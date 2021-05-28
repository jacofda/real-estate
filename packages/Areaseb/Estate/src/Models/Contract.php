<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\Primitive;

class Contract extends Primitive
{
    public $timestamps = false;
    protected $table = 'property_contracts';

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        $name = 'name_'.$locale;
        return $this->$name;
    }

}
