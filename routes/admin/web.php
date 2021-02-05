<?php

use Illuminate\Support\Facades\Route;

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
Route::middleware(['guest'])->group(function() {
  Route::get('login', 'AuthController@login')->name('login');
  Route::post('login', 'AuthController@login')->name('login');
});

Route::middleware(['admin.auth'])->group(function() {
  Route::middleware(['role:admin|super.admin'])->group(function(){
    Route::get('/', function() {
      return view('admin.index');
    })->name('index');
  });
  Route::get('logout', 'AuthController@logout')->name('logout');
});

