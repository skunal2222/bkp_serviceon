<?php defined('BASEPATH') OR exit('No direct script access allowed');
Class Order extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$this->load->library('zyk/SlotLib', 'slotlib');
		error_reporting(0);
	} 
	public function TrackOrder() {
	
		$id=$_SESSION['olouserid'];
		 
		$this->load->library ( 'zyk/UserLib' );
		if(!empty($id)){
			$orders = $this->userlib->getOngoingOrders($id);
	//	echo '<pre>';	print_r($orders);  echo '</pre>'; exit;
			//$order = $this->userlib->getlastOrder($id);
			//$logs= $this->userlib->getlastOrderComment($order[0]['orderid']);
			//$bill = $this->userlib->getBill($id);
 
			
		$this->load->library('zyk/OrderLib');
		$allorders = $this->orderlib->getOrderDetails($orders[0]['orderid']);
 

		$this->load->library('zyk/SearchLib','searchlib');
 		if($allorders[0]['package_id'] > 0)
 		{      
 			$this->load->library('zyk/OrderLib');
            $Userpackages = $this->orderlib->getUserpackageDetails($allorders[0]['userid'],$allorders[0]['package_id']); 
       }

                /*echo "<pre>";
                print_r($Userpackages);
                exit();*/
				

			$this->template->set('userpackage', $Userpackages); 
			$this->template->set('orders',$orders);
			//$this->template->set('logs',$logs);
			//$this->template->set('bill',$bill);
			$this->template->set ( 'description', '' );
			//$this->template->set ( 'page', 'home' );
			$this->template->set_theme('default_theme');
			$this->template->set_layout ('default')
			->title ( 'bikeDoctor' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('order/ongoing-orders');
		}else{
			redirect(base_url ());
		}
	}
	public function History() {				
		$id=$_SESSION['olouserid'];
		
		if(!empty($id)){
			$this->load->library ( 'zyk/UserLib' );				
			$order = $this->userlib->getOrderhistory($id);	
		//echo '<pre>';	print_r($order);  echo '</pre>'; exit;	
		 
			 $orderids = "";
			 foreach ($order as  $value) {
			 	# code...
			 	$orderids.=$value['orderid'].',';
			 }

			 $allorderids = rtrim($orderids,',');

			  
			$this->load->library('zyk/OrderLib');
			$allorders = $this->orderlib->getAllInvoiceOrderDetails($allorderids);
  
			/*echo "<pre>";
            print_r($allorders);
            exit();*/
 
			$this->template->set('allorders', $allorders);  
			$this->template->set('orders',$order);
			$this->template->set ( 'description', '' );
		//	$this->template->set_layout (false);
			$this->template->set_layout ('default')
			->title ( 'bikeDoctor' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('order/order-history');
		}else{
			redirect(base_url ());
		}
	}

	public function Notification() {
		//$this->template->set ( 'page', 'home' );
		//$this->template->set_theme('default_theme');
		$uid = $_SESSION ['olouserid'];
		if(!empty($uid)){
			$this->load->library ( 'zyk/UserLib' );
			$detail = $this->userlib->getNotification($uid);
			$this->template->set('detail',$detail);
			$this->template->set ( 'description', '' );
			$this->template->set_layout (false);
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/notification');
		}else{
			redirect(base_url ());
		}
	}
	
	 
	public function Wallet() {
	    $userid = $_SESSION['olouserid'];
	    $this->load->library ( 'zyk/UserLib' );
	    if(!empty($userid)){
		    $balance = $this->userlib->getWalletBalance($userid);
		    $wallet_history =  $this->userlib->getWalletTransactions($userid);
		    	if(!empty($balance)){
		    		$balance = $balance;
		    	}else{
		    		$balance[0]['amount'] = 0;
		    	}
		    	/* if(!empty($wallet_history)){
		    		$wallet_history = $wallet_history;
		    	}else{
		    		$wallet_history = '';
		    	} */
		    $this->template->set('balance',$balance);
		    $this->template->set('wallet_history',$wallet_history);
		    $this->template->set ( 'description', '' );
		    $this->template->set_layout (false);
		    $this->template->set_layout ('default')
		    ->title ( 'Garage2Ghar' )
		    ->set_partial ( 'header', 'partials/header' )
		    ->set_partial ( 'footer', 'partials/footer' );
		    $this->template->build ('Order/wallets');
	    }else{
	    	redirect(base_url ());
	    }
	}
	
	public function Setting() {
		$id=$_SESSION['olouserid'];
		if(!empty($id)){
			//$this->template->set ( 'page', 'home' );
			//$this->template->set_theme('default_theme');
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->getUser($id);
			$user1 = $this->userlib->getUser1($id);
			$this->template->set('user',$user);
			$this->template->set('user1',$user1);
			$this->template->set ( 'description', '' );
			$this->template->set_layout (false);
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/settings');
		}else{
			redirect(base_url ());
		}
	}
	
	public function Offer() {
 		$id=$_SESSION['olouserid'];
 		if(!empty($id)){
	 		$this->load->library ( 'zyk/UserLib' );
 			$refcode = $this->userlib->getReferCode($id);
	 		$this->template->set('refcode',$refcode);
			$this->template->set ( 'description', '' );
			$this->template->set_theme('default_theme');
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/offer');
		}else{
			redirect(base_url ());
		}
	}
	
	public function Userupdate()
	{
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('fname').' '. $this->input->post('lname');
		$params['email'] = $this->input->post('email');
		$params['mobile'] = $this->input->post('mobile');
		$params['original'] = $this->input->post('password');
		$params['password'] = md5($this->input->post('password'));
		//$params['address'] = $this->input->post('address');
		$params['model'] = $this->input->post('model');
		$params['vehicle_no'] = $this->input->post('vehicleno');
		
		$params1 = array();
		$params1['id'] = $this->input->post('id');
		$params1['model'] = $this->input->post('model1');
		$params1['vehicle_no'] = $this->input->post('vehicleno1');
		$this->load->library ( 'zyk/UserLib' );
		$register = $this->userlib->updateUser1( $params );
		$register1 = $this->userlib->updateUser2( $params1 );
		$response['status'] = 1;
		$response['msg'] = "User updated successfully.";
		echo json_encode($response);
	}
	
	/*public function booking() {  
 		$this->load->library('zyk/ServiceLib', 'servicelib');
		$brandList = $this->servicelib->getBrandId('9'); 
		$_SESSION['category_id'] = '9'; 
		$this->template->set('brandList',$brandList);  
  	    $this->template->set ( 'page', 'booking-flow/select-brand' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
 		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
 		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/booking');
		
	}*/



	public function selectBrand() {   
  		$this->load->library('zyk/ServiceLib', 'servicelib');
		$brandList = $this->servicelib->getBrandId('9'); 
   		$_SESSION['category_id'] = '9'; 
    		/*$this->session->unset_userdata('brand_id'); 
   		$this->session->unset_userdata('model_id'); 
   		$this->session->unset_userdata('subcategory_id');
   		$this->session->unset_userdata('catsubcat_id'); 
   		exit();*/


   		//print_r($this->session->userdata());
    		//$this->session->unset_userdata('category_id'); 
 
		$this->template->set('brandList',$brandList);  
  	    $this->template->set ( 'page', 'booking-flow/select-brand' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
 		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
 		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/booking');
		
	}

	public function selectModel() {
		/*$this->session->unset_userdata('model_id'); 
   		$this->session->unset_userdata('subcategory_id');
   		$this->session->unset_userdata('catsubcat_id');*/

  		$this->load->library('zyk/ServiceLib', 'servicelib'); 
		//save brand into session
 	 	echo $data['brand_id']    = $this->session->userdata('brand_id');
	 	$modelList = $this->servicelib->getModelbyBrandId1($data['brand_id']);  

	 	$this->template->set ('modelList',$modelList);
 	    $this->template->set ( 'page', 'booking-flow/select-modal' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-modal');
		
	}

	public function selectSubcategory() {
		/*$this->session->unset_userdata('subcategory_id');
   		$this->session->unset_userdata('catsubcat_id');*/

  		$this->load->library('zyk/ServiceLib', 'servicelib'); 
		//get subcategory list
		  //$model_id = $_SESSION['model_id'];

		$subcategoryList = $this->servicelib->getActiveSubcategory(); 
  		$this->template->set('subcategoryList',$subcategoryList);

	    $this->template->set ( 'page', 'booking-flow/select-subcategory' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
 		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
 		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-subcategory'); 
	}

	public function selectServices() {  

		//$this->session->unset_userdata('catsubcat_id');

		$this->load->library('zyk/ServiceLib', 'servicelib'); 
		//get subcategory list   
		$data['sub_id'] = $_SESSION['subcategory_id']; 
		$data['brand_id'] = $_SESSION['brand_id']; 
		$data['model_id'] = $_SESSION['model_id']; 
		$data['category_id'] = $_SESSION['category_id'];  
		$data['vehicle_no'] = $_SESSION['vehicle_no'];
	//get main subcategory id from subcategory table  

 		$subcategory_id = $this->servicelib->getSubcatId_new($data); 
 
 		$data['subcategory_id'] = $subcategory_id;
 
 		$catsubcatList = $this->servicelib->getServiceGroup( $data ); 

		$vehicle_id = $_SESSION['vehicle_no']; 

		$vehicle =$this->db->select('a.*,b.name as model_name,c.name as brand_name')
                    ->from('tbl_user_vehicles AS a')
                    ->join('manufacturer AS b', 'a.model_id = b.id', 'inner')
                    ->join('brand AS c', 'a.brand_id = c.id', 'inner')
                    ->where('a.id',$vehicle_id)->where('a.status', '1')->group_by('a.id')
                    ->get()->result_array();
 
 		//$catsubcatList = array(); 
  

 		// if(isset($subcategory_id)){
 		// 	$catsubcatList = $this->servicelib->getCatsubcatid1($subcategory_id);  

 		// }
 		 


 		$this->template->set('vehicle_number',$vehicle[0]['vehicle_no']); 
 		$this->template->set('vehicle_brand',$vehicle[0]['brand_name']);
 		$this->template->set('vehicle_model',$vehicle[0]['model_name']);
  		$this->template->set( 'catsubcatList',$catsubcatList);
	    $this->template->set( 'page', 'booking-flow/select-part');
		$this->template->set( 'description', '' );
		$this->template->set( 'keywords', '' );
		$this->template->set_theme('default_theme');
 		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
 		->set_partial ( 'header', 'partials/header' )
 				->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-catsubcat'); 
	}

	public function selectPackage() { 

		    $id =$_SESSION['olouserid'];  
		    $vehicle_no = $_SESSION['vehicle_no'];
 			if(!empty($id)){

 			$this->load->library('zyk/SearchLib','searchlib'); 	
 			$mypackages=$this->searchlib->getmypackageNew($id,$vehicle_no);
 		 
		    $packageids="";
			//$mahesh=1;
			foreach ($mypackages as $value) {  
				$packageids.=$value['package_id']. ','; 
			} 
			$packageid=rtrim($packageids,","); 

			$this->template->set('mypackages',$mypackages);
		    }  

		    $mypackageid = $packageid;
		    
 		$this->load->library('zyk/ServiceLib', 'servicelib'); 
		//get subcategory list   
		$data['sub_id'] = $_SESSION['subcategory_id']; 
		$data['brand_id'] = $_SESSION['brand_id']; 
		$data['model_id'] = $_SESSION['model_id'];  
		$data['category_id'] = $_SESSION['category_id'];  
		//get main subcategory id from subcategory table 

		$packages = array();
		$this->load->library('zyk/SearchLib','searchlib'); 
 		//$packages = $this->searchlib->getPackageByModelId($data);  
 		$packages = $this->searchlib->getRecommendedPackageByModelId($data,$mypackageid);  

 		/*echo "<pre>";
 		print_r($packages);
 		exit();*/ 

 		$vehicle_id = $_SESSION['vehicle_no']; 
		 
		$vehicle =$this->db->select('a.*,b.name as model_name,c.name as brand_name')
                    ->from('tbl_user_vehicles AS a')
                    ->join('manufacturer AS b', 'a.model_id = b.id', 'inner')
                    ->join('brand AS c', 'a.brand_id = c.id', 'inner')
                    ->where('a.id',$vehicle_id)->where('a.status', '1')->group_by('a.id')
                    ->get()->result_array();

 		$this->template->set('vehicle_number',$vehicle[0]['vehicle_no']); 	
 		$this->template->set('vehicle_brand',$vehicle[0]['brand_name']);
 		$this->template->set('vehicle_model',$vehicle[0]['model_name']); 
  		$this->template->set( 'packages',$packages);
	   // $this->template->set( 'page', 'booking-flow/select-package');
	    $this->template->set( 'page', 'my-profile/my-packages');
		$this->template->set( 'description', '' );
		$this->template->set( 'keywords', '' );
		$this->template->set_theme('default_theme');
 		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
 		->set_partial ( 'header', 'partials/header' )
 				->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-package'); 
	} 
	
	public function selectAdd() {
		 
		 $userdata['name'] = $this->session->userdata('olousername');
		 $userdata['email'] = $this->session->userdata('olouseremail');
		 $userdata['mobile'] = $this->session->userdata('olousermobile');

		 
		 $package_id  =$_SESSION['package_id']; 
		 $catsubcat_id=$_SESSION['catsubcat_id'];  

		 
 			if(!empty($catsubcat_id)){  
 
			$catsubcat = $this->db->select('*')->from('category_subcat')->where_in('id',$catsubcat_id)->get()->result_array(); 
		 
			$this->template->set('catsubcat',$catsubcat);
		    } 
		    if(!empty($package_id)){  
 
			$package = $this->db->get_where('packages',array('id'=>$package_id))->result_array();
			if(!empty($package))
			{
				$result = $this->db->select('a.name')
								   ->from('service as a')
								   ->join('package_services as b','a.id = b.service_id','inner')
								   ->where('b.package_id',$package_id)
								   ->get()
								   ->result_array();
				$package[0]['services'] = $result;
			}
		 

			/*echo '<pre>';
			print_r($package); 
			exit;*/

			$this->template->set('package',$package);
		    } 


		$vehicle_id = $_SESSION['vehicle_no']; 
		$vehicle = $this->db->select('vehicle_no')->from('tbl_user_vehicles')->where('id',$vehicle_id)->get()->result_array(); 

		$subcategory_id = $_SESSION['subcategory_id']; 
		$subcategory = $this->db->select('name')->from('static_subcategory')->where('id',$subcategory_id)->get()->result_array(); 
 
 		$this->template->set('service_type',$subcategory[0]['name']);
 		$this->template->set('vehicle_number',$vehicle[0]['vehicle_no']);  
 		$this->template->set('userdata',$userdata);
	    $this->template->set ( 'page', 'booking-flow/select-address' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-address');
		
	}
	public function selectUserAdd() {
		 redirect('select-subcategory');    
		 $userdata['name'] = $this->session->userdata('olousername');
		 $userdata['email'] = $this->session->userdata('olouseremail');
		 $userdata['mobile'] = $this->session->userdata('olousermobile'); 

		$user_id = $_SESSION['olouserid']; 
		 
		$package_id = $_SESSION['package_id']; 

		$vehiclelist = $this->db->select('*')->from('tbl_user_vehicles')->where('user_id',$user_id)->where('status', 1)->get()->result_array(); 

		if(!empty($package_id)){  
 
			$package = $this->db->get_where('packages',array('id'=>$package_id))->result_array();
			if(!empty($package))
			{
				$result = $this->db->select('a.name')
								   ->from('service as a')
								   ->join('package_services as b','a.id = b.service_id','inner')
								   ->where('b.package_id',$package_id)
								   ->get()
								   ->result_array();
				$package[0]['services'] = $result;
			}
		 

			/*echo '<pre>';
			print_r($package); 
			exit;*/

			$this->template->set('package',$package);
		    } 
               $package_model = $this->db->select('model_id')->from('package_models')->where('package_id', $package_id)->get()->result_array(); 
               
//               foreach ($package_model as $value) {
//                  foreach ($vehiclelist as $key => $val) {
//                      if($value['model_id'] != $val['model_id']){
//                          unset($vehiclelist[$key]);
//                      }
//                  } 
//               }
 		
 		$this->template->set('vehiclelist', $vehiclelist);  
 		$this->template->set('userdata',$userdata);
	        $this->template->set ( 'page', 'booking-flow/select-address' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-user-address');
		
	}

	public function setBrand(){ 
 		$this->session->set_userdata('brand_id',$this->input->post('brand_id'));
		$response = array('msg'=>'Brand added in session','status'=>1);
		echo json_encode($response); 
 	}

	public function setModel(){ 
 		$this->session->set_userdata('model_id',$this->input->post('model_id')); 
		$response = array('msg'=>'Model added in session','status'=>1);
		echo json_encode($response); 
 	}

 	public function setSub(){ 
 		$this->session->set_userdata('subcategory_id',$this->input->post('subcategory_id')); 
		$response = array('msg'=>'Subcategory added in session','status'=>1);
		echo json_encode($response); 
 	}
 	public function setCatsubcat(){  
 		$this->session->set_userdata('package_id', ''); 

 		$this->session->set_userdata('catsubcat_id', $this->input->post('catsubcat_id'));  
		$response = array('msg'=>'Catsubcat added in session','status'=>1);
		echo json_encode($response); 
 	}

 	public function setPackage(){ 
 		//$this->load->library('zyk/SearchLib');
 		$package_id = $this->input->post('package_id');
 		 		//$this->session->set_userdata('catsubcat_id', '');  
 		$this->session->set_userdata('catsubcat_id', $this->input->post('catsubcat_id')); 
 		//$userid = $this->session->userdata('olouserid');
 		//get package data
 				//$packageData = $this->searchlib->getPackageDetailsbyId($package_id);
  		//get package usages
 				//$packageUsages = $this->searchlib->getPackageUsagesByUser($package_id,$userid,$packageData['year']);
 
 				//check count with year 

 				/*if($packageUsages['count']<$packageData['service_used_validity']){
					$this->session->set_userdata('package_id', $this->input->post('package_id')); 
					$response = array('msg'=>'Package  added ','status'=>1);
 				}else{
 					$response = array('msg'=>"Package is valid {$packageData['service_used_validity']} times  added in session",'status'=>1); 
 				} 
  		*/

  		$this->session->set_userdata('package_id', $this->input->post('package_id')); 
  			$response = array('msg'=>'Package  added ','status'=>1);
		echo json_encode($response); 
 	} 
 	
 	public function setData(){   

 		//print_r($this->input->post());exit();
 		$this->session->set_userdata('name', $this->input->post('name'));
 		$this->session->set_userdata('email', $this->input->post('email')); 
 		$this->session->set_userdata('mobile', $this->input->post('mobile')); 
 		$this->session->set_userdata('visit_date', $this->input->post('visit_date')); 
 		$this->session->set_userdata('visit_time', $this->input->post('visit_time')); 
 		$this->session->set_userdata('flat', $this->input->post('flat')); 
 		$this->session->set_userdata('landmark', $this->input->post('landmark'));  
		$this->session->set_userdata('latitude', $this->input->post('latitude'));
		$this->session->set_userdata('longitude', $this->input->post('longitude')); 

		//print_r($_SESSION);exit();
		$response = array('msg'=>'Data added in session','status'=>1);
		echo json_encode($response);   
 	} 

	public function bookingSummary() {
 
		$vehicle_id = $_SESSION['vehicle_no']; 
		$vehicle = $this->db->select('vehicle_no')->from('tbl_user_vehicles')->where('id',$vehicle_id)->get()->result_array(); 

		$subcategory_id = $_SESSION['subcategory_id']; 
		$subcategory = $this->db->select('name')->from('static_subcategory')->where('id',$subcategory_id)->get()->result_array();


 
 		$this->template->set('service_type',$subcategory[0]['name']);
 		$this->template->set('vehicle_number',$vehicle[0]['vehicle_no']);
	    $this->template->set ( 'page', 'booking-flow/Booking-summary' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/Booking-summary');
		
	}

	public function thankyou() {
	    $this->template->set ( 'page', 'booking-flow/thank-you' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/thank-you');
		
	}

	public function bookingFail() {
	    $this->template->set ( 'page', 'booking-flow/booking-failed' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/booking-failed');
		
	}
	public function selectVehicle() { 

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$this->load->library('zyk/ServiceLib', 'servicelib');

		 //get vehical list
		$user_id = $_SESSION['olouserid']; 
		$vehicalList = $this->vehicallib->getVehicalList($user_id);  
  		$brands = $this->vehicallib->getActiveBikeBrands(); 
        $models = $this->servicelib->getActiveModels();


        $this->template->set('brands',$brands); 
        $this->template->set('models',$models); 
        $this->template->set('vehicalList',$vehicalList); 
	    $this->template->set ( 'page', 'booking-flow/select-vehicle' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/select-vehicle');
	}

	public function addVehicle(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid']; 

        $params['user_id'] = $user_id; 
        $params['vehical_no'] = $this->input->post('vehicle_no');
        $params['brand_id'] = $this->input->post('brand_id');
        $params['model_id'] = $this->input->post('model_id'); 
        $params['license_number'] = $this->input->post('license_number'); 
        $params['insurance_brand'] = $this->input->post('insurance_brand'); 
        $params['insurance_number'] = $this->input->post('insurance_number'); 
        
        $params['status'] =   1 ;   
        $params['created_datetime'] = date('Y-m-d H:i:s');   

        /*echo "<pre>";
        print_r($params);
        exit();
*/
        $response = $this->vehicallib->AddVehical($params); 
        echo json_encode($response);  
	}
	public function setVehical(){  
		$this->session->set_userdata('vehicle_no',$this->input->post('vehicle_no'));
 		$this->session->set_userdata('model_id',$this->input->post('model_id'));
 		$this->session->set_userdata('brand_id',$this->input->post('brand_id')); 
 		$this->session->set_userdata('subcategory_id',$this->input->post('subcategory_id')); 
 
		$response = array('msg'=>'Vehicle added in session','status'=>1); 
		echo json_encode($response); 
 	}
 	public function editVehicle(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid']; 

        $params['user_id'] = $user_id; 
        $params['id'] = $this->input->post('id1'); 
        $params['vehicle_no'] = $this->input->post('vehicle_no1');
        $params['brand_id'] = $this->input->post('brand_id1');
        $params['model_id'] = $this->input->post('model_id1'); 
        $params['license_number'] = $this->input->post('license_number1'); 
        $params['insurance_brand'] = $this->input->post('insurance_brand1'); 
        $params['insurance_number'] = $this->input->post('insurance_number1'); 
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
	public function addLicense(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid']; 
        $user_name = $_SESSION['olousername'];
        
        $params['user_id'] = $user_id;  
        $images = array();
        if(!empty($_FILES['licensefiles']['name'])){ 
            $files = $_FILES; 
                if($files['licensefiles']['name'] != '') {
                    $_FILES['image_single']['name'] = $files['licensefiles']['name'];
                    $_FILES['image_single']['type'] = $files['licensefiles']['type'];
                    $_FILES['image_single']['tmp_name'] = $files['licensefiles']['tmp_name'];
                    $_FILES['image_single']['error'] = $files['licensefiles']['error'];
                    $_FILES['image_single']['size'] = $files['licensefiles']['size'];

                    $imageid = $user_name.'_DL'.mt_rand(10000,99999);
                    $location = 'assets/images/vehicles_documents/';
                    $item = uploadImage($_FILES['image_single'], $location, array('jpeg', 'jpg', 'png', 'gif', 'pdf','docx'), 2097152, ''.$imageid.'');
                    if($item['status'] == 1){
                        $images = $item['image'];
                    }
                }    
         }  

         $fullpath =  asset_url().$images;

         $params['license_url'] =  $fullpath;
        /*echo "<pre>";
        print_r($params);
        exit();*/

        $response = $this->vehicallib->addLicense($params); 
        echo json_encode($response);  
	}
		public function delete_license_by_id() {
		$user_id = $this->input->post('Id');  
		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$result = $this->vehicallib->delete_license_by_id($user_id);
		if ($result['status'] == 1) {
			$response['status'] = 1;
			$response['msg'] = "License deleted successfully"; 
		} else { 
			$response['status'] = 0; 
			$response['msg'] = "Error occured";
		}
		echo json_encode($response);
	}
	public function editLicense(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid']; 
        $user_name = $_SESSION['olousername'];
       
        $params['user_id'] = $user_id;   

        $images = array();
        if(!empty($_FILES['licensefile']['name'])){ 
            $files = $_FILES; 
                if($files['licensefile']['name'] != '') {
                    $_FILES['image_single']['name'] = $files['licensefile']['name'];
                    $_FILES['image_single']['type'] = $files['licensefile']['type'];
                    $_FILES['image_single']['tmp_name'] = $files['licensefile']['tmp_name'];
                    $_FILES['image_single']['error'] = $files['licensefile']['error'];
                    $_FILES['image_single']['size'] = $files['licensefile']['size'];

                    $imageid = $user_name.'_DL'.mt_rand(10000,99999);
                    $location = 'assets/images/vehicles_documents/';
                    $item = uploadImage($_FILES['image_single'], $location, array('jpeg', 'jpg', 'png', 'gif', 'pdf','docx'), 2097152, ''.$imageid.'');
                    if($item['status'] == 1){
                        $images = $item['image'];
                    }
                }    
         }  

         $fullpath =  asset_url().$images;

        $params['license_url'] =  $fullpath; 
 
        $response = $this->vehicallib->updateLicense($params); 
        echo json_encode($response);  
	}
	public function addVehicleRC(){
		/*echo "<pre>";
		print_r($_POST);
		exit;*/
		/*
				[vehicle_id] => 25
    [vehicle_no] => MH 12 AQ 1212
    [document_type] => 1
		*/
		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid']; 
        $user_name = $_SESSION['olousername'];
        
        $params['user_id'] = $user_id;  

		$params['vehicle_id'] = $this->input->post('vehicle_id'); 
		$params['type'] =  $this->input->post('document_type');
		
		if($params['type'] == 1)
		{
			$params['document_name'] = $user_name.'-Rc';
		}
		else if($params['type'] == 2){
			$params['document_name'] = $user_name.'-Insurance';
		}
		else if($params['type'] == 3){
			$params['document_name'] = $user_name.'-Puc';
		}

		$vehicleno = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $this->input->post('vehicle_no'))); 
		$params['created_datetime'] = date('Y-m-d H:i:s'); 

        $images = array();
        if(!empty($_FILES['register_certificate']['name'])){ 
            $files = $_FILES; 
                if($files['register_certificate']['name'] != '') {
                    $_FILES['image_single']['name'] = $files['register_certificate']['name'];
                    $_FILES['image_single']['type'] = $files['register_certificate']['type'];
                    $_FILES['image_single']['tmp_name'] = $files['register_certificate']['tmp_name'];
                    $_FILES['image_single']['error'] = $files['register_certificate']['error'];
                    $_FILES['image_single']['size'] = $files['register_certificate']['size'];

                    $imageid = $vehicleno.mt_rand(10000,99999);
                    $location = 'assets/images/vehicles_documents/';
                    $item = uploadImage($_FILES['image_single'], $location, array('jpeg', 'jpg', 'png', 'gif', 'pdf','docx'), 2097152, ''.$imageid.'');
                    if($item['status'] == 1){
                        $images = $item['image'];
                    }
                }    
         }  

        $fullpath =  asset_url().$images;
        $params['url'] =  $fullpath;
        $response = $this->vehicallib->addVehicleRC($params); 
        echo json_encode($response);  
	}
	public function editVehicleRC(){
	
		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid'];  
        $user_name = $_SESSION['olousername']; 
       
        $params['user_id'] = $user_id;  
        $params['id'] = $this->input->post('rc_id');
		$params['vehicle_id'] = $this->input->post('vehicle_id'); 

		$vehicleno = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $this->input->post('vehicle_no'))); 
		$params['updated_datetime'] = date('Y-m-d H:i:s'); 
	
        $images = array();
        if(!empty($_FILES['otherfiles']['name'])){ 
   
            	$files = $_FILES; 
                if($files['otherfiles']['name'] != '') {
                    $_FILES['image_single']['name'] = $files['otherfiles']['name'];
                    $_FILES['image_single']['type'] = $files['otherfiles']['type'];
                    $_FILES['image_single']['tmp_name'] = $files['otherfiles']['tmp_name'];
                    $_FILES['image_single']['error'] = $files['otherfiles']['error'];
                    $_FILES['image_single']['size'] = $files['otherfiles']['size'];

                    $imageid = $vehicleno.mt_rand(10000,99999);
                    $location = 'assets/images/vehicles_documents/';
                    $item = uploadImage($_FILES['image_single'], $location, array('jpeg', 'jpg', 'png', 'gif', 'pdf','docx'), 2097152, ''.$imageid.'');
                    if($item['status'] == 1){
                        $images = $item['image'];
                    }
                }    
         }  

         $fullpath =  asset_url().$images;

         $params['url'] =  $fullpath;
 
        $response = $this->vehicallib->updateVehicleRC($params); 
        echo json_encode($response); 
        //echo json_encode(array('status'=>0,'msg'=>"updated successfully..!!"));  
	}
	public function delete_rc_by_id() {
		$Id = $this->input->post('Id'); 
 
		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$result = $this->vehicallib->delete_rc_by_id($Id);
		if ($result['status'] == 1) {
			$response['status'] = 1;
			$response['msg'] = "Document deleted successfully"; 
		} else { 
			$response['status'] = 0; 
			$response['msg'] = "Error occured";
		}
		echo json_encode($response);
	}
	public function addInsurance(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid']; 
        $user_name = $_SESSION['olousername'];
        
        $params['user_id'] = $user_id;  

		$params['vehicle_id'] = $this->input->post('vehicle_id'); 
		$params['type'] = 2 ;
		$vehicleno = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $this->input->post('vehicle_no'))); 
		$params['created_datetime'] = date('Y-m-d H:i:s'); 
		$params['document_name'] = $user_name;
		
        $images = array();
        if(!empty($_FILES['Insurance']['name'])){ 
            $files = $_FILES; 
                if($files['Insurance']['name'] != '') {
                    $_FILES['image_single']['name'] = $files['Insurance']['name'];
                    $_FILES['image_single']['type'] = $files['Insurance']['type'];
                    $_FILES['image_single']['tmp_name'] = $files['Insurance']['tmp_name'];
                    $_FILES['image_single']['error'] = $files['Insurance']['error'];
                    $_FILES['image_single']['size'] = $files['Insurance']['size'];

                    $imageid = $vehicleno.'_Insurance'.mt_rand(10000,99999);
                    $location = 'assets/images/vehicles_documents/';
                    $item = uploadImage($_FILES['image_single'], $location, array('jpeg', 'jpg', 'png', 'gif', 'pdf','docx'), 2097152, ''.$imageid.'');
                    if($item['status'] == 1){
                        $images = $item['image'];
                    }
                }    
         }  

         $fullpath =  asset_url().$images;

         $params['url'] =  $fullpath;
        /*echo "<pre>";
        print_r($params);
        exit();*/

        $response = $this->vehicallib->addVehicleInsurance($params); 
        echo json_encode($response);  
	}
	public function editInsurance(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid'];  
       
        $params['user_id'] = $user_id;  
        $params['id'] = $this->input->post('insurance_id');
		$params['vehicle_id'] = $this->input->post('vehicle_id'); 
		$params['type'] = 2 ;
		$vehicleno = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $this->input->post('vehicle_no'))); 
		$params['updated_datetime'] = date('Y-m-d H:i:s'); 

        $images = array();
        if(!empty($_FILES['Insurance']['name'])){ 
            $files = $_FILES; 
                if($files['Insurance']['name'] != '') {
                    $_FILES['image_single']['name'] = $files['Insurance']['name'];
                    $_FILES['image_single']['type'] = $files['Insurance']['type'];
                    $_FILES['image_single']['tmp_name'] = $files['Insurance']['tmp_name'];
                    $_FILES['image_single']['error'] = $files['Insurance']['error'];
                    $_FILES['image_single']['size'] = $files['Insurance']['size'];

                    $imageid = $vehicleno.'_Insurance'.mt_rand(10000,99999);
                    $location = 'assets/images/vehicles_documents/';
                    $item = uploadImage($_FILES['image_single'], $location, array('jpeg', 'jpg', 'png', 'gif', 'pdf','docx'), 2097152, ''.$imageid.'');
                    if($item['status'] == 1){
                        $images = $item['image'];
                    }
                }    
         }  

         $fullpath =  asset_url().$images;

         $params['url'] =  $fullpath;
 
        $result = $this->vehicallib->updateVehicleInsurance($params); 
        
       	if ($result['status'] == 1) {
			$response['status'] = 1;
			$response['msg'] = "Document updated successfully"; 
		} else { 
			$response['status'] = 0; 
			$response['msg'] = "Error occured";
		} 

        echo json_encode($response);  
	}
	public function delete_insurance_by_id() {
		$user_id = $this->input->post('Id');  
		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$result = $this->vehicallib->delete_insurance_by_id($user_id);
		if ($result['status'] == 1) {
			$response['status'] = 1;
			$response['msg'] = "Insurance deleted successfully"; 
		} else { 
			$response['status'] = 0; 
			$response['msg'] = "Error occured";
		}
		echo json_encode($response);
	}

	public function addPuc(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid']; 
        $user_name = $_SESSION['olousername'];
        
        $params['user_id'] = $user_id;  

		$params['vehicle_id'] = $this->input->post('vehicle_id'); 
		$params['type'] = 3 ;

		$vehicleno = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $this->input->post('vehicle_no'))); 
		$params['created_datetime'] = date('Y-m-d H:i:s'); 
		$params['document_name'] = $user_name; 
		


        $images = array();
        if(!empty($_FILES['Puc']['name'])){ 
            $files = $_FILES; 
                if($files['Puc']['name'] != '') {
                    $_FILES['image_single']['name'] = $files['Puc']['name'];
                    $_FILES['image_single']['type'] = $files['Puc']['type'];
                    $_FILES['image_single']['tmp_name'] = $files['Puc']['tmp_name'];
                    $_FILES['image_single']['error'] = $files['Puc']['error'];
                    $_FILES['image_single']['size'] = $files['Puc']['size'];

                    $imageid = $vehicleno.'_PUC'.mt_rand(10000,99999);
                    $location = 'assets/images/vehicles_documents/';
                    $item = uploadImage($_FILES['image_single'], $location, array('jpeg', 'jpg', 'png', 'gif', 'pdf','docx'), 2097152, ''.$imageid.'');
                    if($item['status'] == 1){
                        $images = $item['image'];
                    }
                }    
         }  

         $fullpath =  asset_url().$images;

         $params['url'] =  $fullpath;
        /*echo "<pre>";
        print_r($params);
        exit();*/

        $response = $this->vehicallib->addVehiclePuc($params); 
        echo json_encode($response);  
	}
	public function editPuc(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid'];  
       
        $params['user_id'] = $user_id;  
        $params['id'] = $this->input->post('puc_id');
		$params['vehicle_id'] = $this->input->post('vehicle_id'); 
		$params['type'] = 3 ;
		$vehicleno = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $this->input->post('vehicle_no'))); 
		$params['updated_datetime'] = date('Y-m-d H:i:s'); 

        $images = array();
        if(!empty($_FILES['Puc']['name'])){ 
            $files = $_FILES; 
                if($files['Puc']['name'] != '') {
                    $_FILES['image_single']['name'] = $files['Puc']['name'];
                    $_FILES['image_single']['type'] = $files['Puc']['type'];
                    $_FILES['image_single']['tmp_name'] = $files['Puc']['tmp_name'];
                    $_FILES['image_single']['error'] = $files['Puc']['error'];
                    $_FILES['image_single']['size'] = $files['Puc']['size'];

                    $imageid = $vehicleno.'_PUC'.mt_rand(10000,99999);
                    $location = 'assets/images/vehicles_documents/';
                    $item = uploadImage($_FILES['image_single'], $location, array('jpeg', 'jpg', 'png', 'gif', 'pdf','docx'), 2097152, ''.$imageid.'');
                    if($item['status'] == 1){
                        $images = $item['image'];
                    }
                }    
         }  

         $fullpath =  asset_url().$images;

         $params['url'] =  $fullpath;
 
        $response = $this->vehicallib->updateVehiclePuc($params); 
        echo json_encode($response);  
	}
	public function delete_puc_by_id() {
		$user_id = $this->input->post('Id');  
		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$result = $this->vehicallib->delete_puc_by_id($user_id);
		if ($result['status'] == 1) {
			$response['status'] = 1;
			$response['msg'] = "PUC deleted successfully"; 
		} else { 
			$response['status'] = 0; 
			$response['msg'] = "Error occured";
		}
		echo json_encode($response);
	}
	public function addOtherDocuments(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid']; 
        $user_name = $_SESSION['olousername'];
        
        $params['user_id'] = $user_id;  
  
		$params['type'] = NULL ;  
		$params['created_datetime'] = date('Y-m-d H:i:s'); 
		$documentname = $this->input->post('document_name'); 
		$params['document_name'] = $documentname;

        $images = array();
        if(!empty($_FILES['otherfiles']['name'])){ 
            $files = $_FILES; 
                if($files['otherfiles']['name'] != '') {
                    $_FILES['image_single']['name'] = $files['otherfiles']['name'];
                    $_FILES['image_single']['type'] = $files['otherfiles']['type'];
                    $_FILES['image_single']['tmp_name'] = $files['otherfiles']['tmp_name'];
                    $_FILES['image_single']['error'] = $files['otherfiles']['error'];
                    $_FILES['image_single']['size'] = $files['otherfiles']['size'];

                    $imageid = $documentname.'_Other'.mt_rand(10000,99999);
                    $location = 'assets/images/vehicles_documents/';
                  	

                    $item = uploadImage($_FILES['image_single'], $location, array('jpeg', 'jpg', 'png', 'gif', 'pdf','docx'), 2097152, ''.$imageid.'');
                    if($item['status'] == 1){
                        $images = $item['image'];
                    }
                }    
         }  

        $fullpath =  asset_url().$images;

         $params['url'] =  $fullpath;

       
        $response = $this->vehicallib->addOtherDocuments($params); 
        echo json_encode($response);  
	}

	public function editOtherDocuments(){

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$params = array(); 
        
        $user_id = $_SESSION['olouserid']; 
        $user_name = $_SESSION['olousername'];
        
        $params['user_id'] = $user_id;  
  		$params['id'] = $this->input->post('other_id');
		$params['type'] = NULL ;  
		$params['updated_datetime'] = date('Y-m-d H:i:s');  
        $images = array();
        if(!empty($_FILES['otherfiles']['name'])){ 
            $files = $_FILES; 
                if($files['otherfiles']['name'] != '') {
                    $_FILES['image_single']['name'] = $files['otherfiles']['name'];
                    $_FILES['image_single']['type'] = $files['otherfiles']['type'];
                    $_FILES['image_single']['tmp_name'] = $files['otherfiles']['tmp_name'];
                    $_FILES['image_single']['error'] = $files['otherfiles']['error'];
                    $_FILES['image_single']['size'] = $files['otherfiles']['size'];

                    $imageid = $user_name.'_Other'.mt_rand(10000,99999);
                    $location = 'assets/images/vehicles_documents/';
                    $item = uploadImage($_FILES['image_single'], $location, array('jpeg', 'jpg', 'png', 'gif', 'pdf','docx'), 2097152, ''.$imageid.'');
                    if($item['status'] == 1){
                        $images = $item['image'];
                    }
                }    
         }  

         $fullpath =  asset_url().$images;

         $params['url'] =  $fullpath;
        /*echo "<pre>";
        print_r($params);
        exit();*/

        $response = $this->vehicallib->editOtherDocuments($params); 
        echo json_encode($response);  
	}

	public function delete_other_doc_by_id() {
		$id = $this->input->post('Id');  
		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$result = $this->vehicallib->delete_other_doc_by_id($id);
		if ($result['status'] == 1) {
			$response['status'] = 1;
			$response['msg'] = "PUC deleted successfully"; 
		} else { 
			$response['status'] = 0; 
			$response['msg'] = "Error occured";
		}
		echo json_encode($response);
	}


	function get_vehicle_doc() {
		$result['documentList'] = $this->db->select('*')
				         ->from( TABLES::$VEHICLES_DOCUMENTS)
				         ->where('vehicle_id', $_POST['vehicle_id'])
				         ->get()
				         ->result_array();
		$this->load->view('vehicle_doc_modal', $result);		         
	}

	function get_vehicle_all_doc() {
		$user_id = $this->input->post('userId');
		$result['images']  = $this->db->select('*')
				         ->from( TABLES::$VEHICLES_DOCUMENTS)
				         ->where('type', NULL)
				         ->where('user_id',$user_id)
				         ->get()
				         ->result_array();

		$html = $this->load->view('image-modal',$result,TRUE);
		echo json_encode(array('status'=>1,'html'=>$html));		         
	}

	function rename_document(){
		$this->db->set('document_name',$_POST['name']);
		$this->db->where('id',$_POST['Id']);
		$this->db->update('vehicles_documents');

		echo json_encode(array('status'=>1,'msg'=>'document name updated successfully..!!'));exit;
	}

}