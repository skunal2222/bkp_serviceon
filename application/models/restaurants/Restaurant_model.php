<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Restaurant_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function getVendorReport($params) {
		/* $this->db->select('a.*,b.orderid,c.name as category,d.name as brand,e.name as model,f.name as subcategory,g.name as service')
		->from(TABLES::$RESTAURANT.' AS a')
		->join(TABLES::$ORDER.' AS b','a.id = b.vendor_id','inner')
		->join(TABLES::$MENU_MAIN_CATEGORY.' AS c','a.category_id = c.id','inner')
		->join(TABLES::$BRAND.' AS d','a.brand_id= d.id','inner')
		->join(TABLES::$MANUFACTURE.' AS e','a.model_id = e.id','inner')
		->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS f','a.subcategory_id = f.id','inner')
		->join(TABLES::$SERVICE.' AS g','a.service_id = g.id','inner');
		 */
		$this->db->select('a.*,b.orderid,count(b.orderid) as ordercount,c.name as category')
			 ->from(TABLES::$RESTAURANT.' AS a')
			 ->join(TABLES::$ORDER.' AS b','a.id = b.vendor_id','left')
			 ->join(TABLES::$MENU_MAIN_CATEGORY.' AS c','a.category_id = c.id','inner');
		
		/* if(!empty($params['from_date']) && !empty($params['to_date']))
			$this->db->where("DATE(b.pickup_date) between '".$params['from_date']."' and '".$params['to_date']."'",'',false); */
		//$this->db->order_by('b.orderid','asc');
		$this->db->group_by('a.id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	public function getVendorDetails($params) {
		$this->db->select('a.*,b.commission_service,b.commission_spare,b.with_service_tax,c.name as category,sum(d.amount_received) as totalbill')
		->from(TABLES::$RESTAURANT.' AS a')
		->join(TABLES::$RESTAURANT_BILLING_CONFIG.' AS b','a.id = b.restid','left')
		->join(TABLES::$MENU_MAIN_CATEGORY.' AS c','a.category_id = c.id','inner')
		->join(TABLES::$ORDER.' AS d','a.id = d.vendor_id','left');
	
		$this->db->where('d.status !=',5);
		$this->db->where('a.id',$params['vendorid']);
		if(!empty($params['from_date']) && !empty($params['to_date']))
			$this->db->where("DATE(d.pickup_date) between '".$params['from_date']."' and '".$params['to_date']."'",'',false);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	public function getvendorDetailReport($params) {
		$this->db->select('a.*,b.name,b.mobile,b.email,b.is_new_customer,c.name as areaname,d.name as pickup_executive,d.mobile as pickup_executive_mobile,e.name as delivery_executive,e.mobile as delivery_executive_mobile,f.status as payment_status,g.name as category,h.name as brand,i.name as model,j.name as subcategory,k.garage_name,l.commission_service,l.commission_spare,l.with_service_tax')
			->from(TABLES::$ORDER.' AS a')
			->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
			->join(TABLES::$AREA.' AS c','a.areaid = c.id','left')
			->join(TABLES::$FIELD_EXECUTIVE.' AS d','a.pickup_exe_id = d.id','left')
			->join(TABLES::$FIELD_EXECUTIVE.' AS e','a.delivery_exe_id = e.id','left')
			->join(TABLES::$PAYMENT_DETAIL.' AS f','a.orderid = f.orderid','left')
			->join(TABLES::$MENU_MAIN_CATEGORY.' AS g','a.category_id = g.id','inner')
			->join(TABLES::$BRAND.' AS h','a.brand_id= h.id','inner')
			->join(TABLES::$MANUFACTURE.' AS i','a.vehicle_model = i.id','inner')
			->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS j','a.subcategory_id = j.id','inner')
			->join(TABLES::$RESTAURANT.' AS k','a.assign_vendor_id = k.id','left')
			->join(TABLES::$RESTAURANT_BILLING_CONFIG.' AS l','a.assign_vendor_id = l.restid','left');
		
		$this->db->where('a.status !=',5);
		$this->db->where('a.assign_vendor_id',$params['vendorid']);
		if(!empty($params['from_date']) && !empty($params['to_date']))
			$this->db->where("DATE(a.pickup_date) between '".$params['from_date']."' and '".$params['to_date']."'",'',false);
		$this->db->order_by('a.pickup_date','asc');
		$this->db->group_by('a.orderid');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}
	
	public function searchVendors($params) {
		$this->db->select('a.*')
		->from(TABLES::$RESTAURANT.' AS a');
		
		if(!empty($params['from_date']) && !empty($params['to_date']))
			$this->db->where("DATE(a.date) between '".$params['from_date']."' and '".$params['to_date']."'",'',false);
		$this->db->order_by('a.date','asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

 	public function addRestaurant($params) {


		$data = array ();
		$map = array (
				'mobile' => $params ['mobile'],
				'email' => $params ['email'],
				'name' => $params ['name'] 
		);

		 // $where = "mobile LIKE '".$params ['mobile']."' OR email LIKE '".$params ['email']."' OR name LIKE '".$params ['name']."'";
		 $where = "mobile LIKE '".$params ['mobile']."' OR name LIKE '".$params ['name']."'";

		$this->db->select ( 'id' )->from ( TABLES::$RESTAURANT )->where ( $where );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
 
		if (count ( $result ) == 0) {
			$this->db->insert ( TABLES::$RESTAURANT, $params );
			$id = $this->db->insert_id ();
			$data ['id'] = $id;
			$data ['status'] = 1;
			$data ['msg'] = "Vendor added successfully";
			return $data;
		} else {
			$errors = array ();
			$data ['msg'] = "Vendor already exists.";
			$data ['status'] = 0;
			//$data ['message'] = $errors;
			return $data;
		}
	}
	
		public function updateVendor_new($rest) {
		$data = array ();
		$map = array (
		'id' => $rest ['id'] 
		);
		$this->db->select ( 'id' )->from ( TABLES::$RESTAURANT )->where ( $map );
		$query = $this->db->get ();
		$result = $query->result_array ();

		if (count ( $result ) == 0) {
			$this->db->insert ( TABLES::$RESTAURANT, $rest );
			$id = $this->db->insert_id ();
			$data ['id'] = $id;
			$data ['status'] = 1;
			$data ['message'] = "Vendor added successfully";
			return $data;
		} else {
			
		$this->db->where ( 'id', $rest['id'] );
		$flag = $this->db->update ( TABLES::$RESTAURANT, $rest );
		if ($flag) {
			$map ['id'] = $rest ['id'];
			$map ['status'] = 1;
			$map ['msg'] = 'Vendor Updated successfully.';
		} else {
			$map ['status'] = 1;
			$map ['msg'] = 'Vendor Updated successfully.';
		}
		return $map;
		}
	}
	public function addRestaurantCuisines($params) {
		$this->db->insert_batch ( TABLES::$RESTAURANT_CUISINES, $params );
	}
	public function addRestaurantContacts($params) {
		$this->db->insert ( TABLES::$RESTAURANT_CONTACTS, $params );
	}
	public function addRestaurantProperties($params) {
		$this->db->insert ( TABLES::$RESTAURANT_PROPERTY, $params );
	}
	public function addRestaurantMov($params) {
		$this->db->insert_batch ( TABLES::$RESTAURANT_MOV, $params );
	}
	public function addRestaurantDeliveryTime($params) {
		$this->db->insert_batch ( TABLES::$RESTAURANT_DEL_TIME, $params );
	}
	public function addRestaurantSlabs($params) {
		$this->db->insert_batch ( TABLES::$RESTAURANT_SLABS, $params );
	}
	public function addRestaurantBillingConfig($params) {
		$this->db->insert ( TABLES::$RESTAURANT_BILLING_CONFIG, $params );
	}
	public function addRestaurantBillingFields($params) {
		$this->db->insert_batch ( TABLES::$RESTAURANT_BILLING_FIELDS, $params );
	}
	
	public function updateVendor($params) {
		$this->db->where ( 'id', $params ['id'] );
		$flag = $this->db->update ( TABLES::$RESTAURANT, $params ); 
		 
		$this->db->where ( 'id',$params ['id']);
		$this->db->select('*');
		$this->db->from( TABLES::$RESTAURANT); 
		$query = $this->db->get();
		$result = $query->result_array ();
		if ($flag) {
			$map ['id'] = $params ['id'];
			$map['userdata'] = $result[0];
			$map ['status'] = 1;
			$map ['msg'] = 'Added successfully.';
		} else {
			$map ['status'] = 1;
			$map ['msg'] = 'Added successfully.';
		}
		return $map;
	
	}
	
	public function addVendor1($params) {
			//$this->db->insert_batch( TABLES::$RESTAURANT_SERVICE, $params );
			foreach($params as $row){
					if(!empty($row['service_id'])){
						$catvalue['restid'] = $row['restid'];
						$catvalue['subcategory_id'] = $row['subcategory_id'];
						$catvalue['service_id'] = $row['service_id'];
						$this->db->insert ( TABLES::$RESTAURANT_SERVICE, $catvalue);
					}
				}
	}
	
	public function updateRestaurantDetails($params) {
		$this->db->where ( 'id', $params ['id'] );
		$flag = $this->db->update ( TABLES::$RESTAURANT, $params );
		if ($flag) {
			$map ['status'] = 1;
			$map ['msg'] = 'Updated successfully.';
		} else {
			$map ['status'] = 1;
			$map ['msg'] = 'Updated successfully.';
		}
		return $map;
	}
	public function updateRestaurantCuisines($params) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_CUISINES )->where ( 'restid', $params [0] ['restid'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) > 0) {
			$this->db->where ( 'restid', $params [0] ['restid'] );
			$this->db->delete ( TABLES::$RESTAURANT_CUISINES );
		}
		$this->db->insert_batch ( TABLES::$RESTAURANT_CUISINES, $params );
	}
	public function updateRestaurantContacts($params) {
		$this->db->where ( 'restid', $params ['restid'] );
		$flag = $this->db->update ( TABLES::$RESTAURANT_CONTACTS, $params );
		if ($flag) {
			$map ['status'] = 1;
			$map ['msg'] = 'Updated successfully.';
		} else {
			$map ['status'] = 1;
			$map ['msg'] = 'Updated successfully.';
		}
		return $map;
	}
	public function updateRestaurantProperties($params) {
		$this->db->where ( 'restid', $params ['restid'] );
		$flag = $this->db->update ( TABLES::$RESTAURANT_PROPERTY, $params );
		if ($flag) {
			$map ['status'] = 1;
			$map ['msg'] = 'Updated successfully.';
		} else {
			$map ['status'] = 1;
			$map ['msg'] = 'Updated successfully.';
		}
		return $map;
	}
	public function updateRestaurantMov($params) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_MOV )->where ( 'restid', $params [0] ['restid'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) > 0) {
			$this->db->where ( 'restid', $params [0] ['restid'] );
			$this->db->delete ( TABLES::$RESTAURANT_MOV );
		}
		$this->db->insert_batch ( TABLES::$RESTAURANT_MOV, $params );
	}
	public function updateRestaurantDeliveryTime($params) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_DEL_TIME )->where ( 'restid', $params [0] ['restid'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) > 0) {
			$this->db->where ( 'restid', $params [0] ['restid'] );
			$this->db->delete ( TABLES::$RESTAURANT_DEL_TIME );
		}
		$this->db->insert_batch ( TABLES::$RESTAURANT_DEL_TIME, $params );
	}
	public function updateRestaurantSlabs($params) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_SLABS )->where ( 'restid', $params [0] ['restid'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) > 0) {
			$this->db->where ( 'restid', $params [0] ['restid'] );
			$this->db->delete ( TABLES::$RESTAURANT_SLABS );
		}
		$this->db->insert_batch ( TABLES::$RESTAURANT_SLABS, $params );
	}
	public function updateRestaurantBillingConfig($params) {
 
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_BILLING_CONFIG )->where ( 'restid', $params ['restid'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) > 0) {

			$this->db->where ( 'restid', $params ['restid'] );
			$flag = $this->db->update ( TABLES::$RESTAURANT_BILLING_CONFIG, $params );
			error_log($this->db->last_query());

			if ($flag) {
				$map ['status'] = 1;
				$map ['msg'] = 'Updated successfully.';
			} else {
				$map ['status'] = 0;
				$map ['msg'] = 'Invalid effective date.';
			}
		}
		else
		{
			$this->db->insert ( TABLES::$RESTAURANT_BILLING_CONFIG, $params );
			$map ['status'] = 1;
			$map ['msg'] = 'Updated successfully.';
			error_log($this->db->last_query());
		}
		return $map;
	}
	public function updateRestaurantBillingFields($params) {
		$result = $this->getRestaurantBillingFieldByDate ( $params ['restid'], $params ['billing_field'], $params ['from_date'] );
		if (count ( $result ) > 0) {
			if ($result [0] ['to_date'] == null && $params ['from_date'] > $result [0] ['from_date']) {
				$newdate = date ( 'Y-m-d', strtotime ( '-1 day', strtotime ( $params ['from_date'] ) ) );
				$newparams = array ();
				$newparams ['to_date'] = $newdate;
				$this->db->where ( 'restid', $params ['restid'] );
				$this->db->where ( 'billing_field', $params ['billing_field'] );
				$this->db->update ( TABLES::$RESTAURANT_BILLING_FIELDS, $newparams );
				$this->db->insert ( TABLES::$RESTAURANT_BILLING_FIELDS, $params );
				error_log($this->db->last_query());
				$map ['status'] = 1;
				$map ['msg'] = 'Updated successfully.';
			} else {
				$map ['status'] = 0;
				$map ['msg'] = 'Invalid effective date.';
			}
		} else {
			$this->db->insert ( TABLES::$RESTAURANT_BILLING_FIELDS, $params );
			$map ['status'] = 1;
			$map ['msg'] = 'Updated successfully.';
			error_log($this->db->last_query());
		}
		return $map;
	}
	
	public function batchUpdateRestaurants($params){
		$this->db->update_batch(TABLES::$RESTAURANT,$params,'id');
	}
	
	/*public function getRestaurants($map) {
		$this->db->select ( 'a.*,b.name as area_name' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$AREA . ' AS b', 'a.areaid=b.id', 'inner' );
		if (isset ( $map ['areaid'] ) && $map ['areaid'] != "") {
			$this->db->where ( 'a.areaid', $map ['areaid'] );
		}
		if (isset ( $map ['name'] ) && $map ['name'] != "") {
			$this->db->like ( 'a.name', $map ['name'], 'both' );
		}
		if (isset ( $map ['id'] ) && $map ['id'] != "") {
			$this->db->where ( 'a.id', $map ['id'] );
		}
		if (isset ( $map ['status'] ) && $map ['status'] != "") {
			$this->db->where ( 'a.status', $map ['status'] );
		}
		$this->db->order_by('a.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	} */
	
		public function getRestaurants($map) {
		$this->db->select ( 'a.*' )->from ( TABLES::$RESTAURANT . ' AS a' );
		
		if (isset ( $map ['name'] ) && $map ['name'] != "") {
			$this->db->like ( 'a.name', $map ['name'], 'both' );
		}
		if (isset ( $map ['id'] ) && $map ['id'] != "") {
			$this->db->where ( 'a.id', $map ['id'] );
		}
		if (isset ( $map ['status'] ) && $map ['status'] != "") {
			$this->db->where ( 'a.status', $map ['status'] );
		}
		$this->db->order_by('a.id','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getGarage($map)
	{
		$day = strtolower ( date ( 'D' ) );
		$nowTime = '"'.date('H:i:s').'"';
		$distance = '6371000 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) )';
		$this->db->select ( 'a.id,a.radius, a.model_id, a.garage_name, IFNULL( 6371000 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) ) ,0) AS distance' )->from ( TABLES::$RESTAURANT . ' AS a' );
		//$this->db->where ( 'a.status', 1 );
		$this->db->having ( 'distance < a.radius', '', FALSE );
		$query = $this->db->get();
		$result = $query->result_array ();
		//print_r($result);
		return $result;
	
		
		/*$this->db->distinct('a.garage_name');
		$this->db->select( 'a.id,a.garage_name,c.*' )
		->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$AREA . ' AS b', 'a.areaid=b.id', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_SERVICE . ' AS c', 'a.id=c.restid', 'inner' );
		$this->db->where( 'a.areaid', $map['areaid']);
		//$this->db->where_in( 'c.service_id', $map['service_id']);
		//$this->db->where('c.service_id IN',(implode(',',$map['service_id'])));
		foreach($map['service_id'] as $row)
		{    // where $org is the instance of one object of active record
		$this->db->or_where('c.service_id',$row);
		}
		$this->db->group_by ('a.id','ASC');
		$this->db->limit(3);
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;*/
	}
	
	public function getRestaurants1() {
		$this->db->select ( 'a.*,b.name as area_name' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$AREA . ' AS b', 'a.areaid=b.id', 'inner' );
		
		$this->db->order_by('a.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getRestaurantBasicDetails($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantTimings($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_TIMINGS . ' AS a' );
		//$this->db->join ( TABLES::$RESTAURANT_PROPERTY . ' AS b', 'a.id=b.restid', 'inner' );
		$this->db->where ( 'a.restid', $id );
		//echo $this->db->_compile_select();
		//$query = $this->db->query ('SELECT * FROM tbl_restaurant_timing where restid='.$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		//print_r($result) ;
		// customecho $this->db->last_query();return
		return $result;
		
	}
	public function getRestaurantTimingsByDay($id, $day) {
		$this->db->select ( 'morning_open_time as mstart_time,morning_closing_time as mclose_time,evening_open_time as estart_time,evening_closing_time as eclose_time' )->from ( TABLES::$RESTAURANT_TIMINGS );
		$this->db->where ( 'restid', $id );
		$this->db->where ( 'day', $day );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantCuisines($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_CUISINES );
		$this->db->where ( 'restid', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantContacts($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_CONTACTS );
		$this->db->where ( 'restid', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantProperties($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_PROPERTY );
		$this->db->where ( 'restid', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantSlabs($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_SLABS );
		$this->db->where ( 'restid', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantDeliveryTime($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_DEL_TIME );
		$this->db->where ( 'restid', $id );
		$this->db->order_by ( "field(day,'mon','tue','wed','thu','fri','sat','sun'),from_rad ASC", '', TRUE );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantDelTime($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_DEL_TIME );
		$this->db->where ( 'restid', $id );
		$this->db->order_by ( "from_rad ASC,field(day,'mon','tue','wed','thu','fri','sat','sun')", '', TRUE );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantMov($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_MOV );
		$this->db->where ( 'restid', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantBillingConfig($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_BILLING_CONFIG );
		$this->db->where ( 'restid', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantBillingField($restid, $field) {
		$curr_date = date ( 'Y-m-d' );
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_BILLING_FIELDS );
		$this->db->where ( "restid=" . $restid . " AND billing_field='" . $field . "' AND '" . $curr_date . "' BETWEEN from_date AND to_date", '', FALSE );
		$this->db->or_where ( "restid=" . $restid . " AND billing_field='" . $field . "' AND to_date IS NULL", '', FALSE );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantBillingFieldByDate($restid, $field, $date) {
		$curr_date = $date;
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_BILLING_FIELDS );
		$this->db->where ( "restid=" . $restid . " AND billing_field='" . $field . "' AND '" . $curr_date . "' BETWEEN from_date AND to_date", '', FALSE );
		$this->db->or_where ( "restid=" . $restid . " AND billing_field='" . $field . "' AND to_date IS NULL", '', FALSE );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function addRestaurantConfig($params) {
		$this->db->insert ( TABLES::$RESTAURANT_CONFIG, $params );
	}
	public function updateRestaurantConfig($params) {
		$this->db->where ( 'restid', $params ['restid'] );
		return $this->db->update ( TABLES::$RESTAURANT_CONFIG, $params );
	}
	public function getRestaurantConfig($restid) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_CONFIG );
		$this->db->where ( 'restid', $restid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function verifyRestaurant($restid) {
		$date = date ( 'Y-m-d H:i:s' );
		$params = array (
				'is_verified' => 1,
				'verification_date' => $date 
		);
		$this->db->where ( 'id', $restid );
		return $this->db->update ( TABLES::$RESTAURANT, $params );
	}
	public function makeRestaurantLive($restid) {
		$date = date ( 'Y-m-d H:i:s' );
		$params = array (
				'status' => 1,
				'live_date' => $date 
		);
		$this->db->where ( 'id', $restid );
		return $this->db->update ( TABLES::$RESTAURANT, $params );
	}
	public function getSearchLink($map) {
		$this->db->select ( 'a.areaid,a.radius,IFNULL( 6371000 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) ) ,0) AS distance,b.name as cityname,c.name as locality' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$AREA . ' AS c', 'a.areaid=c.id', 'inner' );
		$this->db->join ( TABLES::$CITY . ' AS b', 'c.cityid=b.id', 'inner' );
		$this->db->where ( 'a.status', 1 );
		$this->db->having ( 'distance < a.radius', '', FALSE );
		$this->db->order_by ( 'distance', 'ASC' );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function searchRestaurants($map) {
		$day = strtolower ( date ( 'D' ) );
		$nowTime = '"'.date('H:i:s').'"';
		$distance = '6371000 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) )';
		$this->db->select ( 'a.*,IFNULL( 6371000 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) ) ,0) AS distance,
				b.name as cityname,c.name as locality,c.zone_id,group_concat(DISTINCT e.name SEPARATOR ", ") as cuisines,	f.amount as mov,g.time,h.online_payment, 
     			j.morning_open_time, j.morning_closing_time,j.evening_open_time, j.evening_closing_time,
				IF ((('.$nowTime.' BETWEEN  j.morning_open_time AND j.morning_closing_time) 
    			OR ('.$nowTime.' BETWEEN  j.evening_open_time AND j.evening_closing_time )),1,0) preorder,k.discount_type,(k.discount_by_zk+discount_by_rest) as total_discount,k.from_date as offer_start_date,k.to_date as offer_end_date,k.status as offer_status' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$AREA . ' AS c', 'a.areaid=c.id', 'inner' );
		$this->db->join ( TABLES::$CITY . ' AS b', 'c.cityid=b.id', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_CUISINES . ' AS d', 'a.id=d.restid', 'left' );
		$this->db->join ( TABLES::$CUISINE . ' AS e', 'd.cuisine_id=e.id', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_MOV . ' AS f', 'a.id=f.restid', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_DEL_TIME . ' AS g', 'a.id=g.restid', 'left' );
		$this->db->join ( TABLES::$RESTAURANT_PROPERTY . ' AS h', 'a.id=h.restid', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_TIMINGS . ' AS j', 'a.id=j.restid', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_OFFER . ' AS k', 'a.id=k.restid', 'left' );
		$this->db->where ( $distance . ' BETWEEN f.from_rad and f.to_rad', '', FALSE );
		$this->db->where ( $distance . ' BETWEEN g.from_rad and g.to_rad', '', FALSE );
		$this->db->where ( 'j.day', $day );
		$this->db->where ( 'j.holiday', 0 );
		$this->db->where ( 'h.services != 2', '', false );
		if (! empty ( $map ['maxFee'] ))
			$this->db->where ( 'f.amount BETWEEN ' . $map ['minFee'] . ' and ' . $map ['maxFee'], '', FALSE );
		if (! empty ( $map ['cuisines'] ))
			$this->db->where ( 'd.cuisine_id IN(' . $map ['cuisines'] . ')', '', FALSE );
		if (! empty ( $map ['mainfilter'] ) && $map ['mainfilter'] == 'veg')
			$this->db->where ( 'a.is_veg', 1 );
		if (! empty ( $map ['mainfilter'] ) && $map ['mainfilter'] == 'online')
			$this->db->where ( 'h.online_payment', 1 );
		if (! empty ( $map ['mainfilter'] ) && $map ['mainfilter'] == 'offers')
			$this->db->where ( 'a.has_deal', 1 );
		$this->db->where ( 'g.day', $day );
		$this->db->where ( 'a.status', 1 );
		$this->db->having ( 'distance < a.radius', '', FALSE );
		$this->db->group_by ( 'a.id' );
		$this->db->order_by ( 'preorder', 'DESC' );
		if((empty ( $map ['veg'] ) || $map ['veg'] == 'random') && (empty ( $map ['online']) || $map ['online'] == 'random') && (empty ( $map ['offers'] ) || $map ['offers'] == 'random') && (empty ( $map ['mov'] ) || $map ['mov'] == 'random')) {
			$this->db->order_by ( 'promote', 'DESC' );
			$this->db->order_by ( 'distance', 'ASC' );
		}
		if (! empty ( $map ['veg'] ) && $map ['veg'] != 'random')
			$this->db->order_by ( 'a.is_veg', $map ['veg'] );
		if (! empty ( $map ['online'] ) && $map ['online'] != 'random')
			$this->db->order_by ( 'h.online_payment', $map ['online'] );
		if (! empty ( $map ['offers'] ) && $map ['offers'] != 'random')
			$this->db->order_by ( 'a.has_deal', $map ['offers'] );
		if (! empty ( $map ['mov'] ) && $map ['mov'] != 'random')
			$this->db->order_by ( 'f.amount', $map ['mov'] );
		
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function searchClientRestaurants($map) {
		$this->db->select ( 'a.*,b.name as locality' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$AREA . ' AS b', 'a.areaid=b.id', 'inner' );
		$this->db->join ( TABLES::$CLIENT_RESTAURANTS . ' AS c', 'a.id=c.restid', 'inner' );
		$this->db->where('c.client_id',$map['client_id']);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getRestaurantDetails($map) {
		$day = strtolower ( date ( 'D' ) );
		$distance = '6371000 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) )';
		$this->db->select ( 'a.*,IFNULL( 6371000 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) ) ,0) AS distance,b.name as cityname,c.name as locality,c.cityid,group_concat(DISTINCT e.name SEPARATOR ", ") as cuisines,f.amount as mov,g.time,h.online_payment,h.services,j.morning_open_time as mstart_time,j.morning_closing_time as mclose_time,j.evening_open_time as estart_time,j.evening_closing_time as eclose_time,h.tax,h.service_charge,h.is_packaging_tax,i.charge as delivery_charge' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$AREA . ' AS c', 'a.areaid=c.id', 'inner' );
		$this->db->join ( TABLES::$CITY . ' AS b', 'c.cityid=b.id', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_CUISINES . ' AS d', 'a.id=d.restid', 'left' );
		$this->db->join ( TABLES::$CUISINE . ' AS e', 'd.cuisine_id=e.id', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_MOV . ' AS f', 'a.id=f.restid', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_DEL_TIME . ' AS g', 'a.id=g.restid', 'left' );
		$this->db->join ( TABLES::$RESTAURANT_SLABS . ' AS i', 'a.id=i.restid', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_PROPERTY . ' AS h', 'a.id=h.restid', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_TIMINGS . ' AS j', 'a.id=j.restid', 'left' );
		$this->db->where ( $distance . ' BETWEEN f.from_rad and f.to_rad', '', FALSE );
		$this->db->where ( $distance . ' BETWEEN g.from_rad and g.to_rad', '', FALSE );
		$this->db->where ( $distance . ' BETWEEN i.from_rad and i.to_rad', '', FALSE );
		if (! empty ( $map ['sub_total'] )) {
			$this->db->where ( $map ['sub_total'] . ' BETWEEN i.lower_limit and i.upper_limit', '', FALSE );
		}
		$this->db->where ( 'a.id', $map ['restid'] );
		$this->db->where ( 'g.day', $day );
		$this->db->where ( 'j.day', $day );
		$this->db->group_by ( 'a.id' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->select ( 'a.*,IFNULL( 6371000 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) ) ,0) AS distance,b.name as cityname,c.name as locality,c.cityid,group_concat(DISTINCT e.name SEPARATOR ", ") as cuisines,f.amount as mov,g.time,h.online_payment,h.services,j.morning_open_time as mstart_time,j.morning_closing_time as mclose_time,j.evening_open_time as estart_time,j.evening_closing_time as eclose_time,h.tax,h.service_charge,h.is_packaging_tax,i.charge as delivery_charge' )->from ( TABLES::$RESTAURANT . ' AS a' );
			$this->db->join ( TABLES::$AREA . ' AS c', 'a.areaid=c.id', 'inner' );
			$this->db->join ( TABLES::$CITY . ' AS b', 'c.cityid=b.id', 'inner' );
			$this->db->join ( TABLES::$RESTAURANT_CUISINES . ' AS d', 'a.id=d.restid', 'left' );
			$this->db->join ( TABLES::$CUISINE . ' AS e', 'd.cuisine_id=e.id', 'inner' );
			$this->db->join ( TABLES::$RESTAURANT_MOV . ' AS f', 'a.id=f.restid', 'inner' );
			$this->db->join ( TABLES::$RESTAURANT_DEL_TIME . ' AS g', 'a.id=g.restid', 'left' );
			$this->db->join ( TABLES::$RESTAURANT_SLABS . ' AS i', 'a.id=i.restid', 'left' );
			$this->db->join ( TABLES::$RESTAURANT_PROPERTY . ' AS h', 'a.id=h.restid', 'left' );
			$this->db->join ( TABLES::$RESTAURANT_TIMINGS . ' AS j', 'a.id=j.restid', 'left' );
			$this->db->where ( $distance . ' BETWEEN f.from_rad and f.to_rad', '', FALSE );
			$this->db->where ( $distance . ' BETWEEN g.from_rad and g.to_rad', '', FALSE );
			$this->db->where ( $distance . ' BETWEEN i.from_rad and i.to_rad', '', FALSE );
			$this->db->where ( 'a.id', $map ['restid'] );
			$this->db->where ( 'g.day', $day );
			$this->db->where ( 'j.day', $day );
			$this->db->group_by ( 'a.id' );
			$query = $this->db->get ();
			$result = $query->result_array ();
			if (count($result) <= 0) {
				$this->db->select ( 'a.*,IFNULL( 6371000 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) ) ,0) AS distance,b.name as cityname,c.name as locality,c.cityid,group_concat(DISTINCT e.name SEPARATOR ", ") as cuisines,f.amount as mov,g.time,h.online_payment,h.services,j.morning_open_time as mstart_time,j.morning_closing_time as mclose_time,j.evening_open_time as estart_time,j.evening_closing_time as eclose_time,h.tax,h.service_charge,h.is_packaging_tax,i.charge as delivery_charge' )->from ( TABLES::$RESTAURANT . ' AS a' );
				$this->db->join ( TABLES::$AREA . ' AS c', 'a.areaid=c.id', 'inner' );
				$this->db->join ( TABLES::$CITY . ' AS b', 'c.cityid=b.id', 'inner' );
				$this->db->join ( TABLES::$RESTAURANT_CUISINES . ' AS d', 'a.id=d.restid', 'left' );
				$this->db->join ( TABLES::$CUISINE . ' AS e', 'd.cuisine_id=e.id', 'inner' );
				$this->db->join ( TABLES::$RESTAURANT_MOV . ' AS f', 'a.id=f.restid', 'inner' );
				$this->db->join ( TABLES::$RESTAURANT_DEL_TIME . ' AS g', 'a.id=g.restid', 'left' );
				$this->db->join ( TABLES::$RESTAURANT_SLABS . ' AS i', 'a.id=i.restid', 'left' );
				$this->db->join ( TABLES::$RESTAURANT_PROPERTY . ' AS h', 'a.id=h.restid', 'left' );
				$this->db->join ( TABLES::$RESTAURANT_TIMINGS . ' AS j', 'a.id=j.restid', 'left' );
				$this->db->where ( 'a.id', $map ['restid'] );
				$this->db->where ( 'j.day', $day );
				$this->db->group_by ( 'a.id' );
				$query = $this->db->get ();
				$result = $query->result_array ();
			}
		}
		return $result;
	}
	
	public function getAreasByRestId($restid) {
		$this->db->select ( 'a.*' )->from ( TABLES::$AREA . ' AS a' );
		$this->db->join ( TABLES::$RESTAURANT . ' AS b', 'a.id=b.areaid', 'inner' );
		$this->db->where ( 'b.id', $restid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function updateRestaurantTimings($map) {
		$this->db->where ( 'restid', $map ['restid'] );
		$this->db->where ( 'day', $map ['day'] );
		$res = $this->db->update ( TABLES::$RESTAURANT_TIMINGS, $map );
		return $res;
	}
	public function addRestaurantTimings($params) {
		$this->db->insert_batch ( TABLES::$RESTAURANT_TIMINGS, $params );
	}
	public function deleteRestaurantTimings($restid) {
		$this->db->where ( 'restid', $restid );
		$this->db->delete ( TABLES::$RESTAURANT_TIMINGS );
	}
	public function getNewRestaurants() {
		$this->db->select ( 'a.id as restid,a.name,a.logo,a.is_veg,a.promote,a.areaid,b.name as areaname,b.cityid,' . 'c.name as cityname,group_concat(DISTINCT e.name SEPARATOR ", ") as cuisines,' . 'f.online_payment' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$AREA . ' AS b', 'a.areaid=b.id', 'inner' );
		$this->db->join ( TABLES::$CITY . ' AS c', 'b.cityid=c.id', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_CUISINES . ' AS d', 'a.id=d.restid', 'left' );
		$this->db->join ( TABLES::$CUISINE . ' AS e', 'd.cuisine_id=e.id', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_PROPERTY . ' AS f', 'a.id=f.restid', 'inner' );
		$this->db->where ( 'a.status', 1 );
		$this->db->where ( '(f.source = 0 OR f.source = 2)', '', false );
		$this->db->group_by ( 'a.id' );
		$this->db->order_by ( 'a.live_date', 'DESC' );
		$this->db->limit ( 8 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getNewRestaurantDetails($restid) {
		$this->db->select ( 'a.*,b.name as areaname,c.name as cityname' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$AREA . ' AS c', 'a.areaid=c.id', 'inner' );
		$this->db->join ( TABLES::$CITY . ' AS b', 'c.cityid=b.id', 'inner' );
		$this->db->where ( 'a.id', $restid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getRestaurantCustomTimings($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT_TIMINGS );
		$this->db->where ( 'restid', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		//print_r($result);
		return $result;
	}
	
	/**
	 *
	 * change the status of resto from 1 to 0
	 * 
	 * @access public
	 * @param $id of
	 *        	city
	 *        	
	 */
	public function turnOffResto($id) {
		$rest ['status'] = 0;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$RESTAURANT, $rest );
	}
	
	/**
	 *
	 * change the status of resto from 0 to 1.
	 * 
	 * @access public
	 * @param
	 *        	id of city
	 */
	public function turnOnResto($id) {
		$rest ['status'] = 1;
		$this->db->where ( 'id', $id );
		$this->db->update ( TABLES::$RESTAURANT, $rest );
	}
	
	public function getSearchedCuisines($map) {
		$day = strtolower ( date ( 'D' ) );
		$nowTime = '"'.date('H:i:s').'"';
		$distance = '6371000 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) )';
		$this->db->select ( 'a.radius,IFNULL( 6371000 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) ) ,0) AS distance,e.id,e.name' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$RESTAURANT_CUISINES . ' AS d', 'a.id=d.restid', 'inner' );
		$this->db->join ( TABLES::$CUISINE . ' AS e', 'd.cuisine_id=e.id', 'inner' );
		$this->db->where ( 'a.status', 1 );
		$this->db->having ( 'distance < a.radius', '', FALSE );
		$query = $this->db->get ();
		$last_query = $this->db->last_query();
		$new_query = 'SELECT m.* FROM ('.$last_query.') AS m GROUP BY m.id';
		$query = $this->db->query($new_query);
		$result = $query->result_array ();
		return $result;
	}
	
	public function getRestaurantsCuisinesByIds($restids) {
		$this->db->select ( 'e.id,e.name' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$RESTAURANT_CUISINES . ' AS d', 'a.id=d.restid', 'inner' );
		$this->db->join ( TABLES::$CUISINE . ' AS e', 'd.cuisine_id=e.id', 'inner' );
		$this->db->where ( 'a.id IN('.$restids.')', '',false);
		$this->db->group_by ( 'e.id');
		$this->db->order_by ( 'e.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateRestaurantGeo($data)
	{
		$id=$data['id'];
		unset($data['id']);
		$this->db->where('id=',$id);
		$this->db->update(TABLES::$RESTAURANT, $data);
	}
	public function savegeo($data)
	{
		if($data['fenceid']!=0)
		{
			$this->db->where('fenceid',$data['fenceid']);
			unset($data['fenceid']);
			$this->db->update(TABLES::$GEOFANCY,$data);
		}
		else {
			$this->db->insert(TABLES::$GEOFANCY,$data);
		}
	}
	public function getgeofance($restid)
	{
		$this->db->select ( '*' )->from ( TABLES::$GEOFANCY );
		$this->db->where ( 'restid', $restid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function addRestaurantLogs($data)
	{
		$this->db->insert_batch ( TABLES::$RESTAURANT_LOG, $data );
	}
	public function getLogsByrestid($restid)
	{
		$query = $this->db->query('select * from tbl_restaurant_logs where restid='.$restid.' order by id DESC limit 0,35');
		$result = $query->result_array ();
		return $result;
	}
	public function getpromotedRestaurant()
	
	{
		$this->db->select ( 'b.*,a.name as name,a.id as restid' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$PROMOTED_RESTAURANT . ' AS b', 'b.restid=a.id', 'left' );
		$this->db->join ( TABLES::$AREA . ' AS c', 'c.id=a.areaid', 'left' );
		$this->db->join ( TABLES::$ZONE . ' AS d', 'c.zone_id=d.id', 'left' );
		$this->db->where('a.status','1');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function promote($data)
	{
		return $this->db->insert_batch ( TABLES::$PROMOTED_RESTAURANT, $data );
	}
	public function promoteUpdate($data)
	{
		$this->db->where ( 'restid', $data ['restid'] );
		$this->db->update(TABLES::$PROMOTED_RESTAURANT,$data);
	}
	
	public function addPromtedRestaurants($promoted) {
		$this->db->insert_batch(TABLES::$PROMOTED_RESTAURANT,$promoted);
		$this->schedulePromotedRestaurants($promoted);
	}
	public function updatePromtedRestaurants($promoted) {
		$this->db->update_batch(TABLES::$PROMOTED_RESTAURANT,$promoted,'id');
		$this->schedulePromotedRestaurants($promoted);
	}
	public function turnoffPromotedResto ($id)
	{
	
		$this->db->where ( 'id', $id);
		$data['status'] = 0;
		$this->db->update(TABLES::$PROMOTED_RESTAURANT,$data);
		$promoted = $this->getPromotedRestaurantByRestId($id);
		$this->schedulePromotedRestaurants($promoted);
	}
	public function turnonPromotedResto ($id)
	{
		$data['status'] = 1;
		$this->db->where ( 'id', $id );
		$this->db->update(TABLES::$PROMOTED_RESTAURANT,$data);
		$promoted = $this->getPromotedRestaurantByRestId($id);
		$this->schedulePromotedRestaurants($promoted);
	}
	public function searchPromotedRestro($zone_id)
	{
		$this->db->select ( 'b.*,a.name as name,a.id as restid' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$PROMOTED_RESTAURANT . ' AS b', 'b.restid=a.id', 'left' );
		$this->db->join ( TABLES::$AREA . ' AS c', 'c.id=a.areaid', 'left' );
		$this->db->join ( TABLES::$ZONE . ' AS d', 'c.zone_id=d.id', 'left' );
		$this->db->where('d.id',$zone_id);
		$this->db->where('a.status','1');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getPromotedRestaurantByRestId($restid)
	{
		$this->db->select ( '*' )->from ( TABLES::$PROMOTED_RESTAURANT );
		$this->db->where ( 'restid', $restid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function schedulePromotedRestaurants($restaurants) {
		$current_date = date('Y-m-d');
		$rests = array();
		foreach ($restaurants as $restaurant) {
			$rest = array();
			$rest['id'] = $restaurant['restid'];
			$rest['priority'] = $restaurant['priority'];
			if ($restaurant['start_date'] <= $current_date && $restaurant['end_date'] >= $current_date) {
				if ($restaurant['status'] == 1) {
					$rest['promote'] = 1;
				} else {
					$rest['promote'] = 0;
				}
			} else {
				$rest['promote'] = 0;
			}
			$rests[] = $rest;
		}
		$this->db->update_batch ( TABLES::$RESTAURANT, $rests, 'id' );
	}
	
	public function getAllPromotedRestaurans()
	{
		$this->db->select ( '*' )->from ( TABLES::$PROMOTED_RESTAURANT );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function topRestaurant()
	{
		
		$this->db->select ( 'c.name as city,a.name,a.locality,a.id,COUNT( b.orderid ) AS ordercount' )->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join ( TABLES::$ORDER . ' AS b', 'b.restid=a.id', 'left' );
		$this->db->join ( TABLES::$CITY . ' AS c', 'c.id=a.cityid', 'left' );
		$this->db->where('b.status','1');
		$this->db->where('a.id !=','92');
		$this->db->group_by('a.id');
		$this->db->order_by('ordercount','desc');
		$this->db->limit('10');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
		
	}
	public function topArea()
	{
		$this->db->select ( 'c.id,c.name,c.latitude,c.longitude,COUNT( b.orderid ) AS ordercount' )->from ( TABLES::$AREA . ' AS c' );
		$this->db->join ( TABLES::$ORDER . ' AS b', 'b.areaid=c.id', 'left' );
		$this->db->where('b.status','1');
		$this->db->group_by('c.id');
		$this->db->order_by('ordercount','desc');
		$this->db->limit('10');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	
	}
	public function topCuisine()
	{
		$this->db->select ( 'd.id,d.name,COUNT( a.orderid ) AS ordercount' )
				 ->from ( TABLES::$ORDER . ' AS a' );
		$this->db->join ( TABLES::$RESTAURANT . ' AS b', 'a.restid=b.id', 'inner' );
		$this->db->join ( TABLES::$RESTAURANT_CUISINES . ' AS c', 'b.id=c.restid', 'inner' );
		$this->db->join ( TABLES::$CUISINE . ' AS d', 'c.cuisine_id=d.id', 'inner' );
		$this->db->where('a.status','1');
		$this->db->group_by('d.id');
		$this->db->order_by('ordercount','desc');
		$this->db->limit('10');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getCuisineByCuisineId($id)
	{
		$this->db->select('*')->from(TABLES::$CUISINE);
		$this->db->where('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getAllRestaurantByCuisine($cuisineid)
	{
		$brand = array();
		$this->db->select('*')->from(TABLES::$RESTAURANT_CUISINES);
		$this->db->where('cuisine_id',$cuisineid);
		$query = $this->db->get ();
		
		$cuisine_details = $query->result_array ();
		
		if(count($cuisine_details) > 0) {
			
				$this->db->select('a.id as restid,a.name,a.logo,a.is_veg,a.promote,a.areaid,b.name as areaname,b.cityid,'.
						'c.name as cityname,group_concat(DISTINCT e.name SEPARATOR ", ") as cuisines,'.
						'f.online_payment')->from(TABLES::$RESTAURANT.' AS a');
				$this->db->join(TABLES::$AREA.' AS b','a.areaid=b.id','inner');
				$this->db->join(TABLES::$CITY.' AS c','b.cityid=c.id','inner');
				$this->db->join(TABLES::$RESTAURANT_CUISINES.' AS d','a.id=d.restid','left');
				$this->db->join(TABLES::$CUISINE.' AS e','d.cuisine_id=e.id','inner');
				$this->db->join(TABLES::$RESTAURANT_PROPERTY.' AS f','a.id=f.restid','inner');
				$this->db->where('a.status',1);
				$this->db->where('(f.source = 0 OR f.source = 2)','',false);
				$this->db->where('e.id',$cuisineid);
				
				
				$this->db->group_by('a.id');
				$this->db->order_by('a.live_date','DESC');
				$query = $this->db->get();
				$result = $query->result_array();
				return $result;
			} 
		 
			
	}
	
	public function addManufacture($params) {
		$data = array ();
		$map = array (
				//'areaid' => $params ['areaid'],
				'name' => $params ['name']
		);
		$this->db->select ( 'manufacturer_id' )->from ( TABLES::$MANUFACTURE )->where ( $map );
		$query = $this->db->get ();
		$result = $query->result_array ();
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$MANUFACTURE, $params );
			$id = $this->db->insert_id ();
			$data ['id'] = $id;
			$data ['status'] = 1;
			$data ['message'] = "manufacture added successfully";
			return $data;
		} else {
			$errors = array ();
			$errors ['name'] = "manufacture name already exists.";
			$data ['status'] = 0;
			$data ['message'] = $errors;
			return $data;
		}
	}
	
	public function getManufactureDetailsById($id) {
		$this->db->select ( '*' )->from ( TABLES::$MANUFACTURE );
		$this->db->where ( 'manufacturer_id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getManufactureDetails() {
		$this->db->select ( '*' )->from ( TABLES::$MANUFACTURE );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateManufactureDetails($params) {
		$this->db->where ( 'manufacturer_id', $params ['manufacturer_id'] );
		$flag = $this->db->update ( TABLES::$MANUFACTURE, $params );
		if ($flag) {
			$map ['status'] = 1;
			$map ['msg'] = 'Updated successfully.';
		} else {
			$map ['status'] = 1;
			$map ['msg'] = 'Updated successfully.';
		}
		return $map;
	}
	
	public function updateVendorDetails($params) {
		//print_r($params);
		$this->db->where ( 'id', $params ['id'] );
		$flag = $this->db->update ( TABLES::$RESTAURANT, $params );
		if ($flag) {
			$map ['status'] = 1;
			//$map ['msg'] = 'Updated successfully.';
			$map ['msg'] = 'Vendor Added Succesfully';
		} else {
			$map ['status'] = 1;
			//$map ['msg'] = 'Updated successfully.';
			$map ['msg'] = 'Vendor Not Added Succesfully';
		}
		//echo $this->db->last_query();
		//exit;
		return $map;
	}
	
	public function getVendorBasicDetails($id) {
		$this->db->select ( '*' )->from ( TABLES::$RESTAURANT );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	// dev - kunal

	public function getServicePriceAVG($vendorid)
	{
		$this->db->select('AVG(price) avgModerate');
		$this->db->where('subcategory_id',1);
		$this->db->where('vendor_id',$vendorid);
		$q = $this->db->get(TABLES::$SERVICE);
		return $q->row_array();
	}
	
	public function getSearchedVendor($map) {
		//exit;
		$day = strtolower ( date ( 'D' ) );
		$nowTime = '"'.date('H:i:s').'"';
		// $result = [];

		$this->db->select ( 'a.id, a.radius, a.name, a.garage_name, a.landmark, a.description, a.email, a.mobile, a.image, a.rating, a.latitude, a.longitude, IFNULL( 6371 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) ) ,0) AS distance' )->from ( TABLES::$RESTAURANT . ' AS a' );

		$this->db->where ( 'a.status', 1 );
		if(array_key_exists("vendor_id",$map)){
			$this->db->where('a.id',$map['vendor_id']);
        } else {
			$this->db->having ( 'distance <', 10, FALSE );

	   //      if(array_key_exists("serviceType",$map)){
				// $this->db->where_in('a.service_type',$map['serviceType']);
	   //      }

	        if(array_key_exists("star",$map)){
				$this->db->where('a.rating >=',$map['star']);
	        }

	        if(array_key_exists("brand",$map)){
				$this->db->where_in('a.brand_id',$map['brand']);
	        }

	        if(array_key_exists("model",$map)){
				$this->db->where_in('a.model_id',$map['model']);
	        }

			if (array_key_exists('limit', $map) && array_key_exists('start', $map)) {
				$this->db->limit($map['limit'],$map['start']);
			}
			$this->db->order_by("a.id", "DESC");
		}
        $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

		// $query = $this->db->get();
		// $result = $query->result_array ();
	    // echo $this->db->last_query(); die();
		//print_r($result);
		return $result;
	}


	public function getVendorsListByName($value=NULL)
	{
		$this->db->select('id,garage_name');
		$this->db->like('garage_name', $value, 'both');
		$query = $this->db->get(TABLES::$RESTAURANT);
		$result = $query->result_array();
		return $result;
	}

	public function garageDetailsByVendorID($map)
	{
		$this->db->select ( 'a.id, a.radius, a.name, a.garage_name, a.landmark, a.description, a.email, a.mobile, a.image, a.rating, IFNULL( 6371 * acos( cos( radians(' . $map ['latitude'] . ') ) * cos( radians( a.latitude ) ) * cos( radians( a.longitude ) - radians(' . $map ['longitude'] . ') ) + sin( radians(' . $map ['latitude'] . ') ) * sin( radians( a.latitude ) ) ) ,0) AS distance, b.id as service_id, b.name as service_name, b.catsubcat_id as service_category, c.id as spare_id, c.name as spare_name, c.catsubcat_id as spare_category' );
		$this->db->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join( TABLES::$SERVICE .' AS b', 'b.vendor_id=a.id','left');
		$this->db->join( TABLES::$SPARE .' AS c', 'c.vendor_id=a.id','left');
		if(array_key_exists("vendor_id",$map)){
			$this->db->where('a.id',$map['vendor_id']);
		}
		$query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $result;
	}

	public function garageDetailsByVendorID2($map)
	{
		$this->db->select ( 'a.id, a.radius, a.name, a.garage_name, a.description, a.email, a.mobile, a.image, a.rating, b.id as service_id, b.name as service_name, b.catsubcat_id as service_category, c.id as spare_id, c.name as spare_name, c.catsubcat_id as spare_category' );
		$this->db->from ( TABLES::$RESTAURANT . ' AS a' );
		$this->db->join( TABLES::$SERVICE .' AS b', 'b.vendor_id=a.id','left');
		$this->db->join( TABLES::$SPARE .' AS c', 'c.vendor_id=a.id','left');
		if(array_key_exists("vendor_id",$map)){
			$this->db->where('a.id',$map['vendor_id']);
		}
		$query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $result;
	}

	// dev - kunal
	
}
	

