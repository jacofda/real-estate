<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\Primitive;

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

}
