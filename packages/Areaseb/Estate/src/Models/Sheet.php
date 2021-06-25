<?php

namespace Areaseb\Estate\Models;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    protected $table = 'sheets';
    protected $fillable = [
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }
}
