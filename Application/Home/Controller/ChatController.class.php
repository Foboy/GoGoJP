<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\CustomerAdvisoryModel;
use Home\Model\MessageModel;
use Common\Common\ErrorType;

class ChatController extends Controller {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Chat控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function customerCommet()
    {
    	$customer_id=I('customerid',0);
    	$customer_account=I('account','');
    	$customer_nickname=I('nickname','');
    	$content = I('content','');
    	$advisoryModel = new CustomerAdvisoryModel();
    	$messageModel = new MessageModel();
		$addResult = $messageModel->addModel($customer_id, 0, $content, time());
		if($addResult->Error == ErrorType::Success)
		{
			$advisoryModel->addModel($customer_id, $customer_account, $customer_nickname, time(), 1);
		}
		$this->ajaxReturn ($addResult);
    }

    public function advisoryReply()
    {
    	$customer_id=I('customerid',0);
    	$content = I('content','');
    	$advisoryModel = new CustomerAdvisoryModel();
    	$messageModel = new MessageModel();
    	$addResult = $messageModel->addModel(0, $customer_id, $content, time());
    	if($addResult->Error == ErrorType::Success)
    	{
    		$advisoryModel->updateReadState($customer_id, 0);
    	}
    	$this->ajaxReturn ($addResult);
    }

    public function messageList()
    {
    	$customer_id=I('customerid',0);
    	$pageIndex = I ('pageIndex', 0 );
    	$pageSize = I ('pageSize', 10 );
    	$begin_time=I('begintime','');
    	$end_time=I('endtime','');
    	$keyname=I('searchkey','','htmlspecialchars');
    	$messageModel = new MessageModel();
    	$this->ajaxReturn ($messageModel->searchByPage($customer_id, $keyname, $begin_time, $end_time, $pageIndex, $pageSize) );
    }

    public function chatList(){
		$advisoryModel = new CustomerAdvisoryModel();
		$begin_time=I('begintime','');
		$end_time=I('endtime','');
		$keyname=I('searchkey','','htmlspecialchars');
		$pageIndex = I ('pageIndex', 0 );
		$pageSize = I ('pageSize', 10 );
		$this->ajaxReturn ($advisoryModel->searchByPage($keyname, $keyname, $begin_time, $end_time, $pageIndex, $pageSize) );
    }
}