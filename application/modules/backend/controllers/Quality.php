<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Quality extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/QualityLib', 'qualitylib');
	//	$this->load->library('zyk/AttributeLib','attributelib');
	}
	

	public function newParameter() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
	   // echo $this->template->build ('partials/qualitym/AddCategory');
	    $this->template->build ('partials/qualitym/AddParameter');
	}
	
	public function addParameter() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
		$this->load->library('zyk/QualityLib');
	
		$response = $this->qualitylib->addParameter($params);
		echo json_encode($response);
	}

	

	public function updateParameter() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$item['updated_datetime'] = date('Y-m-d H:i:s');
		$params['status'] = $this->input->post('status');
		$this->load->library('zyk/QualityLib');
		
		$response = $this->qualitylib->updateParameter($params);
		echo json_encode($response);
	}
	
	
	public function quality() {
		
	$parameters = $this->qualitylib->getActiveParameter();
	$grades = $this->qualitylib->getActiveGrade();
	$this->template->set('parameters',$parameters);
	$this->template->set('grades',$grades);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Quality' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('qualitym/mainquality');
	}
	
	public function editParameter() {
		$id=$this->input->post('id');
		$parameters = $this->qualitylib->getParameterById($id);
		$this->template->set('parameters',$parameters);
	//	print_r($cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/qualitym/AddCategory');
		$this->template->build ('partials/qualitym/EditParameter');
	}
	
	public function newGrade() {
		$parameters = $this->qualitylib->getActiveParameter2();
		$this->template->set('parameters',$parameters);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/qualitym/AddCategory');
		$this->template->build ('partials/qualitym/AddGrade');
	}
	
	public function addGrade() {
		
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$params['created_datetime'] = date('Y-m-d H:i:s');
		$grade_id = $this->qualitylib->addGrade($params);
		$parameter = $this->input->post('parameter');
		for($i = 0; $i < count($parameter); $i ++){
			$para = array();
			$para['grade_id'] = $grade_id;
			$para['parameter_id'] = $parameter[$i];
			$paras[] = $para;
		
		}
		$response = $this->qualitylib->addGradePara($paras);
		$this->load->library('zyk/QualityLib');
		
		echo json_encode($response);
	}
	
	
	public function updateGrade() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$item['updated_datetime'] = date('Y-m-d H:i:s');
		$params['status'] = $this->input->post('status');
		$this->load->library('zyk/QualityLib');
		$grade_id = $this->qualitylib->updateGrade($params);
		
		$parameter = $this->input->post('parameter');				
		for($i = 0; $i < count($parameter); $i ++){					
			$para = array();					
			$para['grade_id'] = $params['id'];					
			$para['parameter_id'] = $parameter[$i];					
			$paras[] = $para;								
		}				
		$response = $this->qualitylib->updateGradePara($paras);
		echo json_encode($response);
	}
	

	
	public function editGrade() {
		$id=$this->input->post('id');
		$grades = $this->qualitylib->getGradeById($id);
		$parameters = $this->qualitylib->getActiveParameter2();
		$parameters1 = $this->qualitylib->getActiveParameter1($id);
		foreach ($parameters as $key=>$row)
		{			
			$parameters[$key]['checked'] = '';			
			foreach ($grades as $value) {							
				if($row['id'] == $value['parameter_id']) 
				{				
					$parameters[$key]['checked'] = 'checked';				
				}			
			}		
		}		
		$this->template->set('parameters',$parameters);
		$this->template->set('parameters1',$parameters1);
		$this->template->set('grades',$grades);
		//	print_r($cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/qualitym/AddCategory');
		$this->template->build ('partials/qualitym/EditGrade');
	}
	

	
	
}



