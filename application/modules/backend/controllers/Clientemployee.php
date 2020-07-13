<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Clientemployee extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('zyk/ClientemployeeLib', 'ClientemployeeLib');
    }
    
    
    public function list_employee() {

        $Emps = $this->clientemployeelib->getActiveEmp(); 
       
        $this->load->library('zyk/OutletLib', 'outletlib');
        $Outlets = $this->outletlib->getAllActive();  
        $Roles   =  $this->clientemployeelib->get_role_list();  
        $this->template->set('Emps',$Emps);
        $this->template->set('Outlets',$Outlets);
        $this->template->set('Roles',$Roles);
        $this->template->set_theme('default_theme')
                        ->set_layout('backend')
                        ->title('Administrator | Employee')
                        ->set_partial('header', 'partials/header')
                        ->set_partial('leftnav', 'partials/sidebar')
                        ->set_partial('footer', 'partials/footer')
                        ->build('client_employee/employee');
    }
    public function add_update_role() {
        /*$data = $this->input->post(NULL, TRUE);
        $this->clientemployeelib->add_update_role($data);*/

        $params = array();
        $map = $this->input->post(); 
        $params['name'] = $this->input->post('name');
        $params['status'] = $this->input->post('status');
        $params['created_datetime'] = date('Y-m-d H:i:s'); 
          
        $response = $this->clientemployeelib->addRole($params);  
       // $response = $this->clientemployeelib->saveAccess($role_id, $map);

        if($response['status']= 1 ){
            $response ['msg'] = "Role Added successfully.";
            echo json_encode($response);exit;
        } 
    }
   /* public function edit_role($id) {
        $role = $this->clientemployeelib->get_role_by_id($id);
        
    }*/ 
    public function editRoleList() {
        $id=$this->input->post('id');
        $Roles = $this->clientemployeelib->get_role_by_id($id); 
        $forms = $this->clientemployeelib->getActiveForm();  

        $this->template->set('Roles',$Roles);
        $this->template->set('forms',$forms);
    //  print_r($cities);
        $this->template->set_theme('default_theme');
        $this->template->set_layout (false); 
        $this->template->build ('client_employee/EditRole');
    }
    public function updateRole() {  
        $data1 = array();
        foreach($_POST['accessrole'] as $key => $value) {
            $data1[] = array(
                'id' => $key,
                'access_type' => $value
            );
        } 

        $data['id'] = $this->input->post('role_id');
        $data['name'] = $this->input->post('name');
        $data['status'] = $this->input->post('status');
        $data['created_datetime'] = date('Y-m-d H:i:s');
        $this->clientemployeelib->updateRoleRequest($data, $data1); 

    }
    public function newEmpList() { 
        
        $this->load->library('zyk/ClientLib', 'clientlib');
        $clients = $this->clientlib->getClients(); 
        $this->load->library('zyk/OutletLib', 'outletlib');
        $outlet = $this->outletlib->getAllActive();   
        $Roles   =  $this->clientemployeelib->get_role_list();
        $this->template->set('Roles',$Roles);
        $this->template->set('outlet', $outlet);
        $this->template->set('clients',$clients);
        $this->template->set_theme('default_theme');
        $this->template->set_layout (false);
        // echo $this->template->build ('partials/emplyee/AddCategory');
        $this->template->build ('client_employee/AddEmployee');
    }
    public function addEmp() {
        
        $params = array();
        $params['first_name'] = ucfirst($this->input->post('first_name'));
        $params['last_name'] = $this->input->post('last_name'); 
        $params['mobile'] = $this->input->post('mobile');
        $params['emergency_mobile'] = $this->input->post('emobile');
        $params['email'] = $this->input->post('email');
        $params['password'] = $this->input->post('password');
        $params['client_id'] = $this->input->post('client_id'); 
        $params['outlet_id'] = implode(",", $this->input->post('outlet_id'));
        //$params['document'] = $this->input->post('document'); 
        $params['user_role'] = $this->input->post('user_role'); 
        $params['status'] = $this->input->post('status');


         if (!empty($_FILES['image']['name'])) {
            $itemlocation = 'assets/images/employee/';
            $item_image = uploadImage($_FILES['image'], $itemlocation, array('jpeg', 'jpg', 'png', 'gif'), 2097152, 'item');
            if ($item_image['status'] == 1) {
                $params['image'] = $item_image['image'];
            } else {
                $errors = array();
                $error = array("image" => $item_image['msg']);
                if (!empty($error)) {
                    array_push($errors, $error);
                }
                $item_image['errormsg'] = $errors;
                echo json_encode($item_image);
                exit;
            }
        } 

        $params['created_by'] = $this->session->adminsession['id'];  
        $params['created_datetime'] = date('Y-m-d H:i:s'); 
        
        $response = $this->clientemployeelib->addEmp($params);  

        $data = array();
        $data['first_name'] = ucfirst($this->input->post('first_name'));  
        $data['last_name'] = $this->input->post('last_name'); 
        $data['email'] = $this->input->post('email');
        $data['password'] = MD5($this->input->post('password'));
        $data['user_role'] = $this->input->post('user_role'); 
        $data['emp_id'] = $response['id'];
        $data['mobile'] = $this->input->post('mobile');
        $data['text_password'] = $this->input->post('password'); 
        $data['client_id'] = $this->input->post('client_id'); 
        $data['outlet_id'] = implode(",", $this->input->post('outlet_id'));
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['first_login'] = '1';
        $data['status'] = $this->input->post('status');
        $data['created_by'] = $this->session->adminsession['id']; 
       
        $response1 = $this->clientemployeelib->addClientAsUser($data);  
                     $this->sendNewUserEmail($data);   
        echo json_encode($response);   
    }
    public function sendNewUserEmail($data){
        $this->load->library ( 'Pkemail' );
        $this->pkemail->load_system_config ();
        $this->pkemail->headline = 'Bike Doctor ';
        $this->pkemail->subject = 'Welcome to Bike Doctor';
        $this->pkemail->mctag = 'newuser-msg';
        $this->pkemail->attachment = 0;
        $this->pkemail->to = $data ['email'];
        $this->template->set ( 'data', $data );
        $this->template->set ( 'page', 'newuser-message' );
        $this->template->set_layout ( false );
        $text_body = $this->template->build ( 'backend/emails/newuser-email', '', true );
        $this->pkemail->send_email ( $text_body );
    } 
     public function checkEmplyee() {
        $data = $this->input->post();
        $data['outlet_id'] = implode(',', $data['outlet_id']);
        $result = $this->clientemployeelib->checkEmplyee($data);

        if (count($result) > 0) {
            $response['data'] = $result;
            $response['msg'] = 'Employee already Assigned to this client and outlet,please check the selected data';
            $response['status'] = 0;
        } else {
            $response['status'] = 1;
            $response['msg'] = 'Employee not assigned to this outlet and client ';
        }
        echo json_encode($response);
    }
    public function editEmp() {
        
        $id=$this->input->post('id'); 
        $this->load->library('zyk/ClientLib', 'clientlib');
        $clients = $this->clientlib->getClients(); 
        $this->load->library('zyk/OutletLib', 'outletlib');
        $Outlets = $this->outletlib->getAllActive();  
        $Emps = $this->clientemployeelib->getEmpById($id);   
        $Roles   =  $this->clientemployeelib->get_role_list();
        $this->template->set('Roles',$Roles);
        $this->template->set('Emps',$Emps); 
        $this->template->set('Outlets',$Outlets); 
        $this->template->set('clients',$clients);
        $this->template->set_theme('default_theme');
        $this->template->set_layout (false);
        // echo $this->template->build ('partials/emplyee/AddCategory');
        $this->template->build ('client_employee/EditEmployee');
    }
    public function updateEmp() {
        $params = array();

        $params['id'] = $this->input->post('id');
        $params['first_name'] = ucfirst($this->input->post('first_name'));
        $params['last_name'] = $this->input->post('last_name'); 
        $params['mobile'] = $this->input->post('mobile');
        $params['emergency_mobile'] = $this->input->post('emobile');
        $params['email'] = $this->input->post('email');
        $params['password'] = $this->input->post('password');
        $params['client_id'] = $this->input->post('client_id'); 
        $params['outlet_id'] = implode(",", $this->input->post('outlet_id'));
        //$params['document'] = $this->input->post('document');

        $params['user_role'] = $this->input->post('user_role'); 
        $params['status'] = $this->input->post('status'); 
        $params['updated_datetime'] = date('Y-m-d H:i:s'); 
       
       $result = $this->clientemployeelib->checkEmployee_update($params);

        //print_r($result);exit ; 

        if (count($result) > 0) {
            $response['data'] = $result;
            $response['msg'] = 'Employee already Assigned to this client and outlet,please check the selected data';
            $response['status'] = 0;

            echo json_encode($response);
            exit();
        } else {
            $response['status'] = 1;
            $response['msg'] = 'Employee not assigned to this client and outlet ';
        }
        //print_r($response);
        
        if (!empty($_FILES['image']['name'])) {
            $itemlocation = 'assets/images/employee/';
            $item_image = uploadImage($_FILES['image'], $itemlocation, array('jpeg', 'jpg', 'png', 'gif'), 2097152, 'item');
            if ($item_image['status'] == 1) {
                $params['image'] = $item_image['image'];
            } else {
                $errors = array();
                $error = array("image" => $item_image['msg']);
                if (!empty($error)) {
                    array_push($errors, $error);
                }
                $item_image['errormsg'] = $errors;
                echo json_encode($item_image);
                exit;
            }
        }    
            
        $response = $this->clientemployeelib->updateEmp($params);  

        $data = array();
        $data['first_name'] = ucfirst($this->input->post('first_name'));  
        $data['last_name'] = $this->input->post('last_name'); 
        $data['email'] = $this->input->post('email');
        $data['password'] = MD5($this->input->post('password'));
        $data['user_role'] = $this->input->post('user_role'); 
        $data['emp_id'] = $params['id'];
        $data['mobile'] = $this->input->post('mobile');
        $data['text_password'] = $this->input->post('password');
        $data['updated_datetime'] = date('Y-m-d H:i:s'); 
        $data['status'] = $this->input->post('status');
       
        $response1 = $this->clientemployeelib->updateClientAsUser($data); 

        echo json_encode($response);
    }
    
}
