<link href="<?php echo base_url(); ?>assets/css/datepicker3.css" rel="stylesheet" type="text/css">

<style>
    <!--
    .btn-plus{
        margin:5px 0px;
    }
    .panel-body> div[class^="col-sm-"], div[class*=" col-sm-"] {
        padding-bottom:5px;
    }
    .modal-header {
        background-color:#337ab7;
        color:#fff;
    }
    .datepicker-dropdown {
        z-index:1050 !important;
    }
    #customer_name_edit {
        width:200px;
    }
    #customer_email_edit {
        width:200px;
    }
    -->
    .m1
    {
        max-width:800px;
        margin:60px auto;
    }

    .pqr
    {
        width:90%;
        margin-bottom:0;
    }

    .itemname
    {
        max-width:102% !important;
        width:102% !important;
    }

    .dropdown-menu li > a {
        font-size: 14px !important;
        width: 300px !important;
    }
    .typeahead{
        width: 300px !important;
    }
    .readonly-ctrl{
        background-color: #fff !important;
    }
</style>
<div id="page-wrapper" style="padding:5px 16px;">
    <div class="row">
        <div class="col-lg-7" style="padding:0px 5px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Order Details</b>
                    <!--<a href="" role="button" class="btn" data-toggle="modal" style="margin-top: 5px;margin-left:342px;" onclick="openInNewTab('<?php echo base_url(); ?>admin/order/view_details1/<?php echo $order['order_id']; ?>');">Profile History</a>-->
                </div>
               	<div class="panel-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <b>ORDER ID</b>
                        </div>
                        <div class="col-sm-7">
                            <?php echo $order['order_id']; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <b>ORDER CODE</b>
                        </div>
                        <div class="col-sm-7">
                            <?php echo $order['ordercode']; ?>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-5">
                            <b>Client Name</b>
                        </div>
                        <div class="col-sm-7">
                            <span id="customer_name_lbl"><?php echo $order['first_name'].$order['last_name']; ?> &nbsp;</span> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <b>Client Email</b>
                        </div>
                        <div class="col-sm-7">
                            <span id="customer_email_lbl"><?php echo $order['poc_email']; ?> &nbsp; </span> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <b>Client Mobile</b>
                        </div>
                        <div class="col-sm-7">
                            <span id="customer_mobile_lbl"><?php echo $order['poc_mob']; ?> &nbsp; </span> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <b>Outlet Name</b>
                        </div>
                        <div class="col-sm-7">
                            <span id="outlet_name_lbl"><?php echo $order['outlet_name']; ?> &nbsp; </span> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <b>Outlet Email</b>
                        </div>
                        <div class="col-sm-7">
                            <span id="customer_email_lbl"><?php echo $order['manager_email']; ?> &nbsp; </span> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <b>Outlet Mobile</b>
                        </div>
                        <div class="col-sm-7">
                            <span id="customer_mobile_lbl"><?php echo $order['manager_mobile']; ?> &nbsp; </span> 
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-5">
                            <b>City</b>
                        </div>

                        <div class="col-sm-7">
                            <span id="customer_address_lbl"><?php echo $order['name']; ?> &nbsp; </span> 
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-sm-5">
                            <b>Bike Name</b>
                        </div>
                        <div class="col-sm-7">
                            <?php echo $order['bike_name']; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <b>Bike Number</b>
                        </div>
                        <div class="col-sm-7">
                            <?php echo $order['bike_number']; ?>
                        </div>
                    </div> 
                    <?php if($order['package_id'] != 0) { ?>
                    <div class="row" id="package_lbl"> 
                            <div class="col-sm-5">
                                <b>Package Name</b>
                            </div>
                            <div class="col-sm-7">
                                <?php echo $package[0]['package_name']; ?>
                            </div> 
                    </div> 
                    <div class="row" id="package_lbl"> 
                            <div class="col-sm-5">
                                <b>Package Price (By client config)</b>
                            </div>
                            <div class="col-sm-7">
                                <?php echo $order['package_price']; ?>
                            </div> 
                    </div> 
                    <div class="row" id="package_lbl"> 
                            <div class="col-sm-5">
                                <b>Package Used  Order Count</b>
                            </div>
                            <div class="col-sm-7">
                                <?= count(explode(",", $package[0]['order_ids'])); ?>
                            </div> 
                    </div> 
                    <div class="row" id="package_lbl"> 
                            <div class="col-sm-5">
                                <b> Package Remaining Order Count</b>
                            </div>
                            <div class="col-sm-7">
                                <?= $package[0]['remaining_service_count']; ?>
                            </div> 
                    </div> 
                    <div class="row" id="package_lbl"> 
                            <div class="col-sm-5">
                                <b>Package Invoice</b>
                            </div>
                            <div class="col-sm-7">
                                <a href="<?php echo base_url().$package[0]['invoice_url']; ?>" target="__blank"> Click here</a>
                            </div> 
                    </div> 
                    
                    <?php }?>
                </div>
                <?php if($order['package_id'] != 0 && empty($tbl_booking_packges)) {?> 

                    <div class="panel panel-default">  
                        <form action="" method="post" name="PackageUpdate" id="PackageUpdate" >
                            <div class="panel-heading">
                                <b>Select Package Items</b> 
                            </div>
                            <div class="panel-body" style="padding:1px;">
                                <div class="row col-sm-12" style="padding:0px 0px;margin-left: 0;"> 
                                    <div class="col-sm-2" style="background-color:#f5f5f5;padding:5px;padding-left:15px;"><b>Action</b></div> 
                                    <div class="col-sm-3" style="background-color:#f5f5f5;padding:5px;"><b>Service Name</b></div>
                                    <div class="col-sm-2" style="background-color:#f5f5f5;padding:5px;"><b>Service Used Validity</b></div> 
                                    <div class="col-sm-2" style="background-color:#f5f5f5;padding:5px;"><b>Remaining Service Count</b></div> 
                                </div>
                                <input type="hidden" name="orderidhidden" id="orderidhidden" value="<?php echo $order['order_id']; ?>"> 
                                <input type="hidden" name="user_package_id" value="<?php echo $package[0]['id']; ?>"> 
                                <input type="hidden" name="package_id" value="<?php echo $order['package_id']; ?>"> 
                                <?php $i=1;  
                                  
                                   foreach ($packageservices as $value) { ?> 
                                    
                                    <div class="row col-sm-12" style="padding:5px 0px;margin-left: 0;font-weight:400;background-color:#f9f9f9;">
                                         <?php
                                           $checkStyle = "checked onclick=\"return false;\" "; 
                                           
                                            $remaining_service_count = $value['service_used_validity'];


                                            foreach ($servicecnt as $key2 => $row) { 
                                                if($value['service_id'] == $row['service_id']){
                                                   $remaining_service_count = $value['service_used_validity'] - $row['service_count'];
                                                }
                                            }
                                
                                         ?>
                                           
                                        <div class="col-sm-2"> 
                                            <input type="hidden" name="all_serviceid[]" value="<?php echo $value['service_id']?>">
                                           <?php if($value['service_used_validity'] != $package[0]['service_used_validity'] && $remaining_service_count != 0) { ?>
                                            <input type="hidden" name="chk_serviceid[]" value="<?php echo $value['service_id']?>">
                                            <input type="checkbox" style="text-align: center;" class="preference" name="service_use[]" value="<?php echo $value['service_id']; ?>"/>   
                                           <?php }?>
                                        </div> 
                                          <?php if($remaining_service_count == 0) {?>
                                        <input type="hidden" value="<?= $value['service_id']?>" name="remaining_zero[]">
                                          <?php }?>
                                        <div class="col-sm-3"><span style="font-weight:500;"><?php echo $value['servicename'];  ?></span><br> 
                                             </div>  
                                        
                                        <div class="col-sm-2">
                                            <?php echo $value['service_used_validity'] ;?>
                                        </div> 

                                        <div class="col-sm-1">
                                         <?php echo $remaining_service_count ; ?>
                                        </div>

                                        <div class="clearfix" style="padding-left:15px;"></div>
                                    </div> 
                                 <?php $i++; } ?>  
                                 <div class="col-sm-12" style="padding:5px 0px;">
    <?php if ($order['status'] < 4) { ?>
                                     
                                        <button type="button" class="btn btn-success" onclick="ApprovalPackageUpdate()">Save Items</button>
    <?php } ?>
                                </div>
                            </div> 
                          </form>  
                    </div> 

                 <?php  } 
                 if($order['package_id'] != 0 && !empty($tbl_booking_packges)) {?> 

                    <div class="panel panel-default">  
                       
                            <div class="panel-heading">
                                <b>Package Items</b> 
                            </div>
                            <div class="panel-body" style="padding:1px;">
                                <div class="row col-sm-12" style="padding:0px 0px;margin-left: 0;"> 
                                    <div class="col-sm-3" style="background-color:#f5f5f5;padding:5px;"><b>Sr. No</b></div>
                                    <div class="col-sm-6" style="background-color:#f5f5f5;padding:5px;"><b>Service Name</b></div>
                                    
                                </div>
                                 
                                <?php $i=1;  
                                  
                                   foreach ($tbl_booking_packges as $value) { ?> 
                                    
                                    <div class="row col-sm-12" style="padding:5px 0px;margin-left: 0;font-weight:400;background-color:#f9f9f9;">
                                        <div class="col-sm-3"><span style="font-weight:500;"><?php echo $i  ?></span><br> 
                                             </div> 
                                            
                                        <div class="col-sm-6"><span style="font-weight:500;"><?php echo $value['service_name'];  ?></span><br> 
                                             </div>  
                                        <div class="clearfix" style="padding-left:15px;"></div>
                                    </div> 
                                 <?php $i++; } ?>  
                            </div> 
                    </div>
                 
                 
                 <?php } if(!empty($items)) { ?> 
                    <div class="panel panel-default">
                        <form action="" method="post" name="approvalUpdate" id="approvalUpdate" >
                            <div class="panel-heading">
                                <b>Order Items</b> 
                                <?php if($order['status'] <= 2) {?>
                                    <div class="pull-right">
                                        <a href="#updateItemModel" role="button" data-toggle="modal">Update Items</a>
                                    </div> 
                                <?php }?>
                            </div>
                            <div class="panel-body" style="padding:1px;">
                                <div class="row col-sm-12" style="padding:0px 0px;margin-left: 0;">
                                    <div class="col-sm-3" style="background-color:#f5f5f5;padding:5px;padding-left:15px;"><b>Action</b></div>
                                    <div class="col-sm-2" style="background-color:#f5f5f5;padding:5px;"><b>Type</b></div>
                                    <div class="col-sm-3" style="background-color:#f5f5f5;padding:5px;"><b>Name</b></div>
                                    <div class="col-sm-2" style="background-color:#f5f5f5;padding:5px;"><b>Priority</b></div>
                                    <div class="col-sm-2" style="background-color:#f5f5f5;padding:5px;"><b>Total Price</b></div>
                                </div>
                                <input type="hidden" name="order_id" id="orderidhidden" value="<?php echo $order['order_id']; ?>">
                                    <?php foreach ($items as $item) { ?>
                                      <div class="row col-sm-12" style="padding:5px 0px;margin-left: 0;font-weight:400;background-color:#f9f9f9;">
                                        <input type="hidden" name="itemid[]" id="itemidhidden" value="<?php echo $item['service_id']; ?>"> 
                                        <div class="col-sm-3">
                                              <select name="is_checked[]" id="is_checked" class="">
                                                <option value="0" <?php if ($item['is_checked'] == 0) { ?> selected<?php } ?>>Waiting</option>
                                                <option value="1" <?php if ($item['is_checked'] == 1) { ?> selected<?php } ?>>Approved</option>
                                                <option value="2" <?php if ($item['is_checked'] == 2) { ?> selected<?php } ?>>Rejected</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-sm-2">
                                            <span style="font-weight:500;"><?= $item['service'] == 1 ? 'Service' : 'Spare'; ?></span>
                                            <br> 
                                        <input type="hidden" name="itemtype[]" value="<?php echo $item['service']; ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <span style="font-weight:500;"><?php echo $item['service_name']; ?></span>
                                            <br><span style="color:red"><?php if ($item['is_checked'] == 0) { ?>(waiting for approval)<?php } else if ($item['is_checked'] == 1) { ?>(Approved)<?php } else { ?>(Rejected)<?php } ?></span>  
                                        <input type="hidden" name="itemname[]" value="<?php echo $item['service_name']; ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <span style="font-weight:500;">
                                                <?= $item['priority'] == 1 ? 'High' : ($item['priority'] == 2 ? 'Medium' : 'Low')?>
                                            </span>
                                            <br> 
                                            <input type="hidden" name="priority[]" value="<?php echo $item['priority']; ?>">
                                        </div>
                                        <div class="col-sm-2"><i class="fa fa-rupee"></i> <?php echo $item['price']; ?>
                                            <input type="hidden" name="price[]" value="<?php echo $item['price']; ?>"></div>
                                        <div class="clearfix" style="padding-left:15px;"></div>
                                    </div>
                                    <?php } if($order['status'] <= 2) {?>
                                <div class="col-sm-12" style="padding:5px 0px;">
   
                                        <button type="button" class="btn btn-success" onclick="ApprovalUpdate()">Save Items</button>
    
                                </div>
                                    <?php }?>
                                <div class="col-sm-12" style="padding:5px 0px;">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-6" style="background-color: #fafafa;border-radius: 5px;padding-bottom:10px;float:right;">
                                        <br>
                                        <table cellpadding="0px" cellspacing="0px" style="width:100%;">
<!--                                            <tr>
                                                <td width="70%"><b>Order Total</b></td>
                                                <td width="30%"><i class="fa fa-rupee"></i> <?php echo $order['amount']; ?></td>
                                            </tr>-->
                                           <!--  <tr>
                                                <td width="70%"><b>Discount</b></td>
                                                <td width="30%"><i class="fa fa-rupee"></i>  </td>
                                            </tr>  -->

                                            <tr>
                                                <td width="70%"><b>Adjustments</b> &nbsp; <?php if ($order['status'] < 4) { ?><a href="#adjustModal" role="button" data-toggle="modal" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a><?php } ?></td>
                                                <td width="30%">
                                                    <i class="fa fa-rupee"></i> <?php echo $order['adjustment']; ?> 
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="70%"><b>Gross Total</b></td>
                                                <td width="30%"><i class="fa fa-rupee"></i> <?php echo ($order['amount']); ?></td>
                                            </tr> 
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                 <?php }?>
            </div>
        </div>
<?php //print_r($garage);  ?> 

     <div class="col-lg-5" style="padding:0px 5px 0px 0px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Order Actions - </b>
                    <span class="text-success"><b>
                            <?php if ($order['status'] == 0) { ?>
                                Assign Mechanic
                            <?php } else if ($order['status'] == 1) { ?>
                                Assigned For Mechanic
                            <?php } else if ($order['status'] == 2) { ?>
                                Waiting for approval
                            <?php } else if ($order['status'] == 3) { ?>
                                Work in progress
                            <?php } else if ($order['status'] == 4) { ?>
                                Work Completed
                            <?php } else if ($order['status'] == 6) { ?>
                                Invoice  generated.
                            <?php } else if ($order['status'] == 7) { ?>
                                Order Delivery Completed
                <?php } else { ?>
                                Order Cancelled
<?php } ?></b>
                    </span>
                </div>
                    <?php if (!empty($order['vendor_id'] != 0)) { ?>
                    <div class="panel-heading">
                        Order Assigned to - <?php foreach ($garage as $item) { ?>
                            <?php
                            if ($item['id'] == $order['vendor_id']) {
                                echo $item['garage_name'];
                            }
                        }
                        ?>
                    <?php if ($order['status'] < 2) { ?>
                            <a href="#updategarageModel" role="button" class="btn btn-warning" data-toggle="modal" style="margin-top: 5px;">Update Mechanic</a>
                            <?php } ?>
                    </div>
<?php } ?>
                <div class="panel-body" style="padding:10px;">
                    <div>
                        <?php if ($order['status'] == 0) { ?>
                            <a href="#deliveryModel" role="button" class="btn btn-warning" data-toggle="modal" style="margin-top: 5px;">Assign Mechanic</a>
                            &nbsp;
                            <!--<a href="#cancelModel" role="button" class="btn btn-danger" data-toggle="modal" style="margin-top: 5px;">Cancel Order</a>-->
                        <?php } else if ($order['status'] == 1) { ?>
                            <a href="#pickedupModel" role="button" class="btn btn-success" data-toggle="modal" style="margin-top: 5px;">Generate Estimate</a>
                            &nbsp;
                            <a href="javascript:ConfirmApproval(<?php echo $order['order_id']; ?>);" role="button" class="btn btn-success" style="margin-top: 5px;">Confirm Estimate</a>
                            <!--<a href="#cancelModel" role="button" class="btn btn-danger" data-toggle="modal" style="margin-top: 5px;">Cancel Order</a>-->
                        <?php } else if ($order['status'] == 2) { ?>
                            <a href="javascript:ConfirmApproval(<?php echo $order['order_id']; ?>);" role="button" class="btn btn-success" style="margin-top: 5px;">Confirm Estimate</a>
                        <?php } else if ($order['status'] == 3) { ?>
                            <a href="javascript:markworkcompleted(<?php echo $order['order_id']; ?>);" role="button" class="btn btn-success" style="margin-top: 5px;">Mark Work Completed</a>
                        <?php } else if ($order['status'] == 4) { ?>
                            <?php if ($order['invoice_status'] == 0) { ?>
                                <a href="#invoiceModal" role="button" data-toggle="modal" class="btn btn-success" style="   " e="margin-top: 5px;">Generate Invoice</a>
                            <?php } else if ($order['status'] == 6) { ?>
                                <a href="#confirmModal" role="button" data-toggle="modal" class="btn btn-success">Confirm Delivery</a>
                            <?php }  ?>
                            <!--<a href="" role="button" class="btn btn-success" data-toggle="modal" style="margin-top: 5px;">View Invoice</a>-->
                        <?php } if ($order['status'] == 6) { ?>
                                <a href="#confirmModal" role="button" data-toggle="modal" class="btn btn-success">Confirm Delivery</a>
                            <?php } else if ($order['status'] == 5) { ?>
                            Order Cancelled
                        <?php } ?>

                        

                    </div>
                    <div class="row" style="padding:10px 0px;margin-top:5px;background-color:#f2f2f2;">
                        <div class="col-sm-12">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <textarea class="form-control" name="admincomment" id="admincomment"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary" onclick="addComment(<?php echo $order['order_id']; ?>)">Add Comment</button>
                            </div>
                        </div>
<?php if (!empty($admin_comments)) { ?>
                            <div class="col-sm-12"><b><u>Comments</u></b></div>
    <?php foreach ($admin_comments as $ordercomment) { ?>
                                <div class="col-sm-12">
                                    <div class="col-md-4"><?php echo $ordercomment['comment']; ?></div>
                                    <div class="col-md-4"><?php echo date('j M Y h:i A', strtotime($ordercomment['created_datetime'])); ?></div>
                                    <div class="col-md-4"><?php echo $ordercomment['Admin_name']; ?></div>
                                </div>
                            <?php } ?>
                        <?php } ?> 
                    </div>
<?php if ($order['invoice_status'] == 1) { ?>
                        <br>
                        <div class="row" style="background-color:#f5f5f5;padding:10px 0px;margin:0px;">
                            <div class="col-sm-8">
                                <b>Invoice Date:</b> <?php echo date('j M Y', strtotime($order['invoice_date'])); ?>
                            </div>
                            <div class="col-sm-4"><a class="btn btn-sm btn-info" href="<?php echo base_url(); ?><?php echo $order['invoice_url']; ?>" target="_blank">View Invoice</a></div>
                        </div>
<?php } ?>
                    <!--    <?php if ($order['invoice_status'] == 1) { ?>
                        <?php if ($order['payment_status'] != "Credit") { ?>
                                            <br>
                                            <div class="row" style="background-color:#f5f5f5;padding:10px 0px;margin:0px;">
                                                    <div class="col-sm-4"><a class="btn btn-sm btn-warning" href="javascript:resendPaymentLink(<?php echo $order['orderid']; ?>);">Resend Payment Link</a></div>
                                            </div>
    <?php } ?>
<?php } ?>-->
                    <br>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="info">
                                    <th>Action</th>
                                    <th>Date Time</th>
                                    <th>CSE Name</th>
                                </tr>
                            </thead>
                            <tbody>
<?php foreach ($logs as $log) { ?>
                                    <tr>
                                        <td><?php echo $log['comment']; ?></td>
                                        <td><?php echo date('j M Y h:i A', strtotime($log['created_date'])); ?></td>
                                        <td><?php echo $log['csename']; ?></td>
                                    </tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div> 

        <div class="col-lg-12" style="padding:0px;">
            <!--  <div class="col-lg-7">-->
<?php if (!empty($order['image'])) { ?> <img src="<?php echo $order['image']; ?>" height="300" width="300"><?php } ?>
<?php if (!empty($order['image1'])) { ?><img src="<?php echo $order['image1']; ?>" height="300" width="300"><?php } ?>
            <!-- </div>-->
        </div>
    </div>
</div> 
<div id="pickedupModel" class="modal fade" style="">
    <div id="pickedup-overlay" class="modal-dialog m1 modal-lg" style="opacity:1 ;width:800px ">
        <div class="modal-content">
            <form action="" method="post" name="additems" id="additems" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff"> X </span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Genrate Estimate</h4>
                </div>
                <div class="modal-body" style="background-color:#f5f5f5;">
                    

                    <h3 style="margin-top:0px;">Add Services </h3>
                    <input type="hidden" name="rate_id" id="rate_id" value="<?php echo $order['rate_id']; ?>"/>
                    <input type="hidden" name="order_id" id="orderid" value="<?php echo $order['order_id']; ?>"/> 
                    
                    <div id="orderitems">
                        <div class="row" style="padding:10px 5px;background-color:#ddd;border:1px solid #ccc;">
                            <div class="row form-group pqr">
                                <div class="col-sm-3">
                                    Type
                                </div>
                                <div class="col-sm-3">
                                    Name
                                </div>
                                
                                <div class="col-sm-2">
                                    Price
                                </div>
                                <div class="col-sm-2">
                                    Priority
                                </div>
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="rcount" id="rcount" value="1"/>
                        <div class="row" style="padding:10px 5px;background-color:#f2f2f2;border-bottom:1px solid #ccc;" id="rowitem-1">
                            <div class="row form-group pqr">
                                <input type="hidden" name="itemid[]" id="itemid-1" value=""/>
                                <div class="col-sm-3">
                                    <select name="itemtype[]" required="" onchange="clear_input(this);" id="itemtype-1" class="form-control itemname">
                                        <option value="">Select Type</option>
                                        <option value="1">Service</option>
                                        <option value="2">Spare</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control itemname itemname1" name="itemname[]" id="itemName" required="" value="" placeholder="Service/Spare Name" autocomplete="off"/>
                                </div>
                                <div class="col-sm-2">
                                    <input type="hidden" name="price[]" id="price-1" value=""/>
                                    <span id="pricelbl-1" style="line-height: 30px;"></span>
                                    <!--<input type="text" class="form-control itemname readonly-ctrl" id="pricelbl-1" value="" placeholder="Rate" readonly/>-->
                                </div>
                                 <div class="col-sm-3">
                                    <select name="priority[]" id="priority-1" class="form-control itemname">
                                       
                                        <option value="1">High</option>
                                        <option value="2">Medium</option>
                                        <option value="3">Low</option>
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <a href="javascript:addMoreItems();" class="btn btn-primary pull-right">Add More Items</a>
                    <br>
                    <div id="response"></div>
                    <br>
                </div>
                <div class="modal-footer">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn-success" onclick="saveItems()">Save Items</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="updateItemModel" class="modal fade" style="">
    <div id="update-overlay" class="modal-dialog m1 modal-lg" style="opacity:1 ;width:800px ">
        <div class="modal-content">
            <form action="" method="post" name="updateitems" id="updateitems" >
                <input name="order_id" value="<?= $order['order_id']?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff"> X </span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update Order Items</h4>
                </div>
                <div class="modal-body" style="background-color:#f5f5f5;"> 
                    <div id="eorderitems">
                        <div class="row" style="padding:10px 5px;background-color:#ddd;border:1px solid #ccc;">
                            <div class="row form-group pqr">
                                <div class="col-sm-3">
                                    Type
                                </div>
                                <div class="col-sm-3">
                                    Name
                                </div>
                                
                                <div class="col-sm-2">
                                    Price
                                </div>
                                <div class="col-sm-2">
                                    Priority
                                </div>
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="ercount" id="ercount" value="<?php echo count($items); ?>"/>
                        <?php foreach ($items as $key => $item) { 
                              $readonly = $item['is_checked'] == 0 ? 'this' : 'readonly';
                              $pointer_event = $item['is_checked'] == 0 ? '' : 'pointer-events:none';
                            ?>
                            <div class="row" style="padding:10px 5px;background-color:#f2f2f2;border-bottom:1px solid #ccc;" id="erowitem-<?php echo $key; ?>">
                                <div class="row form-group pqr">
                                    <input type="hidden" name="itemid[]" id="eitemid-<?php echo $key; ?>" value="<?php echo $item['service_id']; ?>"/>
                                    <input type="hidden" name="is_checked[]" value="<?=$item['is_checked']?>">
                                    <div class="col-sm-3">
                                    <!-- <input type="checkbox" name="is_checked[]" value="<?php echo $item['is_checked']; ?>" id="eitencheck-<?php echo $key; ?>" <?php if ($item['is_checked'] == 0) { ?> <?php } else { ?>checked <?php } ?>/>-->
                                        <select  name="itemtype[]" <?=$readonly?> style="<?= $pointer_event?>" required="" onchange="clear_input(<?=$readonly?>);" id="eitemtype-<?php echo $key; ?>" class="form-control itemname">
                                            <!-- <option value=""><?php
                                                    if ($item['service'] == 1) {
                                                        echo "Service";
                                                    } else {
                                                        echo "Spare";
                                                    }
                                                    ?></option> -->
                                            <option value="1" <?php
                                                    if ($item['service'] == 1) {
                                                        echo "selected";
                                                    }
                                                    ?>>Service</option>
                                            <option value="2" <?php
                                                    if ($item['service'] == 2) {
                                                        echo "selected";
                                                    }
                                                    ?>>Spare</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" readonly="" class="form-control itemname itemname1" required="" name="itemname[]" id="eitemname-<?php echo $key; ?>" value="<?php echo $item['service_name']; ?>" placeholder="Enter Service Name" autocomplete="off"/>
                                    </div>
                                    <div class="col-sm-2">
                                        
                                        <input type="hidden" name="price[]" id="eprice-<?php echo $key; ?>" value="<?php echo $item['price']; ?>"/>
                                        <span id="epricelbl-<?php echo $key; ?>" style="line-height: 30px;">Rs. <?php echo $item['price']; ?></span>
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="priority[]" <?=$readonly?> style="<?= $pointer_event?>"  id="priority-1" class="form-control itemname">
                                            
                                            <option value="1" <?php
                                        if ($item['priority'] == 1) {
                                            echo "selected";
                                        }
                                                    ?>>High</option>
                                            <option value="2" <?php
                                    if ($item['priority'] == 2) {
                                        echo "selected";
                                    }
                                    ?>>Medium</option>
                                                        <option value="3" <?php
                                    if ($item['priority'] == 3) {
                                        echo "selected";
                                    }
                                    ?>>Low</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1">
                                    <?php if($item['is_checked'] == 0) {?> 
                                            <a href="javascript:eremoveItem(<?php echo $key; ?>);" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
                                        <?php } else if($item['is_checked'] == 1) {?>
                                            <span style="color:green">(Approved)</span>
                                            <?php } else if($item['is_checked'] == 2) {?>
                                                <span style="color:red">(Rejected)</span>
                                            <?php }?>    
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <br>
                    <a href="javascript:eaddMoreItems();" class="btn btn-primary pull-right">Add More Items</a>
                    <br>
                    <div id="uresponse"></div>
                    <br>
                </div>
                <div class="modal-footer">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn-success" onclick="updateItems()">Update Items</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 

 
 
<div id="deliveryModel" class="modal fade" style="padding-top: 86px;">
    <div id="cancel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff"> X </span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Assign Mechanic</h4>
            </div>
            <div class="modal-body" style="background-color:#f5f5f5;">
                <div class="row" style="padding:10px">
                    <div class="col-md-12">
                        <!-- <div class="form-group">
                            <label for="password" class="control-label">Mechanic</label>

                            <select name="vendor_id" id="vendor_id" class="form-control">
                                <option value=""> Select Mechanic</option>
<?php foreach ($garage as $item) { ?>
                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['garage_name']; ?></option>
<?php } ?>

                            </select>
                        </div> -->
                        <div class="form-group form-focus select-focus">
                                    <label class="control-label">Assign Mechanic<span class="c-input--danger">*</span></label>
                                    <input id="garage_name" name="garage_name" class="form-control floating" placeholder="Enter Name and select from list" autocomplete="off" type="text">   
                        </div>
                                <div class="messageContainer"></div>
                                <input type="hidden" name="vendor_id" id="vendor_id">
                    </div>
                </div>
                <div class="row" style="padding:10px">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password" class="control-label">Enter Mobile Number(Comma Separted)</label>
                            <input type="text" class="form-control" name="vendor_mobiles" id="vendor_mobiles" value="" placeholder="Enter Mobile Numbers" autocomplete="off"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary" onclick="assignGarage(<?php echo $order['order_id']; ?>)">Assign</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="updategarageModel" class="modal fade" style="padding-top: 86px;">
    <div id="cancel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff"> X </span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Assign Mechanic</h4>
            </div>
            <div class="modal-body" style="background-color:#f5f5f5;">
                <div class="row" style="padding:10px">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password" class="control-label">Mechanic</label>

                            <select name="vendor_id" id="vendor_idupdate" class="form-control">
                                <option value=""> Select Mechanic</option>
<?php foreach ($garage as $item) { ?>
                                    <option value="<?php echo $item['id']; ?>" <?php if ($item['id'] == $order['assign_vendor_id']) { ?> selected<?php } ?>><?php echo $item['garage_name']; ?></option>
<?php } ?>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding:10px">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password" class="control-label">Enter Mobile Number(Comma Separted)</label>
                            <input type="text" class="form-control" name="updatevendor_mobiles" id="updatevendor_mobiles" value="" placeholder="Enter Mobile Numbers" autocomplete="off"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary" onclick="updateassignGarage(<?php echo $order['order_id']; ?>)">Assign</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="redeliveryModel" class="modal fade" style="">
    <div id="redel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff"> X </span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Re-Assign Delivery</h4>
            </div>
            <div class="modal-body" style="background-color:#f5f5f5;">
                <div class="row" style="padding:20px">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="password" class="control-label">Select Delivery Executive</label>
                             
                        </div>
                    </div>
                </div>
                <div class="row" style="display:none;">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="password" class="control-label">Select Delivery Date</label>
                             
                        </div>
                    </div>
                </div>
                <div class="row" style="padding:20px">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="password" class="control-label">Select Delivery Slot</label>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary" onclick="reassignDelivery(<?php echo $order['order_id']; ?>)">Re-Assign Delivery</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="invoiceModal" class="modal fade" style="">
    <div id="invoice-overlay" class="modal-dialog" style="opacity:1 ;width:600px ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff"> X </span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Generate Invoice</h4>
            </div>
            <div class="modal-body" style="background-color:#fff;">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="password" class="control-label">Adjustment (Rs)</label>
                            <input type="text" name="adjustment" id="adjustment" class="form-control" value="<?php echo $order['adjustment']; ?>" readonly/> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="password" class="control-label">Grand Total</label>
                            <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $order['amount']; ?>" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary" onclick="generateInvoice(<?php echo $order['order_id']; ?>)">Generate Invoice</button>
            </div>
        </div>
    </div>
</div>
<div id="adjustModal" class="modal fade" style="">
    <div id="invoice-overlay" class="modal-dialog" style="opacity:1 ;width:600px ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff"> X </span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Adjustment</h4>
            </div>
            <div class="modal-body" style="background-color:#fff;">
                <div class="row">
                    <div class="col-md-12">
                         <div class="form-group">
                            <label for="password" class="control-label col-md-4">Add Or Deduct</label>
                            <div class="col-md-8">
                                <input type="radio" name="adj_type" id="adjadd" value="0" <?php if ($order['adjustment'] >= 0) { ?>checked<?php } ?>/> ADD
                                <input type="radio" name="adj_type" id="adjremove" value="1" <?php if ($order['adjustment'] < 0) { ?>checked<?php } ?>/> REMOVE
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password" class="control-label col-md-4">Adjustment (Rs)</label>
                            <div class=" col-md-4">
                                 <input type="text" name="iadjustment" id="iadjustment" class="form-control" value="<?php
if ($order['adjustment'] < 0) {
    echo $order['adjustment'] * -1;
} else {
    echo $order['adjustment'];
}
?>"/> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary" onclick="updateAdjustment(<?php echo $order['order_id']; ?>)">Update Adjustment</button>
            </div>
        </div>
    </div>
</div> 
<div id="confirmModal" class="modal fade" style="">
    <div id="invoice-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff"> X </span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delivery</h4>
            </div>
            <div class="modal-body" style="background-color:#fff;">
                <input type="hidden" name="final_total" id="final_total" value="<?php echo $order['amount']; ?>"/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password" class="control-label">Total Amount Received</label>
                            <input type="text" name="to_amount" id="to_amount" readonly="" class="form-control" value="<?php echo $order['amount']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password" class="control-label">Payment Mode</label>
                            <select id="cpay_mode" name="cpay_mode" class="form-control">
                                <option value="1">Online Paid</option>
                                <option value="2">Cash On Delivery</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary" onclick="confirmDelivery(<?php echo $order['order_id']; ?>)">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="cancelModel" class="modal fade" style="">
    <div id="cancel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff"> X </span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Cancel Order</h4>
            </div>
            <div class="modal-body" style="background-color:#f5f5f5;">
                <div class="row" style=padding:20px">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password" class="control-label"> Reason</label>
                             <input type="text" class="form-control" name="reason" id="reason" value="">
                        </div>
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-danger" onclick="cancelOrder(<?php echo $order['order_id']; ?>)">Cancel Order</button>
                        <span class="pull-right">
                      
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="script_res">
    </div>
<script>
var url = '';
</script>
<script src="<?php echo asset_url(); ?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script>

                            $('.datepicker').datepicker({
                                format: 'dd-mm-yyyy',
                                startDate: '0d'
                            }); 

                            function assignGarage(orderid) {
                                var a = $("#vendor_id").val();
                                var x = document.getElementById("vendor_id");
                                var txt = "";
                                var i;

                                for (i = 1; i < x.length; i++) {
                                    if (a != x.options[i].value) {
                                        txt = txt + " " + x.options[i].value + ",";
                                    }
                                }
                                if ($("#vendor_id").val() != "") {
                                    ajaxindicatorstart("Please hang on.. while we assign order ..");
                                    $.get(base_url + "client/order/assigndelivery/" + orderid, {vendor_id: $("#vendor_id").val(), other_vendor: txt, vendor_mobiles: $("#vendor_mobiles").val()}, function (data) {
                                        ajaxindicatorstop();
                                        alert(data.message);
                                        window.location.reload();
                                    }, 'json');
                                } else if ($("#vendor_id").val() == "") {
                                    alert("Please select mechanic");
                                }
                            }

                            function updateassignGarage(orderid) {
                                var a = $("#vendor_idupdate").val();
                                var x = document.getElementById("vendor_idupdate");
                                var txt = "";
                                var i;

                                for (i = 1; i < x.length; i++) {
                                    if (a != x.options[i].value) {
                                        txt = txt + " " + x.options[i].value + ",";
                                    }
                                }
                                if ($("#vendor_idupdate").val() != "") {
                                    ajaxindicatorstart("Please hang on.. while we assign order ..");
                                    $.get(base_url + "admin/order/updateassigndelivery/" + orderid, {vendor_id: $("#vendor_idupdate").val(), other_vendor: txt, vendor_mobiles: $("#updatevendor_mobiles").val()}, function (data) {
                                        ajaxindicatorstop();
                                        alert(data.message);
                                        window.location.reload();
                                    }, 'json');
                                } else if ($("#vendor_idupdate").val() == "") {
                                    alert("Please select mechanic");
                                }
                            }

                            function reassignDelivery(orderid) {
                                if ($("#rdexecutive_id").val() != "" && $("#rdelivery_slot").val() != "" && $("#rdelivery_date").val()) {
                                    ajaxindicatorstart("Please hang on.. while we re-assign order ..");
                                    $.get(base_url + "admin/order/reassigndelivery/" + orderid, {executive_id: $("#rdexecutive_id").val(), delivery_slot: $("#rdelivery_slot").val(), delivery_date: $("#rdelivery_date").val()}, function (data) {
                                        ajaxindicatorstop();
                                        alert(data.message);
                                        window.location.reload();
                                    }, 'json');
                                } else if ($("#rdexecutive_id").val() == "") {
                                    alert("Please select delivery executive");
                                } else if ($("#rdelivery_slot").val() == "") {
                                    alert("Please select delivery slot");
                                } else if ($("#rdelivery_date").val() == "") {
                                    alert("Please select delivery date");
                                } else {
                                    alert("Please select all fields");
                                }
                            }

                            function cancelOrder(orderid) {
                                if ($("#reason").val() != "") {
                                    var ans = confirm("Are you sure !! you want to cancel this order ?");
                                    if (ans) {
                                        ajaxindicatorstart("Please hang on .. while we cancel this order ..");
                                        $.get(base_url + "client/order/cancel/" + orderid, { reason: $("#reason").val()}, function (data) {
                                            ajaxindicatorstop();
                                            alert(data.message);
                                            window.location.reload();
                                        }, 'json');
                                    }
                                } else {
                                    alert("Please enter reason of cancellation.");
                                }
                            }

                            function deleteOrder(orderid) {
                                if ($("#reason_id").val() != "") {
                                    var ans = confirm("Are you sure !! you want to delete this order ?");
                                    if (ans) {
                                        ajaxindicatorstart("Please hang on .. while we delete this order ..");
                                        $.get(base_url + "admin/order/delete/" + orderid, {comment: $("#cancelcomment").val(), reason_id: $("#reason_id").val()}, function (data) {
                                            ajaxindicatorstop();
                                            alert(data.message);
                                            window.location.reload();
                                        }, 'json');
                                    }
                                } else {
                                    alert("Please select reason of deletion.");
                                }
                            }

                            function updateAdjustment(orderid) {
                                if ($("#iadjustment").val() > 0) {
                                    var adj_type = $("input[name='adj_type']:checked").val();
                                    $.post(base_url + "client/order/updateorderadjustment/" + orderid, {adj_type: adj_type, adjustment: $("#iadjustment").val()}, function (data) {
                                        ajaxindicatorstop();
                                        alert(data.msg);
                                        window.location.reload();
                                    }, 'json');
                                } else {
                                    alert("Please enter adjustment amount.");
                                }
                            }
 

                            function confirmDelivery(orderid) {
                                ajaxindicatorstart("Please hang on.. while we complete order ..");
                                $.get(base_url + "client/order/completed/" + orderid, {net_total: $("#to_amount").val(), final_total: $("#final_total").val(), pay_mode: $("#cpay_mode").val()}, function (data) {
                                    ajaxindicatorstop();
                                    alert(data.msg);
                                    window.location.reload();
                                }, 'json');
                            }

                            function requestPayment(orderid) {
                                ajaxindicatorstart("Please hang on.. while we made payment request ...");
                                $.get(base_url + "admin/order/payment_request/" + orderid, {}, function (data) {
                                    ajaxindicatorstop();
                                    alert(data.message);
                                    window.location.reload();
                                }, 'json');
                            }

                            function generateInvoice(orderid) {
                                ajaxindicatorstart("Please hang on.. while we generate invoice ..");
                                $.post(base_url + "client/order/invoice_generate/" + orderid, {discount: $("#discount").val(), adjustment: $("#adjustment").val()}, function (data) {
                                    ajaxindicatorstop();
                                    alert(data.msg);
                                    window.location.reload();
                                }, 'json');
                            }

                            function saveItems() {
                                ajaxindicatorstart("Please hang on.. while we add items ..");
                                var options = {
                                    target: '#response',
                                    beforeSubmit: showAddRequest,
                                    success: showAddResponse1,
                                    url: base_url + 'client/order/additems',
                                    semantic: true,
                                    dataType: 'json'
                                };
                                $('#additems').ajaxSubmit(options);
                            }

                            function showAddRequest(formData, jqForm, options) {
                                ajaxindicatorstop();
                                $("#response").hide();
                                var queryString = $.param(formData);
                                return true;
                            }

                            function showAddResponse1(resp, statusText, xhr, $form) {
                                debugger;
                                if (resp.status == '0') {
                                    ajaxindicatorstop();
                                    $("#response").removeClass('alert-success');
                                    $("#response").addClass('alert-danger');
                                    $("#response").html(resp.message);
                                    $("#response").show();
                                } else {
                                    ajaxindicatorstop();
                                    $("#response").removeClass('alert-danger');
                                    $("#response").addClass('alert-success');
                                    $("#response").html(resp.message);
                                    $("#response").show();
                                    alert('Order Services added successfully.');
                                    window.location.reload();
                                }
                            }

                            function updateItems() {
                                var options = {
                                    target: '#uresponse',
                                    beforeSubmit: ushowAddRequest,
                                    success: ushowAddResponse,
                                    url: base_url + 'client/order/approvalUpdate',
                                    semantic: true,
                                    dataType: 'json'
                                };
                                $('#updateitems').ajaxSubmit(options);
                                ajaxindicatorstart("Please hang on..");
                                
                            }

                            function ushowAddRequest(formData, jqForm, options) {
                                ajaxindicatorstop();
                                $("#uresponse").hide();
                                var queryString = $.param(formData);
                                return true;
                            }

                            function ushowAddResponse(resp, statusText, xhr, $form) {
                                if (resp.status == '0') {
                                    $("#uresponse").removeClass('alert-success');
                                    $("#uresponse").addClass('alert-danger');
                                    $("#uresponse").html(resp.message);
                                    $("#uresponse").show();
                                } else {
                                    $("#uresponse").removeClass('alert-danger');
                                    $("#uresponse").addClass('alert-success');
                                    $("#uresponse").html(resp.message);
                                    $("#uresponse").show();
                                    alert(resp.message);
                                    window.location.reload();
                                }
                            }

                            $("#reason_id").change(function () {
                                $("#cancelcomment").val($("#reason_id option:selected").text());
                            });
                            
                                
                            $("#itemtype-1").change(function () {
                                
                                var a = $('#itemtype-1').val(); 
                                var b = $('#rate_id').val(); 
                                url = base_url + "client/item/search/" + b ;
                                ajaxindicatorstart("Please hang on.. while we add items ..");
                                $.post(base_url + 'client/item/add_type_into_session', { a : a}, function(data){
                                  ajaxindicatorstop();  
                                }, 'JSON');
                                $("#itemName").typeahead({
                                    onSelect: function (item) {
                                        itemvalue = item.value;
                                        $.get(base_url + "client/item/detail/" + itemvalue , {}, function (result) {
                                            $("#price-1").val(result.price);
                                            $("#pricelbl-1").html("Rs. " + result.price); 
                                            $("#itemid-1").val(result.id);
                                            $('#itemName').attr('readonly', 'readonly');
                                        }, 'json');
                                    },
                                    ajax: {
                                        url: url,
                                        timeout: 500,
                                        displayField: "name",
                                        triggerLength: 1,
                                        method: "get",
                                        loadingClass: "loading-circle",
                                        preDispatch: function (query) {
                                            return {
                                                name: query
                                            }
                                        },
                                        preProcess: function (data) {
                                            if (data.success === false) {
                                                return false;
                                            }
                                            return data;
                                        }
                                    }
                                });
                            }); 

                            function addMoreItems() {
                                var rows = parseInt($("#rcount").val());
                                rows = rows + 1;
                                var html = '<div class="row" style="padding:10px 5px;background-color:#f2f2f2;border-bottom:1px solid #ccc;" id="rowitem-' + rows + '">' +
                                        '<div class="row form-group" style="width:90%;margin-bottom:0;">' +
                                        '<input type="hidden" name="itemid[]" id="itemid-' + rows + '" value=""/>' +
                                        '<div class="col-sm-3">' +
                                        '<select class="form-control itemname" required="" onchange="clear_input(this);" name="itemtype[]" id="itemtype-' + rows + '"><option value="">Select Type</option><option value="1">Service</option><option value="2">Spare</option></select>' +
                                        '</div>' +
                                        '<div class="col-sm-3">' +
                                        '<input type="text" class="form-control itemname itemname1" required="" name="itemname[]" id="itemname-' + rows + '" value="" placeholder="Service/Spare Name" autocomplete="off"/>' +
                                        '</div>' +
                                        '<div class="col-sm-2">' +
                                        '<input type="hidden" name="price[]" id="price-' + rows + '" value=""/>' +
                                        '<span id="pricelbl-' + rows + '" style="line-height:30px;"></span>' +
                                        '</div>' +
                                        '<div class="col-sm-3">' +
                                        '<select name="priority[]" required="" id="priority-' + rows + '" class="form-control itemname">' +
                                            '<option value="1">High</option>' +
                                        '<option value="2">Medium</option>' +
                                        '<option value="3">Low</option>' +
                                        '</select>' +
                                        '</div>' +
                                        '<div class="col-sm-1"><a href="javascript:removeItem(' + rows + ');" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a></div>' +
                                        '</div>' +
                                        '</div>';
                                $("#orderitems").append(html);
                                $("#rcount").val(rows);
                                var itemid = $('#ratecardid').val();
                                $("#itemtype-" + rows).change(function () {
                                    //alert("hi");
                                    var a = $("#itemtype-" + rows).val();
                                    var b = $('#rate_id').val();
                                    ajaxindicatorstart("Please hang on.. while we add items ..");
                                $.post(base_url + 'client/item/add_type_into_session', { a : a}, function(data){
                                  ajaxindicatorstop();  
                                }, 'JSON');
                                    $("#itemname-" + rows).typeahead({

                                        onSelect: function (item) {
                                            
                                            itemvalue = item.value;
                                            $.get(base_url + "client/item/detail/" + itemvalue, {}, function (result) {
                                                $("#price-" + rows).val(result.price);
                                                $("#pricelbl-" + rows).html("Rs. " + result.price);
                                                $("#itemid-" + rows).val(result.id);
                                                $("#itemname-" + rows).attr('readonly', 'readonly');
                                            }, 'json');
                                        },
                                        ajax: {
                                            url: base_url + "client/item/search/" + b,
                                            timeout: 500,
                                            displayField: "name",
                                            triggerLength: 1,
                                            method: "get",
                                            loadingClass: "loading-circle",
                                            preDispatch: function (query) {
                                                return {
                                                    name: query
                                                }
                                            },
                                            preProcess: function (data) {
                                                if (data.success === false) {
                                                    return false;
                                                }
                                                return data;
                                            }
                                        }
                                    });
                                });
                            }
                            function removeItem(count) {
                                $("#rowitem-" + count).remove();
                            }
                            function eaddMoreItems() {

                                var rows = parseInt($("#ercount").val());
                                rows = rows + 1;
                                var html = '<div class="row" style="padding:10px 5px;background-color:#f2f2f2;border-bottom:1px solid #ccc;" id="erowitem-' + rows + '">' +
                                        '<div class="row form-group" style="width:90%;margin-bottom:0;">' +
                                        '<input type="hidden" name="itemid[]" id="eitemid-' + rows + '" value=""/>' +
                                        '<div class="col-sm-3">' +
                                        '<select class="form-control itemname" required="" onchange="clear_input(this);" name="itemtype[]" id="eitemtype-' + rows + '"><option value="">Select Type</option> <option value="1">Service</option><option value="2">Spare</option></select>' +
                                        '</div>' +
                                        '<div class="col-sm-3">' +
                                        '<input type="text" class="form-control itemname itemname1" name="itemname[]" id="eitemname-' + rows + '" value="" placeholder="Service/Spare Name" autocomplete="off"/>' +
                                        '</div>' +
                                        '<div class="col-sm-2">' +
                                        '<input type="hidden" name="price[]" id="eprice-' + rows + '" value=""/>' +
                                        '<span id="epricelbl-' + rows + '" style="line-height:30px;"></span>' +
                                        '</div>' +
                                        '<div class="col-sm-2">' +
                                        '<select name="priority[]" id="priority-' + rows + '" class="form-control itemname">' +
                                        '<option value="1">High</option>' +
                                        '<option value="2">Medium</option>' +
                                        '<option value="3">Low</option>' +
                                        '</select>' +
                                        '</div>' +
                                        '<input type="hidden" name="is_checked[]" value="0">'
                                        '<div class="col-sm-1"><a href="javascript:eremoveItem(' + rows + ');" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a></div>' +
                                        '</div>' +
                                        '</div>';
                                $("#eorderitems").append(html);
                                $("#ercount").val(rows);
                                var itemid = $('#rateid').val();
                                $("#eitemtype-" + rows).change(function () {
                                    //alert("hi");
                                    var a = $("#eitemtype-" + rows).val();
                                    var b = $('#rate_id').val();
                                    ajaxindicatorstart("Please hang on.. while we add items ..");
                                        $.post(base_url + 'client/item/add_type_into_session', { a : a}, function(data){
                                          ajaxindicatorstop();  
                                        }, 'JSON');
                                    $("#eitemname-" + rows).typeahead({

                                        onSelect: function (item) {
                                            //	var itemid12 = $('#inputrateid1').val();
                                            //alert(itemid);

                                            itemvalue = item.value;

                                            $.get(base_url + "client/item/detail/" + itemvalue , {}, function (result) {

                                                $("#eprice-" + rows).val(result.price);
                                                $("#epricelbl-" + rows).html("Rs. " + result.price);
                                                $("#eitemid-" + rows).val(result.id);
                                                $('#eitemname-' + rows).attr('readonly', 'readonly');
                                            }, 'json');
                                        },
                                        ajax: {

                                            url: base_url + "client/item/search/" + b,
                                            timeout: 500,
                                            displayField: "name",
                                            triggerLength: 1,
                                            method: "get",
                                            loadingClass: "loading-circle",
                                            preDispatch: function (query) {
                                                return {
                                                    name: query
                                                }
                                            },
                                            preProcess: function (data) {
                                                if (data.success === false) {
                                                    return false;
                                                }
                                                return data;
                                            }

                                        }
                                    });
                                });
                            }

                            function eremoveItem(count) {
                                $("#erowitem-" + count).remove();
                            }
                            <?php foreach ($items as $key => $item) { ?>
                               $("#eitemtype-<?php echo $key; ?>").change(function () {
                                    //alert("hi");
                                    var a = $("#eitemtype-<?php echo $key; ?>").val();
                                    var b = $("#rate_id").val();
                                    
                                    ajaxindicatorstart("Please hang on.. while we add items ..");
                                $.post(base_url + 'client/order/add_type_into_session', { a : a}, function(data){
                                  ajaxindicatorstop();  
                                }, 'JSON');
                                    $("#eitemname-<?php echo $key; ?>").typeahead({

                                        onSelect: function (item) {
                                            
                                            itemvalue = item.value;
                                            $.get(base_url + "client/item/detail/" + itemvalue, {}, function (result) {
                                                $("#eprice-<?php echo $key; ?>").val(result.price);
                                                $("#epricelbl-<?php echo $key; ?>").html("Rs. " + result.price);
                                                $("#eitemid-<?php echo $key; ?>").val(result.id);
                                                $('#eitemname-<?php echo $key; ?>').attr('readonly', 'readonly');
                                               

                                            }, 'json');
                                        },
                                        ajax: {

                                            url: base_url + "client/item/search/" + b,
                                            timeout: 500,
                                            displayField: "name",
                                            triggerLength: 1,
                                            method: "get",
                                            loadingClass: "loading-circle",
                                            preDispatch: function (query) {
                                                return {
                                                    name: query
                                                }
                                            },
                                            preProcess: function (data) {
                                                if (data.success === false) {
                                                    return false;
                                                }
                                                return data;
                                            }
                                        }
                                    });
                                });
                                <?php } ?>
 

                            function openInNewTab(url) {
                                var win = window.open(url, '_blank');
                                win.focus();
                            }

                            function ConfirmApproval(orderid) {
                                ajaxindicatorstart("Please hang on.. while we Confirm Approval ..");
                                $.post(base_url + "client/order/confirmApproval/" + orderid, {}, function (data) {
                                    ajaxindicatorstop();
                                    alert(data.msg);
                                    window.location.reload();
                                }, 'json');
                            }

                            function markworkcompleted(orderid) {
                                ajaxindicatorstart("Please hang on.. while we Confirm Approval ..");
                                $.post(base_url + "client/order/markworkCompleted/" + orderid, {}, function (data) {
                                    ajaxindicatorstop();
                                    alert(data.msg);
                                    window.location.reload();
                                }, 'json');
                            }

                            

                            
                            function showAddRequest(formData, jqForm, options) {
                                // ajaxindicatorstop();
                                $("#response").hide();
                                var queryString = $.param(formData);
                                return true;
                            }

                            function showAddResponse(resp, statusText, xhr, $form) {
                                ajaxindicatorstop();
                                if (resp.status == '0') {
                                    $("#response").removeClass('alert-success');
                                    $("#response").addClass('alert-danger');
                                    $("#response").html(resp.msg);
                                    $("#response").show();
                                    alert(resp.msg);
                                } else {
                                    $("#response").removeClass('alert-danger');
                                    $("#response").addClass('alert-success');
                                    $("#response").html(resp.msg);
                                    $("#response").show();
                                    alert(resp.msg);
                                    //window.location.href = base_url+"admin/mainservice";
                                    window.location.reload();
                                }
                            }

                            function ApprovalUpdate() {
                                ajaxindicatorstart("Please hang on.. while we add items ..");
                                var options = {
                                    target: '#response',
                                    beforeSubmit: AshowAddRequest,
                                    success: AshowAddResponse,
                                    url: base_url + 'client/order/approvalUpdate',
                                    semantic: true,
                                    dataType: 'json'
                                };
                                $('#approvalUpdate').ajaxSubmit(options);
                            }

                            function AshowAddRequest(formData, jqForm, options) {
                                //ajaxindicatorstop();
                                $("#response").hide();
                                var queryString = $.param(formData);
                                return true;
                            }

                            function AshowAddResponse(resp, statusText, xhr, $form) {
                                ajaxindicatorstop();
                                if (resp.status == '0') {
                                    
                                    $("#response").removeClass('alert-success');
                                    $("#response").addClass('alert-danger');
                                    $("#response").html(resp.message);
                                    $("#response").show();
                                } else {
                                   
                                    $("#response").removeClass('alert-danger');
                                    $("#response").addClass('alert-success');
                                    $("#response").html(resp.message);
                                    $("#response").show();
                                    alert(resp.message);
                                    window.location.reload();
                                }
                            }
                            function clear_input(ths) {
                                $(ths).parent().parent().find('input[type="text"], input[type="hidden"]').val('');
                                $(ths).parent().parent().find('.itemname1').removeAttr('readonly');
                        }
                        function ApprovalPackageUpdate() {
                                ajaxindicatorstart("Please hang on.. while we add items ..");
                                var options = {
                                    target: '#response',
                                    beforeSubmit: AshowAddRequest,
                                    success: AshowAddResponse,
                                    url: base_url + 'client/order/approvalPackageUpdate',
                                    semantic: true,
                                    dataType: 'json'
                                };
                                $('#PackageUpdate').ajaxSubmit(options);
                            }


$("#garage_name").typeahead({
        onSelect: function (item) {
            $('#vendor_id').val(item.value);
        },
        ajax: {
            url: base_url + "client/order/get_vendor_by_name",
            timeout: 500,
            displayField: "name",
            triggerLength: 1,
            method: "get",
            loadingClass: "loading-circle",
            preDispatch: function (query) {
                return {
                    name: query
                }
            },
            preProcess: function (data) {
                if (data.success === false) {
                    return false;
                }
                return data;
            }
        }

    });

  

</script>