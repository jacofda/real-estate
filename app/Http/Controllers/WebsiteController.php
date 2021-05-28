<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Areaseb\Estate\Models\Property;

class WebsiteController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }

    public function vendita()
    {

        $query = Property::filter();
        $properties = $query->paginate(9);

        return view('properties.index-vendita', compact('properties'));
    }

    public function affitto()
    {
        return view('properties.index-affitto', compact('properties'));
    }



}
