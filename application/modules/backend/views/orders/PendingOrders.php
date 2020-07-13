<style>
<!--
.btn-plus{
	margin:5px 0px;
}
.modal-header {
	background-color:#337ab7;
	color:#fff;
}
.datepicker-dropdown {
	z-index:1050 !important;
}
-->
</style>
<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
        	<div class="panel panel-default" style="width: 100%;">
            	<div class="panel-heading">
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Pending Orders
              	</div>
              	<div>
              		<form action="<?php echo base_url();?>crm/order/pendingorders" method="post">
              		<div class="panel panel-default">
	                   	<div class="panel-body">
                      <!--       <div class="row">
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
                          	<div class="row" style="padding: 10px 0px;">
                          		<div class="col-sm-12">
                          			<input type="submit" name="search" id="search" class="btn btn-primary" value="Search"/>
                          			<span class="pull-right">
                          				<input type="button" name="del_date" id="del_date" value="Change Delivery Date" class="btn btn-warning"/>
                          			</span>
                          		</div>
                          	</div>-->
	                   	</div>
	               	</div>
	               	</form>
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper" style="overflow:auto;">
                        	<table class="table table-striped table-bordered table-hover" id="tblRestos">
							<thead class="bg-info">
								<tr>
								<!-- 	<th><input type="checkbox" name="selectall" id="selectall" /></th> -->
									<th>OrderID</th>
									<th>Order Code</th>
									<th>User Name</th>
									<th>User Mobile</th>
									<th>PickUp Date</th>
									<th>Visiting Slot</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody class="inoice_table">
							<?php if (isset($orders)) { ?>
							<?php foreach ($orders as $item):?>
								<tr>
								<!-- 	<td><input type="checkbox" name="orderid[]" class="orderid" value="<?php echo $item['orderid'];?>"/></td> -->
									<td>
										<a href = "<?php echo base_url();?>admin/order/view_details/<?php echo $item['orderid']?>">
											<?php echo $item['orderid'];?>
										</a>
									</td>
									<td>
										<?php echo $item['ordercode'];?>
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
										<?php echo $item['slot'];?>
									</td>
									<td>
										<a href = "<?php echo base_url();?>admin/order/view_details/<?php echo $item['orderid']?>" class="btn btn-success icon-btn btn-xs">Process</a>
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
<div id="changeDeliveryModal" class="modal fade" style="">
    <div id="rsp-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Change Delivery Date</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
          		<input type="hidden" name="orderids" id="orderids" value=""/>
              	<div class="row" style="padding:0px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Delivery Date</label>
                       		<input type="text" name="delivery_date" id="delivery_date" class="form-control datepicker" value=""/>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
             			<button type="submit" class="btn btn-primary" onclick="changeDeliveryDate();">Change Date</button>
             		</div>
              	</div>
          	</div>
      	</div>
  	</div>
</div>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script>
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$('#pickup_date').datepicker();
$('.datepicker').datepicker();
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
$("#selectall").click(function(){
	var checkBoxes = $("input[name=orderid\\[\\]]");
    checkBoxes.prop("checked", !checkBoxes.prop("checked"));
});

$("#del_date").click(function(){
	var orderids = "";
	$('.inoice_table input:checked').each(function(index, obj) {
		if(orderids != "") {
			orderids = orderids+","+$(obj).val();
		} else {
			orderids = $(obj).val();
		}
	});
	if(orderids != "") {
		$("#orderids").val(orderids);
		$("#changeDeliveryModal").modal('show');
	} else {
		alert("Please select orders to change delivery date.");
	}
		
});

function changeDeliveryDate() {
	//ajaxindicatorstart("Please hang on.. while we update delivery dates ..");
	$.post(base_url+"crm/orders/changedate", {orderids : $("#orderids").val(), delivery_date : $("#delivery_date").val()},function(data){
		alert(data.message);
		window.location.reload();
	//	ajaxindicatorstop();
	},'json');
}
</script>