<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateChecklistsTable extends Migration
{
    public function up()
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id('checkID');
            $table->string('taskname');
            $table->boolean('checked')->default(false);
            $table->unsignedBigInteger('groupID');
            $table->timestamps();


            $table->foreign('groupID')->references('id')->on('group_checklists')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('checklists');
    }
}

