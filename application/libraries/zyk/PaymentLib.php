<?php
require APPPATH.'third_party/Instamojo.php';
class PaymentLib {
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function getPaymentUrl($params) {
		//$msg = array('status'=>1,'msg'=>'Payment request sent successfully.');
		//$instamojo = new Instamojo('af946740ad4853874798abd8eeeb70d2','aa858bff752968630808dc34cb7dfcc4');
		// $instamojo = new Instamojo('7345301cb70f2f317f8979f9952a9d3b','a5bbd3114abc29d0243fd44e2488affa');
		//$instamojo = new Instamojo('8e6de222b29df5688e9ae263d97ec68f','eeac5ad6aae1d8d764c44d17361121ca');

		$instamojo = new Instamojo('65b23b080ac62a1c2aeb1a7587117334','1579ce87964a2f252d22ece0a137bf2a');
		try {
			$response = $instamojo->paymentRequestCreate(array(
					"purpose" => "ServiceOn payment",
					"buyer_name" => $params['name'],
					"amount" => $params['amount'],     
					"send_email" => true,
					"send_sms" => true,
					"email" => $params['email'],
					"phone" => $params['mobile'],
					"webhook" =>base_url()."admin/payment_response",
					"redirect_url" => base_url().'payment_status',
					"allow_repeated_payments" => true
			));
			$data = json_encode($response);
//                        echo "<pre>";
//                        print_r($response);
//                        exit;
			error_log($data,0);
			$obj = json_decode($data);
			$id = $obj->{'id'};
			$url=$obj->{'longurl'};
			if(!empty($obj->{'longurl'})) {
				$payment = array();
				$payment['orderid'] = $params['orderid'];
				$payment['transactionid'] = $id;
				$payment['longurl'] = $obj->{'longurl'};
				$payment['email'] = $params['email'];
				$payment['amount'] = $params['amount'];
				$payment['phone'] = $params['mobile'];
				$payment['shorturl'] ='';
				$payment['status'] =$obj->{'status'};
				$this->CI->load->model ('users/User_model','user');
				$respurl=$this->CI->user->addPaymentDetail($payment);
				$msg['status'] = 1;
				$msg['msg'] = "Payment request sent successfully.";
				
			} else {
				$msg['status'] = 0;
				$msg['msg'] = "Failed to sent payment request.";
			}
		} catch (Exception $e) {
			$msg['status'] = 0;
			$msg['msg'] = "Failed to sent payment request.";
			error_log('Exception',0);
                    //    $url = '1222';
		}
		return $url;
	}
	
	public function updatePayment($params) {
		//echo "inside updatepayment";
		$this->CI->load->model ('users/User_model','user');
		$flag = $this->CI->user->updatePaymentDetail($params);
	/*	if($params['status'] == 'Credit') {
			$pay_details = $this->CI->user->getPaymentByTransId($params['transactionid']);
			$orderid = $pay_details[0]['orderid'];
			$umap = array();
			$umap['id'] = $orderid;
			$umap['amount'] = $params['amount'];
			$this->CI->user->updateForm($umap);
			
		} */
		return $flag;
	}

	public function updateRidePayment($params) {
		$this->CI->load->model ('users/User_model','user');
		$flag = $this->CI->user->updateRidePaymentDetail($params);
		return $flag;
	}
	
	public function createInstaTransaction($params) {
		//echo "inside payment";
		//print_r($params);
		$msg = array();
		//$instamojo = new Instamojo('af946740ad4853874798abd8eeeb70d2','aa858bff752968630808dc34cb7dfcc4');
		// $instamojo = new Instamojo('7345301cb70f2f317f8979f9952a9d3b','a5bbd3114abc29d0243fd44e2488affa');
		//$instamojo = new Instamojo('8e6de222b29df5688e9ae263d97ec68f','eeac5ad6aae1d8d764c44d17361121ca');
		$instamojo = new Instamojo('65b23b080ac62a1c2aeb1a7587117334','1579ce87964a2f252d22ece0a137bf2a');
		try {
			$response = $instamojo->paymentRequestCreate(array(
					"purpose" => "GarageDemo payment",
					"buyer_name" => $params['name'],
					"amount" => $params['amount'],
					"send_email" => true,
					"send_sms" => true,
					"email" => $params['email'],
					"phone" => $params['mobile'],
					"webhook" =>base_url()."crm/payment_response",
					"redirect_url" => base_url(),
					"allow_repeated_payments" => true
			));
			$data = json_encode($response);
			error_log($data,0);
			//print_r($data);
			$obj = json_decode($data);
			$id = $obj->{'id'};
			if(!empty($obj->{'longurl'})) {
				$payment = array();
				$payment['orderid'] = $params['orderid'];
				$payment['transactionid'] = $id;
				$payment['longurl'] = $obj->{'longurl'};
				$payment['email'] = $params['email'];
				$payment['amount'] = $params['amount'];
				$payment['phone'] = $params['mobile'];
				$payment['shorturl'] ='';
				$payment['status'] =$obj->{'status'};
				$this->CI->load->model ('users/User_model','user');
				$respurl=$this->CI->user->addPaymentDetail($payment);
				$msg['status'] = 1;
				$msg['msg'] = "Payment request sent successfully.";
				$msg['url'] = $obj->{'longurl'};
			} else {
				$msg['status'] = 0;
				$msg['msg'] = "Failed to sent payment request.";
			}
		} catch (Exception $e) {
			$msg['status'] = 0;
			$msg['msg'] = "Failed to sent payment request.";
			error_log('Exception',0);
		}
		return $msg;
	}
	
	public function createSimpleTransaction($data) {
		$this->CI->load->library('mylib/OrderLib');
		$orders = $this->CI->orderlib->getOrderDetails($data['orderid']);
		$items = $this->CI->orderlib->getOrderItems($data['orderid']);
		$url = $this->simpl_base_url.'api/v1/transactions';
		$params = array();
		$params['transaction_token'] = $data['transaction_token'];
		$params['amount_in_paise'] = $orders[0]['grand_total']*100;
		$params['order_id'] = $data['orderid'];
		$params['shipping_amount_in_paise'] = $orders[0]['delivery_charge']*100;
		$params['discount_in_paise'] = $orders[0]['discount']*100;
		$newitems = array();
		foreach ($items as $item) {
			$newitem = array();
			$newitem['sku'] = $item['item_id'];
			if($item['cat_id'] == 2) {
				$newitem['quantity'] = $item['weight'];
			} else {
				$newitem['quantity'] = $item['quantity'];
			}
			$newitem['unit_price_in_paise'] = $item['item_price']*100;
			$newitem['display_name'] = $item['item_name'];
			$newitems[] = $newitem;
		}
		$params['items'] = $newitems;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:7c224f7b1413487196db4a40d31c7319','Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec ($ch);
		error_log($result,0);
		curl_close ($ch);
		$response = json_decode($result,true);
		$resp = array();
		if($response['success']) {
			if($response['data']['transaction']['status'] == 'CHARGED' || $response['data']['transaction']['status'] == 'CLAIMED') {
				$payment = array();
				$payment['orderid'] = $data['orderid'];
				$payment['transactionid'] = $response['data']['transaction']['transaction_id'];
				$payment['longurl'] = '';
				$payment['email'] = $orders[0]['email'];
				$payment['amount'] = $orders[0]['grand_total'];
				$payment['phone'] = $orders[0]['mobile'];
				$payment['shorturl'] = '';
				$payment['status'] = 'Credit';
				$payment['gateway'] = 'simpl';
				$payment['payment_date'] = date('Y-m-d H:i:s');
				$this->CI->load->model ('adminusers/User_model','adminuser');
				$this->CI->adminuser->updatePayment($payment);
				$this->load->library('mylib/OrderLib');
				$this->orderlib->sendPaymentSuccesfullEmail($data,$orders[0]['invoice_url']);
				$resp['status'] = 1;
				$resp['msg'] = 'Payment Successful.';
			} else {
				$resp['status'] = 0;
				$resp['msg'] = 'Payment Failed.';
			}
		} else {
			$resp['status'] = 0;
			$resp['msg'] = 'Payment Failed.';
		}
	
		return $resp;
	}
        public function getResponse($payment_request_id){
            // $instamojo = new Instamojo('test_f9626a8125397a1b1e88fe9bbc9','test_516a0ac25848a585f81067406c9'); 
            $instamojo = new Instamojo('65b23b080ac62a1c2aeb1a7587117334','1579ce87964a2f252d22ece0a137bf2a'); 
            //$instamojo = new Instamojo('8e6de222b29df5688e9ae263d97ec68f','eeac5ad6aae1d8d764c44d17361121ca');
            $response = $instamojo->paymentRequestStatus($payment_request_id);
            return $response ; 
        
        
    }



    // for service type ride payment
    public function getRidePaymentUrl($params) {
		$instamojo = new Instamojo('65b23b080ac62a1c2aeb1a7587117334','1579ce87964a2f252d22ece0a137bf2a');
		try {
			$response = $instamojo->paymentRequestCreate(array(
					"purpose" => "ServiceOn Ride payment",
					"buyer_name" => $params['name'],
					"amount" => $params['amount'],     
					"send_email" => true,
					"send_sms" => true,
					"email" => $params['email'],
					"phone" => $params['mobile'],
					"webhook" =>base_url()."ride_paymentresponse",
					"redirect_url" => base_url().'ride_payment_status',
					"allow_repeated_payments" => true
			));
			$data = json_encode($response);
                       // echo "<pre>";
                       // print_r($response);
                       // exit;
			error_log($data,0);
			$obj = json_decode($data);
			$id = $obj->{'id'};
			$url=$obj->{'longurl'};
			$senddata['url'] = $url;
			$senddata['payment_orderid'] = $id;
			// print_r($senddata);die();
			if(!empty($obj->{'longurl'})) {
				$payment = array();
				$payment['orderid'] = $params['orderid'];
				$payment['transactionid'] = $id;
				$payment['longurl'] = $obj->{'longurl'};
				$payment['email'] = $params['email'];
				$payment['amount'] = $params['amount'];
				$payment['phone'] = $params['mobile'];
				$payment['shorturl'] ='';
				$payment['source'] = (isset($params['source']) && $params['source'] == 1)?1:2;
				$payment['status'] =$obj->{'status'};
				$this->CI->load->model ('users/User_model','user');
				$respurl=$this->CI->user->addRidePaymentDetail($payment);
				$senddata['status'] = 1;
				$senddata['msg'] = "Payment request sent successfully.";
			} else {
				$senddata['status'] = 0;
				$senddata['msg'] = "Failed to sent payment request.";
			}
		} catch (Exception $e) {
			$senddata['status'] = 0;
			$senddata['msg'] = "Failed to sent payment request.";
			error_log('Exception',0);                        
		}
		return $senddata;
	}

	public function createOrderPaymentRequestForApp($id)
	{
		$instamojo = new Instamojo('65b23b080ac62a1c2aeb1a7587117334','1579ce87964a2f252d22ece0a137bf2a');
		// try {
			$response = $instamojo->createOrderPaymentRequest(array(
					// "id" => "e717cb64bff5491b92fa4cc865d8287b"
					"id" => $id,
			));
			$data = json_encode($response);
                       echo "<pre> ddfgd ";
                       print_r($response);
                       exit;
			error_log($data,0);
		// } catch (Exception $e) {
		// 	$senddata['status'] = 0;
		// 	$senddata['msg'] = "Failed to sent payment request.";
		// 	error_log('Exception',0);                        
		// }
		// return $senddata;
	}	
}
