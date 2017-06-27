<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('invoice_no')->unsigned()->nullable(false);
            $table->date('invoice_date')->default(null)->nullable();
            $table->time('invoice_time')->default(null)->nullable();
            $table->decimal('invoice_total')->default(null)->nullable();
            $table->decimal('invoice_cash_pay',10,2)->default(null)->nullable();
            $table->decimal('invoice_card_pay',10,2)->default(null)->nullable();
            $table->decimal('invoice_cheque_pay',10,2)->default(null)->nullable();
            $table->integer('invoice_job_card_id')->unsigned()->default(null)->nullable();
            $table->integer('invoice_users_id')->unsigned()->default(null)->nullable();
            $table->decimal('invoice_discount_rate',10,2)->default(null)->nullable();
            $table->decimal('invoice_voucher_pay',10,2)->default(null)->nullable();


            $table->foreign('invoice_job_card_id')->references('job_card_id')->on('job_card')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('invoice_users_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
