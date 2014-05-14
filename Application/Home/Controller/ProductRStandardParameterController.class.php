<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/14 11:54:14
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\ProductRStandardParameterModel;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class ProductRStandardParameterController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的ProductRStandardParameter控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 添加
	public function addProductRStandardParameter() {
		$result = new DataResult ();
		$ProductRStandardParameter = new ProductRStandardParameterModel ();
		
		$product_id = I ( 'product_id' );
		$standard_id = I ( 'standard_id' );
		$standard_parameter_id = I ( 'standard_parameter_id' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $product_id ) or empty ( $product_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'product_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_id ) or empty ( $standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_parameter_id ) or empty ( $standard_parameter_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_parameter_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $ProductRStandardParameter->addModel ( $product_id, $standard_id, $standard_parameter_id, $create_time );
		$this->ajaxReturn ( $result );
	}
	// 删除
	public function deleteProductRStandardParameter() {
		$result = new DataResult ();
		$ProductRStandardParameter = new ProductRStandardParameterModel ();
		$id = I ( 'id' );
		if (! isset ( $id ) or empty ( $id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $ProductRStandardParameter->deleteModel ( $id );
		$this->ajaxReturn ( $result );
	}
	// 编辑
	public function updateProductRStandardParameter() {
		$result = new DataResult ();
		$ProductRStandardParameter = new ProductRStandardParameterModel ();
		$product_id = I ( 'product_id' );
		$standard_id = I ( 'standard_id' );
		$standard_parameter_id = I ( 'standard_parameter_id' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $product_id ) or empty ( $product_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'product_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_id ) or empty ( $standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_parameter_id ) or empty ( $standard_parameter_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_parameter_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $ProductRStandardParameter->updateModel ( $product_id, $standard_id, $standard_parameter_id, $create_time );
		$this->ajaxReturn ( $result );
	}
	// 获取单个
	public function getProductRStandardParameter() {
		$result = new DataResult ();
		$ProductRStandardParameter = new ProductRStandardParameterModel ();
		$id = I ( 'id' );
		if (! isset ( $id ) or empty ( $id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $ProductRStandardParameter->getModel ( $id );
		$this->ajaxReturn ( $result );
	}
	
	// 分页查询列表
	public function searchProductRStandardParameter() {
		$result = new DataResult ();
		$ProductRStandardParameter = new ProductRStandardParameterModel ();
		$product_id = I ( 'product_id' );
		$standard_id = I ( 'standard_id' );
		$standard_parameter_id = I ( 'standard_parameter_id' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $product_id ) or empty ( $product_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'product_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_id ) or empty ( $standard_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_parameter_id ) or empty ( $standard_parameter_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_parameter_id' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		$pageIndex = I ( 'pageindex', 0 );
		$pageSize = I ( 'pagesize', 10 );
		$result = $ProductRStandardParameter->searchByPage ( $product_id, $standard_id, $standard_parameter_id, $create_time, $pageIndex, $pageSize );
		$this->ajaxReturn ( $result );
	}
}