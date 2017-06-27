<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_card', function (Blueprint $table) {
            $table->increments('job_card_id')->unsigned()->nullable(false);
            $table->decimal('job_card_total',10,2)->default(null)->nullable();
            $table->integer('job_card_vehicle_id')->unsigned()->default(null)->nullable();
            $table->integer('job_card_users_id')->unsigned()->default(null)->nullable();
            $table->integer('job_card_status')->default(null)->nullable();
            $table->timestamps();

            $table->foreign('job_card_vehicle_id')->references('vehicle_id')->on('vehicle')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_card_users_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_card');
    }
}
