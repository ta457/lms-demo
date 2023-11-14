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

    public function store() 
    {
        $attributes = request()->validate([
            'faculty_name' => 'required|max:255'
        ]);
        Faculty::create($attributes);
        return redirect('/admin-dashboard/faculties');
    }

    public function edit(Faculty $faculty) {
        $props = [
            'faculty' => $faculty,
            'delete' => $faculty,
            'url' => '/admin-dashboard/faculties'
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
        return redirect('/admin-dashboard/faculties');
    }

    public function destroy(Faculty $faculty)
    {
        DB::delete('update courses set faculty_id = 1 where faculty_id = ?', [$faculty->id]);
        $faculty->delete();
        return redirect('/admin-dashboard/faculties');
    }
}
