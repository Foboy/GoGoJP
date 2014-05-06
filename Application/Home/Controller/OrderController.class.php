<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/6 14:00:24
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\OrderModel;
use Home\Model\OrderitemModel;

class OrderController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Order控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 添加
	public function addOrder() {
		$Order = new OrderModel ();
		$user_id = I ( 'user_id', 0 );
		$order_time = I ( 'order_time', '', 'htmlspecialchars' );
		$order_freight = I ( 'order_freight', 0 );
		$order_totalprice = I ( 'order_totalprice', 0 );
		$order_payment = I ( 'order_payment', '', 'htmlspecialchars' );
		$order_status = I ( 'order_status', '', 'htmlspecialchars' );
		$order_status_update_time = I ( 'order_status_update_time', '', 'htmlspecialchars' );
		$order_receive_address = I ( 'order_receive_address', '', 'htmlspecialchars' );
		$order_receive_name = I ( 'order_receive_name', '', 'htmlspecialchars' );
		$order_receive_mobile = I ( 'order_receive_mobile', 0 );
		$order_receive_phone = I ( 'order_receive_phone', '', 'htmlspecialchars' );
		$order_receive_postcode = I ( 'order_receive_postcode', '', 'htmlspecialchars' );
		
		$this->ajaxReturn ( $Order->addModel ( $user_id, $order_time, $order_freight, $order_totalprice, $order_payment, $order_status, $order_status_update_time, $order_receive_address, $order_receive_name, $order_receive_mobile, $order_receive_phone, $order_receive_postcode ) );
	}
	// 删除
	public function deleteOrder() {
		$Order = new OrderModel ();
		$orderid = I ( 'orderid' );
		$this->ajaxReturn ( $Order->deleteModel ( $orderid ) );
	}
	// 编辑
	public function updateOrder() {
		$Order = new OrderModel ();
		$user_id = I ( 'user_id', 0 );
		$order_time = I ( 'order_time', '', 'htmlspecialchars' );
		$order_freight = I ( 'order_freight', 0 );
		$order_totalprice = I ( 'order_totalprice', 0 );
		$order_payment = I ( 'order_payment', '', 'htmlspecialchars' );
		$order_status = I ( 'order_status', '', 'htmlspecialchars' );
		$order_status_update_time = I ( 'order_status_update_time', '', 'htmlspecialchars' );
		$order_receive_address = I ( 'order_receive_address', '', 'htmlspecialchars' );
		$order_receive_name = I ( 'order_receive_name', '', 'htmlspecialchars' );
		$order_receive_mobile = I ( 'order_receive_mobile', 0 );
		$order_receive_phone = I ( 'order_receive_phone', '', 'htmlspecialchars' );
		$order_receive_postcode = I ( 'order_receive_postcode', '', 'htmlspecialchars' );
		
		$this->ajaxReturn ( $Order->updateModel ( $user_id, $order_time, $order_freight, $order_totalprice, $order_payment, $order_status, $order_status_update_time, $order_receive_address, $order_receive_name, $order_receive_mobile, $order_receive_phone, $order_receive_postcode ) );
	}
	// 获取单个
	public function getOrder() {
		$Order = new OrderModel ();
		$orderid = I ( 'orderid' );
		$this->ajaxReturn ( $Order->getModel ( $orderid ) );
	}
	
	// 分页查询列表
	public function searchOrder() {
		$Order = new OrderModel ();
		$user_id = I ( 'user_id', 0 );
		$order_time = I ( 'order_time', '', 'htmlspecialchars' );
		$order_freight = I ( 'order_freight', 0 );
		$order_totalprice = I ( 'order_totalprice', 0 );
		$order_payment = I ( 'order_payment', '', 'htmlspecialchars' );
		$order_status = I ( 'order_status', '', 'htmlspecialchars' );
		$order_status_update_time = I ( 'order_status_update_time', '', 'htmlspecialchars' );
		$order_receive_address = I ( 'order_receive_address', '', 'htmlspecialchars' );
		$order_receive_name = I ( 'order_receive_name', '', 'htmlspecialchars' );
		$order_receive_mobile = I ( 'order_receive_mobile', 0 );
		$order_receive_phone = I ( 'order_receive_phone', '', 'htmlspecialchars' );
		$order_receive_postcode = I ( 'order_receive_postcode', '', 'htmlspecialchars' );
		
		$pageIndex = I ( 'pageindex', 0 );
		$pageSize = I ( 'pagesize', 10 );
		$this->ajaxReturn ( $Order->searchByPage ( $user_id, $order_time, $order_freight, $order_totalprice, $order_payment, $order_status, $order_status_update_time, $order_receive_address, $order_receive_name, $order_receive_mobile, $order_receive_phone, $order_receive_postcode, $pageIndex, $pageSize ) );
	}
	// 添加
	public function addOrderitem() {
		$Orderitem = new OrderitemModel ();
		$user_id = I ( 'user_id', 0 );
		$orderid = I ( 'orderid', 0 );
		$productid = I ( 'productid', 0 );
		$buynumber = I ( 'buynumber', 0 );
		$prodcut_price = I ( 'prodcut_price', 0 );
		$product_name = I ( 'product_name', '', 'htmlspecialchars' );
		$big_pic = I ( 'big_pic', '', 'htmlspecialchars' );
		$small_pic = I ( 'small_pic', '', 'htmlspecialchars' );
		$create_time = I ( 'create_time', '', 'htmlspecialchars' );
		
		$this->ajaxReturn ( $Orderitem->addModel ( $user_id, $orderid, $productid, $buynumber, $prodcut_price, $product_name, $big_pic, $small_pic, $create_time ) );
	}
	// 删除
	public function deleteOrderitem() {
		$Orderitem = new OrderitemModel ();
		$id = I ( 'id' );
		$this->ajaxReturn ( $Orderitem->deleteModel ( $id ) );
	}
	// 编辑
	public function updateOrderitem() {
		$Orderitem = new OrderitemModel ();
		$user_id = I ( 'user_id', 0 );
		$orderid = I ( 'orderid', 0 );
		$productid = I ( 'productid', 0 );
		$buynumber = I ( 'buynumber', 0 );
		$prodcut_price = I ( 'prodcut_price', 0 );
		$product_name = I ( 'product_name', '', 'htmlspecialchars' );
		$big_pic = I ( 'big_pic', '', 'htmlspecialchars' );
		$small_pic = I ( 'small_pic', '', 'htmlspecialchars' );
		$create_time = I ( 'create_time', '', 'htmlspecialchars' );
		
		$this->ajaxReturn ( $Orderitem->updateModel ( $user_id, $orderid, $productid, $buynumber, $prodcut_price, $product_name, $big_pic, $small_pic, $create_time ) );
	}
	// 获取单个
	public function getOrderitem() {
		$Orderitem = new OrderitemModel ();
		$id = I ( 'id' );
		$this->ajaxReturn ( $Orderitem->getModel ( $id ) );
	}
	
	// 分页查询列表
	public function searchOrderitem() {
		$Orderitem = new OrderitemModel ();
		$user_id = I ( 'user_id', 0 );
		$orderid = I ( 'orderid', 0 );
		$productid = I ( 'productid', 0 );
		$buynumber = I ( 'buynumber', 0 );
		$prodcut_price = I ( 'prodcut_price', 0 );
		$product_name = I ( 'product_name', '', 'htmlspecialchars' );
		$big_pic = I ( 'big_pic', '', 'htmlspecialchars' );
		$small_pic = I ( 'small_pic', '', 'htmlspecialchars' );
		$create_time = I ( 'create_time', '', 'htmlspecialchars' );
		
		$pageIndex = I ( 'pageindex', 0 );
		$pageSize = I ( 'pagesize', 10 );
		$this->ajaxReturn ( $Orderitem->searchByPage ( $user_id, $orderid, $productid, $buynumber, $prodcut_price, $product_name, $big_pic, $small_pic, $create_time, $pageIndex, $pageSize ) );
	}
}