<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\{Contact, Event, Primitive};
use \Carbon\Carbon;

class Booking extends Primitive
{
    public $timestamps = false;
    protected $table = 'property_bookings';
    protected $cast = ['from_date' => 'datetime:Y-m-d', 'to_date' => 'datetime:Y-m-d'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function events()
    {
        return $this->morphMany(Event::class, 'eventable');
    }

    public function getFromDateAttribute()
    {
        return Carbon::parse($this->attributes['from_date']);
    }

    public function getToDateAttribute()
    {
        return Carbon::parse($this->attributes['to_date']);
    }







}
