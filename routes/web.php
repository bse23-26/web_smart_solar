<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', static function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'canViewDashboard' => Route::has('dashboard')
    ]);
});


Route::group(['middleware'=>['auth', 'verified']], static function() {

    //rendering react components this is just an example
    Route::get('/dashboard', static function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
require __DIR__.'/auth.php';
