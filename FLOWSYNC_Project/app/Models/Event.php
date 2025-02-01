<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Define the table name (optional, if your table is named 'events')
    protected $table = 'events';

    // Define the fields that are mass assignable
    protected $fillable = [
        'title', 'description', 'location', 'start', 'end', 'notification', 
    ];

    public function eventHistory()
    {
        return $this->hasMany(EventHistory::class);
    }
}
