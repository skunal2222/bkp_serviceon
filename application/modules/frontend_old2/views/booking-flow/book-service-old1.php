<link href="<?php echo asset_url();?>frontend/css/booking-flow/date-time-picker.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo asset_url();?>frontend/js/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/booking-flow/common.css">
<style type="text/css">
.select-img2 {
    margin: 16px 12px 3px 670px;
    width: 2.1rem;
    height: 2.1rem;
}
</style>

<?php 

$timeslotList = $this->session->userdata('timeslotList');

//print_r($timeslotList);exit();

?>
<div class="booking jumbotron">
	<div class="container">
		<div class="flex-box">
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>images/" alt="thankyou">
					<h2>Select Model</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box">
					<img src="<?php echo asset_url();?>images/" alt="thankyou">
					<h2>Select Package</h2>
				</div>
			</div>
			<div class="flex-1">
				<div class="select-box active">
					<img src="<?php echo asset_url();?>images/" alt="thankyou">
					<h2>Book Your Service</h2>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6 col-md-4 col-xs-12">
						<div class="package text-center">
								<img src="<?php echo asset_url().'/'. $package['image'];?>" alt="thankyou">
							<h3><?php echo $package['package_name'];?></h3>
							<h4><?php echo $package['best_price'];?></h4>
						  <!--  <?php  foreach ($package['services'] as $services): ?>
							<p><?php echo $services['servicename'];?> </p>
						    <?php endforeach; ?> -->

                          <?php  $services=$package['services'];
                            for($f=0;$f<3;$f++){
												
					             echo '<p>'.(isset($services[$f]['servicename']) ? $services[$f]['servicename'] : "No More Service") .'</p>';
					          
                           }?>
							
							<h5>You Saved Rs <?php echo $package['best_price']-$package['special_price'];?></h5>
							
							<button type="button" class="know-more-btn" onclick="quickView(<?= $package['id'];?>);">Know More+</button>
							<?php if($this->session->userdata('searchid')==!null)
							{ $url=base_url().'select-package';
							} else{
								$url=base_url().'package';
							}?>
							<!-- <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo $url ;?>';">Buy Now</button> -->
                              
							<button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo $url ;?>';">Change Package</button>
						</div>
			</div>
			<div class="col-sm-6 col-md-8 col-xs-12">
				<div class="contactus">
			       <div class="contact-form text-center">
			              <h3>Enter Address Details</h3>
			              <!-- action="<?php echo base_url();?>setdata " -->
			              <form id="general_form" class="custom-form" method="post" action="" enctype="multipart/formdata">
			              	<input type="hidden" name="userid"  value="<?= ($this->session->userdata('olouserid') ? $this->session->userdata('olouserid') :0)?>">
			              
			              	<input type="hidden" name="packageid" value="<?=$package['id'] ?>">
			              	<input type="hidden" name="best_price" value="<?=$package['best_price'] ?>">
			              	<input type="hidden" name="special_price" value="<?=$package['special_price'] ?>">  
			              	<input type="hidden" name="packagename" value="<?=$package['package_name'] ?>">
			              	<input type="hidden" name="latitude" id="latitude" value=""/>
							<input type="hidden" name="longitude" id="longitude" value=""/>
			              	
		 			<div class="row">
		 					<div class="col-sm-6">
 								<div class="input-group">
				                    <input type="text" class="form-control"  name="name" id="oname" placeholder="Name" value="<?php echo $userdata['name']; ?>">
				                </div>
								<div class="messageContainer"></div>

 							</div>
 							<div class="col-sm-6">
 								<div class="input-group">
				                    <input type="email" class="form-control" name="email" id="oemail" placeholder="Email Id" value="<?php echo $userdata['email']; ?>">
				                </div>
                                    <div class="messageContainer"></div>

 							</div>
		 			</div>
		 						<div class="row">
				 				   <div class="col-sm-6">
		 								<div class="input-group">
						                    <input type="text" class="form-control" name="mobile" id="omobile" placeholder="Phone No." value="<?php echo $userdata['mobile']; ?>">
						                </div>
		                                    <div class="messageContainer"></div>

		 							</div>
		 							<div class="col-sm-6">
		 								<div class="input-group">
						                    <input type="text" id="visit_date" name="visit_date" class="form-control"   placeholder="Select Visit Date" value="<?php echo date('d-m-Y'); ?>" >
						                </div>
		                                    <div class="messageContainer"></div>

		 							</div>
		 						</div>
		 						<div class="row">
		 							<div class="col-sm-6">
		 						<div class="input-group">
					                <div id="visit_slot">
										<select name="visit_time" id="visit_time" class="form-control frmcntrl" placeholder="Select Visit time" value="">
											<option value="">Select time slot</option>
											<?php if(!empty($timeslotList)){ 
												   foreach ($timeslotList as $key => $value) { 
												?>
												<option <?php if($value==$_SESSION['visit_time']){echo 'Selected'; }?>> <?php echo $value; ?></option>
											<?php } } ?>
										</select>
									</div>
                                    <div class="messageContainer"></div>

				                </div>
		 							</div>
		 							<div class="col-sm-6">
		 						<div class="input-group">
				                    <input type="text" class="form-control" name="flat" id="flat"
				                     placeholder="Flat No./Building" value="">
				                </div>
                                <div class="messageContainer"></div> 
		 							</div>
		 						</div>
		 				<div class="row">
		 					<div class="col-sm-12">
		 						<div class="input-group">
				                   <!--  <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Society Name & Landmark" value=""> -->
				                   <input type="text" class="form-control" name="landmark" id="landmark" onkeyup="checkLatlng(this.value)" />
				                    <a href="javascript:locateMe()"><img src="<?php echo asset_url();?>images/Locate-me.png" alt="location" class="select-img2"></a>
				                </div>
                                <div class="messageContainer"></div> 
		 				    </div>
		 				</div>
		 				<div class="row">
		 					<div class="col-sm-12">
		 						<div class="input-group">
				                    <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Zip / Postal Code" value="">
				                </div>
                                <div class="messageContainer"></div> 
		 				    </div>
		 				</div>
		 			<?php	if(!isset($_SESSION['olousermodel'])) 		 				{  ?>
		 		<div class="row">
		 					<div class="col-sm-6">
		 						<div class="input-group">
					                <div id="br">
										<select name="brand_id" id="brand_id" class="form-control frmcntrl" required="required" data-error="Please select one option.">
											<option value="">Select Brand</option>
				<?php if(!empty($brand_array)){
					$temp=" ";
	                foreach($brand_array as $rows){
	                
	                       if($temp !=$rows['brand_id'])
	                        echo "<option value='".$rows['brand_id']."'>".$rows['brand_name']."</option>";
	                    	$temp=$rows['brand_id'];
	                    
	                }  
	            }?>
										</select>
										 <div class="help-block with-errors"></div>
									</div>
                                    <div class="messageContainer"></div>

				                </div>
		 					</div>
 						<div class="col-sm-6">
 						<div class="input-group">
			                <div id="md">
								<select name="model_id" id="model_id" class="form-control frmcntrl"  required="required" data-error="Please select one option.">
									<option value="">Select Model</option>
									
								</select>

							</div>
                            <div class="messageContainer"></div>

		                </div>
 					</div>
		 		</div>

		 			<?php	} 		 				?>


		 						<!-- <div class="row">
		 							<div class="col-sm-12">
		 								<div class="input-group">
						                    <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Zip / Postal Code">
						                </div>
						                <div class="messageContainer"></div> 
		 							</div>

		 						</div> -->

		 						<!-- <div class="row">
		 							<div class="col-sm-12">
		 								<div class="input-group">
						                    <input type="text" class="form-control" name="plateno" placeholder="Car Plate Number">
						                </div>
						                 <div class="messageContainer"></div> 
		 							</div>
		 						</div> -->

		 						<div class="row">
		 							<div class="col-sm-12">
		 								<div class="input-group">
						                    <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Enter Coupon Code">
						                    <div class="input-group-btn">
						                      <button type="button" class="apply-btn" id="bookurl" onclick="checkCoupon()">APPLY</button>
						                    </div>
						                  </div>
						                  <div id="msg" style="color: red"></div>
		 							</div>
		 							<input type="hidden" name="flag" id="flag" value="0">
		 						</div>
		 					 <button type="submit" id="custom_btn" class="custom-btn1" >Service My Bike</button>
			              <!--      <button type="button" class="custom-btn1" onclick="window.location.href = '<?php echo base_url();?>booking-summary';">Service My Car</button> -->
			              </form> 
			        </div>
				</div>
			</div>
		</div>
	</div>
</div>



					<!-- know more package pop up -->
                      <!-- Modal -->
                  <!-- know more package pop up -->
                      <!-- Modal -->
                      <div id="quick_view_Popup"></div>
             
                      <!-- Modal -->  
                    <!-- know more package pop up -->

                      <!-- Modal -->  
                    <!-- know more package pop up -->

<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
//$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initMap&key=AIzaSyBbRzoO4onibXVRx8RikxKzlGE7ozneQ-s");
$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initMap&key=<?php echo $google_map_key;?>");

function initMap() {
   /*  var options = {
        componentRestrictions: { country: 'in' }
    }; */
    var options;
    var input = document.getElementById('landmark');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        $('#latitude').val(place.geometry.location.lat());
        $('#longitude').val(place.geometry.location.lng());

    });
}
//window.load(locateMe());

var delay = 5000;
setTimeout(function() { locateMe(); }, delay);

function locateMe() {
    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
    };

    function success(pos) {
        var crd = pos.coords;
        var geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(crd.latitude, crd.longitude);
        geocoder.geocode({ 'latLng': latlng }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                   /*  for (var i = 0; i < results.address_components.length; i++) {
                            for (var j = 0; j < results.address_components[i].types.length; j++) {
                                if (place.address_components[i].types[j] == "postal_code") {
                                     document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                                    $('#pincode').val(place.address_components[i].long_name);
                               }
                       		 }
                       } */
                    $("#latitude").val(crd.latitude);
                    $("#longitude").val(crd.longitude);
                    var geoaddress = results[0].formatted_address
                    $("#locality").val(geoaddress);
                    //$('#user_profile_update').bootstrapValidator('revalidateField','location');
                }
            }
        });
    };

    function error(err) {
        console.warn('ERROR(' + err.code + '): ' + err.message);
        /* var locality = $("#locality").val();
         if(locality == ''){
           //alert(err.message);
           alert("Please enter the address");
        } */
    };
    navigator.geolocation.getCurrentPosition(success, error, options);
}

</script>     
<script type="text/javascript">
	function checkLatlng(land){
 		$('#latitude').val('');
		$('#longitude').val('');
 	}

 	  $(document).ready(function(){
      var defaultDate=$("#visit_date").val();
      //alert(defaultDate);
     $.get(base_url+'delivery_dates',{ date: defaultDate },function(data){
       $("#visit_time").html(data);
          });
     //call model dropdown
       $("#brand_id").change(function() {
            var brand_id = $('#brand_id').val();
            $.post(base_url + "admin/modelbybrandid1/", {
                brand_id: brand_id
            }, function(data) {
                $('#model_id').empty();
                if (data.length > 0) {
                    $('#model_id').html("");
                    for (var i = 0; i < data.length; i++) {
                        $('#model_id').append("<option value='" + data[i].id + "'>" + data[i].name + "(" + data[i].brand_name + ")</option>");
                    }
                }
            }, 'json');
        });

  });

// $.getScript("//maps.googleapis.com/maps/api/js?v=3.exp&key=<?php echo $google_map_key;?>&libraries=places&sensor=false&callback=initMap");

// function initMap() {
// 	var options = {
// 	  	componentRestrictions: {country: 'in'}
// 	};

// 	var input =  document.getElementById('landmark');

// 	var autocomplete = new google.maps.places.Autocomplete(input,options);
// 	autocomplete.addListener('place_changed', function() {
// 		var place = autocomplete.getPlace();
// 	    if (!place.geometry) {
// 	      window.alert("Autocomplete's returned place contains no geometry");
// 	      return;
// 	    }
// 	    $('#latitude').val(place.geometry.location.lat());
// 	    $('#longitude').val(place.geometry.location.lng());
// 	});
// }
	function checkCoupon() { 
	  if($("#coupon_code").val() == "") {
	    swal('',"Please enter a coupon code.",'error');
	  }else if($("#visit_date").val() == ""){
	    swal('',"Please select Date.",'error');
	  }else { 
	    $.post("<?php echo base_url();?>applycpoupon",{coupon_code: $("#coupon_code").val(),visit_date:$("#visit_date").val() },function(data){ 
	              if(data.status == 1){
	             $("#msg").html(data.msg);
	             $("#flag").val(data.status);
	             }else{
	             $("#msg").html(data.msg);
	             $("#coupon_code").val('');
	            } 
	     },'json');
	  }
	}
	//function quickview
    function quickView(id){ 
     $.post(base_url+"quickView", {id : id}, function(data){
          $('#quick_view_Popup').html(data); 
             $("#package_modal").modal('show');
          },'html');

    }
var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$.fn.datepicker.defaults.startDate = today; 

onclick="window.location.href = '<?php echo base_url();?>booking-summary';"



$('#visit_date').datepicker({
	 autoclose: true
 }).on('changeDate', function(e){
	  $.get(base_url+'delivery_dates',{date:$(this).val()},function(data){
		   $("#visit_time").html(data);
		      });
 }); 

$('#general_form').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('div.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    		'mobile': {
            validators: {
            	notEmpty: {
                    message: 'Phone no is required'
                },
                regexp: {
                    regexp: '^[7-9][0-9]{9}$',
                    message: 'Invalid Mobile Number'
                }
            }
        },
        'name': {
            validators: {
                notEmpty: {
                    message: 'Name is required '
                }
            }
        },
        'email': {
            validators: {
            	notEmpty: {
                    message: 'Email id is required '
                },
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'The value is not a valid email address'
                }
            }
        },
        'visit_date': {
            validators: {
            	notEmpty: {
                    message: 'Visit date is required '
                } 
            }
        }, 
         'visit_time': {
            validators: {
            	notEmpty: {
                    message: 'Visit slot is required '
                } 
            }
        }, 
         'flat': {
            validators: {
            	notEmpty: {
                    message: 'Flat no/Building is required '
                } 
            }
        }, 
        'landmark': {
            validators: {
            	notEmpty: {
                    message: 'Landmark is required '
                } 
            }
         },
         'pincode': {
            validators: {
            	notEmpty: {
                    message: 'Pincode is required '
                },
                 regexp: {
                    regexp: '^([0-9]){6}$',
                    message: 'Enter valid pincode.'
                } 
            }
        },
        'plateno':  {
            validators: {
            	notEmpty: {
                    message: 'Number Plate is required '
                } 
            }
        } 
    }
}).on('success.form.bv', function(event,data) {
	 //Prevent form submission
	event.preventDefault();
	var flag=$('[name="flag"]').val();
    if(parseInt(flag)==0)
    $("#coupon_code").val('');
    
    	addBooking();
    
   // checklogin();
	
});
function checklogin(){
    var userid=$('[name="userid"]').val();
    if(parseInt(userid)==0)
    {   
      //swal('','please login','error');
       $("#myLoginModal").modal('show');
    }else{
    	addBooking();
    }


}

function addBooking() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'setdata',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#general_form').ajaxSubmit(options);
}

function showAddRequest(formData, jqForm, options){
	$("#response").hide();
	//ajaxindicatorstart("Please hang on.. while we add order ..");
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	ajaxindicatorstop();
	if(resp.status == '0') {
		  $("#bookurl").attr('disabled',false);
		
		  swal(resp.msg +"!");
		
  	} else { 
         window.location.href = base_url+'booking-summary';
  	}
} 
</script>

<script>
$('#sandbox-container input').datepicker({
    autoclose: true
});

$('#sandbox-container input').on('show', function(e){
    console.debug('show', e.date, $(this).data('stickyDate'));
    
    if ( e.date ) {
         $(this).data('stickyDate', e.date);
    }
    else {
         $(this).data('stickyDate', null);
    }
});

$('#sandbox-container input').on('hide', function(e){
    console.debug('hide', e.date, $(this).data('stickyDate'));
    var stickyDate = $(this).data('stickyDate');
    
    if ( !e.date && stickyDate ) {
        console.debug('restore stickyDate', stickyDate);
        $(this).datepicker('setDate', stickyDate);
        $(this).data('stickyDate', null);
    }
});
</script>   
            