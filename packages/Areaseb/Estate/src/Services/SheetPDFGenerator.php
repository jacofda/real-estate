<?php

namespace Areaseb\Estate\Services;

use Areaseb\Estate\Models\Sheet;
use Illuminate\Support\Facades\Storage;
use \PDF;

class SheetPDFGenerator
{
    public function preview(Sheet $sheet)
    {
        return $this->composePDF($sheet, false);
    }

    public function generate(Sheet $sheet, $sign)
    {
        return $this->composePDF($sheet, $sign);
    }

    protected function composePDF(Sheet $sheet, $sign = false)
    {
        $path = "sheets/pdf/{$sheet->id}";

        $header = view('estate::pdf.sheets.header')->render();
        $footer = view('estate::pdf.sheets.footer')->render();

        Storage::put("public/{$path}/header.html", $header);
        Storage::put("public/{$path}/footer.html", $footer);

        $headerUrl = asset("storage/{$path}/header.html");
        $footerUrl = asset("storage/{$path}/footer.html");

        $pdf = PDF::loadView('estate::pdf.sheets.sheet', [
                'sheet' => $sheet,
                'sign' => $sign
            ])
            ->setPaper('a4')
            ->setOption('enable-local-file-access', true)
            ->setOption('header-spacing', 10)
            ->setOption('header-html', $headerUrl)
            ->setOption('footer-html', $footerUrl)
            ->setOption('encoding', 'UTF-8');
            ;

        return $pdf;
    }
}
