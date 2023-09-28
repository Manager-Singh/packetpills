<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ConnectController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\PrescriptionController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'mainIndex'])->name('index');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('enterprise/connect', [ConnectController::class, 'index'])->name('enterprise.connect');
Route::post('enterprise/connect/send', [ConnectController::class, 'store'])->name('enterprise.connect.submit');


/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        // User Dashboard Specific
        Route::group(['middleware' => ['checkSteps']], function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('prescription', [DashboardController::class, 'userPrescripiton'])->name('prescription');
            Route::get('medications', [DashboardController::class, 'medications'])->name('medications');
            Route::get('orders', [DashboardController::class, 'orders'])->name('orders');
        });
        
        Route::get('prescription/upload', [PrescriptionController::class, 'prescriptionUpload'])->name('prescription.upload');
        Route::post('prescription/upload/save', [PrescriptionController::class, 'save'])->name('prescription.upload.save');

        // User Account Specific
        Route::get('account', [AccountController::class, 'index'])->name('account');
        
        // User Profile Specific
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('health-information', [DashboardController::class, 'healthInformation'])->name('health.information');
        Route::post('health-information/save', [DashboardController::class, 'healthInformationsave'])->name('health.information.save');
        Route::get('health-card', [DashboardController::class, 'healthCard'])->name('health.card');
        Route::post('health-card/save', [DashboardController::class, 'healthCardsave'])->name('health.card.save');
        Route::post('health-card/delete', [DashboardController::class, 'healthCardDelete'])->name('health.card.delete');
        Route::get('insurance', [DashboardController::class, 'insurance'])->name('insurance');
        Route::post('insurance/save', [DashboardController::class, 'insurancesave'])->name('insurance.save');
        Route::post('insurance/delete', [DashboardController::class, 'insuranceDelete'])->name('insurance.delete');
        Route::get('address', [DashboardController::class, 'address'])->name('address');
        Route::get('address/add', [DashboardController::class, 'addressAdd'])->name('address.add');
        Route::post('address/save', [DashboardController::class, 'addressSave'])->name('address.save');
        Route::post('address/delete', [DashboardController::class, 'addressDelete'])->name('address.delete');
        Route::post('address/defaultChange', [DashboardController::class, 'addressDefaultChange'])->name('address.default.change');
        Route::get('address/add', [DashboardController::class, 'addressAdd'])->name('address.add');
        Route::get('payment', [DashboardController::class, 'payment'])->name('payment');
        Route::get('payment/add', [DashboardController::class, 'paymentAdd'])->name('payment.add');
        Route::post('payment/save', [DashboardController::class, 'paymentSave'])->name('payment.save');
        Route::post('payment/delete', [DashboardController::class, 'paymentDelete'])->name('payment.delete');
        Route::post('payment/defaultChange', [DashboardController::class, 'paymentDefaultChange'])->name('payment.default.change');
        Route::get('personal-details', [DashboardController::class, 'personalDetails'])->name('personal.details');
        Route::get('drug/search', [DashboardController::class, 'drugSearch'])->name('drug.search');
        Route::get('drug/single-details/{id}', [DashboardController::class, 'drugSingleDetails'])->name('drug.single');
        Route::post('drug/get-search', [DashboardController::class, 'drugAjaxSearch'])->name('drug.ajax.search');
    });
});
