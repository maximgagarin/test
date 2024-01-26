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

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/', 'MainController@index')->name('main');
Route::get('/main', 'MainController@index')->name('main')->middleware('admin');

//Route::get('main', 'MainController@index')->name('main');
Route::get('name', 'MainController@search')->name('name');
//Route::get('/search', 'MainController@search')->name('main.search');




Route::get('Counter', 'CounterController@index')->name('counter') ;
Route::post('store', 'CounterController@store')->name('store') ;
Route::delete('/delete-record/{id}', 'CounterController@delete')->name('delete') ;


Route::get('/dashboard/{id}', 'DashboardController@index')->name('dashboard')->middleware('admin') ;
Route::get('Counter2/{id}', 'Counter2Controller@index')->name('counter2') ;
Route::post('store2', 'Counter2Controller@store')->name('store2') ;

Route::get('Payments', 'PaymentController@index')->name('payments');
Route::post('Payments/{id}', 'PaymentController@store')->name('payments.store');
Route::post('Payment/{id}', 'PaymentController@pay')->name('payments.pay');
Route::post('Paymentupdate', 'PaymentController@update')->name('payments.update');

Route::post('Prepay/{id}', 'PrepayController@prepay')->name('prepay');


Route::get('Tariff', 'TariffController@index')->name('tariff')->middleware('admin');
Route::post('Tariff', 'TariffController@store')->name('tariff.store') ;

Route::get('Debts', 'DebtsController@index')->name('debts')->middleware('admin') ;
Route::post('Debts2', 'DebtsController@index2')->name('debts2') ;

Route::post('Areascomment', 'AreasController@comment')->name('areas.comment') ; //обновление комментария
Route::get('Areasupdate/{id}', 'AreasController@update')->name('areas.update') ; //страница обновление участка
Route::post('Areaupdate', 'AreasController@update2')->name('area.update') ; //обновление участка
Route::delete('/paymentmovs/{id}', 'PaymentmovsController@destroy')->name('payment_mov.delete');




//Route::get('Counter', 'CounterController@index')->name('jquery') ;




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
