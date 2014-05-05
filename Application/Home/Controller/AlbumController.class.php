<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\AlbumModel;

class AlbumController extends Controller {
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Album控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	//新增合辑
	public function addAlbum()
	{ 
		$Album=new AlbumModel();
		$this->ajaxReturn($Album->addModel());
	}
	//删除合辑
	public function deleteAlbum(){
		
	}
	//更新合辑
	public function updateAlbum(){
		$Album=new AlbumModel();
		$album_id=I('$album_id');
		$this->ajaxReturn($Album->updateModel($album_id));
	}
	//根据主键获取某个合辑信息
	public function getAlbum(){
		$Album=new AlbumModel();
		$album_id=I('$album_id');
		$this->ajaxReturn($Album->getModel($album_id));
	}
	//根据调价模糊分页查询合辑列表
	public function searchAlbumByCondition(){
		$Album=new AlbumModel();
		$album_name=I('album_name','','htmlspecialchars');
		$start_time=I('start_time');
		$end_time=I('end_time',time());
		$pageIndex = I ('pageIndex', 0 );
		$pageSize = I ('pageSize', 10 );
		$this->ajaxReturn($Album->searchAlbumByCondition($album_name, $start_time, $end_time, $pageIndex, $pageSize));
	}
}
?>