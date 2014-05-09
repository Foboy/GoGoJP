<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/8 12:54:57
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\OrderModel;
use Common\Common\DataResult;
use Common\Common\ErrorType;
use Common\Common\LogisticsStatus;
use Common\Common\OrderStatus;

class OrderController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Order控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 添加
	// 添加
	public function addOrder() {
		$result = new DataResult ();
		$Order = new OrderModel ();
		
		$order_no = I ( 'order_no' );
		$user_id = I ( 'user_id' );
		$user_account = I ( 'user_account' );
		$order_time = I ( 'order_time' );
		$order_freight = I ( 'order_freight' );
		$order_totalprice = I ( 'order_totalprice' );
		$order_payment = I ( 'order_payment' );
		$order_status = I ( 'order_status' );
		$order_status_update_time = I ( 'order_status_update_time' );
		$order_receive_address = I ( 'order_receive_address' );
		$order_receive_name = I ( 'order_receive_name' );
		$order_receive_mobile = I ( 'order_receive_mobile' );
		$order_receive_phone = I ( 'order_receive_phone' );
		$order_receive_postcode = I ( 'order_receive_postcode' );
		$remark = I ( 'remark' );
		$order_pay_account = I ( 'order_pay_account' );
		$logistics_status = I ( 'logistics_status' );
		
		if (! isset ( $order_no ) or empty ( $order_no )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $user_id ) or empty ( $user_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $user_account ) or empty ( $user_account )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_time ) or empty ( $order_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_freight ) or empty ( $order_freight )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_totalprice ) or empty ( $order_totalprice )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_payment ) or empty ( $order_payment )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_status ) or empty ( $order_status )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_status_update_time ) or empty ( $order_status_update_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_receive_address ) or empty ( $order_receive_address )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_receive_name ) or empty ( $order_receive_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_receive_mobile ) or empty ( $order_receive_mobile )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_receive_phone ) or empty ( $order_receive_phone )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_receive_postcode ) or empty ( $order_receive_postcode )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $remark ) or empty ( $remark )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_pay_account ) or empty ( $order_pay_account )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $logistics_status ) or empty ( $logistics_status )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Order->addModel ( $order_no, $user_id, $user_account, $order_time, $order_freight, $order_totalprice, $order_payment, $order_status, $order_status_update_time, $order_receive_address, $order_receive_name, $order_receive_mobile, $order_receive_phone, $order_receive_postcode, $remark, $order_pay_account, $logistics_status );
		$this->ajaxReturn ( $result );
	}
	// 删除
	public function deleteOrder() {
		$result = new DataResult ();
		$Order = new OrderModel ();
		$order_no = I ( 'order_no' );
		if (! isset ( $order_no ) or empty ( $order_no )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Order->deleteModel ( $order_no );
		$this->ajaxReturn ( $result );
	}
	// 编辑订单状态
	public function updateOrderStatus() {
		$result = new DataResult ();
		$Order = new OrderModel ();
		$order_no = I ( 'order_no' );
		$order_status = I ( 'order_status' );
		
		if (! isset ( $order_no ) or empty ( $order_no )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		
		if (! isset ( $order_status ) or empty ( $order_status )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		
		$result = $Order->updateModel ( $order_no, $order_status, time(), LogisticsStatus::unsend );
		$this->ajaxReturn ( $result );
	}
	// 编辑物流状态
	public function updateLogisticsStatus() {
		$result = new DataResult ();
		$Order = new OrderModel ();
		$order_no = I ( 'order_no' );
		$logistics_status = I ( 'logistics_status' );
	
		if (! isset ( $order_no ) or empty ( $order_no )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $logistics_status ) or empty ( $logistics_status )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Order->updateModel ( $order_no, OrderStatus::paid,time(), $logistics_status );
		$this->ajaxReturn ( $result );
	}
	// 获取单个
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
	
	// 分页查询列表
	public function searchOrder() {
		$result = new DataResult ();
		$Order = new OrderModel ();
		$keyname = I ( 'keyname' );
		$order_time1 = I ( 'stime' );
		$order_time2 = I ( 'etime' );
		$order_status = I ( 'order_status' );
		
		
		if (! isset ( $keyname ) ) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_time1 )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_time2 )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $order_status ) ) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$pageIndex = I ( 'pageindex', 0 );
		$pageSize = I ( 'pagesize', 10 );
		$result = $Order->searchByPage ($keyname, $order_time1, $order_time2, $order_status, $pageIndex, $pageSize );
		$this->ajaxReturn ( $result );
	}
}