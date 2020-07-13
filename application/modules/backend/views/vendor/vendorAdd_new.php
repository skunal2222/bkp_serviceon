<style>

.margin-bottom-5{
	margin-bottom: 5px;
}

#map-canvas {

	width: 100%;
	height: 350px;

}

.service-txt{
	height: 34px;
	padding: 6px 12px;
	font-size: 14px;
	line-height: 1.42857143;
	color: #555;
	background-color: #fff;
	background-image: none;
	border: 1px solid #ccc;
	border-radius: 4px;
}

.panel-group .panel+.panel {
	margin-top: 6px !important ; 
}

</style>
<?php
/* if($_SESSION['vendor_id']!='')
{
//echo '<script>window.location =  "' . base_url () . 'admin/vendor/new" ; </script>';
echo '<script>  window.onload = function () { xyz();}</script>';

} */
?>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/selectize.bootstrap3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
<!--  <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<link href="<?php echo asset_url(); ?>css/jquery.multiselect.css" rel="stylesheet" />
<script src="<?php echo asset_url(); ?>js/jquery.multiselect.js"></script>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.almightree.js"></script>
<link rel="stylesheet" href="<?php echo asset_url(); ?>css/almightree.css">
<style>
.select2{
	width : 100% !important;
}

</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<div class="row" style="padding-left: 259px;padding-right: 35px;">
	<div class="col-lg-12">
		<h3 class="page-header">Add Vendor</h3>
		<div class="panel panel-info">
			<div class="panel-wrapper collapse in" aria-expanded="true">
				<div class="panel-body">
					<div class="form-body">
						<ul class="nav customtab nav-tabs" role="tablist">
							<li role="presentation" class="nav-item" title="Basic details">
								<a href="#basic" id="Basic_li" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Basic Details</span></a>
							</li>
							<li role="presentation" class="nav-item disabled" title="Please fill basic details">
								<a href="#meta_info" id="Service_li" class="nav-link disabled" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Services</span></a>
							</li>
							<li role="presentation" class="nav-item disabled" title="Please fill basic details">
								<a href="#spare_info" id="Spare_li" class="nav-link disabled" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Spares</span></a>
							</li>
							<li role="presentation" class="nav-item disabled" title="Please fill basic details">
								<a href="#Zone" id="Zone_li" class="nav-link disabled" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Zone</span></a>
							</li>
							<li role="presentation" class="nav-item disabled" title="Please fill basic details">
								<a href="#Billing" id="Billing_li" class="nav-link disabled" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Billing</span></a>
							</li>

						</ul>
						<div class="tab-content">
							<div id="basic" class="tab-pane fade in active">
								<form id="addrestaurant" name="addrestaurant" action="" method="post">

									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-body">
													<div class="row">
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-name">
																<label class="control-label col-sm-5">Mechanic Name <span class='text-danger'>*</span></label>
																<div class="col-sm-10">
																	<input type="text" autocomplete="off" class="form-control" id="garage_name" name="garage_name"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-name">
																<label class="control-label col-sm-5">Vendor Name <span class='text-danger'>*</span></label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" id="name" name="name"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
													</div>
													<div class="row">

														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-landmark">
																<label class="control-label col-sm-5">Email <span class='text-danger'></span></label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" id="email" name="email" autocomplete="off"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-landline_1">
																<label class="control-label col-sm-5">Mobile Number <span class='text-danger'>*</span></label>
																<div class="col-sm-10">
																	<input type="text" autocomplete="off" class="form-control" id="mobile" name="mobile"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>  
													</div> 
													<div class="row">
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-landline_2">
																<label class="control-label col-sm-5">Alternate Number</label>
																<div class="col-sm-10">
																	<input type="text" autocomplete="off" class="form-control" id="landline" name="landline"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-address">
																<label class="control-label col-sm-5">Address <span class='text-danger'>*</span></label>
																<div class="col-sm-10">
																	<textarea class="form-control" autocomplete="off" rows="3" id="address" name="address"></textarea>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="form-group" id="error-category_id">
																<label class="control-label col-sm-5">Category<span class='text-danger'>*</span></label>
																<div class="col-sm-10"> 
																	<select name="category_id" id="category_id" class="form-control"  >
																		<option value=""> Select Category </option>
																		<?php foreach ($categories as $category) { ?>
																			<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
																		<?php } ?>
																	</select>
																</div><div class="messageContainer col-sm-6"></div>

															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group" id="error-brand_id">
																<label class="control-label col-sm-5">Brand<span class='text-danger'>*</span></label>

																<div class="col-sm-12">
																	<select name="brand_id[]" id="brand_id" class="form-control" multiple="true"    >
																		<div class="messageContainer"></div>
																		<input type="button" id="select_all2" class="btn btn-success" name="select_all2" value="Select All">
																		<input type="button" class="btn btn-success" id="brand_clear_all" name="brand_clear_all" value="Clear All">
																	</select>
																</div>
																<div class="messageContainer col-sm-10" id="error_brand" style="color:#a94442;"></div>


															</div> 
														</div> 
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group" id="error-model_id">
																<label class="control-label col-sm-5">Model<span class='text-danger'>*</span></label>
																<div class="col-sm-12">
																	<select name="model_id[]" id="model_id" class="form-control" multiple="true"  >
																		<div class="messageContainer"></div> 
																		<input type="button" id="select_all" class="btn btn-success" name="select_all" value="Select All" >
																		<input type="button" class="btn btn-success" id="model_clear_all" name="model_clear_all" value="Clear All">
																	</select>
																</div>
																<div class="messageContainer col-sm-10" id="error_model" style="color:#a94442;"></div>

															</div>
														</div>
<!-- <div class="col-md-6">
<div class="form-group" id="error-name">
<label class="control-label">Subcategory<span class='text-danger'>*</span></label>
<div class="col-sm-10">
<select name="subcategory_id" id="subcategory_id" class="form-control">
<option value=""> Select Subcategory</option>													<?php /* print_r($subcategories[0]);?>
<?php foreach ($subcategories[0] as $category) { ?>													     <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>													<?php } */ ?>
</select>
</div>
</div>
<div class="messageContainer"></div>
</div>-->

</div>

<div class="row"> 
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-pincode">
			<label class="control-label col-sm-5">Pincode</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" autocomplete="off" id="pincode" name="pincode"/>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-address">
			<label class="control-label col-sm-5">Review <span class='text-danger'>*</span></label>
			<div class="col-sm-10">
				<textarea class="form-control" rows="3" id="review" name="review"></textarea>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
</div>
<div class="row"> 
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-pincode">
			<label class="control-label col-sm-5">Grade</label>
			<div class="col-sm-10">
				<select name="rating" id="rating" class="form-control">
					<option value=""> Select Grade</option>
					<?php foreach ($grades as $grade) { ?>
						<option value="<?php echo $grade['id']; ?>"><?php echo $grade['name']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-pincode">
			<label class="control-label col-sm-5">Profile photo</label>
			<div class="col-sm-10">
				<input type="file" name="image" accept="image/*">
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
</div>

<div class="row"><input type="hidden" id="vendor_id" name="id">
	<div class="col-lg-12 margin-bottom-5 text-center">
		<div id="response1"></div>
		<button type="submit" id="save_btn" class="btn btn-success">Save</button>
<!-- <button class="btn btn-success" type="button" onclick="toggale_div('#Service_li')">Next</button>
	<?php //} ?> -->
</div>
</div>
</div>
</div>
</div>
</div>

</form>
</div>

<!--Second panel for Service-->

<div id="meta_info" role="tabpanel" class="tab-pane fade" aria-expanded="true">
<div id="service-innerdiv">
	<div class="row">
		<div class="col-lg-12">
			<div class="btn-plus">
				<a href="javascript: addservice();"
				class="btn btn-primary view-contacts bottom-margin"
				style="color: white;"> <i class="fa fa-plus"></i> Service
			</a>
		</div>
<?php //print_r($_SESSION['vendor_id']); ?>
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
	<span class="pull-right">
		<a href="javascript:downloadforservice();" class="btn btn-info" style="color: white;">Download</a>
	</span>
</div>

</div>

</div>

</div>
		<!-- /Third panel for Zone -->

		<div id="spare_info" role="tabpanel" class="tab-pane fade" aria-expanded="true">
			<div id="spare-innerdiv">
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

									<table class="table table-striped table-bordered table-hover" id="tblspare">

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
																		<?php if (isset($spares)) { ?>
																		<?php foreach ($spares as $item):?>
																		<tr>
																			<td><?php echo $item['id'];?></td>
																			<td><?php echo $item['name'];?></td>
																			<td><?php echo $item['price'];?></td>
																			<td><?php echo $item['category'];?></td>
																			<td><?php echo $item['brand'];?></td>
																			<td><?php echo $item['model'];?></td>
																			<td><?php echo $item['subcategory'];?></td>
																			<td><?php echo $item['subcat'];?></td>
																			<td><?php if($item['status'] == 1) {?>Enable<?php }else{?>Disable <?php }?></td>
																			<td><a href="javascript: editspare(<?php echo $item['id']?>);" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil" style="color: white;"></i></a>
																			</td>
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


		<!-- /Fourth panel for Zone -->


		<div id="Zone" class="panel-collapse collapse" role="tabpanel"  class="tab-pane fade" aria-expanded="true">
			<form id="updaterestaurant" name="updaterestaurant" action="" method="post" style="margin-top: 6px;">
				<div>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<input type="hidden" id="id" name="id">
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-landmark">
												<label class="control-label col-sm-3">Landmark</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="landmark" autocomplete="off" name="landmark"/>
												</div>
												<div class="messageContainer col-sm-4"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-locality">
												<label class="control-label col-sm-5">Accurate Location <span class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" class="form-control" autocomplete="off" id="locality" name="locality"/>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-longitude">
												<label class="control-label col-sm-5">Latitude <span class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="latitude" name="latitude"  readonly />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-longitude">
												<label class="control-label col-sm-5">Longitude <span class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="longitude" name="longitude" readonly />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-radius">
												<label class="control-label col-sm-5">Delivery Radius <span class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="radius" name="radius" value="3000"/>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-billing_cycle">
												<label class="control-label col-sm-5">Billing Cycle <span class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<select name="billing_cycle" id="billing_cycle" class="form-control" style="display:inline;width:48%;">
														<option value="">Select Billing Cycle</option>
														<option value="1">Weekly</option>
														<option value="2">Fortnightly</option>
														<option value="3">Monthly</option>
													</select>
													<input type="text" id="cycle_effective_date" name="cycle_effective_date" class="form-control" placeholder="Effective Date" style="display:inline;width:49%;"/>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-with_service_tax">
												<label class="control-label col-sm-5">Inclusive Service Tax </label>
												<div class="col-sm-10">
													<select name="with_service_tax" id="with_service_tax" class="form-control" >
														<option value="1">Yes</option>
														<option value="0">No</option>
													</select>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-payment_mode">
												<label class="control-label col-sm-5">Invoice Payment Mode </label>
												<div class="col-sm-10">
													<select name="payment_mode" id="payment_mode" class="form-control" onchange="change()">
														<option value="1">Online</option>
<option value="2">Cheque</option><!-- 
<option value="0">Cash</option>
<option value="3">Wallet</option> -->
</select>
</div>
<div class="messageContainer col-sm-10"></div>
</div>
</div>
<div class="col-lg-6 margin-bottom-5">
	<div class="form-group" id="error-company_name">
		<label class="control-label col-sm-5">Billing Company Name </label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="company_name" name="company_name" value=""/>
		</div>
		<div class="messageContainer col-sm-10"></div>
	</div>
</div>
</div>
<div id="bank">
	<div class="row">
		<div class="col-lg-6 margin-bottom-5" id="chk1">
			<div class="form-group" id="error-cheque-favour-of">
				<label class="control-label col-sm-5">Cheque In Favour</label>
				<div class="col-sm-10">
					<input type="text" autocomplete="off" class="form-control" id="cheque_favour_of" name="cheque_favour_of" value=""/>
				</div>
				<div class="messageContainer col-sm-10"></div>
			</div>
		</div>
		<div class="col-lg-6 margin-bottom-5">
			<div class="form-group" id="error-account_name">
				<label class="control-label col-sm-5">Account Name</label>
				<div class="col-sm-10">
					<input type="text" autocomplete="off" class="form-control" id="account_name" name="account_name"/>
				</div>
				<div class="messageContainer col-sm-10"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 margin-bottom-5">
			<div class="form-group" id="error-account_number">
				<label class="control-label col-sm-5">Account Number <span class='text-danger'>*</span></label>
				<div class="col-sm-10"> 
					<input type="text" autocomplete="off" class="form-control" id="account_number" name="account_number"/>
				</div>
				<div class="messageContainer col-sm-10"></div>
			</div>
		</div>
		<div class="col-lg-6 margin-bottom-5">
			<div class="form-group" id="error-bank_name">
				<label class="control-label col-sm-5">Bank Name <span class='text-danger'>*</span></label>
				<div class="col-sm-10">
					<input type="text" autocomplete="off" class="form-control" id="bank_name" name="bank_name" />
				</div>
				<div class="messageContainer col-sm-10"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 margin-bottom-5">
			<div class="form-group" id="error-branch_name">
				<label class="control-label col-sm-5">Branch Name <span class='text-danger'>*</span> </label>
				<div class="col-sm-10">
					<input type="text" autocomplete="off"class="form-control" id="branch_name" name="branch_name"/>
				</div>
				<div class="messageContainer col-sm-10"></div>
			</div>
		</div>
		<div class="col-lg-6 margin-bottom-5">
			<div class="form-group" id="error-ifsc_code">
				<label class="control-label col-sm-5">IFSC Code<span class='text-danger'>*</span></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="ifsc_code" placeholder="(e.g SBIN1234567)" name="ifsc_code"/>
				</div>
				<div class="messageContainer col-sm-10"></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
<!-- <div class="col-lg-6 margin-bottom-5" id="wall">
<div class="form-group" id="error-min_amount">
<label class="control-label col-sm-5">Wallet Name</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="wallet_name" name="wallet_name"/>
</div>
<div class="messageContainer col-sm-10"></div>
</div>
</div>
<div class="col-lg-6 margin-bottom-5" id="mob">
<div class="form-group" id="error-min_amount">
<label class="control-label col-sm-5">Mobile number for Wallet </label>
<div class="col-sm-10">
<input type="text" class="form-control" id="mob_no" name="mob_no"  />
</div>
<div class="messageContainer col-sm-10"></div>
</div>
</div> -->
<div class="col-lg-6 margin-bottom-5">
	<div class="form-group" id="error-min_amount">
		<label class="control-label col-sm-5">Minimum Billing Amount <span class='text-danger'>*</span></label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="min_amount" name="min_amount"/>
		</div>
		<div class="messageContainer col-sm-10"></div>
	</div>
</div>
<!--    	 <div class="col-lg-6 margin-bottom-5">
<div class="form-group" id="error-is_official">
<label class="control-label col-sm-5">Is Official ? </label>
<div class="col-sm-10">
<select name="is_official" id="is_official" class="form-control">
<option value="1">Official</option>
<option value="0">UnOfficial</option>
</select>
</div>
<div class="messageContainer col-sm-10"></div>
</div>
</div>-->
</div>
<div class="row">
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-hard_copy">
			<label class="control-label col-sm-10">Invoice Hardcopy Required ?</label>
			<div class="col-sm-10">
				<select name="hard_copy" id="hard_copy" class="form-control">
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-invoice_notify_mobile">
			<label class="control-label col-sm-5">Gateway Charge <span class='text-danger'>*</span></label>
			<div class="col-sm-10">
				<input type="text" id="gateway_charge" name="gateway_charge" class="form-control" placeholder="Gateway Charge" style="width:37%;display:inline;" />
				<input type="text" id="gateway_effective_date" name="gateway_effective_date" placeholder="Effective Date" class="form-control" style="width:60%;display:inline;"/>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-branch_name">
			<label class="control-label col-sm-5">Commission for Service %</label>
			<div class="col-sm-10">
				<input type="number" class="form-control" id="comm_ser" name="comm_ser" min="0"/>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
	<div class="col-lg-6 margin-bottom-5">
		<div class="form-group" id="error-ifsc_code">
			<label class="control-label col-sm-5">Commission for Spare part %</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="comm_spare" min="0" name="comm_spare"/>
			</div>
			<div class="messageContainer col-sm-10"></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 margin-bottom-5 text-center">
		<div id="response"></div>
		<button type="submit" class="btn btn-success">Submit</button>
	</div>
</div> 


</div>
</div>
</div>
</div>
</div>
</form>        
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

<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/selectize.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->

<!-- <script src="<?php echo asset_url(); ?>js/select2.multicheckboxes.js"></script> -->

<script>
	$(document).ready(function () {
		$("#map-canvas").hide();
		$("#chk1").hide();

		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
var target = $(e.target).attr("href") // activated tab
if (target == "#delivery")
{
	showGEO();
} else
{
	$("#map-canvas").hide();
}
});

	});

	$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initMap&key=AIzaSyCH-u-UD2bz6cfPEAe8mCVyrnnI7ONx9ro");
	$.fn.datepicker.defaults.format = "dd-mm-yyyy";

	$('#cycle_effective_date').datepicker().on('changeDate', function (ev) {
		$('#updaterestaurant').bootstrapValidator('revalidateField', 'cycle_effective_date');
	});

	$('#gateway_effective_date').datepicker().on('changeDate', function (ev) {
		$('#updaterestaurant').bootstrapValidator('revalidateField', 'gateway_effective_date');
	});



/* $('#trial_start_date').datepicker().on('changeDate', function(ev){
$('#addrestaurant').bootstrapValidator('revalidateField', 'trial_start_date');
});
$('#trial_end_date').datepicker().on('changeDate', function(ev){
$('#addrestaurant').bootstrapValidator('revalidateField', 'trial_end_date');
});  */

$('.resttime').timepicker();
var cuisine = $("#cuisines").selectize({
	plugins: ['remove_button'],
	delimiter: ',',
	persist: false,
	create: function (input) {
		return {
			value: input,
			text: input
		}
	}
});

/*cuisine.on('change', function() {
$('#addrestaurant').bootstrapValidator('revalidateField', 'cuisines[]');
});
*/

function initMap() {
//debugger;
var options = {
	componentRestrictions: {country: 'in'}
};
var input = document.getElementById('locality');
var autocomplete = new google.maps.places.Autocomplete(input, options);
autocomplete.addListener('place_changed', function () {
	var place = autocomplete.getPlace();
	if (!place.geometry) {
		window.alert("Autocomplete's returned place contains no geometry");
		return;
	}
// $('#latitude').val(place.geometry.location.lat());
//    $('#longitude').val(place.geometry.location.lng());

var lat = place.geometry.location.lat();
var lang = place.geometry.location.lng();
setLatLang(lat, lang)
//$('#addrestaurant').bootstrapValidator('revalidateField', 'locality');
//$('#addrestaurant').bootstrapValidator('revalidateField', 'latitude');
//$('#addrestaurant').bootstrapValidator('revalidateField', 'longitude');

});
}
function setLatLang(lat, lang) {
//debugger;
$('#latitude').val(lat);
$('#longitude').val(lang);
// jQuery.validator.addMethod('validlatup', function(value, element){
// 	    var lat = jQuery("#latitude").val();
// 	    if(lat !=''){
// 			return 1;
// 		    } else {
// 				return 0;
// 			    }
// }, 'Select locality from google address.');

// jQuery.validator.addMethod('validlongup', function(value, element) {
// 		 var longt = jQuery("#longitude").val();
// 		    if(longt !=''){
// 				return 1;
// 			    } else {
// 					return 0;
// 				    }
// }, 'Select locality from google address.');

$('#updaterestaurant').bootstrapValidator('revalidateField', 'locality');
$('#updaterestaurant').bootstrapValidator('revalidateField', 'latitude');
$('#updaterestaurant').bootstrapValidator('revalidateField', 'longitude');
}

$("#cityid").change(function () {
	$.get(base_url + "admin/general/localities", {cityid: $("#cityid").val()}, function (data) {
		var html = "<option value=''>Select Area</option>";
		$.each(data, function (key, value) {
			html = html + "<option value='" + value.id + "'>" + value.name + "</option>";
		});
		$("#areaid").html(html);
	}, 'json');
});

$("#is_trial").change(function () {
	if ($(this).val() == 1) {
		$("#trial_dates").show();
		$('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_start_date', true);
		$('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_end_date', true);
	} else {
		$("#trial_dates").hide();
		$('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_start_date', false);
		$('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_end_date', false);
	}
});


$('#addrestaurant').bootstrapValidator({
	container: function ($field, validator) {
		return $field.parent().next('.messageContainer');
	},

	feedbackIcons: {
		validating: 'glyphicon glyphicon-refresh'
	},
	fields: {
		email: {
			validators: {
/*notEmpty: {
message: 'Email is required and cannot be empty'
},*/
regexp: {
	regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
	message: 'The value is not a valid email address'
}
}
},
mobile: {
	validators: {
		notEmpty: {
			message: 'Mobile is required and cannot be empty'
		},
		regexp: {
			regexp: '^[7-9][0-9]{9}$',
			message: 'Invalid Mobile Number'
		}
	}
},
landline: {
	validators: {
/*notEmpty: {
message: 'Mobile is required and cannot be empty'
},*/
regexp: {
	regexp: '^[7-9][0-9]{9}$',
	message: 'Invalid Mobile Number'
}
}
},
name: {
	validators: {
		notEmpty: {
			message: 'Vendor Name is required and cannot be empty'
		}
	}
},
garage_name: {
	validators: {
		notEmpty: {
			message: 'Garage Name is required and cannot be empty'
		}
	}
},
address: {
	validators: {
		notEmpty: {
			message: 'Address is required and cannot be empty'
		}
	}
},

pincode: {
	validators: {
		integer: {
			message: 'Invalid pincode.'
		},
		stringLength: {
			max: 6,
			min: 6,
			message: 'Invalid pincode.'
		},
	}
},
review: {
	validators: {
		notEmpty: {
			message: 'Review is required and cannot be empty'
		}
	}
},
category_id: {
	validators: {
		notEmpty: {
			message: 'Category is required and cannot be empty'
		}
	}
},
brand_id: {
	validators: {
		notEmpty: {
			message: 'Brand is required and cannot be empty'
		}
	}
},
/*image : {
validators: {
notEmpty: {
message: 'Profile photo is required and cannot be empty'
}
}
},*/
model_id: {
	validators: {
		notEmpty: {
			message: 'Model is required and cannot be empty'
		}
	}
}


}
}).on('success.form.bv', function (event, data) {
// Prevent form submission
event.preventDefault();
addRestaurant();
});


$("#brand_id").change(function () {
	var brand = $('#brand_id').val();
	if (brand != null) {
//debugger;
$("#save_btn").removeAttr('disabled');
$("#next_btn").removeAttr('disabled');
$('#error_brand').html('');
}
});

$("#model_id").change(function () {
	var brand = $('#brand_id').val();
	if (brand != null) {
// debugger;
$("#save_btn").removeAttr('disabled');
$("#next_btn").removeAttr('disabled');
$('#error_model').html('');
}
});


function addRestaurant() {

	if (($('#brand_id').val()) == null) {
		$('#error_brand').html('Brand is required and cannot be empty');
		$("#save_btn").attr('disabled', true);
		$("#next_btn").attr('disabled', true);
	}

	if (($('#model_id').val()) == null) {
		$('#error_model').html('Model is required and cannot be empty');
		$("#save_btn").attr('disabled', true);
		$("#next_btn").attr('disabled', true);
	}


/* 	var vendor_id = document.getElementById("vendor_id").value;
if(vendor_id)
{
var options = {
target : '#response', 
beforeSubmit : showAddRequest,
success :  showAddResponse,
url : base_url+'admin/vendor/updatebasic',
semantic : true,
dataType : 'json'
};
$('#addrestaurant').ajaxSubmit(options);

} else { */

	var brand = $('#brand_id').val();
	var model = $('#model_id').val();

	var options = {
		target: '#response',
		beforeSubmit: showAddRequest,
		success: showAddResponse,
		url: base_url + 'admin/vendor/add',
		semantic: true,
		dataType: 'json'
	};
	$('#addrestaurant').ajaxSubmit(options);
}
//}


function showAddRequest(formData, jqForm, options) {
	$("#response").hide();
	var queryString = $.param(formData);
	return true;
}

function showAddResponse(resp, statusText, xhr, $form) {
	$('button').removeAttr('disabled');
	if (resp.status == '0') {
		alert(resp.msg);

		$("#response1").removeClass('alert-success');
		$("#response1").addClass('alert-danger');
		$("#response1").html(resp.msg.name);
		$("#response1").show();
// window.location.href = base_url+"admin/vendor/list";
} else {
	alert(resp.msg);

	$("#vendor_id").val(resp.id);
	$("#response1").removeClass('alert-danger');
	$("#response1").addClass('alert-success');
	$("#response1").html(resp.msg);
	$("#response1").show();
	$("#id").val(resp.id);
	window.location.href = base_url+"admin/vendor/edit/"+resp.id;
	//list(resp.model_id);
	// $('#basic').hide();
	// $('#Basic_li').removeClass('active');
	// $('#servicetype').addClass('in active');
	//$('#servicing').show();
	// $("#Service_li").trigger("click");

	}
}

function xyz()
{
	$('#basic').hide();
	$('#basictab').removeClass('active');
	$('#servicetab').addClass('active');
	$('#servicing').show();
}
function list(id)
{
//  alert("hiii");
//  alert(id);
//$.post(base_url + "admin/vendor/new1", {model_id: id}, function (data) {
$.post(base_url + "admin/subcategory/new", {}, function (data) {
//$('#basic').hide();
$('#basictab').removeClass('active');
$('#servicetab').addClass('active');
$('#servicing').show();
$("#Service").empty();
$("#Service").html(data);
//  $("#mainchk").empty();
//  $("#mainchk").html(data);
},'html');
}

$('#updaterestaurant').bootstrapValidator({
	container: function ($field, validator) {
		return $field.parent().next('.messageContainer');
	},
	feedbackIcons: {
		validating: 'glyphicon glyphicon-refresh'
	},
	excluded: ':disabled',
	fields: {

		locality: {
			validators: {
				notEmpty: {
					message: 'locality is required and cannot be empty'
				}
			}
		},
		billing_cycle: {
			validators: {
				notEmpty: {
					message: 'Billing cycle is required and cannot be empty'
				}
			}
		},
		cycle_effective_date: {
			validators: {
				notEmpty: {
					message: 'Effective cycle date is required'
				},
				date: {
					format: 'DD-MM-YYYY',
					message: 'Effective cycle date is not a valid'
				}
			}
		},
/* company_name: {
validators: {
notEmpty: {
message: 'Billing Company Name is required and cannot be empty'
}
}
},*/
/*cheque_favour_of: {
validators: {
notEmpty: {
message: 'Cheque favour is required and cannot be empty'
}
}
},*/
/* account_name: {
validators: {
notEmpty: {
message: 'Account Name is required and cannot be empty'
}
}
},*/
account_number: {
	validators: {
		notEmpty: {
			message: 'Account Number is required and cannot be empty'
		},
		regexp: {
			regexp: /^[0-9\s]*$/,
			message: 'Accept only digits'
		}
	}
},
bank_name: {
	validators: {
		notEmpty: {
			message: 'Bank Name is required and cannot be empty'
		},
		regexp: {
			regexp: /^[a-z\s]+$/i,
			message: 'Accept only charactors'
		}
	}
},
branch_name: {
	validators: {
		notEmpty: {
			message: 'Branch Name is required and cannot be empty'
		},
		regexp: {
			regexp: /^[a-z\s]+$/i,
			message: 'Accept only charactors'
		}
	}
},
ifsc_code: {
	validators: {
		notEmpty: {
			message: 'IFSC Code is required and cannot be empty'
		},
		regexp: {
			regexp: '^[A-Za-z]{4}[0-9]{7}$',
			message: 'Invalid IFSC Code'
		}
	},
},
/* wallet_name: {
validators: {
notEmpty: {
message: 'Wallet Name is required and cannot be empty'
}
}
},
mob_no: {
validators: {
notEmpty: {
message: 'Mobile number is required and cannot be empty'
},
regexp: {
regexp: '^[7-9][0-9]{9}$',
message: 'Invalid Mobile Number'
}
}
},*/
min_amount: {
	validators: {
		notEmpty: {
			message: 'Minimum billing amount is required and cannot be empty'
		}
	}
},
gateway_charge: {
	validators: {
		notEmpty: {
			message: 'Minimum billing amount is required and cannot be empty'
		}
	}
},
gateway_effective_date: {
	validators: {
		notEmpty: {
			message: 'Gateway effective cycle date is required'
		},
		date: {
			format: 'DD-MM-YYYY',
			message: 'Gateway effective cycle date is not a valid'
		}
	}
},
comm_ser: {
	validators: {
		notEmpty: {
			message: 'Commission for Service amount is required and cannot be empty'
		}
	}
},
comm_spare: {
	validators: {
		notEmpty: {
			message: 'Commission for Spare amount is required and cannot be empty'
		}
	}
},

/*    subcategory_id[]: {
validators: {
notEmpty: {
message: 'Subcategory is required and cannot be empty'
}
}
},
service_id[]: {
validators: {
notEmpty: {
message: 'Service is required and cannot be empty'
}
}
},*/
zone_id: {
	validators: {
		notEmpty: {
			message: 'Zone is required and cannot be empty'
		}
	}
},
area_id: {
	validators: {
		notEmpty: {
			message: 'Area is required and cannot be empty'
		}
	}
},
latitude: {
	validators: {
		notEmpty: {
			message: 'Latitude is required and cannot be empty'
		}
	}
},
longitude: {
	validators: {
		notEmpty: {
			message: 'Longitude is required and cannot be empty'
		}
	}
}

}
}).on('success.form.bv', function (event, data) {
// Prevent form submission
event.preventDefault();
updateRestaurant();
});

function updateRestaurant() {
	var options = {
		target: '#response',
		beforeSubmit: showAddRequest,
		success: showAddResponse1,
		url: base_url + 'admin/vendor/updateVen',
		semantic: true,
		dataType: 'json'
	};
	$('#updaterestaurant').ajaxSubmit(options);
	ajaxindicatorstart("Please hang on.. while we add vendor ..");
}

function showAddRequest1(formData, jqForm, options) {
	ajaxindicatorstop();
	$("#response").hide();
	var queryString = $.param(formData);
	return true;
}

function showAddResponse1(resp, statusText, xhr, $form) {
	ajaxindicatorstop();
	if (resp.status == '0') {
		alert(resp.message);
		$("#response").removeClass('alert-success');
		$("#response").addClass('alert-danger');
		$("#response").html(resp.msg.name);
		$("#response").show();
//window.location.href = base_url+"admin/vendor/list";
} else { 
	alert(resp.msg);
	$("#response").removeClass('alert-danger');
	$("#response").addClass('alert-success');
	$("#response").html(resp.msg);
	$("#response").show();
	window.location.href = base_url + "admin/vendor/list";
}
}

function addMoreSlabs() {
	var slabcount = parseInt($("#slabcount").val());
	slabcount++;
	var slab_html = '<tr id="slabrow' + slabcount + '">' +
	'<td><input type="text" name="lower_limit[]" class="form-control" placeholder="From Amount"/></td>' +
	'<td><input type="text" name="upper_limit[]" class="form-control" placeholder="To Amount"/></td>' +
	'<td><input type="text" name="from_rad[]" class="form-control" placeholder="From Radius"/></td>' +
	'<td><input type="text" name="to_rad[]" class="form-control" placeholder="To Radius"/></td>' +
	'<td><input type="text" name="charge[]" class="form-control" placeholder="Delivery Charge"/></td>' +
	'<td><a href="javascript:deleteSlab(' + slabcount + ');" class="btn btn-danger btn-sm">X</a></td>' +
	'</tr>';
	$("#del_slabs").append(slab_html);
	$("#slabcount").val(slabcount);
}

function deleteSlab(id) {
	var slabcount = parseInt($("#slabcount").val());
	slabcount = slabcount - 1;
	$("#slabrow" + id).remove();
	$("#slabcount").val(slabcount);
}

function addMoreDelTime() {
	var timecount = parseInt($("#timecount").val());
	timecount++;
	var slab_html = '<tr id="timeslabrad' + timecount + '">' +
	'<td colspan=3><input type="text" name="from_time_rad[]" class="form-control" placeholder="From Radius"/></td>' +
	'<td colspan=3><input type="text" name="to_time_rad[]" class="form-control" placeholder="To Radius"/></td>' +
	'<td class="text-center"><a href="javascript:deleteDelTime(' + timecount + ');" class="btn btn-danger btn-sm">X</a></td>' +
	'</tr>' +
	'<tr id="timeslabtime' + timecount + '">' +
	'<td><input type="text" name="mon[]" class="form-control" placeholder="Monday"/></td>' +
	'<td><input type="text" name="tue[]" class="form-control" placeholder="Tuesday"/></td>' +
	'<td><input type="text" name="wed[]" class="form-control" placeholder="Wednesday"/></td>' +
	'<td><input type="text" name="thu[]" class="form-control" placeholder="Thursday"/></td>' +
	'<td><input type="text" name="fri[]" class="form-control" placeholder="Friday"/></td>' +
	'<td><input type="text" name="sat[]" class="form-control" placeholder="Saturday"/></td>' +
	'<td><input type="text" name="sun[]" class="form-control" placeholder="Sunday"/></td>' +
	'</tr>';
	$("#del_time").append(slab_html);
	$("#timecount").val(timecount);
}

function deleteDelTime(id) {
	var timecount = parseInt($("#timecount").val());
	timecount = timecount - 1;
	$("#timeslabrad" + id).remove();
	$("#timeslabtime" + id).remove();
	$("#timecount").val(timecount);
}

function addMoreMov() {
	var movcount = parseInt($("#movcount").val());
	movcount++;
	var slab_html = '<tr id="movrow' + movcount + '">' +
	'<td><input type="text" name="from_mov_rad[]" class="form-control" placeholder="From Radius"/></td>' +
	'<td><input type="text" name="to_mov_rad[]" class="form-control" placeholder="To Radius"/></td>' +
	'<td><input type="text" name="amount[]" class="form-control" placeholder="MOV"/></td>' +
	'<td><a href="javascript:deleteMov(' + movcount + ');" class="btn btn-danger btn-sm">X</a></td>' +
	'</tr>';
	$("#del_mov").append(slab_html);
	$("#movcount").val(movcount);
}

function deleteMov(id) {
	var movcount = parseInt($("#movcount").val());
	movcount = movcount - 1;
	$("#movrow" + id).remove();
	$("#movcount").val(movcount);
}
$("#cboCustomTime").change(function () {

	showCustomTime();

});

function showCustomTime() {
	if ($("#cboCustomTime").val() == 1) {
		$("#divCustomT").show();
		$("#divRegularT").hide();
	} else {
		$("#divCustomT").hide();
		$("#divRegularT").show();
	}
}
function showGEO()
{
	$("#map-canvas").show();
	successFunction($('#latitude').val(), $('#longitude').val(), $('#radius').val());
}


function change()
{
	var selectBox = document.getElementById("payment_mode");
	var selected = selectBox.options[selectBox.selectedIndex].value;
	var cheque = document.getElementById("bank");
	var cheque1 = document.getElementById("chk1");
	var mob_no1 = document.getElementById("mob");
	var wall1 = document.getElementById("wall");
// alert(selected);
if (selected === '2')
{
	cheque.style.display = "block";
	cheque1.style.display = "block";
	mob_no1.style.display = "none";
	wall1.style.display = "none";
}
if (selected === '0')
{
	cheque.style.display = "none";
	mob_no1.style.display = "none";
	wall1.style.display = "none";
}
if (selected === '3')
{
	cheque.style.display = "none";
	mob_no1.style.display = "block";
	wall1.style.display = "block";
//document.getElementById("mob_no").disabled=false;
}
if (selected === '1')
{
	cheque.style.display = "block";
	cheque1.style.display = "none";
	mob_no1.style.display = "none";
	wall1.style.display = "none";
}

}

/*  function show(elementId) { 
alert(elementId);
document.getElementById("basic").style.display="none";
document.getElementById(elementId).style.display="block";
} */

/*  $(document).ready(function () {
$('.nav li a').click(function(e) {

$('.nav li.active').removeClass('active');

var $parent = $(this).parent();
$parent.addClass('active');
e.preventDefault();
});
});

$('#showservice').click(function(e) {
alert("inside");
$('#basictab').removeClass('active');

var parent = $('#servicetab');
// parent.addClass('active');
$('#servicetab a').addClass('active');
$('#servicetab a').attr("aria-expanded","true");
e.preventDefault();
});*/


</script>
<script type="text/javascript">

	$(document).ready(function () {
//Chosen
$("#brand_id").select2({
	maxItems: 3
})

$("#model_id").select2({
	maxItems: 3
})


});

</script>
<script>
	$(document).ready(function () {
/*	$("#model_id").change(function() 
{
var model_id =  $('#model_id').val();       
console.log(model_id);	    
$.post(base_url+"admin/vendor/new", {model_id : model_id}, function(data)
{

});   
});*/


/*$("#addrestaurant").validate({
rules: {
brand_id: "required",
model_id: "required" 
},
messages: {
brand_id: "Please select brand name",
model_id: "Please select model name" 
}
});*/



$("#category_id").change(function () {
	var cat_id = $('#category_id').val();
	console.log(cat_id);
	$.post(base_url + "admin/brandbycatid/", {cat_id: cat_id}, function (data)
	{
		if (data.length > 0)
		{
			for (var i = 0; i < data.length; i++)
			{
				$('#brand_id').append("<option data-targetname=" + data[i].name + " value='" + data[i].id + "'>" + data[i].name + "</option>");
			}
		}
	}, 'json');
});

$("#brand_id").change(function () {
	var brand_id = $('#brand_id').val();

	$.post(base_url + "admin/modelbybrandid1/", {brand_id: brand_id}, function (data) {
		$('#model_id').empty();
		if (data.length > 0) {
			$('#model_id').html("");
			for (var i = 0; i < data.length; i++)
			{
//  $('#model_id').append("<optgroup label="+data[i].brand_name+">");      			    
$('#model_id').append("<option value='" + data[i].id + "'>" + data[i].name + "(" + data[i].brand_name + ")</option>");
// $('#model_id').append("</optgroup>");
}
$("#model_id").select2({
	maxItems: 3
})
}
}, 'json');
});
});

</script>
<script>
	$(function () {
		$("#treecheck").almightree({search: "#box"});
	});
</script>

<script>
/**
* Comment
*/
function toggale_div(div) {
	$(div).trigger('click');
}
$("#category_id1").change(function () {
	jQuery.noConflict();
	alert("Mouse down event");
	var cat_id = $('#category_id').val();
	var html = "";
//ajaxindicatorstart("Loading...");
$.post(base_url + "admin/brandbycatid/", {cat_id: cat_id}, function (data)
{
	$('#brand_id').empty();
	$('#brand_id').append("<option value=''>" + 'Select Brand' + "</option>");
	if (data.length > 0)
	{
		for (var i = 0; i < data.length; i++)
		{
// $('#brand_id').append("<option data-targetname="+data[i].name+" value='"+data[i].id+"'>"+data[i].name+"</option>");			
html = html + "<option value='" + data[i].id + "'>" + data[i].name + "</option>";

}
}
$("#brand_id").multiselect({
	selectAll: true
});
$("#brand_id").html(html);
}, 'json');

});

</script>

<script>

	$('#select_all').click(function () {
		$('#model_id option').prop('selected', true);
		$("#model_id").trigger("change");
	});

	$('#select_all2').click(function () {
		$('#brand_id option').prop('selected', true);
		$("#brand_id").trigger("change");
	});

	$('#brand_clear_all').click(function () {
		$('#brand_id option').prop('selected', false);
		$("#brand_id").trigger("change");
	}); 

	$('#model_clear_all').click(function () {
		$('#model_id option').prop('selected', false);
		$("#model_id").trigger("change");
	}); 

</script> 

<!-- service and spare form js  -->
<script>
/*$(document).ready(function(){
    $('#tblservice').DataTable();
});

$(document).ready(function(){
    $('#tblspare').DataTable();
});

function addservice()
{
	$.post(base_url+"admin/service/new/0",{},function(data) {
		$("#meta_info").html(data);
	},'html');
}

function addspare()
{
	$.post(base_url+"admin/spare/new/0",{},function(data) {
		$("#spare_info").html(data);
	},'html');
}

function goto_service() {
	//$('#tblservice').DataTable();
	$("#meta_info").load(location.href + " #service-innerdiv");
}

function goto_spare() {
	$("#spare_info").load(location.href + " #spare-innerdiv");
}

function editservice(id)
{
	$.post(base_url+"admin/service/edit",{id: id},function(data) {
		$("#meta_info").html(data);
	},'html');
}

function editspare(id)
{
	$.post(base_url+"admin/spare/edit",{id: id},function(data) {
		$("#spare_info").html(data);
	},'html');
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
        beforeSubmit:  showRequest_service_upload,
        success:       showResponse_service_upload,
        url : base_url+'admin/menu/import2',
 		semantic : true,
 		dataType : 'json'
    };
	$('#Upload').ajaxSubmit(options);
}

function showRequest_service_upload(formData, jqForm, options) {
}

function showResponse_service_upload(responseText, statusText)  {
	if(responseText.status == 0)
	{
		alert(responseText.message);
		if (responseText.message == 'Please fill basic details, Vendor is missing!') {
			window.location.href = base_url+"admin/vendor/new";
		}
	}else {
		$("#myModal").modal("hide");
		alert(responseText.message);
		goto_service();
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
        beforeSubmit:  showRequest_spare_upload,
        success:       showResponse_spare_upload,
        url : base_url+'admin/menu/import1',
 		semantic : true,
 		dataType : 'json'
    };
	$('#Upload').ajaxSubmit(options);
}

function showRequest_spare_upload(formData, jqForm, options) {
}

function showResponse_spare_upload(responseText, statusText)  {
	if(responseText.status == 0)
	{
	   alert(responseText.message);
	   if (responseText.message == 'Please fill basic details, Vendor is missing!') {
			window.location.href = base_url+"admin/vendor/new";
		}
	} else {
	   alert(responseText.message);
	   	$("#myModal").modal("hide");
		alert(responseText.message);
		goto_spare();
	}	
}

function downloadforservice(){
	window.location.href = base_url+'admin/menu/downloaduptoservice';
}*/
</script>
<!-- ./service and spare form js -->