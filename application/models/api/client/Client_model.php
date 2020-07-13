<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI_Model API for client order management .
 *
 * <p>
 * We are using this model to add/update client orders.
 * </p>
 * @package Client
 * @subpackage client-model
 * @author pradeep singh
 * @category CI_Model API
 */
class Client_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

	public function addOrder( $map ) {
		$this->db->insert(TABLES::$CLIENT_ORDER,$map);
		return $this->db->insert_id();
	}
	
	public function updateOrder( $map ) {
		$this->db->where('id',$map['id']);
		return $this->db->update(TABLES::$CLIENT_ORDER,$map);
	}
	
	public function getClientOrders() {
		$date = date('Y-m-d');
		$this->db->select('a.*,b.name as restname,c.name as areaname,d.name as cityname,h.first_name as cse_name,i.name as reason', FALSE)
				 ->from(TABLES::$CLIENT_ORDER.' AS a')
				 ->join(TABLES::$RESTAURANT.' AS b','a.restid=b.id','inner')
				 ->join(TABLES::$AREA.' AS c','b.areaid = c.id','left')
				 ->join(TABLES::$CITY.' AS d','c.cityid = d.id','left')
				 ->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				 ->join(TABLES::$CANCEL_REASON.' AS i','a.reason_id = i.id','left')
				 ->where('DATE(a.created_date)',$date);
		$this->db->order_by('a.created_date','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function getClientOrdersByRestId($restid) {
		$date = date('Y-m-d');
		$this->db->select('a.*,b.name as restname,c.name as areaname,d.name as cityname,h.first_name as cse_name,i.name as reason', FALSE)
				->from(TABLES::$CLIENT_ORDER.' AS a')
				->join(TABLES::$RESTAURANT.' AS b','a.restid=b.id','inner')
				->join(TABLES::$AREA.' AS c','b.areaid = c.id','left')
				->join(TABLES::$CITY.' AS d','c.cityid = d.id','left')
				->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				->join(TABLES::$CANCEL_REASON.' AS i','a.reason_id = i.id','left')
				->where('a.restid',$restid)
				->where('DATE(a.created_date)',$date);
		$this->db->order_by('a.created_date','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	
	public function getClientOrderDetail($id) {
		$date = date('Y-m-d');
		$this->db->select('a.*,b.name as restname,b.address,b.landmark,b.locality as rest_locality,b.latitude as rest_latitude,b.longitude as rest_longitude,c.name as areaname,d.name as cityname,h.first_name as cse_name,i.name as reason', FALSE)
				 ->from(TABLES::$CLIENT_ORDER.' AS a')
				 ->join(TABLES::$RESTAURANT.' AS b','a.restid=b.id','inner')
				 ->join(TABLES::$AREA.' AS c','b.areaid = c.id','left')
				 ->join(TABLES::$CITY.' AS d','c.cityid = d.id','left')
				 ->join(TABLES::$ADMIN_USER.' AS h','a.cse_id = h.id','left')
				 ->join(TABLES::$CANCEL_REASON.' AS i','a.reason_id = i.id','left')
				 ->where('a.id',$id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function updateClientOrder($params) {
		$this->db->where('id',$params['id']);
		return $this->db->update(TABLES::$CLIENT_ORDER,$params);
	}
	
}