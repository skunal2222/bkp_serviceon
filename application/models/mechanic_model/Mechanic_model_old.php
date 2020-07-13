<?php
class Mechanic_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
		
	public function mobileExist($data)
	{
		$this->db->select ('mobile');
		$this->db->from ( TABLES::$EMPLOYEE );
		$this->db->where ( 'mobile', $data['mobile'] );
		$this->db->where ( 'role_id', 3 );
		$this->db->where ( 'status', '1' );
		$query = $this->db->get ();
		
		$result = $query->result_array ();
		//print_r($result);
		return $result;
	}
		
	public function updatemobileRegistration($data) {
		//print_r($data);
		$this->db->where ( 'mobile', $data ['mobile'] );
		$this->db->update ( TABLES::$EMPLOYEE, $data );
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$EMPLOYEE );
		$this->db->where ( 'mobile', $data['mobile'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function otpMatch($map) {
		//print_r($map);
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$EMPLOYEE );
		$this->db->where ( 'otp', $map['otp'] );
		$this->db->where ( 'mobile', $map['mobile'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		
		if (empty ( $result )) {
			$result [0] ['status'] = "0";
		} else {
			$result [0] ['status'] = "1";
			
		}
		//echo $this->db->last_query();
		return $result;
	}
	
	public function login($params) {
	
		$this->db->select ( 'e.*' );
		$this->db->from ( TABLES::$EMPLOYEE.' AS e' );		
		$this->db->where ( 'e.mobile',$params['mobile'] );
		$this->db->where ( 'e.password',$params['password'] );
		$this->db->where ( 'e.status', '1' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if(count($result)>0){
			$gcm = array ( "gcm_token" => $params['gcm_token'] );
			$this->db->where ( 'mobile', $params['mobile']);
			$this->db->update ( TABLES::$EMPLOYEE, $gcm);	
		}
		return $result; 
	}
	
	public function suggestServices($param,$userid) {
	
		$data = json_decode($param,true);
		$result = 1;
		foreach ($data as $key => $jsons) {
			$order_id = $jsons['orderid'];
			$user_id = $jsons['orderid'];
			$insert = $this->db->insert(TABLES::$ORDER_SERVICE,$jsons);		
			$result = $this->db->insert_id();
			$totals +=   $jsons['total_amount'];
		} 		
		
		if($result == 0){
			$map=array();			
			//echo "order_id".$order_id;
			$map['mechanic_status'] = 4;
			$map['status'] = 2;
			$map['order_amount'] = $totals;
			$map['net_total'] = $totals;
			$map['grand_total'] = $totals;
			$this->db->where ( 'orderid', $order_id );
			$this->db->update ( TABLES::$ORDER, $map );
			$data = array();
			$data['orderid'] = $order_id;
			$data['comment'] = "Estimate Generated";
			$data['order_status'] = "2";
			$data['created_date'] = date("Y-m-d H:i:s");
			$data['created_by'] = $userid;
			$insert = $this->db->insert(TABLES::$ORDER_LOGS,$data);		
		}
		return $result;  
	}
	
	public function reasonlist() {
	
		$this->db->select ( 'r.*' );
		$this->db->from ( TABLES::$REASON.' AS r' );		
		
		$query = $this->db->get ();
		$result = $query->result_array ();
		
		return $result; 
	}
	
	public function suggestedServiceList($params) {
	
		
			$this->db->select ( '*' )
					 ->from ( TABLES::$ORDER_SERVICE);
			
			$this->db->where ('orderid',$params['orderid']);
			$this->db->where ('is_checked',1);
			$query = $this->db->get ();
			$result = $query->result_array ();
			//echo "count".count($result);
			if(count($result)<=0){
				$this->db->select ( '*' )
					 ->from ( TABLES::$ORDER_SERVICE);
			
				$this->db->where ('orderid',$params['orderid']);
				//$this->db->where ('is_checked',1);
				$query = $this->db->get ();
				$result = $query->result_array ();
			}
			
		return $result;
	}
	public function serviceOrSparepartsList($params) {
	
		
		if($params['type']==1)
		{
			
			$this->db->select ( '*' )
					 ->from ( TABLES::$SERVICE);
			//$this->db->like ( 'name',$params['name'],'both' );
			/* $this->db->where ('category_id',$params['category_id']);
			$this->db->where ('brand_id',$params['brand_id']);
			$this->db->where ('model_id',$params['model_id']);
			$this->db->where ('subcategory_id',$params['subcategory_id']); */
			$this->db->where ('catsubcat_id',$params['catsubcat_id']);
			$query = $this->db->get ();
			$result = $query->result_array ();
		
		}
		else
		{
			
			$this->db->select ( '*' )
			->from ( TABLES::$SPARE);
			//$this->db->like ( 'name',$params['name'],'both' );
			$this->db->where ('category_id',$params['category_id']);
			$this->db->where ('brand_id',$params['brand_id']);
			$this->db->where ('model_id',$params['model_id']);
			$this->db->where ('subcategory_id',$params['subcategory_id']);
			$query = $this->db->get ();
			$result = $query->result_array ();
			
		}
	    
		return $result; 
	}
	
	public function mainServicesList($params) {
		
		if($params['type']==1)
		{
			$this->db->select ( '*' )
					 ->from ( TABLES::$CATEGORY_SUBCATEGORY);
			//$this->db->like ( 'name',$params['name'],'both' );
			$this->db->where ('category_id',$params['category_id']);
			$this->db->where ('brand_id',$params['brand_id']);
			$this->db->where ('model_id',$params['model_id']);
			$this->db->where ('subcategory_id',$params['subcategory_id']);
			$query = $this->db->get ();
			$result = $query->result_array ();
		}else{
			$this->db->select ( '*' )
			->from ( TABLES::$SPARE);
			//$this->db->like ( 'name',$params['name'],'both' );
			$this->db->where ('category_id',$params['category_id']);
			$this->db->where ('brand_id',$params['brand_id']);
			$this->db->where ('model_id',$params['model_id']);
			$this->db->where ('subcategory_id',$params['subcategory_id']);
			$query = $this->db->get ();
			$result = $query->result_array ();
		}
		
		return $result; 
	}	
	
	public function ongoingOrders($params) {
		
		$this->db->select('a.orderid, a.ordercode,a.pickup_date,a.slot,a.status, a.accepted_by,b.name, b.mobile, b.email');
		$this->db->select ( 's.name AS service_name');
		$this->db->select ( 'm.name AS model_name');
		$this->db->select ( 'br.name AS brand_name');
		$this->db->from(TABLES::$ORDER.' AS a');
		$this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
		$this->db->join ( TABLES::$SERVICE.' AS s','s.id=a.catsubcat_id', 'left' );		
		$this->db->join ( TABLES::$MANUFACTURE.' AS m','m.id=a.vehicle_model', 'left' );		
		$this->db->join ( TABLES::$BRAND.' AS br','br.id=a.brand_id', 'left' );		
		//$this->db->where ('a.accepted_by',$params['user_id']);			
		//$this->db->where('a.status',2);		
		//$this->db->or_where('a.status',3);		
		$where = '(a.accepted_by = '.$params['user_id'].' and (a.status = "2" or a.status="3"))';
		$this->db->where($where);
		$this->db->order_by('a.orderid','desc');
		$this->db->limit(200);
		$query = $this->db->get();
			//echo $this->db->last_query();
		$result = $query->result_array ();
		
		return $result; 
	}	
	
	public function getOrder($data)
   	{
   		$this->db->select ('*');
   		$this->db->from ( TABLES::$ORDER );
   		$this->db->where ( 'accepted_by', $data);
   		$this->db->order_by('orderid', 'DESC');
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
   		$this->db->where ( 'a.orderid', $data);   
   		$this->db->order_by('a.orderid', 'DESC');
   		$this->db->limit('1');
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
   	
	public function scheduled_services($params) {
	
		
		$service_date = date("Y-m-d",strtotime('now'));
		if($params['service_day']==2){				
			$service_date = date("Y-m-d", strtotime('tomorrow'));
		} 
		
		$this->db->select ( 'o.*');
		$this->db->select ( 's.name AS service_name');
		$this->db->select ( 'm.name AS model_name');
		$this->db->select ( 'b.name AS brand_name');
		$this->db->from ( TABLES::$ORDER.' AS o');		
		$this->db->join ( TABLES::$EMPLOYEE.' AS e','e.garage_id=o.vendor_id', 'left' );		
		$this->db->join ( TABLES::$SERVICE.' AS s','s.id=o.catsubcat_id', 'left' );		
		$this->db->join ( TABLES::$MANUFACTURE.' AS m','m.id=o.vehicle_model', 'left' );		
		$this->db->join ( TABLES::$BRAND.' AS b','b.id=o.brand_id', 'left' );		
		$this->db->where ( 'e.id',$params['user_id'] );
		$this->db->where ( 'o.pickup_date', $service_date); 
		$this->db->where ( 'o.is_accepted != 2');
		$this->db->where ( 'o.mechanic_status != 6');
		$this->db->where ( 'e.garage_id=o.assign_vendor_id');
		
		$query = $this->db->get ();
		$result = $query->result_array ();
		//echo $this->db->last_query(); 
		return $result; 
	}
	
	public function updatePassword ($data) {
		
		$this->db->where ( 'mobile', $data['mobile'] );
		$result = $this->db->update ( TABLES::$EMPLOYEE, $data );
		
		//echo $this->db->last_query(); 
		return $result;
	}
	
	public function service_accept_or_reject_post ($data) {
		$map=array();
		$map['is_accepted'] = $data['accept_reject_flag'];
		$map['accepted_by'] = $data['user_id'];
		$map['reason_id'] = $data['reason_id'];
		$this->db->where ( 'orderid', $data['order_id'] );
		$result = $this->db->update ( TABLES::$ORDER, $map );
		
		//echo "result".$result;
		return $result;
	}
	
	public function update_profile($data) {
		$data['updated_datetime'] = date("Y-m-d H:i:s");
		$this->db->where ( 'id', $data['id'] );
		$result = $this->db->update ( TABLES::$EMPLOYEE, $data );
		
		//echo $result; 
		return $result;
	}
	
	public function orderStatus ($data) {
		$map=array();
		if($data['order_status'] == 1){
			$map['is_pickup_accepted'] = 1;
		}
		if($data['order_status'] == 5){
			$map['status'] = 4;
			
			$data1 = array();
			$data1['orderid'] = $data['order_id'];
			$data1['comment'] = "Work Completed.";
			$data1['order_status'] = "4";
			$data1['created_date'] = date("Y-m-d H:i:s");
			$data1['created_by'] = $data['user_id'];
			$insert = $this->db->insert(TABLES::$ORDER_LOGS,$data1);		
		}
		$map['accepted_by'] = $data['user_id'];
		$map['mechanic_status'] = $data['order_status'];
		
		$this->db->where ( 'orderid', $data['order_id'] );
		$result = $this->db->update ( TABLES::$ORDER, $map );
		
		//echo "result".$result;
		return $result;
	}
	
	
	public function paymentStatus ($data) {
		$map=array();		
		
		$map['status'] = 7;		
		$map['accepted_by'] = $data['user_id'];
		$map['mechanic_status'] = $data['order_status'];
		$map['amount_received'] = $data['received_amount'];
		
		$this->db->where ( 'orderid', $data['order_id'] );
		$result = $this->db->update ( TABLES::$ORDER, $map );
		
		//echo "result".$result;
		return $result;
	}
	
	public function getMechanicGcmIdbyId($userid) {
		$this->db->select ( 'gcm_token' );
		$this->db->from ( TABLES::$EMPLOYEE );
		$this->db->where ( 'status', 1 );
		$this->db->where ( 'id', $userid );
		$this->db->where ( 'gcm_token IS NOT NULL AND gcm_token != ""', '',false );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	
	}
	
	public function getMechanicNotificationById($userid) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER_NOTIFICATION );
		$this->db->where ( 'mec_id', $userid );
		$this->db->order_by ('created_date',desc);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	
	}
	
	public function getMechanicByGarageid($garageid) {
		$this->db->select ( 'gcm_token,id' );
		$this->db->from ( TABLES::$EMPLOYEE );
		$this->db->where ( 'status', 1 );
		$this->db->where ( 'garage_id', $garageid );
		$this->db->where ( 'gcm_token IS NOT NULL AND gcm_token != ""', '',false );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
		
	}
	
	
	
	
	
}