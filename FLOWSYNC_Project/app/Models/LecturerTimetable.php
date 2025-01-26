<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturerTimetable extends Model
{
    use HasFactory;

    protected $table = 'lect_timetable';

    protected $fillable = [
        'day',
        'time',
        'subject',
        'slot',
    ];

    /**
     * Scope a query to group timetable data by day and order by time.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGroupedByDay($query)
    {
        $timetable = LecturerTimetable::orderBy('time')->get()->groupBy('day');

    }

    /**
     * Fetch unique time slots for table headers.
     *
     * @return array
     */
    public static function getTimeSlots()
    {
        return self::select('time')
            ->distinct()
            ->orderBy('time')
            ->get()
            ->pluck('time')
            ->toArray();
    }
}