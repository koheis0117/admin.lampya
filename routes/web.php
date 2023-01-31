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


Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);;

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/item', 'ItemController@index')->name('item_list');
    Route::post('/item/store', 'ItemController@store')->name('item_store');
    Route::get('/item/edit/{id}', 'ItemController@edit')->name('item_edit');
    Route::post('/item/update', 'ItemController@update')->name('item_update');
    Route::post('/item/delete/{id}', 'ItemController@delete')->name('item_delete');
    Route::get('/stock', 'StockController@index')->name('stock_create');
    Route::get('/stock/list', 'StockController@show')->name('stock_list');
    Route::post('/stock/store', 'StockController@store')->name('stock_store');
    Route::get('/stock/edit/{id}', 'StockController@edit')->name('stock_edit');
    Route::post('/stock/update', 'StockController@update')->name('stock_update');
    Route::post('/stock/delete/{id}', 'StockController@delete')->name('stock_delete');
    Route::get('/stock/output/pdf', 'PdfOutputController@output')->name('pdf_output');
});