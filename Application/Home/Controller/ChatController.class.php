<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\CustomerAdvisoryModel;
use Home\Model\MessageModel;
use Common\Common\ErrorType;
use Common\Common\NovComet;

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
			$advisoryModel->addModel($customer_id, $customer_account, $customer_nickname, time(), 0);
			$comet = new NovComet();
			$comet->publish('customercomet',";$customer_id");
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
    		$advisoryModel->updateReadState($customer_id, 1);
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
    	$begin_time=$begin_time ;
    	$end_time=$end_time ;
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

    public function getCustomer()
    {
    	$customer_id=I('customerid',0);
    	$advisoryModel = new CustomerAdvisoryModel();
    	$advisoryModel->updateReadState($customer_id, 1);
    	$this->ajaxReturn ($advisoryModel->getModelByCustomerId($customer_id));
    }

    public function advisoryObserve()
    {

    	$comet = new NovComet();
    	$publish = I('publish','');
    	$subscribed = I('subscribeds','');
    	$timestamps = I('timestamps','');
    	session_write_close();//防止session阻塞
    	if ($publish != '') {
    		echo $comet->publish($publish);
    	} else {
    		for($i=0;$i<count($subscribed);$i++)
    		{
    			$comet->setVar($subscribed[$i], $timestamps[$i]);
    		}

    		echo $comet->run();
    		/*
    		foreach (filter_var_array($subscribed, FILTER_SANITIZE_NUMBER_INT) as $key => $value) {
    			var_dump("$key -> $value");
    			$comet->setVar($key, $value);
    		}
*/
    	}
    }
}