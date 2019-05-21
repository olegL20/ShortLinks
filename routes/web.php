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

Route::group(['prefix' => 'convert'], function () {
    Route::get('/', 'ShortLinkController@index')->name('url-converter');
    Route::post('/', 'ShortLinkController@convert')->name('convert');
});

Route::get('{link}', 'ShortLinkController@redirect')->name('redirect-to-link');
