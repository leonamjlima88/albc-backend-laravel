<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('payment_term_installment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_term_id')
                ->constrained('payment_term')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                $table->tinyInteger('range_in_days');
                $table->tinyInteger('bill_next_month_on_the_day')->nullable();
                $table->foreignId('bank_account_id')->constrained('bank_account');
                $table->foreignId('payment_option_id')->constrained('payment_option');
                $table->tinyInteger('is_to_apply_for_funding')->nullable();
        });

        DB::table('payment_term')->insert([
            [
                'name' => 'Dinheiro',
                'is_cents_in_the_last_installment' => 0,
                'created_at' => now(),
            ],
            [
                'name' => 'Boleto',
                'is_cents_in_the_last_installment' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Cartão de Crédito',
                'is_cents_in_the_last_installment' => 0,
                'created_at' => now(),
            ],
            [
                'name' => 'Cartão de Débito',
                'is_cents_in_the_last_installment' => 0,
                'created_at' => now(),
            ],
            [
                'name' => 'Cheque',
                'is_cents_in_the_last_installment' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Pix',
                'is_cents_in_the_last_installment' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Prazo',
                'is_cents_in_the_last_installment' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Ticket de Troca',
                'is_cents_in_the_last_installment' => 1,
                'created_at' => now(),
            ], 
        ]);

        DB::table('payment_term_installment')->insert([
            [
                'payment_term_id' => 1, // Dinheiro
                'range_in_days' => 0,
                'bank_account_id' => 1,
                'payment_option_id' => 1,
            ], 
            [
                'payment_term_id' => 2, // Boleto
                'range_in_days' => 5,
                'bank_account_id' => 1,
                'payment_option_id' => 2,
            ], 
            [
                'payment_term_id' => 3, // Cartão de Crédito
                'range_in_days' => 30,
                'bank_account_id' => 1,
                'payment_option_id' => 3,
            ], 
            [
                'payment_term_id' => 4, // Cartão de Débito
                'range_in_days' => 0,
                'bank_account_id' => 1,
                'payment_option_id' => 4,
            ], 
            [
                'payment_term_id' => 5, // Cheque
                'range_in_days' => 30,
                'bank_account_id' => 1,
                'payment_option_id' => 5,
            ], 
            [
                'payment_term_id' => 6, // Pix
                'range_in_days' => 0,
                'bank_account_id' => 1,
                'payment_option_id' => 6,
            ], 
            [
                'payment_term_id' => 7, // Prazo
                'range_in_days' => 30,
                'bank_account_id' => 1,
                'payment_option_id' => 7,
            ], 
            [
                'payment_term_id' => 8, // Ticket de Troca
                'range_in_days' => 0,
                'bank_account_id' => 1,
                'payment_option_id' => 8,
            ], 
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_term_installment');
    }
};
