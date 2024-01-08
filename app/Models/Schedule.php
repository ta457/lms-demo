<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['day_of_week', 'start_period', 'end_period', 'class_id'];

    //each schedule belong to one class
    public function class()
    {
        return $this->belongsTo('App\Models\CourseClass');
    }

    public function getRealStartPeriodAttribute() {
        return $this->start_period + $this->day_of_week * 10 - 10;
    }

    public function getRealEndPeriodAttribute() {
        return $this->end_period + $this->day_of_week * 10 - 10;
    }

    //get the weekday from the day_of_week attribute
    public function getWeekdayAttribute()
    {
        $day = $this->day_of_week;
        switch ($day) {
            case 1:
                return 'Monday';
                break;
            case 2:
                return 'Tuesday';
                break;
            case 3:
                return 'Wednesday';
                break;
            case 4:
                return 'Thursday';
                break;
            case 5:
                return 'Friday';
                break;
            default:
                return 'Unknown';
                break;
        }
    }
}
