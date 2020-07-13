<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * General API
 * @author pradeepsingh
 * @package General
 *
 */
class Api extends REST_Controller {
	
	public function checkcoupon_post() {
		$couponcode = $this->post('couponcode');
		$email = $this->post('email');
		$category_id = $this->post('category_id');
		$brand_id = $this->post('brand_id'); 
		$date = $this->post('order_date');
		$package_id = $this->post('package_id');

		$this->load->library('api/General');
		
		if($couponcode != "" && $email != "") {
			$data = array();
			$data['coupon_code'] = $couponcode;
			$data['order_date'] = date('Y-m-d',strtotime($date));
			$data['email'] = $email;
			$data['category_id'] = $category_id;
			$data['brand_id'] = $brand_id;
			$data['package_id'] = $package_id;
			
			$coupon = $this->general->applyCoupon($data);
			if($coupon['status'] == 0) {
				$resp["success"] = "false";
				$resp["msg"] = $coupon['msg'];
			} else {
				$resp["success"] = "true";
				$resp["msg"] = $coupon['msg'];
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "coupon code or emailid is blank";
		}
		$this->response ($resp,200);
	}
	
	public function checkcouponold_post() {
		$couponcode = $this->post('couponcode');
		$email = $this->post('email');
		$this->load->library('mylib/General');
		$date = date('Y-m-d');
		if($couponcode != "" && $email != "") {
			$data = array();
			$data['coupon_code'] = $couponcode;
			$data['order_date'] = date('Y-m-d',strtotime($date));
			$data['email'] = $email;
			$coupon = $this->general->applyCoupon($data);
			if($coupon['status'] == 0) {
				$resp["success"] = "false";
				$resp["msg"] = $coupon['msg'];
			} else {
				$resp["success"] = "true";
				$resp["msg"] = $coupon['msg'];
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "coupon code or emailid is blank";
		}
		echo json_encode($resp);
	}
	
	public function productlist_post() {
		$dryclean=array();
		$wetclean=array();
		$ironing=array();
		$this->load->library('mylib/ItemLib');
		$items = $this->itemlib->getActiveItems();
		foreach($items as $item) {
			$productid = $item['id'];
			$productname = $item['name'];
			$productcategory = $item['cat_id'];
			$unit_price = $item['price'];
			$unit_price = round($unit_price,2);
	
			if($productcategory == 1)
			{
				$dry['productid'] = $productid;
				$dry['productname'] = $productname;
				$dry['unitprice']= "Rs.".$unit_price."/piece";
				$dryclean[] = $dry;
			} else if ($productcategory == 2) {
				$wet['productid'] = $productid;
				$wet['productname'] = $productname;
				$wet['unitprice'] = "Rs.".$unit_price."/kg";
				$wetclean[] = $wet;
			} else if ($productcategory == 3) {
				$iron['productid'] = $productid;
				$iron['productname'] = $productname;
				$iron['unitprice'] = "Rs.".$unit_price."/piece";
				$ironing[] = $iron;
			}
		}
		$all_products=array();
		$so = array();
		$all_products['wetcleaning'] = $wetclean;
		$all_products['drycleaning'] = $dryclean;
		$all_products['ironing'] = $ironing;
		$so[] = $all_products;
	
		$data['success']="true";
		$data['products'] = $so;
		$this->response ($data,200);
	}
	
	public function productlistold_post() {
		$dryclean=array();
		$wetclean=array();
		$ironing=array();
		$this->load->library('mylib/ItemLib');
		$items = $this->itemlib->getActiveItems();
		foreach($items as $item) {
			$productid = $item['id'];
			$productname = $item['name'];
			$productcategory = $item['cat_id'];
			$unit_price = $item['price'];
			$unit_price = round($unit_price,2);
	
			if($productcategory == 1)
			{
				$dry['productid'] = $productid;
				$dry['productname'] = $productname;
				$dry['unitprice']= "Rs.".$unit_price."/piece";
				$dryclean[] = $dry;
			} else if ($productcategory == 2) {
				$wet['productid'] = $productid;
				$wet['productname'] = $productname;
				$wet['unitprice'] = "Rs.".$unit_price."/kg";
				$wetclean[] = $wet;
			} else if ($productcategory == 3) {
				$iron['productid'] = $productid;
				$iron['productname'] = $productname;
				$iron['unitprice'] = "Rs.".$unit_price."/piece";
				$ironing[] = $iron;
			}
		}
		$all_products=array();
		$so = array();
		$all_products['wetcleaning'] = $wetclean;
		$all_products['drycleaning'] = $dryclean;
		$all_products['ironing'] = $ironing;
		$so[] = $all_products;
	
		$data['success']="true";
		$data['products'] = $so;
		echo json_encode($data);
	}
	
	public function couponlist_post() {
		$this->load->library('mylib/General');
		$coupons = $this->general->getActiveCoupons();
		$coupon = array();
		if(count($coupons) > 0) {
			foreach ($coupons as $cpn) {
				if($cpn['coupon_code'] != "ES20" && $cpn['coupon_code'] != "TML20" && $cpn['coupon_code'] != 'YOU30') {
					$response["couponcode"] = $cpn['coupon_code'];
					$response["title"] = $cpn['title'];
					$response["description"] = $cpn['description'];
					$response["validdate"] = "Offer valid till ".date('d-m-Y',strtotime($cpn['end_date']));
					$coupon[]=$response;
				}
			}
			$data["success"] = "true";
			$data["coupons"] = $coupon;
		} else {
			$data["success"] = "false";
			$data["msg"] = "no coupons found";
		}
		$this->response ($data,200);
	}
	
	public function couponlistold_post() {
		$this->load->library('mylib/General');
		$coupons = $this->general->getActiveCoupons();
		$coupon = array();
		if(count($coupons) > 0) {
			foreach ($coupons as $cpn) {
				if($cpn['coupon_code'] != "ES20" && $cpn['coupon_code'] != "TML20" && $cpn['coupon_code'] != 'YOU30') {
					$response["couponcode"] = $cpn['coupon_code'];
					$response["title"] = $cpn['title'];
					$response["description"] = $cpn['description'];
					$response["validdate"] = "Offer valid till ".date('d-m-Y',strtotime($cpn['end_date']));
					$coupon[]=$response;
				}
			}
			$data["success"] = "true";
			$data["coupons"] = $coupon;
		} else {
			$data["success"] = "false";
			$data["msg"] = "no coupons found";
		}
		echo json_encode($data);
	}
	
	public function addticket_post() {
		$email = $this->post('email');
		$quantity = $this->post('quantity');
		$description = $this->post('description');
		$dt_tm = date('Y-m-d H:i:s');
		if($email!="") {
			$this->load->library ( 'mylib/UserLib' );
			$this->load->library('mylib/General');
			$user = $this->userlib->getUserByEmail ( $email );
			if(count($user) > 0) {
				$ticket = array();
				$ticket['priority'] = 2;
				$ticket['userid'] = $user[0]['id'];
				$ticket['orderid'] = 0;
				$ticket['subject'] = 'New Ticket';
				$ticket['description'] = $description;
				$ticket['type'] = 1;
				$ticket['quantity'] = $quantity;
				$ticket['created_date'] = $dt_tm;
				$ticket['updated_date'] = $dt_tm;
				$id = $this->general->addTicket($ticket);
				$ticket_no = 'TT'.$id;
				$tp = array();
				$tp['ticketid'] = $id;
				$tp['ticket_no'] = $ticket_no;
				$this->general->updateTicket($tp);
				$tsms = array();
				$tsms['name'] = $user[0]['name'];
				$tsms['mobile'] = $user[0]['mobile'];
				$tsms['email'] = $email;
				$tsms['message'] = $description;
				$this->general->sendTicketSMS($tsms);
				$this->general->notifyFeedBack($tsms);
				$resp["success"] = "true";
				$resp["msg"] = "We are sorry for this. Please handover those clothes to us separately on your next wash";
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
	
	public function addticketold_post() {
		$email = $this->post('email');
		$quantity = $this->post('quantity');
		$description = $this->post('description');
		$dt_tm = date('Y-m-d H:i:s');
		if($email!="") {
			$this->load->library ( 'mylib/UserLib' );
			$this->load->library('mylib/General');
			$user = $this->userlib->getUserByEmail ( $email );
			if(count($user) > 0) {
				$ticket = array();
				$ticket['priority'] = 2;
				$ticket['userid'] = $user[0]['id'];
				$ticket['orderid'] = 0;
				$ticket['subject'] = 'New Ticket';
				$ticket['description'] = $description;
				$ticket['type'] = 1;
				$ticket['quantity'] = $quantity;
				$ticket['created_date'] = $dt_tm;
				$ticket['updated_date'] = $dt_tm;
				$id = $this->general->addTicket($ticket);
				$ticket_no = 'TT'.$id;
				$tp = array();
				$tp['ticketid'] = $id;
				$tp['ticket_no'] = $ticket_no;
				$this->general->updateTicket($tp);
				$tsms = array();
				$tsms['name'] = $user[0]['name'];
				$tsms['mobile'] = $user[0]['mobile'];
				$tsms['email'] = $email;
				$tsms['message'] = $description;
				$this->general->sendTicketSMS($tsms);
				$this->general->notifyFeedBack($tsms);
				$resp["success"] = "true";
				$resp["msg"] = "We are sorry for this. Please handover those clothes to us separately on your next wash";
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "contact not found";
			}
		} else {
			$resp["success"] = "false";
			$resp["msg"] = "email is blank";
		}
		echo json_encode($resp);
	}
	
	public function addcomplaint_post() {
		$email = $this->post('email');
		$complaint = $this->post('complaint');
		$orderid = $this->post('salesorderid');
		$dt_tm = date('Y-m-d H:i:s');
		
		if( $orderid == "") {
			$resp["success"] = "false";
			$resp["msg"] = "Salesorder not found";
		}
		else
		{
			if ($email != "") {
				$this->load->library ( 'mylib/UserLib' );
				$this->load->library('mylib/General');
				$user = $this->userlib->getUserByEmail ( $email );
				if(count($user) > 0) {
					$ticket = array();
					$ticket['priority'] = 2;
					$ticket['userid'] = $user[0]['id'];
					$ticket['orderid'] = $orderid;
					$ticket['subject'] = 'New Ticket';
					$ticket['description'] = $complaint;
					$ticket['type'] = 1;
					$ticket['quantity'] = 0;
					$ticket['created_date'] = $dt_tm;
					$ticket['updated_date'] = $dt_tm;
					$id = $this->general->addTicket($ticket);
					$ticket_no = 'TT'.$id;
					$tp = array();
					$tp['ticketid'] = $id;
					$tp['ticket_no'] = $ticket_no;
					$this->general->updateTicket($tp);
					$tsms = array();
					$tsms['name'] = $user[0]['name'];
					$tsms['mobile'] = $user[0]['mobile'];
					$tsms['email'] = $email;
					$tsms['message'] = $complaint;
					$this->general->sendTicketSMS($tsms);
					$this->general->notifyFeedBack($tsms);
					$resp["success"] = "true";
					$resp["msg"] = "We acknowledge the reciept of your complaint. Our Moustache Man will get in touch with you soon.";
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "contact not found";
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "email is blank";
			}
		}
		$this->response ($resp,200);
	}
	
	public function addcomplaintold_post() {
		$email = $this->post('email');
		$complaint = $this->post('complaint');
		$orderid = $this->post('salesorderid');
		$dt_tm = date('Y-m-d H:i:s');
	
		if( $orderid == "") {
			$resp["success"] = "false";
			$resp["msg"] = "Salesorder not found";
		}
		else
		{
			if ($email != "") {
				$this->load->library ( 'mylib/UserLib' );
				$this->load->library('mylib/General');
				$user = $this->userlib->getUserByEmail ( $email );
				if(count($user) > 0) {
					$ticket = array();
					$ticket['priority'] = 2;
					$ticket['userid'] = $user[0]['id'];
					$ticket['orderid'] = $orderid;
					$ticket['subject'] = 'New Ticket';
					$ticket['description'] = $complaint;
					$ticket['type'] = 1;
					$ticket['quantity'] = 0;
					$ticket['created_date'] = $dt_tm;
					$ticket['updated_date'] = $dt_tm;
					$id = $this->general->addTicket($ticket);
					$ticket_no = 'TT'.$id;
					$tp = array();
					$tp['ticketid'] = $id;
					$tp['ticket_no'] = $ticket_no;
					$this->general->updateTicket($tp);
					$tsms = array();
					$tsms['name'] = $user[0]['name'];
					$tsms['mobile'] = $user[0]['mobile'];
					$tsms['email'] = $email;
					$tsms['message'] = $complaint;
					$this->general->sendTicketSMS($tsms);
					$this->general->notifyFeedBack($tsms);
					$resp["success"] = "true";
					$resp["msg"] = "We acknowledge the reciept of your complaint. Our Moustache Man will get in touch with you soon.";
				} else {
					$resp["success"] = "false";
					$resp["msg"] = "contact not found";
				}
			} else {
				$resp["success"] = "false";
				$resp["msg"] = "email is blank";
			}
		}
		echo json_encode($resp);
	}
	
	public function servicelist_post() {
		
		$this->load->library('mylib/ItemLib');
		$items = $this->itemlib->getActiveCategories();
		
		$services = array();
		foreach($items as $item) {
			$service['ServiceId'] = $item['id'];
			$service['ServiceName']  = $item['name'];
			$services[] = $service;
						
		}
		
		$data['status']="true";
		$data['message']="Service list";
		$data['data']= $services;
		
		echo json_encode($data);
	}
	
	public function checkservice_post() {
		$service = array ();
		$service['area_id'] = $this->post('AreaId');
		$service['product_id'] = $this->post('ServiceId');
		
		if (empty($service['area_id']) || empty($service['product_id']))
		{
			$response["success"] = "false";
			$response["msg"] = "Empty Area or Service";
		}
		else{
		    $this->load->library('mylib/General');
			$areas = $this->general->checkServiceArea($service);
			//print_r($areas);
			if($areas[0]['status'] == 1) {
				/* $gcm = array();
					$gcm['id'] = $user[0]['id'];
					$gcm['gcm_reg_id'] = $this->post('gcm_code');
					$this->userlib->updateUserProfile($gcm); */
				/*$contact_details = array();
				$data = new stdClass();
				//$data->AreaId = $areas[0]['id'];
				$data->AreaName = $areas[0]['name'];
				$data->Pincode = $areas[0]['pincode'];
				array_push($contact_details,$data);*/
				$response["success"] = "true";
				$response["msg"] = "Service is Available";
				//$response["data"] = $contact_details;
			} else {
				$response["success"] = "false";
				$response["msg"] = "Service is Not Available";
			}
		}	
		//$this->response ($resp,200);
		echo json_encode($response);
	}
	
	public function serviceprice_post() {
		
		$catid = $this->post('service_id');
		$this->load->library('mylib/ItemLib');
		//$items = $this->itemlib->getRateByCatId($catid);
		$items = $this->itemlib->getActiveItemsByCatId($catid);
		
		$services = array();
		if($catid == 1){
			foreach($items as $item) {
				
				$ser = $item['section'];
				
				if($ser == 1){
				    $section = 'MENSWEAR';
				}
				if($ser == 2){
					$section = 'WOMENSWEAR';
				}
				if($ser == 3){
					$section = 'OTHERS';
				}
				
				$service['section'] = $section;
				$service['product_name'] = $item['name'];
				$service['price'] = $item['price'];
				$services[] = $service;
							
			}
		} else { 
			foreach($items as $item) {
			
				//$service['section'] = $item['section'];
				$service['product_name'] = $item['name'];
				$service['price']= $item['price'];
				$services[] = $service;
					
			}
		}
		
		$data['status']="true";
		$data['message']="Service price list";
		$data['data']= $services;
		echo json_encode($data);
	}
	
	public function pickupslot_post() {
	
		$this->load->library('mylib/General');
		$slots = $this->general->getPickupSlots();
	
		$services = array();
		foreach($slots as $item) {
			$service['id'] = $item['id'];
			//$service['ratecard_name'] = $item['ratecard_name'];
			$service['slot']  = $item['slot'];
			//$service['price']  = $item['price'];
			$services[] = $service;
		}
		$data['status']="true";
		$data['message']="Pickupslot list";
		$data['data']= $services;
		echo json_encode($data);
	}
	
	/*public function deliveryslot_post() {
	
		$this->load->library('mylib/General');
		$slots = $this->general->getPickupSlots();
	
		$services = array();
		foreach($slots as $item) {
			$service['id'] = $item['id'];
			//$service['ratecard_name'] = $item['ratecard_name'];
			$service['slot']  = $item['slot'];
			//$service['price']  = $item['price'];
			$services[] = $service;
	
		}
		$data['status']="true";
		$data['message']="Deliveryslot list";
		$data['data']= $services;
		echo json_encode($data);
	}  */
	
	public function deliveryslot_post() {
		
	$del_date = $this->post('del_date');
	$date = date('Y-m-d', strtotime($del_date));
	$current_date = date('Y-m-d');
	$current_time = date('H:i');
	$current_time_ext = date('H:i',strtotime('+45 minutes'));
	$this->load->library('mylib/General');
	$slots = $this->general->getActivePickupSlots();
	$durArray = array();
	$day = date('D',strtotime($date));
	//$services = array();
	if($date == date('Y-m-d')) {
		foreach ($slots as $slot) {
			$slot_arr = explode('-',$slot['slot']);
			$from_time = date('H:i',strtotime($slot_arr[0]));
			$to_time = date('H:i',strtotime($slot_arr[1]));
			if($current_time < $from_time) {
				$service['id'] = $slot['id'];
				$service['slot']  = $slot['slot'];
				$durArray[] = $service;
			}
		}
	} else {
		foreach ($slots as $slot) {
			$service['id'] = $slot['id'];
			$service['slot']  = $slot['slot'];
			$durArray[] = $service;
			//$durArray[] = $slot['slot'];
			//$service['id'] = $slot['id'];
			//$service['slot']  = $slot['slot'];
			//$services[] = $service;
		}
	}
	$data['status']="true";
	$data['message']="Deliveryslot list";
	$data['data']= $durArray;
	echo json_encode($data);
	
	}
	
	public function getActiveCoupons_post() {
		$this->load->library('api/CoupanLib');
		$coupons = $this->coupanlib->getActiveCoupons();
		$coupon = array();
		if(count($coupons) > 0) {
			foreach ($coupons as $cpn) {
				//if($cpn['coupon_code'] != "ES20" && $cpn['coupon_code'] != "TML20" && $cpn['coupon_code'] != 'YOU30') {
					$response["couponcode"] = $cpn['coupon_code'];
					$response["name"] = $cpn['name'];
					$response["description"] = $cpn['description'];
					$response["validdate"] = "Offer valid till ".date('d-m-Y',strtotime($cpn['end_date']));
					$coupon[]=$response;
				//}
			}
			$data["success"] = "true";
			$data["coupons"] = $coupon;
		} else {
			$data["success"] = "false";
			$data["msg"] = "no coupons found";
		}
		$this->response ($data,200);
	}

	public function save_driving_license_post(){
 
    	$myFile = APPPATH."/third_party/sample.json";
        $arr_data = $_POST; // create empty array
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($myFile, '');
        file_put_contents($myFile, $jsondata);


		$data=array();
		 
		$data['user_id'] = $this->input->post('user_id');
		$user_name = $this->input->post('user_name');  
  		$image =$this->input->post('image');

  		if (!empty($data['user_id'])) { 

	  		if(!empty($image))
			{
				$imageid = $user_name.'_DL'.mt_rand(10000,99999);
				$path = "assets/images/vehicles_documents/".$imageid.".png";
				$actualpath = base_url().$path;
				file_put_contents($path,base64_decode($image)); 
				$data['license_url'] = $actualpath;
			} 
 
	    $this->load->library ( 'api/MechanicLib' );
		$result = $this->mechaniclib->add_user_vehicle_license( $data );
		 
			$success_response["success"] = "true";
			$success_response["msg"] = $result['msg'];
		} else {
			$success_response["success"] = "false";
			$success_response["msg"] = "user id is blank";
		}
		 echo json_encode($success_response);
	}
	
	
}
