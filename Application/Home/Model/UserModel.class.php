<?php

namespace Home\Model;

use Think\Model;

class UserModel extends Model {
	protected $tableName = 'user';
	public function add() {
		$data = array (
				/* 'user_name' => I ( 'user_name' ),
				'password' => md5 ( I ( 'password' ) ),
				'email' => I ( 'email','','email' ),
				'user_level' => 1,
				'realname' => I ( 'realname' ),
				'sex' => 1,
				'mobile' => I ( 'mobile' )  */
				'user_name' => '小李子',
				'password' => md5 ( '111111' ),
				'email' => '653260669@qq.com' 
		)
		;
		$pid = $this->add ( $data );
		if ($pid > 0) {
			return $this->find ( $pid );
		} else {
		}
	}
	public function update($userid) {
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
			return '更新成功';
		} else {
			return '更新失败';
		}
	}
	public function delete($userid) {
		$result = $this->where ( 'user_id=' . $userid )->delete ();
		if ($result == 1) {
			return '删除成功';
		} else {
			return '删除失败';
		}
	}
	public function get($userid) {
			// 第一种方式写sql
			/*
		 * $Data = new Model (); $result = $Data->query ( 'select * from gogojp_user where user_id='.$userid ); return $result;
		 */
			// 第二种方式orm
		$result = $this->find ( $userid );
		return $result;
	}
	public function search(){
		$result = $this->select ();
		return $result;
	}
}