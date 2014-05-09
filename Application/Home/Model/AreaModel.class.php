<?php
/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/6 19:24:20
 */
namespace Home\Model;
use Think\Model;
use Common\Common\DataResult;

class AreaModel extends Model {
	protected $tableName = 'area';
	
	// 根据主键id获取某个专辑信息
	public function getModel($id) {
		$result = new DataResult ();
		$result->Data = $this->where ( 'id=%d', $id )->select ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPid($pid) {
		$result = new DataResult ();
		$result->Data = $this->where ( 'pid=%d', $pid )->field('id,name')->select ();
		return $result;
	}
}