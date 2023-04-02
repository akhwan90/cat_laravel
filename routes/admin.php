<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PesertaController as AdminPesertaController;
use App\Http\Controllers\Admin\SoalController as AdminSoalController;
use App\Http\Controllers\Admin\UjianController as AdminUjianController;
use App\Http\Controllers\Admin\UjianPesertaController as AdminUjianPesertaController;
use App\Http\Controllers\Admin\UjianSoalController as AdminUjianSoalController;
use App\Http\Controllers\Admin\MapelController as AdminMapelController;

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
Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::controller(AdminUserController::class)->prefix('user')->as('admin.user.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{idUser}', 'edit')->name('edit');
        Route::post('/insert', 'insert')->name('insert');
        Route::post('/update', 'update')->name('update');
        Route::get('/remove/{idUser}', 'remove')->name('remove');
    });

    Route::controller(AdminPesertaController::class)->prefix('peserta')->as('admin.peserta.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{idPeserta}', 'edit')->name('edit');
        Route::post('/insert', 'insert')->name('insert');
        Route::post('/update', 'update')->name('update');
        Route::get('/remove/{idPeserta}', 'remove')->name('remove');
        Route::get('/insertAdmin/{idPeserta}', 'insertAdmin')->name('insertAdmin');
    });

    Route::controller(AdminSoalController::class)->prefix('soal')->as('admin.soal.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{idSoal}', 'edit')->name('edit');
        Route::post('/insert', 'insert')->name('insert');
        Route::post('/update', 'update')->name('update');
        Route::get('/remove/{idSoal}', 'remove')->name('remove');
        Route::get('/getGambarSoal/{idSoal}', 'getGambarSoal')->name('getGambarSoal');
    });

    Route::controller(AdminUjianController::class)->prefix('ujian')->as('admin.ujian.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/insert', 'insert')->name('insert');
        Route::post('/update', 'update')->name('update');
        Route::get('/remove/{id}', 'remove')->name('remove');
        
        Route::get('/detil/{id}', 'detil')->name('detil');
    });

    Route::controller(AdminMapelController::class)->prefix('mapel')->as('admin.mapel.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::get('/edit/{idMapel}', 'edit')->name('edit');
        Route::post('/insert', 'insert')->name('insert');
        Route::post('/update', 'update')->name('update');
        Route::get('/remove/{idMapel}', 'remove')->name('remove');
    });


    Route::controller(AdminUjianPesertaController::class)->prefix('ujian/peserta')->as('admin.ujian.peserta.')->group(function () {
        Route::get('{id}', 'index')->name('index');
        Route::get('add/{idUjian}', 'add')->name('add');
        Route::get('remove/{idUjian}/{idUjianPeserta}', 'remove')->name('remove');
        Route::post('/save', 'save')->name('save');
    });

    Route::controller(AdminUjianSoalController::class)->prefix('ujian/soal')->as('admin.ujian.soal.')->group(function () {
        Route::get('{id}', 'index')->name('index');
        Route::get('add/{idUjian}', 'add')->name('add');
        Route::get('remove/{idUjian}/{idUjianSoal}', 'remove')->name('remove');
        Route::post('/save', 'save')->name('save');
    });
});