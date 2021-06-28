<?php

namespace Areaseb\Estate\Http\Controllers;

use Areaseb\Estate\Events\SheetCreated;
use Areaseb\Estate\Http\Requests\SignSheetRequest;
use Areaseb\Estate\Http\Requests\StoreSheetRequest;
use Areaseb\Estate\Models\Client;
use Areaseb\Estate\Models\Property;
use Areaseb\Estate\Models\Sheet;
use Areaseb\Estate\Models\View;
use Areaseb\Estate\Services\SheetPDFGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Knp\Snappy\Pdf;

class SheetController extends Controller
{
    /**
     * @var SheetPDFGenerator
     */
    protected $sheetPdfGenerator;

    public function __construct(SheetPDFGenerator $sheetPdfGenerator)
    {
        $this->sheetPdfGenerator = $sheetPdfGenerator;
    }

    public function index()
    {
        $sheets = Sheet::with('client')->latest()->get();
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
        return redirect()->route('sheets.index');
    }

    public function destroy(Sheet $sheet)
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

    public function showSignForm($uuid)
    {
        $sheet = Sheet::uuid($uuid)->notSigned()->first();
        if (!$sheet) {
            return abort(404);
        }

        return view('estate::estate.sheets.sign', [
            'sheet' => $sheet
        ]);
    }

    public function sign(SignSheetRequest $request, $uuid)
    {
        $sheet = Sheet::uuid($uuid)/*->notSigned()*/->first();
        if (!$sheet) {
            return abort(404);
        }

        $sign = $request->input('sign');

        // Generate and save the sheet
        $pdf = $this->sheetPdfGenerator->generate($sheet, $sign)->output();
        Storage::disk('sheets')->put($sheet->uuid . '.pdf', $pdf);

        // The sheet is signed
        $sheet->signed = true;
        $sheet->save();

        return view('estate::estate.sheets.thanks', [
            'sheet' => $sheet
        ]);
    }

    public function preview($uuid)
    {
        $sheet = Sheet::uuid($uuid)->notSigned()->first();
        if (!$sheet) {
            return abort(404);
        }

        return $this->sheetPdfGenerator->preview($sheet)->inline('preview.pdf');
    }

    public function download($uuid)
    {
        $sheet = Sheet::uuid($uuid)->signed()->first();
        if (!$sheet) {
            return abort(404);
        }

        $response = Storage::disk('sheets')->response($sheet->uuid . '.pdf');
        $response->headers->set('Content-Disposition', 'filename="sheet.pdf"');
        return $response;
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
