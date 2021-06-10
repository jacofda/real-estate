<?php

namespace Areaseb\Estate\Models;

use Areaseb\Estate\Models\{Calendar, City, Primitive};
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use App\User;

class Property extends Primitive
{

    public function feats()
    {
        return $this->belongsToMany(Feat::class, 'property_feat', 'property_id', 'feat_id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function owners()
    {
        return $this->hasMany(Ownership::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public function pois()
    {
        return $this->belongsToMany(Poi::class, 'property_poi', 'property_id', 'poi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


//SCOPE
    public function scopeVendita($query)
    {
        $query = $query->whereIn('contract_id', [1,3])->orWhere('contract_id', 3);
    }

    public function scopeAffitto($query)
    {
        $query = $query->whereIn('contract_id', [2,3])->orWhere('contract_id', 3);
    }

    public function scopeSlug($query, $slug)
    {
        if($locale = app()->getLocale() == 'it')
        {
            $query = $query->where('slug_it', $slug);
        }
        else
        {
            $query = $query->where('slug_en', $slug);
        }

    }



//GETTER
    public static function makeSlug($property)
    {
        // $arr[] = ($property->contract) ? $property->contract->name_it : null;
        $arr[] = ($property->city) ? $property->city->comune : null;
        $arr[] = ($property->tag) ? $property->tag->name_it : null;
        $arr[] = $property->name_it;

        $str = '';
        foreach($arr as $value)
        {
            if($value)
            {
                $str .= str_slug($value).'-';
            }
        }
        $str = rtrim($str, '-');
        $property->update(['slug_it' => $str]);



        // $arr_en[] = ($property->contract) ? $property->contract->name_en : null;
        $arr_en[] = ($property->city) ? $property->city->comune : null;
        $arr_en[] = ($property->tag) ? $property->tag->name_en : null;
        $arr_en[] = $property->name_en ?? $property->name_it ;

        $str_en = '';
        foreach($arr_en as $value_en)
        {
            if($value_en)
            {
                $str_en .= str_slug($value).'-';
            }
        }
        $str_en = rtrim($str_en, '-');
        $property->update(['slug_en' => $str_en]);
    }


    public function getRelatedAttribute()
    {
        return $this->tag->properties()->where('id', '!=', $this->id)->where('contract_id', $this->contract_id)->take(6)->get();
    }


    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        $name = 'name_'.$locale;
        if($this->$name)
        {
            return $this->$name;
        }
        return $this->name_it;
    }

    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        $name = 'desc_'.$locale;
        if($this->$name)
        {
            return $this->$name;
        }
        return $this->desc_it;
    }

    public function getShortDescAttribute()
    {
        $locale = app()->getLocale();
        $name = 'short_desc_'.$locale;
        if($this->$name)
        {
            return $this->$name;
        }
        return $this->short_desc_it;
    }


    public function getUrlAttribute()
    {
        $locale = app()->getLocale();
        $slug = 'slug_'.$locale;

        $lang_definer = ($locale == 'it') ? 'immobile/' : 'property/';
        return url($lang_definer . $this->$slug);

        // return ($locale == 'it') ? 'immobile/' . $this->$slug : 'property/' . $this->$slug;
    }


    public function getAddressApiAttribute()
    {
        if($this->address)
        {
            $city = $this->city;
            $str = str_replace(' ', '+', $this->address).',';
            $str .= $city->cap.','.str_replace(' ', '+', $city->comune).','.str_replace(' ', '+', $city->provincia);
            return $str;
        }
        return null;
    }

    public function getPrezzoVenditaAttribute()
    {
        if($this->sell_price)
        {
            return number_format($this->sell_price, 2, ',', '.');
        }
        return null;
    }

//STATIC
    public static function uniqueState()
    {
        return self::distinct('state')->pluck('state', 'state')->toArray();
    }

    public static function uniqueHeating()
    {
        return self::distinct('heating')->pluck('heating', 'heating')->toArray();
    }

    public static function realCities()
    {
        $realCities = Cache::remember('realCities', 60*5, function () {
            $uniquesCityIds = self::whereNotNull('city_id')->distinct('city_id')->pluck('city_id')->toArray();
            return [''=>'']+City::whereIn('id', $uniquesCityIds)->orderBy('comune', 'ASC')->pluck('comune', 'id')->toArray();
        });
        return $realCities;
    }

    public static function realCitiesChunked()
    {
        $arr = self::realCities();
        $value = reset($arr);
        $key = key($arr);
        unset($arr[$key]);
        return (array_chunk($arr, 3, true));
    }

    public static function realTags()
    {
        $realTags = Cache::remember('realTags', 60*5, function () {
            return [''=>'']+Tag::whereIn('id', Property::whereNotNull('tag_id')->distinct('tag_id')->pluck('tag_id')->toArray())->pluck('name_it', 'id')->toArray();
        });
        return $realTags;
    }

    public static function realTagsChunked()
    {
        $arr = self::realTags();
        $value = reset($arr);
        $key = key($arr);
        unset($arr[$key]);
        return (array_chunk($arr, 2, true));
    }


//IMG GETTER

    public function getFirstImgAttribute()
    {
        if($this->media()->img()->exists())
        {
            return $this->media()->img()->orderBy('media_order', 'ASC')->first()->filename;
        }
        return false;
    }

    public function getOriginalAttribute()
    {
        if($this->first_img)
        {
            return asset('storage/properties/original/'.$this->first_img);
        }
        return false;
    }

    public function getThumbAttribute()
    {
        if($this->first_img)
        {
            return asset('storage/properties/thumb/'.$this->first_img);
        }
        return false;
    }

    public function getPageAttribute()
    {
        if($this->first_img)
        {
            return asset('storage/properties/page/'.$this->first_img);
        }
        return false;
    }

    public function getFullAttribute()
    {
        if($this->first_img)
        {
            return asset('storage/properties/full/'.$this->first_img);
        }
        return false;
    }





// FILTER
    public static function filter()
    {

        $query = Property::with('tag', 'type', 'city', 'media', 'contract', 'requests');

        if(request('feats'))
        {
            $feats = request('feats');
            $query = $query->whereHas('feats', function($q) use($feats) {
                            $q->whereIn('id', $feats);
                        });
        }

        if(request('city_id'))
        {
            $query = $query->where('city_id', request('city_id'));
        }

        if(request('tag_id'))
        {
            $query = $query->where('tag_id', request('tag_id'));
        }

        if(request('contract_id'))
        {
            $query = $query->where('contract_id', request('contract_id'));
        }

        if(request('id'))
        {
            $query = $query->where('id', request('id'));
        }

        if(request('min_price'))
        {
            $query = $query->where('sell_price', '>=', request('min_price'));
        }

        if(request('max_price'))
        {
            $query = $query->where('sell_price', '<=', request('max_price'));
        }

        if(request('min_mq'))
        {
            $query = $query->where('surface', '>=', request('min_mq'));
        }

        if(request('max_mq'))
        {
            $query = $query->where('surface', '<=', request('max_mq'));
        }

        if(request('n_bathrooms'))
        {
            $query = $query->where('n_bathrooms', '<=', request('n_bathrooms'));
        }

        if(request('n_bedrooms'))
        {
            $query = $query->where('n_bedrooms', '<=', request('n_bedrooms'));
        }

        if(request('user_id'))
        {
            $query = $query->where('user_id', request('user_id'));
        }

        if(request('approved') == 'null')
        {
            $query = $query->whereNull('approved');
        }
        elseif(request('approved') == '1')
        {
            $query = $query->where('approved', 1);
        }
        elseif(request('approved') == '0')
        {
            $query = $query->where('approved', 0);
        }



        return $query;

    }

}
