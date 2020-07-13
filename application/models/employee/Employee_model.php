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

	public function saveRole($map) {  
        $data = array(
            'name' => $map['name'],
            'alias_name' => str_replace(" ", "_", strtolower(trim($map['name']))),
            'created_datetime' => $map['created_datetime'],
            'status' => $map['status'],
        );
 
        $this->db->insert(TABLES::$ROLE, $data);

        $data['id'] = $this->db->insert_id();
        $this->saveAccessControls($data);
        return $data;
    }

	public function checkRoleExist($name) {
        $name = str_replace(" ", "_", strtolower(trim($name)));  
        $this->db->select('*')
                ->from(TABLES::$ROLE)
                ->where('alias_name', $name);
        $query = $this->db->get();
        $result = $query->result_array();  
        return $result;   
    }
     public function saveAccess($type_id, $stack) {
        $access = $stack['accessname'];
        foreach ($access as $value) {
            $data = array(
                'role_id' => $type_id,
                'module_id' => $value, 
                'access_type' => $stack["access_type" . $value],
            );
            $this->db->insert(TABLES::$ACCESS_CONTROL, $data);
        }
        $resp ['status'] = 0;
        $resp ['msg'] = "Added successfully";
        echo json_encode($resp);
        exit;
    }
     public function saveAccessControls($data) { 
     	$data1 = array (); 
        $this->db->select('*')->from(TABLES::$FORM_ACCESS);
        $query = $this->db->get();
        $result = $query->result_array();
        $datanew = array();
        $a = 0;
        foreach ($result as $value) {
            $datanew[$a]['module_id'] = $value['id'];
            $datanew[$a]['access_type'] = 3;
            $datanew[$a]['role_id'] = $data['id'];
            $a++;
        }   
        $this->db->insert_batch(TABLES::$ACCESS_CONTROL, $datanew);
        $data1 ['status'] = 1;
        $data1 ['msg'] = "Added successfully";
        return $data1;
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

/*
			echo "<pre>";
			print_r($catvalue);
			exit();
*/

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
        $this->db->where('id !=', 1)->where ('status',1);
		$this->db->order_by ('id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getAllActiveRole() {
		$this->db->select ( '*' )->from ( TABLES::$ROLE );
		$this->db->where ('status',1); 
        //$this->db->where('id !=', 1)->where ('status',1);
		$this->db->order_by ('id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getAllRoles() {
		$this->db->select ( '*' )->from ( TABLES::$ROLE );
		//$this->db->where ('status',1); 
        $this->db->where('id !=', 1);
		$this->db->order_by ('id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
		
	public function getActiveRole1() {		
		$this->db->select ( '*' )->from ( TABLES::$ROLE );		
		//$this->db->where ('status',1); 
        $this->db->where('id !=', 1);
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
	
	 public function updateRoleAccess($data, $access) {
        $this->db->update_batch(TABLES::$ACCESS_CONTROL, $access, 'id');

        $this->db->where('id', $data ['id']);
        $this->db->update(TABLES::$ROLE, $data);
        if(isset($_POST['new'])) {
        	$Insertdata = array();
        	foreach ($_POST['new'] as $key => $value) {
        		$Insertdata[] = array(
 					'module_id' => $key,
 					'access_type' => $value,
 					'role_id' => $_POST['role_id']
        		);
        	}
        	$this->db->insert_batch(TABLES::$ACCESS_CONTROL, $Insertdata);
        }

        $resp ['status'] = 1;
        $resp ['msg'] = "Role Updated Successfully";
        echo json_encode($resp);
        exit;
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
	
		/*	$this->db->select ( '*' )->from ( TABLES::$FORM_ACCESS );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;*/

	/*	$this->db->select ( 'id,name' )->from ( TABLES::$FORM_ACCESS )->order_by ( 'name', 'asc' );
		$query = $this->db->get ();
		$result = $query->result_array (); 
		return $result;*/

		$moduls =  $this->db->select('a.id,a.name')
							  ->from(TABLES::$FORM_ACCESS . ' AS a')
			                  ->where('a.only_for_admin!=', 1)
			                  ->get()
			                  ->result_array();
	    $access =  $this->db->select('b.id, b.module_id, b.access_type')
	    				      ->from(TABLES::$ACCESS_CONTROL . ' AS b')
			                  ->where('b.role_id', $_POST['id'])
			                  ->get()
			                  ->result_array();              
		$temp = array();
		$data = array();
		$temp2 = array();
		foreach ($access as $value) {
			$temp[$value['module_id']] = $value['access_type'];
			$temp2[$value['module_id']] = $value['id'];
		}
			//return $temp2;
		$a = 0;
	    foreach ($moduls as $value) {
	    	 $data[$a]['name'] = $value['name'];
	    	 $data[$a]['module_id'] = $value['id'];
	    	 $data[$a]['role_id'] = $_POST['id'];
    	     if(isset($temp[$value['id']])) {
				$data[$a]['id'] = $temp2[$value['id']];
				$data[$a]['access_type'] = $temp[$value['id']];
    	     } else {
    	     	$data[$a]['id'] = 0;
    	     	$data[$a]['access_type'] = 'No';
    	     }
    	     $a++;
	    }
	    return $data;
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