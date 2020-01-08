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



Route::get('/', 'AuthController@dashboard');
Route::get('login', [ 'as' => 'login', 'uses' => 'AuthController@index']);
Route::post('post-login', 'AuthController@postLogin'); 
Route::get('logout', 'AuthController@logout');
Route::post('chamados/store', ['as'=>'chamados.store', 'middleware' => 'auth', 'uses' => 'ChamadoController@store']);

Route::get('inventarios/', ['as'=>'inventarios', 'middleware' => 'auth', 'uses' => 'InventarioController@index']);
Route::get('inventarios/create', ['as'=>'inventarios.create', 'middleware' => 'auth', 'uses' => 'InventarioController@create']);
Route::post('inventarios/', ['as'=>'inventarios.store', 'middleware' => 'auth', 'uses' => 'InventarioController@store']);
Route::get('inventarios/{id}', ['as'=>'inventarios.show', 'middleware' => 'auth', 'uses' => 'InventarioController@show']);
Route::get('inventarios/{id}/edit', ['as'=>'inventarios.edit', 'middleware' => 'auth', 'uses' => 'InventarioController@edit']);
Route::put('inventarios/{id}', ['as'=>'inventarios.update', 'middleware' => 'auth', 'uses' => 'InventarioController@update']);
Route::delete('inventarios/{id}', ['as'=>'inventarios.destroy', 'middleware' => 'auth', 'uses' => 'InventarioController@destroy']);

Route::group(['as'=>'chamados', 'middleware' => 'auth'], function () {
  Route::resource('chamados', 'ChamadoController');
});

// Route::group(['as'=>'inventarios', 'middleware' => 'auth'], function () {
//   Route::resource('inventarios', 'InventarioController');
// });