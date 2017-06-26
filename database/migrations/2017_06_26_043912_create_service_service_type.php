<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceServiceType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_service_type', function (Blueprint $table) {
            $table->integer('service_service_type_service_id')->unsigned()->default(null)->nullable();
            $table->integer('service_service_type_service_type_id')->unsigned()->default(null)->nullable();
            $table->primary(['service_service_type_service_id','service_service_type_service_type_id'],'id_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_service_type');
    }
}
