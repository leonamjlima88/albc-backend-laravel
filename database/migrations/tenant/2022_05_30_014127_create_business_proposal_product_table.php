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
        Schema::create('business_proposal_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_proposal_id')
                ->constrained('business_proposal')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                $table->foreignId('product_id')->constrained('product');
                $table->string('complement_note', 80)->nullable();
                $table->decimal('quantity', 15, 4);
                $table->decimal('sale_price', 15, 4)->nullable();
                $table->decimal('unit_discount', 15, 4)->nullable();
                $table->decimal('total', 15, 4)->nullable();
            });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_proposal_product');
    }
};
