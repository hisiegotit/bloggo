<?php

use App\Livewire\ArchivePost;
use App\Livewire\CreatePost;
use App\Livewire\EditPost;
use App\Livewire\Home;
use App\Livewire\ListPost;
use App\Livewire\ShowPost;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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

Route::get('/', Welcome::class)->name('welcome');

Route::get('/view/{post}', ShowPost::class)->name('post.show');
// Users will be redirected to this route if not logged in
Volt::route('/login', 'login')->name('login');
Volt::route('/register', 'register')->name('register');

// Define the logout
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
});


Route::get('/home', Home::class)->name('home');
Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
        Route::get('/', ListPost::class)->name('index');
        Route::get('/edit/{post}', EditPost::class)->name('edit');
        Route::get('/create', CreatePost::class)->name('create');
        Route::get('/archive', ArchivePost::class)->name('archive');
    });

});
