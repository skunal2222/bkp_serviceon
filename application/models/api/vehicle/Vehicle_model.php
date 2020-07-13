<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );

class Vehicle_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}

	/************** code by kunal *******************/
	public function addVehical($cat) { 
        $data = array (); 
          
        $params = array (
                'user_id' => $cat ['user_id'],
                'vehicle_no' => $cat ['vehical_no'] 
        );

        $data1 = array(
            'user_id' => $cat['user_id'],
            'vehicle_no' => $cat['vehical_no'],
            'vehicle_alias_no' => str_replace(" ", "_", strtolower(trim($cat['vehical_no']))), 
            'brand_id' => $cat['brand_id'],
            'model_id' => $cat['model_id'],
            'manufactured_year' => $cat['manufactured_year'],
            'total_kms' => $cat['total_kms'],
            'created_datetime' => $cat['created_datetime'],
            'status' => $cat['status']
        );
         
        $this->db->select ( 'id' )->from ( TABLES::$USER_VEHICLES )->where ( $params );
        $query = $this->db->get ();
        $result = $query->result_array ();

        if (count ( $result ) <= 0) {
            $this->db->insert ( TABLES::$USER_VEHICLES, $data1 );
            $data['id'] = $this->db->insert_id();
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        return $data;
    }

    public function updateVehicle($params)
    {
        $id = $params ['id'];
        $vehicle_no = $params ['vehicle_no'];

        $this->db->select ( 'id' )->from ( TABLES::$USER_VEHICLES )->where ('id !=',$id )->where ('vehicle_no',$vehicle_no );
        $query = $this->db->get ();
        $result = $query->result_array ();

        if (count ( $result ) <= 0) {
            $this->db->where('id', $params['id']);
            $this->db->update(TABLES::$USER_VEHICLES, $params);
            $data ['status'] = 1;
        }
        else
        {
            $data ['status'] = 0;
        }
        return $data;
    }

    public function getVehiclesbyId($id) {
        $this->db->select('a.*,b.name as username ,b.mobile as usermobile,c.name as brandname,d.name as modelname', FALSE)
                 ->from(TABLES::$USER_VEHICLES . ' AS a') 
                 ->join ( TABLES::$USER . ' AS b', 'a.user_id = b.id')
                 ->join ( TABLES::$BRAND . ' AS c', 'a.brand_id = c.id')
                 ->join ( TABLES::$MANUFACTURE . ' AS d', 'a.model_id = d.id')
                 ->where ( 'a.id', $id );
        $query = $this->db->get ();
        $result = $query->result_array ();
        //print_r($result);
        return $result;
    }

    public function getVehicleList($id) {
        $this->db->select ( 'a.*,b.name as brandname,c.name as modelname' )
                 ->join ( TABLES::$BRAND . ' AS b', 'a.brand_id = b.id', 'inner' )
                 ->join ( TABLES::$MANUFACTURE . ' AS c', 'a.model_id = c.id', 'left' );  
        $this->db->from ( TABLES::$USER_VEHICLES.' AS a'); 
        $this->db->where ( 'a.user_id', $id );
        $this->db->where ( 'a.status', 1 );
        $query = $this->db->get ();
        $result = $query->result_array ();
        //print_r($result);
        return $result;
    }

	/************** code by kunal *******************/
}
?>