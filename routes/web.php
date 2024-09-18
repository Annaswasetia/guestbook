<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

//middleware untuk membatasi user
Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin', //admin/tamu
    'as' => 'admin.', // routea(admin.)
], function () {

    //guestbook.test/admin/
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index'); 
    
    //guestbook.test/admin/dashboard -> route(admin.dashboard)
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    //guestbook.test/admin/institution(ROUTING CRUD)
    Route::resource('/institution', App\Http\Controllers\InstitutionController::class);

    //guestbook.test/admin/guests(ROUTING CRUD)
    Route::resource('/guests', App\Http\Controllers\GuestController::class)->only(['index', 'show', 'destroy']);
});
