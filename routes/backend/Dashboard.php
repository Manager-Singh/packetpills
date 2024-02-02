<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::post('get-permission', 'DashboardController@getPermissionByRole')->name('get.permission');

// Edit Profile
/* Route::get('profile/edit', 'DashboardController@editProfile')->name('profile.edit');
Route::patch('profile/update', 'DashboardController@updateProfile')
    ->name('profile.update'); */


Route::get('setting', 'DashboardController@setting')->name('setting');
Route::post('setting/add', 'DashboardController@setting')->name('setting.store');
