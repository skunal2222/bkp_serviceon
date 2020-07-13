<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Global_config {
	private $CI;
	private $fb_config;
	
	function load_config() {
		$this->CI = &get_instance();
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->CI->load->library('zyk/OrderLib');
		$ordercount = $this->CI->orderlib->allOrders();
		$this->CI->template->set('ordercount', $ordercount);
		$remindorders = $this->CI->orderlib->getallReminderOrders();
		$this->CI->template->set('remindorders', $remindorders);
		if($this->CI->router->directory=="../modules/frontend/controllers/"){
	        $this->CI->template->set('global_url',site_url());
	        $this->CI->template->set('asset_url',asset_url());
			$this->CI->load->library('user_agent');
			$this->CI->template->set('olouserid',$this->CI->session->userdata('olouserid'));
			$this->CI->template->set('olousername',$this->CI->session->userdata('olousername'));
			$this->CI->template->set('olouseremail',$this->CI->session->userdata('olouseremail'));
			$this->CI->template->set('olousermobile',$this->CI->session->userdata('olousermobile'));
			$this->CI->template->set('google_map_key',$fb_config['google_api_key']);
			if ($this->CI->agent->is_mobile()) {
				$this->CI->template->set('mobile',1);
				$ua = $_SERVER['HTTP_USER_AGENT'];
				$checker = array(
						'iphone'=>preg_match('/iPhone|iPod|iPad/', $ua),
						'blackberry'=>preg_match('/BlackBerry/', $ua),
						'android'=>preg_match('/Android/', $ua),
				);
				if($checker['blackberry']) {
					$this->CI->template->set('device','BB');
				}
			}
			if ($this->CI->agent->browser() == 'Internet Explorer') {
				$this->CI->template->set('IE',$this->CI->agent->version());
			}else {
				$this->CI->template->set('IE',40);
			}
		}
		if($this->CI->router->directory=="../modules/backend/controllers/"){
			$this->CI->template->set('asset_url',asset_url());
			$this->CI->template->set('google_map_key',$fb_config['google_api_key']);
		}
	}
	
	function initilize_config() {
		$this->CI->template->set('base_url',base_url());
		$this->CI->load->library('session');
		$this->CI->load->helper('cookie');
	}
	
}
