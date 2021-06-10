<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Areaseb\Estate\Models\Property;

class PropertyController extends Controller
{

    public function vendita()
    {
        $query = Property::filter();
        $properties = $query->vendita()->paginate(9);
        return view('properties.index-vendita', compact('properties'));
    }

    public function affitto()
    {
        $query = Property::filter();
        $properties = $query->affitto()->paginate(9);
        return view('properties.index-affitto', compact('properties'));
    }

    public function index()
    {
        $properties = Property::filter()->paginate(9);
        return view('properties.index', compact('properties'));
    }

    public function show($slug)
    {
        $property = Property::slug($slug)->first();
        if(is_null($property))
        {
            if(app()->getLocale() == 'en')
            {
                $property = Property::where('slug_it', $slug)->first();
                if($property)
                {
                    return redirect('property/'.$property->slug_en);
                }
            }

            if(app()->getLocale() == 'it')
            {
                $property = Property::where('slug_en', $slug)->first();
                if($property)
                {
                    return redirect('immobile/'.$property->slug_it);
                }
            }

            return 'error in show';

        }
        $images = $property->media()->img()->get();
        $property->increment('views');
        return view('properties.show', compact('property', 'images'));
    }


    public function grid()
    {
        $properties = Property::filter()->paginate(9);
        $properties->withPath(url()->previous());
        return view('properties.index.ajax-grid', compact('properties'));
    }

}
