<?php

/**
 * @author zhengrunqiang
 * @email:653260669@qq.com
 * @date: 2014/5/14 22:06:38
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\StandardModel;
use Common\Common\ErrorType;
use Common\Common\DataResult;

class StandardController extends Controller {
	// 根据规格id查询分类
	public function searchCategoryByStandardId() {
		$standard_id = I ( 'standard_id', 0 );
		$pageindex = I ( 'pageIndex', 0 );
		$pagesize = I ( 'pageSize', 20 );
		$standardmodel = new StandardModel ();
		$this->ajaxReturn ( $standardmodel->searchCategoryByStandardId ( $standard_id, $pageindex, $pagesize ) );
	}
	// 根据规格id和分类id查询参数值
	public function searchParamterBySidAndCatid() {
		$standard_id = I ( 'standard_id' );
		$category_id = I ( 'category_id' );
		$standardmodel = new StandardModel ();
		$this->ajaxReturn ( $standardmodel->searchParamterBySidAndCatid ( $standard_id, $category_id ) );
	}
	// 根据规格id和查询参数值列表（和分类无关）
	public function searchParamterBySid() {
		$standard_id = I ( 'standard_id' );
		$standardmodel = new StandardModel ();
		$this->ajaxReturn ( $standardmodel->searchParamterBySid ( $standard_id ) );
	}
	// 批量添加分类规格参数
	public function AddCatagoryStandardParameters() {
		$result = new DataResult ();
		$standard_id = I ( 'standard_id' );
		$category_id = I ( 'category_id' );
		$parameter_names = I ( 'parameter_names' );
		if (! isset ( $standard_id ) or empty ( $standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $category_id ) or empty ( $category_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'category_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $parameter_names ) or empty ( $parameter_names )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'parameter_names' params error";
			$this->ajaxReturn ( $result );
		}
		$standardmodel = new StandardModel ();
		$parameterArray = explode ( ',', $parameter_names );
		if (count ( $parameterArray ) > 0) {
			for($i = 0; $i < count ( $parameterArray ); $i ++) {
				$standardmodel->AddCatagoryStandardParameter ( $standard_id, $category_id, $parameterArray [$i] );
			}
			$this->ajaxReturn ( $result );
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '添加失败';
			$this->ajaxReturn ( $result );
		}
	}
	// 批量添加通用规格参数
	public function AddCommonStandardParameter() {
		$result = new DataResult ();
		$parameter_names=I('parameter_names');
		$standard_id=I('standard_id');
		if (! isset ( $parameter_names ) or empty ( $parameter_names )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'parameter_names' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_id ) or empty ( $standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		$standardmodel = new StandardModel ();
		$parameterArray = explode ( ',', $parameter_names );
		if (count ( $parameterArray ) > 0) {
			for($i = 0; $i < count ( $parameterArray ); $i ++) {
				$standardmodel->AddCommonStandardParameter($parameterArray [$i] , $standard_id);
			}
			$this->ajaxReturn ( $result );
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '添加失败';
			$this->ajaxReturn ( $result );
		}
	}
	// 批量跟新规格参数状态
	public function UpdateStandardParameterStatus($standard_parameter_ids, $parameter_statuses) {
		$standard_parameter_ids = I ( 'standard_parameter_ids' );
		$parameter_statuses = I ( 'parameter_statuses' );
	}
}