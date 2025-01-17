<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateParticipantsGroupTable extends Migration
{
    public function up()
    {
        Schema::create('participants_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('groupID');
            $table->string('email');
            $table->timestamps();


            $table->foreign('groupID')->references('id')->on('group_checklists')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('participants_group');
    }
}

