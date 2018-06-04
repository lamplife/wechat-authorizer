<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatAuthorizerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_authorizer', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('main_id')->default(0)->comment('授权主体ID');
            $table->tinyInteger('type')->comment('0:公众平台 1:小程序');
            $table->unsignedInteger('component_id')->comment('授权对象ID');
            $table->string('nick_name', 100)->default('');
            $table->string('head_img', 100)->default('');
            $table->string('user_name', 100)->default('');
            $table->string('authorizer_appid', 50)->default('');
            $table->string('authorizer_access_token', 500)->default('');
            $table->string('authorizer_refresh_token', 500)->default('');
            $table->string('js_ticket', 500)->default('');
            $table->string('func_info', 255)->default('');
            $table->dateTime('token_expires')->comment('TOKEN过期');
            $table->dateTime('ticket_expires');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->engine = 'MyISAM';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wechat_authorizer');
    }
}
