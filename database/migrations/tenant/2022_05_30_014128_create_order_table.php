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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('person');
            $table->foreignId('seller_id')->constrained('person');
            $table->string('approval', 10)->index()->comment('[pending, closed, canceled]');
            $table->text('note')->nullable();
            $table->text('internal_note')->nullable();
            $table->decimal('order_product_sum_total', 15, 4)->nullable();
            $table->decimal('order_product_sum_hist_product_cost_total', 15, 4)->nullable();
            $table->decimal('discount', 15, 4)->nullable();
            $table->decimal('total', 15, 4)->nullable();
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
        Schema::dropIfExists('order');
    }
};
