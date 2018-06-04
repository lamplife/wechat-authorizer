<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_component', function (Blueprint $table) {
            $table->increments('id');
            $table->char('appid', 20)->comment('小程序appid');
            $table->char('name', 100)->comment('小程序名称');
            $table->char('appsecret', 50)->comment('小程序secret');
            $table->string('apptoken', 255)->default('')->comment('公众号消息校验Token');
            $table->string('encoding_aes_key', 255)->default('')->comment('公众号消息加解密Key');
            $table->string('access_token', 255)->default('')->comment('access_token');
            $table->dateTime('access_token_updated')->comment('access_token更新时间');
            $table->string('verify_ticket', 255)->default('');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wechat_component');
    }
}
