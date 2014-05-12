<?php

namespace Home\Controller;
use Think\Controller;
use Home\Model\AreaModel;
use Home\Model\ProductModel;
use Common\Common\ErrorType;
use Common\Common\DataResult;
use Home\Model\AddressModel;

class IAppController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Iapp控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 获取首页海报
	public function getPoster() {
	}
	// 分页获取套餐
	public function searchCombosByPage() {
	}
	// 增加点击率
	public function addClickNums() {
		$pmodel = new ProductModel ();
		
		$pid = I ( 'pid' );
		if (! isset ( $pid ) or empty ( $pid )) {
			$this->ajaxReturn ( ErrorType::RequestParamsFailed );
		}
		
		$pmodel->updateClickNum ( $pid );
	}
	// 获取购物车数据s
	public function seachShoppingCartInfoByUserId() {
	}
	// 添加收货地址
	public function addAddress() {
		$address = new AddressModel();
		
		$result =new DataResult();
		$receive_name = I ( 'receive_name' );
		$receive_address = I ( 'receive_address' );
		$receive_mobile = I ( 'receive_mobile' );
		$user_id = I ( 'user_id' );
		$receive_postcode = I ( 'receive_postcode' );
		$receive_phone = I ( 'receive_phone' );
		$province_id = I ( 'province_id' );
		$city_id = I ( 'city_id' );
		$county_id = I ( 'county_id' );
		$country_id = I ( 'country_id' );
		$create_time = I ( 'create_time' );
		
		
		if (! isset ( $receive_name ) or empty ( $receive_name )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$result->ErrorMessage="'receive_name' params error";
			$this->ajaxReturn($result);
		}
		if (! isset ( $receive_address ) or empty ( $receive_address )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$result->ErrorMessage="'receive_address' params error";
			$this->ajaxReturn($result);
		}
		if (! isset ( $receive_mobile ) or empty ( $receive_mobile )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$result->ErrorMessage="'receive_mobile' params error";
			$this->ajaxReturn($result);
		}
		if (! isset ( $user_id ) or empty ( $user_id )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$result->ErrorMessage="'user_id' params error";
			$this->ajaxReturn($result);
		}
		if (! isset ( $receive_postcode ) or empty ( $receive_postcode )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$result->ErrorMessage="'receive_postcode' params error";
			$this->ajaxReturn($result);
		}
		if (! isset ( $receive_phone ) or empty ( $receive_phone )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$result->ErrorMessage="'receive_phone' params error";
			$this->ajaxReturn($result);
		}
		if (! isset ( $province_id ) or empty ( $province_id )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$result->ErrorMessage="'province_id' params error";
			$this->ajaxReturn($result);
		}
		if (! isset ( $city_id ) or empty ( $city_id )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$result->ErrorMessage="'city_id' params error";
			$this->ajaxReturn($result);
		}
		if (! isset ( $county_id ) or empty ( $county_id )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$result->ErrorMessage="'county_id' params error";
			$this->ajaxReturn($result);
		}
		if (! isset ( $country_id ) or empty ( $country_id )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$result->ErrorMessage="'country_id' params error";
			$this->ajaxReturn($result);
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$result->ErrorMessage="'create_time' params error";
			$this->ajaxReturn($result);
		}
		$result = $address->addModel ( $receive_name, $receive_address, $receive_mobile, $user_id, $receive_postcode, $receive_phone, $province_id, $city_id, $county_id, $country_id, time () );
	}
	// 获取身份信息
	public function searchProvince() {
		$AreaModel = new AreaModel ();
		$this->ajaxReturn ( $AreaModel->searchByPid ( 0 ) );
	}
	// 通过省份获取城市
	public function searchCityByProvince() {
		$AreaModel = new AreaModel ();
		$pid = I ( 'pid' );
		if (! isset ( $pid ) or empty ( $pid )) {
			$this->ajaxReturn ( ErrorType::RequestParamsFailed );
		}
		$this->ajaxReturn ( $AreaModel->searchByPid ( $pid ) );
	}
	// 通过城市获取县
	public function searchCountyByCity() {
		$AreaModel = new AreaModel ();
		$pid = I ( 'pid' );
		if (! isset ( $pid ) or empty ( $pid )) {
			$this->ajaxReturn ( ErrorType::RequestParamsFailed );
		}
		$this->ajaxReturn ( $AreaModel->searchByPid ( $pid ) );
	}
	// 查询用户配送地址
	public function searchAddrs() {
		$Address = new AddressModel();
		$user_id = I ( 'userid' );
		if (! isset ( $user_id ) or empty ( $user_id )) {
			$this->ajaxReturn ( ErrorType::RequestParamsFailed );
		}
		$this->ajaxReturn ( $Address->searchUserAddress ( $user_id ) );
	}
	// 删除配送地址
	public function delAddr() {
	}
	// 通过关键词查询产品分类，产品名称，产品标签
	public function searchKeysByKey() {
	}
	// 通过名称分页查询产品列表
	public function searchProductsByName() {
	}
	// 通过分类分页查询产品列表
	public function searchProductsByType() {
	}
	// 通过标签分页查询产品
	public function searchProductsByTag() {
	}
	// 获取全部分类
	public function searchTypes() {
	}
	// 获取用户咨询历史记录
	public function searchConsultHistory() {
	}
	// 用户咨询
	public function consult() {
	}
	// 通过ID获取商品详情
	public function getProductDetailByID() {
	}
	// 通过ID获取商品规格参数
	public function getProductSpec() {
	}
	// 添加产品到购物车
	public function productToCart() {
	}
	// 下单
	public function addOrder() {
	}
	// 收藏产品
	public function addFavorites() {
	}
	public function test() {
		echo "begin call getPoster ..... \r\n";
		IAppController::getPoster ();
		echo "call getPoster 成功！\r\n";
		$searchProvince = IAppController::searchProvince ();
		echo json_encode ( $searchProvince );
	}
}