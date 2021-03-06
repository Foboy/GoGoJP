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
	//删除合辑关联商品
	public function deleteAlbumProduct(){
		$album_product_id=I('album_product_id',0);
		$AlbumProduct=new AlbumProductModel();
		$this->ajaxReturn($AlbumProduct->deleteModel($album_product_id)) ;
		
	}
	//ɾ��ϼ�
	public function deleteAlbum(){
		
	}
	//���ºϼ�
	public function updateAlbum(){
		$Album=new AlbumModel();
		$album_id=I('album_id');
		$album_name=I('album_name');
		$album_cover=I('album_cover');
		$album_description=$_POST ['album_description'];
		$album_status=I('album_status');
		$productids=rtrim(I('productids'),',') ;
		$albumproduct_ids=rtrim(I('albumproduct_ids'),',');
		$album_tag_id=I('tagid',0);
		$result= $this->updateAlbumProduct($album_id,$productids,$albumproduct_ids);
		if($result->Error==ErrorType::Success){
		$this->ajaxReturn($Album->updateModel($album_id,$album_name,$album_cover,$album_description,$album_status,$album_tag_id));
		}
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
		$start_time=I('start_time','');
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
			return $result;
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '���ʧ��';
			return $result;
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
	
	public function searchAlbumProductByAlbumId(){
		$album_id=I('album_id');
		$AlbumProduct=new AlbumProductModel();
		$this->ajaxReturn ( $AlbumProduct->searchAlbumProductByAlbumId($album_id));
	}
	
	public function deleteAlbumProductList($albumproduct_ids)
	{
		$albumproductid_array=explode(',',trim($albumproduct_ids,'') );
		$AlbumProduct=new AlbumProductModel();
		if (count ($albumproductid_array ) > 0 && $albumproductid_array[0]!='') {
			for($i = 0; $i < count ( $albumproductid_array ); $i ++) {
				$AlbumProduct->deleteModel($albumproductid_array[$i]);
			}
		}
	}
	public function updateAlbumProduct($albumid,$productids,$albumproduct_ids)
	{
		/* $this->deleteAlbumProductList($albumproduct_ids); */
		$aresult= $this->addAlbumProduct($albumid, $productids);
		$result=new DataResult();
		return $result;
	}
}
?>