<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Timeslot extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/SlotLib', 'slotlib');
	//	$this->load->library('zyk/AttributeLib','attributelib');
	}
	

	public function newVslot() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
	   // echo $this->template->build ('partials/timeslot/AddCategory');
	    $this->template->build ('partials/timeslot/AddVslot');
	}
	
	public function addVslot() {
		$params = array();
		$params['time_slot'] = $this->input->post('time_slot');
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/slotlib');
	
		$response = $this->slotlib->addVslot($params);
		echo json_encode($response);
	}

	

	public function updateVslot() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['time_slot'] = $this->input->post('time_slot');
		$item['updated_datetime'] = date('Y-m-d H:i:s');
		$params['status'] = $this->input->post('status');
		$this->load->library('zyk/slotlib');
		
		$response = $this->slotlib->updateVslot($params);
		echo json_encode($response);
	}
	
	
	public function timeslot() {
		
	$visitingslots = $this->slotlib->getActiveVisiting();
	$deliveryslots = $this->slotlib->getActiveDelivery();
	$this->template->set('visitingslots',$visitingslots);
	$this->template->set('deliveryslots',$deliveryslots);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Area' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('Timeslots/maintimeslot');
	}
	
	public function editVslot() {
		$id=$this->input->post('id');
		$visitingslots = $this->slotlib->getVslotById($id);
		$this->template->set('visitingslots',$visitingslots);
	//	print_r($cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/timeslot/AddCategory');
		$this->template->build ('partials/timeslot/EditVslot');
	}
	
	public function newDslot() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/timeslot/AddCategory');
		$this->template->build ('partials/timeslot/AddDslot');
	}
	
	public function addDslot() {
		$params = array();
		$params['time_slot'] = $this->input->post('time_slot');
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/slotlib');
		
		$response = $this->slotlib->addDslot($params);
		echo json_encode($response);
	}
	
	
	public function updateDslot() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['time_slot'] = $this->input->post('time_slot');
		$item['updated_datetime'] = date('Y-m-d H:i:s');
		$params['status'] = $this->input->post('status');
		$this->load->library('zyk/slotlib');
		
		$response = $this->slotlib->updateDslot($params);
		echo json_encode($response);
	}
	

	
	public function editDslot() {
		$id=$this->input->post('id');
		$deliveryslots = $this->slotlib->getDslotById($id);
		$this->template->set('deliveryslots',$deliveryslots);
		//	print_r($cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/timeslot/AddCategory');
		$this->template->build ('partials/timeslot/EditDslot');
	}
	

	
	
}



