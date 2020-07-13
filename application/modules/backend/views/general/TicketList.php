<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="btn-plus">
			<a href="<?php echo base_url();?>admin/general/ticket/new" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Ticket
			</a>
			</div>
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Ticket List
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                       	<table class="table table-striped table-bordered table-hover" id="tblitems">
							<thead class="bg-info">
								<tr>                                    <th>Id</th>                                    
								    <th>Status</th> 
									<th>Priority</th>
									<th>Assigned To</th>
									<th>Contact Name</th>
									<th>Contact Mobile</th>
									<th>Ticket Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="items_area">
							<?php //print_r($tickets); 
							if (isset($tickets)) { ?>
							<?php foreach ($tickets as $ticket):?>
								<tr>                                     <td>										<?php echo $ticket['ticketid'];?>									 </td>									
									 <td>
										<?php if($ticket['status'] == 0) { ?>
										Open
										<?php } else if($ticket['status'] == 1) { ?>
										In Progress
										<?php } else if($ticket['status'] == 2) { ?>
										Wait For Response
										<?php } else if($ticket['status'] == 3) { ?>
										Closed
										<?php } ?>
									</td> 
									<td>
										<?php if($ticket['priority'] == 0) { ?>
										Low
										<?php } else if($ticket['priority'] == 1) { ?>
										Normal
										<?php } else if($ticket['priority'] == 2) { ?>
										High
										<?php } else if($ticket['priority'] == 3) { ?>
										Urgent
										<?php } ?>
									</td>
									<td>
										<?php echo $ticket['assigned_to_name'];?>
									</td>
									<td>
										<?php echo $ticket['name'];?>
									</td>
									<td>
										<?php echo $ticket['mobile'];?> 
									</td>
									<td>
										<?php echo date('j M Y',strtotime($ticket['created_date']));?>
									</td>
									<td><a href = "<?php echo base_url();?>admin/general/ticket/edit/<?php echo $ticket['ticketid']?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a>
									<a href="<?php echo base_url();?>admin/general/view/<?php echo $ticket['ticketid']?>"><i class="ti-desktop"></i></a>
									</td>
								</tr>
								<?php endforeach;?>
							<?php } else { ?>
								<tr><td colspan="6">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/general/ticket/new" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Ticket
			</a>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
    $('#tblitems').DataTable();
});
function turnOn(id) {
	$.get(base_url+'admin/general/coupon/turnon/'+id,{},function(){
		window.location.reload();
	});
}
function turnOff(id) {
	$.get(base_url+'admin/general/coupon/turnoff/'+id,{},function(){
		window.location.reload();
	});
}
</script>

