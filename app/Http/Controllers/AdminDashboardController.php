<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
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

    public function index()
    {   
        $records = User::get();
        $columns = ['id','name','username','email','role','faculty_id'];
        $data = [];

        foreach ($records as $record) {
            $data[] = array_combine($columns, [
                $record->id,
                $record->name,
                $record->username,
                $record->email,
                $this->getRoleName($record->role),
                $record->faculty_id
            ]);
        }

        $props = ['columns' => $columns, 'data' => $data];

        return view('admin.admin-users', [
            'props' => $props
        ]);
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

        $props = ['columns' => $columns, 'data' => $data];

        return view('admin.admin-faculties', [
            'props' => $props
        ]);
    }

    public function courses()
    {
        $records = Course::get();
        $columns = ['id','course_name', 'faculty_id'];
        $data = [];

        foreach ($records as $record) {
            $data[] = array_combine($columns, [
                $record->id,
                $record->course_name,
                $record->faculty_id
            ]);
        }

        $props = ['columns' => $columns, 'data' => $data];

        return view('admin.admin-courses', [
            'props' => $props
        ]);
    }

    public function classes()
    {
        $records = CourseClass::get();
        $columns = ['id','class_name', 'course_id'];
        $data = [];

        foreach ($records as $record) {
            $data[] = array_combine($columns, [
                $record->id,
                $record->class_name,
                $record->course_id
            ]);
        }

        $props = ['columns' => $columns, 'data' => $data];

        return view('admin.admin-classes', [
            'props' => $props
        ]);
    }
}
