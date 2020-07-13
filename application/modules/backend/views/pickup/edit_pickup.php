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
		<h3 class="page-header">Edit Pickup slot</h3>
		<div class="panel panel-info">
			<div class="panel-wrapper collapse in" aria-expanded="true">
				<div class="panel-body">
					<div class="form-body">		

						<form id="addrestaurant" name="addrestaurant" action="<?= base_url('admin/pickup/updatePickup')?>" method="post">
							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-default">
										<div class="panel-body">
											<input type="hidden" name="edit_id" value="<?= $pickup['id']?>">
											<div class="row">
												<div class="col-lg-6 margin-bottom-5">
													<div class="form-group" id="error-name">
														<label class="control-label col-sm-5">From -KM <span class='text-danger'>*</span></label>
														<div class="col-sm-10">
															<input type="text" autocomplete="off" class="form-control" id="garage_name" name="minkm" value="<?= $pickup['minkm']?>" />
														</div>
														<div class="messageContainer col-sm-10"></div>
													</div>
												</div>
												<div class="col-lg-6 margin-bottom-5">
													<div class="form-group" id="error-name">
														<label class="control-label col-sm-5">To- KM <span class='text-danger'>*</span></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" id="name" name="maxkm" value="<?= $pickup['maxkm']?>" />
														</div>
														<div class="messageContainer col-sm-10"></div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6 margin-bottom-5">
													<div class="form-group" id="error-landmark">
														<label class="control-label col-sm-5">Price <span class='text-danger'></span></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" id="email" name="price" autocomplete="off" value="<?= $pickup['price']?>" />
														</div>
														<div class="messageContainer col-sm-10"></div>
													</div>
												</div>
												<div class="col-lg-6 margin-bottom-5">
													<div class="form-group" id="error-pincode">
														<label class="control-label col-sm-5">Status</label>
														<div class="col-sm-10">
															<select name="status" id="rating" class="form-control">
																<option value=""> Select rating</option>
																	<option value="0">Active</option>
																	<option value="1">In-Active</option>
															</select>
														</div>
														<div class="messageContainer col-sm-10"></div>
													</div>
												</div>  
											</div>

											<div class="row">
												<div class="col-lg-12 margin-bottom-5 text-center">
													<div id="response1"></div>
													<button type="submit" id="save_btn" class="btn btn-block btn-success">Save</button>
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

	$('#addrestaurant').bootstrapValidator({
		container: function ($field, validator) {
			return $field.parent().next('.messageContainer');
		},

		feedbackIcons: {
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'minkm': {
				validators: {
					notEmpty: {
						message: 'From -km is required and cannot be empty'
					},
					regexp: {
						regexp: '^[0-9 ]+$',
						message: 'Only numeric values allowed'
					}
				}
			},
			'maxkm': {
				validators: {
					notEmpty: {
						message: 'To -KM is required and cannot be empty'
					},
					regexp: {
						regexp: '^[0-9 ]+$',
						message: 'Only numeric values allowed'
					}
				}
			},
			'price': {
				validators: {
					notEmpty: {
						message: 'Bank name is required and cannot be empty'
					},
					regexp: {
						regexp: '^[0-9 ]+$',
						message: 'Only numeric values allowed'
					}
				}
			},
			'status': {
				validators: {
					notEmpty: {
						message: 'Branch name is required and cannot be empty'
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
					window.location.href = base_url+"admin/general/pickup";
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

	$('#rating').val('<?= $pickup['status']?>');
</script>