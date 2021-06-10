<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\Primitive;

class Tag extends Primitive
{
    public $timestamps = false;
    protected $table = 'property_tags';

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        $name = 'name_'.$locale;
        return $this->$name;
    }

    public static function countProperty($name_it)
    {
        if(is_string($name_it))
        {
            $tag = self::where('name_it', $name_it)->first();
            if($tag)
            {
                return $tag->properties()->count();
            }
        }
        else
        {
            $tagsId = self::whereIn('name_it', $name_it)->pluck('id');
            return Property::whereIn('tag_id', $tagsId)->count();
        }

        return 0;
    }

    public static function mostPopular()
    {
        $mostPopular = \Cache::remember('mostPopular', 60*24, function () {
            $commons = [];
            foreach(Tag::all() as $tag)
            {
                $commons[$tag->id] = intval($tag->properties()->sum('views'));
            }
            arsort($commons);
            $count = 0;
            foreach ($commons as $key => $value)
            {
                if($count < 4)
                {
                    $arr[] = $key;
                }
                $count++;
            }
            return self::whereIn('id', $arr)->get();
        });
        return $mostPopular;
    }


}
