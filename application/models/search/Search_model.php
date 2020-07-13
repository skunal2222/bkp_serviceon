    	<?php
class Search_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	public function getBrandsbyName($name) {
		$this->db->select ( 'concat("brand_",a.id) as id,a.name', FALSE )->from ( TABLES::$BRAND . ' AS a' );
		$this->db->like ( 'a.name', $name,'both' );
		$this->db->where ( 'a.status', 1 );
		$this->db->order_by ( 'a.id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getModelbyName($name) {
		$this->db->select ('concat("model_",a.id) as id,concat_ws("-",a.name,b.name) as name')->from ( TABLES::$MANUFACTURE.' as a' )->join(TABLES::$BRAND.' AS b','b.id = a.brand_id','inner');;
	     $this->db->like ( 'a.name', $name,'both' );
		$this->db->where ( 'a.status', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	  public function getPackageList($pkid){
	  $id=explode("_", $pkid);	
	  //print_r($id); 
        $this->db->select ( 'a.*' )->from ( TABLES::$Package.' as a');
        $this->db->join (TABLES::$PackageModels . ' AS b', 'a.id = b.package_id', 'inner' );
        if($id[0]=="brand"){
            $where="a.brand_id LIKE('%{$id[1]}%')";
        }
        else{
            $where="b.model_id IN('{$id[1]}')"; 
        }
        $this->db->where($where);	
		$query = $this->db->get ();
		//echo $this->db->last_query(); die; 
		$result = $query->result_array (); 
		return $result;
    }
    public function getPackageListBySearchid($pkid){
         $id=explode("_", $pkid);  
        //print_r($id); 
        $this->db->select ( 'a.*' )->from ( TABLES::$Package.' as a');
        $this->db->join (TABLES::$PackageModels . ' AS b', 'a.id = b.package_id', 'inner' );
        if($id[0]=="brand"){
            $where="a.brand_id LIKE('%{$id[1]}%')";
        }
        else{
            $where="b.model_id IN('{$id[1]}')"; 
        }
        $this->db->where($where); 
        $this->db->group_by('a.package_name','ASC'); 
    $query = $this->db->get ();
    //echo $this->db->last_query(); die; 
    $result = $query->result_array (); 
    return $result;
    }
    
    public function getservicebypackage3($pkid) {    // b2b
        $this->db->select ( 'b.*,b.name as servicename' )->from ( TABLES::$ClientPackageServices . ' AS a' )
                    ->join ( TABLES::$SERVICE . ' AS b', 'a.service_id = b.id', 'inner' )
                    ->where ( 'a.package_id', $pkid );
                    //->group_by('b.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
    }

    function getservicebypackage($pkid)
    {
    	$this->db->select ( 'b.*,b.name as servicename' )->from ( TABLES::$PackageServices . ' AS a' )
                    ->join ( TABLES::$SERVICE . ' AS b', 'a.service_id = b.id', 'inner' )
                    ->where ( 'a.package_id', $pkid );
                    //->group_by('b.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
    }
    function getservicebypackage2($pkid)
    {
    	$this->db->select ( 'a.*,b.name as servicename' )->from ( TABLES::$PackageServices . ' AS a' )
                    ->join ( TABLES::$SERVICE . ' AS b', 'a.service_id = b.id', 'inner' )
                    ->where ( 'a.package_id', $pkid )
                    ->group_by('b.name','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
    }
    function getPackagebyId($pkid)
    { 
        $this->db->select ( '*' )->from ( TABLES::$Package);
        $this->db->where('id',$pkid);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
   
    }
      function getPackageByModelId($pkid)
    { 
        $this->db->select ( 'b.*,a.package_id' )->from ( 'package_models as a')->join('packages as b','a.package_id=b.id','left');
        $this->db->where('a.model_id',$pkid['model_id']);
       // $this->db->group_by ( 'b.id', 'ASC' );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
   
    }

      function getRecommendedPackageByModelId($data,$packageids)
    {   

        $this->db->select ( 'b.*,a.package_id' )
                 ->from ( 'package_models as a')
                 ->join('packages as b','a.package_id=b.id','left');
        $this->db->where('a.model_id',$data['model_id']);
       // $this->db->where('b.id != ',$packageids);
       // $this->db->where('b.id NOT IN('.$packageids.')','',false);
        $this->db->where_not_in('b.id', $packageids);
        $this->db->where('b.status',1);
       // $this->db->group_by ( 'b.id', 'ASC' );
    $query = $this->db->get ();
    //echo $this->db->last_query();
    $result = $query->result_array ();
    return $result;
   
    }




    function getPackageDetailsbyId($pkid) {  

        return $this->db->select('*')->from ('packages')->where('id',$pkid)->get()->row_array(); 
   
    }

    function getPackageUsagesByUser($pkid,$userid, $vehicle_id) {   
     	
          return $this->db->select('*')->from ('tbl_user_package')
                  ->where('package_id',$pkid)
                  ->where('expiry_date > ', date('Y-m-d'))
                  ->where('user_id',$userid)
                  ->where('vehicle_id', $vehicle_id)
                  ->order_by('id','DESC')
                  ->limit(1)
                  ->get()
                  ->row_array();  

     } 
     function getmypackage($userid)
     {
        $query=$this->db->get_where('tbl_user_package',array('user_id'=>$userid));
          return $query->result_array();

     }
     function getmypackageNew($userid,$vehicle_id)
     {
        $query=$this->db->get_where('tbl_user_package',array('user_id'=>$userid,'vehicle_id'=>$vehicle_id));
          return $query->result_array();

     }

     function getOrdersBypackage($pkid,$userid)
     {
        $this->db->select('a.*');
        $this->db->from(TABLES::$ORDER.' AS a');
       // $this->db->join(TABLES::$USER.' AS b','a.userid = b.id','inner');
        $this->db->where('a.status !=',5);
        $this->db->where('a.package_id',$pkid);
        $this->db->where('a.userid',$userid);
      //  $this->db->where('a.ordered_on >=',$current_date);
       // $this->db->order_by('a.orderid','asc');
       // $this->db->limit(200);
        $query = $this->db->get();
      //  $result = $query->num_rows();
        return $query->num_rows();
     }
      function getOrders($userid,$orderids)
     {
        $this->db->select('a.orderid,a.package_id,a.ordercode');
        $this->db->from(TABLES::$ORDER.' AS a');
       // $this->db->join(TABLES::$PackageInvoice.' AS b','a.orderid=b.order_id','inner');
        $this->db->where('a.status !=',5);
        //$this->db->where('a.package_id',$pkid);
       /* $where = " a.orderid in (".$orderids.")"; 
        $this->db->where($where);*/
        $this->db->where_in('a.orderid',$orderids);
        $this->db->where('a.userid',$userid);

      //  $this->db->where('a.ordered_on >=',$current_date);
        $this->db->order_by('a.orderid','ASC');
       // $this->db->limit(200);
        $query = $this->db->get();
      //  $result = $query->num_rows();
        return $query->result_array();
     }
    /* public function getallPackage(){
     
        $this->db->select ( 'a.*' )->from ( TABLES::$Package.' as a');
        $this->db->join (TABLES::$PackageModels . ' AS b', 'a.id = b.package_id', 'inner' );
        $this->db->where('a.status',1);
        $query = $this->db->get ();
        //echo $this->db->last_query(); die;
        $result = $query->result_array ();
        return $result;
    }*/
     public function getallPackage($page=null){
        if(isset($page))
          $offset = 3*$page; $limit = 3; 
     // print_r($id); die;
        $this->db->select ( 'a.*' )->from ( TABLES::$Package.' as a');
        //$this->db->join (TABLES::$PackageModels . ' AS b', 'a.id = b.package_id', 'inner' );
        $this->db->where('a.status',1);
        $this->db->group_by('a.package_name');
         if(isset($page))
        $this->db->limit($limit, $offset);
         else
         $this->db->limit(9);    
        $query = $this->db->get ();
        //echo $this->db->last_query(); die;
        $result = $query->result_array ();
        return $result;
    }

    function getOrderdetails($pkid,$userid)
     {
        $this->db->select('a.*');
        $this->db->from(TABLES::$ORDER.' AS a');
    //    $this->db->join(TABLES::$PackageInvoice.' AS b','a.orderid=b.order_id','inner');
        $this->db->where('a.status !=',5);
        $this->db->where('a.package_id',$pkid);
        $this->db->where('a.userid',$userid);
      //  $this->db->where('a.ordered_on >=',$current_date);
        $this->db->order_by('a.orderid','desc');
        $this->db->limit(1);
        $query = $this->db->get();
         //echo $this->db->last_query(); die;
      //  $result = $query->num_rows();
        return $query->result_array();
     }
     function getorderbypackage($userid,$pkid)
     {
        $query=$this->db->get_where('tbl_user_package',array('user_id'=>$userid,'package_id'=>$pkid,'is_expire'=>1));
      //  echo $this->db->last_query(); exit;
          return $query->result_array();

     }
       function getorderbyexpiredpackage($userid,$pkid)
     {
        $query=$this->db->get_where('tbl_user_package',array('user_id'=>$userid,'package_id'=>$pkid));
      //  echo $this->db->last_query(); exit;
          return $query->result_array();

     }
     function getservicecount($orderids)
     { 
        $sql = "SELECT service_id,count(service_id) as service_count FROM `tbl_booking_services` WHERE orderid IN({$orderids})  AND is_package_service != 0 GROUP BY service_id";
        return $query=$this->db->query($sql)->result_array();
     }
      function getusedpackage($pkid,$uid){
        $current_date=date('Y-m-d');
     
        $where=" is_expire = 0 or expiry_date <= '".strtotime($current_date)."'";
  
        return $this->db->select('*')->from ('tbl_user_package')->where('package_id',$pkid)->where('user_id',$uid)->where($where)->get()->row_array(); 
         // echo $this->db->last_query();

     }
      function getPackageUsagesByUser6789($userid,$pkid,$orderid) {   
     
   
        $where="  FIND_IN_SET(".$orderid.",order_ids) > 0";
  
    return    $this->db->select('*')->from ('tbl_user_package')->where('package_id',$pkid)->where('user_id',$userid)->where($where)->get()->row_array(); 
         // echo $this->db->last_query();
         
   
    }
}