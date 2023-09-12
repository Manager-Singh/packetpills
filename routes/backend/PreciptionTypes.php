<?php

// Prescriptions Management
Route::group(['namespace' => 'PreciptionTypes'], function () {
    Route::resource('preciption-types', 'PreciptionTypesController', ['except' => ['']]);
    //For DataTables
    Route::post('preciption-types/get', 'PreciptionTypesTableController')->name('preciptionTypes.get');
   // Route::post('preciption-types/deleted', 'PreciptionTypesController')->name('preciption-types.deleted');
    
});
