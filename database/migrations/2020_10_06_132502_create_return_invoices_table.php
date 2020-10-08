<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
          'invoice_id' => 'required',
                'remarks' => '',
                'totalAmount' => 'required',
                'discount' => 'required',
                'payableAmount' => 'required',*/
        Schema::create('return_invoices', function (Blueprint $table) {
            $table->id();//pk
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('totalAmount');
            $table->unsignedBigInteger('discount');
            $table->unsignedBigInteger('payableAmount');
            $table->string('remarks')->nullable();
            $table->index('invoice_id');//fk
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
        Schema::dropIfExists('return_invoices');
    }
}
