<?php

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

// front routes
Auth::routes();
Route::get('/', function () {
  return redirect('/adminpanel');
});

//admin routes
Route::resource('adminpanel/', 'adminloginController');
Route::group(['middleware' => ['adminauth:admin']], function () {
  Route::resource('adminpanel/users', 'adminmemberController');
  Route::delete('myusersDeleteAll', 'adminmemberController@deleteAll');
  Route::resource('adminpanel/provider', 'providerController');
  Route::resource('adminpanel/about', 'adminaboutController');
  Route::resource('adminpanel/privacy', 'adminprivacyController');
  Route::resource('adminpanel/conditions', 'adminconditionsController');
  Route::resource('adminpanel/setapp', 'adminchangelogoController');
  Route::resource('adminpanel/items', 'adminitemController');
  Route::delete('myitemssDeleteAll', 'adminitemController@deleteAll');
  Route::resource('adminpanel/bills', 'adminillController');
  Route::resource('adminpanel/orders', 'adminorderController');
  Route::delete('myordersDeleteAll', 'adminorderController@deleteAll');
  Route::resource('adminpanel/transfers', 'admintransferController');
  Route::delete('mytransferDeleteAll', 'admintransferController@deleteAll');
  Route::resource('adminpanel/categories', 'admincuttingsController');
  Route::resource('adminpanel/wcategories', 'adminweightsController');
  Route::resource('adminpanel/cities', 'adminCityController');
  Route::resource('adminpanel/districts', 'adminDistrictController');
});

//admin logout
Route::Delete('adminpanel/{id}', 'adminloginController@destroy');
