<?php

namespace Areaseb\Estate\Http\Controllers;

use Areaseb\Estate\Models\{Calendar, Company, Contact, Event};
use App\User;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('super'))
        {
            $calendars = Calendar::all();
        }
        else
        {
            $calendars = auth()->user()->calendars;
        }

        return view('estate::core.calendars.index', compact('calendars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estate::core.calendars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Calendar::create(['user_id' => auth()->user()->id, 'nome' => $request->nome, 'privato' => $request->privato]);
        return redirect('calendars')->with('message', 'Calendario Creato');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar)
    {
        $contacts = Contact::all()->pluck('fullname' ,'id')->toArray();
        $companies = Company::pluck('rag_soc', 'id')->toArray();
        $users = User::with('contact')->get()->pluck('contact.fullname', 'id')->toArray();
        return view('estate::core.calendars.show', compact('users', 'companies', 'contacts', 'calendar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        return view('estate::core.calendars.edit', compact('calendar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar $calendar)
    {
        $calendar->nome = $request->nome;
        $calendar->privato = $request->privato;
        $calendar->save();
        return redirect('calendars')->with('message', 'Calendario Aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return redirect('calendars')->with('message', 'Calendario Aggiornato');
    }

//calendars/overlayed
    public function overlayed()
    {
        if(request()->input())
        {
            $ids = request('ids');
            $arrIds = explode('-', $ids);

            if(count($arrIds) > 1)
            {
                $contacts= Contact::all()->pluck('fullname' ,'id')->toArray();
                $companies = Company::pluck('rag_soc', 'id')->toArray();
                $users = User::with('contact')->get()->pluck('contact.fullname', 'id')->toArray();
                $calendar_ids = request('ids');
                $calendarIdName = Calendar::whereIn('id', $arrIds)->pluck('nome', 'id')->toArray();
                return view('estate::core.calendars.overlayed', compact('users', 'companies', 'contacts', 'calendar_ids', 'calendarIdName'));
            }
            else
            {
                return redirect('calendars/'.$arrIds[0]);
            }
        }

        return redirect('calendars/'.auth()->user()->default_calendar->id)->with('message', 'Il tuo calendario di default');
    }

//calendars/bind - GET
    public function bind()
    {
        if(auth()->user()->hasRole('super'))
        {
            $calendars = Calendar::all();
        }
        else
        {
            $calendars = auth()->user()->calendars;
        }
        return view('estate::core.calendars.bind', compact('calendars'));
    }


}
