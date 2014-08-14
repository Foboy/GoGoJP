<?php

namespace Home\Model;

use Think\Model;
use Common\Common\DataResult;
use Common\Common\ErrorType;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;

class AlbumModel extends Model {
	protected $tableName = 'album';
	// 鏂板model
	public function addModel() {
		$result = new DataResult ();
		$data = array (
				'album_name' => I ( 'album_name', '', 'htmlspecialchars' ),
				'album_cover' => I ( 'album_cover' ),
				'album_description' => $_POST ['album_description'] ,
				'album_tag_id'=>I('tagid',0)
		);
		$pid = $this->add ( $data );
		if ($pid > 0) {
			$result->Data = $this->find ( $pid );
			$result->ErrorMessage = '鏂板鎴愬姛';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '鏂板澶辫触';
		}
		return $result;
	}
	// 鍒犻櫎model
	public function deleteModel() {
	}
	// 鏇存柊model
	public function updateModel($album_id,$album_name,$album_cover,$album_description,$album_status,$album_tag_id) {
		$result = new DataResult ();
		$data = array (
				'album_name' => $album_name,
				'album_cover' => $album_cover,
				'album_description' => $album_description,
				'album_status'=>$album_status,
				'album_tag_id'=>$album_tag_id
		);
		
		$map = array (
				'album_id' => $album_id 
		);
		// 娉ㄦ剰鍒ゆ柇鏉′欢浣跨敤鎭掔瓑寮�
		if ($this->where ( $map )->save ( $data ) !== false) {
			$result->Data = $this->find ( $album_id );
			$result->ErrorMessage = '鏇存柊鎴愬姛';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '鏇存柊澶辫触';
		}
		return $result;
	}
	// 鏍规嵁涓婚敭id鑾峰彇鏌愪釜涓撹緫淇℃伅
	public function getModel($album_id) {
		$result = new DataResult ();
		$map = array (
				'album_id' => $album_id 
		);
		$result->Data = $this->where ( $map )->find ();
		return $result;
	}
	// 鏍规嵁鏉′欢妯＄硦鍒嗛〉鏌ヨ涓撹緫鍒楄〃淇℃伅
	public function searchAlbumByCondition($album_name, $start_time, $end_time, $pageIndex, $pageSize) {
		$result = new PageDataResult ();
		$lastPageNum = $pageIndex * $pageSize;
		$likename = " '%" . $album_name . "%'  ";
		$conn = new Pdo ();
		if (! empty ( $start_time )) {
			$start_time = date ( 'Y-m-d H:i:s', $start_time );
			$end_time = date ( 'Y-m-d H:i:s', $end_time );
			$objects = $conn->query ( "select a.* from ( select * from gogojp_album where (create_time between '$start_time' and '$end_time' ) and (album_name like $likename or ''=:album_name) ) as a order by a.create_time desc limit $lastPageNum,$pageSize", array (
					':album_name' => $album_name 
			) );
			$data = $conn->query ( "select count(*) totalcout from gogojp_album where (create_time between '$start_time' and '$end_time' ) and (album_name like $likename or ''=:album_name) ", array (
					':album_name' => $album_name 
			) );
			$totalcount = $data [0] ['totalcout'];
			$result->pageindex = $pageIndex;
			$result->pagesize = $pageSize;
			$result->Data = $objects;
			$result->totalcount = $totalcount;
		} else {
			$objects = $conn->query ( "select  a.* from ( select * from gogojp_album where (album_name like $likename or ''=:album_name) ) as a order by a.create_time desc limit $lastPageNum,$pageSize", array (
					':album_name' => $album_name 
			) );
			$data = $conn->query ( "select count(*) totalcout from gogojp_album where (album_name like $likename or ''=:album_name)", array (
					':album_name' => $album_name 
			) );
			$totalcount = $data [0] ['totalcout'];
			$result->pageindex = $pageIndex;
			$result->pagesize = $pageSize;
			$result->Data = $objects;
			$result->totalcount = $totalcount;
		}
		return $result;
	}
}
