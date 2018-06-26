<?php

namespace app\index\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;
use think\log;
use think\Cache;


class Turn extends Send
{


    public function inc_speed_p2($u_id, $money)
    {
        $c_uid = Db::table('vpay_user')
            ->where('u_id', $u_id)
            ->field('agentid,vip_static,speed,f_uid,u_id,best_uid')
            ->find();

        $f_uid_top = Db::table('vpay_user')
            ->where('u_id', $c_uid['best_uid'])
            ->field('vip_static,speed')
            ->find();

        $config1 = Db::table('vpay_config')
            ->where('c_id', 3)
            ->value('c_config');

        $config2 = Db::table('vpay_config')
            ->where('c_id', 4)
            ->value('c_config');

        $config3 = Db::table('vpay_config')
            ->where('c_id', 8)
            ->value('c_config');

        $config4 = Db::table('vpay_config')
            ->where('c_id', 9)
            ->value('c_config');

        if ($f_uid_top['vip_static'] == 1) { //最上级代理是否为vip
            if ($c_uid['speed'] == 0) {
                if ($c_uid['agentid'] == 1) { //该用户属于第几代会员,第一代会员影响f_uid
                    $f_speed = sprintf("%.2f", substr(sprintf("%.3f", $money * $config1 / 100), 0, -2));
                    $score = Db::table('vpay_user')
                        ->where('u_id', $c_uid['f_uid'])
                        ->value('score');

                    if ($score >= $f_speed) {
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setInc('money', $f_speed);

                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setDec('score', $f_speed);

                    } else if ($score < $f_speed) {
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setInc('money', $score);

                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setDec('score', $score);
                    }
                    $mon1 = Db::table('vpay_user')
                        ->where('u_id', $c_uid['f_uid'])
                        ->value('money');

                    Log::write($c_uid['f_uid'], 'notice');
                    Log::write($mon1, 'notice');
                    Db::table('vpay_score_order')->insert([
                        'u_id' => $c_uid['f_uid'],
                        'order_score' => -$f_speed,
                        'time' => time(),
                        'type' => 6,
                    ]);
                    Db::table('vpay_money_order')->insert([
                        'u_id' => $c_uid['f_uid'],
                        'order_money' => $f_speed,
                        'n_money' => $mon1,
                        'time' => time(),
                        'type' => 6,
                    ]);
                    Db::table('vpay_user')
                        ->where('u_id', $c_uid['u_id'])
                        ->setField('speed', 1);

                } else if ($c_uid['agentid'] <= 14 && $c_uid['agentid'] > 1) {//该用户属于第几代会员,第一代会员影响f_uid
                    $f_speed = sprintf("%.2f", substr(sprintf("%.3f", $money * $config1 / 100), 0, -2));
                    $f_speed_p2 = sprintf("%.2f", substr(sprintf("%.3f", $money * $config2 / 100), 0, -2));
                    $score = Db::table('vpay_user')
                        ->where('u_id', $c_uid['f_uid'])
                        ->value('score');

                    if ($score >= $f_speed) {
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setInc('money', $f_speed);
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setDec('score', $f_speed);
                    } else if ($score < $f_speed) {
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setInc('money', $score);
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setDec('score', $score);
                    }
                    $mon1 = Db::table('vpay_user')
                        ->where('u_id', $c_uid['f_uid'])
                        ->value('money');
                    Log::write($c_uid['f_uid'], 'notice');
                    Log::write($mon1, 'notice');
                    Db::table('vpay_score_order')->insert([
                        'u_id' => $c_uid['f_uid'],
                        'order_score' => -$f_speed,
                        'time' => time(),
                        'type' => 6,
                    ]);
                    Db::table('vpay_money_order')->insert([
                        'u_id' => $c_uid['f_uid'],
                        'order_money' => $f_speed,
                        'n_money' => $mon1,
                        'time' => time(),
                        'type' => 6,
                    ]);
                    $this->get_top_parentid($c_uid['f_uid'], $f_speed_p2);
                    $best_uid = Cache::get('best_uid' . $f_speed_p2);
                    if ($c_uid['best_uid'] == $best_uid) {
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['u_id'])
                            ->setField('speed', 1);
                    }
                }
            }
        } else {
            if ($c_uid['speed'] == 0) {
                if ($c_uid['agentid'] == 1) { //该用户属于第几代会员,第一代会员影响f_uid
                    Log::write('1', 'notice');

                    $f_speed = sprintf("%.2f", substr(sprintf("%.3f", $money * $config3 / 100), 0, -2));
                    $score = Db::table('vpay_user')
                        ->where('u_id', $c_uid['f_uid'])
                        ->value('score');
                    if ($score >= $f_speed) {
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setInc('money', $f_speed);
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setDec('score', $f_speed);
                    } else if ($score < $f_speed) {
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setInc('money', $score);
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setDec('score', $score);
                    }
                    $mon1 = Db::table('vpay_user')
                        ->where('u_id', $c_uid['f_uid'])
                        ->value('money');

                    Log::write($c_uid['f_uid'], 'notice');
                    Log::write($mon1, 'notice');
                    Db::table('vpay_score_order')->insert([
                        'u_id' => $c_uid['f_uid'],
                        'order_score' => -$f_speed,
                        'time' => time(),
                        'type' => 6,
                    ]);
                    Db::table('vpay_money_order')->insert([
                        'u_id' => $c_uid['f_uid'],
                        'order_money' => $f_speed,
                        'n_money' => $mon1,
                        'time' => time(),
                        'type' => 6,
                    ]);
                    Db::table('vpay_user')
                        ->where('u_id', $c_uid['u_id'])
                        ->setField('speed', 1);

                } else if ($c_uid['agentid'] <= 8 && $c_uid['agentid'] > 1) {//该用户属于第几代会员,第一代会员影响f_uid
                    Log::write('2', 'notice');
                    $f_speed = sprintf("%.2f", substr(sprintf("%.3f", $money * $config3 / 100), 0, -2));
                    $f_speed_p2 = sprintf("%.2f", substr(sprintf("%.3f", $money * $config4 / 100), 0, -2));
                    $score = Db::table('vpay_user')
                        ->where('u_id', $c_uid['f_uid'])
                        ->value('score');
                    if ($score >= $f_speed) {
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setInc('money', $f_speed);
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setDec('score', $f_speed);
                    } else if ($score < $f_speed) {
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setInc('money', $score);
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['f_uid'])
                            ->setDec('score', $score);
                    }
                    $mon1 = Db::table('vpay_user')
                        ->where('u_id', $c_uid['f_uid'])
                        ->value('money');

                    Log::write($c_uid['f_uid'], 'notice');
                    Log::write($mon1, 'notice');
                    Db::table('vpay_score_order')->insert([
                        'u_id' => $c_uid['f_uid'],
                        'order_score' => -$f_speed,
                        'time' => time(),
                        'type' => 6,
                    ]);
                    Db::table('vpay_money_order')->insert([
                        'u_id' => $c_uid['f_uid'],
                        'order_money' => $f_speed,
                        'n_money' => $mon1,
                        'time' => time(),
                        'type' => 6,
                    ]);
                    $this->get_top_parentid($c_uid['f_uid'], $f_speed_p2);
                    $best_uid = Cache::get('best_uid' . $f_speed_p2);
                    if ($c_uid['best_uid'] == $best_uid) {
                        Db::table('vpay_user')
                            ->where('u_id', $c_uid['u_id'])
                            ->setField('speed', 1);
                    }
                }
            }
        }

    }

    //余额兑换积分
    public function assets_exchange()
    {
        $user = Request::instance()->param('u_id');
        $money = Request::instance()->param('money');
        $pass_p = Request::instance()->param('pass_p');
        $type = Request::instance()->param('type');

        if (empty($user) || empty($money) || empty($pass_p) || empty($type))  return jsonp(['code' => 2, 'msg' => '参数错误！']);
        $check = Db::table('mb_user')
            ->where('u_id', $user)
            ->field('assets,speed,f_uid,best_uid,
            pay_pass,era,balance,level')
            ->find();
        $config1 = Db::table('mb_config')
            ->where('co_id', 7)
            ->value('co_config');
        if ($type == 2) { //余额兑换资产
            if (md5($pass_p) != $check['pay_pass']) return jsonp(['code' => 2, 'msg' => '支付密码错误！']);
            if ($check['balance'] < $money) return jsonp(['code' => 2, 'msg' => '余额不足！']);
            $accets = $money * $config1 / 100;
//            减少用户余额
            $res1 = Db::table('mb_user')
                ->where('u_id', $user)
                ->setDec('balance', $money);
//            增加用户积分
            $res2 = Db::table('mb_user')
                ->where('u_id', $user)
                ->setInc('assets', $accets);
//            增加用户积分记录 type = 3 :兑换积分
            $insert1 = Db::table('mb_assets_order')->insert([
                'u_id' => $user,
                'ao_money' => $accets,
                'former_money' => $check['assets'],
                'ao_time' => time(),
                'type' => 3,
            ]);
//            增加用户余额记录 type 8: 兑换固定资产
            $insert2 = Db::table('mb_balance_order')->insert([
                'u_id' => $user,
                'bo_money' => -$money,
                'former_money' => $check['balance'],
                'bo_time' => time(),
                'type' => 8,
            ]);
//            如果用户的等级大于0 ,说明有上级用户
            if ($check['era'] > 0) {
                $f_uid = Db::table('mb_user')
                    ->where('u_id', $check['f_uid'])
                    ->find();
//                推荐5个用户以上才会有释放加速
                $tuijian_num = Db::table('vpay_share_order')->where('u_id',$f_uid['u_id'])->select();
//                if ($tuijian_num >= 5){
                    if ($f_uid['vip_static'] == 1) {
//                       如果用户上级用户为 vip
                        $config11 = Db::table('mb_config')->where('co_id', 1)->value('co_config');
                    } else {
//                       用户上级为 普通用户
                        $config11 = Db::table('mb_config')
                            ->where('co_id', 3)
                            ->value('co_config');
                    }
                    $speed = sprintf("%.2f", substr(sprintf("%.3f", $accets * $config11 / 100), 0, -2));
                    if ($speed > 0) {
                        Db::table('mb_user')->where('u_id',$f_uid['u_id'])->setDec('assets',$speed);
                        Db::table('mb_user')->where('u_id',$f_uid['u_id'])->setInc('balance',$speed);

                        Db::table('mb_assets_order')->insert([
                            'u_id' => $f_uid['u_id'],
                            'ao_money' => -$speed,
                            'former_money' => $f_uid['assets'],
                            'ao_time' => time(),
                            'type' => 2,
                        ]);
                        Db::table('mb_balance_order')->insert([
                            'u_id' => $f_uid['u_id'],
                            'bo_money' => $speed,
                            'former_money' => $f_uid['balance'],
                            'bo_time' => time(),
                            'type' => 5,
                        ]);
                    }
//                }
                if ($f_uid['era'] != 0) {
                    $this->get_top_parentid($f_uid['f_uid'], $accets, $check['era']);
                }
            }
            $now = Db::table('mb_user')->where('u_id', $user)->field('balance,assets')->find();
            if ($res1 || $res2 || $insert1 || $insert2) {
                return jsonp(['code' => 1, 'msg' => '兑换成功！', 'data' => $now]);
            } else {
                return jsonp(['code' => 2, 'msg' => '兑换失败！']);
            }
        }
    }

    /**
     * 递归寻找最上级
     * @param $uid      用户上级u_id
     * @param $money    兑换金额
     * @param $c_num    兑换积分用户多少代
     */
    public function get_top_parentid($uid, $money, $c_num)
    {
        $r = Db::table('mb_user')->where('u_id', $uid)->find();
        $num = $c_num - $r['era'];
        if ($r['vip_static'] == 1) {
            $config12 = Db::table('mb_config')->where('co_id', 2)->value('co_config');
        } else{
            $config12 = Db::table('mb_config')->where('co_id', 4)->value('co_config');
        }
        $speed1 = sprintf("%.2f", substr(sprintf("%.3f", $money * $config12 / 100), 0, -2));
        if ($speed1 > 0) {
            Db::table('mb_user')->where('u_id',$r['u_id'])->setDec('assets',$speed1);
            Db::table('mb_user')->where('u_id',$r['u_id'])->setInc('balance',$speed1);
            Db::table('mb_assets_order')->insert([
                'u_id' => $r['u_id'],
                'ao_money' => -$speed1,
                'former_money' => $r['assets'],
                'ao_time' => time(),
                'type' => 2,
            ]);
            Db::table('mb_balance_order')->insert([
                'u_id' => $r['u_id'],
                'bo_money' => $speed1,
                'former_money' => $r['balance'],
                'bo_time' => time(),
                'type' => 5,
            ]);
        }
        if ($r['era'] >= 1 && $num <= 15) {
            $this->get_top_parentid($r['f_uid'], $money, $c_num);
        }else if ($r['era'] == 0 && $num <= 15) {
            Cache::set('best_uid', $r['u_id'], 10);
        }
    }


    //余额兑换流动资产
    public function current_exchange()
    {
        $user = Request::instance()->param('u_id');
        $money = Request::instance()->param('money');
        $pass_p = Request::instance()->param('pass_p');
        if ($user && $money && $pass_p) {
            $check = Db::table('mb_user')
                ->where('u_id', $user)
                ->field('current,balance,pay_pass')
                ->find();

            $config1 = Db::table('mb_config')
                ->where('co_id', 8)
                ->value('co_config');
            if (md5($pass_p) == $check['pay_pass']) {
                if ($check['balance'] < $money) {
                    return jsonp([
                        'code' => 2,
                        'msg' => '余额不足！'
                    ]);
                } else {

                    Log::write($user, 'notice');
                    $res1 = Db::table('mb_user')
                        ->where('u_id', $user)
                        ->setDec('balance', $money);
                    $res2 = Db::table('mb_user')
                        ->where('u_id', $user)
                        ->setInc('current', $money * $config1 / 100);

                    $insert1 = Db::table('mb_current_order')->insert([
                        'u_id' => $user,
                        'co_money' => $money * $config1 / 100,
                        'former_money' => $check['current'],
                        'co_time' => time(),
                        'type' => 2,
                    ]);
                    $insert2 = Db::table('mb_balance_order')->insert([
                        'u_id' => $user,
                        'bo_money' => -$money,
                        'former_money' => $check['balance'],
                        'bo_time' => time(),
                        'type' => 2,
                    ]);
                    $now = Db::table('mb_user')
                        ->where('u_id', $user)
                        ->field('balance,current,assets')
                        ->find();
                    if ($res1 || $res2 || $insert1 || $insert2) {
                        return jsonp([
                            'code' => 1,
                            'msg' => '兑换成功！',
                            'data' => $now
                        ]);
                    } else {
                        return jsonp(['code' => 2, 'msg' => '兑换失败！']);
                    }
                }
            } else {
                return jsonp(['code' => 2, 'msg' => '支付密码错误！']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误！']);
        }


    }

    public function turn_out_first_t()
    {
        $user = Request::instance()->param('u_id');
        $u_id = $user;

        if ($user) {
            $check = Db::table('mb_user')
                ->where('u_id', $user)
                ->field('u_id,tel')
                ->find();
            if ($u_id == $check['tel']) {
                return jsonp(['code' => 2, 'msg' => '收款人不能是自己！']);
            } else {

                if (strlen($u_id) <= 6) {
                    $res = Db::table('mb_user')
                        ->where('u_id', $u_id)
                        ->field('tel,user,u_img')
                        ->find();
                    if ($res) {
                        return jsonp([
                            'code' => 1,
                            'msg' => 'succeed',
                            'data' => $res
                        ]);
                    } else {
                        return jsonp(['code' => 2, 'msg' => '用户不存在！']);
                    }
                } else if (strlen($u_id) <= 11 && strlen($u_id) > 6) {
                    $res = Db::table('mb_user')
                        ->where('tel', $u_id)
                        ->field('tel,user,u_img')
                        ->find();
                    if ($res) {
                        return jsonp([
                            'code' => 1,
                            'msg' => 'succeed',
                            'data' => $res
                        ]);
                    } else {
                        return jsonp(['code' => 2, 'msg' => '用户不存在！']);
                    }
                }
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误！']);
        }
    }

    //余额转出第一步(识别用户)
    public function turn_out_first()
    {

        $user = Request::instance()->param('u_id');

        $u_id = Request::instance()->param('user_phone');


        if ($u_id && $user) {
            $check = Db::table('mb_user')
                ->where('u_id', $user)
                ->field('u_id,tel')
                ->find();


            if ($u_id == $check['u_id']) {
                return jsonp([
                    'code' => 2,
                    'msg' => '收款人不能是自己！'
                ]);
            } else {

                if (strlen($u_id) <= 6) {
                    $res = Db::table('mb_user')
                        ->where('u_id', $u_id)
                        ->field('u_id,tel,user,u_img')
                        ->find();
                    if ($res) {
                        return jsonp([
                            'code' => 1,
                            'msg' => 'succeed',
                            'data' => $res
                        ]);
                    } else {
                        return jsonp([
                            'code' => 2,
                            'msg' => '用户不存在！'
                        ]);
                    }
                } else if (strlen($u_id) <= 11 && strlen($u_id) > 6) {
                    $res = Db::table('mb_user')
                        ->where('tel', $u_id)
                        ->field('u_id,tel,user,u_img')
                        ->find();
                    if ($res) {
                        return jsonp([
                            'code' => 1,
                            'msg' => 'succeed',
                            'data' => $res
                        ]);
                    } else {
                        return jsonp([
                            'code' => 2,
                            'msg' => '用户不存在！'
                        ]);
                    }
                }
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误！']);
        }


    }

    /**
     * 余额转出第二部（记录与转出）
     * A转出给B A: 转出用户 B: 收款用户
     * @return \think\response\Jsonp
     */
    public function turn_out_two()
    {
        $type = Request::instance()->param('type');
        $pass_p = Request::instance()->param('pass_p');
        $user = Request::instance()->param('u_id'); // 转出用户u_id
        $money = Request::instance()->param('money');
        $phone = Request::instance()->param('phone'); // 收款用户手机号
//        var_dump($type,$pass_p,$user,$money,$phone);exit;
        if (empty($type) || empty($pass_p) || empty($user) || empty($money) || empty($phone)) return jsonp(['code' => 2, 'msg' => '参数错误！']);

//       收款用户信息
        $check = Db::table('mb_user')->where('tel', $phone)
            ->field('u_id,tel,assets,balance,pay_pass,vip_static,f_uid,era')
            ->find();
        if ($user == $check['u_id']) return jsonp(['code' => 2, 'msg' => '请输入对方手机号码！']);

        if ($type == 1) {  //余额互转
//            转出用户信息
            $userInfo = Db::table('mb_user')->where('u_id', $user)
                ->field('assets,balance,tel,pay_pass,u_id,vip_static,f_uid,era')
                ->find();
            if ($check['tel'] != $phone)  return jsonp(['code' => 2, 'msg' => '手机号码错误！']);
            if (md5($pass_p) != $userInfo['pay_pass']) return jsonp(['code' => 2, 'msg' => '支付密码错误！']);
            if ($userInfo['balance'] < $money) return jsonp(['code' => 2, 'msg' => '余额不足！']);

//           A 减去 转出余额 , 增加 (80% * 转出余额) 的积分
            $res2 = Db::table('mb_user')->where('u_id', $user)->setDec('balance', $money);
            $res2 = Db::table('mb_user')->where('u_id', $user)->setInc('assets', $money * 0.8);

            $insert2 = Db::table('mb_balance_order')->insert([
                'u_id' => $user,
                'bo_money' => -$money,
                'former_money' => $userInfo['balance'],
                'bo_time' => time(),
                'type' => 6, // 转出
                'target_uid' => $check['u_id'],
            ]);
            $insert4 = Db::table('mb_assets_order')->insert([
                'u_id' => $user,
                'ao_money' => $money * 0.8,
                'former_money' => $userInfo['assets'],
                'ao_time' => time(),
                'type' => 5, // 转出
            ]);

//           B 增加 (80% * 转出余额) 的余额 和 (20% * 转出余额) 的积分
            $res1 = Db::table('mb_user')->where('u_id', $check['u_id'])->setInc('balance', $money * 0.8);
            $res1 = Db::table('mb_user')->where('u_id', $check['u_id'])->setInc('assets', $money * 0.2);

            $insert1 = Db::table('mb_balance_order')->insert([
                'u_id' => $check['u_id'],
                'bo_money' => $money * 0.8,
                'former_money' => $check['balance'],
                'bo_time' => time(),
                'type' => 7, // 转入
                'target_uid' => $userInfo['u_id'],
            ]);
            $insert3 = Db::table('mb_assets_order')->insert([
                'u_id' => $check['u_id'],
                'ao_money' => $money * 0.2,
                'former_money' => $check['assets'],
                'ao_time' => time(),
                'type' => 4, // 转入
            ]);

//            $type1 = 3;
            if ($check['vip_static'] == 1 && $userInfo['vip_static'] == 1) {
                $type1 = 1;
//            } else if ($userInfo['vip_static'] == 2 || $check['vip_static'] == 2) {
            } else {
                $type1 = 2;
            }
            if ($userInfo['era'] > 0) {

                $this->inc_speed($userInfo['f_uid'], $money, $type1, $userInfo['era']);
            }

            $now = Db::table('mb_user')->where('u_id', $user)->field('balance,assets')->find();
            if ($res1 && $res2 && $insert1 && $insert2 && $insert3 && $insert4) {

                return jsonp(['code' => 1, 'msg' => '转出成功！', 'data' => $now]);
            } else {
                return jsonp(['code' => 2, 'msg' => '转出失败！']);
            }
        } else if ($type == 2) { //流通互转

        }
    }


    /**
     * 转出加速至最上级，vip获取金额8%的积分奖励
     * @param $u_id     转出用户上级u_id
     * @param $money    转出金额
     * @param $type    1.都是vip 2.只有一个是vip
     * @param $level    当前转出用户等级
     *
     */
    public function inc_speed($u_id, $money, $type, $level)
    {
        $fUserInfo = Db::table('mb_user')
            ->where('u_id', $u_id)
            ->field('era,vip_static,f_uid,u_id,best_uid,assets')
            ->find();
        Log::write($fUserInfo['u_id'], 'notice');
        Log::write($money, 'notice');
        Log::write($type, 'notice');
        if (($level - $fUserInfo['era']) <= 15) {
            if ($fUserInfo['vip_static'] == 1) {
                if ($type == 1) {
                    $config1 = Db::table('mb_config')->where('co_id', 10)->value('co_config');
                } else {
                    $config1 = Db::table('mb_config')->where('co_id', 9)->value('co_config');
                }
                $f_speed = sprintf("%.2f", substr(sprintf("%.3f", $money * $config1 / 100), 0, -2));
                Db::table('mb_user')->where('u_id', $fUserInfo['u_id'])->setInc('assets', $f_speed);
                Db::table('mb_assets_order')->insert([
                    'u_id' => $fUserInfo['u_id'],
                    'ao_money' => $f_speed,
                    'former_money' => $fUserInfo['assets'],
                    'ao_time' => time(),
                    'type' => 10, // vip 积分奖励
                ]);
            }
        }
        if (($level - $fUserInfo['era']) <= 15 && $fUserInfo['era'] > 0) {
            $this->inc_speed($fUserInfo['f_uid'], $money, $type, $level);
        }
    }


    //用户创建买入挂单
    public function purchase()
    {
        $user = Request::instance()->param('u_id');
        $money = Request::instance()->param('money');
        $pay_pass = Request::instance()->param('pay_pass');

        if (Cache::get('purchase' . $user)) {
            return jsonp(['code' => 4, 'msg' => '频率过快']);
        } else {
            if ($user && $money && $pay_pass) {
                Cache::set('purchase' . $user, true, 3);
                $check = Db::table('mb_user')->where('u_id', $user)->field('is_card,balance,pay_pass')->find();
                if ($check['pay_pass'] == md5($pay_pass)) {
                    if ($check['is_card'] != 0) {
                        $card = Db::table('mb_bank')->where('u_id', $user)->where('defult', 1)->value('b_id');
                        if ($card) {
                            if ($check['balance'] >= 100) {
                                $res1 = Db::table('mb_user')->where('u_id', $user)->setDec('balance', 100);
                                $res2 = Db::table('mb_sell_order')->insert([
                                    'u_id' => $user,
                                    'u_id_bank' => $card,
                                    'money' => $money,
                                    'time' => time(),
                                    'shi_money' => $money * 0.85,
                                    'type' => 1,
                                ]);
                                if ($res2) {
                                    return jsonp(['code' => 1, 'msg' => '订单创建成功']);
                                } else {
                                    return jsonp(['code' => 2, 'msg' => '订单创建失败']);
                                }
                            } else {
                                return jsonp(['code' => 2, 'msg' => '扣除保证金100失败，请兑换余额！']);
                            }
                        } else {
                            return jsonp(['code' => 2, 'msg' => '请设置默认银行卡！']);
                        }

                    } else {
                        return jsonp(['code' => 2, 'msg' => '请添加银行卡！']);
                    }

                } else {
                    return jsonp(['code' => 2, 'msg' => '支付密码错误！']);
                }
            } else {
                return jsonp(['code' => 2, 'msg' => '参数错误！']);
            }
        }


    }


    //用户创建卖出挂单
    public function sell_out()
    {
        $user = Request::instance()->param('u_id');
        $money = Request::instance()->param('money');
        $pay_pass = Request::instance()->param('pay_pass');
        if (Cache::get('sell_out' . $user)) {
            return jsonp(['code' => 4, 'msg' => '频率过快']);
        } else {
            if ($user && $money && $pay_pass) {
                Cache::set('sell_out' . $user, true, 3);
                $check = Db::table('mb_user')->where('u_id', $user)->field('is_card,balance,pay_pass')->find();

                if ($check['pay_pass'] == md5($pay_pass)) {
                    if ($check['is_card'] != 0) {
                        $card = Db::table('mb_bank')->where('u_id', $user)->where('defult', 1)->value('b_id');
                        if ($card) {
                            if ($check['balance'] >= $money) {
                                $res1 = Db::table('mb_user')->where('u_id', $user)->setDec('balance', $money);
                                $res2 = Db::table('mb_sell_order')->insert([
                                    'u_id' => $user,
                                    'u_id_bank' => $card,
                                    'money' => $money,
                                    'time' => time(),
                                    'shi_money' => $money * 0.85,
                                    'type' => 2,
                                ]);
                                if ($res1 && $res2) {
                                    return jsonp(['code' => 1, 'msg' => '订单创建成功']);
                                } else {
                                    return jsonp(['code' => 2, 'msg' => '订单创建失败']);
                                }
                            } else {
                                return jsonp(['code' => 2, 'msg' => '扣除余额失败，请兑换余额！']);
                            }
                        } else {
                            return jsonp(['code' => 2, 'msg' => '请设置默认银行卡！']);
                        }

                    } else {
                        return jsonp(['code' => 2, 'msg' => '请添加银行卡！']);
                    }

                } else {
                    return jsonp(['code' => 2, 'msg' => '支付密码错误！']);
                }
            } else {
                return jsonp(['code' => 2, 'msg' => '参数错误！']);
            }

        }


    }


    //用户买入余额挂单
    public function purchase_pay()
    {
        $user = Request::instance()->param('u_id');
        $pay_pass = Request::instance()->param('pay_pass');
        $so_id = Request::instance()->param('s_id');

        if (Cache::get('purchase_pay' . $user)) {
            return jsonp(['code' => 4, 'msg' => '频率过快']);
        } else {
            if ($user && $pay_pass && $so_id) {
                $check = Db::table('mb_user')->where('u_id', $user)->field('is_card,balance,pay_pass')->find();

                if ($check['is_card'] == 1) {
                    if ($check['pay_pass'] == md5($pay_pass)) {
                        $re2 = Db::table('mb_sell_order')->where('s_id', $so_id)->value('u_id');
                        if ($check['balance'] >= 100) {
                            Cache::set('purchase_pay' . $user, true, 3);
                            if ($re2 != $user) {
                                $card = Db::table('mb_bank')->where('u_id', $user)->where('defult', 1)->value('b_id');
                                if ($card) {
                                    $res5 = Db::table('mb_user')->where('u_id', $user)->setDec('balance', 100);
                                    $res2 = Db::table('mb_sell_order')->where('s_id', $so_id)->setField('static', 2);
                                    $res = Db::table('mb_sell_order')->where('s_id', $so_id)->setField('user', $user);
                                    $res3 = Db::table('mb_sell_order')->where('s_id', $so_id)->setField('user_bank', $card);

                                    $phone = Db::table('mb_user')->where('u_id', $re2)->value('tel');
                                    $conten = Send::buy($phone);
                                    if ($res2 && $res && $res3) {
                                        return jsonp(['code' => 1, 'msg' => '成功买入订单，请进行付款']);
                                    } else {
                                        return jsonp(['code' => 2, 'msg' => '订单买入失败']);
                                    }
                                } else {
                                    return jsonp(['code' => 2, 'msg' => '请设置默认银行卡！']);
                                }


                            } else {
                                return jsonp(['code' => 2, 'msg' => '不可买入自己发布的挂单']);
                            }
                        } else {
                            return jsonp(['code' => 2, 'msg' => '买入需要100保证金']);
                        }

                    } else {
                        return jsonp(['code' => 2, 'msg' => '支付密码错误！']);
                    }
                } else {
                    return jsonp(['code' => 3, 'msg' => '请绑定银行卡！']);
                }
            } else {
                return jsonp(['code' => 2, 'msg' => '参数错误！']);
            }
        }


    }

    //用户卖出余额
    public function sell()
    {
        $user = Request::instance()->param('u_id');
        $pay_pass = Request::instance()->param('pay_pass');
        $so_id = Request::instance()->param('s_id');
        if (Cache::get('sell' . $user)) {
            return jsonp(['code' => 2, 'msg' => '频率过快']);
        } else {
            if ($user && $pay_pass && $so_id) {

                $check = Db::table('mb_user')->where('u_id', $user)->field('is_card,balance,pay_pass')->find();
                if ($check['is_card'] == 1) {
                    if ($check['pay_pass'] == md5($pay_pass)) {
                        Cache::set('sell' . $user, true, 9);
                        $order = Db::table('mb_sell_order')->where('s_id', $so_id)->field('u_id,money')->find();

                        if ($order['u_id'] != $user) {
                            if ($check['balance'] >= $order['money']) {

                                $card = Db::table('mb_bank')->where('u_id', $user)->where('defult', 1)->value('b_id');
                                if ($card) {
                                    $res2 = Db::table('mb_sell_order')->where('s_id', $so_id)->setField('static', 2);
                                    $res = Db::table('mb_sell_order')->where('s_id', $so_id)->setField('user', $user);
                                    $res3 = Db::table('mb_sell_order')->where('s_id', $so_id)->setField('user_bank', $card);

                                    $res1 = Db::table('mb_user')->where('u_id', $user)->setDec('balance', $order['money']);
                                    $phone = Db::table('mb_user')->where('u_id', $order['u_id'])->value('tel');
                                    $conten = Send::buyin($phone);
                                    if ($res2 && $res && $res3 && $res1) {
                                        return jsonp(['code' => 1, 'msg' => '成功出售订单，请等待用户付款']);
                                    } else {
                                        return jsonp(['code' => 2, 'msg' => '订单出售失败']);
                                    }
                                } else {
                                    return jsonp(['code' => 2, 'msg' => '请设置默认银行卡！']);
                                }

                            } else {
                                return jsonp(['code' => 2, 'msg' => '余额不足，请兑换余额！']);
                            }
                        } else {
                            return jsonp(['code' => 2, 'msg' => '不可出售自己发布的挂单']);
                        }

                    } else {
                        return jsonp(['code' => 2, 'msg' => '支付密码错误！']);
                    }
                } else {
                    return jsonp(['code' => 3, 'msg' => '请绑定银行卡！']);
                }
            } else {
                return jsonp(['code' => 2, 'msg' => '参数错误！']);
            }

        }


    }

    //用户确认支付(此处不判断是否为卖方还是买方)
    public function result_pay()
    {
        $user = Request::instance()->param('u_id');
        $so_id = Request::instance()->param('s_id');
        $pay_pass = Request::instance()->param('pay_pass');
        if (Cache::get('result_pay' . $user)) {
            return jsonp(['code' => 4, 'msg' => '频率过快']);
        } else {
            if ($user && $so_id && $pay_pass) {
                Cache::set('result_pay' . $user, true, 3);
                $check = Db::table('mb_user')->where('u_id', $user)->field('is_card,balance,pay_pass')->find();

                if ($check['pay_pass'] == md5($pay_pass)) {


                    $re2 = Db::table('mb_sell_order')->where('s_id', $so_id)->field('u_id,user,type,static')->find();
                    if ($re2['static'] < 3) {
                        $res2 = Db::table('mb_sell_order')->where('s_id', $so_id)->setField('static', 3);
                        if ($re2['type'] == 1) {
                            $phone = Db::table('mb_user')->where('u_id', $re2['user'])->value('tel');
                            $conten = Send::buyout($phone);
                        } else if ($re2['type'] == 2) {
                            $phone = Db::table('mb_user')->where('u_id', $re2['u_id'])->value('tel');
                            $conten = Send::buyout($phone);
                        }

                        if ($res2) {
                            return jsonp(['code' => 1, 'msg' => '支付确认，等待对方确认收款']);
                        } else {
                            return jsonp(['code' => 2, 'msg' => '支付确认失败']);
                        }
                    }
                } else {
                    return jsonp(['code' => 2, 'msg' => '支付密码错误！']);
                }
            } else {
                return jsonp(['code' => 2, 'msg' => '支付密码错误！']);
            }
        }

    }

    //用户卖出订单确认收款（判断是卖方还是买方 进行逻辑处理）
    public function sell_confirm()
    {
        $user = Request::instance()->param('u_id');
        $so_id = Request::instance()->param('s_id');
        $pay_pass = Request::instance()->param('pay_pass');
        if (Cache::get('sell_confirm' . $user)) {
            return jsonp(['code' => 4, 'msg' => '频率过快']);
        } else {

            if ($user && $so_id && $pay_pass) {
                Cache::set('sell_confirm' . $user, true, 3);
                $check = Db::table('mb_user')->where('u_id', $user)->field('tel,balance,pay_pass')->find();
                //1买入 2卖出
                if ($check['pay_pass'] == md5($pay_pass)) {
                    $order = Db::table('mb_sell_order')->where('s_id', $so_id)->find();

                    if ($order['static'] < 4) {
                        if ($order['type'] == 1) {
                            if ($order['user'] == $user) {


                                $check_t = Db::table('mb_user')->where('u_id', $order['u_id'])->field('tel,balance')->find();
                                $check_d = Db::table('mb_user')->where('u_id', $order['user'])->field('tel,balance')->find();

//                                    $res1 = Db::table('mb_user')->where('u_id', $order['user'])->setDec('balance', $order['money']);//卖方扣钱
                                $res2 = Db::table('mb_user')->where('u_id', $order['u_id'])->setInc('balance', $order['money']);//买方加钱
                                Db::table('mb_user')->where('u_id', $order['u_id'])->setInc('balance', 100);//买入订单需返回100保证金

//                        $mon1=Db::table('vpay_user')->where('u_id',$order['user'])->value('money');


                                $insert1 = Db::table('mb_balance_order')->insert([
                                    'u_id' => $order['user'],
                                    'bo_money' => -$order['money'],
                                    'former_money' => $check_d['balance'],
                                    'bo_time' => time(),
                                    'type' => 4,
                                    'target_uid' => $check_t['tel'],
                                ]);
                                $insert2 = Db::table('mb_balance_order')->insert([
                                    'u_id' => $order['u_id'],
                                    'bo_money' => $order['money'],
                                    'former_money' => $check_t['balance'],
                                    'bo_time' => time(),
                                    'type' => 3,
                                    'target_uid' => $check_d['tel'],
                                ]);
                                $res = Db::table('mb_sell_order')->where('s_id', $so_id)->setField('static', 4);
                                if ($res && $res2 && $insert1 && $insert2) {
                                    return jsonp(['code' => 1, 'msg' => '确认收款，交易完成']);
                                } else {
                                    return jsonp(['code' => 2, 'msg' => '确认收款失败']);
                                }


                            }
                        } else if ($order['type'] == 2) {
                            if ($order['u_id'] == $user) {

                                $check_t = Db::table('mb_user')->where('u_id', $order['u_id'])->field('tel,balance')->find();
                                $check_d = Db::table('mb_user')->where('u_id', $order['user'])->field('tel,balance')->find();
                                $res = Db::table('mb_sell_order')->where('s_id', $so_id)->setField('static', 4);
//                      $res1 = Db::table('vpay_user')->where('u_id',$order['u_id'])->setDec('money',$order['money']);//卖方扣钱
                                $res2 = Db::table('mb_user')->where('u_id', $order['user'])->setInc('balance', $order['money']);//买方加钱
                                Db::table('mb_user')->where('u_id', $order['user'])->setInc('balance', 100);//返回买方100保证金
//                        $mon1=Db::table('vpay_user')->where('u_id',$order['u_id'])->value('money');

                                $insert1 = Db::table('mb_balance_order')->insert([
                                    'u_id' => $order['u_id'],
                                    'bo_money' => -$order['money'],
                                    'former_money' => $check_t['balance'],
                                    'bo_time' => time(),
                                    'type' => 4,
                                    'target_uid' => $check_t['tel'],
                                ]);
                                $insert2 = Db::table('mb_balance_order')->insert([
                                    'u_id' => $order['user'],
                                    'bo_money' => $order['money'],
                                    'former_money' => $check_d['balance'],
                                    'bo_time' => time(),
                                    'type' => 3,
                                    'target_uid' => $check_d['tel'],
                                ]);


                                if ($res && $res2 && $insert1 && $insert2) {
                                    return jsonp(['code' => 1, 'msg' => '确认收款，交易完成']);
                                } else {
                                    return jsonp(['code' => 2, 'msg' => '确认收款失败']);
                                }

                            }
                        }
                    }
                } else {
                    return jsonp(['code' => 2, 'msg' => '支付密码错误！']);
                }
            } else {
                return jsonp(['code' => 2, 'msg' => '参数错误！']);
            }


        }
    }

}