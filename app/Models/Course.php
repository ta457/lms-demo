<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Faculty;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function classes()
    {
        return $this->hasMany(CourseClass::class);
    }

    public function getFacultyNameAttribute()
    {
        return $this->faculty->faculty_name ?? 'Unknown';
    }
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }
}
