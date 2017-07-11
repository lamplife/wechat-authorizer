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



    /**
     *  获取授权方的帐号基本信息
     *
     *  @author 狂奔的螞蟻 <www.firstphp.com>
     */
    public function getAuthorizerInfo($authorizerAppid, $accessToken)
    {
        return $this->http->post('cgi-bin/component/api_get_authorizer_info?component_access_token='.$accessToken, [
            'json' => [
                'component_appid' => $this->appId,
                'authorizer_appid' => $authorizerAppid
            ]
        ]);
    }



    /**
     * 授权公众号或小程序的接口调用凭据
     */
    public function getAuthorizerToken($authorizer, $accessToken)
    {
        return $this->http->post('cgi-bin/component/api_authorizer_token?component_access_token='.$accessToken, [
            'json' => [
                'component_appid' => $authorizer['component_appid'],
                'authorizer_appid' => $authorizer['authorizer_appid'],
                'authorizer_refresh_token' => $authorizer['authorizer_refresh_token']
            ]
        ]);
    }



    /**
     * 修改服务器地址
     */
    public function modifyDomain($authorizerAccessToken)
    {
        return $this->http->post('wxa/modify_domain?access_token='.$authorizerAccessToken, [
            'json' => [
                'action' => 'add',
                'requestdomain' => ['https:www.weiba789.com'],
                'wsrequestdomain' => ['https:www.weiba789.com'],
                'uploaddomain' => ['https:www.weiba789.com'],
                'downloaddomain' => ['https:www.weiba789.com']
            ]
        ]);
    }



    /**
     * 绑定小程序体验者
     */
    public function bindTester($testid, $accessToken)
    {
        return $this->http->post('wxa/bind_tester?access_token='.$accessToken, [
            'json' => [
                'wechatid' => $testid
            ]
        ]);
    }



    /**
     * 获取授权小程序帐号的可选类目
     */
    public function getCategory($authorizerAccessToken)
    {
        return $this->http->get('wxa/get_category?access_token='.$authorizerAccessToken, [
            'json' => []
        ]);
    }



    /**
     * 为授权的小程序帐号上传小程序代码
     */
    public function wxappCommit($templateId, $extJson, $userVersion, $userDesc, $authorizerAccessToken)
    {
        return $this->http->post('wxa/commit?access_token='.$authorizerAccessToken, [
            'json' => [
                'template_id' => $templateId,
                'ext_json' => $extJson,
                'user_version' => $userVersion,
                'user_desc' => $userDesc,
            ]
        ]);
    }



}