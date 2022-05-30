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
        Schema::create('size', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80)->index();
            $table->timestamps();
        });

        DB::table('size')->truncate();
        DB::table('size')->insert([
            [
                'name' => 'PP',
                'created_at' => now(),
            ],
            [
                'name' => 'P',
                'created_at' => now(),
            ],
            [
                'name' => 'M',
                'created_at' => now(),
            ],
            [
                'name' => 'G',
                'created_at' => now(),
            ],
            [
                'name' => 'XG',
                'created_at' => now(),
            ],
            [
                'name' => '34',
                'created_at' => now(),
            ],
            [
                'name' => '36',
                'created_at' => now(),
            ],
            [
                'name' => '38',
                'created_at' => now(),
            ],
            [
                'name' => '40',
                'created_at' => now(),
            ],
            [
                'name' => '42',
                'created_at' => now(),
            ],
            [
                'name' => '44',
                'created_at' => now(),
            ],
            [
                'name' => '46',
                'created_at' => now(),
            ],
            [
                'name' => '48',
                'created_at' => now(),
            ],
            [
                'name' => '50',
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
        Schema::dropIfExists('size');
    }
};
