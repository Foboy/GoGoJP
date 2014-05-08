<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\AreaModel;
use Home\Model\ShippingaddressModel;

class IAppController extends Controller
{
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Iapp控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	//获取首页海报
	public function getPoster()
	{}
	//分页获取套餐
	public function searchCombosByPage()
	{}
	//增加点击率
	public function addClickNums()
	{}
	//获取购物车数据s
	public function seachShoppingCartInfoByUserId()
	{
		
	}
	//添加收货地址
	public function addAddress()
	{}
	//获取身份信息
	public function searchProvince()
	{
		$AreaModel = new AreaModel ();
		$this->ajaxReturn($AreaModel->searchByPid(0));
	}
	//通过省份获取城市
	public function searchCityByProvince()
	{
		$AreaModel = new AreaModel ();
		$pid=I('pid');
		$this->ajaxReturn($AreaModel->searchByPid($pid));
	}
	//通过城市获取县
	public function searchCountyByCity()
	{
		$AreaModel = new AreaModel ();
		$pid=I('pid');
		$this->ajaxReturn($AreaModel->searchByPid($pid));
	}
	//查询用户配送地址
	public function searchAddrs()
	{
		$Address=new ShippingaddressModel();
		$user_id=I('userid');
		$this->ajaxReturn($Address->searchUserAddress($user_id));
	}
	//删除配送地址
	public function delAddr()
	{}
	//通过关键词查询产品分类，产品名称，产品标签
	public function searchTagsByKey()
	{}
	//通过名称分页查询产品列表
	public function searchProductsByName()
	{}
	//通过分类分页查询产品列表
	public function searchProductsByType()
	{}
	//通过标签分页查询产品
	public function searchProductsByTag()
	{}
	//获取全部分类
	public function searchTypes()
	{}
	//获取用户咨询历史记录
	public function searchConsultHistory()
	{}
	//用户咨询
	public function consult()
	{}
	//通过ID获取商品详情
	public function getProductDetailByID()
	{}
	//通过ID获取商品规格参数
	public function getProductSpec()
	{}
	//添加产品到购物车
	public function productToCart()
	{}
	//下单
	public function addOrder()
	{}
	//收藏产品
	public function addFavorites()
	{}

}