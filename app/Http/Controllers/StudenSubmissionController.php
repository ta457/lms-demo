<?php

namespace App\Http\Controllers;

use App\Models\Subsection;
use Illuminate\Http\Request;
use App\Models\StudenSubmission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class StudenSubmissionController extends Controller
{
    public function index(Subsection $subsection)
    {   
        //dd($subsection);
        // $columns = ['id','faculty_name'];
        $section = $subsection->section;
        $class = $section->class;
        $submissions = $subsection->submissions;
        //id of all the students sumitted to this assignment
        $students = User::has('submissions')->get();

        $props = [
            'subsection' => $subsection,
            'section' => $section,
            'class' => $class,
            'submissions' => $submissions,
            'students' => $students
        ];
        if (Auth::user()->role == 2) {
            return view('class.assignment', [
                'props' => $props
            ]);
        } else {
            return view('class.student-submissions', [
                'props' => $props
            ]);
        }
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

        $url = '/assignment/' . $subsection->id;
        return redirect($url);
    }

    public function destroy(StudenSubmission $submission) {
        $filePath = '/student-submissions/' . $submission->file;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        $submission->delete();
        
        $url = '/assignment/' . $submission->subsection->id;
        return redirect($url);
    }
}
