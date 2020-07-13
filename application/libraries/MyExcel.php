<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once APPPATH."/third_party/PHPExcel.php";

class MyExcel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}
# See more at: http://arjunphp.com/how-to-use-phpexcel-with-codeigniter/#sthash.Td4TPc9v.dpuf