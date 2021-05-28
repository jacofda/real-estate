<?php

namespace App\Estate\Exports;

use Areaseb\Estate\Models\Property;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PropertyExport implements FromView
{

    public function view(): View
    {
        return view('exports.properties', [
            'properties' => Property::with('contract', 'tag', 'city', 'feats', 'type')->get()
        ]);
    }
}
