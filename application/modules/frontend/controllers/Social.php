<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Social extends MX_Controller {

    private $_gp_client;
    private $_gp_plus;
    private $_gp_moment;
    private $_gp_plusItemScope;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('zyk/Sociallib');
        $this->load->library('zyk/UserLib');
    }

    public function facebook() {
       $this->load->library('facebook');
       redirect($this->facebook->login_url());
    }

    public function facebook_login() {
        $this->load->library('facebook');
        $response = $this->facebook->request('get', '/me?fields=id, first_name, last_name, email, gender, locale, picture');
        if (isset($response['id'])) {
            $this->sociallib->facebook_user_data($response);
        }

        if(isset($_SESSION['referrer_url'])){
        	redirect($_SESSION['referrer_url']); // session set at booking confirm view in script tag
        } else {
        	redirect(base_url());
        }
   }

    public function google() {
        set_include_path(APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path());
        $this->load->library('Googleplus');
        if(isset($_GET['code']))
		{
			$this->googleplus->getAuthenticate();
			$response = $this->googleplus->getUserInfo();
			$this->sociallib->google_user_data($response);

			if(isset($_SESSION['referrer_url'])){
        		redirect($_SESSION['referrer_url']); // session set at booking confirm view in script tag
	        } else {
	        	redirect(base_url());
	        }
		}
		else 
		{
			redirect($this->googleplus->loginURL());
		}
    }



    function mobile_opt() {
        $this->load->library ( 'zyk/UserLoginLib' );
        $response = array();
        $check_mobile = $this->db->query('SELECT * FROM tbl_users WHERE mobile = '.$_POST['mobile'])->result_array();
        if(empty($check_mobile)) {
            $data = $this->db->query('SELECT * FROM tbl_users WHERE id = '.$_POST['id'])->result_array();
            $otp = $this->userloginlib->otpSendSocial($data[0]);
            
            $this->session->set_userdata('otp', $otp);
            $response['status'] = 1 ;
            $response['msg'] = 'OTP send successfully' ;
            $response['mobile'] = $_POST['mobile'] ;
        } else {
            $response['status'] = 0 ;
            $response['msg'] = 'Mobile number already register with us';
            
        }
        echo json_encode($response);
    }

    function social_mobile_otp_verify() {
       // echo $this->session->otp;
        if($_POST['otp'] == $this->session->otp) {
            $this->session->unset_userdata('socialuserid');
            $this->session->unset_userdata('otp');
            $update = array(
                'mobile' => $_POST['mobile'],
                'status' => 1
            );
            $this->db->where('id', $_POST['id'])
                     ->update('tbl_users', $update);
            $data = $this->db->query('SELECT * FROM tbl_users WHERE id ='.$_POST['id'])->result_array();
            $this->session->set_userdata('olouserid', $data[0]['id']);
            $this->session->set_userdata('olousername', $data[0]['name']);
            $this->session->set_userdata('olouseremail', $data[0]['email']);
            $this->session->set_userdata('olousermobile', $data[0]['mobile']);
            $this->session->set_userdata('active', 1);
            $response['status'] = 1 ;
            
        } else {
            $response['status'] = 0 ;
            $response['msg'] = 'Wrong OTP' ;
        }
        echo json_encode($response);
    }

    

}

?>