<link type="text/css" rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<link type="text/css" rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<style>
.btn-plus {
	margin: 5px 0px;
}
th {
	border: 1px solid #ccc;
}
</style>
<div id="page-wrapper" style="padding: 0 16px;">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				Vendor Report
			</div>
			<!-- <div>
				<form action="<?php echo base_url()?>admin/report/vendor" method="post">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row" style="width: 70%;">
								<div class="col-md-6">
									<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date" value="<?php if(!empty($params['from_date'])){ echo date('d-m-Y',strtotime($params['from_date']));}?>" />
								</div>
								<div class="col-md-6">
									<input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Date" value="<?php if(!empty($params['to_date'])){ echo date('d-m-Y',strtotime($params['to_date']));}?>" />
								</div>
							</div>
							<div class="row" style="padding-top: 5px; width: 100%;">
								<div class="col-sm-12">
									<input type="submit" name="search" id="search" class="btn btn-primary" value="Search" /> 
									<input type="button" name="reset" id="reset" class="btn btn-default" value="Reset" />
									<span class="pull-right"><a href="javascript:downloadReport();" class="btn btn-info">Download</a></span>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>-->
			<div class="panel-body">
				<center>
					<div id="ajaxTest"
						style="position: absolute; width: 100px; height: 50px; background-color: transparent">
						<div id="dynElement"></div>
					</div>
				</center>
				<div class="table-responsive dataTable_wrapper"
					style="overflow-x: scroll; max-width: 1093px;">
					<table id="example1" class="display" cellspacing="0" width="100%">
						<thead class="bg-info">
							<tr>
								<th>ID</th>
								<th>Vendor Name</th>
								<th>Garage Name</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Area</th>
								<th>Address</th>
								<th>Category</th>
								<!-- <th>Brand</th>				    
								<th>Model</th>
								<th>Subcategory</th>
								<th>Service</th> 
								<th>Order Id</th> -->
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
								<!-- <th></th>					
								<th></th>
								<th></th>
								<th></th> 
								<th></th> -->
							</tr>
						</thead>
						<tbody id="ubody">			
						 <?php $i = 1;?>
				         <?php foreach ($vendors as $vendor){ ?>
				           <tr>
								<td><?php echo $i; ?></td>
								<?php if($vendor['ordercount'] > 0){ ?>
								<td><a href="<?php echo base_url()?>admin/report/vendorDetails/<?php echo $vendor['id']?>"><?php echo $vendor['name'];?></a></td>
								<?php }else{?>
								<td><?php echo $vendor['name'];?></td>
								<?php } ?>
								<td><?php echo $vendor['garage_name'];?></td>
								<td><?php echo $vendor['mobile'];?></td>
								<td><?php echo $vendor['email'];?></td>
								<td><?php echo $vendor['locality'];?></td>
								<td><?php echo $vendor['address'];?></td>
								<td><?php echo $vendor['category'];?></td>
								<!-- <td><?php echo $vendor['brand'];?></td>	
								<td><?php echo $vendor['model'];?></td>
								<td><?php echo $vendor['subcategory'];?></td>
								<td><?php echo $vendor['service'];?></td>
								<td><?php echo $vendor['orderid'];?></td>-->
							</tr>			
							<?php $i ++; } ?>
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
	window.location.href = base_url+'admin/report/vendors';
});
function downloadReport() {	
	window.location.href = base_url+'admin/report/downloadbusireport?from_date='+$("#from_date").val()+"&to_date="+$("#to_date").val();
}
</script>