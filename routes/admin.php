<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;

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

Route::controller(AdminUserController::class)->middleware(['auth'])->prefix('admin/user')->as('admin.user.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::get('/edit/{idUser}', 'edit')->name('edit');
    Route::post('/insert', 'insert')->name('insert');
    Route::post('/update', 'update')->name('update');
    Route::get('/remove/{idUser}', 'remove')->name('remove');
});

