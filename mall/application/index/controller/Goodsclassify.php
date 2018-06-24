<?php

namespace app\index\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;
use think\Log;

class Goodsclassify extends Common
{
    /**
     * [index 商品分类列表]
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
        $res = $mall->table('mall_goods_classify')->where('is_delete', 0)->paginate(10, false, [
            'query' => Request::instance()->param()
        ]);
        $this->assign('class', $res);
        return $this->fetch();
    }

    /**
     * [addClassify 添加商品分类]
     * @Author    wyc
     * @DateTime  2018-05-24T14:18:47+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     */
    public function addClassify()
    {
        $param = Request::instance()->param();
        $name = delHtml($param['classify']);
        $mall = Db::connect('mall');
        $classify = $mall->table('mall_goods_classify')->where('is_delete', 0)->column('name');
        /*log::write('分类');
        log::write($classify);*/
        if (is_array($classify)) {
            if (in_array($name, $classify)) {
                $res['code'] = -1;
                $res['msg'] = '分类已存在';
                echo json_encode($res);
                exit;
            }
        } else {
            if ($name == $classify) {
                $res['code'] = -1;
                $res['msg'] = '分类已存在';
                echo json_encode($res);
                exit;
            }
        }

        $data['name'] = $param['classify'];
        $data['add_time'] = time();
        $res = $mall->table('mall_goods_classify')->insert($data);
        if ($res) {
            $re['code'] = 1;
            $re['msg'] = '添加成功';

        } else {
            $re['code'] = 1;
            $re['msg'] = '添加失败';
        }
        echo json_encode($re);
    }

    /**
     * [updateClassifyStatus 修改分类状态]
     * @Author    wyc
     * @DateTime  2018-05-24T15:04:56+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function updateClassifyStatus()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $status = $mall->table('mall_goods_classify')->where('classify_id', $param['classify_id'])->value('status');
        if ($status == 1) {
            $data['data'] = '已禁用';
            $res = $mall->table('mall_goods_classify')->where('classify_id', $param['classify_id'])->setField('status', 0);
        } else {
            $data['data'] = '已启用';
            $res = $mall->table('mall_goods_classify')->where('classify_id', $param['classify_id'])->setField('status', 1);
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
     * [delGoodsClassify 删除商品分类]
     * @Author    wyc
     * @DateTime  2018-05-24T15:17:11+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function delGoodsClassify()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $re = $mall->table('mall_goods_classify')->where('classify_id', $param['cf_id'])->setField('is_delete', 1);
        if ($re) {
            $res['code'] = 1;
        } else {
            $res['code'] = 0;
        }
        echo json_encode($res);
    }

    /**
     * [updateGoodsClassify 修改分类]
     * @Author    wyc
     * @DateTime  2018-05-24T15:26:37+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function updateGoodsClassify()
    {
        $param = Request::instance()->param();
        $name = delHtml($param['name']);
        $mall = Db::connect('mall');
        $re = $mall->table('mall_goods_classify')->where('classify_id', $param['cf_id'])->setField('name', $name);
        if ($re) {
            $res['code'] = 1;
        } else {
            $res['code'] = 0;
        }
        echo json_encode($res);
    }
}