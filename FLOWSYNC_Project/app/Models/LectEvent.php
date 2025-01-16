<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectEvent extends Model
{
    use HasFactory;

    // Define the table name (optional if it differs from the model name)
    protected $table = 'lect_event';

    // Define the fields that are mass assignable
    protected $fillable = [
        'title', 
        'description', 
        'location', 
        'start', 
        'end', 
        'notification', 
    ];

    // Cast the start and end fields to date format
    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];
}
