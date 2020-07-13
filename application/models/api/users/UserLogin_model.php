<?php
class UserLogin_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}

	public function userLoginExist($data)
	{
		$this->db->select ('*');
		$this->db->from ( TABLES::$USER );
		$this->db->where("(email = '" . $data['username'] . "' OR mobile = '" . $data['username'] . "') ");
		$query = $this->db->get ();
		$result = $query->row_array();
		return $result;
	}

	public function userExist($data)
    {
        $this->db->select ('*');
		$this->db->from ( TABLES::$USER );
		//$this->db->where ( 'email', $data['email'] );
		//$this->db->or_where ( 'mobile', $data['mobile'] );
		$this->db->where("(email = '" . $data['email'] . "' OR mobile = '" . $data['mobile'] . "') ");
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
      	return $result;
   	}
   	public function UpdateOTP($id,$otp){ 
		//$this->db->set('otp',$otp);
		$this->db->where('id',$id);
		$this->db->update(TABLES::$USER,array('otp'=>$otp));
		//echo $this->db->last_query();  
	}

	public function userRegistration($data) {
    	$this->db->insert ( TABLES::$USER, $data );
		return $this->db->insert_id ();  
	}
	
	public function mobileExist($data)
	{
		$this->db->select ('*');
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'mobile', $data['mobile'] );
		//$this->db->where ( 'email', $data['email'] );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function mobileRegistration($data) {
		$this->db->insert ( TABLES::$USER, $data );
		return $this->db->insert_id ();
	}
	
	public function updatemobileRegistration($data) {
		//print_r($data);
		$this->db->where ( 'mobile', $data ['mobile'] );
		$this->db->update ( TABLES::$USER, $data );
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'mobile', $data['mobile'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function otpMatch($map) {
		//print_r($map);
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'otp', $map['otp'] );
		$this->db->where ( 'id', $map['id'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		
		if (empty ( $result )) {
			$result [0] ['status'] = "0";
		} else {
			$status = array ( "status" => "1"  );
			$this->db->where ( 'id', $map['id'] );
			$this->db->update ( TABLES::$USER, $status );
			$result [0] ['status'] = "1";
		}
		//echo $this->db->last_query();
		return $result;
	}
	
	public function login($params) {
	/*	$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( $params );
		$this->db->where ( 'status', '1' );
		$query = $this->db->get ();
		$preCheck = $query->num_rows();
		if($preCheck > 0){
			$prevResult = $query->row_array();
			$data['last_login'] = date("Y-m-d H:i:s");
			$update = $this->db->update(TABLES::$USER,$data,array('id'=>$prevResult['id']));
		}
		$result = $query->result_array ();
		return ($result);*/
		
		//$this->db->select ( 'a.*,b.pickup_date,b.slot,b.locality,b.address' );
		$this->db->select ( 'a.*' );
		$this->db->from ( TABLES::$USER.' AS a' );
		//$this->db->join ( TABLES::$ORDER.' AS b','a.id=b.userid','left' );
		$this->db->where ( 'a.mobile',$params['mobile'] );
		$this->db->where ( 'a.password',$params['password'] );
		//$this->db->where ( 'a.status', '1' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function loginwithOTP($otp){
		if (!empty($otp['id'])) {
			$data['otp'] = $otp['otp'];
			$data['mobile'] = $otp['mobile'];
			$this->db->where('id',$otp['id']);
			$this->db->update(TABLES::$USER,$data);
		} else {
			$data['otp'] = $otp['otp'];
			$data['mobile'] = $otp['mobile'];
			$data['status'] = 1;
			$data['is_new_customer'] = 1;
			$data['created_on'] = date('Y-m-d');
			$this->db->insert(TABLES::$USER,$data);
		}

		$this->db->select('*');
		$this->db->from(TABLES::$USER);
		$this->db->where(['otp'=>$otp['otp'],'mobile'=>$otp['mobile']]);
		$query = $this->db->get();
	
		$result = $query->row_array();
		return $result;
	}

	/*public function loginwithOTP($params) {
		$this->db->select ( 'a.*' );
		$this->db->from ( TABLES::$USER.' AS a' );
		$this->db->where ( 'a.mobile',$params['mobile'] );
		$this->db->where ( 'a.otp',$params['otp'] );
		//$this->db->where ( 'a.status', '1' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}*/
	
	public function login1($params) {
		$otp = array ( "otp" => $params['otp'] );
		$this->db->where ( 'mobile', $params['mobile']);
		$this->db->update ( TABLES::$USER, $otp);
	
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where (mobile,$params['mobile'] );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		//exit;
		$result = $query->result_array ();
	
	
		return ($result);
	}
	
	public function checkUserfb($data = array()){
		$this->db->select('*');
		$this->db->from( TABLES::$USER );
		$this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();
	
		if($prevCheck > 0){
			$prevResult = $prevQuery->row_array();
			$data['last_login'] = date("Y-m-d H:i:s");
			$update = $this->db->update(TABLES::$USER,$data,array('id'=>$prevResult['id']));
			$userID = $prevResult['id'];
		}else{
			$data['created_on'] = date("Y-m-d H:i:s");
			$data['last_login'] = date("Y-m-d H:i:s");
			$insert = $this->db->insert(TABLES::$USER,$data);
			$userID = $this->db->insert_id();
		}
		//$result = $prevQuery->result_array ();
		//return ($result);
		return $userID?$userID:FALSE;
	}
	
	public function checkUsergo($data = array()){
		$this->db->select('*');
		$this->db->from( TABLES::$USER );
		$this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();
	
		if($prevCheck > 0){
			$prevResult = $prevQuery->row_array();
			$data['last_login'] = date("Y-m-d H:i:s");
			$update = $this->db->update(TABLES::$USER,$data,array('id'=>$prevResult['id']));
			$userID = $prevResult['id'];
		}else{
			$data['created_on'] = date("Y-m-d H:i:s");
			$data['last_login'] = date("Y-m-d H:i:s");
			$insert = $this->db->insert(TABLES::$USER,$data);
			$userID = $this->db->insert_id();
		}
		//$result = $prevQuery->result_array ();
		//return ($result);
		return $userID?$userID:FALSE;
	}
	
	public function addAddress($data) {
		$this->db->insert ( TABLES::$USERADDRESS, $data );
		return $this->db->insert_id ();
	}
	
	public function getAddressById($userid) {
		$this->db->select ( 'a.*,b.name as areaname,c.name as city' );
		$this->db->from ( TABLES::$USERADDRESS.' AS a' );
		$this->db->join ( TABLES::$AREA.' AS b','a.areaid=b.id','left' );
		$this->db->join ( TABLES::$CITY.' AS c','c.id=b.cityid','left' );
		$this->db->where ( 'a.userid', $userid );
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
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateUserProfile ($data) {
		$this->db->where ( 'id', $data['id'] );
		$this->db->update ( TABLES::$USER, $data );
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where (id,$data['id']);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return ($result);
	}
	/*public function forgetPassword ($mobile,$client_id){
		
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'mobile',$mobile );
		$this->db->where ( 'client_id',$client_id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if(count($result)>0)
		{
			$data ['otp'] = mt_rand ( 100000, 999999 );
			$this->db->where ( 'id', $result[0]['id'] );
			$this->db->update ( TABLES::$USER, $data );
			$result [0]['otp'] = $data ['otp'];
		}
		return $result;
	}*/
	
	public function forgetPassword ($email){
	
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'email',$email );
		$this->db->or_where ( 'mobile',$email );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	public function getOrderDetailByUserId($id)
	{
		$this->db->select ( 'a.*,b.name' );
		$this->db->from ( TABLES::$ORDER.' AS a' );
		$this->db->join ( TABLES::$RESTAURANT.' AS b','a.restid=b.id','left' );
		$this->db->where ( 'userid',$id );
		$this->db->order_by('a.orderid','DESC');
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
		if(count( $result ) > 0)
		{ 
			$data['message'] = "You have allready Subscribed to our newsletter . ";
		}
		else {
		$this->db->insert ( TABLES::$SUBSCRIBE, $email );
		$data['message'] = "Thank you for subscribing to our newsletter ! ";
		$data['email']=$email['email'];
		}
		return $data;
		
	}
	
	public function updateUserRegistration($data){
		$this->db->set('my_ref_code',$data['my_ref_code']);
		$this->db->where('id',$data['id']);
		$this->db->update(TABLES::$USER,$data);
	}
	public function getReferCode($userid){
		$this->db->select('my_ref_code');
		$this->db->from(TABLES::$USER);
		$this->db->where('id',$userid);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function validateReferralCode($refferalcode){
		$this->db->select('id');
		$this->db->from(TABLES::$USER);
		$this->db->where('my_ref_code',$refferalcode);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function getUserReferralCode($refferalcode){
		$this->db->select('id');
		$this->db->from(TABLES::$USER);
		$this->db->where('my_ref_code',$refferalcode);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	
}