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
        Schema::create('m_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_method_type_id');
            $table->string('code');
            $table->string('label');
            $table->string('icon');
            $table->timestamps();

            $table
                ->foreign('payment_method_type_id')
                ->references('id')
                ->on('m_payment_method_types')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_payment_methods');
    }
};
