<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/9 11:54:11
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\MessageModel;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class MessageController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Message控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 添加
	public function addMessage() {
		$result = new DataResult ();
		$Message = new MessageModel ();
		
		$form_userid = I ( 'form_userid' );
		$to_userid = I ( 'to_userid' );
		$content = I ( 'content' );
		$create_time = I ( 'create_time' );
		$advisory_id = I ( 'advisory_id' );
		
		if (! isset ( $form_userid ) or empty ( $form_userid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $to_userid ) or empty ( $to_userid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $content ) or empty ( $content )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $advisory_id ) or empty ( $advisory_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Message->addModel ( $form_userid, $to_userid, $content, $create_time, $advisory_id );
		$this->ajaxReturn ( $result );
	}
	// 删除
	public function deleteMessage() {
		$result = new DataResult ();
		$Message = new MessageModel ();
		$messageid = I ( 'messageid' );
		if (! isset ( $messageid ) or empty ( $messageid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Message->deleteModel ( $messageid );
		$this->ajaxReturn ( $result );
	}
	// 编辑
	public function updateMessage() {
		$result = new DataResult ();
		$Message = new MessageModel ();
		$form_userid = I ( 'form_userid' );
		$to_userid = I ( 'to_userid' );
		$content = I ( 'content' );
		$create_time = I ( 'create_time' );
		$advisory_id = I ( 'advisory_id' );
		
		if (! isset ( $form_userid ) or empty ( $form_userid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $to_userid ) or empty ( $to_userid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $content ) or empty ( $content )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $advisory_id ) or empty ( $advisory_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Message->updateModel ( $form_userid, $to_userid, $content, $create_time, $advisory_id );
		$this->ajaxReturn ( $result );
	}
	// 获取单个
	public function getMessage() {
		$result = new DataResult ();
		$Message = new MessageModel ();
		$messageid = I ( 'messageid' );
		if (! isset ( $messageid ) or empty ( $messageid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Message->getModel ( $messageid );
		$this->ajaxReturn ( $result );
	}
	
	// 分页查询列表
	public function searchMessage() {
		$result = new DataResult ();
		$Message = new MessageModel ();
		$form_userid = I ( 'form_userid' );
		$to_userid = I ( 'to_userid' );
		$content = I ( 'content' );
		$create_time = I ( 'create_time' );
		$advisory_id = I ( 'advisory_id' );
		
		if (! isset ( $form_userid ) or empty ( $form_userid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $to_userid ) or empty ( $to_userid )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $content ) or empty ( $content )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $advisory_id ) or empty ( $advisory_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$pageIndex = I ( 'pageindex', 0 );
		$pageSize = I ( 'pagesize', 10 );
		$result = $Message->searchByPage ( $form_userid, $to_userid, $content, $create_time, $advisory_id, $pageIndex, $pageSize );
		$this->ajaxReturn ( $result );
	}
}