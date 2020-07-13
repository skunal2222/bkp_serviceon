<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Mloyal extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('MloyalLib', 'mloyallib');	
	}
        function get_points_validation_info() {
            $data['objClass'] = array(
                'customer_mobile' => '9975468540',
                'customer_points' => '50',
                'store_code' => '001'
            );
            $data['method_name'] = 'GET_POINTS_VALIDATION_INFO';
            $response = $this->mloyallib->send_curl_request($data);
            echo "<pre>";
            print_r(json_decode($response, true));
            exit;
//            Array
//(
//    [GET_POINTS_VALIDATION_INFOResult] => Array
//        (
//            [Success] => 1
//            [message] => coupon has been sent on customer mobile 919975468540.
//            [methodname] => Points_Validation
//            [output] => Array
//                (
//                    [points] => 100
//                    [points_value] => 100
//                )
//
//        )
//
//)
    }
    function insert_customer_registration_action() {
        $data['objClass'][] = array(
            'customer_mobile' => '9975468540',
            'registration_date' => date('Y-m-d H:i'),
            'customer_name' => 'Tabrosh Shaikh',
            'customer_email' => 'tab@yopmail.com',
            'store_code' => STORE_CODE_REG,
        );
        $data['method_name'] = 'INSERT_CUSTOMER_REGISTRATION_ACTION';
        $response = $this->mloyallib->send_curl_request($data);
        echo "<pre>";
        print_r(json_decode($response, true));
        exit;
// Output             
//            Array (
//            [INSERT_CUSTOMER_REGISTRATION_ACTIONResult] => Array
//                (
//                    [Success] => 1
//                    [message] => Total Records=1;successfully transferred=1;unsuccessful transferred =0
//                    [methodname] => Customer_Registration
//                    [output] => Array
//                        (
//                            [response] => SNo=1;Mobile=9975468540;Reason=Your Card is created successfully.;
//                        )
//
//                )
//            )
    }
    function redeem_loyalty_points_action() {
        $data['objClass'] = array(
            'customer_mobile' => '9975468540',
            'customer_points' => '10',
            'passcode' => '953194',
            'ref_bill_no' => 'Test-01',
            'store_code' => 'HO-01',
        );
        $data['method_name'] = 'REDEEM_LOYALTY_POINTS_ACTION';
        $response = $this->mloyallib->send_curl_request($data);
            echo "<pre>";
            print_r(json_decode($response, true));
            exit;
    }
    function reverse_points() {
        $data['objClass'] = array(
            'customer_mobile' => '9975468540',
            'redeem_date' => '10',
            'redeem_points' => date('Y-m-d H:i'),
            'ref_bill_no' => 'Test-01',
            'store_code' => 'HO-01',
        );
        $data['method_name'] = 'REVERSE_POINTS';
        $response = $this->mloyallib->send_curl_request($data);
            echo "<pre>";
            print_r(json_decode($response, true));
            exit;
    }
    function get_customer_trans_info() {
        $data['objClass'] = array(
            'customer_mobile' => '8793397880',
            
        );
        $data['method_name'] = 'GET_CUSTOMER_TRANS_INFO';
        $response = $this->mloyallib->send_curl_request($data);
        $response = json_decode($response, true);
        //$response = json_decode($response['GET_CUSTOMER_TRANS_INFOResult']['output']['response'], true);
            echo "<pre>";
            print_r($response);
            exit;
    }
	
	
	 
}

?>