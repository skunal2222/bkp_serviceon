<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Quality_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	

	public function addParameter($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$PARAMETER )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$PARAMETER, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getActiveParameter() {
		$this->db->select ( '*' )->from ( TABLES::$PARAMETER );
		//$this->db->where ('status',1);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveParameter1($id) {
		$this->db->select('b.id,b.name', FALSE)
		->from(TABLES::$GRADEPARA.' AS a')
		->join(TABLES::$PARAMETER.' AS b','a.parameter_id = b.id','inner');
		$this->db->where ( 'a.grade_id', $id );
	  	$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveParameter2() {
		$this->db->select ( '*' )->from ( TABLES::$PARAMETER );
		$this->db->where ('status',1);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateParameter($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$PARAMETER )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$PARAMETER, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Name name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getParameterById($id) {
		$this->db->select ( '*' )->from ( TABLES::$PARAMETER );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addGrade($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$GRADE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$GRADE, $cat );
			return $this->db->insert_id();
		} else {
			$data ['msg'] = "SubCategory name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function addGradePara( $map ) {
		$data = array ();
		foreach($map as $row){
			$catvalue['grade_id'] = $row['grade_id'];
			$catvalue['parameter_id'] = $row['parameter_id'];
			$this->db->insert ( TABLES::$GRADEPARA, $catvalue);
	
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			
		}
		return $data;
	}		
	
	public function updateGradePara( $map )
	{		
		$this->db->where ( 'grade_id',$map[0]['grade_id']);		
		$this->db->delete ( TABLES::$GRADEPARA );		
		$data = array ();			
		foreach($map as $row)
		{				
			$catvalue['grade_id'] = $row['grade_id'];				
			$catvalue['parameter_id'] = $row['parameter_id'];				
			$this->db->insert ( TABLES::$GRADEPARA, $catvalue);						
			$data ['status'] = 1;				
			$data ['msg'] = "Updated successfully";								
		}			
		return $data;		
	}

	
   public function getActiveGrade() {
		$this->db->select ( '*' )->from ( TABLES::$GRADE );
		//$this->db->where ('status',1);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getmainActiveGrade() {
		$this->db->select ( '*' )->from ( TABLES::$GRADE );
		$this->db->where ('status',1);
		$this->db->order_by ('name','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getGradeById($category_id) {
		$this->db->select('a.id,a.name,a.status,b.parameter_id', FALSE)
		->from(TABLES::$GRADE.' AS a')		->join(TABLES::$GRADEPARA.' AS b','b.grade_id=a.id','inner');
		$this->db->where ( 'a.id', $category_id );
		$this->db->order_by ('a.name','ASC');
		$query = $this->db->get ();
	//	echo $this->db->last_query();
		$result = $query->result_array ();				
		if(empty($result))		
		{			
			//echo "inside if";			
			$this->db->select ( '*' )->from ( TABLES::$GRADE );			
			$this->db->where ('id',$category_id);			
			$query = $this->db->get ();			
			//echo $this->db->last_query();			
			$result = $query->result_array ();			
			//return $result;		
		}		
		return $result;
	}
	
	public function updateGrade($cat) {      	
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$GRADE )->where ( $params );
		$query = $this->db->get ();
		
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$GRADE, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Name already exists.";
			$data ['status'] = 0;
			return $data;
		}	}
	
	public function getSubGradeById($id) {
		$this->db->select ( '*' )->from ( TABLES::$GRADE );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	
	
}