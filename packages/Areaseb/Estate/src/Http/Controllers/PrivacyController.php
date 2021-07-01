<?php

namespace Areaseb\Estate\Http\Controllers;

use Areaseb\Estate\Events\PrivacyCreated;
use Areaseb\Estate\Http\Requests\SignPrivacyRequest;
use Areaseb\Estate\Http\Requests\StorePrivacyRequest;
use Areaseb\Estate\Models\Client;
use Areaseb\Estate\Models\Privacy;
use Areaseb\Estate\Services\PrivacyPDFGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class PrivacyController extends Controller
{
    /**
     * @var PrivacyPDFGenerator
     */
    protected $privacyPDFGenerator;

    public function __construct(PrivacyPDFGenerator $privacyPDFGenerator)
    {
        $this->privacyPDFGenerator = $privacyPDFGenerator;
    }

    public function index()
    {
        $privacy = Privacy::with('client')->latest()->get();
        return view('estate::estate.privacy.index', [
            'privacy' => $privacy
        ]);
    }

    public function create()
    {
        $clients = ['' => '', 'new' => 'Nuovo Contatto'] + Client::pluck('rag_soc' ,'id')->toArray();

        return view('estate::estate.privacy.create', [
            'clients' => $clients,
        ]);
    }

    public function store(StorePrivacyRequest $request)
    {
        // Let's store a new sheet
        $privacy = $this->createNewPrivacy($request);
        event(new PrivacyCreated($privacy));
        return redirect()->route('privacy.index');
    }

    public function destroy(Privacy $privacy)
    {
        $privacy->delete();
        return 'done';
    }

    public function showSignForm($uuid)
    {
        $privacy = Privacy::uuid($uuid)->notSigned()->first();
        if (!$privacy) {
            return abort(404);
        }

        return view('estate::estate.privacy.sign', [
            'privacy' => $privacy
        ]);
    }

    public function sign(SignPrivacyRequest $request, $uuid)
    {
        $privacy = Privacy::uuid($uuid)->notSigned()->first();
        if (!$privacy) {
            return abort(404);
        }

        $sign = $request->input('sign');

        // Generate and save the sheet
        $pdf = $this->privacyPDFGenerator->generate($privacy, $sign)->output();
        Storage::disk('privacy')->put($privacy->uuid . '.pdf', $pdf);

        // The sheet is signed
        $privacy->signed = true;
        $privacy->save();

        return view('estate::estate.privacy.thanks', [
            'privacy' => $privacy
        ]);
    }

    public function preview($uuid)
    {
        $privacy = Privacy::uuid($uuid)->notSigned()->first();
        if (!$privacy) {
            return abort(404);
        }

        return $this->privacyPDFGenerator->preview($privacy)->inline('preview.pdf');
    }

    public function download($uuid)
    {
        $privacy = Privacy::uuid($uuid)->signed()->first();
        if (!$privacy) {
            return abort(404);
        }

        $response = Storage::disk('privacy')->response($privacy->uuid . '.pdf');
        $response->headers->set('Content-Disposition', 'filename="sheet.pdf"');
        return $response;
    }

    /**
     * Create a new sheet
     */
    protected function createNewPrivacy(Request $request)
    {
        $privacy = new Privacy();

        // Let's prepare the data for the model
        // and then fill the model
        $data = Arr::only($request->all(), $privacy->getFillable());
        $privacy->fill($data)->save();
        $privacy->save();

        return $privacy;
    }
}
