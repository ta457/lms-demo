<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
        'role',
        'faculty_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function classes()
    {
        return $this->belongsToMany(CourseClass::class, 'class_members', 'user_id', 'class_id')->with('course');
    }

    public function getRoleNameAttribute()
    {
        $roles = [1 => 'Admin', 2 => 'Student', 3 => 'Teacher'];
        return $roles[$this->attributes['role']];
    }

    public function getFacultyNameAttribute()
    {
        return $this->faculty->faculty_name;
    }
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }
    public function submissions()
    {
        return $this->hasMany('App\Models\StudenSubmission', 'student_id');
    }

    public function getTimelineAttribute() {
        $classes = $this->classes;
        //create an empty array of 50 elements
        $timeline = array_fill(0, 51, null);
        //foreach class, get the real start and end period, and fill the timeline array
        foreach ($classes as $class) {
            $schedule = $class->schedule;
            $start = $schedule->real_start_period;
            $end = $schedule->real_end_period;
            for ($i = $start; $i <= $end; $i++) {
                $timeline[$i] = [$end - $start + 1, $class];
            }
        }
        return $timeline;
    }

    public function isBusy($day, $start, $end) {
        $timeline = $this->timeline;
        for ($i = $start; $i <= $end; $i++) {
            if ($timeline[$day * 10 - 10 + $i] != null) {
                return true;
            }
        }
        return false;
    }
}
