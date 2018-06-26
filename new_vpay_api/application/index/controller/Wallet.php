<?php

namespace app\index\controller;

use think\Cache;
use think\Controller;
use think\Cookie;
use think\Db;
use think\Lang;
use think\Request;
use think\Log;

class Wallet extends Controller
{

    public function zichan()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $user_arr = Db::table('mb_assets_order')
                ->where('u_id', $user)
                ->order('ao_time desc')
                ->field('type,ao_money,ao_time')
                ->limit(500)
                ->select();

            foreach ($user_arr as $k => $v) {
                $message = '';
                switch ($v['type']) {
                    case 1:
                        $message = '每日释放';
                        break;
                    case 2:
                        $message = '加速释放';
                        break;
                    case 3:
                        $message = '兑换积分';
                        break;
                    case 4:
                        $message = '转入';
                        break;
                    case 5:
                        $message = '转出';
                        break;
                    case 8:
                        $message = 'vip积分奖励';
                        break;
                    case 10:
                        $message = 'vip积分奖励';
                        break;

                }

                $user_arr[$k]['ao_time'] = date('Y-m-d H:i:s', $v['ao_time']);
                $user_arr[$k]['type'] = $message;
            }
            if ($user_arr) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $user_arr]);
            } else {
                return jsonp(['code' => 2, 'msg' => '参数错误', 'data' => $user_arr]);
            }
        }

    }

    public function liutong()
    {
        $user = Request::instance()->param('u_id');

        if ($user) {
            $user_arr = Db::table('mb_current_order')
                ->where('u_id', $user)
                ->order('co_time desc')
                ->field('co_money,target_uid,co_time,type')
                ->select();

            foreach ($user_arr as $k => $v) {
                $message = '';
                switch ($v['type']) {
                    case 1:
                        $message = '兑换固定资产';
                        break;
                    case 2:
                        $message = '余额兑换';
                        break;
                    case 3:
                        $message = '转入';
                        break;
                    case 4:
                        $message = '转出';
                        break;

                }

                $user_arr[$k]['co_time'] = date('Y-m-d H:i:s', $v['co_time']);
                $user_arr[$k]['type'] = $message;
            }
            if ($user_arr) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $user_arr]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据', 'data' => $user_arr]);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }

    public function yue()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $user_arr = Db::table('mb_balance_order')
                ->where('u_id', $user)
                ->order('bo_time desc')
                ->field('bo_money,target_uid,bo_time,type')
                ->limit(500)
                ->select();

            foreach ($user_arr as $k => $v) {
                switch ($v['type']) {
                    case 1:
                        $message = '每日释放';
                        break;
                    case 2:
                        $message = '兑换流动资产';
                        break;
                    case 3:
                        $message = '买入';
                        break;
                    case 4:
                        $message = '卖出';
                        break;
                    case 5:
                        $message = '加速释放';
                        break;
                    case 6:
                        $message = '转出';
                        break;
                    case 7:
                        $message = '转入';
                        break;
                    case 8:
                        $message = '兑换固定资产';
                        break;

                }

                $user_arr[$k]['bo_time'] = date('Y-m-d H:i:s', $v['bo_time']);
                $user_arr[$k]['type'] = $message;
            }
            if ($user_arr) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $user_arr]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据', 'data' => $user_arr]);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }
}
