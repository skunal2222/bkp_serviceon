<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h4 class="page-title">Role</h4>
			</div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="#">Dashboard</a></li>
					<li class="active">Role</li>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info">
					<!--   <div class="panel-heading">Category</div>-->
					<div class="panel-wrapper collapse in" aria-expanded="true">
						<div class="panel-body">
							<div class="form-body">
								<ul class="nav customtab nav-tabs" role="tablist">
									<li role="presentation" class="nav-item">
									  <a href="#basic" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Role</span></a>
									</li>
									<li role="presentation" class="nav-item">
									  <a href="#image" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Employee</span></a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="basic" role="tabpanel"
										class="tab-pane fade in active show" aria-expanded="true">
										<div id="">
											<div class="row">
												<div class="col-lg-12">
													<div class="btn-plus">
														<a href="javascript: add();" class="btn btn-primary view-contacts bottom-margin" style="color: white;"> <i class="fa fa-plus"></i>Role</a>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">Role List</div>
														<div class="panel-body">
															<div class="dataTable_wrapper">
																<table class="table table-striped table-bordered table-hover" id="tblcategory">
																	<thead class="bg-info">
																		<tr>
																			<th>ID</th>
																			<th>Role</th> 
																			<th>Status</th>
																			<th>Action</th>
																		</tr>
																	</thead>
																	<tbody>
																	<?php if (isset($Roles)) { ?>
																	<?php $i=1; foreach ($Roles as $item){?>
																	<tr>
																		<td>
																		  <?php echo $i;?>
																		</td>
																		<td>
																		  <?php echo $item['name'];?>
																		</td>
																		<td>
										                                	<?php if($item['status'] == 1) {?>
																				Active
																			<?php }else{?>
																				In-active
																			<?php }?>
										                               </td>
																		<td>
																		  <a href="javascript: edit(<?php echo $item['id']?>);" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil" style="color: white;"></i></a>
																		</td>
																	</tr> 
																	<?php $i++; }?>
																	<?php } else { ?>
																	<tr>
																		<td colspan="4">Records not found.</td>
																	</tr>
																	<?php }?>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<a href="javascript: add();" class="btn btn-primary view-contacts bottom-margin" style="color: white;"> <i class="fa fa-plus"></i> Role</a>
												</div>
											</div>
										</div>
									</div>
									<div id="image" role="tabpanel" class="tab-pane fade" aria-expanded="true">
										<div id="">
											<div class="row">
												<div class="col-lg-12">
													<div class="btn-plus">
														<a href="javascript: addemployee();" class="btn btn-primary view-contacts bottom-margin" style="color: white;"> <i class="fa fa-plus"></i>
															Employee
														</a>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">Employee List</div>
														<div class="panel-body">
															<div class="dataTable_wrapper">
																<table class="table table-striped table-bordered table-hover" id="tblcategory">
																	<thead class="bg-info">
																		<tr>
																			<th>ID</th>
																			<th>Employee</th>
																			<th>Email</th>
																			<th>Mobile</th>
																			<th>Role name</th>
																			<th>Action</th>
																		</tr>
																	</thead>
																	<tbody>
																	<?php if (isset($Emps)) { ?>
																	<?php foreach ($Emps as $item):?>
																	<tr>
																		<td>
																			<?php echo $item['id'];?>
																		</td>
																		<td>
																			<?php echo $item['name'];?>
																		</td>
																		<td>
																			<?php echo $item['email'];?>
																		</td>
																		<td>
																			<?php echo $item['mobile'];?>
																		</td>
																		<td>
																			<?php echo $item['role'];?>
																		</td>
																		<td><a href="javascript: editemployee(<?php echo $item['id']?>);" class="btn btn-success icon-btn btn-xs">
																				<i class="fa fa-pencil" style="color: white;"></i>
																			</a>
																			<a data-toggle="modal" data-target="#uploadModal">Documents</a>
																			</td>
																	</tr>
																	<?php endforeach;?>
																	<?php } else { ?>
																	<tr>
																		<td colspan="4">Records not found.</td>
																	</tr>
																	<?php }?>
																</tbody>
																</table>
															</div>
														</div>
													</div>
													<a href="javascript: addemployee();" class="btn btn-primary view-contacts bottom-margin" style="color: white;">
													 <i class="fa fa-plus"></i> Employee
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>
<div id="uploadModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form enctype="multipart/form-data" name="upload_frm" id="upload_frm" style="padding: 15px 19px 20px 10px;" method="post">
				<div class="modal-header" style="padding: 0px;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<center>
						<h4>Upload Document</h4>
					</center>
				</div>
				<br/><br/>
				<div class="form-group label-floating is-empty">
					<div>
						<div class="row profile-row">
							<!--<div class="col-lg-4" style="margin-left: 115px;">
							Bank Statement
						</div>-->
						<?php foreach ($uploads as $row):?>
						<div class="col-lg-4">
							<a class="link"	onclick="window.open('<?php echo base_url().$row['documents'];?>', '_blank');">Documents</a>
						</div>
						<?php endforeach;?>
					</div>
						<br/>
					</div>
				</div>
				<br/>
			</form>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
    $('#tblcategory').DataTable();
});

function add(){
	//alert('hello');
	$.post(base_url+"admin/role/new",{},function(data) {
		//alert(data);
		$("#basic").html(data);
	},'html');
}

function edit(id){
	//alert('hello');
	//alert(id);
	$.post(base_url+"admin/role/edit",{id: id},function(data) {
		$("#basic").html(data);
	},'html');
}

function addemployee(){
	//alert('hello');
	$.post(base_url+"admin/emp/new",{},function(data) {
		//alert(data);
		$("#image").html(data);
	},'html');
}

function editemployee(id){
	//alert('hello');
	//alert(id);
	$.post(base_url+"admin/emp/edit",{id: id},function(data) {
		$("#image").html(data);
	},'html');
}
</script>