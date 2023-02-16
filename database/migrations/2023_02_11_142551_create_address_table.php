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
            $table->text('parish');
            $table->text('sector');
            $table->text('neighborhood');
            $table->text('main_street');
            $table->text('back_street');
            $table->text('house_number');
            $table->text('reference');
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
