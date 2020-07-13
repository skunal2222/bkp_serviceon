<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Vehical extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('zyk/VehicalLib', 'vehicallib');
    }
    
    
    public function New_Vehical() { 
 
        $this->load->library('zyk/ServiceLib', 'servicelib'); 
       // $categories = $this->servicelib->getActiveCategories(); 
        $brands = $this->vehicallib->getActiveBikeBrands(); 
        
        $models = $this->servicelib->getActiveModels();


        $this->template->set('brands',$brands);
       // $this->template->set('categories',$categories);
        $this->template->set('models',$models);
        $this->template->set_theme('default_theme')
                        ->set_layout('backend')
                        ->title('Administrator | Vehical')
                        ->set_partial('header', 'partials/header')
                        ->set_partial('leftnav', 'partials/sidebar')
                        ->set_partial('footer', 'partials/footer')
                        ->build('vehical/VehicalAdd');
    } 
    public function AddVehical() { 
        $params = array(); 
        
        $item = $this->input->post('item'); 
        
        $params['user_id'] = $item['userid']; 
        $params['vehical_no'] = $item['vehical_no'];
        $params['brand_id'] = $item['brand_id'];
        $params['model_id'] = $item['model_id']; 
        /*$params['license_number'] = $item['license_number'];
        $params['insurance_brand'] = $item['insurance_brand'];
        $params['insurance_number'] = $item['insurance_number'];*/
        $params['status'] =   $item['status'];   
        $params['created_datetime'] = date('Y-m-d H:i:s');  
  
        $response = $this->vehicallib->AddVehical($params); 
        echo json_encode($response);  
    }  
     public function VehicleList() {
        $vehicle = $this->vehicallib->getAllVehicleList(); 
        $this->template->set('vehicle', $vehicle);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Administrator | Vehicle List')
                ->set_partial('header', 'partials/header')
                ->set_partial('leftnav', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('vehical/VehicleList'); 
    }

    public function VehicletEdit($id) {
        
        $vehicle = $this->vehicallib->getVehiclesbyId($id); 
        $this->load->library('zyk/ServiceLib', 'servicelib');
        $brands = $this->servicelib->getActiveBrands();
        $models = $this->servicelib->getActiveModels(); 
        $this->template->set('models',$models);
        $this->template->set('brands',$brands);
        $this->template->set('vehicle', $vehicle); 
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Administrator | VehicleEdit')
                ->set_partial('header', 'partials/header')
                ->set_partial('leftnav', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('vehical/VehicleEdit');
    }
    public function update_vehicle() { 
        $params = array(); 
        
        $item = $this->input->post('item'); 

        $params['id'] = $item['id']; 
        $params['user_id'] = $item['userid']; 
        $params['vehicle_no'] = $item['vehical_no'];
        $params['brand_id'] = $item['brand_id'];
        $params['model_id'] = $item['model_id'];  
        // $params['license_number'] = $item['license_number'];
        // $params['insurance_brand'] = $item['insurance_brand'];
        // $params['insurance_number'] = $item['insurance_number'];
        $params['status'] =   $item['status'];   
        $params['updated_datetime'] = date('Y-m-d H:i:s');  

        $response = $this->vehicallib->updateVehicle($params); 
        echo json_encode($response);
    }
    public function get_vehicles_by_id() {

        //echo '<pre>';print_r($this->input->post()); die;
 
      $Id  = $this->input->post('vehicle_id');  
      $response = $this->vehicallib->getVehiclesbyId($Id);
      echo json_encode($response[0]);
    }
}
