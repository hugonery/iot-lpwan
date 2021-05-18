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

Route::get('/', function () { return redirect('/home'); })->name('home');

Route::get('/login/{erro}', function ($erro) { return view('auth.login', compact('erro')); });

Route::get('/logout', function () { Auth::logout(); return redirect('/login/4'); });

Route::group(['middleware' => ['auth']], function() 
{
  Route::get('/home','HomeController@index');
  Route::get('/changePassword','UsersController@showChangePasswordForm');
  Route::post('/changePassword','UsersController@changePassword')->name('changePassword');
  
  Route::get('/places/create/{id}','PlacesController@create');
  Route::get('/stations/create/{id}','StationsController@create');
  Route::get('/sensors/create/{id}','SensorsController@create');

  Route::resource('users', 'UsersController');
  Route::resource('places', 'PlacesController');
  Route::resource('stations', 'StationsController');
  Route::resource('sensors', 'SensorsController');
  Route::resource('states', 'StatesController');
  
  Route::get('/busca-cep/{form}', function ($form) { return view('cep.busca', compact('form')); });
  Route::match(['get', 'post'], '/busca-cep-estado/{form}', function ($form) { return view('cep.buscaestado', compact('form')); });
  Route::match(['get', 'post'], '/busca-cep-cidade/{form}', function ($form) { return view('cep.buscacidade', compact('form')); });
  Route::match(['get', 'post'], '/busca-cep-bairro/{form}', function ($form) { return view('cep.buscabairro', compact('form')); });
    
});
  
Auth::routes();
