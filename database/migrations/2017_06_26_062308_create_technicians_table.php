<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician', function (Blueprint $table) {
            $table->increments('technician_id')->unsigned()->nullable(false);
            $table->string('technician_name',450)->default(null)->nullable();
            $table->string('technician_tel1',450)->default(null)->nullable();
            $table->string('technician_tel2',450)->default(null)->nullable();
            $table->string('technician_address',450)->default(null)->nullable();
            $table->string('technician_code',450)->default(null)->nullable();
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
        Schema::dropIfExists('technician');
    }
}
