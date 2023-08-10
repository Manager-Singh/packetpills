<?php

// Drugs Management
Route::group(['namespace' => 'Drugs'], function () {
    Route::resource('drugs', 'DrugsController', ['except' => ['show']]);

    //For DataTables
    Route::post('drugs/get', 'DrugsTableController')
        ->name('drugs.get');
});
