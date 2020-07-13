<?php

class AreaLib {

	

	public function __construct() {

		$this->CI = & get_instance ();

	}



	public function addCity($cat) {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$result = $this->CI->areamodel->addCity ($cat);

		return $result;

	}

	
	public function getAllCities() {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$response = $this->CI->areamodel->getAllCities();

		return $response;

	}

	public function getActiveCities() {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$response = $this->CI->areamodel->getActiveCities();

		return $response;

	}

	

	public function updateCity($cat) {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$result = $this->CI->areamodel->updateCity ( $cat );

		return $result;

	}

	

	public function getCityById($cat_id) {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$response = $this->CI->areamodel->getCityById ( $cat_id );

		return $response;

	}

	

	public function addZone($cat) {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$result = $this->CI->areamodel->addZone ($cat);

		return $result;

	}

	

	public function getActiveZones() {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$response = $this->CI->areamodel->getActiveZones();

		return $response;

	}

	

	public function getActiveAreas2() {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$response = $this->CI->areamodel->getActiveAreas2();

		return $response;

	}

	

	public function getZoneId($category_id) {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$response = $this->CI->areamodel->getZoneId($category_id);

		return $response;

	}

	

	public function updateZone($cat) {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$result = $this->CI->areamodel->updateZone ( $cat );

		return $result;

	}

	

	public function getZoneById($cat_id) {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$response = $this->CI->areamodel->getZoneById ( $cat_id );

		return $response;

	}

	

	

	public function addArea($cat) {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$result = $this->CI->areamodel->addArea ($cat);

		return $result;

	}

	

	public function getActiveAreas() {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$response = $this->CI->areamodel->getActiveAreas();

		return $response;

	}

	

	public function getActiveAreas1() {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$response = $this->CI->areamodel->getActiveAreas1();

		return $response;

	}

	

	public function updateArea($cat) {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$result = $this->CI->areamodel->updateArea ( $cat );

		return $result;

	}

	

	public function getAreaById($cat_id) {

		$this->CI->load->model ( 'area/Area_model', 'areamodel' );

		$response = $this->CI->areamodel->getAreaById ( $cat_id );

		return $response;

	}

	

}