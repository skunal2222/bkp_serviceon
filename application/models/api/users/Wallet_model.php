<?php
class Wallet_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function createWallet($data) {
		$this->db->insert ( TABLES::$WALLET, $data );
	}
	
	public function createTransaction($data) {
		$this->db->insert ( TABLES::$WALLET_TRANSACTION, $data );
	}
	
	public function addToWallet($data) {
    	$sql = "UPDATE ".TABLES::$WALLET." SET amount=amount+".$data['amount'].", updated_date='".date('Y-m-d H:i:s')."' WHERE userid=".$data['userid'];
    	$query = $this->db->query($sql);
    	//$query->result_array ();
    	$trans = array();
    	$trans['userid'] = $data['userid'];
    	$trans['amount'] = $data['amount'];
    	$trans['is_debit'] = 0;
    	$trans['updated_by'] = 0;
    	$trans['updated_date'] = date('Y-m-d H:i:s');
    	if(!empty($data['orderid']))
    	$trans['orderid'] = $data['orderid'];
    	$this->db->insert ( TABLES::$WALLET_TRANSACTION, $trans );
	}
	
	public function removeFromWallet($data) {
		$sql = "UPDATE ".TABLES::$WALLET." SET amount=amount-".$data['amount'].", updated_date='".date('Y-m-d H:i:s')."' WHERE userid=".$data['userid'];
		$query = $this->db->query($sql);
		//$query->result_array ();
		$trans = array();
		$trans['userid'] = $data['userid'];
		$trans['amount'] = $data['amount'];
		$trans['is_debit'] = 0;
		$trans['updated_by'] = 1;
		$trans['updated_date'] = date('Y-m-d H:i:s');
		if(!empty($data['orderid']))
			$trans['orderid'] = $data['orderid'];
		$this->db->insert ( TABLES::$WALLET_TRANSACTION, $trans );
	}
	
	public function getWalletBalance($userid) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$WALLET );
		$this->db->where ( 'userid', $userid );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getWalletTransactions($userid) {
		$this->db->select ( 'a.id,a.userid,a.amount,a.updated_by as is_debit,a.orderid,b.ordercode' );
		$this->db->from ( TABLES::$WALLET_TRANSACTION.' AS a' );
		$this->db->join ( TABLES::$ORDER.' AS b','a.orderid=b.orderid','left' );
		$this->db->where ( 'a.userid', $userid );
		$this->db->order_by('a.updated_date','DESC');
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	
}