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

  public function viewClassMembers(CourseClass $class)
  {
    $members = $class->members();
    $members = $members->where('role', '>', 1);

    if (request('sort_by_time') == 'latest') {
      $members = $members->latest();
    }

    $members = $members->when(request('search'), function ($query) {
      return $query->where(function ($query) {
        $query->where('name', 'like', '%' . request('search') . '%')
          ->orWhere('username', 'like', '%' . request('search') . '%');
      });
    });

    $members = $members->when(request('filter_role'), function ($query) {
      return $query->where('role', 'like', '%' . request('filter_role') . '%');
    });

    $props = [
      'class' => $class,
      'users' => $members->paginate(10)
    ];
    return view('class.members', [
      'props' => $props
    ]);
  }
}
