<?php

namespace Areaseb\Estate\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Areaseb\Estate\Models\{Area, Contract, Feat, Property, Preference, Ownership, Tag, Type};
use Areaseb\Estate\Models\{Calendar, City, Client, Contact, Media};
use Areaseb\Estate\Exports\PropertyExport;
use Carbon\Carbon;

class PropertyController extends Controller
{

    public function export()
    {
        $properties = Property::with('contract', 'tag', 'city', 'feats', 'type', 'area')->get();
        return \Excel::download(new PropertyExport, 'properties.xlsx');
    }

    public function index()
    {

        if(request('search-property'))
        {
            $search = '%'.request('search-property').'%';
            $query = Property::query()->where('rif', 'like', $search);
            if($query->count() == 0 )
            {
                $query = Property::query()->where('name_it', 'like', $search);
            }
        }
        else
        {
            $query = Property::filter();
        }


        $properties = $query->get();
        $cities = Property::realCities();
        $tags =  Property::realTags();
        return view('estate::estate.properties.index-dt', compact('properties', 'cities', 'tags'));
    }


    public function countIndex(Request $request)
    {
        $search = '%'.$request->search.'%';
            $query = Property::orWhere('name_it', 'like', $search );
            $query = $query->orWhere('rif', 'like', $search );
        return $query->count();
    }


    public function create()
    {
        $types = [''=>'']+Type::pluck('name_it', 'id')->toArray();
        $tags = [''=>'']+Tag::pluck('name_it', 'id')->toArray();
        $contracts = [''=>'']+Contract::pluck('name_it', 'id')->toArray();
        $cities = [''=>''];
        $provincies = [''=>'']+City::uniqueProvinces();
        $states = Property::uniqueState();
        $heatings = Property::uniqueHeating();
        $areas = [''=>'']+Area::pluck('name', 'id')->toArray();
        $feats = Feat::pluck('name_it', 'id')->toArray();
        $featsSelected = [];

        return view('estate::estate.properties.create', compact('types', 'tags', 'contracts', 'cities', 'provincies', 'states', 'heatings', 'feats', 'featsSelected', 'areas'));
    }

    public function store(Request $request)
    {
        // return $request->input();

        $this->validate(request(),[
            'name_it' => 'required',
            'desc_it' => 'required',
            'short_desc_it' => 'required',
            'type_id' => 'required',
            'contract_id' => 'required',
            'tag_id' => 'required',
            'province' => 'required',
            'city_id' => 'required'
        ]);



        $property = Property::create([
            'rif' => $request->rif,
            'contract_id' => $request->contract_id,
            'type_id' => $request->type_id,
            'tag_id' => $request->tag_id,
            'name_it' => $request->name_it,
            'short_desc_it' => $request->short_desc_it,
            'desc_it' => $request->desc_it,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'city_id' => $request->city_id,
            'area_id' => $request->area_id,
            'state' => $request->state,
            'heating' => $request->heating,
            'energy_class' => $request->energy_class,
            'ipe' => $request->ipe,

            'aquired_at' => $request->aquired_at ? Carbon::createFromFormat('d/m/Y', $request->aquired_at) : null,
            'built_at' => $request->built_at ? Carbon::createFromFormat('d/m/Y', '01/01/'.$request->built_at) : null,
            'status' => $request->status,

            'censito_a' => $request->censito_a,
            'partita' => $request->partita,
            'mappali' => $request->mappali,
            'categoria' => $request->categoria,
            'foglio' => $request->foglio,
            'particella' => $request->particella,
            'subalterno' => $request->subalterno,
            'rendita' => $request->rendita,

            'floor' => $request->floor,
            'n_bathrooms' => $request->n_bathrooms,
            'n_bedrooms' => $request->n_bedrooms,
            'n_garages' => $request->n_garages,
            'n_floors' => $request->n_floors,
            'surface' => $request->surface,
            'land_surface' => $request->land_surface,
            'garden_surface' => $request->garden_surface,
            'rent_period' => $request->rent_period,
            'rent_price' => $request->rent_price,
            'sell_price' => $request->sell_price,
            'highlighted' => $request->highlighted,
            'discounted' => $request->discounted
        ]);


        if(intval($request->highlighted))
        {
            if( Property::whereNotNull('highlighted')->count() > 6)
            {
                Property::whereNotNull('highlighted')->orderBy('updated_at', 'ASC')->first()->update(['highlighted' => null]);
            }
        }

        if(intval($request->discounted))
        {
            if( Property::whereNotNull('discounted')->count() > 6)
            {
                Property::whereNotNull('discounted')->orderBy('updated_at', 'ASC')->first()->update(['discounted' => null]);
            }
        }

        $property->feats()->sync($request->feats);

        $property->pois()->sync($request->pois);

        Property::makeSlug($property);

        if($property->contract_id != 1)
        {
            if(!$property->calendar)
            {
                Calendar::create([
                    'user_id' => 1,
                    'nome' => 'Imm Rif.'. $property->rif,
                    'privato' => 0
                ]);
            }
        }

        return redirect(route('properties.index'))->with('message', 'Immobile creato');

    }

    public function show(Property $property)
    {


                // dd($property->address_api);

        //dd($property->requests);
        if($property->owners)
        {
            $contacts = [''=>'']+Client::whereNotIn('id', $property->owners()->pluck('client_id')->toArray())->get()->pluck('fullname' ,'id')->toArray();
        }
        else
        {
            $contacts = [''=>'']+Client::all()->pluck('fullname' ,'id')->toArray();
        }

        $requests = $property->requests;

        return view('estate::estate.properties.show', compact('property', 'contacts', 'requests'));
    }

    public function edit(Request $request, Property $property)
    {
        $types = [''=>'']+Type::pluck('name_it', 'id')->toArray();
        $tags = [''=>'']+Tag::pluck('name_it', 'id')->toArray();
        $contracts = [''=>'']+Contract::pluck('name_it', 'id')->toArray();
        $cities = [''=>''];
        $provincies = [''=>'']+City::uniqueProvinces();
        $states = Property::uniqueState();
        $heatings = Property::uniqueHeating();
        $areas = [''=>'']+Area::pluck('name', 'id')->toArray();
        $feats = Feat::pluck('name_it', 'id')->toArray();
        $featsSelected = $property->feats()->pluck('id', 'id')->toArray();
        return view('estate::estate.properties.edit', compact('property', 'types', 'tags', 'contracts', 'cities', 'provincies', 'states', 'heatings', 'feats', 'featsSelected', 'areas'));
    }

    public function update(Request $request, Property $property)
    {
        $this->validate(request(),[
            'name_it' => 'required',
            'desc_it' => 'required',
            'type_id' => 'required',
            'contract_id' => 'required',
            'tag_id' => 'required',
            'province' => 'required',
            'city_id' => 'required'
        ]);


        $property->update([
            'rif' => $request->rif,
            'contract_id' => $request->contract_id,
            'type_id' => $request->type_id,
            'tag_id' => $request->tag_id,
            'name_it' => $request->name_it,
            'slug_it' => $request->slug_it,
            'short_desc_it' => $request->short_desc_it,
            'desc_it' => $request->desc_it,

            'name_en' => $request->name_en,
            'slug_en' => $request->slug_en,
            'short_desc_en' => $request->short_desc_en,
            'desc_en' => $request->desc_en,

            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'city_id' => $request->city_id,
            'area_id' => $request->area_id,
            'state' => $request->state,
            'heating' => $request->heating,
            'energy_class' => $request->energy_class,
            'ipe' => $request->ipe,

            'aquired_at' => $request->aquired_at ? Carbon::createFromFormat('d/m/Y', $request->aquired_at) : null,
            'built_at' => $request->built_at ? Carbon::createFromFormat('d/m/Y', '01/01/'.$request->built_at) : null,
            'status' => $request->status,

            'censito_a' => $request->censito_a,
            'partita' => $request->partita,
            'mappali' => $request->mappali,
            'categoria' => $request->categoria,
            'foglio' => $request->foglio,
            'particella' => $request->particella,
            'subalterno' => $request->subalterno,
            'rendita' => $request->rendita,

            'floor' => $request->floor,
            'n_bathrooms' => $request->n_bathrooms,
            'n_bedrooms' => $request->n_bedrooms,
            'n_garages' => $request->n_garages,
            'n_floors' => $request->n_floors,
            'surface' => $request->surface,
            'land_surface' => $request->land_surface,
            'garden_surface' => $request->garden_surface,
            'rent_period' => $request->rent_period,
            'rent_price' => $request->rent_price,
            'sell_price' => $request->sell_price,
            'highlighted' => $request->highlighted,
            'discounted' => $request->discounted
        ]);

        if(intval($request->highlighted))
        {
            if( Property::whereNotNull('highlighted')->count() > 6)
            {
                Property::whereNotNull('highlighted')->orderBy('updated_at', 'ASC')->first()->update(['highlighted' => null]);
            }
        }

        if(intval($request->discounted))
        {
            if( Property::whereNotNull('discounted')->count() > 6)
            {
                Property::whereNotNull('discounted')->orderBy('updated_at', 'ASC')->first()->update(['discounted' => null]);
            }
        }


        $property->feats()->sync($request->feats);

        $property->pois()->sync($request->pois);



        if($property->contract_id != 1)
        {
            if(!$property->calendar)
            {
                $calendar = Calendar::create([
                    'user_id' => 1,
                    'nome' => 'Imm Rif.'. $property->rif,
                    'privato' => 0
                ]);
                $property->update(['calendar_id' => $calendar->id]);
            }
        }

        if($request->url_before)
        {
            return redirect($request->url_before)->with('message', 'Immobile aggiornato');
        }


        return redirect(route('properties.index'))->with('message', 'Immobile aggiornato');

    }

    public function destroy(Property $property)
    {
        Media::deleteAllMedia($property);
        if($property->feats()->exists())
        {
            $property->feats()->delete();
        }

        if($property->pois()->exists())
        {
            $property->pois()->delete();
        }

        $property->delete();
        return 'done';
    }


    public function media(Property $property)
    {
        $model = $property;
        return view('estate::estate.properties.media', compact('model'));
    }

    public function cityArea($city_id)
    {
        $arr[0]['id'] = '';$arr[0]['text'] = ''; $count = 1;
        foreach(Area::where('city_id', $city_id)->pluck('name', 'id')->toArray() as $id => $text)
        {
            $arr[$count]['id'] = $id;
            $arr[$count]['text'] = $text;
            $count++;
        }
        return $arr;
    }

    public function typeAhead()
    {
        return Property::select('name_it as text', 'id')->get();
    }


    //api/properties-filter
    public function filter(Request $request)
    {
        $preference = Preference::firstOrCreate(['contact_id' => $request->contact_id]);
        $preference->update([
            'sell_price_from' => null,
            'sell_price_to' => null,
            'rent_price_from' => null,
            'rent_price_to' => null,
            'surface_from' => null,
            'surface_to' => null
        ]);

        $query = Property::query();

        $contract_id = []; $city_ids = []; $tag_ids = [];
        foreach($request->data as $arr)
        {
            if($arr['name'] == 'contract_id')
            {
                $contract_id[] = $arr['value'];
            }
            elseif($arr['name'] == 'city_id')
            {
                $city_ids[] = $arr['value'];
            }
            elseif($arr['name'] == 'tag_id')
            {
                $tag_ids[] = $arr['value'];
            }
            elseif($arr['name'] == 'sell_price_from')
            {
                $query = $query->where('sell_price', '>=', $arr['value']);
            }
            elseif($arr['name'] == 'sell_price_to')
            {
                $query = $query->where('sell_price', '<=', $arr['value']);
            }
            elseif($arr['name'] == 'rent_price_from')
            {
                $query = $query->where('rent_price', '>=', $arr['value']);
            }
            elseif($arr['name'] == 'rent_price_to')
            {
                $query = $query->where('rent_price', '<=', $arr['value']);
            }
            elseif($arr['name'] == 'surface_from')
            {
                $query = $query->where('surface', '>=', $arr['value']);
            }
            elseif($arr['name'] == 'surface_to')
            {
                $query = $query->where('surface', '<=', $arr['value']);
            }

            if( (strpos($arr['name'], '_to') !== false) || (strpos($arr['name'], '_from') !== false))
            {
                $preference->update([$arr['name'] => $arr['value']]);
            }

        }

        if(count($contract_id))
        {
            if(count($contract_id) === 1)
            {
                $query = $query->whereIn('contract_id', $contract_id);
                $preference->update(['contract_id' => $contract_id[0]]);
            }
            else
            {
                $query = $query->where('contract_id', 3);
                $preference->update(['contract_id' => 3]);
            }
        }
        else
        {
            $preference->update(['contract_id' => null]);
        }

        if(count($city_ids))
        {
            $query = $query->whereIn('city_id', $city_ids);
            $preference->update(['areas' => $city_ids]);
        }
        else
        {
            $preference->update(['areas' => null]);
        }

        if(count($tag_ids))
        {
            $query = $query->whereIn('tag_id', $tag_ids);
            $preference->update(['tags' => $tag_ids]);
        }
        else
        {
            $preference->update(['tags' => null]);
        }

        return ['results' => $query->get(), 'search' => $request->data];
    }


    //api/properties-filter/{contact_id}
    public function filterClient($contact_id)
    {
        $ps = null;$contact = Contact::find($contact_id);
        if($contact->preference)
        {
            $ps = $contact->preference->properties()->get();
        }
        return view('estate::companies.offers', compact('ps'));
    }


//OWNER
    public function addOwner(Request $request, Property $property)
    {
        //return $request->input();
        Ownership::create([
            'property_id' => $property->id,
            'contact_id' => $request->contact_id,
            'from' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->from)
        ]);
        return back()->with('message', 'Propietario Aggiunto');
    }

    public function addProperty(Request $request, Client $client)
    {
        Ownership::create([
            'property_id' => $request->property_id,
            'client_id' => $client->id,
            'from' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->from)
        ]);
        return 'done';
    }

    public function deleteOwner(Request $request, $owner_id)
    {
        Ownership::find($owner_id)->delete();
        return 'done';
    }

}
