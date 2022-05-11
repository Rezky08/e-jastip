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
        Schema::table(\App\Models\Transaction\Transaction::getTableName(),function (Blueprint $table){

            $table->foreign('user_id')
                ->references('id')
                ->on('m_users')
                ->onDelete('cascade');

            $table->foreign('faculty_id')
                ->references('id')
                ->on('m_faculties')
                ->onDelete('cascade');

            $table->foreign('study_program_id')
                ->references('id')
                ->on('m_study_programs')
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
        Schema::table(\App\Models\Transaction\Transaction::getTableName(),function (Blueprint $table){
            $table->dropForeign('t_transactions_faculty_id_foreign');
            $table->dropForeign('t_transactions_study_program_id_foreign');
            $table->dropForeign('t_transactions_user_id_foreign');
        });
    }
};
