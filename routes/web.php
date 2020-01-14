<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'backend', 'middleware' => ['role:backend']], function () {
    Route::get('/', 'Backend\BackendController@index')->name('index-backend');

    // Silkroad
    Route::group(['prefix' => 'silkroad'], function () {
        Route::get('/user', 'Backend\SilkroadController@indexSroUser')->name('sro-user-index-user-backend');
        Route::get('/user-datatables', 'Backend\SilkroadController@sroUserDatatables')->name('sro-user-datatables-backend');
        Route::get('/user/{user}/edit', 'Backend\SilkroadController@sroUserEdit')->name('sro-user-edit-backend');

        Route::get('/players', 'Backend\SilkroadController@indexSroPlayer')->name('sro-players-index-backend');
        Route::get('/players-datatables', 'Backend\SilkroadController@SroPlayerDatatables')->name('sro-players-datatables-backend');
        Route::get('/players/{char}/edit', 'Backend\SilkroadController@sroPlayerEdit')->name('sro-players-edit-backend');
    });

    Route::group(['prefix' => 'web'], function () {
        Route::get('/downloads', 'Backend\DownloadsController@index')->name('downloads-index-backend');
        Route::get('/downloads/add', 'Backend\DownloadsController@create')->name('downloads-create-backend');

        Route::get('/downloads/create', 'Backend\DownloadsController@show')->name('downloads-show-backend');
        Route::post('/downloads/create', 'Backend\DownloadsController@create')->name('downloads-create-backend');

        Route::get('/downloads/{download}/edit', 'Backend\DownloadsController@edit')->name('downloads-edit-backend');
        Route::patch('/downloads/{download}/update', 'Backend\DownloadsController@update')->name('downloads-update-backend');

        Route::post('/downloads/{download}/destroy', 'Backend\DownloadsController@destroy')->name('downloads-destroy-backend');
    });

    // Logging
    Route::get('/smc-log', 'Backend\BackendController@smclogIndex')->name('smclog-index-backend');
    Route::get('/smc-log-datatables', 'Backend\BackendController@smclogDatatables')->name('smclog-datatables-backend');
});
