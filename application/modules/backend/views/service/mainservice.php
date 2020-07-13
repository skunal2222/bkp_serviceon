<link type="text/css" rel="stylesheet"
	href="<?php echo asset_url();?>css/datepicker3.css">

<link type="text/css" rel="stylesheet"
	href="<?php echo asset_url();?>css/bootstrap-timepicker.min.css">

<div id="page-wrapper">

	<div class="container-fluid">

		<div class="row bg-title">

			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

				<h4 class="page-title">Services</h4>
			</div>

			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

				<ol class="breadcrumb">

					<li><a href="#">Dashboard</a></li>

					<li class="active">Services</li>

				</ol>

			</div>

			<!-- /.col-lg-12 -->

		</div>

		<!-- /.row -->

		<div class="row">

			<div class="col-md-12">

				<div class="panel panel-info">

					<!--   <div class="panel-heading"> 

                         Category

                            </div>-->

					<div class="panel-wrapper collapse in" aria-expanded="true">

						<div class="panel-body">

							<div class="form-body">

								<ul class="nav customtab nav-tabs" role="tablist">

									<li role="presentation" class="nav-item"><a href="#basic"
										class="nav-link active" aria-controls="home" role="tab"
										data-toggle="tab" aria-expanded="true"><span
											class="visible-xs"><i class="ti-home"></i></span><span
											class="hidden-xs">Vehical Type</span></a></li>

									<li role="presentation" class="nav-item"><a href="#brand"
										class="nav-link" aria-controls="profile" role="tab"
										data-toggle="tab" aria-expanded="false"><span
											class="visible-xs"><i class="ti-user"></i></span> <span
											class="hidden-xs">Brand</span></a></li>

									<li role="presentation" class="nav-item"><a href="#model_info"
										class="nav-link" aria-controls="profile" role="tab"
										data-toggle="tab" aria-expanded="false"><span
											class="visible-xs"><i class="ti-user"></i></span> <span
											class="hidden-xs">Model</span></a></li>

									<li role="presentation" class="nav-item"><a href="#servicetype"
										class="nav-link" aria-controls="profile" role="tab"
										data-toggle="tab" aria-expanded="false"><span
											class="visible-xs"><i class="ti-user"></i></span> <span
											class="hidden-xs">Assign Service Type</span></a></li>

									<li role="presentation" class="nav-item"><a href="#cat"
										class="nav-link" aria-controls="profile" role="tab"
										data-toggle="tab" aria-expanded="false"><span
											class="visible-xs"><i class="ti-user"></i></span> <span
											class="hidden-xs">Service Groups</span></a></li>

									<li role="presentation" class="nav-item d-none"><a href="#meta_info"
										class="nav-link" aria-controls="profile" role="tab"
										data-toggle="tab" aria-expanded="false"><span
											class="visible-xs"><i class="ti-user"></i></span> <span
											class="hidden-xs">Service</span></a></li>

									<li role="presentation" class="nav-item d-none"><a href="#spare_info"
										class="nav-link" aria-controls="profile" role="tab"
										data-toggle="tab" aria-expanded="false"><span
											class="visible-xs"><i class="ti-user"></i></span> <span
											class="hidden-xs">Spare</span></a></li>
								</ul>

								<div class="tab-content">

									<div id="basic" role="tabpanel"
										class="tab-pane fade in active show" aria-expanded="true">

										<div id="">

											<div class="row">

												<div class="col-lg-12">

													<div class="btn-plus">

														<a href="javascript: add();"
															class="btn btn-primary view-contacts bottom-margin"
															style="color: white;"> <i class="fa fa-plus"></i>
															Vehical Type

														</a>

													</div>

													<div class="panel panel-default">

														<div class="panel-heading">Vehical Type List</div>

														<div class="panel-body">

															<div class="dataTable_wrapper">

																<table
																	class="table table-striped table-bordered table-hover"
																	id="tblcategory">

																	<thead class="bg-info">

																		<tr>

																			<th>ID</th>

																			<th>Vehical Type</th>
																			<th>Status</th>

																			<th>Action</th>

																		</tr>

																	</thead>

																	<tbody>

																					<?php if (isset($categories)) { ?>

																					<?php $i=1; foreach ($categories as $item){?>

																						<tr>

																			<td>

																								<?php echo $i ;?>

																							</td>

																			<td>

																								<?php echo $item['name'];?>

																							</td>
																			<td><?php if($item['status'] == 1) {?>Enable<?php }else{?>Disable <?php }?></td>

																			<td><a
																				href="javascript: edit(<?php echo $item['id']?>);"
																				class="btn btn-success icon-btn btn-xs"><i
																					class="fa fa-pencil" style="color: white;"></i></a></td>

																		</tr>

																						<?php  $i++;}?>

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

													<a href="javascript: add();"
														class="btn btn-primary view-contacts bottom-margin"
														style="color: white;"> <i class="fa fa-plus"></i> Vehical Type

													</a>
													

												</div>

											</div>

										</div>
									</div>

									<div id="brand" role="tabpanel" class="tab-pane fade"
										aria-expanded="true">

										<div id="">

											<div class="row">

												<div class="col-lg-12">

													<div class="btn-plus">

														<a href="javascript: addbrand();"
															class="btn btn-primary view-contacts bottom-margin"
															style="color: white;"> <i class="fa fa-plus"></i> Brand

														</a>

													</div>

													<div class="panel panel-default">

														<div class="panel-heading">Brand List</div>

														<div class="panel-body">

															<div class="dataTable_wrapper">

																<table
																	class="table table-striped table-bordered table-hover"
																	id="tblbrand">

																	<thead class="bg-info">

																		<tr>

																			<th>ID</th>

																			<th>Vehical Type</th>

																			<th>Brand</th>
																			
																			<th>Status</th>

																			<th>Action</th>

																		</tr>

																	</thead>

																	<tbody>

																					<?php if (isset($brands)) { ?>

																					<?php foreach ($brands as $item):?>

																						<tr>

																			<td>

																								<?php echo $item['id'];?>

																							</td>

																			<td>

																								<?php echo $item['category'];?>

																							</td>

																			<td>

																								<?php echo $item['name'];?>

																							</td>
																			<td><?php if($item['status'] == 1) {?>Enable<?php }else{?>Disable <?php }?></td>

																			<td><a
																				href="javascript: editbrand(<?php echo $item['id']?>);"
																				class="btn btn-success icon-btn btn-xs"><i
																					class="fa fa-pencil" style="color: white;"></i></a></td>

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

													<a href="javascript: addbrand();"
														class="btn btn-primary view-contacts bottom-margin"
														style="color: white;"> <i class="fa fa-plus"></i> Brand

													</a>

										
												</div>

											</div>

										</div>



									</div>


									<div id="model_info" role="tabpanel" class="tab-pane fade"
										aria-expanded="true">

										<div id="">

											<div class="row">

												<div class="col-lg-12">

													<div class="btn-plus">

														<a href="javascript: addmodel();"
															class="btn btn-primary view-contacts bottom-margin"
															style="color: white;"> <i class="fa fa-plus"></i> Model

														</a>

													</div>

													<div class="panel panel-default">

														<div class="panel-heading">Model List</div>

														<div class="panel-body">

															<div class="dataTable_wrapper">

																<table
																	class="table table-striped table-bordered table-hover"
																	id="tblmodel">

																	<thead class="bg-info">

																		<tr>

																			<th>ID</th>

																			<th>Model</th>

																			<th>Category</th>

																			<th>Brand</th>
																			
																			<th>Status</th>

																			<th>Action</th>

																		</tr>

																	</thead>

																	<tbody>

																					<?php if (isset($models)) { ?>

																					<?php foreach ($models as $item):?>

																						<tr>

																			<td>

																								<?php echo $item['id'];?>

																							</td>

																			<td>

																								<?php echo $item['name'];?>

																							</td>

																			<td>

																								<?php echo $item['category'];?>

																							</td>

																			<td>

																								<?php echo $item['brand'];?>

																							</td>
																			<td><?php if($item['status'] == 1) {?>Enable<?php }else{?>Disable <?php }?></td>

																			<td><a
																				href="javascript: editmodel(<?php echo $item['id']?>);"
																				class="btn btn-success icon-btn btn-xs"><i
																					class="fa fa-pencil" style="color: white;"></i></a></td>

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

													<a href="javascript: addmodel();"
														class="btn btn-primary view-contacts bottom-margin"
														style="color: white;"> <i class="fa fa-plus"></i> Model

													</a>

												</div>

											</div>

										</div>



									</div>



									<div id="servicetype" role="tabpanel" class="tab-pane fade"
										aria-expanded="true"> 
										 
											<div class="row">

												<div class="col-lg-12">

													<div class="btn-plus">

														<a href="javascript: addsub();"
															class="btn btn-primary view-contacts bottom-margin"
															style="color: white;"> <i class="fa fa-plus"></i>
															Assign Service Type

														</a>

													</div>

													<div class="panel panel-default">

														<div class="panel-heading">Service Type List</div>

														<div class="panel-body">

															<div class="dataTable_wrapper">

																<table
																	class="table table-striped table-bordered table-hover"
																	id="tblsubcat">

																	<thead class="bg-info">

																		<tr>

																			<th>ID</th>

																			<th>Name</th>

																			<th>Vehical Type</th>

																			<th>Brand</th>

																			<th>Model</th>
																			
																			<th>Status</th>

																			<th>Action</th>

																		</tr>

																	</thead>

																	<tbody>

																					<?php if (isset($subcategories)) { ?>

																					<?php foreach ($subcategories as $item):?>

																						<tr>

																			<td>

																								<?php echo $item['id'];?>

																							</td>

																			<td>

																								<?php echo $item['name'];?>

																							</td>

																			<td>

																								<?php echo $item['category'];?>

																							</td>
																			<td>

																								<?php echo $item['brand'];?>

																							</td>
																			<td>

																								<?php echo $item['model'];?>

																							</td>
																			<td><?php if($item['status'] == 1) {?>Enable<?php }else{?>Disable <?php }?></td>

																			<td><a
																				href="javascript: editsub(<?php echo $item['id']?>);"
																				class="btn btn-success icon-btn btn-xs"><i
																					class="fa fa-pencil" style="color: white;"></i></a></td>

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

													<a href="javascript: addsub();"
														class="btn btn-primary view-contacts bottom-margin"
														style="color: white;"> <i class="fa fa-plus"></i>
														Assign Service Type

													</a>

												</div>

											</div> 

									</div>

									<div id="cat" role="tabpanel" class="tab-pane fade"
										aria-expanded="true">

										<div id="">

											<div class="row">

												<div class="col-lg-12">

													<div class="btn-plus">

														<a href="javascript: addcatsubcat();"
															class="btn btn-primary view-contacts bottom-margin"
															style="color: white;"> <i class="fa fa-plus"></i>
															 Service Group

														</a>

													</div>

													<div class="panel panel-default">

														<div class="panel-heading">Service Group List</div>

														<div class="panel-body">

															<div class="dataTable_wrapper">

																<table
																	class="table table-striped table-bordered table-hover"
																	id="tblcatsub">

																	<thead class="bg-info">

																		<tr>

																			<th>ID</th>
																			<th>Name</th>
																			<th>Vehical Type</th>
																			<th>Brand</th>
																			<th>Model</th>
																			<th>Service Type</th>
																			<th>Status</th>
																			<th>Action</th>

																		</tr>

																	</thead>

																	<tbody>

																					<?php if (isset($catsubcats)) { ?>

																					<?php foreach ($catsubcats as $item):?>

																						<tr>

																			<td>

																								<?php echo $item['id'];?>

																							</td>

																			<td>

																								<?php echo $item['name'];?>

																							</td>
																			<td>

																								<?php echo $item['category'];?>

																							</td>
																			<td>

																								<?php echo $item['brand'];?>

																							</td>
																			<td>

																								<?php echo $item['model'];?>

																							</td>
																			<td>

																								<?php echo $item['subcategory'];?>

																							</td>
																			<td><?php if($item['status'] == 1) {?>Enable<?php }else{?>Disable <?php }?></td>

																			<td><a
																				href="javascript: editcatsubcat(<?php echo $item['id']?>);"
																				class="btn btn-success icon-btn btn-xs"><i
																					class="fa fa-pencil" style="color: white;"></i></a></td>

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

													<a href="javascript: addcatsubcat();"
														class="btn btn-primary view-contacts bottom-margin"
														style="color: white;"> <i class="fa fa-plus"></i>Service Group 
													</a>
													<a href = "" class="btn btn-success view-contacts bottom-margin" style="color: white;" data-toggle="modal" data-target="#myModal" onclick="loadPopup();"><i class="fa fa-upload"></i> Upload</a>
										
													<span class="pull-right"><a href="javascript:downloadReport();" class="btn btn-info" style="color: white;">Download</a></span>
												</div>

											</div>

										</div>

									</div>

									<div id="meta_info" role="tabpanel" class="tab-pane fade"
										aria-expanded="true">

										<div id="">

											<div class="row">

												<div class="col-lg-12">

													<div class="btn-plus">

														<a href="javascript: addservice();"
															class="btn btn-primary view-contacts bottom-margin"
															style="color: white;"> <i class="fa fa-plus"></i> Service

														</a>

													</div>

													<div class="panel panel-default">

														<div class="panel-heading">Service List</div>

														<div class="panel-body">

															<div class="dataTable_wrapper">

																<table
																	class="table table-striped table-bordered table-hover" id="tblservice">

																	<thead class="bg-info">

																		<tr>

																			<th>ID</th>
																			<th>Name</th>
																			<th>Price</th>
																			<th>Vehical Type</th>
																			<th>Brand</th>
																			<th>Model</th>
																			<th>Service Type</th>
																			<th>Service Group</th>
																			 <th>Status</th>
																			<th>Action</th>

																		</tr>

																	</thead>

																	<tbody>

																					<?php if (isset($services)) { ?>

																					<?php foreach ($services as $item):?>

																						<tr>

																			<td>

																								<?php echo $item['id'];?>

																							</td>

																			<td>

																								<?php echo $item['name'];?>

																							</td>
																			<td>

																								<?php echo $item['price'];?>

																							</td>
																			<td>

																								<?php echo $item['category'];?>

																							</td>
																			<td>

																								<?php echo $item['brand'];?>

																							</td>
																			<td>

																								<?php echo $item['model'];?>

																							</td>
																			<td>

																								<?php echo $item['subcategory'];?>

																							</td>
																							<td>

																								<?php echo $item['subcat'];?>

																							</td>
																			  <td><?php if($item['status'] == 1) {?>Enable<?php }else{?>Disable <?php }?></td>

																			<td><a
																				href="javascript: editservice(<?php echo $item['id']?>);"
																				class="btn btn-success icon-btn btn-xs"><i
																					class="fa fa-pencil" style="color: white;"></i></a></td>

																		</tr>

																						<?php endforeach;?>

																					<?php } else { ?>

																						<tr>
																			Records not found.
																		</tr>

																					<?php }?>

																					</tbody>

																</table>

															</div>

														</div>

													</div>

													<a href="javascript: addservice();"
														class="btn btn-primary view-contacts bottom-margin"
														style="color: white;"> <i class="fa fa-plus"></i> Service

													</a>
												<a href = "" class="btn btn-success view-contacts bottom-margin" style="color: white;" data-toggle="modal" data-target="#myModal" onclick="loadPopup2();"><i class="fa fa-upload"></i> Upload</a>
												<span class="pull-right"><a href="javascript:downloadforservice();" class="btn btn-info" style="color: white;">Download</a></span>
												</div>

											</div>

										</div>

									</div>



									<div id="spare_info" role="tabpanel" class="tab-pane fade"
										aria-expanded="true">

										<div id="">

											<div class="row">

												<div class="col-lg-12">

													<div class="btn-plus">

														<a href="javascript: addspare();"
															class="btn btn-primary view-contacts bottom-margin"
															style="color: white;"> <i class="fa fa-plus"></i> Spare

														</a>

													</div>

													<div class="panel panel-default">

														<div class="panel-heading">Spare List</div>

														<div class="panel-body">

															<div class="dataTable_wrapper">

																<table
																	class="table table-striped table-bordered table-hover"
																	id="tblspare">

																	<thead class="bg-info">

																		<tr>

																			<th>ID</th>
																			<th>Name</th>
																			<th>Price</th>
																			<th>Vehical Type</th>
																			<th>Brand</th>
																			<th>Model</th>
																			<th>Service Type</th>
																			<th>Status</th>
																			<th>Action</th>

																		</tr>

																	</thead>

																	<tbody>

																					<?php if (isset($spares)) { ?>

																					<?php foreach ($spares as $item):?>

																						<tr>

																			<td>

																								<?php echo $item['id'];?>

																							</td>

																			<td>

																								<?php echo $item['name'];?>

																							</td>
																			<td>

																								<?php echo $item['price'];?>

																							</td>
																			<td>

																								<?php echo $item['category'];?>

																							</td>
																			<td>

																								<?php echo $item['brand'];?>

																							</td>
																			<td>

																								<?php echo $item['model'];?>

																							</td>
																			<td>

																								<?php echo $item['subcategory'];?>

																							</td>
																			<td><?php if($item['status'] == 1) {?>Enable<?php }else{?>Disable <?php }?></td>

																			<td><a
																				href="javascript: editspare(<?php echo $item['id']?>);"
																				class="btn btn-success icon-btn btn-xs"><i
																					class="fa fa-pencil" style="color: white;"></i></a></td>

																		</tr>

																						<?php endforeach;?>

																					<?php } else { ?>

																						<tr>
																			Records not found.
																		</tr>

																					<?php }?>

																					</tbody>

																</table>

															</div>

														</div>

													</div>

													<a href="javascript: addspare();"
														class="btn btn-primary view-contacts bottom-margin"
														style="color: white;"> <i class="fa fa-plus"></i> Spare

													</a>
													
													<a href = "" class="btn btn-success view-contacts bottom-margin" style="color: white;" data-toggle="modal" data-target="#myModal" onclick="loadPopup1();"><i class="fa fa-upload"></i> Upload</a>
													

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

</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title" id="myTitle">Upload</h4>
      		</div>
      		<div class="modal-body" id="upload-popup">
        		<form id="Upload" name="Upload" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="type" value="new" />
		<div class="row">
			<div class="col-lg-12 margin-bottom-5">
				<div class="form-group" id="error-cityid">
					<label class="control-label col-sm-3">File <span
						class='text-danger'>*</span></label>
					<div class="col-sm-5">
						<input type="file" name="menu" required="required">
					</div>
					<div class="messageContainer col-sm-4"></div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-12 margin-bottom-5">
				<div class="form-group">
					<div class="col-sm-5">
						<button type="submit" id="upload_menu" class="btn btn-success" >Upload</button>
					</div>
				</div>
			</div>
		</div>
		<br>
	</form>
      		</div>
      		<!-- div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div-->
    	</div>
  	</div>
</div>

<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>

<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>

<script src="<?php echo asset_url();?>js/bootstrap-timepicker.min.js"></script>

<script src="<?php echo asset_url();?>js/selectize.min.js"></script>

<script src="<?php echo asset_url();?>js/jquery.form.js"></script>

<script>
	// $(document).ready(function(){
	// 	$('.customtab > .nav-item > .nav-link').click(function(){
	// 		//alert("");
	// 		location.reload();

	// 	})
	// });
	
		$(document).ready(function(){
		    $('#tblcategory').DataTable();
		});
		$(document).ready(function(){
		    $('#tblbrand').DataTable();
		});
		$(document).ready(function(){
		    $('#tblmodel').DataTable();
		});
		$(document).ready(function(){
		    $('#tblsubcat').DataTable();
		});
		$(document).ready(function(){
		    $('#tblcatsub').DataTable();
		});
		$(document).ready(function(){
		    $('#tblservice').DataTable();
		});
		$(document).ready(function(){
		    $('#tblspare').DataTable();
		});

			$.fn.datepicker.defaults.format = "dd-mm-yyyy";

			$('#special_from_date').datepicker().on('changeDate', function(ev){

				$('#special_from_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			});

			$('#special_to_date').datepicker().on('changeDate', function(ev){

				$('#special_to_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			});

			$('#new_to_date').datepicker().on('changeDate', function(ev){

				$('#new_to_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			});

			$('#new_from_date').datepicker().on('changeDate', function(ev){

				$('#new_from_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			});

			$('#avail_from_date').datepicker().on('changeDate', function(ev){

				$('#avail_from_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			});

			$('#avail_to_date').datepicker().on('changeDate', function(ev){

				$('#avail_to_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			}); 

			/* $('#new_from_date').datepicker().on('changeDate', function(ev){

				$('#new_from_date').bootstrapValidator('revalidateField', 'cycle_effective_date');

			}); */



		</script>

<script>



//         $.post(base_url+"signup", { name: $("#su_name").val() }, function(data){

//     		if(data.is_register == 1) {

//     			alert("SignUp Successful.");

//     			$("#signInModal").modal("hide");

//     			//$("#otpModal").modal("show");

//     			//$("#lg_uid").val(data.id);

//     			window.location.reload();

//     		} else {

//     			$("#su_response").show();

//     			$("#su_response").html(data.msg);

//     		}

//     	},'json');

        

        $(".attrgrp" ).change(function() {

           var attrgrp = $("#attribute_group_id").val();

           //alert(attrgrp);

          	 $.get(base_url + "admin/productAttribute", { attribute_group_id : attrgrp }, function (data) {

	              // alert(data);

	    	      // alert('Status is changed');

	        	   $("#attributes").empty();

	        	   $("#attributes").html(data);

        	   

      			});

        	});

        </script>



<script>

$('#addProduct').bootstrapValidator({

	container: function($field, validator) {

		return $field.parent().next('.messageContainer');

   	},

    feedbackIcons: {

        validating: 'glyphicon glyphicon-refresh'

    },

    excluded: ':disabled',

    fields: {

        name: {

            validators: {

                notEmpty: {

                    message: 'Name is required and cannot be empty'

                }

            }

        },

        sku: {

            validators: {

                notEmpty: {

                    message: 'SKU is required and cannot be empty'

                }

            }

        },

    	price : {

	        validators: {

	        	numeric: {

                    message: 'The value is not a number',

                }, 

	            notEmpty: {

	                message: 'Price is required and cannot be empty'

	            }

	        }

	    },

	    special_price : {

	        validators: {

	        	numeric: {

                    message: 'The value is not a number',

                } 

	            

	        }

	    },

	    minimum_quantity : {

	        validators: {

	        	numeric: {

                    message: 'The value is not a number',

                } 

	            

	        }

	    },

	    quantity: {

            validators: {

                numeric: {

                    message: 'The value is not a number',

                }, 

                notEmpty: {

	                message: 'Quantity is required and cannot be empty'

	            }

            }

        }, 

        vendor_id : {

        	validators :{

					notEmpty: {

							message : 'Please select a vendor'

						}

					}

            }

    }

}).on('success.form.bv', function(event,data) {

	// Prevent form submission

	event.preventDefault();

	addProduct();

});



function addProduct() {

	var options = {

	 		target : '#response', 

	 		beforeSubmit : showAddRequest,

	 		success :  showAddResponse,

	 		url : base_url+'admin/product/add',

	 		semantic : true,

	 		dataType : 'json'

	 	};

   	$('#addProduct').ajaxSubmit(options);

}



function showAddRequest(formData, jqForm, options){

	$("#response").hide();

   	var queryString = $.param(formData);

	return true;

}

   	

function showAddResponse(resp, statusText, xhr, $form){

	if(resp.status == '0') {

		$("#response").removeClass('alert-success');

       	$("#response").addClass('alert-danger');

		$("#response").html(resp.msg.name);

		$("#response").show();

  	} else {

  		$("#response").removeClass('alert-danger');

        $("#response").addClass('alert-success');

        $("#response").html(resp.msg);

        $("#response").show();

        alert(resp.msg);

        window.location.href = base_url+"admin/product/add";

  	}

}



function abc(input){

	//alert('hello');

	$(input).val('1')

}





//Image Preview 

var images = $('.imageOutput')



$(".imageUpload").change(function(event){

    readURL(this);

});



function readURL(input) {



    if (input.files && input.files[0]) {

        $.each(input.files, function() {

            var reader = new FileReader();

            reader.onload = function (e) {           

                images.append('<img height="100" width="100" src="'+ e.target.result+'" /> <input type="radio" name="is_image[]" value="0" onclick="abc(this)" />');

            }

            reader.readAsDataURL(this);

        });

        

    }

}



$(function () {

    $("input[type='checkbox']").change(function () {

        $(this).siblings('ul')

            .find("input[type='checkbox']")

            .prop('checked', this.checked);

    });

});

</script>

<script>

$(document).ready(function(){

    $('#tblcategory').DataTable();

});

</script>



<script>



function add()

{

	//alert('hello');

	$.post(base_url+"admin/category/new",{},function(data) {

		//alert(data);

		$("#basic").html(data);

		

	},'html');



}



function edit(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/category/edit",{id: id},function(data) {

		$("#basic").html(data);

		

	},'html');



}



function addsub()

{

	//alert('hello');

	$.post(base_url+"admin/subcategory/new",{},function(data) {

		//alert(data);

		$("#servicetype").html(data);

		

	},'html');



}



function editsub(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/subcategory/edit",{id: id},function(data) {

		$("#servicetype").html(data);

		

	},'html');



}


function addcatsubcat()

{

	//alert('hello');

	$.post(base_url+"admin/catsubcat/new",{},function(data) {

		//alert(data);

		$("#cat").html(data);

		

	},'html');



}



function editcatsubcat(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/catsubcat/edit",{id: id},function(data) {

		$("#cat").html(data);

		

	},'html');



}

function addservice()

{

	//alert('hello');

	$.post(base_url+"admin/service/new/0",{},function(data) {

		//alert(data);

		$("#meta_info").html(data);

		

	},'html');



}



function editservice(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/service/edit",{id: id},function(data) {

		$("#meta_info").html(data);

		

	},'html');



}


function addbrand()

{

	//alert('hello');

	$.post(base_url+"admin/brand/new",{},function(data) {

		//alert(data);

		$("#brand").html(data);

		

	},'html');



}



function editbrand(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/brand/edit",{id: id},function(data) {

		$("#brand").html(data);

	},'html');

}

function addmodel()

{

	//alert('hello');

	$.post(base_url+"admin/model/new",{},function(data) {

		//alert(data);

		$("#model_info").html(data);

		

	},'html');



}



function editmodel(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/model/edit",{id: id},function(data) {

		$("#model_info").html(data);

		

	},'html');



}

function addspare()

{

	//alert('hello');

	$.post(base_url+"admin/spare/new/0",{},function(data) {

		//alert(data);

		$("#spare_info").html(data);

		

	},'html');



}



function editspare(id)

{

	//alert('hello');

	//alert(id);

	$.post(base_url+"admin/spare/edit",{id: id},function(data) {

		$("#spare_info").html(data);

		

	},'html');



}

function loadPopup() {
	//$.get(base_url+"admin/menu/upload",{},function(data){
	//	$("#upload-popup").html(data);
		//$("h4#myTitle").html(name);
		$('#Upload').bootstrapValidator({
			container: function($field, validator) {
				return $field.parent().next('.messageContainer');
		   	},
		    feedbackIcons: {
		        validating: 'glyphicon glyphicon-refresh'
		    },
		    excluded: ':disabled',
		    fields: {
		    	menu: {
		            validators: {
		                notEmpty: {
		                    message: 'The Upload File is required and cannot be empty'
		                },
		                file: {
		                    extension: 'xls',
		                    type: 'application/vnd.ms-excel',
		                    maxSize: 2097152,   // 2048 * 1024
		                    message: 'Please select .xls file only'
		                }
		            }
		        }
		    }
		}).on('success.form.bv', function(event,data) {
			// Prevent form submission
			event.preventDefault();
			uploadMenu();
		});
	//},'html');
}

function uploadMenu() {
	//alert("hii");
	var options = {
    	target:        '#messageContainer',
        beforeSubmit:  showRequest,
        success:       showResponse,
        url : base_url+'admin/menu/import',
 		semantic : true,
 		dataType : 'json'
    };
	$('#Upload').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
}

function showResponse(responseText, statusText)  {
	   if(responseText.status == 0)
	   {
		   alert(responseText.message);
	   }else {
		   alert(responseText.message);
		   window.location.href = base_url+"admin/mainservice";
	  }	
	}

function loadPopup1() {
	//$.get(base_url+"admin/menu/upload",{},function(data){
	//	$("#upload-popup").html(data);
	//	$("h4#myTitle").html(name);
		$('#Upload').bootstrapValidator({
			container: function($field, validator) {
				return $field.parent().next('.messageContainer');
		   	},
		    feedbackIcons: {
		        validating: 'glyphicon glyphicon-refresh'
		    },
		    excluded: ':disabled',
		    fields: {
		    	menu: {
		            validators: {
		                notEmpty: {
		                    message: 'The Upload File is required and cannot be empty'
		                },
		                file: {
		                    extension: 'xls',
		                    type: 'application/vnd.ms-excel',
		                    maxSize: 2097152,   // 2048 * 1024
		                    message: 'Please select .xls file only'
		                }
		            }
		        }
		    }
		}).on('success.form.bv', function(event,data) {
			// Prevent form submission
			event.preventDefault();
			uploadMenu1();
		});
	//},'html');
}

function uploadMenu1() {
	//alert("hii");
	var options = {
    	target:        '#messageContainer',
        beforeSubmit:  showRequest1,
        success:       showResponse1,
        url : base_url+'admin/menu/import1',
 		semantic : true,
 		dataType : 'json'
    };
	$('#Upload').ajaxSubmit(options);
}

function showRequest1(formData, jqForm, options) {
}

function showResponse1(responseText, statusText)  {
	   if(responseText.status == 0)
	   {
		   alert(responseText.message);
	   }else {
		   alert(responseText.message);
		   window.location.href = base_url+"admin/mainservice";
	  }	
	}

function loadPopup2() {
	//$.get(base_url+"admin/menu/upload",{},function(data){
	//	$("#upload-popup").html(data);
	//	$("h4#myTitle").html(name);
		$('#Upload').bootstrapValidator({
			container: function($field, validator) {
				return $field.parent().next('.messageContainer');
		   	},
		    feedbackIcons: {
		        validating: 'glyphicon glyphicon-refresh'
		    },
		    excluded: ':disabled',
		    fields: {
		    	menu: {
		            validators: {
		                notEmpty: {
		                    message: 'The Upload File is required and cannot be empty'
		                },
		                file: {
		                    extension: 'xls',
		                    type: 'application/vnd.ms-excel',
		                    //maxSize: 2097152,   // 2048 * 1024
		                    message: 'Please select .xls file only'
		                }
		            }
		        }
		    }
		}).on('success.form.bv', function(event,data) {
			// Prevent form submission
			event.preventDefault();
			uploadMenu2();
		});
	//},'html');
}

function uploadMenu2() {
	//alert("hii");
	var options = {
    	target:        '#messageContainer',
        beforeSubmit:  showRequest1,
        success:       showResponse1,
        url : base_url+'admin/menu/import2',
 		semantic : true,
 		dataType : 'json'
    };
	$('#Upload').ajaxSubmit(options);
}

function showRequest2(formData, jqForm, options) {
}

function showResponse2(responseText, statusText)  {
	   if(responseText.status == 0)
	   {
		   alert(responseText.message);
	   }else {
		   alert(responseText.message);
		   window.location.href = base_url+"admin/mainservice";
	  }	
	}

function downloadReport() {
	window.location.href = base_url+'admin/menu/downloadcatofsubcat';
}

function downloadforservice(){
	window.location.href = base_url+'admin/menu/downloaduptoservice';
}
</script>