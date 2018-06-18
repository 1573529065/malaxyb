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
        $user = Request::instance()->param('u_id');
        $name = Request::instance()->param('name'); //持卡人姓名
        $card_id = Request::instance()->param('card_id'); //银行卡号
        $bank = Request::instance()->param('bank'); //开户银行

        $default = Request::instance()->param('defult'); //是否默认

        $branch = Request::instance()->param('branch'); //开户支行

        if (Cache::get('card')) {
            return json(['code' => 2, 'msg' => '频率过快!']);
        }else{
            if($user && $name && $card_id && $bank){
                Cache::set('card',true,2);
                if(!empty($branch)){
                    if(!empty($default)){
                        $res = Db::table('mb_bank')->data(
                            ['u_id' => $user,'c_name'=>$name,
                                'b_name' =>$bank, 'b_card' => $card_id,'b_branch'=>$branch,'defult'=>$default]
                        )->insert();
                        $userId = Db::name('mb_bank')->getLastInsID();

                        $res2=Db::table('mb_bank')->where('u_id',$user)->where('b_id','<>',$userId)->setField('defult',0);

                        Db::table('mb_user')->where('u_id',$user)->setField('is_card',1);
                    }else{
                        $res = Db::table('mb_bank')->data(
                            ['u_id' => $user,'c_name'=>$name,
                                'b_name' =>$bank, 'b_card' => $card_id,'b_branch'=>$branch]
                        )->insert();
                        Db::table('mb_user')->where('u_id',$user)->setField('is_card',1);
                    }

                    if($res){
                        return jsonp(['code' => 1, 'msg' => '添加成功！']);
                    }else{
                        return jsonp(['code' => 2, 'msg' => '添加失败！']);
                    }
                }else{
                    if(!empty($default)){
                        $res = Db::table('mb_bank')->data(
                            ['u_id' => $user,'c_name'=>$name,
                                'b_name' =>$bank, 'b_card' => $card_id,'defult'=>$default

                            ]
                        )->insert();
                        $userId = Db::name('mb_bank')->getLastInsID();

                        $res2=Db::table('mb_bank')->where('u_id',$user)->where('b_id','<>',$userId)->setField('defult',0);

                        Db::table('mb_user')->where('u_id',$user)->setField('is_card',1);
                    }else{
                        $res = Db::table('mb_bank')->data(
                            ['u_id' => $user,'c_name'=>$name,
                                'b_name' =>$bank, 'b_card' => $card_id]
                        )->insert();
                        Db::table('mb_user')->where('u_id',$user)->setField('is_card',1);
                    }

                    if($res){
                        return jsonp(['code' => 1, 'msg' => '添加成功！']);
                    }else{
                        return jsonp(['code' => 2, 'msg' => '添加失败！']);
                    }
                }

            }else{
                return jsonp(['code' => 2, 'msg' => '参数错误']);
            }
        }
    }

    //删除银行卡
    public function del_card(){
        $user = Request::instance()->param('u_id');
        $bc_id = Request::instance()->param('b_id');

        if (Cache::get('del_card')) {
            return json(['code' => 2, 'msg' => '频率过快!']);
        }else{
            if($user && $bc_id){
                Cache::set('del_card',true,3);
                $res=Db::table('mb_bank')->where('u_id',$user)->where('b_id',$bc_id)->delete();
                if($res){
                    return jsonp(['code' => 1, 'msg' => '删除成功！']);
                }else{
                    return jsonp(['code' => 2, 'msg' => '删除失败！']);
                }
            }else{
                return jsonp(['code' => 2, 'msg' => '参数错误！']);
            }

        }

    }
    //设为默认银行卡
    public function default_bc(){
        $user = Request::instance()->param('u_id');
        $bc_id = Request::instance()->param('b_id');
        if (Cache::get('default_bc')) {
            return json(['code' => 2, 'msg' => '频率过快!']);
        }else{
            Cache::set('default_bc',true,3);
            if($user && $bc_id){
                $res=Db::table('mb_bank')->where('u_id',$user)->where('b_id',$bc_id)->setField('defult',1);
                Db::table('mb_bank')->where('u_id',$user)->where('b_id','<>',$bc_id)->setField('defult',0);
                if($res){
                    return jsonp(['code' => 1, 'msg' => '设为默认成功！']);
                }else{
                    return jsonp(['code' => 2, 'msg' => '设为默认失败！']);
                }
            }else{
                return jsonp(['code' => 2, 'msg' => '参数错误！']);
            }
        }


    }
}