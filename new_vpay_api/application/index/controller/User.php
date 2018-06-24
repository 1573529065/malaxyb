<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Cache;
use think\Cookie;
use think\log;


class User extends Controller
{


    //登录
    public function login()
    {
        $pass = Request::instance()->param('pass'); //登录密码
        $user = Request::instance()->param('user'); //用户
        if (strlen($user) == 6) {
            $res_uid = Db::table('vpay_user')->where('u_id', $user)->value('pass');
            if ($res_uid) {
                if ($res_uid == md5($pass)) {
                    $u_id = Db::table('vpay_user')->where('u_id', $user)->value('u_id');
                    Cookie::set('login_ed', $u_id, 259200);
                    return json(['code' => 1, 'msg' => '登录成功！']);
                } else {
                    return json(['code' => 2, 'msg' => '密码错误！']);
                }
            } else {
                return json(['code' => 2, 'msg' => '用户不存在！']);
            }
        } else if (strlen($user) == 11) {
            $res_phone = Db::table('vpay_user')->where('tel', $user)->value('pass');
            if ($res_phone) {
                if ($res_phone == md5($pass)) {
                    $u_id = Db::table('vpay_user')->where('tel', $user)->value('u_id');
                    Cookie::set('login_ed', $u_id, 259200);
                    return json(['code' => 1, 'msg' => '登录成功！']);
                } else {
                    return json(['code' => 2, 'msg' => '密码错误！']);
                }
            } else {
                return json(['code' => 2, 'msg' => '用户不存在！']);
            }
        }

    }


    // 注册
    public function register()
    {
        $pass = Request::instance()->param('pass'); //登录密码
        $pay_pass = Request::instance()->param('pay_pass'); //支付密码
        $phone = Request::instance()->param('phone'); //手机号码
        $phone_code = Request::instance()->param('phone_code'); //手机验证码
        $name = Request::instance()->param('name'); //用户昵称
        $f_phone = Request::instance()->param('f_uid'); //上级用户id
        $re_name = Request::instance()->param('re_name'); //真实姓名

        if ($phone_code != Cache::get($phone)) {
            return jsonp(['code' => 2, 'msg' => '手机验证码输入错误！']);
        } else {
            if ($this->is_utf8($name) == true) {
                $resname = Db::table('mb_user')
                    ->where('user', $name)
                    ->find();

                if ($resname) {
                    return jsonp(['code' => 2, 'msg' => '昵称重复！']);
                } else {
                    $resphone = Db::table('mb_user')
                        ->where('tel', $phone)
                        ->find();

                    if ($resphone) {
                        return jsonp(['code' => 2, 'msg' => '该手机号码已被注册！']);
                    } else {
                        if ($f_phone) {
                            // 查询上级用户的等级
                            $agentid = Db::table('mb_user')
                                ->where('u_id', $f_phone)
                                ->field('era')
                                ->find();

                            if ($agentid) {
                                $num = 0;
                                $this->get_top_parentid($f_phone, $num);
                                $b_id = Cache::get($f_phone);
                                if ($b_id) {
                                    Db::table('mb_user')->data([
                                            'user' => $name,
                                            'tel' => $phone,
                                            'u_name' => 0,
                                            'pass' => md5($pass),
                                            'speed' => 0,
                                            'pay_pass' => md5($pay_pass),
                                            'time' => time(),
                                            'f_uid' => $f_phone,
                                            'era' => $agentid['era'] + 1,
                                            'best_uid' => $b_id
                                        ])
                                        ->insert();
                                    $userId = Db::name('mb_user')->getLastInsID();
                                } else {
                                    Db::table('mb_user')->data([
                                            'user' => $name,
                                            'tel' => $phone,
                                            'u_name' => 0,
                                            'pass' => md5($pass),
                                            'speed' => 0,
                                            'pay_pass' => md5($pay_pass),
                                            'time' => time(),
                                            'f_uid' => $f_phone,
                                            'era' => $agentid['era'] + 1,
                                            'best_uid' => $f_phone
                                        ])->insert();
                                    $userId = Db::name('mb_user')->getLastInsID();
                                }

                                $uid = Db::name('mb_user')->getLastInsID();
                                Db::table('vpay_share_order')->data(
                                    ['u_id' => $f_phone, 'user' => $uid, 'time' => time()]
                                )->insert();


                                return jsonp(['code' => 1, 'msg' => ' 注册成功！', 'u_id' => $userId]);
                            } else {
                                return jsonp(['code' => 2, 'msg' => '请输入正确的邀请码！']);
                            }

                        }

                    }
                }
            } else {
                return jsonp(['code' => 2, 'msg' => '昵称命名不规范！']);
            }
        }
    }

    // 注册
    public function register_t()
    {
        $pass = Request::instance()->param('pass'); //登录密码
        $pay_pass = Request::instance()->param('pay_pass'); //支付密码
        $phone = Request::instance()->param('phone'); //手机号码
        $phone_code = Request::instance()->param('phone_code'); //手机验证码
        $name = Request::instance()->param('name'); //用户昵称
        $f_uid = Request::instance()->param('account'); //上级用户id
        $re_name = Request::instance()->param('re_name'); //真实姓名

        if ($phone_code != Cache::get($phone)) return json(['code' => 2, 'msg' => '手机验证码输入错误！']);

        if ($this->is_utf8($name) != true) return json(['code' => 2, 'msg' => '昵称命名不规范！']);

        $resname = Db::table('mb_user')->where('user', $name)->find();
        if ($resname) return json(['code' => 2, 'msg' => '昵称重复！']);

        $resphone = Db::table('mb_user')->where('tel', $phone)->find();
        if ($resphone) return json(['code' => 2, 'msg' => '该手机号码已被注册！']);

        if (!$f_uid) return json(['code' => 2, 'msg' => '请输入邀请码！']);

        $agentid = Db::table('mb_user')->where('u_id', $f_uid)->field('era')->find();
        if (!$agentid) return jsonp(['code' => 2, 'msg' => '请输入正确的邀请码！']);

        $num = 0;
        $this->get_top_parentid($f_uid, $num);
        $b_id = Cache::get($f_uid); // 最上级用户ID
        $data = [
            'user' => $name,
            'tel' => $phone,
            'u_name' => $re_name,
            'pass' => md5($pass),
            'speed' => 0,
            'pay_pass' => md5($pay_pass),
            'time' => time(),
            'f_uid' => $f_uid,
            'era' => $agentid['era'] + 1,
            'best_uid' => $b_id
        ];
        if ($b_id)
            $data['best_uid'] = $b_id;
        else
            $data['best_uid'] = $b_id;

        $info = Db::table('mb_user')->data($data)->insert();
        if ($info)
            return jsonp(['code' => 2, 'msg' => ' 注册失败！']);
        else
            return jsonp(['code' => 1, 'msg' => ' 注册成功！']);
    }

    /**
     * 获取最上级用户id
     * @param $uid  上级用户id
     * @param $num
     */
    public function get_top_parentid($uid, $num)
    {
        $r = Db::table('mb_user')
            ->where('u_id', $uid)
            ->field('u_id,f_uid,era,vip_static,assets,balance')
            ->find();


//        如果等级不为0,且第一次进入则,设置first=上级用户ID 设置上级用户ID = 最上级用户ID   10 秒缓存
        if ($r['era'] != 0) { // 说明不是初级会员
            if ($num == 0){
                $count = Db::table('mb_user')->where('f_uid',$uid)->value('u_id');
                if ($count >= 10 && $r['vip_static'] != 1){
                    Db::table('mb_user')->where('u_id',$r['u_id'])->update(['vip_static' => 1]);
                }
                $balance = $r['assets']* 0.06; // 推荐会员 加速6%释放
                Db::table('mb_user')->where('u_id',$r['u_id'])
                    ->setInc('balance',$balance);
                Db::table('mb_balance_order')->insert([
                    'u_id' => $r['u_id'],
                    'bo_money' => $balance,
                    'former_money' => $r['balance'],
                    'type' => 5,
                    'bo_time' => time()
                ]);

                Db::table('mb_user')->where('u_id',$r['u_id'])
                    ->setDec('assets',$balance);
                Db::table('mb_assets_order')->insert([
                    'u_id' => $r['u_id'],
                    'ao_money' => '-'.$balance,
                    'former_money' => $r['assets'],
                    'type' => 2,
                    'ao_time' => time()
                ]);
                Cache::set('first', $uid, 10);
            }
            $num += 1;
            $this->get_top_parentid($r['f_uid'], $num);
        } else if ($r['era'] == 0) {
            Cache::set(Cache::get('first'), $r['u_id'], 10);
        }
    }

    //找回登录密码
    public function findpass()
    {
        $pass = Request::instance()->param('pass');
        $phone_code = Request::instance()->param('phone_code');
        $phone = Request::instance()->param('phone');
        $resphone = Db::table('mb_user')
            ->where('tel', $phone)
            ->value('u_id');

        if ($resphone) {
            if ($phone_code == Cache::get($phone)) {
                Db::table('mb_user')
                    ->where('tel', $phone)
                    ->setField('pass', md5($pass));

                return jsonp(['code' => 1, 'msg' => '修改密码成功！']);
            } else {
                return jsonp(['code' => 2, 'msg' => '验证码输入错误！']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '手机号码不存在！']);
        }
    }


    //找回支付密码
    public function findpay_pass()
    {
        $pass = Request::instance()->param('pass');
        $phone_code = Request::instance()->param('phone_code');
        $phone = Request::instance()->param('phone');
        $resphone = Db::table('mb_user')
            ->where('tel', $phone)
            ->value('u_id');
        if ($resphone) {
            if ($phone_code == Cache::get($phone)) {
                Db::table('mb_user')
                    ->where('tel', $phone)
                    ->setField('pay_pass', md5($pass));

                return jsonp(['code' => 1, 'msg' => '修改支付密码成功！']);
            } else {
                return jsonp(['code' => 2, 'msg' => '验证码输入错误！']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '手机号码不存在！']);
        }
    }


    //检验是否为utf8字符串
//    public function is_utf8($gonten)
//    {
//        if (preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$gonten) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$gonten) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$gonten) == true)
//        {
//            return true;
//        }
//        else
//        {
//            return false;
//        }
//    }

    function is_utf8($string) //函数二
    {
        $str = mb_detect_encoding($string, 'UTF-8') === 'UTF-8';
        if ($str == 1) {
            return true;
        } else {
            return false;
        }

    }

    //用户反馈建议
    public function feedback()
    {
        $feedback = Request::instance()->param('feedback');
        $user = Request::instance()->param('u_id');

        $res = Db::table('mb_feedback')->data([
            'f_text' => $feedback,
            'u_id' => $user,
            'time' => time()
        ])
            ->insert();
        if ($res) {
            return jsonp([
                'code' => 1,
                'msg' => '您的建议已提交成功！'
            ]);
        } else {
            return jsonp(['code' => 2, 'msg' => '提交失败！']);
        }
    }

    //用户反馈建议列表
    public function feedbackList()
    {
        $u_id = Request::instance()->param('u_id');

        $res = Db::table('mb_feedback')
            ->where('u_id', $u_id)
            ->order('time', 'DESC')
            ->select();
//        var_dump($res);exit;
        if ($res) {
            return jsonp(['code' => 1, 'msg' => '查询成功!', 'data' => $res]);
        } else {
            return jsonp(['code' => 2, 'msg' => '查询失败！']);
        }
    }


    //用户修改昵称
    public function change_name()
    {
        $name = Request::instance()->param('name');
        $user = Request::instance()->param('u_id');
        $res = Db::table('mb_user')->where('u_id', $user)->setField('user', $name);
        if ($res) {
            return jsonp(['code' => 1, 'msg' => 'succeed', 'name' => $name]);
        } else {
            return jsonp(['code' => 2, 'msg' => '修改失败！']);
        }
    }

    //用户修改登录密码
    public function change_pass()
    {
        $pass = Request::instance()->param('pass');
        $new_pass = Request::instance()->param('new_pass');
        $user = Request::instance()->param('u_id');
        if ($pass != $new_pass) {
            $check = Db::table('mb_user')
                ->where('pass', md5($pass))
                ->where('u_id', $user)
                ->value('u_id');
            if ($check) {
                $res = Db::table('mb_user')
                    ->where('u_id', $user)
                    ->setField('pass', md5($new_pass));
                if ($res) {
                    return jsonp(['code' => 1, 'msg' => '密码修改成功！']);
                } else {
                    return jsonp(['code' => 2, 'msg' => '密码修改失败！']);
                }
            } else {
                return jsonp(['code' => 2, 'msg' => '旧登录密码错误！']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '旧密码与新密码相同！']);
        }

    }

    //用户修改支付密码
    public function change_pay_pass()
    {
        $pass = Request::instance()->param('pass');
        $new_pass = Request::instance()->param('new_pass');
        $user = Request::instance()->param('u_id');
        if ($pass != $new_pass) {
            $check = Db::table('mb_user')
                ->where('pay_pass', md5($pass))
                ->where('u_id', $user)
                ->value('u_id');
            if ($check) {
                $res = Db::table('mb_user')
                    ->where('u_id', $user)
                    ->setField('pay_pass', md5($new_pass));
                if ($res) {
                    return jsonp([
                        'code' => 1,
                        'msg' => '支付密码修改成功！'
                    ]);
                } else {
                    return jsonp([
                        'code' => 2,
                        'msg' => '支付密码修改失败！'
                    ]);
                }
            } else {
                return jsonp([
                    'code' => 2,
                    'msg' => '旧支付密码错误！'
                ]);
            }
        } else {
            return jsonp([
                'code' => 2,
                'msg' => '旧密码与新密码相同！'
            ]);
        }

    }

    //用户修改头像
    public function change_uimg()
    {

        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

        header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept");

        $user = Request::instance()->param('u_id');
        $u_img = Db::table('mb_user')->where('u_id', $user)->value('u_img');
        if ($u_img) {
            $url1 = $_SERVER['DOCUMENT_ROOT'];
            $url = dirname($_SERVER['SCRIPT_NAME']) . '/static';
            $imageUrl = $url1 . $url . "/uploads/" . $u_img;
            $info = @unlink($imageUrl);
        }
        $file = request()->file('image');
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public/static' . DS . 'uploads');
            if ($info) {

//                // 成功上传后 获取上传信息
//                // 输出 jpg
//                echo $info->getExtension();
//                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $u_img2 = $info->getSaveName();
//                // 输出 42a79759f284b767dfcb2a0197904287.jpg
//                echo $info->getFilename();
                $res = Db::table('mb_user')->where('u_id', $user)->setField('u_img', $u_img2);
                if ($res) {
                    return json(['code' => 1, 'msg' => 'succeed', 'url' => $u_img2]);
                } else {
                    return json(['code' => 2, 'msg' => '修改头像失败！']);
                }
            } else {
                // 上传失败获取错误信息
                return json(['code' => 2, 'msg' => $file->getError()]);
            }
        } else {
            return json(['code' => 2, 'msg' => '无法获取图片']);
        }
    }


}