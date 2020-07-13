<?php
class Instamojo {
    const version = '1.1';
    protected $curl;
//    LIVE
    protected $endpoint = 'https://www.instamojo.com/api/1.1/';
    protected $api_key = '65b23b080ac62a1c2aeb1a7587117334';
    protected $auth_token ='1579ce87964a2f252d22ece0a137bf2a';
    //Test
      // protected $endpoint = 'https://test.instamojo.com/api/1.1/';
      // protected $api_key = 'test_f9626a8125397a1b1e88fe9bbc9';
      // protected $auth_token ='test_516a0ac25848a585f81067406c9';
    
   
    public function __construct($api_key, $auth_token=null, $endpoint=null) 
    {
        $this->api_key = (string) $api_key;
        $this->auth_token = (string) $auth_token;
        if(!is_null($endpoint)){
            $this->endpoint = (string) $endpoint;   
        }
    }
    public function __destruct() 
    {
        if(!is_null($this->curl)) {
            curl_close($this->curl);
        }
    }
    
    private function build_curl_headers() 
    {
        $headers = array("X-Api-key: $this->api_key");
        if($this->auth_token) {
            $headers[] = "X-Auth-Token: $this->auth_token";
        }
        return $headers;        
    }
    
    private function build_api_call_url($path)
    {
        if (strpos($path, '/?') === false and strpos($path, '?') === false) {
            return $this->endpoint . $path . '/';
        }
        return $this->endpoint . $path;
    }
    
    private function api_call($method, $path, array $data=null) 
    {
		//echo "<br>inside api";
        $path = (string) $path;
		//echo "<br>path=".$path;
        $method = (string) $method;
		//echo "<br>method=".$method;
        $data = (array) $data;
		//echo "<br>data=".$data;
        $headers = $this->build_curl_headers();
        $request_url = $this-> build_api_call_url($path);
        $options = array();
        $options[CURLOPT_HTTPHEADER] = $headers;
        $options[CURLOPT_RETURNTRANSFER] = true;
        
        if($method == 'POST') {
            $options[CURLOPT_POST] = 1;
            $options[CURLOPT_POSTFIELDS] = http_build_query($data);
        } else if($method == 'DELETE') {
            $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        } else if($method == 'PATCH') {
            $options[CURLOPT_POST] = 1;
            $options[CURLOPT_POSTFIELDS] = http_build_query($data);         
            $options[CURLOPT_CUSTOMREQUEST] = 'PATCH';
        } else if ($method == 'GET' or $method == 'HEAD') {
            if (!empty($data)) {
                /* Update URL to container Query String of Paramaters */
                $request_url .= '?' . http_build_query($data);
            }
        }
        // $options[CURLOPT_VERBOSE] = true;
        $options[CURLOPT_URL] = $request_url;
        $this->curl = curl_init();
        $setopt = curl_setopt_array($this->curl, $options);
        $response = curl_exec($this->curl);
        $headers = curl_getinfo($this->curl);
        $error_number = curl_errno($this->curl);
        $error_message = curl_error($this->curl);
        $response_obj = json_decode($response, true);
        if($error_number != 0){
            if($error_number == 60){
                throw new \Exception("Something went wrong. cURL raised an error with number: $error_number and message: $error_message. " .
                                    "Please check http://stackoverflow.com/a/21114601/846892 for a fix." . PHP_EOL);
            }
            else{
                throw new \Exception("Something went wrong. cURL raised an error with number: $error_number and message: $error_message." . PHP_EOL);
            }
        }
        if($response_obj['success'] == false) {
            $message = json_encode($response_obj['message']);
            throw new \Exception($message . PHP_EOL);
        }
        return $response_obj;
    }
    /**
    * @return string URL to upload file or cover image asynchronously
    */
    public function getUploadUrl()
    {
        $result = $this->api_call('GET', 'links/get_file_upload_url', array());
        return $result['upload_url'];
    }
    
    public function uploadFile($file_path)
    {
        $upload_url = $this->getUploadUrl();
        $file_path = realpath($file_path);
        $file_name = basename($file_path);
        $ch = curl_init();
        $data = array('fileUpload' => $this->getCurlValue($file_path, $file_name));
        curl_setopt($ch, CURLOPT_URL, $upload_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }
    public function getCurlValue($file_path, $file_name, $content_type='')
    {
        
        if (function_exists('curl_file_create')) {
            return curl_file_create($file_path, $content_type, $file_name);
        }
        
        $value = "@{$file_path};filename=$file_name";
        if ($content_type) {
            $value .= ';type=' . $content_type;
        }
        return $value;
    }
   
    public function uploadMagic(array $link)
    {
        if(!empty($link['file_upload'])) {
            $file_upload_json = $this->uploadFile($link['file_upload']);
            $link['file_upload_json'] = $file_upload_json;
            unset($link['file_upload']);
        }
        if(!empty($link['cover_image'])) {
            $cover_image_json = $this->uploadFile($link['cover_image']);
            $link['cover_image_json'] = $cover_image_json;
            unset($link['cover_image']);
        }
        return $link;        
    }
    
    public function auth(array $args)
    {
        $response = $this->api_call('POST', 'auth', $args);
        $this->auth_token = $response['auth_token']['auth_token']; 
        return $this->auth_token; 
    }
     
    public function linksList() 
    {
        $response = $this->api_call('GET', 'links', array());   
        return $response['links'];
    }
     
    public function linkDetail($slug) 
    {
        $response = $this->api_call('GET', 'links/' . $slug, array()); 
        return $response['link'];
    }
     
    public function linkCreate(array $link) 
    {   
        if(empty($link['currency'])){
            $link['currency'] = 'INR';
        }
        $link = $this->uploadMagic($link);
        $response = $this->api_call('POST', 'links', $link);
        return $response['link'];
    }
      
    public function linkEdit($slug, array $link) 
    {
        $link = $this->uploadMagic($link);
        $response = $this->api_call('PATCH', 'links/' . $slug, $link);
        return $response['link'];
    }
      
    public function linkDelete($slug) 
    {
        $response = $this->api_call('DELETE', 'links/' . $slug, array());
        return $response;
    }
    
    public function paymentsList($limit = null, $page = null) 
    {
        $params = array();
        if (!is_null($limit)) {
            $params['limit'] = $limit;
        }
        if (!is_null($page)) {
            $params['page'] = $page;
        }
        $response = $this->api_call('GET', 'payments', $params);
        return $response['payments'];
    }
    
    public function paymentDetail($payment_id) 
    {
        $response = $this->api_call('GET', 'payments/' . $payment_id, array()); 
        return $response['payment'];
    }
   
    public function paymentRequestCreate(array $payment_request) 
    {
		//echo "inside request";
		//print_r($payment_request);
        $response = $this->api_call('POST', 'payment-requests', $payment_request); 
		
        return $response['payment_request'];
    }
     
    public function paymentRequestStatus($id) 
    {
        $response = $this->api_call('GET', 'payment-requests/' . $id, array()); 
        return $response['payment_request'];
    }
    
    public function paymentRequestPaymentStatus($id, $payment_id) 
    {
        $response = $this->api_call('GET', 'payment-requests/' . $id . '/' . $payment_id, array()); 
        return $response['payment_request'];
    }
     
    public function paymentRequestsList($datetime_limits=null) 
    {
        $endpoint = 'payment-requests';
        if(!empty($datetime_limits)){
            $query_string = http_build_query($datetime_limits);
            if(!empty($query_string)){
                $endpoint .= '/?' . $query_string;
            }
        }
        $response = $this->api_call('GET', $endpoint, array()); 
        return $response['payment_requests'];
    }
     
    public function refundCreate(array $refund) 
    {
        $response = $this->api_call('POST', 'refunds', $refund); 
        return $response['refund'];
    }
     
    public function refundDetail($id) 
    {
        $response = $this->api_call('GET', 'refunds/' . $id, array()); 
        return $response['refund'];
    }
     
    public function refundsList() 
    {
        $response = $this->api_call('GET', 'refunds', array()); 
        return $response['refunds'];
    }

    public function createOrderPaymentRequest(array $ord_payment_request)
    {
        //         echo "inside request";
        // $headers = $this->build_curl_headers();
        // $response = $this->api_call('POST', 'gateway/orders/payment-request', $ord_payment_request); 
        // // return $response;
        // print_r($response); die();
        
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.instamojo.com/v2/gateway/orders/payment-request/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer 1579ce87964a2f252d22ece0a137bf2a'));

        $payload = $ord_payment_request; /*Array(
            'id' => '9c337d3c5e3242fca818937366b915b4'
        );*/

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch); 
        return $response;
    }
}
?>