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
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80)->index();
            $table->tinyInteger('status_action')->default(0)->comment('[0=Pendente, 1=Concluído, 2=Cancelado]');
            $table->timestamps();
        });

        DB::table('status')->truncate();
        DB::table('status')->insert([
            [
                'id' => 1,
                'name' => 'Aguardando Aprovação',
                'status_action' => 0,
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Aguardando Peças',
                'status_action' => 0,
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Cancelado',
                'status_action' => 2,
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Concluído',
                'status_action' => 1,
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Executado',
                'status_action' => 0,
                'created_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Passar Orçamento',
                'status_action' => 0,
                'created_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Pendente',
                'status_action' => 0,
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
        Schema::dropIfExists('status');
    }
};
