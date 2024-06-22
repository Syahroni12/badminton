<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JurusanController;

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
Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan');
Route::post('/tambah_jurusan', [JurusanController::class, 'tambah_data'])->name('tambah_jurusan');
Route::post('/update_jurusan', [JurusanController::class, 'update_jurusan'])->name('update_jurusan');
Route::get('/hapus_jurusan/{id}', [JurusanController::class, 'hapus_jurusan'])->name('hapus_jurusan');



Route::get('/anggota', [AnggotaController::class, 'index'])->name("anggota");
Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('tambah_anggota');
Route::post('/anggota/store', [AnggotaController::class, 'store'])->name("anggota.store");
Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name("anggota.edit");
Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name("anggota.update");
Route::get('/hapus_anggota/{id}', [AnggotaController::class, 'destroy']);

Route::get('/jurusan/{fakultas_id}', [JurusanController::class, 'getJurusanByFakultas'])->name('getJurusanByFakultas');
// Route::get('/jurusan/{fakultas_id}', [JurusanController::class, 'getJurusanByFakultas'])->name('getJurusanByFakultas');
