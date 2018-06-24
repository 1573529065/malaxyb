<?php

namespace app\index\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;
use think\Log;

class Goods extends Common
{
    /**
     * [index 商品列表]
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
        $res = $mall->table('mall_goods a')
            ->where('a.is_delete', 0)
            ->join('mall_goods_classify b', 'a.classify_id = b.classify_id')
            ->join('mall_admin c', 'a.seller_id=c.admin_id')
            ->field('a.goods_id,b.name,a.content,a.standard,a.goods_name,a.goods_img,a.price,a.stock,a.sales_num,c.shop_name,a.status,a.add_time')
            ->where($where)
            ->whereTime('a.add_time', 'between', [$time1, $time2])
            ->paginate(10, false, [
                'query' => Request::instance()->param()
            ]);
        $class = $mall->table('mall_goods_classify')->where('is_delete', 0)->select();
        $this->assign('time1', $time1);
        $this->assign('time2', $time2);
        $this->assign('classify', $class);
        $this->assign('goods', $res);
        return $this->fetch();
    }

    /**
     * [goodsExport 商品导出excel]
     * @Author    wyc
     * @DateTime  2018-05-29T10:42:45+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function goodsExport()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $login_user = Cookie::get('logined_user');
        \think\Loader::import('PHPExcel', EXTEND_PATH);
        $excel = new \PHPExcel();
        $letter = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', "AG", 'AH', 'AI', 'AJ');
        //表头数组
        if ($param['type'] == 1) {
            $tableheader = ['商品id', '商品名', '所属商家', '商品分类', '商品价格', '商品库存', '销量', '详情', '规格', '状态', '添加时间'];
            $fields = 'a.goods_id,a.goods_name,c.shop_name,b.name,a.price,a.stock,a.sales_num,a.content,a.standard,a.status,a.add_time';
            $where = '';
            if (isset($param['search'])) {
                $search = $param['search'];
                $where['a.goods_name|b.name|c.shop_name'] = ['like', '%' . $param['search'] . '%'];

            } else {
                $search = '';
            }
        } elseif ($param['type'] == 2) {
            $tableheader = ['商品id', '商品名', '商品价格', '商品库存', '销量', '详情', '规格', '状态', '添加时间'];
            $fields = 'a.goods_id,a.goods_name,a.price,a.stock,a.sales_num,a.content,a.standard,a.status,a.add_time';
            if (isset($param['search'])) {
                $where['a.goods_name'] = ['like', '%' . $param['search'] . '%'];

            }
            $where['seller_id'] = $login_user['admin_id'];
        }
        if ($param['status'] == -1) {
            $where['a.status'] = ['in', [0, 1]];
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
        $res = $mall->table('mall_goods a')
            ->where('a.is_delete', 0)
            ->join('mall_goods_classify b', 'a.classify_id = b.classify_id')
            ->join('mall_admin c', 'a.seller_id=c.admin_id')
            ->field($fields)
            ->where($where)
            ->whereTime('a.add_time', 'between', [$time1, $time2])
            ->select();
        foreach ($res as $key => $value) {
            switch ($value['status']) {
                case 0:
                    $value['status'] = '已下架';
                    break;
                case 1:
                    $value['status'] = '已上架';
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
        $title = '商品表';
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
     * [search 查找]
     * @Author    wyc
     * @DateTime  2018-05-29T10:03:11+0800
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
            //echo 1;
            $where = '';
            if (isset($param['search'])) {
                $search = $param['search'];
                $where['a.goods_name|b.name|c.shop_name'] = ['like', '%' . $param['search'] . '%'];
                //echo 1;

            } else {
                $search = '';
            }
        } elseif ($login_user['type'] == 2) {
            if ($param['search'] != '') {
                $search = $param['search'];
                $where['a.goods_name'] = ['like', '%' . $param['search'] . '%'];

            } else {
                $search = '';
            }
            $where['c.seller_id'] = $login_user['admin_id'];
        }
        if (isset($param['status'])) {
            $status = $param['status'];
            if ($param['status'] == -1) {
                $where['a.status'] = ['in', [0, 1]];
            } else {
                $where['a.status'] = $param['status'];
            }
        } else {
            $status = -1;
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
        //dump($where);
        //exit;
        $res = $mall->table('mall_goods a')
            ->where('a.is_delete', 0)
            ->join('mall_goods_classify b', 'a.classify_id = b.classify_id')
            ->join('mall_admin c', 'a.seller_id=c.admin_id')
            ->field('a.goods_id,b.name,a.content,a.standard,a.goods_name,a.goods_img,a.price,a.stock,a.sales_num,c.shop_name,a.status,a.add_time')
            ->where($where)
            ->whereTime('a.add_time', 'between', [$time1, $time2])
            ->paginate(10, false, [
                'query' => Request::instance()->param()
            ]);
        $class = $mall->table('mall_goods_classify')->where('is_delete', 0)->select();
        $this->assign('time1', $time1);
        $this->assign('time2', $time2);
        $this->assign('status', $status);
        $this->assign('search', $search);
        $this->assign('classify', $class);
        $this->assign('goods', $res);
        return $this->fetch();
    }

    /**
     * [uploadMultiImg 上传多张图片]
     * @Author    wyc
     * @DateTime  2018-05-24T16:23:19+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function uploadMultiImg()
    {
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if ($info) {
            $filename = '/mall/public/uploads/' . $info->getSaveName();
            $filename = str_replace('\\', "/", $filename);
            $data['code'] = 1;
            $data['msg'] = '上传成功';
            $data['data'] = ['src' => $filename, 'title' => '卧槽'];
            echo json_encode($data);
        } else {
            $data['code'] = 0;
            $data['data'] = ['src' => ''];
            $data['msg'] = $file->getError();
            echo json_encode($data);
        }
    }

    /**
     * [uploadImg 编辑器上传图片]
     * @Author    wyc
     * @DateTime  2018-05-24T19:09:17+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function uploadImg()
    {
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if ($info) {
            $filename = '/mall/public/uploads/' . $info->getSaveName();
            $filename = str_replace('\\', "/", $filename);
            $data['code'] = 0;
            $data['msg'] = '上传成功';
            $data['data'] = ['src' => $filename, 'title' => '卧槽'];
            echo json_encode($data);
        } else {
            $data['code'] = 1;
            $data['data'] = ['src' => ''];
            $data['msg'] = $file->getError();
            echo json_encode($data);
        }
    }

    public function addGoods()
    {
        $param = Request::instance()->param();
        log::write('参数');
        log::write($param);
        $mall = Db::connect('mall');
        $logined_user = Cookie::get('logined_user');
        if ($logined_user['type'] == 1) {
            $goodsInfo['classify_id'] = $param['classify_id'];
            $goodsInfo['seller_id'] = $param['seller_id'];
        } elseif ($logined_user['type'] == 2) {
            $goodsInfo['classify_id'] = $logined_user['classify_id'];
            $goodsInfo['seller_id'] = $logined_user['admin_id'];
        }

        $goodsInfo['content'] = ($param['content']);
        $goodsInfo['goods_name'] = ($param['goods_name']);
        $goodsInfo['standard'] = ($param['standard']);
        $goodsInfo['price'] = $param['price'];
        $goodsInfo['goods_img'] = $param['goods_img'];
        $goodsInfo['stock'] = $param['stock'];
        $goodsInfo['sales_num'] = $param['sales_num'];
        $goodsInfo['status'] = $param['status'];
        $goodsInfo['add_time'] = time();
        $res = $mall->table('mall_goods')->insert($goodsInfo);
        //拆分img的src
        $img = explode('-', $param['src']);
        foreach ($img as $key => $value) {
            $imgData['goods_id'] = $mall->table('mall_goods')->getLastInsID();
            $imgData['path'] = $value;
            $imgData['add_time'] = time();
            $mall->table('mall_goods_img')->insert($imgData);
        }
        $data['code'] = 1;
        echo json_encode($data);
    }

    /**
     * [updateGoodsStatus 更改商品状态]
     * @Author    wyc
     * @DateTime  2018-05-25T08:57:15+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function updateGoodsStatus()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $status = $mall->table('mall_goods')->where('goods_id', $param['goods_id'])->value('status');
        if ($status == 1) {
            $data['data'] = '已禁用';
            $res = $mall->table('mall_goods')->where('goods_id', $param['goods_id'])->setField('status', 0);
        } else {
            $data['data'] = '已启用';
            $res = $mall->table('mall_goods')->where('goods_id', $param['goods_id'])->setField('status', 1);
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

    /**
     * [updateGoods 修改商品]
     * @Author    wyc
     * @DateTime  2018-05-25T09:11:05+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function updateGoods()
    {
        $param = Request::instance()->param();
        log::write('参数');
        log::write($param);
        $mall = Db::connect('mall');
        $goodsInfo = $mall->table('mall_goods')->where('is_delete', 0)->where('goods_id', $param['goods_id'])->find();
        $data['code'] = 1;
        $data['data'] = $goodsInfo;
        echo json_encode($data);
    }

    public function updateGoods1()
    {
        $param = Request::instance()->param();
        /*		log::write('参数');
                log::write($param);*/
        $mall = Db::connect('mall');
        //$goodsInfo['classify_id'] = $param['classify_id'];
        $goodsInfo['content'] = ($param['content']);
        $goodsInfo['goods_name'] = ($param['goods_name']);
        $goodsInfo['standard'] = ($param['standard']);
        $goodsInfo['price'] = $param['price'];
        $goodsInfo['stock'] = $param['stock'];
        $goodsInfo['sales_num'] = $param['sales_num'];
        $goodsInfo['status'] = $param['status'];
        $goodsInfo['add_time'] = time();
        $res = $mall->table('mall_goods')->where('goods_id', $param['goods_id'])->update($goodsInfo);
        if ($res) {
            $data['code'] = 1;
            $data['msg'] = 'success';
        } else {
            $data['code'] = 0;
            $data['msg'] = 'fail';
        }

        echo json_encode($data);
    }

    /**
     * [delGoods 删除商品]
     * @Author    wyc
     * @DateTime  2018-05-25T10:50:53+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function delGoods()
    {
        $param = Request::instance()->param();
        /*		log::write('参数');
                log::write($param);*/
        $mall = Db::connect('mall');
        $res = $mall->table('mall_goods')->where('goods_id', $param['goods_id'])->update(['is_delete' => 1]);
        if ($res) {
            $data['code'] = 1;
            $data['msg'] = 'success';
        } else {
            $data['code'] = 0;
            $data['msg'] = 'fail';
        }
        echo json_encode($data);
    }
}