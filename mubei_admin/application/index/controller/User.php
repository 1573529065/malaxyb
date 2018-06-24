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

class User extends Common
{

    //渲染发送余额页面
    public function send_money()
    {
        $user = Request::instance()->param('account');
        $user_vip = Db::table('mb_user')->where('u_id', $user)->find();
        $this->assign('user', $user_vip);
        return $this->fetch();
    }

    public function add_admin()
    {
        return $this->fetch();
    }

    public function add_admin_p2()
    {
        $user = Request::instance()->param('u_id');
        $pass = Request::instance()->param('pass');
        $type = Request::instance()->param('type');
        $resname = Db::table('vpay_admin')->where('account', $user)->find();

        if ($resname) {
            return json(['code' => 2, 'msg' => '用户名重复！']);
        } else {
            $res = Db::table('vpay_admin')->data(
                ['account' => $user, 'pass' => md5($pass), 'time' => time(), 'type' => $type]
            )->insert();
            if ($res) {
                return json(['code' => 1, 'msg' => '添加成功！']);
            } else {
                return json(['code' => 2, 'msg' => '添加失败！']);
            }
        }


    }


    public function change_pass()
    {
        $user = Request::instance()->param('account');
        $this->assign('user', $user);
        return $this->fetch();
    }

    public function change_pass_p2()
    {
        $user = Request::instance()->param('uid');
        $pass = Request::instance()->param('pass');
        Log::write($user, 'notice');

        $res = Db::table('vpay_admin')->where('account', $user)->setField('pass', md5($pass));
        if ($res) {
            return json(['code' => 1, 'msg' => '修改成功！']);
        } else {
            return json(['code' => 2, 'msg' => '修改失败！']);
        }

    }

    //用户发送余额
    public function change_money()
    {
        $user = Request::instance()->param('u_id');
        $money = Request::instance()->param('money');
        $type = Request::instance()->param('type');
        if ($type == 1) {
            $res = Db::table('mb_user')->where('u_id', $user)->setInc('balance', $money);
        } else if ($type == 2) {
            $res = Db::table('mb_user')->where('u_id', $user)->setInc('current', $money);
        } else if ($type == 3) {
            $res = Db::table('mb_user')->where('u_id', $user)->setInc('assets', $money);
        }

        if ($res) {
            return json(['code' => 1, 'msg' => '发送成功！']);
        } else {
            return json(['code' => 2, 'msg' => '发送失败！']);
        }
    }

    //渲染删除用户页面
    public function delete_user()
    {
        $user = Request::instance()->param('account');
        $user_vip = Db::table('mb_user')->where('u_id', $user)->find();
        $this->assign('user', $user_vip);
        return $this->fetch();
    }

    /**
     * 后台-会员管理-渲染编辑会员页面
     */
    public function edit_user()
    {
        $user = Request::instance()->param('account');
        $user_vip = Db::table('mb_user')->where('u_id', $user)->find();
        $this->assign('user', $user_vip);
//        var_dump($user_vip);exit;
        return $this->fetch();
    }


    public function edit_user_p2()
    {
        $u_id = Request::instance()->param('u_id');
        $user = Request::instance()->param('user');
        $tel = Request::instance()->param('tel');
        $balance = Request::instance()->param('balance');
        $assets = Request::instance()->param('assets');
        $pass = Request::instance()->param('pass');
        $pass1 = Request::instance()->param('pass1');
        $pay_pass = Request::instance()->param('pay_pass');
        $pay_pass1 = Request::instance()->param('pay_pass1');

        $data = ['user' => $user, 'tel' => $tel, 'balance' => $balance, 'assets' => $assets];
        if (!empty($pass) && !empty($pass1)) {
            if ($pass == $pass1) {
                $data['pass'] = md5($pass);
            } else {
                return json(['code' => 2, 'msg' => '两次登录密码不一致']);
            }
        }
        if (!empty($pay_pass) && !empty($pay_pass1)) {
            if ($pay_pass == $pay_pass1) {
                $data['pay_pass'] = md5($pay_pass);
            } else {
                return json(['code' => 2, 'msg' => '两次支付密码不一致']);
            }
        }

        $resname = Db::table('mb_user')->where('u_id', $u_id)->update($data);
        if ($resname) {
            return json(['code' => 1, 'msg' => '修改成功！']);
        } else {
            return json(['code' => 2, 'msg' => '修改失败！']);
        }
    }


    //渲染添加用户页面
    public function add_user()
    {
        return $this->fetch();
    }

    public function add_user_p2()
    {
        $user = Request::instance()->param('u_id');
        $pass = Request::instance()->param('pass');
        $pass1 = Request::instance()->param('pass1');
        $name = Request::instance()->param('name');
        $fuid = Request::instance()->param('fuid');

        $resname = Db::table('mb_user')->where('user', $name)->find();
        if ($resname) {
            return json(['code' => 2, 'msg' => '昵称重复！']);
        } else {
            $resphone = Db::table('mb_user')->where('tel', $user)->find();
            if ($resphone) {
                return json(['code' => 2, 'msg' => '该手机号码已被注册！']);
            } else {

                if ($fuid) {
                    $res1 = Db::table('mb_user')->where('u_id', $fuid)->find();
                    $best = Db::table('mb_user')->where('u_id', $res1['best_uid'])->find();
                    if ($res1) {
                        if ($best) {
                            $res = Db::table('mb_user')->data(
                                ['user' => $name, 'tel' => $user, 'u_name' => 0,
                                    'pass' => md5($pass), 'pay_pass' => md5($pass1), 'best_uid' => $best['u_id'], 'time' => time(), 'f_uid' => $fuid, 'era' => $res1['era'] + 1]
                            )->insert();
                        } else {
                            $res = Db::table('mb_user')->data(
                                ['user' => $name, 'tel' => $user, 'u_name' => 0,
                                    'pass' => md5($pass), 'pay_pass' => md5($pass1), 'best_uid' => $fuid, 'time' => time(), 'f_uid' => $fuid, 'era' => $res1['era'] + 1]
                            )->insert();
                        }


                        if ($res) {
                            return json(['code' => 1, 'msg' => '添加成功！']);
                        } else {
                            return json(['code' => 2, 'msg' => '添加失败！']);
                        }
                    } else {
                        return json(['code' => 2, 'msg' => '无此上级uid！']);
                    }
                } else {
                    $res = Db::table('mb_user')->data(
                        ['user' => $name, 'tel' => $user, 'u_name' => 0,
                            'pass' => md5($pass), 'pay_pass' => md5($pass1), 'best_uid' => 0, 'time' => time(), 'f_uid' => 0]
                    )->insert();
                    if ($res) {
                        return json(['code' => 1, 'msg' => '添加成功！']);
                    } else {
                        return json(['code' => 2, 'msg' => '添加失败！']);
                    }

                }

            }
        }


    }

    //删除用户
    public function delete_user_p2()
    {
        $user = Request::instance()->param('u_id');
        $res = Db::table('mb_user')->where('u_id', $user)->delete();
        if ($res) {
            return json(['code' => 1, 'msg' => '删除成功！']);
        } else {
            return json(['code' => 2, 'msg' => '删除失败！']);
        }
    }


    //渲染余额记录页面
    public function money_order()
    {
        $user = Request::instance()->param('account');
        $message = Db::table('mb_balance_order')->where('u_id', $user)->order('bo_time', 'desc')->select();
        $this->assign('order', $message);
        return $this->fetch();
    }


    //渲染积分记录页面
    public function score_order()
    {
        $user = Request::instance()->param('account');
        $message = Db::table('mb_current_order')->where('u_id', $user)->order('co_time', 'desc')->select();
        $this->assign('order', $message);
        return $this->fetch();
    }


    //渲染积分记录页面
    public function assets_order()
    {
        $user = Request::instance()->param('account');
        $message = Db::table('mb_assets_order')->where('u_id', $user)->order('ao_time', 'desc')->select();
        $this->assign('order', $message);
        return $this->fetch();
    }

    //渲染下级会员页面
    public function subordinate()
    {
        $user = Request::instance()->param('account');
        $user_1 = Db::table('mb_user')->where('f_uid', $user)->order('era', 'asc')->select();
        $this->assign('user', $user_1);
        return $this->fetch();
    }


    public function noticemanage_t()
    {

        $user = Request::instance()->param('nid');
        $user_1 = Db::table('mb_notice')->where('n_id', $user)->find();
        $this->assign('user', $user_1);
        return $this->fetch();
    }


    //渲染发送信息页面
    public function send_message()
    {
        $user = Request::instance()->param('account');
        $user_vip = Db::table('mb_user')->where('u_id', $user)->find();
        $this->assign('user', $user_vip);
        return $this->fetch();
    }

    public function send_message_t()
    {
        $title = Request::instance()->param('title');
        $content = Request::instance()->param('content');
        $uid = Request::instance()->param('uid');
        if ($title && $content) {
            $insert = Db::table('mb_message')->insert([
                'm_title' => $title,
                'm_text' => $content,
                'u_id' => $uid,
                'm_time' => time()
            ]);
            if ($insert) {
                return json(['code' => 1, 'msg' => '发送成功！']);
            }
        } else {
            return json(['code' => 2, 'msg' => '请填写标题与内容！']);
        }

    }

    public function add_shop()
    {
        return $this->fetch();
    }

    public function add_shop_p2()
    {
        $title = Request::instance()->param('title');
        $min_money = Request::instance()->param('editor');
        $file = request()->file('image');
        if ($file) {
            $info = $file->move($_SERVER['DOCUMENT_ROOT'] . '/maibao/public/static' . DS . 'uploads');
            if ($info) {
//                echo $info->getExtension();
//                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $u_img2 = $info->getSaveName();
//                // 输出 42a79759f284b767dfcb2a0197904287.jpg
//                echo $info->getFilename();


                $insert = Db::table('vpay_shop')->insert([
                    'sh_title' => $title,
                    'sh_text' => $min_money,
                    'sh_img' => $u_img2,
                    'time' => time(),
                ]);

                if ($insert) {
                    return json(['code' => 1, 'msg' => '发布资讯成功！']);
                } else {
                    return json(['code' => 2, 'msg' => '发布资讯失败！']);
                }
            } else {
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }


    }

    public function change_shop()
    {
        $shid = Request::instance()->param('nid');
        $shop = Db::table('vpay_shop')->where('sh_id', $shid)->find();
        $this->assign('shop', $shop);
        return $this->fetch();
    }

    public function change_shop_p2()
    {
        $title = Request::instance()->param('title');
        $sh_id = Request::instance()->param('shid');
        $min_money = Request::instance()->param('editor');
        $u_img = Request::instance()->param('img');
        $file = request()->file('image');

        if ($file && $u_img) {
            $url1 = $_SERVER['DOCUMENT_ROOT'];
            $url = '/maibao/public/static';
            $imageUrl = $url1 . $url . DS . "/uploads/" . $u_img;
            $info = @unlink($imageUrl);

            if ($file) {
                $info = $file->move($_SERVER['DOCUMENT_ROOT'] . '/maibao/public/static' . DS . 'uploads');
                if ($info) {
//                echo $info->getExtension();
//                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    $u_img2 = $info->getSaveName();
//                // 输出 42a79759f284b767dfcb2a0197904287.jpg
//                echo $info->getFilename();


                    $insert = Db::table('vpay_shop')->where('sh_id', $sh_id)->update([
                        'sh_title' => $title,
                        'sh_text' => $min_money,
                        'sh_img' => $u_img2,
                    ]);

                    if ($insert) {
                        return json(['code' => 1, 'msg' => '修改资讯成功！']);
                    } else {
                        return json(['code' => 2, 'msg' => '修改资讯失败！']);
                    }
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }
        } else {
            $insert = Db::table('vpay_shop')->where('sh_id', $sh_id)->update([
                'sh_title' => $title,
                'sh_text' => $min_money,
            ]);

            if ($insert) {
                return json(['code' => 1, 'msg' => '修改商品成功！']);
            } else {
                return json(['code' => 2, 'msg' => '修改商品失败！']);
            }
        }


    }


    public function shop_order()
    {
        $shid = Request::instance()->param('nid');
        $card = Db::table('vpay_shop_get')
            ->alias('a')
            ->join('vpay_shop w', 'a.sh_id = w.sh_id')
            ->join('vpay_shop_dizhi c', 'a.sd_id = c.sd_id')
            ->where('w.sh_id', $shid)
            ->order('a.time', 'desc')
            ->field('a.sg_money,a.sg_id,a.time,a.u_id,a.type,w.sh_title,w.sh_img,c.s_name,c.s_tel,c.s_diqu,c.s_dizhi')
            ->select();
        $this->assign('order', $card);
        return $this->fetch();
    }

    public function result_order()
    {
        $sgid = Request::instance()->param('sg_id');

        $insert = Db::table('vpay_shop_get')->where('sg_id', $sgid)->setField('type', 3);
        if ($insert) {
            return json(['code' => 1, 'msg' => '发货成功！']);
        } else {
            return json(['code' => 2, 'msg' => '发货失败！']);
        }
    }


    public function add_card_p3()
    {
        $nid = Request::instance()->param('nid');
        $insert = Db::table('mb_bank_name')->where('bn_id', $nid)->find();
        $this->assign('user', $insert);
        return $this->fetch();
    }

    public function change_lunbo()
    {
        $nid = Request::instance()->param('nid');
        $message = Db::table('mb_lunbo')->where('lb_id', $nid)->find();
        $this->assign('shop', $message);
        return $this->fetch();
    }

    public function change_beijin()
    {
        $nid = Request::instance()->param('nid');
        $message = Db::table('mb_beijin')->where('bj_id', $nid)->find();
        $this->assign('shop', $message);
        return $this->fetch();
    }
}