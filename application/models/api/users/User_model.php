<?php
class User_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}

	/******** code by kunal **********/

	public function getOrderListByuserID($userid) {
		$this->db->select('a.*,b.name, b.mobile, b.email,b.outstanding, rd.rider_name, rd.mobile as rider_mobile, adrs.*, vh.vehicle_no, vendor.garage_name, vendor.email as vendor_email,vendor.mobile as vendor_mobile, vendor.locality as vendor_locality, vendor.latitude as vendor_latitude, vendor.longitude as vendor_longitude, vendor.address as vendor_address, vendor.landmark as vendor_landmark, vendor.pincode as vendor_pincode, st_sub.name as subcategory_name, e.invoice_url,e.invoice_date,e.id as invoice_id,e.status as invoice_s,f.transactionid,f.status as payment_status,f.payment_date, f.longurl,g.name as category,h.name as brand,i.name as model,j.name as subcategory,k.name as service,l.commission_service,l.commission_spare,j.sub_id', FALSE)
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

	public function addAddress($data) {
		$this->db->insert ( TABLES::$USERADDRESS, $data );
		$id = $this->db->insert_id ();
		$this->db->where('id',$id);
		$q = $this->db->get('user_address');
		return $q->row_array();
	}

	public function updateAddress($data) {
		$this->db->where ( 'id', $data ['id'] );
		$this->db->update ( TABLES::$USERADDRESS, $data );
		return 1;
	}

	public function getAddressByIDs($data=ARRAY())
	{
		if (isset($data['userid'])) {
			$this->db->where('user_address.userid',$data['userid']);
		}
		if (isset($data['addressid'])) {
			$this->db->where('user_address.id',$data['addressid']);
		}
		$this->db->select('user_address.*, states.name as statename, cities.name as cityname');
		$this->db->join('states','states.id=user_address.state','left');
		$this->db->join('cities','cities.id=user_address.city','left');
		$q = $this->db->order_by('id DESC');
		$q = $this->db->get('user_address');
		$result = $q->result_array();
		return $result;
	}

	public function get_statelist($countryid=NULL)
	{
		$this->db->select('id,name');
		$this->db->where('country_id',$countryid);
		$q = $this->db->get('states');
		return $q->result_array();
	}

	public function get_citylist($stateid=NULL)
	{
		$this->db->select('id,name');
		$this->db->where('state_id',$stateid);
		$q = $this->db->get('cities');
		return $q->result_array();
	}

	/******** code by kunal **********/


	public function userExist($data)
    {
        $this->db->select ('*');
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'email', $data['email'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
      	return $result;
   	}
   	public function mobileExist($data)
    {
    	 
        $this->db->select ('*');
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'mobile', $data[0]['mobile'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
      	return $result;
   	}
   	
   	public function getOrder($data)
   	{
   		$this->db->select ('a.*,b.garage_name');
   		$this->db->from ( TABLES::$ORDER.' AS a' );
   		$this->db->join(TABLES::$RESTAURANT.' AS b','b.id = a.vendor_id');
   		$this->db->where ( 'a.userid', $data);
   		$this->db->where ( 'a.status!=', '5');
   		$this->db->order_by('a.orderid', 'DESC');
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
   		// $this->db->select ('*');
   		// $this->db->from ( TABLES::$ORDER );
   		// $this->db->where ( 'userid', $data);
   		// $this->db->where ( 'status!=', '5');
   		// $this->db->order_by('orderid', 'DESC');
   		// $query = $this->db->get ();
   		// $result = $query->result_array ();
   		// return $result;
   	}
   	
   	public function getOrderbyMobile($data)
   	{
   		$this->db->select ('*');
   		$this->db->from ( TABLES::$ORDER );
   		$this->db->where ( 'mobile', $data);
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
   	}
   	
	public function getlastOrder($data)
   	{
   		$this->db->select ('a.orderid,a.ordercode,a.pickup_date,b.garage_name,d.name as subcategory');
   		$this->db->from ( TABLES::$ORDER.' AS a');
   		$this->db->join ( TABLES::$RESTAURANT.' AS b','a.vendor_id=b.id','left' );
   		//$this->db->join ( TABLES::$INVOICE.' AS c','a.orderid=c.orderid','left' );
   		$this->db->join ( TABLES::$MENU_MAIN_SUBCATEGORY.' AS d','a.subcategory_id=d.id','left' );
   		//$this->db->join ( TABLES::$ORDER_LOGS.' AS e','a.orderid=e.orderid','left' );
   		$this->db->where ( 'a.userid', $data);   
   		$this->db->order_by('a.orderid', 'DESC');
   		$this->db->limit('1');
   		$query = $this->db->get ();
   		//echo $this->db->last_query();
   		$result = $query->result_array ();
   		return $result;
	   }

	   public function getlastOrder_app($data)
   	{
   		$this->db->select ('a.orderid,a.ordercode,a.pickup_date,b.garage_name,d.name as subcategory');
   		$this->db->from ( TABLES::$ORDER.' AS a');
   		$this->db->join ( TABLES::$RESTAURANT.' AS b','a.vendor_id=b.id','left' );
   		//$this->db->join ( TABLES::$INVOICE.' AS c','a.orderid=c.orderid','left' );
   		$this->db->join ( TABLES::$MENU_MAIN_SUBCATEGORY.' AS d','a.subcategory_id=d.id','left' );
   		//$this->db->join ( TABLES::$ORDER_LOGS.' AS e','a.orderid=e.orderid','left' );
   		$this->db->where ( 'a.orderid', $data);   
   		$this->db->order_by('a.orderid', 'DESC');
   		$this->db->limit('1');
   		$query = $this->db->get ();
   		//echo $this->db->last_query();
   		$result = $query->result_array ();
   		return $result;
   	}
   	
   	public function getallComment($data)
   	{
   		$this->db->select ('a.orderid');
   		$this->db->from ( TABLES::$ORDER.' AS a');
   		$this->db->where ( 'a.userid', $data);
   		$this->db->order_by('a.orderid', 'DESC');
   		$this->db->limit('1');
   		$query1 = $this->db->get ();
   		$result1 = $query1->result_array ();
   		
   		$this->db->select ('b.comment,b.created_date as createddate');
   		$this->db->from ( TABLES::$ORDER.' AS a');
   		$this->db->join ( TABLES::$ORDER_LOGS.' AS b','a.orderid=b.orderid','left' );
   		$this->db->where ( 'b.orderid', $result1[0]['orderid']);
   		
   		$query = $this->db->get ();
   		//echo $this->db->last_query();
   		$result = $query->result_array ();
   		return $result;
	   }
	   public function getallComment_app($data)
   	{
   		$this->db->select ('a.orderid');
   		$this->db->from ( TABLES::$ORDER.' AS a');
   		$this->db->where ( 'a.orderid', $data);
   		$this->db->order_by('a.orderid', 'DESC');
   		$this->db->limit('1');
   		$query1 = $this->db->get ();
   		$result1 = $query1->result_array ();
   		
   		$this->db->select ('b.comment,b.created_date as createddate');
   		$this->db->from ( TABLES::$ORDER.' AS a');
   		$this->db->join ( TABLES::$ORDER_LOGS.' AS b','a.orderid=b.orderid','left' );
   		$this->db->where ( 'b.orderid', $result1[0]['orderid']);
   		
   		$query = $this->db->get ();
   		//echo $this->db->last_query();
   		$result = $query->result_array ();
   		return $result;
   	}
   	
   	public function getlastOrderComment($orderid)
   	{
   		$this->db->select ('*');
   		$this->db->from ( TABLES::$ORDER_LOGS);
   		//$this->db->join ( TABLES::$ORDER_LOGS.' AS b','a.orderid=b.orderid','left' );
   		$this->db->where ( 'orderid', $orderid);
   		$this->db->order_by('created_date', 'ASC');
   		$query = $this->db->get ();
   		//echo $this->db->last_query();
   		$result = $query->result_array ();
   		return $result;
   	}
   	
   	public function getBill($data)
   	{
   		$this->db->select ('a.orderid');
   		$this->db->from ( TABLES::$ORDER.' AS a');
   		$this->db->where ( 'a.userid', $data);
   		$this->db->order_by('a.orderid', 'DESC');
   		$this->db->limit('1');
   	    $query1 = $this->db->get ();
   		$result1 = $query1->result_array ();
   		
   		$this->db->select ('a.*,b.*');
   		$this->db->from ( TABLES::$ORDER.' AS a');
   		$this->db->join ( TABLES::$ORDER_SERVICE.' AS b','a.orderid=b.orderid','inner' );
   		$this->db->where ( 'b.orderid', $result1[0]['orderid']);
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
	   }
	   public function getBill_app($data)
   	  {
   		$this->db->select ('a.orderid');
   		$this->db->from ( TABLES::$ORDER.' AS a');
   		$this->db->where ( 'a.orderid', $data);
   		$this->db->order_by('a.orderid', 'DESC');
   		$this->db->limit('1');
   	    $query1 = $this->db->get ();
   		$result1 = $query1->result_array ();
   		
   		$this->db->select ('a.*,b.*');
   		$this->db->from ( TABLES::$ORDER.' AS a');
   		$this->db->join ( TABLES::$ORDER_SERVICE.' AS b','a.orderid=b.orderid','inner' );
   		$this->db->where ( 'b.orderid', $result1[0]['orderid']);
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
	   }
	   
	   
	
	public function setConfirmItem($order_id, $amont, $item_list)
   	{
		 $data = json_decode($item_list,true);
		 //print_r($data);
		foreach ($data as $key => $jsons) {
			
			foreach ($jsons as $key => $value) {	
				if ($key == 'order_id')
					$order_id = $value;				
				
				if ($key == 'service_id')
					$service_id = $value;
				
				if ($key == 'check_value')
					$check_value = $value;
				
			}
			$map = array ( "is_checked" => $check_value);
			$this->db->where('service_id',$service_id);
			$this->db->where('orderid',$order_id);
			$this->db->update(TABLES::$ORDER_SERVICE,$map);
			$notify_id = $this->db->insert_id();
			
		}
		
		$orders = $this->orderlib->getOrderDetailsByOrderId($order_id);

		$map = array ( "order_amount" => $amont + $orders[0]['old_price'],
					   "net_total" => $amont + $orders[0]['old_price'],
					   "grand_total" => $amont + $orders[0]['old_price'], 
					   "status"=>3);	
		
		$this->db->where('orderid',$order_id);
		$this->db->update(TABLES::$ORDER,$map);
		$notify_id = $this->db->insert_id();
		return $notify_id;
   	}
   	
   	public function getNotification($data)
   	{
   		$this->db->select ('a.*,b.orderid');
   		$this->db->from ( TABLES::$USER_NOTIFICATION.' AS a' );
   		$this->db->join ( TABLES::$ORDER.' AS b','a.orderid=b.orderid','inner' );
   		$this->db->where ( 'a.user_id', $data);
   		$this->db->where ( 'a.status', 1);
   		$this->db->order_by('b.orderid','DESC'); 
		//echo $this->db->last_query();
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
   	}
   	
   	public function updateNotification($map) {
   		$this->db->where('id',$map['id']);
   		$this->db->update(TABLES::$USER_NOTIFICATION,$map);
   		$notify_id = $this->db->insert_id();
   		return $notify_id;
   	}
   	
   	public function getUser($data)
   	{
   		$this->db->select ('*');
   		$this->db->from ( TABLES::$USER );
   		$this->db->where ( 'id', $data);
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
   	}
   	
   	public function getUser1($data)
   	{
   		$this->db->select ('*');
   		$this->db->from ( TABLES::$PROFILEUPDATE );
   		$this->db->where ( 'userid', $data);
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
   	}
   	
	public function userRegistration($data) {
    	$this->db->insert ( TABLES::$USER, $data );
		return $this->db->insert_id ();  
	}
	
	public function contact($data) {
		$this->db->insert ( TABLES::$CONTACT, $data );
		return $this->db->insert_id ();
	}
	
	public function updateUser($map) {
		$this->db->where('mobile',$map['mobile']);
		$this->db->update(TABLES::$USER,$map);
		$user_id = $this->db->insert_id();
        return $user_id;
	}
	
	public function updateUser1($map) {
		$this->db->where('id',$map['id']);
		$this->db->update(TABLES::$USER,$map);
		
	}
	public function updateUser3($map) {
		$this->db->where('email',$map['email']);
		$this->db->update(TABLES::$USER,$map);
		
	}
	
	public function updateUser2($data) {
		$this->db->where ( 'userid', $data['id']);
    	$this->db->delete ( TABLES::$PROFILEUPDATE);
   
    	$trans = array();
    	$trans['userid'] = $data['id'];
    	$trans['model'] = $data['model'];
    	$trans['vehicle_no'] = $data['vehicle_no'];
    	if(!empty($data['userid']))
    	$trans['userid'] = $data['userid'];
    	$this->db->insert ( TABLES::$PROFILEUPDATE, $trans );
	
	}
	
	public function addPaymentDetail($map) {
		$this->db->insert(TABLES::$PAYMENT_DETAIL,$map);
       //echo $this->db->last_query();
			return $this->db->insert_id ();
	}
	
	public function updatePaymentDetail($map) {
		$this->db->where('transactionid',$map['transactionid']);
		$this->db->update(TABLES::$PAYMENT_DETAIL,$map);
		//echo $this->db->last_query();
	}
	public function otpMatch($map) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'otp', $map['otp'] );
		$this->db->where ( 'id', $map['id'] );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		
		if (empty ( $result )) {
			$result [0] ['status'] = "0";
		} else {
			$status = array ( "status" => "1"  );
			$this->db->where ( 'id', $map['id'] );
			$this->db->update ( TABLES::$USER, $status );
			$result [0] ['status'] = "1";
		}
		
		return $result;
	}
	
	public function login($params) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return ($result);
	}
	
	public function getAddressById($data) {
		$this->db->select ( 'a.*,b.name as areaname,c.name as city' );
		$this->db->from ( TABLES::$USERADDRESS.' AS a' );
		$this->db->join ( TABLES::$AREA.' AS b','a.areaid=b.id','left' );
		$this->db->join ( TABLES::$CITY.' AS c','c.id=b.cityid','left' );
		$this->db->where ( 'a.userid', $data );
		$this->db->order_by('a.id','DESC');
		$this->db->order_by('a.is_primary','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateAddressByUserId($data) {
		$this->db->where ( 'userid', $data ['userid'] );
		$this->db->update ( TABLES::$USERADDRESS, $data );
	}
	
	public function getAddressByAddressId($id) {
			$this->db->select ( 'a.*,b.id as areaid,b.name,c.id as city_id,' )->from ( TABLES::$USERADDRESS . ' AS a' )->where ( 'a.id', $id );
			$this->db->join ( TABLES::$AREA . ' AS b', 'a.areaid=b.id', 'inner' );
			$this->db->join ( TABLES::$CITY . ' AS c', 'b.cityid=c.id', 'inner' );
			$query = $this->db->get ();
			$result = $query->result_array ();
			//print_r($result);
			return $result;
	}
	
	public function getProfile($id) {
		$this->db->select ( 'a.*,b.locality as loc,b.latitude,b.longitude' );
		$this->db->from ( TABLES::$USER.' AS a');
		$this->db->join(TABLES::$USER_ADDRESS.' AS b','a.id = b.userid','left');
		$this->db->where ( 'a.id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		//print_r($result);
		return $result;
	}
	
	public function updateUserProfile ($data) {
		$this->db->where ( 'id', $data['id'] );
		$this->db->update ( TABLES::$USER, $data );
        $this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'id', $data['id'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateLatLong ($data) {
		$this->db->where ( 'id', $data['id'] );
		$this->db->update ( TABLES::$USER, $data );
	}
	
	public function forgetPassword ($email){
		
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'email',$email );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getOrderDetailByUserId($id)
	{
		$this->db->select ( 'a.*,b.status as payment_status,b.longurl' );
		$this->db->from ( TABLES::$ORDER.' AS a' );
		$this->db->join(TABLES::$PAYMENT_DETAIL.' AS b','a.orderid = b.orderid','left');
		$this->db->where ( 'a.userid',$id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function subscribe($email)
	{   
	    $data=array();
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$SUBSCRIBE );
		$this->db->where ( $email );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count( $result ) > 0)
		{ 
			$data['message'] = "You have allready Subscribed to our newsletter . ";
		} else {
			$this->db->insert ( TABLES::$SUBSCRIBE, $email );
			$data['message'] = "Thank you for subscribing to our newsletter ! ";
			$data['email']=$email['email'];
		}
		return $data;
	}
	
	public function getUsersReport($params) {
		$this->db->select ( 'a.*,b.name as areaname,c.amount' );
		$this->db->from ( TABLES::$USER.' AS a' );
		$this->db->join ( TABLES::$AREA.' AS b','a.areaid=b.id','left' );
		$this->db->join ( TABLES::$WALLET.' AS c','a.id=c.userid','left' );
		if(!empty($params['from_date']) && !empty($params['to_date']))
			$this->db->where ( "a.created_on between '".$params['from_date']."' and '".$params['to_date']."'",'',true );
		if(!empty($params['email']))
			$this->db->where('a.email',$params['email']);
		if(!empty($params['mobile']))
			$this->db->where('a.mobile',$params['mobile']);
		if(!empty($params['name']))
			$this->db->like('a.name',$params['name'],'both');
		if(!empty($params['areaid']))
			$this->db->where('a.areaid',$params['areaid']);
		if(!empty($params['address']))
			$this->db->like('a.address',$params['address'],'both');
		if(!empty($params['source']))
			$this->db->like('a.source',$params['source'],'both');
		$this->db->order_by('a.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProfileByEmail($email) {
		$this->db->select ( 'id,email,otp' );
		$this->db->from ( TABLES::$USER );
		$this->db->like ( 'email', $email,'both' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getUserByEmail($email) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'email', $email);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProfileByMobile($mobile) {
		$this->db->select ( 'id,mobile' );
		$this->db->from ( TABLES::$USER );
		$this->db->like ( 'mobile', $mobile,'both' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getProfileByName($name) {
		$this->db->select ( 'id,name' );
		$this->db->from ( TABLES::$USER );
		$this->db->like ( 'name', $name,'both' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getValidReferralCode($ref_code) {
		$this->db->select ( 'id' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'my_ref_code', $ref_code );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getUserGcmIds() {
		$this->db->select ( 'gcm_reg_id' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'status', 1 );
		$this->db->where ( 'gcm_reg_id IS NOT NULL AND gcm_reg_id != ""', '',false );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getTodaysRegisteredUsers() {
		$date = date('Y-m-d');
		$this->db->select ( 'a.name,a.email,a.mobile,a.gcm_reg_id,max(b.ordered_on) as last_order_date' );
		$this->db->from ( TABLES::$USER.' AS a' );
		$this->db->join ( TABLES::$ORDER.' AS b','a.id=b.userid','left' );
		//$this->db->where ( 'a.created_on', $date );
		$this->db->group_by('a.id');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function deleteaddress($id) {
		$this->db->where ( 'id', $id );
		$this->db->delete ( TABLES::$USERADDRESS);
		return 1;
	}
	
	public function getUserGcmIdsbyId($userid) {
		$this->db->select ( 'gcm_reg_id' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'status', 1 );
		$this->db->where ( 'id', $userid );
		$this->db->where ( 'gcm_reg_id IS NOT NULL AND gcm_reg_id != ""', '',false );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
		
	}
	
	public function getReferCode($userid){
		$this->db->select('my_ref_code');
		$this->db->from(TABLES::$USER);
		$this->db->where('id',$userid);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getOngoingOrders($userid)
	{
		$this->db->select('e.name as model,c.name as vehicle_type,a.orderid,a.ordercode,a.pickup_date,a.order_amount,a.discount,a.net_total,a.adjustment,a.grand_total,b.garage_name,d.name as subcategory');
		$this->db->from (TABLES::$ORDER.' AS a');
		$this->db->join (TABLES::$RESTAURANT.' AS b','a.vendor_id=b.id','left' );
		//$this->db->join ( TABLES::$INVOICE.' AS c','a.orderid=c.orderid','left' );
		$this->db->join (TABLES::$MENU_MAIN_SUBCATEGORY.' AS d','a.subcategory_id=d.id','left' );
		$this->db->join ('category AS c','c.id=a.category_id','left' );
		$this->db->join ('manufacturer AS e','e.id=a.vehicle_model','left' );

		//$this->db->join ( TABLES::$ORDER_LOGS.' AS e','a.orderid=e.orderid','left' );
		$this->db->where ( 'a.userid', $userid);
		$this->db->where ( 'a.status!=', '7');
		$this->db->where ( 'a.status!=', '5');
		$this->db->order_by('a.orderid', 'DESC');
		//$this->db->limit('1');
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		//echo $this->db->last_query();
		return $result;
	}
	
	public function getOngoingOrderBill($orderid)
	{
		$this->db->select ('a.*,b.*');
		$this->db->from ( TABLES::$ORDER.' AS a');
		$this->db->join ( TABLES::$ORDER_SERVICE.' AS b','a.orderid=b.orderid','inner' );
		$this->db->where ( 'b.orderid', $orderid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}

	public function updateUserWallet($stack){
		$amount = $this->db->get_where(TABLES::$WALLET,array('userid'=>$stack['user_id']))->row('amount');
		if($amount !== ''){
			if($stack['trans_type'] == 0){
				$amount = $amount + $stack['amount'];
			}elseif ($stack['trans_type'] == 1) {
				$amount = $amount - $stack['amount'];
			}
			$this->db->set('amount',$amount);
			$this->db->where('userid',$stack['user_id']);
			$this->db->update(TABLES::$WALLET);
			$insert = array(
				'userid'=>$stack['user_id'],
				'amount'=>$stack['amount'],
				'updated_by' => $stack['trans_type'],
				'updated_date' => date('Y-m-d H:i:s'),
				'orderid' => $stack['order_id'],
				'comment' => $stack['comment']
			);
			$this->db->insert(TABLES::$WALLET_TRANSACTION,$insert);
		 	return $this->db->insert_id();
		}else{
			return 0;
		}
	}

   	public function getOrder_five($data)
   	{
   		$this->db->select ('a.*,g.name as location,h.name as brand,i.name as model,j.name as subcat,k.name as catsubcat');
   		$this->db->from ( TABLES::$ORDER.' as a' ) 
   		->join(TABLES::$MENU_MAIN_CATEGORY.' AS g','a.category_id = g.id','left')
		         ->join(TABLES::$BRAND.' AS h','a.brand_id = h.id','left')
		         ->join(TABLES::$MANUFACTURE.' AS i','a.vehicle_model = i.id','left')
	           	->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS j','a.subcategory_id = j.id','left')
	           		->join('category_subcat AS k','a.catsubcat_id = k.id','left');

   		$this->db->where ( 'a.userid', $data);
   		$this->db->where ( 'a.status!=', '5');
   		$this->db->order_by('a.orderid', 'DESC')->limit('1');

   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
   	}

   	public function orderDetails($orderid){
   		return $this->db->select('service_name')->from('tbl_booking_services')->where('orderid',$orderid)->where('is_checked',1)->get()->result_array();

   	}
           public function get_mechanic_profile_by_order_id($param) {
               return $this->db->select('a.name, a.mobile, a.image')
                               ->from('vendor AS a')
                               ->join('tbl_booking AS b', 'b.vendor_id = a.id', 'inner')
                               ->where('b.orderid', $param)
                               ->get()
                               ->result_array();
           }
	
}