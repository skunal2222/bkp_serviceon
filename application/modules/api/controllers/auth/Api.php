<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Auth API
 * @author Pradeep Singh
 * @package Auth
 *
 */
class Api extends REST_Controller {
	
	/**
	 * Fuction For user Login
	 * @return json
	 */
	
	/////////////// code by kunal as per serivceon ///////////////////

	public function digidocs_list_post()
	{
		$userid = $this->post('user_id');
		if (empty($userid)) {
			$response['status'] = "false";
			$response['msg'] = "user ID missing";
		}
		else
		{
			$this->db->select('*');
			$this->db->where('user_id',$userid);
			$q = $this->db->get('tbl_digidocs');
			$result = $q->result_array();

			if (!empty($result)) {
				$response['status'] = "true";
				$response['msg'] = "Data found";
				$response['data'] = $result;
			}
			else
			{
				$response['status'] = "false";
				$response['msg'] = "Data not found";
			}
		}
		$this->response($response,200);
	}

	public function delete_digidocs_post()
	{
		$fileid = $this->post('file_id');
		if (empty($fileid)) {
			$response['status'] = "false";
			$response['msg'] = "File ID missing.";
		}
		else
		{
			$dgoldfile = $this->db->select('file_path')->where('id',$fileid)->get('tbl_digidocs')->row_array();
			$file_path = $dgoldfile['file_path'];
			if(file_exists('./assets/'.$file_path))
			{
			    unlink('./assets/'.$file_path);
			}
			$this->db->where('id',$fileid)->delete('tbl_digidocs');
			$response['status'] = "true";
			$response['msg'] = "File deleted successfully.";
		}
		$this->response($response,200);
	}

	public function update_digidocs_post()
	{
		$fileid = $this->post('file_id');
		if (empty($fileid)) {
			$response['status'] = "false";
			$response['msg'] = "File ID missing.";
		}
		else
		{
			$filename = $this->post('fileName');
			if(!empty($_FILES['file']['name'])) {

	            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
	            $rand = rand(1000,9999);

	            $dgoldfile = $this->db->select('file_path')->where('id',$fileid)->get('tbl_digidocs')->row_array();

				$file_path = $dgoldfile['file_path'];

				$config['upload_path']          = './assets/digi_docs/';
		        $config['allowed_types']        = 'pdf|jpeg|jpg|png';
		        $config['max_size']             = 5 * 1024 * 1024;
		        $config['file_name']            = date('YmdHis').$rand.".".$ext;

		        $this->load->library('upload', $config);
				$this->upload->initialize($config);

				if(!$this->upload->do_upload('file'))
		        {
		            $error = $this->upload->display_errors();
		            $response['status'] = "false";
		            $response['msg'] = "Error: ". json_encode($error);
		            $this->response($response,200);
		            exit;
		        } else {
		        	$data['file_path'] = "digi_docs/".$config['file_name'];

		        	if(file_exists('./assets/'.$file_path))
					{
					    unlink('./assets/'.$file_path);
					}
		        }
			}

			$data['vehicle_id'] = isset($_POST['vehicle_id'])?$_POST['vehicle_id']:"";
			$data['file_name'] = $filename;
			$data['updated_date'] = date('Y-m-d H:i:s');

			$this->db->where('id',$fileid)->update('tbl_digidocs',$data);

			$response['status'] = "true";
			$response['msg'] = "Document updated successfully.";
		}
		$this->response($response,200);
	}

	public function save_digidocs_post()
	{
		// print_r($_FILES); die();
		$user_id = $this->post('user_id');
		if (empty($user_id)) {
			$response['status'] = "false";
			$response['msg'] = "user ID missing.";
		}
		else
		{
			$filename = $this->post('fileName');
			$cn = count($_FILES['files']['name']);

			for ($i=0; $i < $cn; $i++) {

				$_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
	            $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
	            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
	            $_FILES['file']['error']    = $_FILES['files']['error'][$i]; 
	            $_FILES['file']['size']     = $_FILES['files']['size'][$i];

	            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$rand = rand(1000,9999);

	            // echo $ext; die();

				$config['upload_path']          = './assets/digi_docs/';
		        $config['allowed_types']        = 'pdf|jpeg|jpg|png';
		        // $config['max_size']             = 5 * 1024 * 1024;
		        $config['file_name']            = date('YmdHis').$rand.".".$ext;

		        $this->load->library('upload', $config);
				$this->upload->initialize($config);

		        if ( ! $this->upload->do_upload('file'))
		        {
		            $error = $this->upload->display_errors();
		            $response['status'] = "false";
		            $response['msg'] = "Filename :".$filename[$i].", Error: ". json_encode($error);
		            // $response['filedata'] = print_r($_FILES);
		            $this->response($response,200);
		            exit;
		        }
		        else
		        {
					$data['user_id'] = $user_id;
					$data['vehicle_id'] = isset($_POST['vehicle_id'])?$_POST['vehicle_id']:"";
					$data['file_name'] = $filename[$i];
					$data['file_path'] = "digi_docs/".$config['file_name'];
					$data['created_date'] = date('Y-m-d H:i:s');

					$this->db->insert('tbl_digidocs',$data);
		        }
			}

			$response['status'] = "true";
			$response['msg'] = "Document uploaded successfully.";
		}
		$this->response($response,200);
	}

	public function sendotpmobileupdate_post() {
		$login = array ();
		$login ['username'] = $this->post ( 'mobile' );
		$is_resend = $this->post ( 'is_resend' );

		if(empty($login['username']))
		{
			$response["status"] = "false";
			$response["msg"] = "Please enter mobile number";
		}
		else
		{
			$this->load->library ( 'api/UserLoginLib' );
			$data = array();
			$exist = $this->userloginlib->userLoginExist ( $login );

			if(!empty($exist))
			{
				$response['status'] = "true";
				$response['msg'] = "Mobile number already exist";
			}
			else
			{
				$data['otp'] = rand(100000,999999);
				$data['mobile'] = $login['username'];
				$this->userloginlib->sendOTPSMS($data);
				$response["status"] = "true";
				$response["msg"] = "OTP sent successfully.";
				if ($is_resend == 1) {
					$response["msg"] = "OTP resent on your mobile.";
				}
				$response["data"] = $data;
			}
		}
		$this->response ($response,200);
	}

	public function verifyotpmobileupdate_post() {
		$update = array ();
		$update ['id'] = $this->post ( 'id' );
		$update ['mobile'] = $this->post ( 'mobile' );
		$update ['otp'] = $this->post ( 'otp' );
		
		//print_r($update);exit ; 
		$contact_details = array();
		if(empty($update ['mobile']))
		{
			$response["status"] = "false";
			$response["msg"] = "Please enter mobile number";
		}
		else
		{
			$this->load->library ( 'api/UserLib' );
			$user = $this->userlib->updateUser1( $update );
			$response["status"] = "true";
			$response["msg"] = "Mobile number updated successfully.";
		}
		$this->response ($response,200);
	}

	public function sendLoginotp_post() {
		$login = array ();
		$login ['username'] = $this->input->post ( 'username' );
		$is_resend = $this->input->post ( 'is_resend' );

		if (empty($login['username'])) {
			$response["status"] = "false";
			$response["msg"] = "Please enter mobile number";
		} else {
			$this->load->library ( 'api/UserLoginLib' );
			$result = array();
			$exist = $this->userloginlib->userLoginExist ( $login );
			// $exist ['otp'] = rand(100000,999999);
			 $exist ['otp'] = 123456; // temprory
			
			$result ['status'] = isset($exist['status'])?$exist['status']:'';
			$result ['id'] = isset($exist['id'])?$exist['id']:'';
			$result ['mobile'] = isset($exist['mobile'])?$exist['mobile']:$login ['username'];
			$result ['otp'] = $exist['otp'];
			$result ['username'] = $login ['username'];
			$this->userloginlib->sendOTPSMS($result);

			$response["status"] = "true";
			$response["msg"] = "OTP sent successfully.";
			if ($is_resend == 1) {
				$response["msg"] = "OTP resent on your mobile.";
			}
			$response["data"] = $result;
		}
		$this->response ($response,200);
	}

	public function loginwithotp_post() {
		$login = array ();
		$login ['id'] = $this->post ( 'id' );
		$login ['mobile'] = $this->post ( 'username' );
		$login ['otp'] = $this->post ( 'otp' );
		
		//print_r($login);exit ; 
		$contact_details = array();
		if (empty($login ['mobile']))
		{
			$response["status"] = "false";
			$response["msg"] = "Please enter mobile number";
		}
		else
		{
			$this->load->library ( 'api/UserLoginLib' );
			$user = $this->userloginlib->loginwithOTP ( $login );
			// print_r($user);exit ; 

			if($user['status'] == 1) {
				/*$data = new stdClass();
				$data->ContactId = $user['id'];
				$data->FirstName = $user['name'];
				$data->LastName = $user['lname'];
				$data->Email = $user['email'];
				$data->MobileNumber = $user['mobile'];
				$data->DOB = $user['dob'];
				$data->Gender = $user['gender'];
				$data->My_Ref_Code = $user['my_ref_code'];*/
				// $data->Address = $user[0]['address'];
				// $data->Landmark = $user[0]['landmark'];
				// $data->AddressType = $user[0]['address_type'];
				// $data->areaid = $user[0]['areaid'];
				if(empty($user['my_ref_code'])){
					$dataref['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($user['id'], 10, 36));
					$dataref['id'] = $user['id'];
					$this->userloginlib->updateUserRegistration($dataref);
					
					// $data->My_Ref_Code = $dataref['my_ref_code'];

					$trans['userid'] = $user['id'];
		            $trans['amount'] = 0;
		            $trans['created_date'] = date('Y-m-d H:i:s');
			        $trans['updated_date'] = date('Y-m-d H:i:s');
		            $this->db->insert ( TABLES::$WALLET, $trans);
				}
				// array_push($contact_details,$data);
				$response["status"] = "true";
				$response["msg"] = "Login successful";
				$response["data"] = $user;
			} else {
				$response["status"] = "false";
				$response["msg"] = "Invalid Mobile or OTP";
				$response["data"] = [];
			}
		}
		$this->response ($response,200);
	}

	public function socialLogin_post() {
		$this->load->helper('string');
        $password = random_string('alnum',5);

		$reg = array ();
		$fullname = trim($this->post ( 'fullname' ));
		$fullname = explode(' ', $fullname);
		$reg ['name'] = (!empty($fullname[0]))?$fullname[0]:"";
		$reg ['lname'] = (!empty($fullname[1]))?$fullname[1]:"";
		$reg ['original'] = $password;
		$reg ['password'] = md5($password);
		$reg ['email'] = $this->post ( 'email' );
		$reg ['oauth_provider'] = $this->post ( 'oauth_provider' );
		$reg ['oauth_uid'] = $this->post ( 'oauth_uid' );
		$reg ['gcm_reg_id'] = $this->post ( 'gcm_reg_id' );
		$reg ['source'] = $this->post ( 'source' );
		$reg ['otherss'] = '';
		$reg ['created_on'] = '';
		$reg ['otp'] = mt_rand ( 100000, 999999 );
		$reg ['status'] = 1;
		$success_response = array();
		$contact_details = array();
		if(!empty($reg ['name']) && !empty($reg ['email'])) {
			$this->load->library ( 'api/UserLoginLib' );
			$data ['username'] = $email = $reg['email'];
			$exist = $this->userloginlib->userLoginExist ( $data );
			if (empty($exist)) {
				$this->db->insert('tbl_users', $reg);
            	$user_id = $this->db->insert_id();
				if (!empty($user_id)) {
					$update['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($user_id, 10, 36));
		            $this->db->where('id', $user_id);
		            $this->db->update('tbl_users', $update);
					$user = $this->db->query("SELECT * FROM tbl_users WHERE email = '$email'")->result_array();
					/*$data1 = new stdClass();
					$data1->ContactId = $user_id;
					$data1->FirstName = $reg['name'];
					$data1->LastName = $reg['lname'];
					$data1->Email = $reg['email'];
					$data1->MobileNumber = $user[0]['mobile'];
					$data1->DOB = $user[0]['dob'];
					$data1->Gender = $user[0]['gender'];
					$data1->My_Ref_Code = $user[0]['my_ref_code'];*/
					/*$data1->Address = $user[0]['address'];
					$data1->Landmark = $user[0]['landmark'];
					$data1->AddressType = $user[0]['address_type'];*/
					// array_push($contact_details,$data1);
		            $trans['userid'] = $user_id;
		            $trans['amount'] = 0;
		            $trans['created_date'] = date('Y-m-d H:i:s');
			        $trans['updated_date'] = date('Y-m-d H:i:s');
		            $this->db->insert ( TABLES::$WALLET, $trans);
					$success_response["status"] = "true";
					$success_response["msg"] = "Thank you for your registration";
					// $success_response["data"] = $contact_details;
					$success_response["data"] = $user;
				} else {
					$success_response["status"] = "false";
					$success_response["msg"] = "Failed to register.";
					$success_response["data"] = $contact_details;
				}
			} else {
				$user = $this->db->query("SELECT * FROM tbl_users WHERE email = '$email'")->result_array();
				/*$data1 = new stdClass();
				$data1->ContactId = $user[0]['id'];
				$data1->FirstName = $user[0]['name'];
				$data1->FirstName = $user[0]['lname'];
				$data1->Email =  $user[0]['email'];
				$data1->MobileNumber = $user[0]['mobile'];
				$data1->DOB = $user[0]['dob'];
				$data1->Gender = $user[0]['gender'];
				$data1->My_Ref_Code = $user[0]['my_ref_code'];*/
				// $data1->Address = $user[0]['address'];
				// $data1->Landmark = $user[0]['landmark'];
				// $data1->AddressType = $user[0]['address_type'];
				// array_push($contact_details,$data1);
				$success_response["status"] = "true";
				$success_response["msg"] = "Login Successful";
				$success_response["data"] = $user;
			}
		} else {
			$success_response["status"] = "false";
			$success_response["message"] = "Name or email is blank";
			$success_response["data"] = $contact_details;
		}
		$this->response ($success_response,200);
	}

	public function addFirebaseToken_post()
	{
		$tokenData = array ();
		$tokenData['id'] = $this->input->post ( 'user_id' );
		$tokenData['gcm_reg_id'] = $this->input->post ( 'token' );

		if (empty($tokenData['id'])) {
			$response["status"] = "false";
			$response["msg"] = "Details not found, userID is missing.";
		} else {

			// print_r($tokenData); die();
			$this->db->set($tokenData);
			$this->db->where('id', $tokenData['id']);
			$this->db->update('tbl_users');

			$response["status"] = "true";
			$response["msg"] = "Token save successfully.";
		}
		$this->response ($response,200);
	}

	public function garage_search_post()
	{
		$map = array();

		$map['latitude'] = $this->input->post('latitude');
		$map['longitude'] = $this->input->post('longitude');
		$map['serviceType'] = $this->input->post('serviceType');
		$map['limit'] = 6;
		$map['start'] = $this->input->post('start') * 6;
		
		if(!empty($this->input->post('rating')))
		{
			$map['star'] = $this->input->post('rating');
		}

		if(!empty($this->input->post('brand')))
		{
			$map['brand'] = explode(',', $this->input->post('brand'));
		}

		if(!empty($this->input->post('model')))
		{
			$map['model'] = explode(',', $this->input->post('model'));
		}

		if(!empty($this->input->post('searchKey'))) {
			$map['searchKey'] = $this->input->post('searchKey');
		}

		//print_r($map); die();

		if (empty($map['latitude']) && empty($map['longitude']))  
		{
			$response["status"] = "false";
			$response["msg"] = "Please select correct location.";
		}
		else
		{
			$response["distanceLimit"] = 10;
			$this->load->library('api/RestaurantLib');
			$vendors['data'] = $this->restaurantlib->getSearchedVendor($map);
			$no = 0;
			if(empty($vendors['data']))
			{
				$response['status'] = "true";
				$response['msg'] = "No garage found.";
				$response['data'] = [];
			}
			else
			{
				/*$response['latitude'] = $map['latitude'];
				$resp['longitude'] = $map['longitude'];*/

				foreach ($vendors['data'] as $vendor) {
					$mod = $this->restaurantlib->getServicePriceAVG($vendor['id']);
					$vendors['data'][$no]['moderate'] = $mod['avgModerate'];
					$no++;
				}

				$response['status'] = "true";
				$response['msg'] = "Garage found.";
				$response['data'] = $vendors['data'];
			}
		}
		$this->response($response,200);
	}

	public function garage_details_post()
	{
		$map['latitude'] = $this->post('latitude');
    	$map['longitude'] = $this->post('longitude');
		$map['vendor_id'] = $this->post('garage_id');
		$distance = $this->post('distance');
		$st = $this->post('serviceType');
		if (empty($map['vendor_id']))
		{
			$response['status'] = "false";
			$response['msg'] = "Please select garage";
		}
		else
		{
			$this->load->library('api/RestaurantLib');
			$this->load->library('api/ServiceLib');
			$garage_detail = $this->restaurantlib->garageDetailsByVendorID($map);
			$servicegroup = $this->servicelib->getActiveServiceGroupsName();
			$mod = $this->restaurantlib->getServicePriceAVG($map['vendor_id']);
			$garage_detail['moderate'] = $mod['avgModerate'];

	    	$data['distance'] = $distance;
	    	$data['st'] = $st;	    	
	    	$result = $this->servicelib->getServiceTypeCharges($data);
	    	$garage_detail['charges'] = $result['price'];

			if(empty($garage_detail))
			{
				$response['status'] = "true";
			 	$response['msg'] = "Garage details not found. Something went wrong.";				
			 	$response['data'] = [];
			 	$response['service_group'] = [];
			}
			else
			{

				$response['status'] = "true";
				$response['msg'] = "garage details found.";
				$response['data'] = $garage_detail;
				$response['service_group'] = $servicegroup;
			}
		}	
		$this->response($response,200);
	}

	public function addUseraddress_post() {
			
		if (empty($this->post('userid'))) {
			$response["status"] = "false";
			$response["msg"] = "User ID is missing.";
		}
		else
		{

			$this->load->library ( 'api/UserLib' );
			$address = array();
			 
			$address['userid'] = $this->post('userid');
			$address['address_name'] = $this->post('address_name');
			$address['address'] = $this->post('address');
			$address['locality'] = $this->post('locality');
			$address['latitude'] = $this->post('latitude');
			$address['longitude'] = $this->post('longitude');
			$address['landmark'] = $this->post('landmark');
			$address['country'] = 101;
			$address['state'] = $this->post('state');
			$address['city'] = $this->post('city');
			$address['pincode'] = $this->post('pincode');
			
			$result = $this->userlib->addAddress($address);
		    
			if($result != 0)
			{
				$response["status"] = "true";
				$response["msg"] = "Address added successfully.";
				$response["data"] = $result;
			}
			else{
				$response["status"] = "false";
				$response["msg"] = "Address Not added.";
			}
		}	
		$this->response($response,200);
	}

	public function updateUseraddress_post() {
		if (empty($this->post('addressid'))) {
			$response["status"] = "false";
			$response["msg"] = "Address ID is missing.";
		}
		else
		{
			$address = array();
		
			$address['id'] = $this->post('addressid');
			$address['address_name'] = $this->post('address_name');
			$address['address'] = $this->post('address');
			$address['locality'] = $this->post('locality');
			$address['latitude'] = $this->post('latitude');
			$address['longitude'] = $this->post('longitude');
			$address['landmark'] = $this->post('landmark');
			$address['country'] = 101;
			$address['state'] = $this->post('state');
			$address['city'] = $this->post('city');
			$address['pincode'] = $this->post('pincode');
				
			$this->load->library ( 'api/UserLib' );
			$result = $this->userlib->updateAddress($address);
			if($result != 0)
			{
				$response["status"] = "true";
				$response["msg"] = "Address updated successfully";
			}
			else{
				$response["status"] = "false";
				$response["msg"] = "Address not updated.";
			}		
		}
		$this->response($response,200);
	}

	public function deleteaddress_post(){
		$id = $this->post('addressid');
		if(!empty($id)) {
			$this->load->library ( 'api/UserLib' );
			$this->userlib->deleteaddress($id);
			$data['status']="true";
			$data['msg']="Address Deleted Successfully";
		}else{
			$data['status']="false";
			$data['msg']="Address ID is missing.";			
		}
		$this->response($data,200);
	}

	public function getAddressByUserId_post()
	{
		$user_id = $this->post('userid');
		if (empty($user_id)) {
			$response['status'] = "false";
			$response['msg'] = "User ID is missing.";
		}
		else
		{
			$data['userid'] = $user_id;
	    	$this->load->library ( 'api/UserLib' );
	    	$result = $this->userlib->getAddressByIDs($data);
	    	if (empty($result)) {
	    		$response['status'] = "true";
	    		$response['msg'] = "Data not found.";
	    		$response['data'] = [];
	    	}
	    	else
	    	{
	    		$response['status'] = "true";
	    		$response['msg'] = "Data found.";
	    		$response['data'] = $result;
	    	}
		}
		$this->response($response,200);
	}

	public function set_isPrimary_address_post()
    {
    	$user_id = $this->input->post('userid');
    	$addressid = $this->input->post('addressid');
    	$response = [];

    	if (empty($addressid) || empty($user_id)) {
    		$response['status'] = "false";
    		$response['msg'] = "Address id or User id is missing.";
    	}
    	else
    	{
    		$this->db->set('is_primary',0);
    		$this->db->where('userid',$user_id);
    		$this->db->update('user_address');

    		$this->db->set('is_primary',1);
    		$this->db->where('id',$addressid);
    		$this->db->update('user_address');

    		$data['addressid'] = $addressid;

    		$response['status'] = "true";
    		$response['msg'] = "pickup address set successfully.";
    	}
    	$this->response($response,200);
    }

    public function get_state_city_list_get()
    {
    	$this->load->library ( 'api/UserLib', 'userlib' );
    	$countryid = 101;
    	$result = $this->userlib->get_statelist($countryid);
    	if (empty($result)) {
    		$response['status'] = "true";
    		$response['msg'] = "State list is not found.";
    		$response['data'] = [];	
    	}
    	else
    	{
    		$arr = [];
    		$i = 0;
    		foreach ($result as $state) {
    			$stateid = $state['id'];
				$cities = $this->userlib->get_citylist($stateid);
				$arr[$i]['stateid'] = $stateid; 	
				$arr[$i]['state_name'] = $state['name']; 	
				$arr[$i]['cities'] = $cities; 	
    			++$i;
    		}
	    	$response['status'] = "true";
	    	$response['msg'] = "State city list is found.";
	    	$response['data'] = $arr;
    	}
    	$this->response($response,200);
    }

    /*public function get_citylist_get()
    {
    	$stateid = $this->get('stateid');
    	if(empty($stateid)) {
    		$response['status'] = "false";
    		$response['msg'] = "State ID is missing.";	
    	}
    	else
    	{
	    	$this->load->library ( 'api/UserLib', 'userlib' );
	    	$result = $this->userlib->get_citylist($stateid);
	    	if (empty($result)) {
	    		$response['status'] = "true";
	    		$response['msg'] = "City list is not found.";	
	    		$response['data'] = [];
	    	}
	    	else
	    	{
		    	$response['status'] = "true";
		    	$response['msg'] = "City list is found.";
		    	$response['data'] = $result;
	    	}
    	}
    	$this->response($response,200);
    }*/

    public function getPickupslot_get()
    {
       	$this->load->library('zyk/SlotLib','slotlib');
		$result = $this->slotlib->getActiveVisiting1();
    	if (empty($result)) {
    		$response['status'] = "true";
    		$response['msg'] = "Pickup slot is not found.";	
    		$response['data'] = [];
    	}
    	else
    	{
	    	$response['status'] = "true";
	    	$response['msg'] = "Pickup slot is found.";
	    	$response['data'] = $result;
    	}
    	$this->response($response,200);
    }

    public function profile_update_post()
	{
		$userid = $this->post('userid');

		if (empty($userid)) {
			$response['status'] = "false";
			$response['msg'] = "User ID is missing.";
		}
		else
		{	
			$data['id'] = $userid;
			$data['name'] = $this->post('fname');
			$data['lname'] = $this->post('lname');
			$data['email'] = $this->post('email');
			$data['dob'] = $this->post('dob');
			$data['gender'] = $this->post('gender');

			$this->load->library('api/UserLib', 'userlib');
			$result = $this->userlib->updateUserProfile($data);
			$response['status'] = "true";
			$response['msg'] = "Profile updated successfully.";
			$response['data'] = $result;
		}
		$this->response($response,200);
	}

	public function getWalletPoints_get()
	{
		$userid = $this->get('user_id');

		if (empty($userid)) {
			$response['status'] = "false";
			$response['msg'] = "User ID is missing.";
		}
		else
		{
			$this->load->library('api/UserLib', 'userlib');
			$result['balance'] = $this->userlib->getWalletBalance($userid);
			$result['transaction'] = $this->userlib->getWalletTransactions($userid);
			if(empty($result['balance'])){
				$result['balance'][0]['amount'] = 0;
			}
			if(empty($result['transaction'])){
				$result['transaction'] = '';
			}
			$response['status'] = "true";
			$response['msg'] = "Wallet details found.";
			$response['data'] = $result;
		}
		$this->response($response,200);
	}

	/////////////// code by kunal ///////////////////

	public function resendotp_post() {
		$data=array();
		$data['mobile']=$this->post('username');
		$this->load->library ( 'zyk/UserLib' );
		$result = $this->userlib->resendOTP ( $data );
		$data_res = array();
		if($result['status'] == 1) {
			$data_res['name'] = $result[0]['name'];
			$data_res['email'] = $result[0]['email'];
			$data_res['mobile'] = $result[0]['mobile'];
			$data_res['address'] = $result[0]['address'];
			$data_res['landmark'] = $result[0]['landmark'];
			$data_res['address_type'] = $result[0]['address_type'];
			$success_response["success"] = "true";
			$success_response["msg"] = "Verification code has been resent to your mobile number";
			$success_response["userid"] = $result['id'];
			$success_response["otp"] = $result['otp'];
			$success_response["data"] = $data_res;
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please enter valid mobile number";
		}
		$this->response ($success_response,200);
		//echo json_encode($success_response);
	}

	public function login_post() {
		$login = array ();
		$login ['username'] = $this->post ( 'mobile' );
		$login ['password'] = $this->post ( 'password' );
		$contact_details = array();
		if (empty($login ['username']) || empty($login ['password']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please enter mobile number and password";
		}
		else
		{
		   $this->load->library ( 'zyk/UserLoginLib' );
			$user = $this->userloginlib->login ( $login );
			 // print_r($user);
			if(isset($user[0]['status']) && $user[0]['status'] == 1) {
				$data = new stdClass();
				$data->ContactId = $user[0]['id'];
				$data->FirstName = $user[0]['name'];
				$data->Email = $user[0]['email'];
				$data->MobileNumber = $user[0]['mobile'];
				$data->Address = $user[0]['address'];
				$data->Landmark = $user[0]['landmark'];
				$data->AddressType = $user[0]['address_type'];
				//$data->areaid = $user[0]['areaid'];
				array_push($contact_details,$data);
				$response["status"] = "true";
				$response["message"] = "Login successful";
				$response["data"] = $contact_details;
				
				if(empty($user[0]['my_ref_code'])){
					$dataref['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($user[0]['id'], 10, 36));
					$dataref['id'] = $user[0]['id'];
					$this->userloginlib->updateUserRegistration($dataref);
				}
				
				if (!empty($this->post('gcm_reg_id'))){
					$gcm = array();
					$gcm['id'] = $user[0]['id'];
					$gcm['gcm_reg_id'] = $this->post('gcm_reg_id');
					$this->load->library ( 'zyk/UserLib' );
					$this->userloginlib->updateUserProfile2($gcm);
				}
				
			} else {
				$response["status"] = "false";
				$response["message"] = "Invalid username or password";
				$response["data"] = $contact_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function signup_post() {
		$this->load->library ( 'zyk/UserLoginLib' );
		$success_response = array();
		$reg = array ();
		//$reg ['name'] = trim$this->post ( 'fullname' );
		$reg ['name'] = $this->post ( 'fname' ).' '.$this->post ( 'lname' );
		$reg ['password'] = $this->post ( 'password' );
		$reg ['email'] = $this->post ( 'email' );
		$reg ['mobile'] = $this->post ( 'mobile' );
		
		$reg ['original'] = $this->post ( 'password' );
		$reg ['source'] = 'Friends';
		
		$reg ['otherss'] = '';
		//$reg ['otp'] = mt_rand (100000, 999999);
		
		$reg ['otp'] = '123456';
		
		$reg ['status'] = 1;
		//$this->load->library('zyk/General');
		
		//$this->load->library ( 'zyk/UserLoginLib' );
		if(!empty($this->post ( 'referal_code' ))){
			$reg ['coupon_code'] = $this->post('referal_code');
			$referral = $this->userloginlib->validateReferralCode($reg ['coupon_code']);
			if(count($referral) > 0){
				$reg ['coupon_code'] = $reg ['coupon_code'];
			}else{
				$success_response['status'] = "false";
				//$success_response['refstatus'] = 0;
				$success_response['message'] = 'Invalid refferal code';
				$this->response ($success_response,200);
				exit;
			}
		}else{
			$reg ['coupon_code'] = '';
		}
	
		$contact_details = array();
		if(!empty($reg ['name']) && !empty($reg ['mobile']) && !empty($reg ['email'])) {
			$exist = $this->userloginlib->userAppExist ( $reg );
			if ($exist['exist'] == 0) {
				$register = $this->userloginlib->userRegistration ( $reg );
				
				if ($register ['status'] == 1) {
					
					$data = array();
					$data ['name'] = $reg ['name'];
					$data ['otp'] = $reg['otp'];
					$data ['email'] = $reg ['email'];
					
					//$contact_details = array();
					$data1 = new stdClass();
					$data1->ContactId = $register['id'];
					$data1->FirstName = $reg['name'];
					$data1->Email = $reg['email'];
					$data1->MobileNumber = $reg['mobile'];
					//$data1->areaid = $reg['areaid'];
					//$data->Address = $register['address'];
				    array_push($contact_details,$data1);
					//$this->userlib->sendOTPSMS($data);
					//$this->userlib->sendOTPEmail($data);
					$success_response["status"] = "true";
					$success_response["message"] = "Thank you for your registration";
					$success_response["data"] = $contact_details;
					
					$refdata['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($register['id'], 10, 36));
					$refdata['id'] = $register['id'];
					$this->userloginlib->updateUserRegistration($data);
				} else {
					$success_response["status"] = "false";
					$success_response["message"] = "Failed to register.";
					$success_response["data"] = $contact_details;
				}
			} else {
				$success_response["status"] = "false";
				//$success_response["message"] = "You are already registered with us.";
				$success_response["message"] = "The Email & mobile is already registered";
				$success_response["data"] = $contact_details;
			}
		} else {
			$success_response["status"] = "false";
			$success_response["message"] = "Name, email or phone is blank";
			$success_response["data"] = $contact_details;
		}
		
		//print_r($success_response);exit ; 
		$this->response ($success_response,200);
		//echo json_encode($success_response);
	}
	
	public function signupfacebookold_post() {
		$reg = array ();
		$reg ['name'] = trim($this->post ( 'fullname' ));
		$reg ['password'] = "";
		$reg ['email'] = $this->post ( 'email' );
		$reg ['mobile'] = $this->post ( 'mobile' );
		//$reg ['address'] = $this->input->post ( 'address' );
		//$reg ['areaid'] = '';
		$reg ['original'] = "";
		$reg ['source'] = 'Friends';
		$reg ['coupon_code'] = $this->post('referral_code');
		$reg ['otherss'] = '';
		$reg ['otp'] = mt_rand ( 100000, 999999 );
		$reg ['status'] = 1;
		$this->load->library('zyk/General');
		//$areas = $this->general->getAreasById($reg ['areaid']);
		//$reg ['area'] = $areas[0]['name'];
		$success_response = array();
		if(!empty($reg ['name']) && !empty($reg ['mobile']) && !empty($reg ['email'])) {
			$this->load->library ( 'zyk/UserLib' );
			$exist = $this->userlib->userExist ( $reg );
			if ($exist['status'] == 0) {
				$register = $this->userlib->userRegistration ( $reg );
				$this->load->library('zyk/OldTml');
				$tmlpram = array();
				$tmlpram['fullname'] = $reg ['name'];
				$tmlpram['mobile'] = $reg ['mobile'];
				$tmlpram['email'] = $reg ['email'];
				$tmlpram['referral_code'] = $reg ['coupon_code'];
				$this->oldtml->fbSignupToVtiger($tmlpram);
				if ($register ['status'] == 1) {
					$address = array();
					$address['userid'] = $register['id'];
					$address['address_name'] = 'Home';
					//$address['address'] = $reg['address'];
					//$address['locality'] = $reg['area'];
					//$address['areaid'] = $reg['areaid'];
					$this->userlib->addAddress($address);
					$data = array();
					$data ['name'] = $reg ['name'];
					$data ['otp'] = $reg['otp'];
					$data ['mobile'] = $reg ['mobile'];
					$this->userlib->sendOTPSMS($data);
					$success_response["success"] = "true";
					$success_response["msg"] = "Thank you for your registration";
				} else {
					$success_response["success"] = "false";
					$success_response["msg"] = "Failed to register.";
				}
			} else {
				$success_response["success"] = "true";
				$success_response["msg"] = "You are already registered with us. Please verify using otp.";
			}
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Name, email or phone is blank";
		}
		echo json_encode($success_response);
	}
	
	public function verifyotp_post() {
		//$email = $this->post ( 'username' );
		//$otp = $this->post ( 'otp' );
		$reg = array ();
		$reg ['id'] = $this->post ( 'id' );
		$reg ['otp'] = $this->post ( 'otp' );
		
		$login = array ();
		//$login['gcm_reg_id'] = $this->post ( 'gcm_code' );
		$login ['status'] = 1;
		if(!empty($reg ['id']) && !empty($reg ['otp'])) {
			$this->load->library ( 'zyk/UserLoginLib' );
			$user = $this->userloginlib->otpMatch($reg);
			//if(count($user) > 0) {
				//if($otp == $user[0]['otp']) {
				if($user[0]['status'] == 1) {
					$login['id'] = $user[0]['id'];
					$this->userloginlib->updateUserProfile($login);
					//$this->userlib->sendSignUpEmail ( $user [0] );
					//$this->userlib->sendSignUpSMS ( $user [0] );
					$success_response["success"] = "true";
					$success_response["msg"] = "Thanks for registering with us";
				} else {
					$success_response["success"] = "false";
					$success_response["msg"] = "Incorrect Code.Please enter the correct OTP.";
				}
			/*} else {
				$success_response["success"] = "false";
				$success_response["error"] = "Please register before proceeding.";
			}*/
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please enter the verification code sent to your mobile number OR email address to proceed.";
		}
		//$this->response ($success_response,200);
		echo json_encode($success_response);
	}
	
	public function facebooklogin_post() {
		$username = $this->post('username');
		$gcmcode = $this->post('gcm_code');
		if (empty($username))
		{
			$resp["success"] = "false";
			$resp["msg"] = "Authentication failed";
		}
		else
		{
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->getUserByEmail ( $username );
			if(count($user) > 0) {
				if($user[0]['status'] == 1) {
					$gcm = array();
					$gcm['id'] = $user[0]['id'];
					$gcm['gcm_reg_id'] = $gcmcode;
					$this->userlib->updateUserProfile($gcm);
					$contact_details = array();
					$data = new stdClass();
					$data->ContactId = $user[0]['id'];
					$data->FirstName = $user[0]['name'];
					$data->Email = $user[0]['email'];
					$data->MobileNumber = $user[0]['mobile'];
					$data->Address = $user[0]['address'];
					$data->TMLContactId = $user[0]['id'];
					$data->area = $user[0]['area'];
					$data->landmark = $user[0]['landmark'];
					$data->latitude = $user[0]['latitude'];
					$data->longitude = $user[0]['longitude'];
					array_push($contact_details,$data);
					$resp["success"] = "true";
					$resp["login"] = "valid";
					$resp["data"] = $contact_details;
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "OTP is not verified";
				}
			} else {
				$resp["success"] = "false";
				$resp["error"] = "Invalid username";
			}
		}
		$this->response ($resp,200);
	}
	
	public function myaccount_post() {
		$email = $this->post('username');
		if($email != "") {
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->getUserByEmail ( $email );
			if(count($user) > 0) {
				$wallet = $this->userlib->getWalletBalance($user[0]['id']);
				$refferal_code = '';
				if(!empty($user[0]['my_ref_code'])) {
					$refferal_code = $user[0]['my_ref_code'];
				} else {
					$length=8;
					$code = '';
					$keys = array_merge(range(1, 9), range('A', 'Z'), range('a', 'z'));
						
					for ($i = 0; $i < $length; $i++)
					{
						$code .= $keys[array_rand($keys)];
					}
					$gcm = array();
					$gcm['id'] = $user[0]['id'];
					$gcm['my_ref_code'] = $code;
					$this->userlib->updateUserProfile($gcm);
					$refferal_code = $code;
				}
				$resp["success"] = "true";
				$resp["referralcode"] = $refferal_code;
				if(count($wallet)  > 0) {
					$resp["balance"] = $wallet[0]['amount'];
				} else {
					$resp["balance"] = 0;
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "contact not found";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "email is blank";
		}
		$this->response ($resp,200);
	}
	
	public function updatecontact_post() {
		$email = $this->post('email');
		if ( $email != "") {
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->getUserByEmail ( $email );
			if (count($user) > 0) {
				$mobno = $this->post('mobno');
				$name = $this->post('name');
				$address = $this->post('address');
				$area = $this->post('area');
				$landmark = '';
				if(!empty($this->post('landmark')))
				$landmark = $this->post('landmark');
				$latitude = '';
				if(!empty($this->post('latitude')))
				$latitude = $this->post('latitude');
				$longitude = '';
				if(!empty($this->post('longitude')))
				$longitude = $this->post('longitude');
				if($mobno!="" && $name!="" && $address!="" && $area!="") {
					$usermap = array();
					$usermap['id'] = $user[0]['id'];
					$usermap['name'] = $name;
					$usermap['mobile'] = $mobno;
					$usermap['address'] = $address;
					$usermap['area'] = $area;
					if($area == 'Aundh') {
						$areaid = 1;
					} else if($area == 'Balewadi') {
						$areaid = 4;
					} else if($area == 'Baner') {
						$areaid = 2;
					} else if($area == 'Bavdhan') {
						$areaid = 5;
					} else if($area == 'Pashan') {
						$areaid = 3;
					} else if($area == 'Karve Nagar') {
						$areaid = 9;
					} else if($area == 'Kothrud') {
						$areaid = 6;
					} else if($area == 'Sus') {
						$areaid = 7;
					} else if($area == 'Warje') {
						$areaid = 8;
					} else {
						$areaid = 1;
					}
					$usermap['areaid'] = $areaid;
					$usermap['landmark'] = $landmark;
					$usermap['latitude'] = $latitude;
					$usermap['longitude'] = $longitude;
					$this->userlib->updateUserProfile($usermap);
					$latlong = array();
					$latlong['userid'] = $user[0]['id'];
					$latlong['latitude'] = $usermap['latitude'];
					$latlong['longitude'] = $usermap['longitude'];
					$latlong['locality'] = $usermap['area'];
					$latlong['landmark'] = $usermap['landmark'];
					$latlong['areaid'] = $areaid;
					$latlong['address'] = $usermap['address'];
					$this->userlib->updateAddressByUserId($latlong);
					$resp["success"] = "true";
					$resp["contactid"] = $user[0]['id'];
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "No field should be left blank";
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "contact not found";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "email id is blank";
		}
		$this->response ($resp,200);
	}
	
	public function forgotpassword_post() {
		$username = $this->post('username');
		if (empty($username))
		{
			$resp["success"] = "false";
			$resp["error"] = "Username not found";
		}
		else
		{
			$username = stripslashes($username);
			//$username = mysql_real_escape_string($username);
			$this->load->library('zyk/UserLib');
			$profile = $this->userlib->getUserByEmail($username);
			if(count($profile) > 0) {
				$data = array();
				$data['email'] = $username;
				$data['mobile'] = $profile[0]['mobile'];
				$data['name'] = $profile[0]['name'];
				$data['password'] = $profile[0]['original'];
				//$this->load->library('zyk/UserLib');
				//$this->userlib->sendPasswordSMS($data);
				$this->userlib->forgetPasswordEmail($data);
				$user = array();
				$user['name'] = $profile[0]['name'];
				$user['phone'] = $profile[0]['mobile'];
				$user['email'] = $profile[0]['email'];
				$user['tmlid'] = $profile[0]['id'];
				$user['address'] = $profile[0]['address'];
				$user['contactid'] = $profile[0]['id'];
				$users[] = $user;
				$resp["status"] = "true";
				$resp["message"] = "Your password has been sent on your registered Email";
				$resp["data"] = $users;
			} else {
				$users = array();
				$resp["status"] = "false";
				$resp["message"] = "contact not found";
				$resp["data"] = $users;
			}
		}
		$this->response ($resp,200);
	}
	
	public function checkaddress_post() {
		$address = $this->post('pincode');
		//$email = $this->post('email');
		$this->load->library('zyk/General');
		$date = date('Y-m-d');
		$contact_details = array();
		if($address != "") {
			$pincode = $address;
			$areas = $this->general->getAreasByPincode($pincode);
			//print_r($areas);
		    /* $this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->login ( $login ); */
			if($areas[0]['status'] == 1) {
				/* $gcm = array();
				$gcm['id'] = $user[0]['id'];
				$gcm['gcm_reg_id'] = $this->post('gcm_code');
				$this->userlib->updateUserProfile($gcm); */
				//$contact_details = array();
				$data = new stdClass();
				$data->AreaId = $areas[0]['id'];
				$data->AreaName = $areas[0]['name'];
				$data->Pincode = $areas[0]['pincode'];
				/*$data->MobileNumber = $user[0]['mobile'];
				$data->Address = $user[0]['address'];
				$data->TMLContactId = $user[0]['id'];
				$data->area = $user[0]['area'];
				$data->landmark = $user[0]['landmark'];
				$data->latitude = $user[0]['latitude'];
				$data->longitude = $user[0]['longitude'];*/
				array_push($contact_details,$data);
				$response["status"] = "true";
				$response["message"] = "valid";
				$response["data"] = $contact_details;
			} else {
				$response["status"] = "false";
				$response["message"] = "Invalid Address";
				$response["data"] = $contact_details;
			}
			
		} else {
			$response["status"] = "false";
			$response["message"] = "Address is Empty";
			$response["data"] = $contact_details;
		}
		//$this->response ($resp,200);
		echo json_encode($response);
	}
	
	  
		
		public function getUseraddress_post() {
			$userid = $this->post('userid');
		    $this->load->library ( 'zyk/UserLib' );
		    
			if($userid != "") {
				    $items = $this->userlib->getAddressById($userid);
									
					$add = array();
					$address = array();
					$address1 = array();
					$address2 = array();
					foreach($items as $item) {
						if($item['address_name'] == 'Home'){
							$add['address_id'] = $item['id'];
							$add['address_name'] = $item['address_name'];
							$add['locality']  = $item['locality'];
							$add['latitude']  = $item['latitude'];
							$add['longitude']  = $item['longitude'];
							$add['address'] = $item['address'];
							$add['landmark']  = $item['landmark'];
							$add['pincode'] = $item['pincode'];
							$add['vendor_id'] = $item['vendor_id'];
							$add['vendor_id1'] = $item['vendor_id1'];
							array_push($address,$add);
						}else if($item['address_name'] == 'Work'){
							$add['address_id'] = $item['id'];
							$add['address_name'] = $item['address_name'];
							$add['locality']  = $item['locality'];
							$add['latitude']  = $item['latitude'];
							$add['longitude']  = $item['longitude'];
							$add['address'] = $item['address'];
							$add['landmark']  = $item['landmark'];
							$add['pincode'] = $item['pincode'];
							$add['vendor_id'] = $item['vendor_id'];
							$add['vendor_id1'] = $item['vendor_id1'];
							array_push($address1,$add);
						}else if($item['address_name'] == 'Other'){
							$add['address_id'] = $item['id'];
							$add['address_name'] = $item['address_name'];
							$add['locality']  = $item['locality'];
							$add['latitude']  = $item['latitude'];
							$add['longitude']  = $item['longitude'];
							$add['address'] = $item['address'];
							$add['landmark']  = $item['landmark'];
							$add['pincode'] = $item['pincode'];
							$add['vendor_id'] = $item['vendor_id'];
							$add['vendor_id1'] = $item['vendor_id1'];
							array_push($address2,$add);
						}
					}
					$response["status"] = "true";
					$response["message"] = "User address";
					$response["home"] = $address;
					$response["work"] = $address1;
					$response["other"] = $address2;
									
			} else {
				$response["status"] = "false";
				$response["message"] = "UserId is Empty";
				$response["data"] = $address;
			}
			//$this->response ($resp,200);
			echo json_encode($response);
		}
		
		public function contact_post() {
		
			$this->load->library('zyk/Adminauth');
			$con = $this->adminauth->getContact();
		
			$contacts = array();
			foreach($con as $contact) {
				//$service['id'] = $item['id'];
				//$service['ratecard_name'] = $item['ratecard_name'];
				$cont['address']  = $contact['address'];
				$cont['tel_no']  = $contact['tel_no'];
				$cont['email']  = $contact['email'];
				$cont['whatsup_no']  = $contact['mobile'];
				$contacts[] = $cont;
		
			}
			$data['status']="true";
			$data['message']="Contact details";
			$data['data']= $contacts;
			
			echo json_encode($data);
		}
		
		public function updatetoken_post(){
			
			$gcm = array();
			$gcm['id'] = $this->post('userid');
			$gcm['gcm_reg_id'] = $this->post('tokenid');
			$this->load->library ( 'zyk/UserLib' );
			$this->userlib->updateUserProfile($gcm);
			
			$contacts = array();
			$data['status']="true";
			$data['message']="Device Id is updated";
			$data['data']= $contacts;
				
			echo json_encode($data);
		}
		
		public function updatepassword_post(){
				
			$gcm = array();
			$gcm['id'] = $this->post('userid');
			$gcm['password'] = md5($this->post('password'));
			$gcm['original'] = $this->post('password');
			$this->load->library ( 'zyk/UserLib' );
			$this->userlib->updateUserProfile($gcm);
				
			$contacts = array();
			$data['status']="true";
			$data['message']="password is updated";
			$data['data']= $contacts;
		
			echo json_encode($data);
		}
		
		public function updateprofile_post(){
		
		/*	$user = array();
			$user['id'] = $this->post('userid');
			//$user['password'] = md5($this->post('fullname'));
			//$user['original'] = $this->post('password');
			$user ['name'] = trim($this->post ( 'fullname' ));
			$user ['mobile'] = $this->post ( 'mobile' );
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->updateUserProfile($user);
		   
			$contacts = array();
			foreach($user as $contact) {
				//$service['id'] = $item['id'];
				//$service['ratecard_name'] = $item['ratecard_name'];
				$cont['userid']  = $contact['id'];
				$cont['name']  = $contact['name'];
				$cont['email']  = $contact['email'];
				$cont['mobile']  = $contact['mobile'];
				$cont['areaid']  = $contact['areaid'];
				$contacts[] = $cont;
			
			}*/
			
			$params = array();
			$params['id'] = $this->input->post('id');
			$params['name'] = $this->input->post('name');
			$params['email'] = $this->input->post('email');
			$params['mobile'] = $this->input->post('mobile');
			$params['original'] = $this->input->post('password');
			$params['password'] = md5($this->input->post('password'));
			$params['address'] = $this->input->post('address');
			$this->load->library ( 'zyk/UserLib' );
			$register = $this->userlib->updateUser1( $params );
			
			$data['status']="true";
			$data['message']="success";
		
			echo json_encode($data);
		}
		
		public function accountsetting_post(){
		
			$params = array();
			$params['id'] = $this->input->post('id');
			$params['name'] = $this->input->post('name');
			$params['email'] = $this->input->post('email');
			$params['original'] = $this->input->post('password');
			$params['password'] = md5($this->input->post('password'));
			$params['model'] = $this->input->post('model');
		    $params['vehicle_no'] = $this->input->post('vehicleno');
			$this->load->library ( 'zyk/UserLib' );
			$register = $this->userlib->updateUser1( $params );
			
			$params1 = array();
			$params1['id'] = $this->input->post('id');
			$params1['model'] = $this->input->post('model1');
			$params1['vehicle_no'] = $this->input->post('vehicleno1');
			$this->load->library ( 'zyk/UserLib' );
			$register1 = $this->userlib->updateUser2( $params1 );
				
			$data['status']="true";
			$data['message']="success";
		
			echo json_encode($data);
		}
		
		public function getUserProfile_post() {
			$userid = $this->post('userid');
			$this->load->library ( 'zyk/UserLib' );
			
			$user = $this->userlib->getUser($userid);
			$user1 = $this->userlib->getUser1($userid);
			
			$resp['success']='true';
			$resp['userdata'] = $user;
			$resp['uservehical'] = $user1;
			
			echo json_encode($resp);
		
		}
		
		/* public function getUserNotification_post() {
			$userid = $this->post('userid');
			$this->load->library ( 'zyk/UserLib' );
		
			if($userid != "") {
				$items = $this->userlib->getUserNotification($userid);
					
				$add = array();
				$address = array();
				foreach($items as $item) {
					$add['id'] = $item['id'];
					$add['message'] = $item['message'];
					$add['type']  = $item['type'];
					$add['created_date'] = $item['created_date'];
					//$add['landmark']  = $item['landmark'];
					//$add['pincode'] = $item['pincode'];
					//$add['locality']  = $item['locality'];
					$address[] = $add;
				}
				
				$response['status']="true";
				$response['message']="Alert Data";
				$response['data']= $address;
					
			} else {
				$response["status"] = "false";
				$response["message"] = "UserId is Empty";
				$response['data']= $address;
			}
			//$this->response ($resp,200);
			echo json_encode($response);
		} */
		
		
		public function testNotification_post(){
				
			$email = $this->post('email');
				
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->getUserByEmail($email);
			$userid = $user[0]['id'];
				
				
			$this->load->library('zyk/OrderLib');
			$result = $this->orderlib->sendBookingNotification($userid);
				
			//$contacts = array();
			//$data['status']="false";
			//$data['message']="Address id is blank";
			//$data['data']= $result;
				
			echo json_encode($result);
				
		}
		
		public function getWalletBalance_post(){
			$userid = $this->post('userid');
			if($userid != "") {
						$this->load->library ( 'zyk/UserLib' );
						$balance = $this->userlib->getWalletBalance($userid);
						$wallet_history =  $this->userlib->getWalletTransactions($userid);
						if(!empty($balance)){
							$balance = $balance;
						}else{
							$balance[0]['amount'] = 0;
						}
						
						$response['status']="true";
						$response['message']="Wallet Data";
						$response['balance']= $balance;
						$response['wallet_history']= $wallet_history;
						
					} else {
						$response["status"] = "false";
						$response["message"] = "UserId is Empty";
						//$response['data']= 
					}
			echo json_encode($response);
		}
		
		public function getReferCode_post(){
			$userid = $this->post('userid');
			if($userid != "") {
				$this->load->library ( 'zyk/UserLib' );
				$refercode = $this->userlib->getReferCode($userid);
						
				$response['status']="true";
				$response['message']="Refer Code";
				$response['refercode']= $refercode;
				//$response['wallet_history']= $wallet_history;
		
			} else {
				$response["status"] = "false";
				$response["message"] = "UserId is Empty";
				//$response['data']=
			}
			echo json_encode($response);
		}
		
		public function getUserNotification_post(){
		
			$userid = $this->post('userid');
		
			$this->load->library ( 'zyk/OrderLib' );
			$result = $this->orderlib->getUserNotification($userid);
			
			$response['status']="true";
			$response['message']="Refer Code";
			$response['data']= $result;
				
			echo json_encode($response);
		
		}
	
}	