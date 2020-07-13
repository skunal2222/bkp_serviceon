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
	
	public function login_post() {
		$login = array ();
		$login ['mobile'] = $this->post ( 'mobile' );
		$login ['password'] = $this->post ( 'password' );
		$login ['gcm_token'] = $this->post ( 'gcm_token' );
		$contact_details = array();
		if (empty($login ['mobile']) || empty($login ['password']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please enter mobile number and password";
		}
		else
		{
		   $this->load->library ( 'zyk/MechanicLib' );
			$user = $this->mechaniclib->login ( $login );
			 // print_r($user);
			if($user[0]['status'] == 1) {
				$data = new stdClass();
				$data->id = $user[0]['id'];
				$data->name = $user[0]['name'];
				$data->email = $user[0]['email'];
				$data->mobile = $user[0]['mobile'];
				$data->password = $user[0]['password'];
				$data->role = $user[0]['role'];
				
				//$data->areaid = $user[0]['areaid'];
				array_push($contact_details,$data); 
				$response["status"] = "true";
				$response["message"] = "Logged in successfully";
				$response["data"] = $contact_details;
			} else {
				$response["status"] = "false";
				$response["message"] = "Invalid username or password";
				$response["data"] = $contact_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function update_profile_post() {
		$login = array ();
		$login ['id'] = $this->post ( 'user_id' );
		$login ['name'] = $this->post ( 'name' );
		$login ['password'] = $this->post ( 'password' );
		$login ['email'] = $this->post ( 'email' );
		$contact_details = array();
		
		if (empty($login ['email']) || empty($login ['password']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please enter Email number Or password";
		}
		else
		{
			
		   $this->load->library ( 'zyk/MechanicLib' );
			$result = $this->mechaniclib->update_profile ( $login );
			 // print_r($user);
			if($result == 1) {				
				$response["success"] = "true";
				$response["msg"] = "Account Setting Changed successfully";
			} else {
				$response["success"] = "false";
				$response["msg"] = "Error in changing Account Setting";
			}
			//echo json_encode($success_response);
		}
		$this->response ($response,200);
	}
	
	public function reason_list_post() {
		
		
		$reason_details = array();
		
		$this->load->library ( 'zyk/MechanicLib' );
		$list = $this->mechaniclib->reasonList ();
			 // print_r($user);
			if(count($list)>0) {
				
				foreach ($list as $value) {
					array_push($reason_details,$value); 
				}	
				
				$response["status"] = "true";
				$response["message"] = "Reason List";
				$response["data"] = $reason_details;
			} else {
				$response["status"] = "false";
				$response["message"] = "Reason List Not Found";
				$response["data"] = $reason_details;
			}
		
		$this->response ($response,200);
	}

	public function main_services_list_post() {
		
		$params = array ();	
		
		$params['type'] = $this->post ('type');
		$params['category_id'] = $this->post ('category_id');
		$params['brand_id'] = $this->post ('brand_id');
		$params['model_id'] = $this->post ('model_id');
		$params['subcategory_id'] = $this->post ('subcategory_id');
		
		
		$service_details = array();
		if (empty($params ['type']) || empty($params ['category_id']) || empty($params ['brand_id']) || empty($params ['model_id']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fiels";
		}
		else
		{
		   $this->load->library ( 'zyk/MechanicLib' );
			$data = $this->mechaniclib->mainServicesList ($params);
			  //print_r($data);
			if($data[0]['status'] == 1) {
				
				foreach ($data as $value) {
					array_push($service_details,$value); 
				}				
				
				$response["status"] = "true";
				$response["message"] = "Service list";
				$response["data"] = $service_details;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "Service list not Found";
				$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function ongoing_orders_post() {
		
		$params = array ();	
		
		$params['user_id'] = $this->post ('user_id');
		$params['role'] = $this->post ('role');
		
		
		$service_details = array();
		if (empty($params ['user_id']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fiels";
		}
		else
		{
		   $this->load->library ( 'zyk/MechanicLib' );
			$data = $this->mechaniclib->ongoingOrders ($params);
			  //print_r($data);
			if(count($data)>0) {
				
				foreach ($data as $value) {
					array_push($service_details,$value); 
				}				
				
				$response["status"] = "true";
				$response["message"] = "Ongoing Order list";
				$response["data"] = $service_details;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "Service list not Found";
				$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function getOrderHistory_post(){
		$params = array ();	
		
		$params['id'] = $this->post ('user_id');
		$params['role'] = $this->post ('role');
		
		$this->load->library ( 'zyk/MechanicLib' );
		$order = $this->mechaniclib->getOrder($params);
		
		if(!empty($order)){
			$success_response['status'] = "1";
			$success_response['message'] = "Order history";
			$success_response['data'] = $order;
		}else{
			$success_response['status'] = "0";
			$success_response['message'] = "No records found.";
		}
	
		$this->response ($success_response,200);
	
	}
	
	public function ongoingorderinfo_post() {
		$uid = $this->post('user_id');
		$order_id = $this->post ('order_id');
		$so = array();
		if($uid!="") {
			//$this->load->library ( 'zyk/UserLib' );
			
			
			$this->load->library ( 'zyk/MechanicLib' );
			$so = $this->mechaniclib->getlastOrder($order_id);
			$logs = $this->mechaniclib->getlastOrderComment ($order_id);
			
				
			$resp['success']='true';
			$resp['order'] = $so;
			$resp['logs'] = $logs;
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "User Id is blank";
		}
		$this->response ($resp,200);
	}

	public function service_or_spareparts_list_post() {
		
		$params = array ();	
		
		$params['type'] = $this->post ('type');
		$params['category_id'] = $this->post ('category_id');
		$params['brand_id'] = $this->post ('brand_id');
		$params['model_id'] = $this->post ('model_id');
		$params['subcategory_id'] = $this->post ('subcategory_id');
		$params['catsubcat_id'] = $this->post ('catsubcat_id');
		
		
		$service_details = array();
		if (empty($params ['type']) || empty($params ['category_id']) || empty($params ['brand_id']) || empty($params ['model_id']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fiels";
		}
		else
		{
		   $this->load->library ( 'zyk/MechanicLib' );
			$data = $this->mechaniclib->serviceOrSparepartsList ($params);
			  //print_r($data);
			if($data[0]['status'] == 1) {
				
				foreach ($data as $value) {
					array_push($service_details,$value); 
				}				
				
				$response["status"] = "true";
				$response["message"] = "Service or spare parts list";
				$response["data"] = $service_details;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "Service or spare parts list not Found";
				$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function suggested_services_list_post() {
		
		$params = array ();	
		
		$params['orderid'] = $this->post ('order_id');
		
		
		$service_details = array();
		if (empty($params ['orderid']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fiels";
		}
		else
		{
		   $this->load->library ( 'zyk/MechanicLib' );
			$data = $this->mechaniclib->suggestedServiceList ($params);
			  //print_r($data);
			if(count($data)>0) {
				
				foreach ($data as $value) {
					array_push($service_details,$value); 
				}				
				
				$response["status"] = "true";
				$response["message"] = "Suggested service list";
				$response["data"] = $service_details;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "Suggested service list not Found";
				$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function suggest_services_post() {
		$params = array ();
		$params ['suggested_list'] = $this->post ('suggested_list');
		$userid = $this->post ('user_id');
		
		$service_details = array();
		if (empty($params ['suggested_list']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fields";
		}
		else
		{
		   $this->load->library ( 'zyk/MechanicLib' );
			$data = $this->mechaniclib->suggestServices ($params['suggested_list'],$userid);
			  //print_r($data);
			if($data == 0) {
				
				$response["status"] = "true";
				$response["message"] = "Suggested services added successfully";
				//$response["data"] = $service_details;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "Error in add services";
				//$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function scheduled_services_post() {
		$service_data = array ();
		$service_data ['service_day'] = $this->post ( 'service_day' );
		$service_data ['user_id'] = $this->post ( 'user_id' );
		
 		$service_details = array();
		if (empty($service_data ['user_id']) || empty($service_data ['service_day']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fiels";
		}
		else
		{
		    $this->load->library ( 'zyk/MechanicLib' );
		    $this->load->library ( 'zyk/ServiceLib' );


			$data = $this->mechaniclib->scheduled_services ( $service_data ); 

  			if($data[0]['status'] == 1) {
				
				foreach ($data as $value) {
					array_push($service_details,$value); 
				}	 
 				foreach ($service_details as $key => $order) {
 									 $catSubCatNames  = array();

					$catsubcatList = $this->servicelib->getCatsubcatid($order['subcategory_id']);  

					foreach ($catsubcatList as $key2 => $catsub) {  
						$catsubcatArray = explode(',', $order['catsubcat_id']);
						if(in_array($catsub['id'], $catsubcatArray)){
							$currentArray['name'] =  $catsub['name'];
							$catSubCatNames[] = $currentArray;
						} 
 					}
 					$service_details[$key]['catsubcatList']=  $catSubCatNames;
 				} 
  				
 				$response["status"] = "true";
				$response["message"] = "Schedule service list";
				$response["data"] = $service_details;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "Schedule service list not Found";
				$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function verifyotp_post() {
		//$email = $this->post ( 'username' );
		//$otp = $this->post ( 'otp' );
		$reg = array ();
		$reg ['mobile'] = $this->post ( 'mobile' );
		$reg ['otp'] = $this->post ( 'otp' );
		
		$login = array ();
		
		if(!empty($reg ['mobile']) && !empty($reg ['otp'])) {
			
			$this->load->library ( 'zyk/MechanicLib' );		
			$result = $this->mechaniclib->otpMatch($reg);
			
				if($result[0]['status'] == 1) {
					
					$success_response["success"] = "true";
					$success_response["msg"] = "OTP Match";
				} else {
					$success_response["success"] = "false";
					$success_response["msg"] = "Incorrect OTP.Please enter the correct OTP.";
				}
			
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please enter the OTP sent to your mobile number";
		}
		//$this->response ($success_response,200);
		echo json_encode($success_response);
	}
	
	public function service_accept_or_reject_post() {
		
		$user_id = $this->post ( 'user_id' );
		$accept_reject_flag = $this->post ( 'accept_reject_flag' );
		$order_id = $this->post ( 'order_id' );
		
		$data = array ();
		$data['user_id'] = $user_id;
		$data['accept_reject_flag'] = $accept_reject_flag;
		$data['order_id'] = $order_id;
		$data['reason_id'] = $this->post ( 'reason_id' );
		
		if(!empty($user_id) && !empty($accept_reject_flag) && !empty($order_id)) {
			
			$this->load->library ( 'zyk/MechanicLib' );		
			$result = $this->mechaniclib->service_accept_or_reject_post($data);			
			
			if($result == 1) {
				
				$success_response["success"] = "true";
				$success_response["msg"] = "Order status changed successfully";
			} else {
				$success_response["success"] = "false";
				$success_response["msg"] = "Error in changing order status.";
			}
			
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please fill the required details.";
		}
		echo json_encode($success_response);
	}
	
	public function setpassword_post() {
		
		$mobile = $this->post ( 'mobile' );
		$password = $this->post ( 'password' );
		
		$data = array ();
		$data['mobile'] = $mobile;
		$data['password'] = $password;
		
		if(!empty($mobile) && !empty($password)) {
			
			$this->load->library ( 'zyk/MechanicLib' );		
			$result = $this->mechaniclib->updatePassword($data);			
			
			if($result == 1) {
				
				$success_response["success"] = "true";
				$success_response["msg"] = "Password set successfully";
			} else {
				$success_response["success"] = "false";
				$success_response["msg"] = "Please enter the correct Password.";
			}
			
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please fill the required details.";
		}
		echo json_encode($success_response);
	}
	
	public function order_status_post() {
		
		$user_id = $this->post ('user_id');
		$order_id = $this->post ('order_id');
		$order_status = $this->post ('order_status');
		
		$data = array ();
		$data['user_id'] = $user_id;
		$data['order_id'] = $order_id;
		$data['order_status'] = $order_status;
		
		if(!empty($user_id) && !empty($order_id)) {
			
			$this->load->library ( 'zyk/MechanicLib' );		
			$result = $this->mechaniclib->orderStatus($data);			
			
			if($result == 1) {
				
				$success_response["success"] = "true";
				$success_response["msg"] = "Order Status Changed successfully";
			} else {
				$success_response["success"] = "false";
				$success_response["msg"] = "Error in change order status";
			}
			
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please fill the required details.";
		}
		echo json_encode($success_response);
	}
	
	public function payment_post() {
		
		$user_id = $this->post ('user_id');
		$order_id = $this->post ('order_id');
		$order_status = $this->post ('order_status');
		$received_amount = $this->post ('received_amount');
		
		$data = array ();
		$data['user_id'] = $user_id;
		$data['order_id'] = $order_id;
		$data['order_status'] = $order_status;
		$data['received_amount'] = $received_amount;
		
		if(!empty($user_id) && !empty($order_id)) {
			
			$this->load->library ( 'zyk/MechanicLib' );		
			$result = $this->mechaniclib->paymentStatus($data);			
			
			if($result == 1) {
				
				$success_response["success"] = "true";
				$success_response["msg"] = "Payment received successfully";
			} else {
				$success_response["success"] = "false";
				$success_response["msg"] = "Error in payment";
			}
			
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Please fill the required details.";
		}
		echo json_encode($success_response);
	}
	
	public function send_otp_post() {
		
		$data=array();
		$data['mobile']=$this->post('mobile_number');
		$this->load->library ( 'zyk/MechanicLib' );
		$result = $this->mechaniclib->sendOTP ( $data );
		if($result == 1) {
			$success_response["success"] = "true";
			$success_response["msg"] = "OTP sent successfully";
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "mobile number not found";
		}
		echo json_encode($success_response);
	}
	
	public function getMechanicNotificationById_post(){
	
		$mecid = $this->post('mec_id');
		$this->load->library ( 'zyk/MechanicLib' );
		$user = $this->mechaniclib->getMechanicNotificationById($mecid);
		
		$success_response["status"] = "true";
		$success_response["message"] = "Notification data";
		$success_response["data"] = $user;
		
		echo json_encode($success_response);
	
	}
	
	public function testNotification_post(){
		$mecid = $this->post('mec_id');
		$this->load->library ( 'zyk/MechanicLib' );
		$user = $this->mechaniclib->sendOrderAssignedNotification($mecid);
		echo json_encode($user);
	}
	
	public function testGarageNotification_post(){
		$garage_id = $this->post('garage_id');
		$this->load->library ( 'zyk/MechanicLib' );
		$user = $this->mechaniclib->sendGarageAssignedNotification($garage_id);
		echo json_encode($user);
	}

	public function getOrderListByMechanic_post() {
	   $data = array ();
	   $data['vendor_id']= $this->post ( 'vendor_id' );
 	   $data['mec_id']= $this->post ( 'mec_id' );

		 if (empty($data ['vendor_id']) && empty($data['mec_id']))
	   {
		   $response["success"] = "false";
		   $response["msg"] = "Invalid data";
	   }
	   else
	   {
		  $this->load->library ( 'zyk/OrderLib' );
		  $this->load->library ( 'zyk/ServiceLib' );
		   $orderList = $this->orderlib->getOrderListByMechanic ( $data );

 		   if(!empty($orderList)) { 
 		   		foreach ($orderList as $key => $value) {
					$orderList[$key]['catsubcatList'] = $this->servicelib->getCatsubcatid($value['subcategory_id']);
 				}

			   $response["status"] = "true";
			   $response["message"] = "Order list get successfully";
			   $response["data"] = $orderList;
		   } else {
			   $response["status"] = "false";
			   $response["message"] = "Invalid data";
			}
	   }
	  echo json_encode($response);
   }
		
		
	public function getMechnicList_post() {
		$params = array ();
		$params ['vendor_id'] = $this->post ('vendor_id');
		//$userid = $this->post ('mech_id');
		
		$service_details = array();
		if (empty($params ['vendor_id']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fields";
		}
		else
		{
		   $this->load->library ( 'zyk/MechanicLib' );
			$data = $this->mechaniclib->getMechnicList ($params);
			  //print_r($data);
			if(count($data)>0) {
				//array_push($service_details,$data); 
				$response["status"] = "true";
				$response["message"] = "Mechanic List get successfully";
				$response["data"] = $data;
			} else {
				$response["status"] = "false"; 
				$response["message"] = "No Data found";
				//$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function assignMechnic_post() {
		$params = array ();
		$params ['mec_id'] = $this->post ('mec_id');
		$params ['order_id'] = $this->post ('order_id');
		//$userid = $this->post ('mech_id');
		
		$service_details = array();
		if (empty($params ['mec_id']) || empty($params ['order_id']))
		{
			$response["success"] = "false";
			$response["msg"] = "Please provide required fields";
		}
		else
		{
		   $this->load->library ( 'zyk/MechanicLib' );
			$data = $this->mechaniclib->assignMechnic($params);
			  //print_r($data);
			if($data == 1) {
				//array_push($service_details,$data); 
				$response["success"] = "true";
				$response["msg"] = "Order assigned to mechanic";
				//$response["data"] = $data;
			} else {
				$response["success"] = "false"; 
				$response["msg"] = "Error in assign mechanic";
				//$response["data"] = $service_details;
			}
		}
		$this->response ($response,200);
	}
	
	public function addMechanic_post() {
		
		$data=array();
		$data['name']=$this->post('name');
		$data['mobile']=$this->post('mobile');
		$data['email']=$this->post('email');
		$data['emergency_mobile']=$this->post('emergency_mobile');
		$data['password']=$this->post('password');
		$data['garage_id']=$this->post('garage_id');
		$data['role_id']=$this->post('role_id');
		$data['status']=$this->post('status');
		$data['created_by']=$this->post('created_by');
		$data['document']=$this->post('document');
		
		$this->load->library ( 'zyk/MechanicLib' );
		$result = $this->mechaniclib->addMechanic ( $data );
		if($result >0) {
			$success_response["success"] = "true";
			$success_response["msg"] = "Mechanic added successfully";
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Error in upload data";
		}
		echo json_encode($success_response);
	}
	 
	public function getRoleList_post() {
		
		
		$this->load->library ( 'zyk/MechanicLib' );
		$result = $this->mechaniclib->getRoleList ();
		if(count($result) > 0) {
			$success_response["status"] = "true";
			$success_response["message"] = "Role List";
			$success_response["data"] = $result;
		} else {
			$success_response["status"] = "false";
			$success_response["message"] = "List Not Found";
		}
		echo json_encode($success_response);
	}
	
	public function uploadDocument_post() {
	
		$path = "assets/images/vendor/";
		$saveurl = "images/vendor/";
			
		$upload_url = base_url().$path;
		$response = array();
	
		if(isset($_POST['vendor_id']) && isset($_FILES['pdf']['name'])){
			//$vendorid = $_POST['vendor_id'];
			//$doctype = $_POST['doc_type'];
			
			$randomid = mt_rand(10000,99999);
			
			
			$docid = "empdoc".$randomid;
			
			//getting file info from the request
			$fileinfo = pathinfo($_FILES['pdf']['name']);
				
			//getting the file extension
			$extension = $fileinfo['extension'];
				
			//file url to store in the database
			$file_url = $saveurl . $docid . '.' . $extension;
				
			$file_path = $path . $docid . '.'. $extension;
				
			move_uploaded_file($_FILES['pdf']['tmp_name'],$file_path);
			
			$data = array ();
			//$data['vendor_id'] = $vendorid;			
			
			$data['emp_doc_url'] = $file_url;
							
			
			
			$success_response['success'] = "true";
			$success_response['msg'] = "File Uploded Succesfully";
			$success_response['data'] = asset_url().$file_url;
	
		}else{
			$success_response['success'] = "false";
			$success_response['msg'] = "Please choose a file";
			$success_response['data'] = '';
			
		}
		
		echo json_encode($success_response);
	
	}
	
	public function addUserTracking_post() {
		
		$data=array();
		$data['user_id']=$this->post('user_id');
		$data['data']=$this->post('data');
		
		
		$this->load->library ( 'zyk/MechanicLib' );
		$result = $this->mechaniclib->addUserTracking ( $data );
		if($result >0) {
			$success_response["success"] = "true";
			$success_response["msg"] = "History data added successfully";
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "Error in upload data";
		}
		echo json_encode($success_response);
	}
}	