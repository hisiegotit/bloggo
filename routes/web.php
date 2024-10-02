<?php

use App\Livewire\CreatePost;
use App\Livewire\EditPost;
use App\Livewire\ListPost;
use App\Livewire\Welcome;
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

Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
    Route::get('/', ListPost::class)->name('index');
    Route::get('/edit/{post}', EditPost::class)->name('edit');
    Route::get('/create', CreatePost::class)->name('create');
});
