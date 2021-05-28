<?php

namespace Areaseb\Estate\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Areaseb\Estate\Models\{Ownership, Preference, View, Booking};

class Contact extends Primitive
{

//ELOQUENT
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function lists()
    {
        return $this->belongsToMany(NewsletterList::class, 'contact_list', 'contact_id', 'list_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_contact');
    }

    public function preference()
    {
        return $this->hasOne(Preference::class);
    }



    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


// GETTERS AND SETTERs
    public function getFullnameAttribute()
    {
        return $this->nome . ' ' . $this->cognome;
    }

    public function getRagSocAttribute()
    {
        if($this->client_id)
        {
            return $this->client->rag_soc;
        }
        return null;
    }

    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = ucwords(strtolower($value));
    }

    public function setCognomeAttribute($value)
    {
        $this->attributes['cognome'] = ucwords(strtolower($value));
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }


//SCOPES & FILTERS
    public function scopeUser($query)
    {
        return $query = $query->whereNotNull('user_id');
    }

    public function scopeSubscribed($query)
    {
        return $query = $query->where('subscribed', 1);
    }

    public function scopeIscritti($query, $value)
    {
        return $query = $query->where('subscribed', $value);
    }

    public function scopeOrigine($query, $value)
    {
        return $query = $query->where('origin', $value);
    }

    // public function isOfType($type_id)
    // {
    //     if(is_array($type_id))
    //     {
    //         return $this->clients()->whereIn('id',$type_id)->exists();
    //     }
    //
    //     return $this->clients()->where('id',$type_id)->exists();
    // }
    //
    // public function isNotOfType($type_id)
    // {
    //     if(is_array($type_id))
    //     {
    //         return !$this->clients()->whereIn('id',$type_id)->exists();
    //     }
    //
    //     return !$this->clients()->where('id',$type_id)->exists();
    // }


    public function scopeBelongToList($query, $list_id)
    {
        $contactIds = NewsletterList::find($list_id)->contacts()->pluck('contact_id')->toArray();
        return $query = $query->whereIn('id', $contactIds );
    }

    public function getAvatarAttribute()
    {
        $arr = explode(' ', $this->fullname);
        $letters = '';$count = 0;
        foreach($arr as $value)
        {
            if($count < 2)
            {
                $letters .= trim(strtoupper(substr($value, 0, 1)));
            }
            $count++;
        }
        if( strlen($letters) == 1)
        {
            $letters = trim(strtoupper(substr($arr[0], 0, 2)));
        }

        return '<div class="avatar">'.$letters.'</div>';
    }


    public function getNewsletterInviateAttribute()
    {
        if($this->reports()->exists())
        {
            return $this->reports()->inviate()->count();
        }
        return 0;
    }

    public function getNewsletterAperteAttribute()
    {
        if($this->reports()->exists())
        {
            return $this->reports()->aperte()->count();
        }
        return 0;
    }

    public function getNewsletterClickedAttribute()
    {
        if($this->reports()->exists())
        {
            return $this->reports()->clicked()->count();
        }
        return 0;
    }


    public function getNewsletterStatsAttribute()
    {
        return (object) [
            'inviate' => $this->newsletter_inviate,
            'aperte' => $this->newsletter_aperte,
            'clicks' => $this->newsletter_clicked
        ];
    }

    public function getNewFromSiteAttribute()
    {
        if($this->origin == 'Sito')
        {
            if($this->created_at == $this->updated_at)
            {
                return 'class=table-info';
            }
        }
        return '';
    }


    public function getIntNumberAttribute()
    {
        $mobile = str_replace(" ", "", $this->cellulare);
        $mobile = str_replace("-", "", $mobile);
        $mobile = str_replace("/", "", $mobile);
        $mobile = str_replace(".", "", $mobile);
        if(substr($mobile,0,2) == '00')
        {
            $mobile = "+".substr($mobile, 2,-1);
        }
        if($this->nazione == 'IT')
        {
            if(strlen($mobile) == 10)
            {
                if(substr($mobile,0,1) == '3')
                {
                    return "+".Country::where('iso2', $this->nazione)->first()->phone_code.$mobile;
                }
            }
            if(strlen($mobile) == 13)
            {
                return $mobile;
            }
            return null;
        }
        if(substr($mobile,0,1) == '+')
        {
            return $mobile;
        }
        return "+".Country::where('iso2', $this->nazione)->first()->phone_code.$mobile;
    }


    public static function uniquePos()
    {
        return Contact::whereNotNull('pos')->distinct()->pluck('pos', 'pos')->toArray();
    }

    public static function uniqueOrigin()
    {
        return Contact::whereNotNull('pos')->distinct()->pluck('origin', 'origin')->toArray();
    }


    public static function filter($data)
    {

        if($data->get('tipo'))
        {
            if(strpos($data['tipo'], '|'))
            {
                $types = explode('|', $data['tipo']);
                $query = self::whereHas('clients', function($query) use($types) {
                                $query->whereIn('id', $types);
                            })->with('clients', 'city');
            }
            else
            {
                $query = Client::find($data['tipo'])->contacts()->with('city', 'clients');
            }
        }
        else
        {
            $query = self::with('city', 'clients');
        }


        if($data->get('sector'))
        {
            $sector = $data->get('sector');
            $query->whereHas('client', function($query) use($sector) {
                            $query->where('sector_id', $sector);
                        });
        }

        if($data->get('search'))
        {
            $like = '%'.$data['search'].'%';
            $query = $query->where('nome', 'like', $like )
                            ->orWhere('cognome', 'like', $like )
                            ->orWhere('email', 'like', $like )
                            ->orWhere('citta', 'like', $like );
        }

        if($data->get('region'))
        {
            if($data->get('region') != '')
            {
                if(strpos($data['region'], '|'))
                {
                    $regions = explode('|', $data['region']);
                    $query = $query->region( $regions );
                }
                else
                {
                    $query = $query->region( $data['region'] );
                }
            }
        }

        if($data->get('province'))
        {
            if($data->get('province') != '')
            {
                if(strpos($data['province'], '|'))
                {
                    $provinces = explode('|', $data['province']);
                    $query = $query->province( $provinces );
                }
                else
                {
                    $query = $query->province( $data['province'] );
                }
            }
        }

        if($data->get('created_at'))
        {
            if($data->get('created_at') != '')
            {
                $query = $query->created( $data['created_at'] );
            }
        }

        if($data->get('updated_at'))
        {
            if($data->get('updated_at') != '')
            {
                $query = $query->updated( $data['updated_at'] );
            }
        }

        if($data->get('origin'))
        {
            if($data->get('origin') != '')
            {
                $query = $query->origine($data->get('origin'));
            }
        }

        if(!is_null($data->get('subscribed')))
        {
            $query = $query->iscritti($data->get('subscribed'));
        }

        if($data->get('range'))
        {
            $range = explode(' - ', $data->range);
            $da = Carbon::createFromFormat('d/m/Y', $range[0])->format('Y-m-d');
            $a =  Carbon::createFromFormat('d/m/Y', $range[1])->format('Y-m-d');
            $query = $query->whereBetween('created_at', [$da, $a]);
        }

        if($data->get('list'))
        {
            if($data->get('list') != '')
            {
                $query = $query->belongToList( $data['list'] );
            }
        }
        if($data->get('sort'))
        {
            $arr = explode('|', $data->sort);
            $field = $arr[0];
            $value = $arr[1];
            $query = $query->orderBy($field, $value);
        }

        return $query;
    }



    public static function createOrUpdate($contact, $data, $user_id = null)
    {
        if(is_null($user_id))
        {
            $user_id = $data['user_id'];
        }

        $nazione = strtoupper($data['nazione']);
        $provincia = $data['provincia'];
        if(isset($data['provincia']))
        {
            if(strlen($data['provincia']) == 2)
            {
                $provincia = City::provinciaFromSigla( strtoupper($data['provincia']) );
            }
        }
        if(isset($data['pos']))
        {
            $contact->pos = $data['pos'];
        }

        if(isset($data['subscribed']))
        {
            $contact->subscribed = $data['subscribed'];
        }

        $contact->nome = $data['nome'];
        $contact->cognome = $data['cognome'];
        $contact->cellulare = $data['cellulare'];
        $contact->nazione = $data['nazione'];
        $contact->email = $data['email'];
        if(isset($data['indirizzo']))
        {
            $contact->indirizzo = $data['indirizzo'];
        }
        if(isset($data['cap']))
        {
            $contact->cap = $data['cap'];
        }
        if(isset($data['citta']))
        {
            $contact->citta = $data['citta'];
            $contact->city_id = City::getCityIdFromData($provincia, $nazione, $data['citta']);
        }
        else
        {
            $contact->city_id = City::getCityIdFromData($provincia, $nazione);
        }
        $contact->provincia = $provincia;

        $contact->nazione = $nazione;
        if($data['nazione'] != 'IT' )
        {
            if(isset($data['lingua']))
            {
                $contact->lingua = $data['lingua'];
            }
            else
            {
                $contact->lingua = 'en';
            }
        }
        $contact->user_id = $user_id;
        $contact->client_id = $data['client_id'];
        $contact->origin = $data['origin'];
        $contact->save();

        return $contact;
    }


    public static function cleanDelete($contact)
    {
        if(\DB::table('event_contact')->where('contact_id', $contact->id)->exists())
        {
            \DB::table('event_contact')->where('contact_id', $contact->id)->delete();
        }

        if(\DB::table('contact_list')->where('contact_id', $contact->id)->exists())
        {
            \DB::table('contact_list')->where('contact_id', $contact->id)->delete();
        }

        if(\DB::table('reports')->where('contact_id', $contact->id)->exists())
        {
            \DB::table('reports')->where('contact_id', $contact->id)->delete();
        }

        $contact->clients()->detach();
        $contact->delete();

    }
}
