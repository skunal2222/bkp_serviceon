<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * General API
 * @author Tushar
 * @package Service
 *
 */
class Api extends REST_Controller {
	
	public function checkservice_post() {
		$map = array ();
		$this->load->library ( 'zyk/UserLib' );
		
		$map['locality'] = $this->post('locality');
		$map['latitude'] = $this->post('latitude');
		$map['longitude'] = $this->post('longitude');
		
		if (empty($map['locality']))
		{
			$response["success"] = "false";
			$response["msg"] = "Empty Area";
		}else{
			$this->load->library('zyk/RestaurantLib');
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
				$address['vendor_id'] = $vendors[0]['id'];
				$address['vendor_id1'] = $vendors[1]['id'].','.$vendors[2]['id'];
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
		
		$this->load->library('zyk/ServiceLib', 'servicelib');
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
		$this->load->library('zyk/ServiceLib', 'servicelib');
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
		$this->load->library('zyk/ServiceLib', 'servicelib');
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
		$this->load->library('zyk/ServiceLib', 'servicelib');
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
		$this->load->library('zyk/ServiceLib', 'servicelib');
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
	    
	    $data['json'] = json_encode($_POST); 
	    $this->db->insert('tbl_json',$data);

	    $params = array();
		$notification = array();
		$this->load->library ( 'zyk/UserLib' );
		
		$reg = array ();
		$reg ['name'] = trim($this->input->post('name'));
		$reg ['email'] = $this->input->post('email');
		$reg ['mobile'] =$this->input->post('mobile');
		
		$reg['address'] = $this->input->post('address');
		$reg['landmark'] = $this->input->post('landmark');
		$reg['latitude'] = $this->input->post('latitude');
		$reg['longitude'] = $this->input->post('longitude');
		$reg['address_type'] = $this->input->post('address_type');
		//$reg ['source'] = 'Frontend';
		$register = $this->userlib->updateUser( $reg );
		
		$params['userid'] =$this->input->post('userid');
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
		$params['latitude'] = $this->input->post('latitude');
		$params['longitude'] = $this->input->post('longitude');
		$params['vendor_id'] = $this->input->post('vendor_id');
		$params['other_vendorid'] = $this->input->post('vendor_id1');
		$params['vendor_response'] =1;
		
		$params['category_id'] = $this->input->post('category_id');
		$params['brand_id'] = $this->input->post('brand_id');
		$params['subcategory_id'] = $this->input->post('subcategory_id');
		$params['vehicle_model'] = $this->input->post('model_id');
		$params['catsubcat_id'] = $this->input->post('catsubcat_id');
			
		$params['slot'] = $this->input->post('visit_time');
		$params['comment'] =$this->input->post('comment');
		//$params['status'] = 1;
		$params['service'] = '';
		//$params['coupon_code'] = $this->input->post('coupon_code');
		
		$image =$this->input->post('image');
		$image1 =$this->input->post('image1');
		
		if(!empty($image)){
			$imageid = $params['subcategory_id'].mt_rand(10000,99999);
			$path = "assets/images/booking/$imageid.png";
			$actualpath = base_url().$path;
			
			//file_put_contents($path,base64_decode($image));
			//$myfile2 = fopen($actualpath, "w") or die("Unable to open file!");
			file_put_contents($path,base64_decode($image));
			$params['image'] = $actualpath;
		}else{
			$params['image'] = ''; 
		}
		
		if(!empty($image1)){
			$imageid1 = $params['subcategory_id'].mt_rand(1000,9999);
			$path1 = "assets/images/booking/$imageid1.png";
			$actualpath1 = base_url().$path1;
			//file_put_contents($path,base64_decode($image1));
			file_put_contents($path1,base64_decode($image1));
			$params['image1'] = $actualpath1;
		}else{
			$params['image1'] = '';
		}
		
		$option= $this->input->post('discount_type');
		$couponcode = $this->input->post('coupon_code');
		if($option == 'promocode') {
			if(!empty($couponcode))
				$params['coupon_code'] = $couponcode;
		} else {
			if($option == "credits")
				$params['wallet_discount'] = 1;
		}
		
		if(!empty($this->input->post('visit_date')))
			$params['pickup_date'] = date('Y-m-d',strtotime($this->input->post('visit_date')));
		else
			$params['pickup_date'] = date('Y-m-d');
		$del_date = date('Y-m-d',strtotime('+48 hours',strtotime($params['pickup_date'])));
		$params['delivery_date'] = date('Y-m-d',strtotime('+72 hours',strtotime($params['pickup_date'])));
		$params['ordered_on'] = date('Y-m-d H:i:s');
		$params['source'] = 1;
		$params['status'] = 0;
		$this->load->library('zyk/OrderLib');
		
 		
		
		$orderid = $this->orderlib->addOrder($params);
	
		 $uid = $params['userid'];
		/* $notification['user_id']=$uid;
		$notification['message'] ='G2G is happy to receive your order request';
		$notification['status']=1;
		$notification['type']='Booking Notification';
		$this->orderlib->addNotification($notification); */
		
		$this->orderlib->sendBookingNotification($uid);

		if($orderid > 0) {
			$params['orderid'] = $orderid;
			//$this->orderlib->sendBookingEmail($params);
			//$this->orderlib->sendBookingSMS($params);
			$oupdate = array();
			$oupdate['orderid'] = $orderid;
			$oupdate['ordercode'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($orderid, 10, 36)) ;
			$this->orderlib->updateOrder($oupdate);
			
			$logs = array();
			$logs['orderid'] = $orderid;
			$logs['comment'] = 'Booking Request Sent';
			$logs['created_date'] = date('Y-m-d H:i:s');
			$logs['order_status'] = 0;
			$logs['created_by'] = 0;
			$this->orderlib->addOrderLogs($logs);
			
			$response['orderid'] = $orderid;
			$response['status'] = 1;
			$response['msg'] = "Order placed successfully!!";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Failed to add order";
		}
		//print_r($response);exit ; 
		echo json_encode($response);
	}
	
	public function getOrderHistory_post(){
		$id = $this->post ( 'user_id' );
		$this->load->library ( 'zyk/UserLib' );
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
		$this->load->library ( 'zyk/UserLib' );
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
		$this->load->library('zyk/SlotLib', 'slotlib');
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
	
	
}