<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Route::get('/vue/{vue_capture?}', function () {
//     return view('welcome');
//    })->where('vue_capture', '[\/\w\.-]*');



Route::get('/{vue?}', function() {
    return view('welcome');
})->where('vue', '[\/\w\.-]*');

//cia sita naudojau
// Route::any('{all}',function(){
//     return view('welcome');
// })
// ->where('all', '^(?!api).*$');





// ->where('all', '^(?!storage).*$');





/*
Route::any('{all}', function () {
    return view('welcome');})->where(['all' => '.*']);
*/




//Route::get('/{any}', function() { return view('welcome'); })->where('any', '.*');
//Route::view("/{any}", 'welcome')->where('any', '.*');
//Route::view("/{app?}", 'welcome')->where('app', '.*');






/*
Route::get('/vue/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
*/

//Route::view("/{app?}", 'welcome')->where('app', '.?');

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();


/*
Route::get('/xd', function () {
    return view('welcome');
});
*/

