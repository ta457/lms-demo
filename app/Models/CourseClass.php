<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class CourseClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $guarded = [];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'class_members', 'class_id', 'user_id');
    }

    public function getCourseNameAttribute()
    {
        return $this->course->course_name ?? 'Unknown';
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function sections($id)
    {   
        //$result = DB::table('sections')->where('class_id', $id)->get();
        $result = Section::get()->where('class_id', $id);
        return $result;
    }
}
