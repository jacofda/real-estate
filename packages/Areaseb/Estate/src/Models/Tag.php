<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\Primitive;

class Tag extends Primitive
{
    public $timestamps = false;
    protected $table = 'property_tags';

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
