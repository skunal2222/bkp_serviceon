<?php
class ReportLib {
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function getBusinessReport($params) {
		$this->CI->load->model ('orders/Order_model','order');
		$orders = $this->CI->order->getBusinessReport($params);
		$order_items = array();
		$orderids = "";
		foreach ($orders as $order) {
			if($orderids == "") {
				$orderids = $order['orderid'];
			} else {
				$orderids = $orderids.','.$order['orderid'];
			}
		}
		
		$reports = array();
		foreach ($orders as $order) {
			$report = array();
			$report['orderid'] = $order['orderid'];
			$report['name'] = $order['name'];
			$report['email'] = $order['email'];
			$report['mobile'] = $order['mobile'];
			$report['delivery_date'] = $order['tml_delivery_date'];
            $report['pickup_date'] = $order['pickup_date'];
			$report['ordered_on'] = $order['ordered_on'];
			$report['areaname'] = $order['areaname'];
			$report['address'] = $order['address'];
			$report['locality'] = $order['locality'];
			$report['address'] = $order['address'];
			$report['garage_name'] = $order['garage_name'];
			$report['category'] = $order['category'];
			$report['brand'] = $order['brand'];
			$report['model'] = $order['model'];
			$report['subcategory'] = $order['subcategory'];
			$report['grand_total'] = number_format($order['grand_total'],2);
			$report['is_new_customer'] = $order['is_new_customer'];
			$report['source'] = $order['source'];
			if(!empty($order['coupon_code']))
				$report['coupon_code'] = $order['coupon_code'];
			else 
				$report['coupon_code'] = 'NA';
			if(!empty($order['title']))
				$report['coupon_title'] = $order['title'];
			else 
				$report['coupon_title'] = 'NA';
			$report['discount'] = $order['discount'];
		    $report['delivery_charge'] = $order['delivery_charge'];
            $report['adjustment'] = $order['adjustment'];
			$report['amount_received'] = number_format($order['amount_received'],2);
			$report['payment_status'] = $order['payment_status'];
			$report['status'] = $order['status'];
			
			if(!empty($order['grand_total'])){
				$report['garagecomm'] = number_format($order['commission_service'] /100 * $report['amount_received'],2);
				$report['vendorcomm'] =	number_format($report['amount_received'] - $report['garagecomm'],2);
			}else{
				$report['garagecomm'] = 0;
				$report['vendorcomm'] = 0;
			}
			$items = $this->CI->order->getOrderItems($order['orderid']);
			//$items = $this->CI->order->getOrderItems($order['orderid']);
			$totalserviceprice = 0;
			$totalspareprice = 0;
			foreach($items as $item){
				if($item['service'] == 1) {
					$serviceprice = $item['total_amount'];
					$totalserviceprice += $serviceprice;
					//$totalserprice += $totalserviceprice;
				}
				if($item['service'] == 2) {
					$spareprice = $item['total_amount'];
					$totalspareprice += $spareprice;
					//$totalspaprice += $totalspareprice;
				}
			}
			if(!empty($totalserviceprice)){
				$report['garage_service_comm'] = number_format($order['commission_service'] /100 * $totalserviceprice,2);
				$report['vendor_service_comm'] = number_format($totalserviceprice - $report['garage_service_comm'],2);
			}else{
				$report['garage_service_comm'] = 0;
				$report['vendor_service_comm'] = 0;
			}
			if(!empty($totalspareprice)){
				$report['garage_spare_comm'] = number_format($order['commission_spare'] /100 * $totalspareprice,2);
				$report['vendor_spare_comm'] = number_format($totalspareprice - $report['garage_spare_comm'],2);
			}else{
				$report['garage_spare_comm'] = 0;
				$report['vendor_spare_comm'] = 0;
			}
			$report['items'] = $items;
			$reports[] = $report;
		}
		return $reports;
	}
	
	public function getVendorReport($params) {
		$this->CI->load->model ('restaurants/Restaurant_model','restaurant');
		$vendors = $this->CI->restaurant->getvendorReport($params);
		return $vendors;
	}
	
	public function getVendorDetails($params) {
		$this->CI->load->model ('restaurants/Restaurant_model','restaurant');
		$vendors = $this->CI->restaurant->getVendorDetails($params);
		$totalvendorbill = $vendors[0]['totalbill'];
		$vendors[0]['totalbill'] = number_format($vendors[0]['totalbill'],2);
		
		$vendors[0]['garagecomm'] = number_format($vendors[0]['commission_service'] /100 * $totalvendorbill,2);
		$vendors[0]['vendorcomm'] = number_format($totalvendorbill - $vendors[0]['garagecomm'],2);
		
		return $vendors;
	}
	
	public function getvendorDetailReport($params) {
		$this->CI->load->model ('restaurants/Restaurant_model','restaurant');
		$this->CI->load->model ('orders/Order_model','order');
		$orders = $this->CI->restaurant->getvendorDetailReport($params);
		$order_items = array();
		$orderids = "";
		foreach ($orders as $order) {
			if($orderids == "") {
				$orderids = $order['orderid'];
			} else {
				$orderids = $orderids.','.$order['orderid'];
			}
		}
		
		$reports = array();
		foreach ($orders as $order) {
			$report = array();
			$report['orderid'] = $order['orderid'];
			$report['name'] = $order['name'];
			$report['email'] = $order['email'];
			$report['mobile'] = $order['mobile'];
			$report['delivery_date'] = $order['tml_delivery_date'];
			$report['pickup_date'] = $order['pickup_date'];
			$report['ordered_on'] = $order['ordered_on'];
			$report['areaname'] = $order['areaname'];
			$report['address'] = $order['address'];
			$report['locality'] = $order['locality'];
			$report['address'] = $order['address'];
			$report['garage_name'] = $order['garage_name'];
			$report['category'] = $order['category'];
			$report['brand'] = $order['brand'];
			$report['model'] = $order['model'];
			$report['subcategory'] = $order['subcategory'];
			$report['grand_total'] = number_format($order['grand_total'],2);
			$report['is_new_customer'] = $order['is_new_customer'];
			$report['source'] = $order['source'];
			if(!empty($order['coupon_code']))
				$report['coupon_code'] = $order['coupon_code'];
			else
				$report['coupon_code'] = 'NA';
			if(!empty($order['title']))
				$report['coupon_title'] = $order['title'];
			else
				$report['coupon_title'] = 'NA';
			$report['discount'] = $order['discount'];
			$report['delivery_charge'] = $order['delivery_charge'];
			$report['adjustment'] = $order['adjustment'];
			$report['amount_received'] = number_format($order['amount_received'],2);
			$report['payment_status'] = $order['payment_status'];
			$report['status'] = $order['status'];
				
			if(!empty($order['grand_total'])){
				$report['garagecomm'] = number_format($order['commission_service'] /100 * $report['amount_received'],2);
				$report['vendorcomm'] =	number_format($report['amount_received'] - $report['garagecomm'],2);
			}else{
				$report['garagecomm'] = 0;
				$report['vendorcomm'] = 0;
			}
			$items = $this->CI->order->getOrderItems($order['orderid']);
			$totalserviceprice = 0;
			$totalspareprice = 0;
			$totalservicepricewithouttax = 0;
			foreach($items as $item){
				if($item['service'] == 1) {
					$serviceprice = $item['total_amount'];
					$servicepricewithouttax = $item['service_price'];
					$totalserviceprice += $serviceprice;
					$totalservicepricewithouttax += $servicepricewithouttax;
					//$totalserprice += $totalserviceprice;
				}
				if($item['service'] == 2) {
					$spareprice = $item['total_amount'];
					$totalspareprice += $spareprice;
					//$totalspaprice += $totalspareprice;
				}
			}
			if(!empty($totalserviceprice)){
				if($order['with_service_tax'] == 1){
					$report['garage_service_comm'] = number_format($order['commission_service'] /100 * $totalserviceprice,2);
					$report['vendor_service_comm'] = number_format($totalserviceprice - $report['garage_service_comm'],2);
					/* $taxprice = $totalservicepricewithouttax * (9/100);
					$garage_service_comm = number_format($order['commission_service'] /100 * $totalservicepricewithouttax,2);
					$vendor_service_comm = number_format($totalservicepricewithouttax - $garage_service_comm,2);
					$report['garage_service_comm'] = $garage_service_comm + $taxprice ;
					$report['vendor_service_comm'] = $vendor_service_comm + $taxprice; */
				}else{
					//echo "serviecprice : ".$totalserviceprice;
					$taxprice = $totalservicepricewithouttax * (18/100);
					//$servicepricewithouttax = $totalserviceprice - $taxprice;
					//echo "<br>serviecwithouttax : ".$servicepricewithouttax;
					$garage_service_comm = number_format($order['commission_service'] /100 * $totalservicepricewithouttax,2);
					$vendor_service_comm = number_format($totalservicepricewithouttax - $garage_service_comm,2);
					$report['garage_service_comm'] = $garage_service_comm + $taxprice ;
					$report['vendor_service_comm'] = $vendor_service_comm;
				}
				
			}else{
				$report['garage_service_comm'] = 0;
				$report['vendor_service_comm'] = 0;
			}
			if(!empty($totalspareprice)){
				$report['garage_spare_comm'] = number_format($order['commission_spare'] /100 * $totalspareprice,2);
				$report['vendor_spare_comm'] = number_format($totalspareprice - $report['garage_spare_comm'],2);
			}else{
				$report['garage_spare_comm'] = 0;
				$report['vendor_spare_comm'] = 0;
			}
			$report['items'] = $items;
			$reports[] = $report;
		}
		return $reports;
		//return $vendors;
	}
	
	public function getCashCollectionReport($params) {
		$this->CI->load->model ('orders/Order_model','order');
		$cashorders = $this->CI->order->getCashCollectionReport($params);
		$onlineorders = $this->CI->order->getOnlineCollectionReport($params);
		$ordercount = count($cashorders);
		if($ordercount > 0)
		$cashorders[$ordercount] = $onlineorders[0];
		return $cashorders;
	}
	
	public function searchVendors($map) {
		$this->CI->load->model ('restaurants/Restaurant_model','restaurant');
		return $this->CI->restaurant->searchVendors($map);
	}
	 public function download_mechanic_log($param) {
 
        $this->CI->load->model ('orders/Order_model','order');
	    return $this->CI->order->download_mechanic_log($param);
        }
}
