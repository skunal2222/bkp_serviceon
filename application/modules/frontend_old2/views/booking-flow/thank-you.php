<?php
//print_r($_SESSION);
            $this->session->unset_userdata('brand_id');
			$this->session->unset_userdata('model_id');
			$this->session->unset_userdata('vehicle_no');
			$this->session->unset_userdata('subcategory_id');
			$this->session->unset_userdata('catsubcat_id');
			$this->session->unset_userdata('timeslotList');
			$this->session->unset_userdata('time_slot');
			$this->session->unset_userdata('pickup_date');
			$this->session->unset_userdata('coupon_code'); 
			$this->session->unset_userdata('redeem_amount'); 
			$this->session->unset_userdata('flat'); 
			$this->session->unset_userdata('landmark'); 
			$this->session->unset_userdata('package_id'); 
			$this->session->unset_userdata('searchid'); 
			$this->session->unset_userdata('name'); 
			$this->session->unset_userdata('email'); 
			$this->session->unset_userdata('mobile'); 
			$this->session->unset_userdata('visit_date'); 
			$this->session->unset_userdata('visit_time');
			$this->session->unset_userdata('redeem_code');   
			$this->session->unset_userdata('longitude'); 
			$this->session->unset_userdata('latitude');
			$this->session->unset_userdata('locality');
 ?>
<div class="thankyou">
	<div class="container">
		<div class="thankyou-box">
			<img src="<?php echo asset_url();?>frontend/images/new/thankyou.png" alt="thankyou">
			<h1>Thank You</h1>
			<h2>Congratulations Your Order is booked.Our Executive will contact you soon. </h2>
			<p>Order code : #<?php echo $_SESSION['order_code']; ?></p>
		</div>
	</div>
</div>