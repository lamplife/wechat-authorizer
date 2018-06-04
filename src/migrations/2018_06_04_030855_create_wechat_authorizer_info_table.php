<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatAuthorizerInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_authorizer_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('authorizer_id')->comment('授权者ID');
            $table->unsignedInteger('main_id')->comment('授权主体ID');
            $table->char('nick_name', 50)->default('')->comment();
            $table->tinyInteger('is_authorized')->default(0)->comment('已授权：1  取消授权：0');
            $table->string('head_img', 255)->default('')->comment('头像');
            $table->tinyInteger('service_type_info')->default(0)->comment('0代表订阅号，1代表由历史老帐号升级后的订阅号，2代表服务号');
            $table->tinyInteger('verify_type_info')->default(-1)->comment('-1代表未认证，0代表微信认证，1代表新浪微博认证，2代表腾讯微博认证，3代表已资质认证通过但还未通过名称认证，4代表已资质认证通过、还未通过名称认证，但通过了新浪微博认证，5代表已资质认证通过、还未通过名称认证，但通过了腾讯微博认证');
            $table->char('user_name', 50)->comment('原始ID');
            $table->char('alias', 50)->comment('微信号');
            $table->string('qrcode_url', 255)->comment('二维码');
            $table->string('qrcode_local', 255)->comment('自行保存二维码地址');
            $table->string('subscribe_url', 255)->default('')->comment('一键关注');
            $table->text('authorizer_info')->comment('原始授权信息');
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
        Schema::dropIfExists('wechat_authorizer_info');
    }
}
