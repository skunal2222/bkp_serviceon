<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Outlet extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		
	}
        public function sample() {
            
        } 
		
	/* ***********Outlet************ */ 

	public function OutletList() {
		$this->load->library('zyk/OutletLib', 'outletlib');
	 	$outlet = $this->outletlib->getListOutlets();  

	 	$this->template->set('outlet', $outlet);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | List Outlet' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('outlet/OutletList');
	}
	 	
	public function OutletAdd() {

        $this->load->library('zyk/ClientLib', 'clientlib');
		$clients = $this->clientlib->getClients();
		$this->load->library('zyk/AreaLib', 'arealib'); 
		$this->load->library('zyk/OutletLib', 'outletlib');  
		$cities = $this->arealib->getActiveCities(); 
		$this->template->set('cities',$cities);
		$this->template->set('clients',$clients);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Add Outlet' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('outlet/OutletAdd');
	} 
	public function add_outlet() { 
        
        $this->load->library('zyk/OutletLib', 'outletlib');
		$params = array();
        $params['client_id']   = $this->input->post('client_id'); 
		$params['outlet_name']   = ucfirst($this->input->post('outlet_name')); 
		$params['cityid'] = $this->input->post('city_id'); 
		$params['address'] = $this->input->post('address'); 
		$params['manager_name']  = $this->input->post('manager_name');
		$params['manager_email']  = $this->input->post('manager_email'); 
		$params['manager_mobile'] = $this->input->post('manager_mobile');
		$params['poc_name'] = $this->input->post('other_contact_person');  
		$params['created_datetime'] = date('Y-m-d H:i:s'); 
		$params['status'] = $this->input->post('status'); 
        $params['created_by'] = $this->session->adminsession['id']; 
		 
		$response = $this->outletlib->addOutlet($params);  
/*
		$data = array();
        $data['first_name'] = ucfirst($this->input->post('manager_name'));  
        $data['email'] = $this->input->post('manager_email');
        $data['password'] = MD5('dummy@123');
        $data['user_role'] = '2';
        $data['mobile'] = $this->input->post('manager_mobile');
        $data['text_password'] = 'dummy@123';
        $data['created_date'] = date('Y-m-d H:i:s'); 
        $data['first_login'] = '1';
        $data['status'] = '1';
        $data['created_by'] = $this->session->adminsession['id']; 

        $response = $this->outletlib->addOutletAsUser($data); 
        	        $this->sendNewUserEmail($data); 
*/
		echo json_encode($response);
	}
	public function sendNewUserEmail($data){
        $this->load->library ( 'Pkemail' );
        $this->pkemail->load_system_config ();
        $this->pkemail->headline = 'Bike Doctor ';
        $this->pkemail->subject = 'Welcome to Bike Doctor';
        $this->pkemail->mctag = 'newuser-msg';
        $this->pkemail->attachment = 0;
        $this->pkemail->to = $data ['email'];
        $this->template->set ( 'data', $data );
        $this->template->set ( 'page', 'newuser-message' );
        $this->template->set_layout ( false );
        $text_body = $this->template->build ( 'backend/emails/newuser-email', '', true );
        $this->pkemail->send_email ( $text_body );
    }
	 
	public function OutletEdit($id) {  

		$this->load->library('zyk/OutletLib', 'outletlib');
	 	$outlet = $this->outletlib->getOutletByID($id);

       	$this->load->library('zyk/AreaLib', 'arealib'); 
		$cities = $this->arealib->getActiveCities($outlet[0]['cityid']); 

		$this->load->library('zyk/ClientLib', 'clientlib');
		$client = $this->clientlib->getClients(); 
 
	 	$this->template->set('clients',$client); 
	 	$this->template->set('cities',$cities); 
	 	$this->template->set('outlet', $outlet); 
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Edit Outlet' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('outlet/OutletEdit');
	}
	
	public function update_outlet() {
		$this->load->library('zyk/OutletLib', 'outletlib');
		$params = array(); 

		$params['id'] = $this->input->post('id');      
		$params['client_id']   = $this->input->post('client_id'); 
		$params['outlet_name']   = ucfirst($this->input->post('outlet_name')); 
		$params['cityid'] = $this->input->post('city_id'); 
		$params['address'] = $this->input->post('address'); 
		$params['manager_name']  = $this->input->post('manager_name');
		$params['manager_email']  = $this->input->post('manager_email'); 
		$params['manager_mobile'] = $this->input->post('manager_mobile');
		$params['poc_name'] = $this->input->post('other_contact_person');  
		$params['status'] = $this->input->post('status'); 
        $params['created_by'] = $this->session->adminsession['id']; 
	 
		$params['updated_datetime'] = date('Y-m-d H:i:s');
		$params['status'] = $this->input->post('status');
			 

		$response = $this->outletlib->updateOutlet($params);
		echo json_encode($response);
	} 
	public function outletbyclientid() {
		$id = $this->input->post('client_id'); 
		$this->load->library('zyk/OutletLib', 'outletlib');
		$outlet = $this->outletlib->outletbyclientid($id);

		echo json_encode($outlet);
	}

	public function AddRatecard() { 
		$this->load->library('zyk/AreaLib', 'arealib');  ;  
		$cities = $this->arealib->getActiveCities(); 
		$this->template->set('cities',$cities); 
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Add Outlet' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('outlet/AddRatecard');
	} 

	public function add_ratecard() { 
                $this->load->library('zyk/OutletLib', 'outletlib');
				$params['city_id'] = $this->input->post('city_id');  
				$params['rate_card_name']   = ucfirst($this->input->post('rate_card_name'));  
				$params['created_datetime'] = date('Y-m-d H:i:s');
				$params['status'] = 1;   
                $id = $this->outletlib->add_rate_card($params);
                if($id == false) {
                  echo json_encode(array('status' => 0, 'msg' => 'Duplicate rate card name'));
                  exit;  
                }
                if (($handle = fopen($_FILES['services']['tmp_name'], "r")) !== FALSE) {
                    $a = 1;
                    $Inserdata = array();
                    $error = array();
                    $service_spare = array('service','spare');
                    while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) {

                        if($a != 1) {
                            if($data[0] == '') {
                                $error[] = 'Enter Type row no.'.$a;
                            }else if(!in_array (strtolower($data[0]), $service_spare)) {
                                $error[] = 'Enter Service or Spare at row no.'.$a;
                            } else if($data[1] == '') {
                                $error[] = 'Enter Name at row no.'.$a;
                            } else if(!is_numeric($data[2])) {
                                $error[] = 'Enter price at row no.'.$a;
                            } 
                            else if(!is_numeric($data[3])) {
                                $error[] = 'Enter special price at row no.'.$a;
                            } 
                            if(!empty($error)) {
                                $this->outletlib->delete_rate_card($id);
                                echo json_encode(array('status' => 0, 'msg' => implode(",", $error)));
                                exit;
                            }
                            $type = $data[0] == 'Service' ? 1 : 2;
                            $Inserdata[] = array(
                                'rate_card_id' => $id,
                                'type' => $type,
                                'service_name' => $data[1],
                                'price' => abs($data[2]),
                                'special_price' =>  abs($data[3])
                            );
                        }
                        $a++;
                    }
                    fclose($handle);
                    $res = $this->outletlib->add_rate_card_price($Inserdata);
                    if($res) {
                        echo json_encode(array('status' => 1, 'msg' => 'Rate card added successfully')); 
                    } else {
                         echo json_encode(array('status' => 0, 'msg' => 'error'));
                    }
                }
        }
        public function ratecard_list() {
            $this->load->library('zyk/OutletLib', 'outletlib');
            $this->template->set('cardlist', $this->outletlib->all_rate_list()); 
            $this->template->set_theme('default_theme');
            $this->template->set_layout('backend')
                            ->title('Administrator | Rate card list')
                            ->set_partial('header', 'partials/header')
                            ->set_partial('leftnav', 'partials/sidebar')
                            ->set_partial('footer', 'partials/footer')
                            ->build('outlet/ratecard_list');
        }
        public function ratecard_edit($id) {
            $this->load->library('zyk/OutletLib', 'outletlib');
            $this->load->library('zyk/AreaLib', 'arealib');    
            $this->template->set('ratecard', $this->outletlib->get_ratecard_details($id)); 
            $this->template->set('city', $this->arealib->getActiveCities());
            $this->template->set_theme('default_theme');
            $this->template->set_layout('backend')
                            ->title('Administrator | Rate card list')
                            ->set_partial('header', 'partials/header')
                            ->set_partial('leftnav', 'partials/sidebar')
                            ->set_partial('footer', 'partials/footer')
                            ->build('outlet/ratecard_edit');
        }
        public function ratecard_update() {
            $data = $this->input->post(NULL, TRUE);
            $this->load->library('zyk/OutletLib', 'outletlib');
            echo json_encode($this->outletlib->ratecard_update($data));
        }
        public function ratecard_assign() {
            $this->load->library('zyk/OutletLib', 'outletlib');
            $this->template->set('ratecard', $this->outletlib->ratecard_assign()); 
            $this->template->set_theme('default_theme');
            $this->template->set_layout('backend')
                            ->title('Administrator | Rate card')
                            ->set_partial('header', 'partials/header')
                            ->set_partial('leftnav', 'partials/sidebar')
                            ->set_partial('footer', 'partials/footer')
                            ->build('outlet/ratecard_assign');
        }
	public function ratecard_download(){

		$this->load->helper('download');
		$pth = file_get_contents(base_url()."assets/ratecard/add-rate-card.csv"); 
		$nme = "add-rate-card.csv";
		force_download($nme, $pth);
	}

	public function citybyclientid() {
		$client_id = $this->input->post('client_id'); 
		$this->load->library('zyk/OutletLib', 'outletlib');   
		$city = $this->outletlib->citybyclientid($client_id); 
		echo json_encode($city);
	}

	public function outletbycityid() {
		$city_id = $this->input->post('city_id'); 
		$client_id = $this->input->post('client_id'); 
		$this->load->library('zyk/OutletLib', 'outletlib');
		$outlets = $this->outletlib->outletbycityid($city_id,$client_id);  
		echo json_encode($outlets);
	}

	public function bikesbyoutletid() {
		$outlet_id = $this->input->post('outlet_id'); 
		$this->load->library('zyk/OutletLib', 'outletlib');
		$outlets = $this->outletlib->bikesbyoutletid($outlet_id);  
		echo json_encode($outlets);
	}
        public function get_rate_card_by_city() {
            $city_id = $this->input->post('city_id', FALSE);
            $this->load->library('zyk/OutletLib', 'outletlib');
            echo json_encode($this->outletlib->get_rate_card_by_city($city_id)); 
        }
        public function add_ratecard_assign() {
            $data = $this->input->post(NULL, FALSE);
            $this->load->library('zyk/OutletLib', 'outletlib');
            echo json_encode($this->outletlib->add_ratecard_assign($data)); 
        } 
}