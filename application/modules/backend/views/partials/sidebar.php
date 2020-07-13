<!-- Left navbar-header --> 
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
			  <?php //print_r($adminsession); 
			        //print_r($_SESSION ['useracces']);
			        //echo $_SESSION ['useracces'][0]['access_type'];
					// echo $_SESSION ['adminsession']['first_name']; ?>
                    

                    <?php $ACCESS_CONTROL = $this->session->userdata['access']; 
                            // client level
                            // 1 - all access (Super admin)
                            // 2 - Client
                            // FALSE - B2C (No access)
                            
                         if($_SESSION['adminsession']['user_role'] == 1 && $_SESSION['adminsession']['is_client'] == 0) {
                             $CLIENT = 1;
                         } else if($_SESSION['adminsession']['is_client'] == 1) {
                             $CLIENT = 2;
                         } else {
                             $CLIENT = FALSE;
                         }
                    ?>


                    <div class="user-profile">
                        <div class="dropdown user-pro-body">
                           <div><img src="<?php echo asset_url();?>backend/images/users/varun.png" alt="user-img"  style="width: 130px;"></div>  
                           <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION ['adminsession']['first_name'] . ' ' . $_SESSION ['adminsession']['last_name']; ?> <span class="caret"></span></a>
                           <ul class="dropdown-menu animated flipInY"> 
                            <li><a href="<?php echo base_url();?>admin/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                          </span> 
                      </div> 
                  </li> 
                  <?php if($CLIENT == FALSE || $CLIENT == 1) { ?>
                  <li><a href="<?php echo base_url();?>admin/dashboard" class="waves-effect"><i class="fa fa-desktop"></i> <span class="hide-menu"> Dashboard</span></a></li>
                  <?php } if($CLIENT) { ?> 
                  
                  <!-- <li><a href="#" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu"> B2B <span class="fa arrow"></span><span class="label label-rouded label-custom pull-right"></span></span></a>
                      <ul class="nav nav-second-level"> 
                        <li><a href="<?php echo base_url();?>client/dashboard" class="waves-effect"><i class="fa fa-desktop"></i> <span class="hide-menu"> Dashboard</span></a></li>
                        <?php if($CLIENT == 1) {?>
                            <li> <a href="<?php echo base_url()?>client/clientlist">Manage Clients</a> </li>
                        <?php } if($ACCESS_CONTROL[4] == 1) {?>
                            <li> <a href="<?php echo base_url()?>client/outlet/list">Manage Outlets</a> </li>
                        <?php } if($ACCESS_CONTROL[5] == 1) {?>
                            <li> <a href="<?php echo base_url()?>client/mainarea">Manage City</a> </li> 
                        <?php } if($ACCESS_CONTROL[10] == 1) {?>  
                          <li> <a href="<?php echo base_url()?>client/bike/list">Manage Bike</a> </li>  
                        <?php } if($ACCESS_CONTROL[6] == 1) {?>
                            <li> <a href="<?php echo base_url()?>client/ratecard/list">Manage Rate Card</a> </li>
                        <?php } if($ACCESS_CONTROL[7] == 1) {?>
                            <li> <a href="<?= base_url()?>client/ratecard/assign">Assign Rate Card</a>  </li> 
                        <?php } if($ACCESS_CONTROL[11] == 1) {?>
                            <li><a href="<?= base_url()?>client/package/list">Manage Package</a> </li>  
                        <?php }  if($ACCESS_CONTROL[8] == 1) {?>
                            <li><a href="<?= base_url()?>client/employee">Manage Employee</a> </li>  
                        <?php } if($ACCESS_CONTROL[1] == 1) {?>  
                        <li> <a href="javascript:void(0)" class="waves-effect">Orders<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <?php  if($ACCESS_CONTROL[1] == 1) {?>
                                    <li><a href="<?php echo base_url() ?>client/order/new">Book New Order</a></li> 
                                    <li><a href="<?php echo base_url() ?>client/order/cofirm_estimate_list"> Cofirm Estimate List</a></li> 
                            <?php } if($CLIENT == 1) {?>
                                    <li> <a href="<?php echo base_url()?>client/order/pendingorders">New Orders</a> </li> 
                                    <li> <a href="<?php echo base_url()?>client/order/assignedorders">Assigned Orders</a> </li>
                                    <li> <a href="<?php echo base_url()?>client/order/ongoingorders">Ongoing Orders/Estimate Genrated</a> </li>
                                    <li> <a href="<?php echo base_url()?>client/order/approvalorders">Ongoing Orders/working</a> </li>
                                    <li> <a href="<?php echo base_url()?>client/order/completedorders">Work Completed Orders</a> </li>
                                    <li> <a href="<?php echo base_url()?>client/order/deliverycompletedorders">Delivery Completed Orders</a> </li>
                                    <li> <a href="<?php echo base_url()?>client/order/cancelledorders">Cancelled Orders</a> </li> 
                            <?php } if($ACCESS_CONTROL[1] == 1) {?>
                                    <li><a href="<?php echo base_url() ?>client/order/invoices">Order Invoices</a></li>
                            <?php }?>        
                        </ul> 
                        </li>
                        <?php }?>
                    </ul>
                  </li>  -->
                  <?php } 
                        if($CLIENT == FALSE || $CLIENT == 1) {
                        if ($this->session->adminsession['user_role'] == 1) { ?>
                   <li><a href="#" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu"> Orders <span class="fa arrow"></span><span class="label label-rouded label-custom pull-right"></span></span></a>
                      <ul class="nav nav-second-level">
                        <li class="d-none"> <a href="<?php echo base_url()?>admin/order/new">Book New Orders</a> </li>
                        <li> <a href="<?php echo base_url()?>admin/order/pendingorders">New Orders</a> </li>
                        <li> <a href="<?php echo base_url()?>admin/order/assignedorders">Assigned Orders</a> </li>
                        <li> <a href="<?php echo base_url()?>admin/order/ongoingorders">Ongoing Orders/Estimate Genrated</a> </li>
                        <li> <a href="<?php echo base_url()?>admin/order/approvalorders">Ongoing Orders/working</a> </li>
                        <li> <a href="<?php echo base_url()?>admin/order/completedorders">Work Completed Orders</a> </li>
                        <li> <a href="<?php echo base_url()?>admin/order/deliverycompletedorders">Delivery Completed Orders</a> </li>
                        <li> <a href="<?php echo base_url()?>admin/order/cancelledorders">Cancelled Orders</a> </li>
                    </ul>
                </li> 
            <?php } if ($ACCESS_CONTROL[2] != 3) {?> 
               <li> <a href="#" class="waves-effect active"><i class="ti-settings" data-icon="v"></i> <span class="hide-menu"> Settings <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right"></span></span></a>
                <ul class="nav nav-second-level">
                    <?php if($this->session->adminsession['user_role'] == 1) {?> 
                       <li> <a href="<?php echo base_url()?>admin/staticsubcategory/list">Service Type</a></li>
                       <li> <a href="<?php echo base_url()?>admin/staticservicegroup/list">Service Group</a></li>
                   <?php }?>
                   <li> <a href="<?php echo base_url()?>admin/vehicle/vehiclelist">Vehicle</a></li>
                   <li> <a href="<?php echo base_url()?>admin/mainservice">Brand & Model </a></li> 

                   <li> <a href="<?php echo base_url()?>admin/maintimeslot">Time Slots</a></li>
                   <!-- <li> <a href="<?php echo base_url()?>admin/mainquality">Quality Management</a></li> -->
                   <!--  <li> <a href="<?php echo base_url()?>admin/mainstatus/list">Status Management</a></li> -->
                   <li> <a href="<?php echo base_url()?>admin/general/reasonlist">Cancellation Reasons</a></li>
                   <!-- <li> <a href="<?php echo base_url()?>admin/general/redeemsetting">Reedom & Offer Setting</a></li> -->
                   <li> <a href="<?php echo base_url()?>admin/general/pickup">Pick up and drop</a></li>
                   <li> <a href="<?php echo base_url()?>admin/general/breakdown">Break Down</a></li>

               </ul>
           </li> 
       <?php } if ($ACCESS_CONTROL[3] != 3 ) { ?> 
      <li><a href="#" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu">Vendor <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right"></span></span></a>
          <ul class="nav nav-second-level">
            <li> <a href="<?php echo base_url()?>admin/vendor/list">Add New Vendor</a> </li>
            <!-- <li> <a href="<?php echo base_url()?>admin/vendor/list">Add New Service</a> </li>
            <li> <a href="<?php echo base_url()?>admin/vendor/list">Add New Spare</a> </li> -->  
        </ul>
      </li>
      <li><a href="#" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu">Rider Management <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right"></span></span></a>
          <ul class="nav nav-second-level">
            <li> <a href="<?php echo base_url()?>admin/rider/list">Rider</a> </li>
            <li> <a href="<?php echo base_url()?>admin/rider/cash_collection_list">Cash Collection List</a> </li>
            <!-- <li> <a href="<?php echo base_url()?>admin/vendor/list">Add New Spare</a> </li>   -->
        </ul>
      </li>
<?php } if ($ACCESS_CONTROL[4] != 3) {?> 
  <li><a href="#" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu">Marketing <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right"></span></span></a>
      <ul class="nav nav-second-level">
          <?php ?> 
          <li> <a href="<?php echo base_url()?>admin/coupon/list">Manage Coupon</a> </li>  
          <!-- <li> <a href="<?php echo base_url()?>admin/package/list">Manage Package</a> </li> -->
      </ul>
  </li>
<?php } if ($ACCESS_CONTROL[5] != 3 && false) { ?>
  <li><a href="#" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu">Ticket <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right"></span></span></a>
      <ul class="nav nav-second-level"> 
        <li> <a href="<?php echo base_url()?>admin/general/ticket">Manage Category/Subcategory</a>  </li>  
        <li> <a href="<?php echo base_url()?>admin/general/tickets">Manage Ticket</a> </li> 
    </ul>
</li>
<?php } if ($ACCESS_CONTROL[6] != 3) { ?> 
  <li><a href="#" class="waves-effect active"><i class="fa fa-registered"></i><span class="hide-menu">Reports<span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right"></span></span></a>
      <ul class="nav nav-second-level">
        <li> <a href="<?php echo base_url()?>admin/report/business">Booking Report</a> </li>
        <li> <a href="<?php echo base_url()?>admin/report/vendor">Customer Report</a> </li>
        <li> <a href="<?php echo base_url()?>admin/report/mechanic_log">Service/Mechanic Log</a> </li>
    </ul>
</li>
<?php if ($_SESSION ['adminsession']['user_role'] == 1) { ?>
<li><a href="#" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu">Vendor Invoice<span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right"></span></span></a>
    <ul class="nav nav-second-level">
        <li> <a href="<?php echo base_url() ?>admin/profit">Generate Invoice</a> </li>
        <li> <a href="<?php echo base_url() ?>admin/profit/pending">Pending Invoice</a> </li>
        <li> <a href="<?php echo base_url() ?>admin/profit/paid">Paid Invoice</a> </li>
        <!--     <li> <a href="#">Manage Ticket</a> </li> -->
    </ul>
</li>
<?php }?>
<?php if ($_SESSION ['adminsession']['user_role'] == 1) { ?>
<li><a href="#" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu">Rider Invoice<span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right"></span></span></a>
    <ul class="nav nav-second-level">
        <li> <a href="<?php echo base_url() ?>admin/profit_rider">Generate Invoice</a> </li>
        <li> <a href="<?php echo base_url() ?>admin/profit/pending_rider">Pending Invoice</a> </li>
        <li> <a href="<?php echo base_url() ?>admin/profit/paid_rider">Paid Invoice</a> </li>
        <!--     <li> <a href="#">Manage Ticket</a> </li> -->
    </ul>
</li>
<?php }?>
<?php } if ($ACCESS_CONTROL[7] != 3) {?> 
   <li><a href="<?php echo base_url()?>admin/customer/list" class="waves-effect active"><i class="fa fa-users"></i><span class="hide-menu"> Customers </span></a></li>
   <li><a href="<?php echo base_url()?>admin/subscription/list" class="waves-effect active"><i class="fa fa-users"></i><span class="hide-menu"> Subscribers  </span></a></li>
   <li><a href="<?php echo base_url()?>admin/notifications/list" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu">Bulk Notifications </span></a></li>

<?php } if($this->session->adminsession['user_role'] == 1) {?> 
   <li><a href="<?php echo base_url()?>admin/mainemp" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu">Employee </span></a></li>
                        <?php } }?>  

   <li><a href="<?php echo base_url()?>admin/riderleads" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu">Rider Leads </span></a></li>
   <li><a href="<?php echo base_url()?>admin/partnerleads" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu">Partner Leads </span></a></li>

<li><a href="<?php echo base_url();?>admin/logout" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li> 
</ul>
</div>
</div>
        <!-- Left navbar-header end -->