<?php
class MY_Input extends CI_Input {

	function __construct()
	{
		parent::__construct();
	}
	//Overide ip_address() with your own function
	function ip_address()
	{
		//Obtain the IP address however you'd like, you may want to do additional validation, etc..
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	        return ( preg_match( "/^([d]{1,3}).([d]{1,3}).([d]{1,3}).([d]{1,3})$/", $_SERVER['HTTP_X_FORWARDED_FOR'] ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'] );
	    } else {
	        return $_SERVER['REMOTE_ADDR']; //something else
	    }
	}
}