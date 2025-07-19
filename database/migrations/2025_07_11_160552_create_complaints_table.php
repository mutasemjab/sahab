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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('video');
            $table->string('name');
            $table->string('phone');
            $table->string('age');
            $table->tinyInteger('gender')->default(1); // 1 male // 2 female
            $table->tinyInteger('hide_information')->default(1); // 1 yes // 2 no
            $table->tinyInteger('status')->default(1); // 1 pending // 2 work on it // 3 Done // 4 Complaints outside the jurisdiction // 5 complaint not solve
           
            //
            $table->tinyInteger('is_complaint_emergency')->default(1); // 1 yes // 2 no
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->string('complaint_details');
            $table->json('photo');
            $table->json('another_photo')->nullable();
            $table->unsignedBigInteger('place_complaint_id');
            $table->foreign('place_complaint_id')->references('id')->on('place_complaints')->onDelete('cascade');
            $table->text('address_details')->nullable();
            $table->double('lat');
            $table->double('lng');
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
        Schema::dropIfExists('complaints');
    }
};
