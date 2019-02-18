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
Route::resource('amostra', 'ControllerAmostra');
Route::resource('atividade_preponderante', 'ControllerAtividadePreponderante');
Route::resource('categoria', 'ControllerCategoria');
Route::resource('objetivo', 'ControllerObjetivo');
Route::resource('parametro', 'ControllerParametro');
