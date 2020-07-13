<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * MY_Validation Class
 *
 * Extends Validation library
 *
 * Adds one validation rule, "unique" and accepts a
 * parameter, the name of the table and column that
 * you are checking, specified in the forum table.column
 */
class MY_Form_validation extends CI_Form_validation {
	protected $CI;
	function __construct() {
		$this->CI = & get_instance ();
		parent::__construct ();
	}
	function valid_date($str) {
		$this->CI->form_validation->set_message ( 'valid_date', 'Invalid %s. Use date format(YYYY-MM-DD).' );
		return (! preg_match ( '#^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3(0|1))]?$#', $str )) ? FALSE : TRUE;
	}
	function valid_time($str) {
		$this->CI->form_validation->set_message ( 'valid_time', 'Invalid %s. Use 24 hour time format(HH:MM:SS).' );
		return (! preg_match ( '#^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#', $str )) ? FALSE : TRUE;
	}
}