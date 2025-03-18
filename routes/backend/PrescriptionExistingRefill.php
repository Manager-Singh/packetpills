<?php

// Prescription Refill  Management
Route::group(['namespace' => 'PrescriptionExistingRefill'], function () {
    Route::get('prescription/existing/refill', 'PrescriptionExistingRefillController@index')->name('prescription.existing.refill.index');

    //For DataTables
    Route::post('prescription/existing/refill/get', 'PrescriptionExistingRefillTableController')->name('prescription.existing.refill.get');
});
