<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

//when open dashboard, call index() of the controller
Route::get('/dashboard', 
    [DashboardController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard');

//when open admin-dashboard, call admin() method of the controller
Route::get('/admin-dashboard', function() {
    return redirect('/admin-dashboard/users');
})->middleware(['admin']);

Route::get('/admin-dashboard/users', 
    [AdminDashboardController::class, 'index']
)->middleware(['admin'])->name('adminUsers');

Route::get('/admin-dashboard/faculties', 
    [AdminDashboardController::class, 'faculties']
)->middleware(['admin'])->name('adminFaculties');

Route::get('/admin-dashboard/courses', 
    [AdminDashboardController::class, 'courses']
)->middleware(['admin'])->name('adminCourses');

Route::get('/admin-dashboard/classes', 
    [AdminDashboardController::class, 'classes']
)->middleware(['admin'])->name('adminClasses');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
