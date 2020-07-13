<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MyPdfLib {
		
	public function __construct() {
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$CI =& get_instance();
	}
	
	public function getPdf($html,$pdf_name) {
		$pdf = new DOMPDF();
		$pdf->load_html($html);
		$pdf->render();
		$pdf = $pdf->output();
		$file_location = FCPATH."assets/invoices/customer/".$pdf_name;
		file_put_contents($file_location,$pdf);
		return "assets/invoices/customer/".$pdf_name;
	}

	public function getPdfRider($html,$pdf_name) {
		$pdf = new DOMPDF();
		$pdf->load_html($html);
		$pdf->render();
		$pdf = $pdf->output();
		$file_location = FCPATH."assets/invoices/rider/".$pdf_name;
		file_put_contents($file_location,$pdf);
		return "assets/invoices/rider/".$pdf_name;
	}
}