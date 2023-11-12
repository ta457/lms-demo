<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminClassesController extends Controller
{
    public function index()
    {
        $columns = ['id','class_name', 'course_name'];
        $props = [
            'columns' => $columns, 
            'records' => CourseClass::with('course')->paginate(8), 
            'courses' => Course::get(),
            'url' => '/admin-dashboard/classes'
        ];
        return view('admin.admin-classes', [
            'props' => $props
        ]);
    }

    public function store() 
    {
        $attributes = request()->validate([
            'class_name' => 'required|max:255',
            'course_id' => 'required',
        ]);
        CourseClass::create($attributes);
        return redirect('/admin-dashboard/classes');
    }

    public function destroy (CourseClass $class)
    {   
        DB::delete('delete from class_members where class_id=?', [$class->id]);
        $class->delete();
        return redirect('/admin-dashboard/classes');
    }

    public function edit (CourseClass $class) {
        $props = [
            'class' => $class,
            'delete' => $class,
            'courses' => Course::get(),
            'faculties' => Faculty::get(),
            'users' => User::get(),
            'members' => $class->members()->paginate(8),
            'url' => '/admin-dashboard/classes'
        ];
        return view('admin.edit-class', [
            'props' => $props
        ]);
    }

    public function update (CourseClass $class) 
    {
        $attributes = request()->validate([
            'class_name' => 'required|max:255',
            'course_id' => 'required',
        ]);
        $selected = request()->input('update-members', []);
        $this->updateClassMembers($class, $selected);
        $class->update($attributes);
        return redirect('/admin-dashboard/classes');
    }

    public function updateClassMembers($class, $memberList)
    {
        $class->members()->sync($memberList);
    }
}
