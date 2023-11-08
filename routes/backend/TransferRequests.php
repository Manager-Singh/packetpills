<?php

// TransferRequests Management
Route::group(['namespace' => 'TransferRequests'], function () {
    Route::resource('transfer-requests', 'TransferRequestsController', ['except' => ['']]);

    //For DataTables
    Route::post('transfer-requests/get', 'TransferRequestsTableController')->name('transfer.request.get');
});
