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
        Schema::create('bank_account', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80)->index();
            $table->foreignId('bank_id')->constrained('bank');
            $table->string('agency', 30); 
            $table->string('agency_digit', 10)->nullable(); 
            $table->string('account', 30); 
            $table->string('account_digit', 10)->nullable(); 
            $table->string('type', 80)->nullable(); 
            $table->text('note')->nullable();
            $table->timestamps();
        });

        DB::table('bank_account')->truncate();
        DB::table('bank_account')->insert([
            [
                'name' => "Fundo Fixo",
                'bank_id' => 1,
                'agency' => '000',
                'account' => '000',
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
        Schema::dropIfExists('bank_account');
    }
};
