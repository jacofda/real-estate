<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\Fe\EuVat;

class Client extends Primitive
{
    protected $casts = [
        'note' => 'array'
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function costs()
    {
        return $this->hasMany(Cost::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_client');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function type()
    {
        return $this->belongsTo(ClientType::class);
    }

//PROPERTY SPECIFIC

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function ownerships()
    {
        return $this->hasMany(Ownership::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function logs()
    {
        return $this->hasMany(ClientLog::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }





    public function setNationAttribute($value)
    {
        $this->attributes['nation'] = $value;
        if($value == 'IT')
        {
            $this->attributes['lang'] = strtolower($value);
        }
        else
        {
            $this->attributes['lang'] = 'en';
        }
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = ucfirst($value);
    }

    public function setPivaAttribute($value)
    {
        $sub = substr($value, 0, 2);
        if(!is_numeric($sub))
        {
            $this->attributes['piva'] = filter_var($value,FILTER_SANITIZE_NUMBER_INT);
        }
        $this->attributes['piva'] = $value;
    }

    // public function setPivaAttribute($value)
    // {
    //     if(is_null($this->attributes['cf']))
    //     {
    //         $this->attributes['cf'] = $value;
    //     }
    //     $this->attributes['piva'] = $value;
    // }

    public function setZipAttribute($value)
    {
        $this->attributes['zip'] = str_pad(trim($value), 5, '0', STR_PAD_LEFT);
    }

    public function getAvatarAttribute()
    {
        $arr = explode(' ', $this->rag_soc);
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


    public function getFullnameAttribute()
    {
        return $this->primary->nome . ' ' . $this->primary->cognome;
    }

    public function getProvAttribute()
    {
        return City::siglaFromProvincia($this->province);
    }

    public function getPivaAttribute()
    {
        if($this->private)
        {
            return '00000000000';
        }

        if($this->is_eu)
        {
            $euVat = new EuVat;
            return $euVat->cleanVat($this->attributes['piva'], $this->nation);
        }

        return $this->attributes['piva'];
    }

    public function getCfAttribute()
    {
        if(!$this->private)
        {
            return $this->piva;
        }

        return $this->attributes['cf'];
    }

    public function getSdiAttribute()
    {
        if($this->private)
        {
            return '0000000';
        }

        if($this->nation != 'IT')
        {
            return 'XXXXXXX';
        }

        return $this->attributes['sdi'];
    }

    public function getNewFromSiteAttribute()
    {
        if($this->contacts()->exists())
        {
            $contact = $this->contacts()->first();

            if($contact->origin == 'Sito')
            {
                if($contact->created_at == $contact->updated_at)
                {
                    return 'class=table-info';
                }
            }
        }
        return '';
    }

    public function getSiglaProvinciaAttribute()
    {
        if($this->city_id)
        {
            return City::find($this->city_id)->sigla_provincia;
        }
        return $this->provincia;
    }

    public function getIsItalianAttribute()
    {
        if($this->nation == 'IT')
        {
            return true;
        }
        return false;
    }

    public function getIsEuAttribute()
    {
        $c = Country::where('iso2', $this->nation)->first();
        if($c)
        {
            if($c->is_eu)
            {
                return true;
            }
            return false;
        }
        return false;
    }

    public function getPrimaryAttribute()
    {
        return $this->contacts()->where('contacts.primary', true)->first();
    }


// SCOPES

    public function scopeSettore($query, $value)
    {
        $query = $query->where('sector_id', $value);
    }

//FILTERS
    public static function filter($data)
    {

        if($data->has('tipo') && $data->get('tipo'))
        {
            $query = self::where('type_id', $data['tipo'])->with('city');
        }
        else
        {
            $query = self::with('city');
        }

        if(request()->has('sector') && request()->get('sector'))
        {
            $query = $query->settore(request('sector'));
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


        if($data->get('id'))
        {
            if($data->get('id') != '')
            {
                $query = $query->where('id', $data['id']);
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

}
