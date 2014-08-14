<?php

/**
 * @author zhengrunqiang
 * @email:653260669@qq.com
 * @date: 2014/5/14 22:04:05
 */
namespace Home\Model;

use Think\Model;
use Think\Db\Driver\Pdo;
use Common\Common\PageDataResult;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class StandardModel extends Model {
	// 根据规格id获取此规格下的商品分类
	public function searchCategoryByStandardId($standard_id, $pageindex, $pagesize) {
		$conn = new Pdo ();
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$conn = new Pdo ();
		$objects = $conn->query ( " select * from gogojp_productcategory where catid in( select 
  		  category_id from gogojp_category_r_standard_parameter where standard_id =:standard_id group by category_id order by create_time desc)
				limit $lastpagenum,$pagesize", array (
				':standard_id' => $standard_id 
		) );
		$data = $conn->query ( "select count(*) as totalcount from gogojp_productcategory where catid in( select 
			    category_id
			from
			    gogojp_category_r_standard_parameter
			where
			    standard_id = :standard_id
			group by category_id )  
		", array (
				':standard_id' => $standard_id 
		) );
		$totalcount = $data [0] ['totalcount'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
	// 根据规格id和分类id查询参数值列表（和分类相关）
	public function searchParamterBySidAndCatid($standard_id, $category_id) {
		$result = new DataResult ();
		$conn = new Pdo ();
		$data = $conn->query ( "select sp.* from(select 
		    parameter_id
		from
		    gogojp_category_r_standard_parameter
		where
		    standard_id =:standard_id and category_id=:category_id  ) as c left join gogojp_standard_parameter as sp on c.parameter_id=sp.standard_parameter_id
		", array (
				':standard_id' => $standard_id,
				':category_id' => $category_id
		) );
		$result->Data = $data;
		return $result;
	}
	// 根据规格id和查询参数值列表（和分类无关）
	public function searchParamterBySid($standard_id) {
		$result = new DataResult ();
		$conn = new Pdo ();
		$data = $conn->query ( "select sp.* from (select standard_id from gogojp_standard where standard_id=:standard_id) as s left join gogojp_standard_parameter as sp on s.standard_id=sp.belong_standard_id", array (
				':standard_id' => $standard_id 
		) );
		$result->Data = $data;
		return $result;
	}
	//添加分类规格参数
	public function AddCatagoryStandardParameter($standard_id,$category_id,$parameter_name) {
		$result=new DataResult();
		$StandardParameter=new StandardParameterModel();
		$parameter_id=$StandardParameter->addModel($parameter_name, $standard_id);
		if($parameter_id>0){
			$CategoryRStandardParameter=new CategoryRStandardParameterModel();
			if($CategoryRStandardParameter->addModel($standard_id, $parameter_id, $category_id)->Error==0){
				$result->ErrorMessage='新增成功';
			}else 
			{
				$result->ErrorMessage='新增失败';
				$result->Error=ErrorType::Failed;
			}
		}else 
		{
			$result->ErrorMessage='新增失败';
			$result->Error=ErrorType::Failed;
		}
		return $result;
		
	}
	//添加通用规格参数
	public function AddCommonStandardParameter($parameter_name,$standard_id){
		$result=new DataResult();
		$StandardParameter=new StandardParameterModel();
		$parameter_id=$StandardParameter->addModel($parameter_name, $standard_id);
		if($parameter_id>0){
			$result->ErrorMessage='新增成功';
		}else
		{
			$result->ErrorMessage='新增失败';
			$result->Error=ErrorType::Failed;
		}
		return $result;
	}
	//跟新规格参数状态
	public function UpdateStandardParameterStatus($standard_parameter_id,$parameter_status){
		$result=new DataResult();
		$StandardParameter=new StandardParameterModel();
		$value=$StandardParameter->updateModelStatus($standard_parameter_id, $parameter_status);
		if($value>0){
			$result->ErrorMessage='新增成功';
		}else
		{
			$result->ErrorMessage='新增失败';
			$result->Error=ErrorType::Failed;
		}
		return $result;
	}
}