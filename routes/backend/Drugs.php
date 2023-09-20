<?php
use App\Http\Controllers\Backend\Drugs\DrugsController;

// Drugs Management
Route::group(['namespace' => 'Drugs'], function () {
    Route::resource('drugs', 'DrugsController', ['except' => ['show']]);

    //For DataTables
    Route::post('drugs/get', 'DrugsTableController')
        ->name('drugs.get');
    Route::get('drugs/image/{id}', [DrugsController::class, 'delete_image'])->name('drugs.image.remove');
    Route::post('drugs/attribute', [DrugsController::class, 'create_attribute'])->name('drugs.create.attribute');
});
