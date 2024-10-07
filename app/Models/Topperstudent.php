<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topperstudent extends Model
{
    protected $fillable = [
        'academic_session',
        'school_id',
        'class_id',
        'student_id',
        'subject_total',
        'total_mark_obtain',
        'rank',
    ];
}
