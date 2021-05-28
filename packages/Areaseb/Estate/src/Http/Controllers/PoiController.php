<?php

namespace Areaseb\Estate\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Areaseb\Estate\Models\Poi;

class PoiController extends Controller
{

    public function index()
    {
        $pois = Poi::paginate(50);
        return view('estate::estate.pois.index', compact('pois'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function edit(Request $request, Poi $tag)
    {

    }

    public function update(Request $request, Poi $tag)
    {

    }

    public function destroy(Poi $tag)
    {
        foreach($tag->properties as $property)
        {
            $property->$tag_id = null;;
        }
        $tag->delete();
        return 'done';
    }

}
