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
Route::get('productbycategory/{categoryId}', 'ProductAPIController@productbycategory');


Route::resource('optionGroup', 'OptionGroupAPIController');
Route::get('groupsWithOption', 'OptionGroupAPIController@groupsWithOption');

Route::resource('option', 'OptionAPIController');
Route::get('getOptionsWithGroup', 'OptionAPIController@getOptionsWithGroup');

Route::resource('test', 'TestController');

Route::resource('user', 'UserAPIController');
Route::post('register', 'UserAPIController@register');
Route::post('login', 'UserAPIController@login');

Route::resource('zone', 'ZoneAPIController');

Route::resource('order', 'OrderAPIController');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'UserAPIController@logout');
    Route::put('updatecarts', 'ProductCartsAPIController@updatecarts');
    Route::resource('productCarts', 'ProductCartsAPIController');
    Route::resource('address', 'DeliveryAdressesAPIController');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


