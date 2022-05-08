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
        Schema::table('t_invoices',function (Blueprint $table){
            $table->unsignedBigInteger('payment_method_account_id')->after('status')->nullable();
            $table->foreign('payment_method_account_id')
                ->references('id')
                ->on('m_payment_method_accounts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_invoices',function (Blueprint $table){
//            $table->dropForeign('payment_method_account_id');
            $table->dropColumn('payment_method_account_id');
        });
    }
};
