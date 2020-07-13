<?php defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(0);
Class MyProfile extends MX_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}

	public function Basicinfo() {
		$uid = $this->session->userdata('olouserid') ;
		if($uid==''){
			redirect(base_url());
		}
		$this->load->library ( 'zyk/UserLoginLib' );
		$saved_address = $this->userloginlib->getUserAddressnk($uid);

		$this->template->set('saved_address',$saved_address);

		$userdata = $this->userloginlib->getProfile ($uid);
		$this->template->set ( 'data', $userdata[0] );

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$this->load->library('zyk/ServiceLib', 'servicelib');

		$vehicalList = $this->vehicallib->getVehicalList($uid);

  		$brands = $this->vehicallib->getActiveBikeBrands();
        $models = $this->servicelib->getActiveModels();


        $this->template->set('brands',$brands);
        $this->template->set('models',$models);
        $this->template->set('vehicalList',$vehicalList);

		$uid = $this->session->userdata('olouserid');
		$this->template->set ( 'page', 'my-profile/basic-info' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Bike Doctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/basic-info');

	}

	public function Docwallet() {
		$uid = $this->session->userdata('olouserid') ;
		if($uid==''){
			redirect(base_url());
		}


		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$this->load->library('zyk/UserLib', 'userlib');

		$vehicalList = $this->vehicallib->getVehicalList($uid);
		$userList = $this->userlib->getUser($uid);
		$documentList = $this->vehicallib->getVehicalDocumentList($uid);

  		$brands = $this->vehicallib->getActiveBikeBrands();
        $models = $this->servicelib->getActiveModels();


        $this->template->set('brands',$brands);
        $this->template->set('models',$models);
        $this->template->set('userList',$userList);
        $this->template->set('vehicalList',$vehicalList);
        $this->template->set('documentList',$documentList);

		$uid = $this->session->userdata('olouserid');
		$this->template->set ( 'page', 'my-profile/basic-info' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Bike Doctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/doc-wallet');

	}

	public function OtherDoc() {
		$uid = $this->session->userdata('olouserid') ;
		if($uid==''){
			redirect(base_url());
		}


		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$this->load->library('zyk/ServiceLib', 'servicelib');

		$vehicalList = $this->vehicallib->getVehicalList($uid);
  		$brands = $this->vehicallib->getActiveBikeBrands();
        $models = $this->servicelib->getActiveModels();
        $documentList = $this->vehicallib->getVehicalDocumentList($uid);



        $this->template->set('brands',$brands);
        $this->template->set('models',$models);
        $this->template->set('vehicalList',$vehicalList);
        $this->template->set('documentList',$documentList);

		$uid = $this->session->userdata('olouserid');
		$this->template->set ( 'page', 'my-profile/basic-info' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Bike Doctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/other-doc');

	}


	public function VehicleDoc() {
		$uid = $this->session->userdata('olouserid') ;
		if($uid==''){
			redirect(base_url());
		}

		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$this->load->library('zyk/ServiceLib', 'servicelib');
		$folder = $this->uri->segment(1);
  		$Id = $this->uri->segment(2);
		$vehicalList = $this->vehicallib->getVehiclesbyId($Id);
  		$brands = $this->vehicallib->getActiveBikeBrands();
        $models = $this->servicelib->getActiveModels();
        $documentList = $this->vehicallib->getVehicalAllDocumentList($Id,$uid);
     	$this->template->set('folder',$folder);
        $this->template->set('brands',$brands);
        $this->template->set('models',$models);
        $this->template->set('vehicalList',$vehicalList);
        $this->template->set('documentList',$documentList);

		$uid = $this->session->userdata('olouserid');
		$this->template->set ( 'page', 'my-profile/basic-info' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Bike Doctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/vehicle-doc');

	}



	public function user($userid){

		$this->load->library ( 'zyk/UserLoginLib' );
		$this->load->library('zyk/UserLib','userlib');
    	if(!empty($userid)){
			$refercode = $this->userloginlib->getReferCode($userid);
			if(!empty($refercode)){
				$this->template->set('refercode',$refercode[0]);
			}
		}

    // $point_conf=wallet_config();
    // $point_conf['my_referral'] = 50;
    // $point_conf['other_referral'] = 30;
     $logourl=asset_url().'images/logo-main.png';

		$this->template->set ( 'page', 'my-profile/refer-n-earn' );
		$this->template->set ('ogtitle', 'Bike doctor');
	    $this->template->set ( 'ogimage', " $logourl");
        $this->template->set ( 'ogdes',  'Get '.$point_conf['other_referral'].' points in your Bike doctor wallet by using my referral code '.$refercode[0]['my_ref_code'].'. You will love their services .' );
        $this->template->set ( 'description', 'Get '.$point_conf['other_referral'].' points on your first order use referral code '.$refercode[0]['my_ref_code'] );
		$this->template->set('point_array',$point_conf);

		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Bike doctor' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('my-profile/refer-n-earn');

	}

	public function refernearn(){
		$this->load->library ( 'zyk/UserLoginLib' );
		$userid = $this->session->userdata('olouserid');
		if(!empty($userid)){
			$refercode = $this->userloginlib->getReferCode($userid);
			if(!empty($refercode)){
				$this->template->set('refercode',$refercode[0]);
			}
			 $point_conf=wallet_config();

    		//$point_conf['my_referral'] = 50;
    		//$point_conf['other_referral'] = 30;

        $logourl=asset_url().'images/logo-main.png';
        $this->template->set ('ogtitle', 'BikeDoctor');
	    $this->template->set ( 'ogimage', " $logourl");
	    $this->template->set ( 'ogdes',  'Get '.$point_conf['other_referral'].' points in your BikeDoctor wallet by using my referral code '.$refercode[0]['my_ref_code'].'. You will love their services .' );
        $this->template->set ( 'description', 'Get '.$point_conf['other_referral'].' points on your first order use referral code '.$refercode[0]['my_ref_code'] );
		$this->template->set('point_array',$point_conf);
		$this->template->set('url',base_url());
	    $this->template->set ( 'page', 'my-profile/refer-n-earn' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'BikeDoctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/refer-n-earn');
		}else{
			redirect(base_url());
		}
	}

	public function wallet(){
		$this->load->library ( 'zyk/UserLoginLib' );
		$userid = $this->session->userdata('olouserid');
		if(!empty($userid)){
			$balance = $this->userloginlib->getWalletBalance($userid);

			$wallet_history =  $this->userloginlib->getWalletTransactions($userid);
			if(!empty($balance)){
				$balance = $balance;
			}else{
				$balance[0]['amount'] = 0;
			}
			if(!empty($wallet_history)){
				$wallet_history = $wallet_history;
			}else{
				$wallet_history = '';
			}
                        $this->load->library('MloyalLib', 'mloyallib');

                       $loyality_points = $this->mloyallib->get_customer_trans_info($_SESSION['olousermobile']);
                  $this->template->set ( 'loyality_points', $loyality_points);
		$this->template->set ( 'balance', $balance);
		$this->template->set ( 'wallet_history', $wallet_history);
	    $this->template->set ( 'page', 'my-profile/wallet' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Bike Doctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/wallet');
		}else{
			redirect(base_url ());
		}
	}

	// public function Notifications() {
	//     $this->template->set ( 'page', 'my-profile/notifications' );
	//     $this->template->set ( 'description', '' );
	//     $this->template->set ( 'keywords', '' );
	//     $this->template->set_theme('default_theme');
	//     //$this->template->set_layout (false);
	//     $this->template->set_layout ('default')
	//     ->title ( 'BikeDoctor' )
	//     //->meta ( 'doctors' )
	//     ->set_partial ( 'header', 'partials/header' )
	//     ->set_partial ( 'footer', 'partials/footer' );
	//     $this->template->build ('my-profile/notifications');

	// }

	function Notifications(){
		$this->load->library ( 'zyk/UserLib' );
		$userid = $this->session->userdata('olouserid');
		if(!empty($userid)){
			$this->load->library ( 'zyk/UserLoginLib' );
			$notifications = $this->userloginlib->getNotificationByuserId($userid);
			$notificationcount = $this->userloginlib->getNotificationCount($userid);
			$this->session->set_userdata('usernotification',$notificationcount);
			$this->template->set('notifications',$notifications);

	    $this->template->set ( 'page', 'my-profile/notifications' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'Bike Doctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/notifications');


		}else{
			redirect(base_url());
		}
	}






}