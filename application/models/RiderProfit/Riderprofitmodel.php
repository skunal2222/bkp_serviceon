<?php

class Riderprofitmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_all_rider_list($value='')
    {
        $this->db->select('*')->from('tbl_rider AS tr');
        // $this->db->join('tbl_rider_billing_fields AS rb','rb.restid=tr.rider_id','left');
        $this->db->join('tbl_rider_billing_config AS rc','rc.restid=tr.rider_id','left');
        $q = $this->db->get();
        $result = $q->result_array();
        return $result;   
    }

    public function get_order_list_by_rider($riderid)
    {
        $this->db->select('*')->from('tbl_booking');
        $this->db->where('assign_rider_id', $riderid);
        $this->db->where('is_pickup_invoice_generated',0);
        $this->db->where('is_ride_paid',1);
        $this->db->where('rider_response',6);
        $q = $this->db->get();
        $result['pickup'] = $q->result_array();

        $this->db->select('*')->from('tbl_booking');
        $this->db->where('delivery_assign_rider_id', $riderid);
        $this->db->where('is_delivery_invoice_generated',0);
        $this->db->where('is_ride_paid',1);
        $this->db->where('delivery_rider_response',6);
        $q = $this->db->get();
        $result['delivery'] = $q->result_array();

        return $result;
    }

    
    function get_online() {
    return $this->db->select('tb.orderid')
                        ->from('tbl_booking AS tb')
                        ->join('tbl_rider AS tr', 'tr.rider_id = tb.assign_rider_id', 'LEFT')
                        ->join('tbl_rider AS del_tr', 'del_tr.rider_id = tb.delivery_assign_rider_id', 'LEFT')
                        // ->join('tbl_rider_billing_fields AS vbf', 'tr.rider_id = vbf.restid', 'LEFT')
                        // ->join('tbl_rider_billing_config AS vbc', 'tr.rider_id = vbc.restid', 'LEFT')
                        ->where('tb.status', 7)
                        // ->where('tb.pay_mode !=', 2) // 1 - online, 2 - cash, 3 - paytm
                        ->where('tb.is_ride_paid', 1)
                        ->group_by('tb.orderid')
                        ->get()
                        ->result_array();
    }
    
    function get_offline() {
       return $this->db->select('tb.orderid, tb.vendor_id, tb.amount_received, tv.garage_name, tv.name, vbc.min_amount, vbf.value, vbc.billing_cycle, vbc.commission_spare, vbc.commission_service,vbc.with_service_tax')
                        ->from('tbl_booking AS tb')
                        ->join('vendor AS tv', 'tv.id = tb.vendor_id', 'LEFT')
                        ->join('vendor_billing_fields AS vbf', 'tv.id = vbf.restid', 'LEFT')
                        ->join('vendor_billing_config AS vbc', 'tv.id = vbc.restid', 'LEFT')
                        ->where('tb.status', 7)
                        ->where('tb.pay_mode', 2)
                        ->where('tb.is_profit_included', '0')
                        ->group_by('tb.orderid')
                        ->get()
                        ->result_array();
    }
    function get_all_spare($param) {
        $data = $this->db->select('ROUND(SUM(total_amount * quantity), 0) as total')
                        ->from('tbl_booking_services')
                        ->where('service', '2')
                        ->where('is_checked', '1')
                        ->where_in('orderid', $param)
                        ->get()
                        ->result_array();
        return empty($data) ? 0 : $data[0]['total'];   
    }
    function get_all_service($param, $with_service_tax, $commission) {
        $result = array(
            'company_tax_value' => 0,
            'total' => 0,
            'vendor_tax_value' => 0
        );
        $data = $this->db->select('total_amount, service_price, tax, quantity')
                        ->from('tbl_booking_services')
                        ->where('service', '1')
                        ->where('is_checked', '1')
                        ->where_in('orderid', $param)
                        ->get()
                        ->result_array();
       
	$result['total_amount'] = 0;
        if(!empty($data)) {
            foreach ($data as $value) {
		$result['total_amount'] = $result['total_amount'] + $value['total_amount'];
                if($with_service_tax == 1) {
                    $service_price = ($commission / 100) * ($value['service_price'] * $value['quantity']); 
                    $result['company_tax_value'] = round($result['company_tax_value'] + ($value['tax'] / 100) * $service_price);
                    $result['total'] = $result['total'] + ($value['service_price'] * $value['quantity']);
                } else {
                    $result['company_tax_value'] = round($result['company_tax_value'] + (($value['tax'] / 100) * ($value['service_price'] * $value['quantity'])));
                    $result['total'] = $result['total'] + ($value['service_price'] * $value['quantity']);
                    $result['vendor_tax_value'] = 0;
                }
            }  
            
        }
       
        
        return $result;
    }
   
    function addinvoice($params) {
        $params['created_date'] = date('Y-m-d');
        $this->db->insert('tbl_rider_invoice', $params);
        return $this->db->insert_id();
    }
    
    function change_order_status($param,$type) {
        $param = explode(",", $param);
        if ($type == 1) {
            $data['is_pickup_invoice_generated'] = 1;   
        } else if ($type == 2) {
            $data['is_delivery_invoice_generated'] = 1;
        }
        $this->db->where_in('orderid', $param);
        $this->db->update('tbl_booking', $data);
    }
    
    function get_invoice_details($id) {
        $data['pickup'] = array();
        $data['delivery'] = array();
        $pickup_order = array();
        $delivery_order = array();
        $data['invoice'] = $this->db->select('tri.*, tr.mobile')
                            ->from('tbl_rider_invoice AS tri')
                            ->join('tbl_rider AS tr', 'tri.rider_id = tr.rider_id', 'left')
                            ->where('tri.id', $id)
                            ->get()
                            ->result_array();

                                    // print_r($id); die();
        if($data['invoice'][0]['pickup_order_id'] != '') {
            $pickup_order = $this->db->select('orderid, ordercode, name, email, mobile, applied_ride_charge, ordered_on')
                            ->from('tbl_booking AS tb')
                            ->where_in('orderid', explode(',', $data['invoice'][0]['pickup_order_id']))
                            ->get()
                            ->result_array();
        }
        if($data['invoice'][0]['delivery_order_id'] != '') {
            $delivery_order = $this->db->select('orderid, ordercode, name, email, mobile, applied_ride_charge, ordered_on')
                                        ->from('tbl_booking AS tb')
                                        ->where_in('orderid', explode(',', $data['invoice'][0]['delivery_order_id']))
                                        ->get()
                                        ->result_array();
        }
		
		if(isset($pickup_order) && !empty($pickup_order)){
			foreach ($pickup_order as  $value) {
				$data['pickup'][$value['orderid']] = $value;
			}
		}
		
        if(isset($delivery_order) && !empty($delivery_order)){
			foreach ($delivery_order as  $value) {
				$data['delivery'][$value['orderid']] = $value;
			}
		}
        return $data;
    }
    public function get_data($param) {
        return $this->db->select('*')
                        ->from('tbl_rider_invoice')    
                        ->where('paid', $param)
                        ->order_by('id', 'DESC')
                        ->get()
                        ->result_array();
    }
    
    public function addpaid($id, $param) {
        $this->db->where('id', $id);
        $this->db->update('tbl_rider_invoice', $param);
    }
    public function update_invoice($id, $param) {
        $this->db->where('id', $id);
        $this->db->update('tbl_rider_invoice', $param);
    }
}
?>