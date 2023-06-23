<?php

use Illuminate\Support\Facades\DB;
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
//        'canRegister' => Route::has('register'),
        'canViewDashboard' => Route::has('dashboard')
    ]);
});


Route::group(['middleware'=>['auth', 'verified']], static function() {

    //rendering react components this is just an example
    Route::get('/dashboard', static function () {
        return Inertia::render('Dashboard',[
            'user_count' => DB::selectOne('select count(id) as count from users;')->count,
            'device_count' => DB::selectOne('select count(id) as count from devices;')->count,
            'fault_count' => DB::selectOne('select count(id) as count from faults;')->count,
        ]);
    })->name('dashboard');

    Route::get('/messages', static function () {
        return Inertia::render('Dashboard');
    })->name('messages');

    Route::get('/reports', static function () {
        return Inertia::render('Dashboard');
    })->name('reports');
});
require __DIR__.'/auth.php';
