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
        Schema::create('tender_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tender_id');
            $table->foreign('tender_id')->references('id')->on('tenders')->onDelete('cascade');
            $table->string('video');
            $table->text('description_en');
            $table->text('description_ar');
            $table->text('condition');
            $table->text('required_file');
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
        Schema::dropIfExists('tender_details');
    }
};
