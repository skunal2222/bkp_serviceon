<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
 * General Settings Model
 *
 * <p>
 * We are using this model to add, update, delete and get general setting like city,area etc.
 * </p>
 *
 * @package General
 * @author Pradeep Singh
 * @copyright Copyright &copy; 2015
 * @category CI_Model API
 *          
 */
class Settings_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function addCategory($cat) {
	
		$data = array ();
	
		$params = array (
	
				'name' => $cat ['name']
	
		);
	
		$this->db->select ( 'id' )->from ( TABLES::$VENDOR_CATEGORY )->where ( $params );
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		if (count ( $result ) <= 0) {
	
			$this->db->insert ( TABLES::$VENDOR_CATEGORY, $cat );
	
			$data ['status'] = 1;
	
			$data ['msg'] = "Added successfully";
	
			return $data;
	
		} else {
	
			$data ['msg'] = "Category name already exists.";
	
			$data ['status'] = 0;
	
			return $data;
	
		}
	
	}
	
	public function getActiveCategories() {
	
		$this->db->select ( '*' )->from ( TABLES::$VENDOR_CATEGORY );
	
		//$this->db->where ('status',1);
	
		$this->db->order_by ('id','ASC');
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		return $result;
	
	}
	
	public function updateCategory($cat) {
	
		$data = array ();
	
		$params = array (
	
				'name' => $cat ['name'],
	
				'id !=' => $cat ['id']
	
		);
	
		$this->db->select ( 'id' )->from ( TABLES::$VENDOR_CATEGORY )->where ( $params );
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		if (count ( $result ) <= 0) {
	
			$this->db->where ( 'id', $cat ['id'] );
	
			$this->db->update ( TABLES::$VENDOR_CATEGORY, $cat );
	
			$data ['status'] = 1;
	
			$data ['msg'] = "updated successfully";
	
			return $data;
	
		} else {
	
			$data ['msg'] = "Category name already exists.";
	
			$data ['status'] = 0;
	
			return $data;
	
		}
	
	}
	
	public function getCategoryById($id) {
	
		$this->db->select ( '*' )->from ( TABLES::$VENDOR_CATEGORY );
	
		$this->db->where ('id',$id);
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		return $result;
	
	}
	
	public function addSubCategory($cat) {
	
		$data = array ();
	
		$params = array (
	
				'name' => $cat ['name']
	
		);
	
		$this->db->select ( 'id' )->from ( TABLES::$VENDOR_SUBCATEGORY )->where ( $params );
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		if (count ( $result ) <= 0) {
	
			$this->db->insert ( TABLES::$VENDOR_SUBCATEGORY, $cat );
	
			$data ['status'] = 1;
	
			$data ['msg'] = "Added successfully";
	
			return $data;
	
		} else {
	
			$data ['msg'] = "Subcategory already exists.";
	
			$data ['status'] = 0;
	
			return $data;
	
		}
	
	}
	
public function getSubActiveCategories() {

		$this->db->select('a.*,b.name as category', FALSE)

		->from(TABLES::$VENDOR_SUBCATEGORY.' AS a')

		->join(TABLES::$VENDOR_CATEGORY.' AS b','a.category_id = b.id','inner');
		
			$this->db->order_by ('a.id','ASC');

		$query = $this->db->get ();

		$result = $query->result_array ();

		return $result;

	}
	
	public function updateSubCategory($cat) {
	
		$data = array ();
	
		$params = array (
	
				'name' => $cat ['name'],
	
				'id !=' => $cat ['id']
	
		);
	
		$this->db->select ( 'id' )->from ( TABLES::$VENDOR_SUBCATEGORY )->where ( $params );
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		if (count ( $result ) <= 0) {
	
			$this->db->where ( 'id', $cat ['id'] );
	
			$this->db->update ( TABLES::$VENDOR_SUBCATEGORY, $cat );
	
			$data ['status'] = 1;
	
			$data ['msg'] = "updated successfully";
	
			return $data;
	
		} else {
	
			$data ['msg'] = "Subcategory already exists.";
	
			$data ['status'] = 0;
	
			return $data;
	
		}
	
	}
	
	public function getSubCategoryById($id) {
	
		$this->db->select ( '*' )->from ( TABLES::$VENDOR_SUBCATEGORY );
	
		$this->db->where ('id',$id);
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		return $result;
	
	}
	
	public function addStatus($cat) {
	
		$data = array ();
	
		$params = array (
	
				'name' => $cat ['name']
	
		);
	
		$this->db->select ( 'id' )->from ( TABLES::$STATUS )->where ( $params );
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		if (count ( $result ) <= 0) {
	
			$this->db->insert ( TABLES::$STATUS, $cat );
	
			$data ['status'] = 1;
	
			$data ['msg'] = "Added successfully";
	
			return $data;
	
		} else {
	
			$data ['msg'] = "Status already exists.";
	
			$data ['status'] = 0;
	
			return $data;
	
		}
	
	}
	
	public function getActiveStatus() {
	
		$this->db->select ( '*' )->from ( TABLES::$STATUS );
	
		//$this->db->where ('status',1);
	
		$this->db->order_by ('id','ASC');
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		return $result;
	
	}
	
	public function getActiveStatus1() {
	
		$this->db->select ( '*' )->from ( TABLES::$STATUS );
	
		//$this->db->where ('status',1);
	
		$this->db->order_by ('id','ASC');
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		return $result;
	
	}
	
	public function updateStatus($cat) {
	
		$data = array ();
	
		$params = array (
	
				'name' => $cat ['name'],
	
				'id !=' => $cat ['id']
	
		);
	
		$this->db->select ( 'id' )->from ( TABLES::$STATUS )->where ( $params );
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		if (count ( $result ) <= 0) {
	
			$this->db->where ( 'id', $cat ['id'] );
	
			$this->db->update ( TABLES::$STATUS, $cat );
	
			$data ['status'] = 1;
	
			$data ['msg'] = "updated successfully";
	
			return $data;
	
		} else {
	
			$data ['msg'] = "Status already exists.";
	
			$data ['status'] = 0;
	
			return $data;
	
		}
	
	}
	
	public function getStatusById($id) {
	
		$this->db->select ( '*' )->from ( TABLES::$STATUS );
	
		$this->db->where ('id',$id);
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
	
		return $result;
	
	}
	
	public function addCity($city) {
		$data = array ();
		$errors = array ();
		$params = array (
				'name' => $city ['name'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$CITY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$CITY, $city );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$errors ['city'] = "City name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	public function getSubCatId($id) {
	
		$this->db->select ( '*' )->from ( TABLES::$VENDOR_SUBCATEGORY );
	
		$this->db->where ('category_id',$id);
	
		$query = $this->db->get ();
	
		$result = $query->result_array ();
		echo $this->db->last_query();
	
		return $result;
	
	}
	
	/**
	 *
	 *
	 * update city name
	 * 
	 * @param
	 *        	city object
	 * @access public
	 * @return array
	 */
	public function updateCity($city) {
		$data = array ();
		$errors = array ();
		$params = array (
				'name' => $city ['name'],
				'id !=' => $city ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$CITY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $city ['id'] );
			$this->db->update ( TABLES::$CITY, $city );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$errors ['city'] = "City name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	/**
	 *
	 * change the status of city from 1 to 0
	 * 
	 * @access public
	 * @param $id of
	 *        	city
	 *        	
	 */
	public function turnOffCity($id) {
		$city ['status'] = 0;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$CITY, $city );
	}
	
	/**
	 *
	 * change the status of city from 0 to 1.
	 * 
	 * @access public
	 * @param
	 *        	id of city
	 */
	public function turnOnCity($id) {
		$city ['status'] = 1;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$CITY, $city );
	}
	
	/**
	 *
	 * get city name,fence and status of city by id
	 * 
	 * @param
	 *        	city id
	 * @access public
	 * @return result_set
	 */
	public function getCityById($id) {
		$this->db->select ( 'id,name,status' )->from ( TABLES::$CITY )->where ( 'id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	/**
	 * get all the cities.
	 * 
	 * @param
	 *        	no param
	 * @access public
	 * @return array_list
	 */
	public function getAllCities() {
		$this->db->select ( 'id,name,status' )->from ( TABLES::$CITY )->order_by ( 'name', 'asc' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addLocality($locality) {
		$params = array (
				'name' => $locality ['name'],
				'cityid=' => $locality ['cityid'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$AREA )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$AREA, $locality );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$errors ['name'] = "Locality name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	/**
	 *
	 * update locality name, longitude, latitude and zone
	 * 
	 * @param
	 *        	locality object
	 * @access public
	 * @throws Exception
	 */
	public function updateLocality($locality) {
		$data = array ();
		$params = array (
				'name' => $locality ['name'],
				'cityid' => $locality ['cityid'],
				'id !=' => $locality ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$AREA )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $locality ['id'] );
			$this->db->update ( TABLES::$AREA, $locality );
			$data ['status'] = 1;
			$data ['msg'] = "Updated successfully";
			return $data;
		} else {
			$errors ['name'] = "Locality name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	/**
	 *
	 * change the status of locality from 1 to 0
	 * 
	 * @access public
	 * @param $id of
	 *        	locality
	 *        	
	 */
	public function turnOffLocality($id) {
		$locality ['status'] = 0;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$AREA, $locality );
	}
	
	/**
	 *
	 * change the status of locality from 0 to 1
	 * 
	 * @access public
	 * @param $id of locality
	 *        	
	 */
	public function turnOnLocality($id) {
		$locality ['status'] = 1;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$AREA, $locality );
	}
	
	/**
	 *
	 * get locality name, latitude, longitude and zone_id of zone by id
	 * 
	 * @param locality id
	 * @access public
	 * @return result_set
	 */
	public function getLocalityById($id) {
		$this->db->select ( '*' )->from ( TABLES::$AREA )->where ( 'id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getLocationByCityAndName($cityid,$location) {
		$this->db->select ('a.id,a.name,a.cityid,b.name as cityname')->from ( TABLES::$AREA.' AS a' );
		$this->db->join(TABLES::$CITY.' AS b','a.cityid=b.id','inner');
		$this->db->where ( 'a.cityid', $cityid );
		$this->db->where ( 'a.status', 1 );
		$this->db->like ( 'a.name', $location,'both' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	/**
	 * get all the localities.
	 * 
	 * @param no param
	 * @access public
	 * @return array_list
	 */
	
	public function checkLocalitiesbyPincode($pincode) {
		$this->db->select ( '*' )->from ( TABLES::$AREA )->order_by ( 'name', 'asc' );
		$this->db->where ( 'pincode', $pincode );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAllLocalities() {
		$this->db->select ( '*' )->from ( TABLES::$AREA )->order_by ( 'name', 'asc' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveLocalities() {
		$this->db->select ( '*' )->from ( TABLES::$AREA )->where('status',1)->order_by ( 'name', 'asc' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAreasByCityId($cityid) {
		$this->db->select ( 'a.*,b.name as cityname' )
			 ->from ( TABLES::$AREA.' AS a' )
			 ->join ( TABLES::$CITY.' AS b','a.cityid=b.id','left')
			 ->order_by ( 'a.name', 'asc' );
		$this->db->where ( 'a.cityid', $cityid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	public function saveContactUs($params) {
		return $this->db->insert ( TABLES::$CONTACT_US, $params );
	}
	
	public function addFeedback($params) {
		return $this->db->insert ( TABLES::$FEEDBACK, $params );
	}
	
	public function getFeedbacks() {
		$this->db->select ( '*' )
				 ->from ( TABLES::$FEEDBACK )
				 ->order_by ( 'created_date', 'DESC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addStore($store) {
		$params = array (
				'name' => $store ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$STORE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$STORE, $store );
			$id = $this->db->insert_id();
			$data ['status'] = 1;
			$data ['id'] = $id;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$errors ['name'] = "Store name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	/**
	 *
	 * update store name
	 *
	 * @param store object
	 * @access public
	 * @throws Exception
	 */
	public function updateStore($store) {
		$data = array ();
		$params = array (
				'name' => $store ['name'],
				'id !=' => $store ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$STORE )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $store ['id'] );
			$this->db->update ( TABLES::$STORE, $store );
			$data ['status'] = 1;
			$data ['msg'] = "Updated successfully";
			return $data;
		} else {
			$errors ['name'] = "Store name already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	/**
	 *
	 * change the status of store from 1 to 0
	 *
	 * @access public
	 * @param $id of
	 *        	locality
	 *
	 */
	public function turnOffStore($id) {
		$store ['status'] = 0;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$STORE, $store );
	}
	
	/**
	 *
	 * change the status of store from 0 to 1
	 *
	 * @access public
	 * @param $id of store
	 *
	 */
	public function turnOnStore($id) {
		$store ['status'] = 1;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$STORE, $store );
	}
	
	/**
	 *
	 * get store name by id
	 *
	 * @param store id
	 * @access public
	 * @return result_set
	 */
	public function getStoreById($id) {
		$this->db->select ( 'a.*,GROUP_CONCAT(c.id) as areaids' )->from ( TABLES::$STORE.' AS a',FALSE)
				 ->join(TABLES::$STORE_AREA.' AS b','a.id=b.store_id','inner')
				 ->join(TABLES::$AREA.' AS c','b.areaid=c.id','inner')
				 ->where ( 'a.id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAllStores() {
		$this->db->select ( 'a.*,GROUP_CONCAT(c.name) as areas' )->from ( TABLES::$STORE.' AS a',FALSE)
				 ->join(TABLES::$STORE_AREA.' AS b','a.id=b.store_id','inner')
				 ->join(TABLES::$AREA.' AS c','b.areaid=c.id','inner')
				 ->group_by('a.id')
				 ->order_by ( 'a.name', 'asc' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addStoreArea($params) {
		$this->db->where('store_id',$params[0]['store_id']);
		$this->db->delete(TABLES::$STORE_AREA);
		$this->db->insert_batch ( TABLES::$STORE_AREA, $params );
	}
	
	public function getStoreAreasByStoreId($store_id) {
		$this->db->select ( '*' )->from ( TABLES::$STORE_AREA )->where ( 'store_id', $store_id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAvailableAreas($store_id) {
		$this->db->select ( 'areaid' )->from ( TABLES::$STORE_AREA );
		if(!empty($store_id)) {
			$this->db->where('store_id !=',$store_id);
		}
		$query = $this->db->get ();
		$aresult = $query->result_array ();
		$areas = array();
		foreach ($aresult as $value) {
			$areas[] = $value['areaid'];
		}
		$this->db->select ( '*' )->from ( TABLES::$AREA );
		if(count($areas) > 0)
		$this->db->where_not_in ( 'id', $areas );
		$this->db->order_by ( 'name', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addExecutive($params) {
		$this->db->insert ( TABLES::$FIELD_EXECUTIVE, $params );
		return $this->db->insert_id();
	}
	
	public function updateExecutive($params) {
		$this->db->where ( 'id', $params ['id'] );
		return $this->db->update ( TABLES::$FIELD_EXECUTIVE, $params );
	}
	
	public function getFieldExecutives() {
		$this->db->select ( '*' )->from ( TABLES::$FIELD_EXECUTIVE )->order_by ( 'name', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getFieldExecutivesByStoreId($store_id) {
		$this->db->select ( 'a.*,b.name as store_name' )->from ( TABLES::$FIELD_EXECUTIVE.' AS a' )
				 ->join(TABLES::$STORE.' AS b','a.store_id=b.id','left')
				 ->where('a.store_id',$store_id)
				 ->order_by ( 'a.name', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveFieldExecutives() {
		$this->db->select ( '*' )->from ( TABLES::$FIELD_EXECUTIVE )->where('status',1)->order_by ( 'name', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getExecutiveById($id) {
		$this->db->select ( 'a.*,b.name as store_name' )->from ( TABLES::$FIELD_EXECUTIVE.' AS a' )
				 ->join(TABLES::$STORE.' AS b','a.store_id=b.id','left')
				 ->where('a.id',$id)
				 ->order_by ( 'a.name', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	/*
	public function addPickupSlot($params) {
		return $this->db->insert ( TABLES::$PICKUP_SLOTS, $params );
	}
	
	public function updatePickupSlot($params) {
		$this->db->where ( 'id', $params ['id'] );
		return $this->db->update ( TABLES::$PICKUP_SLOTS, $params );
	}
	
	public function getPickupSlots() {
		$this->db->select ( '*' )->from ( TABLES::$PICKUP_SLOTS )->order_by ( 'id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActivePickupSlots() {
		$this->db->select ( '*' )->from ( TABLES::$PICKUP_SLOTS )->where('status',1)->order_by ( 'id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getPickupSlotById($id) {
		$this->db->select ( '*' )->from ( TABLES::$PICKUP_SLOTS )
				 ->where('id',$id)
				 ->order_by ( 'slot', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addDeliverySlot($params) {
		return $this->db->insert ( TABLES::$DELIVERY_SLOTS, $params );
	}
	
	public function updateDeliverySlot($params) {
		$this->db->where ( 'id', $params ['id'] );
		return $this->db->update ( TABLES::$DELIVERY_SLOTS, $params );
	}
	
	public function getDeliverySlots() {
		$this->db->select ( '*' )->from ( TABLES::$DELIVERY_SLOTS )->order_by ( 'id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveDeliverySlots() {
		$this->db->select ( '*' )->from ( TABLES::$DELIVERY_SLOTS )->where('status',1)->order_by ( 'id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getDeliverySlotById($id) {
		$this->db->select ( '*' )->from ( TABLES::$DELIVERY_SLOTS )
				 ->where('id',$id)
				 ->order_by ( 'slot', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}*/
	
	public function getClothPrices() {
		$this->db->select ( '*' )->from ( TABLES::$CLOTHPRICE );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addCoupon($coupon) {
		$this->db->insert(TABLES::$COUPON_CODE,$coupon);
		return $this->db->insert_id();
	}
	
	public function updateCoupon($coupon) {
		$this->db->where('id',$coupon['id']);
		return $this->db->update(TABLES::$COUPON_CODE,$coupon);
	}
	
	public function getAllCoupons() {
		$this->db->select ( '*' )->from ( TABLES::$COUPON_CODE )
				 ->order_by ( 'start_date', 'DESC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveCoupons() {
		$current_date = date('Y-m-d');
		$this->db->select ( '*' )->from ( TABLES::$COUPON_CODE )
				 ->where("'".$current_date."' BETWEEN start_date AND end_date",'',false)
				 ->where('status',1)
				 ->order_by ( 'start_date', 'DESC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getCouponById($id) {
		$this->db->select ( '*' )->from ( TABLES::$TBL_COUPON )
				 ->where('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getCouponByCode($data) {
		//echo "<pre>" ; print_r($data); exit();
		$this->db->select ( 'a.*,b.name' )->from ( TABLES::$TBL_COUPON.' AS a' )
				 ->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS b','a.subcategory_id=b.id','left')
				 ->where('a.coupon_code',$data['coupon_code']);
		$this->db->where("'".$data['order_date']."' BETWEEN start_date and end_date",'',false);
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addTicket($params) {
		$this->db->insert ( TABLES::$TICKET, $params );
		return $this->db->insert_id();
	}
	
	public function addComment($params) {
		$this->db->insert ( TABLES::$TICKET_COMMENT, $params );
		$data ['status'] = 1;
       // $data ['msg'] = "Added successfully";
        return $data;
	}
	
	function updateLead($data) {
		$this->db->where('ticketid', $data['ticketid']);
		$this->db->update ( TABLES::$TICKET, $data);
		$result =array();
		if ($this->db->affected_rows() > 0)
		{
			$result['status'] = 1;
			$result['msg'] = 'Record updated successfully.';
				
		}
		else
		{
			$result['status'] = 0;
			$result['msg'] = 'Please try again.';
		}
		return $result;
	}
	
	public function updateTicket($params) {
		$this->db->where('ticketid',$params['ticketid']);
		return $this->db->update(TABLES::$TICKET,$params);
	}
	
	public function getAllTickets() {
		$this->db->select ( '*' )->from ( TABLES::$TICKET )
				 ->order_by('status','ASC')
				 ->order_by('priority','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAllActiveTickets() {
		$this->db->select ( "a.*,b.name,b.mobile,b.email,concat(d.first_name,' ',d.last_name) as created_by_name,e.name as status,f.name as assigned_to_name" );
		$this->db->from ( TABLES::$TICKET.' AS a' );
		$this->db->join ( TABLES::$USER.' AS b','a.userid=b.id','inner' );
		$this->db->join ( TABLES::$ADMIN_USER.' AS c','a.assigned_to=c.id','left' );
		$this->db->join ( TABLES::$ADMIN_USER.' AS d','a.created_by=d.id','left' );
		$this->db->join ( TABLES::$STATUS.' AS e','a.status_id=e.id','left' );
		$this->db->join ( TABLES::$EMPLOYEE.' AS f','a.assigned_to=f.id','left' );
		$this->db->order_by('a.created_date','DESC');
		$this->db->order_by('a.priority','DESC');
	//	$this->db->order_by('a.status','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getTicketById($ticketid) {
		$this->db->select ( "a.*,b.name,b.mobile,b.email as email1,concat(c.first_name,' ',c.last_name) as assigned_to_name,concat(d.first_name,' ',d.last_name) as created_by_name" );
		$this->db->from ( TABLES::$TICKET.' AS a' );
		$this->db->join ( TABLES::$USER.' AS b','a.userid=b.id','inner' );
		$this->db->join ( TABLES::$ADMIN_USER.' AS c','a.assigned_to=c.id','left' );
		$this->db->join ( TABLES::$ADMIN_USER.' AS d','a.created_by=d.id','left' );
		$this->db->where('a.ticketid',$ticketid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getUserComment($ticketid) {
		$this->db->select ( "a.*" );
		$this->db->from ( TABLES::$TICKET_COMMENT.' AS a' );
		$this->db->where('a.ticketid',$ticketid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addReason($reason) {
		$params = array (
				'name' => $reason ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$CANCEL_REASON )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$CANCEL_REASON, $reason );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$this->db->where ( 'id', $result[0] ['id'] );
			$this->db->update ( TABLES::$CANCEL_REASON, $reason );
			$errors ['name'] = "Reason already exists.";
			$data ['status'] = 1;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	public function updateReason($reason) {
		$data = array ();
		$params = array (
				'name' => $reason ['name'],
				'id !=' => $reason ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$CANCEL_REASON )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $reason ['id'] );
			$this->db->update ( TABLES::$CANCEL_REASON, $reason );
			$data ['status'] = 1;
			$data ['msg'] = "Updated successfully";
			return $data;
		} else {
			$errors ['name'] = "Reason already exists.";
			$data ['status'] = 0;
			$data ['msg'] = $errors;
			return $data;
		}
	}
	
	public function deleteReason($id) {
		$map['status'] = 0;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$CANCEL_REASON , $map);
	}
	
	public function getActiveReasons(){
		$this->db->select ('*')->from ( TABLES::$CANCEL_REASON )->where ('status',1);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getReasonById($id){
		$this->db->select ('*')->from ( TABLES::$CANCEL_REASON )->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addNotification($params) {
		$this->db->insert ( TABLES::$NOTIFICATION, $params );
		return $this->db->insert_id();
	}
	
	public function updateNotification($params) {
		$this->db->where('id',$params['id']);
		return $this->db->update(TABLES::$NOTIFICATION,$params);
	}
	
	public function getActiveNotifications() {
		$this->db->select ( "a.*,concat(b.first_name,' ',b.last_name) as assigned_to_name" );
		$this->db->from ( TABLES::$NOTIFICATION.' AS a' );
		$this->db->join ( TABLES::$ADMIN_USER.' AS b','a.assigned_to=b.id','left' );
		$this->db->order_by('a.created_date','DESC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getNotificationById($id) {
		$this->db->select ( "a.*,concat(b.first_name,' ',b.last_name) as assigned_to_name" );
		$this->db->from ( TABLES::$NOTIFICATION.' AS a' );
		$this->db->join ( TABLES::$ADMIN_USER.' AS b','a.assigned_to=b.id','left' );
		$this->db->where('a.id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function checkServiceArea($params) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$SERVICEAREA );
		$this->db->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return ($result);
	}
	function getredeemconfig()
	{
		$this->db->select ('*');
		$this->db->from ('redeem_offer_config');
		$query = $this->db->get ();
		$result = $query->row_array ();
		return $result;
	}
	public function updatepoint($data) {
		$this->db->update ('redeem_offer_config',$data);

		if($this->db->affected_rows() > 0){
			return true;
		}
	}
	public function addSubscription($params) {
		$data = array ();
		 
		$this->db->insert ('tbl_subscription', $params );
		$data ['status'] = 1;
		$data ['msg'] = "Subscription Added successfully";
		return $data;
		 
	}
	public function getsubscriptionList(){
		$this->db->select ('*');
		$this->db->from ( 'tbl_subscription' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}

}