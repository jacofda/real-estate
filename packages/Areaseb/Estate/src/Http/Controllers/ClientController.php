<?php

namespace Areaseb\Estate\Http\Controllers;

use Illuminate\Http\Request;
use Areaseb\Estate\Models\{City, Client, ClientLog, Contact, Country, Exemption, Property, Sector};
use App\User;
use \Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{
    public function index()
    {
        $query = Client::with('type','contacts.preference');
        if(request('q'))
        {
            $q = request('q');
            if($q != '')
            {
                $q = '%'.$q.'%';
                $query =  Client::where('rag_soc', 'like', $q)->orWhere('email', 'like', $q);
                return ['results' => $query->with('type', 'contacts.preference')->get()];
            }

            return ['results' => Client::query()->with('type','contacts.preference')->get()];
        }
        elseif(request('search-client'))
        {
            $search = '%'.request('search-client').'%';
            $contactQuery = Contact::orWhere('nome', 'like', $search );
            $contactQuery = $contactQuery->orWhere('cognome', 'like', $search );
            $companyIds = $contactQuery->pluck('client_id')->toArray();
            $query = $query->whereIn('id', $companyIds);
        }


        $clients = $query->orderBy('created_at', 'DESC')->paginate(30);

       return view('estate::estate.clients.index.index', compact('clients'));

        //return view('estate::core.clients.index.show', compact('clients'));
    }

    public function countIndex(Request $request)
    {
        $search = '%'.$request->search.'%';
            $contactQuery = Contact::orWhere('nome', 'like', $search );
            $contactQuery = $contactQuery->orWhere('cognome', 'like', $search );
        return Client::query()->whereIn('id', $contactQuery->pluck('client_id')->toArray())->count();
    }


    public function create()
    {
        $provinces = City::uniqueProvinces();
        $countries = Country::listCountries();
        $sectors = [''=>'']+Sector::pluck('nome', 'id')->toArray();
        $exemptions = ['' => '']+Exemption::where('connettore', 'Aruba')->orderBy('nome', 'ASC')->pluck('nome', 'id')->toArray();

        return view('estate::core.clients.create', compact('provinces', 'countries', 'sectors', 'exemptions'));
    }


    public function store(Request $request)
    {
        $this->validate(request(),[
            'rag_soc' => "required|unique:clients,rag_soc",
            'email' => "required|email|unique:clients,email",
            'piva' => "required_if:privato,0",
            'pec' => "nullable|unique:clients,pec",
            's1' => "nullable|numeric|between:0.00,99.99"
        ]);

        $lang = 'it';
        if($request->nation != 'IT')
        {
            $lang = 'en';
        }

        if(isset($request->lang))
        {
            $lang = $request->lang;
        }

        $sector_id = null;
        if(!is_null($request->sector_id))
        {
            if(is_numeric($request->sector_id))
            {
                $sector_id = $request->sector_id;
            }
            else
            {
                $sector_id = Sector::create(['nome' => $request->sector_id])->id;
            }
        }

        $client = new Client;
            $client->rag_soc = $request->rag_soc;
            $client->nation = $request->nation;
            $client->lang = $lang;
            $client->address = $request->address;
            $client->city = $request->city;
            $client->zip = $request->zip;
            $client->province = $request->province;
            $client->email = $request->email;
            $client->phone = $request->phone;
            $client->private = $request->private;
            $client->sdi = $request->sdi;
            $client->pec = $request->pec;
            $client->piva = $request->piva;
            $client->cf = $request->cf;
            $client->sector_id = $sector_id;
            $client->type_id = $request->type_id;
            $client->city_id = City::getCityIdFromData($request->provincia, $request->nazione);
        $client->save();


        if(!Contact::where('email', $request->email)->exists())
        {
            $contact = new Contact;
                $contact->email = $request->email;
                $contact->nome = $request->nome;
                $contact->cognome = $request->cognome;
                $contact->indirizzo = $request->address;
                $contact->cap = $client->zip;
                $contact->citta = $client->city;
                $contact->provincia = $client->province;
                $contact->nazione = $client->nation;
                $contact->city_id = $client->city_id;
                $contact->cellulare = $client->phone;
                $contact->origin = "Manuale";
                $contact->company_id = $client->id;
                $contact->lingua = strtolower($client->lang);
                $contact->subscribed = 1;
            $contact->save();
        }

        return redirect(route('clients.index'))->with('message', 'Azienda Creata');
    }


    public function show(Client $client)
    {
        $contact = $client->primary;
        $requests = $client->requests;//\Areaseb\Estate\Models\Request::where('contact_id', $contact->id)->get();
        $properties = [''=>'']+Property::pluck('name_it', 'id')->toArray();
        $logs = $this->generateLogs($client);
        $logsType = ClientLog::getTypes();
        return view('estate::estate.clients.show', compact('client', 'requests', 'contact', 'properties', 'logs', 'logsType'));
    }


    public function edit(Client $client)
    {
        $provinces = City::uniqueProvinces();
        $countries = Country::listCountries();
        $sectors = [''=>'']+Sector::pluck('nome', 'id')->toArray();

        return view('estate::core.clients.edit', compact('provinces', 'countries', 'client', 'sectors'));
    }


    public function update(Request $request, Client $client)
    {
        $this->validate(request(),[
            'rag_soc' => "required|unique:clients,rag_soc,".$client->id.",id",
            'piva' => "required_if:privato,0",
            'pec' => "nullable|unique:colient,pec,".$client->id.",id",
            's1' => "nullable|min:1|max:99"
        ]);

        $lang = 'it';
        if($request->nation != 'IT')
        {
            $lang = 'en';
        }

        if(isset($request->lang))
        {
            $lang = $request->lang;
        }

        $sector_id = null;
        if(!is_null($request->sector_id))
        {
            if(is_numeric($request->sector_id))
            {
                $sector_id = $request->sector_id;
            }
            else
            {
                $sector_id = Sector::create(['nome' => $request->sector_id])->id;
            }
        }

            $client->rag_soc = $request->rag_soc;
            $client->nation = $request->nation;
            $client->lang = $lang;
            $client->address = $request->address;
            $client->city = $request->city;
            $client->zip = $request->zip;
            $client->province = $request->province;
            $client->email = $request->email;
            $client->phone = $request->phone;
            $client->private = $request->private;
            $client->sdi = $request->sdi;
            $client->pec = $request->pec;
            $client->piva = $request->piva;
            $client->cf = $request->cf;
            $client->sector_id = $sector_id;
            $client->type_id = $request->type_id;
            $client->city_id = City::getCityIdFromData($request->provincia, $request->nazione);

        $client->save();

        return redirect(route('clients.index'))->with('message', 'Azienda Aggiornata');
    }


    public function destroy(Client $client)
    {
        try
        {
            $client->clients()->detach();
            foreach($client->contacts as $contact)
            {
                $contact->update(['company_id' => null]);
            }
            $client->delete();
        }
        catch(\Exception $e)
        {
            return "Questo elemento è usato da un'altro modulo";
        }
        return 'done';
    }


//api/companies/create-contacts - POST
    public function createContactsFromCompanies(Request $request)
    {
        $companies = Client::filter($request)->whereNotNull('email')->get();
        $count = 0;
        foreach($companies as $client)
        {
            $email = $client->email;
            if(strpos(',', $client->email) !== false)
            {
                $arr = explode($client->email, ',');
                $email = trim($arr[0]);
            }
            if(strpos(';', $client->email) !== false)
            {
                $arr = explode($client->email, ';');
                $email = trim($arr[0]);
            }

            if(!Contact::where('email', $email)->exists())
            {
                $contact = new Contact;
                    $contact->email = $email;
                    $contact->nome = $client->rag_soc;
                    $contact->indirizzo = $client->address;
                    $contact->cap = $client->zip;
                    $contact->citta = $client->city;
                    $contact->provincia = $client->province;
                    $contact->nazione = $client->nation;
                    $contact->city_id = $client->city_id;
                    $contact->cellulare = $client->phone;
                    $contact->origin = "Manuale";
                    $contact->company_id = $client->id;
                    $contact->lingua = strtolower($client->lang);
                    $contact->subscribed = 1;
                $contact->save();
                $count++;
            }
        }
    return $count." Contatti creati";
}


//api/companies/{id} - GET
    public function checkNation(Client $client)
    {
        return $client->nation;
    }

//api/ta/companies/{$q} - GET
    public function taindexQ($q)
    {
        $query = Client::select('rag_soc as name')->where('rag_soc', 'like', '%'.$q.'%');

        return ['resultCount' => (clone $query)->count(), 'results' => $query->get()];
        return Client::select('rag_soc as name')->where('rag_soc', 'like', '%'.$q.'%')->get();
    }

//api/ta/companies/ - GET
    public function taindex()
    {
        return Client::select('rag_soc as name', 'id')->get();
    }

//api/companies/{company}/discount-exemption - GET
    public function discountExemption(Client $client)
    {
        return $client;
    }

//api/companies/{company}/discount-exemption - GET
    public function payment(Client $client)
    {   if(is_null($client->pagamento))
        {
            return '';
        }
        return config('invoice.payment_types')[$client->pagamento];
    }

    public function getNote(Client $client)
    {
        return $client->note;
    }

    public function addNote(Request $request, Client $client)
    {
        $client->note = $request->obj;
        $client->save();
        return 'done';
    }


    public function generateLogs($client)
    {
        $collection = collect();
        $logs = $client->logs()->with('client', 'property')->get();
        $requests = $client->requests()->with('client', 'property')->get();
        $ownerships = $client->ownerships()->with('client', 'property')->get();
        $views = $client->views()->with('client', 'property')->get();
        $sheets = $client->sheets()->with('client', 'property')->get();

        $properties = collect();
        if($client->primary->user_id)
        {
            if(auth()->user()->properties()->exists())
            {
                if(auth()->user()->properties)
                {
                    $properties = auth()->user()->properties;
                }
            }
        }

        $collection = $collection->merge($requests)->merge($ownerships)->merge($logs)->merge($views)->merge($properties)->merge($sheets);
        return $collection->sortByDesc('created_at');
    }

    public function checkVies(Request $request, Client $client)
    {
        if($client->is_eu)
        {
            if($client->piva && !$client->privato)
            {
                $url = 'https://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl';
                $client = new \SoapClient($url);
                $piva = $client->piva;
                if(strpos($client->piva, $client->nazione) !== false)
                {
                    $piva = substr($client->piva, 2);
                }

                $soapmessage = [
                    'countryCode' => $client->nazione,
                    'vatNumber' => $piva,
                ];

                $result = $client->checkVat($soapmessage);

                if($result->valid)
                {
                    if(is_null($request->exemption_id))
                    {
                        return ['status' => 'warning', 'result' => $result->valid, 'response' => 'Azienda presente in VIES, ma scegli esenzione'];
                    }
                    else
                    {
                        return ['status' => 'success', 'result' => $result->valid, 'response' => 'Azienda presente in VIES e esenzione correttamente impostata!'];
                    }
                }
                else
                {
                    if(is_null($request->exemption_id))
                    {
                        return ['status' => 'warning', 'result' => $result->valid, 'response' => "Azienda non presente in VIES, l'azienda dovrà pagare l'IVA per intero"];
                    }
                    else
                    {
                        return ['status' => 'error', 'result' => $result->valid, 'response' => "Azienda non presente in VIES, l'esenzione non è valida e l'azienda dovrà pagare l'IVA per intero"];
                    }
                }
            }
            else
            {
                return ['status' => 'success', 'response' => "Privato Europeo paga sempre iva!"];
            }
        }
        else
        {
            if(is_null($request->exemption_id))
            {
                return ['status' => 'warning', 'response' => 'Ricordati di selezionare un esenzione'];
            }
            else
            {
                return ['status' => 'success', 'response' => "Esenziona impostata per azienda extra-EU."];
            }
        }
    }


}
