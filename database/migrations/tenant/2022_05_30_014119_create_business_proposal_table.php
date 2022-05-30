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
        Schema::create('business_proposal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('person');
            $table->foreignId('seller_id')->constrained('person');
            $table->foreignId('status_id')->constrained('status');
            $table->text('private_note')->nullable();
            $table->text('public_note')->nullable();
            $table->date('offer_valid_until')->nullable()->comment('Proposta válida até');
            $table->date('delivery_forecast_until')->nullable()->comment('Previsão de entrega até');
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
        Schema::dropIfExists('business_proposal');
    }
};
