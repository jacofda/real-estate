<?php

namespace Areaseb\Estate\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Areaseb\Estate\Models\{Booking, Property};
use Areaseb\Estate\Models\{City, Contact, Event, Calendar, Media};
use \Carbon\Carbon;



class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::all();
        return view('estate::estate.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $clients = [''=>'']+Client::pluck('rag_soc' ,'id')->toArray();
        $properties = [''=>'']+Property::pluck('name_it', 'id')->toArray();
        return view('estate::estate.bookings.create', compact('properties', 'clients'));
    }


    public function show(Booking $booking)
    {
        $property = $booking->property;
        $contact = $booking->contact;
        $owner = $property->ownership;
        return view('estate::estate.bookings.show', compact('booking', 'property', 'contact', 'owner'));
    }


    public function store(Request $request)
    {
        $this->validate(request(),[
            'client_id' => 'required',
            'property_id' => 'required',
        ]);

        $property = Property::find($request->property_id);
        $client = Client::find($request->client_id);

        if(is_null($property->calendar_id))
        {
            $calendar = Calendar::create([
                'user_id' => 1,
                'nome' => 'Imm Rif.'. $property->rif,
                'privato' => 0
            ]);
            $property->update(['calendar_id' => $calendar->id]);
        }

        $from = Carbon::createFromFormat('d/m/Y H:i:s', $request->from_date . ' 08:00:00');
        $to = Carbon::createFromFormat('d/m/Y H:i:s', $request->to_date . ' 23:59:59');

        $booking = new Booking;
            $booking->from_date = $from;
            $booking->to_date = $to;
            $booking->client_id = $request->client_id;
            $booking->property_id = $request->property_id;
            $booking->note = $request->note;
            $booking->rent_period = $request->rent_period;
            $booking->amount = $request->amount;
        $booking->save();

        $event = new Event;
            $event->starts_at = $from->format('Y-m-d H:i:s');
            $event->ends_at = $to->format('Y-m-d H:i:s');
            $event->summary = $request->note;
            $event->title = $contact->fullname;
            $event->location = null;
            $event->allday = true;
            $event->backgroundColor = '#28a745';
            $event->user_id = auth()->user()->id;
            $event->calendar_id = $property->calendar_id;
            $event->eventable_id = $booking->id;
            $event->eventable_type = get_class($booking);
        $event->save();

        return redirect(route('bookings.index'))->with('message', 'Booking aggiunto');
    }

    public function edit(Booking $booking)
    {
        $clients = [''=>'']+Client::pluck('rag_soc' ,'id')->toArray();
        $properties = [''=>'']+Property::pluck('name_it', 'id')->toArray();
        return view('estate::estate.bookings.edit', compact('properties', 'clients', 'booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $this->validate(request(),[
            'client_id' => 'required',
            'property_id' => 'required',
        ]);
        $property = Property::find($request->property_id);
        $from = Carbon::createFromFormat('d/m/Y H:i:s', $request->from_date . ' 08:00:00');
        $to = Carbon::createFromFormat('d/m/Y H:i:s', $request->to_date . ' 23:59:59');

        $event = $booking->events()->where('title', $booking->client->fullname)->first();
        if(is_null($event))
        {
            $event = $booking->events()->latest()->first();
        }

            $booking->from_date = $from;
            $booking->to_date = $to;
            $booking->client_id = $request->client_id;
            $booking->property_id = $request->property_id;
            $booking->note = $request->note;
            $booking->rent_period = $request->rent_period;
            $booking->amount = $request->amount;
        $booking->save();


            $event->starts_at = $from->format('Y-m-d H:i:s');
            $event->ends_at = $to->format('Y-m-d H:i:s');
            $event->summary = $request->note;
        $event->save();

        return redirect(route('bookings.index'))->with('message', 'Booking aggiornato');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return 'done';
    }

    public function media(Booking $booking)
    {
        $model = $booking;
        return view('estate::estate.bookings.media', compact('model'));
    }



}
