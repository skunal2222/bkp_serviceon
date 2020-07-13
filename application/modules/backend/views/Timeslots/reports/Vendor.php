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
              		<form action="<?php echo base_url()?>admin/report/vendors" method="post">
	              		<div class="panel panel-default">
		                   	<div class="panel-body">
	                            <div class="row">
		                            <div class="col-sm-4">
		                            	<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date" value="<?php if(!empty($params['from_date'])){ echo date('d-m-Y',strtotime($params['from_date']));}?>"/>
		                            </div>
		                            <div class="col-sm-4">
		                            	<input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Date" value="<?php if(!empty($params['to_date'])){ echo date('d-m-Y',strtotime($params['to_date']));}?>"/>
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
                <th>garage Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
                </tr>
        </thead>
        <tbody id="ubody">
        <?php 
        if(isset($vendors))foreach ($vendors as $vendor){ ?>
            <tr>
          		<td><?php echo $vendor['id'];?></td>
                <td><?php echo $vendor['name'];?></td>
                <td><?php echo $vendor['garage_name'];?></td>
                <td><?php echo $vendor['mobile'];?></td>
                <td><?php echo $vendor['email'];?></td>
                <td><?php echo $vendor['address'];?></td>
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
	window.location.href = base_url+'admin/report/vendors';
});

</script>