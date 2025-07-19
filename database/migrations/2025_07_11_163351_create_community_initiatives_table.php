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
        Schema::create('community_initiatives', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('description_en');
            $table->text('description_ar');
            $table->text('date_finish')->nullable();
          // when user create 
            $table->string('name');
            $table->string('phone');
            $table->string('age');
            $table->json('photo');
            $table->tinyInteger('gender')->default(1); // 1 male // 2 female
            $table->tinyInteger('hide_information')->default(1); // 1 yes // 2 no
            $table->tinyInteger('status')->default(1); // 1 pending // 2 work on it // 3 Done
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
        Schema::dropIfExists('community_initiatives');
    }
};
