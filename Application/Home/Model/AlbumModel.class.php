<?php

namespace Home\Model;

use Think\Model;
use Common\Common\DataResult;
use Common\Common\ErrorType;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;

class AlbumModel extends Model {
	protected $tableName = 'album';
	// 新增model
	public function addModel() {
		$result = new DataResult ();
		$data = array (
				'album_name' => I ( 'album_name', '', 'htmlspecialchars' ),
				'album_cover' => I ( 'album_cover' ),
				'album_description' => I ( 'album_description' ),
				'album_sign' => I ( 'album_sign', '' ) 
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
	// 删除model
	public function deleteModel() {
	}
	// 更新model
	public function updateModel($album_id) {
		$result = new DataResult ();
		$data = array (
				'album_name' => I ( 'album_name', '', 'htmlspecialchars' ),
				'album_cover' => I ( 'album_cover' ),
				'album_description' => I ( 'album_description' ),
				'album_sign' => I ( 'album_sign', '' ) 
		);
		// 注意判断条件使用恒等式
		if ($this->where ( 'album_id=%d', $album_id )->save ( $data ) !== false) {
			$result->Data = $this->find ( $album_id );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 根据主键id获取某个专辑信息
	public function getModel($album_id) {
		$result = new DataResult ();
		$result->Data = $this->where ( 'album_id=%d', $album_id )->select ();
		return $result;
	}
	// 根据条件模糊分页查询专辑列表信息
	public function searchAlbumByCondition($album_name, $start_time, $end_time, $pageIndex, $pageSize) {
		$result = new PageDataResult ();
		$lastPageNum = $pageIndex * $pageSize;
		$likename = " '%" . $album_name . "%'  ";
		$conn = new Pdo ();
		if (! empty ( $start_time )) {
			$start_time=date('Y-m-d h:i:s',$start_time);
			$end_time=date('Y-m-d h:i:s',$end_time);
			$objects = $conn->query ( "select * from gogojp_album where (create_time between $start_time and $end_time ) and (album_name like $likename or ''=:album_name) limit $lastPageNum,$pageSize", array (
					':album_name' => $album_name
			) );
			$totalcount = $conn->query ( "select count(*) from gogojp_album where (create_time between $start_time and $end_time ) and (album_name like $likename or ''=:album_name) ", array (
					':album_name' => $album_name
			) )[0]['count(*)'];
			$result->pageindex = $pageIndex;
			$result->pagesize = $pageSize;
			$result->Data = $objects;
			$result->totalcount = $totalcount;
		} else {
			$objects = $conn->query ( "select * from gogojp_album where (album_name like $likename or ''=:album_name) limit $lastPageNum,$pageSize", array (
					':album_name' => $album_name
			) );
			$totalcount = $conn->query ( "select count(*) from gogojp_album where (album_name like $likename or ''=:album_name)", array (
					':album_name' => $album_name
			) )[0]['count(*)'];
			$result->pageindex = $pageIndex;
			$result->pagesize = $pageSize;
			$result->Data = $objects;
			$result->totalcount = $totalcount;
		}
		return $result;
	}
}
?>
