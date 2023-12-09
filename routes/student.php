<?php
use App\Http\Controllers\StudenSubmissionController;
use Illuminate\Support\Facades\Route;

Route::get(
  '/assignment/{subsection}',
  [StudenSubmissionController::class, 'index']
)->middleware(['auth', 'verified']);
Route::post(
  '/assignment/{subsection}',
  [StudenSubmissionController::class, 'store']
)->middleware(['auth', 'verified']);
Route::delete(
  '/submission/{submission}',
  [StudenSubmissionController::class, 'destroy']
)->middleware(['auth', 'verified']);