<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\Primitive;

class Poi extends Primitive
{
    public $timestamps = false;
    protected $table = 'property_pois';

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_poi', 'property_id', 'poi_id');
    }

    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        $name = 'name_'.$locale;
        return $this->$name;
    }

}
