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
            $table->string('job_card_detail_comment',450)->unsigned()->default(null)->nullable();
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
        Schema::dropIfExists('job_card_detail');
    }
}
