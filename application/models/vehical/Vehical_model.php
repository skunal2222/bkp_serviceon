<?php

Class Vehical_model extends CI_Model {

     
   public function addVehical($cat) { 
        $data = array (); 
          
        $params = array (
                'user_id' => $cat ['user_id'],
                'vehicle_no' => $cat ['vehical_no'] 
        );
        $data1 = array(
            'user_id' => $cat['user_id'],
            'vehicle_no' => $cat['vehical_no'],
            'vehicle_alias_no' => str_replace(" ", "_", strtolower(trim($cat['vehical_no']))), 
            'brand_id' => $cat['brand_id'],
            'model_id' => $cat['model_id'],  
            'manufactured_year' => $cat['manufactured_year'],
            'total_kms' => $cat['total_kms'],
            'insurance_no' => $cat['insurance_no'],
            'purchase_date' => $cat['purchase_date'],
            'issued_by' => $cat['issued_by'],
            'created_datetime' => $cat['created_datetime'],
            'status' => $cat['status']
        );
         
        $this->db->select ( 'id' )->from ( TABLES::$USER_VEHICLES )->where ( $params );
        $query = $this->db->get ();
        $result = $query->result_array ();

        if (count ( $result ) <= 0) {
            $this->db->insert ( TABLES::$USER_VEHICLES, $data1 );
            $data['id'] = $this->db->insert_id();
            $data['msg'] = "Vehical Added Successfully";
            $data['status'] = 1;
            return $data;
        } else {
            $data['msg'] = "Vehical already exists.";
            $data['status'] = 0;
            //return $data;
            echo json_encode($data);
            exit;
        }
    }  
   public function getActiveBikeBrands(){ 
        $this->db->select ( 'a.*,b.name as category', FALSE )->from ( TABLES::$BRAND . ' AS a' )->join ( TABLES::$MENU_MAIN_CATEGORY . ' AS b', 'a.category_id = b.id', 'inner' );
        $this->db->where ( 'b.name', 'Bike' );
         $this->db->where ( 'a.status', 1 );
        $this->db->order_by ( 'a.id', 'ASC' );
        $query = $this->db->get ();
        //echo $this->db->last_query();
        $result = $query->result_array ();
        return $result;
   
   } 

    public function getModelsByBrandsID($brandsID=null)
    {
        $this->db->select('id, name');
        $this->db->from(TABLES::$MANUFACTURE);
        if (!empty($brandsID)) {
            $this->db->where_in('brand_id',$brandsID);
        }
        $this->db->where('status',1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }


    public function getVehicalList($id) {
        $this->db->select ( 'a.*,b.name as brandname,c.name as modelname' )
                 ->join ( TABLES::$BRAND . ' AS b', 'a.brand_id = b.id', 'inner' )
                 ->join ( TABLES::$MANUFACTURE . ' AS c', 'a.model_id = c.id', 'left' );  
        $this->db->from ( TABLES::$USER_VEHICLES.' AS a'); 
        $this->db->where ( 'a.user_id', $id );
        $this->db->where ( 'a.status', 1 );
        $query = $this->db->get ();
        $result = $query->result_array ();
        //print_r($result);
        return $result;
    }
    public function getBrandListbyVehicalId($id) {
        $this->db->select ( 'a.brand_id' )    
                 ->from ( TABLES::$USER_VEHICLES.' AS a'); 
        $this->db->where ( 'a.id', $id );
        $query = $this->db->get ();
        $result = $query->result_array ();
        //print_r($result);
        return $result;
    }
    public function getModelListbyVehicalId($id) {
        $this->db->select ( 'a.model_id' )    
                 ->from ( TABLES::$USER_VEHICLES.' AS a'); 
        $this->db->where ( 'a.id', $id );
        $query = $this->db->get ();
        $result = $query->result_array ();
        //print_r($result);
        return $result;
    }
     public function getAllVehicleList() {
        $this->db->select('a.*,b.name as username ,c.name as brandname,d.name as modelname', FALSE)
                 ->from(TABLES::$USER_VEHICLES . ' AS a')
                 ->join ( TABLES::$USER . ' AS b', 'a.user_id = b.id')
                 ->join ( TABLES::$BRAND . ' AS c', 'a.brand_id = c.id')
                 ->join ( TABLES::$MANUFACTURE . ' AS d', 'a.model_id = d.id')
                 ->order_by('a.id','DESC');  
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getVehiclesbyId($id) {
        $this->db->select('a.*,b.name as username ,b.mobile as usermobile,c.name as brandname,d.name as modelname', FALSE)
                 ->from(TABLES::$USER_VEHICLES . ' AS a') 
                 ->join ( TABLES::$USER . ' AS b', 'a.user_id = b.id')
                 ->join ( TABLES::$BRAND . ' AS c', 'a.brand_id = c.id')
                 ->join ( TABLES::$MANUFACTURE . ' AS d', 'a.model_id = d.id')
                 ->where ( 'a.id', $id );
        $query = $this->db->get ();
        $result = $query->result_array ();
        //print_r($result);
        return $result;
    }
      
     public function updateVehicle($params) { 

          /*$data1 = array(
            'id' => $params['id'],
            'user_id' => $params['user_id'],
            'vehicle_no' => $params['vehicle_no'],
            'vehicle_alias_no' => str_replace(" ", "_", strtolower(trim($params['vehicle_no']))), 
            'brand_id' => $params['brand_id'],
            'model_id' => $params['model_id'],  
            'updated_datetime' => $params['updated_datetime'],
            'status' => $params['status']
        );*/

        $id = $params ['id'];
        $vehicle_no = $params ['vehicle_no'];

        $this->db->select ( 'id' )->from ( TABLES::$USER_VEHICLES )->where ('id !=',$id )->where ('vehicle_no',$vehicle_no );
        $query = $this->db->get ();
        $result = $query->result_array ();

        if (count ( $result ) <= 0) {
            $this->db->where('id', $params['id']);
            $this->db->update(TABLES::$USER_VEHICLES, $params);
            $data ['status'] = 1;
            $data ['msg'] = "Updated successfully";
            $data['id'] = $params['id'];
        }
        else
        {
            $data ['status'] = 0;
            $data ['msg'] = "Vehicle number already exist to another user/vehicle.";
        }
        return $data; 

    }  
    public function addLicense($cat){
        $data = array (); 
          
         $data1 = array(   
            'license_url' => $cat['license_url'] 
        );

        $this->db->where('id',$cat['user_id']);
        $this->db->update(TABLES::$USER,$data1); 
      
        $data['msg'] = "License Added Successfully";
        $data['status'] = 1; 
        echo json_encode($data);
        exit;
         
    }

     public function addVehicleRC($cat){
        $data = array (); 
          
         $data1 = array(   
            'user_id' => $cat['user_id'],
            'vehicle_id' => $cat['vehicle_id'],
            'type' => $cat['type'],
            'url' => $cat['url'], 
            'document_name' => $cat['document_name'], 
            'created_datetime' => $cat['created_datetime'] 
        );


        $this->db->insert ( TABLES::$VEHICLES_DOCUMENTS, $data1 );
        $data['id'] = $this->db->insert_id();
        $data['type']=$cat['type'];
        
        if ($data['type'] == 1) {

           $data['msg'] = "RC Added Successfully";
           $data['status'] = 1; 

        }elseif ($data['type'] == 2) {
          
           $data['msg'] = "Insurance Added Successfully";
           $data['status'] = 1; 
        } elseif ($data['type'] == 3) {
          
           $data['msg'] = "PUC Added Successfully";
           $data['status'] = 1; 
        } 
         
        echo json_encode($data);
        exit;
         
    }
     public function getVehicalDocumentList($id) {
        $this->db->select ( 'a.*' );  
        $this->db->from ( TABLES::$VEHICLES_DOCUMENTS.' AS a'); 
        $this->db->where ( 'a.user_id', $id ); 
        $query = $this->db->get ();
        $result = $query->result_array ();
        //print_r($result);
        return $result;
    }

       public function getVehicalAllDocumentList($vehicleid,$userid) { 

        $this->db->select ( 'a.*,b.vehicle_no' );  
        $this->db->from ( TABLES::$VEHICLES_DOCUMENTS.' AS a')
                 ->join ( TABLES::$USER_VEHICLES . ' AS b', 'a.vehicle_id = b.id');
        $this->db->where ( 'a.vehicle_id', $vehicleid ); 
        $this->db->where ( 'a.user_id', $userid ); 
        $query = $this->db->get ();
        $result = $query->result_array ();
        //print_r($result);
        return $result;
    }


     public function getUserLicenseList($id) {
        $this->db->select ( 'a.*' );  
        $this->db->from ( TABLES::$USER_VEHICLES_DOCUMENTS.' AS a'); 
        $this->db->where ( 'a.user_id', $id ); 
        $query = $this->db->get ();
        $result = $query->result_array ();
        //print_r($result);
        return $result;
    }

     public function delete_license_by_id($id) {   
        
        $this->db->set('license_url', NULL); 
        $this->db->where ( 'id', $id );
        $this->db->update ( TABLES::$USER ); 
        $response['status'] = 1; 
       return $response;
    }
    public function updateLicense($params){
       
          $data1 = array(  
            'license_url' => $params['license_url'] 
        );


        $this->db->where('id', $params['user_id']);
        $this->db->update(TABLES::$USER, $data1);
        $data ['status'] = 1;
        $data ['msg'] = "License Updated successfully";
        $data['id'] = $data1['id'];
        return $data; 
    }
      public function updateVehicleRC($params){
       
          $data1 = array(  
            'url' => $params['url'],
            'updated_datetime' => $params['updated_datetime']
        ); 
          
        $this->db->where('id', $params['id']);
        $this->db->update(TABLES::$VEHICLES_DOCUMENTS, $data1);
        $data ['status'] = 1;
        $data ['msg'] = "Document Updated successfully"; 
        //$data ['id'] = $data1['id'];
        return $data;  
    }
     public function delete_rc_by_id($id) {   

        $this->db->where ( 'id', $id ); 
        $this->db->delete( TABLES::$VEHICLES_DOCUMENTS ); 
        $response['status'] = 1; 
       return $response;
    }

     public function addVehicleInsurance($cat){
        $data = array (); 
          
         $data1 = array(   
            'user_id' => $cat['user_id'],
            'vehicle_id' => $cat['vehicle_id'],
            'type' => $cat['type'],
            'url' => $cat['url'], 
            'document_name' => $cat['document_name'], 
            'created_datetime' => $cat['created_datetime'] 
        );

        $this->db->insert ( TABLES::$VEHICLES_DOCUMENTS, $data1 );
        $data['id'] = $this->db->insert_id();
        $data['msg'] = "Insurance Added Successfully";
        $data['status'] = 1; 
        echo json_encode($data);
        exit;
         
    }
     public function updateVehicleInsurance($params){
       
          $data1 = array(  
            'url' => $params['url'],
            'updated_datetime' => $params['updated_datetime']
        ); 
          
        $this->db->where('id', $params['id']);
        $this->db->update(TABLES::$VEHICLES_DOCUMENTS, $data1);
        $data ['status'] = 1;
        $data ['msg'] = "Insurance Updated successfully"; 
        return $data; 
    }
     public function delete_insurance_by_id($id) {   

        $this->db->where ( 'id', $id );
        $this->db->where ( 'type', 2 );
        $this->db->delete( TABLES::$VEHICLES_DOCUMENTS ); 
        $response['status'] = 1; 
       return $response;
    }

     public function addVehiclePuc($cat){
        $data = array (); 
          
         $data1 = array(   
            'user_id' => $cat['user_id'],
            'vehicle_id' => $cat['vehicle_id'],
            'type' => $cat['type'],
            'url' => $cat['url'], 
            'document_name' => $cat['document_name'], 
            'created_datetime' => $cat['created_datetime'] 
        );

        $this->db->insert ( TABLES::$VEHICLES_DOCUMENTS, $data1 );
        $data['id'] = $this->db->insert_id();
        $data['msg'] = "PUC Added Successfully";
        $data['status'] = 1; 
        echo json_encode($data);
        exit;
         
    } 

     public function updateVehiclePuc($params){
       
          $data1 = array(  
            'url' => $params['url'],
            'updated_datetime' => $params['updated_datetime']
        ); 
          
        $this->db->where('id', $params['id']);
        $this->db->update(TABLES::$VEHICLES_DOCUMENTS, $data1);
        $data ['status'] = 1;
        $data ['msg'] = "PUC Updated successfully"; 
        return $data; 
    }
     public function delete_puc_by_id($id) {   

        $this->db->where ( 'id', $id );
        $this->db->where ( 'type', 3 );
        $this->db->delete( TABLES::$VEHICLES_DOCUMENTS ); 
        $response['status'] = 1; 
       return $response;
    }
     public function addOtherDocuments($cat){
        $data = array (); 
          
         $data1 = array(   
            'user_id' => $cat['user_id'],
            'vehicle_id' =>  NULL,
            'type' =>  NULL,
            'url' => $cat['url'], 
            'document_name' => $cat['document_name'], 
            'created_datetime' => $cat['created_datetime'] 
        );


        $this->db->insert ( TABLES::$VEHICLES_DOCUMENTS, $data1 );
        $data['id'] = $this->db->insert_id();
        $data['msg'] = "Documents Added Successfully";
        $data['status'] = 1; 
        echo json_encode($data);
        exit;
         
    }
     public function editOtherDocuments($params){
       
          $data1 = array(  
            'url' => $params['url'], 
            'updated_datetime' => $params['updated_datetime']
        ); 

        $this->db->where('id', $params['id']);
        $this->db->update(TABLES::$VEHICLES_DOCUMENTS, $data1);
        $data ['status'] = 1;
        $data ['msg'] = "Documents Updated successfully"; 
        return $data; 
    }
      public function delete_other_doc_by_id($id) {   

        $this->db->where ( 'id', $id );
        $this->db->where ( 'type', NULL );
        $this->db->delete( TABLES::$VEHICLES_DOCUMENTS ); 
        $response['status'] = 1; 
       return $response;
    }

}

?>