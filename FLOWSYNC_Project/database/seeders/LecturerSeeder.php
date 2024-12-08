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
            ['name' => 'Dr. Smith', 'email' => 'smith@example.com', 'phone' => '123456789'],
            ['name' => 'Dr. Johnson', 'email' => 'johnson@example.com', 'phone' => '987654321'],
            ['name' => 'Dr. Lee', 'email' => 'lee@example.com', 'phone' => '567890123'],
        ]);
    }
}
