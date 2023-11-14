<?php

// TransferRequests Management
Route::group(['namespace' => 'TransferRequests'], function () {
    Route::resource('transfer-requests', 'TransferRequestsController', ['except' => ['']]);

    //For DataTables
    Route::post('transfer-requests/get', 'TransferRequestsTableController')->name('transfer.request.get');
    Route::post('transfer-requests/fax-number/update', 'TransferRequestsController@faxNumberUpdate')->name('transfer.fax.number.update');

        
});
