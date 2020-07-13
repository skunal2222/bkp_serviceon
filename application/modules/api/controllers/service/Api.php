<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * General API
 * @author Tushar
 * @package Service
 *
 */
class Api extends REST_Controller {

	/**************** code by kunal ****************/

	public function getBrandList_get()
	{
		$this->load->library ( 'api/ServiceLib', 'servicelib');
		$list = $this->servicelib->getActiveBikeBrandsByName();
		if(empty($list))
		{
			$response['status'] = "true";
			$response['msg'] = "No brand found.";
			$response['data'] = [];
		}
		else
		{
			$response['status'] = "true";
			$response['msg'] = "Brand found.";
			$response['data'] = $list;
		}
		$this->response($response,200);
	}

	public function getModelsByBrandsID_post()
	{
		$data['brandId'] = explode(',', $this->post('brand_id'));
		if (empty($data['brandId'])) {
			$response['status'] = "false";
			$response['msg'] = "Brand ID is missing.";
		}
		else
		{
			$this->load->library ( 'api/ServiceLib', 'servicelib');
			$result = $this->servicelib->getModelsByBrandsID($data);
			if (empty($result)) {
				$response['status'] = "true";
				$response['msg'] = "Model not found.";		
			}
			else
			{
				$response['status'] = "true";
				$response['msg'] = "Model list found.";
				$response['data'] = $result;
			}
		}
		$this->response($response,200);
	}

	/**************** code by kunal ****************/


	public function checkservice_post() {
		$map = array ();
		$this->load->library ( 'api/UserLib' );

		$map['locality'] = $this->post('locality');
		$map['latitude'] = $this->post('latitude');
		$map['longitude'] = $this->post('longitude');

		if (empty($map['locality']))
		{
			$response["success"] = "false";
			$response["msg"] = "Empty Area";
		}else{
			$this->load->library('api/RestaurantLib');
			$vendors = $this->restaurantlib->getSearchedVendor($map);
			//print_r($vendors);

			if(!empty($vendors)){
				$response["status"] = "true";
				$response["msg"] = "Our service is available for this area.";
				$response["data"] = $vendors;

				$address = array();
				$address['userid'] = $this->post('userid');
				$address['address_name'] = $this->post('address_name');
				$address['address'] = $this->post('address');
				$address['locality'] = $this->post('locality');
				$address['latitude'] = $this->post('latitude');
				$address['longitude'] = $this->post('longitude');
				$address['landmark'] = $this->post('landmark');
				$address['pincode'] = $this->post('pincode');
				$address['flat_no'] = $this->post('flat_no');
				$address['vendor_id'] = $vendors[0]['id'];
				//$address['vendor_id1'] = $vendors[1]['id'].','.$vendors[2]['id'];
				$result = $this->userlib->addAddress($address);
			} else {
				$response["status"] = "false";
				$response["msg"] = "Service is Not Available";
			}
		}
		//$this->response ($resp,200);
		echo json_encode($response);
	}

	public function getCategory_post() {

		$this->load->library('api/ServiceLib', 'servicelib');
		$categories = $this->servicelib->getActiveCategories();

		$cat = array();
		foreach($categories as $item) {
			$category['cat_id'] = $item['id'];
			$category['cat_name']  = $item['name'];
			$category['cat_image']  = asset_url().$item['image'];
			$cat[] = $category;

		}

		$data['status']="true";
		$data['message']="Category list";
		$data['data']= $cat;

		echo json_encode($data);
	}

	public function brandbycatid_post() {

		$id = $this->post('cat_id');
		$this->load->library('api/ServiceLib', 'servicelib');
		$brands = $this->servicelib->getBrandId($id);

		$brandarr = array();
		foreach($brands as $item) {
			$brand['brand_id'] = $item['id'];
			$brand['brand_name']  = $item['name'];
			$brand['brand_image']  = asset_url().$item['image'];
			$brandarr[] = $brand;

		}

		$data['status']="true";
		$data['message']="Brand list";
		$data['data']= $brandarr;

		echo json_encode($data);
	}

	public function modelbybrandid_post() {

		$id = $this->post('brand_id');
		$this->load->library('api/ServiceLib', 'servicelib');
		$models = $this->servicelib->getModelbyBrandId($id);

		$modelarr = array();
		foreach($models as $item) {
			$model['model_id'] = $item['id'];
			$model['model_name']  = $item['name'];
			//$model['model_image']  = asset_url().$item['image'];
			$modelarr[] = $model;

		}

		$data['status']="true";
		$data['message']="Brand list";
		$data['data']= $modelarr;

		echo json_encode($data);
	}

	public function categorybymodelid_post() {

		$id = $this->post('model_id');
		$this->load->library('api/ServiceLib', 'servicelib');
		$categories = $this->servicelib->getSubCatId($id);

		$catarr = array();
		foreach($categories as $item) {
			$category['modelcat_id'] = $item['id'];
			$category['modelcat_name']  = $item['name'];
			//$category['modelcat_image']  = asset_url().$item['image'];
			$catarr[] = $category;

		}

		$data['status']="true";
		$data['message']="Category list";
		$data['data']= $catarr;

		echo json_encode($data);
	}

	public function subcategorybycatid_post() {

		$id = $this->post('modelcat_id');
		$this->load->library('api/ServiceLib', 'servicelib');
		$subcategories = $this->servicelib->getCatsubcatid($id);

		$subcatarr = array();
		foreach($subcategories as $item) {
			$subcategory['subcat_id'] = $item['id'];
			$subcategory['subcat_name']  = $item['name'];
			//$subcategory['subcat_image']  = asset_url().$item['image'];
			$subcatarr[] = $subcategory;

		}

		$data['status']="true";
		$data['message']="SubCategory list";
		$data['data']= $subcatarr;

		echo json_encode($data);
	}

	public function addOrder_post() {
		$oupdate = array();
		$oupdate['order_amount'] = 0;
		$oupdate['net_total'] = 0;
		$oupdate['grand_total'] = 0;
		$oupdate['discount'] = 0;
		$myFile = APPPATH."/third_party/sample.json";
		$arr_data = $_POST; // create empty array
		$jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
		file_put_contents($myFile, '');
		file_put_contents($myFile, $jsondata);
		$params = array();
		$notification = array();
		$this->load->library ( 'api/UserLib' );

		$reg = array ();
		$reg ['name'] = trim($this->input->post('name'));
		$reg ['email'] = $this->input->post('email');
		$reg ['mobile'] =$this->input->post('mobile');
		$reg['address'] = $this->input->post('address');
		$reg['landmark'] = $this->input->post('landmark');
		$reg['latitude'] = $this->input->post('latitude');
		$reg['longitude'] = $this->input->post('longitude');
		$reg['address_type'] = $this->input->post('address_type');
		$register = $this->userlib->updateUser( $reg );
		$params['userid'] = $this->input->post('userid');
		$params['name'] = $this->input->post('name');
		$params['email'] = $this->input->post('email');
		$params['mobile'] = $this->input->post('mobile');

        if(!empty($this->input->post('locality')))
		{
		    $params['locality'] = $this->input->post('locality');
		}else{
			$params['locality'] = '';
		}

		$params['address'] = $this->input->post('address');

		if(!empty($this->input->post('landmark')))
		{
			$params['landmark'] = $this->input->post('landmark');
		}else {
			$params['landmark'] = '';
		}

        $params['address'] = $this->input->post('address');
		$params['latitude'] = $this->input->post('latitude');
		$params['longitude'] = $this->input->post('longitude');
		$params['vendor_id'] = 0;
		$params['other_vendorid'] = 0;
		$params['vendor_response'] =1;
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');

		//$params['subcategory_id'] = $this->input->post('subcategory_id');
                $static_sub_id  = $this->input->post('subcategory_id');
                $subcategory_id = $this->db->select('id')
                                           ->from('subcategory')
                                           ->where('model_id', $this->input->post('vehicle_model'))
                                           ->where('sub_id', $static_sub_id)
                                           ->get()
                                           ->result_array();
                if(empty($subcategory_id)) {
                    $response['status'] = 'false';
		    		$response['msg'] = "Failed to add order";
                    echo json_encode($response);
                    exit;
                }
        $params['subcategory_id'] = $subcategory_id[0]['id'];
		$params['vehicle_model'] = $this->input->post('vehicle_model');
		$params['catsubcat_id'] = $this->input->post('catsubcat_id');
        $params['service_id'] = $params['catsubcat_id'];
		$params['slot'] = $this->input->post('slot');
		$params['comment'] =$this->input->post('comment');
		$image =$this->input->post('image');
		$image1 =$this->input->post('image1');
                $image2 =$this->input->post('image2');
                $image3 =$this->input->post('image3');
                $arr_images = array();
		if(!empty($image))
		{
			$imageid = $params['subcategory_id'].mt_rand(10000,99999);
			$path = "assets/images/booking/$imageid.png";
			$actualpath = base_url().$path;
			file_put_contents($path,base64_decode($image));
                        $arr_images[] = $actualpath;
			//$params['image'] = $actualpath;
		}
                if(!empty($image1)) {
			$imageid1 = $params['subcategory_id'].mt_rand(1000,9999);
			$path1 = "assets/images/booking/$imageid1.png";
			$actualpath1 = base_url().$path1;
			file_put_contents($path1,base64_decode($image1));
                        $arr_images[] = $actualpath1;
			//$params['image1'] = $actualpath1;
		}
                if(!empty($image2)) {
			$imageid2 = $params['subcategory_id'].mt_rand(1000,9999);
			$path2 = "assets/images/booking/$imageid2.png";
			$actualpath2 = base_url().$path2;
			file_put_contents($path2,base64_decode($image2));
                        $arr_images[] = $actualpath2;
			//$params['image1'] = $actualpath1;
		}
                if(!empty($image3)) {
			$imageid3 = $params['subcategory_id'].mt_rand(1000,9999);
			$path3 = "assets/images/booking/$imageid3.png";
			$actualpath3 = base_url().$path3;
			file_put_contents($path3,base64_decode($image3));
			//$params['image1'] = $actualpath1;
                        $arr_images[] = $actualpath3;
		}
		$params['image'] = implode(",", $arr_images);

		$option= $this->input->post('discount_type');
		$couponcode = $this->input->post('coupon_code');
		if($option == 'promocode')
		{
			if(!empty($couponcode))
				$params['coupon_code'] = $couponcode;
		}
		else
		{
			if($option == "credits")
				$params['wallet_discount'] = 1;
		}

		if(!empty($this->input->post('visit_date')))
		{
			$params['pickup_date'] = date('Y-m-d',strtotime($this->input->post('visit_date')));
		}
		else
		{
			$params['pickup_date'] = date('Y-m-d',strtotime($this->input->post('pickup_date')));
		}

		$del_date = date('Y-m-d',strtotime('+48 hours',strtotime($params['pickup_date'])));
		$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
		$params['ordered_on'] = date('Y-m-d H:i:s');
		$params['source'] = 1;
		$params['status'] = 0;

        if($this->input->post('is_package') == 1)
        {
            $params['package_id'] = $this->input->post('package_id');
        }
        $params['is_package_paid'] = 0;
		$this->load->library('api/OrderLib');
		if($this->input->post('is_package_paid') == 1)
		{
			$params['is_package_paid'] = 1;
			$params['old_price'] = 0;
		}
		$params['vehicle_id'] = $this->input->post('vehicle_id');
        $orderid = $this->orderlib->addOrder($params);
		$uid = $params['userid'];
		$this->orderlib->sendBookingNotification($uid);
		if($orderid > 0)
		{
			$params['orderid'] = $orderid;
			$oupdate['orderid'] = $orderid;
			$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
			if($this->input->post('is_package') == 1)
			{
				$params['package_id'] = $this->input->post('package_id');
				$this->load->library('zyk/SearchLib');
				$packageData = $this->searchlib->getPackageDetailsbyId($params['package_id']);

                $result = $this->db->get_where('tbl_user_package',
				array('user_id' => $params['userid'],
						  'package_id' =>$params['package_id'],'is_expire'=>1,'vehicle_id'=>$params['vehicle_id']))->result_array();
			/*	echo "<pre>";
				print_r($result);
				exit; */
				if(!empty($result))
				{

					$services = explode(',', $this->input->post('package_services'));

					$items = array();
	 	 			foreach ($packageData['services'] as $row) {
	 	 				if(in_array($row['id'], $services)) {

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
							$item['quantity'] = 1;
							$item['is_package_service'] = $result[0]['id'];
						    $items[] = $item;
					}

 					}
 					$oupdate['order_amount'] = 0;
			        $oupdate['net_total'] = 0;
			        $oupdate['grand_total'] = 0;
			        $oupdate['discount'] = 0;
 					$remains = $result[0]['remaining_service_count'] - 1;

                    $this->db->insert_batch('tbl_booking_services', $items);
                    //$useless =  $this->db->insert_id();
                    //exit;
                    $update['order_ids'] = $result[0]['order_ids'].','.$orderid;
 					$update['remaining_service_count'] = $remains;
 					if($remains == 0)
 					{
                        $update['is_expire'] = 0;
 					}
 					$this->db->where('id', $result[0]['id']);
 					$this->db->update('tbl_user_package', $update);
				}
				else
				{
                                    if($params['package_id'] == PACKAGE_ID1 || $params['package_id'] == PACKAGE_ID2) {
                                            $price = $params['package_id'] == 5 ? 399 : 999;
                                            $this->add_billing_mloyal($params, $orderid, $price);
                                        }
					/*Generate Invoice*/
					$this->template->set('order',$params);
					$this->template->set('ordercode',$oupdate['ordercode']);
					$this->template->set('packageData',$packageData);
	 	 			$this->template->set_theme('default_theme');
					$this->template->set_layout (false)
								   ->title ( 'Administrator | Generate Invoice' );
					$html = $this->template->build ('frontend/booking-flow/InvoiceDetails','',true);
	 	 			$file_name = "invoice_package".$oupdate['ordercode'].".pdf";
	 				$this->load->library('MyPdfLib');
					$url = $this->mypdflib->getPdf($html,$file_name);
					$user_package['vehicle_id'] = $this->input->post('vehicle_id');
					$user_package['package_id'] = $this->input->post('package_id');
					$user_package['order_ids'] = $orderid;
					$user_package['service_used_validity'] = $packageData['service_used_validity'];
					$user_package['year'] = $packageData['year'];
					$user_package['expiry_date'] = date('Y-m-d',strtotime('+'.$packageData['year'].' year'));
					$user_package['created_date'] = date('Y-m-d H:i:s');
					$user_package['remaining_service_count'] = $packageData['service_used_validity'] - 1;
					$user_package['invoice_url'] = $url;
					$user_package['user_id'] = $params['userid'];
					$user_package['is_expire'] = 1;

					$this->db->insert('tbl_user_package',$user_package);
					$user_package_id = $this->db->insert_id();
					if($user_package_id > 0)
					{
						$newinvoice = array();
			 			$newinvoice['url'] = $url;
			 			$newinvoice['user_id'] = $params['userid'];
			 			$newinvoice['order_id']=$orderid;
			 			$newinvoice['created_date'] = date('Y-m-d');
		 	 			$this->db->insert('package_invoice',$newinvoice);

		 	 			$items = array();
		 	 			foreach ($packageData['services'] as $row) {
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
							$item['quantity'] = 1;
							$item['is_package_service'] = $user_package_id;
						    $items[] = $item;
	 					}
	 					/*
							If First package booking
	 					*/
	 					$oupdate['order_amount'] = $packageData['special_price'];
			 			$oupdate['net_total'] = $packageData['special_price'];
			 			$oupdate['grand_total'] = $packageData['special_price'];
			 			$oupdate['discount'] =0;
			 			$oupdate['old_price'] = $packageData['special_price'];
	 					$this->db->insert_batch('tbl_booking_services',$items);
	 					        if($params['is_package_paid'] == 1)
						        {
								    $uid = uniqid();
						        	$payment = array(
						        		'orderid'=>$orderid,
						        		'email'=>$params['email'],
						        		'transactionid'=>$uid,
						        		'amount'=>$packageData['special_price'],
						        		'status'=>'Credit',
						        		'gateway'=>'instamojo',
						        		'paymentid'=>$uid,
						        		'phone'=>$params['mobile'],
						        		'mac'=>'',
						        		'fees'=>0,
						        		'shorturl'=>'',
						        		'longurl'=>'',
						        		'payment_date'=>date('Y-m-d H:i:s'),
						        	);
						        	$this->db->insert('tbl_payment_details',$payment);
						        }
					}
					//get total amount from the package data
				}
			}
            $ordertotal = 0;
			//$oupdate['net_total'] = round($oupdate['order_amount']);
			//$oupdate['grand_total'] = round($oupdate['net_total'] - $oupdate['discount']);

			$this->orderlib->updateOrder($oupdate);
			$params['ordercode'] = $oupdate['ordercode'];
			$this->orderlib->sendBookingEmail($params);
			$this->orderlib->sendBookingSMS($params);
			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Booking Request Sent';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 0;
			$logs['created_by'] = 0;
			$logs['source'] = 'Customer App';
			$this->orderlib->addOrderLogs($logs);
			$response['orderid'] = $orderid;
			$response['status'] = 'true';
			$response['msg'] = "Order placed successfully!!";
		}
		else
		{
			$response['status'] = 'false';
			$response['msg'] = "Failed to add order";
		}
		echo json_encode($response);
	}


	public function getOrderHistory_post(){
		$id = $this->post ( 'user_id' );
		$this->load->library ( 'api/UserLib' );
		$order = $this->userlib->getOrder($id);

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

	public function getOrderDetail_post(){
		$id = $this->post ( 'user_id' );
		$this->load->library ( 'api/UserLib' );
		$order = $this->userlib->getOrder($id);

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

	public function getslot_post() {

		$del_date = $this->post('pickup_date');
		$date = date('Y-m-d', strtotime($del_date));
		$current_date = date('Y-m-d');
		$current_time = date('H:i');
		$current_time_ext = date('H:i',strtotime('+45 minutes'));
		$this->load->library('api/SlotLib', 'slotlib');
		$slots = $this->slotlib->getActiveVisiting1();
		$durArray = array();
		$day = date('D',strtotime($date));
		//$services = array();
		if($date == date('Y-m-d')) {
			foreach ($slots as $slot) {
				$slot_arr = explode('-',$slot['time_slot']);
				$from_time = date('H:i',strtotime($slot_arr[0]));
				$to_time = date('H:i',strtotime($slot_arr[1]));
				if($current_time < $from_time) {
					$service['id'] = $slot['id'];
					$service['time_slot']  = $slot['time_slot'];
					$durArray[] = $service;
				}
			}
		} else {
			foreach ($slots as $slot) {
				$service['id'] = $slot['id'];
				$service['time_slot']  = $slot['time_slot'];
				$durArray[] = $service;
				//$durArray[] = $slot['slot'];
				//$service['id'] = $slot['id'];
				//$service['slot']  = $slot['slot'];
				//$services[] = $service;
			}
		}
		$data['status']="true";
		$data['message']="slot list";
		$data['data']= $durArray;
		echo json_encode($data);

	}

	public function uploadDocument_post() {

		//$name =$this->input->post('name');
		//$document =$this->input->post('document');

		$path = "assets/images/booking/";

		$upload_url = base_url().$path;
		$response = array();

		if(isset($_POST['name']) && isset($_FILES['pdf']['name'])){
			$name = $_POST['name'];
			$docid = $name.mt_rand(10000,99999);
			//getting file info from the request
			$fileinfo = pathinfo($_FILES['pdf']['name']);

			//getting the file extension
			$extension = $fileinfo['extension'];

			//file url to store in the database
			$file_url = $upload_url . $docid . '.' . $extension;

			$file_path = $path . $docid . '.'. $extension;

			move_uploaded_file($_FILES['pdf']['tmp_name'],$file_path);

			$response['Status'] = "True";
			$response['url'] = $file_url;
			$response['name'] = $name;

		}else{
			$response['Status']= "false";
			$response['message']='Please choose a file';
		}

		/*if(!empty($document)){
			$docid = $name.mt_rand(10000,99999);

			$path = "assets/images/booking/$docid.png";

			$actualpath = base_url().$path;

			//file_put_contents($path,base64_decode($image));
			//$myfile2 = fopen($actualpath, "w") or die("Unable to open file!");
			file_put_contents($path,base64_decode($image));

			$data['status']="true";
			$data['message']="Document Uploaded";
		}else{
			$data['status']="true";
			$data['message']="Document is Blank";
		} */

		echo json_encode($response);


	}
	public function my_packges_post() {
		$this->load->library('api/OrderLib');
		$userid = $this->input->post('user_id');
                //$vehicle_id = $this->input->post('vehicle_id'); // optional
		if( $userid == '')
		{
			$response["Status"] = "false";
			$response["message"] = "User Id is blank";
		}
		else
		{
			$packages = $this->orderlib->getMyPackageList($userid);


			if(!empty($packages))
			{
				$result = array();
				foreach($packages as $value) {

					$temp = $value;
				foreach ($temp['services'] as $key => $value1) {
				   if($value1['remaing_service'] <= 0) {
				   		unset($temp['services'][$key]);
				   }
				}
				$temp['services'] = array_values($temp['services']);
				$result[] = $temp;
			  }
				$response["Status"] = "true";
				$response["message"] = "Package list retrive successfully";
				$response["data"] = $result;
			}
			else
			{
				$response["Status"] = "false";
				$response["message"] = "Sorry, you have not added any package";
			}
		}
		$this->response ($response,200);
    }

    public function particular_package_post()
    {
    	$this->load->library('api/OrderLib');
    	$tbl_user_pack_id = $this->input->post('tbl_user_pack_id');
		if( $tbl_user_pack_id == '')
		{
			$response["Status"] = "false";
			$response["message"] = "User Selected Package Id is blank";
		}
		else
		{
			$packages = $this->orderlib->particular_package($tbl_user_pack_id);
			if(!empty($packages))
			{
				$response["Status"] = "true";
				$response["message"] = "Package details retrive successfully";
				$response["data"] = $packages;
			}
			else
			{
				$response["Status"] = "false";
				$response["message"] = "No records found.";
			}
		}
		$this->response ($response,200);

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

}