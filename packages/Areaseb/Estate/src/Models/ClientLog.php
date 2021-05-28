<?php

namespace Areaseb\Estate\Models;

class ClientLog extends Primitive
{
    protected $table = 'client_logs';


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public static function getTypes()
    {
        $arr = ['Feedback' => 'Feedback', 'Nota' => 'Nota'];
        return [''=>'']+$arr+self::pluck('log_type', 'log_type')->toArray();
    }

    public function setLogTypeAttribute($value)
    {
        $this->attributes['log_type'] = ucwords($value);
    }

}
