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
        Schema::create('status_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')
                ->constrained('status')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('domain', 35)->index()->comment('[business_proposal, order, purchase_order, purchase, service_order]');
        });

        // Pendente (Pendente)
        $status_id = 1;
        DB::table('status')->insert([
            [
                'id' => $status_id,
                'name' => 'Pendente',
                'action' => 'pending',
                'created_at' => now(),
            ],
        ]);
        DB::table('status_tag')->insert([
            ['status_id' => $status_id, 'domain' => 'business_proposal'],
            ['status_id' => $status_id, 'domain' => 'order'],
            ['status_id' => $status_id, 'domain' => 'purchase_order'],
            ['status_id' => $status_id, 'domain' => 'purchase'],
            ['status_id' => $status_id, 'domain' => 'service_order'],
        ]);


        // Concluído (Concluído)
        $status_id = 2;
        DB::table('status')->insert([
            [
                'id' => $status_id,
                'name' => 'Concluído',
                'action' => 'closed',
                'created_at' => now(),
            ],
        ]);
        DB::table('status_tag')->insert([
            ['status_id' => $status_id, 'domain' => 'business_proposal'],
            ['status_id' => $status_id, 'domain' => 'order'],
            ['status_id' => $status_id, 'domain' => 'purchase_order'],
            ['status_id' => $status_id, 'domain' => 'purchase'],
            ['status_id' => $status_id, 'domain' => 'service_order'],
        ]);


        // Cancelado (Cancelado)
        $status_id = 3;
        DB::table('status')->insert([
            [
                'id' => $status_id,
                'name' => 'Cancelado',
                'action' => 'canceled',
                'created_at' => now(),
            ],
        ]);
        DB::table('status_tag')->insert([
            ['status_id' => $status_id, 'domain' => 'business_proposal'],
            ['status_id' => $status_id, 'domain' => 'order'],
            ['status_id' => $status_id, 'domain' => 'purchase_order'],
            ['status_id' => $status_id, 'domain' => 'purchase'],
            ['status_id' => $status_id, 'domain' => 'service_order'],
        ]);
            

        // Aguardando Aprovação (Pendente)
        $status_id = 4;
        DB::table('status')->insert([
            [
                'id' => $status_id,
                'name' => 'Aguardando Aprovação',
                'action' => 'pending',
                'created_at' => now(),
            ],
        ]);
        DB::table('status_tag')->insert([
            ['status_id' => $status_id, 'domain' => 'business_proposal'],
            ['status_id' => $status_id, 'domain' => 'purchase_order'],
            ['status_id' => $status_id, 'domain' => 'service_order'],
        ]);


        // Aguardando Peças (Pendente)
        $status_id = 5;
        DB::table('status')->insert([
            [
                'id' => $status_id,
                'name' => 'Aguardando Peças',
                'action' => 'pending',
                'created_at' => now(),
            ],
        ]);
        DB::table('status_tag')->insert([
            ['status_id' => $status_id, 'domain' => 'business_proposal'],
            ['status_id' => $status_id, 'domain' => 'service_order'],
        ]);


        // Executado (Pendente)
        $status_id = 6;
        DB::table('status')->insert([
            [
                'id' => $status_id,
                'name' => 'Executado',
                'action' => 'pending',
                'created_at' => now(),
            ],
        ]);
        DB::table('status_tag')->insert([
            ['status_id' => $status_id, 'domain' => 'service_order'],
        ]);


        // Passar Orçamento (Pendente)
        $status_id = 7;
        DB::table('status')->insert([
            [
                'id' => $status_id,
                'name' => 'Passar Orçamento',
                'action' => 'pending',
                'created_at' => now(),
            ],
        ]);
        DB::table('status_tag')->insert([
            ['status_id' => $status_id, 'domain' => 'business_proposal'],
            ['status_id' => $status_id, 'domain' => 'service_order'],
        ]);        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_tag');
    }
};
