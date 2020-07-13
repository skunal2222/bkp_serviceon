<?php
class Clientauth {
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function login($umap) {
		$this->CI->load->model ( 'clientusers/user_model', 'clientuser' );
		$user_details = $this->CI->clientuser->getUserDetailByEmail( $umap['email'] );
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
                                        $user['first_login'] = $user_details[0]['first_login']; 
                                        $user['is_client'] = 1;
                                        $user['client_id'] = $user_details[0]['client_id'];
                                        $user['outlet_id'] = $user_details[0]['outlet_id'];
  
					$map ['status'] = 1;
					$map ['msg'] = "Logged in successfully.";
					$map ['result'] = $user;
					return $map;
				} else {
					$map ['status'] = 0;
					$map ['msg'] = "Login to this site have been blocked by Admin.";
					$errors = array ();
					array_push ( $errors, "Unautharised access blocked." );
					$map ['errormsg'] [] = $errors;
					return $map;
				}
			} else {
				$map ['status'] = 0;
				$map ['msg'] = "Username or password is wrong.";
				$errors = array ();
				array_push ( $errors, "Username or password is wrong." );
				$map ['errormsg'] [] = $errors;
				return $map;
			}
		} else {
			$map ['status'] = 0;
			$map ['msg'] = "Username or password is wrong.";
			$errors = array ();
			array_push ( $errors, "Username or password is wrong." );
			$map ['errormsg'] [] = $errors;
			return $map;
		}
		
	}

	public function seesionAccess($param) {
                $this->CI->load->model('clientuser/user_model', 'clientuser');
		return $this->CI->clientuser->getAccessRole($param);
    }

	public function reset_password($data) {
		 
		$this->CI->load->model ( 'clientusers/user_model', 'clientuser' );
        return $this->CI->clientuser->reset_password($data);
    }
	
	public function logout() {
		
	}
	
	/**
	 * Code For Edit Password
	 * @return integer
	 */
	public function editPassword($data)
	{
		$this->CI->load->model (  'clientusers/user_model', 'clientuser'  );
		return $userdetail = $this->CI->clientuser->editPassword($data);
	}
	
	/**
	 * Code For Check Password
	 * @return integer
	 */
	public function  checkPassword($data)
	{
		$response = array();
		$this->CI->load->model (  'clientusers/user_model', 'clientuser'  );
		$result = $this->CI->clientuser->checkPassword($data);
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
	
	public function getClients() {
		$this->CI->load->model (  'clientusers/user_model', 'clientuser'  );
		$result = $this->CI->clientuser->getClients();
		return $result;
	}
	
	public function getClientRestaurants($client_id) {
		$this->CI->load->model (  'clientusers/user_model', 'clientuser'  );
		$result = $this->CI->clientuser->getClientRestaurants($client_id);
		return $result;
	}
	
	public function addClientRestaurant($data) {
		$this->CI->load->model (  'clientusers/user_model', 'clientuser'  );
		$result = $this->CI->clientuser->addClientRestaurant($data);
	}
	
	public function deleteClientRestaurant($client_id) {
		$this->CI->load->model (  'clientusers/user_model', 'clientuser'  );
		$this->CI->clientuser->deleteClientRestaurant($client_id);
	}
	
	public function getClientById($id) {
		$this->CI->load->model (  'clientusers/user_model', 'clientuser'  );
		$result = $this->CI->clientuser->getUserById($id);
		return $result;
	}
	
	public function addClient($client) {
		$this->CI->load->model (  'clientusers/user_model', 'clientuser'  );
		$client['password'] = MD5($client['password']);
		return $this->CI->clientuser->addUser($client);
	} 
	
	public function updateClient($client) {
		$this->CI->load->model (  'clientusers/user_model', 'clientuser'  );
		if(!empty($client['password']))
		$client['password'] = MD5($client['password']);
		return $this->CI->clientuser->updateUser($client);
	}
	
	
}
