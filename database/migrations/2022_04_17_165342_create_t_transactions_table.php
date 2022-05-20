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
            $table->string('token')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('student_id');
            $table->string('name');
            $table->unsignedBigInteger('faculty_id');
            $table->unsignedBigInteger('study_program_id');
            $table->unsignedBigInteger('origin_province_id');
            $table->unsignedBigInteger('origin_city_id');
            $table->unsignedBigInteger('origin_district_id');
            $table->string('origin_zip_code');
            $table->text('origin_address');
            $table->unsignedBigInteger('destination_province_id');
            $table->unsignedBigInteger('destination_city_id');
            $table->unsignedBigInteger('destination_district_id');
            $table->string('destination_zip_code');
            $table->text('destination_address');
            $table->string('partner_shipment_code')->nullable();
            $table->string('partner_shipment_service')->nullable();
            $table->string('partner_shipment_price')->nullable();
            $table->string('partner_shipment_etd')->nullable();
            $table->integer('status')->default(\App\Models\Transaction\Transaction::TRANSACTION_STATUS_CREATED);
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
