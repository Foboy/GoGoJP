<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/8 16:06:27
 */
namespace Home\Model;

use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class OrderItemModel extends Model {
	protected $tableName = 'orderitem';
	// 增加表中数据
	public function addModel($order_no, $productid, $buynumber, $prodcut_price, $product_name, $pic_url, $create_time, $type_remark, $product_num) {
		$result = new DataResult ();
		$data = array (
				':order_no' => $order_no,
				':productid' => $productid,
				':buynumber' => $buynumber,
				':prodcut_price' => $prodcut_price,
				':product_name' => $product_name,
				':pic_url' => $pic_url,
				':create_time' => $create_time,
				':type_remark' => $type_remark,
				':product_num' => $product_num 
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
		$map['id']=$id;
		if ($this->where ( $map )->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 编辑表中数据
	public function updateModel($id, $order_no, $productid, $buynumber, $prodcut_price, $product_name, $pic_url, $create_time, $type_remark, $product_num) {
		$result = new DataResult ();
		$data = array (
				':id' => $id,
				':order_no' => $order_no,
				':productid' => $productid,
				':buynumber' => $buynumber,
				':prodcut_price' => $prodcut_price,
				':product_name' => $product_name,
				':pic_url' => $pic_url,
				':create_time' => $create_time,
				':type_remark' => $type_remark,
				':product_num' => $product_num 
		);
		// 注意判断条件使用恒等式
		$map['id']=$id;
		if ($this->where ( $map )->save ( $data ) !== false) {
			$result->Data = $this->find ( $id );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 根据主键id获取某个专辑信息
	public function searchItemByOrderNO($order_no) {
		$result = new DataResult ();
		$map['order_no']=$order_no;
		$result->Data = $this->where ( $map)->select ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($order_no, $productid, $buynumber, $prodcut_price, $product_name, $pic_url, $create_time, $type_remark, $product_num, $pageindex, $pagesize) {
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$conn = new Pdo ();
		$objects = $conn->query ( " select id,order_no,productid,buynumber,prodcut_price,product_name,pic_url,create_time,type_remark,product_num from gogojp_orderitem where  ( order_no = :order_no or :order_no='' ) 
 and  ( productid = :productid or :productid=0 )  
 and  ( buynumber = :buynumber or :buynumber=0 ) 
 and  ( prodcut_price = :prodcut_price or :prodcut_price='' ) 
 and  ( product_name = :product_name or :product_name='' ) 
 and  ( pic_url = :pic_url or :pic_url='' ) 
 and  ( create_time = :create_time or :create_time='' ) 
 and  ( type_remark = :type_remark or :type_remark='' ) 
 and  ( product_num = :product_num or :product_num='' ) 
 limit $lastpagenum,$pagesize", array (
				':order_no' => $order_no,
				':productid' => $productid,
				':buynumber' => $buynumber,
				':prodcut_price' => $prodcut_price,
				':product_name' => $product_name,
				':pic_url' => $pic_url,
				':create_time' => $create_time,
				':type_remark' => $type_remark,
				':product_num' => $product_num 
		) );
		$data = $conn->query ( " select count(*) totalcount  from gogojp_orderitem where  ( order_no = :order_no or :order_no='' ) 
 and  ( productid = :productid or :productid=0 ) 
 and  ( buynumber = :buynumber or :buynumber=0 ) 
 and  ( prodcut_price = :prodcut_price or :prodcut_price='' ) 
 and  ( product_name = :product_name or :product_name='' ) 
 and  ( pic_url = :pic_url or :pic_url='' ) 
 and  ( create_time = :create_time or :create_time='' ) 
 and  ( type_remark = :type_remark or :type_remark='' ) 
 and  ( product_num = :product_num or :product_num='' ) 
", array (
				':order_no' => $order_no,
				':productid' => $productid,
				':buynumber' => $buynumber,
				':prodcut_price' => $prodcut_price,
				':product_name' => $product_name,
				':pic_url' => $pic_url,
				':create_time' => $create_time,
				':type_remark' => $type_remark,
				':product_num' => $product_num 
		) );
		$totalcount = $data [0] ['totalcout'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}