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
        Schema::create('person', function (Blueprint $table) {
            $table->id();
            $table->string('business_name', 80)->index();
            $table->string('alias_name', 80)->nullable()->index();
            $table->string('ein', 20)->unique()->index();
            $table->string('state_registration', 20)->nullable();
            $table->string('municipal_registration', 20)->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->string('address', 100)->index();
            $table->string('address_number', 15)->nullable();
            $table->string('complement', 100)->nullable();
            $table->string('district', 100);
            $table->foreignId('city_id')->constrained('city')->onUpdate('cascade')->onDelete('cascade');
            $table->string('reference_point', 100)->nullable();
            $table->string('phone_1', 40)->nullable();
            $table->string('phone_2', 40)->nullable();
            $table->string('phone_3', 40)->nullable();
            $table->string('company_email', 100)->nullable();
            $table->string('financial_email', 100)->nullable();
            $table->string('internet_page', 255)->nullable();
            $table->text('general_note')->nullable();
            $table->text('bank_note')->nullable();
            $table->text('commercial_note')->nullable();
            $table->integer('is_customer')->nullable();
            $table->integer('is_seller')->nullable();
            $table->integer('is_supplier')->nullable();
            $table->integer('is_carrier')->nullable();
            $table->integer('is_technician')->nullable();
            $table->integer('is_employee')->nullable();
            $table->integer('is_other')->nullable();
            $table->integer('is_final_customer')->default(0);
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
        Schema::dropIfExists('person');
    }
};
