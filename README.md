# wechat-authorizer
微信第三方授权 for laravel5.4

安装

	composer require firstphp/wechat:"2.2"


配置

	在config/app.php中的providers数组中添加 Firstphp\Wechat\Providers\WechatServiceProvider::class
	执行 php artisan vendor:publish --provider="Firstphp\Wechat\Facades\WechatServiceProvider" 用以生成配置文件


编辑.env文件，设置如下：

	COMPONENT_ID=1
	WECHAT_APPID=wxda93db123lafdu83d
	WECHAT_APPSECRET=87afeef9df90b74g4a8l9ca8d67b3742
	WECHAT_TOKEN=b5pxmw4bglFeh7Cz
	WECHAT_AES_KEY=mWm1DkAVBAZD2L1rs3QWKeoWa62wLumjqCXG9HifLdM


示例代码：

	use Firstphp\Wechat\Facades\WXFactory;
