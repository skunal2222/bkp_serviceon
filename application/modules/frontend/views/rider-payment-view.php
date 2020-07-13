<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>frontend/css/confirm-booking-responsive.css">
<section id="about-section" class="bg-white">
	<div class="row">
		
		<div class="col-lg-12 text-center">
			<h4 class="about-section-title text-center">Riding Payment</h4>
		</div>

		<div class="col-lg-12"> 
			
			<!------------------------------------------------------------------------------------------------->
			<div class="row">
				<div class="col-lg-12">
					<div class="user-address">
						<div class="jumbotron">
							<form action="<?= base_url(); ?>ride-payment-confirm" method="POST" accept-charset="utf-8">
						 		<div class="row">
						 			<?php // echo "<pre>"; print_r($userdata); ?>
									<div class="col-lg-6">
										<label for="name">Name</label>
										<input type="text" class="form-control" id="name" name="order[name]" value="<?= (!empty($userdata['name']))?$userdata['name']:"" ?>" readonly>
									</div>
									<div class="col-lg-6">
										<label for="email">Email</label>
										<input type="text" class="form-control" id="email" name="order[email]" value="<?= (!empty($userdata['email']))?$userdata['email']:"" ?>" readonly>
									</div>
									<div class="col-lg-6">
										<label for="mobile">Mobile</label>
										<input type="text" class="form-control" id="mobile" name="order[mobile]" value="<?= (!empty($userdata['mobile']))?$userdata['mobile']:"" ?>" readonly>
									</div>
									<div class="col-lg-6">
										<label for="st">Service Type</label>
										<input type="text" class="form-control" id="st" name="orer[st]" value="<?= (!empty($userdata['subcategory_id']) && $userdata['subcategory_id'] == 1)?"Pick'n drop":(($userdata['subcategory_id'] == 2)?"Breakdown":""); ?>" readonly>
									</div>
									<div class="col-lg-6">
										<label for="charge">Applied Charge (Rs) </label>
										<input type="text" class="form-control" id="charge" name="oder[charge]" value="<?= (!empty($userdata['applied_ride_charge']))?$userdata['applied_ride_charge']:""; ?>" readonly>
									</div>
								</div>
							<input type="hidden" id="orderid" name="order[orderid]" value="<?= $userdata['orderid'] ?>">
							<input type="hidden" id="price" name="order[amount]" value="<?= (!empty($userdata['applied_ride_charge']))?$userdata['applied_ride_charge']:""; ?>">
							<div class="summary-confirm-btn pt-5 text-center">
								<?php if (!empty($this->session->tempdata('ride_payment_status'))) { ?>
									<h3>Payment Successful! Please wait for generating booking ID</h3>
								<?php } else if ($this->session->tempdata('ride_payment_status') === 0) { ?>
									<h3>Retry, Payment Failed!</h3>
									<button type="submit" style="width: 50%; height: 48px;">Pay Again</button>
								<?php } else { ?>
									<button type="submit" style="width: 50%; height: 48px;">Pay</button>
								<?php } ?>
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
	<?php if (!empty($this->session->tempdata('ride_payment_status'))) { ?>
		setInterval(function(){ location.href = base_url+"order-details/<?= $userdata['ordercode'] ?>"; }, 5000);
	<?php } ?>
</script>