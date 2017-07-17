<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->increments('supplier_id')->unsigned()->nullable(false);
            $table->string('supplier_name',45)->nullable(false);
            $table->string('supplier_tel_no',45)->default(null)->nullable();
            $table->string('supplier_code',45)->default(null)->nullable();
            $table->string('supplier_cust_code',45)->default(null)->nullable();

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
        Schema::dropIfExists('supplier');
    }
}
