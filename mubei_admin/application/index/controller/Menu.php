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

class Menu extends Common
{
    /**
     * 渲染首页
     */
    public function card()
    {

        $card = Db::table('mb_bank')
            ->alias('a')
            ->join('mb_bank_name w', 'a.b_name = w.bn_id')
            ->select();
        $this->assign('card', $card);

        return $this->fetch();
    }

    public function admin()
    {

        $user = Db::table('vpay_admin')->order('time', 'desc')->where('level', '>', 1)->paginate(100);
        $logined_user = Cookie::get('logined_user');
        $this->assign('user', $user);
        $this->assign('admin', $logined_user);

        return $this->fetch();
    }


    public function user_money_order()
    {
        $message = Db::table('mb_balance_order')->order('bo_time', 'desc')->paginate(50);
        $time = time();
        $this->assign('time', date('Y-m-d', $time));
        $this->assign('order', $message);
        return $this->fetch();
    }

    public function user_score_order()
    {
        $message = Db::table('mb_current_order')->order('co_time', 'desc')->paginate(50);
        $time = time();
        $this->assign('time', date('Y-m-d', $time));
        $this->assign('order', $message);
        return $this->fetch();
    }

    public function user_assets_order()
    {
        $message = Db::table('mb_assets_order')->order('ao_time', 'desc')->paginate(50);

        $time = time();


        $this->assign('order', $message);
        $this->assign('time', date('Y-m-d', $time));
        return $this->fetch();
    }

    public function quanxian()
    {
        $order = Db::table('vpay_menu')->order('me_id asc')->select();
        $this->assign('menu', $order);
        return $this->fetch();
    }

    //修改权限
    public function jur_edit()
    {
        if ($_POST) {
            $str = '';
            foreach ($_POST as $k => $v) {
                if (!is_string($k)) {
                    Db::table('vpay_menu')->where('me_id', $k)->update(['me_level' => 2]);
                    $str .= "$k,";
                }
            }
            Db::table('vpay_menu')->where('me_id', 'not in', $str)->update(['me_level' => '1']);

            $this->error('操作成功');

        } else {
            Db::table('vpay_menu')->where('me_level', 2)->update(['me_level' => 1]);
            $this->error('操作成功');
        }
    }


    public function delete_admin()
    {
        $aid = Request::instance()->param('aid');
        $res = Db::table('vpay_admin')->where('a_id', $aid)->delete();
        if ($res) {
            return json(['code' => 1, 'msg' => '删除成功！']);
        } else {
            return json(['code' => 2, 'msg' => '删除失败！']);
        }
    }

    public function sell()
    {
        $message = Db::table('mb_sell_order')->where('type', 2)->order('time', 'desc')->paginate(50);
        $this->assign('order', $message);
        return $this->fetch();
    }

    public function purshare()
    {
        $message = Db::table('mb_sell_order')->where('type', 1)->order('time', 'desc')->paginate(50);
        $this->assign('order', $message);
        return $this->fetch();
    }

    public function share()
    {
        $message = Db::table('vpay_share_order')->order('time', 'desc')->paginate(50);
        $this->assign('order', $message);
        return $this->fetch();
    }


    public function noticemanage()
    {
        $message = Db::table('mb_notice')->order('time', 'desc')->paginate(50);
        $this->assign('order', $message);
        return $this->fetch();
    }


    public function noticemanage_c()
    {
        $title = Request::instance()->param('title');
        $content = Request::instance()->param('content');
        if ($title && $content) {
            $insert = Db::table('mb_notice')->insert([
                'n_title' => $title,
                'n_text' => $content,
                'time' => time()
            ]);
            if ($insert) {
                return json(['code' => 1, 'msg' => '发布成功！']);
            }
        } else {
            return json(['code' => 2, 'msg' => '请填写标题与内容！']);
        }

    }

    public function noticemanage_y()
    {
        $nid = Request::instance()->param('nid');

        if ($nid) {
            $insert = Db::table('mb_notice')->where('n_id', $nid)->delete();
            if ($insert) {
                return json(['code' => 1, 'msg' => '删除成功！']);
            }
        } else {
            return json(['code' => 2, 'msg' => '请填写标题与内容！']);
        }

    }

    public function noticemanage_t()
    {
        $nid = Request::instance()->param('nid');
        $title = Request::instance()->param('title');
        $content = Request::instance()->param('content');
        if ($title && $content) {
            $insert = Db::table('mb_notice')->where('n_id', $nid)->update([
                'n_title' => $title,
                'n_text' => $content,
                'time' => time()
            ]);
            if ($insert) {
                return json(['code' => 1, 'msg' => '修改成功！']);
            }
        } else {
            return json(['code' => 2, 'msg' => '请填写标题与内容！']);
        }
    }

// 建议列表
    public function feedback()
    {
        $message = Db::table('mb_feedback')->order('time', 'desc')->paginate(50);
        $this->assign('order', $message);
        return $this->fetch();
    }

    //  回复建议页面
    public function reply_feedback()
    {
        $f_id = Request::instance()->param('f_id');
        $this->assign('f_id', $f_id);
        return $this->fetch();
    }

//    回复建议
    public function replyFeedback1()
    {
        $f_id = Request::instance()->param('f_id');
        $content = Request::instance()->param('f_content');
        if ($content) {
            $info = Db::table('mb_feedback')->where('f_id', $f_id)->update(['f_content' => $content, 'reply_time' => time()]);
            if ($info) {
                return json(['code' => 1, 'msg' => '修改成功']);
            } else {
                return json(['code' => 2, 'msg' => '修改失败']);
            }
        }
    }


    public function message()
    {
        $message = Db::table('mb_message')->order('m_time', 'desc')->paginate(50);
        $this->assign('order', $message);
        return $this->fetch();
    }

    public function config()
    {
        $config1 = Db::table('mb_config')->where('co_id', 1)->find();
        $config2 = Db::table('mb_config')->where('co_id', 2)->find();
        $config3 = Db::table('mb_config')->where('co_id', 3)->find();
        $config4 = Db::table('mb_config')->where('co_id', 4)->find();
        $config5 = Db::table('mb_config')->where('co_id', 5)->find();
        $config6 = Db::table('mb_config')->where('co_id', 6)->find();
        $config7 = Db::table('mb_config')->where('co_id', 7)->find();
        $config8 = Db::table('mb_config')->where('co_id', 6)->find();
        $config9 = Db::table('mb_config')->where('co_id', 9)->find();
        $config10 = Db::table('mb_config')->where('co_id', 10)->find();
        $config11 = Db::table('mb_config')->where('co_id', 11)->find();

        $this->assign('config1', $config1);
        $this->assign('config2', $config2);
        $this->assign('config3', $config3);
        $this->assign('config4', $config4);
        $this->assign('config5', $config5);
        $this->assign('config6', $config6);
        $this->assign('config7', $config7);
        $this->assign('config8', $config8);
        $this->assign('config9', $config9);
        $this->assign('config10', $config10);
        $this->assign('config11', $config11);

        return $this->fetch();
    }


    public function change_config()
    {
        $data = Request::instance()->param('data');
        $data_arr = json_decode($data, true);
        Log::write($data_arr, 'notice');
        foreach ($data_arr as $v) {
            if ($v['cid'] == 6) {
                $time = strtotime($v['config']);
                $insert = Db::table('mb_config')->where('co_id', $v['cid'])->update([
                    'co_config' => $time,
                ]);
            } else {
                $insert = Db::table('mb_config')->where('co_id', $v['cid'])->update([
                    'co_config' => $v['config'],
                ]);
            }

        }
        return json(['code' => 1, 'msg' => '修改成功！']);
    }


    public function delete_message()
    {
        $nid = Request::instance()->param('mid');

        if ($nid) {
            $insert = Db::table('mb_message')->where('m_id', $nid)->delete();
            if ($insert) {
                return json(['code' => 1, 'msg' => '删除成功！']);
            }
        } else {
            return json(['code' => 2, 'msg' => '请填写标题与内容！']);
        }

    }


    public function dizhi()
    {
        $card = Db::table('vpay_shop_dizhi')->paginate(50);
        $this->assign('card', $card);
        return $this->fetch();
    }

    public function shop()
    {
        $card = Db::table('vpay_shop')->order('time', 'desc')->paginate(50);
        $this->assign('card', $card);
        return $this->fetch();
    }


    public function delete_shop()
    {
        $nid = Request::instance()->param('nid');
        $u_img = Request::instance()->param('img');


        $url1 = $_SERVER['DOCUMENT_ROOT'];
        $url = '/maibao/public/static';
        $imageUrl = $url1 . $url . DS . "/uploads/" . $u_img;
        $info = @unlink($imageUrl);
        if ($nid) {
            $insert = Db::table('vpay_shop')->where('sh_id', $nid)->delete();
            if ($insert) {
                return json(['code' => 1, 'msg' => '删除成功！']);
            }
        } else {
            return json(['code' => 2, 'msg' => '请填写标题与内容！']);
        }

    }

    public function delete_sell_order()
    {
        $res = Db::table('mb_sell_order')->where('type', 2)->where('static', 4)->delete();
        if ($res) {
            return json(['code' => 1, 'msg' => '清空成功！']);
        } else {
            return json(['code' => 2, 'msg' => '清空失败！']);
        }

    }

    public function delete_sell_order_p()
    {
        $res = Db::table('mb_sell_order')->where('type', 1)->where('static', 4)->delete();
        if ($res) {
            return json(['code' => 1, 'msg' => '清空成功！']);
        } else {
            return json(['code' => 2, 'msg' => '清空失败！']);
        }

    }


    public function add_card()
    {
        $card_name = Db::table('mb_bank_name')->select();
        $this->assign('order', $card_name);
        return $this->fetch();
    }

    public function add_card_p1()
    {
        $title = Request::instance()->param('title');
        if ($title) {
            $insert = Db::table('mb_bank_name')->insert([
                'bn_name' => $title,
            ]);
            if ($insert) {
                return json(['code' => 1, 'msg' => '添加成功！']);
            }
        } else {
            return json(['code' => 2, 'msg' => '请填写银行名！']);
        }

    }

    public function add_card_p2()
    {
        $nid = Request::instance()->param('nid');
        if ($nid) {
            $insert = Db::table('mb_bank_name')->where('bn_id', $nid)->delete();
            if ($insert) {
                return json(['code' => 1, 'msg' => '删除成功！']);
            }
        }
    }

    public function add_card_p4()
    {
        $nid = Request::instance()->param('nid');
        $title = Request::instance()->param('title');
        if ($title) {
            $insert = Db::table('mb_bank_name')->where('bn_id', $nid)->update([
                'bn_name' => $title,
            ]);
            if ($insert) {
                return json(['code' => 1, 'msg' => '修改成功！']);
            }
        } else {
            return json(['code' => 2, 'msg' => '请填写银行名！']);
        }

    }


    public function about()
    {
        $c = Db::table('mb_about')->where('type', 1)->find();
        $b = Db::table('mb_about')->where('type', 2)->find();
        $this->assign('ch', $c);
        $this->assign('en', $b);
        return $this->fetch();
    }


    public function change_about_en()
    {
        $content = Request::instance()->param('content');
        $res = Db::table('mb_about')->where('type', 1)->setField('a_text', $content);
        if ($res) {
            return json(['code' => 1, 'msg' => '修改成功！']);
        } else {
            return json(['code' => 2, 'msg' => '修改失败！']);
        }
    }


    public function change_about_ch()
    {
        $content = Request::instance()->param('content');
        $res = Db::table('mb_about')->where('type', 2)->setField('a_text', $content);
        if ($res) {
            return json(['code' => 1, 'msg' => '修改成功！']);
        } else {
            return json(['code' => 2, 'msg' => '修改失败！']);
        }
    }


    public function goodsExcelExport()
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
        foreach ($card as $k => $v) {
            $type = '';
            if ($v['type'] == 1) {
                $type = '筹备中';
            } else if ($v['type'] == 2) {
                $type = '等待发货';
            } else if ($v['type'] == 3) {
                $type = '等待收货';
            } else if ($v['type'] == 4) {
                $type = '订单完成';
            }
            $time = date('Y-m-d H:i:s', $v['time']);
            $card[$k]['type'] = $type;
            $card[$k]['time'] = $time;
            $card[$k]['xiandiqu'] = $v['s_diqu'] . $v['s_dizhi'];
        }


        $xlsData = $card;
        $xlsName = "筹备用户";
        $xlsCell = array(
            array('sh_title', '商品标题'),
            array('u_id', '用户uid'),
            array('sg_money', '筹备金额'),
            array('s_name', '收货人'),
            array('s_tel', '联系电话'),
            array('xiandiqu', '联系地址'),
            array('type', '状态'),
            array('time', '时间'),
        );
        $this->exportExcel($xlsName, $xlsCell, $xlsData);
    }

    public function exportExcel($expTitle, $expCellName, $expTableData)
    {
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $expTitle . date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);

        vendor("PHPExcel.PHPExcel");

        $objPHPExcel = new \PHPExcel();
        $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle . '  Export time:' . date('Y-m-d H:i:s'));
        for ($i = 0; $i < $cellNum; $i++) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '2', $expCellName[$i][1]);
        }
        // Miscellaneous glyphs, UTF-8
        for ($i = 0; $i < $dataNum; $i++) {
            for ($j = 0; $j < $cellNum; $j++) {
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + 3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }


    //查询积分记录（通过时间）
    public function search_asstes_order()
    {
        $uid = Request::instance()->param('uid');
        $date_start_p1 = Request::instance()->param('date_start');

        $date_start = strtotime($date_start_p1 . ' 00:00:00');
        $date_end_p1 = Request::instance()->param('date_end');
        $date_end = strtotime($date_end_p1 . ' 23:59:59');

        if ($uid) {
            $message = Db::table('mb_assets_order')->where('u_id', $uid)->where("ao_time<=$date_end and ao_time>=$date_start")->order('ao_time', 'desc')->paginate(50);
        } else {
            $message = Db::table('mb_assets_order')->where("ao_time<=$date_end and ao_time>=$date_start")->order('ao_time', 'desc')->paginate(50);
        }


        $this->assign('order', $message);
        $this->assign('uid', $uid);
        $this->assign('time1', $date_start_p1);
        $this->assign('time2', $date_end_p1);
        return $this->fetch();


    }


    //查询积分记录（通过时间）
    public function search_score_order()
    {

        $date_start_p1 = Request::instance()->param('date_start');
        $date_start = strtotime($date_start_p1 . ' 00:00:00');
        $date_end_p1 = Request::instance()->param('date_end');
        $date_end = strtotime($date_end_p1 . ' 23:59:59');

        $message = Db::table('mb_current_order')->where("co_time<=$date_end and co_time>=$date_start")->order('co_time', 'desc')->paginate(50);

        $this->assign('order', $message);
        $this->assign('time1', $date_start_p1);
        $this->assign('time2', $date_end_p1);
        return $this->fetch();


    }


    public function search_money_order()
    {

        $date_start_p1 = Request::instance()->param('date_start');
        $uid = Request::instance()->param('uid');

        $date_start = strtotime($date_start_p1 . ' 00:00:00');
        $date_end_p1 = Request::instance()->param('date_end');
        $date_end = strtotime($date_end_p1 . ' 23:59:59');
        if ($uid) {
            $message = Db::table('mb_balance_order')->where('u_id', $uid)->where("bo_time<=$date_end and bo_time>=$date_start")->order('bo_time', 'desc')->paginate(50);
        } else {
            $message = Db::table('mb_balance_order')->where("bo_time<=$date_end and bo_time>=$date_start")->order('bo_time', 'desc')->paginate(50);
        }


        $this->assign('order', $message);
        $this->assign('uid', $uid);
        $this->assign('time1', $date_start_p1);
        $this->assign('time2', $date_end_p1);
        return $this->fetch();


    }


    public function lunbo()
    {
        $message = Db::table('mb_lunbo')->order('time', 'desc')->paginate(50);
        $this->assign('order', $message);
        return $this->fetch();
    }


    public function add_lunbo()
    {
        $file = request()->file('image');
        if ($file) {
            $info = $file->move($_SERVER['DOCUMENT_ROOT'] . '/new_vpay_api/public/static' . DS . 'uploads');
            if ($info) {
                $u_img2 = $info->getSaveName();
                $insert = Db::table('mb_lunbo')->insert([
                    'lb_img' => $u_img2,
                    'time' => time(),
                ]);
                if ($insert) {
                    return json(['code' => 1, 'msg' => '发布轮播图成功！']);
                } else {
                    return json(['code' => 2, 'msg' => '发布轮播图失败！']);
                }
            } else {
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }

    }

    public function delete_lunbo()
    {
        $nid = Request::instance()->param('nid');
        $u_img = Request::instance()->param('image');
        $url1 = $_SERVER['DOCUMENT_ROOT'];
        $url = '/new_vpay_api/public/static';
        $imageUrl = $url1 . $url . DS . "/uploads/" . $u_img;
        $info = @unlink($imageUrl);
        if ($nid) {
            $insert = Db::table('mb_lunbo')->where('lb_id', $nid)->delete();
            if ($insert) {
                return json(['code' => 1, 'msg' => '删除成功！']);
            }
        } else {
            return json(['code' => 2, 'msg' => '请填写标题与内容！']);
        }
    }

    public function change_lunbo()
    {
        $nid = Request::instance()->param('nid');
        $u_img = Request::instance()->param('images');
        $url1 = $_SERVER['DOCUMENT_ROOT'];
        $url = '/new_vpay_api/public/static';
        $imageUrl = $url1 . $url . DS . "/uploads/" . $u_img;
        $info = @unlink($imageUrl);
        if ($nid) {
            $file = request()->file('image');
            if ($file) {
                $info = $file->move($_SERVER['DOCUMENT_ROOT'] . '/new_vpay_api/public/static' . DS . 'uploads');
                if ($info) {
                    $u_img2 = $info->getSaveName();
                    $insert = Db::table('mb_lunbo')->where('lb_id', $nid)->setField('lb_img', $u_img2);
                    if ($insert) {
                        return json(['code' => 1, 'msg' => '修改轮播图成功！']);
                    } else {
                        return json(['code' => 2, 'msg' => '修改轮播图失败！']);
                    }
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }
        }

    }


    public function beijin()
    {
        $message = Db::table('mb_beijin')->order('time', 'desc')->paginate(50);
        $this->assign('order', $message);
        return $this->fetch();
    }

    public function change_beijin()
    {
        $nid = Request::instance()->param('nid');
        $u_img = Request::instance()->param('images');
        $url1 = $_SERVER['DOCUMENT_ROOT'];
        $url = '/new_vpay_api/public/static';
        $imageUrl = $url1 . $url . DS . "/uploads/" . $u_img;
        $info = @unlink($imageUrl);
        if ($nid) {
            $file = request()->file('image');
            if ($file) {
                $info = $file->move($_SERVER['DOCUMENT_ROOT'] . '/new_vpay_api/public/static' . DS . 'uploads');
                if ($info) {
                    $u_img2 = $info->getSaveName();
                    $insert = Db::table('mb_beijin')->where('bj_id', $nid)->setField('bj_img', $u_img2);
                    Db::table('mb_beijin')->where('bj_id', $nid)->setField('time', time());
                    if ($insert) {
                        return json(['code' => 1, 'msg' => '修改背景图成功！']);
                    } else {
                        return json(['code' => 2, 'msg' => '修改背景图失败！']);
                    }
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            }
        }

    }


    public function shensu()
    {
        $message = Db::table('mb_shengshu')->order('time', 'desc')->paginate(50);
        $this->assign('order', $message);
        return $this->fetch();
    }

    public function delete_shensu()
    {
        $nid = Request::instance()->param('nid');
        $u_img = Request::instance()->param('images');
        $url1 = $_SERVER['DOCUMENT_ROOT'];
        $url = '/new_vpay_api/public/static';
        $imageUrl = $url1 . $url . DS . "/uploads/" . $u_img;
        $info = @unlink($imageUrl);
        if ($nid) {
            $insert = Db::table('mb_shengshu')->where('ss_id', $nid)->delete();
            if ($insert) {
                return json(['code' => 1, 'msg' => '驳回成功！']);
            }
        } else {
            return json(['code' => 2, 'msg' => '请填写标题与内容！']);
        }
    }


    public function ageree()
    {
        $nid = Request::instance()->param('nid');
        $u_img = Request::instance()->param('images');

        $url1 = $_SERVER['DOCUMENT_ROOT'];
        $url = '/new_vpay_api/public/static';
        $imageUrl = $url1 . $url . DS . "/uploads/" . $u_img;
        $info = @unlink($imageUrl);
        $s_id = Db::table('mb_shengshu')->where('ss_id', $nid)->value('s_id');
        $res = Db::table('mb_sell_order')->where('s_id', $s_id)->find();
        if ($res['type'] == 2) {
            $user = $res['user'];
            Db::table('mb_user')->where('u_id', $user)->setInc('balance', $res['money']);
        } else if ($res['type'] == 1) {
            $user = $res['u_id'];
            Db::table('mb_user')->where('u_id', $user)->setInc('balance', $res['money']);
        }

        if ($nid) {
            $insert = Db::table('mb_shengshu')->where('ss_id', $nid)->delete();
            Db::table('mb_sell_order')->where('s_id', $s_id)->delete();
            if ($insert) {
                return json(['code' => 1, 'msg' => '确认成功！']);
            }
        } else {
            return json(['code' => 2, 'msg' => '请填写标题与内容！']);
        }
    }

}