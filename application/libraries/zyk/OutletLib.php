<?php
class OutletLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	} 
	public function addOutlet($params) {
		$this->CI->load->model ( 'outlet/Outlet_model', 'outletmodel' );
		$result = $this->CI->outletmodel->addOutlet ($params);
		return $result;
	}

	public function addOutletAsUser($data) {  
		
		$this->CI->load->model ( 'outlet/Outlet_model', 'outletmodel' );
 		$result = $this->CI->outletmodel->addOutletAsUser ($data);
 		return $result;
 	}
	
	public function updateOutlet($params) {
		$this->CI->load->model ( 'outlet/Outlet_model', 'outletmodel' );
		$result = $this->CI->outletmodel->updateOutlet ($params);
		return $result;
	}
 	public function getListOutlets()
	{
		$this->CI->load->model ( 'outlet/Outlet_model', 'outletmodel' );
		$result = $this->CI->outletmodel->getListOutlets ();
		return $result;
	}
	
	public function getOutletByID($id)
	{
		$this->CI->load->model ( 'outlet/Outlet_model', 'outletmodel' );
		$result = $this->CI->outletmodel->getOutletByID ($id);
		return $result;
	} 
	public function getAllActive()
	{
		$this->CI->load->model ( 'outlet/Outlet_model', 'outletmodel' );
		$result = $this->CI->outletmodel->getAllActive ();
		return $result;
	} 
	public function getOutletList($id){ 
		
		$this->CI->load->model ( 'outlet/Outlet_model', 'outletmodel' );
		return $this->CI->outletmodel->getOutletList($id);
	}  
	public function outletbyclientid($client_id) {
		$this->CI->load->model ( 'outlet/Outlet_model', 'outletmodel' );
		$response = $this->CI->outletmodel->outletbyclientid($client_id);
		return $response;
	}
	public function citybyclientid($client_id) { 
		$this->CI->load->model ( 'outlet/Outlet_model', 'outletmodel' );
		$response = $this->CI->outletmodel->citybyclientid($client_id);
		return $response;
	}

	public function outletbycityid($city_id,$client_id) {
		$this->CI->load->model ( 'outlet/Outlet_model', 'outletmodel' );
		$response = $this->CI->outletmodel->outletbycityid($city_id,$client_id);
		return $response;
	}

	public function bikesbyoutletid($outlet_id) {
		$this->CI->load->model ( 'outlet/Outlet_model', 'outletmodel' );
		$response = $this->CI->outletmodel->bikesbyoutletid($outlet_id);
		return $response;
	}
        public function add_rate_card($param) {
            $this->CI->load->model('outlet/Outlet_model', 'outletmodel');
            return $this->CI->outletmodel->add_rate_card($param);
	}
        
        public function delete_rate_card($param) {
            $this->CI->load->model('outlet/Outlet_model', 'outletmodel');
            $this->CI->outletmodel->delete_rate_card($param);
        }
        
        public function add_rate_card_price($param) {
            $this->CI->load->model('outlet/Outlet_model', 'outletmodel');
            return $this->CI->outletmodel->add_rate_card_price($param);
        }
        
        public function all_rate_list() {
            $this->CI->load->model('outlet/Outlet_model', 'outletmodel');
            return $this->CI->outletmodel->all_rate_list();
        }
        public function get_ratecard_details($id) {
            $this->CI->load->model('outlet/Outlet_model', 'outletmodel');
            return $this->CI->outletmodel->get_ratecard_details($id);
        }
        public function ratecard_update($param) {
            $this->CI->load->model('outlet/Outlet_model', 'outletmodel');
            return $this->CI->outletmodel->ratecard_update($param);
        }
        public function ratecard_assign() {
            $this->CI->load->model('outlet/Outlet_model', 'outletmodel');
            return $this->CI->outletmodel->ratecard_assign(); 
        }
        public function get_rate_card_by_city($city_id) {
            $this->CI->load->model('outlet/Outlet_model', 'outletmodel');
            return $this->CI->outletmodel->get_rate_card_by_city($city_id); 
        }
        
        public function add_ratecard_assign($param) {
            $this->CI->load->model('outlet/Outlet_model', 'outletmodel');
            return $this->CI->outletmodel->add_ratecard_assign($param); 
        }




}