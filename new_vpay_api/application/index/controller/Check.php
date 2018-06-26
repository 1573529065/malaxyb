<?php
/**
 * Created by @Panco.
 * User: @Panco
 * Date: 2017/10/9
 * Time: 16:33
 */

/**
 * 检测用户登陆状态基类检测类
 */

namespace app\index\controller;

use think\Controller;
use think\Cookie;

class Check extends Controller
{
    public function _initialize()
    {
        $logined_user = Cookie::get('login_ed');

        if (!$logined_user || $logined_user == null || $logined_user == '') {
            $this->redirect('index/user/login');
        }
    }


}