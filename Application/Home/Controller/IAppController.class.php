<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\AreaModel;
use Home\Model\ProductModel;
use Common\Common\ErrorType;
use Common\Common\DataResult;
use Home\Model\AddressModel;
use Home\Model\MessageModel;
use Home\Model\CustomerAdvisoryModel;
use Home\Model\OrderModel;
use Home\Model\PictureModel;
use Home\Model\ProductCategoryModel;
use Home\Model\OrderitemModel;
use Think\Log;
use Home\Model\ShopcartModel;

class IAppController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Iapp控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 获取首页海报
	public function getPoster() {
		$Pic = new PictureModel ();
		$pageIndex = I ( 'page_index', 0 );
		$pageSize = I ( 'page_size', 10 );
		$this->ajaxReturn ( $Pic->searchByPage ( $pageIndex, $pageSize ) );
	}
	// 分页获取合集
	public function searchCombosByPage() {
	}
	// 通过关键词查询产品分类，产品名称，产品标签
	public function searchKeysByKey() {
	}
	// 通过名称分页查询产品列表
	public function searchProductsByName() {
		$Product = new ProductModel ();
		$result = new DataResult ();
		$pname = I ( 'pname' );
		if (! isset ( $pname ) or empty ( $pname )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'catid' params error";
			$this->ajaxReturn ( $result );
		}
		$pageIndex = I ( 'page_index', 0 );
		$pageSize = I ( 'page_size', 10 );
		$this->ajaxReturn ( $Product->searchProductByCondition ( 0, $pname, $pageIndex, $pageSize ) );
	}
	// 通过分类分页查询产品列表
	public function searchProductsByType() {
		$Product = new ProductModel ();
		$result = new DataResult ();
		$catid = I ( 'catid' );
		if (! isset ( $catid ) or empty ( $catid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'catid' params error";
			$this->ajaxReturn ( $result );
		}
		$pageIndex = I ( 'pageIndex', 0 );
		$pageSize = I ( 'pageSize', 10 );
		$this->ajaxReturn ( $Product->searchProductByCondition ( $catid, '', $pageIndex, $pageSize ) );
	}
	// 通过标签分页查询产品
	public function searchProductsByTag() {
	}
	// 获取全部分类
	public function searchTypes() {
		$ProductCategory = new ProductCategoryModel ();
		$this->ajaxReturn ( $ProductCategory->searchMainCategory () );
	}
	// 通过ID获取商品详情
	public function getProductDetailByID() {
		$Product = new ProductModel ();
		$productid = I ( 'product_id' );
		$result = new DataResult ();
		if (! isset ( $productid ) or empty ( $productid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'product_id' params error";
			$this->ajaxReturn ( $result );
		}
		$this->ajaxReturn ( $Product->getModel ( $productid ) );
	}
	
	// 通过产品ID数组获取收藏产品列表
	public function searchProductListByPIDS() {
	}
	// 通过ID获取商品规格参数
	public function getProductSpec() {
	}
	// 添加产品到购物车
	public function productToCart() {
		$result = new DataResult ();
		$Shopcart = new ShopcartModel ();
		
		$user_id = I ( 'user_id' );
		$productid = I ( 'product_id' );
		$buynumber = I ( 'buy_number' );
		$prodcut_price = I ( 'prodcut_price' );
		$product_name = I ( 'product_name' );
		$pic_url = I ( 'pic_url' );
		$create_time = time();
		$type_remark = I ( 'type_remark' );
		$product_num = I ( 'product_num' );
		
		if (! isset ( $user_id ) or empty ( $user_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'user_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $productid ) or empty ( $productid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'productid' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $buynumber ) or empty ( $buynumber )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'buynumber' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $prodcut_price ) or empty ( $prodcut_price )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'prodcut_price' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $product_name ) or empty ( $product_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'product_name' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $pic_url ) or empty ( $pic_url )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'pic_url' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $type_remark ) or empty ( $type_remark )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'type_remark' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $product_num ) or empty ( $product_num )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'product_num' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $Shopcart->addModel ( $user_id, $productid, $buynumber, $prodcut_price, $product_name, $pic_url, $create_time, $type_remark, $product_num );
		$this->ajaxReturn ( $result );
	}
	//移除产品
	public  function removeProductInCart()
	{
		$result = new DataResult ();
		$Shopcart = new ShopcartModel ();
		$cartid = I ( 'cart_id' );
		if (! isset ( $cartid ) or empty ( $cartid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'cartid' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $Shopcart->deleteModel ( $cartid );
		$this->ajaxReturn ( $result );
	}

	// 获取购物车数据s
	public function seachShoppingCartInfoByUserId() {
		$result = new DataResult ();
		$Shopcart = new ShopcartModel ();
		$userid = I ( 'user_id' );
		if (! isset ( $userid ) or empty ( $userid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'userid' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $Shopcart->seachModelByUserId ( $userid );
		$this->ajaxReturn ( $result );
	}
	// 收藏产品（客户端做）
// 	public function addFavorites() {
// 	}
	// 增加点击率
	public function addClickNums() {
		$pmodel = new ProductModel ();
		
		$pid = I ( 'pid' );
		if (! isset ( $pid ) or empty ( $pid )) {
			$this->ajaxReturn ( ErrorType::RequestParamsFailed );
		}
		
		$pmodel->updateClickNum ( $pid );
	}
	
	// 添加收货地址
	public function addAddress() {
		$address = new AddressModel ();
		
		$result = new DataResult ();
		$receive_name = I ( 'receive_name' );
		$receive_address = I ( 'receive_address' );
		$receive_mobile = I ( 'receive_mobile' );
		$user_id = I ( 'user_id' );
		$receive_postcode = I ( 'receive_postcode', '' );
		$receive_phone = I ( 'receive_phone' );
		$province_id = I ( 'province_id' );
		$city_id = I ( 'city_id' );
		$county_id = I ( 'county_id' );
		$country_id = I ( 'country_id' );
		
		if (! isset ( $receive_name ) or empty ( $receive_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'receive_name' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $receive_address ) or empty ( $receive_address )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'receive_address' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $receive_mobile ) or empty ( $receive_mobile )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'receive_mobile' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $user_id ) or empty ( $user_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'user_id' params error";
			$this->ajaxReturn ( $result );
		}
		
		if (! isset ( $receive_phone ) or empty ( $receive_phone )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'receive_phone' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $province_id ) or empty ( $province_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'province_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $city_id ) or empty ( $city_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'city_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $county_id ) or empty ( $county_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'county_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $country_id ) or empty ( $country_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'country_id' params error";
			$this->ajaxReturn ( $result );
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
		$Address = new AddressModel ();
		$user_id = I ( 'user_id' );
		if (! isset ( $user_id ) or empty ( $user_id )) {
			$this->ajaxReturn ( ErrorType::RequestParamsFailed );
		}
		$this->ajaxReturn ( $Address->searchUserAddress ( $user_id ) );
	}
	// 删除配送地址
	public function delAddr() {
		$Address = new AddressModel ();
		$aid = I ( 'aid' );
		if (! isset ( $aid ) or empty ( $aid )) {
			$this->ajaxReturn ( ErrorType::RequestParamsFailed );
		}
		$this->ajaxReturn ( $Address->deleteModel ( $aid ) );
	}
	
	// 获取用户咨询历史记录
	public function searchConsultHistory() {
		$result = new DataResult ();
		$customer_id = I ( 'customer_id' );
		$pageIndex = I ( 'page_index' );
		$pageSize = I ( 'page_size', 10 );
		$begin_time = I ( 'begin_time' );
		$end_time = I ( 'end_time' );
		$keyname = I ( 'key', '', 'htmlspecialchars' );
		
		if (! isset ( $customer_id ) or empty ( $customer_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'customer_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $pageIndex ) or empty ( $pageIndex )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'page_index' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $begin_time ) or empty ( $begin_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'begin_time' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $end_time ) or empty ( $end_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'end_time' params error";
			$this->ajaxReturn ( $result );
		}
		$messageModel = new MessageModel ();
		$result = $messageModel->searchByPage ( $customer_id, $keyname, $begin_time, $end_time, $pageIndex, $pageSize );
		$this->ajaxReturn ( $result );
	}
	// 用户咨询
	public function consult() {
		$result = new DataResult ();
		$customer_id = I ( 'user_id' );
		$customer_account = I ( 'account' );
		$customer_nickname = I ( 'nickname' );
		$content = I ( 'content' );
		
		if (! isset ( $customer_id ) or empty ( $customer_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'user_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $customer_account ) or empty ( $customer_account )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'account' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $customer_nickname ) or empty ( $customer_nickname )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'nickname' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $content ) or empty ( $content )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'content' params error";
			$this->ajaxReturn ( $result );
		}
		$advisoryModel = new CustomerAdvisoryModel ();
		$messageModel = new MessageModel ();
		$addResult = $messageModel->addModel ( $customer_id, 0, $content, time () );
		if ($addResult->Error == ErrorType::Success) {
			$advisoryModel->addModel ( $customer_id, $customer_account, $customer_nickname, time (), 1 );
		}
		$this->ajaxReturn ( $addResult );
	}
	
	// 下单
	public function addOrder() {
	
		$Order = new OrderModel ();
		$result = new DataResult ();
		$order_no = 'SD' . date ( 'Ymd' ) . str_pad ( mt_rand ( 1, 9999999 ), 7, '0', STR_PAD_LEFT );
		
		$remark = I ( 'remark', '', 'htmlspecialchars' );
		$logistics_status = 1;
		$order_time = time ();
		$order_status = 1;
		$order_status_update_time = time ();
		
		$order_items = I ( 'order_items' );
		if (! isset ( $order_items ) or empty ( $order_items )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'order_items' params error";
			$this->ajaxReturn ( $result );
		}
		
		$aid = I ( 'aid' );
		if (! isset ( $aid ) or empty ( $aid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'content' params error";
			$this->ajaxReturn ( $result );
		}
		$Address = new AddressModel ();
		$addrmodule = $Address->getModel ( $aid );
		
		$order_receive_address = $addrmodule->Data ['receive_address'];
		$order_receive_name = $addrmodule->Data ['receive_name'];
		$order_receive_mobile = $addrmodule->Data ['receive_mobile'];
		$order_receive_phone = $addrmodule->Data ['receive_phone'];
		$order_receive_postcode = $addrmodule->Data ['receive_postcode'];
		
		$invoice = I ( 'invoice' );
		$user_id = I ( 'user_id' );
		$user_account = I ( 'user_account' );
		$order_freight = I ( 'order_freight' );
		$order_totalprice = I ( 'order_totalprice' );
		$order_payment = I ( 'order_payment' );
		
		if (! isset ( $user_id ) or empty ( $user_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'user_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $user_account ) or empty ( $user_account )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'user_account' params error";
			$this->ajaxReturn ( $result );
		}
		
		if (! isset ( $order_freight ) or empty ( $order_freight )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'order_freight' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_totalprice ) or empty ( $order_totalprice )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'order_totalprice' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $invoice ) or empty ( $invoice )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'invoice' params error";
			$this->ajaxReturn ( $result );
		}
		
		$result = $Order->addModel ( $order_no, $user_id, $user_account, $order_time, $order_freight, $order_totalprice, $order_payment, $order_status, $order_status_update_time, $order_receive_address, $order_receive_name, $order_receive_mobile, $order_receive_phone, $order_receive_postcode, $remark, $invoice );
		
		// 添加订单详情
		$order_items = "[{\"productid\":18,\"product_name\":\"西安\",\"buynumber\":1,
				\"prodcut_price\":\"33.00\",\"type_remark\":\"真皮 XL 红色\",
				\"pic_url\":\"\",\"product_sn\":\"p234234324\"}]";
		$order_items = json_decode ( $order_items );
		$arr = json_decode ( $order_items );
		
		foreach ( $arr as $key => $value ) {
			$OrderitemModel = new OrderitemModel ();
			$productid = 0;
			$product_name = "";
			$buynumber = 0;
			$prodcut_price = 0;
			$pic_url = "";
			$type_remark = "";
			$product_num = "";
			
			$productid = $arr [$key]->productid;
			
			$product_name = $arr [$key]->product_name;
			
			$buynumber = $arr [$key]->buynumber;
			
			$prodcut_price = $arr [$key]->prodcut_price;
			
			$type_remark = $arr [$key]->type_remark;
			
			$pic_url = $arr [$key]->pic_url;
			
			$product_num = $arr [$key]->product_sn;
			
			$OrderitemModel->addModel ( $order_no, $productid, $buynumber, $prodcut_price, $product_name, $pic_url, time (), $type_remark, $product_num );
		}
		$result->Error=ErrorType::Success;
		$this->ajaxReturn ( $result );
	}
	
	// 支付订单
	public function payOrder() {
		$Order = new OrderModel ();
		$result = new DataResult ();
		
		$order_no = I ( 'order_no' );
		$order_pay_account = I ( 'order_pay_account' );
		
		if (! isset ( $order_pay_account ) or empty ( $order_pay_account )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'order_pay_account' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_no ) or empty ( $order_no )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'order_no' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $Order->PayOrder ( $order_no, $order_pay_account );
		$this->ajaxReturn ( $result );
	}
	
	// 获取用户订单列表
	public function searchOrderListByUserId() {
		$result = new DataResult ();
		$Order = new OrderModel ();
		$user_id = I ( 'user_id' );
		
		if (! isset ( $user_id ) or empty ( $user_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'user_id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $Order->searchUserOrder($user_id);
		$this->ajaxReturn ( $result );
	}
	// 通过订单号获取订单信息
	public function getOrder() {
		$result = new DataResult ();
		$Order = new OrderModel ();
		$order_no = I ( 'order_no' );
		if (! isset ( $order_no ) or empty ( $order_no )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Order->getModel ( $order_no );
		$this->ajaxReturn ( $result );
	}
	// 通过订单号获取订单详情
	public function searchOrderItem() {
		$result = new DataResult ();
		$OrderItem = new OrderitemModel();
		$order_no = I ( 'order_no' );
		if (! isset ( $order_no ) or empty ( $order_no )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $OrderItem->searchItemByOrderNO ( $order_no );
		$this->ajaxReturn ( $result );
	}
	public function test() {
		// echo "begin call getPoster ..... \r\n";
		// IAppController::getPoster ();
		// echo "call getPoster 成功！\r\n";
		// $searchProvince = IAppController::searchProvince ();
		// echo json_encode ( $searchProvince );
		
		// $Address = new AddressModel();
		// $addrmodule = $Address->getModel( 1 );
		// echo json_encode (date( "Y-m-d H:i:s",time() ));
		$result = new DataResult ();
		$order_items = I ( 'order_items' );
		if (! isset ( $order_items ) or empty ( $order_items )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'order_items' params error";
			$this->ajaxReturn ( $result );
		}
		
		$order_items = "[{\"CityId\":18,\"CityName\":\"西安\"},{\"CityId\":53,\"CityName\":\"广州\"}]";
		$arr = json_decode ( $order_items );
		// var_dump($arr);
		
		foreach ( $arr as $key => $value ) {
			print_r ( $arr [$key]->CityName );
		}
		try {
			Log::write($order_items,'WARN');
		} catch (Exception $e) {
			Log::write($order_items,'WARN');
		}
	}
}