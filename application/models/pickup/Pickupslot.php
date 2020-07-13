<?php
	class Pickupslot extends CI_Model{

		function __construct() {
			parent::__construct ();
		}


		public function get_pickup_slots() {
			$query = $this->db->get ('pickup_slots');
			$result = $query->result_array ();
			return $result;
		}

		public function get_breakdown_slots() {
			$query = $this->db->get ('breakdownslot');
			$result = $query->result_array ();
			return $result;
		}
	}
?>