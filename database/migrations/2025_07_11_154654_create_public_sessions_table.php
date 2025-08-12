<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_sessions', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_event');
            $table->string('from_time')->nullable();
            $table->string('to_time')->nullable();
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('description_en');
            $table->text('description_ar');
            $table->tinyInteger('type')->default(1); // 1 open // 2 soon
            $table->string('video')->nullable(); 
            $table->text('what_expect')->nullable(); 
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
        Schema::dropIfExists('public_sessions');
    }
};
