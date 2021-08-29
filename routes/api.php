<?php

use App\Http\Controllers\CategoryAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::resource('category', 'CategoryAPIController');
Route::get('categorywithcount', 'CategoryAPIController@categorywithcount');

Route::resource('product', 'ProductAPIController');
Route::put('updateProductOptions/{id}', 'ProductAPIController@updateProductOptions');
Route::get('categoryproducts/{categoryId}', 'ProductAPIController@categoryproducts');

Route::resource('optionGroup', 'OptionGroupAPIController');

Route::resource('option', 'OptionAPIController');
Route::get('getOptionsWithGroup', 'OptionAPIController@getOptionsWithGroup');

Route::resource('test', 'TestController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


