<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>frontend/css/confirmation-responsive.css">
<section id="confirmation-section" class="d-flex justify-content-center text-center">
	<div class="row">
		<div class="col-12 header-imgs">
			<img class="left-side-img" src="<?php echo asset_url(); ?>frontend/images/statue.png">	
			<img class="right-side-img" src="<?php echo asset_url(); ?>frontend/images/statue1.png">		
<?php //echo "<pre>"; print_r($_SESSION); die(); ?>
			<div class="text-center">
				<h2 class="confirm-title">We have received your order</h2>
				<h3 class="order-number"><?= ($payment_status == 1)?"Payment Successful!":""; ?></h3>
				<div class="confirm-details text-center">
					<h5 class="order-number">Order Number</h5>
					<h3 class="pt-1 track-no"><?= $ordercode; ?></h3>
				</div>
				<div class="d-flex justify-content-center pt-3 pb-4">
					<div class="track-button text-center">
						<a href="<?php echo base_url(); ?>track-order/<?= $ordercode; ?>" class="submit-btn">Track Order</a>		
					</div>
				</div>
			</div>
		</div>
	</div>
</section>