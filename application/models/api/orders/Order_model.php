<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI_Model API for order management .
 *
 * <p>
 * We are using this model to add/update orders.
 * </p>
 * @package Orders
 * @subpackage orders-model
 * @author pradeep singh
 * @category CI_Model API
 */
class Order_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

	/**********code by kunal*************/

	public function getOrderListByuserID($userid) {
		$this->db->select('a.*,b.name, b.mobile, b.email,b.outstanding, rd.rider_name, rd.mobile as rider_mobile, adrs.*, vh.vehicle_no, vendor.garage_name, vendor.email as vendor_email,vendor.mobile as vendor_mobile, vendor.locality as vendor_locality, vendor.latitude as vendor_latitude, vendor.longitude as vendor_longitude, vendor.address as vendor_address, vendor.landmark as vendor_landmark, vendor.pincode as vendor_pincode, st_sub.name as subcategory_name, e.invoice_url,e.invoice_date,e.id as invoice_id,e.status as invoice_s,f.transactionid,f.status as payment_status,f.payment_date,
                f.longurl,g.name as category,h.name as brand,i.name as model,j.name as subcategory,k.name as service,l.commission_service,l.commission_spare,j.sub_id', FALSE)
                 ->from(TABLES::$ORDER.' AS a')
                 ->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
                 ->join(TABLES::$RIDER.' AS rd','rd.rider_id = a.assign_rider_id','left')
                 ->join(TABLES::$USER_ADDRESS.' AS adrs','adrs.id = a.address_id','left')
                 ->join(TABLES::$USER_VEHICLES.' AS vh','vh.id = a.vehicle_id','left')
                 ->join(TABLES::$RESTAURANT.' AS vendor','vendor.id = a.assign_vendor_id','left')
                 ->join(TABLES::$INVOICE.' AS e','a.orderid = e.orderid','left')
                 ->join(TABLES::$PAYMENT_DETAIL.' AS f','a.orderid = f.orderid','left')
                 ->join(TABLES::$MENU_MAIN_CATEGORY.' AS g','a.category_id = g.id','left')
                 ->join(TABLES::$STATIC_SUBCATEGORY.' AS st_sub','st_sub.id = a.subcategory_id','left')
                 ->join(TABLES::$BRAND.' AS h','a.brand_id = h.id','left')
                 ->join(TABLES::$MANUFACTURE.' AS i','a.vehicle_model = i.id','left')
                 ->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS j','a.subcategory_id = j.id','left')
                 ->join(TABLES::$SERVICE.' AS k','a.service_id = k.id','left')
                 ->join(TABLES::$RESTAURANT_BILLING_CONFIG.' AS l','a.vendor_id = l.restid','left');
	
		$this->db->where('a.userid', $userid);
		// $this->db->order_by('a.orderid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function getOrderListByRiderID($riderid)
	{
		// $where = "status <> 7";
		$this->db->select('*')->from(TABLES::$ORDER);
		$this->db->where('assign_rider_id',$riderid);
		// $this->db->where($where);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function getOrderDetails($ordercode) {
        $this->db->select('a.*,b.name, b.mobile, b.email,b.outstanding, rd.rider_name, rd.mobile as rider_mobile, adrs.*, vh.vehicle_no, vendor.garage_name, vendor.email as vendor_email,vendor.mobile as vendor_mobile, vendor.locality as vendor_locality, vendor.latitude as vendor_latitude, vendor.longitude as vendor_longitude, vendor.address as vendor_address, vendor.landmark as vendor_landmark, vendor.pincode as vendor_pincode, st_sub.name as subcategory_name, e.invoice_url,e.invoice_date,e.id as invoice_id,e.status as invoice_s,f.transactionid,f.status as payment_status,f.payment_date,
                f.longurl,g.name as category,h.name as brand,i.name as model,j.name as subcategory,k.name as service,l.commission_service,l.commission_spare,j.sub_id', FALSE)
                 ->from(TABLES::$ORDER.' AS a')
                 ->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
                 ->join(TABLES::$RIDER.' AS rd','rd.rider_id = a.assign_rider_id','left')
                 ->join(TABLES::$USER_ADDRESS.' AS adrs','adrs.id = a.address_id','left')
                 ->join(TABLES::$USER_VEHICLES.' AS vh','vh.id = a.vehicle_id','left')
                 ->join(TABLES::$RESTAURANT.' AS vendor','vendor.id = a.assign_vendor_id','left')
                 ->join(TABLES::$INVOICE.' AS e','a.orderid = e.orderid','left')
                 ->join(TABLES::$PAYMENT_DETAIL.' AS f','a.orderid = f.orderid','left')
                 ->join(TABLES::$MENU_MAIN_CATEGORY.' AS g','a.category_id = g.id','left')
                 ->join(TABLES::$STATIC_SUBCATEGORY.' AS st_sub','st_sub.id = a.subcategory_id','left')
                 ->join(TABLES::$BRAND.' AS h','a.brand_id = h.id','left')
                 ->join(TABLES::$MANUFACTURE.' AS i','a.vehicle_model = i.id','left')
                 ->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS j','a.subcategory_id = j.id','left')
                 ->join(TABLES::$SERVICE.' AS k','a.service_id = k.id','left')
                 ->join(TABLES::$RESTAURANT_BILLING_CONFIG.' AS l','a.vendor_id = l.restid','left');
        
        //$this->db->where('a.orderid', $ordercode);
        if(is_numeric($ordercode))
            $this->db->where('a.orderid', $ordercode);
        else
            $this->db->where('a.ordercode', $ordercode);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }


	/**********code by kunal*************/


	public function addOrder( $map ) {
		$this->db->select('count(orderid) as orders', FALSE)
				 ->from(TABLES::$ORDER);
		$this->db->where('userid',$map['userid']);
	//	$this->db->where('status',4);
		$query = $this->db->get();
		$result = $query->result_array();
		if(count($result) > 0 && $result[0]['orders'] > 0) {
			$umap = array('is_new_customer'=>0);
			$this->db->where ( 'id', $map ['userid'] );
			$this->db->update ( TABLES::$USER, $umap );
		}
		$this->db->insert(TABLES::$ORDER,$map);
		return $this->db->insert_id();
	}
	
	public function addCategory( $map ) {
	foreach($map as $row){
	             	$catvalue['orderid'] = $row['orderid'];
					$catvalue['category_name'] = $row['category_name'];
					$this->db->insert ( TABLES::$CATEGORY, $catvalue);
				
			
		}	
	}
	
	public function updateOrder( $map ) {
		$this->db->where('orderid',$map['orderid']);
		return $this->db->update(TABLES::$ORDER,$map);
		
	}
	
	
	public function getAllOrderDetails() {
		$abc = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." -10 minutes"));
		echo $abc;
		$this->db->select('a.orderid,a.status,a.vendor_id,a.other_vendorid,a.vendor_response,a.ordered_on,b.name, b.mobile, b.email', FALSE)
					->from(TABLES::$ORDER.' AS a')
					->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->where('a.vendor_response', 0);
		$this->db->where('a.status', 2);
		$this->db->where('a.vendor_id>=', 0);
		//$this->db->where('a.ordered_on >= ','NOW() - INTERVAL 10 MINUTE');
		$this->db->where('a.updated_datetime  <=', $abc);
	    $query = $this->db->get();
		$result = $query->result_array();
		echo $this->db->last_query();
		return $result;
	}
	
	public function getAllDetails($userid) {
		$this->db->select('a.*,b.name, b.mobile, b.email,b.outstanding,e.invoice_url,e.invoice_date,e.id as invoice_id,f.transactionid,f.status as payment_status,f.payment_date,
				f.longurl,g.name as category,h.name as brand,i.name as model,j.name as subcategory,k.name as service', FALSE)
					->from(TABLES::$ORDER.' AS a')
					->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
					->join(TABLES::$INVOICE.' AS e','a.orderid = e.orderid','left')
					->join(TABLES::$PAYMENT_DETAIL.' AS f','a.orderid = f.orderid','left')
					->join(TABLES::$MENU_MAIN_CATEGORY.' AS g','a.category_id = g.id','left')
					->join(TABLES::$BRAND.' AS h','a.brand_id = h.id','left')
					->join(TABLES::$MANUFACTURE.' AS i','a.vehicle_model = i.id','left')
					->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS j','a.subcategory_id = j.id','left')
					->join(TABLES::$SERVICE.' AS k','a.service_id = k.id','left');
	
		$this->db->where('a.orderid', $userid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	public function getlatestOrderDetails($userid) {
		$this->db->select('a.*,b.name, b.mobile, b.email,b.outstanding,c.name as pickup_boy,c.mobile as pickup_boy_mobile,d.name as del_boy,d.mobile as del_boy_mobile,e.invoice_url,e.invoice_date,e.id as invoice_id,f.transactionid,f.status as payment_status,f.payment_date,f.longurl', FALSE)
		->from(TABLES::$ORDER.' AS a')
		->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
		->join(TABLES::$FIELD_EXECUTIVE.' AS c','a.pickup_exe_id = c.id','left')
		->join(TABLES::$FIELD_EXECUTIVE.' AS d','a.delivery_exe_id = d.id','left')
		->join(TABLES::$INVOICE.' AS e','a.orderid = e.orderid','left')
		->join(TABLES::$PAYMENT_DETAIL.' AS f','a.orderid = f.orderid','left');
	
		$this->db->where('a.userid', $userid);
		$this->db->where('a.status',0);
		$this->db->order_by('a.orderid','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function getOrderDetailsByIds($orderids) {
		$this->db->select('a.*,b.name, b.mobile, b.email', FALSE)
				 ->from(TABLES::$ORDER.' AS a')
				 ->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->where('a.orderid IN('.$orderids.')','',false);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function filterOrders($map) {
		$this->db->select('a.*,b.name, b.mobile, b.email,b.area');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		if($map['status'] != "")
		$this->db->where('a.status',$map['status']);
		if(!empty($map['pickup_date'])) {
			$pickup_date = date('Y-m-d',strtotime($map['pickup_date']));
			$this->db->where('a.pickup_date',$pickup_date);
		}
		if(!empty($map['delivery_date'])) {
			$delivery_date = date('Y-m-d',strtotime($map['delivery_date']));
			$this->db->where('a.tml_delivery_date',$delivery_date);
		}
		if(!empty($map['email'])) {
			$this->db->where('b.email',$map['email']);
		}
		if(!empty($map['mobile'])) {
			$this->db->where('b.mobile',$map['mobile']);
		}
		if(!empty($map['name'])) {
			$this->db->like('b.name',$map['name'],'both');
		}
		$this->db->order_by('a.orderid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getPendingOrdersByDate() {
		$current_date = date('Y-m-d');
		$this->db->select('a.*,b.name, b.mobile, b.email');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->where('a.status',0);
		//$this->db->where('a.ordered_on >=',$current_date);
		$this->db->order_by('a.orderid','desc');
		$this->db->limit(200);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getAssignedOrdersByDate() {
		$current_date = date('Y-m-d');
		$this->db->select('a.*,b.name, b.mobile, b.email');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->where('a.status',1);
		//$this->db->where('a.ordered_on >=',$current_date);
		$this->db->order_by('a.orderid','desc');
		$this->db->limit(200);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function getRejectedOrdersByDate() {
		$current_date = date('Y-m-d');
		$this->db->select('a.*,b.name, b.mobile, b.email');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->where('a.status',1);
		$this->db->where('a.is_accepted',2);
		//$this->db->where('a.ordered_on >=',$current_date);
		$this->db->order_by('a.orderid','desc');
		$this->db->limit(200);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOngoingOrdersByDate() {
		$current_date = date('Y-m-d');
		$this->db->select('a.*,b.name, b.mobile, b.email');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->where('a.status',2);
		//$this->db->where('a.ordered_on >=',$current_date);
		$this->db->order_by('a.orderid','desc');
		$this->db->limit(200);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function ongoingOrdersByUSer($params) {
		$this->db->select ('a.orderid, a.ordercode,a.pickup_date,a.slot,a.status, a.accepted_by,b.name, b.mobile, b.email');
		$this->db->select ( 's.name AS service_name');
		$this->db->select ( 'm.name AS model_name');
		$this->db->select ( 'br.name AS brand_name');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->join ( TABLES::$SERVICE.' AS s','s.id=a.catsubcat_id', 'left' );		
		$this->db->join ( TABLES::$MANUFACTURE.' AS m','m.id=a.vehicle_model', 'left' );		
		$this->db->join ( TABLES::$BRAND.' AS br','br.id=a.brand_id', 'left' );		
		$where = '(a.userid = '.$params['user_id'].' and (a.status <> "2" or a.status="3"))';
		$this->db->where($where);
		$this->db->order_by('a.orderid','desc');
 		$query = $this->db->get();
 		$result = $query->result_array (); 
		return $result; 
	}	
	
	public function getApprovalOrdersByDate() {
		$current_date = date('Y-m-d');
		$this->db->select('a.*,b.name, b.mobile, b.email');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->where('a.status',3);
		//$this->db->where('a.ordered_on >=',$current_date);
		$this->db->order_by('a.orderid','desc');
		$this->db->limit(200);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getCompletedOrdersByDate() {
		//$date = date('Y-m-d',strtotime('-2 days'));
		$this->db->select('a.*,b.name, b.mobile, b.email');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		//$this->db->where("a.tml_delivery_date >=",$date);
		$this->db->where('a.status',4);
		$this->db->limit(200);
		$this->db->order_by('a.orderid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getDeliveryCompletedOrdersByDate() {
		//$date = date('Y-m-d',strtotime('-2 days'));
		$this->db->select('a.*,b.name, b.mobile, b.email');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		//$this->db->where("a.tml_delivery_date >=",$date);
		$this->db->where('a.status',7);
		$this->db->order_by('a.orderid','desc');
		$this->db->limit(200);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getCancelledOrdersByDate($store_id,$role_id) {
		$date = date('Y-m-d');
		$this->db->select('a.*,b.name, b.mobile, b.email');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		//$this->db->where("DATE(a.ordered_on) = '".$date."'",'',false);
		$this->db->where('a.status',5);
		$this->db->order_by('a.orderid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOrdersForPickup($store_id,$role_id) {
		$this->db->select('a.*,b.name, b.mobile, b.email,b.area');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		if($role_id != 1) {
			$this->db->join(TABLES::$STORE_AREA.' AS c','a.areaid = c.areaid','inner');
			$this->db->where('c.store_id',$store_id);
		}
		$this->db->where('a.status',1);
		$this->db->order_by('a.orderid','desc');
		$this->db->limit(100);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOrdersUnderProcess($store_id,$role_id) {
		$this->db->select('a.*,b.name, b.mobile, b.email,b.area');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		if($role_id != 1) {
			$this->db->join(TABLES::$STORE_AREA.' AS c','a.areaid = c.areaid','inner');
			$this->db->where('c.store_id',$store_id);
		}
		$this->db->where('a.status',2);
		$this->db->order_by('a.orderid','desc');
		$this->db->limit(100);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOrdersForDelivery($store_id,$role_id) {
		$date = date('Y-m-d',strtotime('-2 days'));
		$this->db->select('a.*,b.name, b.mobile, b.email,b.area,d.name as delivery_executive_name');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->join(TABLES::$FIELD_EXECUTIVE.' AS d','a.delivery_exe_id = d.id','left');
		if($role_id != 1) {
			$this->db->join(TABLES::$STORE_AREA.' AS c','a.areaid = c.areaid','inner');
			$this->db->where('c.store_id',$store_id);
		}
		$this->db->where("a.tml_delivery_date >=",$date);
		$this->db->where('a.status',3);
		$this->db->order_by('a.orderid','desc');
		$this->db->limit(100);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getTodaysOrders($store_id,$role_id) {
		$current_date = date('Y-m-d');
		$this->db->select('a.*,b.name, b.mobile, b.email,b.area,d.name as pickup_executive_name');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->join(TABLES::$FIELD_EXECUTIVE.' AS d','a.pickup_exe_id = d.id','left');
		if($role_id != 1) {
			$this->db->join(TABLES::$STORE_AREA.' AS c','a.areaid = c.areaid','inner');
			$this->db->where('c.store_id',$store_id);
		}
		$this->db->where('a.pickup_date',$current_date);
		$this->db->where('a.status !=',5);
		$this->db->order_by('a.orderid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getTodaysOrdersBooked($store_id,$role_id) {
		$current_date = date('Y-m-d');
		$this->db->select('a.*,b.name, b.mobile, b.email,b.area,d.name as pickup_executive_name');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->join(TABLES::$FIELD_EXECUTIVE.' AS d','a.pickup_exe_id = d.id','left');
		if($role_id != 1) {
			$this->db->join(TABLES::$STORE_AREA.' AS c','a.areaid = c.areaid','inner');
			$this->db->where('c.store_id',$store_id);
		}
		$this->db->where("DATE(a.ordered_on) = '".$current_date."'",'',false);
		$this->db->where('a.status !=',5);
		$this->db->order_by('a.orderid','desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	public function getTodaysDeliveries($store_id,$role_id) {
		$current_date = date('Y-m-d');
		$this->db->select('a.*,b.name, b.mobile, b.email,b.area,d.name as delivery_executive_name');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->join(TABLES::$FIELD_EXECUTIVE.' AS d','a.delivery_exe_id = d.id','left');
		if($role_id != 1) {
			$this->db->join(TABLES::$STORE_AREA.' AS c','a.areaid = c.areaid','inner');
			$this->db->where('c.store_id',$store_id);
		}
		$this->db->where('a.tml_delivery_date',$current_date);
		$this->db->where('a.status !=',5);
		$this->db->order_by('a.orderid','desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	public function getTodaysPendingDeliveries() {
		$current_date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->where('tml_delivery_date',$current_date);
		$this->db->where('status NOT IN(4,5)','',false);
		$this->db->order_by('orderid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getPreviousDayPendingDeliveries() {
		$current_date = date('Y-m-d',strtotime('-1 day'));
		$this->db->select('*');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->where('tml_delivery_date',$current_date);
		$this->db->where('status NOT IN(4,5)','',false);
		$this->db->order_by('orderid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getTodaysOrderCount() {
		$date = date('Y-m-d');
		$this->db->select('count(orderid) as orders,status', FALSE)
				 ->from(TABLES::$ORDER)
				 ->where("DATE(ordered_on) = '".$date."'",'',false);
		$this->db->group_by('status');
		$this->db->order_by('status','asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getTodaysPickupOrderCount() {
		$date = date('Y-m-d');
		$this->db->select('count(orderid) as orders', FALSE)
				 ->from(TABLES::$ORDER)
				 ->where("pickup_date",$date);
		$this->db->where('status !=',5,false);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['orders'];
	}
	
	public function addCancelOrderReason($map) {
		return $this->db->insert(TABLES::$ORDER_CANCEL_REASON,$map);
	}
	
// 	public function getOrderDetailsByOrderId($orderid) {
// 		$this->db->select('a.*,b.name, b.mobile, b.email,b.area,b.gcm_reg_id,b.is_new_customer,b.outstanding')
// 				 ->from(TABLES::$ORDER.' AS a')
// 				 ->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
// 				 ->where('a.orderid',$orderid);
// 		$query = $this->db->get();
// 		$result = $query->result_array();
// 		return $result;
// 	}
	

	public function getOrderDetailsByOrderId($orderid) {
		$this->db->select('a.*,b.name, b.mobile,b.model,b.vehicle_no, b.email,a.comment,c.name as category_name,e.name as model_name,d.name as brand_name,a.slot,b.area,b.gcm_reg_id,b.is_new_customer,b.outstanding')
		->from(TABLES::$ORDER.' AS a')
		->join(TABLES::$MENU_MAIN_CATEGORY.' AS c','c.id = a.category_id','inner')
		->join(TABLES::$BRAND.' AS d','d.id = a.brand_id','inner')
		->join(TABLES::$MANUFACTURE.' AS e','e.id = a.vehicle_model','inner')
		->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
		->where('a.orderid',$orderid);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOrderInfoByOrderId($orderid) {
		$this->db->select('*')
				 ->from(TABLES::$ORDER)
				 ->where('orderid',$orderid);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	

	public function allOrders() {
		$this->db->select('*')
		->from(TABLES::$ORDER);
		$this->db->order_by('orderid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function allPendingOrders() {
		$this->db->select('*')
		->from(TABLES::$ORDER);
		$this->db->where('status',0);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function allCompletedOrders() {
		$this->db->select('*')
		->from(TABLES::$ORDER);
		$this->db->where('status',7);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function searchOrders($params) {
		$this->db->select('a.*,b.name, b.mobile, b.email,c.name as areaname')
				 ->from(TABLES::$ORDER.' AS a')
				 ->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
				 ->join(TABLES::$AREA.' AS c','a.areaid = c.id','left');
		if($params['status'] != '')
			$this->db->where('a.status',$params['status']);
		if(!empty($params['from_date']) && !empty($params['to_date']))
			$this->db->where("DATE(a.ordered_on) between '".$params['from_date']."' and '".$params['to_date']."'",'',false);
		$this->db->order_by('a.tml_delivery_date','asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function addOrderLogs($params) {
		return $this->db->insert(TABLES::$ORDER_LOGS,$params);
	}
	
	public function addNotificationRider($params) {
		return $this->db->insert(TABLES::$RIDER_NOTIFICATION,$params);
	}

	public function addNotification($params) {
		return $this->db->insert(TABLES::$USER_NOTIFICATION,$params);
	}
	
	public function getUserNotification($userid) {
		$this->db->select('*');
		$this->db->from(TABLES::$USER_NOTIFICATION);
		$this->db->where('user_id',$userid);
		$this->db->where('status', 1)->order_by('id','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOrderLogs($orderid) {
		$this->db->select("a.*,concat_ws(' ',b.first_name,b.last_name) as csename",false)
				 ->from(TABLES::$ORDER_LOGS.' AS a')
				 ->join(TABLES::$ADMIN_USER.' AS b','a.created_by = b.id','left')
				 ->where('a.orderid',$orderid);
				 // ->where('a.order_status >', 0);
		$query = $this->db->get();
		$result = $query->result_array();
		if(!empty($result)){
			foreach ($result as $key => $value) {
				if( $value['csename'] == '' ){
					$result[$key]['csename'] = $this->db->get_where(TABLES::$RESTAURANT,array('id'=>$value['created_by']))->row('garage_name');
				}
			}
		}
		return $result;
	}
	
	public function addOrderItems($params) {
		return $this->db->insert_batch(TABLES::$ORDER_SERVICE,$params);
		
	}
	
	public function removeOrderItems($orderid) {
		$this->db->where('orderid',$orderid);
		return $this->db->delete(TABLES::$ORDER_SERVICE);
	}
	
	public function getOrderItems($orderid) {
		$this->db->select('a.*', FALSE)
				 ->from(TABLES::$ORDER_SERVICE.' AS a')
				// ->join(TABLES::$SERVICE.' AS b','a.service_id=b.id','inner')
				// ->join(TABLES::$SPARE.' AS c','a.service_id=c.id','inner')
				 ->where("a.orderid",$orderid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	

	
	public function getOrderProducts($orderid) {
		$this->db->select('a.*')
				 ->from(TABLES::$ORDER.' AS a')
				 ->where("a.orderid",$orderid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	
	
	public function generateInvoice($map) {
		$this->db->insert(TABLES::$INVOICE,$map);
		return $this->db->insert_id();
	}
	
	public function updateInvoice($map) {
		$this->db->where('id',$map['id']);
		return $this->db->update(TABLES::$INVOICE,$map);
	}
	
	public function updateBulkInvoice($map) {
		return $this->db->update_batch(TABLES::$INVOICE,$map,'id');
	}
	
	public function updateBulkOrder($map) {
		return $this->db->update_batch(TABLES::$ORDER,$map,'orderid');
	}
	
	public function addPaymentDetail($map) {
		$this->db->select('*')
				 ->from(TABLES::$PAYMENT_DETAIL)
				 ->where("orderid",$map['orderid']);
		$query = $this->db->get();
		$result = $query->result_array();
		if(count($result) <= 0) {
			$this->db->insert(TABLES::$PAYMENT_DETAIL,$map);
		} else {
			$this->db->where('orderid',$map['orderid']);
			$this->db->update(TABLES::$PAYMENT_DETAIL,$map);
		}
	}
	
	public function updatePaymentDetail($map) {
		$this->db->where('transactionid',$map['transactionid']);
		$this->db->update(TABLES::$PAYMENT_DETAIL,$map);
	}
	
	public function getPaymentByTransId($transactionid) {
		$this->db->select('a.*,b.grand_total')
				 ->from(TABLES::$PAYMENT_DETAIL.' AS a')
				 ->join(TABLES::$ORDER.' AS b','a.orderid=b.orderid','left')
				 ->where("a.transactionid",$transactionid);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	private function pickup_sort( $records ) {
		$pickup_date = array();
		$pickup_time = array();
		$batch = array();
		foreach($records as $key=>$row)
		{
			$pickup_date[$key] = $row['pickup_date'];
			$slots = explode("-",$row['pickup_slot']);
			if(!empty($slots[0]))
				$ptime = date('H:i',strtotime(trim($slots[0])));
			else 
				$ptime = '';
			$pickup_time[$key] = $ptime;
			$records[$key]['pickup_time'] = $ptime;
			$batch [] = $records[$key];
		}
		array_multisort($pickup_date,SORT_DESC,$pickup_time,SORT_DESC,$batch);
		unset($pickup_date);
		unset($pickup_time);
		return $batch;
	}
	
    public function getBusinessReport($params) {
        $this->db->select('a.*,b.name,b.mobile,b.email,b.is_new_customer,c.name as areaname,d.name as pickup_executive,d.mobile as pickup_executive_mobile,e.name as delivery_executive,e.mobile as delivery_executive_mobile,f.status as payment_status,g.name as category,h.name as brand,i.name as model,j.name as subcategory,k.garage_name,l.commission_service,l.commission_spare')
                 ->from(TABLES::$ORDER.' AS a')
                 ->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
                 ->join(TABLES::$AREA.' AS c','a.areaid = c.id','left')
                 ->join(TABLES::$FIELD_EXECUTIVE.' AS d','a.pickup_exe_id = d.id','left')
                 ->join(TABLES::$FIELD_EXECUTIVE.' AS e','a.delivery_exe_id = e.id','left')
                 ->join(TABLES::$PAYMENT_DETAIL.' AS f','a.orderid = f.orderid','left')
                 ->join(TABLES::$MENU_MAIN_CATEGORY.' AS g','a.category_id = g.id','inner')
                 ->join(TABLES::$BRAND.' AS h','a.brand_id= h.id','inner')
       			 ->join(TABLES::$MANUFACTURE.' AS i','a.vehicle_model = i.id','inner')
       			 ->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS j','a.subcategory_id = j.id','inner')
       			 ->join(TABLES::$RESTAURANT.' AS k','a.assign_vendor_id = k.id','left')
       			 ->join(TABLES::$RESTAURANT_BILLING_CONFIG.' AS l','a.assign_vendor_id = l.restid','left');
      		  //   ->join(TABLES::$SERVICE.' AS k','a.service_id= k.id','left');
              //   ->join(TABLES::$COUPON_CODE.' AS g','a.coupon_code=g.coupon_code','left');
        //if($params['status'] != '')
        $this->db->where('a.status !=',5);
        if(!empty($params['from_date']) && !empty($params['to_date']))
            $this->db->where("DATE(a.pickup_date) between '".$params['from_date']."' and '".$params['to_date']."'",'',false);
        $this->db->order_by('a.pickup_date','asc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        $result = $query->result_array();
        return $result;
    }
     public function getBusinessReport_NewParam($params) {
        $this->db->select('a.*,b.name,b.mobile,b.email,b.is_new_customer,c.name as areaname,d.name as pickup_executive,d.mobile as pickup_executive_mobile,e.name as delivery_executive,e.mobile as delivery_executive_mobile,f.status as payment_status,g.name as category,h.name as brand,i.name as model,j.name as subcategory,k.garage_name,l.commission_service,l.commission_spare')
                 ->from(TABLES::$ORDER.' AS a')
                 ->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
                 ->join(TABLES::$AREA.' AS c','a.areaid = c.id','left')
                 ->join(TABLES::$FIELD_EXECUTIVE.' AS d','a.pickup_exe_id = d.id','left')
                 ->join(TABLES::$FIELD_EXECUTIVE.' AS e','a.delivery_exe_id = e.id','left')
                 ->join(TABLES::$PAYMENT_DETAIL.' AS f','a.orderid = f.orderid','left')
                 ->join(TABLES::$MENU_MAIN_CATEGORY.' AS g','a.category_id = g.id','inner')
                 ->join(TABLES::$BRAND.' AS h','a.brand_id= h.id','inner')
       			 ->join(TABLES::$MANUFACTURE.' AS i','a.vehicle_model = i.id','inner')
       			 ->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS j','a.subcategory_id = j.id','inner')
       			 ->join(TABLES::$RESTAURANT.' AS k','a.assign_vendor_id = k.id','left')
       			 ->join(TABLES::$RESTAURANT_BILLING_CONFIG.' AS l','a.assign_vendor_id = l.restid','left');
      		  //   ->join(TABLES::$SERVICE.' AS k','a.service_id= k.id','left');
              //   ->join(TABLES::$COUPON_CODE.' AS g','a.coupon_code=g.coupon_code','left');
        //if($params['status'] != '')
        $this->db->where('a.status !=',5);
        if(!empty($params['from_date']) && !empty($params['to_date']))
            $this->db->where("DATE(a.pickup_date) between '".$params['from_date']."' and '".$params['to_date']."'",'',false);
        $this->db->order_by('a.pickup_date','asc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        $result = $query->result_array();
        return $result;
    }


	
/*	public function getOrderItemCountByIds($orderids) {
		$this->db->select('sum(a.quantity) as items,sum(a.weight) as weights,sum(a.total_amount) as items_total,a.orderid,b.cat_id', FALSE)
				 ->from(TABLES::$ORDER_ITEM.' AS a')
				 ->join(TABLES::$ITEM.' AS b','a.item_id=b.id','inner');
		if($orderids != "") {
			$this->db->where("a.orderid IN(".$orderids.")",'',false);
		}
		$this->db->group_by('a.orderid');
		$this->db->group_by('b.cat_id');
		$this->db->order_by('a.orderid','ASC');
		$this->db->order_by('b.cat_id','ASC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}*/
	
	public function updateBatchDelivery($orderdata) {
		return $this->db->update_batch(TABLES::$ORDER,$orderdata,'orderid');
	}
	
	public function getOrdersByEmail($email) {
		$this->db->select('count(orderid) as orders', FALSE)
				 ->from(TABLES::$ORDER);
		$this->db->where('email',$email);
		$this->db->where('status', 4);
		$query = $this->db->get();
		$result = $query->result_array();
		if(count($result) > 0) {
			return $result[0]['orders'];
		} else {
			return 0;
		}
	}
	
	public function getOrdersByEmailAndCoupon($email,$coupon) {
		$this->db->select('count(orderid) as orders', FALSE)
		->from(TABLES::$ORDER);
		$this->db->where('email',$email);
		$this->db->where('coupon_code',$coupon);
		$this->db->where('discount >',0);
		$this->db->where('status', 4);
		$query = $this->db->get();
		$result = $query->result_array();
		if(count($result) > 0) {
			return $result[0]['orders'];
		} else {
			return 0;
		}
	}
	
	public function getCashCollectionReport($params) {
		$this->db->select('COUNT(a.orderid) as orders,round(SUM(a.grand_total),2) as ordertotal,round(SUM(a.amount_received),2) as total_received,a.delivery_date,b.name', FALSE)
				 ->from(TABLES::$ORDER.' AS a')
				 ->join(TABLES::$FIELD_EXECUTIVE.' AS b','a.delivery_exe_id = b.id','left')
				 ->join(TABLES::$PAYMENT_DETAIL.' AS c','a.orderid = c.orderid','left');
		$this->db->where('a.status', 4);
		$this->db->where("(c.status IS NULL OR c.status != 'Credit')",'',false);
		if(!empty($params['executive_id'])) {
			$this->db->where('b.id',$params['executive_id']);
		}
		if(!empty($params['from_date']) && !empty($params['to_date'])) {
			$this->db->where("a.tml_delivery_date BETWEEN '".$params['from_date']."' AND '".$params['to_date']."'",'',false);
		}
		$this->db->group_by('b.id');
		$this->db->order_by('b.name','ASC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOnlineCollectionReport($params) {
		$this->db->select('COUNT(a.orderid) as orders,round(SUM(a.grand_total),2) as ordertotal,round(SUM(a.amount_received),2) as total_received,a.delivery_date,"Online Paid" as name', FALSE)
			 ->from(TABLES::$ORDER.' AS a')
			 ->join(TABLES::$FIELD_EXECUTIVE.' AS b','a.delivery_exe_id = b.id','inner')
			 ->join(TABLES::$PAYMENT_DETAIL.' AS c','a.orderid = c.orderid','inner');
		$this->db->where('a.status', 4);
		$this->db->where('c.status', 'Credit');
		if(!empty($params['from_date']) && !empty($params['to_date'])) {
			$this->db->where("a.tml_delivery_date BETWEEN '".$params['from_date']."' AND '".$params['to_date']."'",'',false);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getTodaysPendingPayments() {
		$current_date = date('Y-m-d');
		$this->db->select('a.orderid,a.grand_total,b.name, b.mobile, b.email,c.invoice_url,c.invoice_date,c.id as invoice_id,d.status as payment_status')
				 ->from(TABLES::$ORDER.' AS a')
				 ->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
				 ->join(TABLES::$INVOICE.' AS c','a.orderid = c.orderid','left')
				 ->join(TABLES::$PAYMENT_DETAIL.' AS d','a.orderid = d.orderid','left');
		$this->db->where('a.tml_delivery_date',$current_date);
		$this->db->where('a.status',3);
		$this->db->order_by('a.orderid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function updateCrondetails( $map ) {

		foreach($map as $row)
		{
			/*$data['vendor_id']=$map['vendor_id'];
			$data['other_vendorid']=$map['other_vendorid'];
			$data['vendor_response']=$map['vendor_response'];
			$data['updated_datetime']=$map['updated_datetime'];
			$data['accepted_by']=$map['accepted_by'];
		    $batch[]=$data;*/
			$this->db->where('orderid',$row['orderid']);
			$this->db->update(TABLES::$ORDER,$row);
		}
	//echo $this->db->last_query();
	}
	
	public function addAdminComment($data) {
		$this->db->insert(TABLES::$ORDER_COMMENT,$data);
		return $this->db->insert_id();
	}
	
	public function getAdminComment($orderid) {
		$this->db->select("a.*,concat_ws(' ',b.first_name,b.last_name) as Admin_name",false)
			->from(TABLES::$ORDER_COMMENT.' AS a')
			->join(TABLES::$ADMIN_USER.' AS b','a.created_by = b.id','left')
			->where('a.orderid',$orderid);
		//->where('a.order_status >', 0);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function checkorder($userid){
		$this->db->select('*');
		$this->db->from(TABLES::$ORDER);
		$this->db->where('userid',$userid);
		$this->db->where('status',7);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getServicedate(){
	
		$current_date = date('Y-m-d');
		$sub_query_from = '(SELECT a.userid, MAX( a.pickup_date ) AS pickup_date,b.name,b.mobile,b.email,b.gcm_reg_id FROM
		tbl_booking as a inner join tbl_users as b on a.userid = b.id where a.status=7 GROUP BY a.userid)
		AS m';
		$this->db->select ('m.userid,m.name,m.email,m.mobile,m.pickup_date,m.gcm_reg_id');
		$this->db->from ($sub_query_from);
		//$this->db->where("m.del_date BETWEEN '".$del_date."' AND '".$current_date."'",'',false);
		$this->db->where("m.pickup_date BETWEEN m.pickup_date AND '".$current_date."'",'',false);
		$query = $this->db->get();
		echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	public function addRemindOrder($data) {
		$this->db->insert(TABLES::$USERREMINDER,$data);
		return $this->db->insert_id();
	}
	
	public function getallReminderOrders(){
		$this->db->select('*');
		$this->db->from(TABLES::$USERREMINDER);
		//$this->db->where('userid',$userid);
		//$this->db->where('status',1);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function getTodaysReminderOrders(){
		$this->db->select('*');
		$this->db->from(TABLES::$USERREMINDER);
		$this->db->where('created_datetime>',date('Y-m-d').' 00:00:00');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function getTodaysTickets(){
		$this->db->select('*');
		$this->db->from(TABLES::$TICKET);
		$this->db->where('created_date>',date('Y-m-d').' 00:00:00');
		$this->db->order_by('ticketid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function getOrderListByVendor($data) {
		
		$service_date = date("Y-m-d",strtotime('now'));
		if($data['service_day']==2){				
			$service_date = date("Y-m-d", strtotime('tomorrow'));
		} 
		
		
		
		$where = "o.status <> 7"; 
 		$this->db->select('o.*');
		$this->db->select ( 's.name AS service_name');
		$this->db->select ( 'm.name AS model_name');
		$this->db->select ( 'b.name AS brand_name');
		
		$this->db->from ( TABLES::$ORDER.' AS o');		
		$this->db->join ( TABLES::$EMPLOYEE.' AS e','e.garage_id=o.vendor_id', 'left' );		
		$this->db->join ( TABLES::$SERVICE.' AS s','s.id=o.catsubcat_id', 'left' );		
		$this->db->join ( TABLES::$MANUFACTURE.' AS m','m.id=o.vehicle_model', 'left' );		
		$this->db->join ( TABLES::$BRAND.' AS b','b.id=o.brand_id', 'left' );		
		
		$this->db->where($where);
		$this->db->where ( 'o.is_accepted != 2');
		$this->db->where('o.vendor_id',$data['vendor_id']); 
		$this->db->where ( 'o.pickup_date', $service_date);  
		//$this->db->group_by ( 'o.userid');	
                $this->db->order_by ( 'o.userid', 'DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function assignOrderToMechanic($data) { 
		$this->db->where('orderid',$data['orderid']);
		$this->db->update(TABLES::$ORDER,$data);
	//	echo $this->db->last_query();exit;
		return 1; 

	}
	
	public function getOrderListByMechanic($data) {
		$where = "status <> 7";
		$this->db->select('*')->from(TABLES::$ORDER);
		$this->db->where('vendor_id',$data['vendor_id']); 
		$this->db->where('mec_id',$data['mec_id']); 

		$this->db->where($where);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	

	public function addReminder($params) {
		return $this->db->insert(TABLES::$ORDER_REMINDER,$params);
	
	}
	

// 	public function getAdminDetails() {
// 		return $this->db->select('id,mobile,email')->from(TABLES::$ADMIN_USER)->where('status',1)->get()->result_array(); 
// 	}	
	
	public function getReminderList() {		
		$date = date('Y-m-d');
		$this->db->select("a.*,b.name as user_name,b.orderid,b.mobile as usermob,b.ordercode,b.slot,c.name as vendor_name,c.garage_name,c.mobile as vendor_mobile,d.name as vehicle_name")
		->from(TABLES::$ORDER_REMINDER.' AS a')
		->join(TABLES::$ORDER.' AS b','a.orderid = b.orderid','left')
		->join(TABLES::$RESTAURANT.' AS c','c.id = b.vendor_id','left')
		->join(TABLES::$MANUFACTURE.' AS d','d.id = b.vehicle_model','left');
	//	->where('a.reminder_date >=',$date);
		$this->db->order_by('a.reminder_date','asc');
		$this->db->limit(100);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
		
	}
	
	public function getRemindercron() {
		$date = date('Y-m-d');
		$this->db->select("a.*,b.name as user_name,b.mobile as usermob,b.ordercode,b.slot,c.name as vendor_name,c.garage_name,c.mobile as vendor_mobile")
			->from(TABLES::$ORDER_REMINDER.' AS a')
			->join(TABLES::$ORDER.' AS b','a.orderid = b.orderid','left')
			->join(TABLES::$RESTAURANT.' AS c','c.id = b.vendor_id','left')
			->where('a.reminder_date',$date);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	
	}
	
	public function rejectedOrders(){
		$this->db->select('*')
		->from(TABLES::$ORDER)
		->where('status',1)
		->where('is_accepted',2);
		$this->db->order_by('orderid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
        public function getBookingServices($param, $subcat_id, $model_id) {
            $data['services'] = $this->db->select('*')
                                        ->from(TABLES :: $SERVICE)
                                        ->where_in('sucategory_id', explode(',', $param))
                                        ->get() 
                                        ->result_array();  
            $data['spare'] = $this->db->select('*')
                                        ->from(TABLES :: $SPARE)
                                        ->where('subcategory_id ', $subcat_id)
                                        ->where('model_id', $model_id)
                                        ->get() 
                                        ->result_array(); 
            return $data;
        }
	
}
