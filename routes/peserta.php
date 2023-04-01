<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Peserta\UjianController as PesertaUjianController;

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
Route::prefix('peserta')->middleware(['auth'])->group(function() {
    Route::controller(PesertaUjianController::class)->prefix('ujian')->as('peserta.ujian.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('ikuti/{idUjian}', 'ikuti')->name('ikuti');
        Route::get('viewSoal/{idUjianPeserta}', 'viewSoal')->name('viewSoal');
        Route::post('saveSatu', 'saveSatu')->name('saveSatu');
        Route::get('selesai/{idUjianPeserta}', 'selesai')->name('selesai');
    });


});