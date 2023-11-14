<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/home', function () {
//     return view('welcome');
// })->name('home');

//if it's a guess, always open login page
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

//if user is logged in, redirect to dashboard or admin-dashboard
Route::get('/', function() {
    if (auth()->user()?->username !== 'admin') {
        return redirect('/dashboard');
    } else {
        return redirect('/admin-dashboard/users');
    }
})->middleware(['auth', 'verified']);

Route::get('/dashboard', 
    [DashboardController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/class/{class}',
    [CourseClassController::class, 'index']
)->middleware(['auth', 'verified']);
Route::get('/class/{class}/edit',
    [CourseClassController::class, 'edit']
)->middleware(['auth', 'verified']);
Route::post('/class/{class}/edit',
    [CourseClassController::class, 'store']
)->middleware(['auth', 'verified']);

Route::post('/section/{section}/store-link', 
    [SectionController::class, 'storeLink']
)->middleware(['auth', 'verified']);

Route::post('/section/{section}/store-text', 
    [SectionController::class, 'storeText']
)->middleware(['auth', 'verified']);

Route::post('/section/{section}/store-file', 
    [SectionController::class, 'storeFile']
)->middleware(['auth', 'verified']);

Route::post('/section/{section}/store-sub', 
    [SectionController::class, 'storeSub']
)->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';