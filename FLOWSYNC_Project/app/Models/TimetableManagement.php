<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimetableManagement extends Model
{
    use HasFactory;

    protected $table = 'timetable';

    protected $fillable = [
        'course_code',
        'course_name',
        'section',
        'time_slot',
    ];
}
