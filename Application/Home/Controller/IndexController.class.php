<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\UserModel;

class IndexController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 新增
	public function addUser() {
		$User = new UserModel ();
		$result = $User->addmodel ();
		$this->ajaxReturn ( $result );
	}
	// 更新
	public function updateUser() {
		$User = new UserModel (); // 实例化User对象
		$userid = 1;
		$result = $User->updatemodel ( $userid );
		$this->ajaxReturn ( $result );
	}
	// 删除
	public function deleteUser() {
		$User = new UserModel ();
		$userid = 11;
		$result = $User->deletemodel ( $userid );
		$this->ajaxReturn ( $result );
	}
	// 根据条件获取单挑数据
	public function getUser() {
			//第一种方式写sql
			/*
		 * $User = new UserModel (); $userid = 11; $result = $User->get ( $userid ); $this->ajaxReturn ( $result );
		 */
		//第二种方式orm
		$User = new UserModel ();
		$userid = 1;
		$result = $User->getmodel ( $userid );
		$this->ajaxReturn ( $result );
		
	}
	
	// 获取列表
	public function serachUser() {
		$Users = new UserModel ();
		$result=$Users->searchmodel();
		$this->ajaxReturn ( $result );
	}
}