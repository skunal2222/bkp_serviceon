<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	public function getMenuRestaurants($map) {
		$this->db->select('a.*,b.name as area_name,a.delivery_type')->from(TABLES::$RESTAURANT.' AS a');
		$this->db->join(TABLES::$AREA.' AS b','a.areaid=b.id','inner');
		//$this->db->join(TABLES::$RESTAURANT_CONFIG.' AS c','a.id=c.restid','left');
		if(isset($map['areaid']) && $map['areaid'] != "") {
			$this->db->where('a.areaid',$map['areaid']);
		}
		if(isset($map['status']) && $map['status'] != "") {
			$this->db->where('a.status',$map['status']);
		}
		if(isset($map['name']) && $map['name'] != "") {
			$this->db->like('a.name',$map['name'],'both');
		}
		if(isset($map['id']) && $map['id'] != "") {
			$this->db->where('a.id',$map['id']);
		}
		
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function addMainCategory( $map ) {
		$this->db->insert(TABLES::$MENU_MAIN_CATEGORY,$map);
		return $this->db->insert_id();
	}
	
	function addProduct( $map ) {
		$this->db->insert(TABLES::$PRODUCT,$map);
		//echo $this->db->last_query();
		return $this->db->insert_id();
	}
	
	function addcatofsubcat( $map ) {
		$this->db->insert(TABLES::$CATEGORY_SUBCATEGORY,$map);
		//echo $this->db->last_query();
		return $this->db->insert_id();
	}
	
	function addSpare( $map ) {
		$this->db->insert(TABLES::$SPARE,$map);
		//echo $this->db->last_query();
		return $this->db->insert_id();
	}
	
	function addService( $map ) {
		$this->db->insert(TABLES::$SERVICE,$map);
		//echo $this->db->last_query();
		return $this->db->insert_id();
	}
	
	function addProductcustom( $map ) {
		$this->db->insert(TABLES::$PRODUCT_CUSTOM_MAIN,$map);
		//echo $this->db->last_query();
		return $this->db->insert_id();
	}
	
	function updateProductcustom( $map ) {
		$this->db->where('product_id',$map['product_id']);
		$this->db->update(TABLES::$PRODUCT_CUSTOM_MAIN,$map);
	}
	
	function addCustom( $map ) {
		$this->db->insert(TABLES::$PRODUCT_CUSTOM_VALUE,$map);
		//echo $this->db->last_query();
		return $this->db->insert_id();
	}
	
	function updateCustom( $map ) {
		$this->db->where('product_id',$map['product_id']);
		$this->db->update(TABLES::$PRODUCT_CUSTOM_VALUE,$map);
	}
	
	// function addCategory( $map ) {
		// $this->db->insert(TABLES::$MENU_CATEGORY,$map);
		// return $this->db->insert_id();
	// }
	
	function addMainCategories( $map ) {
		$this->db->insert_batch(TABLES::$MENU_MAIN_CATEGORY,$map);
	}
	
	function addCategories( $map ) {
		$this->db->insert_batch(TABLES::$MENU_CATEGORY,$map);
	}
	
	function updateMenu( $map ) {
		$this->db->where('menu_id',$map['menu_id']);
		$this->db->update(TABLES::$TK_MENU,$map);
	}
	
	function updateMainCategories( $map ) {
		$this->db->update_batch(TABLES::$MENU_MAIN_CATEGORY,$map,'id');
	}
	
	function updateCategories( $map ) {
		$this->db->update_batch(TABLES::$MENU_CATEGORY,$map,'id');
	}
	function updateMenuCat($map){
		$menu = array('id'=>$map['id']);
		$this->db->where($menu);
		$this->db->update(TABLES::$MENU_CATEGORY, $map);
	  
	}
	function updateMainMenuCat($map){
		 
		$menu = array('id'=>$map['id']);
		$this->db->where($menu);
		$this->db->update(TABLES::$MENU_MAIN_CATEGORY, $map);
		 
	}
	function updateMenuImage($map){
		
		$menu = array('id'=>$map['id']);
		$this->db->where($menu);
		$this->db->update(TABLES::$MENU_CATEGORY, $map);
			
	}
	function updateMenuSortOrder($map){
		 
		$menu = array('id'=>$map['id']);
		$data= array('sortorder'=>$map['sortorder']);
		$this->db->where($menu);
		$this->db->update(TABLES::$MENU_CATEGORY, $data);
		 
	}
	function updateMainMenuSortOrder($map){
			
		$menu = array('id'=>$map['id']);
		$data= array('sortorder'=>$map['sortorder']);
		$this->db->where($menu);
		$this->db->update(TABLES::$MENU_MAIN_CATEGORY, $data);
			
	}
	
	function addMenuToStorage( $batch ) {
		$this->db->insert_batch(TABLES::$MENU_STORAGE, $batch);
	}
	
	function purgeMenuFromStorage( $restid ) {
		$this->db->where('restid',$restid);
		$this->db->delete(TABLES::$MENU_STORAGE);
	}
	
	function getMainCategories( $menu_id ) {
		$this->db->select('DISTINCT id as mcatid,name,menu_id,sortorder,image,description',FALSE)
				 ->from(TABLES::$MENU_MAIN_CATEGORY)
				 ->where('menu_id',$menu_id);
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getCategories( $menu_id ) {
		$this->db->select('DISTINCT a.id,a.sortorder,a.menu_mcat_id,a.image,a.description,a.name',FALSE)
				 ->from(TABLES::$MENU_CATEGORY.' AS a')
				 ->join(TABLES::$MENU_MAIN_CATEGORY.' AS b','a.menu_mcat_id = b.id')
				 ->where('b.menu_id',$menu_id);
		$this->db->order_by('a.sortorder','ASC');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getMainCategoriesForNewRestaurant( $map ) {
		$this->db->select('a.id,a.description,a.image,a.name,a.menu_id')
				 ->from(TABLES::$MENU_MAIN_CATEGORY.' AS a')
				 ->join(TABLES::$MENU_CATEGORY.' AS b','a.id = b.menu_mcat_id')
				 ->where('a.restid',$map['restid']);
		$this->db->group_by('a.id');
		$this->db->order_by('a.sortorder','ASC');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;	
	} 
	
	function getMainCategoriesByName( $map ) {
		$this->db->select('a.id,a.description,a.image,a.name,a.menu_id,a.sortorder')
				->from(TABLES::$MENU_MAIN_CATEGORY.' AS a')
				->join(TABLES::$MENU_CATEGORY.' AS b','a.id = b.menu_mcat_id')
				->join(TABLES::$MENU_ITEM.' AS c','b.id = c.menu_cat_id')
				->where('c.restid',$map['restid'])
				->where('a.name',$map['name']);	
		$this->db->group_by('b.id');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getCategoriesByName( $map ) {
		$this->db->select('b.id,b.description,b.image,b.name')
				->from(TABLES::$MENU_MAIN_CATEGORY.' AS a')
				->join(TABLES::$MENU_CATEGORY.' AS b','a.id = b.menu_mcat_id')
				->where('a.restid',$map['restid'])
				->where('b.name',$map['name'])
				->where('a.name',$map['mcatname']);
		$this->db->group_by('b.id');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getCategoriesForNewRestaurant( $map ) {
		$this->db->select('b.id,b.description,b.image,b.name,b.menu_mcat_id')
				->from(TABLES::$MENU_MAIN_CATEGORY.' AS a')
				->join(TABLES::$MENU_CATEGORY.' AS b','a.id = b.menu_mcat_id')
				->where('a.restid',$map['restid']);
		$this->db->group_by('b.id');
		$this->db->order_by('b.sortorder','ASC');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;	
	}
	
	function getMainCategoriesForRestaurant( $map ) {
		$this->db->select('a.id,a.description,a.image,a.sortorder,a.name')
				->from(TABLES::$MENU_MAIN_CATEGORY.' AS a')
				->join(TABLES::$MENU_CATEGORY.' AS b','a.id = b.menu_mcat_id')
				->join(TABLES::$MENU_ITEM.' AS c','b.id = c.menu_cat_id')
				->where('c.restid',$map['restid']);
		if(!empty($map['name']))
			$this->db->like('a.name',$map['name'],'after');
		$this->db->group_by('a.id');
		$this->db->order_by('a.sortorder','ASC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;	
	}
	
	function getCategoriesForRestaurant( $map ) {
		$this->db->select('a.id,a.description,a.sortorder,a.image,a.name,a.menu_mcat_id')
				->from(TABLES::$MENU_CATEGORY.' AS a')
				->join(TABLES::$MENU_ITEM.' AS b','a.id = b.menu_cat_id')
				->where('b.restid',$map['restid']);
		$this->db->group_by('a.id');
		$this->db->order_by('a.sortorder','ASC');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;	
	}
	
	public function getNewMainCategoriesForMenu( $map ) {
		$this->db->select('a.id,a.description,a.image,a.sortorder,a.name,a.menu_id')
				->from(TABLES::$MENU_MAIN_CATEGORY.' AS a')
				->join(TABLES::$MENU_CATEGORY.' AS b','a.id = b.menu_mcat_id')
				->join(TABLES::$MENU_ITEM.' AS c','b.id = c.menu_cat_id')
				->join(TABLES::$MENU_ITEM_PRICE.' AS d','c.id = d.itemid')
				->where('c.restid',$map['restid'])
				->where('d.end_date IS NULL','',FALSE);
		$compiled_query1 = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('a.id,a.description,a.image,a.sortorder,a.name,a.menu_id')
				->from(TABLES::$MENU_MAIN_CATEGORY.' AS a')
				->join(TABLES::$MENU_CATEGORY.' AS b','a.id = b.menu_mcat_id')
				->join(TABLES::$MENU_ITEM.' AS c','b.id = c.menu_cat_id')
				->join(TABLES::$MENU_ITEM_PRICE.' AS d','c.id = d.itemid')
				->where('c.restid',$map['restid'])
				->where('d.end_date >= "'.date('Y-m-d').'"','',FALSE);
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		$compiled_query = $compiled_query1.' UNION '.$compiled_query2;
		$query = $this->db->query($compiled_query);
		$result = $query->result_array();
		return $result;
	}
	
	public function getNewCategoriesForMenu( $map ) {
		$this->db->select('a.id,a.description,a.sortorder,a.image,a.name,a.menu_mcat_id')
				->from(TABLES::$MENU_CATEGORY.' AS a')
				->join(TABLES::$MENU_ITEM.' AS b','a.id = b.menu_cat_id')
				->join(TABLES::$MENU_ITEM_PRICE.' AS c','b.id = c.itemid')
				->where('b.restid',$map['restid'])
				->where('c.end_date IS NULL','',FALSE);
		$compiled_query1 = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('a.id,a.description,a.sortorder,a.image,a.name,a.menu_mcat_id')
				->from(TABLES::$MENU_CATEGORY.' AS a')
				->join(TABLES::$MENU_ITEM.' AS b','a.id = b.menu_cat_id')
				->join(TABLES::$MENU_ITEM_PRICE.' AS c','b.id = c.itemid')
				->where('b.restid',$map['restid'])
				->where('c.end_date >= "'.date('Y-m-d').'"','',FALSE);
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		$compiled_query = $compiled_query1.' UNION '.$compiled_query2;
		$query = $this->db->query($compiled_query);
		$result = $query->result_array();
		return $result;
	}

	
}