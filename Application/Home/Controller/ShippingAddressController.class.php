<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\AddressModel;

class ShippingAddressController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的ShippingAddress控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	public function test() {
		$Address = new AddressModel ();
		$result = $Address->query ( "select * from gogojp_user where user_id=:user_id", array (
				":user_id" => 1 
		) );
		$this->ajaxReturn($result);
	}
}