<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Areaseb\Estate\Models\{Client, Contact, NewsletterList, Setting};

class OverrideController extends Controller
{

    public function registerLead()
    {
        $url = 'https://www.'.Setting::base()->sitoweb;
        $urlPP = 'naturalmenteprimi';

        $ref = request()->headers->get('referer');
        if($ref == '')
        {
            $ref = request('referer');
        }

        $ref = request()->headers->get('referer');
        if((strpos($ref, $url) !== false) || (strpos($ref, $urlPP) !== false))
        {
            if(!Contact::where('email', request('email'))->exists())
            {

                $client = new Client;
                    $client->email = request('email');
                    $client->rag_soc = request('nome') . ' ' . request('cognome');
                    $client->phone = request('telefono');
                    $client->private = true;
                $client->save();

                $contact = new Contact;
                    $contact->email = request('email');
                    $contact->nome = request('nome');
                    $contact->cognome = request('cognome');
                    $contact->cellulare = request('telefono');
                    $contact->subscribed = intval(request('newsletter'));
                    $contact->origin = "Sito";
                    $contact->clinet_id = $client->id;
                $contact->save();

                if(intval(request('newsletter')))
                {
                    $list = NewsletterList::firstOrCreate(['nome' => 'Contatti da sito', 'owner_id' => 1]);
                    $contact->lists()->attach($list->id);
                }
            }
        }
        return redirect($url.'/grazie');
    }

}
