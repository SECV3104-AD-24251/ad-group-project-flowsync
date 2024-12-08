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
            ['name' => 'SECI1013', 'description' => 'Discrete Structure'],
            ['name' => 'SECJ1013', 'description' => 'Programming Technique I'],
            ['name' => 'SECP1513', 'description' => 'Technology & Information System'],
            ['name' => 'SECR1013', 'description' => 'Digital Logic'],
            ['name' => 'ULRS1032', 'description' => 'Kursus Integriti dan Anti Rasuah'],
            ['name' => 'SECV3113', 'description' => 'English Communication Skills'],
            ['name' => 'SECJ1023', 'description' => 'Programming Technique II'],
            ['name' => 'SECR1213', 'description' => 'Network Communications'],
            ['name' => 'SECD2523', 'description' => 'Database'],
            ['name' => 'SECJ2203', 'description' => 'Software Engineering'],
            ['name' => 'SECJ2013', 'description' => 'Data Structure and Algorithm'],
            ['name' => 'SECV2113', 'description' => 'Human Computer Interaction'],
            ['name' => 'UHLB2122', 'description' => 'Professional Communication Skills 1'],
            ['name' => 'SECV1113', 'description' => 'Mathematics for Computer Graphics'],
            ['name' => 'SECR2043', 'description' => 'Operating Systems'],
            ['name' => 'SECV3113', 'description' => 'Geometric Modelling'],
            ['name' => 'SECV3104', 'description' => 'Application Development'],
            ['name' => 'UHLB3132', 'description' => 'Professional Communication Skills 2'],
            ['name' => 'SECV3213', 'description' => 'Fundamental of Image Processing'],


        ]);
    }
}
