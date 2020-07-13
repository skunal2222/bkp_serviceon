<?php
class CoupanLib {
	public function __construct() {
		$this->CI = & get_instance ();
	}
	public function getAllRestaurant() {
		$this->CI->load->model ( 'general/Coupan_model', 'coupon' );
		$areas = $this->CI->coupon->getRestaurant ();
		return $areas;
	}
	public function getCouponsByVendorId($a) {
		$this->CI->load->model ( 'general/Coupan_model', 'coupon' );
		$areas = $this->CI->coupon->getCouponsByVendorsId ( $a );
		return $areas;
	}
	public function getDiscountByVendorId($a) {
		$this->CI->load->model ( 'general/Coupan_model', 'coupon' );
		$areas = $this->CI->coupon->getDiscountByVendorId ( $a );
		return $areas;
	}
	public function getVendorById($a) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$restaurants = $this->CI->coupan->getVendorById ( $a );
		return $restaurants;
	}

	public function getVendorsById($a) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$restaurants = $this->CI->coupan->getVendorsById ( $a );
		return $restaurants;
	}
	
	public function getCouponId($a) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$coupons = $this->CI->coupan->getCouponId ( $a );
		return $coupons;
	}
	
	public function getRastByAreaId($cityid) {
		$this->CI->load->model ( 'general/Settings_model', 'settings' );
		$areas = $this->CI->settings->getRastByAreaId ( $cityid );
		return $areas;
	}
	public function getRestaurant() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$restaurants = $this->CI->coupan->getRestaurant ();
		return $restaurants;
	}
	public function addVendor($aa) {
		// echo $aa['to_time'];
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$this->CI->coupan->addVendor ( $aa );
	}
	public function getCoupons() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$vendors = $this->CI->coupan->getCoupons ();
		return $vendors;
	}
	public function getAllVendors() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$vendors = $this->CI->coupan->getAllVendors ();
		
		return $vendors;
	}

	public function getAllVendorsList() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$vendors = $this->CI->coupan->getAllVendorsList ();
		
		return $vendors;
	}

	public function addCoupon($data) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->addCoupon ( $data );
		return $discount;
	}
	public function updateVendor($data) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->updateVendor ( $data );
	}
	public function update($data) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->update ( $data );
		return $discount;
	}
	public function turnoffcoupon($data) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->turnoffcoupon ( $data );
	}
	public function turnoncoupon($data) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->turnoncoupon ( $data );
	}
	public function deleteVendor($vendorid) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->deleteVendor ( $vendorid );
	}
	public function offcoupon($coupon_code) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->statusoffcoupon ( $coupon_code );
	}
	public function oncoupon($coupon_code) {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		$discount = $this->CI->coupan->statusoncoupon ( $coupon_code );
	}
	
	public function getActiveSpecificCoupons() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		return $this->CI->coupan->getActiveSpecificCoupons ( );
	}
	
	public function getInActiveSpecificCoupons() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		return $this->CI->coupan->getInActiveSpecificCoupons ( );
	}
	
	public function getCouponCodeByCode($data){
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		return $coupon = $this->CI->coupan->getCouponCodeByCode($data);
	}
	
	public function getActiveCoupons() {
		$this->CI->load->model ( 'coupan/Coupan_model', 'coupan' );
		return $this->CI->coupan->getActiveCoupons ( );
	}
}