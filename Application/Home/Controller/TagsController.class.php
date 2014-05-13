<?php

/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/12 14:13:43
 */
namespace Home\Controller;

use Think\Controller;
use Home\Model\TagsModel;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class TagsController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Tags控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 添加
	public function addTags() {
		$result = new DataResult ();
		$Tags = new TagsModel ();
		
		$tag_name = I ( 'tag_name' );
		
		if (! isset ( $tag_name ) or empty ( $tag_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Tags->addModel ( $tag_name);
		$this->ajaxReturn ( $result );
	}
	// 删除
	public function deleteTags() {
		$result = new DataResult ();
		$Tags = new TagsModel ();
		$tag_id = I ( 'tag_id' );
		if (! isset ( $tag_id ) or empty ( $tag_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Tags->deleteModel ( $tag_id );
		$this->ajaxReturn ( $result );
	}
	// 编辑
	public function updateTags() {
		$result = new DataResult ();
		$Tags = new TagsModel ();
		$tag_name = I ( 'tag_name' );
		$create_time = I ( 'create_time' );
		
		if (! isset ( $tag_name ) or empty ( $tag_name )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		if (! isset ( $create_time ) or empty ( $create_time )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Tags->updateModel ( $tag_name, $create_time );
		$this->ajaxReturn ( $result );
	}
	// 获取单个
	public function getTags() {
		$result = new DataResult ();
		$Tags = new TagsModel ();
		$tag_id = I ( 'tag_id' );
		if (! isset ( $tag_id ) or empty ( $tag_id )) {
			$result->Error = ErrorType::RequestParamsFailed;
			$this->ajaxReturn ( $result );
		}
		$result = $Tags->getModel ( $tag_id );
		$this->ajaxReturn ( $result );
	}
	
	// 分页查询列表
	public function searchTags() {
		$Tags = new TagsModel ();
		$pageIndex = I ( 'pageindex', 0 );
		$pageSize = I ( 'pagesize', 20 );
		$result = $Tags->searchByPage ( $pageIndex, $pageSize );
		$this->ajaxReturn ( $result );
	}
}