<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/13 0:08:46
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\StandardModel;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class StandardController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Standard控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 添加
	public function addStandard() {
		$result = new DataResult ();
		$Standard = new StandardModel ();
		
		$parent_name = I ( 'parent_name' );
		$standard_parent_id = I ( 'standard_parent_id' );
		$child_name = I ( 'child_name' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $parent_name ) or empty ( $parent_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'parent_name' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_parent_id ) or empty ( $standard_parent_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_parent_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $child_name ) or empty ( $child_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'child_name' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $Standard->addModel ( $parent_name, $standard_parent_id, $child_name, $create_time );
		$this->ajaxReturn ( $result );
	}
	// 删除
	public function deleteStandard() {
		$result = new DataResult ();
		$Standard = new StandardModel ();
		$standard_id = I ( 'standard_id' );
		if (! isset ( $standard_id ) or empty ( $standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $Standard->deleteModel ( $standard_id );
		$this->ajaxReturn ( $result );
	}
	// 编辑
	public function updateStandard() {
		$result = new DataResult ();
		$Standard = new StandardModel ();
		$parent_name = I ( 'parent_name' );
		$standard_parent_id = I ( 'standard_parent_id' );
		$child_name = I ( 'child_name' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $parent_name ) or empty ( $parent_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'parent_name' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_parent_id ) or empty ( $standard_parent_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_parent_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $child_name ) or empty ( $child_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'child_name' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $Standard->updateModel ( $parent_name, $standard_parent_id, $child_name, $create_time );
		$this->ajaxReturn ( $result );
	}
	// 获取单个
	public function getStandard() {
		$result = new DataResult ();
		$Standard = new StandardModel ();
		$standard_id = I ( 'standard_id' );
		if (! isset ( $standard_id ) or empty ( $standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $Standard->getModel ( $standard_id );
		$this->ajaxReturn ( $result );
	}
	
	// 分页查询列表
	public function searchStandard() {
		$result = new DataResult ();
		$Standard = new StandardModel ();
		$parent_name = I ( 'parent_name' );
		$standard_parent_id = I ( 'standard_parent_id' );
		$child_name = I ( 'child_name' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $parent_name ) or empty ( $parent_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'parent_name' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_parent_id ) or empty ( $standard_parent_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_parent_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $child_name ) or empty ( $child_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'child_name' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$pageIndex = I ( 'pageindex', 0 );
		$pageSize = I ( 'pagesize', 10 );
		$result = $Standard->searchByPage ( $parent_name, $standard_parent_id, $child_name, $create_time, $pageIndex, $pageSize );
		$this->ajaxReturn ( $result );
	}
}