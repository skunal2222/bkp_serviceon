<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Rider_Profit extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('zyk/RiderprofitLib','riderprofitlib');
    }
    
    public function index() {
        $this->load->library('mylib/OrderLib', 'orderlib');
        $weekly = array();
        $rider = array();
        $fortnightly = array();
        $monthly = array();
        $riderlist = $this->riderprofitlib->get_all_rider_list();

        // echo "<pre>";
        // print_r($riderlist); die();
        
        foreach($riderlist as $value) {
          $order = $this->riderprofitlib->get_order_list_by_rider($value['rider_id']);
          $rider[$value['rider_id']]['rider_id'] = $value['rider_id'];
          $rider[$value['rider_id']]['rider_name'] = $value['rider_name'];
          $rider[$value['rider_id']]['rider_mobile'] = $value['mobile'];
          $rider[$value['rider_id']]['commission_service'] = $value['commission_service'];
          $rider[$value['rider_id']]['billing_cycle'] = $value['billing_cycle']; 
          $rider[$value['rider_id']]['with_service_tax'] = $value['with_service_tax'];
          foreach ($order['pickup'] as $pickup) {
           $pickup_ride_charge = $pickup['applied_ride_charge'] / 2;
           $rider[$value['rider_id']]['pickup_total'] = (isset($rider[$value['rider_id']]['pickup_total']) ? $rider[$value['rider_id']]['pickup_total'] : 0) + round($pickup_ride_charge);
           $rider[$value['rider_id']]['pickup_order_id'][] = $pickup['orderid'];
          }

          foreach ($order['delivery'] as $delivery) {
           $delivery_ride_charge = $delivery['applied_ride_charge'] / 2;
           $rider[$value['rider_id']]['delivery_total'] = (isset($rider[$value['rider_id']]['delivery_total']) ? $rider[$value['rider_id']]['delivery_total'] : 0) + round($delivery_ride_charge);
           $rider[$value['rider_id']]['delivery_order_id'][] = $delivery['orderid'];
          }
        }
        $final = [];
        foreach ($rider as $value) {
          if (!empty($value['pickup_order_id']) || !empty($value['delivery_order_id'])) {
            $final[] = $value;
          }
        }
        // echo "<pre>";
        // print_r($final); die();
        
        /*$offline = $this->riderprofitlib->get_offline();
        foreach($offline as $value) {
           $vendor[$value['vendor_id']]['vendor_id'] = $value['vendor_id'];
           $vendor[$value['vendor_id']]['offline_total'] = (isset($vendor[$value['vendor_id']]['offline_total']) ? $vendor[$value['vendor_id']]['offline_total'] : 0) + $value['amount_received']; 
           $vendor[$value['vendor_id']]['offline_order_id'][] = $value['orderid'];
           $vendor[$value['vendor_id']]['name'] = $value['name'];
           $vendor[$value['vendor_id']]['gateway_charge'] = $value['value'];
           $vendor[$value['vendor_id']]['garage_name'] = $value['garage_name'];
           $vendor[$value['vendor_id']]['commission_service'] = $value['commission_service'];  
           $vendor[$value['vendor_id']]['commission_spare'] = $value['commission_spare']; 
           $vendor[$value['vendor_id']]['billing_cycle'] = $value['billing_cycle']; 
           $vendor[$value['vendor_id']]['with_service_tax'] = $value['with_service_tax']; 
        }*/
        // spare and services
        /*$final = array();
        foreach($vendor as $value) {
            $compnay_tax_profit = 0;
            $vendor_tax_profit = 0;
	          $total_amount = 0;
            $amount_recived = 0;
            $online_actual_total = 0;
            $final[$value['vendor_id']] = $value;

            if(isset($value['online_order_id']) && !empty($value['online_order_id'])) {
              $final[$value['vendor_id']]['online_spare_total'] =  $this->riderprofitlib->get_all_spare($value['online_order_id']);
              $price_with_taxes = $this->riderprofitlib->get_all_service($value['online_order_id'], $value['with_service_tax'], $value['commission_service']);
              $final[$value['vendor_id']]['online_service_total'] =  $price_with_taxes['total'];
              $compnay_tax_profit = $compnay_tax_profit + $price_with_taxes['company_tax_value'];
              $vendor_tax_profit =  $vendor_tax_profit + $price_with_taxes['vendor_tax_value'];
              $total_amount = $price_with_taxes['total_amount'] + $final[$value['vendor_id']]['online_spare_total'];
              $amount_recived = $amount_recived + $price_with_taxes['total_amount'];  
              $online_actual_total = $total_amount;
            } else {
              $final[$value['vendor_id']]['online_spare_total'] = 0;
              $final[$value['vendor_id']]['online_service_total'] = 0;
            }


            if(isset($value['offline_order_id']) && !empty($value['offline_order_id'])) {
              $price_with_taxes = array();  
              $final[$value['vendor_id']]['offline_spare_total'] =  $this->riderprofitlib->get_all_spare($value['offline_order_id']);
              $price_with_taxes = $this->riderprofitlib->get_all_service($value['offline_order_id'], $value['with_service_tax'], $value['commission_service']);
              $final[$value['vendor_id']]['offline_service_total'] =  $price_with_taxes['total'];
              $compnay_tax_profit = $compnay_tax_profit + $price_with_taxes['company_tax_value'];
              $vendor_tax_profit =  $vendor_tax_profit + $price_with_taxes['vendor_tax_value'];
              $total_amount = $total_amount + $price_with_taxes['total_amount'] + $final[$value['vendor_id']]['offline_spare_total'];
              $amount_recived = $amount_recived + $final[$value['vendor_id']]['offline_total'];
              
            } else {
              $final[$value['vendor_id']]['offline_spare_total'] = 0;
              $final[$value['vendor_id']]['offline_service_total'] = 0;
            }


            $final[$value['vendor_id']]['tax_settlement'] = $compnay_tax_profit;
            $final[$value['vendor_id']]['total_amount'] = round($total_amount);
            $final[$value['vendor_id']]['online_actual_total'] = round($online_actual_total);
            $final[$value['vendor_id']]['amount_recived'] = round($amount_recived);
            $discount = round($total_amount) - round($amount_recived);
            // single service rounding issue;
            $discount = $discount <= 2 ? 0 : $discount ;
            $final[$value['vendor_id']]['discount_amount'] = $discount;
        }*/
        
        
        foreach($final as $value) {
            if($value['billing_cycle'] == 1) {
                $weekly[] = $value;
            } else if($value['billing_cycle'] == 2) {
                $fortnightly[] = $value;
            } else {
                $monthly[] = $value;
            }
        }
//        echo "<pre>";
//        print_r($monthly);
//        exit;
        
        $this->template->set('weekly', $weekly);
        $this->template->set('fortnightly', $fortnightly);
        $this->template->set('monthly', $monthly);
        $this->template->set('active', '');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Administrator | Profit')
                ->set_partial('header', 'partials/header')
                ->set_partial('leftnav', 'sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('rider_profit/index');
    }
    
    function addinvoice() {
        ini_set('max_execution_time', 300);

        $id = $this->riderprofitlib->addinvoice($this->input->post(NULL, FALSE));

        if($_POST['pickup_order_id'] != '') {
          $this->riderprofitlib->change_order_status($_POST['pickup_order_id'],1);
        }

        if($_POST['delivery_order_id'] != '') {
          $this->riderprofitlib->change_order_status($_POST['delivery_order_id'],2);
        }
        $data = $this->riderprofitlib->get_invoice_details($id);
        // echo $id; exit();
        // print_r($data);exit;
        $html = $this->load->view('rider_profit/invoice', $data, TRUE);
        $file_name = "rider_invoice_".$_POST['invoice_no'].".pdf";
        $this->load->library('MyPdfLib');
        $data1['invoice_url'] = $this->mypdflib->getPdfRider($html,$file_name);
        $this->riderprofitlib->update_invoice($id, $data1);
        echo json_encode('SUCCESS');
    }
    
    function tp() {
       
        $data = $this->riderprofitlib->get_invoice_details(4);
        
        $html = $this->load->view('rider_profit/invoice', $data, TRUE);
        //echo $html;exit;
        $file_name = "invoice_0000.pdf";
        $this->load->library('MyPdfLib');
        $data['url'] = $this->mypdflib->getPdf($html,$file_name);
        
        
    }

    function pending() {
        $weekly = array();
        $fortnightly = array();
        $monthly = array();
        $data = $this->riderprofitlib->get_data(0);
        
        foreach($data as $value) {
            if($value['billing_cycle'] == 1) {
                $weekly[] = $value;
            } else if($value['billing_cycle'] == 2) {
                $fortnightly[] = $value;
            } else {
                $monthly[] = $value;
            }
        }
        
        $this->template->set('weekly', $weekly);
        $this->template->set('fortnightly', $fortnightly);
        $this->template->set('monthly', $monthly);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Administrator | Profit')
                ->set_partial('header', 'partials/header')
                ->set_partial('leftnav', 'sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('rider_profit/pending');
    }
    function addpaid() {
        $data['paid_date'] = date('Y-m-d');
        $data['paid'] = 1;
        $id = $_POST['id'];
        $this->riderprofitlib->addpaid($id, $data);
        echo json_encode('SUCCESS');
    }
    function paid() {
        $weekly = array();
        $fortnightly = array();
        $monthly = array();
        $data = $this->riderprofitlib->get_data(1);
        
        foreach($data as $value) {
            if($value['billing_cycle'] == 1) {
                $weekly[] = $value;
            } else if($value['billing_cycle'] == 2) {
                $fortnightly[] = $value;
            } else {
                $monthly[] = $value;
            }
        }
        $this->template->set('weekly', $weekly);
        $this->template->set('fortnightly', $fortnightly);
        $this->template->set('monthly', $monthly);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Administrator | Profit')
                ->set_partial('header', 'partials/header')
                ->set_partial('leftnav', 'sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('rider_profit/paid');
    }
}

?>