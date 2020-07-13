<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Notification extends MX_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->library('zyk/EmployeeLib', 'employeelib');
		$this->load->library('zyk/UserLoginLib', 'userloginlib');
		$this->load->library('zyk/NotificationLib', 'notificationlib');
	} 
	
	public function notificationList() {
		$users = $this->notificationlib->getCustomerList(); 
		$this->template->set('users',$users);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Administrator | Notifications' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'leftnav', 'partials/sidebar' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('notifications/NotificationList');
	}
	 public function New_Notification() { 
  
       // $categories = $this->servicelib->getActiveCategories(); 
      
       // $this->template->set('categories',$categories);
       
        $this->template->set_theme('default_theme')
                        ->set_layout('backend')
                        ->title('Administrator | Notifications')
                        ->set_partial('header', 'partials/header')
                        ->set_partial('leftnav', 'partials/sidebar')
                        ->set_partial('footer', 'partials/footer')
                        ->build('notifications/NotificationAdd');
    } 
     public function AddNotification() { 
         
        $notification_title = $this->input->post('title'); 
        $notification_message = $this->input->post('message');   
  
        $response = $this->notificationlib->sendBulkNotification($notification_title,$notification_message); 
        echo json_encode($response);  
    } 


		
}