<?php

namespace app\index\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;
use think\Log;

class Address extends Common
{
    /**
     * [index 用户详情列表]
     * @Author    wyc
     * @DateTime  2018-05-24T14:18:18+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function index()
    {
        $param = Request::instance()->param();
        $res = Db::name('mb_user')
            ->paginate(10, false, ['query' => Request::instance()->param()]);
        $time1 = date('Y-m-d', 0);
        $time2 = date('Y-m-d', strtotime('1 day'));
        $this->assign('time1', $time1);
        $this->assign('time2', $time2);
        $this->assign('userinfo', $res);
        return $this->fetch();
    }

    public function search()
    {
        $param = Request::instance()->param();
        if ($param['time1'] != '') {
            $time1 = $param['time1'];
        } else {
            $time1 = date('Y-m-d', 0);
        }
        if ($param['time2'] != '') {
            $time2 = $param['time2'];
        } else {
            $time2 = date('Y-m-d', strtotime('1 day'));
        }
        if ($param['search'] != '') {
            $where['u_id|user|u_name'] = ['like', '%' . $param['search'] . '%'];
            $search = $param['search'];
        } else {
            $search = '';
        }
        if ($param['status'] == -1) {
            $where['status'] = ['in', [0, 1]];
        } else {
            $where['status'] = $param['status'];

        }
        $status = $param['status'];
        $res = Db::name('mb_user')
            ->where($where)
            ->whereTime('time', 'between', [$time1, $time2])
            ->paginate(10, false, ['query' => Request::instance()->param()]);
        $this->assign('search', $search);
        $this->assign('status', $status);
        $this->assign('time1', $time1);
        $this->assign('time2', $time2);
        $this->assign('userinfo', $res);
        return $this->fetch();
    }

    /**
     * [addAddress 添加收货地址]
     * @Author    wyc
     * @DateTime  2018-05-25T14:01:24+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     */
    public function addAddress()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $user = Db::name('mb_user')->where('u_id', $param['u_id'])->find();
        if (!$user) {
            $re['code'] = -1;
            $re['msg'] = '用户id不存在';
            echo json_encode($re);
            exit;
        }
        $param['add_time'] = time();
        $res = $mall->table('mall_delivery_address')->insert($param);
        if ($res) {
            $re['code'] = 1;
            $re['msg'] = '添加成功';
        } else {
            $re['code'] = 0;
            $re['msg'] = '添加失败';
        }
        echo json_encode($re);
    }

    /**
     * [getAddress 获取地址]
     * @Author    wyc
     * @DateTime  2018-05-25T14:53:30+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function getAddress()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $res = $mall->table('mall_delivery_address')->where('u_id', $param['u_id'])->where('is_delete', 0)->select();
        if ($res) {
            $re['code'] = 1;
            $re['data'] = $res;
        } else {
            $re['code'] = 0;
            $re['data'] = array();
        }


        echo json_encode($re);
    }

    /**
     * [updateAddressStatus 修改地址状态]
     * @Author    wyc
     * @DateTime  2018-05-25T14:53:59+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function updateAddressStatus()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        /*		log::write('参数');
                log::write($param);*/
        if ($param['is_default'] == 0) {
            $defaults = $mall->table('mall_delivery_address')->where('u_id', $param['u_id'])->where('is_default', 1)->find();
            if ($defaults) {
                $mall->table('mall_delivery_address')->where('u_id', $param['u_id'])->where('address_id', $defaults['address_id'])->update(['is_default' => 0]);
            }
            $msg = '默认';
            $status = 1;
        } else {
            $msg = '非默认';
            $status = 0;
        }
        $res = $mall->table('mall_delivery_address')->where('address_id', $param['address_id'])->update(['is_default' => $status]);
        if ($res) {
            $re['code'] = 1;
            $re['msg'] = $msg;
            $re['data'] = $status;
        } else {
            $re['code'] = 0;
            $re['msg'] = '设置默认失败';
            $re['data'] = $status;
        }
        echo json_encode($re);

    }

    /**
     * [delAddress 删除地址]
     * @Author    wyc
     * @DateTime  2018-05-29T15:17:06+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function delAddress()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $res = $mall->table('mall_delivery_address')->where('address_id', $param['address_id'])->update(['is_delete' => 1]);
        if ($res) {
            $re['code'] = 1;

        } else {
            $re['code'] = 0;
        }
        echo json_encode($re);
    }

    /**
     * [changeStatus 修改用户状态]
     * @Author    wyc
     * @DateTime  2018-05-29T15:17:35+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function changeStatus()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $status = Db::name('mb_user')->where('u_id', $param['u_id'])->value('status');
        if ($status == 1) {
            $data['data'] = '已禁用';
            $res = Db::name('mb_user')->where('u_id', $param['u_id'])->setField('status', 0);
        } else {
            $data['data'] = '已启用';
            $res = Db::name('mb_user')->where('u_id', $param['u_id'])->setField('status', 1);
        }
        if ($res) {
            $data['code'] = 1;
            $data['msg'] = 'success';
            echo json_encode($data);
        } else {
            $data['code'] = 0;
            $data['msg'] = 'fail';
            echo json_encode($data);
        }
    }

}