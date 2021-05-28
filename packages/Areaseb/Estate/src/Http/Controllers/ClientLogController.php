<?php

namespace Areaseb\Estate\Http\Controllers;

use Illuminate\Http\Request;
use Areaseb\Estate\Models\{City, Client, ClientLog, Contact, Country, Exemption, Property, Sector};
use App\User;
use \Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;

class ClientLogController extends Controller
{

    public function create()
    {
        return view();
    }

    public function store(Request $request)
    {
        ClientLog::create($request->except('_method'));
        return back()->with('message', 'Log Aggiunto');
    }

    public function edit(ClientLog $clientLog)
    {

    }

    public function update(Request $request, ClientLog $clientLog)
    {

    }



}
