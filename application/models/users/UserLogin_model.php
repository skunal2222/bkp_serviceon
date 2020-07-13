<?php
class UserLogin_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	public function userExist($data)
	{
		$this->db->select ('*');
		$this->db->from ( TABLES::$USER );
		$this->db->where("(email = '" . $data['email'] . "' OR mobile = '" . $data['mobile'] . "') ");
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}

	public function userRegistration($data) {
    	$this->db->insert ( TABLES::$USER, $data );
		return $this->db->insert_id ();  
	}

	public function login($params) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		//$this->db->where ( $params );
		$this->db->where("(email = '" . $params['username'] . "' OR mobile = '" . $params['username'] . "') ");
		$this->db->where ( 'password',$params['password']);
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return ($result);
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

		$this->db->select('id,name,lname,mobile,email,status,my_ref_code');
		$this->db->from(TABLES::$USER);
		$this->db->where(['otp'=>$otp['otp'],'mobile'=>$otp['mobile']]);
		$query = $this->db->get();
	
		$result = $query->row_array();
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

	public function updateUserProfile_full($data) {
		$id= array_shift($data);
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$USER, $data );
		$response['status'] = 1;
		return $response;
	}

	public function validateReferralCode($refferalcode){
		$this->db->select('id');
		$this->db->from(TABLES::$USER);
		$this->db->where('my_ref_code',$refferalcode);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function UpdateOTP($id,$otp){
		$this->db->set('otp',$otp);
		$this->db->where('id',$id);
		$this->db->update(TABLES::$USER,$data);
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


	public function getNotificationByuserId($userid){
		$this->db->select('*');
		$this->db->from(TABLES::$NOTIFICATION);
		$this->db->where('userid',$userid);
		$this->db->order_by('id','DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function getNotificationCount($userid){
		$this->db->select('id');
		$this->db->from(TABLES::$NOTIFICATION);
		$this->db->where('userid',$userid);
		$this->db->where('is_read',0);
		$query = $this->db->get();
		$result = $query->num_rows();
		return $result;
	}

	public function forgetPassword ($email){
	
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'email',$email );
		//$this->db->or_where ( 'mobile',$email );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function updateUserPassword($data) {
		$this->db->where ( 'id', $data ['id'] );
		$this->db->where ('otp', $data ['reset_code'] );
		$this->db->update ( TABLES::$USER, array('password'=>$data ['password'],'original'=>$data ['original']) );
		/*echo $this->db->last_query();
		exit;*/
	}

	public function updateUserProfile ($data) {
		$this->db->where ( 'id', $data['id'] );
		$this->db->update ( TABLES::$USER, array('otp'=>$data['otp']) );
		$response['status'] = 1;
		
		return $response ;
	}
        public function updateUserProfile2 ($data) {
		$this->db->where ( 'id', $data['id'] );
		$this->db->update ( TABLES::$USER, array('gcm_reg_id'=>$data['gcm_reg_id']) );
		$response['status'] = 1;
		return $response ;
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


	/*---------------- old ------------------------------------*/
	
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
	
	
	
	
	public function getUserReferralCode($refferalcode){
		$this->db->select('id');
		$this->db->from(TABLES::$USER);
		$this->db->where('my_ref_code',$refferalcode);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	
}