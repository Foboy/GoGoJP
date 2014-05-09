<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/9 11:55:12
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\CustomerAdvisoryModel;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class CustomerAdvisoryController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的CustomerAdvisory控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 添加
	public function addCustomerAdvisory() {
		$result = new DataResult ();
		$CustomerAdvisory = new CustomerAdvisoryModel ();
		
		$customer_id = I ( 'customer_id' );
		$customer_account = I ( 'customer_account' );
		$customer_nickname = I ( 'customer_nickname' );
		$create_time = I ( 'create_time' );
		$isread = I ( 'isread' );
		
		if (! isset ( $customer_id ) or empty ( $customer_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $customer_account ) or empty ( $customer_account )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $customer_nickname ) or empty ( $customer_nickname )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $isread ) or empty ( $isread )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $CustomerAdvisory->addModel ( $customer_id, $customer_account, $customer_nickname, $create_time, $isread );
		$this->ajaxReturn ( $result );
	}
	// 删除
	public function deleteCustomerAdvisory() {
		$result = new DataResult ();
		$CustomerAdvisory = new CustomerAdvisoryModel ();
		$advisory_id = I ( 'advisory_id' );
		if (! isset ( $advisory_id ) or empty ( $advisory_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $CustomerAdvisory->deleteModel ( $advisory_id );
		$this->ajaxReturn ( $result );
	}
	// 编辑
	public function updateCustomerAdvisory() {
		$result = new DataResult ();
		$CustomerAdvisory = new CustomerAdvisoryModel ();
		$customer_id = I ( 'customer_id' );
		$customer_account = I ( 'customer_account' );
		$customer_nickname = I ( 'customer_nickname' );
		$create_time = I ( 'create_time' );
		$isread = I ( 'isread' );
		
		if (! isset ( $customer_id ) or empty ( $customer_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $customer_account ) or empty ( $customer_account )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $customer_nickname ) or empty ( $customer_nickname )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $isread ) or empty ( $isread )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $CustomerAdvisory->updateModel ( $customer_id, $customer_account, $customer_nickname, $create_time, $isread );
		$this->ajaxReturn ( $result );
	}
	// 获取单个
	public function getCustomerAdvisory() {
		$result = new DataResult ();
		$CustomerAdvisory = new CustomerAdvisoryModel ();
		$advisory_id = I ( 'advisory_id' );
		if (! isset ( $advisory_id ) or empty ( $advisory_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $CustomerAdvisory->getModel ( $advisory_id );
		$this->ajaxReturn ( $result );
	}
	
	// 分页查询列表
	public function searchCustomerAdvisory() {
		$result = new DataResult ();
		$CustomerAdvisory = new CustomerAdvisoryModel ();
		$customer_id = I ( 'customer_id' );
		$customer_account = I ( 'customer_account' );
		$customer_nickname = I ( 'customer_nickname' );
		$create_time = I ( 'create_time' );
		$isread = I ( 'isread' );
		
		if (! isset ( $customer_id ) or empty ( $customer_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $customer_account ) or empty ( $customer_account )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $customer_nickname ) or empty ( $customer_nickname )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $isread ) or empty ( $isread )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$pageIndex = I ( 'pageindex', 0 );
		$pageSize = I ( 'pagesize', 10 );
		$result = $CustomerAdvisory->searchByPage ( $customer_id, $customer_account, $customer_nickname, $create_time, $isread, $pageIndex, $pageSize );
		$this->ajaxReturn ( $result );
	}
}