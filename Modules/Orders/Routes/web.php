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
        // Route::get('/', 'BasicsController@index')->name('basics');
        Route::get('/', 'OrderController@index')->name('dashboard.orders');
        Route::view('products', 'orders::livewire.product.index')
        ->name('order.products')->middleware('can_view:product');
        Route::view('typeprice', 'orders::livewire.typeprice.index')
        ->name('order.typeprice')->middleware('can_view:typeprice');
        Route::view('price', 'orders::livewire.price.index')
        ->name('order.prices')->middleware('can_view:price');
        // Route::view('payment', 'basics::livewire.payment.index')
        // ->name('basic.payment')->middleware('can_view:payment');
        // Route::view('classifications', 'basics::livewire.classification.index')
        // ->name('basic.classifications');
    });
});
