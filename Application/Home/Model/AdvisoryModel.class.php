
<?php

namespace Home\Model;

use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class AdvisoryModel extends Model {
	protected $tableName = 'customer_advisory';
	// 增加表中数据
	public function addModel($customer_id,$customer_account,$customer_nickname,$create_time,$isread) {
		$result = new DataResult ();
		$data = array (
':customer_id' => $customer_id,
                   ':customer_account' => $customer_account,
                   ':customer_nickname' => $customer_nickname,
                   ':create_time' => $create_time,
                   ':isread' => $isread
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
	public function deleteModel($advisory_id) {
		$result = new DataResult ();
		if ($this->where ( 'advisory_id=%d', $advisory_id )->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 编辑表中数据
	public function updateModel($advisory_id,$customer_id,$customer_account,$customer_nickname,$create_time,$isread) {
		$result = new DataResult ();
		$data = array (
':advisory_id' => $advisory_id,
                   ':customer_id' => $customer_id,
                   ':customer_account' => $customer_account,
                   ':customer_nickname' => $customer_nickname,
                   ':create_time' => $create_time,
                   ':isread' => $isread
		);
		// 注意判断条件使用恒等式
		if ($this->where ( 'advisory_id=%d', $advisory_id )->save ( $data ) !== false) {
			$result->Data = $this->find ( $advisory_id );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 根据主键id获取某个专辑信息
	public function getModel($advisory_id) {
		$result = new DataResult ();
		$result->Data = $this->where ( 'advisory_id=%d', $advisory_id )->select ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($customer_id,$customer_account,$customer_nickname,$create_time,$isread, $pageindex, $pagesize) {
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$conn = new Pdo ();
		$objects = $conn->query ( " select advisory_id,customer_id,customer_account,customer_nickname,create_time,isread from gogojp_customer_advisory where  ( customer_id = :customer_id or :customer_id=0 ) 
 and  ( customer_account = :customer_account or :customer_account='' ) 
 and  ( customer_nickname = :customer_nickname or :customer_nickname='' ) 
 and  ( create_time = :create_time or :create_time='' ) 
 and  ( isread = :isread or :isread='' ) 
 limit $lastpagenum,$pagesize", array (
':customer_id' => $customer_id,
                   ':customer_account' => $customer_account,
                   ':customer_nickname' => $customer_nickname,
                   ':create_time' => $create_time,
                   ':isread' => $isread
			)  );
		$data = $conn->query ( " select count(*) totalcount  from gogojp_customer_advisory where  ( customer_id = :customer_id or :customer_id=0 ) 
 and  ( customer_account = :customer_account or :customer_account='' ) 
 and  ( customer_nickname = :customer_nickname or :customer_nickname='' ) 
 and  ( create_time = :create_time or :create_time='' ) 
 and  ( isread = :isread or :isread='' ) 
", array (
':customer_id' => $customer_id,
                   ':customer_account' => $customer_account,
                   ':customer_nickname' => $customer_nickname,
                   ':create_time' => $create_time,
                   ':isread' => $isread
			)  );
		$totalcount=$data[0]['totalcout'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}