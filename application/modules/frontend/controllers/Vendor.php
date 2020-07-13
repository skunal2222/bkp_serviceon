<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Vendor extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/RestaurantLib');
		$this->load->library('zyk/ServiceLib');
	}

	public function getModelsByBrandsID()
	{
		$output = array();
		$brandsID = $this->input->post('brand');
		$this->load->library ( 'zyk/VehicalLib', 'vehicallib' );
		$models = $this->vehicallib->getModelsByBrandsID($brandsID);

		if (!empty($models)) {
			$output['modelModalList'] = '';
			$output['modelList'] = '<div class="user-select">';
	        $modelsize = sizeof($models);
	            for($i = 0; $i < 4; $i++){
	            	$output['modelList'] .= '<div><label>';
	            	$output['modelList'] .= '<input type="checkbox" class="common_selector model" name="ch-model[]" value="'.$models[$i]['id'].'">';
	            	$output['modelList'] .= '<span class="pl-3">'.$models[$i]['name'].'</span>';
					$output['modelList'] .= '</label></div>';
	            }
	            if ($modelsize>4) {
		            $output['modelList'] .= '<div>';
		            $output['modelList'] .= '<h5 class="see-more" data-toggle="modal" data-target="#bikebrandModal">See '.($modelsize-4).' More</h5>';
		            $output['modelList'] .= '</div>';

		            for($i = 4; $i < $modelsize; $i++){
			            $output['modelModalList'] .= '<div><label>';
			            $output['modelModalList'] .= '<input type="checkbox" class="model" name="ch-model[]" value="'.$models[$i]['id'].'">';
			            $output['modelModalList'] .= '<span class="pl-3">'.$models[$i]['name'].'</span>';
			            $output['modelModalList'] .= '</label></div>';
		            }
	            }
			$output['modelList'] .= '</div>';

			echo json_encode($output);
		}
	}

	public function search()
	{
		$output = '';
		$map = array();
		$vendors['byvendor_id'] = 0;

		$map['locality'] = str_replace('-', ' ', $this->input->post('locality'));
		$map['latitude'] = $this->input->post('latitude');
		$map['longitude'] = $this->input->post('longitude');
		$map['serviceType'] = $this->input->post('st');
		$map['limit'] = $this->input->post('limit');
		$map['start'] = $this->input->post('start');
		
		if(!empty($map['serviceType']))
		{
			$_SESSION['serviceType'] = $map['serviceType'];
		}

		if($this->input->post('star'))
		{
			$map['star'] = $this->input->post('star');
			$_SESSION['filterstar'] = $map['star'];
		}

		if($this->input->post('brand'))
		{
			$map['brand'] = $this->input->post('brand');
			$_SESSION['filterbrand'] = $map['brand'];
		}

		if($this->input->post('model'))
		{
			$map['model'] = $this->input->post('model');
			$_SESSION['filtermodel'] = $map['model'];
		}

		if(!empty($this->input->post('vendor_id'))) {
			$map['vendor_id'] = $this->input->post('vendor_id'); 
			$vendors['byvendor_id'] = 1;
		}

		//print_r($map); die();

		if (!empty($map['latitude']) && !empty($map['longitude']))  
		{
			$vendors['data'] = $this->restaurantlib->getSearchedVendor($map);
			$no= 0;
			if(!empty($vendors['data']))
			{
				foreach ($vendors['data'] as $vendor) {
					$mod = $this->restaurantlib->getServicePriceAVG($vendor['id']);
					$vendors['data'][$no]['moderate'] = $mod['avgModerate'];
					$no++;
				}

				$vendors['location'] = $this->input->post('locality');
				$vendors['latitude'] = $map['latitude'];
				$vendors['longitude'] = $map['longitude'];
				$output = $this->load->view('garage-list-ajax', $vendors, FALSE);
			}
			// print_r($vendors['data']); die();
		}
		echo $output;
	}

	public function garage_list($loc=NULL, $lati=NULL, $longi=NULL, $serviceType=NULL)
    {
    	$this->load->library('zyk/VehicalLib','vehicallib');
    	$map = array();
		$map['locality'] = $loc;
		$map['latitude'] = $lati;
		$map['longitude'] = $longi;
		$map['serviceType'] = $serviceType;
		$data['userid'] = (isset($_SESSION['olouserid']))?$_SESSION['olouserid']:"";
		$brands = $this->servicelib->getActiveBrands('ASC');
		$models = $this->servicelib->getActiveModels('ASC');
		$userVehicle = $this->vehicallib->getVehicalList($data['userid']);
    	$this->template->set ( 'userVehicle', $userVehicle );
    	$this->template->set ( 'brands', $brands );
    	$this->template->set ( 'models', $models );
    	$this->template->set ( 'location_data', $map );
    	$this->template->set ( 'page', 'Garage List' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('garage-list');
    }

	public function getVendorsListByName()
	{
		$value = $this->input->post('search');
		//echo $value; die();
		$output = [];
		if (!empty($value)) {
			$result = $this->restaurantlib->getVendorsListByName($value);
			if(!empty($result))
			{
				//$output['status'] = 1;
				foreach ($result as $garage) {
					$output[] = array(
					    'value'  => $garage["id"],
					    'label'  => $garage["garage_name"],
				    );
				}
			} 
		}		
		echo json_encode($output);
	}

	public function garage_dashboard($garageName=NULL,$latLong=NULL,$vendor_id=NULL)
    {
    	// print_r($latLong);die();
    	$ltlg = explode('-', $latLong);
    	$map['latitude'] = $ltlg[0];
    	$map['longitude'] = $ltlg[1];
    	$map['vendor_id'] = $vendor_id;
    	$garage_detail = $this->restaurantlib->garageDetailsByVendorID($map);
    	// $service_detail = $this->restaurantlib->getServiceDetailsByVendorID($map);
		$mod = $this->restaurantlib->getServicePriceAVG($vendor_id);
		$garage_detail['moderate'] = $mod['avgModerate'];
    	// print_r($garage_detail); die();
    	$servicegroup = $this->servicelib->getActiveServiceGroupsName();
    	$this->template->set ( 'servicegroup', $servicegroup );
    	$this->template->set ( 'garage_detail', $garage_detail );
    	$this->template->set ( 'page', 'Garage Dashboard' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('garage-dashboard');
    }

    public function booking_confirm()
    {
    	if (!empty($_POST)) {
    		$_SESSION['back_url'] = $this->input->post('ref_url');
    		$_SESSION['categories'] = $this->input->post('categories');
    		$_SESSION['vendor_id'] = $this->input->post('vendor_id');
    	}

    	if (empty($_SESSION['categories'])) {
    		redirect($_SESSION['back_url']);
    	}

    	$data['distance'] = $this->input->post('distance');
    	$data['st'] = $_SESSION['serviceType'];
    	if (empty($data['st'])) {
    		redirect(base_url());
    	}
    	
    	$stData = $this->servicelib->getServiceTypeCharges($data);
    	$stData['serviceType'] = ($data['st'] == 1)?"Pick'n drop":(($data['st'] == 2)?"Breakdown":"NA");
    	$stData['st'] = $data['st'];


    	$_SESSION['stData'] = $stData;

    	$data['userid'] = (isset($_SESSION['olouserid']))?$_SESSION['olouserid']:"";
    	$this->load->library('zyk/SlotLib','slotlib');
    	$this->load->library('zyk/UserLib','userlib');
    	$this->load->library('zyk/VehicalLib','vehicallib');
    	$this->load->library('zyk/ServiceLib','servicelib');
    	$visitingslots = $this->slotlib->getActiveVisiting1();
    	$user_address = $this->userlib->getAddressByIDs($data);
    	$userVehicle = $this->vehicallib->getVehicalList($data['userid']);
    	$userInfo = $this->userlib->getuser($data['userid']);
    	$cats['id'] = $_SESSION['categories'];
    	$categories = $this->servicelib->getActiveServiceGroupsName($cats);
    	// print_r($stData); die();
    	$this->template->set ( 'vendor_id', $_SESSION['vendor_id'] );
    	$this->template->set ( 'back_url', $_SESSION['back_url'] );
    	$this->template->set ( 'stData', $stData );
    	$this->template->set ( 'categories', $categories );
    	$this->template->set ( 'visitingslots', $visitingslots );
    	$this->template->set ( 'userAddress', $user_address );
    	$this->template->set ( 'userVehicle', $userVehicle );
    	$this->template->set ( 'userInfo', $userInfo );
    	$this->template->set ( 'page', 'Booking Confirm' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    $this->template->set_layout ('default')
	    ->title ( 'ServiceOn' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('booking-confirm');
    }

    public function getModalViews()
    {
    	$view = $this->input->post('view');
    	if ($view == 2) {
    		$this->load->library('zyk/SlotLib','slotlib');
	    	$data = array();
	    	$data['visitingslots'] = $this->slotlib->getActiveVisiting1();
	    	$response['modaltitle'] = "Change Date & Time Slot";
	    	$response['modalbody'] = $this->load->view('Change_slot', $data, true);
	    	echo json_encode($response);
    	}

    	if ($view == 3) {
	    	$data = array();
	    	$response['modaltitle'] = "Change Address";
	    	$response['modalbody'] = $this->load->view('Change_address', $data, true);
	    	echo json_encode($response);
    	}

    	if ($view == 4) {
    		$userdata['userid'] = $_SESSION['olouserid'];
    		$data = array();
    		$this->load->library ( 'zyk/VehicalLib', 'vehicallib' );
    		$data['brands_data'] = $this->vehicallib->getActiveBikeBrands();
			$data['vehicalList'] = $this->vehicallib->getVehicalList($userdata['userid']);
	    	$response['modaltitle'] = "Change Vehicle";
	    	$response['modalbody'] = $this->load->view('Change_vehicle', $data, true);
	    	echo json_encode($response);
    	}

    	if ($view == 5) {
    		$this->load->library('zyk/SlotLib','slotlib');
	    	$this->load->library('zyk/UserLib','userlib');
	    	$this->load->library('zyk/VehicalLib','vehicallib');
	    	$this->load->library('zyk/RestaurantLib','restaurantlib');
    		$summarydata = array();
    		$userdata['vendor_id'] = $_SESSION['vendor_id'];
    		$q = $this->db->where('id', $userdata['vendor_id'])->get('vendor');
    		$summarydata['garage_detail'] = $q->row_array();
    		// $summarydata['garage_detail'] = $this->restaurantlib->garageDetailsByVendorID($userdata);

    		$userdata['userid'] = $_SESSION['olouserid'];
	    	$summarydata['userAddress'] = $this->userlib->getAddressByIDs($userdata);
	    	$summarydata['userVehicle'] = $this->vehicallib->getVehicalList($userdata['userid']);
	    	$cats['id'] = $_SESSION['categories'];
	    	$summarydata['categories'] = $this->servicelib->getActiveServiceGroupsName($cats);
	    	$summarydata['order']['user_id'] =  $_SESSION['olouserid'];
	    	$summarydata['order']['vendor_id'] =  $_SESSION['vendor_id'];
	    	$summarydata['order']['slotdate'] =  $_SESSION['slotdate'];
	    	$summarydata['order']['slottime'] =  $_SESSION['slottime'];
	    	$summarydata['order']['categories'] =  implode(",", $_SESSION['categories']);
	    	$response['modaltitle'] = "Order Summary";

	    	$response['modalbody'] = $this->load->view('Booking_summary', $summarydata, true);
	    	echo json_encode($response);	
    	}
    }

    public function getAddressTBL()
    {
    	$data['userid'] = $this->input->get('userid');
    	$this->load->library ( 'zyk/UserLib', 'userlib' );
    	$data = $this->userlib->getAddressByIDs($data);

    	$tbl = "";
    	$i=1;
    	foreach ($data as $address) {
    		$chekd = ($address['is_primary'] == 1)? 'checked':'';
    		$addresstype = ($address['address_name'] == 1 ? "Home Address" : ($address['address_name'] == 2 ? "Office Address" : "Other Address"));
    		$edit = "<a href='#' class='edit' id='".$address['id']."'><i class='fa fa-edit'></i></a>";
    		$del = "<a href='#' class='delete' id='".$address['id']."'><i class='fa fa-times'></i></a>";
    		$rd = "<input type='radio' name='is_primary' id='isprimary-".$address['id']."' ".$chekd."  >";
	    	$tbl .= "<tr>";
	    	$tbl .= "<td>".$i.$edit.$del."</td>";
	    	$tbl .= "<td>".$rd."</td>";
	    	$tbl .= "<td>".$addresstype."</td>";
	    	$tbl .= "<td>".$address['address']."</td>";
	    	$tbl .= "<td>".$address['locality']."</td>";
	    	$tbl .= "<td>".$address['landmark']."</td>";
	    	$tbl .= "<td>".$address['statename']."</td>";
	    	$tbl .= "<td>".$address['cityname']."</td>";
	    	$tbl .= "<td>".$address['pincode']."</td>";
	    	$tbl .= "</tr>";
    		$i++;
    	}

    	echo json_encode($tbl);
    }

    public function editUserAddress()
    {
    	$data['addressid'] = $this->input->post('address_id');
    	$this->load->library ( 'zyk/UserLib', 'userlib' );
    	$data = $this->userlib->getAddressByIDs($data);
    	echo json_encode($data);
    }

    public function deleteUserAddress()
    {
    	$addressid = $this->input->post('address_id');
    	if(!empty($addressid)) {
			$this->db->where('id',$addressid);
			$this->db->delete('user_address');
    	}
    	echo json_encode(1);
    }

    public function get_statelist()
    {
    	$this->load->library ( 'zyk/UserLib', 'userlib' );
    	$countryid = 101;
    	$data = $this->userlib->get_statelist($countryid);
    	echo json_encode($data);
    }

    public function get_citylist()
    {
    	$this->load->library ( 'zyk/UserLib', 'userlib' );
    	$stateid = $this->input->get('stateid');
    	$data = $this->userlib->get_citylist($stateid);
    	echo json_encode($data);
    }

    public function address_submit()
    {
    	$response['result'] = 0;
    	if (!empty($_SESSION['olouserid'])) {
	    	$address['userid'] = $_SESSION['olouserid'];
	    	$address['id'] = $this->input->post('address_id');
	    	$address['address_name'] = $this->input->post('address_type');
	    	$address['locality'] = $this->input->post('locality');
	    	$address['latitude'] = $this->input->post('latitude');
	    	$address['longitude'] = $this->input->post('longitude');
	    	$address['address'] = $this->input->post('address');
	    	$address['landmark'] = $this->input->post('landmark');
	    	$address['country'] = 101;
	    	$address['state'] = $this->input->post('state');
	    	$address['city'] = $this->input->post('city');
	    	$address['pincode'] = $this->input->post('pincode');

	    	$this->load->library ( 'zyk/UserLib', 'userlib' );
	    	$response['result'] = $this->userlib->submit_address($address);
	    	if ($address['id'] =="") {
	    		$response['msg'] = "Address Saved Successfully";
	    	} else {
	    		$response['msg'] = "Address Updated Successfully";
	    	}
    	}
    	echo json_encode($response);
    }

    public function set_isPrimary_address()
    {
    	$user_id = $this->input->post('userid');
    	$addressid = $this->input->post('address_id');
    	$response = [];

    	if (!empty($addressid)) {
    		$this->db->set('is_primary',0);
    		$this->db->where('userid',$user_id);
    		$this->db->update('user_address');

    		$this->db->set('is_primary',1);
    		$this->db->where('id',$addressid);
    		$this->db->update('user_address');

    		$data['addressid'] = $addressid;
    		$this->load->library('zyk/UserLib', 'userlib');
			$userAddress = $this->userlib->getAddressByIDs($data);

			if (!empty($userAddress[0])) {
    			$response['setaddress'] = $userAddress[0]['address'].", ".$userAddress[0]['locality'].", ".$userAddress[0]['landmark'].", ".$userAddress[0]['cityname'].", ".$userAddress[0]['statename'].", ".$userAddress[0]['pincode'];
			}
    	}
    	echo json_encode($response);
    }

    public function savePayMode()
    {
    	$pmd = $this->input->post('pm');
    	if (!empty($pmd)) {
    		if ($pmd == 1 || $pmd == 2) {
	    		$_SESSION['stData']['paymode'] = $pmd;
	    		$rsp['status'] = 1;
    		} else {
    			$rsp['status'] = 0;
    		}
    	} else {
    		$rsp['status'] = 0;
    	}
    	echo json_encode($rsp);
    }

    public function deleteSelectedServiceGroup()
    {
    	$catid = $this->input->post('catid');
    	if (!empty($catid)) {
    		$key = array_search($catid, $_SESSION['categories']);
    		// echo $key; die();
    		if ($key !== false) {
    			unset($_SESSION['categories'][$key]);
    			$_SESSION['categories'] = array_values($_SESSION['categories']);
    			// print_r($_SESSION['categories']); die();
    			$response['length'] = count($_SESSION['categories']);
    		}
    	}

    	echo json_encode($response);
    }

    public function getVehicleTBL()
    {
    	$userid = $this->input->get('userid');
    	$this->load->library ( 'zyk/VehicalLib', 'vehicallib' );
    	$data = $this->vehicallib->getVehicalList($userid);

    	$tbl = "";
    	$i=1;
    	foreach ($data as $vehicle) {
    		$chekd = ($vehicle['is_primary_vehicle'] == 1)? 'checked':'';
    		$edit = "<a href='#' class='editvehicle' id='".$vehicle['id']."'><i class='fa fa-edit'></i></a>";
    		$del = "<a href='#' class='deletevehicle' id='".$vehicle['id']."'><i class='fa fa-times'></i></a>";
    		$rd = "<input type='radio' name='is_primary_vehicle' id='isprimaryvehicle-".$vehicle['id']."' ".$chekd."  >";
	    	$tbl .= "<tr>";
	    	$tbl .= "<td>".$i." ".$edit." ".$del."</td>";
	    	$tbl .= "<td>".$rd."</td>";
	    	$tbl .= "<td>".$vehicle['brandname']."</td>";
	    	$tbl .= "<td>".$vehicle['modelname']."</td>";
	    	$tbl .= "<td>".$vehicle['vehicle_no']."</td>";
	    	$tbl .= "</tr>";
    		$i++;
    	}
    	echo json_encode($tbl);
    }

    public function setPickupslot()
    {
    	$_SESSION['slotdate'] = $this->input->get('slotdate');
    	$_SESSION['slottime'] = $this->input->get('slottime');
    	echo 1;
    }

    public function order_summary_view($coupon=NULL)
    {
    	$decoded_cpn = base64_decode($coupon);

    	$this->load->library('zyk/SlotLib','slotlib');
    	$this->load->library('zyk/UserLib','userlib');
    	$this->load->library('zyk/VehicalLib','vehicallib');
    	$this->load->library('zyk/RestaurantLib','restaurantlib');
		$summarydata = array();
		if(isset($_SESSION['vendor_id'])){
			$userdata['vendor_id'] = $_SESSION['vendor_id'];
			$q = $this->db->where('id', $userdata['vendor_id'])->get('vendor');
			$summarydata['garage_detail'] = $q->row_array();

			$userdata['userid'] = $_SESSION['olouserid'];
	    	$summarydata['userAddress'] = $this->userlib->getAddressByIDs($userdata);
	    	$summarydata['userVehicle'] = $this->vehicallib->getVehicalList($userdata['userid']);
	    	$cats['id'] = $_SESSION['categories'];
	    	$summarydata['categories'] = $this->servicelib->getActiveServiceGroupsName($cats);
	    	$summarydata['order']['user_id'] =  $_SESSION['olouserid'];
	    	$summarydata['order']['vendor_id'] =  $_SESSION['vendor_id'];
	    	$summarydata['order']['slotdate'] =  $_SESSION['slotdate'];
	    	$summarydata['order']['slottime'] =  $_SESSION['slottime'];
	    	$summarydata['order']['categories'] =  implode(",", $_SESSION['categories']);
	    	$summarydata['stData'] =  $_SESSION['stData'];
	    	$response['modaltitle'] = "Order Summary";

		    $this->template->set ( 'ccode', $decoded_cpn );
		    $this->template->set ( 'page', 'Booking Summary' );
			$this->template->set ( 'description', '' );
			$this->template->set ( 'keywords', '' );
			$this->template->set_theme('default_theme');
			//$this->template->set_layout (false);
			$this->template->set_layout ('default')
			->title ( 'ServiceOn' )
			//->meta ( 'doctors' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'footer', 'partials/footer' );

			$this->template->build ('Booking_summary', $summarydata);
		}else{
			redirect(base_url());
		}
		


	    // $response['modalbody'] = $this->load->view('Booking_summary', $summarydata);
    }

    public function get_description()
    {	
    	$id = $this->input->post('cid');
    	$description = $this->db->select('description')->from('coupon')->where('id', $id)->get()->row_array();
    	echo json_encode($description);
    }
}