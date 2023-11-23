<?php

use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudenSubmissionController;
use Illuminate\Support\Facades\Route;


Route::middleware('teacher')->group(function () {
    // return class view (class sections) 
    Route::get(
        '/class/{class}/edit',
        [CourseClassController::class, 'edit']
    )->middleware(['auth', 'verified']);

    //store new section to class
    Route::post(
        '/class/{class}/edit',
        [CourseClassController::class, 'store']
    )->middleware(['auth', 'verified']);
    
    //return edit section view
    Route::get(
        '/section/{section}/edit',
        [SectionController::class, 'edit']
    )->middleware(['auth', 'verified']);
    
    //update & delete section
    Route::patch(
        '/section/{section}/edit',
        [SectionController::class, 'update']
    )->middleware(['auth', 'verified']);

    Route::delete(
        '/section/{section}',
        [SectionController::class, 'destroy']
    )->middleware(['auth', 'verified']);

    //store new link / text / file / assignment subsection to section
    Route::post(
        '/section/{section}/store-link',
        [SectionController::class, 'storeLink']
    )->middleware(['auth', 'verified']);

    Route::post(
        '/section/{section}/store-text',
        [SectionController::class, 'storeText']
    )->middleware(['auth', 'verified']);

    Route::post(
        '/section/{section}/store-file',
        [SectionController::class, 'storeFile']
    )->middleware(['auth', 'verified']);

    Route::post(
        '/section/{section}/store-assignment',
        [SectionController::class, 'storeAssignment']
    )->middleware(['auth', 'verified']);

    //edit, update, delete link subsection =======================================

    Route::get(
        '/subsection/{subsection}/edit-link',
        [SectionController::class, 'editLink']
    )->middleware(['auth', 'verified']);
    
    Route::patch(
        '/subsection/{subsection}/edit-link',
        [SectionController::class, 'updateLink']
    )->middleware(['auth', 'verified']);

    Route::delete(
        '/subsection/{subsection}',
        [SectionController::class, 'destroySubsection']
    )->middleware(['auth', 'verified']);

    //edit, update, delete text subsection ==========================================

    Route::get(
        '/subsection/{subsection}/edit-text',
        [SectionController::class, 'editText']
    )->middleware(['auth', 'verified']);

    Route::patch(
        '/subsection/{subsection}/edit-text',
        [SectionController::class, 'updateText']
    )->middleware(['auth', 'verified']);

    //edit, update, delete file subsection =========================================

    Route::get(
        '/subsection/{subsection}/edit-file',
        [SectionController::class, 'editFile']
    )->middleware(['auth', 'verified']);

    Route::patch(
        '/subsection/{subsection}/edit-file',
        [SectionController::class, 'updateFile']
    )->middleware(['auth', 'verified']);

    //edit, update, delete assignment subsection ====================================

    Route::get(
        '/subsection/{subsection}/edit-assignment',
        [SectionController::class, 'editAssignment']
    )->middleware(['auth', 'verified']);

    Route::patch(
        '/subsection/{subsection}/edit-assignment',
        [SectionController::class, 'updateAssignment']
    )->middleware(['auth', 'verified']);

    //view student submissions =====================================================
    Route::get(
        '/assignment/{subsection}/view-submissions',
        [StudenSubmissionController::class, 'index']
    )->middleware(['auth', 'verified']);
});
