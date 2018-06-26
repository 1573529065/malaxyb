<?php

namespace app\index\controller;

use think\Cache;
use think\Controller;
use think\Cookie;
use think\Db;
use think\Lang;
use think\Request;
use think\Log;

class Turnin extends Controller
{
    public function turn_in()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $key = "IXSN86JAKQfa30e1nTE2zouyuavcUmLV";
            $arr = array(
                'uid' => $user,
                'sign' => $key
            );
            $url2 = json_encode($arr);
            $url2 = base64_encode($url2);
            if ($url2) {
                // return jsonp(['code' => 1, 'msg' => 'succeed','url'=>"http://www.malaxyb.com/new_vpay_api/public/index.php/index/index/qrcode/text/$url2.html"]);
                return jsonp([
                    'code' => 1,
                    'msg' => 'succeed',
                    'url' => "http://qr.topscan.com/api.php?bg=f3f3f3&fg=ff0000&gc=222222&el=l&w=200&m=10&text=http://www.malaxyb.com/mubei/TurnOut/turn_out.html?u_id=$user"]);
            } else {
                return jsonp(['code' => 2, 'msg' => '无效地址']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }


    public function turnin_recode()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $card = Db::table('mb_balance_order')
                ->where('u_id', $user)
                ->where('type', 7)
                ->field('bo_money,bo_time,target_uid')
                ->order('bo_time desc')
                ->select();


            foreach ($card as $k => $v) {
                $card[$k]['bo_time'] = date('Y-m-d H:i:s', $v['bo_time']);

            }
            if ($card) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $card]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }


    public function turnin_recode_c()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $card = Db::table('mb_current_order')
                ->alias('a')
                ->join('mb_user w', 'a.target_uid = w.tel')
                ->field('a.co_money,a.co_time,a.target_uid,w.user')
                ->where('a.u_id', $user)
                ->where('a.type', 3)
                ->order('a.co_time desc')
                ->select();

            foreach ($card as $k => $v) {
                $card[$k]['co_time'] = date('Y-m-d H:i:s', $v['co_time']);

            }
            if ($card) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $card]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }


    public function check()
    {
        $token = Request::instance()->param('token');
        $banben = Request::instance()->param('banben');
//        $token = Request::instance()->param('token');
        if ($token == 'check') {
            $json_string = file_get_contents('http://www.cmb1688.com/mgc.json');
            $data = json_decode($json_string, true);
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
                if ($data['ios'] != $banben) {
                    return jsonp(['code' => 1, 'msg' => '请更新', 'url' => $data['android_url'], 'banben' => $data['ios']]);
                } else {
                    return jsonp(['code' => 2, 'msg' => '正常版本', 'url' => '']);
                }
            } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Android')) {
                if ($data['android'] != $banben) {
                    return jsonp(['code' => 1, 'msg' => '请更新', 'url' => $data['android_url'], 'banben' => $data['android']]);
                } else {
                    return jsonp(['code' => 2, 'msg' => '正常版本']);
                }
            }
        }

    }


    public function del_order()
    {
        $sid = Request::instance()->param('s_id');
        $order = Db::table('mb_sell_order')->where('s_id', $sid)->value('static');
        if ($order == 1) {
            $type = Db::table('mb_sell_order')->where('s_id', $sid)->find();
            if ($type['type'] == 1) {
                Db::table('mb_user')->where('u_id', $type['u_id'])->setInc('balance', 100);
            } else {
                Db::table('mb_user')->where('u_id', $type['u_id'])->setInc('balance', $type['money']);
            }
            Db::table('mb_sell_order')->where('s_id', $sid)->delete();
            return jsonp(['code' => 1, 'msg' => '取消成功']);
        } else {
            return jsonp(['code' => 2, 'msg' => '订单状态不符合']);
        }
    }


    public function lunbo()
    {
        $order = Db::table('mb_lunbo')->select();
        if ($order) {
            return jsonp(['code' => 1, 'msg' => '取消成功', 'data' => $order]);
        } else {
            return jsonp(['code' => 2, 'msg' => 'no']);
        }
    }


    public function order_list()
    {
        $sid = Request::instance()->param('s_id');
        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.u_id')
            ->join('mb_bank c', 'w.u_id_bank = c.b_id')
            ->join('mb_bank_name n', 'c.b_name = n.bn_id')
            ->where('mb_sell_order.s_id', $sid)
            ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,
            w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
            ->order('mb_sell_order.time', 'desc')
            ->find();

        $order['time'] = date('Y-m-d H:i:s', $order['time']);
        $order2 = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.user')
            ->join('mb_bank c', 'w.user_bank = c.b_id')
            ->join('mb_bank_name n', 'c.b_name = n.bn_id')
            ->where('mb_sell_order.s_id', $sid)
            ->field('a.u_img,a.user,a.tel,n.bn_name,
            w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
            ->order('mb_sell_order.time', 'desc')
            ->find();

        $order2['time'] = date('Y-m-d H:i:s', $order2['time']);
        if ($order) {
            return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order, 'data2' => $order2]);
        } else {
            return jsonp(['code' => 2, 'msg' => '暂无数据']);
        }
    }

    public function shenshu()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept");
        $u_id = Request::instance()->param('u_id');
        $s_id = Request::instance()->param('s_id');
        $user = Request::instance()->param('user');
        $text = Request::instance()->param('text');
        $check = Db::table('mb_shengshu')->where('s_id', $s_id)->find();

        if (Cache::get('shenshu' . $u_id)) {
            return jsonp(['code' => 4, 'msg' => '频率过快']);
        } else {
            if (!$check) {
                Cache::set('shenshu' . $u_id, true, 3);
                $file = request()->file('image');
                if ($file) {
                    $info = $file->move(ROOT_PATH . 'public/static' . DS . 'uploads');
                    if ($info) {

                        $u_img2 = $info->getSaveName();
                        $res = Db::table('mb_shengshu')->insert([
                            'u_id' => $u_id,
                            'user' => $user,
                            's_id' => $s_id,
                            'ss_text' => $text,
                            'ss_img' => $u_img2,
                            'time' => time(),
                        ]);
                        if ($res) {
                            return json(['code' => 1, 'msg' => '提交成功']);
                        } else {
                            return json(['code' => 2, 'msg' => '提交失败']);
                        }

                    } else {
                        // 上传失败获取错误信息
                        return json(['code' => 2, 'msg' => $file->getError()]);
                    }
                } else {
                    return json(['code' => 2, 'msg' => '无法获取图片']);
                }
            } else {
                return json(['code' => 2, 'msg' => '您已经申诉过此订单']);
            }
        }


    }
}
