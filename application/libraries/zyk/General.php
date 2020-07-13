<?php
class General {
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function addCategory($cat) {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$result = $this->CI->settings->addCategory ($cat);
	
		return $result;
	
	}
	
	
	
	public function getActiveCategories() {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$response = $this->CI->settings->getActiveCategories();
	
		return $response;
	
	}
	
	
	
	public function updateCategory($cat) {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$result = $this->CI->settings->updateCategory ( $cat );
	
		return $result;
	
	}
	
	
	
	public function getCategoryById($cat_id) {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$response = $this->CI->settings->getCategoryById ( $cat_id );
	
		return $response;
	
	}
	
	public function addSubCategory($cat) {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$result = $this->CI->settings->addSubCategory ($cat);
	
		return $result;
	
	}
	
	
	
	public function getSubActiveCategories() {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$response = $this->CI->settings->getSubActiveCategories();
	
		return $response;
	
	}
	
	
	
	public function updateSubCategory($cat) {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$result = $this->CI->settings->updateSubCategory ( $cat );
	
		return $result;
	
	}
	
	
	
	public function getSubCategoryById($cat_id) {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$response = $this->CI->settings->getSubCategoryById ( $cat_id );
	
		return $response;
	
	}
	
	public function addStatus($cat) {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$result = $this->CI->settings->addStatus ($cat);
	
		return $result;
	
	}
	
	
	
	public function getActiveStatus() {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$response = $this->CI->settings->getActiveStatus();
	
		return $response;
	
	}
	
	public function getActiveStatus1() {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$response = $this->CI->settings->getActiveStatus1();
	
		return $response;
	
	}
	
	
	
	public function updateStatus($cat) {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$result = $this->CI->settings->updateStatus ( $cat );
	
		return $result;
	
	}
	
	
	
	public function getStatusById($cat_id) {
	
		$this->CI->load->model ( 'general/Settings_model', 'settings');
	
		$response = $this->CI->settings->getStatusById ( $cat_id );
	
		return $response;
	
	}
	
	public function getCities() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$cities = $this->CI->settings->getAllCities ();
		return $cities;
	}
	public function getRestaurantsByVendor($vendorid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getRestaurantsByVendor ( $vendorid );
		return $areas;
	}
	public function getCityById($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$cities = $this->CI->settings->getCityById ( $id );
		return $cities;
	}
	public function turnOnCity($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$this->CI->settings->turnOnCity ( $id );
	}
	public function turnOffCity($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$this->CI->settings->turnOffCity ( $id );
	}
	public function addCity($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->addCity ( $params );
		return $response;
	}
	public function updateCity($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->updateCity ( $params );
		return $response;
	}
	public function getAreas() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getAllLocalities ();
		return $areas;
	}
	public function getAreasByCityId($cityid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getAreasByCityId ( $cityid );
		return $areas;
	}
	public function getAreasById($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getLocalityById ( $id );
		return $areas;
	}
	public function addArea($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->addLocality ( $params );
		return $response;
	}
	public function updateArea($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->updateLocality ( $params );
		return $response;
	}
	public function turnOnArea($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$this->CI->settings->turnOnLocality ( $id );
	}
	public function turnOffArea($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$this->CI->settings->turnOffLocality ( $id );
	}
	/*public function getCuisines() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$cuisines = $this->CI->settings->getAllCuisines ();
		return $cuisines;
	}*/
	public function getCuisineById($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$cuisines = $this->CI->settings->getCuisineById ( $id );
		return $cuisines;
	}
	public function addCuisine($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->addCuisine ( $params );
		return $response;
	}
	public function updateCuisine($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->updateCuisine ( $params );
		return $response;
	}
	public function deleteCuisine($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$this->CI->settings->deleteCuisine ( $id );
	}
	public function getRestByAreaId($cityid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getRestByAreaId ( $cityid );
		return $areas;
	}
	public function getAreaidandCityidByRestaurant($a) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupon' );
		$areas = $this->CI->coupon->getAreaidandCityidByRestaurant ( $a );
		return $areas;
	}
	public function addReason($params) {
		$this->CI->load->model ('general/Settings_model', 'settings');
		$response = $this->CI->settings->addReason($params);
		return $response;
	}
	
	public function updateReason($params) {
		$this->CI->load->model ('general/Settings_model', 'settings');
		$response = $this->CI->settings->updateReason($params);
		return $response;
	}
	
	public function deleteReason($id) {
		$this->CI->load->model ('general/Settings_model', 'settings');
		$this->CI->settings->deleteReason($id);
	}
	
	public function getActiveReasons() {
		$this->CI->load->model ('general/Settings_model', 'settings');
		$response = $this->CI->settings->getActiveReasons();
		return $response;
	}
	
	public function getReasonById($id) {
		$this->CI->load->model ('general/Settings_model', 'settings');
		$response = $this->CI->settings->getReasonById($id);
		return $response;
	}
	
	public function getCuisinesByArea($arealist) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$cuisines = $this->CI->settings->getCuisinesByArea($arealist);
		return $cuisines;
	}
		
	public function getZoneByCityId($cityid)
	{
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$zone = $this->CI->settings->getZoneByCityId($cityid);
		return $zone;
	}
	public function getAreaByZoneId ($zoneid)
	{
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$area = $this->CI->settings->getAreaByZoneId($zoneid);
		return $area;
	}
	public function getRestaurantByZoneId($zoneid)
	{
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$restaurant = $this->CI->settings->getRestaurantByZoneId($zoneid);
		return $restaurant;
	}
	
	
	public function saveContactUs($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$result = $this->CI->settings->saveContactUs($params);
		$map = array();
		if($result) {
			$map['status'] = 1;
			$map['message'] = 'Query added successfully.';
		} else {
			$map['status'] = 0;
			$map['message'] = 'Failed to add query.';
		}
		return $map;
	}
	
	public function addFeedback($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$result = $this->CI->settings->addFeedback($params);
		$map = array();
		if($result) {
			$map['status'] = 1;
			$map['message'] = 'Feedback added successfully.';
		} else {
			$map['status'] = 0;
			$map['message'] = 'Failed to add feedback.';
		}
		return $map;
	}
	
	public function getAreasByZoneId($zone_id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getAreasByZoneId ( $zone_id );
		return $areas;
	}
	
	public function saveRating($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$result = $this->CI->settings->saveRating ( $params );
		return $result;
	}
	
	public function saveReview($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$result = $this->CI->settings->saveReview ( $params );
		return $result;
	}
	
	public function getRestaurantReviews($restid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$result = $this->CI->settings->getRestaurantsReviews ( $restid );
		return $result;
	}
	
	public function addTicket($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->addTicket ($params);
		return $response;
	}
	
	public function addComment($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->addComment ($params);
		return $response;
	}
	
	public function updateTicket($params) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->updateTicket ($params);
		return $response;
	}
	
	public function getAllTickets() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->getAllTickets ();
		return $response;
	}
	
	public function getAllActiveTickets() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->getAllActiveTickets ();
		return $response;
	}
	
	public function getTicketById($ticketid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->getTicketById ($ticketid);
		return $response;
	}
	
	public function getUserComment($ticketid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->getUserComment ($ticketid);
		return $response;
	}
	
	public function getUserCommentByTicketId($ticketid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->getUserCommentByTicketId ($ticketid);
		return $response;
	}
	
	public function leadHistory($ticketid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response['priorities'] = $this->CI->settings->leadPriorityHistory($ticketid);
		$response['leadStatus'] = $this->CI->settings->leadStatusHistory($ticketid);
		$response['executives'] = $this->CI->settings->leadExecutiveHistory($ticketid);
		return $response;
	}
	
	public function updateLead($data) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->updateLead($data);
		return $response;
	}
	
	public function sendContactUSEmail($user) {
		//echo "inside email";
		//print_r($user);
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'G2G Contact Form';
		$this->CI->pkemail->subject = 'New Enquiry From Website';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = 'nikhil@garage2ghar.com';
		//$this->CI->pkemail->to = 'tushar@brandzgarage.com';
		$this->CI->template->set ( 'data', $user );
		$this->CI->template->set ( 'page', 'otp-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/contactus', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
	
	public function sendTicketSMS($details) {
		$sms_msg = "Hi ".$details ['name'].", We would like to acknowledge that we have received your complaint and we will get back to you shortly. Regards, The Moustache Laundry";
		$this->CI->load->library ( 'pksms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function getActiveAreas() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getActiveLocalities ();
		return $areas;
	}
	
	public function getSubCatId($id) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->getSubCatId ($id);
		return $response;
	}
	
	/*public function applyCoupon($data) {
		//print_r($data);
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$coupon = $this->CI->settings->getCouponByCode ($data);
		print_r($coupon);
		exit;
		$response = array();
		if(count($coupon) > 0) {
			if($coupon[0]['is_new_user'] == 1) {
				if(!empty($data['email'])) {
					$this->CI->load->model ('orders/Order_model','order');
					$orders = $this->CI->order->getOrdersByEmail($data['email']);
					if($orders > 0) {
						$response['status'] = 0;
						$response['msg'] = "Coupon is valid for New Users Only.";
					} else {
						$response['status'] = 1;
						if(!empty($coupon[0]['name'])) {
							$response['msg'] = "Coupon applied. Note: Coupon is valid on ".$coupon[0]['name'].' only.';
						} else {
							$response['msg'] = "Coupon applied.Discount value will be shown post pickup.";
							$response['order'] = $orders;
						}
						$response['coupon'] = $coupon[0];
					}
				} else {
					$response['status'] = 1;
					if(!empty($coupon[0]['name'])) {
						$response['msg'] = "Coupon applied. Note: Coupon is valid on ".$coupon[0]['name'].' only.';
					} else {
						$response['msg'] = "Coupon applied.Discount value will be shown post pickup.";
						$response['order'] = $orders;
					}
					$response['coupon'] = $coupon[0];
				}
			} else {
				if(!empty($data['email'])) {
					$this->CI->load->model ('orders/Order_model','order');
					$orders = $this->CI->order->getOrdersByEmailAndCoupon($data['email'],$data['coupon_code']);
					if($orders > 0) {
						$response['status'] = 0;
						$response['msg'] = "You have already used this coupon.";
					} else {
						$response['status'] = 1;
						if(!empty($coupon[0]['name'])) {
							$response['msg'] = "Coupon applied. Note: Coupon is valid on ".$coupon[0]['name'].' only.';
						} else {
							$response['msg'] = "Coupon applied.Discount value will be shown post pickup.";
							//$response['order'] = $orders;
						}
						$response['coupon'] = $coupon[0];
					}
				} else {
					$response['status'] = 1;
					if(!empty($coupon[0]['name'])) {
						$response['msg'] = "Coupon applied. Note: Coupon is valid on ".$coupon[0]['name'].' only.';
					} else {
						$response['msg'] = "Coupon applied.Discount value will be shown post pickup.";
						//	$response['order'] = $orders;
					}
					$response['coupon'] = $coupon[0];
				}
			}
		} else {
			$response['status'] = 0;
			$response['msg'] = "Coupon is not valid.";
		}
		//print_r($response);
		//exit;
		return $response;
	}*/
	public function applyCoupon($data) {
        //print_r($data);exit();
        $this->CI->load->model('general/Settings_model', 'settings');
        $coupon = $this->CI->settings->getCouponByCode($data);
 		 
        $response = array();
        $flag = 0;
        //flag=1 (coupon applied) and  flag=0 (invalid coupon) 
        if (count($coupon) > 0 && $coupon[0]['status'] > 0 ) {
            //check new or old user
 
        	$coupon = $coupon[0];
	        $coupon['coupon_code'] = $coupon['coupon_code'];
	        $coupon['coupon_category'] = $coupon['coupon_category'];
	        $coupon['category_id'] = explode(",", $coupon['category_id']);
	        $coupon['brand_id'] = explode(",", $coupon['brand_id']);
	        $coupon['model_id'] = explode(",", $coupon['model_id']);
	        $coupon['subcategory_id'] = explode(",", $coupon['subcategory_id']);
	        $coupon['catsubcat_id'] = explode(",", $coupon['catsubcat_id']);
	        $coupon['spare_id'] = explode(",", $coupon['spare_id']);
	        $coupon['service_id'] = explode(",", $coupon['service_id']); 
	        $coupon['package_id'] = explode(",", $coupon['package_id']); 


            if ($coupon['is_new_user'] == 1) {
                if (!empty($data['email'])) {
                    $this->CI->load->model('orders/Order_model', 'order');
                    $orders = $this->CI->order->getOrdersByEmail($data['email']);
                    //old user
                    if ($orders > 0) {
                        return $this->set_response_false('Valid for new users only');
                    } else {
                        $flag = 1;
                    }
                }
            } else {
                if (!empty($data['email'])) {
                    $this->CI->load->model('orders/Order_model', 'order');
                    $orders = $this->CI->order->getOrdersByEmailAndCoupon($data['email'], $data['coupon_code']);
                    if ($orders > 0) {
                        return $this->set_response_false('Already used this coupon');
                    } else {
                        $flag = 1;
                    }
                } else {
                    $flag = 1;
                }
            }
            //min order value
            if ($coupon['min_order_value'] <= $data['order_amount']) {
                $flag = 1;
            } else {
                $this->set_response_false('Minumn order amount is' . $coupon['min_order_value']);
            }

           
            if (!empty($data['package_id'])) { 

            	if ($coupon['coupon_category'] == 2 ) {
	          	  
	          		  if (in_array($data['package_id'], $coupon['package_id'])) {  
	           			$flag = 1;
	           		  }
	           		  else{ 
	                	return $this->set_response_false('Coupon not applicable for this package'); 
	           		  } 
	          }  

            } 
            else{ 

	            if (in_array($data['category_id'], $coupon['category_id'])) {

	                if (in_array($data['subcategory_id'], $coupon['subcategory_id'])) {

	                    if (count(array_intersect($data['catsubcat_id'], $coupon['catsubcat_id']))) { 

	                        if (in_array($data['brand_id'], $coupon['brand_id'])) { 

	                            if (in_array($data['model_id'], $coupon['model_id'])) {


	                                /*if (count(array_intersect($data['service_id'], $coupon['service_id'])) || count(array_intersect($data['spare_id'], $coupon['spare_id']))) {
	                                    $flag = 1;
	                                } else {
	                                    if(!empty($coupon['service_id'])) {
	                                         return $this->set_response_false('Coupon not applicable for this service');
	                                    }
	                                    if(!empty($coupon['spare_id'])) {
	                                         return $this->set_response_false('Coupon not applicable for this spare');
	                                    }
	                                }*/
	                                
	                            } else {
	                                /* model check */
	                                return $this->set_response_false('Coupon not applicable for this model');
	                            }
	                        } else {
	                            /* brand check */
	                            return $this->set_response_false('Coupon not applicable for this brand');
	                        }
	                    } else {
	                        return $this->set_response_false('Coupon not applicable for this service group');
	                    }
	                } else {
	                    return $this->set_response_false('Coupon not applicable for this service type');
	                }
	            } else {
	                return $this->set_response_false('Coupon not applicable for this category');
	           	}  

            } 
 
        } else {
            $response['status'] = 0;
            $response['msg'] = "Coupon is not valid.";
            return $response;
        }

        if ($flag == 1) {
            return $this->set_response_true($coupon);
        }
    }

    public function set_response_true($data) {
        $response = array('status' => 1, 'msg' => 'Coupon applied successfully.', 'coupon' => $data);
        return $response;
    }

    public function set_response_false($msg) {
        $response = array('status' => 0, 'msg' => $msg);
        return $response;
    }
	public function getredeemconfig() {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$result = $this->CI->settings->getredeemconfig ();
		return $result;
	}
	public function addSubscription($params) { 
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$response = $this->CI->settings->addSubscription ($params);
		return $response;
	}
}
