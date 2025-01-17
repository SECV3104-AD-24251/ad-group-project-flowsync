


<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateGroupChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_checklists', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('title'); // Checklist title
            $table->timestamps(); // Created and updated timestamps
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_checklists');
    }
}

