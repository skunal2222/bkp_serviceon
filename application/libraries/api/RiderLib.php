<?php
class RiderLib {
	
	public function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->model ( 'api/rider_model/Rider_model', 'rider' );
	}

	public function getRiderDataByRiderID($riderid)
	{
		return $this->CI->rider->getRiderDataByRiderID($riderid);
	}


	public function getOrderImgData($orderid)
	{
		return $this->CI->rider->getOrderImgData($orderid);
	}

	public function getDashboardData($rider_id)
	{
		return $this->CI->rider->getDashboardData($rider_id);
	}

	public function getOrderListByRiderID($rider_id) {
		return $this->CI->rider->getOrderListByRiderID($rider_id);
	}

	public function getOrderDetails($orderid) {
		return $this->CI->rider->getOrderDetails($orderid);
	}

	public function updateOrder($orderdata) {
		return $this->CI->rider->updateOrder($orderdata);
	}

	public function getTotalIncomeOfRider($riderid) {
		return $this->CI->rider->getTotalIncomeOfRider($riderid);
	}

	public function getTodayIncomeOfRider($riderid) {
		return $this->CI->rider->getTodayIncomeOfRider($riderid);
	}

	public function getWeeklyIncomeOfRider($riderid) {
		return $this->CI->rider->getWeeklyIncomeOfRider($riderid);
	}

	public function getInvoicesOfRider($riderid) {
		return $this->CI->rider->getInvoicesOfRider($riderid);
	}

	public function otpMatch($reg) {
		$params = array ();
		$params ['mobile'] = $reg['mobile'];
		$params ['otp'] = $reg['otp'];
		$rider = $this->CI->rider->otpMatch ( $params );
		return $rider;
	}

	public function sendOTP ($data)
	{
		$exist = $this->CI->rider->mobileExist ( $data );
		if(count($exist)>0){
			// $data ['otp'] = mt_rand ( 100000, 999999 );
			$data ['otp'] = 123456;
			$data ['rider_id'] = $exist[0]['rider_id'];

			$riders = $this->CI->rider->updateRider($data);

			$data ['rider_name'] = $exist[0]['rider_name'];
			if ($riders) {
				$this->sendOTPSMS ( $data );
				return 1;
			} else {
				return 0;
			}
		}
		return 0;
	}

	public function sendOTPSMS($details) {
		$name = explode(" ",$details['rider_name']);
		$fname = $name[0];
		$sms_msg = 'Hi '.$fname.', Use verification code ' . $details ['otp'] . ' to complete the registration process on ServiceOn.';
		$this->CI->load->library ( 'Pksms' );
		$map = array ();
		$map ['mobile'] = $details ['mobile'];
		$map ['message'] = $sms_msg;
		$this->CI->pksms->sendSms ( $map );
	}
	
	public function getRiderList($map=NULL){
		$riders = $this->CI->rider->getRiderList($map);
		return $riders;
	}

	public function updateRider($map)
	{
		$riders = $this->CI->rider->updateRider($map);
		return $riders;	
	}
}