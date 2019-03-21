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

Route::resource('objetivo', 'ControllerObjetivo');
Route::resource('alteracao', 'ControllerAlteracao');
Route::resource('categoria', 'ControllerCategoria');
Route::resource('parametro', 'ControllerParametro');
Route::resource('atividade_preponderante', 'ControllerAtividadePreponderante');
Route::resource('amostra', 'ControllerAmostra');
Route::post('amostra/confirm', 'ControllerAmostra@confirm')->name('amostra.confirm');
