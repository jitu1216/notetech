<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tc extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'academic_session',
        'school_id',
        'class_id',
        'class_1', 'date_of_admission_1', 'date_of_promotion_1', 'date_of_removal_1', 'Causes_1', 'session_1', 'conduct_1', 'work_1',
        'class_2', 'date_of_admission_2', 'date_of_promotion_2', 'date_of_removal_2', 'Causes_2', 'session_2', 'conduct_2', 'work_2',
        'class_3', 'date_of_admission_3', 'date_of_promotion_3', 'date_of_removal_3', 'Causes_3', 'session_3', 'conduct_3', 'work_3',
        'class_4', 'date_of_admission_4', 'date_of_promotion_4', 'date_of_removal_4', 'Causes_4', 'session_4', 'conduct_4', 'work_4',
        'class_5', 'date_of_admission_5', 'date_of_promotion_5', 'date_of_removal_5', 'Causes_5', 'session_5', 'conduct_5', 'work_5',
        'class_6', 'date_of_admission_6', 'date_of_promotion_6', 'date_of_removal_6', 'Causes_6', 'session_6', 'conduct_6', 'work_6',
        'class_7', 'date_of_admission_7', 'date_of_promotion_7', 'date_of_removal_7', 'Causes_7', 'session_7', 'conduct_7', 'work_7',
        'class_8', 'date_of_admission_8', 'date_of_promotion_8', 'date_of_removal_8', 'Causes_8', 'session_8', 'conduct_8', 'work_8',
        'class_9', 'date_of_admission_9', 'date_of_promotion_9', 'date_of_removal_9', 'Causes_9', 'session_9', 'conduct_9', 'work_9',
        'class_10', 'date_of_admission_10', 'date_of_promotion_10', 'date_of_removal_10', 'Causes_10', 'session_10', 'conduct_10', 'work_10',
        'transfer_certificate_no','withdrwal_file_no', 'addmission_file_no', 'tc_date','tc_count',
    ];
}
