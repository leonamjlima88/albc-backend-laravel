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
        Schema::create('order_payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('order')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('bank_account_id')->constrained('bank');
            $table->foreignId('payment_option_id')->constrained('payment_option');
            $table->date('expire_at');
            $table->decimal('amount', 15, 4);
            $table->text('note')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_payment');
    }
};
