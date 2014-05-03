<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\UserModel;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class IndexController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	//用户登陆
	public function login(){
		$result =new DataResult();
		$account=I('user_name','','htmlspecialchars');
		$password=I('password');
		if (!isset ($account) or empty ($account)) {
			$result->Error=ErrorType::RequestParamsFailed;
			$this->ajaxReturn($result);
		}
		if (! isset ( $password ) or empty ( $password )) {
			$result->Error=ErrorType::RequestParamsFailed;
			$this->ajaxReturn($result);
		}
		$User=new UserModel();
		$result=$User->userLogin($account,md5($password));
		$this->ajaxReturn($result);
	}
	
	//用户退出登录
	public function loginOut(){
		$result =new DataResult();
		session('[destroy]');
		cookie('gogojp_c',null);
		$this->ajaxReturn($result);
	}
	//获取当前登录用户信息
	public function getCurrentUser(){
		$result=new DataResult();
		$User=new UserModel();
		if(session('user_id')){
		$result=$User->getModel(session('user_id'));
		}
		$this->ajaxReturn($result);
	}
}