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

Route::get('/', function () {
    return view('login');
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth.checkrole:admin', 'as'=>'admin.'],function() {
    Route::get('customers', ['as' => 'customers.index', 'uses' => 'CustomersController@index']);
    Route::get('customers/create', ['as' => 'customers.create', 'uses' => 'CustomersController@create']);
    Route::get('customers/edit/{id}', ['as' => 'customers.edit', 'uses' => 'CustomersController@edit']);
    Route::post('customers/update/{id}', ['as' => 'customers.update', 'uses' => 'CustomersController@update']);
    Route::post('customers/store', ['as' => 'customers.store', 'uses' => 'CustomersController@store']);
    Route::get('customers/destroy/{id}', ['as' => 'customers.destroy', 'uses' => 'CustomersController@destroy']);
    Route::post('customers', ['as' => 'customers.filter', 'uses' => 'CustomersController@filter']);
});


Auth::routes();

Route::get('/home', function() {
    return redirect()->route('admin.customers.index');
});