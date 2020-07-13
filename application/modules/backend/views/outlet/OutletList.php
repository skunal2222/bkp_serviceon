<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>

<?php echo "123"; ?>

<div id="page-wrapper">
	<div class="row" >
		<div>
			<form action="" method="post">
			
			</form>
		</div>
		<div class="col-lg-12" style="padding:0px">
			<div class="btn-plus">
			<a href="<?php echo base_url();?>client/outlet/addoutlet" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Add Outlet
			</a>
			</div>
        	<div class="panel panel-default"  >
            	<div class="panel-heading" style="width:500">
                	Outlet List
              	</div>
              <div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="tblOutlet">	
						<thead class="bg-info">
								<tr>
	                <th>Sr. No.</th>  
								  <th>Company Name</th>
                  <th>Outlet Name </th>
                  <th>City</th> 
								  <th>Outlet Manager Name</th>
								  <th>Outlet Manager Mobile</th>
						      <th>Outlet Manager Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
							</thead>
							<tbody> 
							 <?php if(!empty($outlet)){?>
                           <?php $i= 1; foreach ($outlet as $item):?>
                           <tr>
                              <td>
                                 <?php echo $i; ?>
                              </td>  
                              <td> 
                                 <?php echo $item['reg_company_name'];?>
                              </td>
                               <td>
                                 <?php echo $item['outlet_name'];?>
                              </td>
                              <td>
                                 <?php echo $item['city'];?>
                              </td> 
                              <td>
                                 <?php echo $item['manager_name'];?>
                              </td>
                               <td>
                                 <?php echo $item['manager_mobile'];?>
                              </td>
                              <td>
                              	<?php echo $item['manager_email']; ?>
                              </td>
                              <td>
                                 <?php if($item['status'] == 1) {?>
                                 Active
                                 <?php }else{?>
                                 In-active
                                 <?php }?>
                              </td>
						                  <td><a href = "<?php echo base_url();?>client/outlet/edit/<?php echo $item['id'];?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a>
                              </td>
									
								</tr>
							    <?php $i++; endforeach;?>
						        <?php  } else{?>
								
								<!--<tr><td colspan="5">Records not found.</td></tr>-->
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>client/outlet/addoutlet" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Add Outlet
			</a>
		</div>
	</div>
</div>
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal -->
<script>
$(document).ready(function(){
    $('#tblOutlet').DataTable();
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
    
    