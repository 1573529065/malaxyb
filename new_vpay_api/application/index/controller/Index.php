<?php

namespace app\index\controller;

use think\Cache;
use think\Controller;
use think\Cookie;
use think\Db;
use think\Lang;
use think\Request;
use think\Log;

class Index extends Controller
{


    //maibao主页
    public function index()
    {
        $user = Request::instance()->param('u_id');
        $order = Db::table('mb_lunbo')->select();
        if ($user) {
            $user_arr = Db::table('mb_user')
                ->where('u_id', $user)
                ->field('u_id,user,u_img,tel,assets,balance,vip_static')
                ->find();
            $beijin = Db::table('mb_beijin')
                ->where('bj_id', 1)
                ->value('bj_img');

            $data = array();
            $time = date('Y-m-d', time());
            $time1 = date("Y-m-d", strtotime("-1 day"));
            $data_start1 = strtotime($time1 . '00:00:00');
            $data_end1 = strtotime($time1 . '23:59:59');
            $date_start = strtotime($time . '00:00:00');
            $date_end = strtotime($time . '23:59:59');


            $asstes = Db::table('mb_balance_order')
                ->where('type', 5)
                ->where('u_id', $user)
                ->where('bo_time', '<=', $data_end1)
                ->where('bo_time', '>=', $data_start1)
                ->sum('bo_money');

            $ass = Db::table('mb_balance_order')
                ->where('type', 1)
                ->where('u_id', $user)
                ->where('bo_time', '<=', $data_end1)
                ->where('bo_time', '>=', $data_start1)
                ->limit(1)
                ->sum('bo_money');

            $today = Db::table('mb_today_assets')
                ->where('u_id', $user)
                ->where('time', '<=', $date_end)
                ->where('time', '>=', $date_start)
                ->find();

            $time = Db::table('mb_config')
                ->where('co_id', 6)
                ->find();

            $hou = date("G", $time['co_config']);
            $hour = date("G");
            $tan = 2;

            if (($asstes + $ass) > 0) {
                if ($today) {
                    $tan = 2;
                } elseif ($hou <= $hour && $user_arr['assets'] > 0) {
                    $tan = 1;
                }
            }

            $notice = Db::table('mb_notice')
                ->order('time', 'desc')
                ->field('n_text')
                ->select();
//            foreach($notice as $k=>$v){
//                $notice[$k]['time']=date('Y-m-d H:i:s',$v['time']);
//                $notice[$k]['n_text']=mb_substr(strip_tags($v['n_text']),0,60);
//            }
            $notice = array_column($notice, 'n_text');


            foreach ($order as $k => $v) {
                $data['lb_img' . $k] = $v['lb_img'];
            }
            if ($user_arr) {
                return jsonp([
                    'code' => 1,
                    'msg' => 'succeed',
                    'data' => $user_arr,
                    'images' => $data,
                    'tan' => $tan,
                    'beijin' => $beijin,
                    'gold' => $asstes + $ass,
                    'notice' => $notice
                ]);
            } else {
                return jsonp(['code' => 2, 'msg' => '参数错误']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    public function red_bao()
    {

        $user = Request::instance()->param('u_id');
        if (Cache::get('red_bao' . $user)) {
            return jsonp(['code' => 2, 'msg' => '频率过快']);
        } else {
            Cache::set('red_bao' . $user, true, 3);
            $user_arr = Db::table('mb_user')
                ->where('u_id', $user)
                ->field('u_id,user,u_img,tel,assets,balance,vip_static')
                ->find();

            $time = date('Y-m-d', time());
            $time1 = date("Y-m-d", strtotime("-1 day"));
            $data_start1 = strtotime($time1 . '00:00:00');
            $data_end1 = strtotime($time1 . '23:59:59');
            $date_start = strtotime($time . '00:00:00');
            $date_end = strtotime($time . '23:59:59');
            $today = Db::table('mb_today_assets')
                ->where('u_id', $user)
                ->where('time', '<=', $date_end)
                ->where('time', '>=', $date_start)
                ->find();
            if (!$today) {
                $ass1 = Db::table('mb_balance_order')
                    ->where('type', 5)
                    ->where('u_id', $user)
                    ->where('bo_time', '<=', $data_end1)
                    ->where('bo_time', '>=', $data_start1)
                    ->sum('bo_money');
                $ass = Db::table('mb_balance_order')
                    ->where('type', 1)
                    ->where('u_id', $user)
                    ->where('bo_time', '<=', $data_end1)
                    ->where('bo_time', '>=', $data_start1)
                    ->limit(1)
                    ->sum('bo_money');

                $asstes = $ass1 + $ass;
                if ($user_arr['assets'] > $asstes && $asstes > 0) {
                    $res1 = Db::table('mb_user')
                        ->where('u_id', $user)
                        ->setDec('assets', $asstes);
                    $res2 = Db::table('mb_user')
                        ->where('u_id', $user)
                        ->setInc('balance', $asstes);

                    $insert2 = Db::table('mb_today_assets')->insert([
                        'u_id' => $user,
                        'assets' => $asstes,
                        'time' => time(),
                    ]);
                    if ($res1 && $res2) {
                        return jsonp([
                            'code' => 1,
                            'msg' => '领取成功',
                            'money' => $asstes
                        ]);
                    } else {
                        return jsonp(['code' => 2, 'msg' => '参数错误']);
                    }

                } else if ($user_arr['assets'] <= $asstes && $asstes > 0) {
                    $res1 = Db::table('mb_user')
                        ->where('u_id', $user)
                        ->setDec('assets', $user_arr['assets']);
                    $res2 = Db::table('mb_user')
                        ->where('u_id', $user)
                        ->setInc('balance', $user_arr['assets']);
                    $insert2 = Db::table('mb_today_assets')->insert([
                        'u_id' => $user,
                        'assets' => $asstes,
                        'time' => time(),
                    ]);
                    if ($res1 && $res2) {
                        return jsonp([
                            'code' => 1,
                            'msg' => '领取成功',
                            'money' => $asstes
                        ]);
                    } else {
                        return jsonp(['code' => 2, 'msg' => '参数错误']);
                    }
                };
            }
        }


    }


    //公告
    public function notice()
    {
        $token = Request::instance()->param('token');
        if ($token) {
            if ($token == 'notice') {
                $notice = Db::table('mb_notice')->order('time', 'desc')->field('n_id,n_title,n_text,time')->select();
                foreach ($notice as $k => $v) {
                    $notice[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
                    $notice[$k]['n_text'] = mb_substr(strip_tags($v['n_text']), 0, 60);
                }
                if ($notice) {
                    return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $notice]);
                } else {
                    return jsonp(['code' => 2, 'msg' => '暂无数据']);
                }
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //个人信息
    public function message()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $message = Db::table('mb_message')->where('u_id', $user)->order('m_time', 'desc')->field('m_id,m_title,m_text,m_time')->select();
            foreach ($message as $k => $v) {
                $message[$k]['m_time'] = date('Y-m-d H:i:s', $v['m_time']);
                $message[$k]['m_text'] = mb_substr(strip_tags($v['m_text']), 0, 60);
            }
            if ($message) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $message]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    // 我的页面-添加钱包地址
    public function add_walletAddress()
    {
        $address = Request::instance()->param('wallet_address');
        $u_id = Request::instance()->param('u_id');
        if ($address) {
            $info = Db::table('mb_user')->where('u_id', $u_id)->update(['wallet_address' => $address]);
            if ($info) {
                return jsonp(['code' => 1, 'msg' => '添加成功']);
            } else {
                return jsonp(['code' => 2, 'msg' => '添加失败']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '地址不能为空']);
        }
    }


    //公告详情页
    public function notice_list()
    {
        $user = Request::instance()->param('token');
        $soid = Request::instance()->param('n_id');
        if ($user == 'notice') {
            $card = Db::table('mb_notice')->where('n_id', $soid)->find();

//            foreach($card as $k=>$v){

//            }
            if ($card) {
                $card['time'] = date('Y-m-d H:i:s', $card['time']);
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $card]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }


    //消息详情页
    public function message_list()
    {
        $user = Request::instance()->param('token');
        $soid = Request::instance()->param('m_id');
        if ($user == 'message') {
            $card = Db::table('mb_message')->where('m_id', $soid)->find();

//            foreach($card as $k=>$v){

//            }
            if ($card) {

                $card['m_time'] = date('Y-m-d H:i:s', $card['m_time']);
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $card]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }


    //关于(中文)
    public function about()
    {
        $token = Request::instance()->param('token');
        $type = Request::instance()->param('type');
        if ($token) {
            if ($token == 'about') {
                $about = Db::table('mb_about')->where('type', $type)->field('a_text')->find();
                if ($about) {
                    return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $about]);
                } else {
                    return jsonp(['code' => 2, 'msg' => '暂无数据']);
                }
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    public function lange()
    {
        $token = Request::instance()->param('token');
        if ($token == 'lange') {
            return jsonp(['code' => 1, 'msg' => '参数错误！']);
        }
    }

    //关于(英文)
    public function about_t()
    {
        $token = Request::instance()->param('token');

        if ($token) {
            if ($token == 'about_t') {
                $about = Db::table('mb_about')->where('type', 2)->field('a_text')->find();
                if ($about) {
                    return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $about]);
                } else {
                    return jsonp(['code' => 2, 'msg' => '暂无数据']);
                }
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }


    //card银行卡页
    public function card()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $card = Db::table('mb_bank')
                ->alias('a')
                ->join('mb_bank_name w', 'a.b_name = w.bn_id')
                ->field('a.b_branch,a.c_name,w.bn_name,a.b_card,a.defult,a.b_id')
                ->where('u_id', $user)
                ->select();

            if ($card) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $card]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //资讯
    public function news()
    {
        $user = Request::instance()->param('token');
        if ($user == 'news') {
            $card = Db::table('vpay_shop')->order('time desc')->select();

            foreach ($card as $k => $v) {
                $card[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
                $card[$k]['sh_text'] = mb_substr(strip_tags($v['sh_text']), 0, 60);
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

    //资讯详情页
    public function news_list()
    {
        $user = Request::instance()->param('token');
        $soid = Request::instance()->param('so_id');
        if ($user == 'news') {
            $card = Db::table('vpay_shop')->where('sh_id', $soid)->find();

//            foreach($card as $k=>$v){
            $card['time'] = date('Y-m-d H:i:s', $card['time']);
//            }
            if ($card) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $card]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //分享
    public function share()
    {

        $user = Request::instance()->param('u_id');
        // $url2="http://www.malaxyb.com/mgc_down/register.html?account=".$user;
        // $url2="https://fir.im/Malaxyb";
        $url2 = "http://www.malaxyb.com/mubei/login/register.html?account=" . $user;
        $url2 = base64_encode($url2);
        if ($user) {
            return jsonp(['code' => 1, 'msg' => 'succeed', 'url' => "http://www.malaxyb.com/new_vpay_api/public/index.php/index/index/qrcode/text/$url2.html"]);
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }

    //银行
    public function bank()
    {
        $token = Request::instance()->param('token');
        if ($token) {
            if ($token == 'bank') {
                $card = Db::table('mb_bank_name')
                    ->field('bn_id,bn_name')
                    ->select();
                if ($card) {
                    return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $card]);
                } else {
                    return jsonp(['code' => 2, 'msg' => '暂无数据']);
                }
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //分享记录
    public function share_order()
    {
        $user = Request::instance()->param('u_id');
        if (!empty($user)) {
            $order = Db::table('vpay_share_order')
                ->alias('a')
                ->join('mb_user w', 'a.user = w.u_id')
                ->where('a.u_id', $user)
                ->field('w.user,w.u_img,w.u_id,a.time,w.vip_static,w.tel')
                ->select();

            foreach ($order as $k => $v) {
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        }

    }


    public function qrcode($text)
    {
        \think\Loader::import('qrcode.qrcode');
        $text = base64_decode($text);
        return \QRcode::png($text);
        exit;
    }


    //买入数据接口
    public function purchase()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $user_arr = Db::table('mb_user')->where('u_id', $user)->find();
            if ($user_arr['is_card'] != 0) {
                $card = Db::table('mb_bank')
                    ->alias('a')
                    ->join('mb_bank_name w', 'a.b_name = w.bn_id')
                    ->field('a.b_branch,a.c_name,w.bn_name,a.b_card,a.defult')
                    ->where('u_id', $user)
                    ->where('defult', 1)
                    ->find();

                $order = Db::table('mb_sell_order')->where('type', 1)->where('u_id', $user)->where('static', 4)->count('s_id');
                $order1 = Db::table('mb_sell_order')->where('type', 2)->where('user', $user)->where('static', '>=', 2)->count('s_id');

                $order3 = Db::table('mb_sell_order')->where('type', 1)->where('u_id', $user)->where('static', 2)->count('s_id');
                $order4 = Db::table('mb_sell_order')->where('type', 2)->where('user', $user)->where('static', 2)->count('s_id');

                $order6 = Db::table('mb_sell_order')->where('type', 1)->where('u_id', $user)->where('static', 1)->where('user', null)->count('s_id');
                $order7 = Db::table('mb_sell_order')->where('type', 1)->where('u_id', $user)->where('user', '>', 1)->where('static', '>', 1)->count('s_id');

                $order5 = Db::table('mb_sell_order')->where('type', 2)->where('static', 1)->count('s_id');


                if ($card) {
                    return jsonp([
                        'code' => 1,
                        'msg' => 'succeed',
                        'data' => $card,
                        'result_pay' => $order3 + $order4,
                        'buy_center' => $order5,
                        'no_order' => $order6 + $order7,
                        'order_result' => $order + $order1
                    ]);
                } else {
                    return jsonp(['code' => 2, 'msg' => '请设置默认银行卡']);
                }

            } else {
                return jsonp(['code' => 2, 'msg' => '请添加银行卡']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }

    //买入记录
    public function result_turn()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $user_arr = Db::table('mb_balance_order')->where('u_id', $user)->order('bo_time desc')->where('type', 3)->field('bo_money,target_uid,bo_time')->select();
            foreach ($user_arr as $k => $v) {
                $user_arr[$k]['bo_time'] = date('Y-m-d H:i:s', $v['bo_time']);
            }
            if ($user_arr) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $user_arr]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }

    //买入未完成订单（未选择收款人）
    public function no_order()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.u_id')
                ->join('mb_bank c', 'w.u_id_bank = c.b_id')
                ->join('mb_bank_name n', 'c.b_name = n.bn_id')
                ->where('w.type', 1)
                ->where('w.u_id', $user)
                ->where('w.user', null)
                ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,
                w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('w.time', 'desc')
                ->select();
            foreach ($order as $k => $v) {
                switch ($v['static']) {
                    case 1:
                        $message = '挂买中';
                        break;
                    case 2:
                        $message = '交易中';
                        break;
                    case 3:
                        $message = '确认中';
                        break;
                    case 4:
                        $message = '已完成';
                        break;

                }
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
                $order[$k]['static'] = $message;
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }

        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }

    //买入未完成订单（已选择收款人）
    public function no_order_t()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.u_id')
//
                ->join('mb_bank c', 'w.u_id_bank = c.b_id')
                ->join('mb_bank_name n', 'c.b_name = n.bn_id')
                ->where('mb_sell_order.type', 1)
                ->where('mb_sell_order.u_id', $user)
                ->where('mb_sell_order.user', '>', 1)
                ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();
            foreach ($order as $k => $v) {
                switch ($v['static']) {
                    case 1:
                        $message = '挂买中';
                        break;
                    case 2:
                        $message = '交易中';
                        break;
                    case 3:
                        $message = '确认中';
                        break;
                    case 4:
                        $message = '已完成';
                        break;

                }
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
                $order[$k]['static'] = $message;
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }

        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }

    //买入已完成订单
    public function result_order()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
//           Db::table('mb_sell_order')->where('type',1)->where('u_id',$user)->where('static',4)->order('time', 'desc')->select();
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.user')
                ->where('mb_sell_order.type', 1)
                ->where('mb_sell_order.u_id', $user)
                ->where('mb_sell_order.static', 4)
                ->field('a.tel,w.money,w.s_id,w.static,w.time,w.u_id,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();
            foreach ($order as $k => $v) {
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //买入操作订单
    public function result_order_t()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
//            $order=Db::table('mb_sell_order')->where('type',2)->where('user',$user)->where('static','>=',2)->order('time', 'desc')->select();
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.user')
                ->where('mb_sell_order.type', 2)
                ->where('mb_sell_order.user', $user)
                ->where('mb_sell_order.static', '>=', 2)
                ->field('a.tel,w.money,w.s_id,w.static,w.time,w.u_id,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();

            foreach ($order as $k => $v) {
                switch ($v['static']) {
                    case 1:
                        $message = '挂买中';
                        break;
                    case 2:
                        $message = '交易中';
                        break;
                    case 3:
                        $message = '确认中';
                        break;
                    case 4:
                        $message = '已完成';
                        break;

                }
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
                $order[$k]['static'] = $message;
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //买入确认打款
    public function result_pay()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.u_id')
                ->join('mb_bank c', 'w.u_id_bank = c.b_id')
                ->join('mb_bank_name n', 'c.b_name = n.bn_id')
                ->where('mb_sell_order.type', 2)
                ->where('mb_sell_order.user', $user)
                ->where('mb_sell_order.static', 2)
                ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();

            foreach ($order as $k => $v) {
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //卖出确认打款
    public function result_pay_t()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.user')
                ->join('mb_bank c', 'w.user_bank = c.b_id')
                ->join('mb_bank_name n', 'c.b_name = n.bn_id')
                ->where('mb_sell_order.type', 1)
                ->where('mb_sell_order.u_id', $user)
                ->where('mb_sell_order.static', 2)
                ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();

            foreach ($order as $k => $v) {
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
                $order[$k]['static'] = '待支付';
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //买入中心
    public function buy_sentic()
    {
        $money = Request::instance()->param('money');
        if ($money) {
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.u_id')
                ->join('mb_bank c', 'w.u_id_bank = c.b_id')
                ->join('mb_bank_name n', 'c.b_name = n.bn_id')
                ->where('mb_sell_order.type', 2)
                ->where('mb_sell_order.user', null)
                ->where('mb_sell_order.money', $money)
                ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();
            foreach ($order as $k => $v) {
                $order[$k]['time'] = date('Y-m-d', $v['time']);
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //卖出数据接口
    public function sell()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $user_arr = Db::table('mb_user')->where('u_id', $user)->find();
            if ($user_arr['is_card'] != 0) {
                $card = Db::table('mb_bank')
                    ->alias('a')
                    ->join('mb_bank_name w', 'a.b_name = w.bn_id')
                    ->field('a.b_branch,a.c_name,w.bn_name,a.b_card,a.defult')
                    ->where('u_id', $user)
                    ->where('defult', 1)
                    ->find();

                $order = Db::table('mb_sell_order')->where('type', 2)->where('u_id', $user)->where('static', 4)->count('s_id');

                $order1 = Db::table('mb_sell_order')->where('type', 1)->where('user', $user)->where('static', '>=', 2)->count('s_id');

                $order3 = Db::table('mb_sell_order')->where('type', 2)->where('u_id', $user)->where('static', 3)->count('s_id');

                $order4 = Db::table('mb_sell_order')->where('type', 1)->where('user', $user)->where('static', 3)->count('s_id');

                $order5 = Db::table('mb_sell_order')->where('type', 1)->where('static', 1)->count('s_id');


                $order6 = Db::table('mb_sell_order')->where('type', 2)->where('u_id', $user)->where('static', 1)->count('s_id');
                $order7 = Db::table('mb_sell_order')->where('type', 2)->where('u_id', $user)->where('user', '>', 0)->where('static', '>', 1)->count('s_id');


                if ($card) {
                    return jsonp([
                        'code' => 1,
                        'msg' => 'succeed',
                        'data' => $card,
                        'result_pay' => $order3 + $order4,
                        'buy_center' => $order5,
                        'no_order' => $order6 + $order7,
                        'order_result' => $order + $order1
                    ]);
                } else {
                    return jsonp(['code' => 2, 'msg' => '请设置默认银行卡']);
                }

            } else {
                return jsonp(['code' => 2, 'msg' => '请添加银行卡']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }

    //卖出记录
    public function result_out()
    {

        $user = Request::instance()->param('u_id');
        if ($user) {
            $user_arr = Db::table('mb_balance_order')->where('u_id', $user)->order('bo_time desc')->where('type', 4)->field('bo_money,target_uid,bo_time')->select();
            foreach ($user_arr as $k => $v) {
                $user_arr[$k]['bo_time'] = date('Y-m-d H:i:s', $v['bo_time']);
            }
            if ($user_arr) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $user_arr]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }

    //卖出未完成订单（未选择付款人）
    public function no_order_a()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.u_id')
                ->join('mb_bank c', 'w.u_id_bank = c.b_id')
                ->join('mb_bank_name n', 'c.b_name = n.bn_id')
                ->where('mb_sell_order.type', 2)
                ->where('mb_sell_order.u_id', $user)
                ->where('mb_sell_order.user', null)
                ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();

            foreach ($order as $k => $v) {
                switch ($v['static']) {
                    case 1:
                        $message = '挂卖中';
                        break;
                    case 2:
                        $message = '交易中';
                        break;
                    case 3:
                        $message = '确认中';
                        break;
                    case 4:
                        $message = '已完成';
                        break;

                }
                $order[$k]['static'] = $message;
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);

            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据', 'user' => $user]);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //卖出未完成订单（已选择付款人）
    public function no_order_c()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.u_id')
                ->join('mb_bank c', 'w.u_id_bank = c.b_id')
                ->join('mb_bank_name n', 'c.b_name = n.bn_id')
                ->where('mb_sell_order.type', 2)
                ->where('mb_sell_order.u_id', $user)
                ->where('mb_sell_order.user', '>', 0)
                ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();
            foreach ($order as $k => $v) {
                switch ($v['static']) {
                    case 1:
                        $message = '挂卖中';
                        break;
                    case 2:
                        $message = '交易中';
                        break;
                    case 3:
                        $message = '确认中';
                        break;
                    case 4:
                        $message = '已完成';
                        break;

                }
                $order[$k]['static'] = $message;
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //卖出已完成订单
    public function result_order_s()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
//            $order=Db::table('mb_sell_order')->where('type',2)->where('u_id',$user)->where('static',4)->order('time', 'desc')->select();

            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.u_id')
                ->where('mb_sell_order.type', 2)
                ->where('mb_sell_order.u_id', $user)
                ->where('mb_sell_order.static', 4)
                ->field('a.tel,w.money,w.s_id,w.static,w.time,w.u_id,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();


            foreach ($order as $k => $v) {
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //卖出操作订单
    public function result_order_p()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {

            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.u_id')
                ->where('mb_sell_order.type', 1)
                ->where('mb_sell_order.user', $user)
                ->where('mb_sell_order.static', '>=', 2)
                ->field('a.tel,w.money,w.s_id,w.static,w.time,w.u_id,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();


//            $order=Db::table('mb_sell_order')->where('type',1)->where('user',$user)->where('static','>=',2)->order('time', 'desc')->select();
//            Log::write($order,'notice');
            foreach ($order as $k => $v) {
                switch ($v['static']) {
                    case 2:
                        $message = '交易中';
                        break;
                    case 3:
                        $message = '确认中';
                        break;
                    case 4:
                        $message = '已完成';
                        break;

                }
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
                $order[$k]['static'] = $message;
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }

        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }

    }

    //卖出确认收款
    public function result_sell()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.user')
                ->join('mb_bank c', 'w.user_bank = c.b_id')
                ->join('mb_bank_name n', 'c.b_name = n.bn_id')
                ->where('mb_sell_order.type', 2)
                ->where('mb_sell_order.u_id', $user)
                ->where('mb_sell_order.static', 3)
                ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();
            foreach ($order as $k => $v) {
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }
    }

    //买入确认收款
    public function result_sell_t()
    {
        $user = Request::instance()->param('u_id');
        if ($user) {
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.u_id')
                ->join('mb_bank c', 'w.u_id_bank = c.b_id')
                ->join('mb_bank_name n', 'c.b_name = n.bn_id')
                ->where('mb_sell_order.type', 1)
                ->where('mb_sell_order.user', $user)
                ->where('mb_sell_order.static', 3)
                ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();
            foreach ($order as $k => $v) {
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }

        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }

    //卖出中心
    public function sell_sentic()
    {
        $money = Request::instance()->param('money');
        if ($money) {
            $order = Db::table('mb_user')
                ->alias('a')
                ->join('mb_sell_order w', 'a.u_id = w.u_id')
                ->join('mb_bank c', 'w.u_id_bank = c.b_id')
                ->join('mb_bank_name n', 'c.b_name = n.bn_id')
                ->where('mb_sell_order.type', 1)
                ->where('mb_sell_order.user', null)
                ->where('mb_sell_order.money', $money)
                ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('mb_sell_order.time', 'desc')
                ->select();
            foreach ($order as $k => $v) {
                $order[$k]['time'] = date('Y-m-d', $v['time']);
            }
            if ($order) {
                return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
            } else {
                return jsonp(['code' => 2, 'msg' => '暂无数据']);
            }
        } else {
            return jsonp(['code' => 2, 'msg' => '参数错误']);
        }


    }


}
