<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('asset_url()'))
{
	function asset_url()
    {
      	return base_url().'assets/';
    }
}

/**
 * 
 * @param File $file
 * @param string $upload_dir
 * @param string $file_types
 * @param int $max_file_size
 * @return multitype:number unknown |multitype:number string unknown
 */
function wallet_config()
    {   
    	$CI = & get_instance ();
    	$CI->db->select('*');
		$CI->db->from('redeem_offer_config');
	
		$query = $CI->db->get();
		$result = $query->row_array();
		return $result;
    } 
function uploadImage($file,$upload_dir,$file_types,$max_file_size,$file_name=""){
	$status = array();
	$status['status'] = 0;
	$original_file_name = clean(basename($file["name"]));
	$files = explode(".",$original_file_name);
	$file_extention = end($files);
	if($file_name == "") {
		$file_name = $files[0];
	}
	
	$target_file = $upload_dir . microtime(true) . $file_name.".".$file_extention;
	$msg = validateFile($target_file,$file,$max_file_size,$file_types);
	if ($msg != "success") {
		$status['status'] = 0;
		$status['msg'] = $msg;
		return $status;
	} else {
		if (move_uploaded_file($file["tmp_name"], $target_file)) {
			$paths = explode("/",$target_file);
			array_shift($paths);
			$status['status'] = 1;
			$status['msg'] = "The file ". basename( $file["name"]). " has been uploaded.";
			$status['image'] = implode("/",$paths);
			return $status;
		} else {
			$status['status'] = 0;
			$status['msg'] = "Sorry, there was an error uploading your file.";
			return $status;
		}
	}
}

function validateFile($target_file,$file,$max_file_size,$file_types){
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if ($file["size"] > $max_file_size) {
		return "File size is too large.";
	}
	$imageFileType = strtolower($imageFileType);
	if(!in_array($imageFileType, $file_types)) {
		return "Sorry, only ".implode(",",$file_types)." files are allowed.";
	}
	return "success";
}

function clean($string) {
	$string = preg_replace('/\s+/', '-',$string);
	return preg_replace('/[^A-Za-z0-9\-.]/', '-', $string);
}

/**
 * Get user IP
 * @return string
 */
function getRealIP() {
   	$headers = array ('HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'HTTP_VIA', 'HTTP_X_COMING_FROM', 'HTTP_COMING_FROM', 'HTTP_CLIENT_IP' );
   	foreach ( $headers as $header ) {
   		if (isset ( $_SERVER [$header]  )) {
   			if (($pos = strpos ( $_SERVER [$header], ',' )) != false) {
   				$ip = substr ( $_SERVER [$header], 0, $pos );
   			} else {
   				$ip = $_SERVER [$header];
   			}
   			$ipnum = ip2long ( $ip );
   			if ($ipnum !== - 1 && $ipnum !== false && (long2ip ( $ipnum ) === $ip)) {
   				if (($ipnum - 184549375) && ($ipnum  - 1407188993) && ($ipnum  - 1062666241))
   					if (($pos = strpos ( $_SERVER [$header], ',' )) != false) {
   						$ip = substr ( $_SERVER [$header], 0, $pos );
   					} else {
   						$ip = $_SERVER [$header];
   					}
   					return $ip;
   				}
   			}
   
   	}
   	return $_SERVER ['REMOTE_ADDR'];
}


function downloadExcel($data, $fileName){
	header("Content-Disposition: attachment; filename=\"$fileName\"");
	header("Content-Type: application/vnd.ms-excel");

	$flag = false;
	foreach($data as $row) {
		if(!$flag) {
			// display column names as first row
			echo implode("\t", array_keys($row)) . "\n";
			$flag = true;
		}
		array_walk($row, 'filterData');
		echo implode("\t", array_values($row)) . "\n";

	}
}

function filterData(&$str)
{

	$str = trim(preg_replace('/\s\s+/', ' ', $str));
	$str = preg_replace("/\r?\n/", "\\n", $str);
	if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}


function getLatLong($string) {

 
	$latlng = array();
	$details_url="https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($string)."&key=AIzaSyBtGPmn8ziQzPa8kbmciGjEwfIBdyvf4Zs";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $details_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = json_decode(curl_exec($ch), true);
 	if ($response['status'] != 'OK') {
		$latlng['lat'] = "";
		$latlng['lng'] = "";
	}else{
		$geometry = $response['results'][0]['geometry'];
		$latlng['lat'] = $geometry['location']['lat'];
		$latlng['lng'] = $geometry['location']['lng'];
	}
	return $latlng;
}

function getGoogleDistance($fTdata) {
	$url = "https://maps.googleapis.com/maps/api/distancematrix/json?mode=driving&key=AIzaSyBtGPmn8ziQzPa8kbmciGjEwfIBdyvf4Zs";
	$params = array();
	$params['origins'] = $fTdata['from_lat'].", ".$fTdata['from_lng'];
	$params['destinations'] = $fTdata['to_lat'].", ".$fTdata['to_lng'];
	$url = $url."&".http_build_query($params);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$output = curl_exec($ch);
	$result = json_decode($output,true);
	$distance = $result['rows'][0]['elements'][0]['distance']['value'];
	return $distance;
}

function arrayToXls($input) {
	// BoF
	$ret = pack('ssssss', 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);

	// array_values is used to ensure that the array is numerically indexed
	foreach (array_values($input) as $lineNumber => $row) {
		foreach (array_values($row) as $colNumber => $data) {
			if (is_numeric($data)) {
				// number, store as such
				$ret .= pack('sssssd', 0x203, 14, $lineNumber, $colNumber, 0x0, $data);
			} else {
				// everything else store as string
				$len = strlen($data);
				$ret .= pack('ssssss', 0x204, 8 + $len, $lineNumber, $colNumber, 0x0, $len) . $data;
			}
		}
	}

	//EoF
	$ret .= pack('ss', 0x0A, 0x00);

	return $ret;
}

function getDeliveryTime($map) {
	$deltime = ($map['deltime'])*60;
	$current_time = date('H:i');
	$deltime_arr = array();
	$j = 0;
	if($deltime > 10800){
		$deltime = 2700;
		$map['del_time'] = date('H:i',strtotime('+45 minutes',strtotime($map['del_time'])));
	}
	if(strtotime($map['mclose_time']) != strtotime($map['estart_time'])){
		for($i=(strtotime($map['mstart_time'])+$deltime); $i < (strtotime($map['mclose_time'])+$deltime); $i = $i + 600){
			$deltime_arr[$j] = date('H:i',$i);
			$j++;
		}
		for($i=(strtotime($map['estart_time'])+$deltime); $i <= (strtotime($map['eclose_time'])+$deltime);$i = $i + 600){
			$deltime_arr[$j] = date('H:i',$i);
			$j++;
		}
	}else{
		for($i=(strtotime($map['mstart_time'])+$deltime); $i <= (strtotime($map['eclose_time'])+$deltime); $i = $i + 600){
			$deltime_arr[$j] = date('H:i',$i);
			$j++;
		}
	}
	if(strtotime($map['del_time']) > strtotime($map['eclose_time'])){
		if($map['deltime'] >= 1440){
			$map['del_time'] = $map['eclose_time'];
		}elseif($map['deltime'] >= 120 && $map['deltime'] < 240){
			$map['del_time'] = date('H:i',strtotime('+'.$map['del_time'].' minutes',strtotime($map['motime'])));
		}elseif($map['deltime'] >= 240 && $map['deltime'] <= 360){
			$map['del_time'] = date('H:i',strtotime('+60 minutes',strtotime($map['eotime'])));
		}
	}
	$time = strtotime($map['del_time']);
	$rounded_time = $time % 300 >= 100 ? $time += (300 - $time % 300):  $time += (300 - $time % 300);
	$deltime_arr = array_unique($deltime_arr);
	//error_log(json_encode($deltime_arr),0);
	$select = "";
	$current_del_time = "";
	$rdel_timings = array();
	foreach($deltime_arr as $key=>$value){
		if(strtotime($value) >= $rounded_time){
			if($current_del_time == ""){
				$current_del_time = $value;
			}
			$select .= '<option value="'.$value.'">' .date('h:i A',strtotime($value)). '</option>';
			$rdel_timings[] = $value;
		}
	}
	if ($select == "") {
		$next_d_time = date('H:i',strtotime('+55 minutes'));
		$select = '<option value="'.$next_d_time.'">' .date('h:i A',strtotime($next_d_time)). '</option>';
	} 
		
	$map = array();
	$map['select_dropdn'] = $select;
	$map['current_del_time'] = $current_del_time;
	$map['timings'] = $rdel_timings;
	return $map;
}

function getAdvanceDeliveryTime($map) {
	$deltime = ($map['deltime'])*60;
	if($deltime > 7200){
		$deltime = 2700;
	}
	$deltime_arr = array();
	$j = 0;
	
	for($i=(strtotime($map['mstart_time'])+$deltime); $i < (strtotime($map['mclose_time'])+600); $i = $i + 900){
		$deltime_arr[$j] = date('H:i',$i);
		$j++;
	}
	
	for($i=(strtotime($map['estart_time'])+$deltime); $i < (strtotime($map['eclose_time'])+600);$i = $i + 900){
		$deltime_arr[$j] = date('H:i',$i);
		$j++;
	}
	$deltime_arr = array_unique($deltime_arr);
	$select = "";
	$rdel_timings = array();
	foreach($deltime_arr as $key=>$value){
		$select .= '<option value="'.$value.'">' .date('h:i A',strtotime($value)). '</option>';
		$rdel_timings[] = $value;
	}
	$map = array();
	$map['select_dropdn'] = $select;
	$map['current_del_time'] = '';
	$map['timings'] = $rdel_timings;
	return $map;
}

function random36($length = 6)
{
	$str = '';
	$len = 1;
	while($len <= $length)
	{
		$str .= substr(base_convert(mt_rand(60466176, 2147483647), 10, 36), 0, $length);
		$len = strlen($str);
	}
	return substr($str,0,$length);
}

function getGeoDistance( $lat1, $lng1, $lat2, $lng2)
{
	$earthRadius = 3958.75;
    $dLat = deg2rad($lat2-$lat1);
    $dLng = deg2rad($lng2-$lng1);
    $a = sin($dLat/2) * sin($dLat/2) +
       cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
       sin($dLng/2) * sin($dLng/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $dist = $earthRadius * $c;
    $meterConversion = 1609;
    $geopointDistance = $dist * $meterConversion;
   	return $geopointDistance;
}

function sendFCMPushNotificationSingle($registatoin_ids,$message,$title)
{


	$curr_date=date('d-M-Y H:i:s');
	$url = 'https://fcm.googleapis.com/fcm/send';
	$fields = array
	(
			'to'		=> $registatoin_ids,
			'notification'	=> $message
	);
	
	$headers = array(
			'Authorization: key=' . GOOGLE_API_KEY,
			// 'Authorization: key=AAAADMiupMA:APA91bEkj5VIg-_wEZBC55HkrGC-n8u4C9rCUjb72Iz7NSuJCz3x5ju6chOTly8P0RuLYYjAGG5_FR-TOUd81BXH4lw89Euxba87LWyFkBlkunDJMgaZR9tpqnvXDrbcfxIglTWhnEaU',
			'Content-Type: application/json'
	);
	//print_r($fields);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	$result = curl_exec($ch);
	//echo "test".curl_error($ch);
	// echo "success".$result;
	// die('Curl failed: ' . curl_error($ch));
	if ($result == FALSE) {
		die('Curl failed: ' . curl_error($ch));
		echo "hi".$result;
	}

}

function sendFCMPushNotificationMechanic($registatoin_ids,$message,$title)
{
	$curr_date=date('d-M-Y H:i:s');
	$url = 'https://fcm.googleapis.com/fcm/send';
	$fields = array
	(
			'to'		=> $registatoin_ids,
			'notification'	=> $message
	);
	
	//define("GOOGLE_API_KEY", "AIzaSyA_ZsbJouvyFpH-166uVpVuG3YCsOeMVHE"); 
	$headers = array(
			'Authorization: key=' . GOOGLE_API_KEY,
			// 'Authorization: key=AIzaSyA_ZsbJouvyFpH-166uVpVuG3YCsOeMVHE',
			'Content-Type: application/json'
	);
	//print_r($fields);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	$result = curl_exec($ch);
	//echo "test".curl_error($ch);
	//echo "hi".$result;
	if ($result == FALSE) {
		die('Curl failed: ' . curl_error($ch));
		echo "hi".$result;
	}

}

function sendMultipleFCMPushNotificationMechanic($registatoin_ids,$message,$title){
	$curr_date=date('d-M-Y H:i:s');
	$url = 'https://fcm.googleapis.com/fcm/send';
	$regids = array();
	/*if(count($registatoin_ids) <= 100) {
		$regids[] = $registatoin_ids;
		} else {
		$i=0;
		$newrgids = array();
		foreach ($registatoin_ids as $regid) {
		$newrgids[] = $regid;
		$i++;
		if($i%1000 == 0) {
		$regids[] = $newrgids;
		$newrgids = array();
		$i = 0;
		}
		}
		$regids[] = $newrgids;
	}*/
	//Google Cloud Messaging GCM API Key
	//define("GOOGLE_API_KEY", "AIzaSyA_ZsbJouvyFpH-166uVpVuG3YCsOeMVHE"); 	// GCM server key
	 
	$headers = array(
			'Authorization: key=' . GOOGLE_API_KEY,
			// 'Authorization: key=AIzaSyA_ZsbJouvyFpH-166uVpVuG3YCsOeMVHE',
			'Content-Type: application/json'
	);
	foreach ($registatoin_ids as $newgcmids) {
		//error_log('Counts: '.count($newgcmids),0);
		//error_log('gcmids: '.$newgcmids);
		/* $fields = array(
		 'registration_ids' => $newgcmids,
		 'data' => $message,
		); */
		$fields = array(
				'to'		=> $newgcmids,
				'notification'	=> $message
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		//echo curl_error($ch);
		//echo $result;
		//error_log('error: '.$result);
		/* if ($result == FALSE) {
			die('Curl failed: ' . curl_error($ch));
				
			echo "hi".$result;
		} */
	}
        
//    function () {
//        
//    }     


}
function sendMultipleFCMPushNotificationUser($registatoin_ids,$message,$title){
	$curr_date=date('d-M-Y H:i:s');
	$url = 'https://fcm.googleapis.com/fcm/send';
	$regids = array();

	$headers = array(
			'Authorization: key=' . GOOGLE_API_KEY,
			//'Authorization: key=AIzaSyACSWiShG-2bOfsQbeBDWiDyNLs3ayqdGU',
			'Content-Type: application/json'
	);
	foreach ($registatoin_ids as $newgcmids) {
		//error_log('Counts: '.count($newgcmids),0);
		//error_log('gcmids: '.$newgcmids);
		/* $fields = array(
		 'registration_ids' => $newgcmids,
		 'data' => $message,
		); */
		$fields = array(
				'to'		=> $newgcmids,
				'notification'	=> $message
		);
		 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		//echo curl_error($ch);
		//echo $result;
		//error_log('error: '.$result);
		/* if ($result == FALSE) {
			die('Curl failed: ' . curl_error($ch));
				
			echo "hi".$result;
		} */
	} 
}
function getIndianCurrency($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '');
}


function check_mobile_no_exist($login_userid){
	if (!empty($login_userid)) {
		$CI = & get_instance();
		// $CI->db->where('mobile !=','');
		$CI->db->where('id',$login_userid);
		$q = $CI->db->get('tbl_users');
		$result = $q->row_array();
		if (!empty($result['mobile'])) {
		// print_r($result); die();
			return 1;
		} else {
			return 0;
		}
	}
}

function generate_coupan($length_of_string) 
{ 
  
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
    return substr(str_shuffle($str_result),  
                       0, $length_of_string); 
}
