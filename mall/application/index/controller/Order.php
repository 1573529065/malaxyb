<?php

namespace app\index\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;
use think\Log;

class Order extends Common
{
    /**
     * [index 订单列表]
     * @Author    wyc
     * @DateTime  2018-05-24T14:18:18+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function index()
    {
        $mall = Db::connect('mall');
        $login_user = Cookie::get('logined_user');
        $param = Request::instance()->param();
        if ($login_user['type'] == 1) {
            $where = '';
        } else {
            if (!isset($login_user['admin_id'])) $this->redirect('login/login');
            $where['a.seller_id'] = $login_user['admin_id'];
        }
        $time1 = date("Y-m-d H:i:s", 0);
        $time2 = date('Y-m-d H:i:s', strtotime('1 day'));

        $order = $mall->table('mall_order a')
            ->join('mall_delivery_address b', 'a.address_id = b.address_id')
            ->join('mall_goods c', 'a.goods_id = c.goods_id')
            ->join('mall_goods_classify d', 'c.classify_id=d.classify_id')
            ->join('mall_admin e', 'e.admin_id = a.seller_id')
            ->where('a.is_delete', 0)
            ->where($where)
            ->whereTime('a.add_time', 'between', [$time1, $time2])
            ->field('order_id,order_sn,a.u_id,e.shop_name,c.goods_name,d.name,c.price,num,total_price,address,a.status,a.add_time')
            ->paginate(10);
        $class = $mall->table('mall_goods_classify')->where('is_delete', 0)->select();
        $this->assign('time1', $time1);
        $this->assign('time2', $time2);
        $this->assign('classify', $class);
        $this->assign('order', $order);
        return $this->fetch();
    }

    /**
     * [orderExport 订单表导出excel]
     * @Author    wyc
     * @DateTime  2018-05-29T11:19:45+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function orderExport()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $login_user = Cookie::get('logined_user');
        \think\Loader::import('PHPExcel', EXTEND_PATH);
        $excel = new \PHPExcel();
        $letter = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', "AG", 'AH', 'AI', 'AJ');
        //表头数组
        if ($login_user['type'] == 1) {
            $tableheader = ['订单id', '订单编号', '所属商家', '商品分类', '用户id', '商品名', '商品单价', '购买数量', '商品总价', '收货地址', '订单状态', '下单时间'];
            $fields = 'order_id,order_sn,e.shop_name,d.name,a.u_id,c.goods_name,c.price,num,total_price,address,a.status,a.add_time';
            $where = '';
            if (isset($param['search'])) {
                $search = $param['search'];
                $where['a.u_id|c.goods_name|d.name|e.shop_name'] = ['like', '%' . $param['search'] . '%'];

            } else {
                $search = '';
            }
        } elseif ($param['type'] == 2) {
            $tableheader = ['订单id', '订单编号', '用户id', '商品名', '商品单价', '购买数量', '商品总价', '收货地址', '订单状态', '下单时间'];
            $fields = 'order_id,order_sn,a.u_id,c.goods_name,c.price,num,total_price,address,a.status,a.add_time';
            if (isset($param['search'])) {
                $where['a.u_id|c.goods_name'] = ['like', '%' . $param['search'] . '%'];

            }
            $where['seller_id'] = $login_user['admin_id'];
        }
        if ($param['status'] == -1) {
            $where['a.status'] = ['in', [0, 1, 2, 3]];
        } else {
            $where['a.status'] = $param['status'];
        }
        $time1 = $param['time1'];

        $time2 = $param['time2'];

        //dump($tableheader);exit;
        //填充表头信息
        for ($i = 0; $i < count($tableheader); $i++) {
            $excel->getActiveSheet()->setCellValue("$letter[$i]1", "$tableheader[$i]");
        }

        //表格数组
        $order = $mall->table('mall_order a')
            ->join('mall_delivery_address b', 'a.address_id = b.address_id')
            ->join('mall_goods c', 'a.goods_id = c.goods_id')
            ->join('mall_goods_classify d', 'c.classify_id=d.classify_id')
            ->join('mall_admin e', 'e.admin_id = a.seller_id')
            ->where('a.is_delete', 0)
            ->where($where)
            ->whereTime('a.add_time', 'between', [$time1, $time2])
            ->field($fields)
            ->select();
        foreach ($order as $key => $value) {
            switch ($value['status']) {
                case 0:
                    $value['status'] = '未付款';
                    break;
                case 1:
                    $value['status'] = '已付款';
                    break;
                case 2:
                    $value['status'] = '已发货';
                    break;
                case 3:
                    $value['status'] = '已完成';
                    break;

            }
            $value['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
            $new[$key] = $value;
        }
        //dump($new);exit;
        //dump($data);exit;
        //填充表格信息
        for ($i = 2; $i <= count($new) + 1; $i++) {
            $j = 0;
            foreach ($new[$i - 2] as $key => $value) {
                $excel->getActiveSheet()->setCellValue("$letter[$j]$i", "$value");
                $j++;
            }
        }
        $title = '订单表';
        $write = new \PHPExcel_Writer_Excel5($excel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl;charset=UTF-8");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header("Content-Disposition:attachment;filename=$title.xls");
        header("Content-Transfer-Encoding:binary");
        $write->save('php://output');
    }

    /**
     * [search 订单查询页面]
     * @Author    wyc
     * @DateTime  2018-05-29T09:11:01+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function search()
    {
        $mall = Db::connect('mall');
        $login_user = Cookie::get('logined_user');
        $param = Request::instance()->param();
        if ($login_user['type'] == 1) {
            $where = '';
            if (isset($param['search'])) {
                $search = $param['search'];
                $where['a.u_id|c.goods_name|d.name|e.shop_name'] = ['like', '%' . $param['search'] . '%'];

            } else {
                $search = '';
            }
        } else {
            if (isset($param['search'])) {
                $search = $param['search'];
                $where['a.u_id|c.goods_name'] = ['like', '%' . $param['search'] . '%'];

            } else {
                $search = '';
            }
            $where['a.seller_id'] = $login_user['admin_id'];
        }
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

        if (isset($param['status'])) {
            $status = $param['status'];
            if ($param['status'] == -1) {
                $where['a.status'] = ['in', [0, 1, 2, 3]];
            } else {
                $where['a.status'] = $param['status'];
            }
        } else {
            $status = -1;
        }
        $order = $mall->table('mall_order a')
            ->join('mall_delivery_address b', 'a.address_id = b.address_id')
            ->join('mall_goods c', 'a.goods_id = c.goods_id')
            ->join('mall_goods_classify d', 'c.classify_id=d.classify_id')
            ->join('mall_admin e', 'e.admin_id = a.seller_id')
            ->where('a.is_delete', 0)
            ->where($where)
            ->whereTime('a.add_time', 'between', [$time1, $time2])
            ->field('order_id,order_sn,a.u_id,e.shop_name,c.goods_name,d.name,c.price,num,total_price,address,a.status,a.add_time')
            ->paginate(10, false, [
                'query' => Request::instance()->param()
            ]);
        $class = $mall->table('mall_goods_classify')->where('is_delete', 0)->select();
        $this->assign('search', $search);
        $this->assign('status', $status);
        $this->assign('time1', $time1);
        $this->assign('time2', $time2);
        $this->assign('classify', $class);
        $this->assign('order', $order);
        return $this->fetch();
    }

    /**
     * [updateOrder 修改订单页面加载]
     * @Author    wyc
     * @DateTime  2018-05-25T11:48:55+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function updateOrder()
    {
        $param = Request::instance()->param();
        /*		log::write('参数');
                log::write($param);*/
        $mall = Db::connect('mall');
        $goodsInfo = $mall->table('mall_order')->where('is_delete', 0)->where('order_id', $param['order_id'])->find();
        $address = $mall->table('mall_delivery_address')->where('u_id', $goodsInfo['u_id'])->where('is_delete', 0)->select();
        $option = '';
        foreach ($address as $key => $value) {
            if ($goodsInfo['address_id'] == $value['address_id']) {
                $option .= "<option selected value=" . $value['address_id'] . ">" . $value['address'] . "</option>";
            } else {
                $option .= "<option value=" . $value['address_id'] . ">" . $value['address'] . "</option>";
            }

        }

        $goodsInfo['addressInfo'] = $option;
        $data['code'] = 1;
        $data['data'] = $goodsInfo;
        echo json_encode($data);
    }

    /**
     * [updateOrder1 修改订单]
     * @Author    wyc
     * @DateTime  2018-05-25T13:29:31+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function updateOrder1()
    {
        $param = Request::instance()->param();
        /*		log::write('参数');
                log::write($param);*/
        $mall = Db::connect('mall');
        $data['price'] = $param['price'];
        $data['num'] = $param['num'];
        $data['total_price'] = $param['total_price'];
        $data['address_id'] = $param['address_id'];
        $data['status'] = $param['status'];
        $data['add_time'] = time();
        $data['update_time'] = time();
        $res = $mall->table('mall_order')->where('order_id', $param['order_id'])->update($data);
        if ($res) {
            $re['code'] = 1;
        } else {
            $re['code'] = 0;
        }

        echo json_encode($re);
    }

    /**
     * [delOrder 删除订单]
     * @Author    wyc
     * @DateTime  2018-05-25T13:37:12+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function delOrder()
    {
        $param = Request::instance()->param();
        /*		log::write('参数');
                log::write($param);*/
        $mall = Db::connect('mall');
        $res = $mall->table('mall_order')->where('order_id', $param['order_id'])->update(['is_delete' => 1]);
        if ($res) {
            $re['code'] = 1;
        } else {
            $re['code'] = 0;
        }
        echo json_encode($re);
    }

}