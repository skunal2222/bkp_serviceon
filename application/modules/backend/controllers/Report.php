<?php 
class Report extends MX_Controller {

	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/APP.ini" );
	}


/*
	public function getUsers() {
		$this->load->library('zyk/UserLib');
		$this->load->library('zyk/General');
		$params = $this->input->post();
		if(!empty($params['from_date']))
			$params['from_date'] = date('Y-m-d',strtotime($params['from_date']));
		if(!empty($params['from_date']))
			$params['to_date'] = date('Y-m-d',strtotime($params['to_date']));
		$users = $this->userlib->getUsersReport($params);
		$areas = $this->general->getActiveAreas();
		$this->template->set('users',$users);
		$this->template->set('areas',$areas);
		$this->template->set('params',$params);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
						->title ( 'Administrator | Users' )
						->set_partial ( 'header', 'partials/header' )
						->set_partial ( 'leftnav', 'reports/menu' )
						->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('reports/CustomerReport');
	}*/
	
	public function getOrders() {
		$this->load->library('zyk/OrderLib');
		$params = $this->input->post();
		if(!empty($params['from_date']))
			$params['from_date'] = date('Y-m-d',strtotime($params['from_date']));
		else 
			$params['from_date'] = date('Y-m-d',strtotime('-90 days'));
		if(!empty($params['to_date']))
			$params['to_date'] = date('Y-m-d',strtotime($params['to_date']));
		else 
			$params['to_date'] = date('Y-m-d');
		if(!isset($params['status'])) {
			$params['status'] = '';
		}
		$orders = $this->orderlib->searchOrders($params);
		$this->template->set('orders',$orders);
		$this->template->set('params',$params);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
					   ->title ( 'Administrator | Orders' )
					  	->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('reports/OrderReport');
	}
	
	public function getVendors() {
		$this->load->library('zyk/ReportLib');
		$params = $this->input->post();
		if(!empty($params['from_date']))
			$params['from_date'] = date('Y-m-d',strtotime($params['from_date']));
		else
			$params['from_date'] = date('Y-m-d',strtotime('-90 days'));
		if(!empty($params['to_date']))
			$params['to_date'] = date('Y-m-d',strtotime($params['to_date']));
		else
			$params['to_date'] = date('Y-m-d');
		if(!isset($params['status'])) {
			$params['status'] = '';
		}
		$vendors = $this->reportlib->searchVendors($params);
		$this->template->set('vendors',$vendors);
		$this->template->set('params',$params);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Orders' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('reports/Vendor');
	}
	
	public function getBusinessReport() {
		$this->load->library('zyk/ReportLib');
		$params = $this->input->post();
		if(!empty($params['from_date']))
			$params['from_date'] = date('Y-m-d',strtotime($params['from_date']));
		else
			$params['from_date'] = date('Y-m-d',strtotime('-7 days'));
		    //$params['from_date'] = date('2018-01-10');
		if(!empty($params['to_date']))
			$params['to_date'] = date('Y-m-d',strtotime($params['to_date']));
		else
			$params['to_date'] = date('Y-m-d');
		$params['status'] = '';
		$orders = $this->reportlib->getBusinessReport($params);
	/*
		echo "<pre>";
		print_r($orders);
		exit();*/

		$this->template->set('orders',$orders);
		$this->template->set('params',$params);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Orders' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('reports/BusinessReport');
	}
	
	public function getVendorReport() {
		$this->load->library('zyk/ReportLib');
		$params = $this->input->post();
		if(!empty($params['from_date']))
			$params['from_date'] = date('Y-m-d',strtotime($params['from_date']));
		else
			//$params['from_date'] = date('Y-m-d',strtotime('-7 days'));
			$params['from_date'] = date('2018-01-10');
		if(!empty($params['to_date']))
			$params['to_date'] = date('Y-m-d',strtotime($params['to_date']));
		else
			$params['to_date'] = date('Y-m-d');
		$params['status'] = '';
		$vendors = $this->reportlib->getVendorReport($params);
		$this->template->set('vendors',$vendors);
		$this->template->set('params',$params);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Orders' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('reports/VendorReport');
	}
	
	public function getvendorDetailReport($id) {
		$this->load->library('zyk/ReportLib');
		$params = $this->input->post();
		if(!empty($params['from_date']))
			$params['from_date'] = date('Y-m-d',strtotime($params['from_date']));
		else
			//$params['from_date'] = date('Y-m-d',strtotime('-7 days'));
		    $params['from_date'] = date('2018-01-10');
		if(!empty($params['to_date']))
			$params['to_date'] = date('Y-m-d',strtotime($params['to_date']));
		else
			$params['to_date'] = date('Y-m-d',strtotime('+30 days'));
		$params['status'] = '';
		$params['vendorid'] = $id;
		$vendors = $this->reportlib->getvendorDetails($params);
		$orders = $this->reportlib->getvendorDetailReport($params);
		$this->template->set('vendors',$vendors);
		$this->template->set('orders',$orders);
		$this->template->set('params',$params);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Orders' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('reports/VendorDetails');
	}
	
	public function downloadReport() {
		$this->load->library('zyk/ReportLib');
		$params = $this->input->get();
		if(!empty($params['from_date']))
			$params['from_date'] = date('Y-m-d',strtotime($params['from_date']));
		else
			$params['from_date'] = date('Y-m-d',strtotime('-7 days'));
		if(!empty($params['to_date']))
			$params['to_date'] = date('Y-m-d',strtotime($params['to_date']));
		else
			$params['to_date'] = date('Y-m-d');
		$params['status'] = '';
		$orders = $this->reportlib->getBusinessReport($params);
		$reports = array();
		
		$g2gservicecommission = 0;
		$g2gsparecommission = 0;
		$vendorservicecommission = 0;
		$vendorsparecommission = 0;
		
		foreach ($orders as $order) {
			$report = array();
			$report['Order ID'] = $order['orderid'];
			$report['Order Date'] = date('d-m-Y',strtotime($order['ordered_on']));
			$report['Service Date'] = date('d-m-Y',strtotime($order['pickup_date']));
			$report['Customer Name'] = $order['name'];
			$report['Customer Email'] = $order['email'];
			$report['Customer Mobile'] = $order['mobile'];
			$report['Area'] = $order['locality'];
			$report['Address'] = $order['address'];
			$report['Garage Name'] = $order['garage_name'];
			$report['Category'] = $order['category'];
			$report['Brand'] = $order['brand'];
			$report['Model'] = $order['model'];
			$report['Subcategory'] = $order['subcategory'];
			
			$services =array();
			foreach($order['items'] as $items){ 
				$service = $items['service_name']; 
				$services[] = $service;
			}
			//$userid = implode(",", $uid);
			$report['Services'] = implode(",", $services);
						
			if($order['is_new_customer'] == 1){
				$report['Customer Type'] = 'New Customer';
			} else {
			 	$report['Customer Type'] = 'Existing Customer';
			}
			if($order['source'] == 2) {
				$report['Order Source'] = 'Website';
			} else if($order['source'] == 1){
				$report['Order Source'] = 'APP';
			} else {
				$report['Order Source'] = 'Backend';
			}
			/* if(!empty($order['coupon_code']))
				$report['Coupon Code'] = $order['coupon_code'];
			else
				$report['Coupon Code'] = 'NA';
			 */
			$report['Discount'] = $order['discount'];
			$report['Adjustment'] = $order['adjustment'];
			$report['Total Bill'] = $order['grand_total'];
			$report['G2G Commission'] = $order['garagecomm'];
			$report['Vendor Commission'] = $order['vendorcomm'];
					
			if($order['payment_status'] == 1) {
				$report['Amount Received'] = $order['amount_received']." - Online";
			} else {
				$report['Amount Received'] = $order['amount_received']." - Cash";
			}
			if($order['status'] == 0) {
				$report['Status'] = 'Assign Garage';
			} else if($order['status'] == 1) {
				$report['Status'] = 'Assigned For Garage';
			} else if($order['status'] == 2) {
				$report['Status'] = 'Waiting for approval';
			} else if($order['status'] == 3) {
				$report['Status'] = 'Work in progress';
			} else if($order['status'] == 4) {
				$report['Status'] = 'Work Completed';
			} else if($order['status'] == 7) {
				$report['Status'] = 'Order Delivery Completed';
			} else {
				$report['Status'] = 'Order Cancelled';
			}
			
			$g2gservicecommission += $order['garage_service_comm'];
			$vendorservicecommission +=	$order['vendor_service_comm'];
			$g2gsparecommission += $order['garage_spare_comm'];
			$vendorsparecommission += $order['vendor_spare_comm'];
			
			$reports[] = $report;
		}
		$toatlbill = $g2gservicecommission+$vendorservicecommission+$g2gsparecommission+$vendorsparecommission;
		
		$this->load->library('MyExcel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$objWorksheet->setTitle("Business Report");
		$batch = array();
		$filename = FCPATH.'assets/documents/reports/business_report'.date('dmY').'.xls';
		$data = array();
		$itemcnt = 1;
		$objWorksheet->getColumnDimension('A')->setAutoSize(true);
		$objWorksheet->getColumnDimension('B')->setAutoSize(true);
		$objWorksheet->getColumnDimension('C')->setAutoSize(true);
		$objWorksheet->getColumnDimension('D')->setAutoSize(true);
		$objWorksheet->getColumnDimension('E')->setAutoSize(true);
		$objWorksheet->getColumnDimension('F')->setAutoSize(true);
		$objWorksheet->getColumnDimension('G')->setAutoSize(true);
		$objWorksheet->getColumnDimension('H')->setAutoSize(true);
		$objWorksheet->getColumnDimension('I')->setAutoSize(true);
		$objWorksheet->getColumnDimension('J')->setAutoSize(true);
		$objWorksheet->getColumnDimension('K')->setAutoSize(true);
		$objWorksheet->getColumnDimension('L')->setAutoSize(true);
		$objWorksheet->getColumnDimension('M')->setAutoSize(true);
		$objWorksheet->getColumnDimension('N')->setAutoSize(true);
		$objWorksheet->getColumnDimension('O')->setAutoSize(true);
		$objWorksheet->getColumnDimension('P')->setAutoSize(true);
		$objWorksheet->getColumnDimension('Q')->setAutoSize(true);
		$objWorksheet->getColumnDimension('R')->setAutoSize(true);
		$objWorksheet->getColumnDimension('S')->setAutoSize(true);
		$objWorksheet->getColumnDimension('T')->setAutoSize(true);
		$objWorksheet->getColumnDimension('U')->setAutoSize(true);
		$objWorksheet->getColumnDimension('V')->setAutoSize(true);
		$objWorksheet->getColumnDimension('W')->setAutoSize(true);
		
		$objWorksheet->getStyle('A1:W1')->getFont()->setBold(true);
		$objWorksheet->setCellValueByColumnAndRow(0,$itemcnt,'Order ID');
		$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,'Customer Name');
		$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,'Customer Email');
		$objWorksheet->setCellValueByColumnAndRow(3,$itemcnt,'Customer Mobile');
		$objWorksheet->setCellValueByColumnAndRow(4,$itemcnt,'Service Date');
		$objWorksheet->setCellValueByColumnAndRow(5,$itemcnt,'Order Date');
		$objWorksheet->setCellValueByColumnAndRow(6,$itemcnt,'Area');
		$objWorksheet->setCellValueByColumnAndRow(7,$itemcnt,'Address');
		$objWorksheet->setCellValueByColumnAndRow(8,$itemcnt,'Mechanic Name');
		$objWorksheet->setCellValueByColumnAndRow(9,$itemcnt,'Category');
		$objWorksheet->setCellValueByColumnAndRow(10,$itemcnt,'Brand');
		$objWorksheet->setCellValueByColumnAndRow(11,$itemcnt,'Model');
		$objWorksheet->setCellValueByColumnAndRow(12,$itemcnt,'Subcategory');
		$objWorksheet->setCellValueByColumnAndRow(13,$itemcnt,'Services');
		$objWorksheet->setCellValueByColumnAndRow(14,$itemcnt,'Customer Type');
		$objWorksheet->setCellValueByColumnAndRow(15,$itemcnt,'Source');
		$objWorksheet->setCellValueByColumnAndRow(16,$itemcnt,'Discount');
		$objWorksheet->setCellValueByColumnAndRow(17,$itemcnt,'Adjustment');
		$objWorksheet->setCellValueByColumnAndRow(18,$itemcnt,'Total Bill');
		$objWorksheet->setCellValueByColumnAndRow(19,$itemcnt,'Amount Received');
		$objWorksheet->setCellValueByColumnAndRow(20,$itemcnt,'Bikedoctor Commission');
		$objWorksheet->setCellValueByColumnAndRow(21,$itemcnt,'Vendor Commission');
		$objWorksheet->setCellValueByColumnAndRow(22,$itemcnt,'Status');
		//$objWorksheet->setCellValueByColumnAndRow(19,$itemcnt,'Garage Name');
		//$objWorksheet->setCellValueByColumnAndRow(20,$itemcnt,'Services');
		$itemcnt = 2;
		try {
			foreach($reports as $key=>$report) {
				$objWorksheet->setCellValueByColumnAndRow(0,$itemcnt,$report['Order ID']);
				$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,$report['Customer Name']);
				$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,$report['Customer Email']);
				$objWorksheet->setCellValueByColumnAndRow(3,$itemcnt,$report['Customer Mobile']);
				$objWorksheet->setCellValueByColumnAndRow(4,$itemcnt,$report['Service Date']);
				$objWorksheet->setCellValueByColumnAndRow(5,$itemcnt,$report['Order Date']);
				$objWorksheet->setCellValueByColumnAndRow(6,$itemcnt,$report['Area']);
				$objWorksheet->setCellValueByColumnAndRow(7,$itemcnt,$report['Address']);
				$objWorksheet->setCellValueByColumnAndRow(8,$itemcnt,$report['Garage Name']);
				$objWorksheet->setCellValueByColumnAndRow(9,$itemcnt,$report['Category']);
				$objWorksheet->setCellValueByColumnAndRow(10,$itemcnt,$report['Brand']);
				$objWorksheet->setCellValueByColumnAndRow(11,$itemcnt,$report['Model']);
				$objWorksheet->setCellValueByColumnAndRow(12,$itemcnt,$report['Subcategory']);
				$objWorksheet->setCellValueByColumnAndRow(13,$itemcnt,$report['Services']);
				$objWorksheet->setCellValueByColumnAndRow(14,$itemcnt,$report['Customer Type']);
				$objWorksheet->setCellValueByColumnAndRow(15,$itemcnt,$report['Order Source']);
				$objWorksheet->setCellValueByColumnAndRow(16,$itemcnt,$report['Discount']);
				$objWorksheet->setCellValueByColumnAndRow(17,$itemcnt,$report['Adjustment']);
				$objWorksheet->setCellValueByColumnAndRow(18,$itemcnt,$report['Total Bill']);
				$objWorksheet->setCellValueByColumnAndRow(19,$itemcnt,$report['Amount Received']);
				$objWorksheet->setCellValueByColumnAndRow(20,$itemcnt,$report['G2G Commission']);
				$objWorksheet->setCellValueByColumnAndRow(21,$itemcnt,$report['Vendor Commission']);
				$objWorksheet->setCellValueByColumnAndRow(22,$itemcnt,$report['Status']);
				//$objWorksheet->setCellValueByColumnAndRow(19,$itemcnt,$report['Garage Name']);
				//$objWorksheet->setCellValueByColumnAndRow(20,$itemcnt,$report['Services']);
				$itemcnt++;
			}
			$objWorksheet->getStyle('A2:W2'.$itemcnt)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFC3FFC1');
			
			$dn_file = "business_report".date('dmY').".xls";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename='.$dn_file);
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			unset($objPHPExcel);
		}catch(Exception $e) {
			$data['status'] = 0;
			$data['msg'] = 'Failed to download.';
			echo json_encode($data);
			unset($apicalls);
			unset($apioutput);
		}
	}
	
	public function downloadVendorDetailsReport() {
		$this->load->library('zyk/ReportLib');
		$params = $this->input->get();
		if(!empty($params['from_date']))
			$params['from_date'] = date('Y-m-d',strtotime($params['from_date']));
		else
			//$params['from_date'] = date('Y-m-d',strtotime('-7 days'));
		    $params['from_date'] = date('2018-01-10');
		if(!empty($params['to_date']))
			$params['to_date'] = date('Y-m-d',strtotime($params['to_date']));
		else
			$params['to_date'] = date('Y-m-d');
		$params['status'] = '';
		$params['vendorid'] = $params['vendor_id'];
		//$params['status'] = 
		$vendors = $this->reportlib->getvendorDetails($params);
		$orders = $this->reportlib->getvendorDetailReport($params);
		$reports = array();
		
		$g2gservicecommission = 0;
		$g2gsparecommission = 0;
		$vendorservicecommission = 0;
		$vendorsparecommission = 0;
		
		foreach ($orders as $order) {
			$report = array();
			$report['Order ID'] = $order['orderid'];
			$report['Order Date'] = date('d-m-Y',strtotime($order['ordered_on']));
			$report['Service Date'] = date('d-m-Y',strtotime($order['pickup_date']));
			$report['Customer Name'] = $order['name'];
			$report['Customer Email'] = $order['email'];
			$report['Customer Mobile'] = $order['mobile'];
			$report['Area'] = $order['locality'];
			$report['Address'] = $order['address'];
			$report['Garage Name'] = $order['garage_name'];
			$report['Category'] = $order['category'];
			$report['Brand'] = $order['brand'];
			$report['Model'] = $order['model'];
			$report['Subcategory'] = $order['subcategory'];
				
			$services =array();
			foreach($order['items'] as $items){
				$service = $items['service_name'];
				$services[] = $service;
			}
			//$userid = implode(",", $uid);
			$report['Services'] = implode(",", $services);
	
			if($order['is_new_customer'] == 1){
				$report['Customer Type'] = 'New Customer';
			} else {
				$report['Customer Type'] = 'Existing Customer';
			}
			if($order['source'] == 2) {
				$report['Order Source'] = 'Website';
			} else if($order['source'] == 1){
				$report['Order Source'] = 'APP';
			} else {
				$report['Order Source'] = 'Backend';
			}
			/* if(!empty($order['coupon_code']))
			 $report['Coupon Code'] = $order['coupon_code'];
				else
					$report['Coupon Code'] = 'NA';
				 */
				$report['Discount'] = $order['discount'];
				$report['Adjustment'] = $order['adjustment'];
				$report['Total Bill'] = $order['grand_total'];
				$report['G2G Commission'] = $order['garagecomm'];
				$report['Vendor Commission'] = $order['vendorcomm'];
				$report['G2G Service Commission'] = $order['garage_service_comm'];
				$report['Vendor Service Commission'] = $order['vendor_service_comm'];
				$report['G2G Spare Commission'] = $order['garage_spare_comm'];
				$report['Vendor Spare Commission'] = $order['vendor_spare_comm'];
					
				if($order['payment_status'] == 1) {
					$report['Amount Received'] = $order['amount_received']." - Online";
				} else {
					$report['Amount Received'] = $order['amount_received']." - Cash";
				}
				if($order['status'] == 0) {
					$report['Status'] = 'Assign Garage';
				} else if($order['status'] == 1) {
					$report['Status'] = 'Assigned For Garage';
				} else if($order['status'] == 2) {
					$report['Status'] = 'Waiting for approval';
				} else if($order['status'] == 3) {
					$report['Status'] = 'Work in progress';
				} else if($order['status'] == 4) {
					$report['Status'] = 'Work Completed';
				} else if($order['status'] == 7) {
					$report['Status'] = 'Order Delivery Completed';
				} else {
					$report['Status'] = 'Order Cancelled';
				}
					
				$reports[] = $report;
				
				$g2gservicecommission += $order['garage_service_comm'];
				$vendorservicecommission +=	$order['vendor_service_comm'];
				$g2gsparecommission += $order['garage_spare_comm'];
				$vendorsparecommission += $order['vendor_spare_comm'];
		}
		$toatlbill = $g2gservicecommission+$vendorservicecommission+$g2gsparecommission+$vendorsparecommission;
		
		$this->load->library('MyExcel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$objWorksheet->setTitle($vendors[0]['garage_name']);
		$batch = array();
		$filename = FCPATH.'assets/documents/reports/vendor_report'.date('dmY').'.xls';
		$data = array();
		
		$objWorksheet->getColumnDimension('A')->setAutoSize(true);
		$objWorksheet->getColumnDimension('B')->setAutoSize(true);
		$objWorksheet->getColumnDimension('C')->setAutoSize(true);
		$objWorksheet->getColumnDimension('D')->setAutoSize(true);
		$objWorksheet->getColumnDimension('E')->setAutoSize(true);
		$objWorksheet->getColumnDimension('F')->setAutoSize(true);
		$objWorksheet->getColumnDimension('G')->setAutoSize(true);
		$objWorksheet->getColumnDimension('H')->setAutoSize(true);
		$objWorksheet->getColumnDimension('I')->setAutoSize(true);
		$objWorksheet->getColumnDimension('J')->setAutoSize(true);
		$objWorksheet->getColumnDimension('K')->setAutoSize(true);
		$objWorksheet->getColumnDimension('L')->setAutoSize(true);
		$objWorksheet->getColumnDimension('M')->setAutoSize(true);
		$objWorksheet->getColumnDimension('N')->setAutoSize(true);
		$objWorksheet->getColumnDimension('O')->setAutoSize(true);
		$objWorksheet->getColumnDimension('P')->setAutoSize(true);
		$objWorksheet->getColumnDimension('Q')->setAutoSize(true);
		$objWorksheet->getColumnDimension('R')->setAutoSize(true);
		$objWorksheet->getColumnDimension('S')->setAutoSize(true);
		$objWorksheet->getColumnDimension('T')->setAutoSize(true);
		$objWorksheet->getColumnDimension('U')->setAutoSize(true);
		$objWorksheet->getColumnDimension('V')->setAutoSize(true);
		$objWorksheet->getColumnDimension('W')->setAutoSize(true);
		$objWorksheet->getColumnDimension('X')->setAutoSize(true);
		$objWorksheet->getColumnDimension('Y')->setAutoSize(true);
		$objWorksheet->getColumnDimension('Z')->setAutoSize(true);
		$itemcnt = 1;  +$vendorservicecommission+$g2gsparecommission+$vendorsparecommission;
		$objWorksheet->getStyle('B1:C1')->getFont()->setBold(true);
		$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,'Mechanic Name : '.$vendors[0]['garage_name']);
		$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,'Total Bill : '.$toatlbill);
		$itemcnt = 2;
		$objWorksheet->getStyle('B2:C2:D2')->getFont()->setBold(true);
		$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,'Address : '.$vendors[0]['locality']);
		$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,'Service Commission : '.$vendors[0]['commission_service'].'%');
		$objWorksheet->setCellValueByColumnAndRow(3,$itemcnt,'Spare Commission : '.$vendors[0]['commission_spare'].'%');
		$itemcnt = 3;
		$objWorksheet->getStyle('B3:C3:D3')->getFont()->setBold(true);
		$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,'Email : '.$vendors[0]['email']);
		$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,'Bikedoctor Service Commission : '.$g2gservicecommission);
		$objWorksheet->setCellValueByColumnAndRow(3,$itemcnt,'Bikedoctor Spare Commission : '.$g2gsparecommission);
		$itemcnt = 4;
		$objWorksheet->getStyle('B4:C4:D4')->getFont()->setBold(true);
		$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,'Mobile : '.$vendors[0]['mobile']);
		$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,'Vendor Service Commission : '.$vendorservicecommission);
		$objWorksheet->setCellValueByColumnAndRow(3,$itemcnt,'Vendor Spare Commission : '.$vendorsparecommission);
		$itemcnt = 5;
		$objWorksheet->getStyle('B5:C5')->getFont()->setBold(true);
		$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,'Category : '.$vendors[0]['category']);
		//$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,'Total Bill : '.$vendors[0]['totalbill']);
		$itemcnt = 6;
		$objWorksheet->getStyle('B6:C6')->getFont()->setBold(true);
		$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,'From Date : '.date('d-m-Y',strtotime($params['from_date'])));
		$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,'To Date : '.date('d-m-Y',strtotime($params['to_date'])));
		$itemcnt = 8;
		$objWorksheet->getStyle('A8:W8')->getFont()->setBold(true);
		$objWorksheet->setCellValueByColumnAndRow(0,$itemcnt,'Order ID');
		$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,'Customer Name');
		$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,'Customer Email');
		$objWorksheet->setCellValueByColumnAndRow(3,$itemcnt,'Customer Mobile');
		$objWorksheet->setCellValueByColumnAndRow(4,$itemcnt,'Service Date');
		$objWorksheet->setCellValueByColumnAndRow(5,$itemcnt,'Order Date');
		$objWorksheet->setCellValueByColumnAndRow(6,$itemcnt,'Area');
		$objWorksheet->setCellValueByColumnAndRow(7,$itemcnt,'Address');
		$objWorksheet->setCellValueByColumnAndRow(8,$itemcnt,'Mechanic Name');
		$objWorksheet->setCellValueByColumnAndRow(9,$itemcnt,'Category');
		$objWorksheet->setCellValueByColumnAndRow(10,$itemcnt,'Brand');
		$objWorksheet->setCellValueByColumnAndRow(11,$itemcnt,'Model');
		$objWorksheet->setCellValueByColumnAndRow(12,$itemcnt,'Subcategory');
		$objWorksheet->setCellValueByColumnAndRow(13,$itemcnt,'Services');
		$objWorksheet->setCellValueByColumnAndRow(14,$itemcnt,'Customer Type');
		$objWorksheet->setCellValueByColumnAndRow(15,$itemcnt,'Source');
		$objWorksheet->setCellValueByColumnAndRow(16,$itemcnt,'Discount');
		$objWorksheet->setCellValueByColumnAndRow(17,$itemcnt,'Adjustment');
		$objWorksheet->setCellValueByColumnAndRow(18,$itemcnt,'Total Bill');
		$objWorksheet->setCellValueByColumnAndRow(19,$itemcnt,'Amount Received');
		$objWorksheet->setCellValueByColumnAndRow(20,$itemcnt,'Bikedoctor Service Commission');
		$objWorksheet->setCellValueByColumnAndRow(21,$itemcnt,'Vendor Service Commission');
		$objWorksheet->setCellValueByColumnAndRow(22,$itemcnt,'Bikedoctor Spare Commission');
		$objWorksheet->setCellValueByColumnAndRow(23,$itemcnt,'Vendor Spare Commission');
		$objWorksheet->setCellValueByColumnAndRow(24,$itemcnt,'Status');
		//$objWorksheet->setCellValueByColumnAndRow(19,$itemcnt,'Garage Name');
		//$objWorksheet->setCellValueByColumnAndRow(20,$itemcnt,'Services');
		$itemcnt = 9;
		try {
			foreach($reports as $key=>$report) {
				$objWorksheet->setCellValueByColumnAndRow(0,$itemcnt,$report['Order ID']);
				$objWorksheet->setCellValueByColumnAndRow(1,$itemcnt,$report['Customer Name']);
				$objWorksheet->setCellValueByColumnAndRow(2,$itemcnt,$report['Customer Email']);
				$objWorksheet->setCellValueByColumnAndRow(3,$itemcnt,$report['Customer Mobile']);
				$objWorksheet->setCellValueByColumnAndRow(4,$itemcnt,$report['Service Date']);
				$objWorksheet->setCellValueByColumnAndRow(5,$itemcnt,$report['Order Date']);
				$objWorksheet->setCellValueByColumnAndRow(6,$itemcnt,$report['Area']);
				$objWorksheet->setCellValueByColumnAndRow(7,$itemcnt,$report['Address']);
				$objWorksheet->setCellValueByColumnAndRow(8,$itemcnt,$report['Garage Name']);
				$objWorksheet->setCellValueByColumnAndRow(9,$itemcnt,$report['Category']);
				$objWorksheet->setCellValueByColumnAndRow(10,$itemcnt,$report['Brand']);
				$objWorksheet->setCellValueByColumnAndRow(11,$itemcnt,$report['Model']);
				$objWorksheet->setCellValueByColumnAndRow(12,$itemcnt,$report['Subcategory']);
				$objWorksheet->setCellValueByColumnAndRow(13,$itemcnt,$report['Services']);
				$objWorksheet->setCellValueByColumnAndRow(14,$itemcnt,$report['Customer Type']);
				$objWorksheet->setCellValueByColumnAndRow(15,$itemcnt,$report['Order Source']);
				$objWorksheet->setCellValueByColumnAndRow(16,$itemcnt,$report['Discount']);
				$objWorksheet->setCellValueByColumnAndRow(17,$itemcnt,$report['Adjustment']);
				$objWorksheet->setCellValueByColumnAndRow(18,$itemcnt,$report['Total Bill']);
				$objWorksheet->setCellValueByColumnAndRow(19,$itemcnt,$report['Amount Received']);
				$objWorksheet->setCellValueByColumnAndRow(20,$itemcnt,$report['G2G Service Commission']);
				$objWorksheet->setCellValueByColumnAndRow(21,$itemcnt,$report['Vendor Service Commission']);
				$objWorksheet->setCellValueByColumnAndRow(22,$itemcnt,$report['G2G Spare Commission']);
				$objWorksheet->setCellValueByColumnAndRow(23,$itemcnt,$report['Vendor Spare Commission']);
				$objWorksheet->setCellValueByColumnAndRow(24,$itemcnt,$report['Status']);
				//$objWorksheet->setCellValueByColumnAndRow(19,$itemcnt,$report['Garage Name']);
				//$objWorksheet->setCellValueByColumnAndRow(20,$itemcnt,$report['Services']);
				$itemcnt++;
			}
			$objWorksheet->getStyle('A9:W9'.$itemcnt)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFC3FFC1');
				
			$dn_file = $vendors[0]['garage_name']."_VendorReport".date('dmY').".xls";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename='.$dn_file);
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			unset($objPHPExcel);
		}catch(Exception $e) {
			$data['status'] = 0;
			$data['msg'] = 'Failed to download.';
			echo json_encode($data);
			unset($apicalls);
			unset($apioutput);
		}
	}
	
	public function collectionReport() {
		$this->load->library('zyk/ReportLib');
		$this->load->library('zyk/General');
		$params = $this->input->post();
		if(!empty($params['from_date']))
			$params['from_date'] = date('Y-m-d',strtotime($params['from_date']));
		else
			$params['from_date'] = date('Y-m-d',strtotime('-7 days'));
		if(!empty($params['to_date']))
			$params['to_date'] = date('Y-m-d',strtotime($params['to_date']));
		else
			$params['to_date'] = date('Y-m-d');
		if(empty($params['executive_id'])) {
			$params['executive_id'] = '';
		}
		$orders = $this->reportlib->getCashCollectionReport($params);
		$executives = $this->general->getActiveFieldExecutives();
		$this->template->set('orders',$orders);
		$this->template->set('params',$params);
		$this->template->set('executives',$executives);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Cash Collection Report' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('reports/CashCollection');
	} 
	public function mechanic_log() {
            $this->load->library('zyk/RestaurantLib');
            $map = array();
            $mechanic = $this->restaurantlib->getRestaurants($map);
            $this->template->set('mechanic', $mechanic);
             $this->template->set_theme('default_theme');
             $this->template->set_layout ('backend')
             ->title ( 'Administrator | Cash Collection Report' )
             ->set_partial ( 'header', 'partials/header' )
             ->set_partial ( 'leftnav', 'partials/sidebar' )
             ->set_partial ( 'footer', 'partials/footer' );
             $this->template->build ('reports/mechanic_log');
	} 
        
    /*public function download_mechanic_log() {
            $data = $_GET;
            $this->load->library('zyk/ReportLib');
            $report = $this->reportlib->download_mechanic_log($data); 

            header('Content-Disposition: attachment; filename= Mechanic-Log-'.time().'.csv');
            $output = fopen('php://output', 'w');
            fputcsv($output, array('Order Id', 'Status', 'Customer Name', 'Location', 'Customer Area', 'Mobile No', 'Subcategory', 'Brand', 'Model', 'Service Group', 'Service', 'Spares', 'Comments', 'Coupon Code', 'Time of Order Id generation', 'Date of Order Id Generation', 'User Id', 'Date of Service at time of new order', 'Service Time', 'Garage Name', 'Assigned Date', 'Assigned Time', 'Date of Service (actual)', 'Estimate Value at New Order', 'Started', 'Reached', 'Inspection Done', 'Confirm Estimate', 'Estimate Value at Confirm Estimate', 'Mark Work Completed', 'Amount Captured in Mechanic App', 'Invoice Value', 'Invoice Line Items', 'Discount', 'Adjustments', 'Mode of Payment', 'Comments captured in Webapp', 'List of Items Rejected'));
            foreach ($report   as $value) {
                fputcsv($output, array($value['orderid'], $value['order_status'], $value['name'], $value['address'], $value['locality'], $value['mobile'], $value['Subcategory'], $value['Brand'], $value['Model'], $value['Service_Group'], $value['Service'], $value['Spare'], $value['comment'], $value['coupon_code'], $value['Time_order_id_gen'], $value['Date_order_id_gen'], $value['userid'], $value['Date_of_Service_at_time_of_new_order'], $value['slot'], $value['Garage_name'], $value['Assigned_Date'], $value['Assigned_Time'], $value['pickup_date'], $value['New_order_amount'], $value['Started'], $value['Reached'], $value['Inspection'], $value['Confirm_Estimate'], $value['Confirm_Estimate_value'], $value['Mark_Work_Completed'], $value['amount_received'], $value['grand_total'], $value['Invoice_Line_Items'], $value['discount'], $value['adjustment'], $value['Mode_of_Payment'], $value['WebComments'], $value['Rejected']));
            }
    }*/

    public function download_mechanic_log() {
            $data = $_GET;
            $this->load->library('zyk/ReportLib');
            $report = $this->reportlib->download_mechanic_log($data);
   
            header('Content-Disposition: attachment; filename= Mechanic-Log-'.time().'.csv');
            $output = fopen('php://output', 'w');
            fputcsv($output, array('Order Id', 'Status', 'Customer Name', 'Location', 'Customer Area', 'Mobile No', 'Subcategory', 'Brand', 'Model', 'Service Group','Package_name', 'Service', 'Spares', 'Comments', 'Coupon Code', 'Time of Order Id generation', 'Date of Order Id Generation', 'User Id', 'Date of Service at time of new order', 'Service Time', 'Garage Name', 'Assigned Date', 'Assigned Time', 'Date of Service (actual)', 'Started', 'Reached', 'Inspection Done', 'Confirm Estimate','Mark Work Completed', 'Invoice Value', 'Invoice Line Items', 'Discount', 'Adjustments', 'Mode of Payment', 'Comments captured in Webapp', 'List of Items Rejected'));
            foreach ($report   as $value) {
                fputcsv($output, array($value['orderid'], $value['order_status'], $value['name'], $value['address'], $value['locality'], $value['mobile'], $value['Subcategory'], $value['Brand'], $value['Model'], $value['Service_Group'],$value['Package_name'], $value['Service'], $value['Spare'], $value['comment'], $value['coupon_code'], $value['Time_order_id_gen'], $value['Date_order_id_gen'], $value['userid'], $value['Date_of_Service_at_time_of_new_order'], $value['slot'], $value['Garage_name'], $value['Assigned_Date'], $value['Assigned_Time'], $value['pickup_date'], $value['Started'], $value['Reached'], $value['Inspection'], $value['Confirm_Estimate'],$value['Mark_Work_Completed'],$value['grand_total'], $value['Invoice_Line_Items'], $value['discount'], $value['adjustment'], $value['Mode_of_Payment'], $value['WebComments'], $value['Rejected']));
 

            }
 

    } 
}