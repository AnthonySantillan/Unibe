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
        Schema::create('sales_notes', function (Blueprint $table) {
            $table->uuid('_id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('_id')->on('users');
            $table->uuid('sales_notes_product_id');
            $table->foreign('sales_notes_product_id')->references('_id')->on('sales_notes_products');
            $table->text('invoice_number');
            $table->decimal('subtotal');
            $table->uuid('client_id');
            $table->foreign('client_id')->references('_id')->on('customers');
            $table->decimal('discount');
            $table->date('date');
            $table->text('observation');
            $table->text('forma_pago');
            $table->decimal('iva');
            $table->decimal('total');
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
        Schema::dropIfExists('sales_notes');
    }
};
