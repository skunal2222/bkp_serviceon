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
			<a href="<?php echo base_url();?>admin/vehicle/newvehicle" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Add Vehicle
			</a>
			</div>
        	<div class="panel panel-default"  >
            	<div class="panel-heading" style="width:500">
                	Vehicle List
              	</div>
              <div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="tblVehicle">	
						<thead class="bg-info">
								 <tr>
	                              <th>Sr. No.</th>
	                              <th>User Name</th> 
								  <th>Vehicle Number</th>
	                              <th>Brand </th>
	                              <th>Model</th> 
	                              <th>Status</th>
	                              <th>Action</th>
                           		</tr>
							</thead>
							<tbody>
							 <?php 
                              if(!empty($vehicle)) { ?>
                           <?php $i= 1; foreach ($vehicle as $item):?>
                           <tr>
                              <td>
                                 <?php echo $i; ?>
                              </td>
                              <td>
                                 <?php echo $item['username'] ; ?>
                              </td> 
                               <td>
                                 <?php echo $item['vehicle_no'] ; ?>
                              </td>
                              <td>
                                 <?php echo $item['brandname'];?>
                              </td>
                               <td>
                                 <?php echo $item['modelname'];?>
                              </td> 
                              <td>
                                 <?php if($item['status'] == 1) {?>
                                 Active
                                 <?php }else{?>
                                 In-active
                                 <?php }?>
                              </td>
						      <td><a href = "<?php echo base_url();?>admin/vehicle/editvehicle/<?php echo $item['id'];?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a>
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
			<a href="<?php echo base_url();?>admin/vehicle/newvehicle" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Add Vehicle
			</a>
		</div>
	</div>
</div>
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal -->
<script>
$(document).ready(function(){
    $('#tblVehicle').DataTable();
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
    
    