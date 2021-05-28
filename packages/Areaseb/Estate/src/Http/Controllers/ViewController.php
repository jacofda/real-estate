<?php

namespace Areaseb\Estate\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Areaseb\Estate\Models\{Preference, Property, View};
use Areaseb\Estate\Models\{City, Client, Company, Contact};
use Carbon\Carbon;

class ViewController extends Controller
{

    public function index()
    {
        $views = View::with('client', 'property')->latest()->get();
        return view('estate::estate.views.index', compact('views'));
    }

    public function create()
    {
        $clients = [''=>'', 'new' => 'Nuovo Contatto']+Client::pluck('rag_soc' ,'id')->toArray();
        $properties = [''=>'']+Property::pluck('name_it', 'id')->toArray();
        return view('estate::estate.views.create', compact('clients', 'properties'));
    }

    public function store(Request $request)
    {

        $client = Client::find($request->client_id);
        $property = Property::find($request->property_id);
        //
        // $preference = Preference::firstOrCreate(['contact_id' => $request->contact_id]);
        //
        // if($property->city_id)
        // {
        //     if(!$preference->hasCity($property->city_id))
        //     {
        //         $city_ids = $preference->areas;
        //         $city_ids[] = $property->city_id;
        //         $preference->update(['areas' => $city_ids]);
        //     }
        // }
        //
        // if($property->tag_id)
        // {
        //     if(!$preference->hasTag($property->tag_id))
        //     {
        //         $tags_ids = $preference->tags;
        //         $tags_ids[] = $property->tag_id;
        //         $preference->update(['tags' => $tags_ids]);
        //     }
        // }
        //
        // if($property->contract_id != 3)
        // {
        //     if(is_null($preference->contract_id))
        //     {
        //         $preference->update(['contract_id' => $property->contract_id]);
        //     }
        // }

        View::create([
            'client_id' => $request->client_id,
            'property_id' => $request->property_id,
            'note' => $request->note,
            'created_at' => Carbon::createFromFormat('d/m/Y H:i', $request->created_at)
        ]);

        if($request->previous_url)
        {
            if(strpos($request->previous_url, 'clients') !== false)
            {
                return redirect(route('clients.show',$client->id))->with('message', 'Visita Aggiunta');
            }
            return 'done';
        }

        return 'done';
    }

    public function edit(View $view)
    {
        $clients = [''=>'', 'new' => 'Nuovo Contatto']+Client::pluck('rag_soc' ,'id')->toArray();
        $properties = [''=>'']+Property::pluck('name_it', 'id')->toArray();

        return view('estate::estate.views.edit', compact('view', 'clients', 'properties'));
    }

    public function update(Request $request, View $view)
    {
        $view->update([
            'created_at' => Carbon::createFromFormat('d/m/Y H:i', $request->created_at),
            'note' => $request->note,
        ]);

        if($request->old_url)
        {
            if(strpos($request->old_url, 'companies') !== false)
            {
                return redirect(route('companies.show',$contact->company_id))->with('message', 'Visita Aggiunta');
            }
            return redirect(route('views.index'));
        }

        return redirect(route('views.index'));
    }

    public function destroy(View $view)
    {
        $view->delete();
        return 'done';
    }




}
