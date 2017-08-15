<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Warranty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty', function (Blueprint $table) {
            $table->increments('warranty_id')->unsigned()->nullable(false);
            $table->string('warranty_no',450)->default(null)->nullable();
            $table->date('warranty_date')->default(null)->nullable();
            $table->time('warranty_time')->default(null)->nullable();
            $table->integer('warranty_vehicle_id')->unsigned()->default(null)->nullable();
            $table->timestamps();

            $table->foreign('warranty_vehicle_id')->references('vehicle_id')->on('vehicle')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warranty');
    }
}
