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
Route::get('test2', 'TestController@test2')->name('test2');
Route::get('test3', 'TestController@test3')->name('test3');





Route::get('/dashboard/{id}', 'DashboardController@index')->name('dashboard') ;
Route::get('Counter2/{id}', 'Counter2Controller@index')->name('counter2') ;
Route::post('store', 'Counter2Controller@store')->name('store') ;

Route::post('store3', 'Counter2Controller@store3')->name('store3') ;
Route::delete('Counter/{id}', 'Counter2Controller@delete')->name('counter.delete') ;
Route::post('Counter/update', 'Counter2Controller@update')->name('counter.update');

Route::get('Payments', 'PaymentController@index')->name('payments');
Route::post('Payments/{id}', 'PaymentController@store')->name('payments.store');
Route::post('Payment/{id}', 'PaymentController@pay')->name('payments.pay');
Route::post('Paymentupdate', 'PaymentController@update2')->name('payments.update');
Route::delete('Payment/{id}', 'PaymentController@destroy')->name('payment.delete');

Route::post('Prepay/{id}', 'PrepayController@prepay')->name('prepay');
Route::get('Prepay/index/{id}', 'PrepayController@index')->name('prepay.index');
Route::post('Prepaystore', 'PrepayController@add')->name('prepay.add');
Route::delete('Prepay/delete/{id}', 'PrepayController@delete')->name('prepay.delete');


Route::get('Tariff', 'TariffController@index')->name('tariff');
Route::post('Tariff', 'TariffController@store')->name('tariff.store') ;
Route::get('vznos', 'TariffController@vznos')->name('vznos');
Route::post('vznos/calculation', 'TariffController@calculationon')->name('vznos.calculation');
Route::delete('vznos/delete', 'TariffController@destroy')->name('vznos.delete');
Route::post('vznos/edit', 'TariffController@edit')->name('vznos.edit');

Route::get('Debts', 'DebtsController@index')->name('debts') ;
Route::get('Debts2', 'DebtsController@index2')->name('debts2') ;
Route::get('Debts3', 'DebtsController@index3')->name('debts3') ;
Route::post('Debtsprint', 'DebtsController@print')->name('debts.print') ;

Route::post('Areas/comment', 'AreasController@comment')->name('areas.comment') ; //обновление комментария
//Route::get('Areas/update/{id}', 'AreasController@update')->name('areas.update') ; //страница обновление участка
Route::get('Areas/new', 'AreasController@new')->name('areas.new') ; //новый владелец
Route::post('Area/update', 'AreasController@update2')->name('area.update') ; //обновление участка
Route::delete('/paymentmovs/{id}', 'PaymentmovsController@destroy')->name('payment_mov.delete');
Route::get('Areas/create', 'AreasController@create')->name('area.create');
Route::post('Areas', 'AreasController@store')->name('area.store');
    Route::delete('/area/{id}', 'AreasController@destroy')->name('area.delete');

Route::get('incoming', 'IncomingController@all')->name('incomingall');
Route::delete('incoming/delete', 'IncomingController@destroy')->name('incoming.delete');
Route::post('incoming/print', 'IncomingController@print')->name('incoming.print');
Route::post('incoming', 'IncomingController@index')->name('incoming');


//Route::post('paymentn', 'PaymentnController@store')->name('payment_new');

Route::post('form', 'FormController@index')->name('form');
Route::post('form/submit', 'FormController@submit')->name('form.submit');
Route::post('check', 'FormController@check')->name('check');


Route::get('report', 'ReportController@index')->name('report');
Route::post('report/calc', 'ReportController@calc')->name('report.calc');
Route::post('report/print', 'ReportController@print')->name('report.print');

});


Auth::routes([
    'confirm' => false,
    'forgot' => false,
    'login' => true,
    'register' => false,
    'reset' => false,
]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


