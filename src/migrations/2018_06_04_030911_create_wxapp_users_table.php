<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxappUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wxapp_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('main_id')->comment('主体ID');
            $table->unsignedInteger('authorizer_id')->comment('授权主体ID');
            $table->string('openid', 255)->default('')->comment('用户opendid');
            $table->string('session_key', 255)->default('')->comment();
            $table->string('token', 255)->default('')->comment();
            $table->dateTime('token_expires');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wxapp_users');
    }
}
