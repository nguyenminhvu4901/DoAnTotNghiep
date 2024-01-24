<?php

use App\Http\Controllers\Frontend\Staff\ImportStaffController;
use \App\Http\Controllers\Frontend\Staff\StaffController;
use Tabuna\Breadcrumbs\Trail;
use \App\Http\Controllers\Frontend\Staff\ExportStaffController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::group(['as' => 'staff.', 'prefix' => 'staff', 'middleware' => ['auth', 'permission:user.management.staff', 'is_admin']], function () {
    Route::get('index', [StaffController::class, 'index'])->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Staff management'), route('frontend.staff.index'));
        });

    Route::get('create', [StaffController::class, 'create'])->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Staff management'), route('frontend.staff.index'))
                ->push(__('Create New Staff'));
        });

    Route::post('', [StaffController::class, 'store'])
        ->name('store');

    Route::get('{id}/show', [StaffController::class, 'show'])->name('show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Staff management'), route('frontend.staff.index'))
                ->push(__('Staff Information'));
        });

    Route::get('{id}/edit', [StaffController::class, 'edit'])->name('edit')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Staff management'), route('frontend.staff.index'))
                ->push(__('Update Information Staff'));
        });

    Route::put('{id}/update', [StaffController::class, 'update'])->name('update');

    Route::delete('{id}/destroy', [StaffController::class, 'destroy'])->name('destroy');

    Route::get('trash', [StaffController::class, 'getAllStaffInTrash'])->name('trash')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Staff management'), route('frontend.staff.index'))
                ->push(__('Achieve Staff management'));
        });

    Route::get('{id}/show-staff-in-trash', [StaffController::class, 'showStaffInTrash'])->name('showStaffInTrash')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Staff management'), route('frontend.staff.index'))
                ->push(__('Achieve Staff management'), route('frontend.staff.trash'))
                ->push(__('Staff Information in trash'));
        });

    Route::get('{id}/restore', [StaffController::class, 'restoreStaff'])->name('restore');

    Route::get('{id}/force-delete', [StaffController::class, 'forceDeleteStaff'])->name('forceDelete');

    //Import
    Route::get('downloadTemplate', [ImportStaffController::class, 'downloadTemplate'])
        ->name('downloadTemplate');

    Route::post('check-staff-email-exists', [ImportStaffController::class, 'checkStaffEmailExists'])
        ->name('checkStaffEmailExists');

    Route::get('/import-staff', [ImportStaffController::class, 'importStaff'])->name('importStaff')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent(homeRoute())
                ->push(__('Staff management'), route('frontend.staff.index'))
                ->push(__('Import Staff'));
        });

    Route::post('/store-import', [ImportStaffController::class, 'store'])->name('store');

    Route::get('/export-staff', [ExportStaffController::class, 'exportStaff'])->name('exportStaff');
});
