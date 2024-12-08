<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call individual seeders
        $this->call([
            CourseSeeder::class,
            LecturerSeeder::class,
            RoomSeeder::class,
            TimetableSeeder::class,
        ]);
    }
}
