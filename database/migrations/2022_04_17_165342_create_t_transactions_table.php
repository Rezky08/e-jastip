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
        Schema::create('t_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('district_id');
            $table->string('zip_code');
            $table->text('address');
            $table->string('partner_shipment_code')->nullable();
            $table->string('partner_shipment_service')->nullable();
            $table->string('partner_shipment_price')->nullable();
            $table->string('partner_shipment_etd')->nullable();
            $table->string('file')->nullable();
            $table->integer('status')->default(\App\Models\Master\Transaction::TRANSACTION_STATUS_CREATED);
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
        Schema::dropIfExists('t_transactions');
    }
};
