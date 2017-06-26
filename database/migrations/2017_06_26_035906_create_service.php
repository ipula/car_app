<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
            $table->increments('service_id')->unsigned()->nullable(false);
            $table->string('service_name',450)->default(null)->nullable();
            $table->integer('service_models_id')->unsigned()->default(null)->nullable();
            $table->decimal('service_price',10,2)->default(null);
            $table->timestamps();

            $table->foreign('service_models_id')->references('models_id')->on('models')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service');
    }
}
