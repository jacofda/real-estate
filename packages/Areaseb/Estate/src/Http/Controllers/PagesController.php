<?php

namespace Areaseb\Estate\Http\Controllers;

use Illuminate\Http\Request;
//use App\User;
use Areaseb\Estate\Models\{Calendar, Client, ClientType, Contact, Event, Report, Setting};


class PagesController extends Controller
{

    public function home()
    {
        $aziendeLables = '';$aziendeData = '';
        foreach(ClientType::all() as $type)
        {
            $aziendeLables .= '"'.$type->name.'",';
            $aziendeData .= $type->clients()->count().',';
        }
        $aziende = (object) [
            'labels' => substr($aziendeLables, 0, -1),
            'data' => substr($aziendeData, 0, -1),
            'total' => Client::count()
        ];

        $contattiLables = '';$contattiData = '';
        foreach(ClientType::all() as $type)
        {
            $contattiLables .= '"'.$type->name.'",';
            $contattiData .= rand(1,400).',';
        }
        $contatti = (object) [
            'labels' => substr($contattiLables, 0, -1),
            'data' => substr($contattiData, 0, -1),
            'total' => Contact::count()
        ];

        $view = Setting::dashboard();

        return view('estate::welcome', compact('aziende', 'contatti', 'view'));
    }


    public function showCalendar()
    {
        $contacts= Contact::all()->pluck('fullname' ,'id')->toArray();
        $companies[''] = '';
        $companies += Company::pluck('rag_soc', 'id')->toArray();
        $users = User::with('contact')->get()->pluck('contact.fullname', 'id')->toArray();
        $userEvents = Event::where('user_id', auth()->user()->id)->select('title', 'starts_at as start', 'ends_at as end' ,'allday', 'backgroundColor', 'backgroundColor as borderColor')->get();

        return view('estate::core.calendars.show', compact('users', 'companies', 'contacts', 'userEvents'));
    }


//logout - POST
    public function logout()
    {
        \Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect(route('login'));
    }



}
