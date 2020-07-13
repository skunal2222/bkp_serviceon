<?php
class RestaurantLib {
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	/************** kunal **********************/

	public function getServicePriceAVG($vendorid)
	{
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$restaurants = $this->CI->restaurant->getServicePriceAVG($vendorid);
		return $restaurants;
	}

	public function getSearchedVendor($map) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		return $this->CI->restaurant->getSearchedVendor($map);
	}

	public function garageDetailsByVendorID($value=NULL)
	{
		$this->CI->load->model ( 'api/restaurants/Restaurant_model', 'restaurant' );
		return $this->CI->restaurant->garageDetailsByVendorID ( $value );	
	}

	public function getVendorsListByName($value=NULL)
	{
		$this->CI->load->model ( 'api/restaurants/Restaurant_model', 'restaurant' );
		return $this->CI->restaurant->getVendorsListByName ( $value );	
	}

	/************** kunal **********************/


	public function getRestaurants($map){
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$restaurants = $this->CI->restaurant->getRestaurants($map);
		return $restaurants;
	}
	
	public function getGarage($map){
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$restaurants = $this->CI->restaurant->getGarage($map);
		return $restaurants;
	}
	
	
	
	public function getRestaurants1(){
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$restaurants = $this->CI->restaurant->getRestaurants1();
		return $restaurants;
	}
	public function getRestaurantBasicDetails($id){
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$restaurants = $this->CI->restaurant->getRestaurantBasicDetails($id);
		return $restaurants;
	}
	
	public function getRestaurantCuisines($id) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$cuisines = $this->CI->restaurant->getRestaurantCuisines($id);
		return $cuisines;
	}
	
	public function getRestaurantContacts($id) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$contacts = $this->CI->restaurant->getRestaurantContacts($id);
		return $contacts;
	}
	
	public function getRestaurantProperties($id) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$props = $this->CI->restaurant->getRestaurantProperties($id);
		return $props;
	}
	public function updateRestaurantGeo($data)
	{
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$olddata=$this->getgeofance($data['id']);
		$this->addRestaurantLogs($olddata,$data,'Restaurant Delivery setting');
		return $this->CI->restaurant->updateRestaurantGeo($data);
		
	}
	public function savegeo($data)
	{
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		return $this->CI->restaurant->savegeo($data);
	}
	public function getgeofance ($restid)
	{
		$this->CI->load->model ( 'api/restaurants/Restaurant_model', 'restaurant' );
		$report = $this->CI->restaurant->getgeofance ( $restid );
		return $report;
	}
	
	public function getRestaurantSlabs($id) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$slabs = $this->CI->restaurant->getRestaurantSlabs($id);
		return $slabs;
	}
	
	public function getRestaurantDeliveryTime($id) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$deltime = $this->CI->restaurant->getRestaurantDeliveryTime($id);
		return $deltime;
	}
	
	public function getRestaurantDelTime($id) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$deltime = $this->CI->restaurant->getRestaurantDelTime($id);
		return $deltime;
	}
	
	public function getRestaurantMov($id) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$mov = $this->CI->restaurant->getRestaurantMov($id);
		return $mov;
	}
	
	public function getRestaurantBillingConfig($id) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$bconfig = $this->CI->restaurant->getRestaurantBillingConfig($id);
		return $bconfig;
	}
	
	public function getRestaurantBillingField($id,$field) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$bfield = $this->CI->restaurant->getRestaurantBillingField($id,$field);         
		return $bfield;
	}
	
	public function getRestaurantConfig($restid) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$config = $this->CI->restaurant->getRestaurantConfig($restid);
		return $config;
	}
	
public function addRestaurant($map){
		$data = array();
		$config = array();
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
	
		$restaurant = $this->CI->restaurant->addRestaurant($map['rest']);
		/*if($restaurant['status'] == 1) {
			$config['restid'] = $restaurant['id'];
			$config['basic'] = 1;
		
			$config['billing'] = 1;
			
			$map['billing']['restid'] = $restaurant['id'];
			
			for ($i = 0; $i < count($map['billingfields']); $i++) {
				$map['billingfields'][$i]['restid'] = $restaurant['id'];
			}
            for ($i = 0; $i < count($map['billingfields']); $i++) {
				$map['billingfields'][$i]['restid'] = $restaurant['id'];
			}
			
			
			$this->CI->restaurant->addRestaurantBillingConfig($map['billing']);
			$this->CI->restaurant->addRestaurantBillingFields($map['billingfields']);
			
		}*/
		return $restaurant;
	}
	
	public function updateVendor($map){
		$data = array();
		$config = array();
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		//send login details of vendor via email and sms
 			//get vendor password 
			$vendorData = $this->CI->restaurant->getRestaurantBasicDetails($map['rest']['id']);

			//send sms
			$this->sendLoginDetailsSMS($vendorData);
   
			//send email
			$this->sendLoginDetailsEmail($vendorData);

	
		$restaurant = $this->CI->restaurant->updateVendor($map['rest']);
		//$restaurant1 = $this->CI->restaurant->addVendor1($map['rest1']);
		if($restaurant['status'] == 1) {

			

 		 $config['restid'] = $restaurant['id'];
		 $config['basic'] = 1;
	
		 $config['billing'] = 1;
		 	
		 $map['billing']['restid'] = $restaurant['id'];
		 	
		 for ($i = 0; $i < count($map['billingfields']); $i++) {
		 $map['billingfields'][$i]['restid'] = $restaurant['id'];
		 }
		 for ($i = 0; $i < count($map['billingfields']); $i++) {
		 $map['billingfields'][$i]['restid'] = $restaurant['id'];
		 }
		 	
		 	
		 $this->CI->restaurant->addRestaurantBillingConfig($map['billing']);
		 $this->CI->restaurant->addRestaurantBillingFields($map['billingfields']);
		 	
		}
		return $restaurant;
	}
	
	/* public function addRestaurant($map){
		$data = array();
		$config = array();
		$this->CI->load->model ('restaurants/Restaurant_model', 'restaurant');
		$cuisine = $map['rest']['cuisine'];
		unset($map['rest']['cuisine']);
		$restaurant = $this->CI->restaurant->addRestaurant($map['rest']);
		if($restaurant['status'] == 1) {
			$config['restid'] = $restaurant['id'];
			$config['basic'] = 1;
			$cuisines = explode(",",$cuisine);
			$cuisine_map = array();
			foreach ($cuisines as $value) {
				$cuisine_map[] = array('restid'=>$restaurant['id'],'cuisine_id'=>$value);
			}
			$map['contact']['restid'] = $restaurant['id'];
			$config['contact'] = 1;
			$config['property'] = 1;
			$config['billing'] = 1;
			$map['property']['restid'] = $restaurant['id'];
			for ($i = 0; $i < count($map['mov']); $i++) {
				$map['mov'][$i]['restid'] = $restaurant['id'];
			}
			if(count($map['mov'])) {
				$config['del_mov'] = 1;
			}
			for ($i = 0; $i < count($map['time']); $i++) {
				$map['time'][$i]['restid'] = $restaurant['id'];
			}
			if(count($map['time'])) {
				$config['del_time'] = 1;
			}
			for ($i = 0; $i < count($map['slabs']); $i++) {
				$map['slabs'][$i]['restid'] = $restaurant['id'];
			}
			if(count($map['slabs'])) {
				$config['del_slab'] = 1;
			}
			$map['billing']['restid'] = $restaurant['id'];
			for ($i = 0; $i < count($map['billingfields']); $i++) {
				$map['billingfields'][$i]['restid'] = $restaurant['id'];
			}
            for ($i = 0; $i < count($map['billingfields']); $i++) {
				$map['billingfields'][$i]['restid'] = $restaurant['id'];
			}
			$this->CI->restaurant->addRestaurantCuisines($cuisine_map);
			$this->CI->restaurant->addRestaurantContacts($map['contact']);
			$this->CI->restaurant->addRestaurantProperties($map['property']);
			if(count($map['mov']) > 0)
			$this->CI->restaurant->addRestaurantMov($map['mov']);
			if(count($map['time']) > 0)
			$this->CI->restaurant->addRestaurantDeliveryTime($map['time']);
			if(count($map['slabs']) > 0)
			$this->CI->restaurant->addRestaurantSlabs($map['slabs']);
			$this->CI->restaurant->addRestaurantBillingConfig($map['billing']);
			$this->CI->restaurant->addRestaurantBillingFields($map['billingfields']);
			$this->CI->restaurant->addRestaurantConfig($config);
            if(isset($map['timings']))
            for ($i = 0; $i < count($map['timings']); $i++) {
				$map['timings'][$i]['restid'] = $restaurant['id'];
			}
            if(isset($map['timings']))
            	$this->CI->restaurant->addRestaurantTimings($map['timings']);
		}
		return $restaurant;
	}  */
	
	public function updateRestaurantDetails($map){
		/*if(!empty($map['cuisine'])) { 
			$cuisine = $map['cuisine'];
		} else {
			$cuisine = "";
		}
		unset($map['cuisine']);
		$comment = $map['comment'];
		unset($map['comment']);
		$log =array();
		$cuisines = explode(",",$cuisine);
		$cuisine_map = array();
		foreach ($cuisines as $value) {
			$cuisine_map[] = array('restid'=>$map['id'],'cuisine_id'=>$value);
			$log[] = array('restid'=>$map['id'],'cuisine_id'=>$value,'comment'=>$comment);
		}  */
		$olddata=$this->getRestaurantBasicDetails($map['id']);	
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$result = $this->CI->restaurant->updateRestaurantDetails($map);
		//$map['restid'] = $map['id'];
		//$map['comment'] = $comment;
		//$this->addRestaurantLogs($olddata,$map,'Basic Detail');
		$params = array();
		if ($result) {
			$params['id'] = $_POST['id'];
			$params['status'] = 1;
			$params['msg'] = 'Details updated successfullly.';
			/*if(!empty($cuisine))
			{
				$olddata=$this->getRestaurantCuisines($map['restid']);	
				$cusine_map['comment'] = $comment;
				
				$this->CI->restaurant->updateRestaurantCuisines($cuisine_map);
				foreach($log as $item)
				{
				$log = $this->addRestaurantLogs($olddata,$item,'Basic Detail');
				}
			} */
		} else {
			$params['id'] = $_POST['id'];
			$params['status'] = 1;
			$params['msg'] = 'Failed to update Details.';
		} 
		return $params;
	}
	
	
	public function updateRestaurantContacts($map){
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$olddata = $this->getRestaurantContacts($map['restid']);
		$comment = $map['comment'];
		unset($map['comment']);
		$this->CI->restaurant->updateRestaurantContacts($map);
		$map['comment'] = $comment;
		$this->addRestaurantLogs($olddata,$map,'Restaurant Contact ');
		$params['status'] = 1;
		$params['msg'] = 'Sucessfull update';
		return $params;
	}
	
	public function updateRestaurantProperties($map){
		
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$comment = $map['comment'];
		unset($map['comment']);
		$olddata = $this->getRestaurantProperties($map['restid']);	
		$this->CI->restaurant->updateRestaurantProperties($map);
		$map['comment'] = $comment;
		$this->addRestaurantLogs($olddata,$map,'Restaurant Propertis ');
		$params['status'] = 1;
		$params['msg'] = 'Sucessfull update';
		return $params;
	}
	
	public function updateRestaurantCuisines($map){
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->updateRestaurantCuisines($map);
		return $this->addRestaurantLogs($olddata,$map,'Restaurant Detail ');;
	}
	
	public function updateRestaurantMov($map){
		
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$olddata = $this->CI->restaurant->getRestaurantMov($map[0]['restid']);
		$comment = $map[0]['comment'];
		$i=0;
		for($i=0;$i<count($map);$i++)
		{
			unset($map[$i]['comment']);
		}
		unset($map['comment']);
		//print_r($map);
		$this->CI->restaurant->updateRestaurantMov($map);
		$map[0]['comment'] = $comment;
		//$this->addRestaurantLogs($olddata,$map,'Restaurant Delivery');
		return 1;
	}
	
	public function updateRestaurantDeliveryTime($map){
		$coment = $map[0]['comment'];
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$olddata = $this->getRestaurantDeliveryTime($map[0]['restid']);
		
		foreach($map as $newdata)
		{
			//print_r($newdata);
		$this->addRestaurantLogs($olddata,$newdata,'Restaurant Delivery');
		
		}
		for($i=0;$i<count($map);$i++)
		{
			unset($map[$i]['comment']);
		}
		return $this->CI->restaurant->updateRestaurantDeliveryTime($map);;
	}
	
	public function updateRestaurantSlabs($map){
		
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$olddata = $this->getRestaurantSlabs($map[0]['restid']);
		for($i=0;$i<count($map);$i++)
			{
				unset($map[$i]['comment']);
			}
		$this->addRestaurantLogs($olddata,$map[0],'Restaurant Propertis Slab');
		return $this->CI->restaurant->updateRestaurantSlabs($map);
	}
	
	public function updateRestaurantBillingConfig($map){
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');		
		$olddata = $this->getRestaurantBillingConfig($map['restid']);
		//$comment = $map['comment'];
		//unset($map['comment']);
		$this->CI->restaurant->updateRestaurantBillingConfig($map);
		//$map['comment'] = $comment;
		//$this->addRestaurantLogs($olddata,$map,'Restaurant Billing Config');
		$params['status'] = 1;
		$params['msg'] = 'Update successfully';
		return $params;
	}
	
	public function updateRestaurantBillingFields($map){	
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$rest = array();
		$i=0;
		foreach($map as $key=>$value)
		{
			$rest[$i] = $key;
			$i++;
		}
		$restid = $rest[0];
		$field = $rest[1];
		$olddata[0] = $this->CI->restaurant->getRestaurantBillingField($restid, $field);
		//$this->addRestaurantLogs($olddata,$map,'Restaurant Billing Config');
		return $this->CI->restaurant->updateRestaurantBillingFields($map);;
	}
	
	public function updateRestaurantConfig($map) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');	
		$olddata = $this->getRestaurantConfig($map['restid']);
		$comment = $map['comment'];
		unset($map['comment']);
		$this->CI->restaurant->updateRestaurantConfig($map);
		$map['comment'] = $comment;
		$this->addRestaurantLogs($olddata,$map,'Restaurant Restaurant Config');
		$params['status'] = 1;
		$params['msg'] = 'Update successfully';
		return $params;
		
	}
	
	public function batchUpdateRestaurants($map) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->batchUpdateRestaurants($map);
	}
	
	public function verifyRestaurant($restid) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$result = $this->CI->restaurant->getRestaurantConfig($restid);
		$score = $result[0]['basic'] + $result[0]['contact'] + $result[0]['property'] + $result[0]['del_slab'] + $result[0]['del_mov'] + $result[0]['del_time'] + $result[0]['billing'] + $result[0]['menu'];
		$progress = ($score/8)*100;
		if ($progress == 100) {
			$this->CI->restaurant->verifyRestaurant($restid);
			$map['status'] = 1;
			$map['msg'] = 'Restaurant verified successfully.';
		} else {
			$map['status'] = 0;
			$map['msg'] = 'Restaurant configuration is incomplete.';
		}
		return $map;
	}
	
	public function makeRestaurantLive($restid) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$result = $this->CI->restaurant->getRestaurantBasicDetails($restid);
		if($result[0]['is_verified']) {
			$this->CI->restaurant->makeRestaurantLive($restid);
			$map['status'] = 1;
			$map['msg'] = 'Restaurant made live successfully.';
		} else {
			$map['status'] = 0;
			$map['msg'] = 'Restaurant configuration is incomplete.';
		}
		return $map;
	}
        
  	public function getRestaurantCustomTimings($restid) {
     	$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
	   	$result = $this->CI->restaurant->getRestaurantCustomTimings($restid);
       	return $result;
  	}     
   	public function updateRestaurantTimings($map){
   		unset($map[comment]);
      	$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
      	return $this->CI->restaurant->updateRestaurantTimings($map);
      	
   	}  	
   	public function addRestaurantTimings($map){
   		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
   		return $this->CI->restaurant->addRestaurantTimings($map);;
   	}
   	
   	public function deleteRestaurantTimings($restid){
   		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant'); 	
   		return $this->CI->restaurant->deleteRestaurantTimings($restid);
   	}
        
	public function turnOnResto($data) {
	    $this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant'); 
	    $olddata[0]['status'] = 0;
	    $newdata['status'] = 1;
	    $newdata['comment'] = $data['comment'];
	    $newdata['restid'] = $data['id'];
	    $log = $this->addRestaurantLogs($olddata,$newdata,'Restaurant List');
	    return $this->CI->restaurant->turnOnResto($data['id']);
	}
	
	public function turnOffResto($data) {
	    $this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
	    $olddata[0]['status'] = 1;
	    $newdata['status'] = 0;
	    $newdata['comment'] = $data['comment'];
	    $newdata['restid'] = $data['id'];
	    $log = $this->addRestaurantLogs($olddata,$newdata,'Restaurant List');
	    return $this->CI->restaurant->turnOffResto($data['id']);
	}
	public function addRestaurantLogs($olddata,$newdata,$page)
	{
		
		unset($newdata['created_date']);
		$i = 0;
		$j = 0;
		$log[] = array();
		foreach($newdata as $key2=>$value2)
		{
		
		foreach($olddata[0] as $key1 => $value1)
		{
			if($key1==$key2)
			{
				if($value1!=$value2)
				{
					$log[$j]['comment'] = $newdata['comment'];
					$log[$j]['page_name'] = $page;
					$log[$j]['field_name'] = $key1;
					$log[$j]['restid'] = $newdata['restid'];
					$log[$j]['old_value'] = $value1;
					$log[$j]['new_value'] = $value2;
					if(!empty($_SESSION['adminsession']['id']))
						$log[$j]['updated_by'] = $_SESSION['adminsession']['id'];
					else 
						$log[$j]['updated_by'] = 1;
					$log[$j]['updated_datetime']=date("Y-m-d H:i:s");
					$j++;
				}
				$i++;
			}
		}
			
		}
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->addRestaurantLogs($log);
		
	}
	public function getLogsByrestid($restid)
	{
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');		
		return $this->CI->restaurant->getLogsByrestid($restid);
	}
	public function promote($data)
	{
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$j=0;
		foreach($data as $item)
		{
			$log[$j]['comment'] = $item['comment'];
			$log[$j]['page_name'] = 'Promote Restaurant';
			$log[$j]['field_name'] = 'Promote';
			$log[$j]['restid'] = $item['restid'];
			$log[$j]['old_value'] = '';
			$log[$j]['new_value'] = '';
			$log[$j]['updated_by'] = $_SESSION['adminsession']['id'];
			$log[$j]['updated_datetime']=date("Y-m-d H:i:s");
			
			unset($data[$j]['comment']);
			$j++;
		}
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->addRestaurantLogs($log);
		
		return $this->CI->restaurant->promote($data);
		
	}
	
	public function promoteUpdate($data)
	{
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$olddata = array();
		$olddata = $this->CI->restaurant->getPromotedRestaurantByRestId($data['restid']);
		$log = $this->addRestaurantLogs($olddata,$data,'Promoted Restaurant Update');
		return $this->CI->restaurant->promoteUpdate($data);
	}
	
	public function addPromtedRestaurants($promoted) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->addPromtedRestaurants($promoted);
	}
	
	public function updatePromtedRestaurants($promoted) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->updatePromtedRestaurants($promoted);
	}
	
	public function getpromotedRestaurant()
	{
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		return $this->CI->restaurant->getpromotedRestaurant();
	}
	public function turnoffPromotedResto ($data)
	{
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->turnoffPromotedResto($data['restid']);
		$log = array();
		$log[0]['comment'] = $data['comment'];
		$log[0]['field_name'] = 'status';
		$log[0]['page_name'] = 'Promote restaurant List';
		$log[0]['old_value'] = '1';
		$log[0]['new_value'] = '0';
		$log[0]['restid'] = $data['restid'];
		$log[0]['updated_by'] = $_SESSION['adminsession']['id'];
		$log[0]['updated_datetime']=date("Y-m-d H:i:s");
		$this->CI->load->model ('restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->addRestaurantLogs($log);
		
	}
	public function turnonPromotedResto ($data)
	{
		
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->turnonPromotedResto($data['restid']);
		$log = array();
		$log[0]['comment'] = $data['comment'];
		$log[0]['field_name'] = 'status';
		$log[0]['page_name'] = 'Promote restaurant List';
		$log[0]['old_value'] = '0';
		$log[0]['new_value'] = '1';
		$log[0]['restid'] = $data['restid'];
		$log[0]['updated_by'] = $_SESSION['adminsession']['id'];
		$log[0]['updated_datetime']=date("Y-m-d H:i:s");
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$this->CI->restaurant->addRestaurantLogs($log);
	}
	public function searchPromotedRestro($zone_id)
	{
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$result = $this->CI->restaurant->searchPromotedRestro($zone_id);
		return $result;
	}
	public function getPromotedRestaurantByRestId($restid)
	{
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$result = $this->CI->restaurant->getPromotedRestaurantByRestId($restid);
		return $result;
	}
	
	public function schedulePromotedRestaurants() {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$promoted = $this->CI->restaurant->getAllPromotedRestaurans();
		$this->CI->restaurant->schedulePromotedRestaurants($promoted);
	}
	
	public function addManufacture($data) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		return $this->CI->restaurant->addManufacture($data);
	}
	
	public function getManufactureDetailsById($data) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		return $this->CI->restaurant->getManufactureDetailsById($data);
	}
	
	public function getManufactureDetails() {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		return $this->CI->restaurant->getManufactureDetails();
	}
	
	public function updateManufactureDetails($data) {
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		return $this->CI->restaurant->updateManufactureDetails($data);
	}
	
	public function getvendorBasicDetails($id){
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$vendors = $this->CI->restaurant->getvendorBasicDetails($id);
		return $vendors;
	}
	
		public function updatevendorDetails($map){
		//exit;
		$olddata=$this->getvendorBasicDetails($map['id']);
		$this->CI->load->model ('api/restaurants/Restaurant_model', 'restaurant');
		$result = $this->CI->restaurant->updateVendorDetails($map);
		$params = array();
		if ($result) {
			$params['status'] = 1;
			$params['msg'] = 'Details updated successfullly.';
		} else {
			$params['status'] = 1;
			$params['msg'] = 'Failed to update Details.';
		}
		return $params;
	}

	public function sendLoginDetailsSMS($details) {
		//echo "inside sms";
		//$sms_msg = 'Your OTP is ' . $details ['otp'] . '.';
		$data=$details[0];
 		$sms_msg = 'Hi '.$data['name'].', Your registration with G2G is successfull use the userneme - '.$data['mobile'].' and password - '.$data['password'].' for login as a vendor Thanks G2G !.';
		$this->CI->load->library ( 'Pksms' );
		$map = array ();
		$map ['mobile'] = $data ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
 	}
	
	
	public function sendLoginDetailsEmail($user) {
		//echo "inside email";
		$user = $user[0];
		$this->CI->load->library ( 'pkemail' );
		$this->CI->pkemail->load_system_config ();
		$this->CI->pkemail->headline = 'G2G Login Details';
		$this->CI->pkemail->subject = 'Your Login Details';
		$this->CI->pkemail->mctag = 'signup-msg';
		$this->CI->pkemail->attachment = 0;
		$this->CI->pkemail->to = $user ['email'];
		$this->CI->template->set ( 'user', $user );
		$this->CI->template->set ( 'page', 'signup-message' );
		$this->CI->template->set_layout ( false );
		$text_body = $this->CI->template->build ( 'frontend/emails/login-details-vendor', '', true );
		$this->CI->pkemail->send_email ( $text_body );
	}
}	
