<?php

use App\Http\Controllers\Frontend\Auth\ConfirmAccountController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\PasswordExpiredController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\Auth\SocialLoginController;
use App\Http\Controllers\Frontend\Auth\UpdatePasswordController;
use App\Http\Controllers\Frontend\User\DashboardController;

/*
 * Frontend Access Controllers
 * All route names are prefixed with 'frontend.auth'.
 */
Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
    // These routes require the user to be logged in
    Route::group(['middleware' => 'auth'], function () {
        Route::get('account/logout', [LoginController::class, 'logout'])->name('logout');

        // These routes can not be hit if the password is expired
        Route::group(['middleware' => 'password_expires'], function () {
            // Change Password Routes
            Route::patch('account/password/update', [UpdatePasswordController::class, 'update'])->name('password.update');
        });

        // Password expired routes
        Route::get('account/password/expired', [PasswordExpiredController::class, 'expired'])->name('password.expired');
        Route::patch('account/password/expired', [PasswordExpiredController::class, 'update'])->name('password.expired.update');
        Route::get('account/service-selection', [DashboardController::class, 'serviceSelection'])->name('service.selection');
        Route::get('account/transfer', [DashboardController::class, 'stepTransfer'])->name('step.transfer');
        Route::get('account/prescription', [DashboardController::class, 'prescription'])->name('step.prescription');
        Route::get('account/telehealth', [DashboardController::class, 'telehealth'])->name('step.telehealth');
        Route::get('account/personal', [DashboardController::class, 'personal'])->name('step.personal');
        Route::post('account/personal', [DashboardController::class, 'personal_save'])->name('step.personal.submit');
        Route::get('account/almostdone', [DashboardController::class, 'almostdone'])->name('step.almostdone');
        Route::post('account/almostdone', [DashboardController::class, 'almostdone_save'])->name('step.almostdone.submit');
        Route::get('account/create-password', [DashboardController::class, 'createPassword'])->name('step.create.password');
        Route::post('account/create-password/save', [DashboardController::class, 'createPassword_save'])->name('step.create.password.save');
        Route::get('account/profile-completed', [DashboardController::class, 'profileCompleted'])->name('step.profile.completed');
    });

    // These routes require no user to be logged in
    Route::group(['middleware' => 'guest'], function () {
        // Authentication Routes
        Route::get('account/login', [LoginController::class, 'showNewLoginForm'])->name('new.login');
        Route::get('account/new-login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('account/login', [LoginController::class, 'login'])->name('login.post');
        Route::post('account/send-otp', [LoginController::class, 'send_otp'])->name('send.otp');
        Route::post('account/verify-otp', [LoginController::class, 'verify_otp'])->name('verify.otp');


        // Socialite Routes
        Route::get('account/login/{provider}', [SocialLoginController::class, 'login'])->name('social.login');
        Route::get('account/login/{provider}/callback', [SocialLoginController::class, 'login']);

        // Registration Routes
        Route::get('account/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('account/register', [RegisterController::class, 'register'])->name('register.post');

        // Confirm Account Routes
        Route::get('account/confirm/{token}', [ConfirmAccountController::class, 'confirm'])->name('account.confirm');
        Route::get('account/confirm/resend/{uuid}', [ConfirmAccountController::class, 'sendConfirmationEmail'])->name('account.confirm.resend');

        // Password Reset Routes
        Route::get('account/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.email');
        //Route::post('account/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email.post');
        Route::post('account/password/phone', [ForgotPasswordController::class, 'sendResetLinkPhone'])->name('password.phone.post');
        Route::post('account/password/phone/verify', [ForgotPasswordController::class, 'phoneOtpVerfiy'])->name('password.phone.verify');

        Route::get('account/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
        Route::post('account/password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');
        Route::get('account/password/update-password', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');
        Route::post('account/password/update-save', [ForgotPasswordController::class, 'updateSavePassword'])->name('password.save');
        
    });
});
