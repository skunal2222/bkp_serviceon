<?php defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(0);
Class Rider extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/RiderLib', 'riderlib');
	}

	public function getRiderList()
	{
		$map = array();
		$rider = $this->riderlib->getRiderList($map);
		$this->template->set('rider',$rider);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Rider' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('rider/rider_list');
	}

	public function newRider()
	{
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Rider' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('rider/rider_add');
	}

	public function addRider()
	{
		$response = array();
		$rest = array();
		$id = $this->input->post('id');
		$rest = $this->input->post('rider');
		$rest['status'] = 1;


        if(!empty($_FILES)){
        	$date = date('YmdHis');
	        $config = array ();
	        $config ['upload_path'] = 'assets/images/rider/';
	        $config ['allowed_types'] = 'jpg|png|PNG|JPEG';
	        $config ['file_name'] = 'rider-'.$date.'.png';
	        $config ['max_size'] = 10*1024;
	        $config ['max_width'] = 2048;
	        $config ['max_height'] = 2048;
	        $this->load->library ( 'upload', $config );
	        if ($this->upload->do_upload ( 'image' )) {
	            $rest['profile_photo'] = 'images/rider/' . $this->upload->data ( 'file_name' );
	        } else {
	        	$error = array('error' => $this->upload->display_errors());
	        	$response['status'] = 0;
	        	$response['msg'] = $error['error'];
	        	echo json_encode($response);
	        	exit;
	        }
	    }

	    if(!empty($_FILES)){
        	$date = date('YmdHis');
	        $config = array ();
	        $config ['upload_path'] = 'assets/images/rider/';
	        $config ['allowed_types'] = 'jpg|png|PNG|JPEG';
	        $config ['file_name'] = 'rider-'.$date.'.png';
	        $config ['max_size'] = 10*1024;
	        $config ['max_width'] = 2048;
	        $config ['max_height'] = 2048;
	        $this->load->library ( 'upload', $config );
	        if ($this->upload->do_upload ( 'image2' )) {
	            $rest['profile_photo2'] = 'images/rider/' . $this->upload->data ( 'file_name' );
	        } else {
	        	$error = array('error' => $this->upload->display_errors());
	        	$response['status'] = 0;
	        	$response['msg'] = $error['error'];
	        	echo json_encode($response);
	        	exit;
	        }
	    }

	    if(!empty($_FILES)){
        	$date = date('YmdHis');
	        $config = array ();
	        $config ['upload_path'] = 'assets/images/rider/';
	        $config ['allowed_types'] = 'jpg|png|PNG|JPEG';
	        $config ['file_name'] = 'rider-'.$date.'.png';
	        $config ['max_size'] = 10*1024;
	        $config ['max_width'] = 2048;
	        $config ['max_height'] = 2048;
	        $this->load->library ( 'upload', $config );
	        if ($this->upload->do_upload ( 'image3' )) {
	            $rest['profile_photo3'] = 'images/rider/' . $this->upload->data ( 'file_name' );
	        } else {
	        	$error = array('error' => $this->upload->display_errors());
	        	$response['status'] = 0;
	        	$response['msg'] = $error['error'];
	        	echo json_encode($response);
	        	exit;
	        }
	    }

	    if(!empty($_FILES)){
        	$date = date('YmdHis');
	        $config = array ();
	        $config ['upload_path'] = 'assets/images/rider/';
	        $config ['allowed_types'] = 'jpg|png|PNG|JPEG';
	        $config ['file_name'] = 'rider-'.$date.'.png';
	        $config ['max_size'] = 10*1024;
	        $config ['max_width'] = 2048;
	        $config ['max_height'] = 2048;
	        $this->load->library ( 'upload', $config );
	        if ($this->upload->do_upload ( 'image4' )) {
	            $rest['profile_photo4'] = 'images/rider/' . $this->upload->data ( 'file_name' );
	        } else {
	        	$error = array('error' => $this->upload->display_errors());
	        	$response['status'] = 0;
	        	$response['msg'] = $error['error'];
	        	echo json_encode($response);
	        	exit;
	        }
	    }

	    if(!empty($_FILES)){
        	$date = date('YmdHis');
	        $config = array ();
	        $config ['upload_path'] = 'assets/images/rider/';
	        $config ['allowed_types'] = 'jpg|png|PNG|JPEG';
	        $config ['file_name'] = 'rider-'.$date.'.png';
	        $config ['max_size'] = 10*1024;
	        $config ['max_width'] = 2048;
	        $config ['max_height'] = 2048;
	        $this->load->library ( 'upload', $config );
	        if ($this->upload->do_upload ( 'image5' )) {
	            $rest['profile_photo5'] = 'images/rider/' . $this->upload->data ( 'file_name' );
	        } else {
	        	$error = array('error' => $this->upload->display_errors());
	        	$response['status'] = 0;
	        	$response['msg'] = $error['error'];
	        	echo json_encode($response);
	        	exit;
	        }
	    }

		$response['status'] = 1;
		if(empty($id)){
			$response['id'] = $this->riderlib->addRider($rest);
			$data['my_referral_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($response['id'], 10, 36)) ;
			$data['rider_id'] = $response['id'];
			$this->riderlib->updateRider($data);
			$response['msg'] = "Rider added successfully";
		}else{
			$rest['rider_id'] = $id;
			$response['result'] = $this->riderlib->updateRider($rest);
			$response['msg'] = "Rider updated successfully";
		}
		echo json_encode($response);
	}

	public function editRider($id)
	{
		$map['id'] = $id;
		$rider = $this->riderlib->getRiderList($map);
		$riderbilling = $this->riderlib->getRiderBillingConfig($id);
		$cycle = $this->riderlib->getRiderBillingField($id,'cycle_effective_date');
		$gateway = $this->riderlib->getRiderBillingField($id,'gateway_effective_date');
		// echo "<pre>"; print_r($rider);exit;
		$this->template->set('rider',$rider);
		$this->template->set('riderbilling',$riderbilling);
		$this->template->set('cycle',$cycle);
		$this->template->set('gateway',$gateway);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Rider' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('rider/rider_edit');	
	}

	public function editPayment()
	{
		$response = array();
		$rest = array();
		$id = $this->input->post('restid');
		$rest = $this->input->post('rider');
		$rest['status'] = 1;

		$response['status'] = 1;
		if(empty($id)){
			$response['id'] = $this->db->insert('rider_payment', $rest);
			$response['msg'] = "Rider added successfully";
		}else{
			$rest['rider_id'] = $id;
			$response['result'] = $this->riderlib->updateRiderPayment($rest);
			$response['msg'] = "Rider updated successfully";
		}
		echo json_encode($response);
	}

	public function edit_zone()
	{
		$response = array();
		$rest = array();
		$id = $this->input->post('restid');
		$rest = $this->input->post('rider');
		$rest['status'] = 1;

		$response['status'] = 1;
		
		if(empty($id)){
			$response['id'] = $this->db->insert('rider_payment', $rest);
			$response['msg'] = "Rider added successfully";
		}else{
			$rest['rider_id'] = $id;
			$response['result'] = $this->riderlib->updateRiderPayment($rest);
			$response['msg'] = "Rider updated successfully";
		}
		echo json_encode($response);
	}


	public function cashCollectionList()
	{

		$orders = $this->riderlib->getCashCollectionOrderList();
		// echo "<pre>";
		// print_r($orders); die();
		$this->template->set('orders',$orders);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Rider' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('rider/cash_collection_list');
	}

	public function saveReceivedAmtByRider()
	{
		$orderid = $this->input->post('orderid');
		$response['status'] = 0;
		if (!empty($orderid)) {
			$data['orderid'] = $orderid;
			$data['handling_charges_received_to_serviceon'] = 1;
			$data['garage_amount_received_to_serviceon'] = 1;
			$data['charges_received_date'] = date('Y-m-d H:i:s');
			$this->load->library('zyk/OrderLib', 'orderlib');
			$this->orderlib->updateOrder($data);
			$response['status'] = 1;
		}
		echo json_encode($response);
	}

	public function rider_billing()
	{
		$riderbilling = array();
		$riderbilling = $this->input->post('rider');
		$restid = $riderbilling['restid'];
		$billing['restid'] = $riderbilling['restid'];
		$billing['billing_cycle'] = $riderbilling['billing_cycle'];
		$billing['with_service_tax'] = $riderbilling['with_service_tax'];
		$billing['payment_mode'] = $riderbilling['payment_mode'];
		$billing['cheque_favour_of'] = $riderbilling['cheque_favour_of'];
		/*$billing['account_name'] = $riderbilling['account_name'];
		$billing['account_number'] = $riderbilling['account_number'];
		$billing['bank_name'] = $riderbilling['bank_name'];
		$billing['branch_name'] = $riderbilling['branch_name'];
		$billing['gstin'] = strtoupper($riderbilling['gstin']);
		$billing['ifsc_code'] = $riderbilling['ifsc_code'];*/
		$billing['min_amount'] = $riderbilling['min_amount'];
		$billing['commission_service'] = $riderbilling['commission_service'];
		// $billing['company_name'] = $riderbilling['company_name'];
		
		$cycle_date = date('Y-m-d',strtotime($riderbilling['cycle_effective_date']));
		/*$gateway_charge = $riderbilling['gateway_charge'];
		$gateway_date = date('Y-m-d',strtotime($riderbilling['gateway_effective_date']));*/
		$billing_fields = array('restid'=>$restid,'billing_field'=>'cycle_effective_date','value'=>$billing['billing_cycle'],'from_date'=>$cycle_date);
		/*$billing_fields2 = array('restid'=>$restid,'billing_field'=>'gateway_effective_date','value'=>$gateway_charge,'from_date'=>$gateway_date);*/
		$this->load->library('zyk/RestaurantLib');
 
		$response = $this->riderlib->updateRiderBillingConfig($billing);
		$this->riderlib->updateRiderBillingFields($billing_fields);
		// $this->riderlib->updateRiderBillingFields($billing_fields2);
		echo json_encode($response);
	}
}
