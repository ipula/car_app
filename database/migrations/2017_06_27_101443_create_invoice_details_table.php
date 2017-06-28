<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->increments('invoice_detail_id')->unsigned()->nullable(false);
            $table->integer('invoice_detail_invoice_no')->unsigned()->default(null)->nullable();
            $table->integer('invoice_detail_job_card_detail_id')->unsigned()->default(null)->nullable();
            $table->decimal('invoice_detail_qty',10,2)->default(null)->nullable();
            $table->string('invoice_detail_qty_string',45)->default(null)->nullable();
            $table->string('invoice_detail_unit',45)->default(null)->nullable();
            $table->decimal('invoice_detail_unit_price',10,2)->default(null)->nullable();
            $table->tinyInteger('invoice_detail_type')->default(null)->nullable();
            $table->decimal('invoice_detail_retail_price',10,2)->default(null)->nullable();
            $table->timestamps();
            $table->foreign('invoice_detail_invoice_no')->references('invoice_no')->on('invoice')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_detail');
    }
}
