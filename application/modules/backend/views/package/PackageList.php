
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
			<a href="<?php echo base_url();?>admin/package/addpackage" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Add
			</a>
			</div>
        	<div class="panel panel-default"  >
            	<div class="panel-heading" style="width:500">
                	Package List
              	</div>
              <div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="tblCity">	<thead class="bg-info">
								<tr>
								<th>Sr No</th>
							    <th>Package Name</th>
							    <th>Package Validity (Year)</th>
							    <th>User per use</th>
							    <th>Short Description</th>
							    <th>Long Description</th>
							    <th>Best Price</th>
							    <th>Special Price</th>
							    <th>Action</th>	
								</tr>
							</thead>
							<?php if (isset($package)) { ?>
						            <?php $i=1; foreach ($package as $item):?>
								<tr>
								    <td><?php echo $i++;?></td>
									<td><?php echo $item['package_name'];?></td>
									<td><?php echo $item['year'];?></td>
									<td><?php echo $item['service_used_validity'];?></td>
									<td><?php echo $item['short_description'];?></td>
									<td><?php echo $item['long_description'];?></td>
									<td><?php echo $item['best_price'];?></td>
									<td><?php echo $item['special_price'];?></td>
							        <td><a href = "<?php echo base_url();?>admin/package/update/<?php echo $item['id'];?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a>
                                    </td>
									
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
			<a href="<?php echo base_url();?>admin/package/addpackage" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Add 
			</a>
		</div>
	</div>
</div>
