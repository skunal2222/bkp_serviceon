<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Slot_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	

	public function addVslot($cat) {
		$data = array ();
		$params = array (
				'time_slot' => $cat ['time_slot']
		);
		$this->db->select ( 'id' )->from ( TABLES::$VISITING_SLOT )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$VISITING_SLOT, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Time slot time_slot already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getActiveVisiting() {
		$this->db->select ( '*' )->from ( TABLES::$VISITING_SLOT );
		//$this->db->where ('status',1);
		$this->db->order_by ('id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveVisiting1() {
		$this->db->select ( '*' )->from ( TABLES::$VISITING_SLOT );
		$this->db->where ('status',1);
		$this->db->order_by ('id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateVslot($cat) {
		$data = array ();
		$params = array (
				'time_slot' => $cat ['time_slot'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$VISITING_SLOT )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$VISITING_SLOT, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Time slot time_slot already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getVslotById($id) {
		$this->db->select ( '*' )->from ( TABLES::$VISITING_SLOT );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addDslot($cat) {
		$data = array ();
		$params = array (
				'time_slot' => $cat ['time_slot']
		);
		$this->db->select ( 'id' )->from ( TABLES::$DELIVERY_SLOT )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$DELIVERY_SLOT, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "SubCategory time_slot already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
public function getActiveDelivery() {
		$this->db->select ( '*' )->from ( TABLES::$DELIVERY_SLOT );
		//$this->db->where ('status',1);
		$this->db->order_by ('id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getDslotById($category_id) {
	
	
		$this->db->select('a.*', FALSE)
		->from(TABLES::$DELIVERY_SLOT.' AS a');
		$this->db->where ( 'id', $category_id );
		$this->db->order_by ('id','ASC');
		$query = $this->db->get ();
	//	echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateDslot($cat) {
		$data = array ();
		$params = array (
				'time_slot' => $cat ['time_slot'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$DELIVERY_SLOT )->where ( $params );
		$query = $this->db->get ();
		
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$DELIVERY_SLOT, $cat );
			//echo $this->db->last_query();
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Time slot already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getSubDslotById($id) {
		$this->db->select ( '*' )->from ( TABLES::$DELIVERY_SLOT );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	
	
}