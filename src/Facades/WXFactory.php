<?php

namespace Firstphp\Wechat\Facades;

use Illuminate\Support\Facades\Facade;

class WXFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'WxappService';
    }

}

