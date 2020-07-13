<?php defined('BASEPATH') OR exit('No direct script access allowed');



Class Area extends MX_Controller {

	

	public function __construct() {

		parent::__construct ();

		$this->load->helper ( 'url' );

		$this->load->helper ( 'cookie' );

		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );

		$this->load->library('zyk/AreaLib', 'arealib');

	//	$this->load->library('zyk/AttributeLib','attributelib');

	}

	



	public function newCity() {

		$this->template->set_theme('default_theme');

		$this->template->set_layout (false);

	   // echo $this->template->build ('partials/area/AddCategory');

	    $this->template->build ('partials/area/AddCity');

	}

	

	public function addCity() {

		$params = array();

		$params['name'] = $this->input->post('name');

		$params['status'] = 1;

		$params['created_datetime'] = date('Y-m-d H:i:s');

		$this->load->library('zyk/AreaLib');

	

		$response = $this->arealib->addCity($params);

		echo json_encode($response);

	}



	



	public function updateCity() {

		$params = array();

		$params['id'] = $this->input->post('id');

		$params['name'] = $this->input->post('name');

		$item['updated_datetime'] = date('Y-m-d H:i:s');

		$params['status'] = $this->input->post('status');

		$this->load->library('zyk/AreaLib');

		

		$response = $this->arealib->updateCity($params);

		echo json_encode($response);

	}

	

	

	public function area() {

		

	$cities = $this->arealib->getAllCities();

	$zones = $this->arealib->getActiveZones();

	$areas = $this->arealib->getActiveareas();

	$this->template->set('cities',$cities);

	$this->template->set('zones',$zones);

	$this->template->set('areas',$areas);

		$this->template->set_theme('default_theme');

		$this->template->set_layout ('backend')

		->title ( 'Administrator | Area' )

		->set_partial ( 'header', 'partials/header' )

		->set_partial ( 'leftnav', 'partials/sidebar' )

		->set_partial ( 'footer', 'partials/footer' );

		$this->template->build ('area/mainarea');

	}

	

	public function editCity() {

		$id=$this->input->post('id');

		$cities = $this->arealib->getCityById($id);

		$this->template->set('cities',$cities);

	//	print_r($cities);

		$this->template->set_theme('default_theme');

		$this->template->set_layout (false);

		// echo $this->template->build ('partials/area/AddCategory');

		$this->template->build ('partials/area/EditCity');

	}

	

	public function newZone() {

		$cities = $this->arealib->getActiveCities();

		$this->template->set('cities',$cities);

		$this->template->set_theme('default_theme');

		$this->template->set_layout (false);

		// echo $this->template->build ('partials/area/AddCategory');

		$this->template->build ('partials/area/AddZone');

	}

	

	public function addZone() {

		$params = array();

		$params['name'] = $this->input->post('name');

		$params['city_id'] = $this->input->post('city_id');

		$params['status'] = 1;

		$params['created_datetime'] = date('Y-m-d H:i:s');

		$this->load->library('zyk/AreaLib');

		

		$response = $this->arealib->addZone($params);

		echo json_encode($response);

	}

	

	

	public function updateZone() {

		$params = array();

		$params['id'] = $this->input->post('id');

		$params['name'] = $this->input->post('name');

		$params['city_id'] = $this->input->post('city_id');

		$item['updated_datetime'] = date('Y-m-d H:i:s');

		$params['status'] = $this->input->post('status');

		$this->load->library('zyk/AreaLib');

		

		$response = $this->arealib->updateZone($params);

		echo json_encode($response);

	}

	



	

	public function editZone() {

		$id=$this->input->post('id');

		$cities = $this->arealib->getActiveCities();

		$zones = $this->arealib->getZoneById($id);

		$this->template->set('cities',$cities);

		$this->template->set('zones',$zones);

		//	print_r($cities);

		$this->template->set_theme('default_theme');

		$this->template->set_layout (false);

		// echo $this->template->build ('partials/area/AddCategory');

		$this->template->build ('partials/area/EditZone');

	}

	

	public function newArea($city_id) {

		$this->load->library('zyk/AreaLib');

		if($city_id == 0) {

			$zones =  $this->arealib->getActiveZones();

		}

		else {

			$zones = $this->arealib->getZoneId($city_id);

			//print_r($zones);

		}

		$cities = $this->arealib->getActiveCities();

		//$zones = $this->arealib->getActiveZones();

		$areas = $this->arealib->getActiveAreas1();

		$this->template->set('cities',$cities);

		$this->template->set('zones',$zones);

		$this->template->set('areas',$areas);

		$this->template->set_theme('default_theme');

		$this->template->set_layout (false);

		// echo $this->template->build ('partials/area/AddCategory');

		$this->template->build ('partials/area/AddArea');

	}

	

	public function addArea() {

		

		$params = array();

		$params['name'] = $this->input->post('name');

		$params['area_id'] = $this->input->post('area_id');

		$params['zone_id'] = $this->input->post('zone_id');

		$params['status'] = 1;

		$params['created_datetime'] = date('Y-m-d H:i:s');

		

		

		$response = $this->arealib->addArea($params);

		echo json_encode($response);

	}

	



	public function updateArea() {

		$params = array();

		$params['id'] = $this->input->post('id');

		$params['name'] = $this->input->post('name');

		$params['area_id'] = $this->input->post('area_id');

		$params['zone_id'] = $this->input->post('zone_id');

		$item['updated_datetime'] = date('Y-m-d H:i:s');

		$params['status'] = $this->input->post('status');

		$this->load->library('zyk/AreaLib');

		

		$response = $this->arealib->updateArea($params);

		echo json_encode($response);

	}

	

	

	public function editArea() {

		$id=$this->input->post('id');

		//$cities = $this->arealib->getActiveCities();

		$zones = $this->arealib->getActiveZones();

		$areas = $this->arealib->getAreaById($id);

		$areas1= $this->arealib->getActiveAreas1();

		//$this->template->set('cities',$cities);

		$this->template->set('zones',$zones);

		$this->template->set('areas',$areas);

		$this->template->set('areas1',$areas1);

		//	print_r($cities);

		$this->template->set_theme('default_theme');

		$this->template->set_layout (false);

		// echo $this->template->build ('partials/area/AddCategory');

		$this->template->build ('partials/area/EditArea');

	}

	

	

}







