<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>frontend/css/confirm-booking-responsive.css">
<section id="about-section" class="bg-white">
	<div class="row">
		
		<div class="col-lg-12 text-center">
			<h4 class="about-section-title text-center">Booking Summary</h4>
		</div>

		<div class="col-lg-12"> 
			
			<!------------------------------------------------------------------------------------------------->
			<div class="row">
				<div class="col-lg-12">
					<div class="user-address">
						<div class="jumbotron">
							<h4 class="">Selected Vendor</h4>
							<p class="logg-in confirm-content"><b><?= ucwords($garage_detail['garage_name']); ?></b></p>
							<hr>
							<h4 class="">Categories</h4>
							<?php foreach ($categories as $cats) { ?>
								<h5 class=""><?= $cats['name'] ?></h5><br>
							<?php } ?>
							
							<hr>
							<h4 class="">Pickup Address</h4>
							<?php
							$address = "";
							$address_id = false;
							if (!empty($userAddress)) {
								foreach ($userAddress as $data) {
									if ($data['is_primary'] == 1) {
										$address_id = $data['id'];
										$address = $data['address'].", ".$data['locality'].", ".$data['landmark'].", ".$data['cityname'].", ".$data['statename'].", ".$data['pincode'];
										break;
									}
								}

								if (empty($address)) {	
									$last_id = sizeof($userAddress)-1;
									$address_id = $userAddress[$last_id]['id'];
									$address = $userAddress[$last_id]['address'].", ".$userAddress[$last_id]['locality'].", ".$userAddress[$last_id]['landmark'].", ".$userAddress[$last_id]['cityname'].", ".$userAddress[$last_id]['statename'].", ".$userAddress[$last_id]['pincode'];
								}
							}
							?>
							<p class="logg-in confirm-content"><b><?= ucwords($address); ?></b></p>
							<hr>
							<h4 class="">Pickup Slot</h4>
							<p class="logg-in confirm-content"><b><?= $_SESSION['slotdate']." | ".$_SESSION['slottime']; ?></b></p>
							<hr>
							<h4 class="">Vehicle</h4>
							<?php
							$vehicle = "";
							$vehicle_id = false;
							if (!empty($userVehicle)) {
								foreach ($userVehicle as $data) {
									if ($data['is_primary_vehicle'] == 1) {
										$vehicle_id = $data['id'];
										$brand_id = $data['brand_id'];
										$model_id = $data['model_id'];
										$vehicle = $data['vehicle_no']."(Brand:".$data['brandname'].", Model:". $data['modelname'].")";
										break;
									}
								}
							}
							?>
							<p class="logg-in confirm-content"><b><?= ucwords($vehicle); ?></b></p>
							<hr>
							<h4 class="">Handling Charges</h4><b>
						 		<p class="logg-in confirm-content">Service Type : <?= $stData['serviceType']; ?></p>
						 		<p class="logg-in confirm-content">Charges Applied : <?= "Rs". $stData['price']; "/-" ?></p>
						 		<p class="logg-in confirm-content">Payment Mode : 
						 		<?= ($stData['paymode'] == 1)?"Cash on Delivery":"Online"; ?>
						 		</p></b>
							<hr>
							<form id="submit_order">
								<div class="row">
									<div class="col-lg-6"><?php //print_r($_SESSION); ?>
									<label for="fname">First Name</label>
									<input type="text" class="form-control" id="fname" name="order[fname]" value="<?= (isset($_SESSION['olousername']))?$_SESSION['olousername']:"" ?>">
									<div class="messageContainer"></div>
								</div>
								<div class="col-lg-6">
									<label for="lname">Last Name</label>
									<input type="text" class="form-control" id="lname" name="order[lname]" value="<?= (isset($_SESSION['olouserlname']))?$_SESSION['olouserlname']:"" ?>">
									<div class="messageContainer"></div>
								</div>
								<div class="col-lg-6">
									<label for="email">Email</label>
									<input type="text" class="form-control" id="email" name="order[email]" value="<?= (isset($_SESSION['olouseremail']))?$_SESSION['olouseremail']:"" ?>">
									<div class="messageContainer"></div>
								</div>
								<div class="col-lg-6">
									<label for="mobile">Mobile</label>
									<input type="text" class="form-control" id="mobile" name="order[mobile]" value="<?= (isset($_SESSION['olousermobile']))?$_SESSION['olousermobile']:"" ?>" readonly>
									<div class="messageContainer"></div>
								</div>
								<div class="col-lg-12">
									<br>
									<input type="checkbox" id="is_orderconfirm" name="is_orderconfirm" required><label for="is_orderconfirm"> I confirm the above all information to complete this order.</label>
									<div class="messageContainer"></div>
								</div>
							</div>
							<input type="hidden" id="vendor_id" name="order[vendor_id]" value="<?= $order['vendor_id'] ?>">
							<input type="hidden" id="user_id" name="order[user_id]" value="<?= $order['user_id'] ?>">
							<input type="hidden" id="order_slotdate" name="order[slotdate]" value="<?= date('Y-m-d',strtotime($order['slotdate'])); ?>">
							<input type="hidden" id="order_slottime" name="order[slottime]" value="<?= $order['slottime'] ?>">
							<input type="hidden" id="order_address" name="order[address_id]" value="<?= $address_id ?>">
							<input type="hidden" id="order_vehicle" name="order[vehicle_id]" value="<?= $vehicle_id ?>">
							<input type="hidden" id="brand_id" name="order[brand_id]" value="<?= $brand_id ?>">
							<input type="hidden" id="model_id" name="order[model_id]" value="<?= $model_id ?>">
							<input type="hidden" id="order_cats" name="order[servicegroup_id]" value="<?= $order['categories']; ?>">
							<input type="hidden" id="order_ride_charge" name="order[ride_charge]" value="<?= $_SESSION['stData']['price']; ?>">
							<input type="hidden" id="order_serviceType" name="order[st]" value="<?= $_SESSION['stData']['st']; ?>">
							<input type="hidden" id="order_pm" name="order[paymode]" value="<?= $_SESSION['stData']['paymode']; ?>">

							<input type="hidden" id="ccode" name="order[ccode]" value="<?= $ccode; ?>">

							<span id="response-msg"></span>
							<div class="summary-confirm-btn pt-5 text-center">
								<button type="submit" style="width: 50%; height: 48px;">Confirm</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!------------------------------------------------------------------------------------------------->
		
	</div>
</div>
</section>

<script type="text/javascript">
	$(document).ready(function () {
		$('#submit_order').bootstrapValidator({
			container: function($field, validator) {
				return $field.parent().find('.messageContainer');
			},
			feedbackIcons: {
				validating: 'glyphicon glyphicon-refresh'
			},
			excluded: ':disabled',
			fields: {
				'order[fname]': {
					validators: {
						notEmpty: {
							message: 'This is required'
						},
						regexp:{
							regexp:'^[a-zA-Z]+$',
							message: 'Allowed letters only'
						}
					}
				},
				'order[lname]': {
					validators: {
						notEmpty: {
							message: 'This is required'
						},
						regexp:{
							regexp:'^[a-zA-Z]+$',
							message: 'Allowed letters only'
						}
					}
				},
				'order[email]': {
					validators: {
						notEmpty: {
							message: 'This is required'
						},
						regexp:{
							regexp:'^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
							message: 'Not a valid email address '
						}

					}
				},
				'order[mobile]': {
					validators: {
						notEmpty: {
							message: 'This is required'
						},
						regexp:{
							regexp:'^[6-9][0-9]{9}$',
							message: 'Please enter a 10 digit valid mobile number'
						}
					}
				},
				'is_orderconfirm': {
					validators: {
						notEmpty: {
							message: 'This is required'
						}
					}
				}
			}
		}).on('success.form.bv', function(event,data) {
			event.preventDefault();
			$("#response-msg").hide();
			var formData = new FormData($('#submit_order')[0]);
			ajaxindicatorstart('please wait');
			$.ajax({ url: base_url + 'submit_order', data: formData, type: 'POST', dataType: 'JSON', processData: false, contentType: false, success: function (response) { 
				ajaxindicatorstop();
				$("#response-msg").show();
				if (response.status == 1) {
					$("#response-msg").css('color','green');
					$("#response-msg").html(response.msg);
					setInterval(function(){ location.href = base_url+response.url; }, 3000);
				} else {
					$("#response-msg").css('color','red');
					$("#response-msg").html("Error, Something went wrong!");
				}
			}
		});
			return false;
		});
	});
</script>