<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class LoginController extends Controller
{
    public function login(){
        return view('index.login');
    }
    public function reg(){
        return view('index.reg');
    }
    public function sendSms(Request $request){
        $mobile = $request->mobile;
        //php 验证手机号
        $reg = '/^1[3|5|6|7|8|9]\d{9}$/';
        //dd(preg_match($reg,$mobile));
        if(!preg_match($reg,$mobile)){
            echo json_encode(['code'=>'00001','msg'=>'手机号格式不正确']);
        }
        $code =rand(100000,999999);
        //发送
        $res = $this->sendByMobile($mobile,$code);
        dd($res);
    }



    public function sendByMobile(){
        


        // Download：https://github.com/aliyun/openapi-sdk-php
        // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

        AlibabaCloud::accessKeyClient('LTAI4GA9LpAdDtHV8AbumP61', 'PrtDsAdnNyM7HhdGmIPaxo0ilovCRc')
                                ->regionId('cn-hangzhou')
                                ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                ->product('Dysmsapi')
                                // ->scheme('https') // https | http
                                ->version('2017-05-25')
                                ->action('SendSms')
                                ->method('POST')
                                ->host('dysmsapi.aliyuncs.com')
                                ->options([
                                                'query' => [
                                                'RegionId' => "cn-hangzhou",
                                                'PhoneNumbers' => "$mobile",
                                                'SignName' => "天王星",
                                                'TemplateCode' => "SMS_187952764",
                                                'TemplateParam' => "$code",
                                                ],
                                            ])
                                ->request();
            return print_r($result->toArray());
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }

    }
}
