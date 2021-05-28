<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\{Contact, Primitive};
use \Carbon\Carbon;

class Request extends Primitive
{
    protected $table = 'property_requests';

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public static function getTypes()
    {
        $arr = [''=>'','Telefono'=>'Telefono', 'Email' => 'Email', 'Passaparola' => 'Passaparola'];
        return $arr+self::whereNotIn('type', $arr)->pluck('type', 'type')->toArray();
    }

}
