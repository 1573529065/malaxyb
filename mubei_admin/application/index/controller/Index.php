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
        $time = date('Y-m-d', time());

        $date_start = strtotime($time . '00:00:00');
        $date_end = strtotime($time . '23:59:59');

        $user_today = Db::table('mb_user')->where('time', '<=', $date_end)->where('time', '>=', $date_start)->count('u_id');
        $user_con = Db::table('mb_user')->count('u_id');
        $user_vip = Db::table('mb_user')->where('vip_static', 1)->count('u_id');
        $user = Db::table('mb_user')->order('era', 'asc')->paginate(20);
        $logined_user = Cookie::get('logined_user');

        $this->assign('user', $user);
        $this->assign('admin', $logined_user);
        $this->assign('user_con', $user_con);
        $this->assign('user_vip', $user_vip);
        $this->assign('user_today', $user_today);
        $fun = $request->action();
        $this->assign('fun', $fun);

        return $this->fetch();
    }

    public function index_v1()
    {
        return $this->fetch();
    }

    /**
     * 渲染首页第一页欢迎页
     */
    public function welcome()
    {
        return $this->fetch();
    }

    public function downloads()
    {
        $time = date('Y-m-d', time());

        $date_start = strtotime($time . '00:00:00');
        $date_end = strtotime($time . '23:59:59');
        $res = Db::table('amount_of_downloads')->where('time', '<=', $date_end)->where('time', '>=', $date_start)->select();
        if (!$res) {
            Db::table('amount_of_downloads')->insert([
                'num' => 1,
                'time' => $date_start,
            ]);
        } else {
            Db::table('amount_of_downloads')->where('time', $date_start)->setInc('num', 1);
        }

    }

    public function user_status_f()
    {
        $account = Request::instance()->param('u_id');
        $res = Db::table('mb_user')->where('u_id', $account)->setField('status', 1);
        if ($res) {
            return json(['code' => 1, 'msg' => '启用用户' . $account]);
        }

    }

    public function user_status_t()
    {
        $account = Request::instance()->param('u_id');
        $res = Db::table('mb_user')->where('u_id', $account)->setField('status', 2);
        if ($res) {
            return json(['code' => 1, 'msg' => '冻结用户' . $account]);
        }

    }


    public function look_html()
    {
        $time = date('Y-m-d', time());

        $date_start = strtotime($time . '00:00:00');
        $date_end = strtotime($time . '23:59:59');

        $user_today = Db::table('mb_user')->where('time', '<=', $date_end)->where('time', '>=', $date_start)->select();
        $this->assign('user', $user_today);
        return $this->fetch();
    }


    public function look_html_t()
    {
        $user = Db::table('mb_user')->select();
        $this->assign('user', $user);
        return $this->fetch();
    }

    public function look_html_v()
    {
        $user_vip = Db::table('mb_user')->where('vip_static', 1)->select();
        $this->assign('user', $user_vip);
        return $this->fetch();
    }

    public function user_status_ff()
    {
        $account = Request::instance()->param('u_id');
        $res = Db::table('vpay_admin')->where('a_id', $account)->setField('status', 1);
        if ($res) {
            return json(['code' => 1, 'msg' => '启用管理员']);
        }

    }

    public function user_status_tt()
    {
        $account = Request::instance()->param('u_id');
        $res = Db::table('vpay_admin')->where('a_id', $account)->setField('status', 2);
        if ($res) {
            return json(['code' => 1, 'msg' => '冻结管理员']);
        }

    }


    public function user_status_fff()
    {
        $account = Request::instance()->param('u_id');
        $res = Db::table('vpay_admin')->where('a_id', $account)->setField('type', 0);
        if ($res) {
            return json(['code' => 1, 'msg' => '启用操作权限']);
        }

    }

    public function user_status_ttt()
    {
        $account = Request::instance()->param('u_id');
        $res = Db::table('vpay_admin')->where('a_id', $account)->setField('type', 2);
        if ($res) {
            return json(['code' => 1, 'msg' => '取消操作权限']);
        }

    }


    public function user_vip1()
    {
        $account = Request::instance()->param('u_id');
        $res = Db::table('mb_user')->where('u_id', $account)->setField('vip_static', 1);
        if ($res) {


            return json(['code' => 1, 'msg' => '升级成功']);
        } else {
            return json(['code' => 2, 'msg' => '升级失败']);
        }

    }

    public function user_vip2()
    {
        $account = Request::instance()->param('u_id');
        $res = Db::table('mb_user')->where('u_id', $account)->setField('vip_static', 2);

        if ($res) {


            return json(['code' => 1, 'msg' => '取消成功']);
        } else {
            return json(['code' => 2, 'msg' => '取消失败']);
        }

    }

    public function select_user(Request $request)
    {
        $account = Request::instance()->param('u_id');
        $time = date('Y-m-d', time());
        $date_start = strtotime($time . '00:00:00');
        $date_end = strtotime($time . '23:59:59');
        $user_today = Db::table('mb_user')->where('time', '<=', $date_end)->where('time', '>=', $date_start)->count('u_id');
        $user_con = Db::table('mb_user')->count('u_id');
        $user_vip = Db::table('mb_user')->where('vip_static', 1)->count('u_id');

        if (strlen($account) <= 7) {
            $user = Db::table('mb_user')->where('u_id', 'like', '%' . $account . '%')->order('era', 'asc')->paginate(100);
        } else if (strlen($account) <= 12 && strlen($account) > 7) {
            $user = Db::table('mb_user')->where('tel', 'like', '%' . $account . '%')->order('era', 'asc')->paginate(100);
        }


        $logined_user = Cookie::get('logined_user');

        $this->assign('user', $user);
        $this->assign('admin', $logined_user);
        $this->assign('user_con', $user_con);
        $this->assign('user_vip', $user_vip);
        $this->assign('user_today', $user_today);
        $fun = $request->action();
        $this->assign('fun', $fun);

        return $this->fetch();


    }

    public function select_user_p1()
    {

        $order = Db::table('mb_user')->select();
        if ($order) {
            $str = '';
            foreach ($order as $v) {
                if ($v['f_uid'] == 0) {
                    $fuid = '初级会员';
                } else {
                    $fuid = $v['f_uid'];
                }
                if ($v['era'] == 0) {
                    $agent = '初';
                } else {
                    $agent = '第' . $v['era'];
                }
                if ($v['vip_static'] == 1) {
                    $vip = '是';
                } else {
                    $vip = '否';
                }
                if ($v['best_uid'] == 0) {
                    $best = '初级会员';
                } else {
                    echo $best = $v['best_uid'];
                }
                $delete = $v['u_id'];
                $time = date('Y-m-d H:i:s', $v['time']);
                $url1 = "/vpay_admin/public/index/user/send_message/account/" . $v['u_id'] . ".html";
                $url2 = "/vpay_admin/public/index/user/send_money/account/" . $v['u_id'] . ".html";
                $url3 = "/vpay_admin/public/index/user/delete_user/account/" . $v['u_id'] . ".html";
                $url4 = "/vpay_admin/public/index/user/subordinate/account/" . $v['u_id'] . ".html";
                $url5 = "/vpay_admin/public/index/user/money_order/account/" . $v['u_id'] . ".html";
                $url6 = "/vpay_admin/public/index/user/score_order/account/" . $v['u_id'] . ".html";
                if ($v['status'] == 1) {
                    $str .= "  <tr style=\"text-align: center\">
                                <td data-title=\"用户uid\">{$v['u_id']}</td>
                                <td data-title=\"用户昵称\" class=\"numeric\">{$v['user']}</td>
                                <td data-title=\"手机号码\" class=\"numeric\">{$v['tel']}</td>
                                <td data-title=\"余额\" class=\"numeric\">{$v['balance']}</td>
                                <td data-title=\"流通资产\" class=\"numeric\">{$v['current']}</td>
                                <td data-title=\"固定资产\" class=\"numeric\">{$v['assets']}</td>
                                <td data-title=\"最上级会员\" class=\"numeric\">{$best}</td>
                                <td data-title=\"上级会员\" class=\"numeric\">{$fuid}</td>
                                <td data-title=\"会员代级\" class=\"numeric\">{$agent}代</td>
                                <td data-title=\"是否为VIP会员\" class=\"numeric\">{$vip}</td>
                                <td data-title=\"注册时间\" class=\"numeric\">{$time}</td>
                                <td data-title=\"上次登陆ip\" class=\"numeric\">{$v['last_ip']}</td>
                                <td data-title=\"操作\" class=\"numeric\">
                                    <div class=\"btn-group\">
                                        <a class=\"btn green\" href=\"#\" data-toggle=\"dropdown\"><i class=\"icon-user\"></i> 会员管理<i class=\"icon-angle-down\"></i></a>
                                        <ul class=\"dropdown-menu\">
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('发送信息','$url1','400','400')\"><i class=\"icon-pencil\"></i>发送信息</a></li>
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('发送余额','$url2','400','400')\"><i class=\"icon-pencil\"></i>发送余额</a></li>
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('删除用户','$url3','400','400')\"><i class=\"icon-trash\"></i>删除用户</a></li>
                                        </ul>
                                    </div>

                                    <div class=\"btn-group\">
                                        <a class=\"btn purple\" href=\"#\" data-toggle=\"dropdown\">
                                            <i class=\"icon-user\"></i> 会员详情
                                            <i class=\"icon-angle-down\"></i>
                                        </a>
                                        <ul class=\"dropdown-menu\">
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('下级会员','$url4','400','400')\"><i class=\"icon-plus\"></i>查看下级会员</a></li>
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('余额记录','$url5','400','400')\"><i class=\"icon-trash\"></i>查看余额记录</a></li>
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('积分记录','$url6','400','400')\"><i class=\"icon-remove\"></i>查看积分记录</a></li>
                                        </ul>
                                    </div>
                                    <div class=\"btn-group\">
                                        <a class=\"btn red \" href=\"javascript:;\" onclick=\"dongjie({$delete})\"  data-toggle=\"dropdown\" >冻结</a></div>

                                </td>
                            </tr>";
                } else {
                    $str .= "  <tr style=\"text-align: center\">
                              <td data-title=\"用户uid\">{$v['u_id']}</td>
                                <td data-title=\"用户昵称\" class=\"numeric\">{$v['user']}</td>
                                <td data-title=\"手机号码\" class=\"numeric\">{$v['tel']}</td>
                                <td data-title=\"余额\" class=\"numeric\">{$v['balance']}</td>
                                <td data-title=\"流通资产\" class=\"numeric\">{$v['current']}</td>
                                <td data-title=\"固定资产\" class=\"numeric\">{$v['assets']}</td>
                                <td data-title=\"最上级会员\" class=\"numeric\">{$best}</td>
                                <td data-title=\"上级会员\" class=\"numeric\">{$fuid}</td>
                                <td data-title=\"会员代级\" class=\"numeric\">{$agent}代</td>
                                <td data-title=\"是否为VIP会员\" class=\"numeric\">{$vip}</td>
                                <td data-title=\"注册时间\" class=\"numeric\">{$time}</td>
                                <td data-title=\"上次登陆ip\" class=\"numeric\">{$v['last_ip']}</td>
                                <td data-title=\"操作\" class=\"numeric\">
                                    <div class=\"btn-group\">
                                        <a class=\"btn green\" href=\"#\" data-toggle=\"dropdown\"><i class=\"icon-user\"></i> 会员管理<i class=\"icon-angle-down\"></i></a>
                                        <ul class=\"dropdown-menu\">
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('发送信息','$url1','400','400')\"><i class=\"icon-pencil\"></i>发送信息</a></li>
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('发送余额','$url2','400','400')\"><i class=\"icon-pencil\"></i>发送余额</a></li>
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('删除用户','$url3','400','400')\"><i class=\"icon-trash\"></i>删除用户</a></li>
                                        </ul>
                                    </div>

                                    <div class=\"btn-group\">
                                        <a class=\"btn purple\" href=\"#\" data-toggle=\"dropdown\">
                                            <i class=\"icon-user\"></i> 会员详情
                                            <i class=\"icon-angle-down\"></i>
                                        </a>
                                        <ul class=\"dropdown-menu\">
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('下级会员','$url4','400','400')\"><i class=\"icon-plus\"></i>查看下级会员</a></li>
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('余额记录','$url5','400','400')\"><i class=\"icon-trash\"></i>查看余额记录</a></li>
                                            <li><a href=\"javascript:;\" onclick=\"admin_add('积分记录','$url6','400','400')\"><i class=\"icon-remove\"></i>查看积分记录</a></li>
                                        </ul>
                                    </div>
                                    <div class=\"btn-group\">
                                        <a class=\"btn green \" href=\"javascript:;\" onclick=\"qiyong({$delete})\"  data-toggle=\"dropdown\" >启用</a></div>

                                </td>
                            </tr>";
                }

            }

            return json(['code' => 1, 'msg' => $str]);
        }
    }


}