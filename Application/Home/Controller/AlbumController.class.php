<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\AlbumModel;
use Home\Model\AlbumProductModel;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class AlbumController extends Controller {
	public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "΢���ź�"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>��ӭʹ�� <b>ThinkPHP</b>��</p><br/>[ �����ڷ��ʵ���Homeģ���Album������ ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
	}
	//�����ϼ�
	public function addAlbum()
	{ 
		$productids=rtrim(I('productids'),',') ;
		$Album=new AlbumModel();
		$this->ajaxReturn($this->addAlbumProduct($Album->addModel()->Data['album_id'],$productids)) ;
	}
	//ɾ��ϼ�
	public function deleteAlbum(){
		
	}
	//���ºϼ�
	public function updateAlbum(){
		$Album=new AlbumModel();
		$album_id=I('album_id');
		$this->ajaxReturn($Album->updateModel($album_id));
	}
	//��������ȡĳ���ϼ���Ϣ
	public function getAlbum(){
		$Album=new AlbumModel();
		$album_id=I('album_id');
		$this->ajaxReturn($Album->getModel($album_id));
	}
	//��ݵ���ģ���ҳ��ѯ�ϼ��б�
	public function searchAlbumByCondition(){
		$Album=new AlbumModel();
		$album_name=I('album_name','','htmlspecialchars');
		$start_time=I('start_time');
		$end_time=I('end_time',time());
		$pageIndex = I ('pageIndex', 0 );
		$pageSize = I ('pageSize', 10 );
		$this->ajaxReturn($Album->searchAlbumByCondition($album_name, $start_time, $end_time, $pageIndex, $pageSize));
	}
	//�����Ʒ
	public function addAlbumProduct($albumid,$productids)
	{
		$productid_array=explode(',',trim($productids,'') );
		$AlbumProduct=new AlbumProductModel();
		$result = new DataResult();
		$result->ErrorMessage = '��ӳɹ�';
		if (count ($productid_array ) > 0 && $productid_array[0]!='') {
			for($i = 0; $i < count ( $productid_array ); $i ++) {
				$AlbumProduct->addModel($productid_array[$i],$albumid);
			}
			
			$this->ajaxReturn ( $result );
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '���ʧ��';
			$this->ajaxReturn ( $result );
		}
	}
		// ǰ���Ƿ���ʾ�ϼ�
	public function isShow() {
		$Album = new AlbumModel ();
		$album_id=I('album_id');
		$album_name = I ( 'album_name', '', 'htmlspecialchars' );
		$album_cover = I ( 'album_cover' );
		$album_description = I ( 'album_description' );
		$album_status = I ( 'album_status' );
		if($album_status==1){
			$album_status=2;
		}else
		{
			$album_status=1;
		}
		$this->ajaxReturn ( $Album->updateModel ($album_id,$album_name,$album_cover,$album_description,$album_status) );
	}
}
?>