<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'MainController@index')->name('main');



Route::get('Counter', 'CounterController@index')->name('counter') ;
Route::post('store', 'CounterController@store')->name('store') ;
Route::delete('/delete-record/{id}', 'CounterController@delete')->name('delete') ;


Route::get('/dashboard/{id}', 'DashboardController@index')->name('dashboard') ;
Route::get('Counter2/{id}', 'Counter2Controller@index')->name('counter2') ;
Route::post('store2', 'Counter2Controller@store')->name('store2') ;

Route::get('Payments', 'PaymentController@index')->name('payments');
Route::post('Payments/{id}', 'PaymentController@store')->name('payments.store');
Route::post('Payment/{id}', 'PaymentController@pay')->name('payments.pay');

Route::get('Tariff', 'TariffController@index')->name('tariff') ;
Route::post('Tariff', 'TariffController@store')->name('tariff.store') ;


//Route::get('Counter', 'CounterController@index')->name('jquery') ;



