<?php
class Sociallib {
	public function __construct() {
		$this->CI = & get_instance ();
                $this->CI->load->model('social/Social_Model', 'social_model' );
	}
	
	
	public function google_user_data($data) {
		$this->CI->load->helper('string');
                $password = random_string('alnum',5);
                $user_data = array(
                    'oauth_provider' => 'Google',
                    'oauth_uid' => $data['id'],
                    'name' => $data['given_name'],
                    'lname' => $data['family_name'],
                    'source' => 'Google',
                    'email' => $data['email'],
                    'avatar' => $data['picture'],
                    'created_on' => date('Y-m-d'), 
                    'original' => $password,
                    'password' => md5($password),
                    
                );
	        $this->CI->social_model->process_user_details($user_data);
		
	}
    
    public function facebook_user_data($data) {
		
		$this->CI->load->helper('string');
                $password = random_string('alnum',5);
                $avatar = (isset($data['picture']['url']))?$data['picture']['url']:"";
                $user_data = array(
                    'oauth_provider' => 'facebook',
                    'oauth_uid' => $data['id'],
                    'name' => $data['first_name'],
                    'lname' => $data['last_name'],
                    'source' => 'facebook',
                    'email' => $data['email'],
                    'avatar' => $avatar,
                    'created_on' => date('Y-m-d'), 
                    'original' => $password,
                    'password' => md5($password),
                );
	        $this->CI->social_model->process_user_details($user_data);
	}
    
    public function instagram_user_data($data) {
		
		$response = $this->CI->social_model->process_user_details($data);
		return $response;
	}
    
    public function twitter_user_data($data) {
		
		$response = $this->CI->social_model->process_user_details($data);
		return $response;
	}
}