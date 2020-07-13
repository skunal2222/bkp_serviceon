<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Todays Orders
              	</div>
              	<!-- div>
              		<form action="<?php echo base_url();?>crm/order/todaysorders" method="post">
              		<div class="panel panel-default">
	                   	<div class="panel-body">
                            <div class="row">
	                            <div class="col-sm-3">
	                            	<input type="text" id="pickup_date" name="pickup_date" class="form-control" placeholder="Pickup Date"/>
	                            </div>
	                            <div class="col-sm-3">
	                            	<input type="text" id="name" name="name" class="form-control" placeholder="Customer Name"/>
	                            </div>
	                            <div class="col-sm-3">
	                            	<input type="text" id="mobile" name="mobile" class="form-control" placeholder="Customer Mobile"/>
	                            </div>
	                            <div class="col-sm-3">
                          			<input type="text" id="email" name="email" class="form-control" placeholder="Customer Email"/>
                          		</div>
                          	</div>
                          	<div class="row" style="padding: 5px 0px;">
                          		<div class="col-sm-3">
                          			<input type="submit" name="search" id="search" class="btn btn-primary" value="Search"/>
                          		</div>
                          	</div>
	                   	</div>
	               	</div>
	               	</form>
              	</div-->
               	<div class="panel-body">
                	<div class="dataTable_wrapper" style="overflow:auto;">
                       	<table class="table table-striped table-bordered table-hover" id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>Status</th>
									<th>Order ID</th>
									<th>User Name</th>
									<th>User Mobile</th>
									<th>PickUp Date</th>
									<th>PickUp Slot</th>
									<th>Assigned To</th>
									<th>Area</th>
									<th>Coupon Code</th>
								</tr>
							</thead>
							<tbody>
							<?php if (isset($orders)) { ?>
							<?php foreach ($orders as $item):?>
								<tr>
									<td>
										<?php if($item['status'] == 0) { ?>
										Pending
										<?php } elseif ($item['status'] == 1) { ?>
										<?php if($item['pickup_rescheduled'] == 0) { ?>
										Pickup Assigned 
										<?php } else if($item['pickup_rescheduled'] == 1) { ?>
										Pickup Rescheduled 
										<?php } else if($item['pickup_rescheduled'] == 2) { ?>
										Pickup Attempted  
										<?php } ?>
										<?php if($item['is_pickup_accepted'] == 1) { ?><br><span style="color:#3c763d;">- Accepted</span><?php } ?>
										<?php } elseif ($item['status'] == 2) { ?>
										Order PickedUp
										<?php } elseif ($item['status'] == 3) { ?>
										<?php if($item['delivery_rescheduled'] == 0) { ?>
										Delivery Assigned 
										<?php } else if($item['delivery_rescheduled'] == 1) { ?>
										Delivery Rescheduled 
										<?php } else if($item['delivery_rescheduled'] == 2) { ?>
										Delivery Attempted
										<?php } else if($item['delivery_rescheduled'] == 3) { ?>
										Delivery Call Answered
										<?php } ?>
										<?php if($item['is_delivery_accepted'] == 1) { ?><br><span style="color:#3c763d;">- Accepted</span><?php } ?>
										<?php } elseif ($item['status'] == 4) { ?>
										Delivered
										<?php } elseif ($item['status'] == 5) { ?>
										Cancelled
										<?php } ?>
									</td>
									<td>
										<a href = "<?php echo base_url();?>crm/order/view_details/<?php echo $item['orderid']?>">
											<?php echo $item['orderid'];?> / <?php echo $item['ordercode'];?>
										</a>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
										<?php echo $item['mobile'];?>
									</td>
									<td>
										<?php echo date('j M Y',strtotime($item['pickup_date']));?>
									</td>
									<td>
										<?php echo $item['pickup_slot'];?>
									</td>
									<td>
										<?php if(!empty($item['pickup_executive_name'])) { echo $item['pickup_executive_name']; } ?>
									</td>
									<td>
										<?php echo $item['area'];?>
									</td>
									<td>
										<?php echo $item['coupon_code'];?>
									</td>
								</tr>
								<?php endforeach;?>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
		</div>
	</div>
</div>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script>
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$('#pickup_date').datepicker();
$(document).ready(function(){
    $('#tblRestos').DataTable({
        "aaSorting": []
    });
});
function hideNav() {
	var status = $("#side-menu").css("display");
	if(status == 'block') {
		$("#side-menu").hide();
		$("#page-wrapper").css("margin","0 0 0 0");
		$("#show-hide-nav").html('<i class="fa fa-chevron-circle-right fa-2x"></i>');
	} else {
		$("#page-wrapper").css("margin","0 0 0 250px");
		$("#side-menu").show();
		$("#show-hide-nav").html('<i class="fa fa-chevron-circle-left fa-2x"></i>');
	}
}
</script>