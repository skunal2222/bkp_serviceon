<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin/rider/editPayment'] = 'backend/Rider/editPayment';
$route['admin/rider/edit_zone'] = 'backend/Rider/edit_zone';
$route['admin/general/pickup'] = 'backend/Pickup/index';
$route['admin/general/breakdown'] = 'backend/Pickup/breakdown';

$route['admin/general/addpickup'] = 'backend/Pickup/addPickup';
$route['admin/general/editpickup/([0-9]+)'] = 'backend/Pickup/editPickup/$1';

$route['admin/general/adddrop'] = 'backend/Pickup/addDrop';
$route['admin/general/editBreakdown/([0-9]+)'] = 'backend/Pickup/editbreakdown/$1';

$route['admin/pickup/insert'] = 'backend/Pickup/insert'; 
$route['admin/pickup/insertDropdown'] = 'backend/Pickup/insertDropdown'; 

$route['admin/pickup/updatePickup'] = 'backend/Pickup/updatepickup'; 
$route['admin/pickup/updateBreakDown'] = 'backend/Pickup/updateBreakDown'; 

$route['admin/riderleads'] = 'backend/Setting/riderleads'; 
$route['admin/partnerleads'] = 'backend/Setting/partnerleads'; 








/* ------------------FRONT END --------------------------------------*/
$route['save_suscriber'] = 'frontend/Home/save_subscriber'; 
$route['save_ride_with_us'] = 'frontend/Home/save_ride_with_us'; 
$route['save_partner_with_us'] = 'frontend/Home/save_partner_with_us'; 


$route['order_summary'] = 'frontend/Vendor/order_summary_view';
$route['order_summary/(:any)'] = 'frontend/Vendor/order_summary_view/$1';
$route['coupon/get_description'] = 'frontend/Vendor/get_description';

$route['apply_coupon/'] = 'frontend/Home/apply_coupon/$1'; 
$route['cpn/validate_coupon_code'] = 'frontend/Home/validate_coupon_code';  
