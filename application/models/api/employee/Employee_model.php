<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Employee_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	

	public function addRole($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$ROLE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$ROLE, $cat );
			return $this->db->insert_id();
		} else {
			$data ['msg'] = "Name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function addRoleForm( $map ) {
		//print_r($map);
		//exit;
		$data = array ();
		foreach($map as $row){
			$catvalue['role_id'] = $row['role_id'];
			$catvalue['form_id'] = $row['form_id'];
			$catvalue['menuname'] = $row['menuname'];
			$catvalue['access_type'] = $row['access_type'];
			/* $catvalue['edit'] = $row['edit'];
			$catvalue['view'] = $row['view'];
			$catvalue['no_access'] = $row['no_access']; */
			$this->db->insert ( TABLES::$FORM_ASSIGN, $catvalue);
		}
		$data ['status'] = 1;
		$data ['msg'] = "Added successfully";
		//return $data;
		return $data;
	}
	
	public function getFormAssignByRoleid($roleid) {
		$this->db->select ( '*' )->from ( TABLES::$FORM_ASSIGN );
		$this->db->where ('role_id',$roleid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function deleteRoleFormByRoleId($roleid) {
		$this->db->where ('role_id', $roleid);
		$this->db->delete( TABLES::$FORM_ASSIGN);
	}
	
	public function getActiveRole() {
		$this->db->select ( '*' )->from ( TABLES::$ROLE );
		//$this->db->where ('status',1);
		$this->db->order_by ('id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
		
	public function getActiveRole1() {		
		$this->db->select ( '*' )->from ( TABLES::$ROLE );		
		$this->db->where ('status',1);			
		$this->db->order_by ('id','ASC');		
		$query = $this->db->get ();		
		$result = $query->result_array ();		
		return $result;	
	}
	
	public function updateRole($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$ROLE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$ROLE, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getRoleById($id) {
		$this->db->select ( '*' )->from ( TABLES::$ROLE );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addEmp($cat) {
		$data = array ();
		$params = array (
				'email' => $cat ['email']
		);
		$this->db->select ( 'id' )->from ( TABLES::$EMPLOYEE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$EMPLOYEE, $cat );
			$data['empid'] = $this->db->insert_id();
			$data['msg'] = "Employee Added Successfully";
			$data['status'] = 1;
			return $data;
		} else {
			$data['msg'] = "Employee already exists.";
			$data['status'] = 0;
			return $data;
		}
	}
	
	public function addupload($data) {
		$result = array ();
		if(count($data['images']) > 0) {
				$this->db->insert_batch ( TABLES::$EMPLOYEE_DOC, $data ['images'] );
		}
		//echo $this->db->last_query();
		$result ['status'] = 1;
	    $result ['msg'] = "Added successfully";
	    return $result;
	}
	
	public function getActiveEmp() {
		$this->db->select ( 'a.*,b.name as role' , FALSE)
		->from ( TABLES::$EMPLOYEE.' AS a' )
		->join(TABLES::$ROLE.' AS b','a.role_id = b.id','inner');
		//$this->db->where ('status',1);
		$this->db->order_by ('a.id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}		
	
	public function getActiveEmp1() {		
		$this->db->select ( 'a.*,b.name as role' , FALSE)		
		->from ( TABLES::$EMPLOYEE.' AS a' )		
		->join(TABLES::$ROLE.' AS b','a.role_id = b.id','inner');	
		$this->db->where ('a.status',1);			
		$this->db->order_by ('a.id','ASC');			
		$query = $this->db->get ();			
		$result = $query->result_array ();			
		return $result;		
	}
	
	public function getActiveForm() {
		$this->db->select ( '*' )->from ( TABLES::$FORM_ACCESS );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveSubForm() {
		$this->db->select('a.*', FALSE)
		->from(TABLES::$SUBFORM_ACCESS.' AS a')
		->join(TABLES::$FORM_ACCESS.' AS b','a.form_id = b.id','inner');
		$this->db->order_by ('a.id','ASC');
		$query = $this->db->get ();
	//	echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getEmpById($category_id) {
		$this->db->select('a.*,b.name as role,c.documents as doc', FALSE)
		->from(TABLES::$EMPLOYEE.' AS a')
		->join(TABLES::$ROLE.' AS b','a.role_id = b.id','inner')
		->join(TABLES::$EMPLOYEE_DOC.' AS c','a.id = c.emp_id','left');
		$this->db->where ( 'a.id', $category_id );
		$this->db->order_by ('a.id','ASC');
		$query = $this->db->get ();
	//	echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getUpload() {
		$this->db->select ( 'b.documents' );
		$this->db->from ( TABLES::$EMPLOYEE . ' AS a' );
		$this->db->join ( TABLES::$EMPLOYEE_DOC . ' AS b', 'a.id=b.emp_id', 'left' );
		$this->db->order_by ('a.id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		//echo $this->db->last_query();
		return $result;
	}
	
	public function updateEmp($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$EMPLOYEE )->where ( $params );
		$query = $this->db->get ();
		
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$EMPLOYEE, $cat );
			//echo $this->db->last_query();
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function updateupload($data) {
		$result = array ();
			$this->db->where ( 'emp_id', $data['emp_id'] );
			$result ['status'] = 1;
		$result ['msg'] = "Updated successfully";
		return $result;
	}
	
	public function getSubEmpById($id) {
		$this->db->select ( '*' )->from ( TABLES::$EMPLOYEE );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getCustomerList(){
		$this->db->select ('*');
		$this->db->from ( TABLES::$USER );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
}