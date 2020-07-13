<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
Class Home extends MX_Controller {

	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$this->load->library('zyk/SlotLib', 'slotlib');
	}

//************************* service on functionalities****************************//
	public function index() {

		$brands = $this->servicelib->getActiveBrands();

        $this->template->set ('brands',$brands);
        $this->template->set ( 'packages', $this->get_all_packages());
	    $this->template->set ( 'page', 'home' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'ServiceOn' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('index');
	}

	public function offers()
    {
    	$this->db->select('coupon.*, vendor.image, vendor.garage_name')
         ->from('coupon')
         ->join('vendor', 'coupon.garage_id = vendor.id', 'left');
		$offers = $this->db->get()->result_array();
    	// $offers = $this->db->get('coupon')->result_array();
    	$this->template->set ( 'page', 'offers' );
    	$this->template->set ( 'offers', $offers );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('offers');
    }

    public function booking_received()
    {
    	$this->template->set ( 'page', 'Booking Received' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('booking-received');
    }

    public function aboutus() {
	    $this->template->set ( 'page', 'about-us' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('about-us');

	}

	public function contactus() {
	    $this->template->set ( 'page', 'contact-us' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('contact-us');
	}

	public function faq() {
	    $this->template->set ( 'page', 'FAQ' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('FAQ');

	}
	public function privacypolicy() {
	    $this->template->set ( 'page', 'Privacy-Policy' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('Privacy-Policy');

	}

	public function tandc() {
	    $this->template->set ( 'page', 'Terms and Conditions' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('tandc');

	}

	public function ride_with_us() {
	    $this->template->set ( 'page', 'Ride With Us' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('ride-with-us');

	}

	public function partner_with_us() {
	    $this->template->set ( 'page', 'Partner With Us' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('partner-with-us');

	}


//*************************service on functionalities end****************************//

	public function selectVehicle() {
	    $this->template->set ( 'page', 'booking-flow/select-vehicle' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('booking-flow/select-vehicle');

	}

	public function addOrder() {

		$this->session->set_userdata('name', $this->input->post('name'));
 		$this->session->set_userdata('email', $this->input->post('email'));
 		$this->session->set_userdata('mobile', $this->input->post('mobile'));
 		$this->session->set_userdata('visit_date', $this->input->post('visit_date'));
 		$this->session->set_userdata('visit_time', $this->input->post('visit_time'));
 		$this->session->set_userdata('flat', $this->input->post('flat'));
 		$this->session->set_userdata('landmark', $this->input->post('landmark'));
		$this->session->set_userdata('latitude', $this->input->post('latitude'));
		$this->session->set_userdata('longitude', $this->input->post('longitude'));
		$this->session->set_userdata('coupon_code', $this->input->post('coupon_code'));
		$this->session->set_userdata('redeem_code', $this->input->post('redeem_code'));

		$params = array();
		$notification = array();
		$this->load->library ( 'zyk/UserLib' );
		$address = array();
		$reg = array ();
		$reg ['name']     = trim($_SESSION['name']);
		$reg ['email']    = $_SESSION['email'];
		$reg ['mobile']   = $_SESSION['mobile'];

		/*$reg ['address']  = $this->input->post('flat').', '.$this->input->post('landmark');
		$reg ['landmark'] = $this->input->post('landmark');
		*/
		$reg ['address']  = $_SESSION['flat'].', '.$_SESSION['landmark'];
		$reg ['landmark'] = $_SESSION['landmark'];
		/*$reg ['latitude'] = $_SESSION['latitude'];
		$reg ['longitude'] = $_SESSION['longitude'];*/
		$reg ['latitude'] = $this->input->post('latitude');
		$reg ['longitude'] = $this->input->post('longitude');
		$reg ['source']   = 'Frontend';
		if($reg['latitude'] == '' && $reg['longitude'] == '')
		{
			$response = array('msg'=>"Sorry we are facing some problem while getting your location please re-enter address",'status'=>0);
			echo json_encode($response);exit();
		}
		$this->load->library('zyk/RestaurantLib');
		$vendors = $this->restaurantlib->getSearchedVendor($reg);
		//print_r($vendors);
		//exit;
		if(!empty($vendors))
		{
		//	echo "if";
			$response['status'] = 1;
			$response['msg'] = 'Our service is available for this area.';
			$_SESSION['data'] = $vendors;
			$_SESSION['latitude'] = $reg['latitude'];
			$_SESSION['longitude'] = $reg['longitude'];
			$_SESSION['locality'] = $reg['locality'];
		}
		else
		{
			//	echo "else";
			$response['status'] = 0;
			$response['msg'] = 'Our service is not available for this area.';
			echo json_encode($response);exit();
		}
		//echo json_encode($response);

		$register = $this->userlib->updateUser( $reg );
		$params['userid'] = $_SESSION['olouserid'];
		$params['name']   = $_SESSION['name'];
		$params['email']  = $_SESSION['email'];
		$params['mobile'] = $_SESSION['mobile'];

		$abc= $_SESSION['subcategory_id'];
		if($abc==1)
		{
			if($this->input->post('landmark2')=='')
			{
				$params['landmark'] = $this->input->post('landmark123');
			}else{
				$params['landmark'] = $this->input->post('landmark2');
			}

 			$params['address'] = $this->input->post('flat123');
			$params['slot'] = $this->input->post('visit_time123');

			if(!empty($this->input->post('visit_date123')))
			   $params['pickup_date'] = date('Y-m-d',strtotime($this->input->post('visit_date123')));
			else
			   $params['pickup_date'] = date('Y-m-d');
			   $params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
		}
		else
	    {
			$params['landmark'] = $_SESSION['landmark'];
			$params ['address']  = $_SESSION['flat'].', '.$_SESSION['landmark'];
			$params['slot'] = $_SESSION['visit_time'];
			if(!empty($_SESSION['visit_date']))
				$params['pickup_date'] = date('Y-m-d',strtotime($_SESSION['visit_date']));
			else
			$params['pickup_date'] = date('Y-m-d');
			$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
		}

		if(isset($_SESSION['landmark']))
			$params['locality']  = $_SESSION['landmark'];
		if(isset($_SESSION['latitude']))
			$params['latitude']  = $_SESSION['latitude'];
		if(isset($_SESSION['longitude']))
		    $params['longitude'] = $_SESSION['longitude'];

/*
		if($_SESSION['latitude']!=""){
			$params['latitude']=0;
		}
		if($_SESSION['longitude']!=""){
			$params['longitude']=0;
		}*/
		/*$params['vendor_id'] = $this->input->post('vendor_id');
		$params['other_vendorid'] = $this->input->post('vendor_id1');*/


		$params['vendor_response'] =1;

		//$params['vehicle_id'] =  $_SESSION['vehicle_no'];
		if($_SESSION['vehicle_no']=='')
		{
			$params['vehicle_id'] = $this->input->post('vehicle_no');
		}else{
			$params['vehicle_id'] = $_SESSION['vehicle_no'];
		}

		if($_SESSION['category_id']=='')
		{
		   // $params['category_id'] = $this->input->post('category_id');
		}else{
			$params['category_id'] = $_SESSION['category_id'];
		}
		if($_SESSION['brand_id']=='')
		{
			//$params['brand_id'] = $this->input->post('brand_id');
		}else{
			$params['brand_id'] = $_SESSION['brand_id'];
		}
		if($_SESSION['subcategory_id1']=='')
		{
			//$params['subcategory_id'] = $this->input->post('subcategory_id');
		}else{
			$params['subcategory_id'] = $_SESSION['subcategory_id1'];
		}
		if($_SESSION['model_id']=='')
		{
			//$params['vehicle_model'] = $this->input->post('model_id');
		}else{
			$params['vehicle_model'] = $_SESSION['model_id'];
		}

		//if(!empty($this->input->post('catsubcat_id'))) {
			if($_SESSION['catsubcat_id']=='')
			{
				/*if(!empty($this->input->post('catsubcat_id'))) {
					$catofsubcat = implode(",",$this->input->post('catsubcat_id'));
					$params['catsubcat_id'] = $catofsubcat;
				 }*/
			}else{
				foreach($_SESSION['catsubcat_id'] as $catofsub){
					$user_id = $catofsub;
					$uid[] = $user_id;
				}
				$cat_subcatid = implode(",", $uid);
				$params['catsubcat_id'] = implode(",",$_SESSION['catsubcat_id']);
			}
		//}

		//$option= $this->input->post('discount_type');
			$option = 'promocode';
		    $couponcode = $_SESSION['coupon_code'];
			if($option == 'promocode') {
				if(!empty($couponcode))
					$params['coupon_code'] = $couponcode;
			} else {
				if($option == "credits")
					$params['wallet_discount'] = 1;
			}
		if($_SESSION['redeem_code']=='')
		{

		}else{
			$params['redeem_amount'] = $_SESSION['redeem_code'];
		}
		//print_r($params);exit();


		$params['status'] = 0;
		$params['ordered_on'] = date('Y-m-d H:i:s');
		$params['source'] = 2;
		//$params['package_id'] = $_SESSION['package_id'];
		$params['old_price'] = 0;
		if($_SESSION['package_id']=='')
		{
			$params['package_id'] = $this->input->post('package_id');
			$order_ids = $this->db->get_where('tbl_user_package',array('package_id'=>$params['package_id'],'user_id'=>$params['userid'],'	is_expire'=>1))->row('order_ids');
			if($order_ids == '')
			{
				$pack_price = $this->db->get_where('packages',array('id'=>$params['package_id']))->row('special_price');
				$params['old_price'] = $pack_price;
			}
		}
		else{
			$params['package_id'] = $_SESSION['package_id'];
			$order_ids = $this->db->get_where('tbl_user_package',array('package_id'=>$params['package_id'],'user_id'=>$params['userid'],'	is_expire'=>1))->row('order_ids');
			if($order_ids == '')
			{
				$pack_price = $this->db->get_where('packages',array('id'=>$params['package_id']))->row('special_price');
				$params['old_price'] = $pack_price;
			}
		}

		//$params['package_id'] = $_SESSION['package_id'];

		$sub_id = $_SESSION['subcategory_id'];

		$model_id = $_SESSION['model_id'];

		$this->load->library('zyk/OrderLib');
		$subcategory_id = $this->orderlib->get_subcategory_id_by_modelId($sub_id,$model_id);

		$params['subcategory_id'] = $subcategory_id[0]['id'];

		if($params['subcategory_id']=='')
		{
			$sub_id = $this->input->post('service_type');
			$vehicle_model_id=$this->db->select('model_id')->from('tbl_user_vehicles')->where('id',$params['vehicle_id'])->get()->result_array();
			$model_id = $vehicle_model_id[0]['model_id'];

			$vehicle_brand_id=$this->db->select('brand_id')->from('tbl_user_vehicles')->where('id',$params['vehicle_id'])->get()->result_array();
			$brand_id = $vehicle_brand_id[0]['brand_id'];

			$subcategory_id = $this->orderlib->get_subcategory_id_by_modelId($sub_id,$model_id);

			$params['subcategory_id'] = $subcategory_id[0]['id'];
			$params['vehicle_model'] = $model_id;
			$params['brand_id'] = $brand_id;

		}

		$params['category_id'] = $subcategory_id[0]['category_id'];

		if($params['category_id']=='')
		{
			$params['category_id'] = 9 ;
		}
		if($this->input->post('paymethod') == 1)
		{
			$this->load->library('zyk/OrderLib');
			if($params['package_id']!="")
			{
				$this->load->library('zyk/SearchLib');
				$packageData = $this->searchlib->getPackageDetailsbyId($params['package_id']);
			 	$userid = $this->session->userdata('olouserid');
	 			$packageUsages = $this->searchlib->getPackageUsagesByUser($packageData['id'],$userid);
				if($packageUsages['remaining_service_count']==0 || empty($packageUsages)){
					$this->session->set_userdata('orderData',$params);
					$data1['name'] = $params['name'];
		            $data1['email'] = $params['email'];
		            $data1['mobile'] = $params['mobile'];
		            $data1['amount'] = $packageData['special_price'];
		            $data1['orderid'] = -1;
		            $this->load->library ( 'zyk/PaymentLib' );
		            $url = $this->paymentlib->getPaymentUrl($data1);
		            $response['status'] = 1;
					$response['url'] = $url;
					echo json_encode($response);
					exit;
	 		    }
			}
		}
		$params['is_package_paid'] = 0;

		//$image	= $_FILES ['image'];

        //$arr_images = array();

		/*if(!empty($image))
		{
			$imageid = $params['subcategory_id'].mt_rand(10000,99999);
			$path = "assets/images/booking/$imageid.png";
			$actualpath = base_url().$path;
			file_put_contents($path,base64_decode($image));
                        $arr_images[] = $actualpath;
			//$params['image'] = $actualpath;
		}*/


		$files = $_FILES;
		$cpt = 0;
			if(!empty($_FILES ['image'] ['name']))
			$cpt = count( $_FILES ['image']['name'] );
			$data['images'] = array();
			for($i = 0; $i < $cpt; $i++) {
				$_FILES ['services'] ['name'] = $_FILES ['image'] ['name'] [$i];
				$_FILES ['services'] ['type'] = $_FILES ['image'] ['type'] [$i];
				$_FILES ['services'] ['tmp_name'] = $_FILES ['image'] ['tmp_name'] [$i];
				$_FILES ['services'] ['error'] = $_FILES ['image'] ['error'] [$i];
				$_FILES ['services'] ['size'] = $_FILES ['image'] ['size'] [$i];

				$config = array ();
				$config ['upload_path'] = 'assets/images/booking/';
				$config ['allowed_types'] = 'gif|jpg|png|PNG|JPEG';
				$config ['max_size'] = 204800;
				$config ['max_width'] = 2048;
				$config ['max_height'] = 2048;



				$this->load->library ( 'upload', $config );
				if ( ! $this->upload->do_upload('services')) {
				    $error = array('error' => $this->upload->display_errors());
				    print_r($error);
				} else {
				    	$arr_image ['images'][] = array (
							'documents' => $config ['upload_path'] . '' . $this->upload->data ( 'file_name' )
					);

				}

			}

         foreach ($arr_image['images'] as $value) {
         	$imagepath.= base_url().$value['documents'].',';
         }

       	$fullpath = rtrim($imagepath,',');

		$params['image'] = $fullpath;


		if(empty($params['vehicle_id']))
		{
			$response = array('msg'=>"Vehicle is empty.",'status'=>0);
			echo json_encode($response);exit();
		}
		if(empty($params['subcategory_id']))
		{
			$response = array('msg'=>"Service type is empty.",'status'=>0);
			echo json_encode($response);exit();
		}


		/*echo "<pre>";
		print_r($params);
		exit();*/

		$orderid = $this->orderlib->addOrder($params);

        $oupdate = array();
		$oupdate['orderid'] = $orderid;
		$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36));
		$_SESSION['order_code'] = $oupdate['ordercode'];
 		if($orderid > 0) {
			$params['orderid'] = $orderid;

			//invoice generate and save data

			if($params['package_id']!=""){
 				//new package 1st time changes
					$this->load->library('zyk/SearchLib');
					$packageData = $this->searchlib->getPackageDetailsbyId($params['package_id']);
 				//check previous used
		 			  $userid = $this->session->userdata('olouserid');

		  		//get package usages
 					$packageUsages = $this->searchlib->getPackageUsagesByUser($packageData['id'],$userid);

  				//check count with year
				if($packageUsages['remaining_service_count']==0 || empty($packageUsages)){
 						$this->template->set('order',$params);
						$this->template->set('ordercode',$oupdate['ordercode']);
						$this->template->set('packageData',$packageData);
		 	 			$this->template->set_theme('default_theme');
						$this->template->set_layout (false)
									   ->title ( 'Administrator | Generate Invoice' );
						$html = $this->template->build ('booking-flow/InvoiceDetails','',true);
 		 	 			$file_name = "invoice_package".$oupdate['ordercode'].".pdf";
		 				$this->load->library('MyPdfLib');
						$url = $this->mypdflib->getPdf($html,$file_name);
		  	 			$items = array();
						//insert data into tbl_user_package
						$user_package['user_id'] = $userid;
						$user_package['is_expire'] = 1;
						$user_package['invoice_url'] =$url ;
						$user_package['service_used_validity'] = $packageData['service_used_validity'];
						$user_package['remaining_service_count'] = $packageData['service_used_validity']-1;
						$user_package['created_date'] = date('Y-m-d');
						$user_package['expiry_date'] = date('Y-m-d', strtotime("+{$packageData['year']} years"));
						$user_package['year'] = $packageData['year'];
	 					$user_package['order_ids'] = $orderid;
						$user_package['package_id'] = $packageData['id'];
						$user_package['vehicle_id'] = $params['vehicle_id'];

						 $this->db->insert('tbl_user_package',$user_package);
						 $user_package_id = $this->db->insert_id();


		 	 			foreach ($packageData['services'] as $row) {
								$item = array();
								$item['orderid'] = $orderid;
								$item['service_id'] = $row['id'];
								$item['service_name'] = $row['name'];
								$item['service_price'] = 0;
		 						$item['tax'] = 0;
		 						$item['total_amount'] = 0;
					            $item['is_checked'] = 1 ;
								$item['service'] = 1;
								$item['priority'] = 1;
								$item['is_package_service'] = $user_package_id;
 							    $items[] = $item;
		 					}
		  					$this->db->insert_batch('tbl_booking_services',$items);
		 			//get total amount from the package data

		 			$oupdate['order_amount'] = $packageData['special_price'];
		 			$oupdate['net_total'] = $packageData['special_price'];
		 			$oupdate['grand_total'] = $packageData['special_price'];
		 			$oupdate['discount'] = 0 ;

                                        if($params['package_id'] == PACKAGE_ID1 || $params['package_id'] == PACKAGE_ID2) {
                                            $price = $params['package_id'] == 5 ? 399 : 999;
                                            $this->add_billing_mloyal($params, $orderid, $price);
                                        }


 		 			} else{
 		 				$response = array('msg'=>"Package is already applied.Please buy from myprofile ",'status'=>0);
						echo json_encode($response);
						exit();
 		 			}  //package close


			}
			$params['ordercode'] = $oupdate['ordercode'];
            $this->orderlib->updateOrder($oupdate);
		//set data for the page order,package data,order code
			$this->orderlib->sendBookingEmail($params);
			$this->orderlib->sendBookingSMS($params);
			$response['orderid'] = $orderid;
			$response['status'] = 1;
			$response['msg'] = "Order punched in system";
			$this->session->set_userdata ( 'olouserid', $params['userid'] );
			$this->session->set_userdata ( 'olousername', $reg ['name'] );
			$this->session->set_userdata ( 'olouseremail', $reg ['email'] );
			$this->session->set_userdata ( 'olousermobile', $reg ['mobile'] );
			$_SESSION['orderid']=$orderid ;

			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Booking Request Sent';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 0;
			$logs['created_by'] = 0;

			$this->orderlib->addOrderLogs($logs);
			$this->session->unset_userdata('brand_id');
			$this->session->unset_userdata('model_id');
			$this->session->unset_userdata('vehicle_no');
			$this->session->unset_userdata('subcategory_id');
			$this->session->unset_userdata('catsubcat_id');
			$this->session->unset_userdata('timeslotList');
			$this->session->unset_userdata('time_slot');
			$this->session->unset_userdata('pickup_date');
			$this->session->unset_userdata('coupon_code');
			$this->session->unset_userdata('redeem_amount');
			$this->session->unset_userdata('flat');
			$this->session->unset_userdata('landmark');
			$this->session->unset_userdata('package_id');
			$this->session->unset_userdata('searchid');
			$response['status'] = 1;
			$response['msg'] = "Order punched in system";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Failed to add order";
		}
		echo json_encode($response);
	}

	public function applyCoupon() {

 		$this->load->library('zyk/General');
		$date = $_POST['visit_date'];
		$data = array();
		$userid = $_SESSION['olouserid'];
		$data['email'] = $_SESSION['olouseremail'];
		$sub_id = $_SESSION['subcategory_id'];
		$data['model_id'] = $_SESSION['model_id'];

		$this->load->library('zyk/OrderLib');
		$subcategory_id = $this->orderlib->get_subcategory_id_by_modelId($sub_id,$data['model_id']);

		$data['subcategory_id'] = $subcategory_id[0]['id'];

		$data['coupon_code'] = $this->input->post('coupon_code');
		$data['order_date'] = date('Y-m-d',strtotime($date));
		if($_SESSION['category_id']=='')
		{
			$_SESSION['category_id'] = 9 ;
		}
		$data['category_id'] = $_SESSION['category_id'];
		$data['brand_id'] = $_SESSION['brand_id'];
		$data['catsubcat_id'] = $_SESSION['catsubcat_id'];
		$data['package_id'] = $_SESSION['package_id'];

		$coupon = $this->general->applyCoupon($data);
		echo json_encode($coupon);
	}

	public function applyRedeem() {

		$this->load->library('zyk/General');
		$date = $this->input->post('visit_date');
		$data = array();
		$userid = $_SESSION['olouserid'];
		$data['email'] = $_SESSION['olouseremail'];
		$data['userid'] = $userid;
		$data['redeem_amount'] = $this->input->post('redeem_code');
		$data['order_date'] = date('Y-m-d',strtotime($date));
		$this->load->library ( 'zyk/UserLib' );
		$balance = $this->userlib->getWalletBalance($userid);

		if(!empty($balance)){
			if($balance[0]['amount'] > 0){

				if ($data['redeem_amount'] < 0) {

					$response['status'] = 0;
					$response['msg'] = 'Please enter valid Amount.';
				}
				elseif ($data['redeem_amount'] <= $balance[0]['amount']) {
					$response['status'] = 1;
					$response['msg'] = 'Amount to Redeem '.$data['redeem_amount'];
					$response['redeem_amount'] = $data['redeem_amount'];
				}
				else{
					$response['status'] = 0;
					$response['msg'] = 'You can redeem upto '.$balance[0]['amount'].' only';
				}
			}else{
				$response['status'] = 0;
				$response['msg'] = 'Your Wallet Amount is Empty';
			}
		}else{
			$response['status'] = 0;
			$response['msg'] = 'No wallet Amount present';
		}
		echo json_encode($response);
	}
	public function getredeempoints(){

		$user_id =  $_GET['user_id'];

		$this->load->library ( 'zyk/UserLib' );
		$balance = $this->userlib->getWalletBalance($user_id);

		if(!empty($balance)){
				if($balance[0]['amount'] > 0){

					$response['status'] = 1;
					$response['msg'] = $balance[0]['amount'];
				}
				else
				{
					$response['status'] = 0;
					$response['msg'] = ' Amount is Empty';
				}
		}else{
			$response['status'] = 0;
			$response['msg'] = 'No wallet Amount present';
		}
		echo json_encode($response);

	}


	public function getDeliveryDates() {
		//echo $_GET['date'];
		date_default_timezone_set('asia/kolkata');
		$date = date('Y-m-d', strtotime($_GET['date']));
		$current_date = date('Y-m-d');
		$current_time = date('H:i');
		$current_time_ext = date('H:i',strtotime('+45 minutes'));
		$slots = $this->slotlib->getActiveVisiting1();
		$durArray = array();
		$day = date('D',strtotime($date));
		if($date == date('Y-m-d')) {
			foreach ($slots as $slot) {
				$slot_arr = explode('-',$slot['time_slot']);
				$from_time = date('H:i',strtotime($slot_arr[0]));
				$to_time = date('H:i',strtotime($slot_arr[1]));
				if($current_time < $from_time) {
					$durArray[] = $slot['time_slot'];
				}
			}
		} else {
			foreach ($slots as $slot) {
				$durArray[] = $slot['time_slot'];
			}
		}
		//print_r($durArray);
		$html = "";
		$i =0;
		$_SESSION['timeslotList'] = $durArray ;
		foreach ($durArray as $pickupslot) {
			$a=explode(" ",$pickupslot);
			$i++;
			if($i==1){
				//$html .= '<option value="'.$pickupslot.'">'.$pickupslot.'</option>';
				$html .= '<option value="'.$pickupslot.'">'.$pickupslot.'</option>';
			} else {
				$html .= '<option value="'.$pickupslot.'">'.$pickupslot.'</option>';

			}
		}
		if($html == "") {
			$html = '<option value="">No Slots Available</option>';
		}
		echo $html;
	}

	public function refund() {
	    $this->template->set ( 'page', 'refund-policy' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('refund-policy');

	}
	public function cancellation() {
	    $this->template->set ( 'page', 'cancellation-policy' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('cancellation-policy');

	}
	

	/* My profile */

	/*public function Ongoingorders() {
	    $this->template->set ( 'page', 'my-profile/ongoing-orders' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/ongoing-orders');

	}

	public function Orderhistory() {
	    $this->template->set ( 'page', 'my-profile/order-history' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/order-history');

	}*/

	public function Basicinfo() {
	    $this->template->set ( 'page', 'my-profile/basic-info' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/basic-info');

	}

	public function RefernEarn() {
	    $this->template->set ( 'page', 'my-profile/refer-n-earn' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/refer-n-earn');

	}

	public function Wallet() {
	    $this->template->set ( 'page', 'my-profile/wallet' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/wallet');

	}

	public function Notifications() {
	    $this->template->set ( 'page', 'my-profile/notifications' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/notifications');

	}
	public function ourservices() {
	    $this->template->set ( 'page', 'our-services' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('our-services');

	}
	public function whyUs() {
	    $this->template->set ( 'page', 'why-us' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('why-us');

	}
	/*public function partner() {
	    $this->template->set ( 'page', 'partner-with-us' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('partner-with-us');

	}*/

	public function package() {
		$avpack =array();
        $userid = $_SESSION['olouserid'];
        if($userid !='')
        {
        	$packages = $this->db->select('package_id')->from('tbl_user_package')->where('user_id',$userid)->where('is_expire',1)->group_by('package_id')->get()->result_array();
        	if(!empty($packages)){
        		foreach ($packages as $key => $value) {
        			$avpack[$key] =  $value['package_id'];
        		}
        	}
        }

		$this->load->library('zyk/SearchLib','searchlib');

 		$packagesid=$this->input->get('searchid');
        $this->session->set_userdata('searchid', $packagesid);
        /*$packages = $this->searchlib->getPackageList($packagesid);*/
        if($packagesid !='')
        {
        	$packages = $this->searchlib->getPackageListBySearchid($packagesid);
        }
        else
        {
        	$packages = $this->searchlib->getPackageAllList($packagesid);
        }


		$newData = array();
      	if(!empty($avpack))
      	{
      		$i =0;
      		foreach ($packages as $key => $value) {
      			if(!in_array($value['id'], $avpack))
      			{
      				$newData[$i] = $value;
      				$i++;
      			}
      		}
      	}
      	else{
      		$newData = $packages;
      	}
		/*echo "<pre>";print_r($packages);exit();*/
		$this->template->set('package',$newData);
	    $this->template->set ( 'page', 'booking-flow/package' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'ServiceOn' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/package');

	}
	

	public function enquiryform() {
	    $this->template->set ( 'page', 'enquiry-form' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('enquiry-form');

	}
	public function Bulkbooking() {
	    $this->template->set ( 'page', 'enquiry-form' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('bulk-booking');

	}

    public function get_all_packages() {
        $avpack =array();
        $userid = $_SESSION['olouserid'];
        if($userid !='')
        {
        	$packages = $this->db->select('package_id')->from('tbl_user_package')->where('user_id',$userid)->where('is_expire',1)->group_by('package_id')->get()->result_array();
        	if(!empty($packages)){
        		foreach ($packages as $key => $value) {
        			$avpack[$key] =  $value['package_id'];
        		}
        	}
        }
     	$data = $this->db->select('a.*,c.name as service_name')
                    ->from('packages AS a')
                    ->join('package_services AS b', 'a.id = b.package_id', 'inner')
                    ->join('service AS c', 'c.id = b.service_id', 'inner')
                    ->where('a.status', '1')->group_by('a.id')
                    ->get()->result_array();
      	$result = array();
      	$newData = array();
      	if(!empty($avpack))
      	{
      		$i =0;
      		foreach ($data as $key => $value) {
      			if(!in_array($value['id'], $avpack))
      			{
      				$newData[$i] = $value;
      				$i++;
      			}
      		}
      	}
      	else{
      		$newData = $data;
      	}
    	foreach ($newData as $key => $value) {
        	if(!isset($result[$value['id']])) {
        		$result[$value['id']] = $value;
        	}
        	$result[$value['id']]['services'][] = $value['service_name'] ;
    	}
    	return $result;
    }

	function notFirstOrder()
	{   //pretag($_SESSION);


		$params = array();
		$notification = array();
		$this->load->library ( 'zyk/UserLib' );
		$address = array();
		$reg = array ();
		$reg ['name']     = trim($_SESSION['name']);
		$reg ['email']    = $_SESSION['email'];
		$reg ['mobile']   = $_SESSION['mobile'];
		//$reg ['address']  = $_SESSION['flat'];
		//$reg ['landmark'] = $_SESSION['landmark'];
		$reg ['vehicle_no'] = $_SESSION['plateno'];
		$reg ['address']  = $_SESSION['flat'].', '.$_SESSION['landmark'];
		$reg ['landmark'] = $_SESSION['landmark'];
		/*$reg ['latitude'] = $_SESSION['latitude'];
		$reg ['longitude'] = $_SESSION['longitude'];*/
		$reg ['latitude'] = $this->input->post('latitude');
		$reg ['longitude'] = $this->input->post('longitude');

		if($reg['latitude'] == '' && $reg['longitude'] == '')
		{
			$response = array('msg'=>"Sorry we are facing some problem while getting your location",'status'=>0);
			echo json_encode($response);exit();
		}


		$reg ['source']   = 'Frontend';

		$this->load->library('zyk/RestaurantLib');
		$vendors = $this->restaurantlib->getSearchedVendor($reg);
		//print_r($vendors);
		//exit;
		if(!empty($vendors))
		{
		//	echo "if";
			$response['status'] = 1;
			$response['msg'] = 'Our service is available for this area.';
			$_SESSION['data'] = $vendors;
			$_SESSION['latitude'] = $reg['latitude'];
			$_SESSION['longitude'] = $reg['longitude'];
			$_SESSION['locality'] = $reg['locality'];
		}
		else
		{
			//	echo "else";
			$response['status'] = 0;
			$response['msg'] = 'Our service is not available for this area.';
			echo json_encode($response);exit();
		}


		$register = $this->userlib->updateUser( $reg );
		$params['userid'] = $_SESSION['olouserid'];
		$params['name']   = $_SESSION['name'];
		$params['email']  = $_SESSION['email'];
		$params['mobile'] = $_SESSION['mobile'];

			$params['landmark'] = $_SESSION['landmark'];
			//$params['address'] = $_SESSION['flat'];
			$params['slot'] = $_SESSION['visit_time'];
			if(!empty($_SESSION['visit_date']))
				$params['pickup_date'] = date('Y-m-d',strtotime($_SESSION['visit_date']));
			else
			$params['pickup_date'] = date('Y-m-d');

			$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));

		if(isset($_SESSION['landmark']))
			$params['locality']  = $_SESSION['landmark'];
		if(isset($_SESSION['latitude']))
			$params['latitude']  = $_SESSION['latitude'];
		if(isset($_SESSION['longitude']))
		    $params['longitude'] = $_SESSION['longitude'];

/*
		if($_SESSION['latitude']!=""){
			$params['latitude']=0;
		}
		if($_SESSION['longitude']!=""){
			$params['longitude']=0;
		}*/
		/*$params['vendor_id'] = $this->input->post('vendor_id');
		$params['other_vendorid'] = $this->input->post('vendor_id1');*/
		$params['vendor_response'] =1;
		if($_SESSION['category_id']=='')
		{
		   // $params['category_id'] = $this->input->post('category_id');
		}else{
			$params['category_id'] = $_SESSION['category_id'];
		}
		if($_SESSION['brand_id']=='')
		{
			//$params['brand_id'] = $this->input->post('brand_id');
		}else{
			$params['brand_id'] = $_SESSION['brand_id'];
		}

		if($_SESSION['model_id']=='')
		{
			//$params['vehicle_model'] = $this->input->post('model_id');
		}else{
			$params['vehicle_model'] = $_SESSION['model_id'];
		}

		//if(!empty($this->input->post('catsubcat_id'))) {
			 if($_SESSION['catsubcat_id']=='')
			{
				/*if(!empty($this->input->post('catsubcat_id'))) {
					$catofsubcat = implode(",",$this->input->post('catsubcat_id'));
					$params['catsubcat_id'] = $catofsubcat;
				 }*/
			}else{
				foreach($_SESSION['catsubcat_id'] as $catofsub){
					$user_id = $catofsub;
					$uid[] = $user_id;
				}
				$cat_subcatid = implode(",", $uid);
				$params['catsubcat_id'] = implode(",",$_SESSION['catsubcat_id']);
			}

		//print_r($params);exit();
		$params['status'] = 0;
		$params['ordered_on'] = date('Y-m-d H:i:s');
		$params['source'] = 2;
		$params['package_id'] = $_SESSION['package_id'];

       		$userid	=	$params['userid'];
       		$package_id	=   $params['package_id'];

		$this->load->library('zyk/OrderLib');
		$vehicle_id = $this->orderlib->vehicle_id_by_packageId($userid,$package_id);

		$params['vehicle_id'] = $vehicle_id[0]['vehicle_id'];

		$this->load->library('zyk/OrderLib');

		$sub_id = $_SESSION['service_type'];

		$model_id = $_SESSION['model_id'];

		$this->load->library('zyk/OrderLib');
		$subcategory_id = $this->orderlib->get_subcategory_id_by_modelId($sub_id,$model_id);

		$params['subcategory_id'] = $subcategory_id[0]['id'];


		if($params['subcategory_id']=='')
		{
			echo $sub_id = $this->input->post('service_type');
			$vehicle_model_id=$this->db->select('model_id')->from('tbl_user_vehicles')->where('id',$params['vehicle_id'])->get()->result_array();
			$model_id = $vehicle_model_id[0]['model_id'];

			$vehicle_brand_id=$this->db->select('brand_id')->from('tbl_user_vehicles')->where('id',$params['vehicle_id'])->get()->result_array();
			$brand_id = $vehicle_brand_id[0]['brand_id'];

			$subcategory_id = $this->orderlib->get_subcategory_id_by_modelId($sub_id,$model_id);

			$params['subcategory_id'] = $subcategory_id[0]['id'];
			$params['vehicle_model'] = $model_id;
			$params['brand_id'] = $brand_id;

		}

		$params['category_id'] = $subcategory_id[0]['category_id'];

		if($params['category_id']=='')
		{
			$params['category_id'] = 9 ;
		}

		$orderid = $this->orderlib->addOrder($params);
		//$orderid = 1;
 		if($orderid > 0) {
			$params['orderid'] = $orderid;
			$oupdate = array();
			$oupdate['orderid'] = $orderid;
			$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36));
			$_SESSION['order_code'] = $oupdate['ordercode'];
			//invoice generate and save data
			if($params['package_id']!=""){
 				//new package 1st time changes
					$this->load->library('zyk/SearchLib');
						$packageData = $this->searchlib->getPackageDetailsbyId($params['package_id']);
		 			$userid = $this->session->userdata('olouserid');

		 		 /*	echo "<pre>";
		 		 	print_r($packageData);
		 		 	exit(); */
		  		//get package usages
 					$packageUsages = $this->searchlib->getPackageUsagesByUser($packageData['id'],$userid);
 					$selectedpackageid = $this->searchlib->getorderbypackage($userid,$packageData['id']);
 					//pretag($selectedpackageid);
                     $usercnt=$selectedpackageid[0]['remaining_service_count']-1;
                    if($usercnt<=0){
                    $user_package['is_expire'] = 0;
                    }


					$user_package['remaining_service_count'] = $usercnt;
					$user_package['order_ids'] = $selectedpackageid[0]['order_ids'].','.$orderid;
				/*	$user_package['created_date'] = date('Y-m-d');
					$user_package['expiry_date'] = date('Y-m-d', strtotime("+{$packageData['year']} years"));
					$user_package['year'] = $packageData['year'];

					$user_package['package_id'] = $packageData['id'];
					$user_package['vehicle_id'] = 0;  */
                    $this->db->where('id',$selectedpackageid[0]['id']);
					$this->db->update('tbl_user_package',$user_package);
                    if(!empty($packageData['services'])){
		  	 			$items = array();
		 	 			foreach ($packageData['services'] as $row) {

		 	 				foreach ($_SESSION['service_use'] as $row2) {
	                    	    if($row['id']==$row2) {
	                    	         $item = array();
									$item['orderid'] = $orderid;
									$item['service_id'] = $row['id'];
									$item['service_name'] = $row['name'];
									$item['service_price'] = 0;
			 						$item['tax'] = 0;
			 						$item['total_amount'] = 0;
						            $item['is_checked'] = 1 ;
									$item['service'] = 1 ;
									$item['priority'] = 1;
									$item['is_package_service'] =$selectedpackageid[0]['id'];
									 $items[] = $item;
	                                }
	                    	     }


		 					}
		 					if(count($_SESSION['service_use'])>0){
		 					//print_r($items);exit();
		  					$this->db->insert_batch('tbl_booking_services',$items);
		  					}
		  			}


		 			//get total amount from the package data

		 		/*	$oupdate['order_amount'] = $packageData['best_price'];
		 			$oupdate['net_total'] = $packageData['best_price'];
		 			$oupdate['grand_total'] = $packageData['special_price'];
		 			$oupdate['discount'] = $packageData['best_price'] - $packageData['special_price'] ;  */
		 			$this->orderlib->updateOrder($oupdate);


 		 		//package close

				}else{
					$response = array('msg'=>"Package is already applied.Please buy from myprofile ",'status'=>0);
						echo json_encode($response);
						exit();
				}


			$params['ordercode'] = $oupdate['ordercode'];
		//set data for the page order,package data,order code
			$this->orderlib->sendBookingEmail($params);
			$this->orderlib->sendBookingSMS($params);
			$response['orderid'] = $orderid;
			$response['status'] = 1;
			$response['msg'] = "Order punched in system";
			$this->session->set_userdata ( 'olouserid', $params['userid'] );
			$this->session->set_userdata ( 'olousername', $reg ['name'] );
			$this->session->set_userdata ( 'olouseremail', $reg ['email'] );
			$this->session->set_userdata ( 'olousermobile', $reg ['mobile'] );
			$_SESSION['orderid']=$orderid ;

			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Booking Request Sent';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 0;
			$logs['created_by'] = 0;

			$this->orderlib->addOrderLogs($logs);
			$this->session->unset_userdata('brand_id');
			$this->session->unset_userdata('model_id');
			$this->session->unset_userdata('subcategory_id');
			$this->session->unset_userdata('catsubcat_id');
			$this->session->unset_userdata('timeslotList');
			$this->session->unset_userdata('time_slot');
			$this->session->unset_userdata('pickup_date');
			$this->session->unset_userdata('coupon_code');
			$this->session->unset_userdata('flat');
			$this->session->unset_userdata('landmark');
			$this->session->unset_userdata('package_id');
			$this->session->unset_userdata('searchid');
			$response['status'] = 1;
			$response['msg'] = "Order punched in system";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Failed to add order";
		}
		echo json_encode($response);

	}


	 public function sendSMS() {
		$fname = 'Mahesh';
		$sms_msg = 'Dear '.$fname.', verification code 12334';
		$this->load->library ( 'Pksms' ,'pksms');
		$map = array ();
		$map ['mobile'] = 9975468540;
		$map ['message'] = $sms_msg;
		$this->pksms->sendSms ( $map );
	}
        public function payment_status() {
            $this->load->library('zyk/PaymentLib');
            $response = $this->paymentlib->getResponse($_GET['payment_request_id']);
            $url = $response['longurl'];
            if(!empty($response['payments'])){
                if ($response['payments'][0]['status'] == 'Credit') {
                    $status = 'Success';
                    $update['transactionid'] = $response['id'];
                    $update['status'] = 'Credit';
                    $update['payment_date'] = date('Y-m-d h:i:s');
                    $this->paymentlib->updatePayment($update);
                    $orderid = $this->db->get_where('tbl_payment_details',array('transactionid'=>$response['id']))->row('orderid');
                    if($orderid == -1)
                    {
                    	$this->addOrderdb($response['id']);
                    }
                } else {
                    $status = 'Failed';
                }
            }
            $this->template->set ( 'status', $status);
            $this->template->set ( 'url', $url);
            $this->template->set ( 'page', 'booking-flow/thank-you' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('booking-flow/payment-thank-you');

          }
          public function payment_status_b2b() {
            $this->load->library('zyk/ClientpaymentLib');
            $response = $this->clientpaymentlib->getResponse($_GET['payment_request_id']);
            $url = $response['longurl'];
            if(!empty($response['payments'])){
                if ($response['payments'][0]['status'] == 'Credit') {
                    $status = 'Success';
                    $update['transactionid'] = $response['id'];
                    $update['status'] = 'Credit';
                    $update['payment_date'] = date('Y-m-d h:i:s');
                    $this->clientpaymentlib->updatePayment($update);
                } else {
                    $status = 'Failed';
                }
            }
            $this->template->set ( 'status', $status);
            $this->template->set ( 'url', $url);
            $this->template->set ( 'page', 'booking-flow/thank-you' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');

	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('booking-flow/payment-thank-you');

          }


    /* My profile */


    public function getQuote() {

 		$this->load->library('zyk/UserLib');
		$this->userlib->sendCallbackEmail();

		$this->session->set_flashdata('Success','Will Call You Shortly!');

		$this->session->set_flashdata('feedback',"class='alert alert-success'");
		redirect('/enquiry-form');
	}
	public function B2BgetQuote() {

 		$this->load->library('zyk/UserLib');
		$this->userlib->sendB2BEmail();

		$this->session->set_flashdata('Success','Will Call You Shortly!');

		$this->session->set_flashdata('feedback',"class='alert alert-success'");
		redirect('/bulk-booking');

	}


	public function addOrderdb($transactionid) {
		$params = $this->session->orderData;
		$this->load->library('zyk/OrderLib');
		$params['old_price'] = 0;
		$params['is_package_paid'] = 1;
		$orderid = $this->orderlib->addOrder($params);
            $oupdate = array();
			$oupdate['orderid'] = $orderid;
			$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36));
			$_SESSION['order_code'] = $oupdate['ordercode'];
 		if($orderid > 0) {
 			$this->db->set('orderid',$orderid);
 			$this->db->where('transactionid',$transactionid);
 			$this->db->update('tbl_payment_details');
			$params['orderid'] = $orderid;

			//invoice generate and save data

			if($params['package_id']!=""){
					$this->load->library('zyk/SearchLib');
					$packageData = $this->searchlib->getPackageDetailsbyId($params['package_id']);
		 			$userid = $this->session->userdata('olouserid');
 					$packageUsages = $this->searchlib->getPackageUsagesByUser($packageData['id'],$userid);
				if($packageUsages['remaining_service_count']==0 || empty($packageUsages)){
 						$this->template->set('order',$params);
						$this->template->set('ordercode',$oupdate['ordercode']);
						$this->template->set('packageData',$packageData);
		 	 			$this->template->set_theme('default_theme');
						$this->template->set_layout (false)
									   ->title ( 'Administrator | Generate Invoice' );
						$html = $this->template->build ('booking-flow/InvoiceDetails','',true);
 		 	 			$file_name = "invoice_package".$oupdate['ordercode'].".pdf";
		 				$this->load->library('MyPdfLib');
						$url = $this->mypdflib->getPdf($html,$file_name);
		  	 			$items = array();
						//insert data into tbl_user_package
						$user_package['user_id'] = $userid;
						$user_package['is_expire'] = 1;
						$user_package['invoice_url'] =$url ;
						$user_package['service_used_validity'] = $packageData['service_used_validity'];
						$user_package['remaining_service_count'] = $packageData['service_used_validity']-1;
						$user_package['created_date'] = date('Y-m-d');
						$user_package['expiry_date'] = date('Y-m-d', strtotime("+{$packageData['year']} years"));
						$user_package['year'] = $packageData['year'];
	 					$user_package['order_ids'] = $orderid;
						$user_package['package_id'] = $packageData['id'];
						$user_package['vehicle_id'] = $params['vehicle_id'];
						$this->db->insert('tbl_user_package',$user_package);
						$user_package_id = $this->db->insert_id();
		 	 			foreach ($packageData['services'] as $row) {
								$item = array();
								$item['orderid'] = $orderid;
								$item['service_id'] = $row['id'];
								$item['service_name'] = $row['name'];
								$item['service_price'] = 0;
		 						$item['tax'] = 0;
		 						$item['total_amount'] = 0;
					            $item['is_checked'] = 1 ;
								$item['service'] = 1;
								$item['priority'] = 1;
								$item['is_package_service'] = $user_package_id;
 							    $items[] = $item;
		 					}
		  			$this->db->insert_batch('tbl_booking_services',$items);
		 			$oupdate['order_amount'] = $packageData['special_price'];
		 			$oupdate['net_total'] = $packageData['special_price'];
		 			$oupdate['grand_total'] = $packageData['special_price'];
		 			$oupdate['discount'] = 0 ;
                                        if($params['package_id'] == PACKAGE_ID1 || $params['package_id'] == PACKAGE_ID2) {
                                            $price = $params['package_id'] == 5 ? 399 : 999;
                                            $this->add_billing_mloyal($params, $orderid, $price);
                                        }
 		 			} else{
 		 				$response = array('msg'=>"Package is already applied.Please buy from myprofile ",'status'=>0);
						echo json_encode($response);
						exit();
 		 			}  //package close
			}
			$params['ordercode'] = $oupdate['ordercode'];
            $this->orderlib->updateOrder($oupdate);
			//set data for the page order,package data,order code
			$this->orderlib->sendBookingEmail($params);
			$this->orderlib->sendBookingSMS($params);
			$response['orderid'] = $orderid;
			$response['status'] = 1;
			$response['msg'] = "Order punched in system";
			$this->session->set_userdata ( 'olouserid', $params['userid'] );
			$this->session->set_userdata ( 'olousername', trim($_SESSION['name']) );
			$this->session->set_userdata ( 'olouseremail', $_SESSION['email'] );
			$this->session->set_userdata ( 'olousermobile', $_SESSION['mobile'] );
			$_SESSION['orderid']=$orderid ;
			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Booking Request Sent';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 0;
			$logs['created_by'] = 0;
			$this->orderlib->addOrderLogs($logs);
			$this->session->unset_userdata('brand_id');
			$this->session->unset_userdata('model_id');
			$this->session->unset_userdata('vehicle_no');
			$this->session->unset_userdata('subcategory_id');
			$this->session->unset_userdata('catsubcat_id');
			$this->session->unset_userdata('timeslotList');
			$this->session->unset_userdata('time_slot');
			$this->session->unset_userdata('pickup_date');
			$this->session->unset_userdata('coupon_code');
			$this->session->unset_userdata('redeem_amount');
			$this->session->unset_userdata('flat');
			$this->session->unset_userdata('landmark');
			$this->session->unset_userdata('package_id');
			$this->session->unset_userdata('searchid');
			$this->session->unset_userdata('orderData');
		}
	}
	  public function addSubscription() {
	  	$this->load->library('zyk/General');

        $params = array();
        $params['email'] = $this->input->post('subscription_email');
        $params['created_datetime'] = date('Y-m-d H:i:s');
        $response = $this->general->addSubscription($params);
        echo json_encode($response);
    }
    public function add_billing_mloyal($param, $orderid, $price) {
        $data = array (
            'objClass' =>
            array (
              0 =>
              array (
                'store_code' => 'HO-01',
                'bill_date' => '2017-01-01',
                'bill_no' => $orderid,
                'bill_grand_total' => $price,
                'bill_discount' => '0',
                'bill_tax' => '0',
                'bill_transaction_type' => 'Sale',
                'bill_gross_amount' => $price,
                'bill_net_amount' => $price,
                'customer_mobile' => $param['mobile'],
                'customer_email' => $param['email'],
                'bill_status' => '1',
                'bill_transcation_no' => $orderid,
                'output' =>
                array (
                  0 =>
                  array (
                    'item_code' => 'HO-01',
                    'item_name' => 'Package999',
                    'item_rate' => '1000',
                    'item_net_amount' => $price,
                    'item_gross_amount' => $price,
                    'item_quantity' => '1',
                    'item_tax' => '10',
                    'item_status' => '1',
                  ),
                ),
              ),
            ),
          );
          $data['method_name'] = 'INSERT_BILLING_DATA_ACTION';
          $this->load->library('MloyalLib', 'mloyallib');
          $this->mloyallib->send_curl_request($data);
          $json['json'] = json_encode($param['mobile']);
          $this->db->insert('json', $json);
    }

    public function save_subscriber()
    {
    	$data['email'] = $this->input->post('sub_email');
	
		if (!empty( $result ) == 0) {
			$this->db->insert ( 'tbl_subscription', $data );
			$response ['status'] = 1;
			$response ['msg'] = "Data added successfully";
			echo json_encode($response);
		} else {
			$errors = array ();
			$data ['msg'] = "Something went wrong.";
			$data ['status'] = 0;
			echo json_encode($response);
		}
    }

    public function save_ride_with_us()
    {
    	$data = $this->input->post();
	
		if (!empty( $data )) {
			$this->db->insert ( 'ride_with_us', $data );
			$response ['status'] = 1;
			$response ['msg'] = "Thank you for your request. Our team will get in touch with you shortly!";
			echo json_encode($response);
		} else {
			$errors = array ();
			$data ['msg'] = "Something went wrong.";
			$data ['status'] = 0;
			echo json_encode($response);
		}				
    }

    public function save_partner_with_us()
    {
    	$data = $this->input->post();
	
		if (!empty( $data )) {
			$this->db->insert ( 'partner_with_us', $data );
			$response ['status'] = 1;
			$response ['msg'] = "Thank you for your request. Our team will get in touch with you shortly!";
			echo json_encode($response);
		} else {
			$errors = array ();
			$data ['msg'] = "Something went wrong.";
			$data ['status'] = 0;
			echo json_encode($response);
		}				
    }

    public function apply_coupon()
   	{
   		$coupon_code = $this->input->post('ccode');
		$amont = $this->input->post('amount');
		$coupon_usage_count = $this->input->post('cpn_per_use_cnt');
		$users_usage_count = $this->input->post('usr_per_use_cnt');;
		$message ='';
		$err_status = 1;

		$this->load->model('coupan/Coupan_model', 'coupon_model');

		if($coupon_attr=$this->coupon_model->fetch_couponData_With_code('coupon',"coupon_code",$coupon_code))
		{  
			if($coupon_usage_count>$coupon_attr[0]->times_per_cpn)
			{
				$message = "Coupon Usage Limit Excides";
				$data = array('err_status' => $err_status, 
					'message' => $message );
				$data = json_encode($data);
				echo $data;
				exit();	
			}
			if($users_usage_count>$coupon_attr[0]->count_per_user)
			{
				$message = "Users Coupon Usage Limit Excides";
				$data = array('err_status' => $err_status, 
					'message' => $message );
				$data = json_encode($data);
				echo $data;
				exit();
			}
			$couponDate = date('Y-m-d');
			$couponDate=date('Y-m-d', strtotime($couponDate));

			$start_date = date('Y-m-d', strtotime($coupon_attr[0]->starts_date));
			$end_date = date('Y-m-d', strtotime($coupon_attr[0]->end_date));

			if (($couponDate >= $start_date) && ($couponDate <= $end_date)){
				if($amont>=$coupon_attr[0]->min_order_value){

					if($coupon_attr[0]->garage_specific=='0' && $coupon_attr[0]->garage_id==$garage_id)
					{
						$message = "Coupon is valid.";
						$data = array('err_status' => $err_status, 
							'message' => $message );
						$data = json_encode($data);
						echo $data;
						exit();	

					}else{
						$message = "Coupon is not valid for this garage.";
						$data = array('err_status' => $err_status, 
							'message' => $message );
						$data = json_encode($data);
						echo $data;
						exit();	
					}

				}else{
					$message = "Not Apllicable To This Amount";
					$data = array('err_status' => $err_status, 
						'message' => $message );
					$data = json_encode($data);
					echo $data;  

					exit();
				}   
			}else{
				$message = "Coupon is expired!";
				$data = array('err_status' => $err_status, 
					'message' => $message );
				$data = json_encode($data);
				echo $data;  
				exit();
			}
		}else{
			$message = "No Such Coupon Available";
			$data = array('err_status' => $err_status, 
				'message' => $message );
			$data = json_encode($data);
			echo $data;
			exit();
		}
	}

	private function calculatePercentage($amount,$percentage,$max_discount)
	{
		$perAmount = ($percentage / 100) * $amount;
		
		if($perAmount>$max_discount)
		{
			$finalTotal = $amount - $max_discount;
		}else{
			$finalTotal = $amount - $perAmount;	
		}
		return $finalTotal;

	}

	private function calculateFlat_Discount($amount,$disc_amount)
	{
		$finalTotal = $amount - $disc_amount;
		return $finalTotal;
	}

	public function validate_coupon_code()
   	{
   		$coupon_code = $this->input->post('ccode');
   		$garage_id = $this->input->post('garage_id');
		
		$message ='';
		$err_status = 1;

		$this->load->model('coupan/Coupan_model', 'coupon_model');

		if($coupon_attr=$this->coupon_model->fetch_couponData_With_code('coupon',"coupon_code",$coupon_code))
		{  
			
			$couponDate = date('Y-m-d');
			$couponDate=date('Y-m-d', strtotime($couponDate));

			$start_date = date('Y-m-d', strtotime($coupon_attr[0]->starts_date));
			$end_date = date('Y-m-d', strtotime($coupon_attr[0]->end_date));

			if (($couponDate >= $start_date) && ($couponDate <= $end_date)){
				//if($amont>=$coupon_attr[0]->min_order_value){

					if($coupon_attr[0]->garage_specific=='0' && $coupon_attr[0]->garage_id==$garage_id)
					{
						$message = "Your coupon has been applied successfully!";
						// $this->add_cpn_to_order($coupon_attr->coupon_code);
						$data = array('err_status' => $err_status, 
							'message' => $message );
						$data = json_encode($data);
						echo $data;
						exit();	
					}else{

						$message = "Sorry! Seems you have applied a wrong coupon!";
						// $message = "Coupon is not valid for this garage.";
						$data = array('err_status' => $err_status, 
							'message' => $message );
						$data = json_encode($data);
						echo $data;
						exit();	
					}

				// }else{
				// 	$message = "Not Apllicable To This Amount";
				// 	$data = array('err_status' => $err_status, 
				// 		'message' => $message );
				// 	$data = json_encode($data);
				// 	echo $data;  
				// 	exit();
				// }   
			}else{
				$message = "Sorry! Seems you have applied a wrong coupon!";
				// $message = "Coupon is expired!";
				$data = array('err_status' => $err_status, 
					'message' => $message );
				$data = json_encode($data);
				echo $data;  
				exit();
			}
		}else{
			$message = "Sorry! Seems you have applied a wrong coupon!";
			// $message = "No Such Coupon Available";
			$data = array('err_status' => $err_status, 
				'message' => $message );
			$data = json_encode($data);
			echo $data;
			exit();
		}
	}
    
}

?>