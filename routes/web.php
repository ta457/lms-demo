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

//admin-dashboard routes
Route::middleware('admin')->group(function () {
    Route::get('/admin-dashboard', function() {
        return redirect('/admin-dashboard/users');
    });
    Route::get('/admin-dashboard/users', 
        [AdminDashboardController::class, 'users']
    );
    Route::post('/admin-dashboard/users', 
        [AdminDashboardController::class, 'storeUser']
    );
    Route::delete('/admin-dashboard/users/{user}', 
        [AdminDashboardController::class, 'destroyUser']
    );
    Route::get('/admin-dashboard/users/{user}/edit', 
        [AdminDashboardController::class, 'editUser']
    );
    Route::patch('/admin-dashboard/users/{user}', 
        [AdminDashboardController::class, 'updateUser']
    );

    Route::get('/admin-dashboard/faculties', 
        [AdminDashboardController::class, 'faculties']
    );
    Route::post('/admin-dashboard/faculties', 
        [AdminDashboardController::class, 'storeFaculty']
    );
    Route::delete('/admin-dashboard/faculties/{faculty}', 
        [AdminDashboardController::class, 'destroyFaculty']
    );
    Route::get('/admin-dashboard/faculties/{faculty}/edit', 
        [AdminDashboardController::class, 'editFaculty']
    );
    Route::patch('/admin-dashboard/faculties/{faculty}', 
        [AdminDashboardController::class, 'updateFaculty']
    );

    Route::get('/admin-dashboard/courses', 
        [AdminDashboardController::class, 'courses']
    );
    Route::post('/admin-dashboard/courses', 
        [AdminDashboardController::class, 'storeCourse']
    );
    Route::delete('/admin-dashboard/courses/{course}', 
        [AdminDashboardController::class, 'destroyCourse']
    );
    Route::get('/admin-dashboard/courses/{course}/edit', 
        [AdminDashboardController::class, 'editCourse']
    );
    Route::patch('/admin-dashboard/courses/{course}', 
        [AdminDashboardController::class, 'updateCourse']
    );

    Route::get('/admin-dashboard/classes', 
        [AdminDashboardController::class, 'classes']
    );
    Route::post('/admin-dashboard/classes', 
        [AdminDashboardController::class, 'storeClass']
    );
    Route::delete('/admin-dashboard/classes/{class}', 
        [AdminDashboardController::class, 'destroyClass']
    );
    Route::get('/admin-dashboard/classes/{class}/edit', 
        [AdminDashboardController::class, 'editClass']
    );
    Route::patch('/admin-dashboard/classes/{class}', 
        [AdminDashboardController::class, 'updateClass']
    );
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
