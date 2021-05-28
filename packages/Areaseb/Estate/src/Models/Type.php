<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\Primitive;

class Type extends Primitive
{
    public $timestamps = false;
    protected $table = 'property_types';

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

}
