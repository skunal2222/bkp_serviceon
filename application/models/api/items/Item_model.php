<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Item_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	function addItem($item) {
		$data = array ();
		$params = array (
				'name' => $item ['name'],
				'cat_id' => $item['cat_id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$ITEM )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$ITEM, $item );
			$data ['status'] = 1;
			$data ['id'] = $this->db->insert_id ();
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Item name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	function addRate($rate) {
		$data = array ();
		$params = array (
				'ratecard_name' => $rate ['ratecard_name'],
				'cat_id' => $rate['cat_id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$RATECARD_PROD )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			foreach($rate as $row){
			$catvalue['cat_id'] = $row['cat_id'];
			$catvalue['ratecard_name'] = $row['ratecard_name'];
			$catvalue['product_name'] = $row['product_name'];
			$catvalue['product_id'] = $row['product_id'];
			$catvalue['product_price'] = $row['product_price'];
			$catvalue['price'] = $row['price'];
			$catvalue['status'] = $row['status'];
			$catvalue['created_on'] = $row['created_on'];
			$this->db->insert ( TABLES::$RATECARD_PROD, $catvalue);
	
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
		 }
		 return $data;
		} else {
			$data ['msg'] = "Ratecard name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	function addVendor($vendor) {
		$data = array ();
		$params = array (
				'vendor_name' => $vendor ['vendor_name'],
				'cat_id' => $vendor['cat_id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$VENDOR )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$VENDOR, $vendor );
			$data ['status'] = 1;
			$data ['id'] = $this->db->insert_id ();
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Vendor name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function updateItem($item) {
		$data = array ();
		/*$params = array (
				'name' => $item ['name'],
				'cat_id' => $item['cat_id'],
				'id !=' => $item ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$ITEM )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {*/
			$this->db->where ( 'id', $item ['id'] );
			$this->db->update ( TABLES::$ITEM, $item );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		/*} else {
			$data ['msg'] = "Item name already exists.";
			$data ['status'] = 0;
			return $data;
		}*/
	}
	
		public function rateUpdate($item) {
		$data = array ();
		
			$this->db->where ( 'id', $item ['id'] );
			$this->db->update ( TABLES::$RATECARD_PROD, $item );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		
	}
	
		public function vendorUpdate($item) {
		$data = array ();
		
			$this->db->where ( 'id', $item ['id'] );
			$this->db->update ( TABLES::$VENDOR, $item );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		
	}
	
	public function turnOffItem($id) {
		$item ['status'] = 0;
		$this->db->where ( 'id', $id );
		return $this->db->update ( TABLES::$ITEM, $item );
	}
	
	public function turnOnItem($id) {
		$item ['status'] = 1;
		$this->db->where ( 'id', $id );
		return $this->db->update ( TABLES::$ITEM, $item );
	}
	
	public function getItemByCatId($cat_id) {
		$this->db->select ( 'a.*,b.name as category' )
				 ->from ( TABLES::$ITEM.' AS a' )
				 ->join ( TABLES::$ITEM_CATEGORY.' AS b', 'a.cat_id=b.id','inner' )
		         ->where ( 'a.cat_id', $cat_id );
		$this->db->order_by ('a.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	

	public function getRateByCatId($cat_id) {
		$this->db->select ( 'a.*,b.name as category')
				 ->from ( TABLES::$RATECARD_PROD.' AS a' )
				 ->join ( TABLES::$ITEM_CATEGORY.' AS b', 'a.cat_id=b.id','inner' )
		         ->where ( 'a.cat_id', $cat_id );
		$this->db->order_by ('a.ratecard_name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getVendorByCatId($cat_id) {
		$this->db->select ( 'a.*,b.name as category')
				 ->from ( TABLES::$VENDOR.' AS a' )
				 ->join ( TABLES::$ITEM_CATEGORY.' AS b', 'a.cat_id=b.id','inner' )
		         ->where ( 'a.cat_id', $cat_id );
		$this->db->order_by ('a.vendor_name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getRateId($rate_id) {
		$this->db->select ( 'a.*,b.name as category')
				 ->from ( TABLES::$RATECARD_PROD.' AS a' )
				 ->join ( TABLES::$ITEM_CATEGORY.' AS b', 'a.cat_id=b.id','inner' )
		         ->where ( 'a.id', $rate_id );
		$this->db->order_by ('a.ratecard_name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getDetailsByName($name) {
		$this->db->select ( 'a.*')
				 ->from ( TABLES::$RATECARD_PROD.' AS a' )
				 ->where ( 'a.ratecard_name', $name );
		$this->db->order_by ('a.ratecard_name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getVendorId($vendor_id) {
		$this->db->select ( 'a.*,b.name as category')
				 ->from ( TABLES::$VENDOR.' AS a' )
				 ->join ( TABLES::$ITEM_CATEGORY.' AS b', 'a.cat_id=b.id','inner' )
		         ->where ( 'a.id', $vendor_id );
		$this->db->order_by ('a.vendor_name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	
	public function getRatelist() {
		//$this->db->select ( '*' )->from ( TABLES::$RATECARD_PROD );
		$this->db->select ( 'a.*,b.name as category')
				 ->from ( TABLES::$RATECARD_PROD.' AS a' )
				 ->join ( TABLES::$ITEM_CATEGORY.' AS b', 'a.cat_id=b.id','inner' )
	             ->where ('a.status',1);
		$this->db->order_by ('a.id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getVendorlist() {
		//$this->db->select ( '*' )->from ( TABLES::$RATECARD_PROD );
		$this->db->select ( 'a.*,b.name as category')
				 ->from ( TABLES::$VENDOR.' AS a' )
				 ->join ( TABLES::$ITEM_CATEGORY.' AS b', 'a.cat_id=b.id','inner' )
	             ->where ('a.status',1);
		$this->db->order_by ('a.id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$ITEM_CATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$ITEM_CATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Category name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function addRatecard($rate) {
		$data = array ();
		$params = array (
				'name' => $rate ['name']
		);
		$this->db->select ( 'id' )->from ( TABLES::$RATECARD )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$RATECARD, $rate );
			$data ['status'] = 1;
			$data ['msg'] = "Added successfully";
			return $data;
		} else {
			$data ['msg'] = "Ratecard name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function updateCategory($cat) {
		$data = array ();
		$params = array (
				'name' => $cat ['name'],
				'id !=' => $cat ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$ITEM_CATEGORY )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $cat ['id'] );
			$this->db->update ( TABLES::$ITEM_CATEGORY, $cat );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Category name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function updateRatecard($rate) {
		$data = array ();
		$params = array (
				'name' => $rate ['name'],
				'id !=' => $rate ['id']
		);
		$this->db->select ( 'id' )->from ( TABLES::$RATECARD )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->where ( 'id', $rate ['id'] );
			$this->db->update ( TABLES::$RATECARD, $rate );
			$data ['status'] = 1;
			$data ['msg'] = "updated successfully";
			return $data;
		} else {
			$data ['msg'] = "Ratecard name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	
	public function getActiveCategories() {
		$this->db->select ( '*' )->from ( TABLES::$ITEM_CATEGORY );
		$this->db->where ('status',1);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveProducts($cat_id) {
		$this->db->select ( '*' )->from ( TABLES::$ITEM );
		$this->db->where ('cat_id',$cat_id);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	

	
	public function getActiveRatecard() {
		$this->db->select ( '*' )->from ( TABLES::$RATECARD_PROD );
		$this->db->where ('status',1);
	    $this->db->group_by('ratecard_name'); 
		$this->db->order_by ('ratecard_name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveVendor() {
		$this->db->select ( '*' )->from ( TABLES::$VENDOR );
		$this->db->where ('status',1);
		$this->db->order_by ('vendor_name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveRatecard1() {
		$this->db->select ( '*' )->from ( TABLES::$RATECARD );
		$this->db->where ('status',1);
		$this->db->order_by ('name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	
	
	public function getCategoryById($id) {
		$this->db->select ( '*' )->from ( TABLES::$ITEM_CATEGORY );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getRatecardById($id) {
		$this->db->select ( '*' )->from ( TABLES::$RATECARD );
		$this->db->where ('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	/*public function getItemById($itemid) {
		$this->db->select ( '*' )->from ( TABLES::$ITEM );
		$this->db->where ('id',$itemid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	} */
	
	public function getItemById($id,$type,$cat,$brand,$model,$subcat) {
	     	//echo "inside if";
	     	if($type==1)
	     	{
			$this->db->select ( '*' )->from ( TABLES::$SERVICE);
			$this->db->where ('id',$id);
			$this->db->where ('category_id',$cat);
			$this->db->where ('brand_id',$brand);
			$this->db->where ('model_id',$model);
			$this->db->where ('subcategory_id',$subcat);
			$query = $this->db->get ();
			//echo $this->db->last_query();
			$result = $query->result_array ();
	     	}
	     	else 
	     	{
	     		$this->db->select ( '*' )->from ( TABLES::$SPARE);
	     		$this->db->where ('id',$id);
	     		$this->db->where ('category_id',$cat);
	     		$this->db->where ('brand_id',$brand);
	     		$this->db->where ('model_id',$model);
	     		$this->db->where ('subcategory_id',$subcat);
	     		$query = $this->db->get ();
	     		//echo $this->db->last_query();
	     		$result = $query->result_array ();
	     	}
	     //	exit;
			return $result;
	
	}
	
	public function getRateById($itemid) {
		$this->db->select ( '*' )->from ( TABLES::$RATECARD_PROD );
		$this->db->where ('id',$itemid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getVendorById($itemid) {
		$this->db->select ( '*' )->from ( TABLES::$VENDOR );
		$this->db->where ('id',$itemid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveItemsByCatId($cat_id) {
		$this->db->select ( 'a.*,b.name as category' )
				 ->from ( TABLES::$ITEM.' AS a' )
				 ->join ( TABLES::$ITEM_CATEGORY.' AS b', 'a.cat_id=b.id','inner' )
				 ->where ( 'a.cat_id', $cat_id );
		$this->db->where ('a.status',1);
		$this->db->order_by ('a.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getActiveItems() {
		$this->db->select ( 'a.*,b.name as category' )
				 ->from ( TABLES::$ITEM.' AS a' )
				 ->join ( TABLES::$ITEM_CATEGORY.' AS b', 'a.cat_id=b.id','inner' );
		$this->db->where ('a.status',1);
		$this->db->order_by ('a.id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function searchItemName($params) {
	
	/*	$this->db->select ( 'a.id,a.product_name as name,a.cat_id' )
				 ->from ( TABLES::$RATECARD_PROD.' AS a' )
				->join ( TABLES::$RATECARD_PROD.' AS b', 'a.cat_id=b.cat_id','inner' );
		$this->db->like ( 'a.product_name',$params['name'],'both' );
	//	$this->db->where ('a.id',$params['id']);
	//	$this->db->where ('a.status',1);
		$this->db->order_by ('a.product_name','ASC');
		$this->db->group_by ('a.id','ASC');
		$query = $this->db->get ();
		//$this->db->last_query();
		$result = $query->result_array ();
		return $result; */
	if($params['type']==1)
		{
			//echo "if";
		$this->db->select ( '*' )
				 ->from ( TABLES::$SERVICE);
		$this->db->like ( 'name',$params['name'],'both' );
		$this->db->where ('category_id',$params['category_id']);
		$this->db->where ('brand_id',$params['brand_id']);
		$this->db->where ('model_id',$params['model_id']);
		$this->db->where ('subcategory_id',$params['subcategory_id']);
		$query = $this->db->get ();
		$result = $query->result_array ();
		//return $result;
		}
		else
		{
			//echo "else";
			$this->db->select ( '*' )
			->from ( TABLES::$SPARE);
			$this->db->like ( 'name',$params['name'],'both' );
			$this->db->where ('category_id',$params['category_id']);
			$this->db->where ('brand_id',$params['brand_id']);
			$this->db->where ('model_id',$params['model_id']);
			$this->db->where ('subcategory_id',$params['subcategory_id']);
			$query = $this->db->get ();
			$result = $query->result_array ();
			//return $result;
		}
	    //echo $this->db->last_query();
		//exit;
		return $result;
	}
	
	public function getItemCategory($item_id) {
		$this->db->select ( 'cat_id' )
				 ->from ( TABLES::$ITEM);
		$this->db->where ('id',$item_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
}