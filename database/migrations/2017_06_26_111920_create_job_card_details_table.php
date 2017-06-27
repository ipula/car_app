<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_card_detail', function (Blueprint $table) {
            $table->increments('job_card_detail_id')->unsigned()->nullable(false);
            $table->integer('job_card_detail_job_card_id')->unsigned()->default(null)->nullable();
            $table->integer('job_card_detail_technician_id')->unsigned()->default(null)->nullable();
            $table->integer('job_card_detail_service_id')->unsigned()->default(null)->nullable();
            $table->integer('job_card_detail_service_type_id')->unsigned()->default(null)->nullable();
            $table->string('job_card_detail_comment',450)->default(null)->nullable();
            $table->integer('job_card_detail_status')->default(null)->nullable();
            $table->decimal('job_card_detail_quantity',10,2)->default(null)->nullable();
            $table->decimal('job_card_detail_unit_price',10,2)->default(null)->nullable();
            $table->timestamps();

            $table->foreign('job_card_detail_service_id')->references('service_id')->on('service')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_card_detail_job_card_id')->references('job_card_id')->on('job_card')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_card_detail_service_type_id')->references('service_type_id')->on('service_type')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_card_detail_technician_id')->references('technician_id')->on('technician')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_card_detail');
    }
}
