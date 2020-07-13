<?php
class SearchLib {
	public function __construct() {
		$this->CI = & get_instance ();
		$this->CI->load->model ( 'search/Search_model', 'searchmodel' );
	}

	public function getbrandsbyName($name) { 
		$brand = $this->CI->searchmodel->getbrandsbyName($name);
		$model = $this->CI->searchmodel->getModelbyName($name);
		$response = array_merge($brand,$model);
		return $response;
	}
	public function getPackageList($pkid) {
      
	   $packlist=$this->CI->searchmodel->getPackageList($pkid);
	   $packege=array();
	   foreach ( $packlist as $key => $row ) {
			$packege [$key] = $row;
			
			$services = $this->CI->searchmodel->getservicebypackage($row['id']);
			$packege [$key]['services'] = $services;
		}
		return $packege;
    }
    public function getPackageListBySearchid($pkid) {
      
	   $packlist=$this->CI->searchmodel->getPackageListBySearchid($pkid);
	   $packege=array();
	   foreach ( $packlist as $key => $row ) {
			$packege [$key] = $row;
			
			$services = $this->CI->searchmodel->getservicebypackage($row['id']);
			$packege [$key]['services'] = $services;
		}
		return $packege;
    }

    public function getPackageAllList($pkid) {
      
	   $packlist=$this->CI->searchmodel->getallPackage($pkid);
	   $packege=array();
	   foreach ( $packlist as $key => $row ) {
			$packege [$key] = $row;
			
			$services = $this->CI->searchmodel->getservicebypackage($row['id']);
			$packege [$key]['services'] = $services;
		}
		return $packege;
    }
    
    public function getPackagebyId($pkid) {
      
	   $packege=$this->CI->searchmodel->getPackagebyId($pkid);
	   foreach ( $packege as $key => $row ) {
			$packege [$key] = $row;
			
			$services = $this->CI->searchmodel->getservicebypackage($row['id']);
			$packege [$key]['services'] = $services;
		} 
		return $packege;
    }

    public function getPackageByModelId($pkid) { 
	   $packege=$this->CI->searchmodel->getPackageByModelId($pkid);  
 	   foreach ( $packege as $key => $row ) {
			$packege [$key] = $row;
			
			$services = $this->CI->searchmodel->getservicebypackage($row['package_id']);
			$packege [$key]['services'] = $services;
		} 
		return $packege;
    }
    public function getRecommendedPackageByModelId($data,$packageid) { 

	   $packege=$this->CI->searchmodel->getRecommendedPackageByModelId($data,$packageid);   
 	   foreach ( $packege as $key => $row ) {
			$packege [$key] = $row;
			
			$services = $this->CI->searchmodel->getservicebypackage($row['package_id']);
			$packege [$key]['services'] = $services;
		} 
		return $packege;
    }

    public function getPackageDetailsbyId($pkid) { 

	    $packageData =  $this->CI->searchmodel->getPackageDetailsbyId($pkid); 
	    $services = $this->CI->searchmodel->getservicebypackage($pkid);
            $packageData['services'] = $services; 
            return $packageData ; 


	}
    
    public function getPackageDetailsbyId2($pkid) { 

	    $services = $this->CI->searchmodel->getservicebypackage3($pkid);
            $services['services'] = $services; 
            return $services;
	}
	public function getPackageUsagesByUser($pkid,$uid, $vid) { 

	   return $this->CI->searchmodel->getPackageUsagesByUser($pkid,$uid, $vid);   
	} 
	function getmypackage($userid)
	 {   $this->CI->load->library('zyk/SearchLib','searchlib');
	 	 $mypackege=$this->CI->searchmodel->getmypackage($userid);
 
	 	 foreach ( $mypackege as $key => $row ) {
			$mypackege [$key] = $row;
			$odercount=explode(",",$row['order_ids'] );
			$mypackege [$key]['ordercnt']=count($odercount);
			$mypackege [$key]['orders']=$this->CI->searchmodel->getOrders($userid,$row['order_ids']);
			$packages = $this->CI->searchlib->getPackagebyId($row['package_id']);
			$mypackege [$key]['packages'] = $packages;
		} 
		return $mypackege;
	 }

	 function getmypackageNew($userid,$vehicle_id)
	 {   $this->CI->load->library('zyk/SearchLib','searchlib');
	 	 $mypackege=$this->CI->searchmodel->getmypackageNew($userid,$vehicle_id);
 
	 	 foreach ( $mypackege as $key => $row ) {
			$mypackege [$key] = $row;
			$odercount=explode(",",$row['order_ids'] );
			$mypackege [$key]['ordercnt']=count($odercount);
			$mypackege [$key]['orders']=$this->CI->searchmodel->getOrders($userid,$row['order_ids']);
			$packages = $this->CI->searchlib->getPackagebyId($row['package_id']);
			$mypackege [$key]['packages'] = $packages;
		} 
		return $mypackege;
	 }

	public function getallPackage($page=null){
    	$packlist=$this->CI->searchmodel->getallPackage($page);
	    $packege=array();
	   foreach ( $packlist as $key => $row ) {
			$packege [$key] = $row;
			
			$services = $this->CI->searchmodel->getservicebypackage($row['id']);
			$packege [$key]['services'] = $services;
		}
		return $packege;

    }
     public function getOrderdetails($pkid,$uid) { 

	   return $this->CI->searchmodel->getOrderdetails($pkid,$uid);   
	} 

	public function getorderbypackage($uid,$pkid) { 

	   return $this->CI->searchmodel->getorderbypackage($uid,$pkid);   
	} 
	public function getorderbyexpiredpackage($uid,$pkid) { 

	   return $this->CI->searchmodel->getorderbyexpiredpackage($uid,$pkid);   
	} 
	public function getservicecount($orderids) { 

	   return $this->CI->searchmodel->getservicecount($orderids);   
	} 
    public function getservicebypackage2($param) {
         return $this->CI->searchmodel->getservicebypackage2($param);  
    }
     public function getusedpackage($uid,$pkid) { 

	   return $this->CI->searchmodel->getusedpackage($pkid,$uid);   
	} 
}