<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(\App\Models\Master\User\User::getTableName(), function (Blueprint $table) {
            foreach (\App\Models\Master\User\User::getAvailableSocialLoginDrivers() as $key) {
                $table->string($key)->after('email')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(\App\Models\Master\User\User::getTableName(), function (Blueprint $table) {
            $table->dropColumn('google_id');
        });
    }
};
