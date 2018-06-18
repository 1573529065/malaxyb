<?php
/**
 * Created by @Panco.
 * User: @Panco
 * Date: 2017/10/9
 * Time: 10:03
 */

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Cookie;
use think\Request;

class Login extends Controller
{
    /**
     * 渲染首页
     */
    public function login()
    {

        return $this->fetch();
    }


    public function check_login(){
        $user = Request::instance()->param('account');
        $pass = Request::instance()->param('pass');
        $passmd5=md5($pass);

        if($user || $pass){
            $login = Db::table('vpay_admin')->where('account', $user)->where('pass', $passmd5)->find();
            if ($login) {
                $ip = $this->getIp();
                $city = $this->getIpInfo($ip);
                Db::table('vpay_admin')->where('account',$login['account'])->setField('ip',$ip);
                Db::table('vpay_admin')->where('account',$login['account'])->setField('city',$city['city']);
                Db::table('vpay_admin')->where('account',$login['account'])->setField('system',$this->is_mobile());

                Cookie::set('logined_user',$login,60*60*24*10000);
                return json(['code' => 1, 'msg' => '登陆成功！']);
            } else {
                return json(['code' => 2, 'msg' => '密码错误！']);
            }

        }else{
            return json(['code' => 2, 'msg' => '非法操作！']);
        }
    }

    public function getIpInfo($ip){
        if(empty($ip)) $ip=get_client_ip();  //get_client_ip()为tp自带函数，如没有，自己百度搜索。此处就不重复复制了
        $url='http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
        $result = file_get_contents($url);
        $result = json_decode($result,true);
        if($result['code']!==0 || !is_array($result['data'])) return false;
        return $result['data'];
    }
    public function is_mobile()
    {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $is_pc = (strpos($agent, 'windows nt')) ? true : false;
        $is_mac = (strpos($agent, 'mac os')) ? true : false;
        $is_iphone = (strpos($agent, 'iphone')) ? true : false;
        $is_android = (strpos($agent, 'android')) ? true : false;
        $is_ipad = (strpos($agent, 'ipad')) ? true : false;


        if($is_pc){
            return  'windows';
        }

        if($is_mac){
            return  'mac os';
        }

        if($is_iphone){
            return  'ios';
        }

        if($is_android){
            return  'android';
        }
        if($is_ipad){
            return  'ipad';
        }
    }
    public function getIp() {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else
            if ($_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
                $ip = $_SERVER['REMOTE_ADDR'];
            else
                if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
                    $ip = $_SERVER['REMOTE_ADDR'];
                else
                    $ip = "unknown";
        return ($ip);
    }

    public function out_login(){
        Cookie::delete('logined_user');
        $this->redirect('login');
    }


    public function update_pass(){
        return $this->fetch();
    }


    public function update_pass_p(){
        $user = Cookie::get('logined_user');
        $pass = Request::instance()->param('pass');
        $pass2 = Request::instance()->param('pass1');
        $pass1md5=md5($pass);
        $pass21md5=md5($pass2);
        if($user || $pass){
            $login = Db::table('vpay_admin')->where('account',$user['account'])->where('pass', $pass1md5)->find();
            if ($login) {
                Db::table('vpay_admin')->where('account',$user['account'])->setField('pass',$pass21md5);
                return json(['code' => 1, 'msg' => '修改密码成功！']);
            } else {
                return json(['code' => 2, 'msg' => '原密码错误！']);
            }

        }else{
            return json(['code' => 2, 'msg' => '非法操作！']);
        }
    }


}