<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NOC extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'academic_session',
        'school_id',
        'date',
        'receipt_no',
        'exam_type',
    ];
}
