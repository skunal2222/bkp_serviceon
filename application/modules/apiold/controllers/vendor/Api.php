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
		   $this->load->library ( 'zyk/OrderLib' );
		   $this->load->library ( 'zyk/ServiceLib' );
			$orderList = $this->orderlib->getOrderListByVendor ( $data );
  			if(!empty($orderList)) { 
			
  				foreach ($orderList as $key => $order) {
					$catSubCatNames  = array();
					$catsubcatList = $this->servicelib->getCatsubcatid($order['subcategory_id']);  

					foreach ($catsubcatList as $key2 => $catsub) {  
						$catsubcatArray = explode(',', $order['catsubcat_id']);
						if(in_array($catsub['id'], $catsubcatArray)){
							$currentArray['name'] =  $catsub['name'];
							$catSubCatNames[] = $currentArray;
						} 
 					}
 					$orderList[$key]['catsubcatList'] =  $catSubCatNames;
 				}
 				$response["status"] = "true";
				$response["message"] = "Order list get successfully";
				$response["data"] = $orderList;
			} else {
				$response["status"] = "false";
				$response["message"] = "order list not found";
 			}
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
		  $this->load->library ( 'zyk/OrderLib' );
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