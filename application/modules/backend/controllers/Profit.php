<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Profit extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('zyk/ProfitLib');
    }
    
    public function index() {
        $this->load->library('mylib/OrderLib', 'orderlib');
        $weekly = array();
        $vendor = array();
        $fortnightly = array();
        $monthly = array();
        $order = $this->profitlib->get_online();
        
        foreach($order as $value) {
           $vendor[$value['vendor_id']]['vendor_id'] = $value['vendor_id'];
           $vendor[$value['vendor_id']]['online_total'] = (isset($vendor[$value['vendor_id']]['online_total']) ? $vendor[$value['vendor_id']]['online_total'] : 0) + $value['amount_received']; 
           $vendor[$value['vendor_id']]['online_order_id'][] = $value['orderid'];
           $vendor[$value['vendor_id']]['name'] = $value['name'];
           $vendor[$value['vendor_id']]['gateway_charge'] = $value['value'];
           $vendor[$value['vendor_id']]['garage_name'] = $value['garage_name'];
           $vendor[$value['vendor_id']]['commission_service'] = $value['commission_service'];  
           $vendor[$value['vendor_id']]['commission_spare'] = $value['commission_spare']; 
           $vendor[$value['vendor_id']]['billing_cycle'] = $value['billing_cycle']; 
           $vendor[$value['vendor_id']]['with_service_tax'] = $value['with_service_tax']; 
        }
        
        
        /*$offline = $this->profitlib->get_offline();
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
        $final = array();
        foreach($vendor as $value) {
            $compnay_tax_profit = 0;
            $vendor_tax_profit = 0;
	          $total_amount = 0;
            $amount_recived = 0;
            $online_actual_total = 0;
            $final[$value['vendor_id']] = $value;

            if(isset($value['online_order_id']) && !empty($value['online_order_id'])) {
              $final[$value['vendor_id']]['online_spare_total'] =  $this->profitlib->get_all_spare($value['online_order_id']);
              $price_with_taxes = $this->profitlib->get_all_service($value['online_order_id'], $value['with_service_tax'], $value['commission_service']);
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


            /*if(isset($value['offline_order_id']) && !empty($value['offline_order_id'])) {
              $price_with_taxes = array();  
              $final[$value['vendor_id']]['offline_spare_total'] =  $this->profitlib->get_all_spare($value['offline_order_id']);
              $price_with_taxes = $this->profitlib->get_all_service($value['offline_order_id'], $value['with_service_tax'], $value['commission_service']);
              $final[$value['vendor_id']]['offline_service_total'] =  $price_with_taxes['total'];
              $compnay_tax_profit = $compnay_tax_profit + $price_with_taxes['company_tax_value'];
              $vendor_tax_profit =  $vendor_tax_profit + $price_with_taxes['vendor_tax_value'];
              $total_amount = $total_amount + $price_with_taxes['total_amount'] + $final[$value['vendor_id']]['offline_spare_total'];
              $amount_recived = $amount_recived + $final[$value['vendor_id']]['offline_total'];
              
            } else {
              $final[$value['vendor_id']]['offline_spare_total'] = 0;
              $final[$value['vendor_id']]['offline_service_total'] = 0;
            }*/


            $final[$value['vendor_id']]['tax_settlement'] = $compnay_tax_profit;
            $final[$value['vendor_id']]['total_amount'] = round($total_amount);
            $final[$value['vendor_id']]['online_actual_total'] = round($online_actual_total);
            $final[$value['vendor_id']]['amount_recived'] = round($amount_recived);
            $discount = round($total_amount) - round($amount_recived);
            // single service rounding issue;
            $discount = $discount <= 2 ? 0 : $discount ;
            $final[$value['vendor_id']]['discount_amount'] = $discount;
        }
        
        
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
        $this->template->build('profit/index');
    }
    
    function addinvoice() {
         ini_set('max_execution_time', 300);
        $id = $this->profitlib->addinvoice($this->input->post(NULL, FALSE));
        if($_POST['online_order_id'] != '') {
          $this->profitlib->change_order_status($_POST['online_order_id']);
        }
        
        /*if($_POST['offline_order_id'] != '') {
           $this->profitlib->change_order_status($_POST['offline_order_id']); 
        }*/
        
        $data = $this->profitlib->get_invoice_details($id);
        $html = $this->load->view('profit/invoice', $data, TRUE);
        //echo $html;exit;
        $file_name = "invoice_".$_POST['invoice_no'].".pdf";
        $this->load->library('MyPdfLib');
        $data1['invoice_url'] = $this->mypdflib->getPdf($html,$file_name);
        $this->profitlib->update_invoice($id, $data1);
        echo json_encode('SUCCESS');
    }
    
    function tp() {
       
        $data = $this->profitlib->get_invoice_details(4);
        
        $html = $this->load->view('profit/invoice', $data, TRUE);
        //echo $html;exit;
        $file_name = "invoice_0000.pdf";
        $this->load->library('MyPdfLib');
        $data['url'] = $this->mypdflib->getPdf($html,$file_name);
        
        
    }

    function pending() {
        $weekly = array();
        $fortnightly = array();
        $monthly = array();
        $data = $this->profitlib->get_data(0);
        
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
        $this->template->build('profit/pending');
    }
    function addpaid() {
        $data['paid_date'] = date('Y-m-d');
        $data['paid'] = 1;
        $id = $_POST['id'];
        $this->profitlib->addpaid($id, $data);
        echo json_encode('SUCCESS');
    }
    function paid() {
        $weekly = array();
        $fortnightly = array();
        $monthly = array();
        $data = $this->profitlib->get_data(1);
        
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
        $this->template->build('profit/paid');
    }
}

?>