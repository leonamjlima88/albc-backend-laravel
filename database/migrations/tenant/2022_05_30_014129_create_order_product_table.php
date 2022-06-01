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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('order')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('product_id')->constrained('product');
            $table->string('complement_note', 80)->nullable();
            $table->decimal('quantity', 15, 4);
            $table->decimal('price', 15, 4)->nullable();
            $table->decimal('unit_discount', 15, 4)->nullable();
            $table->decimal('total', 15, 4)->nullable();
            $table->foreignId('seller_id')->constrained('person');
            $table->string('hist_product_name', 120);
            $table->decimal('hist_product_cost_price', 15, 4);
            $table->decimal('hist_product_cost_total', 15, 4);
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
};
