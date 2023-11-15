<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudenSubmission;

class Subsection extends Model
{
    use HasFactory;

    protected $fillable = ['section_id','type','title','text_content','file','url','deadline','instruction'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function getShortenedFileNameAttribute()
    {
        $maxLength = 12;
        $filePath = $this->attributes['file'];
        $parts = explode('/', $filePath);

        if (strlen($parts[1]) > $maxLength) {
            return substr($parts[1], 0, $maxLength) . '...';
        } else {
            return $parts[1];
        }
    }

    public function getFileExtensionAttribute()
    {
        $extension = pathinfo($this->attributes['file'], PATHINFO_EXTENSION);

        return $extension;
    }
    
    public function submissions()
    {
        return $this->hasMany(StudenSubmission::class);
    }
}
