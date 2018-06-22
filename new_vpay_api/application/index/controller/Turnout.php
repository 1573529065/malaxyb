<?php

namespace app\index\controller;

use think\Cache;
use think\Controller;
use think\Cookie;
use think\Db;
use think\Lang;
use think\Request;
use think\Log;

class Turnout extends Controller
{
    public function turn_out(){
        $user = Cookie::get('login_ed');
        $er=Cache::get($user.'er');

        if($er){
            $user_arr=Db::table('mb_user')->where('u_id',$er)->find();
            $this->assign('user',$user_arr);
        }
        return $this->fetch();
    }

    //转入接受二维码
    public function turn_out_t(){
        $key="vE4hF&FxeyfRPelVGUDQWi^Q0cZE^xkp";
        $date = Request::instance()->param('date');
        $last=json_decode($date,true);
        $user = Cookie::get('login_ed');
        if($key == $last['sign']){
            Log::write($date,'notice');
            Cache::set($user.'er',$last['uid'],10);
            if($last){
                return json(['code' => 1, 'msg' => $last['uid']]);
            }
        }else{
            return json(['code' => 2, 'msg' => $last['uid']]);
        }
    }


    //流动资产兑换记录
    public function change_recode_lt(){
        $user = Request::instance()->param('u_id');
        $user_arr=Db::table('mb_current_order')
            ->where('u_id',$user)
            ->where('type',2)
            ->field('co_money,co_time')
            ->order('co_time desc')
            ->select();
        foreach($user_arr as $k=>$v){
            $user_arr[$k]['co_time']=date('Y-m-d H:i:s',$v['co_time']);
            $user_arr[$k]['co_money']=str_replace("-", "", $v['co_money']);
        }
        if($user_arr){
            return jsonp([
                'code' => 1,
                'msg' => 'succeed',
                'data'=>$user_arr
            ]);
        }else{
            return jsonp([
                'code' => 2,
                'msg' => '参数错误',
                'data'=>$user_arr
            ]);
        }
    }


    //转出记录(余额)
    public function turn_recode(){
        $user = Request::instance()->param('u_id');
        $user_arr=Db::table('mb_balance_order')
            ->where('u_id',$user)
            ->where('type',6)
            ->field('bo_money,bo_time,target_uid')
            ->order('bo_time desc')
            ->select();

        foreach($user_arr as $k=>$v){
            $user_arr[$k]['bo_time']=date('Y-m-d H:i:s',$v['bo_time']);
        }
        if($user_arr){
            return jsonp(['code' => 1, 'msg' => 'succeed','data'=>$user_arr]);
        }else{
            return jsonp(['code' => 2, 'msg' => '暂无数据','data'=>$user_arr]);
        }
    }

    //转出记录(流通)
    public function turn_recode_current(){
        $user = Request::instance()->param('u_id');
        $user_arr=Db::table('mb_current_order')
            ->where('u_id',$user)
            ->where('type',4)
            ->field('co_money,co_time,target_uid')
            ->order('co_time desc')
            ->select();
        foreach($user_arr as $k=>$v){
            $user_arr[$k]['co_time']=date('Y-m-d H:i:s',$v['co_time']);
        }
        if($user_arr){
            return jsonp(['code' => 1, 'msg' => 'succeed','data'=>$user_arr]);
        }else{
            return jsonp(['code' => 2, 'msg' => '暂无数据','data'=>$user_arr]);
        }
    }


    //固定资产记录(流通兑换)
    public function change_current_zichan(){

        $user = Request::instance()->param('u_id');
        $user_arr=Db::table('mb_current_order')
            ->where('u_id',$user)
            ->where('type',1)
            ->field('co_money,co_time')
            ->order('co_time desc')
            ->select();
        foreach($user_arr as $k=>$v){
            $user_arr[$k]['co_time']=date('Y-m-d H:i:s',$v['co_time']);
            $user_arr[$k]['assets']=str_replace("-", "", $v['co_money']*3);

        }
        if($user_arr){
            return jsonp(['code' => 1,
                'msg' => 'succeed',
                'data'=>$user_arr]);
        }else{
            return jsonp(['code' => 2,
                'msg' => '参数错误',
                'data'=>$user_arr]);
        }
    }

    //固定资产记录(余额兑换)
    public function change_recode_balance(){

        $user = Request::instance()->param('u_id');
        $user_arr=Db::table('mb_balance_order')
            ->where('u_id',$user)
            ->where('type',8)
            ->field('bo_money,bo_time')
            ->order('bo_time desc')
            ->select();
        foreach($user_arr as $k=>$v){
            $user_arr[$k]['bo_time']=date('Y-m-d H:i:s',$v['bo_time']);
            $user_arr[$k]['assets']=str_replace("-", "", $v['bo_money']*6);
        }
        if($user_arr){
            return jsonp([
                'code' => 1,
                'msg' => 'succeed',
                'data'=>$user_arr
            ]);
        }else{
            return jsonp([
                'code' => 2,
                'msg' => '参数错误',
                'data'=>$user_arr
            ]);
        }
    }
}
