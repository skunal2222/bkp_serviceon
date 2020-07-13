<?php

Class Employee_model extends CI_Model {

    public function add_update_role($data) {
        if ($data['id'] != '') {
            $data1 = array(
                    'id !=' => $data['id'],
                    'name ' => $data['name']
                );
            $this->check_exist($data1, TRUE);
            $this->db->where('id', $data['id']);
            $this->db->update('tbl_client_role');
            echo json_encode(array('status' => 1, 'msg' => 'Updated successfully'));
        } else {
            $data1 = array(
                    'name ' => $data['name']
                );
            $this->check_exist($data1, FALSE);
            $data['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert('tbl_client_role', $data);
            echo json_encode(array('status' => 1, 'msg' => 'Added successfully'));
        }
    }

    public function check_exist($data, $is_update) {
        $result = $this->db->select('id')
                            ->from('tbl_client_role')
                            ->where($data)
                            ->get()
                            ->result_array();
        if(!empty($result)) {
            echo json_encode(array('status' => 0, 'msg' => 'Duplicate role name'));
            exit;
        }
        
    }
    
    public function get_role_list() {
        return $this->db->select('*')
                        ->from('tbl_client_role')
                       // ->where('status',1) 
                        ->order_by('id', 'ASC')
                        ->get()
                        ->result_array();
    }
    
    public function get_role_by_id($param) {
        return $this->db->select('*')
                        ->from('tbl_client_role')
                        ->where('id', $param)
                        ->get()
                        ->result_array();
    }
    public function checkRoleExist($name) {
        $name = str_replace(" ", "_", strtolower(trim($name)));  
        $this->db->select('*')
                ->from(TABLES::$CLIENT_USER_ROLE)
                ->where('alias_name', $name);
        $query = $this->db->get();
        $result = $query->result_array();   
        return $result;   
    }

    public function saveRole($map) {  
        $data = array(
            'name' => $map['name'],
            'alias_name' => str_replace(" ", "_", strtolower(trim($map['name']))),
            'created_datetime' => $map['created_datetime'],
            'status' => $map['status'],
        ); 
        
        $this->db->insert(TABLES::$CLIENT_USER_ROLE, $data);

        $data['id'] = $this->db->insert_id();

        $this->saveAccessControls($data);
        return $data;
    } 

    public function saveAccessControls($data) {  

        $data1 = array (); 
        $this->db->select('*')->from(TABLES::$CLIENT_FORM_ACCESS);
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
        $this->db->insert_batch(TABLES::$CLIENT_ACCESS_CONTROL, $datanew);
        $data1 ['status'] = 1;
        $data1 ['msg'] = "Added successfully..!!";
        return $data1;
    } 
     public function saveAccess($type_id, $stack) {
        $access = $stack['accessname'];
        foreach ($access as $value) {
            $data = array(
                'role_id' => $type_id,
                'module_id' => $value, 
                'access_type' => $stack["access_type" . $value],
            );
            $this->db->insert(TABLES::$CLIENT_ACCESS_CONTROL, $data);
        }
        $resp ['status'] = 0;
        $resp ['msg'] = "Role Added successfully..";
        //echo json_encode($resp);
        //exit;
         return $resp;
    }
    public function getActiveForm() { 

        $moduls =  $this->db->select('a.id,a.name')
                              ->from(TABLES::$CLIENT_FORM_ACCESS . ' AS a')
                              ->where('a.only_for_admin!=', 1)
                              ->get()
                              ->result_array();
        $access =  $this->db->select('b.id, b.module_id, b.access_type')
                              ->from(TABLES::$CLIENT_ACCESS_CONTROL . ' AS b')
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
    public function updateRoleAccess($data, $access) {

        $this->db->update_batch(TABLES::$CLIENT_ACCESS_CONTROL, $access, 'id');

        $this->db->where('id', $data ['id']);
        $this->db->update(TABLES::$CLIENT_USER_ROLE, $data);
        if(isset($_POST['new'])) {
            $Insertdata = array();
            foreach ($_POST['new'] as $key => $value) {
                $Insertdata[] = array(
                    'module_id' => $key,
                    'access_type' => $value,
                    'role_id' => $_POST['role_id']
                );
            }
            $this->db->insert_batch(TABLES::$CLIENT_ACCESS_CONTROL, $Insertdata);
        }

        $resp ['status'] = 1;
        $resp ['msg'] = "Role Updated Successfully";
        echo json_encode($resp);
        exit;
    }
    public function addEmp($cat) { 

        $data = array ();
        $params = array (
                'mobile' => $cat ['mobile'],
                'email' => $cat ['email']
        );
        $this->db->select ( 'id' )->from ( TABLES::$CLIENT_EMPLOYEE )->where ( $params );
        $query = $this->db->get ();
        $result = $query->result_array ();

        if (count ( $result ) <= 0) {
            $this->db->insert ( TABLES::$CLIENT_EMPLOYEE, $cat );
            $data['id'] = $this->db->insert_id();
            $data['msg'] = "Employee Added Successfully";
            $data['status'] = 1;
            return $data;
        } else {
            $data['msg'] = "Employee already exists.";
            $data['status'] = 0;
            //return $data;
            echo json_encode($data);
            exit;
        }
    } 
     public function addClientAsUser($data) {

        $params = array( 
            'mobile' => $data ['mobile'],
            'email' => $data ['email']
        );  
 
        $this->db->select('id')->from(TABLES::$B2B_ADMIN_USER)->where($params);
        $query = $this->db->get();
        $result = $query->result_array();   
        if (count($result) <= 0) {  
            $this->db->insert(TABLES::$B2B_ADMIN_USER, $data);
            $data ['status'] = 1;
            $data ['msg'] = "Added successfully";
            $data['id'] = $this->db->insert_id();
            return $data;
        } else { 

            $data ['msg'] = "User already exists.";
            $data ['status'] = 0;
            return $data;
        } 
 
    }
     public function updateClientAsUser($data){ 
        
        $result = array ();
        $this->db->where('emp_id',$data['emp_id']);
        $this->db->update(TABLES::$B2B_ADMIN_USER,$data);
        //echo $this->db->last_query();
        $result ['status'] = 1;
        $result ['msg'] = "Updated successfully";
        return $result;

    } 
    public function addupload($data) {
        $result = array ();
        if(count($data) > 0) {
                $this->db->insert_batch ( TABLES::$CLIENT_EMPLOYEE_DOC, $data);
        }
        //echo $this->db->last_query();
        $result ['status'] = 1;
        $result ['msg'] = "Added successfully";
        return $result;
    }

    public function getActiveEmp() {
        $this->db->select ( 'a.*,b.reg_company_name as client_name,c.name as user_role' , FALSE)
        ->from ( TABLES::$CLIENT_EMPLOYEE.' AS a' )
        ->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner')
        ->join(TABLES::$CLIENT_USER_ROLE.' AS c','a.user_role = c.id','left');
        //$this->db->where ('status',1);
        $this->db->order_by ('a.id','DESC');
        $query = $this->db->get ();
        $result = $query->result_array ();
        return $result;
    }   
    public function getEmpById($id) {
        $this->db->select('a.*,b.reg_company_name', FALSE)
        ->from(TABLES::$CLIENT_EMPLOYEE.' AS a')
        ->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner');
      //  ->join(TABLES::$CLIENT_EMPLOYEE_DOC.' AS c','a.id = c.emp_id','left');
        $this->db->where ( 'a.id', $id );
        $this->db->order_by ('a.id','ASC');
        $query = $this->db->get ();
    //  echo $this->db->last_query();
        $result = $query->result_array (); 
        return $result;
    }
    public function updateEmp($cat) {
        $data = array (); 
        $params = array (
                'email' => $cat ['email'],
                'id !=' => $cat ['id']
        );

        $this->db->select ( 'id' )->from ( TABLES::$CLIENT_EMPLOYEE )->where ( $params );
        $query = $this->db->get ();
        
        $result = $query->result_array ();

        if (count ( $result ) <= 0) {
            $this->db->where ( 'id', $cat ['id'] );
            $this->db->update ( TABLES::$CLIENT_EMPLOYEE, $cat ); 
            //$this->db->update (TABLES::$B2B_ADMIN_USER, $cat);
            //echo $this->db->last_query();
            $data ['id'] = $this->db->insert_id(); 
            $data ['status'] = 1;
            $data ['msg'] = "Updated successfully";
            return $data;
        } else {
            $data ['msg'] = "Employee Email already exists.";
            $data ['status'] = 0;
            return $data;
        }
    }
    public function Emp_document_update($data) {

        $result = array ();
            $this->db->where ( 'emp_id', $data['emp_id'] ); 
            $this->db->update ( TABLES::$CLIENT_EMPLOYEE_DOC, $cat );
            $result ['status'] = 1;
        $result ['msg'] = "Updated successfully";
        return $result;
    }
     public function checkEmplyee($data) {
        $where = "a.client_id={$data['client_id']} AND a.user_role={$data['user_role']} AND a.outlet_id IN ({$data['outlet_id']})";
        $this->db->select('a.id')->from(TABLES::$B2B_ADMIN_USER . ' as a')->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }
     public function checkEmployee_update($data) {

        $where = "a.client_id={$data['client_id']} AND a.user_role={$data['user_role']} AND a.outlet_id IN ({$data['outlet_id']}) AND a.id != {$data['id']}";
        $this->db->select('a.id')->from(TABLES::$B2B_ADMIN_USER . ' as a')->where($where);
        $query = $this->db->get(); 
        return $query->result_array();
       
    }
    
    

}

?>