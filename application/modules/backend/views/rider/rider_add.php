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
		<h3 class="page-header">Add Rider</h3>
		<div class="panel panel-info">
			<div class="panel-wrapper collapse in" aria-expanded="true">
				<div class="panel-body">
					<div class="form-body">
						<ul class="nav customtab nav-tabs" role="tablist">
							<li role="presentation" class="nav-item" title="Basic details">
								<a href="#basic" id="Basic_li" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Basic Details</span></a>
							</li>
							<li role="presentation" class="nav-item disabled" title="Please fill basic details">
								<a href="#meta_info" id="Service_li" class="nav-link disabled" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Payment</span></a>
							</li>
							<li role="presentation" class="nav-item disabled" title="Please fill basic details">
								<a href="#meta_info" id="Service_li" class="nav-link disabled" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Zone</span></a>
							</li>
						</ul>
						<div class="tab-content">
							
							<div id="basic" class="tab-pane fade in active">
								<form id="addrider" name="addrider" action="" method="post" enctype="">
									<div class="row">
										<div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-body">
													<div class="row">
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-name">
																<label class="control-label col-sm-5">Rider Name <span class='text-danger'>*</span></label>
																<div class="col-sm-10">
																	<input type="text" autocomplete="off" class="form-control" id="rider_name" name="rider[rider_name]"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-dob">
																<label class="control-label col-sm-5">Rider DOB <span class='text-danger'>*</span></label>
																<div class="col-sm-10">
																	<input type="date" class="form-control" id="rider_dob" name="rider[dob]"/>
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
																	<input type="text" class="form-control" id="mobile" name="rider[mobile]" autocomplete="off" maxlength="10" />
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-email">
																<label class="control-label col-sm-5">Email <span class='text-danger'></span></label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" id="email" name="rider[email]" autocomplete="off"/>
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
																	<textarea class="form-control" autocomplete="off" rows="3" id="address" name="rider[address]"></textarea>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
														<div class="col-lg-2 margin-bottom-5">
															<div class="form-group" id="error-pincode">
																<label class="control-label col-sm-5">Pincode</label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" autocomplete="off" id="pincode" name="rider[pincode]" maxlength="6" />
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
														<div class="col-lg-3 margin-bottom-5">
															<div class="form-group" id="error-vehicle_no">
																<label class="control-label col-sm-5">Vehicle No</label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" autocomplete="off" id="vehicle_no" name="rider[vehicle_no]" />
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
																	<input type="text" class="form-control" autocomplete="off" id="id_name1" name="rider[id_name]"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>

														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-pincode">
																<label class="control-label col-sm-5">Profile photo</label>
																<div class="col-sm-10">
																	<input type="file" name="image" accept="image/jpg,image/jpeg,image/png">
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>

														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-idname">
																<label class="control-label col-sm-5">Identity Name 2</label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" autocomplete="off" id="id_name2" name="rider[id_name2]"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>

														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-pincode">
																<label class="control-label col-sm-5">Profile photo</label>
																<div class="col-sm-10">
																	<input type="file" name="image2" accept="image/jpg,image/jpeg,image/png">
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>

														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-idname">
																<label class="control-label col-sm-5">Identity Name 3</label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" autocomplete="off" id="id_name3" name="rider[id_name3]"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>

														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-pincode">
																<label class="control-label col-sm-5">Profile photo</label>
																<div class="col-sm-10">
																	<input type="file" name="image3" accept="image/jpg,image/jpeg,image/png">
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>

														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-idname">
																<label class="control-label col-sm-5">Identity Name 4</label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" autocomplete="off" id="id_name4" name="rider[id_name4]"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>

														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-pincode">
																<label class="control-label col-sm-5">Profile photo</label>
																<div class="col-sm-10">
																	<input type="file" name="image4" accept="image/jpg,image/jpeg,image/png">
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>

														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-idname">
																<label class="control-label col-sm-5">Identity Name 5</label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" autocomplete="off" id="id_name5" name="rider[id_name5]"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>

														<div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-pincode">
																<label class="control-label col-sm-5">Profile photo</label>
																<div class="col-sm-10">
																	<input type="file" name="image5" accept="image/jpg,image/jpeg,image/png">
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div>
														<!-- <div class="col-lg-6 margin-bottom-5">
															<div class="form-group" id="error-pincode">
																<label class="control-label col-sm-5">Identity Number</label>
																<div class="col-sm-10">
																	<input type="text" class="form-control" autocomplete="off" id="id_number" name="rider[id_number]"/>
																</div>
																<div class="messageContainer col-sm-10"></div>
															</div>
														</div> -->
													</div>
													
													<div class="row"><input type="hidden" name="id" id="id">
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


<div id="Zone" class="panel-collapse collapse" role="tabpanel"  class="tab-pane fade" aria-expanded="true">
	<form id="vendor_area" name="vendor_area" action="" method="post" style="margin-top: 6px;">
		<div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<input type="hidden" id="id" name="id" value="<?php echo $basic[0]['id'];?>">
							<input type="hidden" name="rid" value="<?php echo $basic[0]['id'];?>" />
							<div class="row">
								<div class="col-lg-6 margin-bottom-5">
									<div class="form-group" id="error-landmark">
										<label class="control-label col-sm-3">Landmark</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="landmark" autocomplete="off" name="landmark" value="<?php echo $basic[0]['landmark'];?>" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
								<div class="col-lg-6 margin-bottom-5">
									<div class="form-group" id="error-locality">
										<label class="control-label col-sm-5">Accurate Location <span class='text-danger'>*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" autocomplete="off" id="locality" name="locality" value="<?php echo $basic[0]['locality'];?>"/>
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
											<input type="text" class="form-control" id="latitude" name="latitude"  readonly value="<?php echo $basic[0]['latitude'];?>" />
										</div>
										<div class="messageContainer col-sm-10"></div>
									</div>
								</div>
								<div class="col-lg-6 margin-bottom-5">
									<div class="form-group" id="error-longitude">
										<label class="control-label col-sm-5">Longitude <span class='text-danger'>*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="longitude" name="longitude" readonly value="<?php echo $basic[0]['longitude'];?>"/>
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
											<input type="text" class="form-control" id="radius" name="radius" value="<?php echo $basic[0]['radius'];?>"/>
										</div>
										<div class="messageContainer col-sm-10"></div>
									</div>
								</div>
							</div>

							<input type="hidden" name="have_gf" id="have_gf" value="<?php echo $basic[0]['have_gf'];?>" /> 
					<!-- <input type="hidden" name="latitude" id="latitude" value="<?php echo $basic[0]['latitude'];?>" />
						<input type="hidden" name="longitude" id="longitude" value="<?php echo $basic[0]['longitude'];?>" />  -->
						<input type="hidden" name="geofencestr" id="geofencestr" value="" /> 
						<input type="hidden" name="vendor_id" value="<?php echo $basic[0]['id'];?>" />
<!-- <div class="row">
	<div class="col-lg-12 margin-bottom-5 text-center">
		<input type="hidden" name="id" value="<?php echo $basic[0]['id'];?>">
		<div id="response"></div>
		<button type="submit" class="btn btn-success">Submit</button>
	</div>
</div>  -->

<div class="col-lg-12 margin-bottom-5 text-center">
	<div id="response"></div>
	<?php if($_SESSION['adminsession']['user_role']==1){?>
		<button type="submit" class="btn btn-success">Update</button>
	<?php } else {?>
		<button type="submit" class="btn btn-success" disabled>Update</button>
	<?php }?>
	<!-- <button class="btn btn-success">Next</button> -->
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

$('#addrider').bootstrapValidator({
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
		},
		'image': {
			validators: {
				notEmpty: {
				message: 'Profile photo is required and cannot be empty'
				}
			}
		}
	}
}).on('success.form.bv', function (event, data) {
// Prevent form submission
event.preventDefault();
addrider();
});

function addrider() {
	var options = {
		target: '#response',
		beforeSubmit: showAddRequest,
		success: showAddResponse,
		url: base_url + 'admin/rider/add',
		semantic: true,
		dataType: 'json'
	};
	$('#addrider').ajaxSubmit(options);
}

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
		$("#response1").html(resp.msg);
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
		window.location.href = base_url+"admin/rider/edit/"+resp.id;
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