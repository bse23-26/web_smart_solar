<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FaultController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {return $request->user();});
    Route::post('/logout', [AuthenticatedSessionController::class, 'apiDestroy'])->name('api.logout');
    Route::post('/fault', [FaultController::class, 'store'])->name('faults.store');
    Route::post('/device_token', [NotificationController::class, 'store'])->name('token.store');
    Route::get('/notify', [NotificationController::class, 'send'])->name('notify.send');
});

Route::post('login', [AuthenticatedSessionController::class, 'apiStore'])->name('api.login');
Route::post('register', [RegisteredUserController::class, 'apiStore'])->name('api.register');


