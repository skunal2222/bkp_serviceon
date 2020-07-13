<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Service extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/SearchLib','searchlib');
	}
	
	public function getbrandsbyName() {
		$name = $this->input->get('name');
		$service = $this->searchlib->getbrandsbyName($name);
		echo json_encode($service);
	}
	/*public function selectPackage() {
		$packagesid=$this->input->get('searchid');	

        $this->session->set_userdata('searchid', $packagesid);
		//$packages = $this->searchlib->getPackageList($packagesid);
		$this->template->set('package',$packages);
	    $this->template->set ( 'page', 'booking-flow/select-package' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial( 'header', 'partials/header' ) 
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build('booking-flow/select-package');
		
	}*/
	   //edit popup
	public function quickView(){ 
		$pkid = $this->input->post('id');
		$packages = $this->searchlib->getPackagebyId($pkid);
                $this->template->set ( 'packDetails', $packages);
                $this->template->set ( 'services', $this->searchlib->getservicebypackage2($pkid));
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		$html = $this->template->build ('booking-flow/quick-view','',true);
		echo $html;
	} 
	public function packageView(){ 
		$pkid = $this->input->post('id');
		$packages = $this->searchlib->getPackagebyId($pkid);
                $this->template->set ( 'packDetails', $packages);
                $this->template->set ( 'services', $this->searchlib->getservicebypackage2($pkid));
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		$html = $this->template->build ('booking-flow/package-view','',true);
		echo $html;
	}
	public function bookService() {
         $userdata['name'] = $this->session->userdata('olousername');
		 $userdata['email'] = $this->session->userdata('olouseremail');
		 $userdata['mobile'] = $this->session->userdata('olousermobile');
         $userdata['olouserid'] = $this->session->userdata('olouserid');  
 		 $userdata['catsubcat_id'] = $this->session->userdata('catsubcat_id'); 
 
		 $url=base_url().'admin/modelbybrandid1';
         $brand = file_get_contents("$url");
         $brand_array=json_decode($brand,true);
          //   pretag($brand_array);
          //  echo $homepage;
		 $this->template->set('brand_array',$brand_array);

 		 $this->template->set('userdata',$userdata); 



	     $packagesid=$this->input->get('id');
	     $packages = $this->searchlib->getPackagebyId($packagesid);


	     $mypackages=$this->searchlib->getorderbypackage($_SESSION['olouserid'], $packagesid);
	     $myexpiredpackages=$this->searchlib->getorderbyexpiredpackage($_SESSION['olouserid'], $packagesid);
	    
	    $vehicle_id =  $myexpiredpackages[0]['vehicle_id']; 
		$vehicle = $this->db->select('vehicle_no')->from('tbl_user_vehicles')->where('id',$vehicle_id)->get()->result_array(); 
	     if(empty($_SESSION['olousermodel'])){
	     	$modelid=$this->searchlib->getusedpackage($_SESSION['olouserid'], $packagesid);
	     	//$_SESSION['olousermodel']=$modelid['model_id'];
	      
	      // pretag($modelid['model_id']); 
	     }

	     if(count( $mypackages)>0)
	      {
	      	 echo '<script>
	      	alert(" This package already subscribed");
	      	var base_url = window.location.origin;
	      	window.location.href = base_url + "/final/my-packages"</script>';
	      }
	    $this->template->set ( 'package', $packages[0]);
	    $this->template->set ( 'vehicle_id', $vehicle_id);
	    $this->template->set('vehicle_number',$vehicle[0]['vehicle_no']);  
	    $this->template->set ( 'page', 'booking-flow/select-address' );
		$this->template->set ( 'description', '' );
		$this->template->set ( 'keywords', '' );
		$this->template->set_theme('default_theme');
		//$this->template->set_layout (false);
		$this->template->set_layout ('default')
		->title ( 'BikeDoctor' )
		//->meta ( 'doctors' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('booking-flow/book-service');
		
	}
	public function getDeliveryDates() {
		//echo $_GET['date'];
		$this->load->library('zyk/SlotLib', 'slotlib');	
		$date = date('Y-m-d', strtotime($_GET['date']));
		$current_date = date('Y-m-d');
		$current_time = date('H:i');
		$current_time_ext = date('H:i',strtotime('+45 minutes'));
		$slots = $this->slotlib->getActiveVisiting1();
		//print_r($slots); die;
		$durArray = array();
		$day = date('D',strtotime($date));
		if($date == date('Y-m-d')) {
			foreach ($slots as $slot) {
				$slot_arr = explode('-',$slot['time_slot']);
				$from_time = date('H:i',strtotime($slot_arr[0]));
				$to_time = date('H:i',strtotime($slot_arr[1]));
				if($current_time < $from_time) {
					$durArray[] = $slot['time_slot'];
				}
			}
		} else {
			foreach ($slots as $slot) {
				$durArray[] = $slot['time_slot'];
			}
		}
		//print_r($durArray);
		$html = "";
		$i =0;
		$_SESSION['timeslotList'] = $durArray ; 
		foreach ($durArray as $pickupslot) {
			$a=explode(" ",$pickupslot);
			$i++;
			if($i==1){
				//$html .= '<option value="'.$pickupslot.'">'.$pickupslot.'</option>';
				$html .= '<option value="'.$pickupslot.'">'.$pickupslot.'</option>';
			} else {
				$html .= '<option value="'.$pickupslot.'">'.$pickupslot.'</option>';
					
			}
		}
		if($html == "") {
			$html = '<option value="">No Slots Available</option>';
		}
		echo $html;
	}


   public function subcategorybycatid(){
		$catid = $this->input->post('catid');
		$this->load->library('zyk/ProductLib', 'productlib');
		$subcategory = $this->productlib->getSubCatByCatId($catid); 
		$catName = $this->productlib->getCategoryName($catid); 
		$this->template->set('catName',$catName[0]['name']);
		
		$this->template->set('catid',$catid);
		
		$this->template->set('subcategory',$subcategory);
		if(!empty($subcategory)){
			$featuredsalon = $this->productlib->getfeaturedsalonbysubcatid($subcategory[0]['id']);
			
			$this->template->set('subcatid',$subcategory[0]['id']);
			$this->template->set('featuredsalon',$featuredsalon);
		}
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('partialspages/subcategoryhome','',true);
	}

	public function headerSubCat() {
		$catid = $this->input->post('catid');
		$this->load->library('zyk/ProductLib', 'productlib');
		$subcategory = $this->productlib->getSubCatByCatId($catid);
		$this->template->set('subcategory',$subcategory);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('partialspages/headerSubCat','',true);
	}
	
	public function featuredsalonbysubcatid() {
		$subcatid = $this->input->post('subcatid');
		$this->load->library('zyk/ProductLib', 'productlib');
		$featuredsalon = $this->productlib->getfeaturedsalonbysubcatid($subcatid);
		$this->template->set('subcatid',$subcatid);
		$this->template->set('featuredsalon',$featuredsalon);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('partialspages/salonhome','',true);
	}
	
	public function shownewpopsalonbycatid() {
		$catid = $this->input->post('catid');
		$this->load->library('zyk/ProductLib', 'productlib');
		$newsalon = $this->productlib->getNewSalonByCatId($catid);
		$popularsalon = $this->productlib->getPopularSalonByCatId($catid);
		$offersalon = $this->productlib->getOfferSalonByCatId($catid);
		$this->template->set('catid',$catid);
		$this->template->set('newsalon',$newsalon);
		$this->template->set('popularsalon',$popularsalon);
		$this->template->set('offersalon',$offersalon);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		echo $this->template->build ('partialspages/view-newsalon-home','',true);
	}
	
	public function MyPackages() {
 			$id=$_SESSION['olouserid']; 


 			if(!empty($id)){
 			$mypackages=$this->searchlib->getmypackage($id);
			/*echo "<pre>";
			print_r($mypackages);
			exit;*/
			// echo '<pre>';
			//   print_r($mypackages); 	echo '</pre>'; exit; 
 
			$this->template->set('mypackages',$mypackages);
		    }

		    $packages = $this->searchlib->getallPackage();
		    
		    $this->template->set('package',$packages);	


	    $this->template->set ( 'page', 'my-profile/my-packages' );
	    $this->template->set ( 'description', '' );
	    $this->template->set ( 'keywords', '' );
	    $this->template->set_theme('default_theme');
	    //$this->template->set_layout (false);
	    $this->template->set_layout ('default')
	    ->title ( 'BikeDoctor' )
	    //->meta ( 'doctors' )
	    ->set_partial ( 'header', 'partials/header' )
	    ->set_partial ( 'footer', 'partials/footer' );
	    $this->template->build ('my-profile/my-packages');
	    
	}
	public function bookorder()
	{
		 $userdata['name'] = $this->session->userdata('olousername');
		 $userdata['email'] = $this->session->userdata('olouseremail');
		 $userdata['mobile'] = $this->session->userdata('olousermobile');
         $userdata['olouserid'] = $this->session->userdata('olouserid'); 
        
        if (!empty($_SESSION['catsubcat_id'])) {

        	  $catsubcat_id=$_SESSION['catsubcat_id'];  
        } 

 		if(!empty($catsubcat_id)){  
			$catsubcat = $this->db->select('*')->from('category_subcat')->where_in('id',$catsubcat_id)->get()->result_array(); 
			$this->template->set('catsubcat',$catsubcat);
		} 
		
 		 $this->template->set('userdata',$userdata);
	    $packagesid=$this->input->post('id');
 	//	 $packagesid=10;
	     $perorder = $this->searchlib->getOrderdetails($packagesid,$_SESSION['olouserid']);
	     $packages = $this->searchlib->getPackagebyId($packagesid);
	    
	     $this->load->library('zyk/UserLib','userlib');
	     $userdetails = $this->userlib->getProfile($_SESSION['olouserid']);
         $this->load->library('zyk/PackageLib');
	     $packageservices = $this->packagelib->getPackageServices($packagesid);

	     $this->template->set('packageservices',$packageservices);

	     $mypackages=$this->searchlib->getorderbypackage($_SESSION['olouserid'], $packagesid);

 	     $servicecnt=$this->searchlib->getservicecount($mypackages[0]['order_ids']); 
 	    $this->template->set ( 'mypackages', $mypackages);
	    $this->template->set ( 'servicecnt', $servicecnt);

	    $this->template->set ( 'userdetails', $userdetails[0]);
	    $this->template->set ( 'perorder', $perorder[0]);
	    $this->template->set ( 'package', $packages[0]);
		$this->template->set_theme('default_theme');
		$this->template->set_layout (false);
		$html = $this->template->build ('booking-flow/book-order','',true);
		echo $html;
	}
	public function setData(){ 
	//pretag($_POST);  
		//print_r($_POST); exit;

	   $notfirstorder=$this->input->post('notfirstorder'); 
		if(isset($notfirstorder)){
		$this->session->set_userdata('model_id', $this->input->post('model_id'));
		$this->session->set_userdata('brand_id',$this->input->post('brand_id'));
		}else{
	    $model_id=explode("_",$_SESSION['searchid']);
		$this->session->set_userdata('model_id', $model_id[1]);
		$brand_id= $this->searchlib->getbrandId($_SESSION['model_id']);
        $this->session->set_userdata('brand_id',($brand_id[0]['brand_id']));
		}
		// $model_id=explode("_",$_SESSION['searchid']);
		// $this->session->set_userdata('model_id', $model_id[1]);
		// $brand_id= $this->searchlib->getbrandId($_SESSION['model_id']);
		//$this->session->set_userdata('brand_id',($brand_id[0]['brand_id']));

		$this->session->set_userdata('latitude', $this->input->post('latitude'));
		$this->session->set_userdata('longitude', $this->input->post('longitude'));
		$this->session->set_userdata('package_id', $this->input->post('packageid'));
		$this->session->set_userdata('packagename', $this->input->post('packagename'));
 		$this->session->set_userdata('best_price', $this->input->post('best_price')); 
 		$this->session->set_userdata('special_price', $this->input->post('special_price')); 
 		$this->session->set_userdata('name', $this->input->post('name'));
 		$this->session->set_userdata('email', $this->input->post('email')); 
 		$this->session->set_userdata('mobile', $this->input->post('mobile')); 
 		$this->session->set_userdata('visit_date', $this->input->post('visit_date')); 
 		$this->session->set_userdata('visit_time', $this->input->post('visit_time')); 
 		$this->session->set_userdata('flat', $this->input->post('flat')); 
 		$this->session->set_userdata('landmark', $this->input->post('landmark')); 
 		$this->session->set_userdata('pincode', $this->input->post('pincode')); 
 		$this->session->set_userdata('plateno', $this->input->post('plateno')); 
 		$this->session->set_userdata('coupon_code', $this->input->post('coupon_code'));
 		$this->session->set_userdata('service_use', $this->input->post('service_use'));
 		$this->session->set_userdata('service_type', $this->input->post('service_type'));
 	/*	print_r($_SESSION); 
 		exit(); */
 		$response = array('msg'=>'Data added in session','status'=>1);
		echo json_encode($response);   
 		//$summuryurl=base_url().'booking-summary' ;

 	//	header("Location: $summuryurl") ;  
		  
 	} 
 	 public function getMore(){
        $page =  $_GET['page'];
         $packages = $this->searchlib->getallPackage($page);
	//	print_r($packages); die;
		$this->template->set('package',$packages);	
		$this->template->set_layout (false);
	 echo	$viewmorehtml=$this->template->build ('booking-flow/view_more','',true); 
       
        exit;
    
       }


	
}