<?php

namespace App\Http\Controllers;

use App\Models\CourseClass;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class CourseClassController extends Controller
{
  public function index(CourseClass $class)
  {
    $props = [
      'class' => $class
    ];
    return view('class.index', [
      'props' => $props
    ]);
  }

  public function edit(CourseClass $class)
  {
    $props = [
      'class' => $class
    ];
    return view('class.edit', [
      'props' => $props
    ]);
  }

  public function store(CourseClass $class)
  { 
    //dd(request()->section_title);
    $attributes = request()->validate([
      'section_title' => 'required|max:255',
      'class_id' => 'required|integer',
    ]);
    //dd($attributes);
    Section::create($attributes);
    $url = '/class/' . $class->id . '/edit';
    return redirect($url);
  }
}
