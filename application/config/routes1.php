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
$route ['api/auth/social/login.(:any)'] = 'api/auth/Api/socialLogin/$1';
$route ['api/auth/loginwithotp.(:any)'] = 'api/auth/Api/loginwithotp/$1';
$route ['api/auth/login.(:any)'] = 'api/auth/Api/login/$1';
$route ['api/auth/signup.(:any)'] = 'api/auth/Api/signup/$1';
$route ['api/auth/verifyotp.(:any)'] = 'api/auth/Api/verifyotp/$1';
$route ['api/auth/resendotp.(:any)'] = 'api/auth/Api/resendotp/$1';
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


//service api
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
$route['updateuser'] = 'frontend/Login/updateProfile';

$route['basic-info'] = 'frontend/MyProfile/Basicinfo';
$route['refer-n-earn'] = 'frontend/MyProfile/refernearn';
$route['user/([0-9]+)'] = 'frontend/MyProfile/user/$1';
$route['wallet'] = 'frontend/MyProfile/wallet';
$route['notifications'] = 'frontend/MyProfile/Notifications';
$route['forgetPassword'] = 'frontend/Login/forgetPassword';

$route['ongoing-orders'] = 'frontend/Order/TrackOrder';
$route['order-history'] = 'frontend/Order/History'; 

/******************** booking-flow routes start *********************/  
$route['booking'] = 'frontend/Order/selectBrand'; 
$route['select-brand'] = 'frontend/Order/selectBrand';
$route['select-model'] = 'frontend/Order/selectModel';
$route['select-subcategory'] = 'frontend/Order/selectSubcategory';
$route['select-services'] = 'frontend/Order/selectServices';
$route['select-address'] = 'frontend/Order/selectAdd';   
$route['Booking-summary'] = 'frontend/Order/bookingSummary';

$route['delivery_dates'] = 'frontend/Home/getDeliveryDates'; 
$route['applycpoupon'] = 'frontend/Home/applyCoupon';
$route['booking/add'] = 'frontend/Home/addOrder'; 

//set data in session
$route['setBrand'] = 'frontend/Order/setBrand';
$route['setData'] = 'frontend/Order/setData';

$route['setModel'] = 'frontend/Order/setModel';
$route['setSub'] = 'frontend/Order/setSub'; 
$route['setCatsubcat'] = 'frontend/Order/setCatsubcat'; 

$route['select-address'] = 'frontend/Order/selectAdd';
$route['thank-you'] = 'frontend/Order/thankyou';
$route['booking-failed'] = 'frontend/Order/bookingFail'; 
$route['vendor/searched'] = 'frontend/Vendor/search'; 
/********************** booking-flow routes end *****************/ 


$route['our-services'] = 'frontend/Home/ourservices';
$route['why-us'] = 'frontend/Home/whyUs';
$route['partner-with-us'] = 'frontend/Home/partner';
$route['package'] = 'frontend/Home/package';
$route['contact-us'] = 'frontend/Home/contactus';
$route['FAQ'] = 'frontend/Home/faq';
$route['Privacy-Policy'] = 'frontend/Home/privacypolicy';
$route['refund-policy'] = 'frontend/Home/refund';
$route['cancellation-policy'] = 'frontend/Home/cancellation';
$route['enquiry-form'] = 'frontend/Home/enquiryform'; 
$route['filter/byservicename'] = 'frontend/Service/getbrandsbyName';
$route['subcategorybycatid'] = 'frontend/Service/subcategorybycatid';
$route['select-package'] = 'frontend/Order/selectPackage';
$route['quickView'] = 'frontend/Service/quickView';  

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
$route['servicebycatid2'] = 'backend/service/servicebycatid2';
$route['admin/servicebyid'] = 'backend/service/servicebyid';
$route['admin/brandbycatid'] = 'backend/service/brandbycatid';
$route['admin/modelbybrandid'] = 'backend/service/modelbybrandid';
$route['admin/modelbybrandid1'] = 'backend/service/modelbybrandid1';
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

$route['admin/items/([0-9]+)'] = 'backend/Item/index/$1';
$route['admin/item/new'] = 'backend/Item/newItem';
$route['admin/item/edit/([0-9]+)'] = 'backend/Item/editItem/$1';
$route['admin/item/add'] = 'backend/Item/addItem';
$route['admin/item/update'] = 'backend/Item/updateItem';
$route['admin/item/turnon/([0-9]+)'] = 'backend/Item/turnOnItem/$1';
$route['admin/item/turnoff/([0-9]+)'] = 'backend/Item/turnOffItem/$1';
$route['admin/item/search/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)'] = 'backend/Item/searchItem/$1/$2/$3/$4/$5';
$route['admin/item/detail/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)'] = 'backend/Item/getItem/$1/$2/$3/$4/$5/$6';
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
$route['admin/menu/downloaduptoservice'] = 'backend/Menu/downloadUptoService';

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

$route['admin/order/service/add'] = 'backend/service/addServiceFromOrder';
$route['admin/order/spare/add'] = 'backend/service/addSpareFromOrder';
$route['admin/order/approvalUpdate'] = 'backend/order/updateServices';

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
$route['client/order/get_bike_by_id'] = 'backend/Clientorder/get_bike_by_id';
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

$route['client/citybyclientid'] = 'backend/outlet/citybyclientid'; 
$route['client/outletbycityid'] = 'backend/outlet/outletbycityid';
$route['client/bikesbyoutletid'] = 'backend/outlet/bikesbyoutletid';

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

 










