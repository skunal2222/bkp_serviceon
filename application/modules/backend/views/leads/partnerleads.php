
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
			<!-- <a href="<?php echo base_url();?>admin/package/addpackage" class="btn btn-primary view-contacts bottom-margin"> -->
				<!-- <i class="fa fa-plus"></i> Add -->
			</a>
			</div>
        	<div class="panel panel-default"  >
            	<div class="panel-heading" style="width:500">
                	Partner Leads
              	</div>
              <div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="tblCity">	<thead class="bg-info">
								<tr>
								<th>Sr No</th>
							    <th>Garage Name</th>
							    <th>Owner Name</th>
							    <th>Phone</th>
							    <th>Email</th>
							    <th>City</th>
							    <th>Requested On</th>
							    
								</tr>
							</thead>
							<?php if (isset($partners)) { ?>
						            <?php $i=1; foreach ($partners as $item):?>
								<tr>

								    <td><?php echo $i++;?></td>
									<td><?php echo $item['gname'];?></td>
									<td><?php echo $item['oname'];?></td>
									<td><?php echo $item['phone'];?></td>
									<td><?php echo $item['email'];?></td>
									<td><?php echo $item['city'];?></td>
									<td><?php echo $item['created_at'];?></td>
									
								</tr>
							    <?php endforeach;?>
						        <?php } else{?>
								
								<tr><td colspan="5">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
