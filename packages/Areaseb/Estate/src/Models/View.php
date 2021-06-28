<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\{Contact, Primitive};
use \Carbon\Carbon;

class View extends Primitive
{
    protected $table = 'property_views';

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function sheet()
    {
        return $this->belongsTo(Sheet::class, 'property_sheet_id');
    }

    public function scopeWithoutSheet($query)
    {
        return $query->doesntHave('sheet');
    }
}
