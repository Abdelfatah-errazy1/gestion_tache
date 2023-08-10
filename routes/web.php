<?php

use App\Http\Controllers\ContraintController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PrerequisController;
use App\Http\Controllers\TacheController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/','/taches');

Route::name('auth.')->prefix('auth')->controller(LoginController::class)->group(function(){
    Route::get('/login','login')->name('login');
    Route::post('/login','store')->name('session');
    Route::get('/logout','logout')->name('logout');
});
Route::name('taches.')->prefix('taches')->controller(TacheController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/store','store')->name('store');
    Route::put('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
    Route::get('/complete/{id}','complete')->name('complete');
    Route::post('/affecter/{id}','affecter')->name('affecter');
});
Route::name('contraints.')->prefix('contraints')->controller(ContraintController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/store','store')->name('store');
    Route::put('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
});
Route::name('prerequis.')->prefix('prerequis')->controller(PrerequisController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/store','store')->name('store');
    Route::put('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
});

Route::get('test', function () {
    return view('components.test');
});