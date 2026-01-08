<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\PegawaiController;

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

Route::get('/', function () {
    return view('login');
});

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
