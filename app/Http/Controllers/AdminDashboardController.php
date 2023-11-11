<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use PhpParser\Builder\Class_;

class AdminDashboardController extends Controller
{   
    public function users()
    {   
        $columns = ['id','name','username','email','role_name','faculty_name'];

        $props = [
            'records' => User::paginate(10),
            'columns' => $columns,
            'faculties' => Faculty::get(),
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
            'delete' => $user,
            'faculties' => Faculty::get(),
            'url' => '/admin-dashboard/users'
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
            DB::delete('delete from class_members where user_id=?', [$user->id]);
            $user->delete();
        }
        return redirect('/admin-dashboard/users');
    }

    public function faculties()
    {
        $columns = ['id','faculty_name'];
        $props = [
            'records' => Faculty::paginate(10),
            'columns' => $columns,
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
            'faculty' => $faculty,
            'delete' => $faculty,
            'url' => '/admin-dashboard/faculties'
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
        if ($faculty->id != 1) {
            $faculty->update($attributes);
        }
        return redirect('/admin-dashboard/faculties');
    }

    public function destroyFaculty(Faculty $faculty)
    {
        DB::delete('update courses set faculty_id = 1 where faculty_id = ?', [$faculty->id]);
        $faculty->delete();
        return redirect('/admin-dashboard/faculties');
    }

    public function courses()
    {
        $columns = ['id','course_name', 'faculty_name'];
        $props = [
            'columns' => $columns, 
            'records' => Course::paginate(10), 
            'faculties' => Faculty::get(),
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
            'delete' => $course,
            'faculties' => Faculty::Get(),
            'url' => '/admin-dashboard/courses'
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
        DB::delete('delete from course_classes where course_id=?', [$course->id]);
        $course->delete();
        return redirect('/admin-dashboard/courses');
    }

    public function classes()
    {
        $columns = ['id','class_name', 'course_name'];
        $props = [
            'columns' => $columns, 
            'records' => CourseClass::paginate(10), 
            'courses' => Course::get(),
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
        DB::delete('delete from class_members where class_id=?', [$class->id]);
        $class->delete();
        return redirect('/admin-dashboard/classes');
    }

    public function editClass (CourseClass $class) {
        $props = [
            'class' => $class,
            'delete' => $class,
            'courses' => Course::get(),
            'faculties' => Faculty::get(),
            'users' => User::get(),
            'members' => $class->members()->paginate(10),
            'url' => '/admin-dashboard/classes'
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
