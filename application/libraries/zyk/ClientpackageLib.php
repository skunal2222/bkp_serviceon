<?php
class ClientpackageLib {
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function savePackage($data) {
		$this->CI->load->model ( 'package/Client_package_model', 'package' );
		$package = $this->CI->package->addPackage ($data);
		return $package;
	}

	public function savebatchPackageModels($data) {
		$this->CI->load->model ( 'package/Client_package_model', 'package' );
		$package = $this->CI->package->addbatchPackageModels ($data);
		return $package;
	}

    public function savebatchPackageServices($data) {
		$this->CI->load->model ( 'package/Client_package_model', 'package' );
		$package = $this->CI->package->addbatchPackageServices ($data);
		return $package;
	}
    
	public function get_services_by_id($param) {
        $this->CI->load->model ('package/Client_package_model', 'package');
	    return $this->CI->package->get_services_by_id($param);
    }

    public function getAllPackageList() {
        $this->CI->load->model ('package/Client_package_model', 'package');
	    return $this->CI->package->getAllPackageList();
    }

    public function getpackageId($a) {
		 $this->CI->load->model ('package/Client_package_model', 'package');
		$coupons = $this->CI->package->getPackageId ( $a );
		return $coupons;
	}
	public function update($data) {
		$this->CI->load->model ('package/Client_package_model', 'package');
		$package = $this->CI->package->update ( $data );
		return $package;
	}

	public function getPackageModels($a) {
		$this->CI->load->model ('package/Client_package_model', 'package');
		$response = $this->CI->package->getPackageModels ($a);
		return $response;
	}

	public function getPackageServices($a) {
		$this->CI->load->model ('package/Client_package_model', 'package');
		$response = $this->CI->package->getPackageServices ($a);
		return $response;
	}

	public function updateBatchPackageModels($packagedata) {
		$this->CI->load->model ('package/Client_package_model', 'package');
		return $this->CI->package->updateBatchPackageModels($packagedata);
	}

	public function updateBatchPackageServices($packageserviceused) {
		$this->CI->load->model ('package/Client_package_model', 'package');
		return $this->CI->package->updateBatchPackageServices($packageserviceused);
	}

	public function PackageNameAlreadyExist($packagename) {
		$this->CI->load->model ('package/Client_package_model', 'package');
		return $this->CI->package->PackageNameAlreadyExist($packagename);
	}

	public function RemoveServices($package_Id) {
		$this->CI->load->model ( 'package/Client_package_model', 'package' );
		$package = $this->CI->package->RemoveServices ($package_Id);
		return $package;
	}

	public function RemoveModel($package_Id) {
		$this->CI->load->model ( 'package/Client_package_model', 'package' );
		$package = $this->CI->package->RemoveModel ($package_Id);
		return $package;
	}
	public function get_packagename_by_modelid($model_id) {
		$this->CI->load->model ( 'package/Client_package_model', 'package' );
		$package = $this->CI->package->get_packagename_by_modelid ($model_id);
		return $package;
	}
	public function getActivePackages() {
		$this->CI->load->model ( 'package/Client_package_model', 'package' );
		$package = $this->CI->package->getActivePackages();
		return $package;
	}
	public function get_userpackage_by_packageid($user_id,$vehicle_id,$package_id) {
		$this->CI->load->model ( 'package/Client_package_model', 'package' );
		$package = $this->CI->package->get_userpackage_by_packageid ($user_id,$vehicle_id,$package_id);
		return $package;
	}

}