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
//Route::resource('test', 'TestController');
//Route::get('reorder', 'TestController@reorder');

Route::get('categorywithcount', 'CategoryAPIController@categorywithcount');
Route::get('categoriestree', 'CategoryAPIController@categoriestree');

Route::post('register', 'UserAPIController@register');
Route::post('loginusers', 'UserAPIController@loginUsers');
Route::post('loginstaf', 'UserAPIController@loginStaf');

Route::get('usersappinfos', 'UserAPIController@usersappinfos');

Route::resource('orderType', 'OrderTypeAPIController');

Route::resource('category', 'CategoryAPIController')->except([
    'create', 'store', 'update', 'destroy'
]);
Route::resource('product', 'ProductAPIController')->except([
    'create', 'store', 'update', 'destroy'
]);
Route::resource('optionGroup', 'OptionGroupAPIController')->except([
    'create', 'store', 'update', 'destroy'
]);
Route::get('categoryproducts/{categoryId}', 'ProductAPIController@categoryproducts');
Route::get('productbycategory/{categoryId}', 'ProductAPIController@productbycategory');
Route::get('groupsWithOption', 'OptionGroupAPIController@groupsWithOption');
Route::resource('option', 'OptionAPIController')->except([
    'create', 'store', 'update', 'destroy'
]);
Route::get('getOptionsWithGroup', 'OptionAPIController@getOptionsWithGroup');
Route::resource('zone', 'ZoneAPIController')->except([
    'create', 'store', 'update', 'destroy'
]);

Route::resource('settings', 'SettingsAPIController');


// *****************************************************************************************
Route::get('historiqueOrders', 'OrderAPIController@historiqueOrders');

Route::middleware('auth:api')->group(function () {
    Route::resource('category', 'CategoryAPIController')->only([
        'create', 'store', 'update', 'destroy'
    ]);

    Route::resource('product', 'ProductAPIController')->only([
        'create', 'store', 'update', 'destroy'
    ]);
    Route::put('updateProductOptions/{id}', 'ProductAPIController@updateProductOptions');
    

    Route::resource('optionGroup', 'OptionGroupAPIController')->only([
        'create', 'store', 'update', 'destroy'
    ]);
    Route::get('groupsWithOption', 'OptionGroupAPIController@groupsWithOption');

    Route::resource('option', 'OptionAPIController')->only([
        'create', 'store', 'update', 'destroy'
    ]);
    Route::get('getOptionsWithGroup', 'OptionAPIController@getOptionsWithGroup');

    Route::resource('user', 'UserAPIController');

    Route::resource('zone', 'ZoneAPIController')->only([
        'create', 'store', 'update', 'destroy'
    ]);

    Route::get('newOrders', 'OrderAPIController@newOrders');
    Route::get('oldOrders', 'OrderAPIController@oldOrders');
    
    Route::put('updateOrder/{id}', 'OrderAPIController@updateOrder');

    Route::resource('order', 'OrderAPIController');

    Route::post('logout', 'UserAPIController@logout');
    Route::post('userappinfo', 'UserAPIController@userappinfo');

    Route::put('updatecarts', 'ProductCartsAPIController@updatecarts');
    Route::resource('productCarts', 'ProductCartsAPIController');
    Route::resource('address', 'DeliveryAdressesAPIController');

    Route::post('updateEnableDelivery', 'SettingsAPIController@updateEnableDelivery');
    Route::post('updateClosed', 'SettingsAPIController@updateClosed');
    Route::post('updateWaitingMessage', 'SettingsAPIController@updateWaitingMessage');

    Route::resource('tables', 'TableAPIController');
    Route::post('tablesmulti', 'TableAPIController@multiStore');
    
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


