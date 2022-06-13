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
        Schema::table(\App\Models\Transaction\Order::getTableName(),function (Blueprint $table) {
            $table->string('receipt')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(\App\Models\Transaction\Order::getTableName(),function (Blueprint $table) {
            $table->dropColumn('receipt');
        });
    }
};
