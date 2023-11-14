<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\StudenSubmission;
use App\Models\Subsection;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function storeLink(Section $section) 
    {   
        $attributes = request()->validate([
            'section_id' => 'required',
            'type' => 'required',
            'title' => 'required|max:255',
            'url' => 'required',
        ]);
        Subsection::create($attributes);
        
        $url = '/class/' . $section->class->id . '/edit';
        return redirect($url);
    }

    public function storeText(Section $section) 
    {   
        $attributes = request()->validate([
            'section_id' => 'required',
            'type' => 'required',
            'title' => 'required|max:255',
            'text_content' => 'required',
        ]);
        Subsection::create($attributes);
        
        $url = '/class/' . $section->class->id . '/edit';
        return redirect($url);
    }

    public function storeFile(Section $section) 
    {   
        $fileName = request()->file('file')->getClientOriginalName();

        $attributes = request()->validate([
            'section_id' => 'required',
            'type' => 'required',
            'title' => 'required|max:255',
            'file' => 'required',
        ]);

        $attributes['file'] = request()->file('file')->storeAs('/section-files', $fileName);
        
        Subsection::create($attributes);
        
        $url = '/class/' . $section->class->id . '/edit';
        return redirect($url);
    }

    public function storeSub(Section $section) 
    {   
        //dd(request());

        $attributes = request()->validate([
            'section_id' => 'required',
            'type' => 'required',
            'title' => 'required|max:255',
            'deadline' => 'required',
            'instruction' => 'required'
        ]);

        Subsection::create($attributes);
        
        $url = '/class/' . $section->class->id . '/edit';
        return redirect($url);
    }
}
