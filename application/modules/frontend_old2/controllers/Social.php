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
    }

    public function facebook() {
       $this->load->library('facebook');
       if ($this->facebook->is_authenticated()) {
         
          $response = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
         
          $this->sociallib->facebook_user_data($response);
          redirect('/');
         // Insert or update user data
         // $userID = $this->user->checkUser($userData);
         // Check user data insert or update status
         //if(!empty($userID)){
         //   $data['userData'] = $userData;
         //  $this->session->set_userdata('userData',$userData);
         //} else {
         //  $data['userData'] = array();
         // }
         // Get logout URL
         //$data['logoutUrl'] = $this->facebook->logout_url();
      } else {
         $fbuser = '';
         // Get login URL


         redirect($this->facebook->login_url());
      }
    }
    function facebook_login() {
      $this->load->library('facebook');
      $response = $this->facebook->request('get', '/me?fields=id, first_name, last_name, email, gender, locale, picture');
      if (isset($response['id'])) {
          $this->sociallib->facebook_user_data($response);
      } 
      redirect('/');
      
   }

    public function google() {
        set_include_path(APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path());
        $this->load->library('Googleplus');
        $this->_gp_client = $this->googleplus->client;
        $this->_gp_plus = $this->googleplus->plus;
        $this->_gp_moment = $this->googleplus->moment;
        $this->_gp_plusItemScope = $this->googleplus->plusItemScope;
        $this->_gp_plusItemScope = $this->googleplus->plus;
        if ($this->input->get_post('code')) {
            try {
                /* $scope = "profile email";
                  $this->_gp_client->setScopes($scope); */
                $this->_gp_client->authenticate($this->input->get_post('code'));
                $access_token = $this->_gp_client->getAccessToken();
                $this->session->set_userdata('access_token', $access_token);
                //on google redirection get the user details and check wether this user is already member of 
                //live yogis then only do login process other wise add this user as new member to live yogis
                //redirect('/google_c/me');
                try {
                    $this->_gp_client->setAccessToken($this->session->userdata('access_token'));
                    $response = $this->_gp_plus->people->get('me');
 
                    $this->sociallib->google_user_data($response);
                    redirect('/');
                    
                } catch (Google_Auth_Exception $e) {
                    print_r($e);
                }
            } catch (Google_Auth_Exception $e) {
                print_r($e);
            }
        } else {
            try {
                //else redirect to google authntication service directly
                //to redirect external url use refresh param with redirect function
                redirect($this->_gp_client->createAuthUrl(), 'refresh');
                //echo anchor($this->_gp_client->createAuthUrl(), 'Conect Me');
            } catch (Google_Auth_Exception $e) {
                print_r($e);
            }
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