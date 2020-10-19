<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('straipsniai', 'PostController@postai');
//Route::get('straipsniai/{id}', 'PostController@postByID');
//Route::get('straipsniai', 'PostController@postSave');
//Route::put('straipsniai/{straipsnis}', 'PostController@postUpdate');


//Route::get('straipsniai', [PostController::class, 'postai']);
//Route::get('straipsniai/{id}', [PostController::class, 'postByID']);
//Route::post('straipsniai', [PostController::class, 'postSave']);
//Route::put('straipsniai/{id}', [PostController::class, 'postUpdate']);
//Route::delete('straipsniai/{id}', [PostController::class, 'postDelete']);


Route::resource('posts.comments', 'App\Http\Controllers\PostCommentController');
Route::resource('categories.posts', 'App\Http\Controllers\CategoryPostController');

//Route::apiResource('straipsniai', 'App\Http\Controllers\ControllerPost');
Route::resource('posts', 'App\Http\Controllers\ControllerPost');
Route::resource('comments', 'App\Http\Controllers\ControllerComment');
Route::resource('categories', 'App\Http\Controllers\ControllerCategory');