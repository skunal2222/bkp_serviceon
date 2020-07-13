<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
Class Bike extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		
	}
        public function sample() {
            
        }
	 
	/* ***********Bike************ */
	

	public function BikeList() {
		$this->load->library('zyk/BikeLib', 'bikelib');
	 	$bike = $this->bikelib->getListBikes();  
   
	 	$this->template->set('bike', $bike);  
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | List Bike' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('bike/BikeList');
	} 	

	public function BikeAdd() {

        $this->load->library('zyk/ClientLib', 'clientlib');
		$clients = $this->clientlib->getClients(); 
		$this->load->library('zyk/OutletLib', 'outletlib');
	 	$outlet = $this->outletlib->getAllActive();   
		$this->template->set('outlet', $outlet);
		$this->template->set('clients',$clients);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Add Bike' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('bike/BikeAdd');
	}
	
	public function add_bike() { 
        
        $this->load->library('zyk/BikeLib', 'bikelib');
	$params = array();
        $params['client_id']   = $this->input->post('client_id');  
        $params['outlet_id']   = $this->input->post('outlet_id'); 
        $params['bike_name']   = ucfirst($this->input->post('bike_name')); 
        $params['bike_number'] = $this->input->post('bike_number');  
        $params['rider_name']  = $this->input->post('rider_name');
        $params['rider_mobile'] = $this->input->post('rider_mobile'); 
        $params['model_id'] = $this->input->post('model_id'); 
        $params['km_run']  = $this->input->post('km_run'); 
        $params['last_servicing_date'] = date('Y-m-d',strtotime($this->input->post('last_servicing_date'))); 
        $params['created_datetime'] = date('Y-m-d H:i:s'); 
        $params['status'] = $this->input->post('status'); 
        $params['created_by'] = $this->session->adminsession['id']; 

		$response = $this->bikelib->addBike($params);  
		echo json_encode($response);
	} 

	public function BikeEdit($id) { 
 

		$this->load->library('zyk/BikeLib', 'bikelib');
	 	$bike = $this->bikelib->getBikeByID($id);
 
		$this->load->library('zyk/ClientLib', 'clientlib');
		$client = $this->clientlib->getClients(); 

		$this->load->library('zyk/OutletLib', 'outletlib');
	 	$outlet = $this->outletlib->getAllActive();

		$this->template->set('outlet', $outlet); 
	 	$this->template->set('clients',$client); 
	 	$this->template->set('bike', $bike); 
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Edit Bike' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('bike/BikeEdit');
	}
	
	public function update_bike() {
		$this->load->library('zyk/BikeLib', 'bikelib');
		$params = array(); 

		$params['id']   	   = $this->input->post('id'); 
		$params['client_id']   = $this->input->post('client_id');  
        $params['outlet_id']   = $this->input->post('outlet_id'); 
		$params['bike_name']   = ucfirst($this->input->post('bike_name')); 
		$params['bike_number'] = $this->input->post('bike_number');  
		$params['rider_name']  = $this->input->post('rider_name');
		$params['rider_mobile'] = $this->input->post('rider_mobile'); 
		$params['km_run']  = $this->input->post('km_run'); 
                $params['model_id'] = $this->input->post('model_id'); 
		$params['last_servicing_date'] = date('Y-m-d',strtotime($this->input->post('last_servicing_date'))); 
		$params['updated_datetime'] = date('Y-m-d H:i:s');
		$params['status'] = $this->input->post('status'); 
        $params['created_by'] = $this->session->adminsession['id']; 
  
		$response = $this->bikelib->updateBike($params);
		echo json_encode($response);
	} 

	public function getBikesByName() {
		$name = $this->input->get('name');
		$this->load->library('zyk/BikeLib', 'bikelib');
		$bike = $this->bikelib->getBikesByName($name);
		echo json_encode($bike);
	}
	
	public function bike_detail($id) {
		$this->load->library('zyk/BikeLib', 'bikelib');
		$bike = $this->bikelib->getBikesDetails($id);
		echo json_encode($bike[0]);
	}

	public function upload_excel(){
		$excelData 		= [];
		$insertionArray = [];
		$rejectionArray = [];

		$this->load->library('zyk/ClientLib', 'clientlib');
		$this->load->library('zyk/OutletLib', 'outletlib');

		if(isset($_FILES['userfiles']['name'])){
			$filepath = $_FILES['userfiles']['tmp_name'];
			//PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
			$object = PHPExcel_IOFactory::load($filepath);
			
			foreach ($object->getWorksheetIterator() as $worksheet) {
				
				$highestRow = $worksheet->getHighestRow();
				$highestCol = $worksheet->getHighestColumn();
				for ($row=2; $row <= $highestRow ; $row++) { 
					$company_name 		 = $worksheet->getCellByColumnAndRow(0,$row)->getValue();
					$outlet_name  		 = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
					$bike_name	  		 = $worksheet->getCellByColumnAndRow(2,$row)->getValue();
					$bike_number  		 = $worksheet->getCellByColumnAndRow(3,$row)->getValue();
					$rider_name   		 = $worksheet->getCellByColumnAndRow(4,$row)->getValue();
					$rider_mobile 		 = $worksheet->getCellByColumnAndRow(5,$row)->getValue();
					$kms		  		 = $worksheet->getCellByColumnAndRow(6,$row)->getValue();
					$last_servicing_date = $worksheet->getCellByColumnAndRow(7,$row)->getValue();
					
					$excelData[] = array(
						'company_name' 		  => $company_name,
						'outlet_name'		  => $outlet_name,
						'bike_name'			  => $bike_name,
						'bike_number'         => $bike_number,
						'rider_name'		  => $rider_name,
						'rider_mobile'		  => $rider_mobile,
						'kms'				  => $kms,
						'last_servicing_date' => $last_servicing_date
					);
				}
			}
			
			$clients = $this->clientlib->getClients(); 
			//searching for client
			foreach ($excelData as $key => $excel) {
				foreach ($clients as $client) {
					$clientCompany = strtolower(str_replace(" ", "-", trim($client['reg_company_name']," ")));
					$excelCompany  = strtolower(str_replace(" ", "-", trim($excel['company_name']," ")));
					if( $excelCompany == $clientCompany ){
						$excelData[$key]['client_id'] = $client['id'];
					}
				}
			}
			
			//searching for outlet
			$outlets = $this->outletlib->getAllActive();
			foreach ($excelData as $key => $excel) {
				foreach ($outlets as $outlet) {
					$clientOutlet = strtolower(str_replace(" ", "-", trim($outlet['outlet_name']," ")));
					$excelOutlet  = strtolower(str_replace(" ", "-", trim($excel['outlet_name']," ")));
					if($clientOutlet == $excelOutlet  && isset($excel['client_id']) && $excel['client_id'] == $outlet['client_id']){
						$excelData[$key]['outlet_id'] = $outlet['id'];
					}
				}
			}
			/*get bikes from table and append model id*/
			$bikes = $this->db->get_where(TABLES::$BIKE,array('status'=>1))->result_array();
			foreach ($excelData as $key => $excel) {
				foreach ($bikes as $bike) {
					$bikeBike  = strtolower(str_replace(" ", "-", trim($bike['bike_name']," ")));
					$excelBike = strtolower(str_replace(" ", "-", trim($excel['bike_name']," ")));
					if($bikeBike == $excelBike ){
						$excelData[$key]['model_id'] = $bike['model_id'];
					}
				}
			}

            foreach ($excelData as $key => $excel) {
            	if(isset($excel['client_id']) && isset($excel['outlet_id']) && isset($excel['model_id'])){
            		$insertionArray[] = array(
            							'client_id' =>$excel['client_id'],
            							'outlet_id' =>$excel['outlet_id'],
            							'bike_name' =>$excel['bike_name'],
            							'bike_number' =>$excel['bike_number'],
            							'rider_name' =>$excel['rider_name'],
            							'rider_mobile' =>$excel['rider_mobile'],
            							'model_id'=>$excel['model_id'],
            							'km_run'=>$excel['kms'],
            							'last_servicing_date'=>date('Y-m-d',strtotime($excel['last_servicing_date'])), 
            							'created_datetime'=>date('Y-m-d H:i:s'),
            							'status' => 1,
            							'created_by' => $this->session->adminsession['id']
            						);
            	}else{
            		$rejectionArray[] = $excel;
            	}
            }
            $this->db->insert_batch(TABLES::$BIKE, $insertionArray); 
            $this->session->set_userdata('rejection',$rejectionArray);
            echo json_encode(array(
            	'status'=>1,
            	"msg"=>"Uploaded Successfully..!!",
            	"redirection" => empty($rejectionArray)  ? 0:1
            ));
		}else{
			echo json_encode(array('status'=>0,'msg'=>'error occured while uploading file.'));
		}
	}

	public function create_excel(){
		$rejected = $this->session->rejection;
		$this->session->rejection='';
		$objPHPExcel = new PHPExcel();
		// Set properties
		if(empty($rejected)){
			exit;
		}
		$objPHPExcel->getProperties()->setCreator("Bike Doctor")
									 ->setLastModifiedBy("Bike Doctor")
									 ->setTitle("Office 2007 XLSX Unsaved Data")
									 ->setSubject("Office 2007 XLSX Unsaved Data")
									 ->setDescription("rejected data while uploading excel")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Unsaved");

		// Add some data  cm
		$sheet = $objPHPExcel->getActiveSheet();        
        $sheet->getColumnDimension('A')->setWidth(15);
		$sheet->getColumnDimension('B')->setWidth(15);
		$sheet->getColumnDimension('C')->setWidth(15);
		$sheet->getColumnDimension('D')->setWidth(15);		
		$sheet->getColumnDimension('E')->setWidth(15);		
		$sheet->getColumnDimension('F')->setWidth(15);		
		$sheet->getColumnDimension('G')->setWidth(15);		
		$sheet->getColumnDimension('H')->setWidth(15);		
    	

		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'COMPANY NAME')
            ->setCellValue('B1', 'OUTLET NAME')
            ->setCellValue('C1', 'BIKE NAME')
            ->setCellValue('D1', 'BIKE NUMBER')
            ->setCellValue('E1', 'RIDER NAME')
            ->setCellValue('F1', 'RIDER MOBILE')
            ->setCellValue('G1', 'KM RUNS')
            ->setCellValue('H1', 'LAST SERVICING DATE(Year/month/date)');

        $styleArray = array('font'  => array('bold'  => true,'color' => array('rgb' => 'FFFFFF'),'size'  => 10,'name'  => 'Liberation Sans'),'fill'=>array('type'=>PHPExcel_Style_Fill::FILL_SOLID,'color'=>array('rgb' => '808080')));

		$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($styleArray);		
        $i=2;
        foreach ($rejected as $key => $value) {

        	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $value['company_name'])
            ->setCellValue('B'.$i, $value['outlet_name'])
            ->setCellValue('C'.$i, $value['bike_name'])
            ->setCellValue('D'.$i, $value['bike_number'])
            ->setCellValue('E'.$i, $value['rider_name'])
            ->setCellValue('F'.$i, $value['rider_mobile'])
            ->setCellValue('G'.$i, $value['kms'])
            ->setCellValue('H'.$i, $value['last_servicing_date']);
         	$i++;
        }
        
        // Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Unsaved data');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="UnsaveData('.date('Y-m-d').').xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		//return redirect(base_url().'client/bike/list');
	}
}