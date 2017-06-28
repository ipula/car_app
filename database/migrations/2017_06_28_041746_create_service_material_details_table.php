<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceMaterialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_material_detail', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('service_material_detail_id')->unsigned()->nullable(false);
            $table->integer('service_material_detail_service_material_id')->unsigned()->default(null)->nullable();
            $table->integer('service_material_detail_job_card_detail_id')->unsigned()->default(null)->nullable();
            $table->decimal('service_material_unit_price',10,2)->default(null);
            $table->decimal('service_material_detail_qty',10,2)->default(null);
            $table->timestamps();

            $table->foreign('service_material_detail_service_material_id','id_foreign')->references('service_material_id')->on('service_material')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('service_material_detail_job_card_detail_id','id')->references('job_card_detail_id')->on('job_card_detail')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_material_detail');
    }
}
