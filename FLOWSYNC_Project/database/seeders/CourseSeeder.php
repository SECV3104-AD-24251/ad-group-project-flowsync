<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run()
    {
        DB::table('courses')->insert([
            ['code' => 'CS101', 'name' => 'Intro to Programming'],
            ['code' => 'CS102', 'name' => 'Data Structures'],
        ]);

        DB::table('sections')->insert([
            ['name' => 'A'],
            ['name' => 'B'],
        ]);

        DB::table('time_slots')->insert([
            ['slot' => '8:00 - 10:00'],
            ['slot' => '10:00 - 12:00'],
        ]);
    }
}
