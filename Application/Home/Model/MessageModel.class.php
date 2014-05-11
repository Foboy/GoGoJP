<?php
/**
 * @author yangchao
 * @email:66954011@qq.com
 * @date: 2014/5/9 11:53:28
 */
namespace Home\Model;
use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class MessageModel extends Model {
	protected $tableName = 'message';
	// 增加表中数据
	public function addModel($form_userid,$to_userid,$content,$create_time) {
		$result = new DataResult ();
		$data = array (
'form_userid' => $form_userid,
                   'to_userid' => $to_userid,
                   'content' => $content
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
	// 删除表中数据
	public function deleteModel($messageid) {
		$result = new DataResult ();
        $map['messageid']=$messageid;
		if ($this->where ($map)->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 编辑表中数据
	public function updateModel($messageid,$form_userid,$to_userid,$content,$create_time,$advisory_id) {
		$result = new DataResult ();
		$data = array (
':messageid' => $messageid,
                   ':form_userid' => $form_userid,
                   ':to_userid' => $to_userid,
                   ':content' => $content,
                   ':create_time' => $create_time,
                   ':advisory_id' => $advisory_id
		);
		// 注意判断条件使用恒等式
        $map['messageid']=$messageid;
		if ($this->where ($map )->save ( $data ) !== false) {
			$result->Data = $this->find ( $messageid );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 根据主键id获取某个专辑信息
	public function getModel($messageid) {
		$result = new DataResult ();
        $map['messageid']=$messageid;
		$result->Data = $this->where ($map )->select ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($form_userid,$to_userid,$content,$create_time,$advisory_id, $pageindex, $pagesize) {
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$conn = new Pdo ();
		$objects = $conn->query ( " select messageid,form_userid,to_userid,content,create_time,advisory_id from gogojp_message where  ( form_userid = :form_userid or :form_userid=0 )
 and  ( to_userid = :to_userid or :to_userid=0 )
 and  ( content = :content or :content='' )
 and  ( create_time = :create_time or :create_time='' )
 and  ( advisory_id = :advisory_id or :advisory_id=0 )
 limit $lastpagenum,$pagesize", array (
':form_userid' => $form_userid,
                   ':to_userid' => $to_userid,
                   ':content' => $content,
                   ':create_time' => $create_time,
                   ':advisory_id' => $advisory_id
			)  );
		$data = $conn->query ( " select count(*) totalcount  from gogojp_message where  ( form_userid = :form_userid or :form_userid=0 )
 and  ( to_userid = :to_userid or :to_userid=0 )
 and  ( content = :content or :content='' )
 and  ( create_time = :create_time or :create_time='' )
 and  ( advisory_id = :advisory_id or :advisory_id=0 )
", array (
':form_userid' => $form_userid,
                   ':to_userid' => $to_userid,
                   ':content' => $content,
                   ':create_time' => $create_time,
                   ':advisory_id' => $advisory_id
			)  );
		$totalcount=$data[0]['totalcout'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}