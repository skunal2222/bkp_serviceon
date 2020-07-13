<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Social_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function process_user_details($data) {
       
        $email = $data['email'];
        $data['mobile'] = '';
        $data['otp'] = '';
        $data['coupon_code'] = '';
        $data['created_on'] = date('Y-m-d'); 
        $user = $this->db->query("SELECT * FROM tbl_users WHERE email = '$email'")->result_array();
        if (empty($user)) {
            $this->db->insert('tbl_users', $data);
            $user_id = $this->db->insert_id();
            $update['my_ref_code'] = strtoupper(base_convert(strtotime(date('Y-m-d H:i:s')), 10, 36)).strtoupper(base_convert($user_id, 10, 36));
            $this->db->where('id', $user_id);
            $this->db->update('tbl_users', $update);
            $user = $this->db->query("SELECT * FROM tbl_users WHERE id = '$user_id'")->result_array();
            $this->session->set_userdata('olouserid', $user[0]['id']);
            $this->session->set_userdata('olousername', $user[0]['name']);
            $this->session->set_userdata('olouserlname', $user[0]['lname']);
            $this->session->set_userdata('olouseremail', $user[0]['email']);
            $this->session->set_userdata('olousermobile', $user[0]['mobile']);
            //$this->session->set_userdata('active', 0);
            $this->session->set_userdata('socialuserid', $user_id);
            $trans['userid'] = $user_id;
            $trans['amount'] = 0;
            $trans['created_date'] = date('Y-m-d H:i:s');
	        $trans['updated_date'] = date('Y-m-d H:i:s');
            $this->db->insert ( TABLES::$WALLET, $trans);
        } else {
            $this->session->set_userdata('olouserid', $user[0]['id']);
            $this->session->set_userdata('olousername', $user[0]['name']);
            $this->session->set_userdata('olouseremail', $user[0]['email']);
            $this->session->set_userdata('olousermobile', $user[0]['mobile']);
            if($user[0]['mobile'] == '') {
            $this->session->set_userdata('socialuserid', $user[0]['id']);   
            }
            
            
        }
    }

}
