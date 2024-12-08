<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds for timetables.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timetables')->insert([
            [
                'course_name' => 'SECV3104',
                'instructor_name' => 'Dr. Smith',
                'room_name' => 'Room A',
                'section' => 'Section 1',
                'day_of_week' => 'Monday',
                'start_time' => '09:00:00',
                'end_time' => '10:30:00',
            ],
            [
                'course_name' => 'SECV3104',
                'instructor_name' => 'Dr. Smith',
                'room_name' => 'Room A',
                'section' => 'Section 2',
                'day_of_week' => 'Monday',
                'start_time' => '11:00:00',
                'end_time' => '12:30:00',
            ],
            [
                'course_name' => 'SECV3213',
                'instructor_name' => 'Dr. Johnson',
                'room_name' => 'Room B',
                'section' => 'Section 1',
                'day_of_week' => 'Tuesday',
                'start_time' => '09:30:00',
                'end_time' => '11:00:00',
            ],
        ]);
    }
}
