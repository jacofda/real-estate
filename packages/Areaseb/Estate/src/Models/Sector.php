<?php

namespace Areaseb\Estate\Models;

class Sector extends Primitive
{
    public $timestamps = false;

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

}
