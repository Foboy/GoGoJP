
<?php

namespace Home\Model;

use Think\Model;
use Common\Common\PageDataResult;
use Think\Db\Driver\Pdo;
use Common\Common\DataResult;
use Common\Common\ErrorType;

class ShippingaddressModel extends Model {
	protected $tableName = 'shippingaddress';
	// 增加表中数据
	public function addModel($receive_name,$receive_address,$receive_mobile,$user_id,$receive_postcode,$receive_phone,$province_id,$city_id,$county_id,$country_id,$create_time) {
		$result = new DataResult ();
		$data = array (
':receive_name' => $receive_name,
                   ':receive_address' => $receive_address,
                   ':receive_mobile' => $receive_mobile,
                   ':user_id' => $user_id,
                   ':receive_postcode' => $receive_postcode,
                   ':receive_phone' => $receive_phone,
                   ':province_id' => $province_id,
                   ':city_id' => $city_id,
                   ':county_id' => $county_id,
                   ':country_id' => $country_id,
                   ':create_time' => $create_time
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
	public function deleteModel($shipping_id) {
		$result = new DataResult ();
		if ($this->where ( 'shipping_id=%d', $shipping_id )->delete () == 1) {
			$result->ErrorMessage = '删除成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '删除失败';
		}
		return $result;
	}
	// 编辑表中数据
	public function updateModel($shipping_id,$receive_name,$receive_address,$receive_mobile,$user_id,$receive_postcode,$receive_phone,$province_id,$city_id,$county_id,$country_id,$create_time) {
		$result = new DataResult ();
		$data = array (
':shipping_id' => $shipping_id,
                   ':receive_name' => $receive_name,
                   ':receive_address' => $receive_address,
                   ':receive_mobile' => $receive_mobile,
                   ':user_id' => $user_id,
                   ':receive_postcode' => $receive_postcode,
                   ':receive_phone' => $receive_phone,
                   ':province_id' => $province_id,
                   ':city_id' => $city_id,
                   ':county_id' => $county_id,
                   ':country_id' => $country_id,
                   ':create_time' => $create_time
		);
		// 注意判断条件使用恒等式
		if ($this->where ( 'shipping_id=%d', $shipping_id )->save ( $data ) !== false) {
			$result->Data = $this->find ( $shipping_id );
			$result->ErrorMessage = '更新成功';
		} else {
			$result->Error = ErrorType::Failed;
			$result->ErrorMessage = '更新成功';
		}
		return $result;
	}
	// 根据主键id获取某个专辑信息
	public function getModel($shipping_id) {
		$result = new DataResult ();
		$result->Data = $this->where ( 'shipping_id=%d', $shipping_id )->select ();
		return $result;
	}
	// 根据主键id获取某个专辑信息
	public function searchUserAddress($user_id) {
		$result = new DataResult ();
		$result->Data = $this->where ( 'user_id=%d', $user_id )->select ();
		return $result;
	}
	// 获取图片管理表中分页数据
	public function searchByPage($receive_name,$receive_address,$receive_mobile,$user_id,$receive_postcode,$receive_phone,$province_id,$city_id,$county_id,$country_id,$create_time, $pageindex, $pagesize) {
		$result = new PageDataResult ();
		$lastpagenum = $pageindex * $pagesize;
		$conn = new Pdo ();
		$objects = $conn->query ( " select shipping_id,receive_name,receive_address,receive_mobile,user_id,receive_postcode,receive_phone,province_id,city_id,county_id,country_id,create_time from gogojp_shippingaddress where  ( receive_name = :receive_name or :receive_name='' ) 
 and  ( receive_address = :receive_address or :receive_address='' ) 
 and  ( receive_mobile = :receive_mobile or :receive_mobile=0 ) 
 and  ( user_id = :user_id or :user_id=0 ) 
 and  ( receive_postcode = :receive_postcode or :receive_postcode='' ) 
 and  ( receive_phone = :receive_phone or :receive_phone='' ) 
 and  ( province_id = :province_id or :province_id=0 ) 
 and  ( city_id = :city_id or :city_id=0 ) 
 and  ( county_id = :county_id or :county_id=0 ) 
 and  ( country_id = :country_id or :country_id=0 ) 
 and  ( create_time = :create_time or :create_time='' ) 
 limit $lastpagenum,$pagesize", array (
':receive_name' => $receive_name,
                   ':receive_address' => $receive_address,
                   ':receive_mobile' => $receive_mobile,
                   ':user_id' => $user_id,
                   ':receive_postcode' => $receive_postcode,
                   ':receive_phone' => $receive_phone,
                   ':province_id' => $province_id,
                   ':city_id' => $city_id,
                   ':county_id' => $county_id,
                   ':country_id' => $country_id,
                   ':create_time' => $create_time
			)  );
		$data = $conn->query ( " select count(*) totalcount  from gogojp_shippingaddress where  ( receive_name = :receive_name or :receive_name='' ) 
 and  ( receive_address = :receive_address or :receive_address='' ) 
 and  ( receive_mobile = :receive_mobile or :receive_mobile=0 ) 
 and  ( user_id = :user_id or :user_id=0 ) 
 and  ( receive_postcode = :receive_postcode or :receive_postcode='' ) 
 and  ( receive_phone = :receive_phone or :receive_phone='' ) 
 and  ( province_id = :province_id or :province_id=0 ) 
 and  ( city_id = :city_id or :city_id=0 ) 
 and  ( county_id = :county_id or :county_id=0 ) 
 and  ( country_id = :country_id or :country_id=0 ) 
 and  ( create_time = :create_time or :create_time='' ) 
", array (
':receive_name' => $receive_name,
                   ':receive_address' => $receive_address,
                   ':receive_mobile' => $receive_mobile,
                   ':user_id' => $user_id,
                   ':receive_postcode' => $receive_postcode,
                   ':receive_phone' => $receive_phone,
                   ':province_id' => $province_id,
                   ':city_id' => $city_id,
                   ':county_id' => $county_id,
                   ':country_id' => $country_id,
                   ':create_time' => $create_time
			)  );
		$totalcount=$data[0]['totalcout'];
		$result->pageindex = $pageindex;
		$result->pagesize = $pagesize;
		$result->Data = $objects;
		$result->totalcount = $totalcount;
		return $result;
	}
}