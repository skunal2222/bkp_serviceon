<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Package extends MX_Controller {

	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/ServiceLib', 'servicelib');
	}
	
	public function index() 
	{
		$this->load->library('zyk/PackageLib');
		$packages = $this->packagelib->getAllPackageList();
		//echo '<pre>'; print_r($packages); die;
        $this->template->set('package',$packages);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Package Dashboard')
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('package/PackageList');
	}

	public function addPackage()
	{
		$this->load->library('zyk/ServiceLib');
		$categories = $this->servicelib->getActiveCategories();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Package Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('package/PackageNew');
	}
	
	public function savePackage()
	{
        //echo '<pre>'; print_r($this->input->post()); die;

		$package = array();

		$package['package_name']      = $this->input->post('name');
		$package['category_id']       = $this->input->post('category_id');
		$package['short_description'] = $this->input->post('short_description');
		$package['long_description']  = $this->input->post('long_description');
		$package['year']              = $this->input->post('Year');
		$package['status']            = $this->input->post('status');
		$package['my_referral']       = $this->input->post('my_referral');
		$package['other_referral']    = $this->input->post('other_referral');  
		$package['best_price']        = $this->input->post('best_price');
		$package['special_price']     = $this->input->post('special_price');
		$package['service_used_validity']  = $this->input->post('Service_used');
				
		$brand_id                 = $this->input->post('brand_id');
		$package['brand_id']      = implode(",",$brand_id);

		$sub_cat                  = $this->input->post('subcategory_id');
		$package['subcategory_id'] = implode(",",$sub_cat);


		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/package/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$package['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}


		$this->load->library('zyk/PackageLib');
	    $packageId = $this->packagelib->savePackage($package);

        if(!empty($packageId)){
          $packagemodels              = array();
          $model_id                   = $this->input->post('model_id');
          
          foreach ($model_id as $key=>$row) {
          	   $modelId_arr = explode(",",$row);
               foreach ($modelId_arr as $value) {
   				$packagemodel               = array();
     			$packagemodel['model_id']   = $value;
     			$packagemodel['package_id'] = $packageId;
     			$packagemodels[] = $packagemodel;
   			}
          }
          if(count($packagemodels) > 0) {
            $this->load->library('zyk/PackageLib');
	        $this->packagelib->savebatchPackageModels($packagemodels);
          }	
          

          $packageservices              = array();
          $service_id                   = $this->input->post('service_id');
          $service_as_per_use           = $this->input->post('service_as_per_use');
          
          
           foreach ($service_id as $key=>$servicerow) {
          	$packageservices[] = array(
          						'service_id' => $servicerow,
          						'service_used_validity'=> $service_as_per_use[$key],
          						'package_id' =>  $packageId
          						);
          }
          
          }
          if(count($packageservices) > 0) {
          $this->load->library('zyk/PackageLib');
	      $this->packagelib->savebatchPackageServices($packageservices);
          }
            $response = array();
	   		$response['status'] = 1;
	   		$response['msg'] = "Package Added successfully.";
	   
	   	echo json_encode($response);
	}

	public function get_services_by_serviceid() {
      $this->load->library('zyk/PackageLib');
      echo json_encode($this->packagelib->get_services_by_id($_POST));
    }


    public function update()
    {
        //echo '<pre>';print_r($this->input->post()); die;

      	$package = array();
      	$package_Id                    = $this->input->post('id');
		$package['id']                = $package_Id;
		$package['package_name']      = $this->input->post('name');
		$package['category_id']       = $this->input->post('category_id');
		$package['short_description'] = $this->input->post('short_description');
		$package['long_description']  = $this->input->post('long_description');
		$package['year']              = $this->input->post('Year');
		$package['status']            = $this->input->post('status'); 
		$package['my_referral']       = $this->input->post('my_referral');
		$package['other_referral']    = $this->input->post('other_referral'); 
		$package['best_price']        = $this->input->post('best_price');
		$package['special_price']     = $this->input->post('special_price');
		$package['service_used_validity']  = $this->input->post('service_used_validity');
		$brand_id                     = $this->input->post('brand_id');
		$package['brand_id']          = implode(",",$brand_id);

		$sub_cat                  = $this->input->post('subcategory_id'); 

		//echo '<pre>'; print_r($sub_cat); die;
		$package['subcategory_id'] = implode(",",$sub_cat);


		if (!empty($_FILES['image']['name'])) {
			$itemlocation = 'assets/images/package/';
			$item_image = uploadImage($_FILES['image'],$itemlocation,array('jpeg','jpg','png','gif'),2097152,'item');
			if($item_image['status'] == 1) {
				$package['image'] =  $item_image['image'];
			} else {
				$errors = array();
				$error = array("image"=>$item_image['msg']);
				if (! empty ( $error )) {
					array_push ( $errors, $error );
				}
				$item_image['errormsg'] = $errors;
				echo json_encode($item_image);
				exit;
			}
		}

		$this->load->library('zyk/PackageLib');
	    $packageId = $this->packagelib->update($package);
        
        /*Remove the models and services in the table */

	    $this->packagelib->RemoveServices($package_Id);
	    $this->packagelib->RemoveModel($package_Id);

        $packagemodels              = array();
        $model_id                   = $this->input->post('model_id');
          
          foreach ($model_id as $key=>$row) {
          	   $modelId_arr = explode(",",$row);
               foreach ($modelId_arr as $value) {
   				$packagemodel               = array();
     			$packagemodel['model_id']   = $value;
     			$packagemodel['package_id'] = $package_Id;
     			$packagemodels[] = $packagemodel;
   			}
          }

          if(count($packagemodels) > 0) {
            $this->load->library('zyk/PackageLib');
	        $this->packagelib->savebatchPackageModels($packagemodels);
          }


         /*Update the service and service per used value in package service table */ 
       
          $packageservices              = array();
          $service_id                   = $this->input->post('service_id');

          $service_as_per_use           = $this->input->post('service_as_per_use');
        
          foreach ($service_id as $key=>$servicerow) {
          	$packageservices[] = array(
          						'service_id' => $servicerow,
          						'service_used_validity'=> $service_as_per_use[$key],
          						'package_id' => $package_Id
          						);
          }	

          if(count($packageservices) > 0) {
          $this->load->library('zyk/PackageLib');
	      $this->packagelib->savebatchPackageServices($packageservices);
          }

	   	    $response = array();

	   		$response['status'] = 1;
	   		$response['msg'] = "Package Updated successfully.";
	   
	   	echo json_encode($response);
  	}
  	
	public function updatePackage($a)
	{   
	    //services
		$this->load->library('zyk/General');
		$this->load->library('zyk/PackageLib');
		$this->load->library('zyk/ServiceLib');
		$categories      = $this->servicelib->getActiveCategories(); 
		$subcategories   = $this->servicelib->getActiveSubCategories();
		$services        = $this->servicelib->getAllActiveServices();
		$brands          = $this->servicelib->getActiveBrands();
		$models          = $this->servicelib->getActiveModels();
		$packagemodels   = $this->packagelib->getPackageModels($a);
		$packageservices = $this->packagelib->getPackageServices($a);
		$package         = $this->packagelib->getpackageId($a); 
		$packService     = array();

		foreach ($packageservices as $key => $value) {
			array_push($packService, $value['service_id']);
		}
		$this->template->set('selectedService',$packService);
        $this->template->set('models',$models);
        
        $packModel     = array();
        foreach ($packagemodels as $key => $value) {
        	//echo '<pre>'; print_r($value); die;
			array_push($packModel, $value['model_id']);
		}
		$this->template->set('selectedModel',$packModel);

		$this->template->set('packageservices',$packageservices);
		$this->template->set('brands',$brands);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('services',$services);
		$this->template->set('package',$package);
	
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Package Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('package/UpdatePackage');
	}

	public function packagenameexist()
	{
      $PackageName = $this->input->post('package_name');
	  $this->load->library('zyk/PackageLib');
	  $PackageNameExist = $this->packagelib->PackageNameAlreadyExist($PackageName);
      
      $response = array();

      if($PackageNameExist == 1){
	  
	    $response['status'] = 1;
	    $response['msg'] = "Package Name Already Exist.";
	  
	  }else{
        
        $response['status'] = 0;
	    $response['msg'] = "Package Name Not Exist.";

	  }
	   	echo json_encode($response);
    }		

	public function get_packagename_by_modelid() {
      $this->load->library('zyk/PackageLib');
      $model_id = $this->input->post('model_id');
      $response  = $this->packagelib->get_packagename_by_modelid($model_id); 
      echo json_encode($response);
    }

	public function getActivePackages() {
      $this->load->library('zyk/PackageLib'); 
      $response  = $this->packagelib->getActivePackages(); 
      echo json_encode($response);
    }

	public function get_userpackage_by_packageid() {
      $this->load->library('zyk/PackageLib');
      $user_id = $this->input->post('userid');
      $vehicle_id = $this->input->post('vehicle_no');
      $package_id = $this->input->post('package_id');
      $response  = $this->packagelib->get_userpackage_by_packageid($user_id,$vehicle_id,$package_id);  
      
     /* echo "<pre>";
      print_r($response);
      exit();
*/

      echo json_encode($response);
    }
}
