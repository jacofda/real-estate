<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Areaseb\Estate\Http\Middleware\SaveTracking;
use Areaseb\Estate\Http\Controllers\{LoginController, PagesController, ReportController};
use App\Http\Controllers\OverrideController;
use App\Http\Controllers\WebsiteController;

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'loginPost'])->name('loginPost');

//newsletter tracking
Route::get('tracker', [ReportController::class, 'tracker']);
Route::get('unsubscribe', [ReportController::class, 'unsubscribe']);
Route::get('track', [ReportController::class, 'track']);

Route::get('register-lead', [ReportController::class, 'registerLead']);


use Areaseb\Estate\Models\Property;

Route::get('make-slugs', function(){

    foreach(Property::all() as $property)
    {
        Property::makeSlug($property);
    }

    return 'done';

});


Route::get('/', [WebsiteController::class, 'welcome'])->name('welcome');
Route::get('vendita', [WebsiteController::class, 'vendita'])->name('vendita');
Route::get('vendita/{slug}', [WebsiteController::class, 'vendita'])->name('vendita.show');
