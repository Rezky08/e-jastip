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
        Schema::create('m_payment_method_accounts', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger("faculty_id");
            $table->unsignedBigInteger("payment_method_id");
            $table->string("name");
            $table->string("account");
            $table->string("qr")->nullable();
            $table->boolean("isActive")->default(true);
            $table->timestamps();

            $table->foreign('payment_method_id')
                ->references('id')
                ->on('m_payment_methods')
                ->onDelete('cascade');
//            $table->foreign('faculty_id')
//                ->references('id')
//                ->on('m_faculties')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_payment_method_accounts');
    }
};
