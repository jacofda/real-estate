<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\{Contact, Primitive};
use \Carbon\Carbon;

class Ownership extends Primitive
{
    protected $table = 'property_ownerships';

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function data()
    {
        return $this->hasOne(OwnershipData::class);
    }


    public function getFromAttribute()
    {
        return Carbon::parse($this->attributes['from']);
    }

    public function getIsLatestAttribute()
    {
        return !self::where('property_id', $this->property_id)->whereDate('from', '>', $this->from)->exists();
    }

}
