<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'App\Http\Controllers\Api\Auth\AuthController@login');
    Route::post('register', 'App\Http\Controllers\Api\Auth\AuthController@register');
    Route::post('logout', 'App\Http\Controllers\Api\Auth\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\Api\Auth\AuthController@refresh');
    Route::post('user-profile', 'App\Http\Controllers\Api\Auth\AuthController@userProfile');
    Route::post('checkToken', 'App\Http\Controllers\Api\Auth\AuthController@checkToken');
});

Route::get('users', 'App\Http\Controllers\UsersController@index');
Route::post('users/delete/{id}', 'App\Http\Controllers\UsersController@deleteUser');
Route::post('users', 'App\Http\Controllers\UsersController@store');
Route::get('users/{id}', 'App\Http\Controllers\UsersController@show');
Route::put('users/{id}', 'App\Http\Controllers\UsersController@update');
Route::put('userss/{id}', 'App\Http\Controllers\UsersController@testUpdate');

Route::resource('posts.comments', 'App\Http\Controllers\PostCommentController');
Route::resource('categories.posts', 'App\Http\Controllers\CategoryPostController');

Route::resource('posts', 'App\Http\Controllers\ControllerPost');
Route::resource('comments', 'App\Http\Controllers\ControllerComment');
Route::resource('categories', 'App\Http\Controllers\ControllerCategory');