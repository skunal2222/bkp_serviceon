<link type="text/css" rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<link type="text/css" rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<style>
.btn-plus{
	margin:5px 0px;
}
th {
	border:1px solid #ccc;
}
</style>
<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Search Users
              	</div>
              	<div>
              		<form action="<?php echo base_url()?>admin/report/business" method="post">
	              		<div class="panel panel-default">
		                   	<div class="panel-body">
	                            <div class="row" style="width: 70%;">
		                            <div class="col-md-6">
		                            	<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date" value="<?php if(!empty($params['from_date'])){ echo date('d-m-Y',strtotime($params['from_date']));}?>"/>
		                            </div>
		                            <div class="col-md-6">
		                            	<input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Date" value="<?php if(!empty($params['to_date'])){ echo date('d-m-Y',strtotime($params['to_date']));}?>"/>
		                            </div>
	                          	</div>
	                          	<div class="row" style="padding-top:5px;width: 100%;">
	                          		<div class="col-sm-12">
	                          			<input type="submit" name="search" id="search" class="btn btn-primary" value="Search"/>
	                          			<input type="button" name="reset" id="reset" class="btn btn-default" value="Reset"/>
	                          			<span class="pull-right"><a href="javascript:downloadReport();" class="btn btn-info">Download</a></span>
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
              
                	<div class="table-responsive dataTable_wrapper" style="overflow-x:scroll;max-width:1093px;">
	              	<table id="example1" class="display" cellspacing="0" width="100%">
				        <thead class="bg-info">
				        	<tr>
				                <th>Order Id</th>
				             	<th>Order Date</th>
				             	<th>Service Date</th>
				                <th>Name</th>
				                <th>Mobile</th>
				                <th>Email</th>
				                <th>Area</th>
				                <th>Address</th>
				                <th>Customer Type</th>
				                <th>Mode</th>
				                <th>Garage Name</th>
				                <th>Category</th>
				                <th>Brand</th>
				                <th>Model</th>
				                <th>Subcategory</th>
				                <th>Services</th>
				                <th>Discount</th>
				                <th>Convenience fees</th>
				                <th>Adjustment</th>
				                <th>Total Bill</th>
				                <th>Amount Received</th>
				                <th>ServiceOn Commission</th>
				                <th>Vendor Commission</th>
				              	<th>Order Status</th>
				            </tr>
				            <tr>
				             	<th></th>
				             	<th></th>
				             	<th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				                <th></th>
				            </tr>
				        </thead>
				        <tbody id="ubody">
				        <?php //print_r($orders);
				        if(isset($orders))foreach ($orders as $order){ 
				        ?>
				            <tr>
				          		<td><?php echo $order['orderid'];?></td>
				          		<td><?php if (!empty($order['ordered_on'])) { echo date('d-m-Y',strtotime($order['ordered_on']));}?></td>
				          		<td><?php if (!empty($order['pickup_date'])) { echo date('d-m-Y',strtotime($order['pickup_date']));}?></td>
				                <td><?php echo $order['name'];?></td>
				                <td><?php echo $order['mobile'];?></td>
				                <td><?php echo $order['email'];?></td>
				                <td><?php echo $order['locality'];?></td>
				                <td><?php echo $order['address'];?></td>
				                <td><?php if($order['is_new_customer'] == 1){?>New Customer<?php } else {?>Existing Customer<?php }?></td>
				                <td><?php if($order['source'] == 2) {?>Website<?php } else if($order['source'] == 1){?>APP<?php } else {?>Backend<?php }?></td>
				                <td><?php echo $order['garage_name'];?></td>
				                <td><?php echo $order['category'];?></td>
				                <td><?php echo $order['brand'];?></td>
				                <td><?php echo $order['model'];?></td>
				                <td><?php echo $order['subcategory'];?></td>
				                <td><?php $services =array(); 
					                foreach($order['items'] as $items)
					                { 
					                	$service = $items['service_name']; 
										$services[] = $service;
					                }
					                $servicesitem = implode(",", $services);
					                ?><?php echo $servicesitem; ?></td>
				                <td><?php echo $order['discount'];?></td>
				                <td><?php echo $order['delivery_charge'];?></td>
				                <td><?php echo $order['adjustment'];?></td>
				                <td><?php echo $order['grand_total'];?></td>
				                <td><?php echo $order['amount_received'];?> - <?php if($order['payment_status'] == 1){?>Online<?php } else {?>Cash<?php } ?></td>
								<td><?php echo $order['garagecomm'];?></td>
								<td><?php echo $order['vendorcomm'];?></td>
								<td>
								<?php if($order['status'] == 0) { ?>
				                	Assign Garage
				                	<?php } else if($order['status'] == 1) { ?>
				                	Assigned For Garage
				                	<?php } else if($order['status'] == 2) { ?>
				                	Waiting for approval
				                	<?php } else if($order['status'] == 3) { ?>
				                	Work in progress
				                	<?php } else if($order['status'] == 4) { ?>
				                	Work Completed
				                	<?php } else if($order['status'] == 7){ ?>
				                	Order Delivery Completed
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
    	buttons: [
    		'copyHtml5',
    	 	'excelHtml5',
    	  	'csvHtml5',
    	  	'pdfHtml5'
  		]
    } );
} );
$("#reset").click(function() {
	window.location.href = base_url+'admin/report/business';
});
function downloadReport() {
	window.location.href = base_url+'admin/report/downloadbusireport?from_date='+$("#from_date").val()+"&to_date="+$("#to_date").val();
}

</script>