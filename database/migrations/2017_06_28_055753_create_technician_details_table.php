<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnicianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician_detail', function (Blueprint $table) {
            $table->increments('technician_detail_id')->unsigned()->nullable(false);
            $table->integer('technician_detail_job_card_detail_id')->unsigned()->default(null)->nullable();
            $table->integer('technician_detail_technician_id')->unsigned()->default(null)->nullable();
            $table->timestamps();

            $table->foreign('technician_detail_job_card_detail_id','id_foreign_id')->references('job_card_detail_id')->on('job_card_detail')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('technician_detail_technician_id','id_detail')->references('technician_id')->on('technician')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technician_detail');
    }
}
