<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTimetable extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'stud_timetable';

    // Specify the primary key (if it's not 'id')
    // protected $primaryKey = 'id';

    // Enable mass assignment for these fields
    protected $fillable = [
        'day',
        'time',
        'subject',
        'slot',
    ];

    // If your primary key is not auto-incrementing, you may need:
    // public $incrementing = false;

    // If your primary key is not an integer, set the key type:
    // protected $keyType = 'string';
}
