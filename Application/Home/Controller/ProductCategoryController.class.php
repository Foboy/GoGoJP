<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\ProductCategoryModel;

class ProductCategoryController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的ProductCategory控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 添加商品类别 主类别 parentid=0
	public function addProductCategory() {
		$ProductCategory = new ProductCategoryModel ();
		$cat_name = I ( 'cat_name', '', 'htmlspecialchars' );
		$parent_id = I ( 'parent_id', 0 );
		$status = I ( 'status', 1 ); // 默认启用
		$this->ajaxReturn ( $ProductCategory->addModel ( $cat_name, $parent_id, $status ) );
	}
	// 删除分类
	public function deleteProductCategory() {
	}
	// 编辑类别
	public function updateProductCategory() {
		$ProductCategory = new ProductCategoryModel ();
		$catid = I ( 'catid' );
		$cat_name = I ( 'cat_name', '', 'htmlspecialchars' );//必填字段
		$status = I ( 'status',1 ); // 默认启用
		$this->ajaxReturn ( $ProductCategory->updateModel ( $catid, $cat_name, $status ) );
	}
	//获取摸个分类信息
	public function getProductCategory(){
		$ProductCategory = new ProductCategoryModel ();
		$catid=I('catid');
		$this->ajaxReturn($ProductCategory->getModel($catid));
	}
	/* 获取主分类列表信息 */
	public function searchMainCategory(){
		$ProductCategory = new ProductCategoryModel ();
		$this->ajaxReturn($ProductCategory->searchMainCategory());
	}
	//根据主类id获取子分类
	public function searchSubcategory(){
		$ProductCategory = new ProductCategoryModel ();
		$catid=I('catid');
		$this->ajaxReturn($ProductCategory->searchSubcategory($catid));
	}
	// 分页查询分类列表(包括上下级关系)
	public function searchProductCategory() {
		$ProductCategory = new ProductCategoryModel ();
		$pageIndex = I ('pageIndex', 0 );
		$pageSize = I ('pageSize', 10 );
		$this->ajaxReturn ( $ProductCategory->searchByPage ( $pageIndex, $pageSize ) );
	}
}