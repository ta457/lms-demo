<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudenSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['subsection_id', 'file'];

    public function subsection()
    {
        return $this->belongsTo(Subsection::class);
    }
}
