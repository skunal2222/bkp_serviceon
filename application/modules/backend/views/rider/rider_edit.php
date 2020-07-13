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
		<h3 class="page-header">Edit Rider</h3>
		<div class="panel panel-info">
			<div class="panel-wrapper collapse in" aria-expanded="true">
				<div class="panel-body">
					<div class="form-body">
						<ul class="nav customtab nav-tabs" role="tablist">
							<li role="presentation" class="nav-item" title="Basic details">
								<a href="#basic" id="Basic_li" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Basic Details</span></a>
							</li>
							<li role="presentation" class="nav-item" title="Please fill basic details">
								<a href="#Payment" id="Service_li" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Payment</span></a>
							</li>

							<li role="presentation" class="nav-item" title="Please fill basic details">
								<a href="#Zone" id="Service_li" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Zone</span></a>
							</li>

							<li role="presentation" class="nav-item" title="Please fill basic details">
								<a href="#Billing" id="billing_li" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Billing</span></a>
							</li>
							

						</ul>
	<div class="tab-content">
		
		<div id="basic" class="tab-pane fade in active">
			<form id="editrider" name="editrider" action="" method="post" enctype="">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label col-sm-5">Rider Name <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" autocomplete="off" class="form-control" id="rider_name" name="rider[rider_name]" value="<?= isset($rider[0]['rider_name'])?$rider[0]['rider_name']:"" ?>" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-dob">
											<label class="control-label col-sm-5">Rider DOB <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="date" class="form-control" id="rider_dob" name="rider[dob]" value="<?= isset($rider[0]['dob'])?$rider[0]['dob']:"" ?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-mobile">
											<label class="control-label col-sm-5">Mobile <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="mobile" name="rider[mobile]" autocomplete="off" value="<?= isset($rider[0]['mobile'])?$rider[0]['mobile']:"" ?>" maxlength="10" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-email">
											<label class="control-label col-sm-5">Email <span class='text-danger'></span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="email" name="rider[email]" autocomplete="off" value="<?= isset($rider[0]['email'])?$rider[0]['email']:"" ?>" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-address">
											<label class="control-label col-sm-5">Address <span class='text-danger'>*</span></label>
											<div class="col-sm-10">
												<textarea class="form-control" autocomplete="off" rows="3" id="address" name="rider[address]"><?= isset($rider[0]['address'])?$rider[0]['address']:"" ?></textarea>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-2 margin-bottom-5">
										<div class="form-group" id="error-pincode">
											<label class="control-label col-sm-5">Pincode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" autocomplete="off" id="pincode" name="rider[pincode]" value="<?= isset($rider[0]['pincode'])?$rider[0]['pincode']:"" ?>" maxlength="6" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-3 margin-bottom-5">
										<div class="form-group" id="error-vehicle_no">
											<label class="control-label col-sm-5">Vehicle No</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" autocomplete="off" id="vehicle_no" name="rider[vehicle_no]" value="<?= isset($rider[0]['vehicle_no'])?$rider[0]['vehicle_no']:"" ?>" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-idname">
											<label class="control-label col-sm-5">Identity Name 1</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" autocomplete="off" id="id_name1" name="rider[id_name]" value="<?= isset($rider[0]['id_name'])?$rider[0]['id_name']:"" ?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>

									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-pincode">
											<label class="control-label col-sm-5">Change Profile Photo</label>
											<div class="col-sm-10">
												<input type="file" name="image" accept="image/jpg,image/jpeg,image/png">
												<br><br>
											</div>
											<div class="col-sm-10">
												<img src="<?= isset($rider[0]['profile_photo'])? asset_url().$rider[0]['profile_photo']:"" ?>" height="200px" width="150px">
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>

									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-idname">
											<label class="control-label col-sm-5">Identity Name 2</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" autocomplete="off" id="id_name2" name="rider[id_name2]" value="<?= isset($rider[0]['id_name2'])?$rider[0]['id_name2']:"" ?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>

									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-pincode">
											<label class="control-label col-sm-5">Change Profile Photo</label>
											<div class="col-sm-10">
												<input type="file" name="image" accept="image/jpg,image/jpeg,image/png">
												<br><br>
											</div>
											<div class="col-sm-10">
												<img src="<?= isset($rider[0]['profile_photo2'])? asset_url().$rider[0]['profile_photo2']:"" ?>" height="200px" width="150px">
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>

									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-idname">
											<label class="control-label col-sm-5">Identity Name 3</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" autocomplete="off" id="id_name3" name="rider[id_name3]" value="<?= isset($rider[0]['id_name3'])?$rider[0]['id_name3']:"" ?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>

									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-pincode">
											<label class="control-label col-sm-5">Change Profile Photo</label>
											<div class="col-sm-10">
												<input type="file" name="image" accept="image/jpg,image/jpeg,image/png">
												<br><br>
											</div>
											<div class="col-sm-10">
												<img src="<?= isset($rider[0]['profile_photo3'])? asset_url().$rider[0]['profile_photo3']:"" ?>" height="200px" width="150px">
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>

									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-idname">
											<label class="control-label col-sm-5">Identity Name 4</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" autocomplete="off" id="id_name4" name="rider[id_name4]" value="<?= isset($rider[0]['id_name4'])?$rider[0]['id_name4']:"" ?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>

									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-pincode">
											<label class="control-label col-sm-5">Change Profile Photo</label>
											<div class="col-sm-10">
												<input type="file" name="image" accept="image/jpg,image/jpeg,image/png">
												<br><br>
											</div>
											<div class="col-sm-10">
												<img src="<?= isset($rider[0]['profile_photo4'])? asset_url().$rider[0]['profile_photo4']:"" ?>" height="200px" width="150px">
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>

									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-idname">
											<label class="control-label col-sm-5">Identity Name 5</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" autocomplete="off" id="id_name5" name="rider[id_name5]" value="<?= isset($rider[0]['id_name5'])?$rider[0]['id_name5']:"" ?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>

									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-pincode">
											<label class="control-label col-sm-5">Change Profile Photo</label>
											<div class="col-sm-10">
												<input type="file" name="image" accept="image/jpg,image/jpeg,image/png">
												<br><br>
											</div>
											<div class="col-sm-10">
												<img src="<?= isset($rider[0]['profile_photo5'])? asset_url().$rider[0]['profile_photo5']:"" ?>" height="200px" width="150px">
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>


								
								<div class="row"><input type="hidden" name="id" id="id" value="<?= isset($rider[0]['rider_id'])?$rider[0]['rider_id']:"" ?>">
									<div class="col-lg-12 margin-bottom-5 text-center">
										<div id="response1"></div>
										<button type="submit" id="save_btn" class="btn btn-success">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</form>
		</div>



		<!-------------------------------SECOND---------------------------------------------->


		<div id="Payment" class="panel-collapse collapse" role="tabpanel"  class="tab-pane fade" aria-expanded="true">
			<form id="restbilling" name="restbilling" action="<?= base_url()?>admin/rider/editPayment" method="post" style="margin-top: 6px;">
				<input type="hidden" name="restid" value="<?php echo $rider[0]['rider_id'];?>" />
				<div>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									
									
									<div id="bank">
										
										<div class="row">
											<div class="col-lg-6 margin-bottom-5">
												<div class="form-group" id="error-account_number">
													<label class="control-label col-sm-5">Account Holder Name <span class='text-danger'>*</span></label>
													<div class="col-sm-10"> 
														<input type="text" autocomplete="off" class="form-control" id="account_name" name="rider[account_name]" value="<?= isset($rider[0]['account_name'])?$rider[0]['account_name']:"" ?>"/>
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>

											<div class="col-lg-6 margin-bottom-5">
												<div class="form-group" id="error-account_number">
													<label class="control-label col-sm-5">Account Number <span class='text-danger'>*</span></label>
													<div class="col-sm-10"> 
														<input type="text" autocomplete="off" class="form-control" id="account_number" name="rider[account_number]" value="<?= isset($rider[0]['account_number'])?$rider[0]['account_number']:"" ?>"/>
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>
											<div class="col-lg-6 margin-bottom-5">
												<div class="form-group" id="error-bank_name">
													<label class="control-label col-sm-5">Bank Name <span class='text-danger'>*</span></label>
													<div class="col-sm-10">
														<input type="text" autocomplete="off" class="form-control" id="bank_name" name="rider[bank_name]" value="<?= isset($rider[0]['bank_name'])?$rider[0]['bank_name']:"" ?>"/>
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>

											<div class="col-lg-6 margin-bottom-5">
												<div class="form-group" id="error-branch_name">
													<label class="control-label col-sm-5">Branch Name <span class='text-danger'>*</span> </label>
													<div class="col-sm-10">
														<input type="text" autocomplete="off" class="form-control" id="branch_name" name="rider[branch_name]" value="<?= isset($rider[0]['branch_name'])?$rider[0]['branch_name']:"" ?>"/>
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>
											<div class="col-lg-6 margin-bottom-5">
												<div class="form-group" id="error-ifsc_code">
													<label class="control-label col-sm-5">IFSC Code<span class='text-danger'>*</span></label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="ifsc_code" placeholder="(e.g SBIN1234567)" name="rider[ifsc_code]" value="<?= isset($rider[0]['ifsc_code'])?$rider[0]['ifsc_code']:"" ?>"/>
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>

										</div>
										
									</div>

									<div class="col-lg-12 margin-bottom-5 text-center">
										<?php if($_SESSION['adminsession']['user_role']==1){?>
											<button type="submit" class="btn btn-success">Update</button>
										<?php } else {?>
											<button type="submit" class="btn btn-success" disabled>Update</button>
										<?php } ?>
										<!-- <button class="btn btn-success">Next</button> -->
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</form>        
		</div>

		<!-------------------------------THIRD---------------------------------------------->


		<div id="Zone" class="panel-collapse collapse" role="tabpanel"  class="tab-pane fade" aria-expanded="true">
			<form id="vendor_zone" name="vendor_zone" action="<?= base_url('admin/rider/edit_zone')?>" method="post" style="margin-top: 6px;">
				<div>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<input type="hidden" id="id" name="restid" value="<?php echo $rider[0]['rider_id'];?>">
									<input type="hidden" name="rid" value="<?php echo $rider[0]['rider_id'];?>" />
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-landmark">
												<label class="control-label col-sm-3">Zone</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="landmark" autocomplete="off" name="rider[landmark]" value="<?php echo $rider[0]['landmark'];?>" />
												</div>
												<div class="messageContainer col-sm-4"></div>
											</div>
										</div>

										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-locality">
												<label class="control-label col-sm-5">Rider Operation Area<span class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" class="form-control" autocomplete="off" id="opration_area" name="rider[opration_area]" value="<?php echo $rider[0]['opration_area'];?>"/>
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
													<input type="text" class="form-control" id="latitude" name="rider[latittude]"  readonly value="<?php echo $rider[0]['latittude'];?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-longitude">
												<label class="control-label col-sm-5">Longitude <span class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="longitude" name="rider[longitude]" readonly value="<?php echo $rider[0]['longitude'];?>"/>
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
													<input type="text" class="form-control" id="radius" name="rider[radius]" value="<?php echo $rider[0]['radius'];?>"/>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>


									<input type="hidden" name="geofencestr" id="geofencestr" value="" /> 
									<input type="hidden" name="vendor_id" value="<?php echo $rider[0]['rider_id'];?>" />


									<div class="col-lg-12 margin-bottom-5 text-center">
										<div id="response"></div>
										<?php if($_SESSION['adminsession']['user_role']==1){?>
											<button type="submit" class="btn btn-success">Update</button>
										<?php } else {?>
											<button type="submit" class="btn btn-success" disabled>Update</button>
										<?php }?>
									</div>


								</div>
							</div>
						</div>
					</div>
				</div>
			</form>        
		</div>
		<!-------------------------------FOURTH---------------------------------------------->
		<div id="Billing" class="panel-collapse collapse" role="tabpanel"  class="tab-pane fade" aria-expanded="true">
			<form id="frmbilling" name="frmbilling" action="" method="post" style="margin-top: 6px;">
				<input type="hidden" name="rider[restid]" value="<?= isset($rider[0]['rider_id'])?$rider[0]['rider_id']:0;?>" />
				<div>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<input type="hidden" id="id1" name="id" value="<?php echo isset($riderbilling[0]['restid'])?$riderbilling[0]['restid']:"";?>">
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-billing_cycle">
												<label class="control-label col-sm-5">Billing Cycle <span class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<select name="rider[billing_cycle]" id="billing_cycle" class="form-control" style="display:inline;width:48%;">
														<option value="">Select Billing Cycle</option>
														<option value="1"<?= (isset($riderbilling[0]['billing_cycle']) && $riderbilling[0]['billing_cycle'] == 1)? "selected":"" ?>>Weekly</option>
														<option value="2"<?= (isset($riderbilling[0]['billing_cycle']) && $riderbilling[0]['billing_cycle'] == 2)? "selected":"" ?>>Fortnightly</option>
														<option value="3"<?= (isset($riderbilling[0]['billing_cycle']) && $riderbilling[0]['billing_cycle'] == 3)? "selected":"" ?>>Monthly</option>
													</select>
													<input type="text" id="cycle_effective_date" name="rider[cycle_effective_date]" class="form-control" placeholder="Effective Date" style="display:inline;width:49%;" value="<?php if($cycle) {echo date('d-m-Y',strtotime($cycle[0]['from_date']));}?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-with_service_tax">
												<label class="control-label col-sm-5">Inclusive Service Tax </label>
												<div class="col-sm-10">
													<select name="rider[with_service_tax]" id="with_service_tax" class="form-control" >
														<option value="1"<?= (isset($riderbilling[0]['with_service_tax']) && $riderbilling[0]['with_service_tax'] == 1)? "selected":"" ?>>Yes</option>
														<option value="0"<?= (isset($riderbilling[0]['with_service_tax']) && $riderbilling[0]['with_service_tax'] == 0)? "selected":"" ?>>No</option>
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
													<select name="rider[payment_mode]" id="payment_mode" class="form-control" onchange="change()">
														<option value="1"<?= (isset($riderbilling[0]['payment_mode']) && $riderbilling[0]['payment_mode'] == 1)? "selected":"" ?>>Online</option>
														<option value="2"<?= (isset($riderbilling[0]['payment_mode']) && $riderbilling[0]['payment_mode'] == 2)? "selected":"" ?>>Cheque</option>
													</select>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<div class="col-lg-6 margin-bottom-5" id="chk1">
											<div class="form-group" id="error-cheque-favour-of">
												<label class="control-label col-sm-5">Cheque In Favour</label>
												<div class="col-sm-10">
													<input type="text" autocomplete="off" class="form-control" id="cheque_favour_of" name="rider[cheque_favour_of]" value="<?= isset($riderbilling[0]['cheque_favour_of'])? $riderbilling[0]['cheque_favour_of']:"" ?>"/>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>

									<div id="bank">
										<div class="row">
											<div class="col-lg-6 margin-bottom-5">
												<div class="form-group" id="error-min_amount">
													<label class="control-label col-sm-6">Minimum Billing Amount <span class='text-danger'>*</span></label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="min_amount" name="rider[min_amount]" value="<?= isset($riderbilling[0]['min_amount'])?$riderbilling[0]['min_amount']:"" ?>" />
													</div>
													<div class="messageContainer col-sm-10"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-hard_copy">
												<label class="control-label col-sm-10">Invoice Hardcopy Required ?</label>
												<div class="col-sm-10">
													<select name="rider[hard_copy]" id="hard_copy" class="form-control">
														<option value="1"<?= (isset($riderbilling[0]['hard_copy']) && $riderbilling[0]['hard_copy'] == 1)? "selected":"" ?>>Yes</option>
														<option value="0"<?= (isset($riderbilling[0]['hard_copy']) && $riderbilling[0]['hard_copy'] == 0)? "selected":"" ?>>No</option>
													</select>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
										<!-- <div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-invoice_notify_mobile">
												<label class="control-label col-sm-5">Gateway Charge <span class='text-danger'>*</span></label>
												<div class="col-sm-10">
													<input type="text" id="gateway_charge" name="gateway_charge" class="form-control" placeholder="Gateway Charge" style="width:37%;display:inline;" value="<?= (isset($gateway[0]['value']) && $gateway[0]['value'])?$gateway[0]['value']:"" ?>" />
													<input type="text" id="gateway_effective_date" name="gateway_effective_date" placeholder="Effective Date" class="form-control" style="width:60%;display:inline;" value="<?= isset($gateway[0]['from_date'])? date('d-m-Y',strtotime($gateway[0]['from_date'])):"" ?>" />
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div> -->
										<div class="col-lg-6 margin-bottom-5">
											<div class="form-group" id="error-ifsc_code">
												<label class="control-label col-sm-5">Commission in %</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="commission_ride" min="0" name="rider[commission_service]" value="<?= (isset($riderbilling[0]['commission_service'])) ? $riderbilling[0]['commission_service']:"" ?>"/>
												</div>
												<div class="messageContainer col-sm-10"></div>
											</div>
										</div>
									</div>

									<div class="col-lg-12 margin-bottom-5 text-center">
										<?php if($_SESSION['adminsession']['user_role']==1){ ?>
										<button type="submit" class="btn btn-success">Update</button>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>        
		</div>
	<!-------------------------------FOURTH---------------------------------------------->
	</div>  

					</div>
				</div>
			</div>
		</div>
	</div>
</div>         

<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/selectize.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script>
	$.fn.datepicker.defaults.format = "dd-mm-yyyy";

	$('#cycle_effective_date').datepicker().on('changeDate', function (ev) {
		$('#frmbilling').bootstrapValidator('revalidateField', 'cycle_effective_date');
	});

	$('#frmbilling').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
	},
	feedbackIcons: {
		validating: 'glyphicon glyphicon-refresh'
	},
	excluded: ':disabled',
	fields: {
				'rider[billing_cycle]': {
					validators: {
						notEmpty: {
							message: 'Billing cycle is required and cannot be empty'
						}
					}
				},
				'rider[cycle_effective_date]': {
					validators: {
						notEmpty: {
							message: 'Effective cycle date is required'
						},
						date: {
							format: 'DD-MM-YYYY',
							message: 'Effective cycle date is not a valid'
						}
					}
				}/*,
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
				}*/
		    }
		}).on('success.form.bv', function(event,data) {
			// Prevent form submission
			event.preventDefault();
			var form = $(this);
            form = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: base_url+'rider_billing',
                data: form,
                processData: false,
                contentType: false,
                success: function(data)
                {
                    data = JSON.parse(data);
                    if(data.status == '1')
                    {
                        alert(data.msg);
						window.location.href = base_url+"admin/rider/list";
                    }
                }
            });

            return false;
		});

	$('#editrider').bootstrapValidator({
		container: function ($field, validator) {
			return $field.parent().next('.messageContainer');
		},

		feedbackIcons: {
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'rider[rider_name]': {
				validators: {
					notEmpty: {
						message: 'Rider name is required and cannot be empty'
					},
					regexp: {
						regexp: '^[a-zA-Z ]+$',
						message: 'Only letters allowed'
					}
				}
			},
			'rider[dob]': {
				validators: {
					notEmpty: {
						message: 'Date of birth is required and cannot be empty'
					}
				}
			},
			'rider[email]': {
				validators: {
					notEmpty: {
						message: 'Email is required and cannot be empty'
					},
					regexp: {
						regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
						message: 'The value is not a valid email address'
					}
				}
			},
			'rider[mobile]': {
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
			'rider[address]': {
				validators: {
					notEmpty: {
						message: 'Address is required and cannot be empty'
					}
				}
			},
			'rider[id_name]': {
				validators: {
					notEmpty: {
						message: 'Identity name is required and cannot be empty'
					}
				}
			},
			'rider[id_number]': {
				validators: {
					notEmpty: {
						message: 'Identity number is required and cannot be empty'
					}
				}
			},
			'rider[pincode]': {
				validators: {
					notEmpty: {
						message: 'Pincode is required and cannot be empty'
					},
					integer: {
						message: 'Invalid pincode.'
					},
					stringLength: {
						max: 6,
						min: 6,
						message: 'Invalid pincode.'
					}
				}
			},
			'rider[vehicle_no]': {
				validators: {
					notEmpty: {
						message: 'Vehicle No is required and cannot be empty'
					},
					regexp: {
						regexp:'^[A-Z]{2}[ -][0-9]{1,2}(?: [A-Z])?(?: [A-Z]*)? [0-9]{4}$',
						message: 'Invalid Vehicle Number'
					}
				}
			}
		}
	}).on('success.form.bv', function (event, data) {
// Prevent form submission
event.preventDefault();
editrider();
});


	$('#restbilling').bootstrapValidator({
		container: function ($field, validator) {
			return $field.parent().next('.messageContainer');
		},

		feedbackIcons: {
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'rider[account_name]': {
				validators: {
					notEmpty: {
						message: 'Account holder name is required and cannot be empty'
					},
					regexp: {
						regexp: '^[a-zA-Z ]+$',
						message: 'Only letters allowed'
					}
				}
			},
			'rider[account_number]': {
				validators: {
					notEmpty: {
						message: 'Account number is required and cannot be empty'
					},
					regexp: {
						regexp: '^[0-9 ]+$',
						message: 'Only numeric values allowed'
					}
				}
			},
			'rider[bank_name]': {
				validators: {
					notEmpty: {
						message: 'Bank name is required and cannot be empty'
					}
				}
			},
			'rider[branch_name]': {
				validators: {
					notEmpty: {
						message: 'Branch name is required and cannot be empty'
					}
				}
			},
			'rider[ifsc_code]': {
				validators: {
					notEmpty: {
						message: 'IFSC is required and cannot be empty'
					},
					regexp: {
						regexp: '^[A-Za-z]{4}[0-9]{6,7}$',
						message: 'IFSC format is not valid'
					}
				}
			}
			
		}
	}).on('success.form.bv', function (event, data) {
		event.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            form = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: url,
                data: form,
                processData: false,
                contentType: false,
                success: function(data)
                {
                    data = JSON.parse(data);
                    if(data.status == '1'){
                        alert(data.msg);
						window.location.href = base_url+"admin/rider/list";
                    }
                }
            });

            return false;
	});

	

	$('#vendor_zone').bootstrapValidator({
		container: function ($field, validator) {
			return $field.parent().next('.messageContainer');
		},

		feedbackIcons: {
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'rider[landmark]': {
				validators: {
					notEmpty: {
						message: 'Zone is required and cannot be empty'
					}
				}
			},
			
			'rider[opration_area]': {
				validators: {
					notEmpty: {
						message: 'Operation Area is required and cannot be empty'
					}
				}
			},
			
			'rider[radius]': {
				validators: {
					notEmpty: {
						message: 'Radius is required and cannot be empty'
					},
					regexp: {
						regexp: '^[0-9 ]+$',
						message: 'Only numeric values allowed'
					}
				}
			}
			
		}
	}).on('success.form.bv', function (event, data) {
		event.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            form = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: url,
                data: form,
                processData: false,
                contentType: false,
                success: function(data)
                {
                    data = JSON.parse(data);
                    if(data.status == '1'){
                        alert(data.msg);
						window.location.href = base_url+"admin/rider/list";
                    }
                }
            });

            return false;
	});



	function editrider() {
		var options = {
			target: '#response',
			beforeSubmit: showAddRequest,
			success: showAddResponse,
			url: base_url + 'admin/rider/add',
			semantic: true,
			dataType: 'json'
		};
		$('#editrider').ajaxSubmit(options);
	}

	function editriderbank(){
		var options = {
			target: '#response',
			beforeSubmit: showAddRequest,
			success: showAddResponse,
			url: base_url + 'admin/rider/editPayment',
			semantic: true,
			dataType: 'json'
		};
		$('#editrider').ajaxSubmit(options);
	}

	function showAddRequest(formData, jqForm, options) {
		$("#response").hide();
		var queryString = $.param(formData);
		console.log(queryString);
		return true;
	}

	function showAddResponse(resp, statusText, xhr, $form) {
		$('button').removeAttr('disabled');
		if (resp.status == '0') {
			alert(resp.msg);

			$("#response1").removeClass('alert-success');
			$("#response1").addClass('alert-danger');
			$("#response1").html(resp.msg);
			$("#response1").show();
		} else {
			alert(resp.msg);
			$("#response1").removeClass('alert-danger');
			$("#response1").addClass('alert-success');
			$("#response1").html(resp.msg);
			$("#response1").show();
			var id = $("#id").val();
			window.location.href = base_url+"admin/rider/edit/"+id;
		}
	}
</script>
<script>
	$(function () {
		$("#treecheck").almightree({search: "#box"});
	});

	function toggale_div(div) {
		$(div).trigger('click');
	}
</script>


<script>
	$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places,drawing&callback=initMap&key=<?= GOOGLE_MAP_API_KEY ?>");



function initMap() {
	console.log("sdfds");
	var options = {
		componentRestrictions: {country: 'in'}
	};
	var input =  document.getElementById('opration_area');
	var autocomplete = new google.maps.places.Autocomplete(input,options);
	autocomplete.addListener('place_changed', function() {
		var place = autocomplete.getPlace();
		if (!place.geometry) {
			window.alert("Autocomplete's returned place contains no geometry");
			return;
		}
		console.log(place.geometry.location);
		$('#latitude').val(place.geometry.location.lat());
		$('#longitude').val(place.geometry.location.lng());
		$('#vendor_area').bootstrapValidator('revalidateField', 'locality');		
	});
}





</script>