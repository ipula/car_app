<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->increments('vehicle_id')->unsigned()->nullable(false);
            $table->string('vehicle_cust_name',450)->default(null)->nullable();
            $table->string('vehicle_cust_tel1',450)->default(null)->nullable();
            $table->string('vehicle_cust_tel2',450)->default(null)->nullable();
            $table->string('vehicle_cust_address',450)->default(null)->nullable();
            $table->string('vehicle_engine_no',450)->default(null)->nullable();
            $table->string('vehicle_chassis_no',450)->default(null)->nullable();
            $table->integer('vehicle_vehicle_model_id')->unsigned()->default(null)->nullable();
            $table->integer('vehicle_vehicle_brand_id')->unsigned()->default(null)->nullable();
            $table->timestamps();

            $table->foreign('vehicle_vehicle_model_id')->references('brand_id')->on('brand')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('vehicle_vehicle_brand_id')->references('model_id')->on('model')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle');
    }
}
