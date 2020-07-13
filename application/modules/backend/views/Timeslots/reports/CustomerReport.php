<style>
.btn-plus{
	margin:5px 0px;
}
</style>
<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Search Users
              	</div>
              	<div>
              		<form action="<?php echo base_url()?>crm/report/users" method="post">
	              		<div class="panel panel-default">
		                   	<div class="panel-body">
	                            <div class="row">
		                            <div class="col-sm-3">
		                            	<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date" value="<?php if(!empty($params['from_date'])){ echo date('d-m-Y',strtotime($params['from_date']));}?>"/>
		                            </div>
		                            <div class="col-sm-3">
		                            	<input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Date" value="<?php if(!empty($params['to_date'])){ echo date('d-m-Y',strtotime($params['to_date']));}?>"/>
		                            </div>
		                            <div class="col-sm-3">
		                            	<input type="text" id="name" name="name" class="form-control" placeholder="Customer Name" value="<?php if(!empty($params['name'])){ echo $params['name'];}?>"/>
		                            </div>
		                            <div class="col-sm-3">
		                            	<input type="text" id="mobile" name="mobile" class="form-control" placeholder=" Mobile" value="<?php if(!empty($params['mobile'])){ echo $params['mobile'];}?>"/>
		                            </div>
	                          	</div>
	                          	<div class="row" style="padding-top:5px;">
		                            <div class="col-sm-3">
		                            	<select id="area" name="area" class="form-control" placeholder="Area" >
		                            		<option value="">Select Area</option>
		                            		<?php foreach ($areas as $area) { ?>
		                            			<option value="<?php echo $area['id'];?>"><?php echo $area['name'];?></option>
		                            		<?php } ?>
		                            	</select>
		                            </div>
		                            <div class="col-sm-3">
		                            	<input type="text" id="address" name="address" class="form-control" placeholder="Address" value="<?php if(!empty($params['address'])){ echo $params['address'];}?>"/>
		                            </div>
		                            <div class="col-sm-3">
		                            	<input type="text" id="source" name="source" class="form-control" placeholder="Source" value="<?php if(!empty($params['source'])){ echo $params['source'];}?>"/>
		                            </div>
	                          		<div class="col-sm-3">
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
                <th>Address</th>
                <th>Source</th>
              	<th>Reg. Date</th>
              	<th>Wallet Balance</th>
            </tr>
        </thead>
        <tbody id="ubody">
        <?php 
        if(isset($users))foreach ($users as $user){ ?>
            <tr>
          		<td><?php echo $user['id'];?></td>
                <td><?php echo $user['name'];?></td>
                <td><?php echo $user['mobile'];?></td>
                <td><?php echo $user['email'];?></td>
                <td><?php echo $user['areaname'];?></td>
                <td><?php echo $user['address'];?></td>
                <td><?php echo $user['source'];?></td>
				<td><?php if (!empty($user['created_on'])) { echo date('Y-m-d',strtotime($user['created_on']));}?></td>  
				<td><?php echo $user['amount']?$user['amount']:0;?></td>              
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
	
	window.location.href = base_url+'crm/report/users';
});
/*$("#search").click(function() {
	$.post(base_url+"admin/report/searchuser",{from_date: $("#from_date").val(), to_date: $("#to_date").val(), email: $("#email").val(), mobile: $("#mobile").val(),user: $("#usertype").val()},function(data){
		var oTable = $("#example1").dataTable();
	    oTable.fnClearTable();
	    $(data).each(function(index){
		    var	vieworder = '<a href="'+base_url+'admin/order/view_details/'+data[index].id+'" >'+data[index].id+'</a>';
		    var row = [];
	    	    row.push(data[index].id);
		    	row.push(data[index].name);
			    row.push(data[index].mobile);
		    	row.push(data[index].email);
		    	if(data[index].address != null)
		    		row.push(data[index].address);
		    	else 
		    		row.push("NA");
		    	if(data[index].locality != null)
		    		row.push(data[index].locality);
		    	else 
		    		row.push("NA");
		    	if(data[index].zonename != null)
		    		row.push(data[index].zonename);
		    	else 
		    		row.push("NA");
		    	row.push(data[index].created_on);
		    	oTable.fnAddData(row);
	    });
	   
	},'json');
	 var loader = $('#dynElement').data('introLoader');
     loader.stop();
     $("#ubody").fadeIn();
});*/

</script>