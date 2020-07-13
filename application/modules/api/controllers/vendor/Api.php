<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Auth API
 * @author Pradeep Singh
 * @package Auth
 *
 */
class Api extends REST_Controller {
	
	/**
	 * Fuction For user Login
	 * @return json
	 */
	public function getOrderList_post() {
		//exit;
 		$data = array ();
		$data['vendor_id']= $this->post ( 'vendor_id' );
		$data['service_day']= $this->post ( 'service_day' );
  		if (empty($data ['vendor_id']))
		{
			$response["success"] = "false";
			$response["msg"] = "Order list not found";
		}
		else
		{
		   $this->load->library ( 'api/OrderLib', NULL, 'orderlib');
		   $this->load->library ( 'api/ServiceLib' );
		   $orderList = $this->orderlib->getOrderListByVendor ( $data );
		    
 
			if(!empty($orderList)) { 
  				foreach ($orderList as $key => $order) {
  					if($order['status'] > 3 && $order['is_accepted'] == 0) {
  						unset($orderList[$key]);
  						continue;
  					}
  					
  					$name = $this->db->get_where('packages',array('id'=>$order['package_id']))->row('package_name');
  					$orderList[$key]['package_name'] =  $name;
					$catSubCatNames  = array();
					$catsubcatList = $this->db->get_where('tbl_booking_services',array('orderid'=>$order['orderid']))->result_array();
					foreach ($catsubcatList as $key2 => $catsub) {  
							$currentArray['name'] =  $catsub['service_name'];
							$currentArray['is_package_service'] =  $catsub['is_package_service'];
							$catSubCatNames[] = $currentArray; 
 					}
 					$orderList[$key]['catsubcatList'] =  $catSubCatNames; 
 				}
 				$response["status"] = "true";
				$response["message"] = "Order list get successfully";
				$orderList = array_values($orderList);
				$response["data"] = $orderList;
			} else {
				$response["status"] = "false";
				$response["message"] = "order list not found";
 			}			
  			/*if(!empty($orderList)) { 
  				foreach ($orderList as $key => $order) {
					$catSubCatNames  = array();
					$catsubcatList = $this->servicelib->getCatsubcatid($order['subcategory_id']);  
					$package = $this->servicelib->getPackage('241'); 					
					foreach ($catsubcatList as $key2 => $catsub) {  
						$catsubcatArray = explode(',', $order['catsubcat_id']);
						if(in_array($catsub['id'], $catsubcatArray)){
							$currentArray['name'] =  $catsub['name'];
							$catSubCatNames[] = $currentArray;
						} 
 					}
 					$orderList[$key]['catsubcatList'] =  $catSubCatNames;
					$orderList[$key]['package_data'] =  $package;
 				}
 				$response["status"] = "true";
				$response["message"] = "Order list get successfully";
				$response["data"] = $orderList;
			} else {
				$response["status"] = "false";
				$response["message"] = "order list not found";
 			}*/
		}
		echo json_encode($response);
	}
	
	public function assignOrderToMechanic_post() {
	   $data = array ();
	   $data['vendor_id']= $this->post ( 'vendor_id' );
	   $data['orderid']= $this->post ( 'order_id' );
	   $data['mec_id']= $this->post ( 'mec_id' );

		if (empty($data ['vendor_id']) && empty( $data['order_id']) && empty($data['mec_id'])){
		   $response["success"] = "false";
		   $response["msg"] = "Invalid data";
	   }
	   else
	   {
		  $this->load->library ( 'api/OrderLib' );
		   $result = $this->orderlib->assignOrderToMechanic ( $data );
 		   if($result==1) { 
			   $response["status"] = "true";
			   $response["message"] = "Order assigned to mechanic.";
 		   }else{
			   $response["status"] = "false";
			   $response["message"] = "Invalid data";
			}
	   }
	  echo json_encode($response);
   } 
		
}	