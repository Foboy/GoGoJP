<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\ProductModel;
use Home\Model\ProductCategoryModel;
use Common\Common\DataResult;
use Home\Model\ProductRStandardParameterModel;
use Common\Common\ErrorType;

class ProductController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Product控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 新增商品
	public function addProduct() {
		$result = new DataResult();
		$Product = new ProductModel ();
		$data = array (
				'parent_catid'=>I('parent_catid'),
				'catid' => I ( 'catid', 0 ),
				'product_tag_id' => I ( 'product_tag_id', 0),
				'product_name' => I ( 'product_name' ),
				'old_price' => I ( 'old_price' ),
				'new_price' => I ( 'new_price' ),
				'small_pic' => I ( 'small_pic' ),
				'big_pic' => I ( 'big_pic' ),
				'product_description' => $_POST ['product_description'],
				'product_count' => I ( 'product_count', 0 ),
				'product_num' => time () 
		);
		$sizeparametersids=I('sizeparametersids','');
		$colorparametersids=I('colorparametersids','');
		$pid=$Product->addModel ($data );
		if($pid>0){
			$this->AddParameters($pid, 1, $sizeparametersids);
			$this->AddParameters($pid, 2, $colorparametersids);
		}else 
		{
			$result->Error=ErrorType::Failed;
		}
		$this->ajaxReturn($result);
	}
	// 删除商品
	public function deleteProdcut() {
	}
	// 编辑商品
	public function updateProduct() {
		$Product = new ProductModel ();
		$productid = I ( 'productid' );
		$sizeparametersids=I('sizeparametersids','');
		$colorparametersids=I('colorparametersids','');
		$rows= $this->DeleteProductStandardParameters($productid);
		if($rows>0){
			$this->AddParameters($productid, 1, $sizeparametersids);
			$this->AddParameters($productid, 2, $colorparametersids);
			$this->ajaxReturn ( $Product->updateModel ( $productid ));
		}
	}
	// 获取摸个商品信息
	public function getProduct() {
		$result = new DataResult ();
		$Product = new ProductModel ();
		$Categroy = new ProductCategoryModel ();
		$ProductRStandardParameterModel=new ProductRStandardParameterModel();
		$productid = I ( 'productid' );
		$product = array ();
		$maincategory = array ();
		$subcategory = array ();
		$ChoosecolorParameters=array();
		$ChoosesizeParameters=array();
		if ($Product->getModel ( $productid )->Error == 0) {
			$product = $Product->getModel ( $productid )->Data;
			$maincategory = $Categroy->getModel ( $product ['parent_catid'] )->Data;
			if ($product ['catid'] > 0) {
				$subcategory = $Categroy->getModel ( $product ['catid'] )->Data;
			}
		}
		$ChoosecolorParameters=$ProductRStandardParameterModel->searchByPage($productid, 2, '', '', 0, 100)->Data;
		$ChoosesizeParameters=$ProductRStandardParameterModel->searchByPage($productid, 1, '', '', 0, 100)->Data;
		$result->Data = array (
				"product" => $product,
				"maincategory" => $maincategory,
				"subcategory" => $subcategory ,
				"ChoosecolorParameters" =>$ChoosecolorParameters,
				"ChoosesizeParameters" =>$ChoosesizeParameters
		);
		$this->ajaxReturn ( $result );
	}
	// 模糊分页查询商品
	public function searchProductByCondition() {
		$Product = new ProductModel ();
		$parent_catid=I('parent_catid',0);
		$catid = I ( 'catid', 0 );
		$keyname = I ( 'keyname', '', 'htmlspecialchars' );
		$pageIndex = I ( 'pageIndex', 0 );
		$pageSize = I ( 'pageSize', 10 );
		$this->ajaxReturn ( $Product->searchProductByCondition ($parent_catid, $catid, $keyname, $pageIndex, $pageSize ) );
	}
	//关联商品规格参数
	public  function AddParameters($pid,$standardid,$parameterids){
		$ProductRStandardParameterModel=new ProductRStandardParameterModel();
		$parameterid_array=explode(',',trim($parameterids,'') );
		if (count ($parameterid_array ) > 0 && $parameterid_array[0]!='') {
			for($i = 0; $i < count ( $parameterid_array ); $i ++) {
				if($parameterid_array[$i]!=''){
				$ProductRStandardParameterModel->addModel($pid, $standardid, $parameterid_array[$i]);
				}
			}
		}
	}
	//删除商品关联的规格参数
	public function DeleteProductStandardParameters($pid)
	{
		$result=new DataResult();
		$ProductRStandardParameterModel=new ProductRStandardParameterModel();
		$rows= $ProductRStandardParameterModel->deleteModel($pid);
		return $result;
	}
	
	//获取商品相关的关联参数
	public function SerachProductStandardParameters()
	{
		$pid=I('pid',0);
		$stardard_id=I('stardard_id',0);
		$ProductRStandardParameterModel=new ProductRStandardParameterModel();
		$this->ajaxReturn($ProductRStandardParameterModel->searchByPage($pid, $stardard_id, '', '', 0, 100)) ;
		
	}
}