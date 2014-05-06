
<?php

namespace Home\Model;

use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class OrderitemModel extends Model {
	protected $tableName = 'orderitem';
	// 增加表中数据
	public function addModel($user_id,$orderid,$productid,$buynumber,$prodcut_price,$product_name,$big_pic,$small_pic,$create_time) {
		$result = new DataResult ();
		$data = array (
':user_id' => $user_id,
                   ':orderid' => $orderid,
                   ':productid' => $productid,
                   ':buynumber' => $buynumber,
                   ':prodcut_price' => $prodcut_price,
                   ':product_name' => $product_name,
                   ':big_pic' => $big_pic,
                   ':small_pic' => $small_pic,
                   ':create_time' => $create_time
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
	// 删除表中数据
	public function deleteModel($id) {
		$result = new DataResult ();
		if ($this->where ( 'id=%d', $id )->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 编辑表中数据
	public function updateModel($id,$user_id,$orderid,$productid,$buynumber,$prodcut_price,$product_name,$big_pic,$small_pic,$create_time) {
		$result = new DataResult ();
		$data = array (
':id' => $id,
                   ':user_id' => $user_id,
                   ':orderid' => $orderid,
                   ':productid' => $productid,
                   ':buynumber' => $buynumber,
                   ':prodcut_price' => $prodcut_price,
                   ':product_name' => $product_name,
                   ':big_pic' => $big_pic,
                   ':small_pic' => $small_pic,
                   ':create_time' => $create_time
		);
		// 注意判断条件使用恒等式
		if ($this->where ( 'id=%d', $id )->save ( $data ) !== false) {
			$result->Data = $this->find ( $id );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 根据主键id获取某个专辑信息
	public function getModel($id) {
		$result = new DataResult ();
		$result->Data = $this->where ( 'id=%d', $id )->select ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($user_id,$orderid,$productid,$buynumber,$prodcut_price,$product_name,$big_pic,$small_pic,$create_time, $pageindex, $pagesize) {
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$conn = new Pdo ();
		$objects = $conn->query ( " select id,user_id,orderid,productid,buynumber,prodcut_price,product_name,big_pic,small_pic,create_time from gogojp_orderitem where  ( user_id = :user_id or :user_id=0 ) 
 and  ( orderid = :orderid or :orderid=0 ) 
 and  ( productid = :productid or :productid=0 )  
 and  ( buynumber = :buynumber or :buynumber=0 ) 
 and  ( prodcut_price = :prodcut_price or :prodcut_price='' ) 
 and  ( product_name = :product_name or :product_name='' ) 
 and  ( big_pic = :big_pic or :big_pic='' ) 
 and  ( small_pic = :small_pic or :small_pic='' ) 
 and  ( create_time = :create_time or :create_time='' ) 
 limit $lastpagenum,$pagesize", array (
':user_id' => $user_id,
                   ':orderid' => $orderid,
                   ':productid' => $productid,
                   ':buynumber' => $buynumber,
                   ':prodcut_price' => $prodcut_price,
                   ':product_name' => $product_name,
                   ':big_pic' => $big_pic,
                   ':small_pic' => $small_pic,
                   ':create_time' => $create_time
			)  );
		$data = $conn->query ( " select count(*) totalcount  from gogojp_orderitem where  ( user_id = :user_id or :user_id=0 ) 
 and  ( orderid = :orderid or :orderid=0 ) 
 and  ( productid = :productid or :productid=0 ) 
 and  ( buynumber = :buynumber or :buynumber=0 ) 
 and  ( prodcut_price = :prodcut_price or :prodcut_price='' ) 
 and  ( product_name = :product_name or :product_name='' ) 
 and  ( big_pic = :big_pic or :big_pic='' ) 
 and  ( small_pic = :small_pic or :small_pic='' ) 
 and  ( create_time = :create_time or :create_time='' ) 
", array (
':user_id' => $user_id,
                   ':orderid' => $orderid,
                   ':productid' => $productid,
                   ':buynumber' => $buynumber,
                   ':prodcut_price' => $prodcut_price,
                   ':product_name' => $product_name,
                   ':big_pic' => $big_pic,
                   ':small_pic' => $small_pic,
                   ':create_time' => $create_time
			)  );
		$totalcount=$data[0]['totalcout'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}