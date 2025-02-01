<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('event_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id')->nullable(); // Nullable for deleted events
            $table->unsignedBigInteger('user_id'); // Who made the change
            $table->string('action'); // added, updated, deleted
            $table->json('old_value')->nullable(); // Store previous state
            $table->json('new_value')->nullable(); // Store new state
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_histories');
    }
};
