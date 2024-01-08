<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCoursesController extends Controller
{
    public function index()
    {
        $courses = Course::oldest();
        if(request('sort_by_time') == 'latest') {
            $courses = Course::latest();
        }

        if(request('search')) {
            $courses->where('course_name', 'like', '%' . request('search') . '%');
        }
        if(request('faculty_id')) {
            $courses->where('faculty_id', 'like', '%' . request('faculty_id') . '%');
        }

        //return view
        $props = [
            'courses' => $courses->paginate(10),
            'faculties' => Faculty::get()
        ];
        return view('admin.admin-courses', ['props' => $props]);
    }

    public function store() 
    {
        $attributes = request()->validate([
            'course_name' => 'required|max:255',
            'faculty_id' => 'required',
        ]);
        $attributes['faculty_id'] = $attributes['faculty_id'] * 1;
        if (!(Course::where('course_name', $attributes['course_name'])->get()->count() > 0)) {
            Course::create($attributes);
            return redirect('/admin-dashboard/courses')->with('success', 'New course added');
        } else {
            return redirect('/admin-dashboard/courses')->with('failed', 'Course name\'s already existed');
        }
    }

    public function edit(Course $course) {
        $props = [
            'course' => $course,
            'faculties' => Faculty::get()
        ];
        return view('admin.edit-course', [
            'props' => $props
        ]);
    }

    public function update(Course $course) 
    {
        $attributes = request()->validate([
            'course_name' => 'required|max:255',
            'faculty_id' => 'required|numeric'
        ]);
        $attributes['faculty_id'] = $attributes['faculty_id'] * 1;
        $course->update($attributes);

        if (request()->img) {
            $attributes = request()->validate([
                'img' => 'image|max:2048'
            ]);
            $attributes['img'] = request()->file('img')->store('courses-bg');
            if($course->img) {
                Storage::delete($course->img);
            }
            $course->update($attributes);
        }

        return redirect("/admin-dashboard/courses/$course->id")->with('success', 'Your changes have been saved');
    }

    public function destroy(Course $course)
    {
        if ($course->id !== 1) {
            //reassign all classes to course 1
            $classes = $course->classes;
            foreach ($classes as $class) {
                $class->update(['course_id' => 1]);
            }
            $course->delete();
            return redirect('/admin-dashboard/courses')->with('success', 'Course deleted');
        } else {
            return redirect('/admin-dashboard/courses')->with('failed', 'Can\'t delete protected record');
        }
    }

    public function destroyAll(Request $request)
    {
        $selectedCourses = $request->input('selected', []);
        
        $courses = Course::whereIn('id', $selectedCourses)->get();

        $flag = 0;
        foreach ($courses as $course) {
            if ($course->id == 1) {
                $flag = 1; continue;
            }
            $this->destroy($course);
        }
        $message = ['success', 'Selected courses have been deleted'];
        if ($flag == 1) $message = ['failed', 'Can\'t delete protected record'];
        return redirect('/admin-dashboard/courses')->with($message[0],$message[1]);
    }
}
