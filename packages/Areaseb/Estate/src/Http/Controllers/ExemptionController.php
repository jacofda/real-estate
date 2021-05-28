<?php

namespace Areaseb\Estate\Http\Controllers;

use Areaseb\Estate\Models\Exemption;

class ExemptionController extends Controller
{
    public function getIva(Exemption $exemption)
    {
        return $exemption->perc;
    }
}
