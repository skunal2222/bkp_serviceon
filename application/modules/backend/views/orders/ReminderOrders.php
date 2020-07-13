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
              	
               	<div class="panel-body">
                	<div class="dataTable_wrapper" style="overflow:auto;">
                        	<table class="table table-striped table-bordered table-hover" id="tblremind">
							<thead class="bg-info">
								<tr>
								<!-- 	<th><input type="checkbox" name="selectall" id="selectall" /></th> -->
									<th>SrNo</th>
									<th>User Name</th>
									<th>User Email</th>
									<th>User Mobile</th>
									<th>Order Last Date</th>
									<!-- <th>Visiting Slot</th>-->
									<th>Status</th>
								</tr>
							</thead>
							<tbody class="inoice_table">
							<?php $i = 1;?>
							<?php if (isset($ordersremind)) { ?>
							<?php foreach ($ordersremind as $order):?>
								<tr>
									<td>
										<?php echo $i;?>
									</td>
									<td>
										<?php echo $order['name'];?>
									</td>
									<td>
										<?php echo $order['email'];?>
									</td>
									<td>
										<?php echo $order['mobile'];?>
									</td>
									<td>
										<?php echo date('j M Y',strtotime($order['last_order_date']));?>
									</td>
									<td>
										<a href ="" class="btn btn-success icon-btn btn-xs">Process</a>
									</td>
								</tr>
								<?php $i++; 
								endforeach;?>
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
$('.datepicker').datepicker();
$(document).ready(function(){
    $('#tblremind').DataTable({
        "aaSorting": []
    });
});

</script>