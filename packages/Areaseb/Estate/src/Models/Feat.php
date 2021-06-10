<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\Primitive;
use Illuminate\Support\Facades\Cache;

class Feat extends Primitive
{
    public $timestamps = false;
    protected $table = 'property_feats';

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_feat', 'feat_id', 'property_id');
    }

    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        $name = 'name_'.$locale;
        return $this->$name;
    }

    public static function availables()
    {
        $availables = Cache::remember('availables', 60*12, function () {
            foreach(self::with('properties')->get() as $feat)
            {
                if($feat->properties->count())
                {
                    $arr[] = $feat->id;
                }
            }
            return self::whereIn('id', $arr)->get();
        });
        return $availables;
    }

    public static function availablesSell()
    {
        $availablesSell = Cache::remember('availablesSell', 60*12, function () {
            $arr = [];
            foreach(self::with('properties')->get() as $feat)
            {
                if($feat->properties()->where('contract_id', 1)->count())
                {
                    $arr[] = $feat->id;
                }
            }
            if(count($arr))
            {
                return self::whereIn('id', $arr)->get();
            }
            return [];
        });
        return $availablesSell;
    }

    public static function availablesRent()
    {
        $availablesRent = Cache::remember('availablesRent', 60*12, function () {
            $arr = [];
            foreach(self::with('properties')->get() as $feat)
            {
                if($feat->properties()->where('contract_id', 2)->count())
                {
                    $arr[] = $feat->id;
                }
            }
            if(count($arr))
            {
                return self::whereIn('id', $arr)->get();
            }
            return [];
        });
        return $availablesRent;
    }



}
