<style type="text/css">
	@media (min-width: 992px){}
	.modal-lg {
	    max-width: 1260px;
	}}
</style>

<script src="https://cdn.jsdelivr.net/npm/js-base64@2.5.2/base64.min.js"></script>

<section id="confirmation" class="pb-5">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-12 credential">
			 <div class="account-info">
			 	<div class="jumbotron">
			 		<h2 class="user-account-info confirm-title">Account Info</h2>
			 		<p class="logg-in confirm-content">You are logged in as <?= (isset($userInfo[0]['name']) || isset($userInfo[0]['lname']))?ucfirst($userInfo[0]['name'])." ".ucfirst($userInfo[0]['lname']):"Guest"; ?> | <?= (isset($userInfo[0]['mobile']))?$userInfo[0]['mobile']:""; ?></p>
			 		<!-- <a href="#" class="change-user">Change User</a> -->
			 	</div>
			 </div>

			<div class="account-info">
			 	<div class="jumbotron">
			 		<h2 class="user-account-info confirm-title">Handling Charge</h2>
			 		<p class="logg-in confirm-content">Service Type : <?= $stData['serviceType']; ?></p>
			 		<p class="logg-in confirm-content">Charges Applied : <?= "Rs". $stData['price']; "/-" ?></p>
			 		<p class="logg-in confirm-content">Payment Mode : 
			 		<label><input type="radio" class="pmd" name="paymode" value="1"> Cash on Delivery</label>
			 		&emsp;&emsp;
			 		<label><input type="radio" class="pmd" name="paymode" value="2"> Online</label>
			 		</p>
			 		<!-- <a href="#" class="change-user">Change User</a> -->
			 	</div>
			</div>

			 <div class="date-time">
			 	<div class="jumbotron">
			 		<h2 class="user-account-info confirm-title">Date & Time</h2>
			 		<p class="logg-in confirm-content">
			 			<?php 
				 			date_default_timezone_set('asia/kolkata');
				 			$printdate = date('d-M-Y');
							$slotdate = date('Y-m-d');
					 		if($slotdate == date('Y-m-d')) {
					 			$current_time = date('H:i');
					 			$i = 0;
								foreach ($visitingslots as $slot) {
									$i++;
									$slot_arr = explode('-',$slot['time_slot']);
									$from_time = date('H:i',strtotime($slot_arr[0]));
									$to_time = date('H:i',strtotime($slot_arr[1]));
									$slottime = "";
									if($current_time < $from_time) {
										$slottime = $slot['time_slot'];
										break;
									}

									if(sizeof($visitingslots)-1 == $i && $slottime=="") {
										$printdate = date("d-M-Y", strtotime('+24 hours'));
										$slotdate = date('Y-m-d', strtotime('+24 hours'));
										$slottime = $slot['time_slot'];
										break;
									}
								}
							}
			 			?>
			 			<span id="setdate">
			 				<?php echo $_SESSION['slotdate'] = $printdate; ?>
			 			</span> | 
			 			<span id="settime">
			 				<?php echo $_SESSION['slottime'] = $slottime ?>
			 			</span>
			 			</p>
			 		<a href="#" onclick="return trigger_modal(2);" class="change-user">Change</a>
			 	</div>
			 </div>

			 <div class="user-address" style="margin-left: 0rem;">
			 	<div class="jumbotron">
			 		<h2 class="user-account-info confirm-title">Address</h2>
			 		<!-- <p class="logg-in confirm-content">Flat 22, Niyoshipark 2, Opposite Puma Showroom, Aundh, Pune</p> -->
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
			 		<p class="logg-in confirm-content" id="setaddress"><?= ucwords($address); ?></p>
			 		<a href="#" onclick="return trigger_modal(3);" class="change-user">Change Address</a>
			 	</div>
			 </div>

			 <div class="user-address" style="margin-left: 0rem;">
			 	<div class="jumbotron">
			 		<h2 class="user-account-info confirm-title">Vehicle</h2>
			 		<?php
			 			$vehicle = "";
			 			$vehicle_id = false;
			 			if (!empty($userVehicle)) {
			 				foreach ($userVehicle as $data) {
		 						if ($data['is_primary_vehicle'] == 1) {
		 							$vehicle_id = $data['id'];
		 							$vehicle = $data['vehicle_no']."(Brand:".$data['brandname'].", Model:". $data['modelname'].")";
		 							break;
		 						}
		 					}

			 				/*if (empty($vehicle)) {	
				 				$last_id = sizeof($userVehicle)-1;
				 				$vehicle_id = $userVehicle[$last_id]['id'];
				 				$vehicle = $userVehicle[$last_id]['vehicle_no']."(Brand:".$userVehicle[$last_id]['brandname'].", Model:". $userVehicle[$last_id]['modelname'].")";
			 				}*/
			 			}
			 		?>
			 		<p class="logg-in confirm-content" id="setvehicle"><?= ucwords($vehicle); ?></p>
			 		<a href="#" onclick="return trigger_modal(4);" class="change-user">Change Vehicle</a>
			 	</div>
			 </div>

			<div class="current-offers">
			 	<div class="jumbotron">
			 		<h2 class="user-account-info confirm-title">Offer</h2>
			 		<form action="<?= base_url('cpn/validate_coupon_code')?>" method="post" id="ccode_apply">
						<div class="input-group form-group">
						  	<input type="text" name="ccode" id="ccode" class="form-control" placeholder="enter coupon code" aria-label="Recipient's username" aria-describedby="basic-addon2">
						  	<div class="input-group-append" required>
						    	<button type="submit" >Apply</button>
						  	</div>
						</div>
						<div>
							<input type="hidden" name="garage_id" value="<?= $vendor_id ?>">
						</div>
					</form>
			 	</div>
			 </div>
		</div>

		<div class="col-lg-4 col-sm-4 col-12 booking-summary d-flex justify-content-center">
			<div class="card" style="width: 24rem";>
				<div class="booking-summary-card d-flex align-items-center mb-1">
  					<h5 class="pl-3 booking-card-title align-items-center">Summary</h5>
  				</div>
				<div class="all-booking-summary pt-4 align-items-center">
					<form>
						<input type="hidden" id="vendor_id" name="vendor_id" value="<?= $vendor_id ?>">
						<input type="hidden" id="user_id" name="user_id" value="<?= (isset($_SESSION['olouserid']))?$_SESSION['olouserid']:'' ?>">
						<input type="hidden" id="order_slotdate" name="order_slotdate" value="<?= $slotdate ?>">
						<input type="hidden" id="order_slottime" name="order_slottime" value="<?= $slottime ?>">
						<input type="hidden" id="order_address" name="order_address" value="<?= $address_id ?>">
						<input type="hidden" id="order_vehicle" name="order_vehicle" value="<?= $vehicle_id ?>">
						<input type="hidden" id="hidden_ccode" name="hidden_ccode">
						<?php foreach ($categories as $cats) { ?>
							<div class=" d-flex justify-content-around align-items-center">
								<h5 class=""><?= $cats['name'] ?></h5>
								<a href="#" class="delete_cats" data-id="<?= $cats['id'] ?>"><i class="fas fa-times"></i></a>
							</div>
						<?php } ?>
						<div class="summary-confirm-btn pt-5">
							<button type="button" onclick="return confirm_order();">Confirm</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>	
</section>

<div class="modal" tabindex="-1" role="dialog" id="md-login">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body" id="login_modal">

      </div>
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="md-modalpages">
  <div class="modal-dialog modal-lg" id="md_lg_spcl" role="document"><br><br><br>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="md-title"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_views">

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function () {

/*	<?php if (!empty($_SESSION['filterbrand']) || !empty($_SESSION['filtermodel'])) { ?>
		trigger_modal(4);
	<?php } ?>*/

	var optionlogin = {
		'show' : true,
		'backdrop' : 'static',
		'keyboard' : false
	}

	<?php if(empty($_SESSION['olouserid'])){
		$_SESSION['referrer_url'] = current_url();
	?>
		$.post(base_url + 'get_login_view', {}, function (data) {
			$("#login_modal").empty();
			$("#login_modal").html(data.view);
			$("#md-login").modal(optionlogin);
		}, "json");
	<?php } else {
		if ($address_id === false) { ?>
			// alert("Please add address");
			return false;
		<?php }	?>
	<?php } ?>
});


function trigger_modal(view, coupon="") {
	if(view==5){
		var str = Base64.encode(coupon);
		url = Base64EncodeUrl(str);
		window.location = base_url+"order_summary/"+url;
	}else{
		$.post(base_url + 'getModalViews', {view:view}, function (data) {
			$("#modal_views").empty();
			$("#md-title").html(data.modaltitle);
			$("#modal_views").html(data.modalbody);
			$("#md-modalpages").modal('show');
		}, "json");
	}
}

function Base64EncodeUrl(str){
    return str.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
}

$(document).on("click", ".delete_cats", function(){
	$(this).closest('div').remove();
	// alert($(this).data('id'));
	var catid = $(this).data('id');
	if (catid != "") {
		$.post(base_url + 'deleteSelectedServiceGroup', {catid:catid}, function (data) {
			if (data.length == 0) {
				alert('Please select at least one category');
				location.href = "<?= $back_url ?>";
			}
		}, "json");
	} else {
		alert('Service group id not found!');
	}
});

$(document).on("click", ".pmd", function(){
	var pm = $(this).val();
	$.post(base_url + 'savepaymd', {pm:pm}, function (data) {
		if (data.status == 0) {
			alert("Error, Something went wrong.");
		}
	}, "json");
});

function confirm_order() {
		var is_slotdate = $("#order_slotdate").val();
		var is_slottime = $("#order_slottime").val();
		var is_address = $("#order_address").val();
		var is_vehicle = $("#order_vehicle").val();
		var is_paymode = $("input[name='paymode']:checked").val();

		var hidden_ccode_val = $("#hidden_ccode").val();

		if (is_paymode === undefined) {
			alert("Please Choose Payment mode");
			return false;
		}

		if (is_slotdate == '' || is_slottime == '') {
			alert("Please Select Pickup Slot");
			return false;
		}

		if (is_address == '') {
			alert("Please Add Pickup Address");
			return false;
		}

		if (is_vehicle == '') {
			alert("Please Select Vehicle");
			return false;
		}

		trigger_modal(5, hidden_ccode_val);

		//location.href = base_url + "confirmation";
	}
</script>

<script>
    $(document).ready(function(){
        // login_check
        $('#ccode_apply').bootstrapValidator({
           message: 'This value is not valid',
           feedbackIcons: {},
           fields: {
            ccode: {
                validators: {
                    notEmpty: {
                        message: 'The coupon code is required and cannot be empty'
                    }
                }
            }
            
        }
    }).on('success.form.bv', function (event, data) {
            // Prevent form submission
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
                    var userCode = $('#ccode').val();

                    if(data.status == '1'){
                    	$('#hidden_ccode').attr('value', userCode);
                    	alert(data.message);
                    }else if(data.err_status=="1"){
                    	$('#hidden_ccode').attr('value', userCode);
                    	alert(data.message);
                    }
                }
            });

            return false;
        });

});
</script>