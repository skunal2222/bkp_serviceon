<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'frontend/Home';
//$route['default_controller'] = 'backend/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE; 

/* *********** API ROUTES ************ */
////// api by kunal ///////////
//serviceon Rider app api****
$route ['api/rider/sendotp'] = 'api/rider/Api/send_otp';
$route ['api/rider/verifyotp'] = 'api/rider/Api/verify_otp';
$route ['api/rider/add_firebaseToken'] = 'api/rider/Api/addFirebaseToken';
$route ['api/rider/get_order_list'] = 'api/rider/Api/getOrderListByRiderID';
$route ['api/rider/get_order_details'] = 'api/rider/Api/getOrderDetails';
$route ['api/rider/save_rider_status'] = 'api/rider/Api/save_rider_status_of_order';
$route ['api/rider/fetch_lat_long_by_rider'] = 'api/rider/Api/updateRiderLatLong';
$route ['api/rider/get_dashboard_data'] = 'api/rider/Api/getDashboardData';
$route ['api/rider/save_rider_availability'] = 'api/rider/Api/saveRiderAvailability';
$route ['api/rider/save_images'] = 'api/rider/Api/save_images';
$route ['api/rider/update_images'] = 'api/rider/Api/update_images';
$route ['api/rider/delete_images'] = 'api/rider/Api/delete_images';
$route ['api/rider/show_collection_amount_at_delivery'] = 'api/rider/Api/showCollectionAmountAtDelivery';
$route ['api/rider/save_collection_amount_at_delivery'] = 'api/rider/Api/saveCollectionAmountAtDelivery';
$route ['api/rider/show_rider_details'] = 'api/rider/Api/showRiderDetails';
$route ['api/rider/update_rider_details'] = 'api/rider/Api/updateRiderDetails';

$route ['api/tempFCM'] = 'api/rider/Api/tempFCM';


//serviceon user app api****
$route ['api/auth/add_firebaseToken'] = 'api/auth/Api/addFirebaseToken';
$route ['api/auth/social/login'] = 'api/auth/Api/socialLogin';
$route ['api/auth/sendloginotp'] = 'api/auth/Api/sendLoginotp';
$route ['api/myprofile/send_otp_mobile_update'] = 'api/auth/Api/sendotpmobileupdate';
$route ['api/myprofile/verify_otp_mobile_update'] = 'api/auth/Api/verifyotpmobileupdate';
$route ['api/auth/verifyotp'] = 'api/auth/Api/loginwithotp';
$route ['api/auth/garage_list'] = 'api/auth/Api/garage_search';
// $route ['api/auth/garage_search_by_name'] = 'api/auth/Api/getVendorsListByName';
$route ['api/auth/garage_details'] = 'api/auth/Api/garage_details';
$route ['api/service/get_brand_list'] = 'api/service/Api/getBrandList';
$route ['api/service/model_list_by_id'] = 'api/service/Api/getModelsByBrandsID';
$route ['api/vehicle/add_vehicle'] = 'api/vehicle/Api/addNewVehicle';
$route ['api/vehicle/update_vehicle'] = 'api/vehicle/Api/updateVehicle';
$route ['api/user/vehicle_list'] = 'api/vehicle/Api/getVehicleListByUserID';
$route ['api/user/add_address'] = 'api/auth/Api/addUseraddress';
$route ['api/user/update_address'] = 'api/auth/Api/updateUseraddress';
$route ['api/user/delete_address'] = 'api/auth/Api/deleteaddress';
$route ['api/user/get_address_by_userid'] = 'api/auth/Api/getAddressByUserId';
$route ['api/user/set_pickup_address'] = 'api/auth/Api/set_isPrimary_address';
$route ['api/user/getwallet-points'] = 'api/auth/Api/getWalletPoints';
$route ['api/user/save_digidocs'] = 'api/auth/Api/save_digidocs';
$route['api/user/delete_digidocs'] = 'api/auth/Api/delete_digidocs';
$route['api/user/update_digidocs'] = 'api/auth/Api/update_digidocs';
$route['api/user/digidocs_list'] = 'api/auth/Api/digidocs_list';

$route ['api/get_statecitylist'] = 'api/auth/Api/get_state_city_list';
// $route ['api/get_citylist'] = 'api/auth/Api/get_citylist';
$route ['api/get_pickupslot'] = 'api/auth/Api/getPickupslot';
$route ['api/user/profile_update'] = 'api/auth/Api/profile_update';
$route ['api/order/submit_order'] = 'api/orders/Api/submit_order';
$route ['api/user/get_order_tracking'] = 'api/orders/Api/getOrderTracking';
$route ['api/order/get_order_details'] = 'api/orders/Api/getOrderDetailsForUser';
$route ['api/order/save_estimate_confirmation'] = 'api/orders/Api/getEstimateConfirmation';
$route ['api/order/save_order_response'] = 'api/orders/Api/saveOrderPaymentResponse';


////// api by kunal ///////////

$route ['api/auth/login.(:any)'] = 'api/auth/Api/login/$1';
$route ['api/auth/signup.(:any)'] = 'api/auth/Api/signup/$1';
// $route ['api/auth/verifyotp.(:any)'] = 'api/auth/Api/verifyotp/$1';
$route ['api/auth/resendotp'] = 'api/auth/Api/resendotp';
$route ['api/auth/updateprofile.(:any)'] = 'api/auth/Api/updateprofile/$1';
$route ['api/auth/accountsetting.(:any)'] = 'api/auth/Api/accountsetting/$1';
$route ['api/order/history.(:any)'] = 'api/orders/Api/orderhistory/$1';
$route ['api/order/notification.(:any)'] = 'api/orders/Api/notification/$1';
$route ['api/order/removeNotification.(:any)'] = 'api/orders/Api/removeNotification/$1';
$route ['api/order/ongoingorderinfo.(:any)'] = 'api/orders/Api/ongoingorderinfo/$1';
$route ['api/order/ongoingorderlogs.(:any)'] = 'api/orders/Api/ongoingorderlogs/$1';
$route ['api/order/ongoingorderbill.(:any)'] = 'api/orders/Api/ongoingorderbill/$1';
$route ['api/order/setConfirmedItems.(:any)'] = 'api/orders/Api/setConfirmedItems/$1';
$route ['api/order/getOrderDetailsByOrderId.(:any)'] = 'api/orders/Api/getOrderDetailsByOrderId/$1';
$route ['api/order/cancelOrderFromApp.(:any)'] = 'api/orders/Api/cancelOrderFromApp/$1';
$route ['api/order/rescheduleOrder.(:any)'] = 'api/orders/Api/rescheduleOrder/$1';
$route ['api/auth/getUserProfile.(:any)'] = 'api/auth/Api/getUserProfile/$1';
$route ['api/auth/getWalletBalance.(:any)'] = 'api/auth/Api/getWalletBalance/$1';
$route ['api/auth/getReferCode.(:any)'] = 'api/auth/Api/getReferCode/$1';
$route ['api/coupon/check.(:any)'] = 'api/general/Api/checkcoupon/$1';
$route ['api/coupon/getActiveCoupons.(:any)'] = 'api/general/Api/getActiveCoupons/$1';

$route ['api/auth/addaddress.(:any)'] = 'api/auth/Api/addUseraddress/$1';
$route ['api/auth/updateaddress.(:any)'] = 'api/auth/Api/updateUseraddress/$1';
$route ['api/auth/getaddress.(:any)'] = 'api/auth/Api/getUseraddress/$1';
$route ['api/auth/getUserNotification.(:any)'] = 'api/auth/Api/getUserNotification/$1';
$route ['api/auth/getOngoingOrder.(:any)'] = 'api/auth/Api/getOngoingOrder/$1'; 

//service api
$route ['api/service/my_packges.(:any)'] = 'api/service/Api/my_packges/$1';
$route ['api/service/particular_package.(:any)'] = 'api/service/Api/particular_package/$1';
$route ['api/service/checkservice.(:any)'] = 'api/service/Api/checkservice/$1';
$route ['api/service/getcategory.(:any)'] = 'api/service/Api/getCategory/$1';
$route ['api/service/brandbycatid.(:any)'] = 'api/service/Api/brandbycatid/$1';
$route ['api/service/modelbybrandid.(:any)'] = 'api/service/Api/modelbybrandid/$1';

$route ['api/service/categorybymodelid.(:any)'] = 'api/service/Api/categorybymodelid/$1';
$route ['api/service/subcategorybycatid.(:any)'] = 'api/service/Api/subcategorybycatid/$1';
$route ['api/service/addOrder.(:any)'] = 'api/service/Api/addOrder/$1';
$route ['api/service/getOrderHistory.(:any)'] = 'api/service/Api/getOrderHistory/$1';
$route ['api/service/getslot.(:any)'] = 'api/service/Api/getslot/$1';
$route ['api/service/uploadDocument.(:any)'] = 'api/service/Api/uploadDocument/$1';

$route ['api/auth/testNotify.(:any)'] = 'api/auth/Api/testNotification/$1';

//mechanic api
$route ['api/mechanic/vehicle_update.(:any)'] = 'api/mechanic/Api/vehicle_update/$1';
$route ['api/mechanic/vehicle_delete.(:any)'] = 'api/mechanic/Api/vehicle_delete/$1';
$route ['api/mechanic/vehicle_pakagelist.(:any)'] = 'api/mechanic/Api/vehicle_pakagelist/$1'; 
$route ['api/mechanic/vehicle_servicelist.(:any)'] = 'api/mechanic/Api/vehicle_servicelist/$1';
 
$route ['api/mechanic/save_vehicle.(:any)'] = 'api/mechanic/Api/save_vehicle/$1';
$route ['api/mechanic/vehicle_list.(:any)'] = 'api/mechanic/Api/vehicle_list/$1';
$route ['api/mechanic/vendorinvoices.(:any)'] = 'api/mechanic/Api/vendor_invoice/$1';
$route ['api/mechanic/refresh_payment.(:any)'] = 'api/mechanic/Api/refresh_payment/$1';


$route ['api/mechanic/pakagelist.(:any)'] = 'api/mechanic/Api/pakagelist/$1'; 	
$route ['api/mechanic/package_servicelist.(:any)'] = 'api/mechanic/Api/package_servicelist/$1';
$route ['api/mechanic/package_search.(:any)'] = 'api/mechanic/Api/package_search/$1';


//$route ['api/general/save_driving_license.(:any)'] = 'api/general/Api/save_driving_license/$1'; 
$route ['api/mechanic/save_driving_license.(:any)'] = 'api/mechanic/Api/save_driving_license/$1'; 
$route ['api/mechanic/user_driving_license.(:any)'] = 'api/mechanic/Api/user_driving_license/$1';
$route ['api/mechanic/driving_license_delete.(:any)'] = 'api/mechanic/Api/driving_license_delete/$1';
$route ['api/mechanic/driving_license_update.(:any)'] = 'api/mechanic/Api/driving_license_update/$1';
$route ['api/mechanic/uploadLicenseDocument.(:any)'] = 'api/mechanic/Api/uploadLicenseDocument/$1';

$route ['api/mechanic/vehicle_documents_list.(:any)'] = 'api/mechanic/Api/vehicle_documents_list/$1';
 

$route ['api/mechanic/save_user_vehicles_documents.(:any)'] = 'api/mechanic/Api/save_user_vehicles_documents/$1';
$route ['api/mechanic/update_user_vehicles_documents.(:any)'] = 'api/mechanic/Api/update_user_vehicles_documents/$1';
$route ['api/mechanic/all_user_vehicles_documents.(:any)'] = 'api/mechanic/Api/all_user_vehicles_documents/$1';
$route ['api/mechanic/vehicle_documents_delete.(:any)'] = 'api/mechanic/Api/vehicle_documents_delete/$1';
$route ['api/mechanic/save_user_other_documents.(:any)'] = 'api/mechanic/Api/save_user_other_documents/$1';
$route ['api/mechanic/update_user_other_documents.(:any)'] = 'api/mechanic/Api/update_user_other_documents/$1';
$route ['api/mechanic/uploadOtherDocument.(:any)'] = 'api/mechanic/Api/uploadOtherDocument/$1';
$route ['api/mechanic/updateOtherDocument.(:any)'] = 'api/mechanic/Api/updateOtherDocument/$1';

$route ['api/mechanic/other_document_list.(:any)'] = 'api/mechanic/Api/other_document_list/$1';



$route ['api/mechanic/send_otp.(:any)'] = 'api/mechanic/Api/send_otp/$1';
$route ['api/mechanic/verifyotp.(:any)'] = 'api/mechanic/Api/verifyotp/$1';
$route ['api/mechanic/setpassword.(:any)'] = 'api/mechanic/Api/setpassword/$1';
$route ['api/mechanic/login.(:any)'] = 'api/mechanic/Api/login/$1';
$route ['api/mechanic/scheduled_services.(:any)'] = 'api/mechanic/Api/scheduled_services/$1';
$route ['api/mechanic/service_accept_or_reject.(:any)'] = 'api/mechanic/Api/service_accept_or_reject/$1';
$route ['api/mechanic/reason_list.(:any)'] = 'api/mechanic/Api/reason_list/$1';
$route ['api/mechanic/order_status.(:any)'] = 'api/mechanic/Api/order_status/$1';
$route ['api/mechanic/service_or_spareparts_list.(:any)'] = 'api/mechanic/Api/service_or_spareparts_list/$1';
$route ['api/mechanic/main_services_list.(:any)'] = 'api/mechanic/Api/main_services_list/$1';
$route ['api/mechanic/suggest_services.(:any)'] = 'api/mechanic/Api/suggest_services/$1';
$route ['api/mechanic/suggested_services_list.(:any)'] = 'api/mechanic/Api/suggested_services_list/$1';
$route ['api/mechanic/payment.(:any)'] = 'api/mechanic/Api/payment/$1';
$route ['api/mechanic/update_profile.(:any)'] = 'api/mechanic/Api/update_profile/$1';
$route ['api/mechanic/ongoing_orders.(:any)'] = 'api/mechanic/Api/ongoing_orders/$1';
$route ['api/mechanic/ongoingorderinfo.(:any)'] = 'api/mechanic/Api/ongoingorderinfo/$1';
$route ['api/mechanic/getOrderHistory.(:any)'] = 'api/mechanic/Api/getOrderHistory/$1';
$route ['api/mechanic/testNotification.(:any)'] = 'api/mechanic/Api/testNotification/$1';
$route ['api/mechanic/testGarageNotification.(:any)'] = 'api/mechanic/Api/testGarageNotification/$1';
$route ['api/mechanic/getNotification.(:any)'] = 'api/mechanic/Api/getMechanicNotificationById/$1';

$route ['api/mechanic/getMechnicList.(:any)'] = 'api/mechanic/Api/getMechnicList/$1';
$route ['api/mechanic/assignMechnic.(:any)'] = 'api/mechanic/Api/assignMechnic/$1';

$route ['api/mechanic/addMechanic.(:any)'] = 'api/mechanic/Api/addMechanic/$1';
$route ['api/mechanic/getRoleList.(:any)'] = 'api/mechanic/Api/getRoleList/$1';

$route ['api/vendor/vendorOrders.(:any)'] = 'api/vendor/Api/getOrderList/$1'; 
$route ['api/vendor/assignOrderToMechanic.(:any)'] = 'api/vendor/Api/assignOrderToMechanic/$1'; 

/* $route ['api/order/detail.(:any)'] = 'api/orders/Api/orderdetail/$1';
$route ['api/order/cancel.(:any)'] = 'api/orders/Api/cancelorder/$1';
$route ['api/auth/facebook/login.(:any)'] = 'api/auth/Api/facebooklogin/$1';
$route ['api/auth/myaccount.(:any)'] = 'api/auth/Api/myaccount/$1';
$route ['api/auth/contact/update.(:any)'] = 'api/auth/Api/updatecontact/$1';
$route ['api/auth/forgotpassword.(:any)'] = 'api/auth/Api/forgotpassword/$1';
$route ['api/coupon/check.(:any)'] = 'api/general/Api/checkcoupon/$1';
$route ['api/coupon/list.(:any)'] = 'api/general/Api/couponlist/$1';
$route ['api/product/list.(:any)'] = 'api/general/Api/productlist/$1';
$route ['api/ticket/add.(:any)'] = 'api/general/Api/addticket/$1';
//$route ['api/complaint/add.(:any)'] = 'api/general/Api/addcomplaint/$1';
//$route ['api/order/add.(:any)'] = 'api/orders/Api/addorder/$1';
//$route ['api/service/add.(:any)'] = 'api/orders/Api/serviceadd/$1';
$route ['api/auth/facebook/signup.(:any)'] = 'api/auth/Api/signupfacebook/$1';
$route ['api/payment/request.(:any)'] = 'api/orders/Api/requestpayment/$1';
$route ['api/auth/updatepassword.(:any)'] = 'api/auth/Api/updatepassword/$1';
$route ['api/auth/updatetoken.(:any)'] = 'api/auth/Api/updatetoken/$1';
$route ['api/auth/getcontact.(:any)'] = 'api/auth/Api/contact/$1';
$route ['api/auth/checkaddress.(:any)'] = 'api/auth/Api/checkaddress/$1';
$route ['api/service/list.(:any)'] = 'api/general/Api/servicelist/$1';
$route ['api/servicearea/check.(:any)'] = 'api/general/Api/checkservice/$1';
$route ['api/service/price.(:any)'] = 'api/general/Api/serviceprice/$1';
$route ['api/auth/addaddress.(:any)'] = 'api/auth/Api/addUseraddress/$1';
$route ['api/auth/updateaddress.(:any)'] = 'api/auth/Api/updateUseraddress/$1';
$route ['api/auth/getaddress.(:any)'] = 'api/auth/Api/getUseraddress/$1';
$route ['api/order/schedulepickup.(:any)'] = 'api/orders/Api/schedulePickup/$1';
$route ['api/order/scheduleorderdetail.(:any)'] = 'api/orders/Api/scheduleorderdetail/$1';
$route ['api/order/updateschedulePickup.(:any)'] = 'api/orders/Api/updateschedulePickup/$1';
$route ['api/order/confirmOrder.(:any)'] = 'api/orders/Api/confirmOrder/$1';
$route ['api/order/updateDelivery.(:any)'] = 'api/orders/Api/updatescheduleDelivery/$1';
$route ['api/order/latestorderdetail.(:any)'] = 'api/orders/Api/latestorderdetail/$1';
$route ['api/pickup/slot.(:any)'] = 'api/general/Api/pickupslot/$1';
$route ['api/delivery/slot.(:any)'] = 'api/general/Api/deliveryslot/$1';
$route ['api/auth/deleteaddress.(:any)'] = 'api/auth/Api/deleteaddress/$1';
$route ['api/auth/testNotify.(:any)'] = 'api/auth/Api/testNotification/$1';
$route ['api/auth/getuseralert.(:any)'] = 'api/auth/Api/getUserNotification/$1'; */


/* *********** Frontend Routes ********* */
$route['userlogin'] = 'frontend/Login/login';
$route['logout'] = 'frontend/Login/logout';
$route['sendotp'] = 'frontend/Login/otpSend';
$route['signup'] = 'frontend/Login/UserRegistration';
$route['sendLoginotp'] = 'frontend/Login/sendLoginotp';
$route['loginwithOTP'] = 'frontend/Login/loginwithOTP';
$route['resendOtp'] = 'frontend/Login/resendOtp';
$route['updateuser'] = 'frontend/Login/updateProfile';

$route['basic-info'] = 'frontend/MyProfile/Basicinfo';
$route['refer-n-earn'] = 'frontend/MyProfile/refernearn';

$route['wallet'] = 'frontend/MyProfile/wallet';
$route['notifications'] = 'frontend/MyProfile/Notifications';
$route['forgetPassword'] = 'frontend/Login/forgetPassword';
$route['resetPassword/([0-9]+)/([0-9]+)'] = 'frontend/Login/resetPassword/$1/$2';
$route['updatePassword'] = 'frontend/Login/updatePassword';

$route['ongoing-orders'] = 'frontend/Order/TrackOrder';
$route['order-history'] = 'frontend/Order/History';  
$route['my-packages'] = 'frontend/Service/MyPackages';
$route['bookingorder'] = 'frontend/Service/bookorder';

/******************** booking-flow routes start @Ajinkya Jadhav*********************/  
$route['rename/document'] = 'frontend/Order/rename_document';
$route['booking'] = 'frontend/Order/selectBrand'; 
$route['select-brand'] = 'frontend/Order/selectBrand';
$route['select-model'] = 'frontend/Order/selectModel';
$route['select-subcategory'] = 'frontend/Order/selectSubcategory';
$route['select-services'] = 'frontend/Order/selectServices';
$route['select-address'] = 'frontend/Order/selectAdd';   
$route['select-user-address'] = 'frontend/Order/selectUserAdd';
$route['Booking-summary'] = 'frontend/Order/bookingSummary'; 
$route['delivery_dates'] = 'frontend/Home/getDeliveryDates'; 
$route['applycpoupon'] = 'frontend/Home/applyCoupon'; 
$route['applyredeem'] = 'frontend/Home/applyredeem';
$route['getredeempoints'] = 'frontend/Home/getredeempoints';
$route['booking/add'] = 'frontend/Home/addOrder';
$route['add-subscription'] = 'frontend/Home/addSubscription';   
//set data in session
$route['setBrand'] = 'frontend/Order/setBrand';
$route['setData'] = 'frontend/Order/setData'; 
$route['setModel'] = 'frontend/Order/setModel';
$route['setSub'] = 'frontend/Order/setSub'; 
$route['setCatsubcat'] = 'frontend/Order/setCatsubcat'; 
$route['setPackage'] = 'frontend/Order/setPackage'; 
$route['select-address'] = 'frontend/Order/selectAdd';
$route['thank-you'] = 'frontend/Order/thankyou';
$route['booking-failed'] = 'frontend/Order/bookingFail'; 
$route['our-services'] = 'frontend/Home/ourservices';
$route['why-us'] = 'frontend/Home/whyUs';
$route['partner-with-us'] = 'frontend/Home/partner_with_us';
$route['ride-with-us'] = 'frontend/Home/ride_with_us';
$route['package'] = 'frontend/Home/package';

$route['refund-policy'] = 'frontend/Home/refund';
$route['cancellation-policy'] = 'frontend/Home/cancellation';
$route['enquiry-form'] = 'frontend/Home/enquiryform';  
$route['filter/byservicename'] = 'frontend/Service/getbrandsbyName';
$route['subcategorybycatid'] = 'frontend/Service/subcategorybycatid';
$route['select-package'] = 'frontend/Order/selectPackage';
$route['quickView'] = 'frontend/Service/quickView'; 
$route['packageView'] = 'frontend/Service/packageView'; 


$route['select-vehicle'] = 'frontend/order/selectVehicle'; 
$route['add-vehical'] = 'frontend/order/addVehicle';  
$route['edit-vehical'] = 'frontend/order/editVehicle'; 
$route['setVehical'] = 'frontend/Order/setVehical'; 
$route['my-packages'] = 'frontend/Service/MyPackages';
$route['setdata'] = 'frontend/Service/setData';
$route['booking/profileorder'] = 'frontend/Home/notFirstOrder';
$route['book-service'] = 'frontend/Service/bookService';
$route['getmorepack'] = 'frontend/Service/getMore';
$route['frontend/getquote'] = 'frontend/Home/getQuote';
$route['frontend/b2bgetquote'] = 'frontend/Home/B2BgetQuote';
$route['bulk-booking'] = 'frontend/Home/Bulkbooking'; 

$route['doc-wallet'] = 'frontend/MyProfile/Docwallet';
$route['other-doc'] = 'frontend/MyProfile/OtherDoc';
$route['add-license'] = 'frontend/order/addLicense'; 
$route['edit-license'] = 'frontend/order/editLicense';
$route['delete_license_by_id'] = 'frontend/order/delete_license_by_id'; 
$route['add-vehicle-rc'] = 'frontend/order/addVehicleRC';  
$route['edit-rc'] = 'frontend/order/editVehicleRC'; 
$route['delete_rc_by_id'] = 'frontend/order/delete_rc_by_id'; 
$route['add-insurance'] = 'frontend/order/addInsurance';   
$route['edit-insurance'] = 'frontend/order/editInsurance';
$route['delete_insurance_by_id'] = 'frontend/order/delete_insurance_by_id'; 
$route['add-puc'] = 'frontend/order/addPuc';   
$route['edit-puc'] = 'frontend/order/editPuc';  
$route['delete_puc_by_id'] = 'frontend/order/delete_puc_by_id'; 
$route['add-other-documents'] = 'frontend/order/addOtherDocuments';
$route['edit-other-documents'] = 'frontend/order/editOtherDocuments';
$route['delete_other_doc_by_id'] = 'frontend/order/delete_other_doc_by_id';

$route['get_vehicle_doc'] = 'frontend/order/get_vehicle_doc';
$route['get_vehicle_all_doc'] = 'frontend/order/get_vehicle_all_doc';


$route['mloyal/get_points_validation_info'] = 'frontend/Mloyal/get_points_validation_info';
$route['mloyal/insert_customer_registration_action'] = 'frontend/Mloyal/insert_customer_registration_action';
$route['mloyal/redeem_loyalty_points_action'] = 'frontend/Mloyal/redeem_loyalty_points_action';
$route['mloyal/reverse_points'] = 'frontend/Mloyal/reverse_points'; 
$route['mloyal/get_customer_trans_info'] = 'frontend/Mloyal/get_customer_trans_info';

/********************** booking-flow routes end *****************/ 

/********************** frontend for serviceon start by kunal ***********/

$route['login'] = 'frontend/Login/serviceOnlogin';
$route['verify-otp'] = 'frontend/Login/serviceOnverifyotp';
$route['my-profile/(:any)'] = 'frontend/MyProfile/myprofile/$1';
$route['user/([0-9]+)'] = 'frontend/MyProfile/user/$1';
$route['offers'] = 'frontend/Home/offers';
$route['terms-and-conditions'] = 'frontend/Home/tandc';
$route['garage-list'] = 'frontend/Home';
$route['garage-list/(:any)/(:any)/(:any)/(:any)'] = 'frontend/Vendor/garage_list/$1/$2/$3/$4';
$route['vendor/searched'] = 'frontend/Vendor/search';
$route['garage-details/(:any)/(:any)/(:any)'] = 'frontend/Vendor/garage_dashboard/$1/$2/$3';
$route['booking-confirm'] = 'frontend/Vendor/booking_confirm';
$route['booking-received'] = 'frontend/Home/booking_received';
$route['order-details/(:any)'] = 'frontend/Order/fetch_order/$1';
$route['track-order/(:any)'] = 'frontend/Order/track_order/$1';
$route['contact-us'] = 'frontend/Home/contactus';
$route['FAQ'] = 'frontend/Home/faq';
$route['Privacy-Policy'] = 'frontend/Home/privacypolicy';
$route['about-us'] = 'frontend/Home/aboutus';

$route['get_vendor_list'] = 'frontend/Vendor/getVendorsListByName';
$route['getModelsByBrandsID'] = 'frontend/Vendor/getModelsByBrandsID';


$route['getModalViews'] = 'frontend/Vendor/getModalViews';
$route['getAddressTBL'] = 'frontend/Vendor/getAddressTBL';
$route['edit-address'] = 'frontend/Vendor/editUserAddress';
$route['delete-address'] = 'frontend/Vendor/deleteUserAddress';

$route['get_statelist'] = 'frontend/Vendor/get_statelist';
$route['get_citylist'] = 'frontend/Vendor/get_citylist';

$route['address_submit'] = 'frontend/Vendor/address_submit';
$route['set_isPrimary_address'] = 'frontend/Vendor/set_isPrimary_address';
$route['deleteSelectedServiceGroup'] = 'frontend/Vendor/deleteSelectedServiceGroup';
$route['savepaymd'] = 'frontend/Vendor/savePayMode';
$route['setPickupslot'] = 'frontend/Vendor/setPickupslot';
$route['getVehicleTBL'] = 'frontend/Vendor/getVehicleTBL';

$route['set_isPrimary_vehicle'] = 'frontend/MyProfile/set_isPrimary_vehicle';
$route['get_login_view'] = 'frontend/MyProfile/get_login_view';
$route['get_mobile_verify_view'] = 'frontend/MyProfile/get_mobile_verify_view';
$route['send_otp_verify_mobile'] = 'frontend/MyProfile/sendOtpVerifyMobile';
$route['update_mobile'] = 'frontend/MyProfile/updateMobile';
$route['profile_update'] = 'frontend/MyProfile/profile_update';
$route['add_vehicle'] = 'frontend/MyProfile/addNewVehicle';
$route['update_vehical'] = 'frontend/MyProfile/updateVehical';
$route['get-models-by-brandId'] = 'frontend/MyProfile/getModelsByBrandsID';
$route['delete_vehical'] = 'frontend/MyProfile/deleteVehical';
$route['save_digidocs'] = 'frontend/MyProfile/submit_digidocs';
$route['delete_digidocs'] = 'frontend/MyProfile/delete_digidocs';
$route['update_digidocs'] = 'frontend/MyProfile/update_digidocs';

// payment gateway for ride payment
$route['submit_order'] = 'frontend/Order/submit_order';
$route['ride_payment'] = 'frontend/Order/ride_payment';
$route['ride-payment-confirm'] = 'frontend/Order/ridePaymentConfirm';
$route['ride_paymentresponse'] = 'frontend/Order/ridePaymentResponse';
$route['ride_payment_status'] = 'frontend/Order/ridePaymentStatus';

$route['order_tracking'] = 'frontend/Order/order_tracking';
$route['order/confirm_estimate'] = 'frontend/MyProfile/updateServices';

/********************** frontend for serviceon end by kunal ***********/
/********************** backend for serviceon start by kunal ***********/

$route['admin/staticservicegroup/new'] = 'backend/service/newStaticServiceGroup';
$route['admin/staticservicegroup/add'] = 'backend/service/addStaticServiceGroup';
$route['admin/staticservicegroup/list'] = 'backend/service/getStaticServiceGroupList';
$route['admin/staticservicegroup/edit/([0-9]+)'] = 'backend/service/editStaticServiceGroup/$1';
$route['admin/staticservicegroup/update'] = 'backend/service/updateStaticServiceGroup';

$route['admin/order/getvendorlist'] = 'backend/Order/getVendorList';

$route['admin/rider/list'] = 'backend/Rider/getRiderList';
$route['admin/rider/new'] = 'backend/Rider/newRider';
$route['admin/rider/add'] = 'backend/Rider/addRider';
$route['admin/rider/edit/([0-9]+)'] = 'backend/Rider/editRider/$1';
$route['admin/rider/cash_collection_list'] = 'backend/Rider/cashCollectionList';
$route['save_received_amt_by_rider'] = 'backend/Rider/saveReceivedAmtByRider';
$route['rider_billing'] = 'backend/Rider/rider_billing';

$route['admin/profit_rider'] = 'backend/Rider_Profit/index';
$route['admin/profit/addinvoice_rider'] = 'backend/Rider_Profit/addinvoice';
$route['admin/profit/pending_rider'] = 'backend/Rider_Profit/pending';
$route['admin/profit/addpaid_rider'] = 'backend/Rider_Profit/addpaid';
$route['admin/profit/paid_rider'] = 'backend/Rider_Profit/paid';


$route['admin/order/getriderlist/([0-9]+)'] = 'backend/Order/getRiderList/$1';
$route['admin/order/assignrider/([0-9]+)'] = 'backend/Order/assignRider/$1';






/********************** backend for serviceon end by kunal ***********/

/* *********** Backend Routes ********** */
$route['admin'] = 'backend/login';
$route['admin/dashboard'] = 'backend/login/dashboard';
$route['admin/logout'] = 'backend/login/logout';
$route['admin/login'] = 'backend/login/adminlogin';
$route['admin/users'] = 'backend/Login/userList';

$route['admin/vendor/list'] = 'backend/Vendor';

$route['admin/vendor/list_trial'] = 'backend/Vendor/Trial';
$route['admin/vendor/new'] = 'backend/Vendor/newRestaurant';
$route['admin/vendor/new1'] = 'backend/Vendor/newRestaurant1';
$route['admin/vendor/add'] = 'backend/Vendor/addRestaurant';
$route['admin/vendor/updateVen'] = 'backend/Vendor/updateVen';
$route['admin/vendor/edit/([0-9]+)'] = 'backend/Vendor/editRestaurant/$1';
$route['admin/vendor/VendorEdit_trial/([0-9]+)'] = 'backend/Vendor/editRestaurant_trial/$1';
$route['admin/vendor/updatebasic'] = 'backend/Vendor/updateRestaurantBasicInfo';
$route['admin/vendor/updatebilling'] = 'backend/Vendor/updateRestaurantBillingInfo';
$route['admin/vendor/verify/([0-9]+)'] = 'backend/Vendor/verifyRestaurant/$1';
$route['admin/vendor/madelive/([0-9]+)'] = 'backend/Vendor/makeRestaurantLive/$1';
$route['admin/vendor/getgeofance/([0-9]+)'] = 'backend/Vendor/getgeofance/$1';
$route['admin/vendor/promoteList'] = 'backend/Vendor/promoteRestaurantList';
$route['admin/vendor/promote'] = 'backend/Vendor/promote';
$route['admin/vendor/promoteUpdate'] = 'backend/Vendor/promoteUpdate';
$route['admin/vendor/turnonpromotedresto'] = 'backend/Vendor/turnonPromotedResto';
$route['admin/vendor/turnoffpromotedresto'] = 'backend/Vendor/turnoffPromotedResto';
$route['admin/vendor/searchpromotedrestaurant'] = 'backend/Vendor/searchPromotedRestro';
$route['admin/vendor/turnoffresto'] = 'backend/Vendor/turnOffResto';
$route['admin/vendor/turnonresto'] = 'backend/Vendor/turnOnResto';
$route['admin/vendor/updatedelivery'] = 'backend/Vendor/updateVendorDeliveryInfo';
$route['admin/vendor/updatevendorarea'] = 'backend/Vendor/updateVendorArea';

$route['admin/mainservice'] = 'backend/service/service';
//$route['admin/category/list'] = 'backend/service/listCategory';
$route['admin/category/new'] = 'backend/service/newCategory';
$route['admin/category/add'] = 'backend/service/addCategory';
$route['admin/category/list'] = 'backend/service/getCategoryList';
$route['admin/category/edit'] = 'backend/service/editCategory';
$route['admin/category/update'] = 'backend/service/updateCategory';
//$route['admin/subcategory/list'] = 'backend/service/listCategory';
$route['admin/subcategorybycatid'] = 'backend/service/subcategorybycatid';
$route['admin/subcategorybycatid2'] = 'backend/service/subcategorybycatid2';
$route['admin/subcategorybycatid_3'] = 'backend/service/subcategorybycatid3';
$route['admin/servicebycatid'] = 'backend/service/servicebycatid';
$route['admin/servicebycatid1'] = 'backend/service/servicebycatid1';
$route['admin/servicebycatid3'] = 'backend/service/servicebycatid3';
$route['admin/getservicesbysubcat'] = 'backend/service/getservicesbysubcat';

$route['servicebycatid2'] = 'backend/service/servicebycatid2';
$route['admin/servicebyid'] = 'backend/service/servicebyid';
$route['admin/brandbycatid'] = 'backend/service/brandbycatid';
$route['admin/modelbybrandid'] = 'backend/service/modelbybrandid';
$route['admin/modelbybrandid1'] = 'backend/service/modelbybrandid1';
$route['admin/getmodelsbybrid'] = 'backend/service/getmodelsbybrid';

$route['admin/catsubcatbyid'] = 'backend/service/catsubcatbyid';
$route['admin/catsubcatbyid1'] = 'backend/service/catsubcatbyid1';
$route['admin/subcategory/new'] = 'backend/service/newSubCategory';
$route['admin/subcategory/add'] = 'backend/service/addSubCategory';
$route['admin/subcategory/list'] = 'backend/service/getSubCategoryList';
$route['admin/subcategory/edit'] = 'backend/service/editSubCategory';
$route['admin/subcategory/update'] = 'backend/service/updateSubCategory';
$route['admin/service/new/([0-9]+)'] = 'backend/service/newService/$1';
$route['admin/service/add'] = 'backend/service/addService';
$route['admin/service/list'] = 'backend/service/getService';
$route['admin/service/edit'] = 'backend/service/editServices';
$route['admin/service/update'] = 'backend/service/updateService';
$route['admin/catsubcat/new'] = 'backend/service/newCatsubcat';
$route['admin/catsubcat/add'] = 'backend/service/addCatsubcat';
$route['admin/catsubcat/list'] = 'backend/service/getCatsubcat';
$route['admin/catsubcat/edit'] = 'backend/service/editCatsubcat';
$route['admin/catsubcat/update'] = 'backend/service/updateCatsubcat';
$route['admin/model/new'] = 'backend/service/newModel';
$route['admin/model/add'] = 'backend/service/addModel';
$route['admin/model/list'] = 'backend/service/getModelList';
$route['admin/model/edit'] = 'backend/service/editModel';
$route['admin/model/update'] = 'backend/service/updateModel';
$route['admin/brand/new'] = 'backend/service/newBrand';
$route['admin/brand/add'] = 'backend/service/addBrand';
$route['admin/brand/list'] = 'backend/service/getBrandList';
$route['admin/brand/edit'] = 'backend/service/editBrand';
$route['admin/brand/update'] = 'backend/service/updateBrand';
$route['admin/spare/new/([0-9]+)'] = 'backend/service/newSpare/$1';
$route['admin/spare/add'] = 'backend/service/addSpare';
$route['admin/spare/list'] = 'backend/service/getSpare';
$route['admin/spare/edit'] = 'backend/service/editSpare';
$route['admin/spare/update'] = 'backend/service/updateSpare';

$route['admin/staticsubcategory/new'] = 'backend/service/newstaticSubCategory';
$route['admin/staticsubcategory/add'] = 'backend/service/addstaticSubCategory';
$route['admin/staticsubcategory/list'] = 'backend/service/getstaticSubCategoryList';
$route['admin/staticsubcategory/edit/([0-9]+)'] = 'backend/service/editstaticSubCategory/$1';
$route['admin/staticsubcategory/update'] = 'backend/service/updatestaticSubCategory';

$route['client/mainarea'] = 'backend/area/area';
//$route['admin/category/list'] = 'backend/service/listCategory';
$route['client/city/new'] = 'backend/area/newCity';
$route['client/city/add'] = 'backend/area/addCity';
$route['client/city/list'] = 'backend/area/getCityList';
$route['client/city/edit'] = 'backend/area/editCity';
$route['client/city/update'] = 'backend/area/updateCity';
//$route['admin/subcategory/list'] = 'backend/service/listCategory';
$route['admin/zone/new'] = 'backend/area/newZone';
$route['admin/zone/add'] = 'backend/area/addZone';
$route['admin/zone/list'] = 'backend/area/getZoneList';
$route['admin/zone/edit'] = 'backend/area/editZone';
$route['admin/zone/update'] = 'backend/area/updateZone';
$route['admin/area/new/([0-9]+)'] = 'backend/area/newArea/$1';
$route['admin/area/add'] = 'backend/area/addArea';
$route['admin/area/list'] = 'backend/area/getArea';
$route['admin/area/edit'] = 'backend/area/editArea';
$route['admin/area/update'] = 'backend/area/updateArea';

$route['admin/maintimeslot'] = 'backend/timeslot/timeslot';
$route['admin/vslot/new'] = 'backend/timeslot/newVslot';
$route['admin/vslot/add'] = 'backend/timeslot/addVslot';
$route['admin/vslot/list'] = 'backend/timeslot/getVslotList';
$route['admin/vslot/edit'] = 'backend/timeslot/editVslot';
$route['admin/vslot/update'] = 'backend/timeslot/updateVslot';
$route['admin/dslot/new'] = 'backend/timeslot/newDslot';
$route['admin/dslot/add'] = 'backend/timeslot/addDslot';
$route['admin/dslot/list'] = 'backend/timeslot/getDslotList';
$route['admin/dslot/edit'] = 'backend/timeslot/editDslot';
$route['admin/dslot/update'] = 'backend/timeslot/updateDslot';

$route['admin/mainquality'] = 'backend/quality/quality';
$route['admin/parameter/new'] = 'backend/quality/newParameter';
$route['admin/parameter/add'] = 'backend/quality/addParameter';
$route['admin/parameter/list'] = 'backend/quality/getParameterList';
$route['admin/parameter/edit'] = 'backend/quality/editParameter';
$route['admin/parameter/update'] = 'backend/quality/updateParameter';
$route['admin/grade/new'] = 'backend/quality/newGrade';
$route['admin/grade/add'] = 'backend/quality/addGrade';
$route['admin/grade/list'] = 'backend/quality/getGrade';
$route['admin/grade/edit'] = 'backend/quality/editGrade';
$route['admin/grade/update'] = 'backend/quality/updateGrade';

$route['admin/mainemp'] = 'backend/employee/employee';
$route['admin/role/new'] = 'backend/employee/newRole';
$route['admin/role/add'] = 'backend/employee/addRole';
$route['admin/role/list'] = 'backend/employee/getRoleList';
$route['admin/role/edit'] = 'backend/employee/editRole';
$route['admin/role/update'] = 'backend/employee/updateRole';
$route['admin/emp/new'] = 'backend/employee/newEmp';
$route['admin/emp/add'] = 'backend/employee/addEmp';
$route['admin/emp/list'] = 'backend/employee/getEmp';
$route['admin/emp/edit'] = 'backend/employee/editEmp';
$route['admin/emp/update'] = 'backend/employee/updateEmp';

$route['admin/customer/list'] = 'backend/employee/customerList';
$route['admin/subscription/list'] = 'backend/setting/subscriptionList';
$route['admin/notifications/list'] = 'backend/notification/notificationList'; 
$route['admin/notifications/newnotification'] = 'backend/notification/New_Notification';
$route['admin/notifications/add'] = 'backend/notification/AddNotification';

$route['admin/coupon/list'] = 'backend/coupan';
$route['admin/coupon/newCoupon'] ='backend/coupan/addCoupon';
$route['admin/coupon/addcoupon']='backend/coupan/add';
$route['admin/general/getRestro'] = 'backend/coupan/getRestro';
$route['admin/coupon/update/([0-9]+)']='backend/coupan/updateCoupon/$1';
$route['admin/coupon/update/updateCoupon']='backend/coupan/update';
$route['admin/general/restro'] = 'backend/Setting/getRestro';
$route['admin/general/getrestaurantbyarea'] = 'backend/Setting/getRestaurantByArea';
$route['admin/coupan/turnoffcoupon/([0-9]+)']='backend/coupan/turnoffcoupon/$1';
$route['admin/coupan/turnoncoupon/([0-9]+)']='backend/coupan/turnoncoupon/$1';
$route['admin/coupon/deletevendor/([0-9]+)']='backend/coupan/deleteVendor/$1';
$route['admin/coupan/statusoncoupon/([0-9]+)']='backend/coupan/statusoncoupon/$1';
$route['admin/coupan/statusoffcoupon/([0-9]+)']='backend/coupan/statusoffcoupon/$1';

$route['admin/order/new'] = 'backend/order/newOrder';

$route['admin/order/add'] = 'backend/order/addOrder';
$route['admin/user/bymobile'] = 'backend/order/getUserByMobile';
$route['admin/user/byemail'] = 'backend/order/getUserByEmail';
$route['admin/user/byname'] = 'backend/order/getUserByName';
$route['admin/user/detail/([0-9]+)'] = 'backend/order/userDetail/$1';
$route['admin/order/pendingorders'] = 'backend/order/pendingOrders';
$route['admin/order/completedorders'] = 'backend/order/completedOrders';
$route['admin/order/deliverycompletedorders'] = 'backend/order/deliveryCompletedOrders';
$route['admin/order/cancelledorders'] = 'backend/order/cancelledOrders';
$route['admin/order/pickuporders'] = 'backend/order/pickupOrders';
$route['admin/order/scheduledorders'] = 'backend/order/scheduledOrders';
$route['admin/order/deliveryorders'] = 'backend/order/deliveryOrders';
$route['admin/order/todaysorders'] = 'backend/order/todaysOrders';
$route['admin/order/todaysordersbooked'] = 'backend/order/todaysOrdersBooked';
$route['admin/order/todaysdeliveries'] = 'backend/order/todaysDeliveries';
$route['admin/order/searchorders'] = 'backend/order/searchOrders';
$route['admin/order/newinvoices'] = 'backend/order/deliveryInvoices';
$route['admin/order/view_details/([0-9]+)'] = 'backend/order/orderDetail/$1';
$route['admin/order/view_details1/([0-9]+)'] = 'backend/order/orderHistory/$1';
$route['admin/order/assignpickup/([0-9]+)'] = 'backend/order/placeOrder/$1';
$route['admin/order/assigndelivery/([0-9]+)'] = 'backend/order/assignDelivery/$1';
$route['admin/order/updateassigndelivery/([0-9]+)'] = 'backend/order/updateassigndelivery/$1';
$route['admin/order/reassignpickup/([0-9]+)'] = 'backend/order/reassignPickUp/$1';
$route['admin/order/reassigndelivery/([0-9]+)'] = 'backend/order/reassignDelivery/$1';
$route['admin/order/deliverycompleted/([0-9]+)'] = 'backend/order/deliveryCompleted/$1';
$route['admin/order/cancel/([0-9]+)'] = 'backend/order/cancelOrder/$1';
$route['admin/order/delete/([0-9]+)'] = 'backend/order/deleteOrder/$1';
$route['admin/order/updatepickupdate/([0-9]+)'] = 'backend/order/updatePickUpDate/$1';
$route['admin/order/updatepickupslot/([0-9]+)'] = 'backend/order/updatePickUpSlot/$1';
$route['admin/order/reschedulepickup/([0-9]+)'] = 'backend/order/reschedulePickUp/$1';
$route['admin/order/updatedeliverydate/([0-9]+)'] = 'backend/order/updateDeliveryDate/$1';
$route['admin/order/updatedeliveryslot/([0-9]+)'] = 'backend/order/updateDeliverySlot/$1';
$route['admin/order/rescheduledelivery/([0-9]+)'] = 'backend/order/rescheduleDelivery/$1';
$route['admin/order/updatecustomername/([0-9]+)'] = 'backend/order/updateCustomerName/$1';
$route['admin/order/updateratecard/([0-9]+)'] = 'backend/order/updateRatecard/$1';
$route['admin/order/updatecustomermobile/([0-9]+)'] = 'backend/order/updateCustomerMobile/$1';
$route['admin/order/updatecustomergst/([0-9]+)'] = 'backend/order/updateCustomerGst/$1'; 
$route['admin/order/updatecustomergstname/([0-9]+)'] = 'backend/order/updateCustomerGstname/$1';
$route['admin/order/updatecustomeremail/([0-9]+)'] = 'backend/order/updateCustomerEmail/$1';
$route['admin/order/updatecustomeraddress/([0-9]+)'] = 'backend/order/updateCustomerAddress/$1';
$route['admin/order/updatecustomerlandmark/([0-9]+)'] = 'backend/order/updateCustomerLandmark/$1';
$route['admin/order/additems'] = 'backend/order/addItems';
$route['admin/order/updateitems'] = 'backend/order/updateItems';
$route['admin/order/completed/([0-9]+)'] = 'backend/order/completeOrder/$1';
$route['admin/order/deliveryattemptedsms/([0-9]+)'] = 'backend/order/deliveryAttemptedSMS/$1';
$route['admin/order/deliverycallanssms/([0-9]+)'] = 'backend/order/deliveryCallAnsweredSMS/$1';
$route['admin/order/pickupattemptedsms/([0-9]+)'] = 'backend/order/pickupAttemptedSMS/$1';
$route['admin/order/invoice/generate/([0-9]+)'] = 'backend/order/generateInvoice/$1';
$route['admin/order/updateorderadjustment/([0-9]+)'] = 'backend/order/updateOrderAdjustment/$1';

$route['admin/order/confirmApproval/([0-9]+)'] = 'backend/order/confirmApproval/$1';
$route['admin/order/markworkCompleted/([0-9]+)'] = 'backend/order/markworkCompleted/$1';
$route['admin/order/assignedorders'] = 'backend/order/assignedOrders';
$route['admin/order/ongoingorders'] = 'backend/order/ongoingOrders';
$route['admin/order/approvalorders'] = 'backend/order/approvalOrders';
$route['admin/order/addAdminComment/([0-9]+)'] = 'backend/order/addAdminComment/$1';
$route['admin/order/add_type_into_session'] = 'backend/order/add_type_into_session';
$route['admin/order/get_services_by_group'] = 'backend/Order/get_services_by_group';
$route['admin/order/get_services_by_id'] = 'backend/Order/get_services_by_id';
$route['admin/order/get_spare_by_id'] = 'backend/Order/get_spare_by_id';
$route['admin/order/addvehicle'] = 'backend/order/AddVehicle'; 
$route['admin/user/vehicle/([0-9]+)'] = 'backend/order/Uservehicle/$1';


$route['admin/items/([0-9]+)'] = 'backend/Item/index/$1';
$route['admin/item/new'] = 'backend/Item/newItem';
$route['admin/item/edit/([0-9]+)'] = 'backend/Item/editItem/$1';
$route['admin/item/add'] = 'backend/Item/addItem';
$route['admin/item/update'] = 'backend/Item/updateItem';
$route['admin/item/turnon/([0-9]+)'] = 'backend/Item/turnOnItem/$1';
$route['admin/item/turnoff/([0-9]+)'] = 'backend/Item/turnOffItem/$1';
$route['admin/item/search/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)'] = 'backend/Item/searchItem/$1/$2/$3/$4/$5/$6';
$route['admin/item/detail/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)'] = 'backend/Item/getItem/$1/$2/$3/$4/$5/$6/$7';
$route['admin/item/category'] = 'backend/Item/getCategoryList';
$route['admin/item/category/new'] = 'backend/Item/newCategory';
$route['admin/item/category/edit/([0-9]+)'] = 'backend/Item/editCategory/$1';
$route['admin/item/category/add'] = 'backend/Item/addCategory';
$route['admin/item/category/update'] = 'backend/Item/updateCategory';
$route['admin/item/newRate'] = 'backend/Item/newRate';
$route['admin/item/newRate1/([0-9]+)'] = 'backend/Item/newRate1/$1';
$route['admin/item/newVendor'] = 'backend/Item/newVendor';
$route['admin/item/newVendor1/([0-9]+)'] = 'backend/Item/newVendor1/$1';
$route['admin/item/addRate'] = 'backend/Item/addRate';
$route['admin/item/addVendor'] = 'backend/Item/addVendor';
$route['admin/item/rateedit/([0-9]+)'] = 'backend/Item/editRate/$1';
$route['admin/item/vendoredit/([0-9]+)'] = 'backend/Item/editVendor/$1';
$route['admin/item/rateUpdate'] = 'backend/Item/rateUpdate';
$route['admin/item/vendorUpdate'] = 'backend/Item/vendorUpdate';
$route['admin/item/ratecard'] = 'backend/Item/getRatecardList';
$route['admin/item/ratecard/new'] = 'backend/Item/newRatecard';
$route['admin/item/ratecard/add'] = 'backend/Item/addRatecard';
$route['admin/item/ratecard/edit/([0-9]+)'] = 'backend/Item/editRatecard/$1';
$route['admin/item/ratecard/update'] = 'backend/Item/updateRatecard';
$route['admin/item/rate/([0-9]+)'] = 'backend/Item/rateCards/$1';
$route['admin/item/rate1/([0-9]+)'] = 'backend/Item/rateCards1/$1';

$route['admin/general/tickets'] = 'backend/setting/tickets';
$route['admin/general/ticket/new'] = 'backend/setting/newTicket';
$route['admin/general/ticket/edit/([0-9]+)'] = 'backend/setting/editTicket/$1';
$route['admin/general/ticket/add'] = 'backend/setting/addTicket';
$route['admin/general/ticket/update'] = 'backend/setting/updateTicket';
$route['admin/general/ticket'] = 'backend/setting/mainTicket';
$route['admin/general/new'] = 'backend/setting/newCategory';
$route['admin/general/add'] = 'backend/setting/addCategory';
$route['admin/general/list'] = 'backend/setting/getCategoryList';
$route['admin/general/edit'] = 'backend/setting/editCategory';
$route['admin/general/update'] = 'backend/setting/updateCategory';
$route['admin/general/newsub'] = 'backend/setting/newSubCategory';
$route['admin/general/addsub'] = 'backend/setting/addSubCategory';
$route['admin/general/listsub'] = 'backend/setting/getSubCategoryList';
$route['admin/general/editsub'] = 'backend/setting/editSubCategory';
$route['admin/general/updatesub'] = 'backend/setting/updateSubCategory';
$route['admin/general/newstatus'] = 'backend/setting/newStatus';
$route['admin/general/addstatus'] = 'backend/setting/addStatus';
$route['admin/general/listatus'] = 'backend/setting/getStatus';
$route['admin/general/editstatus'] = 'backend/setting/editStatus';
$route['admin/general/updatestatus'] = 'backend/setting/updateStatus';
$route['admin/general/subcbycatid'] = 'backend/setting/subcbycatid';
$route['admin/general/view/([0-9]+)']   = 'backend/setting/viewLead/$1';
$route['admin/general/comment']   =  'backend/setting/comment';
$route['admin/general/change/priority']   =  'backend/setting/changePriority';
$route['admin/general/history/([0-9]+)']   =  'backend/setting/leadHistory/$1';
$route['admin/general/status/history/([0-9]+)']   =  'backend/setting/statusHistory/$1';
$route['admin/general/priority/history/([0-9]+)']   =  'backend/setting/priorityHistory/$1';
$route['admin/general/assign/executive']   =  'backend/setting/assignLead';
$route['admin/general/change/status']   =  'backend/setting/changeStatusLead';
$route['admin/general/change/priority']   =  'backend/setting/changePriority';

$route['admin/user/bymobile'] = 'backend/setting/getUserByMobile';
$route['admin/user/byemail'] = 'backend/setting/getUserByEmail';
$route['admin/user/byname'] = 'backend/setting/getUserByName';
$route['admin/user/detail/([0-9]+)'] = 'backend/setting/userDetail/$1';
$route['admin/details'] = 'backend/setting/detail';

$route['admin/report/users'] = 'backend/Report/getUsers';
$route['admin/report/orders'] = 'backend/Report/getOrders';
$route['admin/report/business'] = 'backend/Report/getBusinessReport';
$route['admin/report/downloadbusireport'] = 'backend/Report/downloadReport';
$route['admin/report/cashcollection'] = 'backend/Report/collectionReport';
$route['admin/report/vendor'] = 'backend/Report/getVendorReport';
$route['admin/report/vendors'] = 'backend/Report/getVendors';
$route['admin/report/vendorDetails/([0-9]+)'] = 'backend/Report/getvendorDetailReport/$1';
$route['admin/report/downloadVendorDetailsReport'] = 'backend/Report/downloadVendorDetailsReport';

$route['admin/menu/upload'] = 'backend/Menu/uploadMenu';
$route['admin/menu/import'] = 'backend/Menu/import';
$route['admin/menu/import1'] = 'backend/Menu/import1';
$route['admin/menu/import2'] = 'backend/Menu/import2';
$route['admin/menu/update/([0-9]+)'] = 'backend/Menu/updateMenu/$1';
$route['admin/menu/importupdate'] = 'backend/Menu/importUpdate';
$route['admin/menu/publish'] = 'backend/Menu/publish_menu';
$route['admin/menu/downloadcatofsubcat'] = 'backend/Menu/downloadCatofSubcat';
$route['admin/menu/downloaduptoservice/([0-9]+)'] = 'backend/Menu/downloadUptoService/$1';

$route['admin/menu/downloadCouponCodes/([0-9]+)'] = 'backend/Menu/downloadCouponCodes/$1';

$route['admin/Cron'] = 'backend/Cron/Assign';

$route['admin/mainstatus/new'] = 'backend/Service/newMainStatus';
$route['admin/mainstatus/add'] = 'backend/Service/addMainStatus';
$route['admin/mainstatus/list'] = 'backend/Service/getMainStatusList';
$route['admin/mainstatus/edit/([0-9]+)'] = 'backend/Service/editMainStatus/$1';
$route['admin/mainstatus/update'] = 'backend/Service/updateMainStatus';

$route['admin/payment_response'] = 'backend/order/paymentResponse';

$route['admin/general/reasonlist'] = 'backend/Setting/getReasonList';
$route['admin/general/newreason'] = 'backend/Setting/newReason';
$route['admin/general/addreason'] = 'backend/Setting/addReason';
$route['admin/general/editreason/([0-9]+)'] = 'backend/Setting/editReason/$1';
$route['admin/general/updatereason'] = 'backend/Setting/updateReason';
$route['admin/general/deletereason/([0-9]+)'] = 'backend/Setting/deleteReason/$1';
$route['admin/general/redeemsetting']   =  'backend/Setting/redeemsetting';
$route['admin/general/saveconfig']   =  'backend/Setting/redeemsave';

$route['admin/save_brand_csv']   =  'backend/Setting/save_brand_csv';
$route['admin/save_model_csv']   =  'backend/Setting/save_model_csv';
$route['admin/save_service_type_csv']   =  'backend/Setting/save_service_type_csv';
$route['admin/save_service_group']   =  'backend/Setting/save_service_group';
$route['admin/save_services']   =  'backend/Setting/save_services';
$route['admin/save_spare']   =  'backend/Setting/save_spare';


$route['admin/order/service/add'] = 'backend/service/addServiceFromOrder';
$route['admin/order/spare/add'] = 'backend/service/addSpareFromOrder';
$route['admin/order/approvalUpdate'] = 'backend/order/updateServices';
$route['admin/order/approvalPackageUpdate'] = 'backend/order/updatePackageServices';

$route['admin/order/getallorders'] = 'backend/order/getallorders';
$route['admin/order/getreminderusers'] = 'backend/Order/getReminderuserdata';
$route['admin/cron/getOrdersafterSixty'] = 'backend/Cron/getOrdersafterSixty';
$route['admin/profit'] = 'backend/Profit/index';
$route['admin/profit/addinvoice'] = 'backend/Profit/addinvoice';
$route['admin/profit/pending'] = 'backend/Profit/pending';
$route['admin/profit/addpaid'] = 'backend/Profit/addpaid';
$route['admin/profit/paid'] = 'backend/Profit/paid';
$route['admin/module/access-type'] = 'backend/Login/AccessType'; 

/* *********** MAHESH (B2B)********** */
$route['client'] = 'backend/clientlogin';

$route['client/dashboard'] = 'backend/clientlogin/dashboard'; 
$route['client/login'] = 'backend/clientlogin/clientlogin';
$route['client/logout'] = 'backend/clientlogin/logout'; 
$route['client/login/client_reset_password'] = 'backend/clientlogin/client_reset_password';

$route['client/addclient'] = 'backend/client/ClientAdd';
$route['client/add'] = 'backend/client/add_client';
$route['client/clientlist'] = 'backend/client/ClientList';
$route['client/editclient/([0-9]+)'] = 'backend/client/ClientEdit/$1';
$route['client/update'] = 'backend/client/update_client';
$route['client/delete_client_doc'] = 'backend/client/delete_client_doc'; 

$route['client/outlet/addoutlet'] = 'backend/outlet/OutletAdd'; 
$route['client/outlet/add'] = 'backend/outlet/add_outlet';
$route['client/outlet/edit/([0-9]+)'] = 'backend/outlet/OutletEdit/$1';
$route['client/outlet/list'] = 'backend/outlet/OutletList'; 
$route['client/outlet/update'] = 'backend/outlet/update_outlet';

$route['client/outletbyclientid'] = 'backend/outlet/outletbyclientid';

$route['client/bike/addbike'] = 'backend/bike/BikeAdd'; 
$route['client/bike/excel'] = 'backend/bike/upload_excel'; 
$route['client/bike/create'] = 'backend/bike/create_excel'; 

$route['client/bike/add'] = 'backend/bike/add_bike';
$route['client/bike/edit/([0-9]+)'] = 'backend/bike/BikeEdit/$1';
$route['client/bike/list'] = 'backend/bike/BikeList'; 
$route['client/bike/update'] = 'backend/bike/update_bike';  


$route['client/bike/byname'] = 'backend/bike/getBikesByName';
$route['client/bike/detail/([0-9]+)'] = 'backend/bike/bike_detail/$1';

$route['client/ratecard/new'] = 'backend/outlet/AddRatecard'; 
$route['client/ratecard/add'] = 'backend/outlet/add_ratecard';
$route['client/ratecard/download'] = 'backend/outlet/ratecard_download';
$route['client/ratecard/list'] = 'backend/outlet/ratecard_list';
$route['client/ratecard/edit/([0-9]+)'] = 'backend/outlet/ratecard_edit/$1';
$route['client/ratecard/update'] = 'backend/outlet/ratecard_update';
$route['client/ratecard/assign'] = 'backend/outlet/ratecard_assign';
$route['client/ratecard/get_rate_card_by_city'] = 'backend/outlet/get_rate_card_by_city';
$route['client/ratecard/add_ratecard_assign'] = 'backend/outlet/add_ratecard_assign';


$route['client/order/new'] = 'backend/Clientorder/newOrder';  
$route['client/order/add'] = 'backend/Clientorder/addClientOrder';  
$route['client/order/get_services_by_id'] = 'backend/Clientorder/get_services_by_id'; 
$route['client/order/get_vendor_by_name'] = 'backend/Clientorder/get_vendor_by_name'; 
$route['client/order/pendingorders'] = 'backend/Clientorder/pendingOrders'; 
$route['client/order/view_details/([0-9]+)'] = 'backend/Clientorder/orderDetail/$1';   
$route['client/order/assigndelivery/([0-9]+)'] = 'backend/Clientorder/assignDelivery/$1'; 
$route['client/order/assignedorders'] = 'backend/Clientorder/assignedOrders';  
$route['client/order/ongoingorders'] = 'backend/Clientorder/ongoingOrders';
$route['client/order/approvalorders'] = 'backend/Clientorder/approvalOrders'; 
$route['client/order/completedorders'] = 'backend/Clientorder/completedOrders'; 
$route['client/order/deliverycompletedorders'] = 'backend/Clientorder/deliveryCompletedOrders';
$route['client/order/cancelledorders'] = 'backend/Clientorder/cancelledOrders';
$route['client/order/approvalPackageUpdate'] = 'backend/Clientorder/approvalPackageUpdate';
$route['client/order/get_package_count'] = 'backend/Clientorder/get_package_count';
$route['client/order/generate_bulk_invoice'] = 'backend/Clientorder/generate_bulk_invoice';
$route['client/order/updateorderadjustment/([0-9]+)'] = 'backend/Clientorder/updateOrderAdjustment/$1';

$route['client/item/add_type_into_session'] = 'backend/Clientorder/add_type_into_session';
$route['client/item/search/([0-9]+)'] = 'backend/Clientorder/searchItem/$1'; 
$route['client/item/detail/([0-9]+)'] = 'backend/Clientorder/getItem/$1';
$route['client/order/additems'] = 'backend/Clientorder/additems';
$route['client/order/approvalUpdate'] = 'backend/Clientorder/service_approved';
$route['client/order/confirmApproval/([0-9]+)'] = 'backend/Clientorder/confirmApproval/$1';
$route['client/order/markworkCompleted/([0-9]+)'] = 'backend/Clientorder/markworkCompleted/$1';
$route['client/order/invoice_generate/([0-9]+)'] = 'backend/Clientorder/invoice_generate/$1';
$route['client/order/completed/([0-9]+)'] = 'backend/Clientorder/completed/$1';
$route['client/order/get_services_by_outlet_id/([0-9]+)'] = 'backend/Clientorder/get_services_by_outlet_id/$1';
$route['client/order/cancel/([0-9]+)'] = 'backend/Clientorder/cancel_order/$1';  
$route['client/order/invoices'] = 'backend/Clientorder/invoices';  
$route['client/order/get_bike_by_id'] = 'backend/Clientorder/get_bike_by_id';  
$route['client/citybyclientid'] = 'backend/outlet/citybyclientid'; 
$route['client/outletbycityid'] = 'backend/outlet/outletbycityid';
$route['client/bikesbyoutletid'] = 'backend/outlet/bikesbyoutletid';
$route['client/order/cofirm_estimate_list'] = 'backend/Clientorder/cofirm_estimate_list';
$route['client/order/confirm_estimate_view'] = 'backend/Clientorder/confirm_estimate_view';
$route['client/order/confirm_estimate_client'] = 'backend/Clientorder/confirm_estimate_client';


$route['client/package/list'] = 'backend/Clientpackage';
$route['client/package/savepackage'] = 'backend/Clientpackage/savePackage';
$route['client/package/addpackage']  = 'backend/Clientpackage/addPackage';
$route['client/package/get_services_by_serviceid']  = 'backend/Clientpackage/get_services_by_serviceid';
$route['client/package/update/([0-9]+)'] = 'backend/Clientpackage/updatePackage/$1';
$route['client/package/updatePackage'] = 'backend/Clientpackage/update';
$route['client/package/packagenameexist'] = 'backend/Clientpackage/packagenameexist'; 


$route['client/employee'] = 'backend/Clientemployee/list_employee';
$route['client/employee/new'] = 'backend/Clientemployee/new_employee';
$route['client/employee/add'] = 'backend/Clientemployee/add_employee';
$route['client/employee/edit/([0-9]+)'] = 'backend/Clientemployee/edit_employee/$1';

$route['client/role/list'] = 'backend/Clientemployee/list_role'; 
$route['client/role/add_update_role'] = 'backend/Clientemployee/add_update_role'; 
//$route['client/role/edit/([0-9]+)'] = 'backend/Clientemployee/edit_role/$1'; 
$route['client/role/edit'] = 'backend/Clientemployee/editRoleList'; 
$route['client/role/update'] = 'backend/Clientemployee/updateRole'; 

$route['client/emp/new'] = 'backend/Clientemployee/newEmpList'; 
$route['client/emp/add'] = 'backend/Clientemployee/addEmp'; 
$route['client/emp/edit'] = 'backend/Clientemployee/editEmp'; 
$route['client/emp/update'] = 'backend/Clientemployee/updateEmp'; 

$route['client/emp/checkEmplyee'] = 'backend/Clientemployee/checkEmplyee'; 


$route['admin/package/list'] = 'backend/Package';
$route['admin/package/savepackage'] = 'backend/Package/savePackage';
$route['admin/package/addpackage']  = 'backend/Package/addPackage';
$route['admin/package/get_services_by_serviceid']  = 'backend/Package/get_services_by_serviceid';
$route['admin/package/update/([0-9]+)'] = 'backend/Package/updatePackage/$1';
$route['admin/package/updatePackage'] = 'backend/Package/update';
$route['admin/package/packagenameexist'] = 'backend/Package/packagenameexist'; 


$route['admin/package/getpackagenamebymodelid'] = 'backend/Package/get_packagename_by_modelid'; 
$route['admin/package/getuserpackagebyid'] = 'backend/Package/get_userpackage_by_packageid';

$route['admin/vehicle/newvehicle'] = 'backend/vehical/New_Vehical';
$route['admin/vehicle/add'] = 'backend/vehical/AddVehical';
$route['admin/vehicle/vehiclelist'] = 'backend/vehical/VehicleList';
$route['admin/vehicle/editvehicle/([0-9]+)'] = 'backend/vehical/VehicletEdit/$1';
$route['admin/vehicle/update'] = 'backend/vehical/update_vehicle';
$route['admin/vehicle/get_vehicles_by_id'] = 'backend/vehical/get_vehicles_by_id';

$route['admin/spare/getsparelistbyparams'] = 'backend/service/getsparelistbyparams';

$route['admin/order/notFirstOrder'] = 'backend/order/notFirstOrder';

$route['admin/order/sendsms'] = 'frontend/Home/sendSMS';

$route['admin/order/sendsms'] = 'frontend/Home/sendSMS';
$route['payment_status'] = 'frontend/Home/payment_status';
$route['payment_status/B2B'] = 'frontend/Home/payment_status_b2b';

$route['facebook'] = 'frontend/social/facebook';
$route['fb_auth_redirect'] = 'frontend/social/facebook_login';
$route['google'] = 'frontend/social/google';
$route['social-mobile-otp'] = 'frontend/social/mobile_opt';
$route['social_mobile_otp_verify'] = 'frontend/social/social_mobile_otp_verify';

$route['admin/report/mechanic_log']   =  'backend/Report/mechanic_log';
$route['admin/report/download_mechanic_log']   =  'backend/Report/download_mechanic_log';
//$route['(:any)/([0-9]+)'] = 'frontend/MyProfile/VehicleDoc';







include ('routes_dipak.php');