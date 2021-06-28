<?php

use Illuminate\Support\Facades\Route;
use Areaseb\Estate\Http\Controllers\CalendarController;
use Areaseb\Estate\Http\Controllers\ClientController;
use Areaseb\Estate\Http\Controllers\ContactController;
use Areaseb\Estate\Http\Controllers\CostController;
use Areaseb\Estate\Http\Controllers\DashboardController;
use Areaseb\Estate\Http\Controllers\EditorController;
use Areaseb\Estate\Http\Controllers\EventController;
use Areaseb\Estate\Http\Controllers\ExemptionController;
use Areaseb\Estate\Http\Controllers\ExpenseController;
use Areaseb\Estate\Http\Controllers\ExportController;
use Areaseb\Estate\Http\Controllers\GeneralController;
use Areaseb\Estate\Http\Controllers\ImportController;
use Areaseb\Estate\Http\Controllers\InvoiceController;
use Areaseb\Estate\Http\Controllers\InvoicePaymentController;
use Areaseb\Estate\Http\Controllers\MediaController;
use Areaseb\Estate\Http\Controllers\NewsletterController;
use Areaseb\Estate\Http\Controllers\NewsletterListController;
use Areaseb\Estate\Http\Controllers\NotificationController;
use Areaseb\Estate\Http\Controllers\PagesController;
use Areaseb\Estate\Http\Controllers\PdfController;
use Areaseb\Estate\Http\Controllers\ProductController;
use Areaseb\Estate\Http\Controllers\ReportController;
use Areaseb\Estate\Http\Controllers\RoleController;
use Areaseb\Estate\Http\Controllers\SettingController;
use Areaseb\Estate\Http\Controllers\StatController;
use Areaseb\Estate\Http\Controllers\UserController;
use Areaseb\Estate\Http\Controllers\TemplateController;


Route::get('calendars', [CalendarController::class, 'index'])->name('calendars.index');
Route::post('calendars', [CalendarController::class, 'store'])->name('calendars.store');
Route::get('calendars/bind', [CalendarController::class, 'bind'])->name('calendars.bind');
Route::get('calendars/overlayed', [CalendarController::class, 'overlayed'])->name('calendars.overlayed');
Route::get('calendars/create', [CalendarController::class, 'create'])->name('calendars.create');
Route::get('calendars/{calendar}', [CalendarController::class, 'show'])->name('calendars.show');
Route::patch('calendars/{calendar}', [CalendarController::class, 'update'])->name('calendars.update');
Route::delete('calendars/{calendar}', [CalendarController::class, 'destroy'])->name('calendars.destroy');
Route::get('calendars/{calendar}/edit', [CalendarController::class, 'edit'])->name('calendars.edit');
Route::get('api/calendars/{calendar_id}/events', [EventController::class, 'calendarEvent'])->name('api.calendar.events');

Route::resource('clients', ClientController::class);
Route::post('api/clients/create-contacts', [ClientController::class, 'createContactsFromCompanies'])->name('api.client.createContacts');
Route::get('api/clients/{client}', [ClientController::class, 'checkNation'])->name('api.client.checkNation');
Route::get('api/clients/{client}/discount-exemption', [ClientController::class, 'discountExemption'])->name('api.client.checkNation');
Route::get('api/clients/{client}/payment', [ClientController::class, 'payment'])->name('api.client.payment');
Route::get('api/clients/{client}/notes', [ClientController::class, 'getNote'])->name('api.client.notes');
Route::post('api/clients/{client}/notes/add', [ClientController::class, 'addNote'])->name('api.client.addNotes');
Route::post('api/clients/{client}/check-vies', [ClientController::class, 'checkVies'])->name('api.client.vies');
Route::get('api/ta/clients', [ClientController::class, 'taindex'])->name('api.ta.clients');
Route::get('api/ta/clients/{q}', [ClientController::class, 'taindexQ'])->name('api.ta.clients.q');
Route::post('api/clients', [ClientController::class, 'countIndex'])->name('api.clients.count');

Route::post('contacts/make-company', [ContactController::class, 'makeCompany'])->name('contacts.makeCompany');
Route::post('contacts/make-user', [ContactController::class, 'makeUser'])->name('contacts.makeUser');
Route::post('contacts-validate-file', [ContactController::class, 'validateFile'])->name('csv.contacts.validate');
Route::resource('contacts', ContactController::class);
Route::get('contact-switch-primary/{contact}', [ContactController::class, 'switchPrimary']);
Route::get('api/ta/contacts', [ContactController::class, 'taindex'])->name('api.ta.contacts');

Route::get('costs', [CostController::class, 'index'])->name('costs.index');
Route::resource('costs', CostController::class);
Route::post('api/costs/saldato', [CostController::class, 'toggleSaldato'])->name('api.costs.toggleSaldato');
Route::get('api/ta/costs', [CostController::class, 'taindex'])->name('api.ta.costs');

Route::get('template-builder', [EditorController::class, 'editor']);
Route::get('template-builder/{id}', [EditorController::class, 'editorWithTemplate']);
Route::get('create-template-builder', [EditorController::class, 'createTemplateBuilder'] );
Route::get('edit-template-builder/{id}', [EditorController::class, 'editTemplateBuilder'] );
Route::get('editor/elements/{slug}', [EditorController::class, 'show']);
Route::get('editor/images', [EditorController::class, 'images'])->name('editor.images');
Route::post('editor/upload', [EditorController::class, 'upload'])->name('editor.upload');
Route::post('editor/delete', [EditorController::class, 'delete'])->name('editor.delete');

Route::post('expiring-events', [EventController::class, 'expiring']);
Route::resource('events', EventController::class);
Route::get('api/events', [EventController::class, 'defaultUserEvent'])->name('api.user.defaultEvents');
Route::get('api/events/{user_id}', [EventController::class, 'userEvent'])->name('api.user.events');
Route::post('api/events/{event}/done', [EventController::class, 'markAsDone'])->name('api.events.done');

Route::get('expenses/modify', [ExpenseController::class, 'modifyCategories'])->name('expenses.categories.edit');
Route::resource('expenses', ExpenseController::class);


Route::get('exports/{model}', [ExportController::class, 'export'])->name('csv.export');
Route::post('imports/peek', [ImportController::class, 'peek'])->name('csv.import.peek');
Route::get('imports/{model}', [ImportController::class, 'importForm'])->name('csv.import.form');
Route::post('imports/{model}', [ImportController::class, 'importUpload'])->name('csv.import.upload');

Route::get('payments/{invoice}', [InvoicePaymentController::class, 'show'])->name('invoices.payments.show');
Route::post('payments/{invoice}', [InvoicePaymentController::class, 'store'])->name('invoices.payments.store');
Route::delete('payments/{payment}', [InvoicePaymentController::class, 'destroy'])->name('invoices.payments.delete');

Route::post('notices/{invoice}', [InvoicePaymentController::class, 'storeNotice'])->name('invoices.notices.store');
Route::delete('notices/{notice}', [InvoicePaymentController::class, 'destroyNotice'])->name('invoices.notices.delete');

Route::get('insoluti', [InvoiceController::class, 'insoluti'])->name('invoices.insoluti');
Route::get('invoices/{invoice}/export', [InvoiceController::class, 'export'])->name('invoices.export');
Route::get('invoices/{invoice}/edit-saldo', [InvoiceController::class, 'editSaldoForm'])->name('invoices.editSaldo');
Route::post('invoices/{invoice}/notice', [InvoiceController::class, 'sendNotice'])->name('invoices.sendNotice');
Route::patch('invoices/{invoice}/update-saldo', [InvoiceController::class, 'updateSaldoForm'])->name('invoices.updateSaldo');
Route::resource('invoices', InvoiceController::class);
Route::get('api/invoices/export', [InvoiceController::class, 'exportXmlInZip'])->name('api.invoices.export');
Route::get('api/invoices/import', [InvoiceController::class, 'import'])->name('api.invoices.importForm');
Route::post('api/invoices/import', [InvoiceController::class, 'importProcess'])->name('api.invoices.import');
Route::post('api/invoices/saldato', [InvoiceController::class, 'toggleSaldato'])->name('api.invoices.toggleSaldato');

Route::get('api/invoices/{invoice}/check', [InvoiceController::class, 'checkBeforeFe'])->name('api.invoices.checkBeforeFe');
Route::post('api/invoices/{invoice}/send-fe', [InvoiceController::class, 'sendFe'])->name('api.invoices.sendFe');
Route::post('api/invoices/{invoice}/duplicate', [InvoiceController::class, 'duplicate'])->name('api.invoices.duplicate');
Route::get('api/invoices/{type}', [InvoiceController::class, 'getNumberFromType'])->name('api.invoices.getNumber');
Route::get('api/exemptions/{exemption}', [ExemptionController::class, 'getIva'])->name('api.exemption.getIva');

Route::resource('newsletters', NewsletterController::class);
Route::get('newsletters/{newsletter}/send-test', [NewsletterController::class, 'test'])->name('newsletters.formTest');
Route::post('newsletters/{newsletter}/send-test', [NewsletterController::class, 'sendTest'])->name('newsletters.sendTest');
Route::get('newsletters/{newsletter}/send', [NewsletterController::class, 'send'])->name('newsletters.form');
Route::post('newsletters/{newsletter}/send', [NewsletterController::class, 'sendOfficial'])->name('newsletters.send');

Route::get('newsletters/{newsletter}/reports', [ReportController::class, 'index'])->name('reports.newsletter.index');
Route::get('newsletters/{newsletter}/reports/aperte', [ReportController::class, 'showOpen'])->name('reports.newsletter.opened');
Route::get('newsletters/{newsletter}/reports/errore', [ReportController::class, 'showErrore'])->name('reports.newsletter.failed');
Route::get('newsletters/{newsletter}/reports/unsubscribed', [ReportController::class, 'showUnsubscribed'])->name('reports.newsletter.unsubscribed');
Route::get('newsletters/{newsletter}/reports/clicked', [ReportController::class, 'showClicked'])->name('reports.newsletter.clicked');
Route::get('newsletters/{newsletter}/reports/{report}', [ReportController::class, 'show'])->name('reports.newsletter.show');

Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show');
Route::post('notifications/{notification}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::delete('notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

Route::get('dashboard', [PagesController::class, 'home'])->name('dashboard');

Route::get('lists', [NewsletterListController::class, 'index'])->name('lists.index');
Route::post('lists', [NewsletterListController::class, 'store'])->name('lists.store');
Route::get('lists/create', [NewsletterListController::class, 'create'])->name('lists.create');
Route::get('lists/{list}', [NewsletterListController::class, 'show'])->name('lists.show');
Route::delete('lists/{list}', [NewsletterListController::class, 'destroy'])->name('lists.destroy');
Route::delete('lists/{list}/contact/{contact}', [NewsletterListController::class, 'removeContactFromList'])->name('lists.removeContact');
Route::post('lists/{list}/update', [NewsletterListController::class, 'updateContacts'])->name('lists.updateContacts');
Route::get('create-list', [NewsletterListController::class, 'CreateList'])->name('lists.createForm');
Route::post('create-list', [NewsletterListController::class, 'CreateListPost'])->name('lists.createStore');

Route::post('pdf/send/{id}', [PdfController::class, 'sendInvoiceCortesia'])->name('pdf.send');
Route::get('pdf/{model}/{id}', [PdfController::class, 'generate'])->name('pdf.create');

Route::get('products/{product}/media', [ProductController::class, 'media'])->name('products.media');
Route::resource('products', ProductController::class);
Route::get('api/products/{product}', [ProductController::class, 'apiShow'])->name('api.products.show');
Route::get('api/products/{product}/{locale}', [ProductController::class, 'apiShowLocale'])->name('api.products.show.locale');
Route::get('api/products/{product}/children/{company_id}', [ProductController::class, 'apiShowChildren'])->name('api.products.showChildren');

Route::resource('roles', RoleController::class);

Route::resource('settings', SettingController::class)->only(['index', 'edit', 'update']);

Route::get('stats/aziende', [StatController::class, 'companies'])->name('stats.companies');
Route::get('stats/categorie', [StatController::class, 'categories'])->name('stats.categories');
Route::get('stats/categorie/{id}', [StatController::class, 'category'])->name('stats.category');
Route::get('stats/balance', [StatController::class, 'balance'])->name('stats.balance');
Route::get('stats/export', [StatController::class, 'export'])->name('stats.export');

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::get('users/{id}/permissions', [UserController::class, 'permissions'])->name('user.permissions');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('api/direct-permissions/{user_id}', [UserController::class, 'permissionUpdate'])->name('api.permissions.update');

Route::get('change-password/{user}', [UserController::class, 'editPassword'])->name('users.edit.password');
Route::post('change-password/{user}', [UserController::class, 'updatePassword'])->name('users.update.password');

Route::get('templates/iframe', [TemplateController::class, 'iframe'])->name('templates.iframe');
Route::get('templates/html/{template}', [TemplateController::class, 'html'])->name('templates.html');
Route::post('templates/{template}', [TemplateController::class, 'update'])->name('templates.update');
Route::post('templates/{template}/duplicate', [TemplateController::class, 'duplicate'])->name('templates.duplicate');
Route::resource('templates', TemplateController::class)->except(['create', 'edit', 'update']);

Route::post('api/countries', [GeneralController::class, 'prefix'])->name('api.countries.prefix');
Route::post('api/city', [GeneralController::class, 'zip'])->name('api.city.zip');
Route::post('api/cities/{province}/province', [GeneralController::class, 'citiesOfProvince'])->name('api.city.province');
Route::post('api/clear-cache', [GeneralController::class, 'clearCache'])->name('api.cache.clear');
Route::post('update-field', [GeneralController::class, 'updateField'])->name('global.updateField');

Route::group(['prefix' => 'api/media'], function () {
    Route::post('upload', [MediaController::class, 'add'])->name('media.add');
    Route::post('update', [MediaController::class, 'update'])->name('media.update');
    Route::post('order', [MediaController::class, 'sort'])->name('media.sort');
    Route::post('type', [MediaController::class, 'type'])->name('media.type');
    Route::delete('delete',[MediaController::class, 'delete'])->name('media.delete');
});



//PROPERTIES
use Areaseb\Estate\Http\Controllers\{PropertyController, PropertyHelperController, RequestController, FeatureController};
use Areaseb\Estate\Http\Controllers\{BookingController, OwnershipController, TagController, ViewController};
use Areaseb\Estate\Http\Controllers\{ClientLogController, PoiController, OfferController, SheetController};


Route::get('property-export', [PropertyController::class, 'export']);

Route::get('properties/{property}/media', [PropertyController::class, 'media'])->name('properties.media');
Route::post('properties/{property}/add-owner', [PropertyController::class, 'addOwner'])->name('properties.add.owner');
Route::post('properties/{client}/add-property', [PropertyController::class, 'addProperty'])->name('properties.add.property');
Route::post('properties/{owner_id}/delete-ownership', [PropertyController::class, 'deleteOwner'])->name('properties.delete.owner');
Route::resource('properties', PropertyController::class);
Route::post('api/areas/{city_id}', [PropertyController::class, 'cityArea']);
Route::get('api/ta/properties', [PropertyController::class, 'typeAhead']);
Route::post('api/properties-filter', [PropertyController::class, 'filter']);
Route::get('api/properties-filter/{contact_id}', [PropertyController::class, 'filterClient']);
Route::post('api/properties', [PropertyController::class, 'countIndex'])->name('api.properties.count');

Route::resource('features', FeatureController::class)->except(['create', 'store', 'update', 'edit']);
Route::resource('tags', TagController::class);
Route::post('request-create-contact', [RequestController::class, 'createContact']);
Route::post('request-email-exists', [RequestController::class, 'emailExist']);
Route::resource('requests', RequestController::class);
Route::get('ownerships/{ownership}/media', [OwnershipController::class, 'media'])->name('ownerships.media');
Route::resource('ownerships', OwnershipController::class);
Route::resource('requests', RequestController::class);
Route::resource('offers', OfferController::class);

Route::resource('views', ViewController::class);
Route::get('bookings/{booking}/media', [BookingController::class, 'media'])->name('bookings.media');
Route::resource('bookings', BookingController::class);
Route::resource('clientlogs', ClientLogController::class);
Route::resource('pois', PoiController::class);

Route::post('create-property-field', [PropertyHelperController::class, 'createField']);
Route::post('update-property-field', [PropertyHelperController::class, 'updateField']);

Route::get('slides', [DashboardController::class, 'slides'])->name('slides.index');
Route::post('slides', [DashboardController::class, 'slideUpdate'])->name('slides.store');
Route::post('slides-delete', [DashboardController::class, 'slideDestroy'])->name('slides.destroy');

Route::get('sheets/create', [SheetController::class, 'create'])->name('sheets.create');
Route::post('sheets', [SheetController::class, 'store'])->name('sheets.store');
Route::get('sheets', [SheetController::class, 'index'])->name('sheets.index');
Route::delete('sheets/{sheet}', [SheetController::class, 'destroy'])->name('sheets.destroy');
Route::get('sheets/{sheet}/edit', [SheetController::class, 'edit'])->name('sheets.edit');
Route::put('sheets/{sheet}', [SheetController::class, 'update'])->name('sheets.update');

Route::get('api/sheets/client/{client}/views', [SheetController::class, 'apiViewsIndex']);
Route::post('api/sheets/views', [SheetController::class, 'apiViewsStore']);
