<?php
class VehicleLib {
	public function __construct() {
		$this->CI = & get_instance ();
		$this->CI->load->model ( 'api/vehicle/Vehicle_model', 'vehiclemodel' );
	}
/******************code by kunal ***********************/
	public function AddVehical($data) {
		$response = $this->CI->vehiclemodel->AddVehical($data);
		return $response;
	}

	public function updateVehicle($data) {
		$response = $this->CI->vehiclemodel->updateVehicle ($data);
		return $response;
	}

    public function getVehiclesbyId($id)
    {
        $result = $this->CI->vehiclemodel->getVehiclesbyId($id);
        return $result;
    }

    public function getVehicleList($id)
    {
        $result = $this->CI->vehiclemodel->getVehicleList($id);
        return $result;
    }
/******************code by kunal ***********************/

}
?>