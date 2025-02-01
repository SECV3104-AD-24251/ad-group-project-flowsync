<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventHistory extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
    protected $fillable = [
        'event_id', 'old_value', 'new_value', 'updated_by'
    ];
}
