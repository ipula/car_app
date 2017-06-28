<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('payment_id')->unsigned()->nullable(false);
            $table->integer('payment_invoice_no')->unsigned()->default(null)->nullable();
            $table->integer('payment_type')->unsigned()->default(null)->nullable();
            $table->decimal('payment_amount',10,2)->default(null)->nullable();
            $table->string('payment_detail',45)->default(null)->nullable();
            $table->date('payment_effective_date')->default(null)->nullable();
            $table->integer('payment_customer_id')->unsigned()->default(null)->nullable();
            $table->string('payment_bank',45)->default(null)->nullable();
            $table->string('payment_note',45)->default(null)->nullable();
            $table->string('payment_receipt_no',45)->default(null)->nullable();
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
        Schema::dropIfExists('payment');
    }
}
