<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Setting extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/ServiceLib');
		$this->load->library('zyk/General');
		$this->load->library('zyk/EmployeeLib', 'employeelib');
		
	}
	
	public function mainTicket() {
		$categories = $this->servicelib->getActiveCategoriesbook();
		$subcategories = $this->servicelib->getActiveSubCategories1();
		$status = $this->general->getActiveStatus1();
		$this->template->set('status',$status);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
	   $this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Settings' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/mainticket');
	}
	
	public function newCategory() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('general/AddCategory');
	}
	
	public function addCategory() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = $this->input->post('status');
		$params['created_datetime'] = date('Y-m-d H:i:s');
		
		$response = $this->general->addCategory($params);
		echo json_encode($response);
	}
	
	
	public function updateCategory() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$params['status'] = $this->input->post('status');
		$params['updated_datetime'] = date('Y-m-d H:i:s');
		
		$response = $this->general->updateCategory($params);
		echo json_encode($response);
	}
	
	public function editCategory() {
		$id=$this->input->post('id');
		$categories = $this->servicelib->getCategoryById($id);
		$this->template->set('categories',$categories);
		//	print_r($categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('general/EditCategory');
	}
	
	public function newSubCategory() {
		$categories = $this->servicelib->getActiveCategoriesbook();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('general/AddSubCategory');
	}
	
	public function addSubCategory() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['category_id'] = $this->input->post('category_id');
		$params['status'] = $this->input->post('status');
		$params['created_datetime'] = date('Y-m-d H:i:s');
	
		$response = $this->general->addSubCategory($params);
		echo json_encode($response);
	}
	
	
	public function updateSubCategory() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$params['category_id'] = $this->input->post('category_id');
		$params['status'] = $this->input->post('status');
		$params['updated_datetime'] = date('Y-m-d H:i:s');
	
		$response = $this->general->updateSubCategory($params);
		echo json_encode($response);
	}
	
	public function editSubCategory() {
		$id=$this->input->post('id');
		$categories = $this->servicelib->getActiveCategoriesbook();
		$subcategories = $this->servicelib->getSubCategoryById($id);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		//	print_r($categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('general/EditSubCategory');
	}
	
	public function newStatus() {
		
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('general/AddStatus');
	}
	
	public function addStatus() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['created_datetime'] = date('Y-m-d H:i:s');
	
		$response = $this->general->addStatus($params);
		echo json_encode($response);
	}
	
	
	public function updateStatus() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$params['updated_datetime'] = date('Y-m-d H:i:s');
	
		$response = $this->general->updateStatus($params);
		echo json_encode($response);
	}
	
	public function editStatus() {
		$id=$this->input->post('id');
		$status = $this->general->getActiveStatus1();
		$this->template->set('status',$status);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		// echo $this->template->build ('partials/service/AddCategory');
		$this->template->build ('general/EditStatus');
	}
	
	
	public function getCityList() {
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CityList');
	}
	
	public function newCity() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CityAdd');
	}
	
	public function addCity() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$this->load->library('zyk/General');
		$response = $this->general->addCity($params);
		echo json_encode($response);
	}
	
	public function editCity($id) {
		$this->load->library('zyk/General');
		$cities = $this->general->getCityById($id);
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CityEdit');
	}
	
	public function updateCity() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$this->load->library('zyk/General');
		$response = $this->general->updateCity($params);
		echo json_encode($response);
	}
	
	public function turnOnCity($id) {
		$this->load->library('zyk/General');
		$response = $this->general->turnOnCity($id);
		redirect(base_url().'admin/general/citylist');
	}
	
	public function turnOffCity($id) {
		$this->load->library('zyk/General');
		$response = $this->general->turnOffCity($id);
		redirect(base_url().'admin/general/citylist');
	}
	
	public function getCities() {
		$this->load->library('zyk/General');
		$response = $this->general->getCities();
		echo json_encode($response);
	}
	
	public function getLocalityList($cityid=0) {
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$localities = array();
		if($cityid > 0)
		$localities = $this->general->getAreasByCityId($cityid);
		$this->template->set('cities',$cities);
		$this->template->set('localities',$localities);
		$this->template->set('cityid',$cityid);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/LocalityList');
	}
	
	public function newLocality() {
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$this->template->set('cities',$cities);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Locality' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/LocalityAdd');
	}
	
	public function addLocality() {
		$params = array();
		$params['cityid'] = $this->input->post('cityid');
		$params['name'] = $this->input->post('name');
		$params['latitude'] = $this->input->post('latitude');
		$params['longitude'] = $this->input->post('longitude');
		$params['status'] = 1;
		$this->load->library('zyk/General');
		$response = $this->general->addArea($params);
		echo json_encode($response);
	}
	
	public function editLocality($id) {
		$this->load->library('zyk/General');
		$cities = $this->general->getCities();
		$locality = $this->general->getAreasById($id);
		$this->template->set('cities',$cities);
		$this->template->set('locality',$locality);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Locality' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/LocalityEdit');
	}
	
	public function updateLocality() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['cityid'] = $this->input->post('cityid');
		$params['name'] = $this->input->post('name');
		$params['latitude'] = $this->input->post('latitude');
		$params['longitude'] = $this->input->post('longitude');
		$this->load->library('zyk/General');
		$response = $this->general->updateArea($params);
		echo json_encode($response);
	}
	
	public function turnOnLocality($id) {
		$this->load->library('zyk/General');
		$this->general->turnOnArea($id);
		$response = $this->general->getAreasById($id);
		redirect(base_url().'admin/general/localitylist/'.$response[0]['cityid']);
	}
	
	public function turnOffLocality($id) {
		$this->load->library('zyk/General');
		$this->general->turnOffArea($id);
		$response = $this->general->getAreasById($id);
		redirect(base_url().'admin/general/localitylist/'.$response[0]['cityid']);
	}
	
	public function getLocality() {
		$cityid = $this->input->get('cityid');
		$this->load->library('zyk/General');
		$areas = $this->general->getAreasByCityId($cityid);
		echo json_encode($areas);
	}
	
	public function getCuisineList() {
		$this->load->library('zyk/General');
		$cuisines = $this->general->getCuisines();
		$this->template->set('cuisines',$cuisines);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cuisines' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CuisineList');
	}
	
	public function newCuisine() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CuisineAdd');
	}
	
	public function addCuisine() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$this->load->library('zyk/General');
		$response = $this->general->addCuisine($params);
		echo json_encode($response);
	}
	
	public function editCuisine($id) {
		$this->load->library('zyk/General');
		$cuisine = $this->general->getCuisineById($id);
		$this->template->set('cuisine',$cuisine);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cities' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'general/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/CuisineEdit');
	}
	
	public function updateCuisine() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$this->load->library('zyk/General');
		$response = $this->general->updateCuisine($params);
		echo json_encode($response);
	}
	
	public function deleteCuisine($id) {
		$this->load->library('zyk/General');
		$this->general->deleteCuisine($id);
		$map['status'] = 1;
		$map['msg'] = 'Cuisine deleted successfully.';
		echo json_encode($map);
	}
       public function getRestro() {          
		$cityid = $this->input->get('cityid');
                $vendorid = $this->input->get('vendorid');
		$this->load->library('zyk/General');
		$areaid  = "";
                $areaid1 = "";
                $cityid1 = "";
                $vendorResto = $this->general->getRestaurantsByVendor($vendorid);
                //print_r($vendorResto);
                $areacity = $this->general->getAreaidandCityidByRestaurant($vendorResto);
               // print_r($areacity);
                $arrRest =array();
                $i =0;
                foreach($areacity as $key =>$value)
                {
                $cityid1=$value['cityid'];
                $areaid1=$value['areaid'];
                } 
                if($areaid=="")$areaid = $areaid1;
                $restaurants = $this->general->getRestByAreaId($areaid);    
                foreach($restaurants as $key =>$value){
                    $arrRest[$i]['restid'] = $value['id'] ;
                    $arrRest[$i]['restname'] = $value['name'] ;
                    $arrRest[$i]['reststatus'] = 0;
                    $i++;                    
                }
             
                $arrVendorRest =explode(',',$vendorResto[0]['restid']);               
                $i =0;
                foreach($arrRest as $key =>$value){
                    if(in_array($value['restid'],$arrVendorRest)){   
                          $arrRest[$i]['reststatus'] =1;
                    }
                     $i++;
                }  
               //print_r($arrRest);
                $arrData['cityid']=$cityid1;
                $arrData['areaid'] =$areaid1;
                $arrfinal = array_merge($arrRest,$arrData);
            
		echo json_encode($arrfinal);
	}
        
        
  	public function getRestaurantByArea() {          
		$areaid = $this->input->get('areaid');               
		$this->load->library('zyk/General');
       	$restaurants = $this->general->getRestByAreaId($areaid); 
        $i = 0;
        $arrRest =array();
        foreach($restaurants as $key =>$value){                    
         	$arrRest[$i]['restid'] = $value['id'] ;
            $arrRest[$i]['restname'] = $value['name'] ; 
            $arrRest[$i]['areaname'] = $value['areaname'] ;
            $i++;                    
       	}
		echo json_encode($arrRest);
	}	
	
	public function getReasonList() {
		$this->load->library('zyk/General');
		$cuisines = $this->general->getActiveReasons();
		$this->template->set('cuisines',$cuisines);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Reasons' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/ReasonList');
	}
	
	public function newReason() {
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Reason' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/ReasonAdd');
	}
	
	public function addReason() {
		$params = array();
		$params['name'] = $this->input->post('name');
		$params['status'] = 1;
		$this->load->library('zyk/General');
		$response = $this->general->addReason($params);
		echo json_encode($response);
	}
	
	public function editReason($id) {
		$this->load->library('zyk/General');
		$cuisine = $this->general->getReasonById($id);
		$this->template->set('cuisine',$cuisine);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Reason' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/ReasonEdit');
	}
	
	public function updateReason() {
		$params = array();
		$params['id'] = $this->input->post('id');
		$params['name'] = $this->input->post('name');
		$this->load->library('zyk/General');
		$response = $this->general->updateReason($params);
		echo json_encode($response);
	}
	
	public function deleteReason($id) {
		$this->load->library('zyk/General');
		$this->general->deleteReason($id);
		$map['status'] = 1;
		$map['msg'] = 'Reason deleted successfully.';
		echo json_encode($map);
	}
	
	public function getZones() {
		$cityid = $this->input->get('cityid');
		$this->load->library('zyk/General');
		$zones = $this->general->getZoneByCityId($cityid);
		echo json_encode($zones);
	}
	
	public function getZoneLocality() {
		$zone_id = $this->input->get('zone_id');
		$this->load->library('zyk/General');
		$areas = $this->general->getAreasByZoneId($zone_id);
		echo json_encode($areas);
	}
	
	//................ Added by Tushar Ticket Model..........................
	
	public function viewLead($id){
	    $tickets = $this->general->getTicketById($id);
	    $tickets1 = $this->general->getAllActiveTickets();
    	$categories = $this->servicelib->getActiveCategoriesbook();
		$subcategories = $this->servicelib->getActiveSubCategories1();
		$status = $this->general->getActiveStatus1();
		$Emps = $this->employeelib->getActiveEmp1();
		$comments = $this->general->getUserComment($id);
		$this->template->set('comments',$comments);
		$this->template->set('status',$status);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('ticket',$tickets[0]);
		$this->template->set('tickets1',$tickets1);
		$this->template->set('Emps',$Emps);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Ticket' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/view-lead');
	}
	
	public function tickets() {
		$this->load->library('zyk/General');
		$tickets = $this->general->getAllActiveTickets();
		$this->template->set('tickets',$tickets);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Ticket' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/TicketList');
	}
	
	public function newTicket() {
		$this->load->library('zyk/Adminauth');
		$acps = $this->adminauth->getAdminUsers();
			$categories = $this->servicelib->getActiveCategoriesbook();
		$subcategories = $this->servicelib->getActiveSubCategories1();
		$status = $this->general->getActiveStatus1();
		$Emps = $this->employeelib->getActiveEmp1();
		$this->template->set('status',$status);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('acps',$acps);
		$this->template->set('Emps',$Emps);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
					   ->title ( 'Administrator | Ticket' )
					   ->set_partial ( 'header', 'partials/header' )
					   ->set_partial ( 'leftnav', 'partials/sidebar' )
					   ->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/TicketAdd');
	}
	
	public function addTicket() {
		$response = array();
		$params = $this->input->post('ticket');
		$this->load->library('zyk/General');
		$ticket = array();
		$ticket['priority'] = $params['priority'];
		$ticket['userid'] = $params['userid'];
		$ticket['orderid'] = $params['orderid'];
		$ticket['subject'] = $params['subject'];
		$ticket['description'] = $params['description'];
		$ticket['category_id'] = $params['category_id'];
		$ticket['subcategory_id'] = $params['subcategory_id'];
		//$ticket['type'] = $params['type'];
		//$ticket['quantity'] = $params['quantity'];
		$ticket['assigned_to'] = $params['assigned_to'];
		$ticket['status_id'] = $params['status'];
		$ticket['created_date'] = date('Y-m-d H:i:s');
		$ticket['updated_date'] = date('Y-m-d H:i:s');
		$ticket['created_by'] = $this->session->userdata('adminsession')['id'];
		$id = $this->general->addTicket($ticket);
		$data=array();
		$data['ticketid'] = $id;
		$data['comment'] = $ticket['description'];
		$this->general->addComment($data);
		if(!empty($id)) { 
			$ticket_no = 'TT'.$id;
			$tp = array();
			$tp['ticketid'] = $id;
			$tp['ticket_no'] = $ticket_no;
			$this->general->updateTicket($tp);
			$tsms = array();
			$tsms['name'] = $params['name'];
			$tsms['mobile'] = $params['mobile'];
			$temail['mobile'] = $params['email'];
			//$this->general->sendTicketSMS($tsms);
			//$this->general->sendTicketSMS($tsms);
			$response['status'] = 1;
			$response['msg'] = 'Ticket added successfully.';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to add Ticket';
		}
		echo json_encode($response);
	}
	
	public function comment(){
		$ticketid = $this->input->post('ticketid');
		$comment = $this->input->post('comment');
		$data = array();
		$data = array(
				'comment' => $comment,
				'ticketid' => $ticketid,
			//	'created_by' => $admin_id,
				'status' => 1,
		);
		$this->load->library('zyk/General');
		$result = $this->general->addComment($data);
		//print_r($result);
		if($result['status']==1){
			$comments = $this->general->getUserComment($ticketid);
			$this->template->set('comments',$comments);
			$this->template->set_theme('default_theme');
			$this->template->set_layout (false);
			$html= $this->template->build ('general/pages/comment', '', true);
			echo $html;
		}
		//echo json_encode($result);
	}
	
	public function leadHistory($ticketid){
		$this->load->library('zyk/Lead', 'lead');
		$leadHistory = $this->lead->leadHistory($ticketid);
		$this->template->set('leadHistory',$leadHistory);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		$html= $this->template->build ('lead/pages/leadHistory', '', true);
		echo $html;
	}
	public function priorityHistory($ticketid){
		$this->load->library('zyk/Lead', 'lead');
		$leadHistory = $this->lead->leadHistory($ticketid);
		$this->template->set('leadHistory',$leadHistory);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		$html= $this->template->build ('lead/pages/priority-history', '', true);
		echo $html;
	}
	public function statusHistory($ticketid){
		$this->load->library('zyk/Lead', 'lead');
		$leadHistory = $this->lead->leadHistory($ticketid);
		$this->template->set('leadHistory',$leadHistory);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		$html= $this->template->build ('lead/pages/status-history', '', true);
		echo $html;
	}
	
	public function assignLead(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$assigned_to = $this->input->post('user');
		$ticketid = $this->input->post('id');
		$data = array(
				'ticketid' => $lead_id,
				'assigned_to' => $user,
			//	'updated_by' => $admin_id,
	
		);
	/*	$lstatus = array(
				'lead_id' => $lead_id,
				'type' => 3,
				'changed_id' => $user,
			//	'created_by' => $admin_id,
				'comment'=>'Executive assigned'
		);*/
	//	$leadStatus = $this->lead->changeLeadStatus($lstatus);
		$response = $this->general->updateLead($data);
		if($response['status']==1){
			//$this->lead->sendLeadAssignEmail($data);
		}
		echo json_encode($response);
	}
	public function changeStatusLead(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$status = $this->input->post('status');
		$lead_id = $this->input->post('id');
		$data = array(
				'id' => $lead_id,
				'lead_status_id' => $status,
				'updated_by' => $admin_id,
	
		);
		$lstatus = array(
				'lead_id' => $lead_id,
				'type' => 2,
				'changed_id' => $status,
				'created_by' => $admin_id,
				'comment'=>'Status changed'
		);
		$this->load->library('zyk/Lead', 'lead');
		$leadStatus = $this->lead->changeLeadStatus($lstatus);
		$response = $this->lead->updateLead($data);
		echo json_encode($response);
	}
	public function changePriority(){
		$admin_id = $this->session->userdata['adminsession']['id'];
		$priority= $this->input->post('priority');
		$lead_id = $this->input->post('id');
		$data = array(
				'id' => $lead_id,
				'priority' => $priority,
				'updated_by' => $admin_id,
	
		);
		$lstatus = array(
				'lead_id' => $lead_id,
				'type' => 1,
				'changed_id' => $priority,
				'created_by' => $admin_id,
				'comment'=>'Priority changed'
		);
		$this->load->library('zyk/Lead', 'lead');
		$leadStatus = $this->lead->changeLeadStatus($lstatus);
		$response = $this->lead->updateLead($data);
		echo json_encode($response);
	}
	
	public function editTicket($ticketid) {
		$this->load->library('zyk/Adminauth');
		$this->load->library('zyk/General');
		$acps = $this->adminauth->getAdminUsers();
		$tickets = $this->general->getTicketById($ticketid);
			$categories = $this->servicelib->getActiveCategoriesbook();
		$subcategories = $this->servicelib->getActiveSubCategories1();
		$status = $this->general->getActiveStatus();
		$this->template->set('status',$status);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('acps',$acps);
		$this->template->set('ticket',$tickets[0]);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
					->title ( 'Administrator | Ticket' )
					->set_partial ( 'header', 'partials/header' )
					->set_partial ( 'leftnav', 'partials/sidebar' )
					->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/TicketEdit');
	}
	
	public function updateTicket() {
		$response = array();
		$params = $this->input->post('ticket');
		$this->load->library('zyk/General');
		$ticket = array();
		$ticket['ticketid'] = $params['ticketid'];
		$ticket['priority'] = $params['priority'];
		$ticket['userid'] = $params['userid'];
		$ticket['orderid'] = $params['orderid'];
		$ticket['subject'] = $params['subject'];
		$ticket['description'] = $params['description'];
		$ticket['category_id'] = $params['category_id'];
		$ticket['subcategory_id'] = $params['subcategory_id'];
		//$ticket['type'] = $params['type'];
		//$ticket['quantity'] = $params['quantity'];
		$ticket['assigned_to'] = $params['assigned_to'];
		$ticket['status_id'] = $params['status'];
		//$ticket['resolution'] = $params['resolution'];
		$ticket['updated_date'] = date('Y-m-d H:i:s');
		$flag = $this->general->updateTicket($ticket);
		//if($flag) {
			$response['status'] = 1;
			$response['msg'] = 'Ticket updated successfully.';
		/*} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to update Ticket';
		}*/
		echo json_encode($response);
	}
	
	public function getUserByEmail() {
		$email = $this->input->get('email');
		$this->load->library('zyk/UserLib');
		$user = $this->userlib->getProfileByEmail($email);
		echo json_encode($user);
	}
	
	public function getUserByMobile() {
		$mobile = $this->input->get('mobile');
		$this->load->library('zyk/UserLib');
		$user = $this->userlib->getProfileByMobile($mobile);
		echo json_encode($user);
	}
	
	public function getUserByName() {
		$name = $this->input->get('name');
		$this->load->library('zyk/UserLib');
		$user = $this->userlib->getProfileByName($name);
		echo json_encode($user);
	}
	
	public function userDetail($id) {
		$this->load->library('zyk/UserLib');
		$this->load->library('zyk/VehicalLib', 'vehicallib');
		$user = $this->userlib->getProfile($id);
		$user[0]['vlist'] = $this->vehicallib->getVehicalList($id);
		echo json_encode($user[0]);
	}
	
	public function detail() {
		$userid = $this->input->post('userid');
		$this->load->library('zyk/UserLib');
		$emaildet = $this->userlib->getOrder($userid);
		echo json_encode($emaildet);
	}
	
	public function subcbycatid() {
		$id = $this->input->post('cat_id');
		$this->load->library('zyk/General');
		$subcat = $this->general->getSubCatId($id);
		echo json_encode($subcat);
	}
	public function redeemsetting() {
		$this->load->library('zyk/General');
		$offerconfig = $this->general->getredeemconfig();

		$this->template->set('offerconfig',$offerconfig);
	   	$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Reedom Settings' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('general/offerpoint');
	}
	public function redeemsave(){
		
		$this->load->model('general/settings_model','setting');


		$result = $this->setting->updatepoint($_POST);
		if($result){
			$response['status']=$result;
			$response['msg']='Data updated succesfully';
		}
		else{
			$response['status']=$result;
			$response['msg']='Data not updated';
		}
		echo json_encode($response);
	
	}
	public function subscriptionList() {

		$this->load->model('general/settings_model','setting');

		$users = $this->setting->getsubscriptionList();
		$this->template->set('users',$users);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Customer' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('customer/SubscriptionList');
	} 
        public function save_brand_csv() {
            $file = fopen('assets/brand.csv','r');
            $a = 1;
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) { 


                    $Insertdata[] = array(
                            'name'=>$getData[0],
                            'category_id'=> 9, 
                            'image' => '',
                            'created_datetime' => date('Y-m-d h:i:s') ,
                            'status'=>'1'
                    );  


                    $a++;
            }

		echo "<pre>";
		print_r($Insertdata); 
                exit;
		$this->db->insert_batch('brand',$Insertdata);
        }
        public function save_model_csv() {
            $file = fopen('assets/model.csv','r');
            $a = 1;
            $this->db->select('*')->from('brand');
            $query = $this->db->get();
            $brand = $query->result_array();

 
	$arr_brand = array();
	foreach ($brand as $key => $value) { 
		$arr_brand[$value['name']] = $value['id'];
	}  
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) { 


                    $Insertdata[] = array(
                            'name'=> $getData[1],
                            'brand_id' => $arr_brand[$getData[0]],
                            'category_id'=> 9, 
                            'sort_order'=> 0, 
                            'image' => '',
                            'created_datetime' => date('Y-m-d h:i:s') ,
                            'status'=>'1'
                    );  


                    $a++;
            }

//		echo "<pre>";
//		print_r($Insertdata); 
//                exit;
		//$this->db->insert_batch('manufacturer',$Insertdata);
        }
        function save_service_type_csv() {
            $file = fopen('assets/model.csv','r');
            $a = 1;
            $this->db->select('*')->from('brand');
            $query = $this->db->get();
            $brand = $query->result_array();

 
	$arr_brand = array();
	foreach ($brand as $key => $value) { 
		$arr_brand[$value['name']] = $value['id'];
	} 
        
        $this->db->select('*')->from('manufacturer');
        $query = $this->db->get();
        $model = $query->result_array();
        $arr_model = array();
	foreach ($model as $key => $value) { 
		$arr_model[$value['name']] = $value['id'];
	}

        
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) { 


                    $Insertdata[] = array(
                            'name'=> 'Breakdown',
                            'sub_id' => 11,
                            'brand_id' => $arr_brand[$getData[0]],
                            'model_id' => $arr_model[$getData[1]], 
                            'image' => '',
                            'category_id'=> 9, 
                            'image' => '',
                            'created_datetime' => date('Y-m-d h:i:s') ,
                            'status'=>'1'
                    );  
                    $Insertdata[] = array(
                            'name'=> "Pick n' Drop",
                            'sub_id' => 12,
                            'brand_id' => $arr_brand[$getData[0]],
                            'model_id' => $arr_model[$getData[1]], 
                            'image' => '',
                            'category_id'=> 9, 
                            'image' => '',
                            'created_datetime' => date('Y-m-d h:i:s') ,
                            'status'=>'1'
                    );
                    $Insertdata[] = array(
                            'name'=> 'Doorstep',
                            'sub_id' => 13,
                            'brand_id' => $arr_brand[$getData[0]],
                            'model_id' => $arr_model[$getData[1]], 
                            'image' => '',
                            'category_id'=> 9, 
                            'image' => '',
                            'created_datetime' => date('Y-m-d h:i:s') ,
                            'status'=>'1'
                    );


                    $a++;
            }

		echo "<pre>";
		print_r($Insertdata); 
                exit;
		$this->db->insert_batch('subcategory',$Insertdata);
        }
        function save_service_group() {
            $file = fopen('assets/service_group.csv','r');
            $a = 1;
            $this->db->select('*')->from('subcategory');
            $query = $this->db->get();
            $subcategory = $query->result_array();
            while (($getData = fgetcsv($file, 1000000, ",")) !== FALSE) { 


                    $s_g[] = $getData[0];
                            
                   
            }
            foreach ($subcategory as $key => $value) { 
                foreach ($s_g as $val) {
                $Insertdata[] = array(
                            'name'=> $val,
                            'subcategory_id ' => $value['id'],
                            'brand_id' => $value['brand_id'],
                            'model_id' => $value['model_id'], 
                            'service_icon' => '',
                            'category_id'=> 9, 
                            'created_datetime' => date('Y-m-d h:i:s') ,
                            'status'=>'1'
                    );  
            }
            
                    
                }
            echo "<pre>";
            print_r(count($Insertdata));
            exit;
            $this->db->insert_batch('category_subcat', $Insertdata);
            exit;
        }
        function save_services() {
            ini_set('memory_limit', '81920M'); 
            $file = fopen('assets/services.csv','r');
            $a = 1;
            $this->db->select('*')->from('category_subcat')->where('name', 'Oils');
            $query = $this->db->get();
            $category_subcat = $query->result_array();
            $servies = array();
            while (($getData = fgetcsv($file, 1000000, ",")) !== FALSE) { 
                $servies[$getData[0]] = array();
                    for($a = 1; $a <= 38; $a++) {
                        if($getData[$a] !='') {
                           $servies[$getData[0]][] =  $getData[$a];
                        }
                    }
            }
            $Insertdata = array();
            foreach ($category_subcat as $key => $value) {
                foreach ($servies as $key1 => $val) {
                    if($key1 == 'Oils') {
                        for($a = 0; $a <= 38; $a++) {
                            if(isset($val[$a])) {
                                $Insertdata[] = array(
                                    'name'=> $val[$a],
                                    'subcategory_id ' => $value['subcategory_id'],
                                    'brand_id' => $value['brand_id'],
                                    'model_id' => $value['model_id'], 
                                    'catsubcat_id' => $value['id'],
                                    'service_icon' => '',
                                    'category_id'=> 9, 
                                    'price' => 0,
                                    'tax' => 0,
                                    'created_datetime' => date('Y-m-d h:i:s') ,
                                    'status'=>'1'
                                );  
                              
                            }
                        }
                    }
                }  
            }
            
            echo "<pre>";
            print_r(count($Insertdata));
            exit;
            $this->db->insert_batch('service', $Insertdata);
            exit;
        }
        
        
        
        function save_spare() {
            $file = fopen('assets/spare.csv','r');
            $a = 1;
            $this->db->select('*')->from('subcategory');
            $query = $this->db->get();
            $subcategory = $query->result_array();
            
            while (($getData = fgetcsv($file, 1000000, ",")) !== FALSE) { 


                    $spare[] = $getData[0];
                            
                   
            }
            
        foreach ($subcategory as $key => $value) { 
            if($value['id'] > 600) {
           foreach($spare as $val) {


                    $Insertdata[] = array(
                            'name'=> $val,
                            'subcategory_id ' => $value['id'],
                            'brand_id' => $value['brand_id'],
                            'model_id' => $value['model_id'], 
                            'service_icon' => '',
                            'category_id'=> 9, 
                            'price' => 0,
                            'tax' => 0,
                            'created_datetime' => date('Y-m-d h:i:s') ,
                            'status'=>'1'
                    );  
                   
            }
            }
        }

		echo "<pre>";
		print_r(count($Insertdata)); 
                exit;
		$this->db->insert_batch('spare',$Insertdata);
        }

        public function riderleads()
	    {
	    	$riders = $this->db->get('ride_with_us')->result_array();
			$this->template->set('riders',$riders);
			$this->template->set_theme('default_theme');
			$this->template->set_layout ('backend')
			->title ( 'Administrator | Rider Leads' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'leftnav', 'partials/sidebar' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('leads/riderleads');
	    	
	    }

	    public function partnerleads()
	    {
	    	$partners = $this->db->get('partner_with_us')->result_array();
	    	$this->template->set('partners',$partners);
			$this->template->set_theme('default_theme');
			$this->template->set_layout ('backend')
			->title ( 'Administrator | Partner Leads' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'leftnav', 'partials/sidebar' )
			->set_partial ( 'footer', 'partials/footer' );
			$this->template->build ('leads/partnerleads');
	    	
	    }
        
}
