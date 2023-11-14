<?php

namespace App\Http\Controllers;

use App\Models\Subsection;
use Illuminate\Http\Request;
use App\Models\StudenSubmission;
use Illuminate\Support\Facades\Auth;

class StudenSubmissionController extends Controller
{
    public function index(Subsection $subsection)
    {   
        //dd($subsection);
        // $columns = ['id','faculty_name'];
        $section = $subsection->section;
        $class = $section->class;
        $submissions = $subsection->studentSubmissions;

        $props = [
            'subsection' => $subsection,
            'section' => $section,
            'class' => $class,
            'submissions' => $submissions
        ];
        return view('class.assignment', [
            'props' => $props
        ]);
    }

    public function store(Subsection $subsection)
    {
        //dd(request());
        $attributes = request()->validate([
            'files.*' => 'required|max:102400', // 100 MB max
        ]);

        foreach ($attributes['files'] as $file) {
            $filename = $file->getClientOriginalName();
            $file->storeAs('student-submissions', $filename);

            StudenSubmission::create([
                'subsection_id' => $subsection->id,
                'student_id' => Auth::user()->id,
                'file' => $filename
            ]);
        }

        $url = '/section/' . $subsection->id . '/submit';
        return redirect($url);
    }
}
