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
        Schema::create('address', function (Blueprint $table) {
            $table->uuid('_id')->primary();
            $table->text('city');
            $table->text('parish')->nullable();
            $table->text('sector')->nullable();
            $table->text('neighborhood')->nullable();
            $table->text('main_street');
            $table->text('back_street')->nullable();
            $table->text('house_number')->nullable();
            $table->text('reference')->nullable();
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
        Schema::dropIfExists('address');
    }
};
