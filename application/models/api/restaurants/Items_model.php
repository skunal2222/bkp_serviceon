<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function addMenuItems( $map ) {
	$this->db->insert(TABLES::$MENU_ITEM,$map);
		return  $this->db->insert_id();
		 		
	}
	
	function addMenuItemPrices( $map ) {
		$this->db->insert_batch(TABLES::$MENU_ITEM_PRICE,$map);
	} 
	
	function addMenuItemPrice( $map ) {
		$this->db->insert(TABLES::$MENU_ITEM_PRICE,$map);
		return $this->db->insert_id();
	}
	
	function updateMenuItems( $map ) {
		$this->db->update_batch(TABLES::$MENU_ITEM,$map,'id');
	}
	
	function updateMenuItemPrices( $map ) {
		$this->db->update_batch(TABLES::$MENU_ITEM_PRICE,$map,'id');
	}
	
	function getNewMenuItems( $map ) {
		$this->db->select('a.id,a.name, a.restid, a.description,a.menu_cat_id,a.image, a.posItemID, a.video_url,a.vat_tax,a.service_tax,b.id as option_id, b.price,b.start_date,b.end_date, b.start_time, b.end_time, b.has_options, b.description, b.calories, b.packaging, b.size,a.replicationID')
				 ->from(TABLES::$MENU_ITEM.' AS a')
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
				 ->where('a.id NOT IN ('.implode(',',$map['items']).')','',FALSE)
				 ->where('restid',$map['restid'])
				 ->where('b.end_date IS NULL','',FALSE);
		$compiled_query1 = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('a.id,a.name, a.restid, a.description,a.menu_cat_id,a.image, a.posItemID, a.video_url,a.vat_tax,a.service_tax,b.id as option_id, b.price,b.start_date,b.end_date, b.start_time, b.end_time, b.has_options, b.description, b.calories, b.packaging, b.size,a.replicationID')
				->from(TABLES::$MENU_ITEM.' AS a')
				->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
				->where('a.id NOT IN ('.implode(',',$map['items']).')','',FALSE)
				->where('restid',$map['restid'])
				->where('b.end_date >= "'.date('Y-m-d').'"','',FALSE);
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		$compiled_query = $compiled_query1." UNION ".$compiled_query2;
// 		error_log($compiled_query,0);
		$query = $this->db->query($compiled_query);
		$result = $query->result_array();
		return $result;
	}
	
	function getMainCategoriesForNewItems( $map ) {
		$this->db->select('a.id,a.description mdesc, a.image as mimage, a.name as mcatname')
				->from(TABLES::$MENU_MAIN_CATEGORY.' AS a')
				->join(TABLES::$MENU_CATEGORY.' AS b','a.id = b.menu_mcat_id')
				->join(TABLES::$MENU_ITEM.' AS c','b.id = c.menu_cat_id')
				->join(TABLES::$MENU_ITEM_PRICE.' AS d','c.id = d.itemid')
				->where('c.id NOT IN ('.implode(',',$map['items']).')','',FALSE)
				->where('c.restid',$map['restid'])
				->where('d.end_date IS NULL','',FALSE);
		$compiled_query1 = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('a.id,a.description mdesc, a.image as mimage, a.name as mcatname')
				->from(TABLES::$MENU_MAIN_CATEGORY.' AS a')
				->join(TABLES::$MENU_CATEGORY.' AS b','a.id = b.menu_mcat_id')
				->join(TABLES::$MENU_ITEM.' AS c','b.id = c.menu_cat_id')
				->join(TABLES::$MENU_ITEM_PRICE.' AS d','c.id = d.itemid')
				->where('c.id NOT IN ('.implode(',',$map['items']).')','',FALSE)
				->where('c.restid',$map['restid'])
				->where('d.end_date >= "'.date('Y-m-d').'"','',FALSE);
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		$compiled_query = $compiled_query1." UNION ".$compiled_query2.' GROUP BY id';
		$query = $this->db->query($compiled_query);
		$result = $query->result_array();
		return $result;
// 		$this->db->group_by('a.id');
// 		$this->db->order_by('a.sortorder','ASC');
// 		$compiled_query = $this->db->_compile_select();
// 		$query = $this->db->get();
// 		$result = $query->result_array();
// 		return $result;
	}
	
	function getCategoriesForNewItems( $map ) {
		$this->db->select('a.id,a.description,a.image,a.name,a.menu_mcat_id')
				 ->from(TABLES::$MENU_CATEGORY.' AS a')
				 ->join(TABLES::$MENU_ITEM.' AS b','a.id = b.menu_cat_id')
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS c','b.id = c.itemid')
				 ->where('b.id NOT IN ('.implode(',',$map['items']).')','',FALSE)
				 ->where('b.restid',$map['restid'])
				 ->where('c.end_date IS NULL','',FALSE);
		$compiled_query1 = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('a.id,a.description,a.image,a.name,a.menu_mcat_id')
				->from(TABLES::$MENU_CATEGORY.' AS a')
				->join(TABLES::$MENU_ITEM.' AS b','a.id = b.menu_cat_id')
				->join(TABLES::$MENU_ITEM_PRICE.' AS c','b.id = c.itemid')
				->where('b.id NOT IN ('.implode(',',$map['items']).')','',FALSE)
				->where('b.restid',$map['restid'])
				->where('c.end_date >= "'.date('Y-m-d').'"','',FALSE);
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		$compiled_query = $compiled_query1." UNION ".$compiled_query2.' GROUP BY id';
		$query = $this->db->query($compiled_query);
		$result = $query->result_array();
		return $result;
	}
	
	function getTotalItemsInMenu( $map ) {
		$this->db->select('count(id) as total',FALSE)
				 ->from(TABLES::$MENU_ITEM)
				 ->where('restid',$map['restid']);
		$compiled_query = $this->db->_compile_select();
		if($data = $this->rcache->get(md5( $compiled_query),$map['restid'])) {
			$this->db->_reset_select();
			$result = $data;
		}else {
			$query = $this->db->get();
			$result = $query->result_array();
			$this->rcache->set(md5($compiled_query), $result,$map['restid']);
		}
		return $result[0]['total']+1;
	}
	function searchItems($map){
		
		$this->db->select('a.name');
		$this->db->from(TABLES::$MENU_ITEM.' AS a');
		$this->db->like('a.name',$map['name'],'after');
		$this->db->limit('20');
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		 
		return $result;
	}

	function findExistingItem( $map ) {
		$this->db->select('MAX(a.id) as id,a.name,a.restid,a.menu_id,MAX(b.id) as option_id',FALSE);
		$this->db->from(TABLES::$MENU_ITEM.' AS a')
			     ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
			     ->JOIN(tables::$MENU_CATEGORY.' as c','a.menu_cat_id = c.id')
			     ->where('a.restid',$map['restid'])
			     ->where('a.name',$map['name'])
			     ->where('c.name',$map['catname']);
		if($map['size'] != null)
			$this->db->where('b.size',$map['size']);
				 
		if($map['menu_id'] != null)
			$this->db->where('a.menu_id',$map['menu_id']);
		$compiled_query = $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	function searchMenuItems( $map ) {
		if($map['existing'] == 1) {
			if($map['itemid'] == null ) {
				$this->db->select('a.id,a.name,a.restid,a.menu_id,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_time,b.end_time,b.has_options,b.description,b.calories,b.packaging,b.size,GROUP_CONCAT(DISTINCT c.new_sub_item_key SEPARATOR ",") as options',FALSE);
			}else{
				$this->db->select('a.id,a.name,a.restid,a.menu_id,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_time,b.end_time,b.has_options,b.description,b.calories,b.packaging,b.size,c.new_sub_item_key as options',FALSE);
			}
		}else {
			$this->db->select('a.id,a.name,a.restid,a.menu_id,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_time,b.end_time,b.has_options,b.description,b.calories,b.packaging,b.size');
		}
		$this->db->from(TABLES::$MENU_ITEM.' AS a');
		$this->db->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid');
		if($map['existing'] == 1) {
			$this->db->join(TABLES::$MENU_OPTION_CATEGORY.' AS c','b.id = c.id');
		}
		if($map['menu_id'] != null)
			$this->db->where('a.menu_id',$map['menu_id']);
		if($map['name'] != null)
			$this->db->like('a.name',$map['name'],'after');
		if($map['itemid'] != null ) {
			$this->db->where('a.id',$map['itemid']);
		}
		if($map['option_id'] != null ) {
			$this->db->where('b.id',$map['option_id']);
			$this->db->group_by('a.id');
		}
		if($map['catid'] != null ) {
			$this->db->where('a.menu_cat_id',$map['catid']);
			$this->db->group_by('a.id');
		}
		if($map['start_date'] != null ) {
			$this->db->where('b.start_date',$map['start_date']);
		}
		if($map['end_date'] != null ) {
			$this->db->where('b.end_date',$map['end_date']);
		}else {
			$this->db->where('b.end_date IS NULL','',FALSE);
		}
		if($map['itemid'] != null ) {
			$this->db->where('a.id',$map['itemid']);
		}
		if($map['restid'] != null)
			$this->db->where('a.restid',$map['restid']);
		$compiled_query1 = $this->db->_compile_select();
		
		$this->db->_reset_select();
		
		if($map['existing'] == 1) {
			if($map['itemid'] == null ) {
				$this->db->select('a.id,a.name,a.restid,a.menu_id,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_time,b.end_time,b.has_options,b.description,b.calories,b.packaging,b.size,GROUP_CONCAT(DISTINCT c.new_sub_item_key SEPARATOR ",") as options',FALSE);
			}else{
				$this->db->select('a.id,a.name,a.restid,a.menu_id,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_time,b.end_time,b.has_options,b.description,b.calories,b.packaging,b.size,c.new_sub_item_key as options',FALSE);
			}
		}else {
			$this->db->select('a.id,a.name,a.restid,a.menu_id,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_time,b.end_time,b.has_options,b.description,b.calories,b.packaging,b.size');
		}
		$this->db->from(TABLES::$MENU_ITEM.' AS a');
		$this->db->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid');
		if($map['existing'] == 1) {
			$this->db->join(TABLES::$MENU_OPTION_CATEGORY.' AS c','b.id = c.id');
		}
		if($map['menu_id'] != null)
			$this->db->where('a.menu_id',$map['menu_id']);
		if($map['name'] != null)
			$this->db->like('a.name',$map['name'],'after');
		if($map['itemid'] != null ) {
			$this->db->where('a.id',$map['itemid']);
		}
		if($map['option_id'] != null ) {
			$this->db->where('b.id',$map['option_id']);
			$this->db->group_by('a.id');
		}
		if($map['catid'] != null ) {
			$this->db->where('a.menu_cat_id',$map['catid']);
			$this->db->group_by('a.id');
		}
		if($map['start_date'] != null ) {
			$this->db->where('b.start_date',$map['start_date']);
		}
		if($map['end_date'] != null ) {
			$this->db->where('b.end_date',$map['end_date']);
		}else {
			$this->db->where('b.end_date  >= "'.date('Y-m-d').'"','',FALSE);
		}
		if($map['itemid'] != null ) {
			$this->db->where('a.id',$map['itemid']);
		}
		if($map['restid'] != null)
			$this->db->where('a.restid',$map['restid']);
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		$compiled_query = $compiled_query1." UNION ".$compiled_query2;
		$query = $this->db->query($compiled_query);
		$result = $query->result_array();
		return $result;
	}
	
	function getMenuItemsForRestaurant( $restid ) {
		$this->db->select('a.id,a.restid,a.name,a.sortorder,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_date,b.end_date,b.start_time,b.end_time,b.has_options,b.color,b.is_dry,b.packaging,b.size,b.id as option_id,b.status')
				 ->from(TABLES::$MENU_ITEM.' AS a')
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
				 ->where('b.end_date IS NULL','',FALSE)
				 ->where('a.restid',$restid);
				
		$compiled_query1 = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('a.id,a.restid,a.name,a.sortorder,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_date,b.end_date,b.start_time,b.end_time,b.has_options,b.color,b.is_dry,b.packaging,b.size,b.id as option_id,b.status')
				->from(TABLES::$MENU_ITEM.' AS a')
				->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
				->where('b.end_date  >= "'.date('Y-m-d').'"','',FALSE)
				->where('a.restid',$restid);
		
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		$compiled_query = $compiled_query1." UNION ".$compiled_query2.' ORDER BY sortorder ASC';
		//echo  $compiled_query;
		$query = $this->db->query($compiled_query);
		$result = $query->result_array();
		return $result;		
	}
	
	function getEndDateMenuItemsForRestaurant( $restid ) {
		$this->db->select('a.id,a.restid,a.name,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_date,b.end_date,b.start_time,b.end_time,b.has_options,b.color,b.is_dry,b.packaging,b.size,b.id as option_id')
				 ->from(TABLES::$MENU_ITEM.' AS a')
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
				 ->where('b.end_date  < "'.date('Y-m-d').'"','',FALSE)
				 ->where('a.restid',$restid);
	
		$compiled_query1 = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('a.id,a.restid,a.name,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_date,b.end_date,b.start_time,b.end_time,b.has_options,b.color,b.is_dry,b.packaging,b.size,b.id as option_id')
				 ->from(TABLES::$MENU_ITEM.' AS a')
		         ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid','left')
				 ->where('b.end_date  < "'.date('Y-m-d').'"','',FALSE)
				 ->where('a.restid',$restid);
	
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		$compiled_query = $compiled_query1." UNION ".$compiled_query2.' ORDER BY price ASC';
		$query = $this->db->query($compiled_query);
		$result = $query->result_array();
		return $result;
	}
	
	function getPublishedMenuItemsForRestaurant( $map ) {
		$this->db->select('a.id,a.restid,a.name,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_date,b.end_date,b.start_time,b.end_time,b.has_options,b.color,b.is_dry,b.packaging,b.size,b.id as option_id,b.status,a.sortorder')
				 ->from(TABLES::$MENU_ITEM.' AS a')
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
				 ->where('b.start_date <= "'.date('Y-m-d').'"','',FALSE)
				 ->where('b.end_date IS NULL','',FALSE)
				 ->where('b.status',1)
				 ->where('a.restid',$map['restid']);
		$compiled_query1 = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('a.id,a.restid,a.name,a.menu_cat_id,a.description,a.image,a.posItemID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_date,b.end_date,b.start_time,b.end_time,b.has_options,b.color,b.is_dry,b.packaging,b.size,b.id as option_id,b.status,a.sortorder')
				->from(TABLES::$MENU_ITEM.' AS a')
				->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
				->where('b.start_date <= "'.date('Y-m-d').'"','',FALSE)
				->where('b.end_date  >= "'.date('Y-m-d').'"','',FALSE)
				->where('b.status',1)
				->where('a.restid',$map['restid']);
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		$compiled_query = $compiled_query1." UNION ".$compiled_query2.' ORDER BY sortorder ASC,price ASC';
		$query = $this->db->query($compiled_query);
		$result = $query->result_array();
		return $result;
	}
	
	function getMenuItemsForCategories( $map ) {
		$this->db->select('a.id,a.restid,a.menu_id,a.name,a.menu_cat_id,a.description,a.sortorder,a.image,a.posItemID,a.replicationID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_date,b.end_date,b.start_time,b.end_time,b.has_options,b.calories,b.packaging,b.size,b.id as option_id,c.frequency as popular')
					->from(TABLES::$MENU_ITEM.' AS a')
					->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
					->join(TABLES::$POPULAR_ITEMS.' As c','a.id = c.itemid','left')
					->where('b.end_date IS NULL','',FALSE)
					->where('a.restid',$map['restid'])
					->where('a.menu_cat_id IN('.implode(',',$map['categories']).')','',FALSE);
	
		$compiled_query1 = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('a.id,a.restid,a.menu_id,a.name,a.menu_cat_id,a.description,a.sortorder,a.image,a.posItemID,a.replicationID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_date,b.end_date,b.start_time,b.end_time,b.has_options,b.calories,b.packaging,b.size,b.id as option_id,c.frequency as popular')
				->from(TABLES::$MENU_ITEM.' AS a')
				->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
				->join(TABLES::$POPULAR_ITEMS.' As c','a.id = c.itemid','left')
				->where('b.end_date  >= "'.date('Y-m-d').'"','',FALSE)
				->where('a.restid',$map['restid'])
				->where('a.menu_cat_id IN('.implode(',',$map['categories']).')','',FALSE);
	
		if($map['menu_id'] != null)
			$this->db->where('a.menu_id',$map['menu_id']);
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		$compiled_query = $compiled_query1." UNION ".$compiled_query2.' ORDER BY price ASC';
		$query = $this->db->query($compiled_query);
		$result = $query->result_array();
		return $result;
	}
	
	function getUpdatedMenuItemsForRestaurant( $map ) {
		$this->db->select('a.id,a.restid,a.menu_id,a.name,a.menu_cat_id,a.description,a.image,a.posItemID,a.replicationID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_date,b.end_date,b.start_time,b.end_time,b.has_options,b.calories,b.packaging,b.size,b.id as option_id,c.name as mcatname,d.name as catname')
				 ->from(TABLES::$MENU_MAIN_CATEGORY.' AS c')
				 ->join(TABLES::$MENU_CATEGORY.' AS d','c.id = d.menu_mcat_id')
				 ->join(TABLES::$MENU_ITEM.' AS a','c.id = a.menu_cat_id')
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
				 ->where('b.end_date IS NULL','',FALSE)
				 ->where('a.restid',$map['restid']);
	
		$compiled_query1 = $this->db->_compile_select();
		$this->db->_reset_select();
		$this->db->select('a.id,a.restid,a.menu_id,a.name,a.menu_cat_id,a.description,a.image,a.posItemID,a.replicationID,a.video_url,a.vat_tax,a.service_tax,b.id as option_id,b.price,b.start_date,b.end_date,b.start_time,b.end_time,b.has_options,b.calories,b.packaging,b.size,b.id as option_id,c.name as mcatname,d.name as catname')
				 ->from(TABLES::$MENU_MAIN_CATEGORY.' AS c')
				 ->join(TABLES::$MENU_CATEGORY.' AS d','c.id = d.menu_mcat_id')
				 ->join(TABLES::$MENU_ITEM.' AS a','c.id = a.menu_cat_id')
				 ->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.id = b.itemid')
				->where('b.end_date  >= "'.date('Y-m-d').'"','',FALSE)
				->where('a.restid',$map['restid']);
	
		$compiled_query2 = $this->db->_compile_select();
		$this->db->_reset_select();
		$compiled_query = $compiled_query1." UNION ".$compiled_query2.' ORDER BY price ASC';
// 		error_log($compiled_query,0);
		if($data = $this->rcache->get(md5( $compiled_query),$map['restid'])) {
			$this->db->_reset_select();
			$result = $data;
		}else {
			$query = $this->db->query($compiled_query);
			$result = $query->result_array();
			$this->rcache->set(md5($compiled_query), $result,$map['restid']);
		}
		return $result;
	}
	
	function turnOffAllItems( $map ) {
		$compiled_query = 'UPDATE tbl_menu_item_prices as a inner join tk_menu_restaurant_items as b on a.itemid = b.id SET a.end_date='.'"'.date('Y-m-d',strtotime('-1 day',strtotime(date('Y-m-d')))).'"'.' where b.restid = '.$map['restid'];
		 $this->db->query($compiled_query);
	}
	
	function getItemsByPosItemId( $map ) {
		$this->db->select('a.id as option_id,a.price,c.restid')
				 ->from(TABLES::$MENU_ITEM_PRICE.' AS a')
				 ->join(TABLES::$MENU_ITEM.' AS b','a.itemid = b.id')
				 ->join(TABLES::$SEARCH_MAP.' as c ','b.restid = c.restid')
				 ->where('c.cityid',$map['cityid'])
				 ->where('b.posItemID',$map['posItemID'])
				 ->where('a.end_date',date('Y-m-d',strtotime('-1 day',strtotime(date('Y-m-d')))));
		 $compiled_query = $this->db->_compile_select();
		 $query = $this->db->get();
		 $result = $query->result_array();
		 return $result;
	}
	
	public function getPosItemRestaurants($id){
		$this->db->select('b.restid,c.menu_id')
				->from(TABLES::$CLIENT_TABLE.' AS a')
				->join(TABLES::$CLIENT_RESTAURANT_TABLE.' AS b','a.id = b.id','inner')
				->join(TABLES::$MENU_RESTAURANT.' AS c ','b.restid = c.restid')
				->where('a.client_id',$id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getMenuItems($restid) {
		$this->db->select('menu')
		->from(TABLES::$MENU_STORAGE)
		->where('restid',$restid);
	//	echo $this->db->_compile_select();
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function turnOffItem($size_id) {
		$map = array('status'=>0);
		$this->db->where('id',$size_id);
		$this->db->update(TABLES::$MENU_ITEM_PRICE,$map);
	}
	
	public function turnOnItem($size_id) {
		$map = array('status'=>1);
		$this->db->where('id',$size_id);
		$this->db->update(TABLES::$MENU_ITEM_PRICE,$map);
	}
	
}