<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Coupan extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
		$this->load->library('zyk/ServiceLib', 'servicelib');
	}
	
	public function index() {
		$this->load->library('zyk/General');
		$this->load->library('zyk/coupanLib');
	
		$coupons = $this->coupanlib->getCoupons();
        //$this->load->library('zyk/couponFrontLib');
        //$cal = $this->couponfrontlib->calculateDiscount(200,23,1);
		$this->template->set('coupons',$coupons);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | coupon Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('coupon/CouponList');
	}
	public function getCouponByVendorId()
	{
		$vendorid = $this->input->get('vendorid');
		$this->load->library('zyk/coupanLib');
		$areas = $this->general->getCouponByVendorId($vendorid);
		echo json_encode($areas);	
	}
	
	public function getRastro() {
		$areaid = $this->input->get('areaid');
		$this->load->library('zyk/coupanLib');
		$areas = $this->general->getRastByAreaId($areaid);
		echo json_encode($areas);
	}
	
	public function add()
	{
		$coupon = array();
	 	$coupon['name'] = $this->input->post('name');
		$coupon['start_date'] = date('Y-m-d',strtotime($this->input->post('start_date')));
		$coupon['end_date'] = date('Y-m-d',strtotime($this->input->post('end_date')));
		$coupon['min_order_value'] = $this->input->post('min_order_value');
		$coupon['description'] = $this->input->post('description');
		$coupon['coupon_code'] = $this->input->post('coupon_code');
		//$coupon['discount_type'] = $this->input->post('discount_type');
		$coupon['category_id'] = $this->input->post('category_id');
		$coupon['brand_id'] = $this->input->post('brand_id');
		/*$coupon['model_id'] = $this->input->post('model_id');
		$coupon['subcategory_id'] = $this->input->post('subcategory_id');
		$coupon['service_id'] = $this->input->post('service_id');*/
		$coupon['status'] = $this->input->post('status');
		//$coupon['discount']=$this->input->post('discount');
		//$coupon['max_discount']=$this->input->post('max_discount');
		$coupon['is_new_user']=$this->input->post('is_new_user');
		$coupon['coupon_type']=$this->input->post('coupon_type');
		if($coupon['coupon_type']==0)
		{
			$coupon['cashback_type']=0;
			$coupon['cashback']=0;
			$coupon['max_cashback']=0;
		}
		else
		{
			$coupon['cashback_type']=$this->input->post('cashback_type');
			$coupon['cashback']=$this->input->post('cashback');
			$coupon['max_cashback']=$this->input->post('max_cashback');
		}
		if($coupon['coupon_type']==2)
		{
			$coupon['discount_type']=0;
			$coupon['discount']=0;
			$coupon['max_discount']=0;
		}
		else
		{
			$coupon['discount_type'] = $this->input->post('discount_type');
			$coupon['discount']=$this->input->post('discount');
			$coupon['max_discount']=$this->input->post('max_discount');
		}
		$this->load->library('zyk/coupanLib');
	    $id = $this->coupanlib->addCoupon($coupon);
	    $response = array();
	    if(!empty($id)) {
	    	$response['status'] = 1;
	    	$response['msg'] = "Coupon added successfully.";
	    } else {
	    	$response['status'] = 0;
	    	$response['msg'] = "Failed to add Coupon.";
	    }
	    echo json_encode($response);
		//$this->index();
	}
	
   	public function update()
    {
      	$coupon = array();
      	$coupon['id'] = $this->input->post('id');
        $coupon['name'] = $this->input->post('name');
		$coupon['start_date'] = date('Y-m-d',strtotime($this->input->post('start_date')));
		$coupon['end_date'] = date('Y-m-d',strtotime($this->input->post('end_date')));
		$coupon['min_order_value'] = $this->input->post('min_order_value');
		$coupon['description'] = $this->input->post('description');
		$coupon['coupon_code'] = $this->input->post('coupon_code');
		//$coupon['discount_type'] = $this->input->post('discount_type');
		$coupon['category_id'] = $this->input->post('category_id');
		$coupon['brand_id'] = $this->input->post('brand_id');
		/* $coupon['model_id'] = $this->input->post('model_id');
		$coupon['subcategory_id'] = $this->input->post('subcategory_id');
		$coupon['service_id'] = $this->input->post('service_id');*/
		$coupon['status'] = $this->input->post('status');
		//$coupon['discount']=$this->input->post('discount');
		//$coupon['max_discount']=$this->input->post('max_discount');
		$coupon['is_new_user']=$this->input->post('is_new_user');
		$coupon['coupon_type']=$this->input->post('coupon_type');
		if($coupon['coupon_type']==0)
		{
			$coupon['cashback_type']=0;
			$coupon['cashback']=0;
			$coupon['max_cashback']=0;
		}
		else
		{
		$coupon['cashback_type']=$this->input->post('cashback_type');
		$coupon['cashback']=$this->input->post('cashback');
		$coupon['max_cashback']=$this->input->post('max_cashback');
		}
		if($coupon['coupon_type']==2)
		{
			$coupon['discount_type']=0;
			$coupon['discount']=0;
			$coupon['max_discount']=0;
		}
		else
		{
			$coupon['discount_type'] = $this->input->post('discount_type');
			$coupon['discount']=$this->input->post('discount');
			$coupon['max_discount']=$this->input->post('max_discount');
		}
        $this->load->library('zyk/coupanLib');
	   	$this->coupanlib->update($coupon);
		//$this->index();
	   	$response = array();
	  // 	if(!empty($id)) {
	   		$response['status'] = 1;
	   		$response['msg'] = "Coupon Updated successfully.";
	   	//} else {
	   		//$response['status'] = 0;
	   		//$response['msg'] = "Failed to add Coupon.";
	   	//}
	   	echo json_encode($response);
  	}
  	
	public function updateCoupon($a)
	{
		$this->load->library('zyk/General');
		$this->load->library('zyk/coupanLib');
		$this->load->library('zyk/ServiceLib');
		$categories = $this->servicelib->getActiveCategories();
		$subcategories = $this->servicelib->getActiveSubCategories();
		$services = $this->servicelib->getActiveServices();
		$brands = $this->servicelib->getActiveBrands();
		$models = $this->servicelib->getActiveModels();
		$coupon = $this->coupanlib->getCouponId($a);
		$this->template->set('models',$models);
		$this->template->set('brands',$brands);
		$this->template->set('categories',$categories);
		$this->template->set('subcategories',$subcategories);
		$this->template->set('services',$services);
		$this->template->set('coupon',$coupon);
		        
	   $this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | coupon Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('coupon/UpdateCoupon');
	}
	
	public function addCoupon()
	{
		$this->load->library('zyk/ServiceLib');
		$categories = $this->servicelib->getActiveCategories();
		$this->template->set('categories',$categories);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | coupon Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('coupon/CouponNew');
	}
	
	public function newCoupon()
	{
		$coupon = array();
		$coupon['vendor_id'] = $this->input->post('vendor');
		$coupon['coupon_code'] = $this->input->post('coupon_code');
		$coupon['status'] = $this->input->post('status');
		$this->load->library('zyk/coupanLib');
	    $this->coupanlib->addCoupon($coupon);
	    $this->index();
	}
	
	public function editVendor($a)
	{   $this->load->library('zyk/General');
		$this->load->library('zyk/coupanLib');
		
		$vendors = $this->coupanlib->getVendorsById($a);
		$this->template->set('vendors',$vendors);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | coupon Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'coupon/menu' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('coupon/EditVendor');
		
	}
	
	public function updateVendor()
	{

		$vendor = array();
		$vendor['id']= $this->input->post('id');
		$vendor['title'] = $this->input->post('title');
		$vendor['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
		$vendor['to_date'] = date('Y-m-d',strtotime($this->input->post('to_date')));
		$vendor['from_time'] = date('H:i:s',strtotime($this->input->post('from_time')));
		$vendor['to_time'] = date('H:i:s',strtotime($this->input->post('totime')));
		$vendor['is_multiple'] = $this->input->post('is_multiple');
		$vendor['is_specific'] = $this->input->post('is_specific');
		$vendor['minimum_order_value'] = $this->input->post('minimum_order_value');
		$vendor['restid'] = $this->input->post('restaurant');
		$vendor['is_day_specific'] = $this->input->post('is_day_specific');
		$vendor['status'] = $this->input->post('status');
		$this->load->library('zyk/coupanLib');
	    $this->coupanlib->updateVendor($vendor);
	    $this->index();
		
	}
	
   	public function turnoffcoupon($a)
   	{
      	$this->load->library('zyk/coupanLib');
      	$vendors = $this->coupanlib->getVendorsById($a);
      	if($vendors[0]['is_specific'] == 1) {
      		$restaurants = array();
      		$rests = explode(',',$vendors[0]['restid']);
      		foreach ($rests as $value) {
      			$restaurant = array();
      			$restaurant['id'] = $value;
      			$restaurant['has_deal'] = 0;
      			$restaurants[] = $restaurant;
      		}
	      	if(count($restaurants) > 0) {
	      		$current_date = date('Y-m-d');
	      		if($vendors[0]['from_date'] <= $current_date && $vendors[0]['to_date'] >= $current_date) {
	      			$this->load->library('zyk/RestaurantLib');
	      			$this->restaurantlib->batchUpdateRestaurants($restaurants);
	      		}
	      	}
      	}
	    $this->coupanlib->turnoffcoupon($a);
       	$this->index();
   	}
   	
   	public function turnoncoupon($a)
   	{
     	$this->load->library('zyk/coupanLib');
     	$vendors = $this->coupanlib->getVendorsById($a);
     	if($vendors[0]['is_specific'] == 1) {
     		$restaurants = array();
     		$rests = explode(',',$vendors[0]['restid']);
     		foreach ($rests as $value) {
     			$restaurant = array();
     			$restaurant['id'] = $value;
     			$restaurant['has_deal'] = 1;
     			$restaurants[] = $restaurant;
     		}
     		if(count($restaurants) > 0) {
     			$current_date = date('Y-m-d');
     			if($vendors[0]['from_date'] <= $current_date && $vendors[0]['to_date'] >= $current_date) {
     				$this->load->library('zyk/RestaurantLib');
     				$this->restaurantlib->batchUpdateRestaurants($restaurants);
     			}
     		}
     	}
	    $this->coupanlib->turnoncoupon($a);
       	$this->index();
   	}
   	
   	public function deleteVendor($vendorid)
    {
      	$this->load->library('zyk/coupanLib');
	   	$this->coupanlib->deleteVendor($vendorid);
   	}
   	
   	public function statusoncoupon($coupon_code)
    {
      	$this->load->library('zyk/coupanLib');
	    $this->coupanlib->oncoupon($coupon_code);
   	}
   	
   	public function statusoffcoupon($coupon_code)
   	{ 
      	$this->load->library('zyk/coupanLib');
	    $this->coupanlib->offcoupon($coupon_code);
   	}
   	
   	public function turnOnRestDeal() {
   		$this->load->library('zyk/coupanLib');
   		$vendors = $this->coupanlib->getActiveSpecificCoupons();
   		$restaurants = array();
   		foreach ($vendors as $key=>$row) {
   			$rest_arr = explode(",",$row['restid']);
   			foreach ($rest_arr as $value) {
   				$restaurant = array();
     			$restaurant['id'] = $value;
     			$restaurant['has_deal'] = 1;
     			$restaurants[] = $restaurant;
   			}
   		}
   		if(count($restaurants) > 0) {
   			$this->load->library('zyk/RestaurantLib');
   			$this->restaurantlib->batchUpdateRestaurants($restaurants);
   		}
   	}
   	
   	public function turnOffRestDeal() {
   		$this->load->library('zyk/coupanLib');
   		$vendors = $this->coupanlib->getInActiveSpecificCoupons();
   		$restaurants = array();
   		foreach ($vendors as $key=>$row) {
   			$rest_arr = explode(",",$row['restid']);
   			foreach ($rest_arr as $value) {
   				$restaurant = array();
   				$restaurant['id'] = $value;
   				$restaurant['has_deal'] = 0;
   				$restaurants[] = $restaurant;
   			}
   		}
   		if(count($restaurants) > 0) {
   			$this->load->library('zyk/RestaurantLib');
   			$this->restaurantlib->batchUpdateRestaurants($restaurants);
   		}
   	}
	
}
