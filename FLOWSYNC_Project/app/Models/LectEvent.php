<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectEvent extends Model
{
    use HasFactory;

    // Define the table name (optional, if your table is named 'events')
    protected $table = 'lect_event';

    // Define the fields that are mass assignable
    protected $fillable = ['title', 'start', 'end'];
}
