<?php

use Areaseb\Estate\Http\Controllers\SheetController;
use Illuminate\Support\Facades\Route;

Route::get('sheets/sign/{uuid}', [SheetController::class, 'sign'])->name('sheets.sign');
Route::post('sheets/sign/{uuid}', [SheetController::class, 'processSign'])->name('sheets.sign.process');
Route::get('sheets/sign/{uuid}/preview', [SheetController::class, 'preview'])->name('sheets.sign.preview');
Route::get('sheets/sign/{uuid}/download', [SheetController::class, 'downloadSigned'])->name('sheets.sign.download');
