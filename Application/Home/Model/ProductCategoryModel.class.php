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
	public function addModel($cat_name, $parent_id, $status,$level) {
		$result = new DataResult ();
		$data = array (
				'cat_name' => $cat_name,
				'parentid' => $parent_id,
				'status' => $status ,
				'level'=>$level+1
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
	public function updateModel($catid, $cat_name, $status) {
		$result = new DataResult ();
		$data = array (
				'cat_name' => $cat_name,
				'status' => $status 
		);
		$map ['catid'] = $catid;
		// 注意判断条件使用恒等式
		if ($this->where ( $map )->save ( $data ) !== false) {
			$result->Data = $this->find ( $catid );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 根据类别id获取某个类别信息
	public function getModel($catid) {
		$result = new DataResult ();
		$map ['catid'] = $catid;
		$result->Data = $this->where ( $map )->select ();
		return $result;
	}
	// 获取主类信息
	public function searchMainCategory() {
		$result = new DataResult ();
		$result->Data = $this->where ( 'parentid=0' )->select ();
		return $result;
	}
	// 根据主类id获取子分类
	public function searchSubcategory($catid) {
		$result = new DataResult ();
		$map ['parentid'] = $catid;
		$result->Data = $this->where ( $map )->select ();
		return $result;
	}
	/* 分页查询分类列表(包括上下级关系) */
	public function searchByPage($pageIndex, $pageSize) {
		$result = new PageDataResult ();
		$lastPageNum = $pageIndex * $pageSize;
		$conn = new Pdo ();
		$maincats = ProductCategoryModel::searchMainCategory ();
		// var_dump($maincats);
		if ($maincats->Error == 0) {
			if (count ( $maincats->Data ) > 0) {
				$starcatid = $maincats->Data [0] ['catid'];
				$sql = "select * from gogojp_productcategory where FIND_IN_SET(catid, getChildLst($starcatid))";
				for($i = 1; $i < count ( $maincats->Data ); $i ++) {
					$catid = $maincats->Data [$i] ['catid'];
					$sql ="$sql union select * from gogojp_productcategory where FIND_IN_SET(catid, getChildLst($catid))";
				}
				$objects = $conn->query ( "select t.cat_name as parent_name,p.* from ( $sql) as p left join gogojp_productcategory as t on p.parentid=t.catid limit $lastPageNum,$pageSize" );
				$data = $conn->query ( "select count(*) totalcount from gogojp_productcategory order by create_time desc" );
				$totalcount = $data [0] ['totalcount'];
				$result->pageindex = $pageIndex;
				$result->pagesize = $pageSize;
				$result->Data = $objects;
				$result->totalcount = $totalcount;
			}
		}
		return $result;
	}
}