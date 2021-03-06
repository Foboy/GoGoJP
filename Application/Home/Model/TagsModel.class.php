<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/12 14:12:43
 */
namespace Home\Model;

use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class TagsModel extends Model {
	protected $tableName = 'tags';
	// 增加表中数据
	public function addModel($tag_name,$tag_description) {
		$result = new DataResult ();
		$data = array (
				'tag_name' => $tag_name ,
				'tag_description'=>$tag_description
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
	public function deleteModel($tag_id) {
		$result = new DataResult ();
		$map ['tag_id'] = $tag_id;
		if ($this->where ( $map )->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 编辑表中数据
	public function updateModel($tag_id, $tag_name, $tag_description) {
		$result = new DataResult ();
		$data = array (
				'tag_id' => $tag_id,
				'tag_name' => $tag_name,
				'tag_description' => $tag_description 
		);
		// 注意判断条件使用恒等式
		$map ['tag_id'] = $tag_id;
		if ($this->where ( $map )->save ( $data ) !== false) {
			$result->Data = $this->find ( $tag_id );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 根据主键id获取某个专辑信息
	public function getModel($tag_id) {
		$result = new DataResult ();
		$map ['tag_id'] = $tag_id;
		$result->Data = $this->where ( $map )->find ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($pageindex, $pagesize) {
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$conn = new Pdo ();
		$objects = $conn->query ( " select * from gogojp_tags  limit $lastpagenum,$pagesize" );
		$data = $conn->query ( " select count(*) totalcount  from gogojp_tags ");
		$totalcount = $data [0] ['totalcount'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}