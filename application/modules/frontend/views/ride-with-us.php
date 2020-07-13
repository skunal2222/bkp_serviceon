<style type="text/css">
	.input-group{
		width: 100%!important;
	}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>frontend/css/ridewithus-responsive.css">
<section id="ride-with-us" style="margin-top: 10rem;">
	<div class="ride-with-us-section">
		<div class="row">	
			<div class="col-md-12">
				<div class="jumbotron row ride-withus-jumbo">	
					<div class="col-lg-3 col-md-3 col-sm-12 text-left ridewithus-right-img">
						<img src="<?php echo asset_url(); ?>frontend/images/ridewithus-right-img.png">	
					</div>

					<div class="col-lg-6 col-md-6 col-sm-12 ridewithus-middle-content">
						<div class="ride-withus-content text-center pt-5">
							<h2 class="ride-withus-title">Ride With Us</h2>
							<p class="ride-withus-content">Become a part of our team!</p>
							<div class="register-btn">
								<a href="javascript:void(0)" id="gotoform" class="btn">Register</a>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-12 text-right ridewithus-left-img">
						<img src="<?php echo asset_url(); ?>frontend/images/ridewithus-left-img.png">	
					</div>
				</div>	
			</div>	
		</div>

		<div class="ridewithus-lnfo">
			<div class="row">
				<div class="col-md-12 ridewithus-lnfo-section">
					<h4 class="ridewithus-lnfo-title">How it works?</h4>
					<p class="ridewithus-lnfo-content">Being a rider and member of Serviceon family......it's our pleasure to describe how we work together.<br>
						1. Download Serviceon rider app from play store (link should be given)<br>
						2. Login with your credentials<br>
						3. Accept the order<br>
						4. Enjoy riding with us
					</p>
				</div>

				<div class="col-md-12 ridewithus-lnfo-section">
					<h4 class="ridewithus-lnfo-title pt-4">Benefits</h4>
					<p class="ridewithus-lnfo-content">
						1. Earn handsome money by accepting more order<br>
						2. Employee referral benefits<br>
						3. Incentives<br>
						4. Rewards<br>
						5. Accidental Insurance
					</p>
				</div>
			</div>
		</div>


		<div class="register-section">
			<div class="row">
				<div class="col-md-12 d-flex justify-content-center">
					<div class="card register-section-card" >
						<div class="card-body">
							<h5 class="register-section-title text-center">Apply Now</h5>
							<form id="register-section-form" method="post" action="<?= base_url('save_ride_with_us')?>">
								
								<div class="form-group" id="error-name">
									<div class="input-group">
										<label for="" class="sr-only">Name</label>
										<input type="text" class="form-control" placeholder="Name" name="name">
									</div>
									<div class="messageContainer col-sm-10"></div>
								</div>

								<div class="form-group" id="error-name">
									<div class="input-group">
										<label for="" class="sr-only">Phone</label>
										<input type="text" class="form-control" placeholder="Phone" name="phone">
									</div>
									<div class="messageContainer col-sm-10"></div>
								</div>

								<div class="form-group" id="error-name">
									<div class="input-group">
										<label for="" class="sr-only">City</label>
										<input type="text" class="form-control" placeholder="City" name="city">
									</div>
									<div class="messageContainer col-sm-10"></div>
								</div>

								<div class="form-group" id="error-name">
									<div class="input-group">
										<label for="" class="sr-only">Vehicle</label>
										<input type="text" class="form-control" placeholder="MH 01 AA 1234" name="vehicle">
									</div>
									<div class="messageContainer col-sm-10"></div>
								</div>

								<div class="text-center register-submit-btn">
									<button type="submit" class="btn">Submit</button>	
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$('#gotoform').click(function(){
		  window.scrollTo(0, 1000);
	});

	$('#register-section-form').bootstrapValidator({
    container: function ($field, validator) {
      return $field.parent().next('.messageContainer');
    },

    feedbackIcons: {
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      'name': {
        validators: {
          notEmpty: {
            message: 'Name is required and cannot be empty'
          },
        }
      },
      'phone': {
        validators: {
          notEmpty: {
            message: 'Phone is required and cannot be empty'
          },
          regexp: {
            regexp: '^[7-9][0-9]{9}$',
            message: 'Please enter valid phone number.'
          }
        }
      },
      'vehicle': {
        validators: {
          notEmpty: {
            message: 'Vehicle is required and cannot be empty'
          },
          regexp: {
            regexp: '^[A-Z]{2}[ -][0-9]{1,2}(?: [A-Z])?(?: [A-Z]*)? [0-9]{4}$',
            message: 'Please enter valid vehicle number.'
          }

        }
      },
      'city': {
        validators: {
          notEmpty: {
            message: 'City is required and cannot be empty'
          }
        }
      },
      
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
           location.reload();
        }
      }
    });

    return false;
  });
</script>