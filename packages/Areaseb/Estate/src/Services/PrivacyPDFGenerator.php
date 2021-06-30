<?php

namespace Areaseb\Estate\Services;

use Areaseb\Estate\Models\Client;
use Areaseb\Estate\Models\Privacy;
use Illuminate\Support\Facades\Storage;
use \PDF;

class PrivacyPDFGenerator
{
    public function preview(Privacy $privacy)
    {
        return $this->composePDF($privacy, false);
    }

    public function generate(Privacy $privacy, $sign)
    {
        return $this->composePDF($privacy, $sign);
    }

    protected function composePDF(Privacy $privacy, $sign = false)
    {
        $path = "privacy/pdf/{$privacy->id}";

        $header = view('estate::pdf.privacy.header')->render();
        $footer = view('estate::pdf.privacy.footer')->render();

        Storage::put("public/{$path}/header.html", $header);
        Storage::put("public/{$path}/footer.html", $footer);

        $headerUrl = asset("storage/{$path}/header.html");
        $footerUrl = asset("storage/{$path}/footer.html");

        $pdf = PDF::loadView('estate::pdf.privacy.privacy', [
                'privacy' => $privacy,
                'sign' => $sign
            ])
            ->setPaper('a4')
            ->setOption('enable-local-file-access', true)
            ->setOption('header-spacing', 10)
            ->setOption('header-html', $headerUrl)
            ->setOption('footer-html', $footerUrl)
            ->setOption('encoding', 'UTF-8');

        return $pdf;
    }
}
