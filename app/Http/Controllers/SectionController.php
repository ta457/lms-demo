<?php

namespace App\Http\Controllers;

use App\Models\Section;

use App\Models\Subsection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function edit(Section $section)
    {   
        $props = [
            'section' => $section,
            'url' => '/section',
            'delete' => $section
        ];
        return view('class.edit-section', [
            'props' => $props
        ]);
    }

    public function update(Section $section)
    {   
        $attributes = request()->validate([
            'section_title' => 'required'
        ]);
        $section->update($attributes);
        $url = '/class/' . $section->class->id . '/edit';
        return redirect($url);
    }

    public function destroy(Section $section)
    {
        $section->delete();
        $url = '/class/' . $section->class->id . '/edit';
        return redirect($url);
    }

    // handle delete subsection ====================================================

    public function destroySubsection(Subsection $subsection)
    {
        $subsection->delete();
        $url = '/class/' . $subsection->section->id . '/edit';
        return redirect($url);
    }

    // handle link subsection =======================================================
    
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

    public function editLink(Subsection $subsection)
    {
        $props = [
            'subsection' => $subsection,
            'url' => '/subsection',
            'delete' => $subsection
        ];
        return view('class.edit-link-subsection', [
            'props' => $props
        ]);
    }

    public function updateLink(Subsection $subsection)
    {
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'url' => 'required',
        ]);
        $subsection->update($attributes);
        
        $url = '/class/' . $subsection->section->id . '/edit';
        return redirect($url);
    }

    // handle text subsection =======================================================

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

    public function editText(Subsection $subsection)
    {
        $props = [
            'subsection' => $subsection,
            'url' => '/subsection',
            'delete' => $subsection
        ];
        return view('class.edit-text-subsection', [
            'props' => $props
        ]);
    }

    public function updateText(Subsection $subsection)
    {
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'text_content' => 'required',
        ]);
        $subsection->update($attributes);
        
        $url = '/class/' . $subsection->section->id . '/edit';
        return redirect($url);
    }

    // handle file subsection ============================================================
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

    public function editFile(Subsection $subsection)
    {
        $props = [
            'subsection' => $subsection,
            'url' => '/subsection',
            'delete' => $subsection
        ];
        return view('class.edit-file-subsection', [
            'props' => $props
        ]);
    }

    public function updateFile(Subsection $subsection)
    {   
        $attributes = '';
        if(request()->file('file')){
            $fileName = request()->file('file')->getClientOriginalName();
            
            if (Storage::exists($subsection->file)) {
                Storage::delete($subsection->file);
            }
            
            $attributes = request()->validate([
                'title' => 'required|max:255',
                'file' => 'required',
            ]);
    
            $attributes['file'] = request()->file('file')->storeAs('/section-files', $fileName);

        } else {
            $attributes = request()->validate([
                'title' => 'required|max:255'
            ]);
        }
        
        $subsection->update($attributes);
        
        $url = '/class/' . $subsection->section->id . '/edit';
        return redirect($url);
    }

    // handle assignment subsection ===================================================

    public function storeAssignment(Section $section) 
    {   
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

    public function editAssignment(Subsection $subsection)
    {
        $props = [
            'subsection' => $subsection,
            'url' => '/subsection',
            'delete' => $subsection
        ];
        return view('class.edit-assignment-subsection', [
            'props' => $props
        ]);
    }

    public function updateAssignment(Subsection $subsection)
    {
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'deadline' => 'required',
            'instruction' => 'required'
        ]);
        $subsection->update($attributes);
        
        $url = '/class/' . $subsection->section->id . '/edit';
        return redirect($url);
    }
}
