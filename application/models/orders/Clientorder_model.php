<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clientorder_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_services_by_id($data) {
        return $this->db->select('*')
                        ->from('tbl_ratecard_price')
                        ->where_in('id', $data)
                        ->get()
                        ->result_array();
    }
    
    function get_vendor_by_name($name) {
        return $this->db->select('id, garage_name as name')
                        ->from('vendor')
                        ->like('garage_name', $name, 'both')
                        ->get()
                        ->result_array();
        
    }
     function getVendorDetails() {
        return $this->db->select('a.*')
                        ->from(TABLES::$RESTAURANT.' AS a')
                        ->get()
                        ->result_array();
        
    }
    function get_client_info($param) {
        return $this->db->select('*')->from('tbl_client')->where('id', $param)->get()->result_array();
    }
    function add_order($param) {
        $this->db->insert('tbl_client_booking', $param);
        $order_id = $this->db->insert_id();
        $response_data['order_id'] = $order_id;
        $response_data['package_price'] = 0;
        if(isset($param['package_id']) && $param['package_id'] != 0) {
            $package_id = $param['package_id'];
            $bike_id = $param['bike_id'];   
            $data['package'] = $this->db->select('*')
                                    ->from('b2b_packages')
                                    ->where('id', $package_id)
                                    ->get()
                                    ->result_array();
            $client_package_payment = $this->get_client_info($param['client_id']);
           
            $result = $this->get_bike_packages($package_id, $bike_id);
            $new = 0;
            $update = array();
            if(isset($result[0]['remaining_service_count']) && $result[0]['remaining_service_count'] == 0 || empty($result)) {
                $new = 1;
                $orderdata = $this->getOrderDetails($order_id);
                $packageData = $this->package_data($package_id);
                $this->template->set('order',$orderdata[0]);
                $this->template->set('packageData',$packageData); 
                $this->template->set_theme('default_theme');
                $this->template->set_layout (false)
                                           ->title ( 'Administrator | Generate Invoice' ); 
                $html = $this->template->build ('clientorders/PackageInvoiceDetails','',true); 
                $file_name = "invoice_package-".$order_id.time().".pdf"; 
                $this->load->library('MyPdfLib');
                $url = $this->mypdflib->getPdf($html,$file_name); 
               $insert = array(
                   'bike_id' => $bike_id,
                   'package_id' => $package_id,
                   'order_ids' => $order_id,
                   'service_used_validity' => $data['package'][0]['service_used_validity'],
                   'year' => $data['package'][0]['year'],
                   'expiry_date' => date('Y-m-d', strtotime('+'.$data['package'][0]['year']. ' years')),
                   'created_date' => date('Y-m-d'),
                   'invoice_url' => $url,
                   'remaining_service_count' => $data['package'][0]['service_used_validity'] - 1
               );
               $this->db->insert('tbl_client_packages', $insert);
            } else {
                $where = array(
                    'id' => $result[0]['id'],
                );
                $update['remaining_service_count'] = $result[0]['remaining_service_count'] - 1;
                $update['order_ids'] = $result[0]['order_ids'].','.$order_id; 
                $this->db->where($where);
                $this->db->update('tbl_client_packages', $update);
            }
            $type = $client_package_payment[0]['package_payment_type'];
            if($new == 1) {
                if($type == 1) {
                     $response_data['package_price'] = $data['package'][0]['special_price'];
                } else if($type == 2) {
                    $response_data['package_price'] = $data['package'][0]['special_price'] / 2;
                } else if($type == 3) {
                    $response_data['package_price'] = $data['package'][0]['special_price'] / $data['package'][0]['service_used_validity'];
                }
            } else {
                if($type == 2 && $update['remaining_service_count'] == 0) {
                    $response_data['package_price'] = $data['package'][0]['special_price'] / 2;
                } else if($type == 3) {
                    $response_data['package_price'] = $data['package'][0]['special_price'] / $data['package'][0]['service_used_validity'];
                }
            }
        }
        return $response_data;
    }
    function package_data($param) {
        return  $this->db->select('a.package_name, a.special_price,c.*')
                            ->from('b2b_packages AS a')
                            ->join('b2b_package_services AS b', 'a.id = b.package_id', 'left')
                            ->join('service AS c', 'c.id = b.service_id', 'left')
                            ->where('a.id', $param)
                            ->get()
                            ->result_array();
    }
    function get_bike_packages($package_id, $bike_id) {
            return  $this->db->select('*')
                            ->from('tbl_client_packages')
                            ->where('package_id', $package_id)
                            ->where('bike_id', $bike_id)
                            ->where('expiry_date >', date('Y-m-d'))
                            ->order_by('id', 'DESC')
                            ->limit(1)
                            ->get()
                            ->result_array();
    }
    function get_package_deatails2($package_id, $bike_id, $order_id) {
            return  $this->db->select('a.*, b.package_name')
                            ->from('tbl_client_packages AS a')
                            ->join('b2b_packages AS b', 'b.id = a.package_id', 'left')
                            ->where('a.package_id', $package_id)
                            ->where('a.bike_id', $bike_id)
                            //->where('a.remaining_service_count != ', 0)
                            ->order_by('a.id', 'DESC')
                            ->limit(1)
                            ->get()
                            ->result_array();
    }
    public function get_package_count($bike_id, $package_id) {
        return  $this->db->select('a.*, b.service_used_validity, b.year')
                            ->from('tbl_client_packages AS a')
                            ->join('b2b_packages AS b', 'b.id = a.package_id', 'left')
                            ->where('a.package_id', $package_id)
                            ->where('a.bike_id', $bike_id)
                            ->where('a.remaining_service_count != ', 0)
                            ->order_by('a.id', 'DESC')
                            ->limit(1)
                            ->get()
                            ->result_array();
    }
     public function get_package_service_used_validity($package_id) {
        return  $this->db->select('a.service_used_validity, a.year')
                            ->from('b2b_packages AS a')
                            ->where('a.id', $package_id)
                            ->order_by('a.id', 'DESC')
                            ->limit(1)
                            ->get()
                            ->result_array();
    }
    
    function add_booking_services($param) {
        $this->db->insert_batch('tbl_client_booking_services', $param);
    }
    function update_order($param) {
        $this->db->where('order_id', $param['order_id']);
        $this->db->update('tbl_client_booking', $param);
    }
    
    function add_order_logs($param) {
        $this->db->insert('tbl_client_booking_logs', $param);
    }
    public function getPendingOrdersByDate() {
        $current_date = date('Y-m-d');
        $this->db->select('a.*,b.reg_company_name, c.outlet_name, d.name');
        $this->db->from(TABLES::$CLIENT_BOOKING.' AS a');
        $this->db->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner');
        $this->db->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','inner'); 
        $this->db->join(TABLES::$CITY.' AS d','a.city_id = d.id','inner'); 
        $this->db->where('a.status',0);
        //$this->db->where('a.ordered_on >=',$current_date);
        $this->db->order_by('a.order_id','desc');
        $this->db->limit(200);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
     public function getApprovalOrdersByDate() {
        $current_date = date('Y-m-d');
        $this->db->select('a.*,b.reg_company_name, c.outlet_name, d.name');
        $this->db->from(TABLES::$CLIENT_BOOKING.' AS a');
        $this->db->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner');
        $this->db->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','inner'); 
        $this->db->join(TABLES::$CITY.' AS d','a.city_id = d.id','inner'); 
        $this->db->where('a.status',3);
        //$this->db->where('a.ordered_on >=',$current_date);
        $this->db->order_by('a.order_id','desc');
        $this->db->limit(200);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getCompletedOrdersByDate(){
        $current_date = date('Y-m-d');
        $this->db->select('a.*,b.reg_company_name, c.outlet_name, d.name');
        $this->db->from(TABLES::$CLIENT_BOOKING.' AS a');
        $this->db->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner');
        $this->db->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','inner'); 
        $this->db->join(TABLES::$CITY.' AS d','a.city_id = d.id','inner'); 
        $this->db->where('a.status',4);
        //$this->db->where('a.ordered_on >=',$current_date);
        $this->db->order_by('a.order_id','desc');
        $this->db->limit(200);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }
    public function getDeliveryCompletedOrdersByDate(){

        $current_date = date('Y-m-d');
        $this->db->select('a.*,b.reg_company_name, c.outlet_name, d.name');
        $this->db->from(TABLES::$CLIENT_BOOKING.' AS a');
        $this->db->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner');
        $this->db->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','inner'); 
        $this->db->join(TABLES::$CITY.' AS d','a.city_id = d.id','inner'); 
        $this->db->where('a.status',7);
        //$this->db->where('a.ordered_on >=',$current_date);
        $this->db->order_by('a.order_id','desc');
        $this->db->limit(200);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
     public function getCancelledOrdersByDate(){

        $current_date = date('Y-m-d');
        $this->db->select('a.*,b.reg_company_name, c.outlet_name, d.name');
        $this->db->from(TABLES::$CLIENT_BOOKING.' AS a');
        $this->db->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner');
        $this->db->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','inner'); 
        $this->db->join(TABLES::$CITY.' AS d','a.city_id = d.id','inner'); 
        $this->db->where('a.status',5);
        //$this->db->where('a.ordered_on >=',$current_date);
        $this->db->order_by('a.order_id','desc');
        $this->db->limit(200);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }


    public function getOrderDetails($ordercode) {
        $this->db->select('a.*,b.first_name, b.last_name,b.poc_mob,b.poc_email,c.outlet_name,c.manager_mobile,c.manager_email,d.name,e.bike_name,e.bike_number', FALSE)
                 ->from(TABLES::$CLIENT_BOOKING.' AS a')
                 ->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner')
                 ->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','left')
                 ->join(TABLES::$CITY.' AS d','a.city_id = d.id','left') 
                 ->join(TABLES::$BIKE.' AS e','a.bike_id = e.id','left');  
        
        //$this->db->where('a.orderid', $ordercode);
        if(is_numeric($ordercode))
            $this->db->where('a.order_id', $ordercode);
        else
            $this->db->where('a.ordercode', $ordercode);
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    }
    public function getActiveMainStatus() {
        $this->db->select ( '*' )
        ->from ( TABLES::$CLIENT_SERVICES ); 
        $query = $this->db->get ();
        $result = $query->result_array (); 
        return $result;
    }
    public function getOrderLogs($orderid) {
        $this->db->select("a.*,concat_ws(' ',b.first_name,b.last_name) as csename",false)
                 ->from(TABLES::$CLIENT_BOOKING_LOGS.' AS a')
                 ->join(TABLES::$B2B_ADMIN_USER.' AS b','a.created_by = b.id','left')
                 ->where('a.order_id',$orderid); 
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    }
    public function getOrderItems($orderid) {
        $this->db->select('a.*', FALSE)
                 ->from(TABLES::$CLIENT_SERVICES.' AS a') 
                 ->where("a.order_id",$orderid)
                 ->where("a.is_package_service", 0);
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    } 

    public function updateOrder( $map ) { 
        $this->db->where('order_id',$map['order_id']);
        return $this->db->update(TABLES::$CLIENT_BOOKING,$map);
        
    }
    public function getOrderDetailsByOrderId($orderid) {
        $this->db->select('a.*,concat(b.first_name, b.last_name) as name,b.poc_mob,b.poc_email')
                 ->from(TABLES::$CLIENT_BOOKING.' AS a')
                 ->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner')
                 ->where('a.order_id',$orderid);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getAssignedOrdersByDate() {
        $current_date = date('Y-m-d'); 
        $this->db->select('a.*,b.first_name, b.last_name,b.reg_company_name,b.poc_mob,b.poc_email,c.outlet_name,c.manager_mobile,c.manager_email,d.name,e.bike_name,e.bike_number', FALSE)
                 ->from(TABLES::$CLIENT_BOOKING.' AS a')
                 ->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner')
                 ->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','left')
                 ->join(TABLES::$CITY.' AS d','a.city_id = d.id','left') 
                 ->join(TABLES::$BIKE.' AS e','a.bike_id = e.id','left');   

        $this->db->where('a.status',1);
        //$this->db->where('a.ordered_on >=',$current_date);
        $this->db->order_by('a.order_id','desc');
        $this->db->limit(200);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
     function get_services_by_outlet_id($data) { 

        $this->db->select('a.*', FALSE)
                 ->from(TABLES::$RATECARD_PRICE.' AS a')
                 ->join(TABLES::$OUTLET.' AS b','a.rate_card_id = b.rate_card_id','left');  
        $this->db->where('b.id', $data);  
        $query = $this->db->get();
        $result = $query->result_array(); 

        return $result;
    }

    public function searchItemName($params) { 
       return $this->db->select('id, service_name AS name')
                 ->from(TABLES::$RATECARD_PRICE)
                 ->where('rate_card_id', $params['rate_id'])
                 ->where('type', $params['type'])
                 ->like('service_name', $params['name'], 'both')
                 ->get()
                 ->result_array();           
    }
    public function getItemById($service_id) {
        return $this->db->select('')
                 ->from(TABLES::$RATECARD_PRICE)
                 ->where('id', $service_id)
                 ->get()
                 ->result_array();
            
    
    }
    
    public function remove_booking_services($param) {
        $this->db->where('order_id', $param);
        $this->db->where('is_package_service', 0);
        $this->db->delete(TABLES::$CLIENT_SERVICES);
        
    }
    
    public function get_order_for_invoice($order_id) {
        $data['order'] = $this->db->select('a.*,b.reg_company_name, c.outlet_name,c.poc_name,c.manager_email, d.name, e.bike_name,e.bike_number')
                                ->from(TABLES::$CLIENT_BOOKING.' AS a')
                                ->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner')
                                ->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','inner') 
                                ->join(TABLES::$CITY.' AS d','a.city_id = d.id','inner')
                                ->join(TABLES::$BIKE.' AS e','a.bike_id = e.id','left')
                                ->where('a.order_id', $order_id)
                                ->get()
                                ->result_array();
        $data['services'] = $this->db->select('*')
                                    ->from(TABLES::$CLIENT_SERVICES)
                                    ->where('order_id', $order_id)
                                    ->where('is_checked', 1)
                                    ->get()
                                    ->result_array();
        return $data;        
    }
    public function allOngoingOrders() {
         $current_date = date('Y-m-d');
        $this->db->select('a.*,b.reg_company_name, c.outlet_name, d.name');
        $this->db->from(TABLES::$CLIENT_BOOKING.' AS a');
        $this->db->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner');
        $this->db->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','inner'); 
        $this->db->join(TABLES::$CITY.' AS d','a.city_id = d.id','inner'); 
        $this->db->where('a.status',2);
        //$this->db->where('a.ordered_on >=',$current_date);
        $this->db->order_by('a.order_id','desc'); 
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    
    public function allWorkingOrders() {
        $this->db->select('*')
        ->from(TABLES::$CLIENT_BOOKING);
        $this->db->where('status',3);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    
    public function allCompletedOrders() {
        $this->db->select('*')
        ->from(TABLES::$CLIENT_BOOKING);
        $this->db->where('status',4);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function allDeliveryCompletedOrders() {
        $this->db->select('*')
        ->from(TABLES::$CLIENT_BOOKING);
        $this->db->where('status',7);
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    }
    public function allCanceledOrders() {
        $this->db->select('*')
        ->from(TABLES::$CLIENT_BOOKING);
        $this->db->where('status',5);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function invoices() {
        $this->db->select('a.*,f.invoice_url, f.id, f.invoice_url AS bulk_invoice_url, f.package_payment_mode, f.cheque_no, b.first_name, b.reg_company_name, b.last_name,b.poc_mob,b.poc_email,c.outlet_name,c.manager_mobile,c.manager_email,d.name,e.bike_name,e.bike_number', FALSE)
                    ->from('tbl_bulk_invoice AS f')
                    ->join(TABLES::$CLIENT_BOOKING.' AS a', 'a.bulk_id = f.id', 'inner')
                    ->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner')
                    ->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','left')
                    ->join(TABLES::$CITY.' AS d','a.city_id = d.id','left') 
                    ->join(TABLES::$BIKE.' AS e','a.bike_id = e.id','left')
                    ->order_by('f.id', 'DESC');
                    //->where('a.status', 4);
        if($_SESSION['adminsession']['is_client'] == 1) {
            $this->db->where_in('a.outlet_id', explode(",", $_SESSION['adminsession']['outlet_id']));
        }
       
        $query = $this->db->get();
        $result = $query->result_array();
        $data = array();
        foreach ($result as $value) {
            if(isset($data[$value['id']])) {
                $data[$value['id']]['bikes'][] = $value['bike_id'];
                $data[$value['id']]['all_status'][] = $value['status'];
            } else {
                $data[$value['id']] = $value;
                $data[$value['id']]['bikes'][] = $value['bike_id'];
                $data[$value['id']]['all_status'][] = $value['status'];
            } 
        }
//        echo "<pre>";
//        print_r($data);
//        exit;
        return $data;
    }
    
    function get_bike_by_id($param) {
        $data['bike'] = $this->db->select('a.*', FALSE)
                        ->from(TABLES::$BIKE.' AS a')
                        ->where_in('id', $param)
                        ->get()
                        ->result_array();
        $bike_ids =  array();
        $final_array = array();
        $package_ids = array();
        $response = array();
        foreach($data['bike'] as $value) {
            $bike_ids[] = $value['model_id'];
        }
        $package = $this->db->select('b.id, a.model_id, package_name, special_price', FALSE)
                        ->from('b2b_package_models AS a')
                        ->join('b2b_packages AS b', 'a.package_id = b.id', 'inner')
                        ->where_in('model_id', $bike_ids)
                        ->where('b.status', 1)
                        ->get()
                        ->result_array();
        foreach ($package as $value) {
                $package_ids[$value['model_id']][] = $value;
        }
        foreach ($data['bike'] as $key => $value) {
            $response[$key] = $value;
            $response[$key]['packages'] = isset($package_ids[$value['model_id']]) ? $package_ids[$value['model_id']] : array();
        }
        
        return $response;
    }
    
    public function order_packege_services($orderid) {
        $this->db->select('a.*', FALSE)
                 ->from(TABLES::$CLIENT_SERVICES.' AS a') 
                 ->where("a.order_id",$orderid)
                 ->where("a.is_package_service !=", 0);
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    } 
    public function getservicecount($param) {
         $sql = "SELECT service_id,count(service_id) as service_count FROM `tbl_client_booking_services` WHERE order_id IN({$param}) AND is_package_service != 0 GROUP BY service_id";
         return $query = $this->db->query($sql)->result_array();
    }
    public function cofirm_estimate_list() {
        $this->db->select('a.*,b.reg_company_name, c.outlet_name, d.name');
        $this->db->from(TABLES::$CLIENT_BOOKING.' AS a');
        $this->db->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner');
        $this->db->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','inner'); 
        $this->db->join(TABLES::$CITY.' AS d','a.city_id = d.id','inner'); 
        $this->db->where('a.status',2);
        if($_SESSION['adminsession']['is_client'] == 1) {
            $this->db->where_in('a.outlet_id', explode(",", $_SESSION['adminsession']['outlet_id']));
        }
        $this->db->order_by('a.order_id','desc'); 
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function order_details_by_bulk_id($param) {
        $this->db->select('a.*, f.package_payment_mode, f.cheque_no, b.first_name, b.reg_company_name, b.last_name,b.poc_mob,b.poc_email,c.outlet_name,c.manager_mobile,c.manager_email,d.name,e.bike_name,e.bike_number', FALSE)
                    ->from('tbl_bulk_invoice AS f')
                    ->join(TABLES::$CLIENT_BOOKING.' AS a', 'a.bulk_id = f.id', 'inner')
                    ->join(TABLES::$CLIENT.' AS b','a.client_id = b.id','inner')
                    ->join(TABLES::$OUTLET.' AS c','a.outlet_id = c.id','left')
                    ->join(TABLES::$CITY.' AS d','a.city_id = d.id','left') 
                    ->join(TABLES::$BIKE.' AS e','a.bike_id = e.id','left')
                    ->where('f.id', $param);
                    
        $query = $this->db->get();
        $result = $query->result_array();
       
        $data = array();
        $a = 0;
        foreach ($result as $value) {
            $data[$value['order_id']] = $value;
            $data[$value['order_id']]['services'] = $this->getOrderItems($value['order_id']);
        }
        return $data;
    }

}
