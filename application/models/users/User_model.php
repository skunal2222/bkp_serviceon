<?php
class User_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}

	/************************ code start by kunal**************************/
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

	public function submit_address($data)
	{
		if (!empty($data['id'])) {
			$this->db->set($data);
			$this->db->where('id',$data['id']);
			$this->db->update('user_address');
			return 1;
		} else {
			$this->db->insert('user_address', $data);
			return 1;
		}
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

	public function getSlotdetails($data=NULL)
   	{
   		$this->db->select ('*');
   		$this->db->from ( TABLES::$VISITING_SLOT );
   		$this->db->where ( 'status',1);
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
   	}   	

	/************************ code end by kunal**************************/

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
		$this->db->where ( 'mobile', $data['mobile'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
      	return $result;
   	}

   	public function getUserAddressById($userid) {
		$this->db->select ('*');
		$this->db->from ( TABLES::$USERADDRESS);
		$this->db->where ( 'userid', $userid );  
		$this->db->order_by ( 'id', 'DESC' );
		$this->db->order_by ( 'is_primary', 'DESC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		
		return $result;
	}

	public function getOngoingOrders($userid)
	{
		$this->db->select ('a.orderid,e.name as model_name,f.name as brand_name,a.ordercode,a.pickup_date,a.order_amount,a.discount,a.net_total,a.adjustment,a.grand_total,b.garage_name,d.name as subcategory');
		$this->db->from ( TABLES::$ORDER.' AS a');
		$this->db->join ( TABLES::$MANUFACTURE.' AS e','a.vehicle_model=e.id','inner' );
		$this->db->join ( TABLES::$BRAND.' AS f','a.brand_id=f.id','inner' );
		$this->db->join ( TABLES::$RESTAURANT.' AS b','a.vendor_id=b.id','left' );

		//$this->db->join ( TABLES::$INVOICE.' AS c','a.orderid=c.orderid','left' );
		$this->db->join ( TABLES::$MENU_MAIN_SUBCATEGORY.' AS d','a.subcategory_id=d.id','left' );
		//$this->db->join ( TABLES::$ORDER_LOGS.' AS e','a.orderid=e.orderid','left' );
		$this->db->where ( 'a.userid', $userid);
		$this->db->where ( 'a.status!=', '7');
		$this->db->where ( 'a.status!=', '5');
		$this->db->order_by('a.orderid', 'DESC');
		//$this->db->limit('1');
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}

	public function getOrderhistory($userid)
	{
		$this->db->select ('a.orderid,e.name as model_name,f.name as brand_name,a.ordercode,a.pickup_date,a.order_amount,a.discount,a.net_total,a.adjustment,a.grand_total,b.garage_name,d.name as subcategory,c.invoice_url as invoice_url');
		$this->db->from ( TABLES::$ORDER.' AS a');
		$this->db->join ( TABLES::$MANUFACTURE.' AS e','a.vehicle_model=e.id','inner' );
		$this->db->join ( TABLES::$BRAND.' AS f','a.brand_id=f.id','inner' );
		$this->db->join ( TABLES::$RESTAURANT.' AS b','a.vendor_id=b.id','left' );

		$this->db->join ( TABLES::$INVOICE.' AS c','a.orderid=c.orderid','left' );
		$this->db->join ( TABLES::$MENU_MAIN_SUBCATEGORY.' AS d','a.subcategory_id=d.id','left' );
		//$this->db->join ( TABLES::$ORDER_LOGS.' AS e','a.orderid=e.orderid','left' );
		$this->db->where ( 'a.userid', $userid);
		$this->db->where ( 'a.status=', '7');
		$this->db->order_by('a.orderid', 'DESC');
		//$this->db->limit('1');
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}

	
   	
   	public function getOrder($data)
   	{
   		$this->db->select ('*');
   		$this->db->from ( TABLES::$ORDER );
   		$this->db->where ( 'userid', $data);
   		$this->db->where ( 'status!=', '5');
   		$this->db->order_by('orderid', 'DESC');
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
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
		
		$map = array ( "order_amount" => $amont, "net_total" => $amont, "grand_total" => $amont);	
		
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
		return 1;
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

	public function addRidePaymentDetail($map) {
		$this->db->insert(TABLES::$RIDE_PAYMENT_DETAIL,$map);
       //echo $this->db->last_query();
			return $this->db->insert_id ();
	}
        public function addClientPaymentDetail($param) {
            $this->db->insert('tbl_client_payment_details', $param);
            return $this->db->insert_id ();
        }
	
	public function updatePaymentDetail($map) {
		$this->db->where('transactionid',$map['transactionid']);
		$this->db->update(TABLES::$PAYMENT_DETAIL,$map);
		//echo $this->db->last_query();
	}

	public function updateRidePaymentDetail($map) {
		$this->db->where('transactionid',$map['transactionid']);
		$this->db->update(TABLES::$RIDE_PAYMENT_DETAIL,$map);
		//echo $this->db->last_query();
	}
        public function updateClientPaymentDetail($map) {
		$this->db->where('transactionid',$map['transactionid']);
		$this->db->update('tbl_client_payment_details',$map);
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
	
	
	
	public function addAddress($data) {
		$this->db->insert ( TABLES::$USERADDRESS, $data );
		return $this->db->insert_id ();
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
	
	public function updateAddress($data) {
		$this->db->where ( 'id', $data ['id'] );
		$this->db->update ( TABLES::$USERADDRESS, $data );
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
	
	// public function getOngoingOrders($userid)
	// {
	// 	$this->db->select ('a.orderid,a.ordercode,a.pickup_date,a.order_amount,a.discount,a.net_total,a.adjustment,a.grand_total,b.garage_name,d.name as subcategory');
	// 	$this->db->from ( TABLES::$ORDER.' AS a');
	// 	$this->db->join ( TABLES::$RESTAURANT.' AS b','a.vendor_id=b.id','left' );
	// 	//$this->db->join ( TABLES::$INVOICE.' AS c','a.orderid=c.orderid','left' );
	// 	$this->db->join ( TABLES::$MENU_MAIN_SUBCATEGORY.' AS d','a.subcategory_id=d.id','left' );
	// 	//$this->db->join ( TABLES::$ORDER_LOGS.' AS e','a.orderid=e.orderid','left' );
	// 	$this->db->where ( 'a.userid', $userid);
	// 	$this->db->where ( 'a.status!=', '7');
	// 	$this->db->where ( 'a.status!=', '5');
	// 	$this->db->order_by('a.orderid', 'DESC');
	// 	//$this->db->limit('1');
	// 	$query = $this->db->get ();
	// 	//echo $this->db->last_query();
	// 	$result = $query->result_array ();
	// 	return $result;
	// }
	
	public function getOngoingOrderBill($orderid)
	{
		$this->db->select ('a.*,b.*');
		$this->db->from ( TABLES::$ORDER.' AS a');
		$this->db->join ( TABLES::$ORDER_SERVICE.' AS b','a.orderid=b.orderid','inner' );
		$this->db->where ( 'b.orderid', $orderid);
		$this->db->where ( 'b.is_checked', 1);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
}