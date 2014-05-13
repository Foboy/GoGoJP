<?php
/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/13 22:04:05
 */
namespace Home\Model;
use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class StandardModel extends Model {
	protected $tableName = 'standard';
	// 增加表中数据
	public function addModel($standard_name,$create_time) {
		$result = new DataResult ();
		$data = array (
'standard_name' => $standard_name,
                   'create_time' => $create_time
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
	public function deleteModel($standard_id) {
		$result = new DataResult ();
        $map['standard_id']=$standard_id;
		if ($this->where ($map)->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 编辑表中数据
	public function updateModel($standard_id,$standard_name,$create_time) {
		$result = new DataResult ();
		$data = array (
'standard_id' => $standard_id,
                   'standard_name' => $standard_name,
                   'create_time' => $create_time
		);
		// 注意判断条件使用恒等式
        $map['standard_id']=$standard_id;
		if ($this->where ($map )->save ( $data ) !== false) {
			$result->Data = $this->find ( $standard_id );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 根据主键id获取某个专辑信息
	public function getModel($standard_id) {
		$result = new DataResult ();
        $map['standard_id']=$standard_id;
		$result->Data = $this->where ($map )->find ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($standard_name,$create_time, $pageindex, $pagesize) {
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$conn = new Pdo ();
		$objects = $conn->query ( " select standard_id,standard_name,create_time from gogojp_standard where  ( standard_name = :standard_name or :standard_name='' ) 
 and  ( create_time = :create_time or :create_time='' ) 
 limit $lastpagenum,$pagesize", array (
':standard_name' => $standard_name,
                   ':create_time' => $create_time
			)  );
		$data = $conn->query ( " select count(*) totalcount  from gogojp_standard where  ( standard_name = :standard_name or :standard_name='' ) 
 and  ( create_time = :create_time or :create_time='' ) 
", array (
':standard_name' => $standard_name,
                   ':create_time' => $create_time
			)  );
		$totalcount=$data[0]['totalcount'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}