<?php
namespace Firstphp\Wechat\Providers;

use Illuminate\Support\ServiceProvider;
use Firstphp\Wechat\Services\WechatService;
use Illuminate\Support\Facades\Config;

class WechatServiceProvider extends ServiceProvider
{

    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../Config/Wechat.php';
        $this->publishes([$configPath => config_path('wechat.php')], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('WechatService', function () {
            $config = Config::get('wechat');
            return new WechatService($config['appid'], $config['appsecret'], $config['token'], $config['encoding_aes_key']);
        });

    }

}
