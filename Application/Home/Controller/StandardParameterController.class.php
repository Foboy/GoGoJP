<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/13 22:07:42
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\StandardParameterModel;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class StandardParameterController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的StandardParameter控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 添加
	public function addStandardParameter() {
		$result = new DataResult ();
		$StandardParameter = new StandardParameterModel ();
		
		$parameter_name = I ( 'parameter_name' );
		$belong_standard_id = I ( 'belong_standard_id' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $parameter_name ) or empty ( $parameter_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'parameter_name' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $belong_standard_id ) or empty ( $belong_standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'belong_standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $StandardParameter->addModel ( $parameter_name, $belong_standard_id, $create_time );
		$this->ajaxReturn ( $result );
	}
	// 删除
	public function deleteStandardParameter() {
		$result = new DataResult ();
		$StandardParameter = new StandardParameterModel ();
		$standard_parameter_id = I ( 'standard_parameter_id' );
		if (! isset ( $standard_parameter_id ) or empty ( $standard_parameter_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_parameter_id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $StandardParameter->deleteModel ( $standard_parameter_id );
		$this->ajaxReturn ( $result );
	}
	// 编辑
	public function updateStandardParameter() {
		$result = new DataResult ();
		$StandardParameter = new StandardParameterModel ();
		$parameter_name = I ( 'parameter_name' );
		$belong_standard_id = I ( 'belong_standard_id' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $parameter_name ) or empty ( $parameter_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'parameter_name' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $belong_standard_id ) or empty ( $belong_standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'belong_standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $StandardParameter->updateModel ( $parameter_name, $belong_standard_id, $create_time );
		$this->ajaxReturn ( $result );
	}
	// 获取单个
	public function getStandardParameter() {
		$result = new DataResult ();
		$StandardParameter = new StandardParameterModel ();
		$standard_parameter_id = I ( 'standard_parameter_id' );
		if (! isset ( $standard_parameter_id ) or empty ( $standard_parameter_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_parameter_id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $StandardParameter->getModel ( $standard_parameter_id );
		$this->ajaxReturn ( $result );
	}
	
	// 分页查询列表
	public function searchStandardParameter() {
		$result = new DataResult ();
		$StandardParameter = new StandardParameterModel ();
		$parameter_name = I ( 'parameter_name' );
		$belong_standard_id = I ( 'belong_standard_id' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $parameter_name ) or empty ( $parameter_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'parameter_name' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $belong_standard_id ) or empty ( $belong_standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'belong_standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$pageIndex = I ( 'pageindex', 0 );
		$pageSize = I ( 'pagesize', 10 );
		$result = $StandardParameter->searchByPage ( $parameter_name, $belong_standard_id, $create_time, $pageIndex, $pageSize );
		$this->ajaxReturn ( $result );
	}
}