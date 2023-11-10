<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use PhpParser\Builder\Class_;

class AdminDashboardController extends Controller
{   
    // public function getUser() {
    //     $userID = auth()->user()->id;
    //     return User::find($userID);
    // }

    public function getRoleName($id) {
        if ($id === 1) return 'Admin';
        if ($id === 2) return 'Student';
        if ($id === 3) return 'Teacher';
    }

    public function users()
    {   
        $records = User::get();
        $faculties = Faculty::get();
        $columns = ['id','name','username','email','role','faculty'];
        $data = [];
        //dd($faculty->where('id', $records[1]->faculty_id)[0]->faculty_name);
        foreach ($records as $record) {
            $data[] = array_combine($columns, [
                $record->id,
                $record->name,
                $record->username,
                $record->email,
                $this->getRoleName($record->role),
                $faculties->where('id', $record->faculty_id)->first()->faculty_name ?? 'NULL'
            ]);
        }
        //$admin = array_shift($data);
        $props = [
            'columns' => $columns, 
            'data' => $data, 
            'faculties' => $faculties,
            'url' => '/admin-dashboard/users'
        ];
        return view('admin.admin-users', [
            'props' => $props
        ]);
    }

    public function storeUser() 
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255',
            'faculty_id' => 'required',
            'role' => 'required'
        ]);
        $attributes['role'] = $attributes['role'] * 1;
        $attributes['faculty_id'] = $attributes['faculty_id'] * 1;
        User::create($attributes);
        return redirect('/admin-dashboard/users');
    }

    public function editUser(User $user) {
        $props = [
            'user' => $user,
            'faculties' => Faculty::Get()
        ];
        return view('admin.edit-user', [
            'props' => $props
        ]);
    }

    public function updateUser(User $user) 
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'faculty_id' => 'required',
            'role' => 'required'
        ]);
        $attributes['role'] = $attributes['role'] * 1;
        $attributes['faculty_id'] = $attributes['faculty_id'] * 1;
        $user->update($attributes);
        return redirect('/admin-dashboard/users');
    }

    public function destroyUser(User $user)
    {
        if($user->role !== 1) {
            $user->delete();
        }
        return redirect('/admin-dashboard/users');
    }

    public function faculties()
    {
        $records = Faculty::get();
        $columns = ['id','faculty_name'];
        $data = [];
        foreach ($records as $record) {
            $data[] = array_combine($columns, [
                $record->id,
                $record->faculty_name
            ]);
        }
        $props = [
            'columns' => $columns, 
            'data' => $data,
            'url' => '/admin-dashboard/faculties'
        ];
        return view('admin.admin-faculties', [
            'props' => $props
        ]);
    }

    public function storeFaculty() 
    {
        $attributes = request()->validate([
            'faculty_name' => 'required|max:255'
        ]);
        Faculty::create($attributes);
        return redirect('/admin-dashboard/faculties');
    }

    public function editFaculty(Faculty $faculty) {
        $props = [
            'faculty' => $faculty
        ];
        return view('admin.edit-faculty', [
            'props' => $props
        ]);
    }

    public function updateFaculty(Faculty $faculty) 
    {
        $attributes = request()->validate([
            'faculty_name' => 'required|max:255'
        ]);
        $faculty->update($attributes);
        return redirect('/admin-dashboard/faculties');
    }

    public function destroyFaculty(Faculty $faculty)
    {
        $faculty->delete();
        return redirect('/admin-dashboard/faculties');
    }

    public function courses()
    {
        $faculties = Faculty::get();
        $records = Course::get();
        $columns = ['id','course_name', 'faculty'];
        $data = [];
        //dd($faculty->where('id', $records[0]->faculty_id)[0]->faculty_name);
        foreach ($records as $record) {
            $data[] = array_combine($columns, [
                $record->id,
                $record->course_name,
                $faculties->where('id', $record->faculty_id)->first()->faculty_name
            ]);
        }
        $props = [
            'columns' => $columns, 
            'data' => $data, 
            'faculties' => $faculties,
            'url' => '/admin-dashboard/courses'
        ];
        return view('admin.admin-courses', [
            'props' => $props
        ]);
    }

    public function storeCourse() 
    {
        $attributes = request()->validate([
            'course_name' => 'required|max:255',
            'faculty_id' => 'required',
        ]);
        Course::create($attributes);
        return redirect('/admin-dashboard/courses');
    }

    public function editCourse(Course $course) {
        $props = [
            'course' => $course,
            'faculties' => Faculty::Get(),
        ];
        return view('admin.edit-course', [
            'props' => $props
        ]);
    }

    public function updateCourse(Course $course) 
    {
        $attributes = request()->validate([
            'course_name' => 'required|max:255'
        ]);
        $course->update($attributes);
        return redirect('/admin-dashboard/courses');
    }

    public function destroyCourse(Course $course)
    {
        $course->delete();
        return redirect('/admin-dashboard/courses');
    }

    public function classes()
    {
        $courses = Course::get();
        $records = CourseClass::get();
        $columns = ['id','class_name', 'course'];
        $data = [];

        foreach ($records as $record) {
            $data[] = array_combine($columns, [
                $record->id,
                $record->class_name,
                $courses->where('id', $record->course_id)->first()->course_name
            ]);
        }
        $props = [
            'columns' => $columns, 
            'data' => $data, 
            'courses' => $courses,
            'url' => '/admin-dashboard/classes'
        ];
        return view('admin.admin-classes', [
            'props' => $props
        ]);
    }

    public function storeClass() 
    {
        $attributes = request()->validate([
            'class_name' => 'required|max:255',
            'course_id' => 'required',
        ]);
        CourseClass::create($attributes);
        return redirect('/admin-dashboard/classes');
    }

    public function destroyClass(CourseClass $class)
    {
        $class->delete();
        return redirect('/admin-dashboard/classes');
    }

    public function editClass (CourseClass $class) {
        $props = [
            'class' => $class,
            'courses' => Course::get(),
            'faculties' => Faculty::get(),
            'members' => $class->members
        ];
        return view('admin.edit-class', [
            'props' => $props
        ]);
    }

    public function updateClass(CourseClass $class) 
    {
        $attributes = request()->validate([
            'class_name' => 'required|max:255',
            'course_id' => 'required',
        ]);
        $class->update($attributes);
        return redirect('/admin-dashboard/classes');
    }
}
