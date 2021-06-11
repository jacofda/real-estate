<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Areaseb\Estate\Models\Property;

class PageController extends Controller
{

    public function switchLocale(Request $request)
    {
        session()->put('locale', $request->locale);

        $route = $request->route;

        if(strpos($request->route, 'it.') !== false)
        {
            $route = str_replace('it.', 'en.', $request->route);
        }

        if(strpos($request->route, 'en.') !== false)
        {
            $route = str_replace('en.', 'it.', $request->route);
        }

        if(strpos($request->route, 'show') !== false)
        {
            $property = Property::where('slug_it', $request->slug)->first();
            if(is_null($property))
            {
                $property = Property::where('slug_en', $request->slug)->first();
            }
            return redirect(route($request->locale.'.immobile.show', $request->slug));
        }

        return redirect(route($route));
    }

    public function contatti()
    {
        return view('pages.contact');
    }

    public function contattiSend()
    {

        if(!request('privacy'))
        {
            return back()->with('error', trans('Accettazione privacy obbligatoria'));
        }

        $this->validate(request(), [
            'privacy' => 'required|acceptance'
        ]);

        dd(request()->input());

        return back()->with('closing-message', 'Sent');
    }


    public function privacy()
    {
        return view('pages.privacy');
    }

    public function sitemap()
    {
        return view('pages.sitemap');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function agency()
    {
        return view('pages.agency');
    }

    public function subscribe()
    {
        return view('pages.subscribe');
    }


}
