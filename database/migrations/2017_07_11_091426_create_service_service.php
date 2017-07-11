<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_service', function (Blueprint $table) {
            $table->increments('service_service_id')->unsigned()->nullable(false);
            $table->integer('service_service_service_id')->unsigned()->default(null)->nullable();
            $table->integer('service_service_type_id')->unsigned()->default(null)->nullable();

            $table->foreign('service_service_service_id','foreign_service')->references('service_id')->on('service')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('service_service_type_id','id_type_service')->references('service_id')->on('service')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_service');
    }
}
