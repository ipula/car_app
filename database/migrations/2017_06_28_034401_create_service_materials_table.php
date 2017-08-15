<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_material', function (Blueprint $table) {
            $table->increments('service_material_id')->unsigned()->nullable(false);
            $table->string('service_material_name',450)->default(null)->nullable();
            $table->string('service_material_code',450)->default(null)->nullable();
            $table->string('service_material_unit',450)->default(null)->nullable();
            $table->decimal('service_material_unit_price',10,2)->default(null);
            $table->decimal('service_material_low_qty',10,2)->default(null)->nullable();
            $table->decimal('service_material_max_qty',10,2)->default(null)->nullable();
            $table->decimal('service_material_reorder_level',10,2)->default(null)->nullable();
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
        Schema::dropIfExists('service_material');
    }
}
