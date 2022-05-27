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
        Schema::create('m_payment_method_accountables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payment_method_account_id');
            $table->morphs('payment_method_accountable');

            $table->foreign('payment_method_account_id')
                ->references(\App\Models\PaymentMethod\Account::getInstance()->getKeyName())
                ->on(\App\Models\PaymentMethod\Account::getTableName())
                ->onDelete('cascade');
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
        Schema::dropIfExists('m_payment_method_accountables');
    }
};
