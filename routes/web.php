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

Route::get('/', 'Controller@home');
Route::post('/new', 'Controller@newProduct');



Route::post('/update/{id}', 'Controller@post');
Route::post('/delete/{id}', 'Controller@remove');
