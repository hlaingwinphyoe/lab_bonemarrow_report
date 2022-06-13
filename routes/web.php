<?php

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

Route::middleware('auth')->group(function(){
    Route::get('/',[\App\Http\Controllers\PageController::class,'index'])->name('index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/hospital',\App\Http\Controllers\HospitalController::class);
    Route::resource('/aspirate',\App\Http\Controllers\AspirateController::class)->except('show','destroy');
    Route::get('/aspirate-print/{patient_name}',[\App\Http\Controllers\AspirateController::class, 'print'])->name('aspirate.print');
    Route::resource('/aspirate_photos',\App\Http\Controllers\AspiratePhotoController::class);
    Route::resource('/trephine',\App\Http\Controllers\TrephineController::class)->except('show','destroy');
    Route::resource('/trephine_photos',\App\Http\Controllers\TrephinePhotoController::class);
    Route::get('/trephine-print/{patient_name}',[\App\Http\Controllers\TrephineController::class, 'print'])->name('trephine.print');
    Route::resource('/histo',\App\Http\Controllers\HistoController::class)->except('show','destroy');
    Route::resource('/histo_photos',\App\Http\Controllers\HistoPhotoController::class);
    Route::get('/histo-print/{patient_name}',[\App\Http\Controllers\HistoController::class, 'print'])->name('histo.print');
    Route::resource('/cyto',\App\Http\Controllers\CytoController::class)->except('show','destroy');
    Route::resource('/cyto_photos',\App\Http\Controllers\CytoPhotoController::class);
    Route::get('/cyto-print/{patient_name}',[\App\Http\Controllers\CytoController::class, 'print'])->name('cyto.print');

    Route::get('/search',[\App\Http\Controllers\PageController::class,'search']);

    Route::middleware('AdminOnly')->group(function(){
        // Custom User Register
        Route::get('/user-register', [\App\Http\Controllers\PageController::class, 'registration'])->name('register');
        Route::get('/users', [\App\Http\Controllers\PageController::class, 'users'])->name('users');
        Route::post('/user-register', [\App\Http\Controllers\PageController::class, 'postRegistration'])->name('register.post');
        Route::delete('/user-delete/{id}', [\App\Http\Controllers\PageController::class, 'destroy'])->name('user.destroy');
        Route::post('/make-admin', [\App\Http\Controllers\PageController::class, 'makeAdmin'])->name('user.makeAdmin');
    });

    Route::prefix('profile')->group(function(){
        // Main Frame Route
        Route::get('/',[\App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
        Route::post('/change-password',[\App\Http\Controllers\ProfileController::class, 'changePassword'])->name('profile.changePassword');
        Route::post('/change-name',[\App\Http\Controllers\ProfileController::class, 'changeName'])->name('profile.changeName');
        Route::post('/change-email',[\App\Http\Controllers\ProfileController::class, 'changeEmail'])->name('profile.changeEmail');
        Route::post('/change-photo',[\App\Http\Controllers\ProfileController::class, 'changePhoto'])->name('profile.changePhoto');
        Route::post('/signature_thumbnails',[\App\Http\Controllers\ProfileController::class, 'signature'])->name('profile.signature_thumbnails');
    });

});
