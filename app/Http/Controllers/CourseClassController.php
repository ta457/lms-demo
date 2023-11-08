<?php

namespace App\Http\Controllers;

use App\Models\CourseClass;
use App\Models\User;
use Illuminate\Http\Request;

class CourseClassController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        $classes = $user->classes;

        return view('dashboard', [
            'classes' => $classes,
            'user' => $user
        ]);
    }
}
