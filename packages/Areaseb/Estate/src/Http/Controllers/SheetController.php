<?php

namespace Areaseb\Estate\Http\Controllers;

use Areaseb\Estate\Events\SheetCreated;
use Areaseb\Estate\Http\Requests\StoreSheetRequest;
use Areaseb\Estate\Models\Client;
use Areaseb\Estate\Models\Property;
use Areaseb\Estate\Models\Sheet;
use Areaseb\Estate\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SheetController extends Controller
{
    public function index()
    {
        $sheets = Sheet::with('client', 'property')->latest()->get();
        return view('estate::estate.sheets.index', [
            'sheets' => $sheets
        ]);
    }

    public function create(Request $request)
    {
        // Let's retrieve the client if sent
        $client = Client::find($request->input('client_id'));

        $clients = ['' => '', 'new' => 'Nuovo Contatto'] + Client::pluck('rag_soc' ,'id')->toArray();
        $properties = ['' => ''] + Property::pluck('name_it', 'id')->toArray();

        return view('estate::estate.sheets.create', [
            'clients' => $clients,
            'properties' => $properties,
            'views' => $this->getViewsByClient($client)
        ]);
    }

    public function store(StoreSheetRequest $request)
    {
        // Let's store a new sheet
        $sheet = $this->createNewSheet($request);
        event(new SheetCreated($sheet));
    }

    public function destroy(Sheet $sheet)
    {
        //
    }

    public function download(Sheet $sheet)
    {
        //
    }

    public function edit(Sheet $sheet)
    {
        //
    }

    public function update(Sheet $sheet)
    {
        //
    }

    /**
     * Create options for views
     */
    protected function getViewsByClient(Client $client = null)
    {
        $views = $client
            ? View::where('client_id', $client->id)->get()
            : collect([]);

        $views = $views->map(function ($view) {
            return [
                'id' => $view->id,
                'name' => $view->property->name_it . ' - ' . $view->created_at->format('d/m/Y'),
            ];
        });

        return ['' => '', 'new' => 'Nuova visita'] + $views->pluck('name', 'id')->toArray();
    }

    /**
     * Create a new sheet
     */
    protected function createNewSheet(Request $request)
    {
        $sheet = new Sheet();

        // Let's prepare the data for the model
        $data = Arr::only($request->all(), $sheet->getFillable());
        $views = collect($request->input('view'))->map(function ($viewId) {
            return View::find($viewId);
        });

        $sheet->fill($data)->save();
        $sheet->views()->saveMany($views);
        $sheet->save();

        return $sheet;
    }
}
