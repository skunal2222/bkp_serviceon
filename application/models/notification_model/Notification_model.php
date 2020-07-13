<?php
class Notification_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	public function getCustomerList(){
		$this->db->select ('b.*,a.name as name,a.email as email,a.mobile as mobile');
		$this->db->from ( TABLES::$USER.' AS a');
		$this->db->join ( TABLES::$USER_NOTIFICATION.' AS b','a.id=b.user_id','left' );
		$this->db->where ( 'b.status', 1 );
		$this->db->where ( 'b.source', 'Backend');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getAllUserlist() {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$USER );
		$this->db->where ( 'status', 1 );
		//$this->db->where ( 'id', 11 );
		$this->db->where ( 'gcm_reg_id IS NOT NULL AND gcm_reg_id != ""', '',false );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
		
	}	
	 
}