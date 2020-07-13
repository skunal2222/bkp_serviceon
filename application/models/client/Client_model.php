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
 
	public function getPropertyListByClientid($id) {
        $this->db->select('a.*,b.*,c.*,d.*', FALSE)
                ->from(TABLES::$CLIENT . ' AS a')
                ->join(TABLES::$CLIENT_BILLING_CONFIG . ' AS b', 'a.id = b.client_id', 'left')
                ->join(TABLES::$CLIENT_BILLING_FIELD . ' AS c', 'a.id = c.client_id', 'left')
                ->join(TABLES::$CLIENT_DOC . ' AS d', 'a.id = d.client_id', 'left')
                ->where('a.status', 1)->where('a.id', $id)
                ->order_by('a.name', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getClientByid($id) {
        $this->db->select('a.*', FALSE)
                ->from(TABLES::$CLIENT . ' AS a')
                ->join(TABLES::$CLIENT_BILLING_CONFIG . ' AS b', 'a.id = b.clientid', 'left')
                ->join(TABLES::$CLIENT_BILLING_FIELD . ' AS c', 'a.id = c.clientid', 'left')
                ->join(TABLES::$CLIENT_DOC . ' AS d', 'a.id = d.client_id', 'left')
                ->where('a.status', 1)->where('a.id', $id);
        $query = $this->db->get();
        $result = $query->result_array();


        return $result;
    }

    public function getAllClientList() {
        $this->db->select('a.*', FALSE)
                ->from(TABLES::$CLIENT . ' AS a')
                ->order_by('a.id','DESC'); 
        if($_SESSION['adminsession']['is_client'] == 1) {
            $this->db->where_in('id', $_SESSION['adminsession']['client_id']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function addClient($cat) {
        $data = array();
        $params = array( 
            'reg_company_name' => $cat ['reg_company_name'],
            'poc_mob' => $cat ['poc_mob'],
            'poc_email' => $cat ['poc_email']
        );   

        $where = "poc_mob LIKE '".$cat ['poc_mob']."' OR poc_email LIKE '".$cat ['poc_email']."' OR reg_company_name LIKE '".$cat ['reg_company_name']."'";

        $this->db->select('id')->from(TABLES::$CLIENT)
                 ->where($where);
        $query = $this->db->get();
        $result = $query->result_array();  

        if (count($result) <= 0) { 

            $this->db->insert(TABLES::$CLIENT, $cat);
            $data ['status'] = 1;
            $data ['msg'] = "Added successfully";
            $data['id'] = $this->db->insert_id();
            return $data;
        } else { 

            $data ['msg'] = "Client already exists.";
            $data ['status'] = 0;
            return $data;
        }
    }
 
    public function addClient_image($cat) {
        $this->db->insert_batch(TABLES::$CLIENT_DOC, $cat);
    }

    /*public function addClientAsUser($data) {

        $params = array( 
            'mobile' => $data ['mobile'],
            'email' => $data ['email']
        );  
 
        $this->db->select('id')->from(TABLES::$B2B_ADMIN_USER)->where($params);
        $query = $this->db->get();
        $result = $query->result_array();   
        if (count($result) <= 0) {  
            $this->db->insert(TABLES::$B2B_ADMIN_USER, $data);
            $data ['status'] = 1;
            $data ['msg'] = "Added successfully";
            $data['id'] = $this->db->insert_id();
            return $data;
        } else { 

            $data ['msg'] = "User already exists.";
            $data ['status'] = 0;
            return $data;
        } 
 
    }*/
   /* public function updateClientAsUser($data){
        echo "<pre>";
        print_r($data);
        exit();
        $this->db->where('emp_id',$data['emp_id']);
        $this->db->update(TABLES::$B2B_ADMIN_USER,$data);
        //echo $this->db->last_query();

    } */
    public function addClientBilling($data) { 
        $this->db->insert(TABLES::$CLIENT_BILLING_CONFIG, $data);
    }

    public function getClients() {
        $this->db->select('*')->from(TABLES::$CLIENT)
                 ->where('status', 1);
        $this->db->order_by('id', 'DESC');
        if($_SESSION['adminsession']['is_client'] == 1) {
            $this->db->where_in('id', $_SESSION['adminsession']['client_id']);
        }
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    }

    public function getClientsbyId($id) {
            
        $data['client'] = $this->db->select('a.*', FALSE)
                ->from(TABLES::$CLIENT . ' AS a')
               // ->join(TABLES::$CLIENT_BILLING_CONFIG . ' AS c', 'a.id = c.clientid', 'left')
                ->where('a.id', $id) 
                ->get()
                ->result_array();  
                
        $data['images'] = $this->db->select('*', FALSE)
                ->from(TABLES::$CLIENT_DOC . ' AS a')
                ->where('client_id', $id)
                ->get()
                ->result_array();
        return $data;
    }

    public function delete_client_doc($param) {
        $this->db->where('id', $param)->delete(TABLES::$CLIENT_DOC);
    }

    public function updateClient($cat) {

        /*$this->db->where('id', $id['id']);
        $this->db->update(TABLES::$CLIENT, $id);
        $data ['status'] = 1;
        $data ['msg'] = "Updated successfully";
        $data['id'] = $id['id'];
        return $data;
*/


        $data = array (); 
        $params = array (
                'poc_email' => $cat ['poc_email'],
                'id !=' => $cat ['id']
        );



        $this->db->select ( 'id' )->from ( TABLES::$CLIENT )->where ( $params );
        $query = $this->db->get ();
        
        $result = $query->result_array (); 
        if (count ( $result ) <= 0) {
            $this->db->where ( 'id', $cat ['id'] );
            $this->db->update ( TABLES::$CLIENT, $cat ); 
            //$this->db->update (TABLES::$B2B_ADMIN_USER, $cat);
            //echo $this->db->last_query();
            $data ['id'] = $this->db->insert_id(); 
            $data ['status'] = 1;
            $data ['msg'] = "Updated successfully";
            return $data;
        } else {
            $data ['msg'] = "Client already exists.";
            $data ['status'] = 0;
            return $data;
        }




    }

    public function updateClientBilling($id) {
        $this->db->where('clientid', $id['clientid']);
        $this->db->update(TABLES::$CLIENT_BILLING_CONFIG, $id);
        $data ['status'] = 1;
        $data ['msg'] = "updated successfully";
        return $data;
    }

    public function updateClient_image($id) {
        $this->db->where('client_id', $id['client_id']);
        $this->db->update_batch(TABLES::$CLIENT_BILLING_CONFIG, $id);
        $data ['status'] = 1;
        $data ['msg'] = "updated successfully";
        return $data;
    }  
	
}