<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subsection;
use App\Models\User;

class StudenSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['subsection_id', 'student_id', 'file'];

    public function getShortenedFileNameAttribute()
    {
        $maxLength = 12;

        if (strlen($this->attributes['file']) > $maxLength) {
            return substr($this->attributes['file'], 0, $maxLength) . '...';
        } else {
            return $this->attributes['file'];
        }
    }

    public function getFileExtensionAttribute()
    {
        $extension = pathinfo($this->attributes['file'], PATHINFO_EXTENSION);

        return $extension;
    }

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function subsection()
    {
        return $this->belongsTo(Subsection::class);
    }
}
