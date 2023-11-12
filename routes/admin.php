<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminFacultiesController;
use App\Http\Controllers\Admin\AdminCoursesController;
use App\Http\Controllers\Admin\AdminClassesController;

//admin-dashboard routes
Route::middleware('admin')->group(function () {
  Route::get('/admin-dashboard', function() {
      return redirect('/admin-dashboard/users');
  });
  Route::get('/admin-dashboard/users', 
      [AdminUsersController::class, 'index']
  );
  Route::post('/admin-dashboard/users', 
      [AdminUsersController::class, 'store']
  );
  Route::delete('/admin-dashboard/users/{user}', 
      [AdminUsersController::class, 'destroy']
  );
  Route::get('/admin-dashboard/users/{user}/edit', 
      [AdminUsersController::class, 'edit']
  );
  Route::patch('/admin-dashboard/users/{user}', 
      [AdminUsersController::class, 'update']
  );

  Route::get('/admin-dashboard/faculties', 
      [AdminFacultiesController::class, 'index']
  );
  Route::post('/admin-dashboard/faculties', 
      [AdminFacultiesController::class, 'store']
  );
  Route::delete('/admin-dashboard/faculties/{faculty}', 
      [AdminFacultiesController::class, 'destroy']
  );
  Route::get('/admin-dashboard/faculties/{faculty}/edit', 
      [AdminFacultiesController::class, 'edit']
  );
  Route::patch('/admin-dashboard/faculties/{faculty}', 
      [AdminFacultiesController::class, 'update']
  );

  Route::get('/admin-dashboard/courses', 
      [AdminCoursesController::class, 'index']
  );
  Route::post('/admin-dashboard/courses', 
      [AdminCoursesController::class, 'store']
  );
  Route::delete('/admin-dashboard/courses/{course}', 
      [AdminCoursesController::class, 'destroy']
  );
  Route::get('/admin-dashboard/courses/{course}/edit', 
      [AdminCoursesController::class, 'edit']
  );
  Route::patch('/admin-dashboard/courses/{course}', 
      [AdminCoursesController::class, 'update']
  );

  Route::get('/admin-dashboard/classes', 
      [AdminClassesController::class, 'index']
  );
  Route::post('/admin-dashboard/classes', 
      [AdminClassesController::class, 'store']
  );
  Route::delete('/admin-dashboard/classes/{class}', 
      [AdminClassesController::class, 'destroy']
  );
  Route::get('/admin-dashboard/classes/{class}/edit', 
      [AdminClassesController::class, 'edit']
  );
  Route::patch('/admin-dashboard/classes/{class}', 
      [AdminClassesController::class, 'update']
  );
});