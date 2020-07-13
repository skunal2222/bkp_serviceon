<?php
class ItemLib {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function addItem($item) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$result = $this->CI->itemmodel->addItem ($item);
		return $result;
	}
	
	public function addRate($rate) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$result = $this->CI->itemmodel->addRate ($rate);
		return $result;
	}
	
	public function addVendor($vendor) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$result = $this->CI->itemmodel->addVendor ($vendor);
		return $result;
	}
	
	
	
	public function updateItem($item) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$result = $this->CI->itemmodel->updateItem ( $item );
		return $result;
	}
	
	public function rateUpdate($item) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$result = $this->CI->itemmodel->rateUpdate ( $item );
		return $result;
	}
	
	public function vendorUpdate($item) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$result = $this->CI->itemmodel->vendorUpdate ( $item );
		return $result;
	}
	
	public function turnOffItem($id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		return  $this->CI->itemmodel->turnOffItem ( $id );
	}
	
	public function turnOnItem($id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		return $this->CI->itemmodel->turnOnItem ( $id );
	}
	
	public function getItemByCatId($cat_id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getItemByCatId ( $cat_id );
		return $response;
	}
	
	public function getItemByRateId($rate_id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getItemByRateId ( $rate_id );
		return $response;
	}
	
	public function getRateByCatId($cat_id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getRateByCatId ( $cat_id );
		return $response;
	}
	
	public function getVendorByCatId($cat_id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getVendorByCatId ( $cat_id );
		return $response;
	}
	
	public function getRateId($rate_id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getRateId ( $rate_id );
		return $response;
	}
	
	public function getDetailsByName($name) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getDetailsByName ( $name);
		return $response;
	}
	
	public function getVendorId($vendor_id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getVendorId ( $vendor_id );
		return $response;
	}
	
	public function getRatelist() {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getRatelist ( );
		return $response;
	}
	
	public function getVendorlist() {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getVendorlist ( );
		return $response;
	}
	
	public function addCategory($cat) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$result = $this->CI->itemmodel->addCategory ($cat);
		return $result;
	}
	
	public function addRatecard($rate) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$result = $this->CI->itemmodel->addRatecard ($rate);
		return $result;
	}
	
	public function updateCategory($cat) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$result = $this->CI->itemmodel->updateCategory ( $cat );
		return $result;
	}
	
	public function updateRatecard($rate) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$result = $this->CI->itemmodel->updateRatecard ( $rate );
		return $result;
	}
	
	public function getActiveCategories() {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getActiveCategories (  );
		return $response;
	}
	
	public function getActiveRatecard() {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getActiveRatecard (  );
		return $response;
	}
	
	public function getActiveVendor() {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getActiveVendor (  );
		return $response;
	}
	
	public function getActiveRatecard1() {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getActiveRatecard1 (  );
		return $response;
	}
	
	public function getCategoryById($cat_id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getCategoryById ( $cat_id );
		return $response;
	}
	
	public function getRatecardById($rate_id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getRatecardById ( $rate_id );
		return $response;
	}
	
	public function getItemById($id,$type,$cat,$brand,$model,$subcat,$vendorid) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getItemById ($id,$type,$cat,$brand,$model,$subcat,$vendorid);
		return $response;
	}
	
	public function getRateById($itemid) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getRateById ( $itemid );
		return $response;
	}
	
	public function getVendorById($itemid) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getVendorById ( $itemid );
		return $response;
	}
	
	public function getActiveItemsByCatId($cat_id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getActiveItemsByCatId ( $cat_id );
		return $response;
	}
	
	public function getActiveItems() {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getActiveItems ( );
		return $response;
	}
	
	public function getActiveProducts($cat_id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getActiveProducts ($cat_id );
		return $response;
	}
	
	
	
	public function searchItemName($params) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->searchItemName ( $params );
		return $response;
	}
	
	public function getItemCategory($item_id) {
		$this->CI->load->model ( 'items/Item_model', 'itemmodel' );
		$response = $this->CI->itemmodel->getItemCategory ( $item_id );
		return $response;
	}
	
}
