<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCoursesController extends Controller
{
    public function index()
    {
        $columns = ['id','course_name', 'faculty_name'];
        $props = [
            'columns' => $columns, 
            'records' => Course::with('faculty')->paginate(10), 
            'faculties' => Faculty::get(),
            'url' => '/admin-dashboard/courses'
        ];
        return view('admin.admin-courses', [
            'props' => $props
        ]);
    }

    public function store() 
    {
        $attributes = request()->validate([
            'course_name' => 'required|max:255',
            'faculty_id' => 'required',
        ]);
        Course::create($attributes);
        return redirect('/admin-dashboard/courses');
    }

    public function edit(Course $course) {
        $props = [
            'course' => $course,
            'delete' => $course,
            'faculties' => Faculty::Get(),
            'url' => '/admin-dashboard/courses'
        ];
        return view('admin.edit-course', [
            'props' => $props
        ]);
    }

    public function update(Course $course) 
    {
        $attributes = request()->validate([
            'course_name' => 'required|max:255'
        ]);
        $course->update($attributes);
        return redirect('/admin-dashboard/courses');
    }

    public function destroy(Course $course)
    {   
        DB::delete('delete from course_classes where course_id=?', [$course->id]);
        $course->delete();
        return redirect('/admin-dashboard/courses');
    }
}
