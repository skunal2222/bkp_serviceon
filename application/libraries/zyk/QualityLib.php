<?php
class QualityLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}

	public function addParameter($cat) {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$result = $this->CI->qualitymodel->addParameter ($cat);
		return $result;
	}
	
	public function getActiveParameter() {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$response = $this->CI->qualitymodel->getActiveParameter();
		return $response;
	}
	
	public function getActiveParameter1($id) {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$response = $this->CI->qualitymodel->getActiveParameter1($id);
		return $response;
	}
	
	public function getActiveParameter2() {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$response = $this->CI->qualitymodel->getActiveParameter2();
		return $response;
	}
	
	public function updateParameter($cat) {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$result = $this->CI->qualitymodel->updateParameter ( $cat );
		return $result;
	}
	
	public function getParameterById($cat_id) {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$response = $this->CI->qualitymodel->getParameterById ( $cat_id );
		return $response;
	}
	
	public function addGrade($cat) {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$result = $this->CI->qualitymodel->addGrade ($cat);
		return $result;
	}
	
	public function getActiveGrade() {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$response = $this->CI->qualitymodel->getActiveGrade();
		return $response;
	}
	
	public function getmainActiveGrade() {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$response = $this->CI->qualitymodel->getmainActiveGrade();
		return $response;
	}
	
	public function getGradeId($category_id) {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$response = $this->CI->qualitymodel->getGradeId($category_id);
		return $response;
	}
	
	public function updateGrade($cat) {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$result = $this->CI->qualitymodel->updateGrade  ( $cat );		return $result;
	}
	
	public function getGradeById($cat_id) {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$response = $this->CI->qualitymodel->getGradeById ( $cat_id );
		return $response;
	}
	
	public function addGradePara($paras) {
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );
		$response = $this->CI->qualitymodel->addGradePara ( $paras );
		return $response;
	}
	
	public function updateGradePara($paras) {			
		$this->CI->load->model ( 'quality/Quality_model', 'qualitymodel' );			
		$response = $this->CI->qualitymodel->updateGradePara ( $paras );			
		return $response;		
	}
	
}