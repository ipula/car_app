<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelServicePrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_service_price', function (Blueprint $table) {
            $table->increments('model_service_price_id')->unsigned()->nullable(false);
            $table->integer('model_service_price_model_id')->unsigned()->default(null)->nullable();
            $table->integer('model_service_price_service_id')->unsigned()->default(null)->nullable();
            $table->decimal('model_service_price',10,2)->default(null);

            $table->foreign('model_service_price_model_id','id_detail_model')->references('models_id')->on('models')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('model_service_price_service_id','id_detail_service')->references('service_id')->on('service')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_service_price');
    }
}
