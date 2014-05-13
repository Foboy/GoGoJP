<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/13 0:09:23
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\ProductRStandardModel;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class ProductRStandardController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的ProductRStandard控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 添加
	public function addProductRStandard() {
		$result = new DataResult ();
		$ProductRStandard = new ProductRStandardModel ();
		
		$product_id = I ( 'product_id' );
		$standard_id = I ( 'standard_id' );
		$create_time = I ( 'create_time' );
		$standard_parent_id = I ( 'standard_parent_id' );
		
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
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_parent_id ) or empty ( $standard_parent_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_parent_id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $ProductRStandard->addModel ( $product_id, $standard_id, $create_time, $standard_parent_id );
		$this->ajaxReturn ( $result );
	}
	// 删除
	public function deleteProductRStandard() {
		$result = new DataResult ();
		$ProductRStandard = new ProductRStandardModel ();
		$id = I ( 'id' );
		if (! isset ( $id ) or empty ( $id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $ProductRStandard->deleteModel ( $id );
		$this->ajaxReturn ( $result );
	}
	// 编辑
	public function updateProductRStandard() {
		$result = new DataResult ();
		$ProductRStandard = new ProductRStandardModel ();
		$product_id = I ( 'product_id' );
		$standard_id = I ( 'standard_id' );
		$create_time = I ( 'create_time' );
		$standard_parent_id = I ( 'standard_parent_id' );
		
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
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_parent_id ) or empty ( $standard_parent_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_parent_id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $ProductRStandard->updateModel ( $product_id, $standard_id, $create_time, $standard_parent_id );
		$this->ajaxReturn ( $result );
	}
	// 获取单个
	public function getProductRStandard() {
		$result = new DataResult ();
		$ProductRStandard = new ProductRStandardModel ();
		$id = I ( 'id' );
		if (! isset ( $id ) or empty ( $id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'id' params error";
			$this->ajaxReturn ( $result );
		}
		$result = $ProductRStandard->getModel ( $id );
		$this->ajaxReturn ( $result );
	}
	
	// 分页查询列表
	public function searchProductRStandard() {
		$result = new DataResult ();
		$ProductRStandard = new ProductRStandardModel ();
		$product_id = I ( 'product_id' );
		$standard_id = I ( 'standard_id' );
		$create_time = I ( 'create_time' );
		$standard_parent_id = I ( 'standard_parent_id' );
		
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
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'create_time' params error";
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $standard_parent_id ) or empty ( $standard_parent_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$result->ErrorMessage = "'standard_parent_id' params error";
			$this->ajaxReturn ( $result );
		}
		$pageIndex = I ( 'pageindex', 0 );
		$pageSize = I ( 'pagesize', 10 );
		$result = $ProductRStandard->searchByPage ( $product_id, $standard_id, $create_time, $standard_parent_id, $pageIndex, $pageSize );
		$this->ajaxReturn ( $result );
	}
}