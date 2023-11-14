<?php

use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;


Route::middleware('teacher')->group(function () {
  Route::get(
      '/class/{class}/edit',
      [CourseClassController::class, 'edit']
  )->middleware(['auth', 'verified']);
  
  Route::post(
      '/class/{class}/edit',
      [CourseClassController::class, 'store']
  )->middleware(['auth', 'verified']);

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
      '/section/{section}/store-sub',
      [SectionController::class, 'storeSub']
  )->middleware(['auth', 'verified']);
});