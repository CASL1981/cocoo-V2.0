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


Route::group(['middleware' => 'auth'], function(){
    Route::prefix('basics')->group(function() {
        // Route::get('/', 'BasicsController@index')->name('basics');
        Route::get('/', 'BasicsController@index')->name('dashboard.basics');
        Route::view('destinations', 'basics::livewire.destination.index')
        ->name('basic.destinations')->middleware('can_view:destination');
        Route::view('employees', 'basics::livewire.employee.index')
        ->name('basic.employees')->middleware('can_view:employee');
        Route::view('clients', 'basics::livewire.client.index')
        ->name('basic.clients')->middleware('can_view:client');
        Route::view('payment', 'basics::livewire.payment.index')
        ->name('basic.payment')->middleware('can_view:payment');
    });
});