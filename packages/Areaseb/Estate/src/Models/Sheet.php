<?php

namespace Areaseb\Estate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sheet extends Model
{
    protected $table = 'sheets';
    protected $fillable = [
        'client_id'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Let's create the uuid when the model is created
        self::creating(function ($query) {
            $query->uuid = Str::uuid();
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function scopeUuid($query, $uuid) {
        return $query->where('uuid', $uuid);
    }
}
