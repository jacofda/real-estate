<?php

namespace Areaseb\Estate\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Areaseb\Estate\Models\{Area, Contract, Feat, Property, Preference, Ownership, OwnershipData, Tag, Type};
use Areaseb\Estate\Models\{City, Client, Media};

class OwnershipController extends Controller
{

    public function index()
    {
        if(request('q'))
        {

        }
        else
        {
            $ownerships = Ownership::with('property.city','client')->get();
        }

        return view('estate::estate.ownerships.index', compact('ownerships'));
    }


    public function create()
    {
        $contacts = [''=>'', 'new' => 'Nuovo Contatto']+Contact::all()->pluck('fullname' ,'id')->toArray();
        $properties = [''=>'']+Property::pluck('name_it', 'id')->toArray();
        return view('estate::estate.ownerships.create', compact('contacts', 'properties'));
    }

    public function show(Ownership $ownership)
    {
        // dd($ownership->data->owners[0]);
        $client = $ownership->client;
        $property = $ownership->property;
        return view('estate::estate.ownerships.show', compact('ownership', 'property', 'client'));
    }

    public function store(Request $request)
    {
        $owners = [];
        foreach($request->nome as $key => $value)
        {
            $owners[$key]['nome'] = $value;
            $owners[$key]['cf'] = $request->cf[$key];
        }

        $data = new OwnershipData;
            $data->description = $request->description;
            $data->ownership_id = $request->ownership_id;
            $data->owners = json_encode($owners);
            $data->type = $request->type;
            $data->document_origin = $request->document_origin;
            $data->neighbors = $request->neighbors;
        $data->save();
        return redirect(route('ownerships.index'))->with('message', 'dati salvati');
    }


    public function edit(Ownership $ownership)
    {
        $clients = [''=>'']+Client::pluck('rag_soc', 'id')->toArray();
        $properties = [''=>'']+Property::pluck('name_it', 'id')->toArray();
        return view('estate::estate.ownerships.edit', compact('clients', 'properties', 'ownership'));
    }

    public function update(Request $request, Ownership $ownership)
    {

        if(isset($request->previous_url))
        {
            $ownership->update([
                'client_id' => $request->client_id,
                'property_id' => $request->property_id,
                'created_at' => $ownership->created_at
            ]);
            return redirect($request->previous_url)->with('message', 'Proprietà aggiornata');
        }

        $owners = [];
        foreach($request->nome as $key => $value)
        {
            $owners[$key]['nome'] = $value;
            $owners[$key]['cf'] = $request->cf[$key];
        }

        $data = $ownership->data;
            $data->description = $request->description;
            $data->ownership_id = $request->ownership_id;
            $data->owners = json_encode($owners);
            $data->type = $request->type;
            $data->document_origin = $request->document_origin;
            $data->neighbors = $request->neighbors;
        $data->save();
        return redirect(route('ownerships.index'))->with('message', 'dati salvati');
    }



    public function media(Ownership $ownership)
    {
        $model = $ownership;
        return view('estate::estate.ownerships.media', compact('model'));
    }



}
