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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)->index();
            $table->tinyInteger('type')->default(0)->comment('[0=Produto, 1=Serviço]');
            $table->string('reference_code', 36)->index()->nullable();
            $table->string('ean_code', 36)->index()->nullable();
            $table->string('manufacturing_code', 36)->index()->nullable();
            $table->string('identification_code', 36)->index()->nullable();
            $table->decimal('cost_price', 15, 4)->nullable();
            $table->decimal('sale_price', 15, 4)->nullable();
            $table->decimal('current_quantity', 15, 4)->nullable();
            $table->decimal('minimum_quantity', 15, 4)->nullable();
            $table->decimal('maximum_quantity', 15, 4)->nullable();
            $table->decimal('gross_weight', 15, 4)->nullable()->comment('Peso bruto');
            $table->decimal('net_weight', 15, 4)->nullable()->comment('Peso líquido');
            $table->decimal('packing_weight', 15, 4)->nullable()->comment('Peso da emablagem');
            $table->tinyInteger('is_to_move_the_stock')->default(0)->comment('Movimentar estoque');
            $table->tinyInteger('is_product_for_scales')->default(0)->comment('Produto para pesar na balança');
            $table->text('private_note')->nullable();
            $table->text('public_note')->nullable();
            $table->tinyInteger('is_discontinued')->nullable()->comment('Item descontinuado');
            $table->foreignId('unit_id')->constrained('unit');
            $table->foreignId('category_id')->nullable()->constrained('category');
            $table->foreignId('brand_id')->nullable()->constrained('brand');
            $table->foreignId('size_id')->nullable()->constrained('size');
            $table->foreignId('storage_location_id')->nullable()->constrained('storage_location');
            $table->tinyInteger('genre')->default(0)->comment('[0=Masculino, 1=Feminino, 2=Unissex]');
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
        Schema::dropIfExists('product');
    }
};
