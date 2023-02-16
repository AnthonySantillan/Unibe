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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('_id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('_id')->on('users');
            $table->uuid('addres_id');
            $table->foreign('addres_id')->references('_id')->on('address');
            $table->text('identification_card');
            $table->text('name');
            $table->text('last_name');
            $table->text('email');
            $table->text('phone');
            $table->text('role');
            $table->text('state');
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
        Schema::dropIfExists('customers');
    }
};
