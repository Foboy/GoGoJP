<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/13 22:05:55
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\CategoryRStandardParameterModel;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class CategoryRStandardParameterController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的CategoryRStandardParameter控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 添加
	public function addCategoryRStandardParameter() {
		$result = new DataResult ();
		$CategoryRStandardParameter = new CategoryRStandardParameterModel() ;
		
		$standard_id = I ( 'standard_id' );
		$parameter_id = I ( 'parameter_id' );
		$category_id = I ( 'category_id' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $standard_id ) or empty ( $standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $parameter_id ) or empty ( $parameter_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'parameter_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $category_id ) or empty ( $category_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'category_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $CategoryRStandardParameter->addModel ( $standard_id, $parameter_id, $category_id, $create_time );
		$this->ajaxReturn ( $result );
	}
	// 删除
	public function deleteCategoryRStandardParameter() {
		$result = new DataResult ();
		$CategoryRStandardParameter = new CategoryRStandardParameterModel ();
		$id = I ( 'id' );
		if (! isset ( $id ) or empty ( $id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $CategoryRStandardParameter->deleteModel ( $id );
		$this->ajaxReturn ( $result );
	}
	// 编辑
	public function updateCategoryRStandardParameter() {
		$result = new DataResult ();
		$CategoryRStandardParameter = new CategoryRStandardParameterModel ();
		$standard_id = I ( 'standard_id' );
		$parameter_id = I ( 'parameter_id' );
		$category_id = I ( 'category_id' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $standard_id ) or empty ( $standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $parameter_id ) or empty ( $parameter_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'parameter_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $category_id ) or empty ( $category_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'category_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $CategoryRStandardParameter->updateModel ( $standard_id, $parameter_id, $category_id, $create_time );
		$this->ajaxReturn ( $result );
	}
	// 获取单个
	public function getCategoryRStandardParameter() {
		$result = new DataResult ();
		$CategoryRStandardParameter = new CategoryRStandardParameterModel ();
		$id = I ( 'id' );
		if (! isset ( $id ) or empty ( $id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $CategoryRStandardParameter->getModel ( $id );
		$this->ajaxReturn ( $result );
	}
	
	// 分页查询列表
	public function searchCategoryRStandardParameter() {
		$result = new DataResult ();
		$CategoryRStandardParameter = new CategoryRStandardParameterModel ();
		$standard_id = I ( 'standard_id' );
		$parameter_id = I ( 'parameter_id' );
		$category_id = I ( 'category_id' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $standard_id ) or empty ( $standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $parameter_id ) or empty ( $parameter_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'parameter_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $category_id ) or empty ( $category_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'category_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$pageIndex = I ( 'pageindex', 0 );
		$pageSize = I ( 'pagesize', 10 );
		$result = $CategoryRStandardParameter->searchByPage ( $standard_id, $parameter_id, $category_id, $create_time, $pageIndex, $pageSize );
		$this->ajaxReturn ( $result );
	}
	
}