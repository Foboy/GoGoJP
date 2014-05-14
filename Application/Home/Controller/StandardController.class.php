<?php

/**
 * @author zhengrunqiang
 * @email:653260669@qq.com
 * @date: 2014/5/14 22:06:38
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\StandardModel;

class StandardController extends Controller {
	//根据规格id查询分类
	public function searchCategoryByStandardId(){
		$standard_id=I('standard_id',0);
		$pageindex=I('pageIndex',0);
		$pagesize=I('pageSize',20);
		$standardmodel=new StandardModel();
		$this->ajaxReturn($standardmodel->searchCategoryByStandardId($standard_id, $pageindex, $pagesize));
	}
	// 根据规格id和分类id查询参数值
	public function searchParamterBySidAndCatid(){
		$standard_id=I('standard_id');
		$category_id=I('category_id');
		$standardmodel=new StandardModel();
		$this->ajaxReturn($standardmodel->searchParamterBySidAndCatid($standard_id, $category_id));
	}
	// 根据规格id和查询参数值列表（和分类无关）
	public function searchParamterBySid(){
		$standard_id=I('standard_id');
		$standardmodel=new StandardModel();
		$this->ajaxReturn($standardmodel->searchParamterBySid($standard_id));
	}
	//批量添加分类规格参数
	public function AddCatagoryStandardParameter($standard_id,$category_id,$parameter_names) {
	}
	//批量添加通用规格参数
	public function AddCommonStandardParameter($parameter_names){
	
	}
	//批量跟新规格参数状态
	public function UpdateStandardParameterStatus($standard_parameter_ids,$parameter_statuses){
		$standard_parameter_ids=I('standard_parameter_ids');
		$parameter_statuses=I('parameter_statuses');
	}
}