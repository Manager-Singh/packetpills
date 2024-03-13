<?php

// Prescription Refill  Management
Route::group(['namespace' => 'PrescriptionRefill'], function () {
    Route::get('prescription/refill', 'PrescriptionRefillController@index')->name('prescription.refill.index');

    //For DataTables
    Route::post('prescription/refill/get', 'PrescriptionRefillTableController')->name('prescription.refill.get');
});
