<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index()
    {   
        //filtering using the table search box
        //dd(request());
        $users = User::oldest();
        if(request('sort_by_time') == 'latest') {
            $users = User::latest();
        }

        if(request('search')) {
            $users->where('name', 'like', '%' . request('search') . '%');
        }
        if(request('filter_role')) {
            $users->where('role', 'like', '%' . request('filter_role') . '%');
        }

        //return view
        $props = [
            'users' => $users->paginate(10),
            'faculties' => Faculty::get()
        ];
        return view('admin.admin-users', ['props' => $props]);
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
        if (!(User::where('username', $attributes['username'])->get()->count() > 0)
            && !(User::where('email', $attributes['email'])->get()->count() > 0)) {
            User::create($attributes);
            return redirect('/admin-dashboard/users')->with('success', 'New user added');
        } else {
            return redirect('/admin-dashboard/users')->with('failed', 'Username or Email is already existed');
        }
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
        return redirect("/admin-dashboard/users/$user->id")->with('success', 'Your changes have been saved');
    }

    public function destroy(User $user)
    {
        if ($user->role !== 1) {
            //DB::delete('delete from class_members where user_id=?', [$user->id]);
            $user->delete();
            return redirect('/admin-dashboard/users')->with('success', 'User deleted');
        } else {
            return redirect('/admin-dashboard/users')->with('failed', 'Can\'t delete protected record');
        }
    }

    public function destroyAll(Request $request)
    {
        $selectedUsers = $request->input('selected', []);
        
        $users = User::whereIn('id', $selectedUsers)->get();

        $flag = 0;
        foreach ($users as $user) {
            if ($user->id == 1) {
                $flag = 1; continue;
            }
            $user->delete();
        }
        $message = ['success', 'Selected users have been deleted'];
        if ($flag == 1) $message = ['failed', 'Can\'t delete protected record'];
        return redirect('/admin-dashboard/users')->with($message[0],$message[1]);
    }
}
