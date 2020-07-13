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
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Generate Invoices
              	</div>
              	<!-- div>
              		<form action="<?php echo base_url();?>crm/order/todaysdeliveries" method="post">
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
									<td><input type="checkbox" name="selectall" id="selectall" checked></td>
									<th>Status</th>
									<th>Order ID</th>
									<th>User Name</th>
									<th>User Mobile</th>
									<th>Delivery Date</th>
									<th>Delivery Slot</th>
									<th>Assigned To</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody class="inoice_table">
							<?php if (isset($orders)) { ?>
							<?php foreach ($orders as $item):?>
								<tr>
									<td><input type="checkbox" name="orderid[]" class="orderid" value="<?php echo $item['orderid'];?>" checked/></td>
									<td>
										<?php if($item['status'] == 0) { ?>
										Pending
										<?php } elseif ($item['status'] == 1) { ?>
										Pickup Assigned - <?php if($item['is_pickup_accepted'] == 1) { ?><br><span style="color:#3c763d;">Accepted</span><?php } ?>
										<?php } elseif ($item['status'] == 2) { ?>
										Order PickedUp
										<?php } elseif ($item['status'] == 3) { ?>
										Delivery Assigned - <?php if($item['is_delivery_accepted'] == 1) { ?><br><span style="color:#3c763d;">Accepted</span><?php } ?>
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
										<?php if(!empty($item['tml_delivery_date'])) { echo date('j M Y',strtotime($item['tml_delivery_date']));}?>
									</td>
									<td>
										<?php if(!empty($item['delivery_slot'])) { echo $item['delivery_slot']; } ?>
									</td>
									<td>
										<?php if(!empty($item['delivery_executive_name'])) { echo $item['delivery_executive_name']; } ?>
									</td>
									<td>
										Rs. <?php echo $item['grand_total'];?>
									</td>
								</tr>
								<?php endforeach;?>
							<?php }?>
							</tbody>
						</table>
					</div>
					<input type="button" name="invoice" id="invoice" value="Generate Invoice" class="btn btn-primary"/>
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
        "aaSorting": [],
        "aoColumnDefs" : [{
        	'bSortable' : false,
            'aTargets' : [ 0, 4 ]
        }],
        "pageLength": 200
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
$("#selectall").click(function(){
	var checkBoxes = $("input[name=orderid\\[\\]]");
    checkBoxes.prop("checked", !checkBoxes.prop("checked"));
});

$("#invoice").click(function(){
 var answer = confirm('Are you sure you want to generate invoice');
 if(answer) {
	var orderids = "";
	$('.inoice_table input:checked').each(function(index, obj) {
		if(orderids != "") {
			orderids = orderids+","+$(obj).val();
		} else {
			orderids = $(obj).val();
		}
	});
	if(orderids != "") {
		ajaxindicatorstart("Please hang on.. while we generate invoices ..");
		$.post(base_url+"crm/invoices/generate", {orderids : orderids},function(data){
			alert(data.message);
			ajaxindicatorstop();
		},'json');
	}
 }
	
});
</script>