<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/booking-flow/common.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/booking-flow/selectize.bootstrap3.css">
<script type="text/javascript" src="<?php echo asset_url();?>js/selectize.min.js"></script>
<div class="booking jumbotron">
	<div class="container">
		<div class="flex-box">
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>images/" alt="thankyou">
					<h2>Select Brand</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>images/" alt="thankyou">
					<h2>Select Modal</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>images/" alt="thankyou">
					<h2>Select Subcategory</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>images/" alt="thankyou">
					<h2>Select Service or Packages</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box  active">
					<img src="<?php echo asset_url();?>images/" alt="thankyou">
					<h2>Select Address</h2>
				</div>
			</div>
		</div>
		<div class="contactus">
	       <div class="contact-form con text-center">
	              <h3>Enter Address Details</h3>
	               <form class="custom-form">
 						<div class="row">
 							<div class="col-sm-6">
 								<div class="input-group">
				                    <input type="text" class="form-control" name="" placeholder="Name">
				                </div>
 							</div>
 							<div class="col-sm-6">
 								<div class="input-group">
				                    <input type="email" class="form-control" name="" placeholder="Email Id">
				                </div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-6">
 								<div class="input-group">
				                    <input type="text" class="form-control" name="" placeholder="Phone No.">
				                </div>
 							</div>
 							<div class="col-sm-6">
 								<div class="input-group">
				                    <input type="text" class="form-control" name="" placeholder="Select Visit Date">
				                </div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-6">
 								<div class="input-group">
				                    <input type="text" class="form-control" name="" placeholder="Select Time">
				                </div>
 							</div>
 							<div class="col-sm-6">
 								<div class="input-group">
				                    <input type="text" class="form-control" name="" placeholder="Flat No./Building">
				                </div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-12">
 								<div class="input-group">
				                    <input type="text" class="form-control" name="" placeholder="Society Name & Landmark">
				                </div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-md-4">
 							</div>
 							<div class="col-md-4 col-sm-6 text-right">
 								<button type="button" class="add-address">+ Add Address</button>
 							</div>
 							<div class="col-md-4 col-sm-6 text-right">
 								<button type="button" class="add-address select-btn">Select Address</button>
 							</div>
 						</div>
 						<div class="select-address">
 							<div class="row">
	 							<div class="col-md-4 col-sm-6 col-xs-6 text-left">
	 								<input type="radio" name="address" value="home1" checked> Home 1<br>
	 							</div>
	 							<div class="col-md-4 col-sm-6 col-xs-6 text-left">
	 								<input type="radio" name="address" value="home2"> Home 2<br>
	 							</div>
	 							<div class="col-md-4 col-sm-6 col-xs-6 text-left">
	 								<input type="radio" name="address" value="office" checked> Office<br>
	 							</div>
	 						</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-12">
 								<div class="input-group">
				                    <input type="text" class="form-control" name="" placeholder="Selected Package">
				                </div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-6">
 								<div class="input-group">
				                    <input type="text" class="form-control" name="" placeholder="Vehicle Details">
				                </div>
 							</div>
 							<div class="col-sm-6">
 								<div class="input-group">
				                    <input type="text" class="form-control" name="" placeholder="Vehicle no.">
				                </div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-12">
 								<div class="input-group">
				                 <select name="service_id" class="form-control custom-add" id="service_id">
							         <option value="">Service Selected</option>
							         <option value="kothrud">kothrud</option>
							         <option value="aundh">aundh</option>
							         <option value="pashan">pashan</option>
							      </select>
							    </div>
 							</div>
 						</div>
 						<div class="row">
 							<div class="col-sm-12">
 								<div class="input-group custom-file-input">
				                    <input type="file" class="form-control" name="" placeholder="Upload Images">
				                    <input type="text" class="form-control" name="" placeholder="Upload Images">
									<button type="button" class="select-file">
										<img src="<?php echo asset_url();?>images/upload.png"/>
									</button> 
				                </div>
 							</div>
 						</div>
	                   <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>Booking-summary';">Submit</button>
	              </form> 
	        </div>
		</div>
	</div>
</div>

<!-- select-service -->
  <script>
       $("#service_id").selectize({});
  </script>
<!-- select-service -->

<script type="text/javascript">
    $(document).ready(function(){
        $('.custom-file-input input[type="file"]').change(function(e){
            $(this).siblings('input[type="text"]').val(e.target.files[0].name);
        });
    });

    $(".select-btn").click(function(){
	 $(".select-address").show();
	})
</script>