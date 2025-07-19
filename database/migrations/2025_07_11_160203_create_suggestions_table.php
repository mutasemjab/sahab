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
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('age');
            $table->text('note');
            $table->tinyInteger('gender')->default(1); // 1 male // 2 female
            $table->tinyInteger('hide_information')->default(1); // 1 yes // 2 no
            $table->tinyInteger('status')->default(1); // 1 pending // 2 work on it // 3 Done
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->tinyInteger('opinion')->default(1); // 1 ok // 2 no good 
            $table->text('question');
            $table->tinyInteger('how_much_use_this_service')->default(1); // 1 weekly // 2 monthly // 3 yearly 
            $table->tinyInteger('Do_you_need_accessibility')->default(1);
            // 1 دعم قارئ الشاشة
            // 2 نص كبير
            // 2 تباين الالوان 
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
        Schema::dropIfExists('suggestions');
    }
};
