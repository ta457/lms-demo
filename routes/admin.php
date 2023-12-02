<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminFacultiesController;
use App\Http\Controllers\Admin\AdminCoursesController;
use App\Http\Controllers\Admin\AdminClassesController;
use App\Http\Controllers\AdminSettingController;

//admin-dashboard routes
Route::middleware('admin')->group(function () {
    Route::get('/admin-dashboard', function () {
        return redirect('/admin-dashboard/users');
    })->name('admin');

    // Admin user CRUD routes =========================================================
    Route::get(
        '/admin-dashboard/users',
        [AdminUsersController::class, 'index']
    );
    Route::post(
        '/admin-dashboard/users',
        [AdminUsersController::class, 'store']
    );
    Route::delete(
        '/admin-dashboard/users/{user}',
        [AdminUsersController::class, 'destroy']
    );
    Route::post(
        '/admin-dashboard/users/destroy-all',
        [AdminUsersController::class, 'destroyAll']
    );
    Route::get(
        '/admin-dashboard/users/{user}',
        [AdminUsersController::class, 'edit']
    );
    Route::patch(
        '/admin-dashboard/users/{user}',
        [AdminUsersController::class, 'update']
    );


    // Admin Faculty CRUD routes ======================================================
    Route::get(
        '/admin-dashboard/faculties',
        [AdminFacultiesController::class, 'index']
    );
    Route::post(
        '/admin-dashboard/faculties',
        [AdminFacultiesController::class, 'store']
    );
    Route::delete(
        '/admin-dashboard/faculties/{faculty}',
        [AdminFacultiesController::class, 'destroy']
    );
    Route::get(
        '/admin-dashboard/faculties/{faculty}',
        [AdminFacultiesController::class, 'edit']
    );
    Route::patch(
        '/admin-dashboard/faculties/{faculty}',
        [AdminFacultiesController::class, 'update']
    );
    Route::post(
        '/admin-dashboard/faculties/destroy-all',
        [AdminFacultiesController::class, 'destroyAll']
    );

    // Admin course CRUD routes =======================================================
    Route::get(
        '/admin-dashboard/courses',
        [AdminCoursesController::class, 'index']
    );
    Route::post(
        '/admin-dashboard/courses',
        [AdminCoursesController::class, 'store']
    );
    Route::delete(
        '/admin-dashboard/courses/{course}',
        [AdminCoursesController::class, 'destroy']
    );
    Route::get(
        '/admin-dashboard/courses/{course}',
        [AdminCoursesController::class, 'edit']
    );
    Route::patch(
        '/admin-dashboard/courses/{course}',
        [AdminCoursesController::class, 'update']
    );
    Route::post(
        '/admin-dashboard/courses/destroy-all',
        [AdminCoursesController::class, 'destroyAll']
    );

    // Admin class CRUD routes =====================================================

    Route::get(
        '/admin-dashboard/classes',
        [AdminClassesController::class, 'index']
    );
    Route::post(
        '/admin-dashboard/classes',
        [AdminClassesController::class, 'store']
    );
    Route::delete(
        '/admin-dashboard/classes/{class}',
        [AdminClassesController::class, 'destroy']
    );
    Route::get(
        '/admin-dashboard/classes/{class}',
        [AdminClassesController::class, 'edit']
    );
    Route::patch(
        '/admin-dashboard/classes/{class}',
        [AdminClassesController::class, 'update']
    );
    Route::post(
        '/admin-dashboard/classes/destroy-all',
        [AdminClassesController::class, 'destroyAll']
    );
    Route::get(
        '/admin-dashboard/classes/{class}/members',
        [AdminClassesController::class, 'editClassMembers']
    );

    Route::patch(
        '/admin-dashboard/classes/{class}/update-members',
        [AdminClassesController::class, 'handleUpdateMemberRequest']
    );

    // Admin settings

    Route::get(
        '/admin-dashboard/settings',
        [AdminSettingController::class, 'index']
    );
    Route::patch(
        '/admin-dashboard/settings',
        [AdminSettingController::class, 'update']
    );
});
