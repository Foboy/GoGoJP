
<?php

namespace Home\Model;

use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class OrderModel extends Model {
	protected $tableName = 'order';
	// 增加表中数据
	public function addModel($user_id,$order_time,$order_freight,$order_totalprice,$order_payment,$order_status,$order_status_update_time,$order_receive_address,$order_receive_name,$order_receive_mobile,$order_receive_phone,$order_receive_postcode) {
		$result = new DataResult ();
		$data = array (
':user_id' => $user_id,
                   ':order_time' => $order_time,
                   ':order_freight' => $order_freight,
                   ':order_totalprice' => $order_totalprice,
                   ':order_payment' => $order_payment,
                   ':order_status' => $order_status,
                   ':order_status_update_time' => $order_status_update_time,
                   ':order_receive_address' => $order_receive_address,
                   ':order_receive_name' => $order_receive_name,
                   ':order_receive_mobile' => $order_receive_mobile,
                   ':order_receive_phone' => $order_receive_phone,
                   ':order_receive_postcode' => $order_receive_postcode
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
	public function deleteModel($orderid) {
		$result = new DataResult ();
		if ($this->where ( 'orderid=%d', $orderid )->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 编辑表中数据
	public function updateModel($orderid,$user_id,$order_time,$order_freight,$order_totalprice,$order_payment,$order_status,$order_status_update_time,$order_receive_address,$order_receive_name,$order_receive_mobile,$order_receive_phone,$order_receive_postcode) {
		$result = new DataResult ();
		$data = array (
':orderid' => $orderid,
                   ':user_id' => $user_id,
                   ':order_time' => $order_time,
                   ':order_freight' => $order_freight,
                   ':order_totalprice' => $order_totalprice,
                   ':order_payment' => $order_payment,
                   ':order_status' => $order_status,
                   ':order_status_update_time' => $order_status_update_time,
                   ':order_receive_address' => $order_receive_address,
                   ':order_receive_name' => $order_receive_name,
                   ':order_receive_mobile' => $order_receive_mobile,
                   ':order_receive_phone' => $order_receive_phone,
                   ':order_receive_postcode' => $order_receive_postcode
		);
		// 注意判断条件使用恒等式
		if ($this->where ( 'orderid=%d', $orderid )->save ( $data ) !== false) {
			$result->Data = $this->find ( $orderid );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 根据主键id获取某个专辑信息
	public function getModel($orderid) {
		$result = new DataResult ();
		$result->Data = $this->where ( 'orderid=%d', $orderid )->select ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($user_id,$order_time,$order_freight,$order_totalprice,$order_payment,$order_status,$order_status_update_time,$order_receive_address,$order_receive_name,$order_receive_mobile,$order_receive_phone,$order_receive_postcode, $pageindex, $pagesize) {
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$conn = new Pdo ();
		$objects = $conn->query ( " select orderid,user_id,order_time,order_freight,order_totalprice,order_payment,order_status,order_status_update_time,order_receive_address,order_receive_name,order_receive_mobile,order_receive_phone,order_receive_postcode from gogojp_order where  ( user_id = :user_id or :user_id=0 ) 
 and  ( order_time = :order_time or :order_time='' ) 
 and  ( order_freight = :order_freight or :order_freight='' ) 
 and  ( order_totalprice = :order_totalprice or :order_totalprice='' ) 
 and  ( order_payment = :order_payment or :order_payment='' ) 
 and  ( order_status = :order_status or :order_status='' ) 
 and  ( order_status_update_time = :order_status_update_time or :order_status_update_time='' ) 
 and  ( order_receive_address = :order_receive_address or :order_receive_address='' ) 
 and  ( order_receive_name = :order_receive_name or :order_receive_name='' ) 
 and  ( order_receive_mobile = :order_receive_mobile or :order_receive_mobile=0 ) 
 and  ( order_receive_phone = :order_receive_phone or :order_receive_phone='' ) 
 and  ( order_receive_postcode = :order_receive_postcode or :order_receive_postcode='' ) 
 limit $lastpagenum,$pagesize", array (
':user_id' => $user_id,
                   ':order_time' => $order_time,
                   ':order_freight' => $order_freight,
                   ':order_totalprice' => $order_totalprice,
                   ':order_payment' => $order_payment,
                   ':order_status' => $order_status,
                   ':order_status_update_time' => $order_status_update_time,
                   ':order_receive_address' => $order_receive_address,
                   ':order_receive_name' => $order_receive_name,
                   ':order_receive_mobile' => $order_receive_mobile,
                   ':order_receive_phone' => $order_receive_phone,
                   ':order_receive_postcode' => $order_receive_postcode
			)  );
		$data = $conn->query ( " select count(*) totalcount  from gogojp_order where  ( user_id = :user_id or :user_id=0 ) 
 and  ( order_time = :order_time or :order_time='' ) 
 and  ( order_freight = :order_freight or :order_freight='' ) 
 and  ( order_totalprice = :order_totalprice or :order_totalprice='' ) 
 and  ( order_payment = :order_payment or :order_payment='' ) 
 and  ( order_status = :order_status or :order_status='' ) 
 and  ( order_status_update_time = :order_status_update_time or :order_status_update_time='' ) 
 and  ( order_receive_address = :order_receive_address or :order_receive_address='' ) 
 and  ( order_receive_name = :order_receive_name or :order_receive_name='' ) 
 and  ( order_receive_mobile = :order_receive_mobile or :order_receive_mobile=0 ) 
 and  ( order_receive_phone = :order_receive_phone or :order_receive_phone='' ) 
 and  ( order_receive_postcode = :order_receive_postcode or :order_receive_postcode='' ) 
", array (
':user_id' => $user_id,
                   ':order_time' => $order_time,
                   ':order_freight' => $order_freight,
                   ':order_totalprice' => $order_totalprice,
                   ':order_payment' => $order_payment,
                   ':order_status' => $order_status,
                   ':order_status_update_time' => $order_status_update_time,
                   ':order_receive_address' => $order_receive_address,
                   ':order_receive_name' => $order_receive_name,
                   ':order_receive_mobile' => $order_receive_mobile,
                   ':order_receive_phone' => $order_receive_phone,
                   ':order_receive_postcode' => $order_receive_postcode
			)  );
		$totalcount=$data[0]['totalcout'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}