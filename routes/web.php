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
Route::middleware(['admin'])->group(function () {

Route::get('/main', 'MainController@index')->name('main');


Route::get('test', 'TestController@test')->name('test');

Route::post('incoming', 'IncomingController@index')->name('incoming');

Route::get('name', 'MainController@search')->name('name');


//Route::post('countered', 'Counter2Controller@countered')->name('countered') ;


Route::get('/dashboard/{id}', 'DashboardController@index')->name('dashboard') ;
Route::get('Counter2/{id}', 'Counter2Controller@index')->name('counter2') ;
Route::post('store', 'Counter2Controller@store')->name('store') ;

Route::post('store3', 'Counter2Controller@store3')->name('store3') ;
Route::delete('Counter/{id}', 'Counter2Controller@delete')->name('counter.delete') ;
Route::post('Counterupdate', 'Counter2Controller@update')->name('counter.update');

Route::get('Payments', 'PaymentController@index')->name('payments');
Route::post('Payments/{id}', 'PaymentController@store')->name('payments.store');
Route::post('Payment/{id}', 'PaymentController@pay')->name('payments.pay');
Route::post('Paymentupdate', 'PaymentController@update')->name('payments.update');
Route::delete('Payment/{id}', 'PaymentController@destroy')->name('payment.delete');

Route::post('Prepay/{id}', 'PrepayController@prepay')->name('prepay');
Route::get('Prepayindex/{id}', 'PrepayController@index')->name('prepay.index');
Route::post('Prepaystore', 'PrepayController@store')->name('prepay.store');
Route::delete('Prepay/delete/{id}', 'PrepayController@delete')->name('prepay.delete');


Route::get('Tariff', 'TariffController@index')->name('tariff');
Route::post('Tariff', 'TariffController@store')->name('tariff.store') ;
Route::get('vznos', 'TariffController@vznos')->name('vznos');
Route::post('vznos/calculation', 'TariffController@calculation')->name('vznos.calculation');

Route::get('Debts', 'DebtsController@index')->name('debts') ;
Route::post('Debts2', 'DebtsController@index2')->name('debts2') ;

Route::post('Areascomment', 'AreasController@comment')->name('areas.comment') ; //обновление комментария
Route::get('Areasupdate/{id}', 'AreasController@update')->name('areas.update') ; //страница обновление участка
Route::get('Areasnew', 'AreasController@new')->name('areas.new') ; //страница обновление участка
Route::post('Areaupdate', 'AreasController@update2')->name('area.update') ; //обновление участка
Route::delete('/paymentmovs/{id}', 'PaymentmovsController@destroy')->name('payment_mov.delete');
Route::get('Areas/create', 'AreasController@create')->name('area.create');
Route::post('Areas', 'AreasController@store')->name('area.store');

Route::get('incoming', 'IncomingController@all')->name('incomingall');
Route::delete('incomingdelete', 'IncomingController@destroy')->name('incoming.delete');




Route::post('paymentn', 'PaymentnController@store')->name('payment_new');















});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
