<?php

// Order Management
Route::group(['namespace' => 'Orders'], function () {
    Route::resource('orders', 'OrdersController', ['except' => ['']]);

    //For DataTables
    Route::post('orders/get', 'OrdersTableController')->name('orders.get');
});
