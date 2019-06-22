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


Route::get('hero/', 'HeroController@index');
Route::get('hero/create', 'HeroController@create');
Route::get('hero/edit/{id}', 'HeroController@edit');

Route::post('hero/create', 'HeroController@store');
Route::delete('/hero/{id}', 'HeroController@delete');

Route::get('hero/formData/', 'HeroController@formData');
Route::get('hero/availableClass/{heroRace}', 'HeroController@availableClass');
Route::get('hero/availableWeapons/{heroClass}', 'HeroController@availableWeapons');
Route::get('hero/data/{id}', 'HeroController@data');


Route::get('/', 'DashboardController@index');
