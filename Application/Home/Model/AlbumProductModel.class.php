<?php

namespace Home\Model;

use Think\Model;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class AlbumProductModel extends Model {
	protected $tableName = 'album_product';
	// 新增合辑商品
	public function addModel($product_id,$album_id) {
		$result = new DataResult ();
		$data = array (
				'product_id' => $product_id,
				'album_id'=>$album_id
		);
		$pid = $this->add ( $data );
		if ($pid > 0) {
			$result->Data = $this->find ( $pid );
			$result->ErrorMessage = '新增成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '新增失败';
		}
		return $result;
	}
	// 删除合辑商品
	public function deleteModel($album_product_id) {
		$result = new DataResult ();
		if ($this->where ( 'album_product_id=%d', $album_product_id )->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 根据专辑id查询与专辑相关联的专辑商品列表
	public function searchAlbumProductByAlbumId($album_id) {
		$result = new DataResult ();
		$result->Data = $this->where ( 'album_id=%d', $album_id)->select ();
		return $result;
	}
}
?>