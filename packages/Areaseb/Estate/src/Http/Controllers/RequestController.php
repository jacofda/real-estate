<?php

namespace Areaseb\Estate\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request as PostRequest;
use Areaseb\Estate\Models\{Preference, Property, Request};
use Areaseb\Estate\Models\{City, Client, Company, Contact};
use Carbon\Carbon;

class RequestController extends Controller
{

    public function index()
    {
        $requests = Request::with('client', 'property')->latest()->get();
        return view('estate::estate.requests.index', compact('requests'));
    }

    public function create()
    {
        $contacts = [''=>'', 'new' => 'Nuovo Contatto']+Contact::all()->pluck('fullname' ,'id')->toArray();
        $properties = [''=>'']+Property::pluck('name_it', 'id')->toArray();
        return view('estate::estate.requests.create', compact('contacts', 'properties'));
    }

    public function emailExist(PostRequest $request)
    {
        if(Contact::where('email', $request->email)->exists())
        {
            return Contact::where('email', $request->email)->first()->fullname;
        }
        return 0;
    }

    public function createContact(PostRequest $request)
    {
        $city = City::where('comune', 'like', '%'.$request->citta.'%')->first();

        $company = Company::create([
            'rag_soc' => ucfirst($request->nome) . ' ' . ucfirst($request->cognome),
            'email' => $request->email,
            'phone' => $request->mobile,
            'city' => $request->citta,
            'city_id' => is_null($city) ? null : $city->id,
            'zip' => is_null($city) ? null : $city->cap,
            'province' => is_null($city) ? null : $city->provincia,
            'private' => 1,
            'nation' => "IT",
            'lang' => 'it'
        ]);

        $company->clients()->attach(Client::Lead());

        $contact = Contact::create([
            'nome' => ucfirst($request->nome),
            'cognome' => ucfirst($request->cognome),
            'email' => $request->email,
            'cellulare' => $request->mobile,
            'citta' => $request->citta,
            'cap' => is_null($city) ? null : $city->cap,
            'provincia' => is_null($city) ? null : $city->provincia,
            'city_id' => is_null($city) ? null : $city->id,
            'subscribed' => 1,
            'company_id' => $company->id
        ]);

        $contact->clients()->attach(Client::Lead());


        return $contact->id;
    }

    public function store(PostRequest $post)
    {

        $client = Contact::find($post->client_id);
        $property = Property::find($post->property_id);

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
        //
        // if($property->contract_id != 3)
        // {
        //     if(is_null($preference->contract_id))
        //     {
        //         $preference->update(['contract_id' => $property->contract_id]);
        //     }
        // }



        Request::create([
            'client_id' => $post->client_id,
            'property_id' => $post->property_id,
            'type' => $post->type,
            'note' => $post->note,
            'created_at' => Carbon::createFromFormat('d/m/Y', $post->created_at)
        ]);
        return 'done';
    }


    public function edit(Request $request)
    {
        $properties = [''=>'']+Property::pluck('name_it', 'id')->toArray();
        $clients = [''=>'']+Client::pluck('rag_soc', 'id')->toArray();
        return view('estate::estate.requests.edit', compact('properties', 'request', 'clients'));
    }

    public function update(Request $request, PostRequest $post)
    {
        $request->update([
            'client_id' => $post->client_id,
            'property_id' => $post->property_id,
            'type' => $post->type,
            'note' => $post->note,
            'created_at' => Carbon::createFromFormat('d/m/Y', $post->created_at)
        ]);
        return redirect($post->previous_url)->with('message', 'Richiesta aggiornata');
    }


    public function destroy(PostRequest $postRequest, Request $request)
    {
        Request::find($request)->delete();
        return 'done';
    }


}
