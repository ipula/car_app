<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrnPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grn_payment', function (Blueprint $table) {
            $table->increments('grn_payment_id')->unsigned()->nullable(false);
            $table->integer('grn_payment_grn_id')->unsigned()->default(null)->nullable();
            $table->integer('grn_payment_type')->unsigned()->default(null)->nullable();
            $table->decimal('grn_payment_amount',10,2)->default(null)->nullable();
            $table->string('grn_payment_detail',45)->default(null)->nullable();
            $table->date('grn_payment_effective_date')->default(null)->nullable();
//            $table->integer('payment_customer_id')->unsigned()->default(null)->nullable();
            $table->string('grn_payment_bank',45)->default(null)->nullable();
            $table->string('grn_payment_note',45)->default(null)->nullable();
            $table->string('grn_payment_receipt_no',45)->default(null)->nullable();
            $table->timestamps();

            $table->foreign('grn_payment_grn_id','payment_grn_id')->references('grn_id')->on('grn')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grn_payment');
    }
}
