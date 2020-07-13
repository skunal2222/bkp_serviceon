<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Api extends REST_Controller {

	/**************** code by kunal ****************/

	public function addNewVehicle_post()
	{
		if (empty($this->post('user_id'))) {
			$response['status'] = "false";
			$response['msg'] = "User ID is missing.";
		}
		else
		{
			$params = array();
	        $params['user_id'] = $this->post('user_id');
	        $params['vehical_no'] = $this->post('vehicle_no');
	        $params['brand_id'] = $this->post('search_brand');
	        $params['model_id'] = $this->post('search_model');
	        $params['manufactured_year'] = $this->post('manufactured_year');
	        $params['total_kms'] = $this->post('total_kms');
	        $params['status'] = 1;
	        $params['created_datetime'] = date('Y-m-d H:i:s');

			$this->load->library('api/VehicleLib', 'vehiclelib');
	        $result = $this->vehiclelib->AddVehical($params); 
	        if ($result['status'] == 0) {
	     		$response['status'] = "true";
				$response['msg'] = "Vehicle already exist.";   	
				$response['data'] = [];   	
	        }
	        else
	        {
	        	$response['status'] = "true";
				$response['msg'] = "Vehicle added successfully.";
				$returndata = $_POST;
				$returndata['id'] = $result['id'];
				$response['data'] = $returndata;
	        }
		}
	    $this->response($response,200);
	}

	public function updateVehicle_post(){

		if (empty($this->post('vehicle_id'))) {
			$response['status'] = "false";
			$response['msg'] = "Vehicle ID is missing.";
		}
		else
		{
			$params = array();
	        $params['id'] = $this->input->post('vehicle_id');
			$params['vehicle_no'] = $this->input->post('vehicle_no');
			$params['vehicle_alias_no'] = str_replace(" ", "_", strtolower(trim($params['vehicle_no']))); 
	        $params['brand_id'] = $this->input->post('search_brand');
	        $params['model_id'] = $this->input->post('search_model');
	        $params['manufactured_year'] = $this->input->post('manufactured_year');
	        $params['total_kms'] = $this->input->post('total_kms');
	        $params['updated_datetime'] = date('Y-m-d H:i:s');

			$this->load->library('api/VehicleLib', 'vehiclelib');
	        $result = $this->vehiclelib->updateVehicle($params); 
	        if ($result['status'] == 0) {
	     		$response['status'] = "true";
				$response['msg'] = "Vehicle number already exist to another user / vehicle.";   	
	        }
	        else
	        {
	        	$response['status'] = "true";
				$response['msg'] = "Vehicle updated successfully.";
	        }
	    }
	    $this->response($response,200);
	}

	public function getVehicleListByUserID_post()
	{
		$user_id = $this->post('user_id');
		if (empty($user_id)) {
			$response['status'] = "false";
			$response['msg'] = "User ID is missing.";
		}
		else
		{
			$this->load->library('api/VehicleLib', 'vehiclelib');
	        $result = $this->vehiclelib->getVehicleList($user_id); 
	        if (empty($result)) {
	     		$response['status'] = "true";
				$response['msg'] = "No vehicle found.";
				$response['data'] = [];
	        }
	        else
	        {
	        	$response['status'] = "true";
				$response['msg'] = "Vehicle list found.";
				$response['data'] = $result;
	        }
		}
		$this->response($response,200);
	}

	/**************** code by kunal ****************/
}
?>