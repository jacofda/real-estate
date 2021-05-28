<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\{Contact, Primitive};
use \Carbon\Carbon;
use Areaseb\Estate\Models\Media;

class OwnershipData extends Primitive
{
    public $timestamps = false;
    protected $table = 'ownerships';
    protected $cast = ['owners' => 'array'];

    public function ownership()
    {
        return $this->belongsTo(Ownership::class);
    }

    public static function documents()
    {
        $docs = config('properties.documents');
        $descs = Media::where('mediable_type', 'Areaseb\Estate\Models\Ownership')->distinct('description')->pluck('description');
        foreach($descs as $desc)
        {
            if(!in_array($desc, $docs))
            {
                $docs[$desc] = $desc;
            }
        }
        return $docs;
    }

    public function getOwnersAttribute()
    {
        return json_decode($this->attributes['owners']);
    }

}
