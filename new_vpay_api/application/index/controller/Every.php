<?php

namespace app\index\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;

class Every extends Controller
{

    //检验用户累计积分是否到100万
    public function score_vip()
    {

        $num = Db::table('mb_user')->field('u_id,assets')->select();
        foreach ($num as $v) {
            $score = Db::table('mb_assets_order')
                ->where('u_id', $v['u_id'])
                ->where('ao_money', '>', 0)
                ->sum('ao_money');
            if ($score >= 1000000) {
                Db::table('mb_user')->where('u_id', $v['u_id'])->setField('vip_static', 1);
            }
        }
    }

    public function every()
    {
        $num = Db::table('mb_user')->field('u_id,assets,balance')->select();
        $config11 = Db::table('mb_config')->where('co_id', 5)->value('co_config');
        foreach ($num as $v) {
            $speed = sprintf("%.2f", substr(sprintf("%.3f", $v['assets'] * $config11 / 1000), 0, -2));
            if ($speed > $v['assets']) {
                $speed = $v['assets'];
            }
            if ($speed > 0) {
                $time = date('Y-m-d', time());
                $date_start = strtotime($time . '00:00:00');
                $date_end = strtotime($time . '23:59:59');
//                Db::table('mb_user')->where('u_id',$v['u_id'])->setDec('assets',$speed);
//                Db::table('mb_user')->where('u_id',$v['u_id'])->setInc('balance',$speed);
                Db::table('mb_assets_order')->insert([
                    'u_id' => $v['u_id'],
                    'ao_money' => -$speed,
                    'former_money' => $v['assets'],
                    'ao_time' => time(),
                    'type' => 1,
                ]);
                Db::table('mb_balance_order')->insert([
                    'u_id' => $v['u_id'],
                    'bo_money' => $speed,
                    'former_money' => $v['balance'],
                    'bo_time' => time(),
                    'type' => 1,
                ]);
            }

        }
    }


}