<?php
class Adminauth {
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function login($umap) {
		$this->CI->load->model ( 'adminusers/user_model', 'adminuser' );
		$user_details = $this->CI->adminuser->getUserDetailByEmail( $umap['email'] );
		$map = array();
		if (count($user_details) > 0) {
			if (MD5($umap['password']) === $user_details[0]['password']) {
				if ($user_details[0]['status'] == 1) {
					$user = array();
					$user['first_name'] = $user_details[0]['first_name'];
					$user['last_name'] = $user_details[0]['last_name'];
					$user['email'] = $user_details[0]['email'];
					$user['mobile'] = $user_details[0]['mobile'];
					$user['id'] = $user_details[0]['id'];
					$user['user_role'] = $user_details[0]['user_role'];
					$user['garage_id'] = $user_details[0]['garage_id'];
					$user['is_client'] = 0;
					$map ['status'] = 1;

					$map ['msg'] = "Logged in successfully.";
					$map ['result'] = $user;
					return $map;
				} else {
					$map ['status'] = 0;
					$map ['msg'] = "Login to this site have been blocked by Admin.";
					$errors = array ();
					array_push ( $errors, "Unauthorised access blocked." );
					$map ['errormsg'] [] = $errors;
					return $map;
				}
			} else {
				$map ['status'] = 0;
				$map ['msg'] = "Email or password is wrong.";
				$errors = array ();
				array_push ( $errors, "Email or password is wrong." );
				$map ['errormsg'] [] = $errors;
				return $map;
			}
		} else {
			$map ['status'] = 0;
			$map ['msg'] = "Email or password is wrong.";
			$errors = array ();
			array_push ( $errors, "Email or password is wrong." );
			$map ['errormsg'] [] = $errors;
			return $map;
		}
		
	}
	public function reset_password($data) {
	        $this->CI->load->model('adminusers/user_model', 'adminuser');
	        return $this->CI->adminuser->reset_password($data);
	}
	
	public function logout() {
		
	}
	
	/**
	 * Code For Edit Password
	 * @return integer
	 */
	public function editPassword($data)
	{
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		return $userdetail = $this->CI->adminuser->editPassword($data);
	}
	
	/**
	 * Code For Check Password
	 * @return integer
	 */
	public function  checkPassword($data)
	{
		$response = array();
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =  $userdetail = $this->CI->adminuser->checkPassword($data);
		if(count($result) > 0)
		{
			$response['status'] = 1;
			$response['msg'] = "Record Found";
		}
		else
		{
				
			$response['status'] = 0;
			$response['msg'] = "Old Password Not correct";
		}
		return $response;
	}
	public function getUserList()
	{
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =$this->CI->adminuser->getUsers();
		return $result;
	}
	public function turnonof($data)
	{
		unset($data['comment']);
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =$this->CI->adminuser->updateUser($data);
		return $result;
	}
	public function assignRole($data)
	{
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =$this->CI->adminuser->updateUser($data);
		return $result;
	}
	public function getAdminUsers() {
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		return $this->CI->adminuser->getActiveUsers();
	}
	
	public function addAdminUser($data)
	{
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =$this->CI->adminuser->addUser($data);
		return $result;
	}
	
	public function updateadminUser($data)
	{
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =$this->CI->adminuser->updateadminUser($data);
		return $result;
	}
	
	public function getMenuAssignbyUserRole($roleid)
	{
		$this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		$result =$this->CI->adminuser->getMenuAssignbyUserRole($roleid);
		$map = array();
		if (count($result) > 0) {
			//$user = array();
			//$user['menuname'] = $result[0]['menuname'];
			//$user['access_type'] = $result[0]['access_type'];
			$map ['status'] = 1;
			$map ['msg'] = "Logged in successfully.";
			$map ['access'] = $result;
			return $map;
		}else{
			$map ['status'] = 0;
			$map ['msg'] = "role id is blank";
			return $map;
		}
		//return $result;
	}

	 public function seesionAccess($param) {

	 	/*echo "<pre>";
	 	print_r($param);
	 	exit();*/

        $this->CI->load->model (  'adminusers/user_model', 'adminuser'  );
		return $this->CI->adminuser->getAccessRole($param);
        }
	
	public function sendAdminUserSMS($details) {
		$sms_msg = "Hi ".$details ['first_name'].", To access your admin panel use these creditials username ".$details ['email'].". password ".$details ['text_password'].". ";
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function sendAdminUserEmail($user) {
		//echo "inside email";
		//print_r($user);
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'BikeDoctor';
		$this->CI->pkemail->subject = 'Welcome to BikeDoctor';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'otp-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'backend/emails/adminuser-email', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function AccessType($data) {  
		$this->CI->load->model ( 'adminusers/user_model', 'adminuser' );
		return $this->CI->adminuser->AccessType($data);
 	}


}
