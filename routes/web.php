<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\FakultasController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/fakultas', [FakultasController::class, 'index'])->name('fakultas');
Route::post('/tambah_fakultas', [FakultasController::class, 'tambah_data'])->name('tambah_fakultas');
Route::post('/update_fakultas', [FakultasController::class, 'update_data'])->name('update_fakultas');
Route::get('/hapus_fakultas/{id}', [FakultasController::class, 'hapus_data'])->name('hapus_fakultas');
Route::get('/anggota', [AnggotaController::class, 'index']);
Route::get('/anggota/create', [AnggotaController::class, 'create']);
Route::post('/anggota/store', [AnggotaController::class, 'store']);
Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit']);
Route::put('/anggota/{id}', [AnggotaController::class, 'update']);
Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy']);
