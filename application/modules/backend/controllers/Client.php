<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Client extends MX_Controller {

    public function __construct() {
        parent::__construct();
       $this->load->library('zyk/ClientLib', 'clientlib');
    }

    public function ClientAdd() {

        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Administrator | ClientAdd')
                ->set_partial('header', 'partials/header')
                ->set_partial('leftnav', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('client/ClientAdd');
    }

    public function add_client() {
        $params = array();
        $params['first_name'] = ucfirst($this->input->post('first_name'));
        $params['last_name'] = $this->input->post('last_name'); 
        $params['reg_company_name'] = ucfirst($this->input->post('reg_company_name'));
        $params['poc_name'] = $this->input->post('poc_name');
        $params['poc_mob'] = $this->input->post('poc_mob');
        $params['poc_email'] = $this->input->post('poc_email');
        $params['gst_no'] = $this->input->post('gst_no');
        //	$params['files'] = $this->input->post('files');
        $params['billing_cycle'] = $this->input->post('billing_cycle');
        $params['status'] = $this->input->post('status');
        $params['package_payment_type'] = $this->input->post('package_payment_type');
        $params['created_datetime'] = date('Y-m-d H:i:s');
        $params['updated_datetime'] = date('Y-m-d H:i:s');
        $params['created_by'] = $this->session->adminsession['id'];


        $response = $this->clientlib->addClient($params);

        $map =array();
         if($response['status'] == 0)
         { 
                $map['status'] = 0;
                $map['msg'] = "Client Already Exist..";
                echo json_encode($response);exit;
        }
         
       /* $data = array();
        $data['first_name'] = ucfirst($this->input->post('first_name'));
        $data['last_name'] = $this->input->post('last_name');
        $data['email'] = $this->input->post('poc_email');
        $data['password'] = MD5('dummy@123');
        $data['user_role'] = '1';
        $data['mobile'] = $this->input->post('poc_mob');
        $data['text_password'] = 'dummy@123';
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['first_login'] = '1';
        $data['status'] = '1';
        $data['created_by'] = $this->session->adminsession['id'];
 
 
        $response1 = $this->clientlib->addClientAsUser($data); 
        $map =array();
         if($response1['status'] == 0)
         { 
                $map['status'] = 0;
                $map['msg'] = "Client Already Exist.";
                echo json_encode($response1);exit;
        }
                 $this->sendNewUserEmail($data);  
        */

        $cpt = count($_FILES ['doc_url'] ['name']);
        $images = array();

        for ($i = 0; $i < $cpt; $i ++) {
            $_FILES ['doc_url'] ['name'] [$i];
            $_FILES ['image_client'] ['name'] = $_FILES ['doc_url'] ['name'] [$i];
            $_FILES ['image_client'] ['type'] = $_FILES ['doc_url'] ['type'] [$i];
            $_FILES ['image_client'] ['tmp_name'] = $_FILES ['doc_url'] ['tmp_name'] [$i];
            $_FILES ['image_client'] ['error'] = $_FILES ['doc_url'] ['error'] [$i];
            $_FILES ['image_client'] ['size'] = $_FILES ['doc_url'] ['size'] [$i];

            $config = array();
            $config ['upload_path'] = 'assets/backend/images/clients/';
            $config ['allowed_types'] = 'jpg|png|PNG|JPEG';


            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image_client')) {
                $image[] = array(
                    'doc_url' => $config ['upload_path'] . '' . $this->upload->data('file_name'),
                    'client_id' => $response['id']
                );
            } else {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            }
        }


        $response2 = $this->clientlib->addClient_image($image);
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

    /**
     * Edit Password
     */
    public function editPassword()
    {
        
        $param['updated_by'] = $this->session->userdata['adminsession']['id'];
        $params['updated_date'] = date('Y-m-d H:i:s');
        $param = $this->input->post('data');
        $newpassword = $param['text_password'];
        $password = MD5($newpassword);
        
        $data = array();
        $data['uid'] = $this->session->userdata['adminsession']['id'];
        $data['oldpassword'] = $param['oldpassword'];
        $data['password'] = $password;
        $data['text_password'] = $param['text_password'];
        $this->load->library('zyk/adminauth');
        $response = $this->adminauth->checkPassword($data);
        $map = array();
        if($response['status'] == 1){
            $boolvalue = $this->adminauth->editPassword($data);
            if($boolvalue == 1)
            {
                $map['status'] = 1;
                $map['msg'] = "Password updated successfully";
            }
            else
            {
                $map['status'] = 0;
                $map['msg'] = "Failed to change password";
            }
        }
        else
        {
            $map = $response;
        }
        echo json_encode($map);
    } 


    public function ClientList() {
        $client = $this->clientlib->getAllClientList();
        $this->template->set('client', $client);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Administrator | Client List')
                ->set_partial('header', 'partials/header')
                ->set_partial('leftnav', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('client/ClientList'); 
    }

    public function ClientEdit($id) {
        
        $client = $this->clientlib->getClientsbyId($id);
        
        $this->template->set('client', $client['client'][0]);
        $this->template->set('images', $client['images']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Administrator | ClientEdit')
                ->set_partial('header', 'partials/header')
                ->set_partial('leftnav', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('client/ClientEdit');
    }

    public function update_client() {
        $params = array();
        $params['id'] = $this->input->post('id');
        $params['first_name'] = ucfirst($this->input->post('first_name'));
        $params['last_name'] = $this->input->post('last_name'); 
        $params['reg_company_name'] = ucfirst($this->input->post('reg_company_name'));
        $params['poc_name'] = $this->input->post('poc_name');
        $params['poc_mob'] = $this->input->post('poc_mob');
        $params['poc_email'] = $this->input->post('poc_email');
        $params['gst_no'] = $this->input->post('gst_no');
        $params['billing_cycle'] = $this->input->post('billing_cycle');
        $params['status'] = $this->input->post('status');
        $params['created_datetime'] = date('Y-m-d H:i:s');
        $params['updated_datetime'] = date('Y-m-d H:i:s');
        $params['package_payment_type'] = $this->input->post('package_payment_type');
        $params['created_by'] = $this->session->adminsession['id']; 
        $response = $this->clientlib->updateClient($params);

       /* $billingdata = array();
        $billingdata['billing_cycle'] = $this->input->post('billing_cycle');
        $billingdata['account_type'] = $this->input->post('account_type');
        $billingdata['account_number'] = $this->input->post('account_number');
        $billingdata['bank_name'] = $this->input->post('bank_name');
        $billingdata['branch_name'] = $this->input->post('branch_name');
        $billingdata['ifsc_code'] = $this->input->post('ifsc_code');
        $billingdata['profit_sharing_perc'] = $this->input->post('profit_sharing_perc');
        $billingdata['clientid'] = $this->input->post('id');

        $response1 = $this->clientlib->updateClientBilling($billingdata);
*/
        if (!empty($_FILES ['doc_url'])) {

            $cpt = count($_FILES ['doc_url'] ['name']);
            $images = array();

            for ($i = 0; $i < $cpt; $i ++) {
                $_FILES ['doc_url'] ['name'] [$i];
                $_FILES ['image_client'] ['name'] = $_FILES ['doc_url'] ['name'] [$i];
                $_FILES ['image_client'] ['type'] = $_FILES ['doc_url'] ['type'] [$i];
                $_FILES ['image_client'] ['tmp_name'] = $_FILES ['doc_url'] ['tmp_name'] [$i];
                $_FILES ['image_client'] ['error'] = $_FILES ['doc_url'] ['error'] [$i];
                $_FILES ['image_client'] ['size'] = $_FILES ['doc_url'] ['size'] [$i];

                $config = array();
                $config ['upload_path'] = 'assets/backend/images/clients/';
                $config ['allowed_types'] = 'jpg|png|PNG|JPEG';


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image_client')) {
                    $image[] = array(
                        'doc_url' => $config ['upload_path'] . '' . $this->upload->data('file_name'),
                        'client_id' => $this->input->post('id')
                    );
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                }
            }
            $response2 = $this->clientlib->addClient_image($image);
        }
        echo json_encode($response);
    }

    function delete_client_doc() {
     $this->clientlib->delete_client_doc($this->input->post('doc_id'));
    }
    
    public function generateSeoURL($string, $wordLimit = 0) {
            $separator = '-';

            if ($wordLimit != 0) {
               $wordArr = explode(' ', $string);
               $string = implode(' ', array_slice($wordArr, 0, $wordLimit));
            }

            $quoteSeparator = preg_quote($separator, '#');

            $trans = array(
                '&.+?;' => '',
                '[^\w\d _-]' => '',
                '\s+' => $separator,
                '(' . $quoteSeparator . ')+' => $separator
            );

            $string = strip_tags($string);
            foreach ($trans as $key => $val) {
               $string = preg_replace('#' . $key . '#i' . (UTF8_ENABLED ? 'u' : ''), $val, $string);
            }

            $string = strtolower($string);

            return trim(trim($string, $separator));
        }
}
