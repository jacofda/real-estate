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
use Areaseb\Estate\Http\Controllers\{GeneralController, PagesController, ReportController};

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OverrideController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;



use App\Http\Controllers\Auth\{LoginController, RegisterController, ForgotPasswordController};


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/account', [HomeController::class, 'account'])->name('home');
Route::get('/account/client', [HomeController::class, 'client'])->name('account.client');
Route::post('/account/client', [HomeController::class, 'clientUpdate'])->name('account.client.update');
Route::get('/account/credentials', [HomeController::class, 'credentials'])->name('account.credentials');
Route::post('/account/credentials', [HomeController::class, 'credentialsUpdate'])->name('account.credentials.update');
Route::get('/account/properties', [HomeController::class, 'properties'])->name('account.properties');
Route::post('/account/properties', [HomeController::class, 'addProperty'])->name('account.properties.store');
Route::get('/account/properties/media/{slug}', [HomeController::class, 'mediaProperty'])->name('account.properties.media');
Route::post('/account/properties/media', [HomeController::class, 'mediaPropertyStore'])->name('account.properties.media.store');

//newsletter tracking
Route::get('tracker', [ReportController::class, 'tracker']);
Route::get('unsubscribe', [ReportController::class, 'unsubscribe']);
Route::get('track', [ReportController::class, 'track']);

Route::get('register-lead', [ReportController::class, 'registerLead']);


use Areaseb\Estate\Models\{Property, Tag};

Route::get('make-images', function(){

    foreach(Property::whereBetween('id', [161,183])->get() as $property)
    {
        // $property = Property::slug('cortina-dampezzo-appartamento-cortina-dampezzo-via-del-castello')->first();
        foreach($property->media()->img()->get() as $img)
        {
            // dd($property->slug_it);
            $image = \Image::make( storage_path('app/public/properties/original/'.$img->filename) );
            $image->fit(770, 513);
            $image->save( storage_path('app/public/properties/page/').$img->filename );
        }
    }

    return 'done';

});

use App\Mediatypes\MediaPropertyFixer;

Route::get('water-images', function(){


    $helper = new MediaPropertyFixer;

    foreach(Property::whereBetween('id', [171,184])->get() as $property)
    {
        // $property = Property::slug('cortina-dampezzo-appartamento-cortina-dampezzo-via-del-castello')->first();
        foreach($property->media()->img()->get() as $img)
        {
            // dd($property->slug_it);
            $image = \Image::make( storage_path('app/public/properties/original/'.$img->filename) );
            $helper->resizeAndSaveImage($image, $img->filename, 'properties');
        }
    }

    return 'done';

});



Route::get('test', function(){

    $commons = [];
    foreach(Tag::all() as $tag)
    {
        $commons[$tag->id] = intval($tag->properties()->sum('views'));
    }
    arsort($commons);
    dd($commons);

});

Route::post('switch-locale', [PageController::class, 'switchLocale'])->name('global.switchLocale');

Route::get('/', [WebsiteController::class, 'welcome'])->name('welcome');

Route::get('immobili', [PropertyController::class, 'index'])->name('it.immobili');
Route::get('realty', [PropertyController::class, 'index'])->name('en.immobili');
Route::get('vendita', [PropertyController::class, 'vendita'])->name('it.vendita');
Route::get('sale', [PropertyController::class, 'vendita'])->name('en.vendita');
Route::get('immobile/{slug}', [PropertyController::class, 'show'])->name('it.immobile.show');
Route::get('property/{slug}', [PropertyController::class, 'show'])->name('en.immobile.show');
Route::get('affitto', [PropertyController::class, 'affitto'])->name('it.affitto');
Route::get('rent', [PropertyController::class, 'affitto'])->name('en.affitto');

Route::get('grid', [PropertyController::class, 'grid'])->name('grid');

Route::get('contatti', [PageController::class, 'contatti'])->name('it.contatti');
Route::get('contact', [PageController::class, 'contatti'])->name('en.contatti');
Route::post('contact', [PageController::class, 'contattiSend'])->name('contatti.send');
Route::get('privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('mappa-del-sito', [PageController::class, 'sitemap'])->name('it.sitemap');
Route::get('sitemap', [PageController::class, 'sitemap'])->name('en.sitemap');
Route::get('termini-e-condizioni', [PageController::class, 'terms'])->name('it.terms');
Route::get('terms-and-conditions', [PageController::class, 'terms'])->name('en.terms');

// Auth::routes();
//
// Route::get('/home', 'HomeController@index')->name('home');
