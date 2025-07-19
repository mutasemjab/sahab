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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->tinyInteger('user_type');  // 1 user   // 2 organaization
            $table->tinyInteger('activate')->default(1); // 1 yes //2 no
            $table->rememberToken();
            $table->timestamps();

            // Composite unique index for email and user_type
            $table->unique(['email', 'user_type']);

            // Composite unique index for phone and user_type
            $table->unique(['phone', 'user_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
