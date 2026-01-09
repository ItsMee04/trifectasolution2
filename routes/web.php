<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\PegawaiController;
use App\Http\Controllers\Master\KendaraanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('pushlogin');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('modules.dashboard.dashboard');
    });

    Route::get('/role', function () {
        return view('modules.role.views.role');
    });
    Route::get('role/getRole', [RoleController::class, 'getRole']);
    Route::post('role/storeRole', [RoleController::class, 'storeRole']);
    Route::get('role/editRole/{id}', [RoleController::class, 'editRole']);
    Route::post('role/updateRole/{id}', [RoleController::class, 'updateRole']);
    Route::post('role/deleteRole/{id}', [RoleController::class, 'deleteRole']);

    Route::get('/pegawai', function () {
        return view('modules.pegawai.views.pegawai');
    });
    Route::get('pegawai/getPegawai', [PegawaiController::class, 'getPegawai']);
    Route::post('pegawai/storePegawai', [PegawaiController::class, 'storePegawai']);
    Route::get('pegawai/editPegawai/{id}', [PegawaiController::class, 'editPegawai']);
    Route::post('pegawai/updatePegawai/{id}', [PegawaiController::class, 'updatePegawai']);
    Route::post('pegawai/deletePegawai/{id}', [PegawaiController::class, 'deletePegawai']);

    Route::get('/users', function () {
        return view('modules.users.views.user');
    });
    Route::get('users/getUsers', [App\Http\Controllers\Master\UserController::class, 'getUsers']);
    Route::get('users/editUsers/{id}', [App\Http\Controllers\Master\UserController::class, 'editUsers']);
    Route::post('users/updateUsers/{id}', [App\Http\Controllers\Master\UserController::class, 'updateUsers']);

    Route::get('/driver', function () {
        return view('modules.driver.views.driver');
    });
    Route::get('driver/getDriver', [App\Http\Controllers\Master\DriverController::class, 'getDriver']);
    Route::post('driver/storeDriver', [App\Http\Controllers\Master\DriverController::class, 'storeDriver']);
    Route::get('driver/editDriver/{id}', [App\Http\Controllers\Master\DriverController::class, 'editDriver']);
    Route::post('driver/updateDriver/{id}', [App\Http\Controllers\Master\DriverController::class, 'updateDriver']);
    Route::post('driver/deleteDriver/{id}', [App\Http\Controllers\Master\DriverController::class, 'deleteDriver']);

    Route::get('/suplier', function () {
        return view('modules.suplier.views.suplier');
    });
    Route::get('suplier/getSuplier', [App\Http\Controllers\Master\SuplierContoller::class, 'getSuplier']);
    Route::post('suplier/storeSuplier', [App\Http\Controllers\Master\SuplierContoller::class, 'storeSuplier']);
    Route::get('suplier/editSuplier/{id}', [App\Http\Controllers\Master\SuplierContoller::class, 'editSuplier']);
    Route::post('suplier/updateSuplier/{id}', [App\Http\Controllers\Master\SuplierContoller::class, 'updateSuplier']);
    Route::post('suplier/deleteSuplier/{id}', [App\Http\Controllers\Master\SuplierContoller::class, 'deleteSuplier']);

    Route::get('/kendaraan', function () {
        return view('modules.kendaraan.views.kendaraan');
    });
    Route::get('kendaraan/getKendaraan', [KendaraanController::class, 'getKendaraan']);
    Route::post('kendaraan/storeKendaraan', [KendaraanController::class, 'storeKendaraan']);
    Route::get('kendaraan/editKendaraan/{id}', [KendaraanController::class, 'editKendaraan']);
    Route::post('kendaraan/updateKendaraan/{id}', [KendaraanController::class, 'updateKendaraan']);
    Route::post('kendaraan/deleteKendaraan/{id}', [KendaraanController::class, 'deleteKendaraan']);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
