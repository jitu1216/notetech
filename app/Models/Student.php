<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;


class Student extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;


    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'student_id');
    }

}
