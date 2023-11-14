<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminUsersController extends Controller
{
    public function index()
    {
        $columns = ['id', 'name', 'username', 'email', 'role_name', 'faculty_name'];

        $props = [
            'records' => User::with('faculty')->paginate(10),
            'columns' => $columns,
            'faculties' => Faculty::get(),
            'url' => '/admin-dashboard/users'
        ];
        return view('admin.admin-users', [
            'props' => $props
        ]);
    }

    public function store()
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

    public function edit(User $user)
    {
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

    public function update(User $user)
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

    public function destroy(User $user)
    {
        if ($user->role !== 1) {
            DB::delete('delete from class_members where user_id=?', [$user->id]);
            $user->delete();
        }
        return redirect('/admin-dashboard/users');
    }
}
