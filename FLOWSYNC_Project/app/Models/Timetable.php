<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    // Specify the updated table name
    protected $table = 'flowsync_timetable';  // Updated table name

    protected $fillable = [
        'course_code',
        'course_name',
        'section',
        'time_slot',
    ];
}

