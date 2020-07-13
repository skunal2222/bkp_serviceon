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

	/***** code by kunal *****/
	public function getOrderListByUserID($userid) {
		$this->db->select('a.*,b.name, b.mobile, b.email,b.outstanding, adrs.*, vh.vehicle_no, vendor.garage_name, vendor.email as vendor_email,vendor.mobile as vendor_mobile, vendor.locality as vendor_locality, vendor.latitude as vendor_latitude, vendor.longitude as vendor_longitude, vendor.address as vendor_address, vendor.landmark as vendor_landmark, vendor.pincode as vendor_pincode, st_sub.name as subcategory_name, e.invoice_url,e.invoice_date,e.id as invoice_id,e.status as invoice_s,f.transactionid,f.status as payment_status,f.payment_date,f.longurl,g.name as category,h.name as brand,i.name as model', FALSE)
		->from(TABLES::$ORDER.' AS a')
		->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
		->join(TABLES::$USER_ADDRESS.' AS adrs','adrs.id = a.address_id','left')
		->join(TABLES::$USER_VEHICLES.' AS vh','vh.id = a.vehicle_id','left')
		->join(TABLES::$RESTAURANT.' AS vendor','vendor.id = a.assign_vendor_id','left')
		->join(TABLES::$INVOICE.' AS e','a.orderid = e.orderid','left')
		->join(TABLES::$PAYMENT_DETAIL.' AS f','a.orderid = f.orderid','left')
		->join(TABLES::$MENU_MAIN_CATEGORY.' AS g','a.category_id = g.id','left')
		->join(TABLES::$STATIC_SUBCATEGORY.' AS st_sub','st_sub.id = a.subcategory_id','left')
		->join(TABLES::$BRAND.' AS h','a.brand_id = h.id','left')
		->join(TABLES::$MANUFACTURE.' AS i','a.vehicle_model = i.id','left');
	
		$this->db->where('a.userid', $userid);
		$this->db->order_by('a.orderid','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}


	/***** code by kunal *****/

	public function getMyPackageList($userid)
	{
		 	$this->db->select('a.*,b.remaining_service_count,b.invoice_url,b.id as tbl_user_pack_id,c.vehicle_no,c.id as vehicle_id,d.name as brand,e.name as model,b.expiry_date,b.created_date as subscribe_date,b.remaining_service_count')
					 ->from('packages a')
					 ->join('tbl_user_package b','a.id = b.package_id','inner')
					 ->join('tbl_user_vehicles c','c.id = b.vehicle_id','left')
					 ->join('brand d','d.id = c.brand_id','left')
					 ->join('manufacturer e','e.id = c.model_id','left')
					 ->where('b.user_id',$userid);
					// ->where('a.status',1);
                                         if($this->input->post('vehicle_id') != '') {
                                           $this->db->where('b.vehicle_id', $this->input->post('vehicle_id'));
                                           $this->db->where('is_expire',1);
                                         }
                                         else
                                         {
                                         	 $this->db->group_by('a.id');
                                         }
                            
                            	$result1 =  $this->db->get()->result_array();
                                         
				
                                $result = array();
                                foreach ($result1 as $key => $value) {
                                    $result[$key] =  $value;
                                    $order_subcategory_id = $this->db->select('b.sub_id')
                                                                       ->from('tbl_booking as t')
                                                                       ->join('subcategory AS b','b.id = t.subcategory_id', 'inner')
                                                                       ->where('t.package_id', $value['id'])
                                                                       ->where('t.userid', $userid)
                                                                       ->limit(1)
                                                                       ->order_by('t.orderid', 'DESC')
                                                                       ->get()
                                                                       ->result_array();
                                    
                                    $result[$key]['order_subcategory_id'] =  $order_subcategory_id[0]['sub_id'];
                                }
                                
		if(!empty($result))
		{
			foreach ($result as $key => $value) {
			$result[$key]['service_used'] = $value['service_used_validity'] - $value['remaining_service_count'];
			$orders=  $this->db->select('t.ordercode')
								        ->from('tbl_booking as t')
								        ->join('tbl_booking_services bs','bs.orderid = t.orderid','inner')
								        ->where('bs.is_package_service',$value['tbl_user_pack_id'])
								        ->group_by('bs.orderid')
								        ->order_by('t.orderid','desc')
								        ->get()
								        ->result_array();
				//echo $orders[0]['ordercode']."<br/>";
				$result[$key]['prev_order'] = isset($orders[0]['ordercode']) ? $orders[0]['ordercode']:'';
				//$result[$key]['prev_order']= $orders[0]['ordercode'];
				$services = $this->db->select('s.*,ps.service_used_validity')
									   ->from('package_services ps')
									   ->join('service s','s.id = ps.service_id')
									   ->where('ps.package_id',$value['id'])
									   ->get()
									   ->result_array();
					if(!empty($services))
					{
						$service_used = 0;
						foreach ($services as $k => $v) {
							$service_used =$this->db->select('count(service_id) as service_used')->get_where('tbl_booking_services',array('service_id'=>$v['id'],'is_package_service'=>$value['tbl_user_pack_id']))->row('service_used');
							$services[$k]['remaing_service'] = $v['service_used_validity'] - $service_used;
							$services[$k]['service_used'] = $service_used;
						}
					}
				$result[$key]['services'] = $services;
			}
		}
		return $result;
	}

	public function particular_package($tbl_user_pack_id)
	{
		$result = 	$this->db->select('a.*,b.remaining_service_count,b.invoice_url,b.id as tbl_user_pack_id')
					 ->from('packages a')
					 ->join('tbl_user_package b','a.id = b.package_id','inner')
					 ->where('b.id',$tbl_user_pack_id)
					 ->where('is_expire',1)
					 ->get()
					 ->result_array();
		if(!empty($result))
		{
			foreach ($result as $key => $value) {
				$services = $this->db->select('s.*,ps.service_used_validity')
								   ->from('package_services ps')
								   ->join('service s','s.id = ps.service_id')
								   ->where('ps.package_id',$value['id'])
								   ->get()
								   ->result_array();
				if(!empty($services))
				{
					$service_used = 0;
					foreach ($services as $k => $v) {
						$service_used =$this->db->select('count(service_id) as service_used')->get_where('tbl_booking_services',array('service_id'=>$v['id'],'is_package_service'=>$value['tbl_user_pack_id']))->row('service_used');
						$services[$k]['service_used_validity'] = $v['service_used_validity'] - $service_used;
						$services[$k]['service_used'] = $service_used;
					}
				}
			$result[$key]['services'] = $services;
			}
		}
		return $result;
	}
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
		if (!empty($map['orderid'])) {
			$this->db->where('orderid',$map['orderid']);
		} else if (!empty($map['ordercode'])) {
			$this->db->where('ordercode',$map['ordercode']);
		}
		return $this->db->update(TABLES::$ORDER,$map);
		
	}
	
	public function getOrderDetails($ordercode) {
        $this->db->select('a.*,b.name, b.mobile, b.email,b.outstanding, rd.rider_name, rd.mobile as rider_mobile, deli_rd.rider_name as delivery_rider_name, deli_rd.mobile as delivery_rider_mobile, adrs.*, vh.vehicle_no, vendor.garage_name, vendor.email as vendor_email,vendor.mobile as vendor_mobile, vendor.locality as vendor_locality, vendor.latitude as vendor_latitude, vendor.longitude as vendor_longitude, vendor.address as vendor_address, vendor.landmark as vendor_landmark, vendor.pincode as vendor_pincode, st_sub.name as subcategory_name, e.invoice_url,e.invoice_date,e.id as invoice_id,e.status as invoice_s,f.transactionid,f.status as payment_status,f.payment_date,
                f.longurl,g.name as category,h.name as brand,i.name as model,j.name as subcategory,k.name as service,l.company_name as vendor_company_name,l.gstin as vendor_gstin,l.commission_service,l.commission_spare,j.sub_id', FALSE)
                 ->from(TABLES::$ORDER.' AS a')
                 ->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
                 ->join(TABLES::$RIDER.' AS rd','rd.rider_id = a.assign_rider_id','left')
                 ->join(TABLES::$RIDER.' AS deli_rd','deli_rd.rider_id = a.delivery_assign_rider_id','left')
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
                 ->join(TABLES::$RESTAURANT_BILLING_CONFIG.' AS l','a.assign_vendor_id = l.restid','left');
        
        //$this->db->where('a.orderid', $ordercode);
        if(is_numeric($ordercode))
        {
            $this->db->where('a.orderid', $ordercode);
        }
        else
        {
            $this->db->where('a.ordercode', $ordercode);
        }
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
            $this->db->where('o.status !=', 5);
            $this->db->where('o.vendor_id',$data['vendor_id']);
            $this->db->where ( 'o.pickup_date', $service_date);
            $this->db->group_by ( 'o.orderid');
            $this->db->order_by ( 'o.orderid', 'DESC');
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
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
	public function getAllInvoiceOrderDetails($orderid) {
		 
		if($orderid == '')
		{
			return true;
		}

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
	
		$this->db->where('a.orderid IN('.$orderid.')','',false);
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
	
	public function getCancelledOrdersByDate($store_id="",$role_id="") {
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
	
	public function getOrderDetailsByOrderId($orderid) {
		$this->db->select('a.*,b.name, b.mobile, b.email,b.area,b.gcm_reg_id,b.is_new_customer,b.outstanding')
				 ->from(TABLES::$ORDER.' AS a')
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

	public function allAssignedOrders() {
		$this->db->select('*')
		->from(TABLES::$ORDER);
		$this->db->where('status',1);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function allNewOrders() {
		$this->db->select('*')
		->from(TABLES::$ORDER);
		$this->db->where('status',0);
		$this->db->where('rider_response',0);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function pickupRiderAssignedOrders() {
		$this->db->select('*');
		$this->db->where('rider_response >=',1);
		$this->db->where('rider_response <=',5);
		$q = $this->db->get(TABLES::$ORDER);
		$result = $q->result_array();
		return $result;
	}

	public function deliveryRiderAssignedOrders() {
		$this->db->select('*');
		$this->db->where('delivery_rider_response >=',1);
		$this->db->where('delivery_rider_response <=',5);
		$q = $this->db->get(TABLES::$ORDER);
		$result = $q->result_array();
		return $result;
	}

	public function allEstimateGeneratedOrders() {
		$this->db->select('*')
		->from(TABLES::$ORDER);
		$this->db->where('status',1);
		$this->db->or_where('status',2);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function allWorkingOrders() {
		$this->db->select('*')
		->from(TABLES::$ORDER);
		$this->db->where('status',3);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function allCompletedOrders() {
		$this->db->select('*')
		->from(TABLES::$ORDER);
		$this->db->where('status',4);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function allDeliveryCompletedOrds() {
		$this->db->select('*')
		->from(TABLES::$ORDER);
		$this->db->where('status',7);
		$this->db->where('delivery_rider_response',6);
		$query = $this->db->get();
		$result = $query->result_array(); 
		return $result;
	}

	public function allCanceledOrders() {
		$this->db->select('*')
		->from(TABLES::$ORDER);
		$this->db->where('status',5);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function allOngoingOrders() {
		$this->db->select('*')
		->from(TABLES::$ORDER);
		$this->db->where('status',2);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function allDeliveryCompletedOrders() {
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
	
	public function addNotification($params) {
		return $this->db->insert(TABLES::$USER_NOTIFICATION,$params);
	}
	
	public function getUserNotification($userid) {
		$this->db->select('*');
		$this->db->from(TABLES::$USER_NOTIFICATION);
		$this->db->where('user_id',$userid);
		$this->db->where('status', 1);
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOrderLogs($orderid) {
		$this->db->select("a.*,b.name as csename",false)
				 ->from(TABLES::$ORDER_LOGS.' AS a')
				 ->join(TABLES::$RESTAURANT.' AS b','a.created_by = b.id','left')
				 ->where('a.orderid',$orderid)
				 ->where('a.order_status >=', 0);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	
	public function addOrderItems($params) {
            
		return $this->db->insert_batch(TABLES::$ORDER_SERVICE,$params);
		
	}
	
	public function removeOrderItems($orderid) {
		$this->db->where('orderid',$orderid);
                $this->db->where('is_package_service', 0);
		return $this->db->delete(TABLES::$ORDER_SERVICE);
	}
	
	public function getOrderItems($orderid) {
		$this->db->select('a.*', FALSE)
				 ->from(TABLES::$ORDER_SERVICE.' AS a')
				// ->join(TABLES::$SERVICE.' AS b','a.service_id=b.id','inner')
				// ->join(TABLES::$SPARE.' AS c','a.service_id=c.id','inner')
				->where("a.orderid",$orderid)
                ->where("a.is_package_service",0);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	public function getPackageOrderItems($orderid) {
		$this->db->select('a.*', FALSE)
				 ->from(TABLES::$ORDER_SERVICE.' AS a')
				// ->join(TABLES::$SERVICE.' AS b','a.service_id=b.id','inner')
				// ->join(TABLES::$SPARE.' AS c','a.service_id=c.id','inner')
				 ->where("a.orderid",$orderid)
                                  ->where("a.is_package_service !=",0);
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
        $this->db->group_by('a.orderid');
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
	public function getVendorComment($vendor_id) { 
		$this->db->select("a.*,b.garage_name as created_name",false)
			->from(TABLES::$ORDER_LOGS.' AS a')
			->join(TABLES::$RESTAURANT.' AS b','a.created_by = b.id','left')
			->where('b.id',$vendor_id);
		//->where('a.order_status >', 0);
		$query = $this->db->get();
		//echo $this->db->last_query();
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
        
        public function get_services_by_group($param) {
            
            return $this->db->select('id, name')
                            ->from('service')
                            ->where_in('catsubcat_id', $param)
                            ->get()
                            ->result_array();
        }
        public function get_services_by_id($param) {
            $data['service'] = $this->db->select('*')
                            ->from('service')
                            ->where_in('id', $param['single_services'])
                            ->get()
                            ->result_array();
            $data['spare'] = $this->get_spare_by_id($param['spare_id']);
            return $data;
            
        }
        
        public function get_spare_by_id($param) {
            return $this->db->select('*')
                            ->from('spare')
                            ->where_in('id', $param)
                            ->get()
                            ->result_array();
        }
	
		public function get_vehicles_by_id($id) {
            return $this->db->select('*')
                            ->from('tbl_user_vehicles')
                            ->where_in('id', $id)
                            ->get()
                            ->result_array();
        } 

    public function getUserpackageDetails($userid,$package_id){
		$this->db->select('*');
		$this->db->from('tbl_user_package');
		$this->db->where('user_id',$userid);
		$this->db->where('package_id',$package_id);
                $this->db->limit(1);
                $this->db->order_by('id', 'DESC');     
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
        
        public function updatePackageServices($param) {
            
            
        }
        
        public function order_packege_services($orderid) {
            $this->db->select('a.*', FALSE)
                    ->from(TABLES::$ORDER_SERVICE.' AS a')
                     ->where("a.orderid",$orderid)
                     ->where("a.is_package_service !=",0);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
        }

     public function get_subcategory_id_by_modelId($sub_id,$model_id){
     	return $this->db->get_where('subcategory',array('sub_id'=>$sub_id,'model_id'=>$model_id))->result_array();
     	/*echo $sub_id.'='.$model_id;exit;
		$this->db->select('*');
		$this->db->from('subcategory');
		$this->db->where('sub_id',$sub_id);
		$this->db->where('model_id',$model_id);
                $this->db->limit(1);
                $this->db->order_by('id', 'DESC');     
		$query = $this->db->get();
		$result = $query->result_array(); 
		return $result;*/
	}   
	public function vehicle_id_by_packageId($userid,$package_id){
		$this->db->select('vehicle_id');
		$this->db->from('tbl_user_package');
		$this->db->where('user_id',$userid);
		$this->db->where('package_id',$package_id);
                $this->db->limit(1);
                $this->db->order_by('id', 'DESC');     
		$query = $this->db->get();
		$result = $query->result_array(); 
		return $result;
	}  

	public function getVendorDetailsByVendorId($id) {
		$this->db->select('*');
		$this->db->from('vendor');
		$this->db->where('id',$id);
		$this->db->where('status', 1);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function getServiceDetailsByOrderId($id) {
		$this->db->select('*');
		$this->db->from('tbl_booking_services');
		$this->db->where('orderid',$id); 
		$this->db->where('is_checked', 1);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function getInvoiceDetailsByOrderId($id) {
		$this->db->select('*');
		$this->db->from('tbl_booking_invoice');
		$this->db->where('orderid',$id);  
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	} 

	public function getOrdercount($orderid,$userid){
		$this->db->select('COUNT(tb.orderid) as orderid, tua.id as userid')
				 ->from(TABLES::$ORDER.' AS tb')
                 ->join(TABLES::$USER.' AS tu','tu.id = tb.userid','inner')
                 ->join(TABLES::$USER.' AS tua','tu.coupon_code = tua.my_ref_code','left');
		$this->db->where('tb.userid',$userid);

		$query = $this->db->get();
		$result = $query->result_array();
		if(count($result) > 0  && $result[0]['orderid'] == 1) {
			return $result[0]['userid'];
		} else {
			return 0;
		}
	}  
	public function getOrdercountFromUserPackage($orderid,$userid){

		$this->db->select('COUNT(tb.order_ids) as orderid, tu.id as userid')
				 ->from(TABLES::$USER_PACKAGES.' AS tb')
                 ->join(TABLES::$USER.' AS tu','tu.id = tb.user_id','inner');
                 //->join(TABLES::$USER.' AS tua','tu.coupon_code = tua.my_ref_code',t'lef');
		$this->db->where('tb.user_id',$userid); 
		$this->db->where_in('tb.order_ids',$orderid); 

		$query = $this->db->get();
		$result = $query->result_array();    

		if(count($result) > 0  && $result[0]['orderid'] == 1) {
		 
			return $result[0]['userid'];
		} else {

			return 0;
		}
	} 

	public function getUserPackageCount($userid,$package_id)
	{

		$this->db->select('COUNT(tb.id) as id')
				 ->from(TABLES::$USER_PACKAGES.' AS tb')
                 ->join(TABLES::$USER.' AS tu','tu.id = tb.user_id','inner');
                 //->join(TABLES::$USER.' AS tua','tu.coupon_code = tua.my_ref_code',t'lef');
		$this->db->where('tb.user_id',$userid); 
		//$this->db->where('tb.package_id',$package_id); 

		$query = $this->db->get();
		$result = $query->result_array(); 
  		 
  		if(count($result) > 0 ) {
		 
		  return $result[0]['id']; 
			
		} else {

			return 0;
			
		}

	}
	public function getOrdercountFromUserPackage1($orderid,$userid){
  
		$this->db->select('COUNT(tb.order_ids) as orderid, tua.id as userid')
				 ->from(TABLES::$USER_PACKAGES.' AS tb')
                 ->join(TABLES::$USER.' AS tu','tu.id = tb.user_id','inner')
                 ->join(TABLES::$USER.' AS tua','tu.coupon_code = tua.my_ref_code','left');
		$this->db->where('tb.user_id',$userid); 
		$this->db->where_in('tb.order_ids',$orderid); 

		$query = $this->db->get();
		$result = $query->result_array();    

		if(count($result) > 0  && $result[0]['orderid'] == 1) {
		 
			return $result[0]['userid'];
		} else {

			return 0;
		}
	} 
	 /*public function get_vendor_name($param) {
            $data = $this->db->select('garage_name')->from('vendor')->where('id', $param)->get()->result_array();
            return isset($data[0]['garage_name']) ? $data[0]['garage_name'] : '';
        }

	public function download_mechanic_log($param) {
            if($param['from_date'] != '') {
                $param['from_date'] = date("Y-m-d", strtotime($param['from_date']));
            }
            if($param['to_date'] != '') {
                $param['to_date'] = date("Y-m-d", strtotime($param['to_date'].' +1 day'));
            }
            $this->db->select('*', FALSE)->from(TABLES::$ORDER);
                if ($param['from_date'] != '' && $param['to_date'] != '') {
                    $this->db->where('ordered_on >=', $param['from_date']);
                    $this->db->where('ordered_on <=', $param['to_date']);
                } else if ($param['from_date'] == '' && $param['to_date'] != '') {
                    $this->db->where('ordered_on <=', $param['to_date']);
                } else if ($param['from_date'] != '' && $param['to_date'] == '') {
                    $this->db->where('ordered_on >=', $param['from_date']);
                }
                if ($param['status'] != '') {
                    $this->db->where('status', $param['status']);
                }
                if ($param['vendor_id'] != '') {
                    $this->db->where('vendor_id', $param['vendor_id']);
                }
            $this->db->order_by('orderid', $param['order_by']);
            $order = $this->db->get()->result_array();
            //echo $this->db->last_query();exit;
            $result = array();
            $a = 0;
            
             $pay_mode_arr = array('Cash', 'Card', 'Paytm', 'UPI');
            $status_arr = array('Order Created', 'Order Assigned', 'Estimate Generated', 'Confirmed Estimate', 'Work Completed', 'Order Cancelled', 'Invoice Generated', 'Order Completed');
          


            foreach($order as $value) {

            	
               $vehicle_details = $this->get_order_vehicle_details($value['subcategory_id'], $value['brand_id'], $value['vehicle_model'], $value['catsubcat_id']); 
 
               $service_spare = $this->get_service_spare($value['orderid']);
               $comments = $this->get_comments_log($value['orderid']);
               $result[$a] = $value; 
               $result[$a]['Subcategory'] = $vehicle_details['Subcategory'];
               $result[$a]['Brand'] = $vehicle_details['Brand'];
               $result[$a]['Model'] = $vehicle_details['Model'];
               $result[$a]['Service_Group'] = $vehicle_details['Service_Group'];
               $result[$a]['Garage_name'] = $this->get_vendor_name($value['vendor_id']);
               $result[$a]['Service'] = $service_spare['Service'];
               $result[$a]['Spare'] = $service_spare['Spare'];
               $result[$a]['Rejected'] = $service_spare['Rejected'];
               $result[$a]['New_order_amount'] = $comments['log']['New_order_amount'];
               $result[$a]['WebComments'] = $comments['comment'];
               $result[$a]['Started'] = $comments['log']['Started'];
               $result[$a]['Reached'] = $comments['log']['Reached'];
               $result[$a]['Inspection'] = $comments['log']['Inspection'];
               $result[$a]['Confirm_Estimate'] = $comments['log']['Confirm_Estimate'];
               $result[$a]['Assigned_Date'] = $comments['log']['Assigned_Date'];
               $result[$a]['Assigned_Time'] = $comments['log']['Assigned_Time'];
               $result[$a]['Date_of_Service_at_time_of_new_order'] = $comments['log']['Date_of_Service_at_time_of_new_order'];
               $result[$a]['Mark_Work_Completed'] = $comments['log']['Mark_Work_Completed'];
               $result[$a]['Confirm_Estimate_value'] = $comments['log']['Confirm_Estimate_value'];
               $result[$a]['Invoice_Value'] = $value['grand_total'];
               $result[$a]['Time_order_id_gen'] = date("H:i:", strtotime($value['ordered_on']));
               $result[$a]['Date_order_id_gen'] = date("d-m-Y", strtotime($value['ordered_on']));
               $result[$a]['pickup_date'] = date("d-m-Y", strtotime($value['pickup_date']));
               $result[$a]['Invoice_Line_Items'] = $service_spare['Invoice_Line_Items'];
               
               $result[$a]['order_status'] = $status_arr[$value['status']];
                if($value['status'] != 7) {
                    $result[$a]['Mode_of_Payment'] = 'Pending';
                } else {
                    $result[$a]['Mode_of_Payment'] = $pay_mode_arr[$value['pay_mode']];
                }
                       
                    
             $a++;          
            }
//            echo "<pre>";
//            print_r($result);
//            exit;
            return $result;
    }
     public function get_comments_log($param) {
            $comment = array();
            $log = array(
                'Started' => '',
                'Reached' => '',
                'Inspection' => '',
                'Confirm_Estimate' => '',
                'Assigned_Date' => '',
                'Assigned_Time' => '',
                'Mark_Work_Completed' => '',
                'New_order_amount' => '',
                'Confirm_Estimate_value' => '',
                'Date_of_Service_at_time_of_new_order' => ''
            );
             $data1 = $this->db->select('*')->from('tbl_booking_comment')->where('orderid', $param)->get()->result_array();
             foreach ($data1 as $value) {
                $comment[] =  $value['comment'];
             }
             $data2 = $this->db->select('*')->from('tbl_booking_logs')->where('orderid', $param)->get()->result_array();
 
             foreach ($data2 as $value) {
                 if($value['comment'] == 'Order Started') {
                     $log['Started'] = date("H:i", strtotime($value['created_date']));
                 } else if($value['comment'] == 'Mechanic Reached') {
                     $log['Reached'] = date("H:i", strtotime($value['created_date']));
                 } else if($value['comment'] == 'Order Inspection Done') {
                     $log['Inspection'] = date("d-m-Y H:i:s", strtotime($value['created_date']));
                 } else if($value['comment'] == 'Estimate Confirmed.') {
                     $log['Confirm_Estimate'] = date("H:i", strtotime($value['created_date']));
                     $log['Confirm_Estimate_value'] = $value['order_amount'];
                 } else if ($value['comment'] == 'Garage Assigned.') {
                     $log['Assigned_Date'] = date("d-m-Y", strtotime($value['created_date']));
                     $log['Assigned_Time'] = date("H:i", strtotime($value['created_date']));
                 } else if ($value['order_status'] == 25) {
                     $log['Mark_Work_Completed'] = date("H:i", strtotime($value['created_date']));
                 } else if ($value['order_status'] == 0) {
                     $log['New_order_amount'] = $value['order_amount'];
                     $log['Date_of_Service_at_time_of_new_order'] = date("d-m-Y", strtotime($value['created_date']));
                 } else if ($value['order_status'] == 3) {
                     $log['New_order_amount'] = $value['order_amount'];
                 }
                 
                
             }
             return array('comment' => implode(',', $comment), 'log' => $log);
            
        }
       public function get_service_spare($param) {
            $result = $this->getOrderItems($param);
            $service = array();
            $spare = array();
            $rejected = array();
            $confirm = array();
            foreach ($result as $value) {
                if($value['service'] == 1) {
                    $service[] = $value['service_name'];
                } else if($value['service'] == 2) {
                    $spare[] = $value['service_name'];
                }  
                
                if($value['is_checked'] != 1) {
                    $rejected[] = $value['service_name'];
                }
                if($value['is_checked'] == 1) {
                   $confirm[] = $value['service_name'];
                }
            }
            return array('Service' => implode(", ", $service), 'Spare' => implode(", ", $spare), 'Rejected' => implode(", ", $rejected), 'Invoice_Line_Items' => implode(",", $confirm));
                    
            
        }
        public function get_order_vehicle_details($subcategory_id, $brand_id, $vehicle_model, $catsubcat_id) {

            $data1 = $this->db->select('a.name')
                              ->from(TABLES::$MENU_MAIN_SUBCATEGORY.' AS a')
                              //->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS b','a.id = b.id','left')
                              ->where('a.id', $subcategory_id)
                              ->get()
                              ->result_array();
 
            $data2 = $this->db->select('name')->from('brand')->where('id', $brand_id)->get()->result_array();
            $data3 = $this->db->select('name')->from('manufacturer')->where('id', $vehicle_model)->get()->result_array();
            $data4 = $this->db->select('name')->from('category_subcat')->where('id', $catsubcat_id)->get()->result_array();
          $result = array('Subcategory' => $data1[0]['name'], 'Brand' => $data2[0]['name'], 'Model' => $data3[0]['name'], 'Service_Group' => $data4[0]['name']); 
         
            return $result;
        }
	*/

    public function get_vendor_name($param) {
            $data = $this->db->select('garage_name')->from('vendor')->where('id', $param)->get()->result_array();
            return isset($data[0]['garage_name']) ? $data[0]['garage_name'] : '';
        }

    public function get_comments_log($param) {
            $comment = array();
            $log = array(
                'Started' => '',
                'Reached' => '',
                'Inspection' => '',
                'Confirm_Estimate' => '',
                'Assigned_Date' => '',
                'Assigned_Time' => '',
                'Mark_Work_Completed' => '',
                'New_order_amount' => '',
                'Confirm_Estimate_value' => '',
                'Date_of_Service_at_time_of_new_order' => ''
            );
             $data1 = $this->db->select('*')->from('tbl_booking_comment')->where('orderid', $param)->get()->result_array();

             foreach ($data1 as $value) {
                $comment[] =  $value['comment'];
             }
             $data2 = $this->db->select('*')->from('tbl_booking_logs')->where('orderid', $param)->get()->result_array();
  
             foreach ($data2 as $value) {
                 if($value['order_status'] ==  21) {
                     $log['Started'] = date("H:i", strtotime($value['created_date']));
                 } else if($value['order_status'] ==  22) {
                     $log['Reached'] = date("H:i", strtotime($value['created_date']));
                 } else if($value['order_status'] == 23) {
                     $log['Inspection'] = date("d-m-Y H:i:s", strtotime($value['created_date']));
                 } else if($value['order_status'] == 3) {
                     $log['Confirm_Estimate'] = date("H:i", strtotime($value['created_date']));
                     $log['Confirm_Estimate_value'] = $value['order_amount'];
                 } else if ($value['order_status'] == 1) {
                     $log['Assigned_Date'] = date("d-m-Y", strtotime($value['created_date']));
                     $log['Assigned_Time'] = date("H:i", strtotime($value['created_date']));
                 } else if ($value['order_status'] == 4) {
                     $log['Mark_Work_Completed'] = date("H:i", strtotime($value['created_date']));
                 } else if ($value['order_status'] == 0) {
                     $log['New_order_amount'] = $value['order_amount'];
                     $log['Date_of_Service_at_time_of_new_order'] = date("d-m-Y", strtotime($value['created_date']));
                 } else if ($value['order_status'] == 3) {
                     $log['New_order_amount'] = $value['order_amount'];
                 }
                 
                
             }
             $result = array('comment' => implode(',', $comment), 'log' => $log); 
             return $result;

        }
       public function get_service_spare($param) {
            $result = $this->getOrderItems($param);
            $service = array();
            $spare = array();
            $rejected = array();
            $confirm = array();
            foreach ($result as $value) {
                if($value['service'] == 1) {
                    $service[] = $value['service_name'];
                } else if($value['service'] == 2) {
                    $spare[] = $value['service_name'];
                }  
                
                if($value['is_checked'] != 1) {
                    $rejected[] = $value['service_name'];
                }
                if($value['is_checked'] == 1) {
                   $confirm[] = $value['service_name'];
                }
            }
            return array('Service' => implode(", ", $service), 'Spare' => implode(", ", $spare), 'Rejected' => implode(", ", $rejected), 'Invoice_Line_Items' => implode(",", $confirm));
                    
            
        }
        public function get_order_vehicle_details($subcategory_id, $brand_id, $vehicle_model, $catsubcat_id,$package_id) {


            $Service_Group = '';
            $Package_name  = '';
 
            $data1 = $this->db->select('a.name')
                              ->from(TABLES::$MENU_MAIN_SUBCATEGORY.' AS a')
                              //->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS b','a.id = b.id','left')
                              ->where('a.id', $subcategory_id)
                              ->get()
                              ->result_array(); 

            $data2 = $this->db->select('name')->from('brand')->where('id', $brand_id)->get()->result_array();
            $data3 = $this->db->select('name')->from('manufacturer')->where('id', $vehicle_model)->get()->result_array();
            $data4 = $this->db->select('name')->from('category_subcat')->where('id', $catsubcat_id)->get()->result_array();
            $data5 = $this->db->select('package_name')->from('packages')->where('id', $package_id)->get()->result_array();

           

          $result = array('Subcategory' => $data1[0]['name'], 
          	'Brand' => $data2[0]['name'], 
          	'Model' => $data3[0]['name'], 
          	'Service_Group' => $data4,
          	'Package_name'  => $data5
          ); 
 
           if (!empty($result['Service_Group'])) {
            	 $result['Service_Group'] = $data4[0]['name'];
            	 $result['Package_name'] = '';
            }
            else{
 		
 				if (!empty($result['Package_name'])) {
            		$result['Package_name'] = $data5[0]['package_name'];
 					$result['Service_Group'] = '';

            	}else{

 					$result['Package_name'] =  '';
 					$result['Service_Group'] = '';
 				}

            }

           return $result;
        }
		
     public function get_order_package_details($package_id) { 
        	 
        	$data = $this->db->get_where('packages',array('id'=>$package_id))->row('package_name');
 
         	//$result = array('Package_name' => $data);  
         
            return $data;
    }    

	public function download_mechanic_log($param) {
            if($param['from_date'] != '') {
                $param['from_date'] = date("Y-m-d", strtotime($param['from_date']));
            }
            if($param['to_date'] != '') {
                $param['to_date'] = date("Y-m-d", strtotime($param['to_date'].' +1 day'));
            }

            $package_details = '';

            $this->db->select('*', FALSE)->from(TABLES::$ORDER);
                if ($param['from_date'] != '' && $param['to_date'] != '') {
                    $this->db->where('ordered_on >=', $param['from_date']);
                    $this->db->where('ordered_on <=', $param['to_date']);
                } else if ($param['from_date'] == '' && $param['to_date'] != '') {
                    $this->db->where('ordered_on <=', $param['to_date']);
                } else if ($param['from_date'] != '' && $param['to_date'] == '') {
                    $this->db->where('ordered_on >=', $param['from_date']);
                }
                if ($param['status'] != '') {
                    $this->db->where('status', $param['status']);
                }
                if ($param['vendor_id'] != '') {
                    $this->db->where('vendor_id', $param['vendor_id']);
                }
            $this->db->order_by('orderid', $param['order_by']);
            $order = $this->db->get()->result_array();
            //echo $this->db->last_query();exit;
 
            $result = array();
            $a = 0;
            
             $pay_mode_arr = array('Cash', 'Card', 'Paytm', 'UPI');
            $status_arr = array('Order Created', 'Order Assigned', 'Estimate Generated', 'Confirmed Estimate', 'Work Completed', 'Order Cancelled', 'Invoice Generated', 'Order Completed');
 

            
            foreach($order as $value) { 
             
            	$vehicle_details = $this->get_order_vehicle_details($value['subcategory_id'], $value['brand_id'], $value['vehicle_model'], $value['catsubcat_id'],$value['package_id']);
            	 
               $service_spare = $this->get_service_spare($value['orderid']);
               $comments = $this->get_comments_log($value['orderid']);

               $result[$a] = $value; 
               $result[$a]['Subcategory'] =$vehicle_details['Subcategory']; 
               $result[$a]['Brand'] = $vehicle_details['Brand'];
               $result[$a]['Model'] = $vehicle_details['Model'];
               $result[$a]['Service_Group'] = $vehicle_details['Service_Group'];
               $result[$a]['Package_name'] = $vehicle_details['Package_name']; 
               $result[$a]['Garage_name'] = $this->get_vendor_name($value['vendor_id']);
               $result[$a]['Service'] = $service_spare['Service'];
               $result[$a]['Spare'] = $service_spare['Spare'];
               $result[$a]['Rejected'] = $service_spare['Rejected'];
               $result[$a]['New_order_amount'] = $comments['log']['New_order_amount'];
               $result[$a]['WebComments'] = $comments['comment'];
               $result[$a]['Started'] = $comments['log']['Started'];
               $result[$a]['Reached'] = $comments['log']['Reached'];
               $result[$a]['Inspection'] = $comments['log']['Inspection'];
               $result[$a]['Confirm_Estimate'] = $comments['log']['Confirm_Estimate'];
               $result[$a]['Assigned_Date'] = $comments['log']['Assigned_Date'];
               $result[$a]['Assigned_Time'] = $comments['log']['Assigned_Time'];
               $result[$a]['Date_of_Service_at_time_of_new_order'] = $comments['log']['Date_of_Service_at_time_of_new_order'];
               $result[$a]['Mark_Work_Completed'] = $comments['log']['Mark_Work_Completed'];
               $result[$a]['Confirm_Estimate_value'] = $comments['log']['Confirm_Estimate_value'];
               $result[$a]['Invoice_Value'] = $value['grand_total'];
               $result[$a]['Time_order_id_gen'] = date("H:i:", strtotime($value['ordered_on']));
               $result[$a]['Date_order_id_gen'] = date("d-m-Y", strtotime($value['ordered_on']));
               $result[$a]['pickup_date'] = date("d-m-Y", strtotime($value['pickup_date']));
               $result[$a]['Invoice_Line_Items'] = $service_spare['Invoice_Line_Items'];
               
               $result[$a]['order_status'] = $status_arr[$value['status']];
                if($value['status'] != 7) {
                    $result[$a]['Mode_of_Payment'] = 'Pending';
                } else {
                    $result[$a]['Mode_of_Payment'] = $pay_mode_arr[$value['pay_mode']];
                }
                       
                    
             $a++;          
            } 
           //exit;

            /*echo "<pre>";
            print_r($result);
            exit();*/

            return $result;
    }     
	
}
