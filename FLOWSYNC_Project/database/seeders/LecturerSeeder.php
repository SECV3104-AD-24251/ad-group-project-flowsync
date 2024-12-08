<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds for lecturer.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lecturer')->insert([
            ['name' => 'Dr. Tarmizi bin Adam', 'email' => 'tarmizi@gmail.com', 'phone' => '011-2345678'],
            ['name' => 'Ms. Lizawati binti Mi Yusuf', 'email' => 'lizawati@gmail.com', 'phone' => '019-8765432'],
            ['name' => 'Dr. Suriati binti Sadimon', 'email' => 'suriati@gmail.com', 'phone' => '015-6789012'],
            ['name' => 'Dr. Mohd Foad bin Rohani', 'email' => 'foad@gmail.com', 'phone' => '017-873459'],
            ['name' => 'Assoc. Prof. Dr. Bushrah bin Basiron', 'email' => 'bushrah@gmail.com', 'phone' => '012-4597267'],
            ['name' => 'Dr. Norhaida binti Mohd Suaib', 'email' => 'haida@gmail.com', 'phone' => '011-8236596'],
            ['name' => 'Dr. Raja Zahilah binti Raja Mohd Radzi', 'email' => 'zahilah@gmail.com', 'phone' => '015-3670958'],
            ['name' => 'Dr. Jumail bin Taliba', 'email' => 'jumail@gmail.com', 'phone' => '014-7738690'],
            ['name' => 'Dr. Raja Zahilah binti Raja Mohd Radzi', 'email' => 'zahilah@gmail.com', 'phone' => '015-3670958'],
            ['name' => 'Dr. Noraini binti Ibrahim', 'email' => 'noraini@gmail.com', 'phone' => '019-8564398'],
            ['name' => 'Dr. Fazliaty Edora binti Fadzli', 'email' => 'Fazliaty@gmail.com', 'phone' => '010-7632189'],
            ['name' => 'Dr. Sarina binti Sulaiman', 'email' => 'sarina@gmail.com', 'phone' => '018-9542760'],
            ['name' => 'Dr. Azim Aiman bin Abd Aziz', 'email' => 'azim@gmail.com', 'phone' => '017-8469209'],
            ['name' => 'Dr. Tarmizi bin Adam', 'email' => 'tarmizi@gmail.com', 'phone' => '011-2345678'],
            ['name' => 'Ms. Lizawati binti Mi Yusuf', 'email' => 'lizawati@gmail.com', 'phone' => '019-8765432'],
            ['name' => 'Dr. Norhaida binti Mohd Suaib', 'email' => 'haida@gmail.com', 'phone' => '011-8236596'],
            ['name' => 'Dr. Jumail bin Taliba', 'email' => 'jumail@gmail.com', 'phone' => '014-7738690'],
            ['name' => 'Dr. Azim Aiman bin Abd Aziz', 'email' => 'azim@gmail.com', 'phone' => '017-8469209'],
            ['name' => 'Dr. Md. Sah bin Hj. Salam', 'email' => 'sah@gmail.com', 'phone' => '012-8132670'],
        ]);
    }
}
