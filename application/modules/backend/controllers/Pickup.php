<?php defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(0);
Class Pickup extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();		
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		
		$this->load->model('pickup/Pickupslot', 'pickup');
	}
	
	public function index() { 
		
		$map = array();
		$pickup = $this->pickup->get_pickup_slots();
		$this->template->set('pickup',$pickup);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('pickup/pickupList');
	}

	public function breakdown() { 
		
		$map = array();
		$breakdown = $this->pickup->get_breakdown_slots();
		$this->template->set('breakdown',$breakdown);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('pickup/breakdownList');
	}

	public function addPickup() { 
		
		$map = array();
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('pickup/add_pickup');
	}

	public function insert()
	{
		$data = $this->input->post();
	
		if (!empty( $result ) == 0) {
			$this->db->insert ( 'pickup_slots', $data );
			$id = $this->db->insert_id ();
			$response ['id'] = $id;
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

	public function insertDropdown()
	{
		$data = $this->input->post();
	
		if (!empty( $result ) == 0) {
			$this->db->insert ( 'breakdownslot', $data );
			$id = $this->db->insert_id ();
			$response ['id'] = $id;
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

	public function addDrop() { 
		
		$map = array();
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('pickup/add_breakdown');
	}

	public function editPickup($id) { 
		
		$map = array();
		$data['pickup'] = $this->db->where('id', $id)->get('pickup_slots')->row_array();
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('pickup/edit_pickup', $data);
	}

	public function editBreakdown($id) { 
		
		$map = array();
		$data['pickup'] = $this->db->where('id', $id)->get('breakdownslot')->row_array();

		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Vendor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('pickup/edit_breakdown', $data);
	}
	
		
	
	public function updatePickup()
	{
		$data = $this->input->post();
	
		if (!empty( $data )) {
			$up = array(
			        'minkm' => $this->input->post('minkm'),
			        'maxkm' => $this->input->post('maxkm'),
			        'price' => $this->input->post('price'),
			        'status' => $this->input->post('status')
			);
			$id = $this->input->post('edit_id');
			$this->db->where('id', $id);
			$this->db->update('pickup_slots', $up);

			$response ['status'] = 1;
			$response ['msg'] = "Data updated successfully";
			echo json_encode($response);
		} else {
			$errors = array ();
			$data ['msg'] = "Something went wrong.";
			$data ['status'] = 0;
			echo json_encode($response);
		}
	}

	public function updateBreakDown()
	{
		$data = $this->input->post();
	
		if (!empty( $data )) {
			$up = array(
			        'minkm' => $this->input->post('minkm'),
			        'maxkm' => $this->input->post('maxkm'),
			        'price' => $this->input->post('price'),
			        'status' => $this->input->post('status')
			);
			$id = $this->input->post('edit_id');
			$this->db->where('id', $id);
			$this->db->update('breakdownslot', $up);
			
			$response ['status'] = 1;
			$response ['msg'] = "Data updated successfully";
			echo json_encode($response);
		} else {
			$errors = array ();
			$data ['msg'] = "Something went wrong.";
			$data ['status'] = 0;
			echo json_encode($response);
		}
	}
}
