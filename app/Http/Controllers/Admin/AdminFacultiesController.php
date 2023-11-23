<?php

namespace App\Http\Controllers\Admin;
use App\Models\Faculty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminFacultiesController extends Controller
{
    public function index()
    {
        $faculties = Faculty::oldest();
        if(request('sort_by_time') == 'latest') {
            $faculties = Faculty::latest();
        }

        if(request('search')) {
            $faculties->where('faculty_name', 'like', '%' . request('search') . '%');
        }

        //return view
        $props = [
            'faculties' => $faculties->paginate(10)
        ];
        return view('admin.admin-faculties', [
            'props' => $props
        ]);
    }

    public function store() 
    {
        $attributes = request()->validate([
            'faculty_name' => 'required|max:255'
        ]);
        Faculty::create($attributes);
        return redirect('/admin-dashboard/faculties')->with('success', 'New faculty added');
    }

    public function edit(Faculty $faculty) {
        $props = [
            'faculty' => $faculty
        ];
        return view('admin.edit-faculty', [
            'props' => $props
        ]);
    }

    public function update(Faculty $faculty) 
    {
        $attributes = request()->validate([
            'faculty_name' => 'required|max:255'
        ]);
        if ($faculty->id != 1) {
            $faculty->update($attributes);
        }
        return redirect("/admin-dashboard/faculties/$faculty->id")->with('success', 'Your changes have been saved');
    }

    public function destroy(Faculty $faculty)
    {
        if ($faculty->id !== 1) {
            $faculty->delete();
            return redirect('/admin-dashboard/faculties')->with('success', 'Faculty deleted');
        } else {
            return redirect('/admin-dashboard/faculties')->with('failed', 'Can\'t delete protected record');
        }
    }

    public function destroyAll(Request $request)
    {
        $selectedFaculties = $request->input('selected', []);
        
        $faculties = Faculty::whereIn('id', $selectedFaculties)->get();

        $flag = 0;
        foreach ($faculties as $faculty) {
            if ($faculty->id == 1) {
                $flag = 1; continue;
            }
            $faculty->delete();
        }
        $message = ['success', 'Selected faculties have been deleted'];
        if ($flag == 1) $message = ['failed', 'Can\'t delete protected record'];
        return redirect('/admin-dashboard/faculties')->with($message[0],$message[1]);
    }
}
