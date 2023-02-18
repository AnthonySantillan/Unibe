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
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('_id')->on('users');
            $table->text('invoice_number');
            $table->decimal('subtotal');
            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')->references('_id')->on('customers');
            $table->decimal('discount')->nullable();
            $table->date('date');
            $table->text('observation')->nullable();
            $table->text('forma_pago');
            $table->decimal('iva')->nullable();
            $table->decimal('total');
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
        Schema::dropIfExists('sales_notes');
    }
};
