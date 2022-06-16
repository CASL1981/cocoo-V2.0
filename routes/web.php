<?php

use App\Http\Livewire\Profiles;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::Group(['middleware' => 'auth'], function(){
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('dashboard/users', 'livewire.user.index')->name('dashboard.users')
    ->middleware('can_view:usuario');
    Route::view('dashboard/roles', 'livewire.role.index')->name('dashboard.roles')
    ->middleware('can_view:role');
    Route::view('dashboard/profile', 'livewire.profile.index')->name('dashboard.profile');    
});

Route::get('/profile/edit', function () {
    return;
});

Route::get('/profile/edit', Profiles::class);