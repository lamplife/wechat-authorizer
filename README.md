# wechat-authorizer
微信第三方授权 for laravel

安装扩展

	composer require firstphp/wechat:"2.5"


注册服务

	在config/app.php中的providers数组中添加如下：
	Firstphp\Wechat\Providers\WechatServiceProvider::class


发布配置

	php artisan vendor:publish
	[2 ] Provider: Firstphp\Wechat\Providers\WechatServiceProvider


数据表迁移

    php artisan migrate


编辑.env文件，设置如下

	COMPONENT_ID=1
	WECHAT_APPID=wxda93db123lafdu83d
	WECHAT_APPSECRET=87afeef9df90b74g4a8l9ca8d67b3742
	WECHAT_TOKEN=b5pxmw4bglFeh7Cz
	WECHAT_AES_KEY=mWm1DkAVBAZD2L1rs3QWKeoWa62wLumjqCXG9HifLdM


示例代码

	use Firstphp\Wechat\Facades\WechatFactory;
