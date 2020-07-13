<?php
class New_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
		
	public function mobileExist($data)
	{
		$user = $this->db->get_where(TABLES::$RESTAURANT,array('mobile' => $data ['mobile'],'status'=>1))->result_array();
		if(empty($user))
		{
			$user = $this->db->get_where(TABLES::$EMPLOYEE,array('mobile' => $data ['mobile'],'status'=>1))->result_array();
			if(!empty($user)){
				$user['user'] = 'employee';
			}
		}
		else
		{
			$user['user'] = 'vendor';
		}
		return $user;
	}
		
	public function updatemobileRegistration($data) {
		$user = $this->db->get_where(TABLES::$RESTAURANT,array('mobile' => $data ['mobile']))->result_array();
		if(empty($user))
		{
			$this->db->where ( 'mobile', $data ['mobile'] );
			$this->db->update ( TABLES::$EMPLOYEE, $data );
			$this->db->select ( '*' );
			$this->db->from ( TABLES::$EMPLOYEE );
			$this->db->where ( 'mobile', $data['mobile'] );
			$query = $this->db->get ();
			$result = $query->result_array ();
			return $result;
		}
		else
		{
			$this->db->where ( 'mobile', $data ['mobile'] );
			$this->db->update ( TABLES::$RESTAURANT, $data );
			$this->db->select ( '*' );
			$this->db->from ( TABLES::$RESTAURANT );
			$this->db->where ( 'mobile', $data['mobile'] );
			$query = $this->db->get ();
			$result = $query->result_array ();
			return $result;	
		}
	}
	
	public function otpMatch($map) {

		$result = $this->db->get_where(TABLES::$RESTAURANT,array('mobile' => $map ['mobile'],'otp' =>$map['otp']))->result_array();
		if(empty($result)){
			$result = $this->db->get_where(TABLES::$EMPLOYEE,array('mobile' => $map ['mobile'],'otp' =>$map['otp']))->result_array();
			if (empty ( $result )) {
				$result [0] ['status'] = "0";
			} else {
				$result [0] ['status'] = "1";
			}
			return $result;
		}else{
			$result [0] ['status'] = "1";
			return $result;
		}
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
			$result[0]['role'] = 2;
			$gcm = array ( "gcm_token" => $params['gcm_token'] );
			$this->db->where ( 'mobile', $params['mobile']);
			$this->db->update ( TABLES::$EMPLOYEE, $gcm);	
		}else{
			$this->db->select ( 'e.*' );
			$this->db->from ( TABLES::$RESTAURANT.' AS e' );		
			$this->db->where ( 'e.mobile',$params['mobile'] );
			$this->db->where ( 'e.password',$params['password'] );
			$this->db->where ( 'e.status', '1' );
			$query = $this->db->get ();
			$result = $query->result_array ();
			if(count($result)>0){
				$result[0]['role'] = 1;
				$gcm = array ( "gcm_token" => $params['gcm_token'] );
				$this->db->where ( 'mobile', $params['mobile']);
				$this->db->update ( TABLES::$RESTAURANT, $gcm);	
				
			}
		}
		return $result; 
	}
	
	public function suggestServices($param,$userid) {
	
		$data = json_decode($param,true);
		$result = 1;

		foreach ($data as $key => $jsons) {
			$order_id = $jsons['orderid'];
                        $jsons['service'] = $jsons['type'];
                        $jsons['service_price'] = $jsons['total_amount'];
                        //$jsons['total_amount'] = $jsons['total_amount'];
                        //$jsons['tax'] = 0;
                        unset($jsons['type']);
			// $user_id = $jsons['orderid'];orderid
			$totals = 0;
			$service = $this->db->get_where(TABLES::$ORDER_SERVICE,array('service_id'=>$jsons['service_id'], 'service' => $jsons['service'], 'orderid'=>$jsons['orderid'],'is_package_service'=> 0))->result_array();
			if(empty($service))
			{
				$insert = $this->db->insert(TABLES::$ORDER_SERVICE,$jsons);		
				$result = $this->db->insert_id();
				//$totals +=   $jsons['total_amount'];
			}else{
				$this->db->where('orderid',$service[0]['orderid']);
				$this->db->where('service_id',$service[0]['service_id']);
                                $this->db->where('service',$service[0]['service']);
				$this->db->update(TABLES::$ORDER_SERVICE,$jsons);		
				$result = $this->db->affected_rows();
				//$totals +=   $jsons['total_amount'];
			}
		} 		
		//echo $result;exit;
		if($result == 0){
			$map=array();			
			//echo "order_id".$order_id;
			$map['mechanic_status'] = 4;
			$map['status'] = 2;
			//$map['order_amount'] = $totals;
			//$map['net_total'] = $totals;
			//$map['grand_total'] = $totals;
			$this->db->where ( 'orderid', $order_id );
			$this->db->update ( TABLES::$ORDER, $map );
			$data = array();
			$data['orderid'] = $order_id;
			$data['comment'] = "Estimate Generated";
			$data['order_status'] = "2";
			$data['created_date'] = date("Y-m-d H:i:s");
			$data['created_by'] = $userid;
			$data['source'] = "Mechanic App";
			$insert = $this->db->insert(TABLES::$ORDER_LOGS,$data);		
		}
		return $result;  
	}
	
	public function reasonlist() {
	
		$this->db->select ( 'r.id as reason_id,r.name as reason_heading' );
		$this->db->from ( TABLES::$CANCEL_REASON.' AS r' );		
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
			$result['service_details'] = $query->result_array ();
			//echo "count".count($result);
			if(count($result['service_details'])<=0){
				$this->db->select ( '*' )
					 ->from ( TABLES::$ORDER_SERVICE);
			
				$this->db->where ('orderid',$params['orderid']);
				//$this->db->where ('is_checked',1);
				$query = $this->db->get ();
				$result['service_details'] = $query->result_array ();
			}
		$result['order_details'] = $this->db->select('b.orderid, b.discount, b.net_total,  b.grand_total, b.adjustment')
                                                    ->from('tbl_booking AS b')
                                                    ->where('b.orderid', $params['orderid'])
                                                    ->get()
                                                    ->result_array();	
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
			$this->db->where ('status',1);
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
			$this->db->where ('status',1);
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
		if($params['role'] == 1){
			$where = '(a.vendor_id = '.$params['user_id'].' and (a.status = "1"  or a.status = "2" or a.status="3" or a.status = "4" or a.status = "5"))';
		}else{
			$where = '(a.accepted_by = '.$params['user_id'].' and (a.status = "1"  or a.status = "2" or a.status="3" or a.status = "4" or a.status = "5" ))';
		}
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
		
		if($data['role'] == 1){
			$this->db->where ( 'vendor_id', $data['id']);
			//$this->db->where ( 'o.mechanic_status > 5');
			//$this->db->where ( 'accepted_by', $data);
		}else{
			$this->db->where ( 'accepted_by', $data['id']);
			//$this->db->where ( 'o.mechanic_status > 5');
		}
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
		//$this->db->select ( 'u.latitude AS user_latitude, u.longitude as user_longitude');
		$this->db->from ( TABLES::$ORDER.' AS o');		
		$this->db->join ( TABLES::$EMPLOYEE.' AS e','e.garage_id=o.vendor_id', 'left' );		
		$this->db->join ( TABLES::$SERVICE.' AS s','s.id=o.catsubcat_id', 'left' );		
		$this->db->join ( TABLES::$MANUFACTURE.' AS m','m.id=o.vehicle_model', 'left' );		
		$this->db->join ( TABLES::$BRAND.' AS b','b.id=o.brand_id', 'left' );		
		//$this->db->join ( TABLES::$USER.' AS u','o.userid=u.id', 'left' );		
		//$this->db->where ( 'e.id',$params['user_id'] );
		$this->db->where('o.mec_id',$params['user_id']);
		$this->db->where ( 'o.pickup_date', $service_date); 
		$this->db->where ( 'o.is_accepted != 2');
		$this->db->where ( 'o.mechanic_status != 6');
		$this->db->group_by ( 'o.orderid');
                $this->db->order_by ( 'o.orderid', 'DESC');
		//$this->db->where ( 'e.garage_id=o.vendor_id');
		
		$query = $this->db->get ();
		$result = $query->result_array ();
		//echo $this->db->last_query(); 
		return $result; 
	}
	
	public function updatePassword ($data) {
		$exist = $this->db->get_where(TABLES::$EMPLOYEE,array('mobile'=>$data['mobile']))->result_array();
		if(empty($exist)){
			$this->db->where ( 'mobile', $data['mobile'] );
			$result = $this->db->update ( TABLES::$RESTAURANT, $data );	
		}else{
			$this->db->where ( 'mobile', $data['mobile'] );
			$result = $this->db->update ( TABLES::$EMPLOYEE, $data );
		}
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
		return $result;
	}
	
	public function update_profile($data) {
		$data['updated_datetime'] = date("Y-m-d H:i:s");
		$this->db->where ( 'id', $data['id'] );
		$result = $this->db->update ( 'vendor', $data );
		
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
		$map['pay_mode'] = $data['pay_mode'];
		$map['remarks'] = $data['remarks'];
		//$map['pay_mode'] = 2;
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

	public function getVendorByGarageid($garageid) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$RESTAURANT );
		$this->db->where ( 'status', 1 );
		$this->db->where ( 'id', $garageid );
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
	
	public function assignMechnic ($data) {
		
		$this->db->where ( 'orderid', $data['order_id'] );
		unset($data['order_id']);
		$result = $this->db->update ( TABLES::$ORDER, $data );
		
		//echo $this->db->last_query(); 
		return $result;
	}
	
	public function getMechnicList($param) {
		$this->db->select ( 'id, name' );
		$this->db->from ( TABLES::$EMPLOYEE );
		$this->db->where ( 'status', 1 );
		$this->db->where ( 'garage_id', $param['vendor_id'] );
		
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
		
	}
	
	public function addMechanic ($data) {
		
		$insert = $this->db->insert(TABLES::$EMPLOYEE,$data);	
		$result = $this->db->insert_id();		
		return $result;
	}
	
	public function getRoleList() {
		
		$this->db->select ( 'id, name' );
		$this->db->from ( 'role');
		$this->db->where ( 'status', 1 );
		
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
		
	}

	public function get_payment_details($orderid) {
		echo $orderid;exit;
	}

	public function invoice($filter_array){
		return $this->db->select('settlment_amount,invoice_url,paid,invoice_no')->order_by('id','DESC')->get_where('tbl_vendor_invoice',array('vendor_id' =>$filter_array['vendor_id'],'paid'=>$filter_array['condition']))->result_array();
	}

	public function getMechanic($user_id){
		return $this->db->get_where(TABLES::$EMPLOYEE,array('id' => $user_id))->result_array();
	}

	public function addUserVehicle($cat){ 
		$data = array (); 
          
        $params = array (
                'user_id' => $cat ['user_id'],
                'vehicle_no' => $cat ['vehicle_no']
        );
        $data1 = array(
            'user_id' => $cat['user_id'],
            'vehicle_no' => $cat['vehicle_no'],
            'vehicle_alias_no' => str_replace(" ", "_", strtolower(trim($cat['vehicle_no']))), 
            'brand_id' => $cat['brand_id'],
            'model_id' => $cat['model_id'],
            'created_datetime' => $cat['created_datetime'],
            'status' => $cat['status']
        ); 
        $this->db->select ( 'id' )->from ( TABLES::$USER_VEHICLES )->where ( $params );
        $query = $this->db->get ();
        $result = $query->result_array ();

        if (count ( $result ) <= 0) {
            $this->db->insert ( TABLES::$USER_VEHICLES, $data1 );
            $data['id'] = $this->db->insert_id();
            $data['msg'] = "Vehical Added Successfully";
            $data['success'] = "true";
            return $data;
        } else {
            $data['msg'] = "Vehical already exists.";
            $data['success'] = "false";
            //return $data;
            echo json_encode($data);
            exit;
        }
	}

	public function getVehicleListByID($params){
		/*
			This function used in following cases 
			1.Get All Vehicles According to user_id
			2.Get Active vehicle @$params['status'] required
			3.Get Inactive vehicle @$params['status'] required
		*/
		$result = $this->db->select('a.*,b.name as brand_name,b.id as brand_id,c.name as model_name,c.id as model_id')
						 ->from(TABLES::$USER_VEHICLES.' AS a')
						 ->join(TABLES::$BRAND.' AS b','b.id = a.brand_id')
						 ->join(TABLES::$MANUFACTURE.' AS c','c.id = a.model_id')
						 ->where('a.user_id',$params['user_id'])
						 ->where('a.status',$params['status'])
						 ->get()
						 ->result_array();
		return $result; 
	}

	public function getVehicleListByVehicleID($params){
		/*
			This function used in following cases 
			1.Get All Vehicles According to user_id
			2.Get Active vehicle @$params['status'] required
			3.Get Inactive vehicle @$params['status'] required
		*/ 

			echo "<pre>";
			print_r($params);
			exit();

		$result = $this->db->select('a.*,b.name as brand_name,b.id as brand_id,c.name as model_name,c.id as model_id')
						 ->from(TABLES::$USER_VEHICLES.' AS a')
						 ->join(TABLES::$BRAND.' AS b','b.id = a.brand_id')
						 ->join(TABLES::$MANUFACTURE.' AS c','c.id = a.model_id')
						 ->join(TABLES::$USER.' AS d','d.id = a.user_id') 
						 ->where('d.user_id',$params['user_id'])
						 ->where('a.status',$params['status'])
						 ->get()
						 ->result_array();
		return $result;

		echo "<pre>";
		print_r($result);
		exit();

	} 

	public function deleteUserVehicle($data)
	{ 

		echo "<pre>";
		print_r($data);
		exit();
		$this->db->set('status',$data['status']);
		$this->db->where('id',$data['id']);
		$this->db->update(TABLES::$USER_VEHICLES);
		return true;
	}

	public function getModelByParams($data)
	{
		return $this->db->get_where(TABLES::$USER_VEHICLES,
			array('id'=>$data['vehicle_id']))->result_array();
	}

	public function getPackageListByModel($data)
	{
		$result = $this->db->select('p.*,pm.model_id')
				 ->from('packages as p')
				 ->join('package_models as pm','pm.package_id = p.id')
                 ->where('p.id NOT IN (SELECT tup.package_id from tbl_user_package AS tup WHERE tup.user_id = '. $data['user_id'] .' AND tup.vehicle_id = '. $data['vehicle_id'] .' AND tup.is_expire = 1)', NULL, FALSE)
                                 ->where('pm.model_id',$data['model_id'])
                                 ->where('p.status',1)
                                 
				 ->get()
				 ->result_array(); 
		return $result;
	}

	public function getServiceByPackageID($id)
	{
		$result = $this->db->select('p.*,pm.name,p.id as service_id')
				 ->from('package_services as p')
				 ->join('service as pm','pm.id = p.service_id')
				 ->where('p.package_id',$id)
				 ->get()
				 ->result_array();
		return $result;
	}

	/*public function getServiceGroup($params)
	{

		$sql="SELECT a.id, a.name,c.image FROM `category_subcat` AS `a`JOIN `tbl_user_vehicles` as `b` ON `a`.`model_id` = `b`.`model_id` and a.brand_id=b.brand_id JOIN `subcategory` as `c` ON `c`.`model_id` = `b`.`model_id` and c.brand_id=b.brand_id WHERE b.`model_id`= {$params['model_id']} and b.brand_id= {$params['brand_id']} and b.id= {$params['vehicle_id']} AND `a`.`status` = 1 and c.sub_id= {$params['subcategory_id']} GROUP BY `a`.`name` ORDER BY `a`.`id` ASC";
		$query = $this->db->query($sql);

		$result = $query->result_array ();
		 
		return $result;	
	}*/

	public function getServiceGroup($params)
	{

		$this->db->select ( 'a.id,a.name, b.image', FALSE )->from ( TABLES::$CATEGORY_SUBCATEGORY . ' AS a' );
		$this->db->join(TABLES::$MENU_MAIN_SUBCATEGORY.' as b','b.id = a.subcategory_id');
		$this->db->join(TABLES::$USER_VEHICLES.' as c','c.model_id = a.model_id');
		$this->db->where('b.sub_id',$params['subcategory_id']);
		$this->db->where('c.id',$params['vehicle_id']);
		$this->db->where ( 'a.status', 1 );
		//$this->db->where ( 'a.subcategory_id');  
		$this->db->order_by ( 'a.id', 'ASC' ); 
		$this->db->group_by('a.name');
		$query = $this->db->get ();
		$result = $query->result_array ();
		// print_r($result); 
		// exit;
		return $result;	 
	}
	public function getSubcatId_new($data) { 

		$where = "brand_id='{$data['brand_id']}' AND model_id='{$data['model_id']}' AND sub_id='{$data['subcategory_id']}' AND category_id=9";

		$this->db->select ( 'id' )->from ( 'subcategory');
		$this->db->where ( 'status', 1 );
		$this->db->where($where);
 		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result[0]['id'];
	}

	public function getServiceGroup1($subcat_id) {
		$this->db->select ( 'a.id,a.name, b.image', FALSE )->from ( TABLES::$CATEGORY_SUBCATEGORY . ' AS a' );
		$this->db->join(TABLES::$MENU_MAIN_SUBCATEGORY.' as b','b.id = a.subcategory_id');
		$this->db->where ( 'a.status', 1 );
		$this->db->where_in ( 'a.subcategory_id', $subcat_id );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	 
	}

	public function getServicesDataByID($id)
	{
		$result = $this->db->select('id, name')
                            ->from('service')
                            ->where_in('catsubcat_id', $param)
                            ->get()
                            ->result_array();
        /*echo "<pre>";
        print_r($result);
        exit;*/
	}	


    public function getServiceListByGroupID($id)
    {
    	$result = $this->db->select('*')
                            ->from('service')
                            ->where_in('catsubcat_id', $id)
                            ->where('status', 1)
                            ->get()
                            ->result_array();
        return $result;
    }

    public function getSpareList($params){
    	$result = $this->db->select('a.*')
                            ->from('spare as a')
                            ->join('subcategory as b','b.id = a.subcategory_id')
                            ->where('a.brand_id', $params['brand_id'])
                            ->where('a.model_id', $params['model_id'])
                            ->where('b.sub_id',$params['subcategory_id'])
                            ->where('a.status', 1)
                            ->get()
                            ->result_array();
        return $result;
    }

    public function add_user_vehicle_license($cat){ 

       	$data1 = array(   
            'license_url' => $cat['license_url'] 
        );

        $this->db->where('id',$cat['user_id']);
        $this->db->update(TABLES::$USER,$data1); 
       
        $data['msg'] = "License Added Successfully";
        $data['success'] = "true";
        return $data; 
        echo json_encode($data);
        exit;
        
	      
	}

	public function add_vehicle_documents($cat){ 

        $data = array (); 
          
        $data1 = array(
            'user_id' => $cat['user_id'],
            'vehicle_id' => $cat['vehicle_id'],
            'type' => $cat['type'],
            'url' => $cat['url'], 
            'created_datetime' => $cat['created_datetime'] 
        ); 
        
            $this->db->insert ( TABLES::$VEHICLES_DOCUMENTS, $data1 );
            $data['id'] = $this->db->insert_id();
            $data['msg'] = "Document Added Successfully";
            $data['success'] = "true";
            return $data; 
            echo json_encode($data);
            exit;
        
	}

	public function add_other_vehicle_documents($cat){ 

        $data = array (); 
          
        $data1 = array(
            'user_id' => $cat['user_id'],
            'vehicle_id' => NULL,
            'type' => NULL,
            'url' => $cat['url'], 
            'created_datetime' => $cat['created_datetime'] 
        ); 
        
            $this->db->insert ( TABLES::$VEHICLES_DOCUMENTS, $data1 );
            $data['id'] = $this->db->insert_id();
            $data['msg'] = "Document Added Successfully";
            $data['success'] = "true";
            return $data; 
            echo json_encode($data);
            exit;
        
	}

	public function uploadVehicleALLDocument($cat){ 

        $data = array (); 
          
        $data1 = array(
            'user_id' => $cat['user_id'],
            'vehicle_id' => $cat['vehicle_id'],
            'type' => $cat['type'],
            'url' => $cat['url'], 
            'created_datetime' => $cat['created_datetime'] 
        ); 
        
            $this->db->insert ( TABLES::$VEHICLES_DOCUMENTS, $data1 );
            $data['id'] = $this->db->insert_id();
            $data['msg'] = "Document Added Successfully";
            $data['success'] = "true";
            return $data; 
            echo json_encode($data);
            exit;
        
	}

	public function uploadLicenseDocument($cat){ 

         $data1 = array(   
            'license_url' => $cat['license_url'] 
        );

        $this->db->where('id',$cat['user_id']);
        $this->db->update(TABLES::$USER,$data1); 
       
        $data['msg'] = "License Added Successfully";
        $data['success'] = "true";
        return $data; 
        echo json_encode($data);
        exit;
        
	}

	public function update_vehicle_documents($cat){  
          
        $response = array();
		$result = $this->db->get_where(TABLES::$VEHICLES_DOCUMENTS,array(
			'id' => $cat['id'] ))->result_array();
  
		if(!empty($result)){
			$update = array(
			
			'user_id' => $cat['user_id'],
            'vehicle_id' => $cat['vehicle_id'],
            'type' => $cat['type'],
            'url' => $cat['url'],  
			'updated_datetime' => $cat['updated_datetime']  
		);
			$this->db->where('id',$cat['id']);
			$this->db->update(TABLES::$VEHICLES_DOCUMENTS,$update);
			$response['id'] = 1;
			$response['msg'] = "Document updated successfully";
		}
		else
		{
			$response['id'] = 0;
			$response['msg'] = "No Change in document data.";
		}
		return $response;  
        
	}

	public function update_other_vehicle_documents($cat){  
          
        $response = array();
		$result = $this->db->get_where(TABLES::$VEHICLES_DOCUMENTS,array(
			'id' => $cat['id'] ))->result_array();
  
		if(!empty($result)){
			$update = array(
			
			'user_id' => $cat['user_id'],
            'vehicle_id' => NULL,
            'type' =>  NULL,
            'url' => $cat['url'],  
			'updated_datetime' => $cat['updated_datetime']  
		);
			$this->db->where('id',$cat['id']);
			$this->db->update(TABLES::$VEHICLES_DOCUMENTS,$update);
			$response['id'] = 1;
			$response['msg'] = "Document updated successfully";
		}
		else
		{
			$response['id'] = 0;
			$response['msg'] = "No Change in document data.";
		}
		return $response;  
        
	}
 	public function getVehicleLicenseByID($data)
	{

		echo "<pre>";
		print_r($data);
		exit();
		 $result = $this->db->select('a.id,a.license_url')
						 ->from(TABLES::$USER.' AS a') 
						 ->where('a.id',$data['user_id']) 
						 ->get()
						 ->result_array();
		return $result;
	}

	public function getVehicleDocumentByID($data)
	{
		 $result = $this->db->select('a.*')
						 ->from(TABLES::$VEHICLES_DOCUMENTS.' AS a') 
						 ->where('a.user_id',$data['user_id'])
						 ->where('a.vehicle_id',$data['vehicle_id'])
						 ->get()
						 ->result_array();
		return $result;
	}

	public function getVehicleOtherDocuments($data)
	{
		 $result = $this->db->select('a.*')
						 ->from(TABLES::$VEHICLES_DOCUMENTS.' AS a') 
						 ->where('a.user_id',$data['user_id'])
						 ->where('a.type', NULL)
						 ->get()
						 ->result_array();
		return $result;
	}

	public function getVehicleDocuments($data)
	{
		 $result = $this->db->select('a.*')
						 ->from(TABLES::$VEHICLES_DOCUMENTS.' AS a') 
						 ->where('a.user_id',$data['user_id'])
						 ->where('a.vehicle_id',$data['vehicle_id'])
						 ->where('a.type',$data['type'])
						 ->get()
						 ->result_array();
		return $result;
	}

	public function update_vehicle_license($data)
	{

		$response = array();
	 
			$update = array( 
			'license_url' => $data['license_url']);
		 
			$this->db->where('id',$data['user_id']);
			$this->db->update(TABLES::$USER,$update);
			$response['id'] = 1;
			$response['msg'] = "License updated successfully";
		 
		return $response;
	}
 
	public function updateUserVehicle($data)
	{
		$response = array();
		$result = $this->db->get_where(TABLES::$USER_VEHICLES,array(
			'id' => $data['id'],
			'user_id' => $data['user_id'],
			'vehicle_alias_no' => $data['vehicle_alias_no'],
			'brand_id' => $data['brand_id'],
			'model_id' => $data['model_id'], 
            'license_number' => $data['license_number'],
            'insurance_brand' => $data['insurance_brand'],
            'insurance_number' => $data['insurance_number'],
			'status' => $data['status'],
		))->result_array();
		if(empty($result)){
			$update = array(
			'user_id' => $data['user_id'],
			'vehicle_no' => $data['vehicle_no'],
			'vehicle_alias_no' => $data['vehicle_alias_no'],
			'brand_id' => $data['brand_id'],
			'model_id' => $data['model_id'], 
            'license_number' => $data['license_number'],
            'insurance_brand' => $data['insurance_brand'],
            'insurance_number' => $data['insurance_number'],
			'status' => $data['status']
		);
			$this->db->where('id',$data['id']);
			$this->db->update(TABLES::$USER_VEHICLES,$update);
			$response['id'] = 1;
			$response['msg'] = "Vehicle data updated successfully";
		}
		else
		{
			$response['id'] = 0;
			$response['msg'] = "No Change in vehicle data.";
		}
		return $response;
	}
 
	public function delete_vehicle_license($data)
	{ 
		$this->db->set('license_url', NULL);
		$this->db->where('id',$data['id']);
		$this->db->update(TABLES::$USER);
		return true;
	}

	public function delete_vehicle_documents($data)
	{ 

		$this->db->where('id',$data['id']);
		$this->db->where('type',$data['type']);
		$this->db->delete(TABLES::$VEHICLES_DOCUMENTS);
		return true;
	}
 


}