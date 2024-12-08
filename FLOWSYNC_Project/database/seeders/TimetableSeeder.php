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
        $courses = DB::table('courses')->pluck('id', 'name'); // Fetch course IDs by course name

        DB::table('timetables')->insert([
            [
                'course_id' => $courses['SECV3104'],  
                'course_name' => 'SECV3104', 
                'instructor_name' => 'Dr. Smith',
                'room_name' => 'Room A',
                'section' => 'Section 1',
                'day_of_week' => 'Monday',
                'start_time' => '09:00:00',
                'end_time' => '10:30:00',
            ],
            [
                'course_id' => $courses['SECV3104'],  
                'course_name' => 'SECV3104',  
                'instructor_name' => 'Dr. Smith',
                'room_name' => 'Room A',
                'section' => 'Section 2',
                'day_of_week' => 'Monday',
                'start_time' => '11:00:00',
                'end_time' => '12:30:00',
            ],
            [
                'course_id' => $courses['SECV3213'],  
                'course_name' => 'SECV3213',  
                'instructor_name' => 'Dr. Johnson',
                'room_name' => 'Room B',
                'section' => 'Section 1',
                'day_of_week' => 'Tuesday',
                'start_time' => '09:30:00',
                'end_time' => '11:00:00',
            ],
            [
                'course_id' => $courses['SECJ1013'],  
                'course_name' => 'SECJ1013',  
                'instructor_name' => 'Dr. Carter',
                'room_name' => 'Room C',
                'section' => 'Section 1',
                'day_of_week' => 'Wednesday',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
            ],
            [
                'course_id' => $courses['SECR1013'],  
                'course_name' => 'SECR1013',  
                'instructor_name' => 'Prof. Adams',
                'room_name' => 'Room D',
                'section' => 'Section 1',
                'day_of_week' => 'Thursday',
                'start_time' => '14:00:00',
                'end_time' => '15:30:00',
            ],
            [
                'course_id' => $courses['SECV3113'],  
                'course_name' => 'SECV3113',  
                'instructor_name' => 'Prof. Lee',
                'room_name' => 'Room E',
                'section' => 'Section 1',
                'day_of_week' => 'Friday',
                'start_time' => '13:00:00',
                'end_time' => '14:30:00',
            ],
            [
                'course_id' => $courses['SECJ1023'],  
                'course_name' => 'SECJ1023',  
                'instructor_name' => 'Dr. Green',
                'room_name' => 'Room F',
                'section' => 'Section 1',
                'day_of_week' => 'Monday',
                'start_time' => '15:00:00',
                'end_time' => '16:30:00',
            ],
            [
                'course_id' => $courses['SECR1213'],  
                'course_name' => 'SECR1213',  
                'instructor_name' => 'Dr. Brown',
                'room_name' => 'Room G',
                'section' => 'Section 1',
                'day_of_week' => 'Tuesday',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
            ],
            [
                'course_id' => $courses['SECD2523'],  
                'course_name' => 'SECD2523',  
                'instructor_name' => 'Prof. White',
                'room_name' => 'Room H',
                'section' => 'Section 1',
                'day_of_week' => 'Wednesday',
                'start_time' => '09:30:00',
                'end_time' => '11:00:00',
            ],
            [
                'course_id' => $courses['SECJ2203'],  
                'course_name' => 'SECJ2203',  
                'instructor_name' => 'Dr. Blue',
                'room_name' => 'Room I',
                'section' => 'Section 1',
                'day_of_week' => 'Thursday',
                'start_time' => '09:00:00',
                'end_time' => '10:30:00',
            ],
            [
                'course_id' => $courses['SECJ2013'], 
                'course_name' => 'SECJ2013',  
                'instructor_name' => 'Dr. Black',
                'room_name' => 'Room J',
                'section' => 'Section 1',
                'day_of_week' => 'Friday',
                'start_time' => '11:00:00',
                'end_time' => '12:30:00',
            ],
            [
                'course_id' => $courses['SECV2113'],  
                'course_name' => 'SECV2113',  
                'instructor_name' => 'Dr. White',
                'room_name' => 'Room K',
                'section' => 'Section 1',
                'day_of_week' => 'Monday',
                'start_time' => '13:00:00',
                'end_time' => '14:30:00',
            ],
            [
                'course_id' => $courses['UHLB2122'],  
                'course_name' => 'UHLB2122',  
                'instructor_name' => 'Prof. Grey',
                'room_name' => 'Room L',
                'section' => 'Section 1',
                'day_of_week' => 'Tuesday',
                'start_time' => '14:00:00',
                'end_time' => '15:30:00',
            ],
            [
                'course_id' => $courses['SECV1113'], 
                'course_name' => 'SECV1113',  
                'instructor_name' => 'Dr. Purple',
                'room_name' => 'Room M',
                'section' => 'Section 1',
                'day_of_week' => 'Wednesday',
                'start_time' => '12:00:00',
                'end_time' => '13:30:00',
            ],
            [
                'course_id' => $courses['SECR2043'], 
                'course_name' => 'SECR2043',  
                'instructor_name' => 'Dr. Pink',
                'room_name' => 'Room N',
                'section' => 'Section 1',
                'day_of_week' => 'Thursday',
                'start_time' => '16:00:00',
                'end_time' => '17:30:00',
            ],
            [
                'course_id' => $courses['SECV3113'],  
                'course_name' => 'SECV3113',  
                'instructor_name' => 'Prof. Orange',
                'room_name' => 'Room O',
                'section' => 'Section 2',
                'day_of_week' => 'Friday',
                'start_time' => '10:00:00',
                'end_time' => '11:30:00',
            ],
            [
                'course_id' => $courses['SECV3104'],  
                'course_name' => 'SECV3104',  
                'instructor_name' => 'Dr. Brown',
                'room_name' => 'Room P',
                'section' => 'Section 3',
                'day_of_week' => 'Monday',
                'start_time' => '15:30:00',
                'end_time' => '17:00:00',
            ],
        ]);
    }
}
