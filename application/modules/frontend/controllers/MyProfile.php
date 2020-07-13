<?php defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(0);
Class MyProfile extends MX_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}

/***************************** kunal *******************************************/
	public function get_login_view()
    {
    	$data = array();
    	$response['view'] = $this->load->view('login', $data, true);
    	echo json_encode($response);
    }

    public function get_mobile_verify_view()
    {
    	$data = array();
    	$response['view'] = $this->load->view('mobile_verify', $data, true);
    	echo json_encode($response);
    }

    public function sendOtpVerifyMobile()
    {
    	$verify = array ();
		$verify ['username'] = $this->input->post ( 'username' );
		$seprateView = (!empty($_POST['seprateView']))?$_POST['seprateView']:0;

		$this->load->library ( 'zyk/UserLoginLib' );
		$result = array();
		$exist = $this->userloginlib->userLoginExist ( $verify );
		if (!empty($exist)) {
			$result['exist_flag'] = 1;
		} else {
			$exist ['otp'] = mt_rand(100000,999999);
			$result['exist_flag'] = 0;
			$result ['mobile'] = $verify ['username'];
			$result ['otp'] = $exist['otp'];
			$result ['username'] = $verify ['username'];
			$this->userloginlib->sendOTPSMS($result);

			if ($seprateView == 1) {
				$result['view'] = $this->load->view('verify-otp', $result, true);
			}
		}
		
		echo json_encode ( $result );
    }

    public function updateMobile()
    {
    	$otp = array();
		$otp['otp'] = $this->input->post('otp');
		$otp['mobile'] = $this->input->post('username');
		$otp['id'] = !empty($this->input->post('id'))?$this->input->post('id'):0;
		$this->load->library ( 'zyk/UserLoginLib' );
		$user = $this->userloginlib->loginwithOTP ( $otp );
		echo json_encode($user);
    }

	public function myprofile($page) {

		if (!empty($_SESSION['olouserid'])) {
			$sidedata['active'] = 0;
			$data['userid'] = $_SESSION['olouserid'];
			if ($page === "profile") {
				$sidedata['active'] = 1;
				$sidebar = $this->load->view('myprofile/profile-sidebar', $sidedata, TRUE);
				$this->load->library ( 'zyk/UserLoginLib' );
				$userdata = $this->userloginlib->getProfile ($data['userid']);

				$this->template->set ( 'sidebar_url', $sidebar );
				$this->template->set ( 'userdata', $userdata[0] );
			    $this->template->set ( 'page', 'My-Profile' );
			    $this->template->set ( 'description', '' );
			    $this->template->set ( 'keywords', '' );
			    $this->template->set_theme('default_theme');
			    $this->template->set_layout ('default')
			    ->title ( 'ServiceOn' )
			    //->meta ( 'doctors' )
			    ->set_partial ( 'header', 'partials/header' )
			    ->set_partial ( 'footer', 'partials/footer' );
			    $this->template->build ('myprofile/profile-update');
			}

			if ($page === "order-history") {
				$sidedata['active'] = 2;
				$sidebar = $this->load->view('myprofile/profile-sidebar', $sidedata, TRUE);
				
				$this->template->set ( 'sidebar_url', $sidebar );
			    $this->template->set ( 'page', 'My-Profile' );
			    $this->template->set ( 'description', '' );
			    $this->template->set ( 'keywords', '' );
			    $this->template->set_theme('default_theme');
			    $this->template->set_layout ('default')
			    ->title ( 'ServiceOn' )
			    //->meta ( 'doctors' )
			    ->set_partial ( 'header', 'partials/header' )
			    ->set_partial ( 'footer', 'partials/footer' );
			    $this->template->build ('myprofile/order-history');
			}

			if ($page === "ongoing-order") {
				$sidedata['active'] = 3;
				$sidebar = $this->load->view('myprofile/profile-sidebar', $sidedata, TRUE);
				$this->load->library('zyk/OrderLib', 'orderlib');
				$orders = $this->orderlib->getOrderListByUserID($_SESSION['olouserid']);
				$no = 0;
				$items = [];
				foreach ($orders as $order) {
					$items[$no] = $this->orderlib->getOrderItems($order['orderid']);
					++$no;
				}
				
				$this->template->set ( 'sidebar_url', $sidebar );
				$this->template->set ( 'orders', $orders );
				$this->template->set ( 'items', $items );
			    $this->template->set ( 'page', 'My-Profile' );
			    $this->template->set ( 'description', '' );
			    $this->template->set ( 'keywords', '' );
			    $this->template->set_theme('default_theme');
			    $this->template->set_layout ('default')
			    ->title ( 'ServiceOn' )
			    //->meta ( 'doctors' )
			    ->set_partial ( 'header', 'partials/header' )
			    ->set_partial ( 'footer', 'partials/footer' );
			    $this->template->build ('myprofile/ongoing-order');
			}

			if ($page === "vehicle") {
				$sidedata['active'] = 4;
				$sidebar = $this->load->view('myprofile/profile-sidebar', $sidedata, TRUE);
				$this->load->library ( 'zyk/UserLoginLib' );
                // $this->load->library ( 'zyk/UserLib', 'userlib' );
                $this->load->library ( 'zyk/VehicalLib', 'vehicallib' );

                $brands = $this->vehicallib->getActiveBikeBrands();
                $vehicalList = $this->vehicallib->getVehicalList($data['userid']);
                // $user_address = $this->userlib->getAddressByIDs($data);
                $userdata = $this->userloginlib->getProfile ($data['userid']);
				
				$this->template->set ( 'sidebar_url', $sidebar );
				$this->template->set ( 'vehicallist', $vehicalList );
                $this->template->set ( 'brands_data', $brands );
                // $this->template->set ( 'userAddress', $user_address );
                $this->template->set ( 'userdata', $userdata[0] );
			    $this->template->set ( 'page', 'My-Profile' );
			    $this->template->set ( 'description', '' );
			    $this->template->set ( 'keywords', '' );
			    $this->template->set_theme('default_theme');
			    $this->template->set_layout ('default')
			    ->title ( 'ServiceOn' )
			    //->meta ( 'doctors' )
			    ->set_partial ( 'header', 'partials/header' )
			    ->set_partial ( 'footer', 'partials/footer' );
			    $this->template->build ('myprofile/vehicle-details');
			}

			if ($page === "address") {
				$sidedata['active'] = 5;
				$sidebar = $this->load->view('myprofile/profile-sidebar', $sidedata, TRUE);
				$this->load->library ( 'zyk/UserLib', 'userlib' );
                $user_address = $this->userlib->getAddressByIDs($data);
				
				$this->template->set ( 'sidebar_url', $sidebar );
                $this->template->set ( 'userAddress', $user_address );
			    $this->template->set ( 'page', 'My-Profile' );
			    $this->template->set ( 'description', '' );
			    $this->template->set ( 'keywords', '' );
			    $this->template->set_theme('default_theme');
			    $this->template->set_layout ('default')
			    ->title ( 'ServiceOn' )
			    //->meta ( 'doctors' )
			    ->set_partial ( 'header', 'partials/header' )
			    ->set_partial ( 'footer', 'partials/footer' );
			    $this->template->build ('myprofile/address-details');
			}

			if ($page === "refer-n-earn") {
				$sidedata['active'] = 6;
				$sidebar = $this->load->view('myprofile/profile-sidebar', $sidedata, TRUE);
				$this->load->library ( 'zyk/UserLoginLib' );
                // $userdata = $this->userloginlib->getProfile ($data['userid']);
				
                $refercode = $this->userloginlib->getReferCode($data['userid']);
				if(!empty($refercode)){
					$this->template->set('refercode',$refercode[0]);
				}
				$point_conf=wallet_config();
		    	//$point_conf['my_referral'] = 50;
		    	//$point_conf['other_referral'] = 30;

		        $logourl=asset_url().'images/logo.png';
		        $this->template->set ('ogtitle', 'ServiceOn');
			    $this->template->set ( 'ogimage', " $logourl");
			    $this->template->set ( 'ogdes',  'Get '.$point_conf['other_referral'].' points in your ServiceOn wallet by using my referral code '.$refercode[0]['my_ref_code'].'. You will love their services .' );
		        $this->template->set ( 'description', 'Get '.$point_conf['other_referral'].' points on your first order use referral code '.$refercode[0]['my_ref_code'] );
				$this->template->set('point_array',$point_conf);
				$this->template->set('url',base_url());
			    $this->template->set ( 'page', 'myprofile/refer-n-earn' );

				$this->template->set ( 'sidebar_url', $sidebar );
                $this->template->set ( 'refercode', $refercode[0] );
			    $this->template->set ( 'page', 'My-Profile' );
			    $this->template->set ( 'description', '' );
			    $this->template->set ( 'keywords', '' );
			    $this->template->set_theme('default_theme');
			    $this->template->set_layout ('default')
			    ->title ( 'ServiceOn' )
			    //->meta ( 'doctors' )
			    ->set_partial ( 'header', 'partials/header' )
			    ->set_partial ( 'footer', 'partials/footer' );
			    $this->template->build ('myprofile/refer-n-earn');
			}

			if ($page === "points") {

				$this->load->library ( 'zyk/UserLoginLib' );
				$balance = $this->userloginlib->getWalletBalance($data['userid']);
				$wallet_history =  $this->userloginlib->getWalletTransactions($data['userid']);
				if(empty($balance)){
					$balance[0]['amount'] = 0;
				}
				if(empty($wallet_history)){
					$wallet_history = '';
				}
                $this->load->library('MloyalLib', 'mloyallib');
                $loyality_points = $this->mloyallib->get_customer_trans_info($_SESSION['olousermobile']);

				$sidedata['active'] = 7;
				$sidebar = $this->load->view('myprofile/profile-sidebar', $sidedata, TRUE);

              	$this->template->set ( 'loyality_points', $loyality_points);
				$this->template->set ( 'balance', $balance);
				$this->template->set ( 'wallet_history', $wallet_history);				
				$this->template->set ( 'sidebar_url', $sidebar );
			    $this->template->set ( 'page', 'My-Profile/Wallet' );
			    $this->template->set ( 'description', '' );
			    $this->template->set ( 'keywords', '' );
			    $this->template->set_theme('default_theme');
			    $this->template->set_layout ('default')
			    ->title ( 'ServiceOn' )
			    ->set_partial ( 'header', 'partials/header' )
			    ->set_partial ( 'footer', 'partials/footer' );
			    $this->template->build ('myprofile/points-details');
			}

			if ($page === "digi-docs") {
				$sidedata['active'] = 8;
				$sidebar = $this->load->view('myprofile/profile-sidebar', $sidedata, TRUE);

				$q = $this->db->get('tbl_digidocs');
				$filedata = $q->result_array();


				$this->template->set ( 'sidebar_url', $sidebar );
				$this->template->set ( 'filedata', $filedata );
			    $this->template->set ( 'page', 'My-Profile' );
			    $this->template->set ( 'description', '' );
			    $this->template->set ( 'keywords', '' );
			    $this->template->set_theme('default_theme');
			    $this->template->set_layout ('default')
			    ->title ( 'ServiceOn' )
			    ->set_partial ( 'header', 'partials/header' )
			    ->set_partial ( 'footer', 'partials/footer' );
			    $this->template->build ('myprofile/digi-documents');
			}
		} else {
			redirect(base_url());
		}
	}

	public function delete_digidocs()
	{
		$fileid = $this->input->post('file_id');
		
		$dgoldfile = $this->db->select('file_path')->where('id',$fileid)->get('tbl_digidocs')->row_array();
		$file_path = $dgoldfile['file_path'];
		if(file_exists('./assets/'.$file_path))
		{
		    unlink('./assets/'.$file_path);
		}
		
		$this->db->where('id',$fileid)->delete('tbl_digidocs');
		return 1;
	}

	public function update_digidocs()
	{
		$user_id = $_SESSION['olouserid'];
		if (!empty($user_id)) {
			$filename = $_POST['dgup_fileName'];
			$fileid = $_POST['dgup_id'];

			if(!empty($_FILES['dgup_files']['name'])) {

	            $ext = pathinfo($_FILES['dgup_files']['name'], PATHINFO_EXTENSION);
	            $rand = rand(1000,9999);

	            $dgoldfile = $this->db->select('file_path')->where('id',$fileid)->get('tbl_digidocs')->row_array();

				$file_path = $dgoldfile['file_path'];

				$config['upload_path']          = './assets/digi_docs/';
		        $config['allowed_types']        = 'pdf|jpeg|jpg|png';
		        $config['max_size']             = 5 * 1024 * 1024;
		        $config['file_name']            = date('YmdHis').$rand.".".$ext;

		        $this->load->library('upload', $config);
				$this->upload->initialize($config);

				if(!$this->upload->do_upload('dgup_files'))
		        {
		            $error['msg'] = $this->upload->display_errors();
		            $error['status'] = 0;
		            echo json_encode($error);
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

			$id = $this->db->where('id',$fileid)->update('tbl_digidocs',$data);

			$response['msg'] = "Document updated successfully.";
			$response['status'] = 1;
			echo json_encode($response);
		}
		else
		{
			redirect(base_url()."login");
		}
	}

	public function submit_digidocs()
	{
		// print_r($_FILES);die();
		$user_id = $_SESSION['olouserid'];
		if (!empty($user_id)) {
			$filename = $_POST['dg_fileName'];
			$cn = count($_FILES['dg_files']['name']);

			for ($i=0; $i < $cn; $i++) { 

				$_FILES['file']['name']     = $_FILES['dg_files']['name'][$i]; 
	            $_FILES['file']['type']     = $_FILES['dg_files']['type'][$i]; 
	            $_FILES['file']['tmp_name'] = $_FILES['dg_files']['tmp_name'][$i]; 
	            $_FILES['file']['error']    = $_FILES['dg_files']['error'][$i]; 
	            $_FILES['file']['size']     = $_FILES['dg_files']['size'][$i];

	            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
	            $rand = rand(1000,9999);

				$config['upload_path']          = './assets/digi_docs/';
		        $config['allowed_types']        = 'pdf|jpeg|jpg|png';
		        $config['max_size']             = 5 * 1024 * 1024;
		        $config['file_name']            = date('YmdHis').$rand.".".$ext;

		        $this->load->library('upload', $config);
				$this->upload->initialize($config);

		        if ( ! $this->upload->do_upload('file'))
		        {
		            $error['msg'] = $this->upload->display_errors();
		            $error['status'] = 0;
		            echo json_encode($error);
		            exit;
		        }
		        else
		        {
					$data['user_id'] = $user_id;
					$data['vehicle_id'] = isset($_POST['vehicle_id'])?$_POST['vehicle_id']:"";
					$data['file_name'] = $filename[$i];
					$data['file_path'] = "digi_docs/".$config['file_name'];
					$data['created_date'] = date('Y-m-d H:i:s');

					$id = $this->db->insert('tbl_digidocs',$data);
		        }
			}

			$response['msg'] = "Document uploaded successfully.";
			$response['status'] = 1;
			echo json_encode($response);
		}
		else
		{
			redirect(base_url()."login/");
		}
		
	}

	public function profile_update()
	{
		$response['status'] = 0;
		$data['id'] = $_SESSION['olouserid'];
		$data['name'] = $this->input->post('fname');
		$data['lname'] = $this->input->post('lname');
		$data['email'] = $this->input->post('email');
		$data['dob'] = $this->input->post('dob');
		$data['gender'] = $this->input->post('gender');

		if ($this->input->post('isOtpVerify') == 1) {
			$q = $this->db->select('mobile1')->where('id',$data['id'])->get('tbl_users');
			$result = $q->row_array();
			if (!empty($result['mobile1'])) {
				$data['mobile1'] = $result['mobile1'].",".$_POST['oldMobile'];
			} else {
				$data['mobile1'] = $_POST['oldMobile'];
			}
			$data['mobile'] = $this->input->post('mobile');
		}

		$this->load->library('zyk/UserLib', 'userlib');
		$response['result'] = $this->userlib->updateUserProfile($data);
		if (!empty($response['result'])) {
			$response['status'] = 1;
		}
		echo json_encode($response);
	}

	public function addNewVehicle(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = (isset($_SESSION['olouserid']))?$_SESSION['olouserid']:""; 

        $params['user_id'] = $user_id;
        $params['vehical_no'] = $this->input->post('vehicle_no');
        $params['brand_id'] = $this->input->post('search_brand');
        $params['model_id'] = $this->input->post('search_model');
        $params['manufactured_year'] = $this->input->post('manufactured_year');
        $params['total_kms'] = $this->input->post('total_kms');
        $params['insurance_no'] = $this->input->post('insurance_no');
        $params['purchase_date'] = $this->input->post('purchase_date');
        $params['issued_by'] = $this->input->post('issued_by');

        $params['status'] = 1;
        $params['created_datetime'] = date('Y-m-d H:i:s');

        /*echo "<pre>";
        print_r($params);
        exit();*/

        if (!empty($_SESSION['filterbrand'])) {
        	unset($_SESSION['filterbrand']);
        }

        if (!empty($_SESSION['filtermodel'])) {
        	unset($_SESSION['filtermodel']);
        }

        $response = $this->vehicallib->AddVehical($params); 
        echo json_encode($response);  
	}

	public function updateVehical(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid']; 

        $params['user_id'] = $user_id; 
        $params['id'] = $this->input->post('vehical_id'); 
		$params['vehicle_no'] = $this->input->post('vehicle_no');
		$params['vehicle_alias_no'] = str_replace(" ", "_", strtolower(trim($params['vehicle_no']))); 
        $params['brand_id'] = $this->input->post('search_brand');
        $params['model_id'] = $this->input->post('search_model');
        $params['manufactured_year'] = $this->input->post('manufactured_year');
        $params['total_kms'] = $this->input->post('total_kms');
        $params['insurance_no'] = $this->input->post('insurance_no');
        $params['purchase_date'] = $this->input->post('purchase_date');
        $params['issued_by'] = $this->input->post('issued_by');
        $params['status'] =  1;   
        $params['updated_datetime'] = date('Y-m-d H:i:s');   
/*
        echo "<pre>";
        print_r($params);
        exit();
*/
        $response = $this->vehicallib->updateVehicle($params); 
        echo json_encode($response);  
	}

	public function getModelsByBrandsID()
	{
		$brandId = $this->input->get('brandId');
		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$result = $this->vehicallib->getModelsByBrandsID($brandId);

		echo json_encode($result);

	}

	public function deleteVehical()
	{
		$vehical_id = $this->input->post('vehical_id');
		$this->db->where('id',$vehical_id)->delete('tbl_user_vehicles');
		echo json_encode(1);
	}

	public function set_isPrimary_vehicle()
    {
    	$user_id = $this->input->post('userid');
    	$vehicleid = $this->input->post('vehicle_id');
    	$response = [];

    	if (!empty($vehicleid)) {
    		$this->db->set('is_primary_vehicle',0);
    		$this->db->where('user_id',$user_id);
    		$this->db->update('tbl_user_vehicles');

    		$this->db->set('is_primary_vehicle',1);
    		$this->db->where('id',$vehicleid);
    		$this->db->update('tbl_user_vehicles');

    		$this->load->library('zyk/VehicalLib', 'vehicallib');
			$vehicle = $this->vehicallib->getVehiclesbyId($vehicleid);
			if (!empty($vehicle[0])) {
    			$response['setvehicle'] = $vehicle[0]['vehicle_no']."(Brand:".$vehicle[0]['brandname'].", Model:". $vehicle[0]['modelname'].")";
			}
    	}
    	echo json_encode($response);
    }


    public function user($userid){
		
		// for profile sidebar ./
    	$sidedata['active'] = 6;
		$sidebar = $this->load->view('myprofile/profile-sidebar', $sidedata, TRUE);
		$this->template->set('sidebar_url',$sidebar);
		// for profile sidebar ./

		$this->load->library ( 'zyk/UserLoginLib' );
		$this->load->library('zyk/UserLib','userlib');
    	if(!empty($userid)){
			$refercode = $this->userloginlib->getReferCode($userid);
			if(!empty($refercode)){
				$this->template->set('refercode',$refercode[0]);
			}
		}

	    $point_conf=wallet_config();
	    // $point_conf['my_referral'] = 50;
	    // $point_conf['other_referral'] = 30;
	    $logourl=asset_url().'images/logo.png';

		$this->template->set ( 'page', 'my-profile/refer-n-earn' );
		$this->template->set ('ogtitle', 'ServiceOn');
	    $this->template->set ( 'ogimage', " $logourl");
        $this->template->set ( 'ogdes',  'Get '.$point_conf['other_referral'].' points in your ServiceOn wallet by using my referral code '.$refercode[0]['my_ref_code'].'. You will love their services .' );
        $this->template->set ( 'description', 'Get '.$point_conf['other_referral'].' points on your first order use referral code '.$refercode[0]['my_ref_code'] );
		$this->template->set('point_array',$point_conf);

		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'ServiceOn' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('myprofile/refer-n-earn');

	}

	public function updateServices() {

		// echo "<pre>"; print_r($_POST['orderidhidden']); exit();
		// print_r($_POST); die;
    	$this->load->library('zyk/OrderLib');
    	$this->load->library ( 'zyk/UserLib' );
    	$this->load->library('zyk/ItemLib');
    	$orderid = $this->input->post('orderidhidden');
    	$orders = $this->orderlib->getOrderDetailsByOrderId($orderid);
    	$adjustment = $orders[0]['adjustment'];
    	$response = array();
    	$itemcheck = $this->input->post('is_checked');
    	$itemids = $this->input->post('itemidhidden');
    	$itemnames = $this->input->post('itemnameA');
    	$itemprices = $this->input->post('pric');
    	$itemtaxes = $this->input->post('tax1');
    	$itemtypes = $this->input->post('itemtype');
    	$itempriority = $this->input->post('itempriority');
    	$qtys = $this->input->post('qty');
		$wts = $this->input->post('weight');
		$itemqty = $this->input->post('quantity'); 

    	
    	$ordertotal = 0;
    	$items = array();
    	for ($i = 0; $i < count($itemids); $i++) {
    		$item = array();
    		$item['orderid'] = $orderid;
    		$item['service_id'] = $itemids[$i];
    		$item['service_name'] = $itemnames[$i];
    		$item['service_price'] = $itemprices[$i];
    		/*$item['quantity'] = 1;*/
    		$item['service'] = $itemtypes[$i];
    		$item['tax'] = $itemtaxes[$i];
    		$item['priority'] = $itempriority[$i];
    		$item['quantity'] = $itemqty[$i];
    		$cal=$itemtaxes[$i] /100 * $itemprices[$i];
    		$item['total_amount']= $itemprices[$i] + $cal;
    		$item['is_checked'] = $itemcheck[$i];
    		//echo $itemcheck[i];
    		if($item['is_checked'] == 1){
    			//echo "itemcheck";
    			$total_amount = $itemprices[$i] + $cal;
    		}else{
    			//echo "itemchecktest";
    			$total_amount = 0;
    		}
    		//$total_amt += $item['total_amount'];
    		$items[] = $item;
   			$ordertotal = $ordertotal + $total_amount ;
   			
    	}
    	$this->orderlib->removeOrderItems($orderid);
            
    	$this->orderlib->addOrderItems($items);
    	$items = $this->orderlib->getOrderItems($orderid);
    	$delivery_charge = 0;
    	$discountable_total = 0;
    	$discount = 0;
    	$newoutstanding = 0;
    	if($orders[0]['outstanding'] != 0) {
    		$outstanding = $orders[0]['outstanding'] + $adjustment;
    		$newoutstanding = 0;
    		$nettotal = $ordertotal - $discount + $delivery_charge;
    		if($outstanding > 0) {
    			$adjustment = $outstanding;
    			$newoutstanding = 0;
    		} else {
    			$outstanding = $outstanding * -1;
    			if($outstanding <= $nettotal) {
    				$adjustment = $outstanding;
    				$newoutstanding = 0;
    			} else {
    				$adjustment = $nettotal;
    				$newoutstanding = $outstanding - $nettotal;
    			}
    			$adjustment = $adjustment * -1;
    			$newoutstanding = $newoutstanding * -1;
    		}
    	}
    	$orderdata = array();
    	$orderdata['orderid'] = $orderid;
    	$orderdata['order_amount'] = $ordertotal;
    	$orderdata['delivery_charge'] = $delivery_charge;
    	$orderdata['vat_tax'] = 0;
    	$orderdata['service_tax'] = 0;
    	$orderdata['discount'] = $discount;
    	$orderdata['adjustment'] = $adjustment;
    	$orderdata['net_total'] = $ordertotal - $discount + $delivery_charge;
    	$orderdata['grand_total'] = $ordertotal - $discount + $adjustment + $delivery_charge;

    	//Update order price  added
    	$orderdata['order_amount'] = $orderdata['order_amount'] + $orders[0]['old_price'];
    	$orderdata['net_total'] = $orderdata['net_total'] + $orders[0]['old_price'];
    	$orderdata['grand_total'] = $orderdata['grand_total'] + $orders[0]['old_price'];
    	$this->orderlib->updateOrder($orderdata);
    	
    	$logs = array();
    	$logs['orderid'] = $orderid;
    	$logs['comment'] = 'Approval Updated By '.$orders[0]['name'].' (Customer)';
    	$logs['created_date'] = date('Y-m-d H:i:s');
    	$logs['order_status'] = 2;
    	$logs['created_by'] = $orders[0]['userid'];
    	$this->orderlib->addOrderLogs($logs);

    	if (!empty($orderid)) {
    		$msg = $this->confirmApproval($orderid);
    	}

    	$response['status'] = 1;
    	$response['message'] = 'Estimate Confirmed successfully.';
    	echo json_encode($response);
    }

    public function confirmApproval($orderid) {
    	 
    	$this->load->library('zyk/OrderLib');
    	$this->load->library('zyk/MechanicLib');
    	$orders = $this->orderlib->getOrderDetails($orderid);

    	$this->load->model('search/Search_model','search_model');
    	$packageid=$orders[0]['package_id'];
    	$package_name= $this->search_model->getPackagebyId($packageid); 

    	$items = $this->orderlib->getOrderItems($orderid);

    	/*echo "<pre>";
    	print_r($items);
    	exit();*/

    	if(!empty($items && $items['is_package_service'] == 0 )) {
  	 
            $confirm = 1;
            foreach($items as $value) {
                if($value['is_checked'] == 1) {
                   $confirm = 2; 
                }
            }
            if($confirm == 1) {
                echo json_encode(array('msg'=>'Please Approve services'));
                exit;
            }
        }else if($orders[0]['package_id'] != 0) {
            $booking_packges = $this->orderlib->order_packege_services($orderid);
            if(empty($booking_packges)) {  
                echo json_encode(array('msg'=>'Please Confirm package services'));
                exit;
            }
        } else if(empty($items) && $orders[0]['package_id'] == 0) { 
            echo json_encode(array('msg'=>'Please add services/spares'));
            exit;
        } /*else if(!empty($items && $items['is_package_service'] == 0 )) {
  	
  			echo "string";

            $confirm = 1;
            foreach($items as $value) {
                if($value['is_checked'] == 1) {
                   $confirm = 2; 
                }
            }
            if($confirm == 1) {
                echo json_encode(array('msg'=>'Please Approve services'));
                exit;
            }
        }
        */

       
        $orderdata = array();
    	$orderdata['orderid'] = $orderid;
    	$orderdata['status'] = 3; 

    	/*echo "<pre>";
        print_r($orderdata);exit();
*/

    	$this->orderlib->updateOrder($orderdata);
    	$data = array();
    	$items = $this->orderlib->getOrderItems($orderid);

    	//$packageitems = $this->orderlib->getPackageOrderItems($orderid);

    	$data = array();
    	$data['name'] = $orders[0]['name'];
    	$data['mobile'] = $orders[0]['mobile'];
    	$data['email'] = $orders[0]['email'];
    	$data['orderid'] = $orders[0]['orderid'];
    	$data['ordercode'] = $orders[0]['ordercode'];
    	$data['pickup_date'] = $orders[0]['pickup_date'];
    	$data['order_amount'] = $orders[0]['order_amount'];
    	$data['items'] = $items; 
    	//$data['packageitems'] = $packageitems; 
    	$data['package_name']= $package_name[0]['package_name'];
    	$data['package_amount'] = $orders[0]['old_price'];

    	//print_r($data);  

    	$sndSms   = $this->orderlib->confirmApproval_sms($data);
    	$sndEmail = $this->orderlib->confirmApproval_email($data);
/*    	$this->orderlib->sendEstimateconfirmedNotification($orders[0]['userid']);
    	$this->mechaniclib->sendEstimateConfirmedNotification($orders[0]['vendor_id']);*/
    	 
    	
    	$logs = array();
    	$logs['orderid'] = $orderid;
    	$logs['comment'] = 'Estimate Confirmed By '.$data['name'].' (Customer).';
    	$logs['created_date'] = date('Y-m-d H:i:s');
    	$logs['order_status'] = 3;
    	$logs['created_by'] = $orders[0]['userid'];
    	$this->orderlib->addOrderLogs($logs);
    	
    	return 1;
    }


/***************************** kunal *******************************************/


	public function Basicinfo() {
		$uid = $this->session->userdata('olouserid') ;
		if($uid==''){
			redirect(base_url());
		}
		$this->load->library ( 'zyk/UserLoginLib' );
		$saved_address = $this->userloginlib->getUserAddressnk($uid);

		$this->template->set('saved_address',$saved_address);

		$userdata = $this->userloginlib->getProfile ($uid);
		$this->template->set ( 'data', $userdata[0] );

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$this->load->library('zyk/ServiceLib', 'servicelib');

		$vehicalList = $this->vehicallib->getVehicalList($uid);

  		$brands = $this->vehicallib->getActiveBikeBrands();
        $models = $this->servicelib->getActiveModels();


        $this->template->set('brands',$brands);
        $this->template->set('models',$models);
        $this->template->set('vehicalList',$vehicalList);

		$uid = $this->session->userdata('olouserid');
		$this->template->set ( 'page', 'my-profile/basic-info' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Bike Doctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/basic-info');

	}

	public function Docwallet() {
		$uid = $this->session->userdata('olouserid') ;
		if($uid==''){
			redirect(base_url());
		}


		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$this->load->library('zyk/UserLib', 'userlib');

		$vehicalList = $this->vehicallib->getVehicalList($uid);
		$userList = $this->userlib->getUser($uid);
		$documentList = $this->vehicallib->getVehicalDocumentList($uid);

  		$brands = $this->vehicallib->getActiveBikeBrands();
        $models = $this->servicelib->getActiveModels();


        $this->template->set('brands',$brands);
        $this->template->set('models',$models);
        $this->template->set('userList',$userList);
        $this->template->set('vehicalList',$vehicalList);
        $this->template->set('documentList',$documentList);

		$uid = $this->session->userdata('olouserid');
		$this->template->set ( 'page', 'my-profile/basic-info' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Bike Doctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/doc-wallet');

	}

	public function OtherDoc() {
		$uid = $this->session->userdata('olouserid') ;
		if($uid==''){
			redirect(base_url());
		}


		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$this->load->library('zyk/ServiceLib', 'servicelib');

		$vehicalList = $this->vehicallib->getVehicalList($uid);
  		$brands = $this->vehicallib->getActiveBikeBrands();
        $models = $this->servicelib->getActiveModels();
        $documentList = $this->vehicallib->getVehicalDocumentList($uid);



        $this->template->set('brands',$brands);
        $this->template->set('models',$models);
        $this->template->set('vehicalList',$vehicalList);
        $this->template->set('documentList',$documentList);

		$uid = $this->session->userdata('olouserid');
		$this->template->set ( 'page', 'my-profile/basic-info' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Bike Doctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/other-doc');

	}


	public function VehicleDoc() {
		$uid = $this->session->userdata('olouserid') ;
		if($uid==''){
			redirect(base_url());
		}

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$folder = $this->uri->segment(1);
  		$Id = $this->uri->segment(2);
		$vehicalList = $this->vehicallib->getVehiclesbyId($Id);
  		$brands = $this->vehicallib->getActiveBikeBrands();
        $models = $this->servicelib->getActiveModels();
        $documentList = $this->vehicallib->getVehicalAllDocumentList($Id,$uid);
     	$this->template->set('folder',$folder);
        $this->template->set('brands',$brands);
        $this->template->set('models',$models);
        $this->template->set('vehicalList',$vehicalList);
        $this->template->set('documentList',$documentList);

		$uid = $this->session->userdata('olouserid');
		$this->template->set ( 'page', 'my-profile/basic-info' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Bike Doctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/vehicle-doc');

	}


	public function refernearn(){
		$this->load->library ( 'zyk/UserLoginLib' );
		$userid = $this->session->userdata('olouserid');
		if(!empty($userid)){
			$refercode = $this->userloginlib->getReferCode($userid);
			if(!empty($refercode)){
				$this->template->set('refercode',$refercode[0]);
			}
			 $point_conf=wallet_config();

    		//$point_conf['my_referral'] = 50;
    		//$point_conf['other_referral'] = 30;

        $logourl=asset_url().'images/logo-main.png';
        $this->template->set ('ogtitle', 'BikeDoctor');
	    $this->template->set ( 'ogimage', " $logourl");
	    $this->template->set ( 'ogdes',  'Get '.$point_conf['other_referral'].' points in your BikeDoctor wallet by using my referral code '.$refercode[0]['my_ref_code'].'. You will love their services .' );
        $this->template->set ( 'description', 'Get '.$point_conf['other_referral'].' points on your first order use referral code '.$refercode[0]['my_ref_code'] );
		$this->template->set('point_array',$point_conf);
		$this->template->set('url',base_url());
	    $this->template->set ( 'page', 'my-profile/refer-n-earn' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'BikeDoctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/refer-n-earn');
		}else{
			redirect(base_url());
		}
	}

	

	// public function Notifications() {
	//     $this->template->set ( 'page', 'my-profile/notifications' );
	//     $this->template->set ( 'description', '' );
	//     $this->template->set ( 'keywords', '' );
	//     $this->template->set_theme('default_theme');
	//     //$this->template->set_layout (false);
	//     $this->template->set_layout ('default')
	//     ->title ( 'BikeDoctor' )
	//     //->meta ( 'doctors' )
	//     ->set_partial ( 'header', 'partials/header' )
	//     ->set_partial ( 'footer', 'partials/footer' );
	//     $this->template->build ('my-profile/notifications');

	// }

	function Notifications(){
		$this->load->library ( 'zyk/UserLib' );
		$userid = $this->session->userdata('olouserid');
		if(!empty($userid)){
			$this->load->library ( 'zyk/UserLoginLib' );
			$notifications = $this->userloginlib->getNotificationByuserId($userid);
			$notificationcount = $this->userloginlib->getNotificationCount($userid);
			$this->session->set_userdata('usernotification',$notificationcount);
			$this->template->set('notifications',$notifications);

	    $this->template->set ( 'page', 'my-profile/notifications' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Bike Doctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/notifications');


		}else{
			redirect(base_url());
		}
	}






}