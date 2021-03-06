<?php
/**
 * Created by PhpStorm.
 * User: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2017/7/6
 * Time: 下午7:28
 */
namespace Firstphp\Wechat\Bridge;

use GuzzleHttp\Client;

class Http {

    /**
     * base uri
     */
    const BASE_URI = 'https://api.weixin.qq.com/';

    protected $client;
    protected $componentToken;
    protected $componentAppid;
    protected $authorizerToken;

    protected $uploadType;


    public function __construct($baseUri = '')
    {
        $this->client = new Client([
            'base_uri' => $baseUri ? $baseUri : static::BASE_URI,
            'timeout' => 200,
            'verify' => false,
        ]);
    }


    public function setComponentToken($componentToken)
    {
        $this->componentToken = $componentToken;
    }


    public function setAuthorizerToken($authorizerToken)
    {
        $this->authorizerToken = $authorizerToken;
    }


    public function setUploadType($type)
    {
        $this->uploadType = $type;
    }


    public function setComponentId()
    {
        $this->componentAppid = config('wechat.component_id');
    }


    public function __call($name, $arguments)
    {
        if ($this->componentToken) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?').'component_access_token='.$this->componentToken;
        }
        if ($this->componentAppid) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?').'component_appid='.$this->componentAppid;
        }
        if ($this->authorizerToken) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?').'access_token='.$this->authorizerToken;
        }
        if ($this->uploadType) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?').'type='.$this->uploadType;
        }
        // 添加代理
        if (config('wechat.proxy')) {
            if (isset($arguments[1])) {
                $arguments[1] += ['proxy'=> config('wechat.proxy')];
            } else {
                $arguments[1] = ['proxy'=> config('wechat.proxy')];
            }
        }
        $response = json_decode($this->client->$name($arguments[0], $arguments[1])->getBody()->getContents(), true);
        if (isset($response['errcode']) && $response['errcode'] != 0) {
            return $response;
        }
        return $response;
    }


}