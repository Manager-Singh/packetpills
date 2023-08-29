<?php

// Prescriptions Management
Route::group(['namespace' => 'Prescriptions'], function () {
    Route::resource('prescriptions', 'PrescriptionsController', ['except' => ['']]);

    //For DataTables
    Route::post('prescriptions/get', 'PrescriptionsTableController')->name('prescriptions.get');
});
