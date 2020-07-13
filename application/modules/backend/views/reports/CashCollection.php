<style>
.btn-plus{
	margin:5px 0px;
}
</style>
<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Cash Collection Report
              	</div>
              	<div>
              		<form action="<?php echo base_url()?>crm/report/cashcollection" method="post">
	              		<div class="panel panel-default">
		                   	<div class="panel-body">
	                            <div class="row">
		                            <div class="col-sm-4">
		                            	<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Delivery Date" value="<?php if(!empty($params['from_date'])){ echo date('d-m-Y',strtotime($params['from_date']));}?>"/>
		                            </div>
		                            <div class="col-sm-4">
		                            	<input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Delivery Date" value="<?php if(!empty($params['to_date'])){ echo date('d-m-Y',strtotime($params['to_date']));}?>"/>
		                            </div>
		                            <div class="col-sm-4">
		                            	<select name="executive_id" id="executive_id" class="form-control">
		                            		<option value="">Select Delivery Executive</option>
		                            		<?php foreach ($executives as $executive) { ?>
		                            		<option value="<?php echo $executive['id'];?>" <?php if($params['executive_id'] == $executive['id']) { ?>selected<?php } ?>><?php echo $executive['name'];?></option>
		                            		<?php } ?>
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
					                <th>Executive Name</th>
					                <th>Orders</th>
					                <th>Total Order Amount</th>
					                <th>Cash Received</th>
					            </tr>
					        </thead>
					        <tbody id="ubody">
					        <?php 
					        if(isset($orders))foreach ($orders as $order){ ?>
					            <tr>
					                <td><?php if(!empty($order['name'])) { echo $order['name'];} else { echo "NA";}?></td>
					                <td><?php echo $order['orders'];?></td>
					                <td><?php echo $order['ordertotal'];?></td>
					                <td><?php echo $order['total_received'];?></td>
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
	window.location.href = base_url+'crm/report/cashcollection';
});

</script>