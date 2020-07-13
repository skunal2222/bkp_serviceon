<?php
class BikeLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	} 	
	public function addBike($params) {
		$this->CI->load->model ( 'bike/Bike_model', 'bikemodel' );
		$result = $this->CI->bikemodel->addBike ($params);
		return $result;
	}
	
	public function updateBike($params) {
		$this->CI->load->model ( 'bike/Bike_model', 'bikemodel' );
		$result = $this->CI->bikemodel->updateBike ($params);
		return $result;
	} 
 
	public function getListBikes()
	{
		$this->CI->load->model ( 'bike/Bike_model', 'bikemodel' );
		$result = $this->CI->bikemodel->getListBikes ();
		return $result;
	}
	
	public function getBikeByID($id)
	{
		$this->CI->load->model ( 'bike/Bike_model', 'bikemodel' );
		$result = $this->CI->bikemodel->getBikeByID ($id);
		return $result;
	}
	 
	public function getAllActive()
	{
		$this->CI->load->model ( 'bike/Bike_model', 'bikemodel' );
		$result = $this->CI->bikemodel->getAllActive ();
		return $result;
	} 
	public function getBikeList($id){
		return $this->CI->bikemodel->getBikeList($id);
	}     
	public function getBikesByName($name) {
		$this->CI->load->model ( 'bike/Bike_model', 'bikemodel' );
		$result = $this->CI->bikemodel->getBikesByName ( $name );
		return $result;
	}
	public function getBikesDetails($id) {
		$this->CI->load->model ( 'bike/Bike_model', 'bikemodel' );
		$result = $this->CI->bikemodel->getBikesDetails ( $id );
		return $result;
	}
	
}