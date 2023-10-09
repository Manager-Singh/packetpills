<?php

// Prescriptions Management
Route::group(['namespace' => 'MailMessages'], function () {
    Route::resource('mail-messages', 'MailMessagesController', ['except' => ['']]);
    //For DataTables
    Route::post('mail-messages/get', 'MailMessagesTableController')->name('mailMessages.get');
   // Route::post('preciption-types/deleted', 'PreciptionTypesController')->name('preciption-types.deleted');
    
});
