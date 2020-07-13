<style>
.btn-plus{
	margin:5px 0px;
}
</style>
<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
        	<div class="panel panel-default" style="width: 100%;">
            	<div class="panel-heading">
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Search Users
              	</div>
              	<div>
              		<form action="<?php echo base_url()?>admin/report/orders" method="post">
	              		<div class="panel panel-default">
		                   	<div class="panel-body">
	                            <div class="row">
		                            <div class="col-sm-4">
		                            	<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date" value="<?php if(!empty($params['from_date'])){ echo date('d-m-Y',strtotime($params['from_date']));}?>"/>
		                            </div>
		                            <div class="col-sm-4">
		                            	<input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Date" value="<?php if(!empty($params['to_date'])){ echo date('d-m-Y',strtotime($params['to_date']));}?>"/>
		                            </div>
		                            <div class="col-sm-4">
		                            	<select name="status" id="status" class="form-control">
		                            		<option value="">Select Status</option>
		                            		<option value="0" <?php if($params['status'] == '0') { ?>selected<?php } ?>>New Orders</option>
		                            	<!-- 	<option value="1" <?php if($params['status'] == 1) { ?>selected<?php } ?>>PickUp Assigned</option> -->
		                            		<option value="2" <?php if($params['status'] == 2) { ?>selected<?php } ?>>PickUp Completed</option>
		                            		<option value="3" <?php if($params['status'] == 3) { ?>selected<?php } ?>>Delivery Assigned</option>
		                            		<option value="4" <?php if($params['status'] == 4) { ?>selected<?php } ?>>Delivery Completed</option>
		                            		<option value="5" <?php if($params['status'] == 5) { ?>selected<?php } ?>>Cancelled Orders</option>
		                            	</select>
		                            </div>
	                          	</div>
	                          	<div class="row" style="padding-top:5px;">
	                          		<div class="col-sm-4">
	                          			<input type="submit" name="search" id="search" class="btn btn-primary" value="Search"/>
	                          			<input type="button" name="reset" id="reset" class="btn btn-default" value="Reset"/>
	                          		</div>
	                          	</div>
		                   	</div>
		               	</div>
	               	</form>
              	</div>
               	<div class="panel-body">
               		<center>
              			<div id="ajaxTest" style="position:absolute;width:100px; height:50px;background-color:transparent">
            				<div id="dynElement">
            				</div>
 						</div>
 					</center>
              
                	<div class="dataTable_wrapper" style="overflow:auto;">
              <table id="example1" class="display" cellspacing="0" width="100%">
        <thead class="bg-info">
            <tr>
             	<th>Id</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Area</th>
              	<th>Order Date</th>
              	<th>Order Status</th>
            </tr>
        </thead>
        <tbody id="ubody">
        <?php 
        if(isset($orders))foreach ($orders as $order){ ?>
            <tr>
          		<td><?php echo $order['orderid'];?></td>
                <td><?php echo $order['name'];?></td>
                <td><?php echo $order['mobile'];?></td>
                <td><?php echo $order['email'];?></td>
                <td><?php echo $order['areaname'];?></td>
				<td><?php if (!empty($order['ordered_on'])) { echo date('d-m-Y',strtotime($order['ordered_on']));}?></td>
				<td>
				<?php if($order['status'] == 0) { ?>
					New Order
				<?php } else if($order['status'] == 1) { ?>
					PickUp Assigned
				<?php } else if($order['status'] == 2) { ?>
					PickUp Completed
				<?php } else if($order['status'] == 3) { ?>
					Delivery Assigned
				<?php } else if($order['status'] == 4) { ?>
					Delivery Completed
				<?php } else { ?>
					Order Cancelled
				<?php } ?>
				</td>                
            </tr>
            <?php } ?>
          
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
$(document).ready(function() {
	$('#from_date').datepicker();
    $('#to_date').datepicker();
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        "aaSorting": [],
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o" style="padding:5px;font-size:20px"></i>',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o" style="padding:5px;font-size:20px"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o" style="padding:5px;font-size:20px"></i>',
                titleAttr: 'CSV'
            }
            
        ]
    } );
} );
$("#reset").click(function() {
	window.location.href = base_url+'admin/report/orders';
});

</script>