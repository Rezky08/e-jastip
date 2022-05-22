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
        Schema::create('m_admin_universities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('university_id');
            $table->timestamps();


            $table
                ->foreign('admin_id')
                ->references('id')
                ->on(\App\Models\Master\Admin::getTableName())
                ->cascadeOnDelete();
            $table
                ->foreign('university_id')
                ->references('id')
                ->on(\App\Models\Master\University::getTableName())
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
        Schema::dropIfExists('m_admin_universities');
    }
};
