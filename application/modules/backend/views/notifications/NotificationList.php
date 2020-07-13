<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>

<div id="page-wrapper">
	<div class="row" >
		<div>
			<form action="" method="post">
			
			</form>
		</div>
		<div class="col-lg-12" style="padding:0px">
			<div class="btn-plus">
			<a href="<?php echo base_url();?>admin/notifications/newnotification" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Add 
			</a>
			</div>
        	<div class="panel panel-default"  >
            	<div class="panel-heading" style="width:500">
                	Users List
              	</div>
              <div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="tblNotification">	
						<thead class="bg-info">
								 <tr>
	                              <th>Sr. No.</th>
	                              <th>User Name</th> 
								  <th>Email</th>
	                              <th>Mobile </th> 
	                              <th>Date </th>
	                              <th>Title </th>
	                              <th>Message </th>
                           		</tr>
							</thead>
							<tbody>
							 <?php 
                              if(!empty($users)) { ?>
                           <?php $i= 1; foreach ($users as $user):?>
                           <tr>
                              <td>
                                 <?php echo $i; ?>
                              </td>
                              <td>
                                 <?php echo $user['name'] ; ?>
                              </td> 
                               <td>
                                 <?php echo $user['email'] ; ?>
                              </td>
                              <td>
                                 <?php echo $user['mobile'];?>
                              </td> 
                               <td>
                                 <?php echo $user['updated_date'] ; ?>
                              </td>
                              <td>
                                 <?php echo $user['type'] ; ?>
                              </td>
                              <td>
                                 <?php echo $user['message'];?>
                              </td>
									
							</tr>
							    <?php $i++; endforeach;?>
						        <?php  } else{?>
								
								<!-- <tr><td colspan="5">Records not found.</td></tr> -->
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/notifications/newnotification" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Add 
			</a>
		</div>
	</div>
</div>
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal -->
<script>
$(document).ready(function(){
    $('#tblNotification').DataTable();
});
   /* function deleteVendor(a)
    {
        //alert("dfsdf");
       $.get(base_url + "admin/coupon/deletevendor/"+a, {vendorid: a}, function (data) {
                   // var html = "<option value=''>Select Area</option>";
                   
                   alert("Delete Complete");
                   window.location.reload();
                });
    }*/
</script>
    
    