<?php
class SlotLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}

	public function addVslot($cat) {
		$this->CI->load->model ( 'slot/Slot_model', 'slotmodel' );
		$result = $this->CI->slotmodel->addVslot ($cat);
		return $result;
	}
	
	public function getActiveVisiting() {
		$this->CI->load->model ( 'slot/Slot_model', 'slotmodel' );
		$response = $this->CI->slotmodel->getActiveVisiting();
		return $response;
	}	

	public function getActiveVisiting1() {
		$this->CI->load->model ( 'slot/Slot_model', 'slotmodel' );
		$response = $this->CI->slotmodel->getActiveVisiting1();			
		return $response;
	}
	
	public function updateVslot($cat) {
		$this->CI->load->model ( 'slot/Slot_model', 'slotmodel' );
		$result = $this->CI->slotmodel->updateVslot ( $cat );
		return $result;
	}
	
	public function getVslotById($cat_id) {
		$this->CI->load->model ( 'slot/Slot_model', 'slotmodel' );
		$response = $this->CI->slotmodel->getVslotById ( $cat_id );
		return $response;
	}
	
	public function addDslot($cat) {
		$this->CI->load->model ( 'slot/Slot_model', 'slotmodel' );
		$result = $this->CI->slotmodel->addDslot ($cat);
		return $result;
	}
	
	public function getActiveDelivery() {
		$this->CI->load->model ( 'slot/Slot_model', 'slotmodel' );
		$response = $this->CI->slotmodel->getActiveDelivery();
		return $response;
	}
	
	public function getDslotId($category_id) {
		$this->CI->load->model ( 'slot/Slot_model', 'slotmodel' );
		$response = $this->CI->slotmodel->getDslotId($category_id);
		return $response;
	}
	
	public function updateDslot($cat) {
		$this->CI->load->model ( 'slot/Slot_model', 'slotmodel' );
		$result = $this->CI->slotmodel->updateDslot  ( $cat );
		return $result;
	}
	
	public function getDslotById($cat_id) {
		$this->CI->load->model ( 'slot/Slot_model', 'slotmodel' );
		$response = $this->CI->slotmodel->getDslotById ( $cat_id );
		return $response;
	}
	

	
}