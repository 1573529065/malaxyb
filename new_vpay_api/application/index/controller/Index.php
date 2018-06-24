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
        $lunbo = Db::table('mb_lunbo')->select();
        if (empty($user)) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $user_arr = Db::table('mb_user')
            ->where('u_id', $user)
            ->field('u_id,user,u_img,tel,assets,balance,vip_static,gold')
            ->find();
        if (!$user_arr) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $beijin = Db::table('mb_beijin')->where('bj_id', 1)->value('bj_img');

        $data = array();

        $date_start = strtotime(date("Y-m-d 00:00:00")); // 今天开始
        $date_end = strtotime(date("Y-m-d 23:59:59")); // 今天开始
        $data_start1 = strtotime(date("Y-m-d 00:00:00", strtotime("-1 day"))); // 昨天开始
        $data_end1 = strtotime(date("Y-m-d 23:59:59", strtotime("-1 day"))); // 昨天结束

//        昨天加速释放和
        $asstes = Db::table('mb_balance_order')
            ->where('type', 5)
            ->where('u_id', $user)
            ->where('bo_time', '<=', $data_end1)
            ->where('bo_time', '>=', $data_start1)
            ->sum('bo_money');
//        昨天每日释放
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

//        每日释放时间
        $time = Db::table('mb_config')->where('co_id', 6)
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

        $notice = array_column($notice, 'n_text');


        foreach ($lunbo as $k => $v) {
            $data['lb_img' . $k] = $v['lb_img'];
        }
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

    }

    /**
     * 如果昨天的加速释放积分+每日释放积分大于0 ,且今天没有领取过红包
     * 则会弹出红包页
     * 现在要求加速和每日释放实时到,所以有些代码需要注释
     * @return \think\response\Jsonp
     */
    public function red_bao()
    {

        $user = Request::instance()->param('u_id');
        if (Cache::get('red_bao' . $user)) return jsonp(['code' => 2, 'msg' => '频率过快']);
        Cache::set('red_bao' . $user, true, 3);
        $user_arr = Db::table('mb_user')
            ->where('u_id', $user)
            ->field('u_id,user,u_img,tel,assets,balance,vip_static')
            ->find();

        $date_start = strtotime(date("Y-m-d 00:00:00")); // 今天开始
        $date_end = strtotime(date("Y-m-d 23:59:59")); // 今天开始
        $data_start1 = strtotime(date("Y-m-d 00:00:00", strtotime("-1 day"))); // 昨天开始
        $data_end1 = strtotime(date("Y-m-d 23:59:59", strtotime("-1 day"))); // 昨天结束

//        查看今天是否已经领过红包
        $today = Db::table('mb_today_assets')
            ->where('u_id', $user)
            ->where('time', '<=', $date_end)
            ->where('time', '>=', $date_start)
            ->find();
        if (!$today) {
//            昨天加速释放和
            $ass1 = Db::table('mb_balance_order')
                ->where('type', 5)
                ->where('u_id', $user)
                ->where('bo_time', '<=', $data_end1)
                ->where('bo_time', '>=', $data_start1)
                ->sum('bo_money');
//            昨天->每日释放数
            $ass = Db::table('mb_balance_order')
                ->where('type', 1)
                ->where('u_id', $user)
                ->where('bo_time', '<=', $data_end1)
                ->where('bo_time', '>=', $data_start1)
                ->limit(1)
                ->sum('bo_money');

            $asstes = $ass1 + $ass; // 昨日 共释放量
            if ($user_arr['assets'] > $asstes && $asstes > 0) {
                $asstes = $asstes;
            } else if ($user_arr['assets'] <= $asstes && $asstes > 0) {
                $asstes = $user_arr['assets'];
            }

            // 因为现在是实时奖励,所以在领红包的时候就不需要更新用户资产了
//            $res1 = Db::table('mb_user')->where('u_id', $user)
//                ->setDec('assets', $asstes);
//            $res2 = Db::table('mb_user')->where('u_id', $user)
//                ->setInc('balance', $asstes);

            Db::table('mb_today_assets')->insert([
                'u_id' => $user,
                'assets' => $asstes,
                'time' => time(),
            ]);
            return jsonp([
                'code' => 1,
                'msg' => '领取成功',
                'money' => $asstes
            ]);
//            if ($res1 && $res2) {
//                return jsonp([
//                    'code' => 1,
//                    'msg' => '领取成功',
//                    'money' => $asstes
//                ]);
//            } else {
//                return jsonp(['code' => 2, 'msg' => '参数错误']);
//            }
        }

    }


    //公告
    public function notice()
    {
        $token = Request::instance()->param('token');
        if (!$token) return jsonp(['code' => 2, 'msg' => '参数错误']);
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
    }

    /**
     * 个人信息->钱包地址
     * 20180624 改为钱包地址
     * @return \think\response\Jsonp
     */
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
        if (empty($u_id)) return jsonp(['code' => 2, 'msg' => '参数错误']);
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


    /*
     * 公告详情页
     */
    public function notice_list()
    {
        $user = Request::instance()->param('token');
        $soid = Request::instance()->param('n_id');
        if ($user != 'notice') return jsonp(['code' => 2, 'msg' => '参数错误']);

        $card = Db::table('mb_notice')->where('n_id', $soid)->find();
        if ($card) {
            $card['time'] = date('Y-m-d H:i:s', $card['time']);
            return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $card]);
        } else {
            return jsonp(['code' => 2, 'msg' => '暂无数据']);
        }
    }


    //个人信息->消息详情页
    public function message_list()
    {
        $user = Request::instance()->param('token');
        $soid = Request::instance()->param('m_id');
        if ($user != 'message') return jsonp(['code' => 2, 'msg' => '参数错误']);

        $card = Db::table('mb_message')->where('m_id', $soid)->find();
        if ($card) {
            $card['m_time'] = date('Y-m-d H:i:s', $card['m_time']);
            return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $card]);
        } else {
            return jsonp(['code' => 2, 'msg' => '暂无数据']);
        }
    }


    //关于(中文)
    public function about()
    {
        $token = Request::instance()->param('token');
        $type = Request::instance()->param('type', 1);
        if ($token != 'about') return jsonp(['code' => 2, 'msg' => '参数错误']);

        $about = Db::table('mb_about')->where('type', $type)->field('a_text')->find();
        if ($about) {
            return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $about]);
        } else {
            return jsonp(['code' => 2, 'msg' => '暂无数据']);
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
        if ($token != 'about_t') return jsonp(['code' => 2, 'msg' => '参数错误']);

        $about = Db::table('mb_about')->where('type', 2)->field('a_text')->find();
        if ($about) {
            return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $about]);
        } else {
            return jsonp(['code' => 2, 'msg' => '暂无数据']);
        }
    }


    // 用户中心->我的银行卡
    public function card()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);

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
    }

    //资讯
    public function news()
    {
        $user = Request::instance()->param('token');
        if ($user != 'news') return jsonp(['code' => 2, 'msg' => '参数错误']);

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
    }

    //资讯详情页
    public function news_list()
    {
        $user = Request::instance()->param('token');
        $soid = Request::instance()->param('so_id');
        if ($user != 'news' || empty($soid)) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $card = Db::table('vpay_shop')->where('sh_id', $soid)->find();
        if ($card) {
            $card['time'] = date('Y-m-d H:i:s', $card['time']);
            return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $card]);
        } else {
            return jsonp(['code' => 2, 'msg' => '暂无数据']);
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
        if ($token != 'bank') return jsonp(['code' => 2, 'msg' => '参数错误']);

        $card = Db::table('mb_bank_name')->field('bn_id,bn_name')->select();
        if ($card) {
            return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $card]);
        } else {
            return jsonp(['code' => 2, 'msg' => '暂无数据']);
        }
    }

    //分享记录
    public function share_order()
    {
        $user = Request::instance()->param('u_id');
        if (empty($user)) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $order = Db::table('vpay_share_order')
            ->alias('a')
            ->join('mb_user w', 'a.user = w.u_id')
            ->where('a.u_id', $user)
            ->field('w.user,w.u_img,w.u_id,a.time,w.vip_static,w.tel')
            ->select();

        if ($order) {
            foreach ($order as $k => $v) {
                $order[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
            }
            return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
        } else {
            return jsonp(['code' => 2, 'msg' => '暂无数据']);
        }
    }


    public function qrcode($text)
    {
        \think\Loader::import('qrcode.qrcode');
        $text = base64_decode($text);
        return \QRcode::png($text);
        exit;
    }


    /**
     * 买入数据接口
     * type 1 买入 2.卖出
     * static 1: 挂卖中 2:交易中 3 确认中 4 已完成'
     * @return \think\response\Jsonp
     */
    public function purchase()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $user_arr = Db::table('mb_user')->where('u_id', $user)->find();
        if ($user_arr['is_card'] == 0) return jsonp(['code' => 2, 'msg' => '请添加银行卡']);

        $card = Db::table('mb_bank')
            ->alias('a')
            ->join('mb_bank_name w', 'a.b_name = w.bn_id')
            ->field('a.b_branch,a.c_name,w.bn_name,a.b_card,a.defult')
            ->where('u_id', $user)
            ->where('defult', 1)
            ->find();
        if (empty($card)) return jsonp(['code' => 2, 'msg' => '请设置默认银行卡']);

//        买入完成的订单数量
        $order = Db::table('mb_sell_order')->where('type', 1)
            ->where('u_id', $user)
            ->where('static', 4)
            ->count('s_id');

//        卖出的未完成订单数量
        $order1 = Db::table('mb_sell_order')->where('type', 2)
            ->where('user', $user)
            ->where('static', '>=', 2)
            ->count('s_id');

//        正在交易中的买入 订单数
        $order3 = Db::table('mb_sell_order')->where('type', 1)
            ->where('u_id', $user)
            ->where('static', 2)
            ->count('s_id');
//        正在交易中的卖出 订单数
        $order4 = Db::table('mb_sell_order')->where('type', 2)
            ->where('user', $user)
            ->where('static', 2)
            ->count('s_id');

//        正在挂卖中,没有付款人的买入 订单数
        $order6 = Db::table('mb_sell_order')->where('type', 1)
            ->where('u_id', $user)
            ->where('static', 1)
            ->where('user', null)
            ->count('s_id');

//        正在交易中,有付款人的买入 订单数
        $order7 = Db::table('mb_sell_order')->where('type', 1)
            ->where('u_id', $user)
            ->where('user', '>', 1)
            ->where('static', '>', 1)
            ->count('s_id');
//        正在挂卖中的卖出 订单数
        $order5 = Db::table('mb_sell_order')->where('type', 2)
            ->where('static', 1)
            ->count('s_id');

        return jsonp([
            'code' => 1,
            'msg' => 'succeed',
            'data' => $card,
            'result_pay' => $order3 + $order4, // 交易中的订单数
            'buy_center' => $order5,
            'no_order' => $order6 + $order7,
            'order_result' => $order + $order1
        ]);
    }

    //买入记录
    public function result_turn()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $user_arr = Db::table('mb_balance_order')->where('u_id', $user)
            ->where('type', 3)
            ->order('bo_time desc')
            ->field('bo_money,target_uid,bo_time')
            ->select();

        foreach ($user_arr as $k => $v) {
            $user_arr[$k]['bo_time'] = date('Y-m-d H:i:s', $v['bo_time']);
        }
        if ($user_arr) {
            return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $user_arr]);
        } else {
            return jsonp(['code' => 2, 'msg' => '暂无数据']);
        }
    }

    //买入未完成订单（未选择收款人）
    public function no_order()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);
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
    }

    //买入未完成订单（已选择收款人）
    public function no_order_t()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.u_id')
            ->join('mb_bank c', 'w.u_id_bank = c.b_id')
            ->join('mb_bank_name n', 'c.b_name = n.bn_id')
            ->where('w.type', 1)
            ->where('w.u_id', $user)
            ->where('w.user', '>', 1)
            ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
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
    }

    //买入已完成订单
    public function result_order()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);
        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.user')
            ->where('w.type', 1)
            ->where('w.u_id', $user)
            ->where('w.static', 4)
            ->field('a.tel,w.money,w.s_id,w.static,w.time,w.u_id,w.shi_money')
            ->order('w.time', 'desc')
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

    //买入操作订单
    public function result_order_t()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.user')
            ->where('w.type', 2)
            ->where('w.user', $user)
            ->where('w.static', '>=', 2)
            ->field('a.tel,w.money,w.s_id,w.static,w.time,w.u_id,w.shi_money')
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
    }

    //买入确认打款
    public function result_pay()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.u_id')
            ->join('mb_bank c', 'w.u_id_bank = c.b_id')
            ->join('mb_bank_name n', 'c.b_name = n.bn_id')
            ->where('w.type', 2)
            ->where('w.user', $user)
            ->where('w.static', 2)
            ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
            ->order('w.time', 'desc')
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
                ->where('w.type', 1)
                ->where('w.u_id', $user)
                ->where('w.static', 2)
                ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('w.time', 'desc')
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
                ->where('w.type', 2)
                ->where('w.user', null)
                ->where('w.money', $money)
                ->field('a.u_img,a.user,a.tel,
                n.bn_name,w.money,w.s_id,
                w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
                ->order('w.time', 'desc')
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
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $user_arr = Db::table('mb_user')->where('u_id', $user)->find();
        if ($user_arr['is_card'] == 0) return jsonp(['code' => 2, 'msg' => '请添加银行卡']);

        $card = Db::table('mb_bank')
            ->alias('a')
            ->join('mb_bank_name w', 'a.b_name = w.bn_id')
            ->field('a.b_branch,a.c_name,w.bn_name,a.b_card,a.defult')
            ->where('u_id', $user)
            ->where('defult', 1)
            ->find();
        if(empty($card)) return jsonp(['code' => 2, 'msg' => '请设置默认银行卡']);

        $order = Db::table('mb_sell_order')->where('type', 2)->where('u_id', $user)->where('static', 4)->count('s_id');

        $order1 = Db::table('mb_sell_order')->where('type', 1)->where('user', $user)->where('static', '>=', 2)->count('s_id');

        $order3 = Db::table('mb_sell_order')->where('type', 2)->where('u_id', $user)->where('static', 3)->count('s_id');

        $order4 = Db::table('mb_sell_order')->where('type', 1)->where('user', $user)->where('static', 3)->count('s_id');

        $order5 = Db::table('mb_sell_order')->where('type', 1)->where('static', 1)->count('s_id');

        $order6 = Db::table('mb_sell_order')->where('type', 2)->where('u_id', $user)->where('static', 1)->count('s_id');
        $order7 = Db::table('mb_sell_order')->where('type', 2)->where('u_id', $user)->where('user', '>', 0)->where('static', '>', 1)->count('s_id');

        return jsonp([
            'code' => 1,
            'msg' => 'succeed',
            'data' => $card,
            'result_pay' => $order3 + $order4,
            'buy_center' => $order5,
            'no_order' => $order6 + $order7,
            'order_result' => $order + $order1
        ]);
    }

    //卖出记录
    public function result_out()
    {
        $user = Request::instance()->param('u_id');
        if (!$user)  return jsonp(['code' => 2, 'msg' => '参数错误']);
        $user_arr = Db::table('mb_balance_order')
            ->where('u_id', $user)
            ->where('type', 4)
            ->order('bo_time desc')
            ->field('bo_money,target_uid,bo_time')->select();
        foreach ($user_arr as $k => $v) {
            $user_arr[$k]['bo_time'] = date('Y-m-d H:i:s', $v['bo_time']);
        }
        if ($user_arr) {
            return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $user_arr]);
        } else {
            return jsonp(['code' => 2, 'msg' => '暂无数据']);
        }
    }

    //卖出未完成订单（未选择付款人）
    public function no_order_a()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);
        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.u_id')
            ->join('mb_bank c', 'w.u_id_bank = c.b_id')
            ->join('mb_bank_name n', 'c.b_name = n.bn_id')
            ->where('w.type', 2)
            ->where('w.u_id', $user)
            ->where('w.user', null)
            ->field('a.u_img,a.user,a.tel,n.bn_name,
            w.money,w.s_id,w.static,w.time,w.u_id,
            c.b_card,c.c_name,w.shi_money')
            ->order('w.time', 'desc')
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
    }

    //卖出未完成订单（已选择付款人）
    public function no_order_c()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);
        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.u_id')
            ->join('mb_bank c', 'w.u_id_bank = c.b_id')
            ->join('mb_bank_name n', 'c.b_name = n.bn_id')
            ->where('w.type', 2)
            ->where('w.u_id', $user)
            ->where('w.user', '>', 0)
            ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
            ->order('w.time', 'desc')
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
    }

    //卖出已完成订单
    public function result_order_s()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.u_id')
            ->where('w.type', 2)
            ->where('w.u_id', $user)
            ->where('w.static', 4)
            ->field('a.tel,w.money,w.s_id,w.static,w.time,w.u_id,w.shi_money')
            ->order('w.time', 'desc')
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

    //卖出操作订单
    public function result_order_p()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.u_id')
            ->where('w.type', 1)
            ->where('w.user', $user)
            ->where('w.static', '>=', 2)
            ->field('a.tel,w.money,w.s_id,w.static,w.time,w.u_id,w.shi_money')
            ->order('w.time', 'desc')
            ->select();

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
    }

    //卖出确认收款
    public function result_sell()
    {
        $user = Request::instance()->param('u_id');
        if (!$user)  return jsonp(['code' => 2, 'msg' => '参数错误']);

        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.user')
            ->join('mb_bank c', 'w.user_bank = c.b_id')
            ->join('mb_bank_name n', 'c.b_name = n.bn_id')
            ->where('w.type', 2)
            ->where('w.u_id', $user)
            ->where('w.static', 3)
            ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
            ->order('w.time', 'desc')
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

    //买入确认收款
    public function result_sell_t()
    {
        $user = Request::instance()->param('u_id');
        if (!$user) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.u_id')
            ->join('mb_bank c', 'w.u_id_bank = c.b_id')
            ->join('mb_bank_name n', 'c.b_name = n.bn_id')
            ->where('w.type', 1)
            ->where('w.user', $user)
            ->where('w.static', 3)
            ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
            ->order('w.time', 'desc')
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

    //卖出中心
    public function sell_sentic()
    {
        $money = Request::instance()->param('money');
        if (!$money) return jsonp(['code' => 2, 'msg' => '参数错误']);

        $order = Db::table('mb_user')
            ->alias('a')
            ->join('mb_sell_order w', 'a.u_id = w.u_id')
            ->join('mb_bank c', 'w.u_id_bank = c.b_id')
            ->join('mb_bank_name n', 'c.b_name = n.bn_id')
            ->where('w.type', 1)
            ->where('w.user', null)
            ->where('w.money', $money)
            ->field('a.u_img,a.user,a.tel,n.bn_name,w.money,w.s_id,w.static,w.time,w.u_id,c.b_card,c.c_name,w.shi_money')
            ->order('w.time', 'desc')
            ->select();

        foreach ($order as $k => $v) {
            $order[$k]['time'] = date('Y-m-d', $v['time']);
        }
        if ($order) {
            return jsonp(['code' => 1, 'msg' => 'succeed', 'data' => $order]);
        } else {
            return jsonp(['code' => 2, 'msg' => '暂无数据']);
        }
    }


}
