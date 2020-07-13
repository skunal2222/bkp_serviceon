<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Login extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}
	
	public function index() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Administrator control panel' )
		->set_partial ( 'header', 'partials/header_login' )
		->set_partial ( 'leftnav', 'partials/menu' )
		->set_partial ( 'footer', 'partials/footer_login' );
		$this->template->build ('login');
	}
	
	public function dashboard() {
		$this->load->library('zyk/OrderLib');
		$orders = $this->orderlib->allOrders();
		// $pendingorders = $this->orderlib->allPendingOrders();  
               
		// $assignedorders = $this->orderlib->allAssignedOrders(); 

		$neworders = $this->orderlib->allNewOrders(); 
		$pickupriderassignedorders = $this->orderlib->pickupRiderAssignedOrders(); 
		$deliveryriderassignedorders = $this->orderlib->deliveryRiderAssignedOrders(); 
		// $ongoingorders = $this->orderlib->allOngoingOrders(); 
		$estimateGenerated = $this->orderlib->allEstimateGeneratedOrders(); 
		$workingorders = $this->orderlib->allWorkingOrders(); 
		$completedorders = $this->orderlib->allCompletedOrders(); 
		// $delivery_completed_orders = $this->orderlib->allDeliveryCompletedOrders();  
		$delivery_completed_orders = $this->orderlib->allDeliveryCompletedOrds();  
		$canceled_orders = $this->orderlib->allCanceledOrders();
		// echo $pickupriderassignedorders;
		// die();

		$this->template->set('orders',$orders);
		// $this->template->set('pendingorders',$pendingorders);  
		// $this->template->set('assignedorders',$assignedorders); 
		$this->template->set('neworders',$neworders);
		$this->template->set('pickupriderassignedorders',$pickupriderassignedorders); 
		$this->template->set('deliveryriderassignedorders',$deliveryriderassignedorders); 
		// $this->template->set('ongoingorders',$ongoingorders); 
		$this->template->set('estimateGenerated',$estimateGenerated); 
		$this->template->set('workingorders',$workingorders);
		$this->template->set('completedorders',$completedorders);
		$this->template->set('delivery_completed_orders',$delivery_completed_orders); 
		$this->template->set('canceled_orders',$canceled_orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Administrator control panel' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('dashboard');
	}
	
	public function adminlogin() {
		$data['email'] = trim($this->input->post('email'));
		$data['password'] = $this->input->post('password');
		$this->load->library('zyk/adminauth');
		$result = $this->adminauth->login($data); 

		//print_r($useracces);

		if($result['status'])
		{
			$this->session->set_userdata('adminsession',$result['result']);
			/*if($result['status'] == 1){
				$useracces = $this->adminauth->getMenuAssignbyUserRole($result['result']['user_role']);
				$this->session->set_userdata('useracces',$useracces['access']);
			}
			*/ 

			if($result['result']['user_role'] != 1){
                $access = $this->adminauth->seesionAccess($result['result']['user_role']);
                $this->session->set_userdata('access', $access);
            } else { 	
                $access = array();
                for ($a = 1;  $a < 40 ; $a++) {
                    $access[$a] = 1;
                }
                $this->session->set_userdata('access', $access);
            } 
            

			//$this->session->set_userdata ( 'adminfname', $result['first_name'] );
		}
		echo json_encode($result);	
	}
	
	/**
   	 * Code For Logout Functionality
   	 */

	public function client_reset_password() {
            $data['id'] = $this->session->adminsession['id'];
            $data['text_password'] = $this->input->post('password', FALSE);
            $data['password'] = md5($this->input->post('password', FALSE));
            $data['first_login'] = 0;
            $detailsData = $this->session->userdata('adminsession');
            $detailsData['first_login'] = 0;
            $this->session->set_userdata('adminsession', $detailsData);
            $this->load->library('mylib/adminauth');
            echo json_encode($this->adminauth->reset_password($data));
        }


   	public function logout() {
   		$this->session->unset_userdata('adminsession');
   		redirect(base_url()."admin");
   	}
	

	/**
	 * View Change Password
	 */
	public function view_change_password() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
			 ->title ( 'FreightBazaar | Change Password' )
			 ->set_partial ( 'header', 'partials/header' )
			 ->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('change_password');
	}
	
	/**
	 * Edit Password
	 */
	public function editPassword()
	{
		
		$param['updated_by'] = $this->session->userdata['adminsession']['id'];
		$params['updated_date'] = date('Y-m-d H:i:s');
		$param = $this->input->post('data');
		$newpassword = $param['text_password'];
		$password = MD5($newpassword);
		
		$data = array();
		$data['uid'] = $this->session->userdata['adminsession']['id'];
		$data['oldpassword'] = $param['oldpassword'];
		$data['password'] = $password;
		$data['text_password'] = $param['text_password'];
		$this->load->library('zyk/adminauth');
		$response = $this->adminauth->checkPassword($data);
		$map = array();
		if($response['status'] == 1){
			$boolvalue = $this->adminauth->editPassword($data);
			if($boolvalue == 1)
			{
				$map['status'] = 1;
				$map['msg'] = "Password updated successfully";
			}
			else
			{
				$map['status'] = 0;
				$map['msg'] = "Failed to change password";
			}
		}
		else
		{
			$map = $response;
		}
		echo json_encode($map);
	}
	public function userList()
	{
		$this->load->library('zyk/adminauth');
		$users = $this->adminauth->getUserList();
		$this->template->set('users',$users);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Users' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('user/userList');
	}
	public function turnonof()
	{
		$data = array();
		$data['status'] = $this->input->get('status');
		$data['id'] = $this->input->get('id');
		$this->load->library('zyk/adminauth');
		$users = $this->adminauth->turnonof($data);
		return 1;
	}
	public function assignRole()
	{
		$data = array();
		$data['user_role'] = $this->input->get('role');
		$data['id'] = $this->input->get('id');
		$this->load->library('zyk/adminauth');
		$users = $this->adminauth->assignRole($data);
		return 1;
		
	}
	  public function AccessType(){ 

        $this->load->library('zyk/adminauth'); 
	 	$data['user_role'] = $this->session->adminsession['user_role'];
	 	$data['url'] = $_POST['url'];

	 	/*echo "<pre>";
	 	print_r($data);
	 	exit();*/

	 	$result = $this->adminauth->AccessType($data);  

    	/*echo "<pre>";
	 	print_r($result);
	 	exit();*/

	 	if(!empty($result)) {
			$response['status'] = 'true';
			$response['msg'] = ""; 
		} else {
			$response['status'] = 'false';
			$response['msg'] = "You don't have permission to access this page..!!";  
		}
		echo json_encode($response); 

    }
	
}
