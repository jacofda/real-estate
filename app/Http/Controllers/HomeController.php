<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Areaseb\Estate\Models\{Media, Property};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function account()
    {
        return view('home');
    }

    public function client()
    {
        return view('account.client');
    }

    public function clientUpdate()
    {
        $this->validate(request(), [
            'nome' => 'required',
            'cognome' => 'required',
        ]);

        $user = auth()->user();
        $contact = $user->contact;
        $client = $contact->client;

        $nome = ucfirst(strtolower(request('nome')));
        $cognome = ucfirst(strtolower(request('cognome')));

        $city = City::where('cap', request('zip'))->first();
        
        if(is_null($city))
        {
            $city = City::where('comune', request('city'))->first();
        }

        if(is_null($city))
        {
            $city = City::where('provincia', request('province'))->first();
        }

        $clientData = [
            'rag_soc' =>  $nome. ' ' . $cognome,
            'cellulare' => request('cellulare'),
            'email' => request('email'),
            'indirizzo' => request('address'),
            'cap' => request('zip'),
            'citta' => request('city'),
            'provincia' => request('province'),
            'nazione' => request('nation'),
            'phone' => request('telefono'),
            'piva' => request('piva'),
            'cf' => request('cf'),
            'city_id' => is_null($city) ? null : $city->id
        ];

        if($client)
        {
            $client->update($clientData);
        }
        else
        {
            $client = Client::create($clientData);
        }

        $contactData = [
            'nome' => $nome,
            'cognome' => $cognome,
            'cellulare' => request('cellulare'),
            'email' => request('email'),
            'indirizzo' => request('address'),
            'cap' => request('zip'),
            'citta' => request('city'),
            'provincia' => request('province'),
            'nazione' => request('nation'),
            'user_id' => $user->id,
            'client_id' => $client->id,
            'city_id' => is_null($city) ? null : $city->id
        ];

        if($contact)
        {
            $contact->update($contactData);
        }
        else
        {
            $contact = Contact::create($contactData);
        }


        $message = trans('Dati anagrafici') . ' ' . trans('Aggiornati');
        return back()->with('message', $message);
    }


    public function credentials()
    {
        return view('account.credentials');
    }

    public function credentialsUpdate()
    {
        $user = auth()->user();

        $this->validate(request(), [
            'email' => 'required|string|email|unique:users,email,'.$user->id.',id',
            'password' => 'required'
        ]);

        $user->update([
            'password' => bcrypt('password'),
            'email' => request('email')
        ]);

        $message = trans('Credenziali Aggiornate');
        return back()->with('message', $message);
    }


    public function properties()
    {
        return view('account.properties');
    }

    public function addProperty(Request $request)
    {

        $rules = [
            'name_it' => 'required',
            'desc_it' => 'required',
            'tag_id' => 'required',
            'city_id' => 'required',
            'rent_price' => 'nullable|numeric',
            'sell_price' => 'nullable|numeric',
            'surface' => 'nullable|numeric',
        ];
        $messages = [
            'name_it.required' => 'Il titolo immobile è obbligatorio',
            'desc_it.required' => 'La descrizione è obbligatoria',
            'tag_id.required' => 'La tipologia immobile è obbligatoria',
            'city_id.required' => 'La locazione dell\'immobile è obbligatoria',
            'rent_price.numeric' => 'Il prezzo deve essere un numero',
            'sell_price.numeric' => 'Il prezzo deve essere un numero',
            'surface.numeric' => 'La superficie deve essere un numero',
        ];
        $request->validate($rules, $messages);

        $property = Property::create($request->except('_token'));
        $property->update([
            'approved' => null,
            'slug_it' => \Str::slug($property->name_it)
        ]);
        return back()->with('message', 'Immobile Aggiunto');
    }

    public function mediaProperty($slug)
    {
        $property = Property::slug($slug)->first();
        if(is_null($property))
        {
            $property = Property::where('name_it', $slug)->first();
        }
        return view('account.media', compact('property'));
    }

    public function mediaPropertyStore(Request $request)
    {
        $property = Property::find($request->mediable_id)->first();
        Media::saveImageOrFile($request);

        return 'done';
    }




}
