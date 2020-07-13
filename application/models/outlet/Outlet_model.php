<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Outlet_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	 
	public function addOutlet($params){   
		$data = array ();
		$existarr = array (
                'outlet_name' => $params ['outlet_name'],
                'manager_mobile' => $params ['manager_mobile'],
				'manager_email' => $params ['manager_email']
		);

         $where = "outlet_name LIKE '".$params ['outlet_name']."' OR manager_mobile LIKE '".$params ['manager_mobile']."' OR manager_email LIKE '".$params ['manager_email']."'"; 

		$this->db->select ( 'id' )->from ( TABLES::$OUTLET )->where ( $where );
		$query = $this->db->get ();
		$result = $query->result_array ();  
 
        
		if (count ( $result ) <= 0) {
			$this->db->insert ( TABLES::$OUTLET, $params ); 
			$data ['status'] = 1;
			$data ['msg'] = "Outlet Added successfully";
                        //$activity_log['comment'] = "{$params['name']} outlet added.";
                        //$activity_log['user_id'] = $this->session->adminsession['id'];
                        //activity_log($activity_log);
			return $data;
		} else {
			$data ['msg'] = "Outlet already exists.";
			$data ['status'] = 0;
			return $data;
		} 
	} 
    public function getAllActive()
    {
            $this->db->select('a.*,b.name as city,c.reg_company_name',FALSE)
            ->from(TABLES::$OUTLET.' AS a')
            ->join(TABLES::$CITY.' AS b','a.cityid = b.id','inner')
            ->join(TABLES::$CLIENT.' AS c','c.id = a.client_id','inner') 
            ->where ('a.status',1)
            ->order_by ('a.outlet_name','ASC'); 
            $query = $this->db->get ();
            $result = $query->result_array ();  
            return $result;
    }

	public function getListOutlets()
	{
			$this->db->select('a.*,b.name as city,c.reg_company_name',FALSE)
			->from(TABLES::$OUTLET.' AS a')
			->join(TABLES::$CITY.' AS b','a.cityid = b.id','inner')
			->join(TABLES::$CLIENT.' AS c','c.id = a.client_id','inner') 
			//->where ('a.status',1)
			->order_by ('a.outlet_name','ASC'); 
                        if($_SESSION['adminsession']['is_client'] == 1) {
                             $this->db->where_in('a.id', explode(",", $_SESSION['adminsession']['outlet_id']));
                         }
			$query = $this->db->get ();
			$result = $query->result_array ();  
			return $result;
	}

	public function addOutletAsUser($data) {    
        $params = array(  
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

            $data ['msg'] = "Outlet already exists.";
            $data ['status'] = 0;
            return $data;
        } 
    }
		
	public function getAllOutlets()
	{
		$this->db->select('a.*,b.name as city',FALSE)
				 ->from(TABLES::$OUTLET.' AS a')
				 ->join(TABLES::$CITY.' AS b','a.city = b.id','inner') 
				 ->where ('a.status',1)
				 ->order_by ('a.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	} 
	public function getOutletByID($id)
	{ 
		$this->db->select('a.*', FALSE)
		->from(TABLES::$OUTLET.' AS a');
		$this->db->where('a.id',$id);
		$this->db->order_by ('outlet_name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();

		return $result;
	}

	public function updateOutlet($params){		
		$data = array ();
		$data = array (
				//'outlet_name' => $params ['outlet_name'],
               // 'manager_mobile' => $params ['manager_mobile'],
                'manager_email' => $params ['manager_email'],
				'id !=' => $params ['id']
		); 

       // $where = "manager_mobile LIKE '".$params ['manager_mobile']."' OR manager_email LIKE '".$params ['manager_email']."'"; 

		$this->db->select ( 'id' )->from ( TABLES::$OUTLET )->where ( $params );
		$query = $this->db->get ();
		$result = $query->result_array ();
         
		if (count ( $result ) == 0) {
			$this->db->where ( 'id', $params ['id'] );
			$this->db->update ( TABLES::$OUTLET, $params );
			$data ['status'] = 1;
			$data ['msg'] = "Updated successfully"; 
			return $data;
		} else {
			$data ['msg'] = "Outlet name already exists.";
			$data ['status'] = 0;
			return $data;
		}
	}
	public function outletbyclientid($client_id) { 
		$this->db->select ( 'a.*', FALSE )->from ( TABLES::$OUTLET . ' AS a' );
		$this->db->where ( 'a.status', 1 );
		$this->db->where ( 'client_id', $client_id );
        $this->db->group_by ('a.id','ASC');
		//$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array (); 

		return $result;
	}  
	public function outletbycityid($city_id, $client_id) {
		$this->db->select ( 'a.*', FALSE )->from ( TABLES::$OUTLET . ' AS a' );
		$this->db->where ( 'a.status', 1 );
        $this->db->where('a.client_id', $client_id);
		$this->db->where ( 'cityid', $city_id );
		$this->db->order_by ( 'a.id', 'ASC' );
                if($_SESSION['adminsession']['is_client'] == 1) {
                    $this->db->where_in('a.id', explode(",", $_SESSION['adminsession']['outlet_id']));
                }
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();  


		return $result;
	}
	public function citybyclientid($client_id) {
		$this->db->select('a.*', FALSE)
                        ->from(TABLES::$CITY . ' AS a')
                        ->join(TABLES::$OUTLET . ' AS b', 'b.cityid = a.id', 'inner')
                        ->join(TABLES::$CLIENT . ' AS c', 'c.id = b.client_id', 'inner') 
                        ->where('a.status', 1)
                        ->where('c.id', $client_id)
                        ->group_by('a.id');
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$result = $query->result_array ();  		 
		return $result;
	} 
	public function bikesbyoutletid($outlet_id) {
		$data['bike'] = $this->db->select('a.*', FALSE)
                                        ->from(TABLES::$BIKE . ' AS a')
                                        ->join(TABLES::$OUTLET . ' AS b', 'b.id = a.outlet_id', 'inner') 
                                        ->where('a.status', 1)
                                        ->where('a.outlet_id', $outlet_id)
                                        ->order_by( 'a.id', 'ASC' )
                                        ->get()
                                        ->result_array();  
                $data['service'] = $this->db->select('b.*', FALSE)
                                        ->from(TABLES::$OUTLET . ' AS a')
                                        ->join('tbl_ratecard_price AS b', 'b.rate_card_id = a.rate_card_id', 'inner') 
                                        ->where('a.id', $outlet_id)
                                        ->get()
                                        ->result_array();  
                return $data;
		
	}
        public function add_rate_card($param) {
            $data = array(
                'city_id' => $param['city_id'],
                'rate_card_name' => $param['rate_card_name']
            );
            $result = $this->db->select('id')
                                ->from('tbl_bike_ratecard')
                                ->where($data)
                                ->get()
                                ->result_array();     
            if(empty($result)) {
                $this->db->insert('tbl_bike_ratecard', $param);
                return $this->db->insert_id();
            } else {
                return false;
            }
        }
        public function delete_rate_card($param) {
            $this->db->where('id', $param);
            $this->db->delete('tbl_bike_ratecard');
        }
        public function add_rate_card_price($param) {
            $this->db->insert_batch('tbl_ratecard_price', $param);
            return true;
        }
        
        public function all_rate_list() {
            return $this->db->select('tbr.*, c.name')
                            ->from('tbl_bike_ratecard AS tbr')
                            ->join('city AS c', 'tbr.city_id = c.id', 'INNER')
                            ->order_by('tbr.id', 'DESC')
                            ->get() 
                            ->result_array();
        }
        
        public function get_ratecard_details($id) {
            return $this->db->select('tbr.*')
                            ->from('tbl_bike_ratecard AS tbr')
                            ->where('id', $id)
                            ->get() 
                            ->result_array();
        }
        public function ratecard_update($param) {
            $data = array(
                'city_id' => $param['city_id'],
                'rate_card_name' => $param['rate_card_name'],
                'id !=' => $param['id']
            );
            $result = $this->db->select('id')
                                ->from('tbl_bike_ratecard')
                                ->where($data)
                                ->get()
                                ->result_array();     
            if(empty($result)) {
                $this->db->where('id', $param['id']);
                $this->db->update('tbl_bike_ratecard', $param);
                return array('status' => 1, 'msg' => 'updated successfully');
            } else {
                return array('status' => 0, 'msg' => 'Duplicate rate card name');
            }
        }
        
        public function ratecard_assign() {
            $this->db->select('to.*, c.name, tc.reg_company_name, tbr.rate_card_name')
                    ->from('tbl_outlets AS to')
                    ->join('tbl_client AS tc', 'to.client_id = tc.id', 'INNER')
                    ->join('city AS c', 'to.cityid = c.id', 'INNER')
                    ->join('tbl_bike_ratecard AS tbr', 'to.rate_card_id = tbr.id', 'LEFT')
                    ->order_by('tbr.id', 'DESC');
            if($_SESSION['adminsession']['is_client'] == 1) {
                $this->db->where_in('to.id', explode(",", $_SESSION['adminsession']['outlet_id']));
            }                
            return $this->db->get()->result_array();
        }
        
        public function get_rate_card_by_city($city_id) {
            return $this->db->select('tbr.*')
                            ->from('tbl_bike_ratecard AS tbr')
                            ->where('city_id', $city_id)
                            ->get() 
                            ->result_array();
        }
        public function add_ratecard_assign($param) {
            $this->db->where('id', $param['id']);
            $this->db->update('tbl_outlets', $param);
            return 'SUCCESS';
        }
}


