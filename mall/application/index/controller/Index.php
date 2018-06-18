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
use think\Log;
use think\Request;

class Index extends Common
{
    /**
     * 渲染首页
     */
    public function index(Request $request)
    {
        $time =date('Y-m-d', time());

        $date_start = strtotime($time.'00:00:00');
        $date_end = strtotime($time.'23:59:59');

        $user_today = Db::table('mb_user')->where('time','<=',$date_end)->where('time','>=',$date_start)->count('u_id');
        $user_con = Db::table('mb_user')->count('u_id');
        $user_vip = Db::table('mb_user')->where('vip_static',1)->count('u_id');
        $user = Db::table('mb_user')->order('era', 'asc')->paginate(100);
        $logined_user = Cookie::get('logined_user');

        $this->assign('user',$user);
        $this->assign('admin',$logined_user);
        $this->assign('user_con',$user_con);
        $this->assign('user_vip',$user_vip);
        $this->assign('user_today',$user_today);
        $fun=$request->action();
        $this->assign('fun',$fun);

        return $this->fetch();
    }

    
    /**
     * 渲染首页第一页欢迎页
     */
    public function welcome()
    {
        return $this->fetch();
    }
   




}