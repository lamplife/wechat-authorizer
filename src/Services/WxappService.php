<?php
/**
 * Created by PhpStorm.
 * User: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2017/7/5
 * Time: 下午8:32
 */

namespace Firstphp\Wechat\Services;

use Illuminate\Support\Facades\Request;
use Firstphp\Wechat\Bridge\Http;
use Firstphp\Wechat\Bridge\MsgCrypt;

class WxappService {

    protected $appId;
    protected $appSecret;
    protected $token;
    protected $encodingAesKey;

    protected $client;


    public function __construct($appId='', $appSecret='', $token='', $encodingAesKey='')
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->token = $token;
        $this->encodingAesKey = $encodingAesKey;

        $this->http = new Http();
    }



    /**
     * 获取推送内容
     */
    public function getReceiveXml($postData = null, $getData = null)
    {
        $crypter = new MsgCrypt($this->token, $this->encodingAesKey, $this->appId);
        $postData = $postData ? : file_get_contents("php://input");
        $getData = $getData ? : Request::input();
        $result = $crypter->decryptMsg($getData['msg_signature'], $getData['timestamp'], $getData['nonce'], $postData);
        return $result;
    }


    /**
     * 获取第三方平台component_access_token
     */
    public function getAccessToken($verifyTicket = '')
    {
        return $this->http->post('cgi-bin/component/api_component_token', [
            'json' => [
                'component_appid' => $this->appId,
                'component_appsecret' => $this->appSecret,
                'component_verify_ticket' => $verifyTicket
            ]
        ]);

        /**
        $data = [
            'component_appid' => $this->appId,
            'component_appsecret' => $this->appSecret,
            'component_verify_ticket' => $verifyTicket
        ];

        return $this->client->post('cgi-bin/component/api_component_token',['form_params' => $data])->getBody();
        */
    }



    /**
     * 获取预授权码
     */
    public function getPreAuthCode($accessToken = '')
    {
        return $this->http->post('cgi-bin/component/api_create_preauthcode?component_access_token='.$accessToken, [
            'json' => [
                'component_appid' => $this->appId
            ]
        ]);
        return $result;
    }



    /**
     * 换取公众号或小程序之授权信息
     */
    public function queryAuth($authCode, $accessToken) {
        return $this->http->post('cgi-bin/component/api_query_auth?component_access_token='.$accessToken, [
            'json' => [
                'component_appid' => $this->appId,
                'authorization_code' => $authCode
            ]
        ]);
    }





}