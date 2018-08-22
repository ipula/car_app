<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobCardWarrantyStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_card', function (Blueprint $table) {
            $table->tinyInteger('job_card_warranty_status',false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_card', function (Blueprint $table) {
            $table->dropColumn('job_card_warranty_status');
        });
    }
}
