<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MloyalLib {
    function insert_customer_registration_action($register) {
        $data['objClass'][] = array(
            'customer_mobile' => $register['mobile'],
            'registration_date' => date('Y-m-d H:i'),
            'customer_name' => $register['name'],
            'customer_email' => $register['email'],
            'store_code' => STORE_CODE_REG,
        );
        $data['method_name'] = 'INSERT_CUSTOMER_REGISTRATION_ACTION';
        $response = $this->send_curl_request($data);
    }
    function get_points_validation_info() {
        $data['objClass'] = array(
            'customer_mobile' => '',
            'customer_points' => '',
            'store_code' => '',
            'method_name' => 'GET_POINTS_VALIDATION_INFO'
        );
        $this->send_curl_request($data);
    }
    function get_customer_trans_info($mobile) {
        $data['objClass'] = array(
            'customer_mobile' => $mobile,
            
        );
        $data['method_name'] = 'GET_CUSTOMER_TRANS_INFO';
        $response = $this->send_curl_request($data);
        $response = json_decode($response, true);
        $response = json_decode($response['GET_CUSTOMER_TRANS_INFOResult']['output']['response'], true);
        if(empty($response)) {
            return '0';
        } else {
            return $response['CUSTOMER_DETAILS'][0]['LoyalityPoints'];
        }
    }

    function redeem_loyalty_points_action() {
        $data['objClass'] = array(
            'customer_mobile' => '',
            'customer_points' => '',
            'store_code' => '',
            'passcode' => '',
            'ref_bill_no' => '',
            'method_name' => 'REDEEM_LOYALTY_POINTS_ACTION'
        );
        $this->send_curl_request($data);
    }

    function get_voucher_validation_info() {
        $data['objClass'] = array(
            'voucher_code' => '',
            'store_code' => '',
            'method_name' => 'GET_VOUCHER_VALIDATION_INFO'
        );
        $this->send_curl_request($data);
    }

    function redeem_voucher_exhaustion_action() {
        $data['objClass'] = array(
            'voucher_code' => '',
            'store_code' => '',
            'passcode' => '',
            'ref_bill_no' => '',
            'method_name' => 'REDEEM_VOUCHER_EXHAUSTION_ACTION'
        );
        $this->send_curl_request($data);
    }
    

    public function send_curl_request($data) {
        $curl = curl_init();
        $url = "http://mqst.mloyalpos.com/Service.svc/".$data['method_name'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'content-type: application/json',
                'pwd: @pa$$w0rd',
                'userid: mob_usr'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

}

?>