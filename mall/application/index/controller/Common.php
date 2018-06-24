<?php

namespace app\index\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;

class Common extends Controller
{
    public function _initialize()
    {
        $logined_user = Cookie::get('logined_user');
        //dump($logined_user);exit;
        if (!$logined_user) {
            $this->redirect('index/login/login');
        } else {

            $module = Request::instance()->module();
            $contr = Request::instance()->controller();
            $ac = Request::instance()->action();
            $url = $module . '/' . $contr;
            //dump($module.$contr.$ac);exit;
            //$logined_user = Cookie::get('logined_user');
            $mall = Db::connect('mall');
            $menu = $mall->table('mall_menu')->where('me_level', '>=', $logined_user['type'])->order('order')->select();
            $node = $mall->table('mall_menu')->where('me_level', '>=', $logined_user['type'])->column('node');

            if (!in_array($url, $node)) {
                //$this->redirect('index/login/login');
                $this->success('对不起,你没有操作权限', 'index/Login/login');
            }
            $seller = $mall->table('mall_admin')->where('type', 2)->select();
            $this->assign('seller', $seller);
            $this->assign('admin', $logined_user);
            $this->assign('menu', $menu);
            $this->assign('fun', $module . $contr . $ac);
        }


    }


}
