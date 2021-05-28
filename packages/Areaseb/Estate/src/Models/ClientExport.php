<?php

namespace Areaseb\Estate\Models;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClientExport implements FromView
{

    public $clients;

    public function __construct($clients)
    {
        $this->clients = $clients;
    }

    public function view(): View
    {
        return view('areaseb::csv.clients', [
            'clients' => $this->clients
        ]);
    }
}
