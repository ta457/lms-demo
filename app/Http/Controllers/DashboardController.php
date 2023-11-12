<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $classes = Auth::user()->classes;

        if (auth()->user()?->username !== 'admin') {
            return view('dashboard', [
                'classes' => $classes
            ]);
        } else {
            return redirect('/admin-dashboard/users');
        }
    }
}
