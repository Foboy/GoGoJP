<?php
/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/9 11:52:34
 */
namespace Home\Model;
use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class CustomerAdvisoryModel extends Model {
	protected $tableName = 'customer_advisory';
	// 增加表中数据
	public function addModel($customer_id,$customer_account,$customer_nickname,$create_time,$isread) {
		$result = new DataResult ();
		$data = array (
				'customer_account' => $customer_account,
				'customer_nickname' => $customer_nickname,
				'isread' => $isread
		);

		$map['customer_id']=$customer_id;
		// 注意判断条件使用恒等式
		if(count($this->where($map)->select())>0)
		{

			$map['customer_id']=$customer_id;
			if ($this->where ($map )->save ( $data ) !== false) {
				$result->Error = ErrorType::Success;
				$result->ErrorMessage = '更新成功';
			}
		}
		else
		{
			$data = array (
	'customer_id' => $customer_id,
	                   'customer_account' => $customer_account,
	                   'customer_nickname' => $customer_nickname,
	                   'isread' => $isread
			);
			$pid = $this->add ( $data );
			if ($pid > 0) {
				$result->Data = $this->find ( $pid );
				$result->ErrorMessage = '新增成功';
			} else {
				$result->Error = ErrorType::Failed;
				$result->ErrorMessage = '新增失败';
			}
		}
		return $result;
	}

	public function updateReadState($customer_id,$isread) {
		$result = new DataResult ();
		$data = array (
				'isread' => $isread
		);
			$map['customer_id']=$customer_id;
			if ($this->where ($map )->save ( $data ) !== false) {
				$result->Error = ErrorType::Success;
				$result->ErrorMessage = '更新成功';
			}
		return $result;
	}

	// 删除表中数据
	public function deleteModel($advisory_id) {
		$result = new DataResult ();
        $map['advisory_id']=$advisory_id;
		if ($this->where ($map)->delete () == 1) {
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
        $map['advisory_id']=$advisory_id;
		if ($this->where ($map )->save ( $data ) !== false) {
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
        $map['advisory_id']=$advisory_id;
		$result->Data = $this->where ($map )->select ();
		return $result;
	}
	public function getModelByCustomerId($customer_id) {
		$result = new DataResult ();
		$map['customer_id']=$customer_id;
		$result->Data = $this->where ($map )->select ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($customer_account,$customer_nickname,$begin_time,$end_time, $pageindex, $pagesize) {
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$conn = new Pdo ();
		$objects = $conn->query ( " select advisory_id,customer_id,customer_account,customer_nickname,create_time,isread from gogojp_customer_advisory where
 ('$customer_account'='' or customer_account like '%$customer_account%')
 and  ('$customer_nickname'='' or customer_nickname = '%$customer_nickname%')
 and  ( create_time >= :begin_time or :begin_time='' )
 and  ( create_time <= :end_time or :end_time='' )
 order by isread asc,create_time desc
 limit $lastpagenum,$pagesize", array (
                   ':begin_time' => date($begin_time),
 				   ':end_time' => date($end_time)
			)  );
		$data = $conn->query ( " select count(*) totalcount  from gogojp_customer_advisory where
('$customer_account'='' or customer_account like '%$customer_account%')
 and  ('$customer_nickname'='' or customer_nickname = '%$customer_nickname%')
 and  ( create_time >= :begin_time or :begin_time='' )
 and  ( create_time <= :end_time or :end_time='' )
", array (
                   ':begin_time' => date($begin_time),
 				   ':end_time' => date($end_time)
			)  );
		$totalcount=$data[0]['totalcout'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}