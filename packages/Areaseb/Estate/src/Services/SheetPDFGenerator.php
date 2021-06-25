<?php

namespace Areaseb\Estate\Services;

use Areaseb\Estate\Models\Sheet;
use \PDF;

class SheetPDFGenerator
{
    public function preview(Sheet $sheet)
    {
        return PDF::loadView('estate::pdf.sheets.sheet', [
            'sheet' => $sheet,
            'preview' => true
        ]);
    }

    public function generate(Sheet $sheet, $sign)
    {
        return PDF::loadView('estate::pdf.sheets.sheet', [
            'sheet' => $sheet,
            'sign' => $sign
        ]);
    }
}
