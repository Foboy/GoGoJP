<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/8 12:34:10
 */
namespace Home\Model;

use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class OrderModel extends Model {
	protected $tableName = 'order';
	
	// 增加表中数据
	public function addModel($order_no, $user_id, $user_account, $order_time, $order_freight, $order_totalprice, $order_payment, $order_status, $order_status_update_time, $order_receive_address, $order_receive_name, $order_receive_mobile, $order_receive_phone, $order_receive_postcode, $remark, $invoice) {
		$result = new DataResult ();
		$data = array (
				'order_no' => $order_no,
				'user_id' => $user_id,
				'user_account' => $user_account,
				'order_time' => $order_time,
				'order_freight' => $order_freight,
				'order_totalprice' => $order_totalprice,
				'order_payment' => $order_payment,
				'order_status' => $order_status,
				'order_status_update_time' => $order_status_update_time,
				'order_receive_address' => $order_receive_address,
				'order_receive_name' => $order_receive_name,
				'order_receive_mobile' => $order_receive_mobile,
				'order_receive_phone' => $order_receive_phone,
				'order_receive_postcode' => $order_receive_postcode,
				'remark' => $remark,
				'invoice' => $invoice 
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
	public function deleteModel($order_no) {
		$result = new DataResult ();
		$map ['order_no'] = $order_no;
		if ($this->where ( $map )->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 编辑表中数据
	public function updateModel($order_no, $order_status, $order_status_update_time, $logistics_status) {
		$result = new DataResult ();
		$data = array (
				'order_status' => $order_status,
				'order_status_update_time' => $order_status_update_time,
				'logistics_status' => $logistics_status 
		);
		$map ['order_no'] = $order_no;
		// 注意判断条件使用恒等式
		if ($this->where ( $map )->save ( $data ) !== false) {
			$result->Data = $this->find ( $order_no );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 订单付款
	public function PayOrder($order_no, $order_pay_account) {
		$result = new DataResult ();
		$data = array (
				'order_status' => 2,
				order_pay_account => $order_pay_account,
				'pay_time' => date ( "Y-m-d H:i:s", time () ) 
		);
		$map ['order_no'] = $order_no;
		// 注意判断条件使用恒等式
		if ($this->where ( $map )->save ( $data ) !== false) {
			$result->Data = $this->find ( $order_no );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 修改付款时间
	public function updatePayTime($order_no) {
		$result = new DataResult ();
		$data = array (
				'order_status' => 2,
				'pay_time' => date ( "Y-m-d H:i:s", time () ) 
		);
		$map ['order_no'] = $order_no;
		// 注意判断条件使用恒等式
		if ($this->where ( $map )->save ( $data ) !== false) {
			$result->Data = $this->find ( $order_no );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 根据主键id获取某个专辑信息
	public function getModel($order_no) {
		$result = new DataResult ();
		$map ['order_no'] = $order_no;
		$result->Data = $this->where ( $map )->find ();
		return $result;
	}
	// 查询用户订单列表
	public function searchUserOrder($user_id) {
		$result = new DataResult ();
		$map ['user_id'] = $user_id;
		$result->Data = $this->where ( $map )->select ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($keyname, $order_time1, $order_time2, $order_status, $pageindex, $pagesize) {
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$skey = " 1=1 ";
		if ($keyname != "") {
			$skey = " (( order_no like '%$keyname%' )  or  ( user_account like '%$keyname%' )) ";
		}
		$timespan = " ";
		if (! empty ( $order_time1 ) and ! empty ( $order_time2 )) {
			$timespan = "  and order_time between '$order_time1' and '$order_time2' ";
		}
		$conn = new Pdo ();
		$sql = " select * from gogojp_order 
				where  $skey
 $timespan
 and  ( order_status = $order_status or $order_status=0 ) 
 limit $lastpagenum,$pagesize";
		$objects = $conn->query ( $sql );
		// print $sql;
		$totalsql = " select count(*) totalcount  from gogojp_order 
				where  $skey
$timespan
 and  ( order_status = $order_status or $order_status=0 ) 
";
		// print $totalsql;
		$data = $conn->query ( $totalsql );
		$totalcount = $data [0] ['totalcount'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
	public function searchIndexOrderInfo() {
		$result = new DataResult ();
		$conn = new Pdo ();
		
		/*
		 * + ------------------------------- 计算当天起始点和结束点时间戳 取出当天的数据 + ------------------------------
		 */
		
		$year = date ( "Y" );
		$month = date ( "m" );
		$day = date ( "d" );
		$dayBegin = mktime ( 0, 0, 0, $month, $day, $year ); // 当天开始时间戳
		$dayEnd = mktime ( 23, 59, 59, $month, $day, $year ); // 当天结束时间戳
		
		$sql = "select 
    (SELECT 
            count(*)
        FROM
            gogojp_order) order_count,
    (SELECT 
            sum(order_totalprice)
        FROM
            gogojp_order
        where
            order_status >= 2) total_price,
    (SELECT 
            count(*)
        FROM
            gogojp_order
        where
            order_status = 1) unpay_order,
    (SELECT 
            count(*)
        FROM
            gogojp_order
        WHERE
            order_time < $dayEnd
                AND order_time > $dayBegin) today_orders
from dual";
		
		$objects = $conn->query ( $sql);
		$result->Data = $objects;
		$result->Error=ErrorType::Success;
		return  $result;
		
	}
	

}