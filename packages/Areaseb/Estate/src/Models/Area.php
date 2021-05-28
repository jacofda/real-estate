<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\Primitive;

class Area extends Primitive
{
    public $timestamps = false;
    protected $table = 'property_areas';

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

}
