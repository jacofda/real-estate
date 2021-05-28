<?php

namespace Areaseb\Estate\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Areaseb\Estate\Models\Feat;

class FeatureController extends Controller
{

    public function index()
    {
        $features = Feat::paginate(50);
        return view('estate::estate.features.index', compact('features'));
    }

    public function destroy(Feat $feature)
    {
        foreach($feature->properties as $property)
        {
            $property->detach($feature->id);
        }
        $feature->delete();
        return 'done';
    }

}
