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
        Schema::create('t_invoices', function (Blueprint $table) {
            $table->string("id",24);
            $table->integer('status')->default(\App\Models\Transaction\Invoice\Invoice::INVOICE_STATUS_CREATED);
            $table->timestamps();
            $table->primary("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_invoices');
    }
};
