<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\ProductModel;

class ProductController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Product控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 新增商品
	public function addProduct() {
		$Product = new ProductModel ();
		$this->ajaxReturn($Product->addModel ());
	}
	// 删除商品
	public function deleteProdcut() {
	}
	// 编辑商品
	public function updateProduct() {
		$Product = new ProductModel ();
		$productid=I('productid');
		$this->ajaxReturn ( $Product->updateModel($productid));
	}
	//获取摸个商品信息
	public function getProduct(){
		$Product = new ProductModel ();
		$productid=I('productid');
		$this->ajaxReturn ( $Product->getModel($productid));
	}
	// 模糊分页查询商品
	public function searchProductByCondition() {
		$Product = new ProductModel ();
		$catid=I('catid',0);
		$product_name=I('product_name','','htmlspecialchars');
		$product_num=I('product_num','','htmlspecialchars');
		$pageIndex = I ('pageIndex', 0 );
		$pageSize = I ('pageSize', 10 );
		$this->ajaxReturn ( $Product->searchProductByCondition($catid,$product_name,$product_num,$pageIndex,$pageSize));
	}
}