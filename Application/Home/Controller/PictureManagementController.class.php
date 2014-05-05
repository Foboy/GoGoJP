<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\PictureModel;

class PictureManagementController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的PictureManagement控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	// 获取幻灯片列表信息
	public function searchSlideShow() {
		$Pic = new PictureModel ();
		$pageIndex = I ('pageIndex', 0 );
		$pageSize = I ('pageSize', 10 );
		$this->ajaxReturn ( $Pic->searchByPage ( $pageIndex, $pageSize ) );
	}
	//增加幻灯片
	public function addSlideShow(){
		$Pic=new PictureModel();
		$title=I('title','','htmlspecialchars');
		$bigPic=I('bigPic');
		$smallPic=I('smallPic');
		$albumId=I('albumId');
		$this->ajaxReturn($Pic->addModel($title, $bigPic, $smallPic, $albumId));
	}
	//编辑幻灯片
	public function updateSlideShow(){
		$Pic=new PictureModel();
		$picId=I('picId');
		$title=I('title','','htmlspecialchars');
		$bigPic=I('bigPic');
		$smallPic=I('smallPic');
		$albumId=I('albumId');
		$this->ajaxReturn($Pic->updateModel($picId, $title, $bigPic, $smallPic, $albumId));
	}
	//删除幻灯片
	public function deleteSlideShow(){
		$Pic=new PictureModel();
		$picId=I('picId');
		$this->ajaxReturn($Pic->deleteModel($picId));
	}
}