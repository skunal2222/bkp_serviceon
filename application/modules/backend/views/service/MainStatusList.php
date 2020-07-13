<style>
.dataTables_filter label{
	display : none;
}
</style>
<div id="page-wrapper">
  <div class="container-fluid">
	<div class="row">
		<div>
		</div>
		<div class="col-lg-12">
			<div class="btn-plus">
			<a href="<?php echo base_url();?>admin/mainstatus/new" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Status
			</a>
			</div>
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Status List
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                       	<table class="table table-striped table-bordered table-hover" id="tblcategory">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Status</th>
     								<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if (isset($categories)) { ?>
							<?php foreach ($categories as $item):?>
								<tr>
									<td>
										<?php echo $item['id'];?>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
										<?php if($item['status'] == 1){ echo "Enable"; } else { echo "Disable"; }?>
									</td>
									<td><a href = "<?php echo base_url();?>admin/mainstatus/edit/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a></td>
								</tr>
								<?php endforeach;?>
							<?php } else { ?>
								<tr><td colspan="4">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/mainstatus/new" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i>Status
			</a>
		</div>
	</div>
  </div>
</div>

<script>
$(document).ready(function(){
    $('#tblcategory').DataTable();
});
</script>