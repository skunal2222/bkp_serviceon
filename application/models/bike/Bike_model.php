<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Bike_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	 

	public function addBike($params){ 
		$data = array ();
		$existarr = array (
				'client_id' => $params ['client_id'],
				'outlet_id' => $params ['outlet_id'],
				'bike_number' => $params ['bike_number']
						
		);
		$this->db->select ( 'id' )->from ( TABLES::$BIKE )->where ( $existarr );
		$query = $this->db->get ();
		$result = $query->result_array (); 

		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$BIKE, $params ); 
			$data ['status'] = 1;
			$data ['msg'] = "Bike Added successfully";
                        //$activity_log['comment'] = "{$params['name']} bike added.";
                        //$activity_log['user_id'] = $this->session->adminsession['id'];
                        //activity_log($activity_log);
			return $data;
		} else {
			$data ['msg'] = "Bike name already exists.";
			$data ['status'] = 0;
			return $data;
		} 
	} 
	public function getListBikes()
	{
			$this->db->select('a.*,b.reg_company_name,c.outlet_name',FALSE)
			->from(TABLES::$BIKE.' AS a') 
			->join(TABLES::$CLIENT.' AS b','b.id = a.client_id','inner') 
			->join(TABLES::$OUTLET.' AS c','c.id = a.outlet_id','inner')
			->order_by ('a.bike_name','ASC'); 
                         if($_SESSION['adminsession']['is_client'] == 1) {
                             $this->db->where_in('c.id', explode(",", $_SESSION['adminsession']['outlet_id']));
                         }
                         
			$query = $this->db->get ();
			$result = $query->result_array ();   
			return $result;
	} 
	public function getAllBikes()
	{
		$this->db->select('a.*,b.name as city',FALSE)
				 ->from(TABLES::$BIKE.' AS a')
				 ->join(TABLES::$CITY.' AS b','a.city = b.id','inner') 
				 ->where ('a.status',1)
				 ->order_by ('a.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	} 

	public function getBikeByID($id)
	{ 
		$this->db->select('a.*', FALSE)
		->from(TABLES::$BIKE.' AS a');
		$this->db->where('a.id',$id);
		$this->db->order_by ('bike_name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();

		return $result;
	}

	public function updateBike($params){		
		$data = array ();
		$data = array (
				'bike_name' => $params ['bike_name'],
				'id !=' => $params ['id']
		); 
		$this->db->select ( 'id' )->from ( TABLES::$BIKE )->where ( $data );
		$query = $this->db->get ();
		$result = $query->result_array ();
                
		if (count ( $result ) == 0) {
			$this->db->where ( 'id', $params ['id'] );
			$this->db->update ( TABLES::$BIKE, $params );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully"; 
			return $data;
		} else {
			$data ['msg'] = "Bike name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function getBikesByName($name) {
		$this->db->select ( 'id, name' );
		$this->db->from ( TABLES::$MANUFACTURE );
		$this->db->like ( 'name', $name,'both' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}  
	public function getBikesDetails($id)
	{  
		$this->db->select('a.*', FALSE)
		->from(TABLES::$BRAND.' AS a');
		$this->db->where('a.id',$id);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();

		return $result;
	}

}
