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
    return view('welcome');
});

Route::resource('alteracao', 'ControllerAlteracao');
Route::resource('categoria', 'ControllerCategoria');
Route::resource('parametro', 'ControllerParametro');
Route::resource('atividade_preponderante', 'ControllerAtividadePreponderante');
Route::resource('amostra', 'ControllerAmostra');
Route::post('amostra/confirm', 'ControllerAmostra@confirm')->name('amostra.confirm');
Route::get('amostra/complete/{id}', 'ControllerAmostra@show_complete')->name('amostra.complete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
