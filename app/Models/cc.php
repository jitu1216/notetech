<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cc extends Model
{
    use HasFactory;
    protected $fillable = [ 'year', 'conduct', 'date' ];
}
