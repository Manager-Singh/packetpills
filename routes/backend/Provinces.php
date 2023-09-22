<?php

// Prescriptions Management
Route::group(['namespace' => 'Provinces'], function () {
    Route::resource('provinces', 'ProvincesController', ['except' => ['']]);
    //For DataTables
    Route::post('provinces/get', 'ProvincesTableController')->name('provinces.get');
   // Route::post('preciption-types/deleted', 'ProvincesController')->name('preciption-types.deleted');
    
});
