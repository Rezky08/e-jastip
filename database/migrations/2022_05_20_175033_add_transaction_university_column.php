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
        Schema::table(\App\Models\Transaction\Transaction::getTableName(),function (Blueprint $table) {
            $table->unsignedBigInteger('university_id')->after('student_id')->nullable();

            $table->foreign('university_id')
                ->references('id')
                ->on('m_universities')
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
        Schema::table(\App\Models\Transaction\Transaction::getTableName(),function (Blueprint $table) {
            $table->dropColumn('university_id');
        });
    }
};
