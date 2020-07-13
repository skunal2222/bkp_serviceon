<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<div>
		</div>
		<div class="col-lg-12">
			<div class="btn-plus">
			<a href="<?php echo base_url();?>admin/general/newreason" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Reason
			</a>
			</div>
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Reason List
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                       	<table class="table table-striped table-bordered table-hover" id="tblCuisine">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if (isset($cuisines)) { ?>
							<?php foreach ($cuisines as $item):?>
								<tr>
									<td>
										<?php echo $item['id'];?>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
										<a href="<?php echo base_url();?>admin/general/editreason/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a>
										<?php if($this->session->userdata("adminsession")['user_role'] == 1) {?>
										<a class="btn btn-danger icon-btn btn-xs" href="javascript:deleteCuisine(<?php echo $item['id'];?>);"><i class="fa fa-remove"></i></a>
										<?php }?>
									</td>
								</tr>
								<?php endforeach;?>
							<?php } else { ?>
								<tr><td colspan="3">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/general/newreason" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Reason
			</a>
		</div>
	</div>
</div>
<script>
function deleteCuisine(id) {
	if(confirm("Are you sure you want to delete this reason ?")) {
		$.get(base_url+"admin/general/deletereason/"+id,{},function(data){
			alert(data.msg);
			window.location.reload();
		},'json');
	}
}

$(document).ready(function(){
    $('#tblCuisine').DataTable();
});
</script>
