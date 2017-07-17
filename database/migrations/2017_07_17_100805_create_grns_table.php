<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grn', function (Blueprint $table) {
            $table->increments('grn_id')->unsigned()->nullable(false);
            $table->date('grn_date')->default(null)->nullable();
            $table->time('grn_time')->default(null)->nullable();
            $table->decimal('grn_total',10,2)->default(null)->nullable();
            $table->integer('grn_no_of_items')->unsigned()->default(null)->nullable();
            $table->integer('grn_sup_id')->unsigned()->default(null)->nullable();
            $table->integer('grn_users_id')->unsigned()->default(null)->nullable();
            $table->decimal('grn_discount',10,2)->default(null)->nullable();
            $table->integer('grn_type')->unsigned()->default(null)->nullable();
            $table->timestamps();

            $table->foreign('grn_sup_id')->references('supplier_id')->on('supplier')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('grn_users_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grn');
    }
}
