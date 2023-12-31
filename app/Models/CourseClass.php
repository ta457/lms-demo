<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function getDaysDifferenceAttribute()
    {
        $createdAt = Carbon::parse($this->created_at);
        $today = Carbon::now();
        $differenceInDays = $today->diffInDays($createdAt);
        return $differenceInDays;
    }

    public function isUserInClass($userId)
    {
        return $this->members()->where('user_id', $userId)->exists();
    }

    //each class has one schedule
    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'id');
    }
}
