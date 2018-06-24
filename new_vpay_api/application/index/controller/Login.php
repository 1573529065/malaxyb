<?php

namespace app\index\controller;

use think\Cache;
use think\Controller;
use think\Cookie;
use think\Db;
use think\Loader;
use think\Lang;
use think\Request;
use think\Log;

class Login extends Controller
{

    /**
     * 用户前端登录
     * @param account 用户名
     * @param password 用户名
     * @return \think\response\Jsonp
     */
    public function login_result()
    {

        header("Access-Control-Allow-Origin: *");
        $account = Request::instance()->param('account');
        $password = Request::instance()->param('password');

        if (empty($account) || empty($password)) return jsonp(['code' => 2, 'msg' => '参数错误！']);

        $is_account = Db::table('mb_user')->where('tel', $account)->whereOr('u_id', $account)->find();
//        $is_account = Db::query("SELECT * FROM  `mb_user` WHERE
//          `tel` =? OR  `u_id` =?", [$account, $account]
//        );
        if (!$is_account) return jsonp(['code' => 2, 'msg' => ' 账户不存在！']);

        $login = Db::table('mb_user')
            ->where('u_id', $account)
            ->whereOr('tel', $account)
            ->where('pass', md5($password))
            ->find();

//        $login = Db::query("select * from mb_user
//            where (u_id=? and pass=?) or (tel=? and pass=?)",
//            [$account, md5($password), $account, md5($password)]
//        );
        if ($login) {
            if ($login[0]['status'] == 2) {
                return jsonp([
                    'code' => 2,
                    'msg' => ' 账户已禁用！如需重新开通，请联系客服'
                ]);
            } else {
                $ip = $this->get_ip();
                Db::table('mb_user')
                    ->where('u_id', $login[0]['u_id'])
                    ->setField('last_ip', $ip);
                return jsonp([
                    'code' => 1,
                    'msg' => ' 登录成功！',
                    'u_id' => $login[0]['u_id']
                ]);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '密码错误！']);
        }

    }

    public function get_ip()
    {
        //判断服务器是否允许$_SERVER
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
        } else {
            //不允许就使用getenv获取
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } elseif (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }

        return $realip;
    }


}
