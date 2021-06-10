<?php

namespace Areaseb\Estate\Http\Controllers;

use Illuminate\Http\Request;
use Areaseb\Estate\Models\Property;

class DashboardController extends Controller
{

    public function slides()
    {
        $slides = Property::whereNotNull('slide')->orderBy('slide', 'ASC')->get();

        $availables[''] = '';
        foreach(Property::whereNull('slide')->get() as $property)
        {
            $availables[$property->id] = $property->rif . ' - ' . $property->name;
        }
        return view('estate::estate.slides.index', compact('slides', 'availables'));
    }

    public function slideUpdate(Request $request)
    {

        $property = Property::find($request->id)->update(['slide' => Property::whereNotNull('slide')->max('slide')+1]);
        return back()->with('message', 'Homepage slide aggiornate');
    }

    public function slideDestroy(Request $request)
    {
        $property = Property::find($request->id)->update(['slide' => null]);
        return back()->with('message', 'Homepage slide aggiornate');
    }


}
