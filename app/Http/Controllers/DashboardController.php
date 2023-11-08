<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        $classes = $user->classes;

        if (auth()->user()?->username !== 'admin') {
            return view('dashboard', [
                'classes' => $classes,
                'user' => $user
            ]);
        } else {
            return redirect('/admin-dashboard/users');
        }
    }
}
