<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Vendor extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/RestaurantLib');
	} 

	
	public function search(){
		$map = array();
		$response = array();
		$map['locality'] = $this->input->post('locality');
		$map['latitude'] = $this->input->post('latitude');
		$map['longitude'] = $this->input->post('longitude');
		//print_r($map);
		
		$vendors = $this->restaurantlib->getSearchedVendor($map);
		//print_r($vendors);
		//exit;
		if(!empty($vendors))
		{
		//	echo "if";
			$response['status'] = 1;
			$response['msg'] = 'Our service is available for this area.';
			$_SESSION['data'] = $vendors;
			$_SESSION['latitude'] = $map['latitude'];
			$_SESSION['longitude'] = $map['longitude'];
			$_SESSION['locality'] = $map['locality']; 
		}
		else 
		{
			//	echo "else";
			$response['status'] = 0;
			$response['msg'] = 'Our service is not available for this area.';
		}		//print_r($response);		//exit;
		echo json_encode($response);
		
	}
	
}