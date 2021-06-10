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

    public function affitto()
    {
        return view('properties.index-affitto', compact('properties'));
    }



}
