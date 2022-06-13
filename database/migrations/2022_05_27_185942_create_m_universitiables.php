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
        Schema::create('m_universitiables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('university_id');
            $table->morphs('universitiable');
            $table->timestamps();

            $table->foreign('university_id')
                ->references(\App\Models\Master\University::getInstance()->getKeyName())
                ->on(\App\Models\Master\University::getTableName())
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
        Schema::dropIfExists('m_universitiables');
    }
};
