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
        Schema::create('t_transaction_attachments', function (Blueprint $table) {
            $table->uuid("id");
            $table->unsignedBigInteger("transaction_id")->nullable();
            $table->uuid("parent_id")->nullable();
            $table->uuid("attachment_id");
            $table->string("name");
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_transaction_attachments');
    }
};
