<?php

// Prescriptions Management
Route::group(['namespace' => 'EnterpriseConnects'], function () {
    Route::resource('enterpriseconnects', 'EnterpriseConnectsController', ['except' => ['']]);
    //For DataTables
    Route::post('enterpriseconnects/get', 'EnterpriseConnectsTableController')->name('enterprise.connect.get');
});
