<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'academic_session',
        'school_id',
        'class_id',
        'item_status',
        
        'date',
    ];
}
