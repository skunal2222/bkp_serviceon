<?php
class ClientemployeeLib {
	
	public function __construct(){
		$this->CI =& get_instance();
                $this->CI->load->model('client/Employee_model', 'employee');
	}
	public function add_update_role($data){
            return $this->CI->employee->add_update_role($data);
	} 
    public function addRole($map) { 
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
    public function checkRoleExist($name)
    {  
        $result = $this->CI->employee->checkRoleExist ($name);
        return $result;
    }
    public function saveRole($map)
    { 
        $id = $this->CI->employee->saveRole ($map);
        return $id;
    }
    public function saveAccess($type_id,$stack)
    { 
        $result = $this->CI->employee->saveAccess ($type_id,$stack);
        return $result;
    }
    public function get_role_list() {
        return $this->CI->employee->get_role_list();
    }
    public function get_emp_list() {
        
    }
    public function get_role_by_id($param) {
        return $this->CI->employee->get_role_by_id($param);
    }
    public function getActiveForm() { 
        $response = $this->CI->employee->getActiveForm();
        return $response;
    }
    public function updateRoleRequest($map, $data1)
    { 
      return  $response = $this->CI->employee->updateRoleAccess ( $map, $data1 ); 
    }
    public function addEmp($cat) { 
     $result = $this->CI->employee->addEmp($cat);
     return $result;
    } 
    public function addupload($data){ 
        $creative = $this->CI->employee->addupload ( $data );
        return $creative;
    }
    public function getActiveEmp() { 
        $response = $this->CI->employee->getActiveEmp();
        return $response;
    }
    public function getEmpById($id) { 
        $response = $this->CI->employee->getEmpById($id);
        return $response;
    }
    public function updateEmp($id) { 
       $result = $this->CI->employee->updateEmp($id);
        return $result;
    }
    public function Emp_document_update($data){ 
        $creative = $this->CI->employee->Emp_document_update($data);
        return $creative;
    }
    public function addClientAsUser($data) {  
        $result = $this->CI->employee->addClientAsUser ($data);
        return $result;
    }
    public function updateClientAsUser($data) {  
        $result = $this->CI->employee->updateClientAsUser ($data);
        return $result;
    }
    public function checkEmplyee($cat) { 
        $result = $this->CI->employee->checkEmplyee ($cat);
        return $result;
    }
    public function checkEmployee_update($cat) { 
        $result = $this->CI->employee->checkEmployee_update ($cat);
        return $result;
    } 
        
}