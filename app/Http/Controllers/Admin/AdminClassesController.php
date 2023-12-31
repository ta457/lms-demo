<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Schedule;
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
            'day_of_week' => 'required',
            'start_period' => 'required',
            'end_period' => 'required'
        ]);
        $attributes['course_id'] = $attributes['course_id'] * 1;
        $attributes['day_of_week'] = $attributes['day_of_week'] * 1;
        $attributes['start_period'] = $attributes['start_period'] * 1;
        $attributes['end_period'] = $attributes['end_period'] * 1;

        if (!(CourseClass::where('class_name', $attributes['class_name'])->get()->count() > 0)) {
            if($attributes['end_period'] <= $attributes['start_period']) {
                return redirect('/admin-dashboard/classes')->with('failed', 'End period must be greater than start period');
            }
    
            if($attributes['end_period'] - $attributes['start_period'] >= 5) {
                return redirect('/admin-dashboard/classes')->with('failed', 'Class must be no more than 5 periods');
            }

            $schedule = Schedule::create([
                'day_of_week' => $attributes['day_of_week'],
                'start_period' => $attributes['start_period'],
                'end_period' => $attributes['end_period']
            ]);
            CourseClass::create([
                'class_name' => $attributes['class_name'],
                'course_id' => $attributes['course_id'],
                'schedule_id' => $schedule->id
            ]);
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
            'course_id' => 'required|numeric',
            'day_of_week' => 'required',
            'start_period' => 'required',
            'end_period' => 'required'
        ]);
        $attributes['course_id'] = $attributes['course_id'] * 1;
        $attributes['day_of_week'] = $attributes['day_of_week'] * 1;
        $attributes['start_period'] = $attributes['start_period'] * 1;
        $attributes['end_period'] = $attributes['end_period'] * 1;

        if($attributes['end_period'] <= $attributes['start_period']) {
            return redirect('/admin-dashboard/classes')->with('failed', 'End period must be greater than start period');
        }

        if($attributes['end_period'] - $attributes['start_period'] >= 5) {
            return redirect('/admin-dashboard/classes')->with('failed', 'Class must be no more than 5 periods');
        }
        $class->update([
            'class_name' => $attributes['class_name'],
            'course_id' => $attributes['course_id']
        ]);
        $class->schedule->update([
            'day_of_week' => $attributes['day_of_week'],
            'start_period' => $attributes['start_period'],
            'end_period' => $attributes['end_period']
        ]);
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
        $class = CourseClass::find($classId);
        $schedule = $class->schedule;

        $selectedUserIds = $request->input('selected', []);
        $selectedUsers = User::whereIn('id', $selectedUserIds)->get();
        $busyUsers = [];
        //add all busy user name to busyUsers array, except for user in this class
        foreach ($selectedUsers as $user) {
            //check if user is in this class members list
            if ($class->members->contains($user)) {
                continue;
            }
            if ($user->isBusy($schedule->day_of_week, $schedule->start_period, $schedule->end_period)) {
                array_push($busyUsers, $user->name);
            }
        }

        // if there is any busy user, return error message
        if (count($busyUsers) > 0) {
            $message = implode(', ', $busyUsers);
            return redirect("/admin-dashboard/classes/$classId/members")->with('failed', "The following users are busy: $message");
        }

        $this->updateClassMembers($class, $selectedUsers);

        return redirect("/admin-dashboard/classes/$classId/members")->with('success', 'Your changes have been saved');
    }
}
