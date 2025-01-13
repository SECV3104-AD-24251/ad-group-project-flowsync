<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectEventTable extends Migration
{
    public function up()
    {
        Schema::create('lect_event', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable(); // Description column
            $table->timestamp('start')->nullable(); // Allow NULL values for 'start'
            $table->timestamp('end')->nullable(); // Allow NULL values for 'end'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lect_event');
    }
}
