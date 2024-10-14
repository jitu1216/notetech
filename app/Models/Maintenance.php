<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id', 'academic_session', 'school_id', 'class_id', 'item_id', 'item_status', 'date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id'); // Specify class_id if class name is Class
    }
}
