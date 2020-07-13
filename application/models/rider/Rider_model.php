<?php

Class Rider_model extends CI_Model {
     

    public function getCashCollectionOrderList()
    {
        $this->db->select('ord.*,rd.rider_id,rd.rider_name,rd.mobile as rider_mobile');
        $this->db->from(TABLES::$ORDER .' AS ord');
        $this->db->join(TABLES::$RIDER.' AS rd','rd.rider_id=ord.cod_payment_collect_rider_id','left');
        $this->db->where('ord.handling_charges_collect_by_rider',1);
        $this->db->or_where('ord.garage_charges_collect_by_rider',1);
        $q = $this->db->get();
        $result = $q->result_array();
        return $result;
    }


    public function getOrderListByRiderID($riderid)
    {
        $this->db->select('*')->from(TABLES::$ORDER);
        $this->db->where('assign_rider_id',$riderid);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

   public function getRiderList($map = NULL) {
        $this->db->from(TABLES::$RIDER);
        if (!empty($map['select'])) {
            $this->db->select($map['select']);
        }
        if (!empty($map['id'])) {
            $this->db->where('rider_id',$map['id']);
        }
        if (!empty($map['is_available'])) {
            $this->db->where('is_available',$map['is_available']);
        }
        $q = $this->db->get();
        return $q->result_array();
    }

    public function addRider($map)
    {
        $this->db->insert(TABLES::$RIDER, $map);
        return $this->db->insert_id();
    }

    public function updateRider($map)
    {
        $this->db->set($map);
        $this->db->where('rider_id',$map['rider_id']);
        $this->db->update(TABLES::$RIDER);
        return 1;
    }

    public function updateRiderPayment($map)
    {
        $this->db->set($map);
        $this->db->where('rider_id',$map['rider_id']);
        $this->db->update(TABLES::$RIDER);
        return 1;
    }

    public function addRiderBillingConfig($params) {
        $this->db->insert ( TABLES::$RIDER_BILLING_CONFIG, $params );
    }

    public function addRiderBillingFields($params) {
        $this->db->insert_batch ( TABLES::$RIDER_BILLING_FIELDS, $params );
    }

    public function updateRiderBillingConfig($params) {
        $this->db->select ( '*' )->from ( TABLES::$RIDER_BILLING_CONFIG )->where ( 'restid', $params ['restid'] );
        $query = $this->db->get ();
        $result = $query->result_array ();
        if (count ( $result ) > 0) {
            $this->db->where ( 'restid', $params ['restid'] );
            $flag = $this->db->update ( TABLES::$RIDER_BILLING_CONFIG, $params );
            error_log($this->db->last_query());

            if ($flag) {
                $map ['status'] = 1;
                $map ['msg'] = 'Updated successfully.';
            } else {
                $map ['status'] = 0;
                $map ['msg'] = 'Invalid effective date.';
            }
        }
        else
        {
            $this->db->insert ( TABLES::$RIDER_BILLING_CONFIG, $params );
            $map ['status'] = 1;
            $map ['msg'] = 'Updated successfully.';
            error_log($this->db->last_query());
        }
        return $map;
    }

    public function updateRiderBillingFields($params) {
        $result = $this->getRiderBillingFieldByDate ( $params ['restid'], $params ['billing_field'], $params ['from_date'] );
        if (count ( $result ) > 0) {
            if ($result [0] ['to_date'] == null && $params ['from_date'] > $result [0] ['from_date']) {
                $newdate = date ( 'Y-m-d', strtotime ( '-1 day', strtotime ( $params ['from_date'] ) ) );
                $newparams = array ();
                $newparams ['to_date'] = $newdate;
                $this->db->where ( 'restid', $params ['restid'] );
                $this->db->where ( 'billing_field', $params ['billing_field'] );
                $this->db->update ( TABLES::$RIDER_BILLING_FIELDS, $newparams );
                $this->db->insert ( TABLES::$RIDER_BILLING_FIELDS, $params );
                error_log($this->db->last_query());
                $map ['status'] = 1;
                $map ['msg'] = 'Updated successfully.';
            } else {
                $map ['status'] = 0;
                $map ['msg'] = 'Invalid effective date.';
            }
        } else {
            $this->db->insert ( TABLES::$RIDER_BILLING_FIELDS, $params );
            $map ['status'] = 1;
            $map ['msg'] = 'Updated successfully.';
            error_log($this->db->last_query());
        }
        return $map;
    }

    public function getRiderBillingFieldByDate($restid, $field, $date) {
        $curr_date = $date;
        $this->db->select ( '*' )->from ( TABLES::$RIDER_BILLING_FIELDS );
        $this->db->where ( "restid=" . $restid . " AND billing_field='" . $field . "' AND '" . $curr_date . "' BETWEEN from_date AND to_date", '', FALSE );
        $this->db->or_where ( "restid=" . $restid . " AND billing_field='" . $field . "' AND to_date IS NULL", '', FALSE );
        $query = $this->db->get ();
        $result = $query->result_array ();
        return $result;
    }

    public function getRiderBillingConfig($id) {
        $this->db->select ( '*' )->from ( TABLES::$RIDER_BILLING_CONFIG );
        $this->db->where ( 'restid', $id );
        $query = $this->db->get ();
        $result = $query->result_array ();
        return $result;
    }

    public function getRiderBillingField($restid, $field) {
        $curr_date = date ( 'Y-m-d' );
        $this->db->select ( '*' )->from ( TABLES::$RIDER_BILLING_FIELDS );
        $this->db->where ( "restid=" . $restid . " AND billing_field='" . $field . "' AND '" . $curr_date . "' BETWEEN from_date AND to_date", '', FALSE );
        $this->db->or_where ( "restid=" . $restid . " AND billing_field='" . $field . "' AND to_date IS NULL", '', FALSE );
        $query = $this->db->get ();
        $result = $query->result_array ();
        return $result;
    }
}
?>