<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();//pk
            $table->string('customerName');
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('totalAmount');
            $table->unsignedBigInteger('totalItems');
            $table->unsignedBigInteger('discount')->default(0);
            $table->unsignedBigInteger('payableAmount');
            $table->unsignedBigInteger('user_id');
            $table->index('user_id');
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
        Schema::dropIfExists('invoices');
    }
}
