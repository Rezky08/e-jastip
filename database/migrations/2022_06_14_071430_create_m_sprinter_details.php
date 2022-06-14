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
        Schema::create(\App\Models\Master\Sprinter\Detail::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sprinter_id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->timestamp('phone_validated_at')->nullable();
            $table->timestamps();

            $table->foreign('sprinter_id')
                ->references('id')
                ->on(\App\Models\Master\Sprinter\Sprinter::getTableName())
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
        Schema::dropIfExists(\App\Models\Master\Sprinter\Detail::getTableName());
    }
};
