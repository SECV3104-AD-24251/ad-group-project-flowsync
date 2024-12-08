<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds for rooms.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            ['name' => 'Room A', 'capacity' => 30],
            ['name' => 'Room B', 'capacity' => 50],
            ['name' => 'Room C', 'capacity' => 20],
        ]);
    }
}
