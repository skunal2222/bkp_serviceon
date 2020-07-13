<?php
class RiderLib {
	
	public function __construct(){
		$this->CI =& get_instance();
	}

	public function getCashCollectionOrderList()
	{
		$this->CI->load->model ('rider/Rider_model', 'rider');
		return $this->CI->rider->getCashCollectionOrderList();
	}
	
	public function getRiderList($map=NULL){
		$this->CI->load->model ('rider/Rider_model', 'rider');
		$riders = $this->CI->rider->getRiderList($map);
		return $riders;
	}

	public function addRider($map)
	{
		$this->CI->load->model ('rider/Rider_model', 'rider');
		$riders = $this->CI->rider->addRider($map);
		return $riders;	
	}

	public function updateRider($map)
	{
		$this->CI->load->model ('rider/Rider_model', 'rider');
		$riders = $this->CI->rider->updateRider($map);
		return $riders;	
	}

	public function updateRiderPayment($map)
	{
		$this->CI->load->model ('rider/Rider_model', 'rider');
		$riders = $this->CI->rider->updateRiderPayment($map);
		return $riders;	
	}

	public function getRiderBillingConfig($id) {
		$this->CI->load->model ('rider/Rider_model', 'rider');
		return $this->CI->rider->getRiderBillingConfig($id);
	}

	public function getRiderBillingField($id,$field) {
		$this->CI->load->model ('rider/Rider_model', 'rider');
		$bfield = $this->CI->rider->getRiderBillingField($id,$field);         
		return $bfield;
	}

	public function addRiderBillingConfig($data) {
		$this->CI->load->model ('rider/Rider_model', 'rider');
		return $this->CI->rider->addRiderBillingConfig($data);
	}

	public function addRiderBillingFields($data) {
		$this->CI->load->model ('rider/Rider_model', 'rider');
		return $this->CI->rider->addRiderBillingFields($data);
	}

	public function updateRiderBillingConfig($map){
		$this->CI->load->model ('rider/Rider_model', 'rider');
		return $this->CI->rider->updateRiderBillingConfig($map);
	}
	
	public function updateRiderBillingFields($map){	
		$this->CI->load->model ('rider/Rider_model', 'rider');
		return $this->CI->rider->updateRiderBillingFields($map);;
	}
}