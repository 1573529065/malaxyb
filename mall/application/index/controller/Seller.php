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

class Seller extends Common
{
    /**
     * 商家管理首页
     */
    public function index()
    {
        $mall = Db::connect('mall');
        $time1 = date("Y-m-d H:i:s", 0);
        $time2 = date('Y-m-d H:i:s', strtotime('1 day'));
        $seller = $mall->table('mall_admin a')
            ->join('mall_goods_classify b', 'a.classify_id=b.classify_id')
            ->field('admin_id,account,a.status,login_ip,a.add_time,a.login_time,shop_name,mobile,name')
            ->where('a.is_delete', 0)
            ->where('type', 2)
            ->paginate(10, false, [
                'query' => Request::instance()->param()
            ]);
        $this->assign('time1', $time1);
        $this->assign('time2', $time2);
        $this->assign('seller', $seller);
        return $this->fetch();
    }

    /**
     * [addSeller 添加商家页面]
     * @Author    wyc
     * @DateTime  2018-05-28T11:56:43+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     */
    public function addSeller()
    {
        $mall = Db::connect('mall');
        $where['is_delete'] = 0;
        $where['status'] = 1;
        $seller = $mall->table('mall_goods_classify')->where($where)->select();
        $option = '';
        foreach ($seller as $key => $value) {
            $option .= "<option value=" . $value['classify_id'] . ">" . $value['name'] . "</option>\r\n";
        }
        $re['msg'] = $option;
        echo json_encode($re);
    }

    /**
     * [addSeller 添加商家提交]
     * @Author    wyc
     * @DateTime  2018-05-28T11:56:43+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     */
    public function addSeller1()
    {
        $mall = Db::connect('mall');
        $param = Request::instance()->param();
        $data['account'] = $param['account'];
        $data['pass'] = md5($param['pass']);
        $data['classify_id'] = $param['classify_id'];
        $data['mobile'] = $param['mobile'];
        $data['shop_name'] = $param['shop_name'];
        $data['status'] = $param['status'];
        $data['login_ip'] = '127.0.0.1';
        $data['login_time'] = time();
        $data['add_time'] = time();
        $res = $mall->table('mall_admin')->insert($data);
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
     * [updateSeller 修改商家页面]
     * @Author    wyc
     * @DateTime  2018-05-28T14:37:01+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function updateSeller()
    {
        $mall = Db::connect('mall');
        $param = Request::instance()->param();
        $res = $mall->table('mall_admin')->find($param['admin_id']);
        $classify = $mall->table('mall_goods_classify')->where('is_delete', 0)->where('status', 1)->select();
        $option = '';
        foreach ($classify as $key => $value) {
            if ($res['classify_id'] == $value['classify_id']) {
                $option .= "<option  selected value=" . $value['classify_id'] . ">" . $value['name'] . "</option>";
            } else {
                $option .= "<option   value=" . $value['classify_id'] . ">" . $value['name'] . "</option>";
            }
        }
        $re['data'] = $res;
        $re['option'] = $option;
        echo json_encode($re);
    }

    /**
     * [updateSeller 修改商家提交]
     * @Author    wyc
     * @DateTime  2018-05-28T14:37:01+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function updateSeller1()
    {
        $mall = Db::connect('mall');
        $param = Request::instance()->param();
        $pass = $mall->table('mall_admin')->where('admin_id', $param['admin_id'])->value('pass');
        if (md5($param['pass1']) == $pass) {
            $re['code'] = -1;
            $re['msg'] = '新密码不能与原密码一致';
            echo json_encode($re);
            exit;
        }
        $data['account'] = $param['account1'];
        $data['pass'] = md5($param['pass1']);
        $data['classify_id'] = $param['classify_id1'];
        $data['mobile'] = $param['mobile1'];
        $data['shop_name'] = $param['shop_name1'];
        $data['status'] = $param['status1'];
        $res = $mall->table('mall_admin')->where('admin_id', $param['admin_id'])->update($data);
        if ($res) {
            $re['code'] = 1;
            $re['msg'] = '修改成功';

        } else {
            $re['code'] = 0;
            $re['msg'] = '修改失败';
        }
        echo json_encode($re);
    }

    /**
     * [updateClassifyStatus 修改商家状态]
     * @Author    wyc
     * @DateTime  2018-05-24T15:04:56+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function updateSellerStatus()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $status = $mall->table('mall_admin')->where('admin_id', $param['admin_id'])->value('status');
        if ($status == 1) {
            $data['data'] = '已禁用';
            $res = $mall->table('mall_admin')->where('admin_id', $param['admin_id'])->setField('status', 0);
        } else {
            $data['data'] = '已启用';
            $res = $mall->table('mall_admin')->where('admin_id', $param['admin_id'])->setField('status', 1);
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
     * [delSeller 删除商家]
     * @Author    wyc
     * @DateTime  2018-05-29T11:46:25+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function delSeller()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $res = $mall->table('mall_admin')->where('admin_id', $param['admin_id'])->setField('is_delete', 1);
        if ($res) {
            $re['code'] = 1;
            $re['msg'] = '删除成功';
        } else {
            $re['code'] = 0;
            $re['msg'] = '删除失败';
        }
        echo json_encode($re);
    }

    /**
     * [search 查找]
     * @Author    wyc
     * @DateTime  2018-05-29T12:01:05+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function search()
    {
        $mall = Db::connect('mall');
        $param = Request::instance()->param();
        if (isset($param['search'])) {
            $search = $param['search'];
            $where['account|mobile|shop_name|name'] = ['like', "%" . $param['search'] . "%"];
        } else {
            $search = '';
        }
        if ($param['status'] == -1) {
            $status = -1;
            $where['a.status'] = ['in', [0, 1]];
        } else {
            $status = $param['status'];
            $where['a.status'] = $param['status'];
        }
        //dump($where);exit;
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
        $seller = $mall->table('mall_admin a')
            ->join('mall_goods_classify b', 'a.classify_id=b.classify_id')
            ->field('admin_id,account,a.status,login_ip,a.add_time,a.login_time,shop_name,mobile,name')
            ->where('a.is_delete', 0)
            ->where($where)
            ->whereTime('a.add_time', 'between', [$time1, $time2])
            ->where('type', 2)
            ->paginate(10, false, [
                'query' => Request::instance()->param()
            ]);
        $this->assign('time1', $time1);
        $this->assign('time2', $time2);
        $this->assign('status', $status);
        $this->assign('search', $search);
        $this->assign('seller', $seller);
        return $this->fetch();
    }

    /**
     * [sellerExport 商家导出excel]
     * @Author    wyc
     * @DateTime  2018-05-29T12:52:18+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    [type]                   [description]
     */
    public function sellerExport()
    {
        $param = Request::instance()->param();
        $mall = Db::connect('mall');
        $login_user = Cookie::get('logined_user');
        \think\Loader::import('PHPExcel', EXTEND_PATH);
        $excel = new \PHPExcel();
        $letter = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', "AG", 'AH', 'AI', 'AJ');
        //表头数组

        $tableheader = ['商家id', '商家用户名', '手机号码', '店铺名', '所属分类', '登录ip', '添加时间', '登陆时间', '状态'];
        $fields = 'admin_id,account,mobile,shop_name,name,login_ip,a.add_time,a.login_time,a.status';
        if (isset($param['search'])) {
            $where['account|mobile|shop_name|name'] = ['like', '%' . $param['search'] . '%'];
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
        $seller = $mall->table('mall_admin a')
            ->join('mall_goods_classify b', 'a.classify_id=b.classify_id')
            ->field($fields)
            ->where('a.is_delete', 0)
            ->where($where)
            ->whereTime('a.add_time', 'between', [$time1, $time2])
            ->where('type', 2)
            ->select();
        foreach ($seller as $key => $value) {
            switch ($value['status']) {
                case 0:
                    $value['status'] = '已禁用';
                    break;
                case 1:
                    $value['status'] = '已启用';
                    break;

            }
            $value['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
            $value['login_time'] = date('Y-m-d H:i:s', $value['login_time']);
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
        $title = '商家表';
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

}