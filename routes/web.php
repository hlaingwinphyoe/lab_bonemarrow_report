<?php

use App\Http\Controllers\AspirateController;
use App\Http\Controllers\AspiratePhotoController;
use App\Http\Controllers\CytoController;
use App\Http\Controllers\CytoPhotoController;
use App\Http\Controllers\HistoController;
use App\Http\Controllers\HistoPhotoController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrephineController;
use App\Http\Controllers\TrephinePhotoController;
use App\Http\Controllers\SpecimenTypeController;
use App\Http\Controllers\HistoGrossController;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

// public access
Route::get('/aspirate-print/{id}',[AspirateController::class, 'print'])->name('aspirate.print');
Route::get('/aspirate-print/without-header/{id}',[AspirateController::class, 'withoutHeaderPrint'])->name('aspirate.without.print');

Route::get('/trephine-print/{id}',[TrephineController::class, 'print'])->name('trephine.print');
Route::get('/trephine-print/without-header/{id}',[TrephineController::class, 'withoutHeaderPrint'])->name('trephine.without.print');

Route::get('/histo-print/{id}',[HistoController::class, 'print'])->name('histo.print');
Route::get('/histo-print/without-header/{id}',[HistoController::class, 'withoutHeaderPrint'])->name('histo.without.print');

Route::get('/cyto-print/{id}',[CytoController::class, 'print'])->name('cyto.print');
Route::get('/cyto-print/without-header/{id}',[CytoController::class, 'withoutHeaderPrint'])->name('cyto.without.print');


// only auth user access
Route::middleware('auth')->group(function(){
    Route::get('/',[PageController::class,'index'])->name('index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/hospital',HospitalController::class)->except('show');
    Route::resource('/specimen_type',SpecimenTypeController::class)->except('show');

    // aspirate
    Route::resource('/aspirate',AspirateController::class)->except('show');
    Route::get('/aspirate-invoice/{id}',[AspirateController::class, 'invoice'])->name('aspirate.invoice');
    Route::resource('/aspirate_photos',AspiratePhotoController::class);
    Route::get('aspirate/export', [AspirateController::class, 'export'])->name('aspirate.export');

    // trephine
    Route::resource('/trephine',TrephineController::class)->except('show');
    Route::get('/trephine-invoice/{id}',[TrephineController::class, 'invoice'])->name('trephine.invoice');
    Route::resource('/trephine_photos',TrephinePhotoController::class);
    Route::get('trephine/export', [TrephineController::class, 'export'])->name('trephine.export');

    // histo
    Route::resource('/histo',HistoController::class)->except('show');
    Route::get('/histo-invoice/{id}',[HistoController::class, 'invoice'])->name('histo.invoice');
    Route::resource('/histo_photos',HistoPhotoController::class);
    Route::resource('/histo_gross',HistoGrossController::class);
    Route::get('histo/export', [HistoController::class, 'export'])->name('histo.export');

    // cyto
    Route::resource('/cyto',CytoController::class)->except('show');
    Route::get('/cyto-invoice/{id}',[CytoController::class, 'invoice'])->name('cyto.invoice');
    Route::resource('/cyto_photos',CytoPhotoController::class);
    Route::get('cyto/export', [CytoController::class, 'export'])->name('cyto.export');

    Route::get('/search',[PageController::class,'search']);
    Route::get('/reports/sales',[PageController::class,'totalSales'])->name('report.sale');

    Route::middleware('AdminOnly')->group(function(){
        // Custom User Register
        Route::get('/users', [PageController::class, 'users'])->name('users');
        Route::post('/user-register', [PageController::class, 'postRegistration'])->name('register.post');
        Route::delete('/user-delete/{id}', [PageController::class, 'destroy'])->name('user.destroy');
        Route::post('/make-admin', [PageController::class, 'makeAdmin'])->name('user.makeAdmin');
    });

    Route::prefix('profile')->group(function(){
        // Main Frame Route
        Route::get('/',[ProfileController::class, 'profile'])->name('profile');
        Route::post('/change-password',[ProfileController::class, 'changePassword'])->name('profile.changePassword');
        Route::post('/change-name',[ProfileController::class, 'changeName'])->name('profile.changeName');
        Route::post('/change-email',[ProfileController::class, 'changeEmail'])->name('profile.changeEmail');
        Route::post('/change-photo',[ProfileController::class, 'changePhoto'])->name('profile.changePhoto');
        Route::post('/signature_thumbnails',[ProfileController::class, 'signature'])->name('profile.signature_thumbnails');
    });

    // 404 page
    Route::get('/denied',[PageController::class,'denied'])->name('denied');

});
