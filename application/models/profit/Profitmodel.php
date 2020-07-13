<?php

class Profitmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_online() {
    return $this->db->select('tb.orderid, tb.vendor_id, tb.amount_received, tv.garage_name, tv.name, vbc.min_amount, vbf.value, vbc.billing_cycle, vbc.commission_spare, vbc.commission_service,vbc.with_service_tax')
                        ->from('tbl_booking AS tb')
                        ->join('vendor AS tv', 'tv.id = tb.vendor_id', 'LEFT')
                        ->join('vendor_billing_fields AS vbf', 'tv.id = vbf.restid', 'LEFT')
                        ->join('vendor_billing_config AS vbc', 'tv.id = vbc.restid', 'LEFT')
                        ->where('tb.status', 7)
                        // ->where('tb.pay_mode !=', 2) // 1 - online, 2 - cash, 3 - paytm
                        ->where('tb.is_profit_included', '0')
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
        $this->db->insert('tbl_vendor_invoice', $params);
        return $this->db->insert_id();
    }
    
    function change_order_status($param) {
        $param = explode(",", $param);
        $data['is_profit_included'] = 1; 
        $this->db->where_in('orderid', $param);
        $this->db->update('tbl_booking', $data);
    }
    
    function get_invoice_details($id) {
        $data['online'] = array();
        $data['offline'] = array();
        $online_order = array();
        $offline_order = array();
        $all_data = array();
        $data['invoice'] = $this->db->select('tvi.*, tv.locality, tv.mobile')
                                    ->from('tbl_vendor_invoice AS tvi')
                                    ->join('vendor AS tv', 'tvi.vendor_id = tv.id', 'left')
                                    ->where('tvi.id', $id)
                                    ->get()
                                    ->result_array();
        if($data['invoice'][0]['online_order_id'] != '') {
            $online_order = $this->db->select('orderid, name,email, mobile, amount_received, discount, adjustment, locality, ordered_on')
                                    ->from('tbl_booking AS tb')
                                    ->where_in('orderid', explode(',', $data['invoice'][0]['online_order_id']))
                                    ->get()
                                    ->result_array();
        }
        /*if($data['invoice'][0]['offline_order_id'] != '') {
            $offline_order = $this->db->select('orderid, name,email, mobile, amount_received, discount, adjustment, locality, ordered_on')
                                        ->from('tbl_booking AS tb')
                                        ->where_in('orderid', explode(',', $data['invoice'][0]['offline_order_id']))
                                        ->get()
                                        ->result_array();
        }*/
        if($data['invoice'][0]['online_order_id'] != '') {
            $online_order_services = $this->db->select('orderid, service_price, tax, service_name, total_amount, service')
                                            ->from('tbl_booking_services')
                                            ->where_in('orderid', explode(',', $data['invoice'][0]['online_order_id']))
                                            ->where('is_checked', '1')
                                            ->get()
                                            ->result_array();
            
            foreach ($online_order_services as $value) {
                $all_data[$value['orderid']][] = $value;
            }
            
        }

        /*if($data['invoice'][0]['offline_order_id'] != '') {
            $offline_order_services = $this->db->select('orderid, service_price, tax, service_name, total_amount, service')
                                            ->from('tbl_booking_services')
                                            ->where_in('orderid', explode(',', $data['invoice'][0]['offline_order_id']))
                                            ->where('is_checked', '1')
                                            ->get()
                                            ->result_array();
            foreach ($offline_order_services as $value) {
                $all_data[$value['orderid']][] = $value;
            }
        }*/
		
		if(isset($online_order) && !empty($online_order)){

			foreach ($online_order as  $value) {
				$data['online'][$value['orderid']] = $value;
				$data['online'][$value['orderid']]['services'] = $all_data[$value['orderid']];
			}
		}
		
        /*if(isset($offline_order) && !empty($offline_order)){
			foreach ($offline_order as  $value) {
				$data['offline'][$value['orderid']] = $value;
				$data['offline'][$value['orderid']]['services'] = $all_data[$value['orderid']];
			}
		}*/
        return $data;
    }
    public function get_data($param) {
        return $this->db->select('*')
                        ->from('tbl_vendor_invoice')    
                        ->where('paid', $param)
                        ->order_by('id', 'DESC')
                        ->get()
                        ->result_array();
    }
    
    public function addpaid($id, $param) {
        $this->db->where('id', $id);
        $this->db->update('tbl_vendor_invoice', $param);
    }
    public function update_invoice($id, $param) {
        $this->db->where('id', $id);
        $this->db->update('tbl_vendor_invoice', $param);
    }
}
?>