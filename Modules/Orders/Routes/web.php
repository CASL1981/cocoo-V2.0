<?php

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
    Route::prefix('orders')->group(function() {        
        Route::get('/', 'OrderController@index')->name('dashboard.orders');
        Route::get('/pdf/{id?}', 'OrderController@pdf')->name('order.pdf');
        Route::view('products', 'orders::livewire.product.index')
        ->name('order.products')->middleware('can_view:product');        
        Route::view('price', 'orders::livewire.price.index')
        ->name('order.prices')->middleware('can_view:price');
        Route::view('operation', 'orders::livewire.operation.index')
        ->name('order.operation')->middleware('can_view:operation');
        Route::view('detailoperation', 'orders::livewire.detailoperation.index')
        ->name('order.detail.operation');
        Route::view('editdetailoperation', 'orders::livewire.editdetailoperation.index')
        ->name('order.edit.detail.operation');
    });
});
