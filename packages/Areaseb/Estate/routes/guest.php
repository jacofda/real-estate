<?php

use Areaseb\Estate\Http\Controllers\PrivacyController;
use Areaseb\Estate\Http\Controllers\SheetController;
use Illuminate\Support\Facades\Route;

Route::get('sheets/{uuid}/sign', [SheetController::class, 'showSignForm'])->name('sheets.sign');
Route::post('sheets/{uuid}/sign', [SheetController::class, 'sign']);
Route::get('sheets/{uuid}/preview', [SheetController::class, 'preview'])->name('sheets.preview');
Route::get('sheets/{uuid}/download', [SheetController::class, 'download'])->name('sheets.download');

Route::get('privacy/{uuid}/sign', [PrivacyController::class, 'showSignForm'])->name('privacy.sign');
Route::post('privacy/{uuid}/sign', [PrivacyController::class, 'sign']);
Route::get('privacy/{uuid}/preview', [PrivacyController::class, 'preview'])->name('privacy.preview');
Route::get('privacy/{uuid}/download', [PrivacyController::class, 'download'])->name('privacy.download');
