<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTimetable extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'stud_timetable';

    // Add fillable fields if you are using mass assignment
    protected $fillable = [
        'day',
        'time',
        'subject',
        'slot',
    ];
}
