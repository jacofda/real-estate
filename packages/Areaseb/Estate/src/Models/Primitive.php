<?php

namespace Areaseb\Estate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use \Carbon\Carbon;

class Primitive extends Model
{
    protected $guarded = array();

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notificationable');
    }

    //get class name
    public function getClassAttribute()
    {
        $arr = explode("\\", get_class($this));
        return end($arr);
    }

    //get class name
    public function getFullClassAttribute()
    {
        return get_class($this);
    }

    public function getTransClassAttribute()
    {
        if($this->class == 'Ownership')
        {
            return 'Proprietà';
        }
        elseif($this->class == 'Request')
        {
            return 'Richiesta';
        }
        elseif($this->class == 'View')
        {
            return 'Visita';
        }
        elseif($this->class == 'ClientLog')
        {
            return 'Nota';
        }
        return $this->class;
    }

    // public function getColorClassAttribute()
    // {
    //     if($this->class == 'Ownership')
    //     {
    //         return 'Proprietà';
    //     }
    //     elseif($this->class == 'Request')
    //     {
    //         return 'Richiesta';
    //     }
    //     elseif($this->class == 'View')
    //     {
    //         return 'Visita';
    //     }
    //     elseif($this->class == 'ClientLog')
    //     {
    //         return 'Nota';
    //     }
    //
    //     return $this->class;
    // }


    //autogenerate slug and storage folder name from class
    public function getDirectoryAttribute()
    {
        return str_plural(strtolower($this->class));
    }

    public static function getClassFromDirectory($directory, $path)
    {
        return $path.'\\'.str_singular(ucfirst($directory));
    }


    //get url of element
    public function getUrlAttribute()
    {
        return config('app.url') . $this->directory . '/' . $this->id;
    }

    //check if model has column in table
    public function scopeHasColumn($query, $column_name)
    {
        return Schema::connection('mysql')->hasColumn($query->getQuery()->from, $column_name);
    }

    //currency formatter
    public function fmt($number)
    {
        $fmt = new \NumberFormatter( 'it_IT', \NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($number, "EUR");
    }

    //decimal
    public function decimal($number)
    {
        return number_format($number, 2, ',','.');
    }

    public static function NF($number)
    {
        $fmt = new \NumberFormatter( 'it_IT', \NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($number, "EUR");
    }

    public function scopeNation($query, $field)
    {
        if($query->hasColumn('nazione'))
        {
            return $query->where('nazione', $field);
        }

        if($query->hasColumn('nation'))
        {
            return $query->where('nation', $field);
        }

        return $query;
    }


    public function scopeRegion($query, $search)
    {
        if($query->hasColumn('city_id'))
        {
            if(is_array($search))
            {
                return $query->whereHas('city',
                    function($q) use($search){
                        $q->whereIn('regione',$search);
                    });
            }

            if($search == 'Estero')
            {
                $query->where('nation', '!=', 'IT');
            }
            else
            {
                return $query->whereHas('city',
                    function($q) use($search){
                        $q->where('regione',$search);
                    });
            }
        }
        return $query;
    }

    public function scopeProvince($query, $search)
    {
        if($query->hasColumn('city_id'))
        {
            if(is_array($search))
            {
                return $query->whereHas('city',
                    function($q) use($search){
                        $q->whereIn('provincia',$search);
                    });
            }
            return $query->whereHas('city',
                function($q) use($search){
                    $q->where('provincia',$search);
                });
        }
        return $query;
    }

    public function scopeUpdated($query, $days)
    {
        return $query->whereDate('updated_at', '>=', Carbon::today()->subDays( $days ) );
    }

    public function scopeCreated($query, $days)
    {
        return $query->whereDate('created_at', '>=', Carbon::today()->subDays( $days ) );
    }

}
