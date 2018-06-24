<?php

namespace app\index\controller;

use think\Cache;
use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;

class Card extends Controller
{


    //添加银行卡
    public function card()
    {
        $user = Request::instance()->param('u_id'); // 用户u_id
        $name = Request::instance()->param('name'); //持卡人姓名
        $card_id = Request::instance()->param('card_id'); //银行卡号
        $bank = Request::instance()->param('bank'); //开户银行

        $default = Request::instance()->param('defult'); //是否默认
        $branch = Request::instance()->param('branch'); //开户支行

        if (Cache::get('card')) return json(['code' => 2, 'msg' => '频率过快!']);
        if (empty($user) || empty($name) || empty($card_id) || empty($bank)) return jsonp(['code' => 2, 'msg' => '参数错误']);

        Cache::set('card', true, 2);
        $data = [
            'u_id' => $user,
            'c_name' => $name,
            'b_name' => $bank,
            'b_card' => $card_id,
        ];
        if (!empty($branch)) $data['b_branch'] = $branch;
        if (!empty($default)) $data['defult'] = $default;

        $b_id = Db::table('mb_bank')->insertGetId($data);
        Db::table('mb_user')->where('u_id', $user)->setField('is_card', 1);

        if (!empty($default)){
            Db::table('mb_bank')->where('u_id', $user)
                ->where('b_id', '<>', $b_id)
                ->setField('defult', 0);
        }
        if ($b_id){
            return jsonp(['code' => 1, 'msg' => '添加成功！']);
        } else {
            return jsonp(['code' => 2, 'msg' => '添加失败！']);
        }
    }

    /**
     * 删除银行卡
     * @param u_id 用户u_id
     * @param b_id 银行卡b_id
     * @return \think\response\Json|\think\response\Jsonp
     */
    public function del_card()
    {
        $user = Request::instance()->param('u_id');
        $bc_id = Request::instance()->param('b_id');

        if (Cache::get('del_card')) return json(['code' => 2, 'msg' => '频率过快!']);
        if (empty($user) || empty($bc_id)) return jsonp(['code' => 2, 'msg' => '参数错误！']);
        Cache::set('del_card', true, 3);
        $res = Db::table('mb_bank')
            ->where('u_id', $user)
            ->where('b_id', $bc_id)
            ->delete();
        if ($res) {
            return jsonp(['code' => 1, 'msg' => '删除成功！']);
        } else {
            return jsonp(['code' => 2, 'msg' => '删除失败！']);
        }
    }

    /**ying
     * 设为默认银行卡
     * @param u_id 用户u_id
     * @param b_id 银行卡b_id
     * @return \think\response\Json|\think\response\Jsonp
     */
    public function default_bc()
    {
        $user = Request::instance()->param('u_id');
        $bc_id = Request::instance()->param('b_id');
        if (Cache::get('default_bc'))  return json(['code' => 2, 'msg' => '频率过快!']);

        Cache::set('default_bc', true, 3);
        if (empty($user) || empty($bc_id)) return jsonp(['code' => 2, 'msg' => '参数错误！']);

        $default = Db::table('mb_bank')
            ->where('u_id', $user)
            ->where('b_id', $bc_id)
            ->field('defult')
            ->find();

        if ($default['defult'] == 1) return jsonp(['code' => 2, 'msg' => '该卡已是默认银行卡']);

        $res = Db::table('mb_bank')->where('u_id', $user)
            ->where('b_id', $bc_id)
            ->setField('defult', 1);

        Db::table('mb_bank')->where('u_id', $user)
            ->where('b_id', '<>', $bc_id)
            ->setField('defult', 0);

        if ($res) {
            return jsonp(['code' => 1, 'msg' => '设为默认成功！']);
        } else {
            return jsonp(['code' => 2, 'msg' => '设为默认失败！']);
        }
    }


}