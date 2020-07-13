<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Options_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	
	function addItemOptionCategory( $map ) {
		$this->db->insert(TABLES::$MENU_OPTION_CATEGORY,$map);
		return $this->db->insert_id();
	}
	
	function updateItemOptionCategories( $map ) {
		$this->db->update_batch(TABLES::$MENU_OPTION_CATEGORY,$map,'option_cat_id');
	}
	
	function addItemOption( $map ) {
		$this->db->insert(TABLES::$MENU_OPTION,$map);
		return $this->db->insert_id();
	}
	
	function addItemOptionPrices( $map ) {
		$this->db->insert_batch(TABLES::$MENU_OPTION_PRICE,$map);
	}
	
	function updateItemOptions( $map ) {
		$this->db->update_batch(TABLES::$MENU_OPTION,$map,'sub_item_id');
	}
	
	function updateItemOptionPrices( $map ) {
		$this->db->update_batch(TABLES::$MENU_OPTION_PRICE,$map,'sub_item_id');
	}
	
	function deleteItemOptionPrices( $map ) {
		$this->db->where('sub_item_id IN ('.implode(',',$map).')','',FALSE);
		$this->db->delete(TABLES::$MENU_OPTION_PRICE);
	}
	
	function deleteItemOption( $map ) {
		$this->db->where('sub_item_id',$map['sub_item_id']);
		$this->db->delete(TABLES::$MENU_OPTION);
	}
	
	function deleteItemOptionCategory( $map ) {
		$this->db->where('new_sub_item_key',$map['sub_item_key']);
		$this->db->delete(TABLES::$MENU_OPTION_CATEGORY);
	}
	
	function deleteItemOptions( $map ) {
		$this->db->where('new_sub_item_key',$map['sub_item_key']);
		$this->db->delete(TABLES::$MENU_OPTION);
	}
	
	function deleteOptionCategoriesForItem( $option_id ) {
		$this->db->where('id',$option_id);
		$this->db->delete(TABLES::$MENU_OPTION_CATEGORY);
	}
	
	function deleteOptionsForItem( $itemid ) {
		$this->db->select('a.new_sub_item_key')
				 ->from(TABLES::$MENU_OPTION_CATEGORY.' AS a')
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.id')
				 ->where('b.itemid',$itemid);
		$query = $this->db->get();
		$result = $query->result_array();
		$this->db->_reset_select();
		$keys = ''; 
		foreach($result as $key=>$row)
		{
			$keys .= '"'.$row['new_sub_item_key'].'"'.',';
		}
		$keys = substr($keys, 0, strlen($keys)-1);
		$compiled_query = 'DELETE FROM '.TABLES::$MENU_OPTION.' where new_sub_item_key IN('.$keys.')';
		$query = $this->db->query($compiled_query);
	}
	
	function upgradeItems( $map ) {
		$this->db->update_batch(TABLES::$MENU_ITEM_PRICE,$map,'id');
	}
	
	function getItemOptionForCategory( $map ) {
		$this->db->select('sub_item_id')
				 ->from(TABLES::$MENU_OPTION)
				 ->where('new_sub_item_key',$map['sub_item_key']);
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getItemsForCategory( $map ) {
		$this->db->select('id')
			->from(TABLES::$MENU_OPTION_CATEGORY)
			->where('new_sub_item_key',$map['sub_item_key']);
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getOptionCategoriesForItem( $itemid ) {
		$this->db->select('a.option_cat_name,a.choice_type,a.optional_flag,a.min_options,a.max_options,a.status,a.description,a.new_sub_item_key,b.itemid')
				 ->from(TABLES::$MENU_OPTION_CATEGORY.' AS a')
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.id')
				 ->where('b.id',$itemid);
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getOptionCategoriesForItemPrice( $option_id ) {
		$this->db->select('a.option_cat_name,a.choice_type,a.optional_flag,a.sortorder,a.min_options,a.max_options,a.status,a.description,a.new_sub_item_key,b.itemid')
		->from(TABLES::$MENU_OPTION_CATEGORY.' AS a')
		->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.id')
		->where('b.id',$option_id);
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getOptionCategoriesForItems( $itemid ) {
		$this->db->select('a.option_cat_name,a.choice_type,a.optional_flag,a.min_options,a.max_options,a.status,a.description,a.new_sub_item_key,b.itemid')
				->from(TABLES::$MENU_OPTION_CATEGORY.' AS a')
				->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.id')
				->where('b.itemid IN ('.$itemid.')','',FALSE);
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getOptionsForItem( $itemid ) {
		$this->db->select('a.sub_item_id,b.sub_item_name,b.image,b.description,b.new_sub_item_key,a.price,a.is_default,a.size,a.start_date,a.end_date,a.start_time,a.end_time,a.calories,a.description as pdesc,a.posItemID,a.posSizeID')
				->from(TABLES::$MENU_OPTION_PRICE.' AS a')
				->join(TABLES::$MENU_OPTION.' AS b','a.sub_item_id = b.sub_item_id')
				->join(TABLES::$MENU_OPTION_CATEGORY.' AS c','b.new_sub_item_key = c.new_sub_item_key')
				->join(TABLES::$MENU_ITEM_PRICE.' AS d','c.id = d.id')
				->where('d.itemid',$itemid)
				->group_by('a.sub_item_id');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getOptionsForItemPrice( $option_id ) {
		$this->db->select('a.sub_item_id,a.sortorder,b.sub_item_name,b.image,b.description,b.new_sub_item_key,a.price,a.is_default,a.size,a.start_date,a.end_date,a.start_time,a.end_time,a.calories,a.description as pdesc,a.posItemID,a.posSizeID')
		->from(TABLES::$MENU_OPTION_PRICE.' AS a')
		->join(TABLES::$MENU_OPTION.' AS b','a.sub_item_id = b.sub_item_id')
		->join(TABLES::$MENU_OPTION_CATEGORY.' AS c','b.new_sub_item_key = c.new_sub_item_key')
		->join(TABLES::$MENU_ITEM_PRICE.' AS d','c.id = d.id')
		->where('d.id',$option_id)
		->group_by('a.sub_item_id');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getOptionsForItems( $itemid ) {
		$this->db->select('a.sub_item_id,b.sub_item_name,b.image,b.description,b.new_sub_item_key,a.price,a.is_default,a.size,a.start_date,a.end_date,a.start_time,a.end_time,a.calories,a.description as pdesc,a.posItemID,a.posSizeID')
				->from(TABLES::$MENU_OPTION_PRICE.' AS a')
				->join(TABLES::$MENU_OPTION.' AS b','a.sub_item_id = b.sub_item_id')
				->join(TABLES::$MENU_OPTION_CATEGORY.' AS c','b.new_sub_item_key = c.new_sub_item_key')
				->join(TABLES::$MENU_ITEM_PRICE.' AS d','c.id = d.id')
				->where('d.itemid IN ('.$itemid.')','',FALSE)
				->group_by('a.sub_item_id');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	/* Fetch a sample template for options*/
	function getItemOptionsForMenu( $map ) {
		$this->db->select('b.sub_item_id,b.sub_item_name,b.image,b.description,b.new_sub_item_key,a.price,a.status,a.is_required,a.is_default,a.sortorder,a.size,a.start_date,a.start_time,a.end_time,a.calories,a.posItemID,a.posSizeID')
				 ->from(TABLES::$MENU_OPTION_PRICE.' AS a')
				 ->join(TABLES::$MENU_OPTION.' AS b','a.sub_item_id = b.sub_item_id')
				 ->join(TABLES::$MENU_OPTION_CATEGORY.' AS c','b.new_sub_item_key = c.new_sub_item_key')	
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS d','c.id = d.id')
				 ->join(TABLES::$MENU_ITEM.' AS e','d.itemid = e.id')
				 ->where('a.end_date IS NULL','',FALSE)
				 ->where('e.restid',$map['restid']);
		if(!empty($map['option_id']))
			$this->db->where('c.id',$map['option_id']);
		$this->db->group_by('b.sub_item_id');
		$compiled_query1 = $this->db->_compile_select();
		$this->db->_reset_select();
		
		$this->db->select('b.sub_item_id,b.sub_item_name,b.image,b.description,b.new_sub_item_key,a.price,a.status,a.is_required,a.is_default,a.sortorder,a.size,a.start_date,a.start_time,a.end_time,a.calories,a.posItemID,a.posSizeID')
				->from(TABLES::$MENU_OPTION_PRICE.' AS a')
				->join(TABLES::$MENU_OPTION.' AS b','a.sub_item_id = b.sub_item_id')
				->join(TABLES::$MENU_OPTION_CATEGORY.' AS c','b.new_sub_item_key = c.new_sub_item_key')
				->join(TABLES::$MENU_ITEM_PRICE.' AS d','c.id = d.id')
				->join(TABLES::$MENU_ITEM.' AS e','d.itemid = e.id')
				->where('a.end_date  >= "'.date('Y-m-d').'"','',FALSE)
				->where('e.restid',$map['restid']);
		if(!empty($map['option_id']))
			$this->db->where('c.id',$map['option_id']);
		$this->db->group_by('b.sub_item_id');
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		
		$compiled_query = $compiled_query1." UNION ".$compiled_query2.' ORDER BY sortorder ASC';
		$query = $this->db->query($compiled_query);
		$result = $query->result_array();
		return $result;	
	}
	
	function findRestaurantWithOptions( $map ) {
		$this->db->select('c.restid,c.name,c.area,a.menu_id,')
					->from(TABLES::$MENU_ITEM.' AS a')
					->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
					->join(TABLES::$SEARCH_MAP.' AS c','a.restid = c.restid')
					->where('b.has_options',1);
		if($map['name'] != null)
			$this->db->like('c.name',$map['name'],'after');
		if($map['restid'] != null)
			$this->db->where('c.restid',$map['restid']);
		$this->db->group_by('c.restid');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	/* Fetch a sample template for categories*/
	function getItemOptionCategoriesForMenu( $map ) {
		$this->db->select('a.option_cat_name,a.id as option_id,a.choice_type,a.required_options,a.optional_flag,a.sortorder,a.new_sub_item_key,a.min_options,a.max_options,a.description,a.new_sub_item_key,a.option_cat_id')
				 ->from(TABLES::$MENU_OPTION_CATEGORY.' AS a')
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.id')
				 ->join(TABLES::$MENU_ITEM.' AS c','b.itemid = c.id')
				 ->where('c.restid',$map['restid']);
		if(!empty($map['option_id']))
			$this->db->where('a.id',$map['option_id']);
		if(!empty($map['template']))
			$this->db->group_by('a.option_cat_name');
		else
			$this->db->group_by('a.new_sub_item_key');
		$this->db->order_by('a.sortorder','asc');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;	
	}
	
	function getItemOptionCategoriesForNewItems( $map ) {
		$this->db->select('a.option_cat_name,a.id as option_id,a.choice_type,a.optional_flag,a.sortorder,a.new_sub_item_key,a.min_options,a.max_options,a.description,a.new_sub_item_key,a.option_cat_id')
				->from(TABLES::$MENU_OPTION_CATEGORY.' AS a')
				->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.id')
				->join(TABLES::$MENU_ITEM.' AS c','b.itemid = c.id')
				->where('c.id NOT IN ('.implode(',',$map['items']).')','',FALSE)
				->where('c.restid',$map['restid'])
				->group_by('a.new_sub_item_key')
		 		->order_by('a.sortorder','asc');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function getItemOptionsForNewItems( $map ) {
		$this->db->select('b.sub_item_id,b.sub_item_name,b.image,b.description,b.new_sub_item_key,a.price,a.status,a.is_default,a.sortorder,a.size,a.start_date,a.start_time,a.end_time,a.calories,a.posItemID,a.posSizeID')
				->from(TABLES::$MENU_OPTION_PRICE.' AS a')
				->join(TABLES::$MENU_OPTION.' AS b','a.sub_item_id = b.sub_item_id')
				->join(TABLES::$MENU_OPTION_CATEGORY.' AS c','b.new_sub_item_key = c.new_sub_item_key')
				->join(TABLES::$MENU_ITEM_PRICE.' AS d','c.id = d.id')
				->join(TABLES::$MENU_ITEM.' AS e','d.itemid = e.id')
				->where('e.id NOT IN ('.implode(',',$map['items']).')','',FALSE)
				->where('e.restid',$map['restid'])
			    ->group_by('b.sub_item_id');
		$this->db->order_by('a.sortorder','asc');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
}