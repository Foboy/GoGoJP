<?php

namespace Home\Model;

use Think\Model;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class OrderModel extends Model {
	protected $tableName='order';
	public function addModel() {
		$result = new DataResult ();
		$data = array (
				'user_name' => 'ppt',
				'password' => md5 ( '111111' ),
				'email' => '653260669@qq.com'
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
	public function updateModel($userid) {
		$result = new DataResult ();
		$data = array (
				'user_name' => 'ThinkPHP',
				'password' => md5 ( '111111' ),
				'email' => 'ThinkPHP@gmail.com',
				'user_level' => 2,
				'realname' => '小强2',
				'sex' => 1,
				'mobile' => '15828670324'
		);
		// 注意判断条件使用恒等式
		if ($this->where ( 'user_id=' . $userid )->save ( $data ) !== false) {
			$result->Data = $this->find ( $userid );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	public function deleteModel($userid) {
		$result = new DataResult ();
		if ($this->where ( 'user_id=' . $userid )->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	public function getModel($userid) {
		$result = new DataResult ();
		// 第一种方式写sql
		/*
		* $Data = new Model (); $result = $Data->query ( 'select * from gogojp_user where user_id='.$userid ); return $result;
		*/
		// 第二种方式orm
		$result->Data = $this->find ( $userid );
		return $result;
	}
	public function searchModel() {
	$result = new DataResult ();
	$result->Data = $this->select ();
	return $result;
	}
// 	public function searchModelByPages($userid,$pageindex,$pagesize) {
// 		$Data = new Model (); 
// 		$result = $Data->query ( 'select * from gogojp_user where user_id='.$userid .' limit '.$pageindex.','.$pagesize); 
	
// 		return $result;
// 	}
	public function searchModelByPages($userid,$pageindex,$pagesize) {
		$Data = new Model ();
		$result = $Data->query ( "select * from gogojp_user where user_id=:user_id limit :pageindex,:pagesize", array (
				":user_id" => 1,
				":pageindex" => $pageindex,
				":pagesize" => $pagesize
		) );
		
		return $result;
	}
	
}