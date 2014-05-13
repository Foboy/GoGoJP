<?php

namespace Home\Controller;

use Think\Controller;
use Home\Model\PictureModel;
use Common\Common\DataResult;

class PictureManagementController extends Controller {
	public function index() {
		$this->show ( '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的PictureManagement控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>', 'utf-8' );
	}
	/**
	 * 上传图片 输出参数：图片保存名称
	 */
	public function upLoadImage() {
		$result = new DataResult ();
		$targetFolder = '/GoGoJP/www/upload'; // Relative to the root
		if (! empty ( $_FILES )) {
			$tempFile = $_FILES ['Filedata'] ['tmp_name'];
			$targetPath = $_SERVER ['DOCUMENT_ROOT'] . $targetFolder;
			if (! file_exists ( $targetPath )) {
				mkdir ( $_SERVER ['DOCUMENT_ROOT'] . $targetFolder );
			}
			$fileName = time () . $_FILES ['Filedata'] ['name'];
			$targetFile = rtrim ( $targetPath, '/' ) . '/' . $fileName;
			// Validate the file type
			$fileTypes = array (
					'jpg',
					'jpeg',
					'gif',
					'png' 
			); // File extensions
			$fileParts = pathinfo ( $_FILES ['Filedata'] ['name'] );
			if (in_array ( $fileParts ['extension'], $fileTypes )) {
				if (move_uploaded_file ( $tempFile, iconv ( 'UTF-8', 'gb2312', $targetFile ) )) {
					$src = realpath ( iconv ( 'UTF-8', 'gb2312', $targetFile ) );
					$url = "http://192.168.0.47/Api32/GoCurrency/uploadImg";
					$data = array (
							'file' => '@' . $src,
							'fileObjName' => 'file' 
					);
					exit ( PictureManagementController::UploadByCURL ( $data, $url ) );
				}
			} else {
				echo 'Invalid file type.';
			}
		}
	}
	/**
	 * 修整图片
	 */
	public function resizeImage() {
		$filename = I ( 'filename' );
		$src = $_SERVER ['DOCUMENT_ROOT'] . '/GoGoTown/trunk/crm/admin/upload/' . $filename;
		$imageSize = getimagesize ( $src );
		if ($imageSize [0] > 300 || $imageSize [1] > 300) {
			$jpeg_quality = 90;
			if ($imageSize [0] > $imageSize [1]) {
				$targ_w = 500;
				$scale = $targ_w / $imageSize [0];
				$targ_h = $imageSize [1] * $scale;
			} else {
				$targ_h = 500;
				$scale = $targ_h / $imageSize [1];
				$targ_w = $imageSize [0] * $scale;
			}
			
			$img_r = imagecreatefromjpeg ( $src );
			$dst_r = ImageCreateTrueColor ( $targ_w, $targ_h );
			imagecopyresampled ( $dst_r, $img_r, 0, 0, 0, 0, $targ_w, $targ_h, $imageSize [0], $imageSize [1] );
			imagejpeg ( $dst_r, $src, $jpeg_quality );
		}
	}
	/**
	 * 保存截屏图片
	 */
	public function saveScreenshotImage() {
		$targ_w = $targ_h = 150;
		$jpeg_quality = 90;
		$filename = $_POST ['filename'];
		$src = 'upload/' . $filename;
		/*
		 * $start = strrpos($filename,'.'); $length = strlen($filename); $dst = substr($filename, 0,$length-$start);
		 */
		$dst = 'upload/' . time () . '.jpg';
		$img_r = imagecreatefromjpeg ( $src );
		$dst_r = ImageCreateTrueColor ( $targ_w, $targ_h );
		
		imagecopyresampled ( $dst_r, $img_r, 0, 0, $_POST ['x'], $_POST ['y'], $targ_w, $targ_h, $_POST ['w'], $_POST ['h'] );
		
		imagejpeg ( $dst_r, $dst, $jpeg_quality );
		header ( "Content-type:image/jpeg" );
		imagejpeg ( $dst_r );
		imagedestroy ( $dst_r );
	}
	/* 手动post提交 */
	private function uploadByCURL($post_data, $post_url) {
		$curl = curl_init ();
		curl_setopt ( $curl, CURLOPT_URL, $post_url );
		curl_setopt ( $curl, CURLOPT_POST, 1 );
		curl_setopt ( $curl, CURLOPT_POSTFIELDS, $post_data );
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $curl, CURLOPT_USERAGENT, "Mozilla/5.0" );
		$result = curl_exec ( $curl );
		$error = curl_error ( $curl );
		curl_close ( $curl );
		return $result;
	}
	
	// 增加幻灯片
	public function addSlideShow() {
		$Pic = new PictureModel ();
		$title = I ( 'title', '', 'htmlspecialchars' );
		$bigPic = I ( 'bigPic' );
		$smallPic = I ( 'smallPic' );
		$albumId = I ( 'albumId' );
		$this->ajaxReturn ( $Pic->addModel ( $title, $bigPic, $smallPic, $albumId ) );
	}
	// 编辑幻灯片
	public function updateSlideShow() {
		$Pic = new PictureModel ();
		$picId = I ( 'picId' );
		$title = I ( 'title', '', 'htmlspecialchars' );
		$bigPic = I ( 'bigPic' );
		$smallPic = I ( 'smallPic' );
		$albumId = I ( 'albumId' );
		$this->ajaxReturn ( $Pic->updateModel ( $picId, $title, $bigPic, $smallPic, $albumId ) );
	}
	// 删除幻灯片
	public function deleteSlideShow() {
		$Pic = new PictureModel ();
		$picId = I ( 'picId' );
		$this->ajaxReturn ( $Pic->deleteModel ( $picId ) );
	}
	// 获取摸个幻灯片相信
	public function getSlideShow(){
		$Pic = new PictureModel ();
		$catid = I ( 'catid' );
		$this->ajaxReturn ( $Pic->getModel ( $catid ) );
	}
	// 获取幻灯片列表信息
	public function searchSlideShow() {
		$Pic = new PictureModel ();
		$pageIndex = I ( 'pageIndex', 0 );
		$pageSize = I ( 'pageSize', 10 );
		$this->ajaxReturn ( $Pic->searchByPage ( $pageIndex, $pageSize ) );
	}
}