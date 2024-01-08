<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(User $user)
    {
        //if current user is not the user in the url, redirect to dashboard
        if (auth()->user()->id != $user->id) {
            return redirect()->route('dashboard');
        }

        // $classes = $user->classes;

        // //create an empty array of 50 elements
        // $timeline = array_fill(0, 51, null);
        // //foreach class, get the real start and end period, and fill the timeline array
        // foreach ($classes as $class) {
        //     $schedule = $class->schedule;
        //     $start = $schedule->real_start_period;
        //     $end = $schedule->real_end_period;
        //     for ($i = $start; $i <= $end; $i++) {
        //         $timeline[$i] = [$end - $start + 1, $class];
        //     }
        // }
        $props = [
            'timeline' => $user->timeline
        ];
        return view('class.schedule', [
            'props' => $props
        ]);
    }
}
