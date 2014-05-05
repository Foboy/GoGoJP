<?php

namespace Home\Model;

use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class PictureModel extends Model {
	protected $tableName = 'sys_picture_management';
	// 增加表中数据
	public function addModel($title, $bigPic, $smallPic, $albumId) {
		$result = new DataResult ();
		$data = array (
				'pic_title' => $title,
				'big_pic' => $bigPic,
				'small_pic' => $smallPic,
				'album_id' => $albumId,
				'istop' => 1 
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
	public function deleteModel($picId) {
		$result = new DataResult ();
		if ($this->where ( 'picid=%d', $picId )->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 编辑表中数据
	public function updateModel($picId, $title, $bigPic, $smallPic, $albumId) {
		$result = new DataResult ();
		$data = array (
				'pic_title' => $title,
				'big_pic' => $bigPic,
				'small_pic' => $smallPic,
				'album_id' => $albumId 
		);
		// 注意判断条件使用恒等式
		if ($this->where ( 'picid=%d', $picId )->save ( $data ) !== false) {
			$result->Data = $this->find ( $picId );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($pageIndex, $pageSize) {
		$result = new PageDataResult ();
		$lastPageNum = $pageIndex * $pageSize;
		$conn = new Pdo ();
		$objects = $conn->query ( "select * from gogojp_sys_picture_management order by create_time desc limit $lastPageNum,$pageSize" );
		$totalcount = $conn->query ( "select count(*) from gogojp_sys_picture_management order by create_time" )[0]['count(*)'];
		$result->pageindex = $pageIndex;
		$result->pagesize = $pageSize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}