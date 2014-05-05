<?php

namespace Home\Model;

use Think\Model;
use Common\Common\DataResult;
use Common\Common\ErrorType;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;

class ProductCategoryModel extends Model {
	protected $tableName = 'productcategory';
	// 增加分类
	public function addModel($cat_name,$parent_id,$status) {
		$result = new DataResult ();
		$data = array (
				'cat_name' => $cat_name,
				'parentid' => $parent_id,
				'status' => $status
		);
		$pid = $this->add ( $data );
		if ($pid > 0) {
			$result->Data = $this->find ( $pid );
			$result->ErrorMessage = '新增成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '新增失败';
		}
		return $result;
	}
	// 编辑分类
	public function updateModel($catid,$cat_name,$status) {
		$result = new DataResult ();
		$data = array (
				'cat_name' => $cat_name,
				'status' => $status
		);
		// 注意判断条件使用恒等式
		if ($this->where ( 'catid=%d', $catid )->save ( $data ) !== false) {
			$result->Data = $this->find ( $catid );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	//根据类别id获取某个类别信息
	public function getModel($catid){
		$result = new DataResult ();
		$result->Data=$this->where('catid=%d',$catid)->select();
		return $result;
	}
	//获取主类信息
	public  function searchMainCategory(){
		$result=new DataResult();
		$result->Data=$this->where('parentid=0')->select();
		return $result;
	}
	//根据主类id获取子分类
	public function searchSubcategory($catid){
		$result=new DataResult();
		$result->Data=$this->where('parentid=%d',$catid)->select();
		return $result;
	}
	/*  分页查询分类列表(包括上下级关系) */
	public function searchByPage($pageIndex, $pageSize) {
		$result = new PageDataResult ();
		$lastPageNum = $pageIndex * $pageSize;
		$conn = new Pdo();
		$objects = $conn->query ( "select g.*,c.cat_name as parent_name from gogojp_productcategory g left join (select cat_name,catid from gogojp_productcategory ) as c on g.parentid=c.catid order by create_time limit $lastPageNum,$pageSize" );
		$totalcount = $conn->query ( "select count(*) from gogojp_productcategory order by create_time" )[0]['count(*)'];
		$result->pageindex = $pageIndex;
		$result->pagesize = $pageSize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}