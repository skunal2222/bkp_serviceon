<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Area_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	

	public function addCity($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$CITY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$CITY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "City name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getActiveCities() {
		$this->db->select ( '*' )->from ( TABLES::$CITY );
		//$this->db->where ('status',1);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateCity($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$CITY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$CITY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "City name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getCityById($id) {
		$this->db->select ( '*' )->from ( TABLES::$CITY );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addZone($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$ZONE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$ZONE, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Zone name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getActiveZones() {
		
		
		$this->db->select('a.*,b.name as city', FALSE)
		->from(TABLES::$ZONE.' AS a')
		->join(TABLES::$CITY.' AS b','a.city_id = b.id','inner');
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getZoneId($category_id) {
	
	
		$this->db->select('a.*', FALSE)
		->from(TABLES::$ZONE.' AS a');
		$this->db->where ( 'id', $city_id );
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
	//	echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateZone($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$ZONE )->where ( $params );
		$query = $this->db->get ();
		
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$ZONE, $cat );
		//	echo $this->db->last_query();
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Zone name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getZoneById($id) {
		$this->db->select ( '*' )->from ( TABLES::$ZONE );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	public function addArea($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$AREA )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$AREA, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Area name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getActiveAreas() {
		$this->db->select('a.*,b.name as area,c.name as zone', FALSE)
		->from(TABLES::$AREA.' AS a')
		->join(TABLES::$AREA.' AS b','a.id = b.id','inner')
		->join(TABLES::$ZONE.' AS c','a.zone_id = c.id','inner');
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveAreas2() {
		$this->db->select('a.*', FALSE)
		->from(TABLES::$AREA.' AS a')
		->join(TABLES::$ZONE.' AS c','a.zone_id = c.id','inner');
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateArea($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$AREA )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$AREA, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Area name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getAreaById($id) {
		$this->db->select ( '*' )->from ( TABLES::$AREA );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveAreas1() {
		$this->db->select ( '*' )->from ( TABLES::$AREA );
		//$this->db->where ('status',1);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
}