<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Coupan_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function getRastByAreaId($cityid) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT )->order_by ( 'name', 'asc' );
		$this->db->where ( 'areaid', $cityid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		//print_r ( $result );
		return $result;
	}
	
	public function getRestaurant() {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addVendor($vendor) {
		$discount ['discount_by_rest'] = $vendor ['discount_by_rest'];
		$discount ['discount_type_rest'] = $vendor ['discount_type_rest'];
		$discount ['discount_type_zk'] = $vendor ['discount_type_zk'];
		$discount ['discount_by_zk'] = $vendor ['discount_by_zk'];
        $discount ['max_discount_value'] = $vendor ['max_discount_value'];
		unset ( $vendor ['discount_by_rest'] );
		unset ( $vendor ['discount_type_rest'] );
		unset ( $vendor ['discount_type_zk'] );
		unset ( $vendor ['discount_by_zk'] );
        unset ( $vendor ['max_discount_value']);
                
		$no_coupon;
		if ($vendor ['is_multiple'] == '0') {
			$coupon ['coupon_code'] = $vendor ['coupon_code'];
			$coupon ['status'] = $vendor ['status'];
			
			unset ( $vendor ['coupon_code'] );
			unset ( $vendor ['no_of_coupon_code'] );
		} else {
			$no_coupon = $vendor ['no_of_coupon'];
			unset ( $vendor ['no_of_coupon'] );
		}
		$coupon ['status'] = $vendor ['status'];
		$this->db->insert ( TABLES::$VENDOR, $vendor );
		$vendor_id = $this->db->insert_id ();
		if ($vendor ['is_multiple'] == '1') {
			$coupon = array ();
			for($i = 0; $i < $no_coupon; $i ++) {
				
				array_push ( $coupon, array (
						'coupon_code' => 'ZK' . rand (),
						'status' => $vendor ['status'],
						'vendor_id' => $vendor_id 
				) );
			}
			unset ( $vendor ['no_of_coupon'] );
		} else {
			$coupon ['vendor_id'] = $vendor_id;
		}
		$discount ['vendor_id'] = $vendor_id;
		if ($vendor ['is_multiple'] == '1') {
			$this->db->insert_batch ( TABLES::$COUPON, $coupon );
		} else {
			$this->db->insert ( TABLES::$COUPON, $coupon );
		}
		$this->db->insert ( TABLES::$DISCOUNT, $discount );
	}
	
	public function update($coupon) {
		
		$this->db->where ( 'id', $coupon['id'] );
		$this->db->update ( TABLES::$TBL_COUPON, $coupon );
	}
	
	public function getCouponsByVendorsId($a) {
		$this->db->select ( 'a.*' )->from ( TABLES::$COUPON . ' AS a' )->where ( 'a.vendor_id', $a );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getCouponId($a) {
		$this->db->select ( 'a.*' )->from ( TABLES::$TBL_COUPON . ' AS a' )->where ( 'a.id', $a );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getVendors() {
		$this->db->select ( 'DISTINCT(a.id),a.*,b.coupon_code,c.*,count(b.vendor_id)as coupon_count' )->from ( TABLES::$VENDOR . ' AS a' );
		$this->db->join ( TABLES::$COUPON . ' AS b', 'a.id=b.vendor_id', 'inner' );
		$this->db->join ( TABLES::$DISCOUNT . ' AS c', 'a.id=c.vendor_id', 'inner' );
		$this->db->group_by ( 'b.vendor_id' );
		
		$query = $this->db->get ();
		$result = $query->result_array ();
		
		return $result;
	}
	
	public function getVendorsById($a) {
		$this->db->select ( 'DISTINCT(a.id),a.*,b.coupon_code,c.*,count(b.vendor_id)as coupon_count' )->from ( TABLES::$VENDOR . ' AS a' )->where ( 'id', $a );
		$this->db->join ( TABLES::$COUPON . ' AS b', 'a.id=b.vendor_id', 'inner' );
		$this->db->join ( TABLES::$DISCOUNT . ' AS c', 'a.id=c.vendor_id', 'inner' );
		$this->db->group_by ( 'b.vendor_id' );
		
		$query = $this->db->get ();
		$result = $query->result_array ();
		
		return $result;
	}
	
	public function getDiscountByVendorId($a) {
		$this->db->select ( 'a.*' )->from ( TABLES::$DISCOUNT . ' AS a' )->where ( 'a.vendor_id', $a );
		$query = $this->db->get ();
		$result = $query->result_array ();
                //print_r($result);
		return $result;
	}
	
	public function getAllVendors() {
		$this->db->select ( 'id' )->from ( TABLES::$VENDOR );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getCoupons() {
		$this->db->select ( '*' )->from ( TABLES::$TBL_COUPON );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addDiscount($discount) {
		$this->db->insert ( TABLES::$DISCOUNT, $discount );
	}
	
	public function addCoupon($coupon) {
		$this->db->insert ( TABLES::$TBL_COUPON, $coupon );
		$data ['status'] = 1;
		$data ['msg'] = "Added successfully";
		return $data;
	}
	
	public function updateVendor($params) {
		$this->db->where ( 'id', $params ['id'] );
		unset ( $params ['id'] );
		$flag = $this->db->update ( TABLES::$VENDOR, $params );
	}
	
	public function getAreaidandCityidByRestaurant($a) {
		$v = explode ( ',', $a [0] ['restid'] );
		$this->db->select ( 'areaid,cityid' )->from ( TABLES::$RESTAURANT )->where ( 'id', $v [0] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function calculateDiscount($amount, $ccode, $restid) {
		$this->db->select ( 'vendor_id' )->from ( TABLES::$COUPON )->where ( 'coupon_code', $ccode );
		$query = $this->db->get ();
		$result = $query->result_array ();
		$vendorid = "";
		foreach ( $result as $r ) {
			$vendorid = $r ['vendor_id'];
		}
		$this->db->select ( '*' )->from ( TABLES::$DISCOUNT )->where ( 'vendor_id', $vendorid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		$amt = "";
		$p = 0;
		$p1 = 0;
		foreach ( $result as $r ) {
			if ($r ['discount_type_rest'] != '0') {
				if ($r ['discount_type_rest'] != 'Flat') {
					$p = round ( ($r ['discount_by_rest'] * $amount) / 100, 2 );
					$p = $amount - $p;
				} else {
					$p = $amount - $r ['discount_by_rest'];
				}
			}
			if ($r ['discount_type_rest'] != '0') {
				if ($r ['discount_type_zk'] != 'Flat') {
					$p1 = round ( ($r ['discount_by_rest'] * $amount) / 100, 2 );
					$p = $amount - ($p1 + $p);
				} else {
					$p = $p - $r ['discount_by_zk'];
				}
			}
		}
		// $p=100-20.7;
		return $p;
	}
	
	public function turnoffcoupon($a) {
		$coupon = array ();
		$coupon ['status'] = 1;
		$this->db->where ( 'id', $a );
		$this->db->update ( TABLES::$VENDOR, $coupon );
		$this->db->where ( 'vendor_id', $a );
		$this->db->update ( TABLES::$COUPON, $coupon );
	}
	
	public function turnoncoupon($a) {
		$coupon = array ();
		$coupon ['status'] = 0;
		$this->db->where ( 'id', $a );
		$this->db->update ( TABLES::$VENDOR, $coupon );
		$this->db->where ( 'vendor_id', $a );
		$this->db->update ( TABLES::$COUPON, $coupon );
		$this->db->where ( 'vendor_id', $a );
		$this->db->update ( TABLES::$COUPON, $coupon );
	}
	
	public function deleteVendor($vendorid) {
		$this->db->where ( 'id', $vendorid );
		$this->db->delete ( TABLES::$VENDOR );
		$this->db->where ( 'vendor_id', $vendorid );
		$this->db->delete ( TABLES::$COUPON );
		$this->db->where ( 'vendor_id', $vendorid );
		$this->db->delete ( TABLES::$DISCOUNT );
	}
	
	public function statusoffcoupon($coupon_code) {
		$coupon = array ();
		$coupon ['status'] = 1;
		$this->db->where ( 'coupon_code', $coupon_code );
		$this->db->update ( TABLES::$COUPON, $coupon );
	}
	
	public function statusoncoupon($coupon_code) {
		$coupon = array ();
		$coupon ['status'] = 0;
		$this->db->where ( 'coupon_code', $coupon_code );
		$this->db->update ( TABLES::$COUPON, $coupon );
	}
	
	public function getCouponDetailByCode($coupon_code, $date, $time) {
		$this->db->select ( 'a.*,c.max_discount_value,c.discount_by_zk,c.discount_by_rest,c.discount_type_zk,c.discount_type_rest,b.coupon_code' )->from ( TABLES::$VENDOR . ' AS a' );
		$this->db->join ( TABLES::$COUPON . ' AS b', 'a.id=b.vendor_id', 'inner' );
		$this->db->join ( TABLES::$DISCOUNT . ' AS c', 'a.id=c.vendor_id', 'inner' );
		$this->db->where ( 'b.coupon_code', $coupon_code );
		$this->db->where ( 'a.status', 1 );
		$this->db->where ( "'" . $date . "' BETWEEN a.from_date AND a.to_date", "", false );
		$this->db->where ( "'" . $time . "' BETWEEN a.from_time AND a.to_time", "", false );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveSpecificCoupons() {
		$current_date = date('Y-m-d');
		$this->db->select ( '*' )->from ( TABLES::$VENDOR );
		$this->db->where('is_specific',1);
		$this->db->where('status',1);
		$this->db->where("'".$current_date."' BETWEEN from_date AND to_date",'',false);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getInActiveSpecificCoupons() {
		$current_date = date('Y-m-d');
		$this->db->select ( '*' )->from ( TABLES::$VENDOR );
		$this->db->where('is_specific',1);
		$this->db->where('status',1);
		$this->db->where("to_date <= '".$current_date."'",'',false);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getOrdersByCouponCode($map) {
		if(!empty($map['email']) && !empty($map['mobile'])) {
			$this->db->select('a.orderid', FALSE)
					 ->from(TABLES::$ORDER.' AS a')
					 ->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid')
					 ->where('a.coupon_code',$map['coupon_code'])
					 ->where("(b.email = '".$map['email']."' OR b.mobile = '".$map['mobile']."')",'',false)
					 ->where('a.status IN(0,1)','',false);
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		} else {
			return array();
		}
	}
	
	public function isCouponAlreadyUsed($coupon_code) {
		$this->db->select('count(orderid) as orders', FALSE)
				 ->from(TABLES::$ORDER)
				 ->where('coupon_code',$coupon_code)
				 ->where('status IN(0,1)','',false);
		$query = $this->db->get();
		$result = $query->result_array();
		if(count($result) > 0) {
			if($result[0]['orders'] > 0) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	
	public function getUserOrdersCount($map) {
		if(!empty($map['email']) && !empty($map['mobile'])) {
			$this->db->select('a.orderid,a.delivery_date,a.status', FALSE)
					 ->from(TABLES::$ORDER.' AS a')
					 ->join(TABLES::$ORDER_CUSTOMER.' AS b','a.orderid=b.orderid')
					 ->where("(b.email = '".$map['email']."' OR b.mobile = '".$map['mobile']."')",'',false)
					 ->where('a.status IN(0,1)','',false);
			$query = $this->db->get();
			$result = $query->result_array();
			$is_first_time = 0;
			$current_date = date('Y-m-d');
			if (count($result) > 0) {
				foreach ($result as $order) {
					if($order['status'] == 1) {
						$is_first_time = 1;
					} else {
						if($order['delivery_date'] >= $current_date) {
							$is_first_time = 1;
						}
					}
				}
			} else {
				$is_first_time = 0;
			}
			return $is_first_time;
		} else {
			return 0;
		}
	}
	
	public function getRestaurantOffer($restid) {
		$date = date('Y-m-d');
		$time = date('H:i:s');
		$this->db->select ( 'a.minimum_order_value,a.applicable_for,c.max_discount_value,(c.discount_by_zk+c.discount_by_rest) as discount,c.discount_type_zk as discount_type,b.coupon_code' )->from ( TABLES::$VENDOR . ' AS a' );
		$this->db->join ( TABLES::$COUPON . ' AS b', 'a.id=b.vendor_id', 'inner' );
		$this->db->join ( TABLES::$DISCOUNT . ' AS c', 'a.id=c.vendor_id', 'inner' );
		$this->db->where ( "FIND_IN_SET('".$restid."',a.restid) !=",0);
		$this->db->where ( 'a.status', 1 );
		$this->db->where ( "'" . $date . "' BETWEEN a.from_date AND a.to_date", "", false );
		$this->db->where ( "'" . $time . "' BETWEEN a.from_time AND a.to_time", "", false );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}		
	
	public function getCouponCodeByCode($code){		
		$this->db->select('*');		
		$this->db->from(TABLES::$COUPON);		
		$this->db->where('coupon_code',$code);		
		$query = $this->db->get();		
		$result = $query->result_array();		
		return $result;	
	}
	
	public function getActiveCoupons() {
		$current_date = date('Y-m-d');
		$this->db->select ( '*' )->from ( TABLES::$TBL_COUPON );
		//$this->db->where('is_specific',1);
		$this->db->where('status',1);
		$this->db->where("'".$current_date."' BETWEEN start_date AND end_date",'',false);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
}