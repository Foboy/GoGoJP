<?php

namespace Home\Model;

use Think\Model;
use Common\Common\DataResult;
use Common\Common\ErrorType;
use Think\Db\Driver\Pdo;

class UserModel extends Model {
	protected $tableName = 'user';
	public function addModel() {
		$result = new DataResult ();
		$data = array (
				/* 'user_name' => I ( 'user_name' ),
				'password' => md5 ( I ( 'password' ) ),
				'email' => I ( 'email','','email' ),
				'user_level' => 1,
				'realname' => I ( 'realname' ),
				'sex' => 1,
				'mobile' => I ( 'mobile' )  */
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
		$User = new Pdo ( );
		$result= $User->query ( "select *  from gogojp_user where user_id=:user_id", array (
				":user_id" => $userid
		) );
		
		/* 第一种方式写sql
		 * $Data = new Model (); $result = $Data->query ( 'select * from gogojp_user where user_id='.$userid ); return $result;
		 */
		
		/*第二种方式orm
		 * $result = $Data->query ( 'select * from gogojp_user where user_id=:user_id', array ( ':userid' => $userid ) );
		*/
		
		// $result->Data = $this->find ( $userid );
		
		// pdo
		//$conn = new pdo ();
		// $conn->query('select * from gogojp_user  where user_id=:user_id',array(":user_id"=>1));
		
		
	   return $result; 
	}
	public function searchModel() {
		$result = new DataResult ();
		$result->Data = $this->select ();
		return $result;
	}
	public function userLogin($account, $password) {
		$result = new DataResult ();
		$condition = array (
				'user_name' => $account,
				'password' => $password 
		);
		$data = $this->where ( $condition )->find ();
		if ($data) {
			$result->Data = $data;
			$result->ErrorMessage = '登陆成功';
			// 写入session
			session ( 'user_id', $data ['user_id'] );
			session ( 'user_logged_in', true );
			session ( 'user_name', $data ['user_name'] );
			cookie ( 'gogojp_c', array (
					'user_id' => $data->user_id 
			) );
		} else {
			$result->Error = ErrorType::LoginFailed;
			$result->ErrorMessage = '密码或账号不正确';
		}
		return $result;
	}
}