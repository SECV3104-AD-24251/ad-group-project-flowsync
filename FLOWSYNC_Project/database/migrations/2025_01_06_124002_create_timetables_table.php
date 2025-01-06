<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flowsync_timetable', function (Blueprint $table) {
            $table->id();
            $table->string('course_code');
            $table->string('course_name');
            $table->string('section');
            $table->string('time_slot');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('flowsync_timetable');
    }
    

}
