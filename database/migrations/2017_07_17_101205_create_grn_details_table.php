<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrnDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grn_detail', function (Blueprint $table) {
            $table->increments('grn_detail_id')->unsigned()->nullable(false);
            $table->integer('grn_detail_grn_id')->unsigned()->default(null)->nullable();
            $table->integer('grn_detail_service_material_id')->unsigned()->default(null)->nullable();
            $table->decimal('grn_detail_qty',10,3)->default(null)->nullable();
            $table->string('grn_detail_qty_string')->default(null)->nullable();
            $table->string('grn_detail_unit')->default(null)->nullable();
            $table->decimal('grn_detail_pur_unit_price',10,2)->default(null)->nullable();
            $table->integer('grn_detail_type')->unsigned()->default(null)->nullable();
            $table->timestamps();

            $table->foreign('grn_detail_grn_id')->references('grn_id')->on('grn')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('grn_detail_service_material_id')->references('service_material_id')->on('service_material')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grn_detail');
    }
}
