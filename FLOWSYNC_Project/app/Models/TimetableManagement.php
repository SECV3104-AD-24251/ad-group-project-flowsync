<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimetableManagement extends Model
{
    use HasFactory;

    // If your table name is different, specify it here
    protected $table = 'timetable_management'; 

    // Specify the columns that can be mass-assigned (optional, but recommended)
    protected $fillable = [
        'course_code',
        'course_name',
        'section',
        'time_slot',
        // Add other columns as needed
    ];
}
