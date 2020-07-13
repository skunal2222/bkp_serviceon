<?php
class EmployeeLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}

	public function addRole($map) {
		/*$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$result = $this->CI->employeemodel->addRole ($cat);
		return $result;*/ 

		$resp = array ();
		$result = $this->checkRoleExist($map['name']);  

		if(empty($result))
		{  
			return $this->saveRole($map);
		}else{
			$resp ['status'] = 1;
			$resp ['msg'] = "Role Already Present";
			echo json_encode($resp);exit;
		} 

	} 
	public function saveAccess($type_id,$stack)
	{
		$this->CI->load->model ( 'employee/Employee_model', 'employee' );
		$result = $this->CI->employee->saveAccess ($type_id,$stack);
		return $result;
	} 
	public function saveRole($map)
	{
		$this->CI->load->model ( 'employee/Employee_model', 'employee' );
		$id = $this->CI->employee->saveRole ($map);
		return $id;
	}
	public function checkRoleExist($name)
	{ 
		$this->CI->load->model ( 'employee/Employee_model', 'employee' );
		$result = $this->CI->employee->checkRoleExist ($name);
		return $result;
	}
	public function getAllActiveRole() {
		$this->CI->load->model ( 'employee/Employee_model', 'employee' );
		$response = $this->CI->employee->getAllActiveRole();
		return $response;
	}
	public function getActiveRole() {
		$this->CI->load->model ( 'employee/Employee_model', 'employee' );
		$response = $this->CI->employee->getActiveRole();
		return $response;
	}
	public function getActiveRole1($id) {
		$this->CI->load->model ( 'employee/Employee_model', 'employee' );
		$response = $this->CI->employee->getActiveRole1($id);
		return $response;
	}
	public function getAllRoles()
	{
		$this->CI->load->model ( 'employee/Employee_model', 'employee' );
		$response = $this->CI->employee->getAllRoles();
		return $response;
	}
	
	public function updateRole($cat) {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$result = $this->CI->employeemodel->updateRole ( $cat );
		return $result;
	}

	public function updateRoleRequest($map, $data1)
	{
        $this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->updateRoleAccess ( $map, $data1 );
    	
	}
	
	public function getRoleById($cat_id) {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->getRoleById ( $cat_id );
		return $response;
	}
	
	public function deleteRoleFormByRoleId($roleid) {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->deleteRoleFormByRoleId ( $roleid );
		//return $response;
	}
	
	public function getFormAssignByRoleid($cat_id) {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->getFormAssignByRoleid ( $cat_id );
		return $response;
	}
	
	public function addEmp($cat) {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$result = $this->CI->employeemodel->addEmp ($cat);
		return $result;
	}
	
	public function addupload($data){
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$creative = $this->CI->employeemodel->addupload ( $data );
		return $creative;
	}
	
	public function updateupload($data){
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$creative = $this->CI->employeemodel->updateupload ( $data );
		return $creative;
	}
	
	public function getActiveEmp() {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->getActiveEmp();
		return $response;
	}
	public function getActiveEmp1() {			
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );			
		$response = $this->CI->employeemodel->getActiveEmp1();			
		return $response;		
	}
	public function getActiveForm() {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->getActiveForm();
		return $response;
	}
	
	public function getActiveSubForm() {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->getActiveSubForm();
		return $response;
	}
	
	public function getEmpId($category_id) {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->getEmpId($category_id);
		return $response;
	}
	
	public function updateEmp($cat) {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$result = $this->CI->employeemodel->updateEmp  ( $cat );
		return $result;
	}
	
	public function getEmpById($cat_id) {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->getEmpById ( $cat_id );
		return $response;
	}
	
	public function getUpload() {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->getUpload ();
		return $response;
	}
	
	public function addRoleForm($paras) {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->addRoleForm ( $paras );
		return $response;
	}
	
	public function getCustomerList() {
		$this->CI->load->model ( 'employee/Employee_model', 'employeemodel' );
		$response = $this->CI->employeemodel->getCustomerList ();
		return $response;
	}
	
}