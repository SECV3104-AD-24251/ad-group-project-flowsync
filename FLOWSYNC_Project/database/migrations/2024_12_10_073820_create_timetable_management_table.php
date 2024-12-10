<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetableManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('timetable_management', function (Blueprint $table) {
        $table->id();
        $table->string('course_code');
        $table->string('course_name');
        $table->string('section');
        $table->string('time_slot');
        $table->string('lecturer_name');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetable_management');
    }
}
