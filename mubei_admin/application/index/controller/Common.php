<?php
namespace app\index\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;

class Common extends Controller
{
    public function _initialize()
    {
        $logined_user = Cookie::get('logined_user');
        if (!$logined_user || $logined_user == null || $logined_user == '' || !is_array($logined_user)) {
            $this->redirect('index/login/login');
        }else{
            if (isset($logined_user['level'])){
                if(!empty($logined_user['level']) || !empty($logined_user['type'])){
                    $fun=Request::instance()->action();
                    $logined_user = Cookie::get('logined_user');
                    $menu = Db::table('vpay_menu')->where('me_level','>=',$logined_user['level'])->order('me_id asc')->select();
                    $this->assign('admin',$logined_user);
                    $this->assign('menu',$menu);
                    $this->assign('fun',$fun);
                }else{
                    $this->redirect('index/login/login');
                }
            }else{
                $this->redirect('index/login/login');
            }

        }
    }

    public function common(Request $request){

        $fun=$request->action();
        $logined_user = Cookie::get('logined_user');
        $this->assign('admin',$logined_user);
        $this->assign('fun',$fun);
        return $this->fetch();
    }




}
