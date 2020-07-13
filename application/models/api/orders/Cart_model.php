<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI_Model API for cart management .
 *
 * <p>
 * We are using this model to assign, unassign, change and get delivery status of orders.
 * </p>
 * @package Orders
 * @subpackage orders-model
 * @author pradeep singh
 * @category CI_Model API
 */
	class Cart_model extends CI_Model {
		
		function __construct() {
			parent::__construct();
		}

		/**
         * Function for getting order cart session.
         *
         * @access private
         * @return cookie session record
         * @version 1.0001
         */
		public function getCartSession( $id ) {
			return md5(date(DATE_RFC822).time().$id);
		}
		
		public function getOrderItemCount( $map ) {
			$params = array('session_cookie'=>$map['session_cookie'],'restid'=>$map['restid']);
			$this->db->select('sum(quantity) as cart_count', FALSE)
					 ->from(TABLES::$ORDER_CART)
					 ->where($params);
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}

		public function addSubItemsToCart( $map ) {
			$this->db->insert(TABLES::$ORDER_SUB_CART,$map);
			return $map;
		}

		public function removeSubItemsFromCart($map) {
			$params = array('session_cookie'=>$map['session_cookie'],'option_id'=>$map['option_id']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_SUB_CART);
		}
		
		public function removeSubItemSetFromCart($map) {
			$params = array('session_cookie'=>$map['session_cookie'],'option_id'=>$map['option_id'],'itemset'=>$map['itemset']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_SUB_CART);
		}

		 /**
         * Function for adding order items to session cart.
         *
         * @access public
         * @param array itemMap
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function addItemToCart( $map) {
			$params = array('session_cookie'=>$map['session_cookie'],'option_id'=>$map['option_id']);
			$this->db->select('COUNT(*) as count')->from(TABLES::$ORDER_CART)->where($params);
	    	$query = $this->db->get();
	    	$result = $query->result_array();
			if($result[0]['count'] <=0 ) {
				$this->db->insert(TABLES::$ORDER_CART,$map);
			}else {
				$this->increaseItemQuantity( $map  );
			}
			return $map;
		}
		
	    public function getOrderTotal( $map ) {
	    	$params = array('a.session_cookie'=>$map['cart_session'],'a.restid'=>$map['restid']);
	    	$this->db->select('SUM(a.quantity*b.price) AS total',FALSE)
	    		     ->from(TABLES::$ORDER_CART.' AS a')
	    		     ->join(TABLES::$MENU_ITEM_TABLE.' AS b','a.itemid = b.id','inner')
	    		     ->where($params)
	    		     ->group_by('a.session_cookie');
			$query = $this->db->get();
	    	$result = $query->result_array();
	    	return $result;
	    }

		
		/**
         * Function for removing items from order session cart.
         *
         * @access public
         * @param integer itemid
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function removeItemFromCart( $map ) {
			$params = array('session_cookie'=>$map['session_cookie'],'option_id'=>$map['option_id'],'restid'=>$map['restid']);
			$this->db->select('quantity')->from(TABLES::$ORDER_CART)->where($params);
			$query = $this->db->get();
			$result = $query->result_array();
			if(count($result) > 0) {
				if ($result[0]['quantity'] <=1 ) {
					$this->db->where($params);
					$this->db->delete(TABLES::$ORDER_CART);
				} else {
					$quantity = $result[0]['quantity'];
					$qty = array();
					$qty['quantity'] = $quantity - 1;
					$this->db->where($params);
					$this->db->update(TABLES::$ORDER_CART,$qty);
				}
			}
		}
		
		public function deleteItemFromCart( $map ) {
			$params = array('session_cookie'=>$map['session_cookie'],'option_id'=>$map['option_id'],'restid'=>$map['restid']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_CART);
		}

		/**
         * Function for updating item quantity in order cart.
         *
         * @access public
         * @param array itemMap
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function updateItemQuantity( $map ) {
			$params = array('session_cookie'=>$map['session_cookie'],'option_id'=>$map['option_id'],'restid'=>$map['restid']);
			$this->db->where($params);
			$qty = array('quantity'=>$map['quantity']);
			$this->db->update(TABLES::$ORDER_CART,$qty);
		}
		
		public function increaseItemQuantity($map) {
			$params = array('session_cookie'=>$map['session_cookie'],'option_id'=>$map['option_id'],'restid'=>$map['restid']);
			$this->db->select('quantity')->from(TABLES::$ORDER_CART)->where($params);
			$query = $this->db->get();
			$result = $query->result_array();
			if(count($result) > 0) {
				$quantity = $result[0]['quantity'];
				$qty = array();
				$qty['quantity'] = $quantity + 1;
				$this->db->where($params);
				$this->db->update(TABLES::$ORDER_CART,$qty);
			}
		}

		  /**
         * Function for getting order cart.
         *
         * @access public
         * @param integer restid
         * @return array array of multi result set
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function getOrderCart( $map ) {
		 	$params = array('a.session_cookie'=>$map['session_cookie']);
		 	$this->db->select('a.itemid,a.option_id,a.quantity,a.size', FALSE)
		 			 ->from(TABLES::$ORDER_CART.' AS a')
		 			 ->where($params);
		 			 //->order_by('c.name','asc');
		 	$query = $this->db->get();
		 	//echo $this->db->last_query();
			$result = $query->result_array();
			return $result;
		}
		
		/* public function getOrderCart( $map ) {
			$params = array('a.session_cookie'=>$map['session_cookie'],'a.restid'=>$map['restid']);
			$this->db->select('a.itemid,a.option_id,a.quantity,b.price,(a.quantity * b.price) as totalprice,(a.quantity *b.packaging) as packaging,a.size,c.name,c.description,c.vat_tax,c.service_tax', FALSE)
			->from(TABLES::$ORDER_CART.' AS a')
			->join(TABLES::$MENU_ITEM_PRICE.' AS b','a.option_id = b.id','inner')
			->join(TABLES::$MENU_ITEM.' AS c','b.itemid = c.id','inner')
			->where($params)
			->order_by('c.name','asc');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}  */
		
		public function getOrderSubItemsBySubcat( $map ) {
		 	$params = array('a.session_cookie'=>$map['cart_session'],'a.restid'=>$map['restid']);
		 	$this->db->select('a.itemid,GROUP_CONCAT(DISTINCT b.sub_item_name SEPARATOR ",") as subitems,c.price,SUM(c.price) as subprice,b.sub_cat_name,b.itemset', FALSE)
		 			 ->from(TABLES::$ORDER_CART.' AS a')
					 ->join(TABLES::$ORDER_SUB_CART.' AS b',' a.session_cookie = b.session_cookie','left')
 					 ->join(TABLES::$ORDER_SUB_ITEM.' AS c','b.sub_item_id = c.sub_item_id','left')
 					 ->where($params)
 					 ->where('b.sub_item_key = c.sub_item_key')
 					 ->where('a.itemid','b.itemid',FALSE)
 					 ->group_by('b.itemid')
 					 ->group_by('b.itemset')
		 			 ->group_by('b.sub_cat_name');

		 	$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}
		
		public function getGlobalIdByItemId( $itemid ) {
			$params = array('id'=>$itemid);
			$this->db->select('global_id')
					 ->from(TABLES::$MENU_ITEM_TABLE)
					 ->where($params);
		
			$query = $this->db->get();
			$result = $query->result_array();
			return $result[0]['global_id'];
		}

		public function getOrderSubCart( $map) {
		 	$params = array('a.session_cookie'=>$map['cart_session'],'a.restid'=>$map['restid']);
		 	$this->db->select('a.itemid,a.sub_item_id,a.sub_item_key,a.itemset,b.price')
		 			 ->from(TABLES::$ORDER_SUB_CART.' AS a')
		 			 ->join(TABLES::$ORDER_SUB_ITEM.' AS b','b.sub_item_id = a.sub_item_id','left')
		 			 ->where($params)
		 			 ->where('a.sub_item_key = b.sub_item_key');
		 	$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}
		
		public function getOrderSubCartByItemSet( $map ) {
			$params = array('session_cookie'=>$map['cart_session'],'restid'=>$map['restid']);
			$this->db->select('itemid,MAX(itemset) as items')
					->from(TABLES::$ORDER_SUB_CART)
					->where($params)
					->group_by('itemid');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}

		 /**
         * Function for checking order cart.
         *
         * @access public
         * @param integer restid
         * @return array array of multi result set
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function checkOrderCart( $restid , $cart_session) {
			 	$params = array('a.session_cookie'=>$cart_session,'a.restid'=>$restid);
			 	$this->db->select('a.itemid,a.quantity,b.name,b.price,(a.quantity * b.price) as total,(a.quantity *b.packaging) as packaging,c.name as category',FALSE)
			 			 ->from(TABLES::$ORDER_CART.' AS a')
			 			 ->join(TABLES::$MENU_ITEM_TABLE.' AS b','a.itemid = b.id','inner')
			 			 ->join(TABLES::$CATEGORY_TABLE.' AS c','b.catid = c.id','inner')
			 			 ->where($params)
			 			 ->order_by('b.name','asc')
			 			 ->order_by('c.id','asc');
			 	$query = $this->db->get();
				$result = $query->result_array();
				return $result;
		}

		  /**
         * Function for clearing order cart.
         *
         * @access public
         * @param integer restid
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function clearOrderCart( $map ) {
			$params = array('session_cookie'=>$map['session_cookie'],'restid'=>$map['restid']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_CART);
			$params = array('session_cookie'=>$map['session_cookie'],'restid'=>$map['restid']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_SUB_CART);
		}

			  /**
         * Function for clearing order cart.
         *
         * @access public
         * @param integer restid
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function clearOrderSubCart(  $map ) {
			$params = array('session_cookie'=>$map['cart_session']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_SUB_CART);
		}
		 /**
         * Function for getting item from order cart.
         *
         * @access public
         * @param integer restid
         * @param integer itemid
         * @return array array of single result set
         * @since Beta 1.0001 - 01-Aug-09
         * @version 1.0001
         */
		public function getItemFromCart( $map ) {
		 	$params = array('a.session_cookie'=>$map['cart_session'],'a.restid'=>$map['restid'],'a.itemid'=>$map['itemid']);
		 	$this->db->select('a.itemid,a.restid,a.quantity,b.catid,b.name,b.price,(a.quantity * b.price) as total,(a.quantity *b.packaging) as packaging,b.sub_cat', FALSE)
		 			 ->from(TABLES::$ORDER_CART.' AS a')
		 			 ->join(TABLES::$MENU_ITEM_TABLE.' AS b','a.itemid = b.id','inner')
		 			 ->where($params)->order_by('b.name','asc');
		 	$query = $this->db->get();
	    	$result = $query->result_array();
	    	return $result;
		}

		/* ************************* Order deals cart implementation ********** ******************* */
		public function addDealsToCart( $itemMap  ) {
			$params = array('session_cookie'=>$itemMap['cart_session'],'dealid'=>$itemMap['dealid']);
			$this->db->select('COUNT(*) as count')->from(TABLES::$ORDER_DEALS_CART)->where($params);
			$query = $this->db->get();
			$result = $query->result_array();
			if($result[0]['count'] <=0 ) {
				$params = array('session_cookie'=>$itemMap['cart_session'],'restid'=>$itemMap['restid'],'dealid'=>$itemMap['dealid']);
				/* New item */
				$this->db->insert(TABLES::$ORDER_DEALS_CART,$params);
				$map['message'] = 'Deal Applied To Cart';
				$map['status'] = 0;
			}else {
// 				$this->updateDealsInCart( $itemMap  );
				$map['message'] = 'Deal Applied To Cart';
				$map['status'] = 1;
			}
			return $map;
		}
		
		public function updateDealsInCart( $itemMap  ) {
			$params = array('session_cookie'=>$itemMap['cart_session'],'restid'=>$itemMap['restid']);
			$dealid = $itemMap['dealid'];
			$dealid = array('dealid'=>$dealid);
			$this->db->where($params);
			$this->db->update(TABLES::$ORDER_DEALS_CART,$dealid);
		}
		
		public function getOrderDealsCart( $requestMap ) {
		 	$params = array('a.session_cookie'=>$requestMap['cart_session'],'a.restid'=>$requestMap['restid'],'c.service'=>$requestMap['service']);
		 	$this->db->select('a.dealid,b.discount,b.disc_type,c.billed_to,b.discount_mode,b.discount_share,b.lower_limit', FALSE)
		 			 ->from(TABLES::$ORDER_DEALS_CART.' AS a')
		 			 ->join(TABLES::$DEAL_DISC_TABLE.' AS b','a.dealid = b.deal_id','inner')
		 			 ->join(TABLES::$DEAL_TABLE.' AS c','b.deal_id = c.id','inner')
		 			 ->where($params);
		 	$query = $this->db->get();
	    	$result = $query->result_array();
	    	return $result;
		}
		
		public function getOrderTotalDealsCart( $requestMap ) {
			$params = array('a.session_cookie'=>$requestMap['cart_session'],'a.restid'=>$requestMap['restid'],'c.service'=>$requestMap['service']);
			$this->db->select('a.dealid,c.billed_to', FALSE)
					 ->from(TABLES::$ORDER_DEALS_CART.' AS a')
					 ->join(TABLES::$DEAL_TABLE.' AS c','a.dealid = c.id','inner')
					 ->where($params);
			$query = $this->db->get();
	    	$result = $query->result_array();
	    	return $result;
		}
		
		public function getItemDealsCart( $requestMap ) {
			$params = array('a.session_cookie'=>$requestMap['cart_session'],'d.session_cookie'=>$requestMap['cart_session'],'a.restid'=>$requestMap['restid'],'c.service'=>$requestMap['service']);
			$this->db->select('DISTINCT a.dealid,b.discount,b.price,b.sell_price,b.cost_price,c.billed_to,d.quantity,b.itemid', FALSE)
					 ->from(TABLES::$ORDER_DEALS_CART.' AS a')
					 ->join(TABLES::$DEAL_ITEM.' AS b','a.dealid = b.deal_id','inner')
					 ->join(TABLES::$DEAL_TABLE.' AS c','b.deal_id = c.id','inner')
					 ->join(TABLES::$ORDER_CART.' AS d',' b.itemid = d.itemid','inner')
					 ->where('b.itemid IN('.$requestMap['deal_items'].')','',FALSE)
					 ->where($params);
			$query = $this->db->get();
	    	$result = $query->result_array();
	    	return $result;
		}
		
		public function clearOrderDealsCart( $requestMap ) {
			$params = array('session_cookie'=>$requestMap['cart_session'],'restid'=>$requestMap['restid']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_DEALS_CART);
		}
		public function removeDealFromCart( $requestMap ) {
			$params = array('session_cookie'=>$requestMap['cart_session'],'restid'=>$requestMap['restid'],'dealid'=>$requestMap['dealid']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_DEALS_CART);
		}
		
		public function getItemSubItemsByIdNSet($itemid,$restid,$itemset, $cart_session){
		 	$params = array('session_cookie'=>$cart_session,'restid'=>$restid,'itemid'=>$itemid,'itemset'=>$itemset);
		 	$this->db->select('sub_item_id,sub_item_key')
					 ->from(TABLES::$ORDER_SUB_CART)
 					 ->where($params);
		 	$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}
		
		public function getOrderSubItemsItemset( $map ) {
		 	$params = array('session_cookie'=>$map['session_cookie'],'restid'=>$map['restid'],'itemid'=>$map['itemid']);
		 	$this->db->select('max(itemset) as itemset',FALSE)
					 ->from(TABLES::$ORDER_SUB_CART)
 					 ->where($params);
		 	$query = $this->db->get();
	    	$result = $query->result_array();
	    	return $result;
		}
		
		public function removeItemSubItemsFromCart( $itemid,$restid,$itemset, $cart_session ) {
			$params = array('session_cookie'=>$cart_session,'itemid'=>$itemid,'restid'=>$restid,'itemset'=>$itemset);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_SUB_CART);
		}
		
		public function getItemSubItemsFromCart($map) {
		 	$params = array('session_cookie'=>$map['session_cookie'],'restid'=>$map['restid'],'option_id'=>$map['option_id'],'itemset'=>$map['itemset']);
		 	$this->db->select('sub_item_id,subitem_price')
					 ->from(TABLES::$ORDER_SUB_CART)
 					 ->where($params);
		 	$query = $this->db->get();
	    	$result = $query->result_array();
	    	return $result;
		}
		
	/*	public function getAllSubItemsFromCart($map) {
			$params = array('session_cookie'=>$map['session_cookie'],'restid'=>$map['restid']);
			$this->db->select('a.itemid,a.option_id,a.sub_item_id,a.itemset,b.option_cat_id,b.option_cat_name,b.sortorder as ocatsortorder,c.sub_item_name,d.price');
			$this->db->from(TABLES::$ORDER_SUB_CART.' AS a');
			$this->db->join(TABLES::$MENU_OPTION_CATEGORY.' AS b','a.option_id=b.id','inner');
			$this->db->join(TABLES::$MENU_OPTION.' AS c','b.new_sub_item_key=c.new_sub_item_key','inner');
			$this->db->join(TABLES::$MENU_OPTION_PRICE.' AS d','c.sub_item_id=d.sub_item_id','inner');
			$this->db->where('a.sub_item_id=c.sub_item_id','',false);
			$this->db->where($params);
			$this->db->order_by('a.option_id','ASC');
			$this->db->order_by('a.itemset','ASC');
			$this->db->order_by('b.option_cat_id','ASC');
			$this->db->order_by('b.sortorder','ASC');
			$this->db->order_by('c.sub_item_name','ASC');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}*/
		
		public function getAllSubItemsFromCart($map) {
			$params = array('session_cookie'=>$map['session_cookie'],'restid'=>$map['restid']);
			$this->db->select('a.itemid,a.option_id,a.sub_item_id,a.itemset');
			$this->db->from(TABLES::$ORDER_SUB_CART.' AS a');
			$this->db->where($params);
			$this->db->order_by('a.option_id','ASC');
			$this->db->order_by('a.itemset','ASC');
			$query = $this->db->get();
			$result = $query->result_array();
			return $result;
		}
		
		public function addAllSubItemsToCart( $batch ) {
			$this->db->insert_batch(TABLES::$ORDER_SUB_CART,$batch);
		}
		
		public function addBatchItemToCart($map) {
			$params = array('session_cookie'=>$map['session_cookie'],'restid'=>$map['restid']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_CART);
			$this->db->insert_batch(TABLES::$ORDER_CART,$map['items']);
		}
		
		public function addBatchSubItemToCart($map) {
			$params = array('session_cookie'=>$map['session_cookie'],'restid'=>$map['restid']);
			$this->db->where($params);
			$this->db->delete(TABLES::$ORDER_SUB_CART);
			$this->db->insert_batch(TABLES::$ORDER_SUB_CART,$map['subitems']);
		}
	}
?>