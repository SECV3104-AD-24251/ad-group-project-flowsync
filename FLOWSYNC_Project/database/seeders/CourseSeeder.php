<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds for courses.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            ['name' => 'SECV3104', 'description' => 'Application Development'],
            ['name' => 'SECV3213', 'description' => 'Fundamental of Image Processing'],
            ['name' => 'SECV3113', 'description' => 'Geometric Modelling'],
        ]);
    }
}
