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
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('_id')->on('users');
            $table->uuid('addres_id')->nullable();
            $table->foreign('addres_id')->references('_id')->on('address');
            $table->text('identification_card');
            $table->text('name');
            $table->text('last_name');
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('role')->nullable();
            $table->text('state')->nullable();
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
