<?php
namespace app\api\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;
use think\Log;
class Api {
	/**
	 * [index 获取商城商品分类]
	 * @Author    wyc
	 * @DateTime  2018-05-24T14:18:18+0800
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [version]
	 * @return    [type]                   [description]
	 */
	public function getGoodsClassify(){
		$mall = Db::connect('mall');
		$res = $mall->table('mall_goods_classify a')			 
			  ->field('classify_id,name')
			  ->where('status',1)
			  ->where('is_delete',0)
			  ->select();
		if($res){
			$re['code'] = 1;
			$re['msg'] = 'success';
			$re['data'] = $res;
		}else{
			$re['code'] = 0;
			$re['msg'] = '暂无数据';
			$re['data'] = array();
		}
		return jsonp($re);
		
	}
	/**
	 * [getGoodsList 根据分类id获取商品列表]
	 * @Author    wyc
	 * @DateTime  2018-05-25T16:31:17+0800
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [version]
	 * @return    [type]                   [description]
	 */
	public function getGoodsList(){
		$mall = Db::connect('mall');
		$param = Request::instance()->param();
		if(!isset($param['classify_id'])){
			$re['code'] = -1;
			$re['msg'] = '参数不正确';
			return jsonp($re);
		}
		$where['a.classify_id'] = $param['classify_id'];
		$where['a.is_delete'] = 0;
		$where['a.status'] = 1;
		$where['b.status'] = 1;
		$res = $mall->table('mall_goods a')
			   ->join('mall_admin b','a.seller_id = b.admin_id')	
			   ->where($where)
			   ->field('goods_id,goods_img,goods_name,sales_num,price,shop_name')
			   ->select();
		if($res){
			$re['code'] = 1;
			$re['msg'] = 'success';
			$re['data'] = $res;
		}else{
			$re['code'] = 0;
			$re['msg'] = '暂无数据';
			$re['data']= array();
		}
		return jsonp($re);
	}
	/**
	 * [getGoodsInfo 根据商品id获取商品详情]
	 * @Author    wyc
	 * @DateTime  2018-05-25T17:08:43+0800
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [version]
	 * @return    [type]                   [description]
	 */
	public function getGoodsInfo(){
		$mall = Db::connect('mall');
		$param = Request::instance()->param();
		if(!isset($param['goods_id'])){
			$re['code'] = -1;
			$re['msg'] = '参数不正确';
			return jsonp($re);
		}
		$res =  $mall->table('mall_goods a')
				->join('mall_admin b','a.seller_id = b.admin_id')
				->where('goods_id',$param['goods_id'])
				->find();
		$img = $mall->table('mall_goods_img')->where('goods_id',$param['goods_id'])->select();
		$res['nav_img'] = $img;
		if($res){
			$re['code'] = 1;
			$re['msg'] = 'success';
			$re['data'] = $res;
		}else{
			$re['code'] = 0;
			$re['msg'] = '暂无数据';
			$re['data']= array();
		}
		return jsonp($re);
	}
	/**
	 * [getAddress 获取地址]
	 * @Author    wyc
	 * @DateTime  2018-05-25T17:49:05+0800
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [version]
	 * @return    [type]                   [description]
	 */
	public function getAddress(){
		$mall = Db::connect('mall');
		$param = Request::instance()->param();
		if(!isset($param['u_id'])){
			$re['code'] = -1;
			$re['msg'] = '参数不正确';
			return jsonp($re);
		}
		$res = $mall->table('mall_delivery_address')->where('u_id',$param['u_id'])->where('is_delete',0)->select();
		if($res){
			$re['code'] = 1;
			$re['msg'] = 'success';
			$re['data'] = $res;
		}else{
			$re['code'] = 0;
			$re['msg'] = '暂无数据';
			$re['data'] = array();
		}
		return jsonp($re);
	}
	/**
	 * [addAddress 添加收货地址]
	 * @Author    wyc
	 * @DateTime  2018-05-25T17:30:24+0800
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [version]
	 */
	public function addAddress(){
		$mall = Db::connect('mall');
		$param = Request::instance()->param();
		if(!isset($param['u_id']) ||!isset($param['address']) || !isset($param['contact']) || !isset($param['delivery_name']) ){
			$re['code'] = -1;
			$re['msg'] = '参数不正确';
			return jsonp($re);
		}
		$data['u_id'] = $param['u_id'];
		$data['address'] = $param['address'];
		$data['contact'] = $param['contact'];
		$data['delivery_name'] = $param['delivery_name'];
		$data['is_default'] = isset($param['is_default']) ? $param['is_default'] : 1;
		$default = $mall->table('mall_delivery_address')->where('u_id',$param['u_id'])->where('is_delete',0)->where('is_default',1)->find();
		if($default){
			$mall->table('mall_delivery_address')->where('address_id',$default['address_id'])->update(['is_default'=>0]);
		}
		$res = $mall->table('mall_delivery_address')->insert($data);
		if($res){
			$re['code'] = 1;
			$re['msg'] = '添加成功';
		}else{
			$re['code'] = 0;
			$re['msg'] = '添加失败';
		}
		return jsonp($re);
	}
	/**
	 * [updateAddress 修改地址]
	 * @Author    wyc
	 * @DateTime  2018-05-25T17:43:33+0800
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [version]
	 * @return    [type]                   [description]
	 */
	public function updateAddress(){
		$mall = Db::connect('mall');
		$param = Request::instance()->param();
		if(!isset($param['address']) || !isset($param['contact']) || !isset($param['delivery_name']) || !isset($param['address_id']) ){
			$re['code'] = -1;
			$re['msg'] = '参数不正确';
			return jsonp($re);
		}
		$data['address'] = $param['address'];
		$data['contact'] = $param['contact'];
		$data['delivery_name'] = $param['delivery_name'];
		$data['is_default'] = isset($param['is_default']) ? $param['is_default'] : 1;
		$default = $mall->table('mall_delivery_address')->where('u_id',$param['u_id'])->where('is_delete',0)->where('is_default',1)->find();
		if($default){
			$mall->table('mall_delivery_address')->where('address_id',$default['address_id'])->update(['is_default'=>0]);
		}
		$res = $mall->table('mall_delivery_address')->where('address_id',$param['address_id'])->update($data);
		if($res){
			$re['code'] = 1;
			$re['msg'] = '修改成功';
		}else{
			$re['code'] = 0;
			$re['msg'] = '修改失败';
		}
		return jsonp($re);
	}
	/**
	 * [delAddress 删除收货地址]
	 * @Author    wyc
	 * @DateTime  2018-05-30T10:06:31+0800
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [version]
	 * @return    [type]                   [description]
	 */
	public function delAddress(){
		$mall = Db::connect('mall');
		$param = Request::instance()->param();
		if(!isset($param['address_id'])){
			$re['code'] = -1;
			$re['msg'] = '参数不正确';
			return jsonp($re);
		}

		$res = $mall->table('mall_delivery_address')->where('address_id',$param['address_id'])->update(['is_delete'=>1]);
		if($res){
			$re['code'] = 1;
			$re['msg'] = '删除成功';
		}else{
			$re['code'] = 0;
			$re['msg'] = '删除失败';
		}
		return jsonp($re);
	}
	/**
	 * [createOrder 创建订单]
	 * @Author    wyc
	 * @DateTime  2018-05-25T17:53:05+0800
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [version]
	 * @return    [type]                   [description]
	 */
	public function createOrder(){
		$mall = Db::connect('mall');
		$param = Request::instance()->param();
		if(!isset($param['u_id']) ||!isset($param['goods_id']) || !isset($param['num']) || !isset($param['total_price'])|| !isset($param['address_id']) ||!isset($param['pay_pass'])){
			$re['code'] = -1;
			$re['msg'] = '参数不正确';
			return jsonp($re);
		}
		$pay_pass = Db::name('mb_user')->where('u_id',$param['u_id'])->value('pay_pass');
		if(md5($param['pay_pass']) != $pay_pass){
			$re['code'] = -2;
			$re['msg'] = '支付密码不正确';
			return jsonp($re);
		}
		$goodsInfo = $mall->table('mall_goods')->where('goods_id',$param['goods_id'])->find();
		$balance = Db::name('mb_user')->where('u_id',$param['u_id'])->value('balance');
		if($param['num'] * $goodsInfo['price'] >$balance){
			$re['code'] = -3;
			$re['msg'] = '余额不足';
			return jsonp($re);
		}
		if($param['total_price'] !=($param['num'] * $goodsInfo['price'])){
			$re['code'] = -4;
			$re['msg'] = '订单总金额不正确';
			return jsonp($re);
		}

		
		$userinfo = Db::name('mb_user')->where('u_id',$param['u_id'])->find();
		log::write('用户');
		log::write($userinfo);
		$data['order_sn'] = code(6).date('Ymdhis');
		$data['u_id'] = $param['u_id'];
		$data['goods_id'] = $param['goods_id'];
		$data['seller_id'] = $goodsInfo['seller_id'];
		$data['price'] = $goodsInfo['price'];
		$data['num'] = $param['num'];
		$data['total_price'] = $param['num'] * $goodsInfo['price'];
		$data['address_id'] = $param['address_id'];
		$data['add_time'] = time();
		$data['update_time'] = time();
		$data['status'] = 1;
		$res = $mall->table('mall_order')->insertGetId($data);

		$balanceInfo['u_id'] = $param['u_id'];
		$balanceInfo['bo_money'] = $param['num'] * $goodsInfo['price'];
		$balanceInfo['former_money'] = $balance;
		$balanceInfo['type'] = 8;
		$balanceInfo['bo_time'] = time();
        $res1 = Db::table('mb_balance_order')->insertGetId($balanceInfo);

		if($res){
			Db::name('mb_user')->where('u_id',$param['u_id'])->setDec('balance',$param['total_price']);
			$mall->table('mall_goods')->where('goods_id',$param['goods_id'])->setDec('stock',$param['num']);
			$mall->table('mall_goods')->where('goods_id',$param['goods_id'])->setInc('sales_num',$param['num']);
			$orderInfo = $mall->table('mall_order a')
						->join('mall_delivery_address b','a.address_id = b.address_id')
						->join('mall_goods c','a.goods_id = c.goods_id')
						->join('mall_goods_classify d','c.classify_id=d.classify_id')
						->where('a.is_delete',0)
						->where('order_id',$res)
						->field('order_id,order_sn,a.u_id,c.goods_name,d.name as classify_name,c.price,c.goods_img,num,total_price,address,a.status,a.add_time')
						->find();
			switch ($orderInfo['status']) {
				case 0:
					$orderInfo['status'] = '未付款';
					break;
				case 1:
					$orderInfo['status'] = '已付款';
					break;
				case 2:
					$orderInfo['status'] = '已发货';
				break;
				case 3:
					$orderInfo['status'] = '已完成';
				break;
			}
			$re['code'] = 1;
			$re['msg'] = '下单成功';
			$re['data']= $orderInfo;
		}else{
			$re['code'] = 0;
			$re['msg'] = '下单失败';

		}
		return jsonp($re);
		
	}
	/**
	 * [confirmOrder 确认收货]
	 * @Author    wyc
	 * @DateTime  2018-05-29T14:39:00+0800
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [version]
	 * @return    [type]                   [description]
	 */
	public function confirmOrder(){
		$mall = Db::connect('mall');
		$param = Request::instance()->param();
		if(!isset($param['u_id']) || !isset($param['order_id'])){
			$re['code'] = -1;
			$re['msg'] = '参数不正确';
			return jsonp($re);
		}
		$where['u_id'] = $param['u_id'];
		$where['order_id'] = $param['order_id'];
		$orderInfo = $mall->table('mall_order')->where($where)->find();
		if(!$orderInfo){
			$re['code'] = -2;
			$re['msg'] = '没有此订单';
			return jsonp($re);
		}else{
			if($orderInfo['status'] != 2){
				$re['code'] = -3;
				$re['msg'] = '流程未走完';
				return jsonp($re);
			}
		}
		$res = $mall->table('mall_order')->where($where)->setField('status',3);
		if($res){
			$re['code'] = 1;
			$re['msg'] = '确认收货成功';
			return jsonp($re);
		}else{
			$re['code'] = 0;
			$re['msg'] = '确认收货失败';
			return jsonp($re);
		}
	}
	/**
	 * [getOrderInfo 获取订单列表]
	 * @Author   wyc
	 * @DateTime 2018-05-26T17:40:10+0800
	 * @return   [type]                   [description]
	 */
	public function getOrderInfo(){
		$mall = Db::connect('mall');
		$param = Request::instance()->param();
		if(!isset($param['u_id'])){
			$re['code'] = -1;
			$re['msg'] = '参数不正确';
			return jsonp($re);
		}
		$orderInfo = $mall->table('mall_order a')
					 ->join('mall_delivery_address b','a.address_id = b.address_id')
					 ->join('mall_goods c','a.goods_id = c.goods_id')
					 ->join('mall_goods_classify d','c.classify_id=d.classify_id')
					 ->where('a.is_delete',0)
					 ->where('a.u_id',$param['u_id'])
					 ->field('order_id,order_sn,standard,a.u_id,c.goods_name,d.name as classify_name,c.price,c.goods_img,num,total_price,address,a.status,a.add_time')
					 ->order('a.add_time desc')
					 ->select();
		foreach ($orderInfo as $key => $value) {
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
			$new[$key] = $value;
		}
		if($orderInfo){
			$re['code'] = 1;
			$re['msg'] = 'success';
			$re['data']= $new;
		}else{
			$re['code'] = 0;
			$re['msg'] = '暂无数据';
			$re['data']= array();
		}
		return jsonp($re);
	}
	/**
	 * [registSeller 注册商家]
	 * @Author    wyc
	 * @DateTime  2018-05-29T18:42:39+0800
	 * @copyright [copyright]
	 * @license   [license]
	 * @version   [version]
	 * @return    [type]                   [description]
	 */
	public function registSeller(){
		$mall = Db::connect('mall');
		$param = Request::instance()->param();
		if(!isset($param['u_id'])||!isset($param['account'])||!isset($param['pass'])
			||!isset($param['mobile'])||!isset($param['classify_id'])||
			!isset($param['shop_name'])){
			$re['code'] = -1;
			$re['msg'] = '参数不正确';
			return jsonp($re);
		}
		$adminInfo = $mall->table('mall_admin')->where('u_id',$param['u_id'])->find();
		if($adminInfo){
			$re['code'] = -2;
			$re['msg'] = '同一个用户只能注册一个商家';
			return jsonp($re);
		}
		$admin = $mall->table('mall_admin')->where('account',$param['account'])->find();
		if($admin){
			$re['code'] = -3;
			$re['msg'] = '该用户名已经被注册';
			return jsonp($re);
		}

		$data['u_id'] = $param['u_id'];
		$data['account'] = $param['account'];
		$data['pass'] = md5($param['pass']);
		$data['mobile'] = $param['classify_id'];
		$data['classify_id'] = $param['classify_id'];
		$data['shop_name'] = $param['shop_name'];
		$data['status'] = 1;
		$data['login_time'] = time();
		$data['add_time'] = time();
		$res = $mall->table('mall_admin')->insert($data);
		if($res){
			$re['code'] =1;
			$re['msg'] = '注册成功,请等待审核';
		}else{
			$re['code'] =0;
			$re['msg'] = '注册失败,请稍后再试';
		}
		return jsonp($re);
		//$data['type'] = 2

	}
	public function getUserInfo(){
		$mall = Db::connect('mall');
		$param = Request::instance()->param();
		$res = Db::name('mb_user')->where('u_id',$param['u_id'])->find();
		return jsonp($res);
	}

    /**
     * 最新商品
     * @return \think\response\Jsonp
     */
    public function getNewGoods(){
            $mall = Db::connect('mall');
            $where['a.is_delete'] = 0;
            $where['a.status'] = 1;
            $res = $mall->table('mall_goods a')
                ->join('mall_admin b','a.seller_id = b.admin_id')
                ->where($where)
                ->order('goods_id desc')
                ->field('goods_id,goods_img,goods_name,sales_num,price,shop_name')
                ->select();
            if($res){
                $re = [
                    'code' => 1,
                    'msg' => 'success',
                    'data' => $res,
                ];
            }else{
                $re = [
                    'code' => 0,
                    'msg' => '暂无数据',
                    'data' => [],
                ];
            }
            return jsonp($re);

    }
	

}