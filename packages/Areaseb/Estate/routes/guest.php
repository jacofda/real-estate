<?php

use Areaseb\Estate\Http\Controllers\SheetController;
use Illuminate\Support\Facades\Route;

Route::get('sheets/{uuid}/sign', [SheetController::class, 'showSignForm'])->name('sheets.sign');
Route::post('sheets/{uuid}/sign', [SheetController::class, 'sign']);
Route::get('sheets/{uuid}/preview', [SheetController::class, 'preview'])->name('sheets.preview');
Route::get('sheets/{uuid}/download', [SheetController::class, 'download'])->name('sheets.download');
