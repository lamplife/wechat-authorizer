<?php

namespace Firstphp\Wechat\Facades;

use Illuminate\Support\Facades\Facade;

class WechatFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'WechatService';
    }

}

