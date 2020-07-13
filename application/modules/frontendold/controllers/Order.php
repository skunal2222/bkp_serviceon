<?php defined('BASEPATH') OR exit('No direct script access allowed');
Class Order extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$this->load->library('zyk/SlotLib', 'slotlib');
		error_reporting(0);
	}
	
   public function TrackOrderOld() {
	
   	$id=$_SESSION['olouserid'];
   	$this->load->library ( 'zyk/UserLib' );
   	if(!empty($id)){
		   	$order = $this->userlib->getlastOrder($id);
		   	$logs= $this->userlib->getlastOrderComment($order[0]['orderid']);
		   	$bill = $this->userlib->getBill($id);  
		   	$this->template->set('order',$order);
		   	$this->template->set('logs',$logs);
		   	$this->template->set('bill',$bill);
		   	    $this->template->set ( 'description', '' );
		    	//$this->template->set ( 'page', 'home' );
		   	    $this->template->set_theme('default_theme');
				$this->template->set_layout ('default')
					->title ( 'Garage2Ghar' )
				->set_partial ( 'header', 'partials/header' )
				->set_partial ( 'footer', 'partials/footer' );
				$this->template->build ('Order/trackorderold');
		}else{
			redirect(base_url ());
		}
	}
	
	public function TrackOrder() {
	
		$id=$_SESSION['olouserid'];
		$this->load->library ( 'zyk/UserLib' );
		if(!empty($id)){
			$orders = $this->userlib->getOngoingOrders($id);
			//$order = $this->userlib->getlastOrder($id);
			//$logs= $this->userlib->getlastOrderComment($order[0]['orderid']);
			//$bill = $this->userlib->getBill($id);
			$this->template->set('orders',$orders);
			//$this->template->set('logs',$logs);
			//$this->template->set('bill',$bill);
			$this->template->set ( 'description', '' );
			//$this->template->set ( 'page', 'home' );
			$this->template->set_theme('default_theme');
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/trackorder');
		}else{
			redirect(base_url ());
		}
	}

	public function Notification() {
		//$this->template->set ( 'page', 'home' );
		//$this->template->set_theme('default_theme');
		$uid = $_SESSION ['olouserid'];
		if(!empty($uid)){
			$this->load->library ( 'zyk/UserLib' );
			$detail = $this->userlib->getNotification($uid);
			$this->template->set('detail',$detail);
			$this->template->set ( 'description', '' );
			$this->template->set_layout (false);
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/notification');
		}else{
			redirect(base_url ());
		}
	}
	
	public function History() {				
		$id=$_SESSION['olouserid'];
		if(!empty($id)){
			$this->load->library ( 'zyk/UserLib' );				
			$order = $this->userlib->getOrder($id);				
			$this->template->set('orders',$order);
			$this->template->set ( 'description', '' );
			$this->template->set_layout (false);
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/history');
		}else{
			redirect(base_url ());
		}
	}
	
	public function Wallet() {
	    $userid = $_SESSION['olouserid'];
	    $this->load->library ( 'zyk/UserLib' );
	    if(!empty($userid)){
		    $balance = $this->userlib->getWalletBalance($userid);
		    $wallet_history =  $this->userlib->getWalletTransactions($userid);
		    	if(!empty($balance)){
		    		$balance = $balance;
		    	}else{
		    		$balance[0]['amount'] = 0;
		    	}
		    	/* if(!empty($wallet_history)){
		    		$wallet_history = $wallet_history;
		    	}else{
		    		$wallet_history = '';
		    	} */
		    $this->template->set('balance',$balance);
		    $this->template->set('wallet_history',$wallet_history);
		    $this->template->set ( 'description', '' );
		    $this->template->set_layout (false);
		    $this->template->set_layout ('default')
		    ->title ( 'Garage2Ghar' )
		    ->set_partial ( 'header', 'partials/header' )
		    ->set_partial ( 'footer', 'partials/footer' );
		    $this->template->build ('Order/wallets');
	    }else{
	    	redirect(base_url ());
	    }
	}
	
	public function Setting() {
		$id=$_SESSION['olouserid'];
		if(!empty($id)){
			//$this->template->set ( 'page', 'home' );
			//$this->template->set_theme('default_theme');
			$this->load->library ( 'zyk/UserLib' );
			$user = $this->userlib->getUser($id);
			$user1 = $this->userlib->getUser1($id);
			$this->template->set('user',$user);
			$this->template->set('user1',$user1);
			$this->template->set ( 'description', '' );
			$this->template->set_layout (false);
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/settings');
		}else{
			redirect(base_url ());
		}
	}
	
	public function Offer() {
 		$id=$_SESSION['olouserid'];
 		if(!empty($id)){
	 		$this->load->library ( 'zyk/UserLib' );
	//		$this->load->library ( 'zyk/UserLoginLib' );
			$refcode = $this->userlib->getReferCode($id);
	 		$this->template->set('refcode',$refcode);
			$this->template->set ( 'description', '' );
			$this->template->set_theme('default_theme');
			$this->template->set_layout ('default')
			->title ( 'Garage2Ghar' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('Order/offer');
		}else{
			redirect(base_url ());
		}
	}
	
	public function Userupdate()
	{
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('fname').' '. $this->input->post('lname');
		$params['email'] = $this->input->post('email');
		$params['mobile'] = $this->input->post('mobile');
		$params['original'] = $this->input->post('password');
		$params['password'] = md5($this->input->post('password'));
		//$params['address'] = $this->input->post('address');
		$params['model'] = $this->input->post('model');
		$params['vehicle_no'] = $this->input->post('vehicleno');
		
		$params1 = array();
		$params1['id'] = $this->input->post('id');
		$params1['model'] = $this->input->post('model1');
		$params1['vehicle_no'] = $this->input->post('vehicleno1');
		$this->load->library ( 'zyk/UserLib' );
		$register = $this->userlib->updateUser1( $params );
		$register1 = $this->userlib->updateUser2( $params1 );
		$response['status'] = 1;
		$response['msg'] = "User updated successfully.";
		echo json_encode($response);
	}
}