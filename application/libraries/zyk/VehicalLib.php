<?php
class VehicalLib {
	
	public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->model('vehical/Vehical_model', 'vehical');
	} 
    public function AddVehical($cat) { 
        $result = $this->CI->vehical->AddVehical($cat);
        return $result;
    }  
    public function getActiveBikeBrands(){
        $result = $this->CI->vehical->getActiveBikeBrands();
        return $result;
    } 
    public function getModelsByBrandsID($brandsID=NULL)
    {
        return $this->CI->vehical->getModelsByBrandsID($brandsID);
    }
    public function getVehicalList($id)
    {
        $result = $this->CI->vehical->getVehicalList($id);
        return $result;
    }
    public function getBrandListbyVehicalId($id) { 
        $result = $this->CI->vehical->getBrandListbyVehicalId($id);
        return $result;
    } 
    public function getModelListbyVehicalId($id) { 
        $result = $this->CI->vehical->getModelListbyVehicalId($id);
        return $result;
    } 
    public function getAllVehicleList(){
          return $this->CI->vehical->getAllVehicleList();
    }
    public function getVehiclesbyId($id)
    {
        $result = $this->CI->vehical->getVehiclesbyId($id);
        return $result;
    }
    public function updateVehicle($params)
    {
        $result = $this->CI->vehical->updateVehicle($params);
        return $result;
    }
    public function addLicense($cat) { 
        $result = $this->CI->vehical->addLicense($cat);
        return $result;
    }
     public function getUserLicenseList($id)
    {
        $result = $this->CI->vehical->getUserLicenseList($id);
        return $result;
    }
     public function updateLicense($params)
    {
        $result = $this->CI->vehical->updateLicense($params);
        return $result;
    }
    public function delete_license_by_id($id)
    {
        $result = $this->CI->vehical->delete_license_by_id($id);
        return $result;
    }
    public function addVehicleRC($cat) { 
        $result = $this->CI->vehical->addVehicleRC($cat);
        return $result;
    }
    public function getVehicalDocumentList($id)
    {
        $result = $this->CI->vehical->getVehicalDocumentList($id);
        return $result;
    }
     public function updateVehicleRC($params)
    {
        $result = $this->CI->vehical->updateVehicleRC($params);
        return $result;
    }
     public function delete_rc_by_id($id)
    {
        $result = $this->CI->vehical->delete_rc_by_id($id);
        return $result;
    }
     public function addVehicleInsurance($cat) { 
        $result = $this->CI->vehical->addVehicleInsurance($cat);
        return $result;
    }
       public function updateVehicleInsurance($params)
    {
        $result = $this->CI->vehical->updateVehicleInsurance($params);
        return $result;
    }
     public function delete_insurance_by_id($id)
    {
        $result = $this->CI->vehical->delete_insurance_by_id($id);
        return $result;
    }

     public function addVehiclePuc($cat) { 
        $result = $this->CI->vehical->addVehiclePuc($cat);
        return $result;
    }

     public function updateVehiclePuc($params)
    {
        $result = $this->CI->vehical->updateVehiclePuc($params);
        return $result;
    }
     public function delete_puc_by_id($id)
    {
        $result = $this->CI->vehical->delete_puc_by_id($id);
        return $result;
    }

    public function addOtherDocuments($cat) { 
        $result = $this->CI->vehical->addOtherDocuments($cat);
        return $result;
    }

    public function editOtherDocuments($cat) { 
        $result = $this->CI->vehical->editOtherDocuments($cat);
        return $result;
    }

    public function delete_other_doc_by_id($id)
    {
        $result = $this->CI->vehical->delete_other_doc_by_id($id);
        return $result;
    }
    public function getVehicalAllDocumentList($vehicleid,$userid)
    {
        $result = $this->CI->vehical->getVehicalAllDocumentList($vehicleid,$userid);
        return $result;
    }


}