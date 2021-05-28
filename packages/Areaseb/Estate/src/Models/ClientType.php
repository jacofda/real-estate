<?php

namespace Areaseb\Estate\Models;

class ClientType extends Primitive
{

    protected $table = 'client_types';

    public function clients()
    {
        return $this->belongsTo(Client::class);
    }

}
