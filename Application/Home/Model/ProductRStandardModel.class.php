<?php
/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/13 0:08:02
 */
namespace Home\Model;
use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class ProductRStandardModel extends Model {
	protected $tableName = 'product_r_standard';
	// 增加表中数据
	public function addModel($product_id,$standard_id,$create_time,$standard_parent_id) {
		$result = new DataResult ();
		$data = array (
'product_id' => $product_id,
                   'standard_id' => $standard_id,
                   'create_time' => $create_time,
                   'standard_parent_id' => $standard_parent_id
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
		if ($this->where ($map)->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 编辑表中数据
	public function updateModel($id,$product_id,$standard_id,$create_time,$standard_parent_id) {
		$result = new DataResult ();
		$data = array (
'id' => $id,
                   'product_id' => $product_id,
                   'standard_id' => $standard_id,
                   'create_time' => $create_time,
                   'standard_parent_id' => $standard_parent_id
		);
		// 注意判断条件使用恒等式
        $map['id']=$id;
		if ($this->where ($map )->save ( $data ) !== false) {
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
        $map['id']=$id;
		$result->Data = $this->where ($map )->find ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($product_id,$standard_id,$create_time,$standard_parent_id, $pageindex, $pagesize) {
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$conn = new Pdo ();
		$objects = $conn->query ( " select id,product_id,standard_id,create_time,standard_parent_id from gogojp_product_r_standard where  ( product_id = :product_id or :product_id=0 ) 
 and  ( standard_id = :standard_id or :standard_id=0 ) 
 and  ( create_time = :create_time or :create_time='' ) 
 and  ( standard_parent_id = :standard_parent_id or :standard_parent_id=0 ) 
 limit $lastpagenum,$pagesize", array (
':product_id' => $product_id,
                   ':standard_id' => $standard_id,
                   ':create_time' => $create_time,
                   ':standard_parent_id' => $standard_parent_id
			)  );
		$data = $conn->query ( " select count(*) totalcount  from gogojp_product_r_standard where  ( product_id = :product_id or :product_id=0 ) 
 and  ( standard_id = :standard_id or :standard_id=0 ) 
 and  ( create_time = :create_time or :create_time='' ) 
 and  ( standard_parent_id = :standard_parent_id or :standard_parent_id=0 ) 
", array (
':product_id' => $product_id,
                   ':standard_id' => $standard_id,
                   ':create_time' => $create_time,
                   ':standard_parent_id' => $standard_parent_id
			)  );
		$totalcount=$data[0]['totalcount'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}