<?php

namespace Home\Model;

use Think\Model;
use Common\Common\DataResult;
use Common\Common\ErrorType;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;

class ProductModel extends Model {
	protected $tableName = 'productinfo';
	// 增加单个商品
	public function addModel($data) {
		$result = new DataResult ();
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
	// 删除单个商品
	public function deleteModel($productid) {
	}
	// 更新某个商品信息
	public function updateModel($productid) {
		$result = new DataResult ();
		$data = array (
				'catid' => I ( 'catid', 0 ),
				'sign' => I ( 'sign', '', 'htmlspecialchars' ),
				'product_name' => I ( 'product_name' ),
				'old_price' => I ( 'old_price' ),
				'new_price' => I ( 'new_price' ),
				'small_pic' => I ( 'small_pic' ),
				'big_pic' => I ( 'big_pic' ),
				'product_description' => I ( 'product_description' ),
				'product_count' => I ( 'product_count', 0 ) 
		);
		// 注意判断条件使用恒等式
		if ($this->where ( 'productid=%d', $productid )->save ( $data ) !== false) {
			$result->Data = $this->find ( $productid );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 获取单个商品信息
	public function getModel($productid) {
		$result = new DataResult ();
		$result->Data = $this->where ( 'productid=%d', $productid )->select ();
		return $result;
	}
	// 根据条件分页模糊查询商品列表
	public function searchProductByCondition($catid, $keyname, $pageIndex, $pageSize) {
		$result = new PageDataResult ();
		$lastPageNum = $pageIndex * $pageSize;
		$skey = " (1=1) ";
		if (! empty ( $keyname )) {
			$skey = " ( ( t.product_name like '%$keyname%' )  or  ( t.product_num  like '%$keyname%' ) )";
		}
		$conn = new Pdo ();
	 
		$objects = $conn->query ( "select * from(SELECT p.*,c.cat_name as category_name FROM gogojp_productinfo as p left join gogojp_productcategory as c on p.catid=c.catid) as t where (t.catid=:catid or 0=:catid) and $skey order by t.create_time desc limit $lastPageNum,$pageSize", array (
				':catid' => $catid 
		) );
		$data = $conn->query ( "select count(*) as totalcount from(SELECT p.*,c.cat_name as category_name FROM gogojp_productinfo as p left join gogojp_productcategory as c on p.catid=c.catid) as t where (t.catid=:catid or 0=:catid) and $skey order by t.create_time desc ", array (
				':catid' => $catid 
		) );
		$result->pageindex = $pageIndex;
		$result->pagesize = $pageSize;
		$result->Data = $objects;
		$result->totalcount = $data [0] ['totalcount'];
		return $result;
	}
	// 更新某个商品信息
	public function updateClickNum($productid) {
		$result = new DataResult ();
		$conn = new Pdo ();
	 
		$objects = $conn->query ( "update gogojp_productinfo set click_num=click_num+1 where productid = :productid", array (
				':productid' => $productid 
		) );
		
		if ($objects) {
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
}