<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminClassesController extends Controller
{
    public function index()
    {
        $classes = CourseClass::oldest();
        if(request('sort_by_time') == 'latest') {
            $classes = CourseClass::latest();
        }

        if(request('search')) {
            $classes->where('class_name', 'like', '%' . request('search') . '%');
        }
        if(request('course_id')) {
            $classes->where('course_id', 'like', '%' . request('course_id') . '%');
        }

        //return view
        $props = [
            'classes' => $classes->paginate(10),
            'courses' => Course::get()
        ];
        return view('admin.admin-classes', ['props' => $props]);
    }

    public function store() 
    {
        $attributes = request()->validate([
            'class_name' => 'required|max:255',
            'course_id' => 'required',
        ]);
        $attributes['course_id'] = $attributes['course_id'] * 1;
        if (!(CourseClass::where('class_name', $attributes['class_name'])->get()->count() > 0)) {
            CourseClass::create($attributes);
            return redirect('/admin-dashboard/classes')->with('success', 'New class added');
        } else {
            return redirect('/admin-dashboard/classes')->with('failed', 'Class name\'s already existed');
        }
    }

    public function edit(CourseClass $class) {
        $props = [
            'class' => $class,
            'courses' => Course::get(),
            'members' => $class->members()->paginate(10),
            'users' => User::get()
        ];
        return view('admin.edit-class', [
            'props' => $props
        ]);
    }

    public function update(CourseClass $class) 
    {
        $attributes = request()->validate([
            'class_name' => 'required|max:255',
            'course_id' => 'required|numeric'
        ]);
        $attributes['course_id'] = $attributes['course_id'] * 1;
        $class->update($attributes);
        return redirect("/admin-dashboard/classes/$class->id")->with('success', 'Your changes have been saved');
    }

    public function destroy(CourseClass $class)
    {
        $class->delete();
        return redirect('/admin-dashboard/classes')->with('success', 'Class deleted');
    }

    public function destroyAll(Request $request)
    {
        $selectedClasses = $request->input('selected', []);
        
        $classes = CourseClass::whereIn('id', $selectedClasses)->get();

        foreach ($classes as $class) {
            $class->delete();
        }
        $message = ['success', 'Selected classes have been deleted'];
        return redirect('/admin-dashboard/classes')->with($message[0],$message[1]);
    }

    public function editClassMembers(CourseClass $class)
    {   
        // search & filter
        $members = $class->members();

        if(request('filter_members') == 'all') {
            $members = User::oldest();
        }

        $members = $members->where('role', '>', 1);
        
        if(request('sort_by_time') == 'latest') {
            $members = $members->latest();
        }

        $members = $members->when(request('search'), function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('username', 'like', '%' . request('search') . '%');
            });
        });

        $members = $members->when(request('filter_role'), function ($query) {
            return $query->where('role', 'like', '%' . request('filter_role') . '%');
        });

        $props = [
            'class' => $class,
            'users' => $members->paginate(10)
        ];
        return view('admin.edit-classMembers', [
            'props' => $props
        ]);
    }

    public function updateClassMembers($class, $memberList)
    {
        $class->members()->sync($memberList);
    }

    public function handleUpdateMemberRequest(Request $request)
    {   
        $classId = $request->input('class_id');
        $selectedUserIds = $request->input('selected', []);
        $selectedUsers = User::whereIn('id', $selectedUserIds)->get();
        $this->updateClassMembers(CourseClass::find($classId), $selectedUsers);

        return redirect("/admin-dashboard/classes/$classId/members")->with('success', 'Your changes have been saved');
    }
}
