<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMembers extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'class_members';
}
