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
        Schema::create('sales_notes_products', function (Blueprint $table) {
            $table->uuid('_id')->primary();
            $table->uuid('product_id');
            $table->foreign('product_id')->references('_id')->on('products')->onDelete('cascade');
            $table->uuid('sales_notes_id')->nullable();
            $table->foreign('sales_notes_id')->references('_id')->on('sales_notes')->onDelete('cascade');
            $table->decimal('amount');
            $table->text('description');
            $table->decimal('importe');
            $table->decimal('discount')->nullable();
            $table->decimal('unit_value');
            $table->decimal('iva')->nullable();
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
        Schema::dropIfExists('sales_notes_products');
    }
};
