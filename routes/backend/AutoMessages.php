<?php

// Prescriptions Management
Route::group(['namespace' => 'AutoMessages'], function () {
    Route::resource('auto-messages', 'AutoMessagesController', ['except' => ['']]);
    //For DataTables
    Route::post('auto-messages/get', 'AutoMessagesTableController')->name('autoMessages.get');
   // Route::post('preciption-types/deleted', 'PreciptionTypesController')->name('preciption-types.deleted');
    
});
