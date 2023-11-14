<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsection extends Model
{
    use HasFactory;

    protected $fillable = ['section_id','type','title','text_content','file','url','deadline','instruction'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    
    public function studentSubmissions()
    {
        return $this->hasMany(StudentSubmission::class);
    }
}
