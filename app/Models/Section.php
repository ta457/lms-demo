<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'section_title', 'order'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($section) {
            $section->order = static::where('class_id', $section->class_id)->max('order') + 1;
        });
    }

    public function class()
    {   
        return $this->belongsTo(CourseClass::class);
    }
}
