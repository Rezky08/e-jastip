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
        Schema::create('payment_method_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("payment_method_id");
            $table->string("account");
            $table->string("qr");
            $table->boolean("isActive")->default(true);
            $table->timestamps();

            $table
                ->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods')
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
        Schema::dropIfExists('payment_method_accounts');
    }
};
