<?php

namespace Areaseb\Estate\Models;

use \Carbon\Carbon;

class Offer extends Primitive
{
    protected $table = 'property_offers';

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


}
