<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/12
 * Time: 14:45
 */

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Loader;
use think\Request;
use think\Cache;

class Send extends Controller
{

   public function juhecurl($url,$params=false,$ispost=0){
       $httpInfo = array();
       $ch = curl_init();
       curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
       curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
       curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
       curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
       curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
       if( $ispost )
       {
           curl_setopt( $ch , CURLOPT_POST , true );
           curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
           curl_setopt( $ch , CURLOPT_URL , $url );
       }
       else
       {
           if($params){
               curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
           }else{
               curl_setopt( $ch , CURLOPT_URL , $url);
           }
       }
       $response = curl_exec( $ch );
       if ($response === FALSE) {
           //echo "cURL Error: " . curl_error($ch);
           return false;
       }
       $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
       $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
       curl_close( $ch );
       return $response;
   }




    public function res(){
        if (Cache::get('res')) {
            return jsonp(['code' => 2, 'msg' => '发送中!']);
        }else{
            Cache::set('res',true,60);
            $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
            $randStr = str_shuffle('1234567890');
            $rand = substr($randStr,0,5);
            $iphone = Request::instance()->param('phone');
            $smsConf = array(
                'key'   => '91ee57b789f1a4bbffda46c1417d50aa', //您申请的APPKEY
                'mobile'    => $iphone, //接受短信的用户手机号码
                'tpl_id'    => '81666', //您申请的短信模板ID，根据实际情况修改
                'tpl_value' =>'#code#='.$rand //您设置的模板变量，根据实际情况修改
            );

            $content = $this->juhecurl($sendUrl,$smsConf,1); //请求发送短信

            if($content){
                $result = json_decode($content,true);
                $error_code = $result['error_code'];
                if($error_code == 0){
                    //状态为0，说明短信发送成功
                    Cache::set($iphone,$rand,600);
                    return jsonp(['code' => 1, 'msg' => '短信发送成功！']);
//                echo "短信发送成功,短信ID：".$result['result']['sid'];
                }else{
                    //状态非0，说明失败
                    $msg = $result['reason'];
                    return jsonp(['code' => 2, 'msg' =>  "短信发送失败(".$error_code.")：".$msg]);
//                echo "短信发送失败(".$error_code.")：".$msg;
                }
            }else{
                //返回内容异常，以下可根据业务逻辑自行修改
                return jsonp(['code' => 2, 'msg' =>  "请求发送短信失败"]);
            }
        }


    }

    public function buy($phone){
        $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL

        $smsConf = array(
            'key'   => '91ee57b789f1a4bbffda46c1417d50aa', //您申请的APPKEY
            'mobile'    => $phone, //接受短信的用户手机号码
            'tpl_id'    => '81666', //您申请的短信模板ID，根据实际情况修改
        );

        $content = $this->juhecurl($sendUrl,$smsConf,1); //请求发送短信

        if($content){
            $result = json_decode($content,true);
            $error_code = $result['error_code'];
            if($error_code == 0){
                //状态为0，说明短信发送成功
                return json(['code' => 1, 'msg' => '短信发送成功！']);
//                echo "短信发送成功,短信ID：".$result['result']['sid'];
            }else{
                //状态非0，说明失败
                $msg = $result['reason'];
                return json(['code' => 2, 'msg' =>  "短信发送失败(".$error_code.")：".$msg]);
//                echo "短信发送失败(".$error_code.")：".$msg;
            }
        }else{
            //返回内容异常，以下可根据业务逻辑自行修改
            return json(['code' => 2, 'msg' =>  "请求发送短信失败"]);
        }

    }

    public function buyin($phone){
        $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL

        $smsConf = array(
            'key'   => '91ee57b789f1a4bbffda46c1417d50aa', //您申请的APPKEY
            'mobile'    => $phone, //接受短信的用户手机号码
            'tpl_id'    => '81666', //您申请的短信模板ID，根据实际情况修改
        );

        $content = $this->juhecurl($sendUrl,$smsConf,1); //请求发送短信

        if($content){
            $result = json_decode($content,true);
            $error_code = $result['error_code'];
            if($error_code == 0){
                //状态为0，说明短信发送成功
                return json(['code' => 1, 'msg' => '短信发送成功！']);
//                echo "短信发送成功,短信ID：".$result['result']['sid'];
            }else{
                //状态非0，说明失败
                $msg = $result['reason'];
                return json(['code' => 2, 'msg' =>  "短信发送失败(".$error_code.")：".$msg]);
//                echo "短信发送失败(".$error_code.")：".$msg;
            }
        }else{
            //返回内容异常，以下可根据业务逻辑自行修改
            return json(['code' => 2, 'msg' =>  "请求发送短信失败"]);
        }

    }

    public function buyout($phone){
        $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL

        $smsConf = array(
            'key'   => '91ee57b789f1a4bbffda46c1417d50aa', //您申请的APPKEY
            'mobile'    => $phone, //接受短信的用户手机号码
            'tpl_id'    => '81666', //您申请的短信模板ID，根据实际情况修改
        );

        $content = $this->juhecurl($sendUrl,$smsConf,1); //请求发送短信

        if($content){
            $result = json_decode($content,true);
            $error_code = $result['error_code'];
            if($error_code == 0){
                //状态为0，说明短信发送成功
                return json(['code' => 1, 'msg' => '短信发送成功！']);
//                echo "短信发送成功,短信ID：".$result['result']['sid'];
            }else{
                //状态非0，说明失败
                $msg = $result['reason'];
                return json(['code' => 2, 'msg' =>  "短信发送失败(".$error_code.")：".$msg]);
//                echo "短信发送失败(".$error_code.")：".$msg;
            }
        }else{
            //返回内容异常，以下可根据业务逻辑自行修改
            return json(['code' => 2, 'msg' =>  "请求发送短信失败"]);
        }

    }
}