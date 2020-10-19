<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

//Route::view('/', 'home';

Route::get('/', function () {
    return view('welcome');
});

Route::get('straipsniai', 'PostController@postai');
Route::get('straipsniai/{id}', 'PostController@postByID');
Route::get('straipsniai', 'PostController@postSave');
Route::put('straipsniai/{straipsnis}', 'PostController@postUpdate');

Route::get('straipsniai', [PostController::class, 'postai']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
