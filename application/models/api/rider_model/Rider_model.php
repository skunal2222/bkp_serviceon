<?php

Class Rider_model extends CI_Model {

    public function getRiderDataByRiderID($riderid)
    {
        $this->db->select('rider_name,mobile,email,address,pincode,landmark,opration_area,dob,vehicle_no,my_referral_code,profile_photo,profile_photo2,profile_photo3,profile_photo4,profile_photo5,id_name,id_name2,id_name3,id_name4,id_name5,created_at');
        $this->db->where('rider_id',$riderid);
        $q = $this->db->get('tbl_rider');
        return $q->result_array();
    }

    public function getOrderImgData($orderid)
    {
        $this->db->select('id as imageid,file_path as image,file_name as imageName');
        $this->db->where('order_id',$orderid);
        $q = $this->db->get(TABLES::$ORDER_IMAGES_RIDER);
        return $q->result_array();
    }

    public function getDashboardData($rider_id)
    {
        $this->db->select('rider_response,delivery_rider_response,orderid');
        $this->db->where('assign_rider_id',$rider_id);
        $this->db->where('status_updated_date',date('Y-m-d'));
        $q = $this->db->get(TABLES::$ORDER);
        $result['pickup'] = $q->result_array();

        $this->db->select('rider_response,delivery_rider_response,orderid');
        $this->db->where('delivery_assign_rider_id',$rider_id);
        $this->db->where('status_updated_date',date('Y-m-d'));
        $q = $this->db->get(TABLES::$ORDER);
        $result['delivery'] = $q->result_array();

        return $result;
    }


    public function updateOrder( $map ) {
        $this->db->where('orderid',$map['orderid']);
        return $this->db->update(TABLES::$ORDER,$map);  
    }

    public function getOrderDetails($ordercode) {
        $this->db->select('a.*,b.name, b.mobile, b.email,b.outstanding, rd.rider_name, rd.mobile as rider_mobile, deli_rd.rider_name as delivery_rider_name, deli_rd.mobile as delivery_rider_mobile, adrs.*, vh.vehicle_no, vendor.garage_name, vendor.email as vendor_email,vendor.mobile as vendor_mobile, vendor.locality as vendor_locality, vendor.latitude as vendor_latitude, vendor.longitude as vendor_longitude, vendor.address as vendor_address, vendor.landmark as vendor_landmark, vendor.pincode as vendor_pincode, st_sub.name as subcategory_name, e.invoice_url,e.invoice_date,e.id as invoice_id,e.status as invoice_s,f.transactionid,f.status as payment_status,f.payment_date,
                f.longurl,g.name as category,h.name as brand,i.name as model,j.name as subcategory,k.name as service,l.commission_service,l.commission_spare,j.sub_id', FALSE)
                 ->from(TABLES::$ORDER.' AS a')
                 ->join(TABLES::$USER.' AS b','a.userid = b.id','inner')
                 ->join(TABLES::$RIDER.' AS rd','rd.rider_id = a.assign_rider_id','left')
                 ->join(TABLES::$RIDER.' AS deli_rd','deli_rd.rider_id = a.delivery_assign_rider_id','left')
                 ->join(TABLES::$USER_ADDRESS.' AS adrs','adrs.id = a.address_id','left')
                 ->join(TABLES::$USER_VEHICLES.' AS vh','vh.id = a.vehicle_id','left')
                 ->join(TABLES::$RESTAURANT.' AS vendor','vendor.id = a.assign_vendor_id','left')
                 ->join(TABLES::$INVOICE.' AS e','a.orderid = e.orderid','left')
                 ->join(TABLES::$PAYMENT_DETAIL.' AS f','a.orderid = f.orderid','left')
                 ->join(TABLES::$MENU_MAIN_CATEGORY.' AS g','a.category_id = g.id','left')
                 ->join(TABLES::$STATIC_SUBCATEGORY.' AS st_sub','st_sub.id = a.subcategory_id','left')
                 ->join(TABLES::$BRAND.' AS h','a.brand_id = h.id','left')
                 ->join(TABLES::$MANUFACTURE.' AS i','a.vehicle_model = i.id','left')
                 ->join(TABLES::$MENU_MAIN_SUBCATEGORY.' AS j','a.subcategory_id = j.id','left')
                 ->join(TABLES::$SERVICE.' AS k','a.service_id = k.id','left')
                 ->join(TABLES::$RESTAURANT_BILLING_CONFIG.' AS l','a.vendor_id = l.restid','left');
        
        //$this->db->where('a.orderid', $ordercode);
        if(is_numeric($ordercode))
        {
            $this->db->where('a.orderid', $ordercode);
        }
        else
        {
            $this->db->where('a.ordercode', $ordercode);
        }
        // $this->db->order_by('a.orderid DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getOrderListByRiderID($riderid)
    {
        // $where = "status <> 7";
        $this->db->select('ord.orderid,ord.ordercode,ord.userid,ord.vehicle_id,ord.vendor_id,ord.assign_rider_id,ord.rider_response,ord.delivery_assign_rider_id,ord.delivery_rider_response,ord.status_updated_date,ord.ride_type,ord.pickup_date,ord.slot,ord.address_id,ord.name,ord.email,ord.mobile,adrs.latitude,adrs.longitude,adrs.address,adrs.locality,adrs.landmark,ct.name as cityname,st.name as statename,adrs.pincode,ord.ordered_on,ord.updated_datetime,ord.status');
        $this->db->from(TABLES::$ORDER. ' AS ord');
        $this->db->join(TABLES::$USER_ADDRESS. ' AS adrs','adrs.id = ord.address_id','left');
        $this->db->join(TABLES::$CITIES. ' AS ct','ct.id = adrs.city','left');
        $this->db->join(TABLES::$STATES. ' AS st','st.id = adrs.state','left');
        $this->db->where('assign_rider_id',$riderid);
        $this->db->or_where('delivery_assign_rider_id',$riderid);
        $this->db->order_by('ord.orderid DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function mobileExist($data)
    {
        $user = $this->db->get_where(TABLES::$RIDER,array('mobile'=>$data['mobile'],'status'=>1))->result_array();
        return $user;
    }

    public function otpMatch($map) {

        $result = $this->db->get_where(TABLES::$RIDER,array('mobile' => $map ['mobile'],'otp' =>$map['otp']))->row_array();
        if(empty($result)){
            $result['status'] = 0;
        }else{
            $result['status'] = 1;
        }
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
        $this->db->where('is_available',1);
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

    public function getTotalIncomeOfRider($riderid)
    {
        $this->db->select('SUM(settlment_amount) as totalIncome');
        $this->db->where('rider_id',$riderid);
        $this->db->where('paid',1);
        $q = $this->db->get('tbl_rider_invoice');
        return $q->result_array();
    }

    public function getTodayIncomeOfRider($riderid)
    {
        $this->db->select('commission_service');
        $this->db->where('restid',$riderid);
        $q = $this->db->get('tbl_rider_billing_config');
        $comm = $q->row_array();

        $this->db->select('applied_ride_charge')->from('tbl_booking');
        $this->db->where('assign_rider_id', $riderid);
        $this->db->where('rider_response',6);
        $this->db->where('status_updated_date',date('Y-m-d'));
        $q = $this->db->get();
        $result['pickup'] = $q->result_array();

        $this->db->select('applied_ride_charge')->from('tbl_booking');
        $this->db->where('delivery_assign_rider_id', $riderid);
        $this->db->where('delivery_rider_response',6);
        $this->db->where('status_updated_date',date('Y-m-d'));
        $q = $this->db->get();
        $result['delivery'] = $q->result_array();

        $data['todayIncome'] = 0;
        foreach ($result['pickup'] as $value) {
            $applied_ride_charge = round($value['applied_ride_charge'] / 2);
            $data['todayIncome'] = $data['todayIncome'] + $applied_ride_charge;
        }

        foreach ($result['delivery'] as $value) {
            $applied_ride_charge = round($value['applied_ride_charge'] / 2);
            $data['todayIncome'] = $data['todayIncome'] + $applied_ride_charge;
        }

        $commition = round($comm['commission_service'] / 100 * $data['todayIncome']);
        $data['todayIncome'] = $data['todayIncome'] - $commition;

        return $data;
    }

    public function getWeeklyIncomeOfRider($riderid)
    {        
        $seventhdate = date('Y-m-d', strtotime('-7 days'));

        $this->db->select('commission_service');
        $this->db->where('restid',$riderid);
        $q = $this->db->get('tbl_rider_billing_config');
        $comm = $q->row_array();

        $this->db->select('applied_ride_charge')->from('tbl_booking');
        $this->db->where('assign_rider_id', $riderid);
        $this->db->where('rider_response',6);
        $this->db->where('status_updated_date >=',$seventhdate);
        $this->db->where('status_updated_date <=',date('Y-m-d'));
        $q = $this->db->get();
        $result['pickup'] = $q->result_array();

        $this->db->select('applied_ride_charge')->from('tbl_booking');
        $this->db->where('delivery_assign_rider_id', $riderid);
        $this->db->where('delivery_rider_response',6);
        $this->db->where('status_updated_date >=',$seventhdate);
        $this->db->where('status_updated_date <=',date('Y-m-d'));
        $q = $this->db->get();
        $result['delivery'] = $q->result_array();

        $data['weeklyIncome'] = 0;
        foreach ($result['pickup'] as $value) {
            $applied_ride_charge = round($value['applied_ride_charge'] / 2);
            $data['weeklyIncome'] = $data['weeklyIncome'] + $applied_ride_charge;
        }

        foreach ($result['delivery'] as $value) {
            $applied_ride_charge = round($value['applied_ride_charge'] / 2);
            $data['weeklyIncome'] = $data['weeklyIncome'] + $applied_ride_charge;
        }

        $commition = round($comm['commission_service'] / 100 * $data['weeklyIncome']);
        $data['weeklyIncome'] = $data['weeklyIncome'] - $commition;
        return $data;
    }


    public function getInvoicesOfRider($riderid)
    {
        $this->db->select('invoice_url,created_date,paid');
        $this->db->where('rider_id',$riderid);
        $this->db->where('invoice_url !=','');
        $this->db->limit(20);
        $this->db->order_by('paid_date DESC');
        $q = $this->db->get('tbl_rider_invoice');
        return $q->result_array();
    }
}
?>