<?php

namespace Areaseb\Estate\Http\Controllers;

use Areaseb\Estate\Models\{City, Contact, Country, Client, NewsletterList};
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use \Spatie\Permission\Models\Role;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->input())
        {
            if(request('id'))
            {
                $query = Contact::query();
                $query = $query->where('id', request('id'));
            }
            else
            {
                $query = Contact::filter(request());
            }
        }
        else
        {
            $query = Contact::query();
        }

        $contacts = $query->orderby('created_at', 'DESC')->paginate(100);

        return view('estate::core.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = City::uniqueProvinces();
        $countries = Country::listCountries();
        $clients[''] = '';
        $clients += Client::pluck('rag_soc', 'id')->toArray();
        $users[''] = '';
        $users += User::with('contact')->get()->pluck('contact.fullname', 'id')->toArray();
        $lists = NewsletterList::pluck('nome', 'id')->toArray();
        $pos = ['' => '']+Contact::uniquePos();
        $origins = ['' => '']+Contact::uniqueOrigin();

        return view('estate::core.contacts.create', compact('provinces', 'countries', 'clients', 'users', 'lists', 'pos', 'origins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'nome' => 'required',
            'cognome' => 'required',
            'email' => 'required|email|unique:contacts'
        ]);
        $contact = Contact::createOrUpdate(new Contact, request()->input());

        if(!is_null($request->list_id))
        {
            if(count($request->list_id) > 0)
            {
                $contact->lists()->attach($request->list_id);
            }
        }

        return redirect(route('contacts.index'))->with('message', 'Contatto Creato');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contacts\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('estate::core.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contacts\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $provinces = City::uniqueProvinces();
        $countries = Country::listCountries();
        $clients[''] = '';
        $clients += Client::pluck('rag_soc', 'id')->toArray();
        $users[''] = '';
        $users += User::with('contact')->get()->pluck('contact.fullname', 'id')->toArray();
        $lists = NewsletterList::pluck('nome', 'id')->toArray();

        $pos = ['' => '']+Contact::uniquePos();
        $origins = ['' => '']+Contact::uniqueOrigin();

        return view('estate::core.contacts.edit', compact('provinces', 'countries', 'clients', 'users', 'contact', 'lists', 'pos', 'origins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contacts\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        if(!is_null($request->list_id))
        {
            if(count($request->list_id) > 0)
            {
                $contact->lists()->sync($request->list_id);
            }
        }

        $this->validate(request(), [
            'nome' => 'required',
            'cognome' => 'required',
            'email' => "required|email|unique:contacts,email,".$contact->id.",id"
        ]);
        Contact::createOrUpdate($contact, request()->input());


        if(isset($request->prev))
        {
            return redirect($request->prev)->with('message', 'Contatto Aggiornato');
        }

        return redirect(route('contacts.index'))->with('message', 'Contatto Aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contacts\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if(!is_null($contact->user_id) && ($contact->user_id != auth()->user()->id))
        {
            $user = User::findOrFail($contact->user_id);

            foreach($user->events as $event)
            {
                $event->delete();
            }

            foreach($user->calendars as $calendar)
            {
                $calendar->delete();
            }

            foreach($user->roles as $role)
            {
                $user->removeRole($role->name);
            }

            foreach($user->permissions as $permission)
            {
                $user->revokePermissionTo($permission->name);
            }

            $user->delete();

            Contact::cleanDelete($contact);

            return 'done';
        }
        elseif($contact->user_id == auth()->user()->id)
        {
            return "Questo contatto è collegato all'utente loggato in questa sessione, non si può eliminare";
        }
        elseif(!is_null($contact->user_id))
        {
            return "Questo contatto è collegato ad un'utente.";
        }

        Contact::cleanDelete($contact);
        return 'done';
    }

//contacts-validate-file
    public function validateFile(Request $request)
    {
        $this->validate(request(), [
            'file' => 'mimes:csv'
        ]);
    }

//contacts/-comapny
    public function Company(Request $request)
    {
        $contact = Contact::find($request->id);

        $company = new Company;
            $client->rag_soc = $contact->fullname;
            $client->address = $contact->indirizzo;
            $client->zip = $contact->cap;
            $client->city = $contact->citta;
            $client->province = $contact->provincia;
            $client->city_id = $contact->city_id;
            $client->nation = $contact->nazione;
            $client->lang = $contact->lingua;
            $client->email = $contact->email;
        $client->save();

        $contact->client_id = $client->id;
        $contact->save();


        return redirect( route('contacts.edit', $contact->id ) )->with('message', 'Azienda da contatto creata! Assicurati di compilare i campi mancanti');
    }


//contacts/make-comapny
    public function makeCompany(Request $request)
    {
        $contact = Contact::find($request->id);
        $company = new Company;
            $client->rag_soc = $contact->fullname;
            $client->address = $contact->indirizzo;
            $client->zip = $contact->cap;
            $client->city = $contact->citta;
            $client->province = $contact->provincia;
            $client->city_id = $contact->city_id;
            $client->nation = $contact->nazione;
            $client->lang = $contact->lingua;
            $client->email = $contact->email;
        $client->save();

        $contact->client_id = $client->id;
        $contact->save();


        return redirect('companies/'.$client->id.'/edit')->with('message', 'Azienda da contatto creata! Assicurati di compilare i campi mancanti');
    }

//contacts/make-user
    public function makeUser(Request $request)
    {
        $contact = Contact::find($request->id);
        if(is_null($contact->email))
        {
            return redirect(route('contacts.index'))->with('error', "Questo contatto non ha un'email. Impossibile creare l'utente");
        }

        $rs = str_random(8);

        $user = User::create([
            'email' => $contact->email,
            'password' => bcrypt($rs)
        ]);

        $contact->user_id = $user->id;
        $contact->save();

        return redirect(route('contacts.index'))->with('message', "Utente creato ". $rs .". Potrà chiedere una nuova password usando l'email: ".$contact->email);
    }


//api/ta/contacts
    public function taindex()
    {
        $contacts = [];$count = 0;

        foreach(Contact::all('nome', 'cognome', 'id') as $contact)
        {
            $contacts[$count]['id'] = $contact->id;
            $contacts[$count]['name'] = $contact->nome . ' ' . $contact->cognome;
            $count++;
        }

        return $contacts;
    }

//contact-switch-primary/{contact} - GET
    public function switchPrimary(Contact $contact)
    {
        foreach($contact->client->contacts as $c)
        {
            $c->update(['primary' => 0]);
        }
        $contact->update(['primary' => 1]);
        return 'done';
    }

}
