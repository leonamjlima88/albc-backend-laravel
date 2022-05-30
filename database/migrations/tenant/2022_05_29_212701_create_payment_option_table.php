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
        Schema::create('payment_option', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80)->index();
            $table->tinyInteger('is_automatic_conference')->default(0);
            $table->timestamps();
        });

        DB::table('payment_option')->truncate();
        DB::table('payment_option')->insert([
            [
                'name' => 'Dinheiro',
                'is_automatic_conference' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Boleto',
                'is_automatic_conference' => 0,
                'created_at' => now(),
            ],
            [
                'name' => 'Cartão de Crédito',
                'is_automatic_conference' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Cartão de Débito',
                'is_automatic_conference' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Cheque',
                'is_automatic_conference' => 0,
                'created_at' => now(),
            ],
            [
                'name' => 'Pix',
                'is_automatic_conference' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Prazo',
                'is_automatic_conference' => 0,
                'created_at' => now(),
            ],
            [
                'name' => 'Ticket de Troca',
                'is_automatic_conference' => 1,
                'created_at' => now(),
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
        Schema::dropIfExists('payment_option');
    }
};
