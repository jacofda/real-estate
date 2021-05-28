<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\{Contact, Primitive};
use \Carbon\Carbon;

class Preference extends Primitive
{
    public $timestamps = false;

    protected $casts = [
        'areas' => 'array',
        'tags' => 'array',
    ];


    public function hasCity($id)
    {
        if($this->areas)
        {
            if(in_array($id, $this->areas))
            {
                return true;
            }
        }
        return false;
    }

    public function hasTag($id)
    {
        if($this->tags)
        {
            if(in_array($id, $this->tags))
            {
                return true;
            }
        }
        return false;
    }

    public function getHasNoPreferencesAttribute()
    {
        if(!is_null($this->contract_id) || !is_null($this->areas) || !is_null($this->tags))
        {
            return true;
        }
        return false;
    }

    public function properties()
    {

        $query = Property::query();

        if($this->contract_id)
        {
            $query = $query->where('contract_id', $this->contract_id);
        }
        if($this->sell_price_from)
        {
            $query = $query->where('sell_price', '>=',$this->sell_price_from);
        }
        if($this->sell_price_to)
        {
            $query = $query->where('sell_price', '<=', $this->sell_price_to);
        }
        if($this->rent_price_from)
        {
            $query = $query->where('rent_price', '>=', $this->rent_price_from);
        }
        if($this->rent_price_to)
        {
            $query = $query->where('rent_price', '<=', $this->rent_price_to);
        }
        if($this->surface_from)
        {
            $query = $query->where('surface', '>=',$this->surface_from);
        }
        if($this->surface_to)
        {
            $query = $query->where('surface', '<=', $this->surface_to);
        }
        if($this->areas)
        {
            $query = $query->whereIn('city_id', $this->areas);
        }
        if($this->tags)
        {
            $query = $query->whereIn('tag_id', $this->tags);
        }

        return $query;

    }



}
