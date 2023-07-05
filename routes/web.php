<?php

use App\Http\Controllers\NotificationController;
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

    Route::get('/dashboard', static function () {
        return Inertia::render('Dashboard',[
            'user_count' => DB::selectOne('select count(id) as count from users;')->count,
            'device_count' => DB::selectOne('select count(id) as count from devices;')->count,
            'fault_count' => DB::selectOne('select count(id) as count from faults;')->count,
        ]);
    })->name('dashboard');

    Route::get('/faults', static function () {
        $faults = DB::select("select f.id, subject, f.description, is_resolved, d.device_uuid, d.location, u.email, u.tel, u.id as user_id from faults f inner join devices d on f.device_id = d.id inner join users u on d.user_id = u.id where is_resolved=0 order by f.id desc;");
        return Inertia::render('Faults',['faults'=>$faults]);
    })->name('faults');

    Route::get('/faults/{id}', static function (String $id) {
        DB::update("update faults set is_resolved=1 where id=$id;");
        $faults = DB::select("select f.id, subject, f.description, is_resolved, d.device_uuid, d.location, u.email, u.tel, u.id as user_id from faults f inner join devices d on f.device_id = d.id inner join users u on d.user_id = u.id where is_resolved=0 order by f.id desc;");
        return Inertia::render('Faults',['faults'=>$faults]);
    })->name('faults.update');



    Route::get('/devices', static function () {
        $devices = DB::select("select device_uuid, location, last_seen, u.email, u.tel, u.id as user_id from devices left join users u on devices.user_id = u.id;");
        return Inertia::render('Devices', ['devices'=>$devices]);
    })->name('devices');

    Route::get('/notify/{id}', function (string $id) {
        return Inertia::render('Notify',['id'=>$id, 'message'=>null]);
    })->name('notify.index');

    Route::get('/notify/{id}/{message}', function (string $id, String $message) {
        return Inertia::render('Notify',['id'=>$id, 'message'=>$message]);
    })->name('notify.withMessage');

    Route::post('/notify', [NotificationController::class, 'sendToClient'])->name('notify.sendToClient');

});
require __DIR__.'/auth.php';
