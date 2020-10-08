<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*$table->unsignedBigInteger('invoice_id');//fk
        $table->unsignedBigInteger('item_id');//fk
        $table->unsignedBigInteger('qty');
        $table->unsignedBigInteger('price');
        $table->unsignedBigInteger('returnQty');
        $table->index('invoice_id');
        $table->index('item_id');
        $table->timestamps();*/
        Schema::create('return_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('return_invoice_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('qty');
            $table->unsignedBigInteger('price');
            $table->index('return_invoice_id');//fk
            $table->index('item_id');//fk
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
        Schema::dropIfExists('return_invoice_items');
    }
}
