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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('_id')->primary();
            $table->uuid('cellar_id');
            $table->foreign('cellar_id')->references('_id')->on('cellars');
            $table->text('code');
            $table->text('name');
            $table->text('description')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('products');
    }
};
