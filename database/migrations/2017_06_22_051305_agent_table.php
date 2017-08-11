<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent', function (Blueprint $table) {
            $table->increments('agent_id')->unsigned()->nullable(false);
            $table->string('agent_name',450)->default(null)->nullable();
            $table->string('agent_tel1',450)->default(null)->nullable();
            $table->string('agent_tel2',450)->default(null)->nullable();
            $table->string('agent_address',450)->default(null)->nullable();
            $table->string('agent_code',450)->default(null)->nullable();
            $table->decimal('agent_discount',10,2)->default(null)->nullable();
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
        Schema::dropIfExists('agent');
    }
}
