<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        $classes = $user->classes;

        return view('admin.admin-users', [
            'classes' => $classes,
            'user' => $user
        ]);
    }

    public function faculties()
    {
        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        $classes = $user->classes;

        return view('admin.admin-faculties', [
            'classes' => $classes,
            'user' => $user
        ]);
    }

    public function courses()
    {
        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        $classes = $user->classes;

        return view('admin.admin-courses', [
            'classes' => $classes,
            'user' => $user
        ]);
    }

    public function classes()
    {
        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        $classes = $user->classes;

        return view('admin.admin-classes', [
            'classes' => $classes,
            'user' => $user
        ]);
    }
}
