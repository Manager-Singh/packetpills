<?php

use App\Http\Controllers\Backend\Auth\Role\RoleController;
use App\Http\Controllers\Backend\Auth\User\UserConfirmationController;
use App\Http\Controllers\Backend\Auth\User\UserController;
use App\Http\Controllers\Backend\Auth\User\UserPasswordController;
use App\Http\Controllers\Backend\Auth\User\UserSessionController;
use App\Http\Controllers\Backend\Auth\User\UserSocialController;
use App\Http\Controllers\Backend\Auth\User\UserStatusController;

// All route names are prefixed with 'admin.auth'.
Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
    'namespace' => 'Auth',
    'middleware' => 'access.routeNeedsPermission:view-access-management',
], function () {
    // User Management
    Route::group(['namespace' => 'User'], function () {
        // For DataTables
        Route::post('user/get', 'UserTableController')->name('user.get');
        Route::post('user/member/get', 'UserTableController')->name('user.member.get');
        Route::post('user/employee/get', 'UserTableController')->name('user.employee.get');

        // User Status'
        Route::get('user/deactivated', [UserStatusController::class, 'getDeactivated'])->name('user.deactivated');
        Route::get('user/employee/get', [UserController::class, 'getEmployee'])->name('user.employee');
        Route::get('user/deleted', [UserStatusController::class, 'getDeleted'])->name('user.deleted');

        // User CRUD
        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::get('user/create', [UserController::class, 'create'])->name('user.create');
        
        Route::post('user', [UserController::class, 'store'])->name('user.store');
        Route::get('user/employee/create', [UserController::class, 'createEmployee'])->name('user.employee.create');
        
        Route::post('user/employee', [UserController::class, 'storeEmployee'])->name('user.employee.store');
        Route::post('user/create/prescription', [UserController::class, 'create_prescription'])->name('user.create.prescription');
        Route::post('user/create/healthcard', [UserController::class, 'create_healthcard'])->name('user.create.healthcard');
        Route::post('user/create/insurance', [UserController::class, 'create_insurance'])->name('user.create.insurance');
        Route::post('user/create/address', [UserController::class, 'create_address'])->name('user.create.address');
        Route::post('user/create/healthinformation', [UserController::class, 'healthinformation'])->name('user.create.healthinformation');
        Route::post('user/create/paymentmethod', [UserController::class, 'paymentmethod'])->name('user.create.paymentmethod');
        Route::post('user/edit/paymentmethod', [UserController::class, 'edit_paymentmethod'])->name('user.edit.paymentmethod');
        Route::get('user/delete/address/{id}', [UserController::class, 'delete_address'])->name('user.create.address.remove');
        Route::get('user/delete/payment/method/{id}', [UserController::class, 'delete_payment_method'])->name('user.paymentmethod.remove');
        Route::post('user/create/address/edit', [UserController::class, 'edit_address'])->name('user.edit.address');
        Route::post('user/create/medication', [UserController::class, 'create_medication'])->name('user.create.medication');
        Route::post('user/send/message', [UserController::class, 'send_message'])->name('user.send.message');
        Route::post('user/update/insurance/status', [UserController::class, 'send_insurance_status'])->name('user.update.insurance.status');
        Route::post('user/prescription/update/status', [UserController::class, 'prescriptionStatusUpdate'])->name('user.prescription.update.status');
        Route::post('user/create/medication/order', [UserController::class, 'createMedicationOrder'])->name('user.create.medication.order');
        Route::post('user/order/update/status', [UserController::class, 'orderStatusUpdate'])->name('user.order.update.status');
        Route::post('user/transfer/update/status', [UserController::class, 'transferStatusUpdate'])->name('user.transfer.update.status');
        Route::post('user/prescription/refill/update/status', [UserController::class, 'prescriptionRefillStatusUpdate'])->name('user.prescription.refill.status');
        Route::post('user/prescription/refill/deleted', [UserController::class, 'prescriptionMedicationDeleted'])->name('user.prescription.refill.deleted');
        Route::post('user/existing/refill/update/status', [UserController::class, 'existingRefillStatusUpdate'])->name('user.existing.refill.update.status');
        Route::group(['prefix' => 'user/{user}/employee'], function () {
            // User
            Route::get('/', [UserController::class, 'showEmployee'])->name('user.employee.show');
            Route::get('edit', [UserController::class, 'editEmployee'])->name('user.employee.edit');
            Route::patch('/', [UserController::class, 'updateEmployee'])->name('user.employee.update');
            Route::delete('/', [UserController::class, 'destroyEmployee'])->name('user.employee.delete');
            Route::get('password/change', [UserPasswordController::class, 'editEmployee'])->name('user.employee.change-password');
            Route::patch('password/change', [UserPasswordController::class, 'updateEmployee'])->name('user.employee.change-password.post');
        });
        // Specific User
        Route::group(['prefix' => 'user/{user}'], function () {
            // User
            Route::get('/', [UserController::class, 'show'])->name('user.show');
            Route::get('edit', [UserController::class, 'edit'])->name('user.edit');
            Route::patch('/', [UserController::class, 'update'])->name('user.update');
            Route::delete('/', [UserController::class, 'destroy'])->name('user.destroy');

            Route::get('members', [UserController::class, 'members'])->name('user.members');
            Route::get('member/create', [UserController::class, 'memberCreate'])->name('member.create');
            // Account
            Route::get('account/confirm/resend', [UserConfirmationController::class, 'sendConfirmationEmail'])->name('user.account.confirm.resend');

            // Status
            Route::get('mark/{status}', [UserStatusController::class, 'mark'])->name('user.mark')->where(['status' => '[0,1]']);

            // Social
            Route::delete('social/{social}/unlink', [UserSocialController::class, 'unlink'])->name('user.social.unlink');

            // Confirmation
            Route::get('confirm', [UserConfirmationController::class, 'confirm'])->name('user.confirm');
            Route::get('unconfirm', [UserConfirmationController::class, 'unconfirm'])->name('user.unconfirm');

            // Password
            Route::get('password/change', [UserPasswordController::class, 'edit'])->name('user.change-password');
            Route::patch('password/change', [UserPasswordController::class, 'update'])->name('user.change-password.post');

            // log in as
            Route::get('login-as', 'UserAccessController@loginAs')->name('user.login-as');

            // Session
            Route::get('clear-session', [UserSessionController::class, 'clearSession'])->name('user.clear-session');

            // Deleted
            Route::delete('delete-permanently', [UserStatusController::class, 'delete'])->name('user.delete-permanently');
            Route::post('restore', [UserStatusController::class, 'restore'])->name('user.restore');
        });
    });

    // Role Management
    Route::group(['namespace' => 'Role'], function () {
        Route::get('role', [RoleController::class, 'index'])->name('role.index');
        Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('role', [RoleController::class, 'store'])->name('role.store');

        Route::group(['prefix' => 'role/{role}'], function () {
            Route::get('edit', [RoleController::class, 'edit'])->name('role.edit');
            Route::patch('/', [RoleController::class, 'update'])->name('role.update');
            Route::delete('/', [RoleController::class, 'destroy'])->name('role.destroy');
        });

        // For DataTables
        Route::post('role/get', 'RoleTableController')->name('role.get');
    });

    // Permission Management
    Route::group(['namespace' => 'Permission'], function () {
        Route::resource('permission', 'PermissionsController', ['except' => ['show']]);

        //For DataTables
        Route::post('permission/get', 'PermissionTableController')->name('permission.get');
    });
});
