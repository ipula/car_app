<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned()->nullable(false);
            $table->string('name',255)->default(null)->nullable();
            $table->string('email',255)->default(null)->nullable();
            $table->string('password',450)->default(null)->nullable();
            $table->string('role',450)->default(null)->nullable();
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
        Schema::dropIfExists('users');
    }
}
