 
<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>frontend/css/booking-flow/common.css">
<link href="<?php echo asset_url();?>css/datepicker3.css" rel="stylesheet">
<style type="text/css">
    .apply-btn {
    font-size: 18px;
    font-weight: 600;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    background: transparent;
    border: none;
    letter-spacing: normal;
    text-align: left;
    color: #000000; 
}
</style>

<?php  
 
$timeslotList = $this->session->userdata('timeslotList');  
 
?>

<div class="booking jumbotron">
	<div class="container">
	    <div class="flex-box">
            <div class="flex-1">
                <div class="select-box active">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/subcategoryname1w.png" alt="thankyou">
                    <h2><a href="<?= base_url()?>select-subcategory">Select Subcategory</a></h2>
                </div>
                <div class="">
                    <?php if(!empty($_SESSION['subcategory_id']) ){

                        if ($_SESSION['subcategory_id']== 11) { ?>
                          
                             <h4 class="text-center">Breakdown </h4>
                      <?php } elseif ($_SESSION['subcategory_id']== 12) { ?>
                        
                         <h4 class="text-center">Pick-Up & Drop</h4>
                    <?php  }  elseif ($_SESSION['subcategory_id']== 13) { ?>
                             <h4 class="text-center">Doorstep</h4>

                    <?php }  ?>
                   
                    <?php }  ?>
                </div>
            </div>
            <div class="flex-1">
                <div class="select-box active">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/modelselectbrandw.png" alt="thankyou">
                    <h2><a href="<?= base_url()?>select-vehicle">Select Vehicle</a></h2>
                </div>
                <div class="">
                    <h4 class="text-center"><?php echo $vehicle_number ; ?></h4>
                </div>
            </div>
            <div class="flex-1">
                <div class="select-box active">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/servicesandpackagesselectbrandw.png" alt="thankyou">
                    <h2><a href="<?= base_url()?>select-package">Select Service or Packages</a></h2>
                </div>
                <!-- <div class="">
                    <h4 class="text-center">Selected Services/Packages</h4>
                </div> -->
            </div>
            <div class="flex-1">
                <div class="select-box active">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/address-selectbrandw.png" alt="thankyou">
                    <h2>Select Address</h2>
                </div>
            </div>
        </div>

        <div class="row">
        <div class="col-sm-4 col-sm-offset-1"> 

        <?php  if((!empty($package)) AND (!empty($catsubcat))) {?>
           
            <div class="contact-form">
                <h3>You have Selected Package </h3>
                <!-- <img src="<?php echo asset_url().'/'. $package[0]['image'];?>" height="80px" width="80px" alt="thankyou"> -->
                <h2 style="text-align: center;"><?php echo $package[0]['package_name'];?></h2>
                <h4>Actual Price : Rs   <strike><?php echo $package[0]['best_price'];?></strike>  &nbsp;
                    Offer Price Rs <?php echo $package[0]['special_price'];?></h4>
              <!--  <?php  foreach ($package['services'] as $services): ?>
                <p><?php echo $services['servicename'];?> </p>
                <?php endforeach; ?> -->

             <!--  <?php  $services=$package[0]['services'];
                for($f=0;$f<3;$f++){
                                    
                     echo '<p>'.(isset($services[$f]['name']) ? $services[$f]['name'] : "No More Service") .'</p>';
                  
               }?> -->

                <div class="row">
                        <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody>
                        <?php $i=1;  
                         foreach ($package[0]['services'] as $services) { ?>
                                <tr>
                                    <td><?php echo $i ?></td>

                                    <td><?php echo $services['name'] ?></td>  

                               </tr>
                        <?php $i++; } ?>  
                          </tbody>
                        </table>
                      </div>
                </div>  
                  
            </div> 
            <br>
            <div class="contact-form">
                    <h3>You have Selected Extra Services </h3>  

                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody>
                        <?php $i=1;  
                         foreach ($catsubcat as $services) { ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                   <!--  <td><?php echo $value['servicename'] ?></td>  -->
                                    <td> 
                                    <?php echo $services['name'];?> 
                                     
                                    </td> 
                               </tr>
                        <?php $i++; } ?>  
                          </tbody>
                        </table>
                      </div>
                    </div>  
                </div> 

        <?php } else if(!empty($package)) { ?> 
                 
               <div class="contact-form">
                <h3>You have Selected Package </h3>
                <!-- <img src="<?php echo asset_url().'/'. $package[0]['image'];?>" height="80px" width="80px" alt="thankyou"> -->
                <h2 style="text-align: center;"><?php echo $package[0]['package_name'];?></h2>
                <h4>Actual Price : Rs   <strike><?php echo $package[0]['best_price'];?></strike>  &nbsp;
                    Offer Price Rs <?php echo $package[0]['special_price'];?></h4>
              <!--  <?php  foreach ($package['services'] as $services): ?>
                <p><?php echo $services['servicename'];?> </p>
                <?php endforeach; ?> -->

             <!--  <?php  $services=$package[0]['services'];
                for($f=0;$f<3;$f++){
                                    
                     echo '<p>'.(isset($services[$f]['name']) ? $services[$f]['name'] : "No More Service") .'</p>';
                  
               }?> -->

                <div class="row">
                        <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody>
                        <?php $i=1;  
                         foreach ($package[0]['services'] as $services) { ?>
                                <tr>
                                    <td><?php echo $i ?></td>

                                    <td><?php echo $services['name'] ?></td>  

                               </tr>
                        <?php $i++; } ?>  
                          </tbody>
                        </table>
                      </div>
                </div>   
            </div>  

             <?php } else { ?>

               <?php if(!empty($catsubcat)) { ?>
                <div class="contact-form">
                    <h3>You have Selected Services List </h3>  

                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-hover">
                            <tbody>
                        <?php $i=1;  
                         foreach ($catsubcat as $services) { ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                   <!--  <td><?php echo $value['servicename'] ?></td>  -->
                                    <td> 
                                    <?php echo $services['name'];?> 
                                     
                                    </td> 
                               </tr>
                        <?php $i++; } ?>  
                          </tbody>
                        </table>
                      </div>
                    </div>  
                </div>

          <?php  }

           }  ?> 

        </div> 

        <div class="col-sm-6">
    		<div class="contactus">
    	       <div class="contact-form text-center">
    	              <h3>Enter Address Details</h3>
    	               <form id="general_form" class="custom-form" method="post" action="" enctype="multipart/formdata">
     						<div class="row"> 
                                
                        <input type="hidden" name="latitude" id="latitude" value="<?php if(isset($_SESSION['latitude'])) echo $_SESSION['latitude'];?>"/>
                                <input type="hidden" name="longitude" id="longitude" value="<?php if(isset($_SESSION['longitude'])) echo $_SESSION['longitude'];?>"/>
                                
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
    				                    <input type="text" id="visit_date" name="visit_date" class="form-control"  value="<?php echo date('Y-m-d');?>" placeholder="Select Visit Date" >
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
                                        <input type="text" class="form-control" name="service_type" placeholder="Type of service" value="<?php echo $service_type ; ?>" readonly>
                                      </div> 
                                </div>  
                                 <div class="col-sm-6">
                                     <div class="input-group">
                                        <input type="text" class="form-control" name="vehicle_number" placeholder="Vehicle Number" value="<?php echo $vehicle_number ; ?>" readonly>
                                      </div>
                                </div>  

                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="flat" id="flat"
                                         placeholder="Flat No./Building" value="<?php echo $_SESSION['flat']; ?>">
                                    </div>
                                    <div class="messageContainer"></div> 
                                </div>
     						</div>
     						<div class="row"> 
     							<div class="col-sm-12">
     								<div class="input-group">
    				                    <input type="text" class="form-control" name="landmark" id="landmark" onkeyup="checkLatlng(this.value)" placeholder="Location" value="<?php echo $_SESSION['locality'] ; ?>">
    				                </div>
                                    <div class="messageContainer"></div>  
     							</div>        
     						</div> 
                <div class="row"> 
                            <div class="col-sm-6 text-left">
                                <label>Upload Image</label>
                                <!-- <input type="file" name="image" id="image" class="form-control " data-bv-field="image">  -->
                                <input type="file" id="image" name="image[]" class="form-control" multiple="true" data-bv-field="image[]">
                            </div>
                </div>            
                <div class="row">
                    <p class="form-control">
                        <input type="radio" class="offer" name="offer" value="1" id="offer1">Apply Coupon
                    </p>
                    <p class="form-control">
                       <input type="radio" class="offer" name="offer" value="2" id="offer2">Redeem From Wallet 
                    </p>
                </div>  	
                 <div class="promocode coupon-div" style="display: none;">
                        <h5>Have a promocode?</h5>
                        <div class="">
                            <div class="input-group"> 
                                <input type="text" class="form-control" placeholder="Enter your coupon here" name="coupon_code" id="coupon_code" > 
                                <div class="input-group-btn"> 
                                        <button class="apply-btn" type="button" onclick="checkCoupon();">Apply</button>  
                                </div>
                            </div>
                            <div class="" id="coupon_response"></div>
                        </div>
                </div>
                    <!--Have a promocode? -->
                    <!--Want to redeem points? -->
                 <div class="promocode redeem-div" style="display: none;">
                        <h5>Want to redeem points?</h5>
                          <span class='text-danger' id="points"></span> 
                          <span class='text-danger' id="nopoints"></span>
                        <div class="">
                            <div class="input-group">
                                <input type="text" onkeypress="return isNumber(event)" class="form-control" placeholder="Enter your points" name="redeem_code" id="redeem_code" >
                                <div class="input-group-btn">  
                                            <button class="apply-btn" type="button" onclick="applyRedeem();">Redeem</button>  
                                </div>
                            </div>
                            <div class="" id="redeem_response"></div>
                        </div>
                    </div>
                    <?php if(!empty($package)){?>
                    <div class="row">
                        <div class="contact-form">
                             <h3>You have Selected Package </h3> 
                             <h2 style="text-align: center;"><?php echo $package[0]['package_name'];?></h2>
                              <h4>Price Rs <?php echo $package[0]['special_price'];?></h4>  
                              <p>
                              <input type="radio" id="paymethod" name="paymethod" value="1" checked>Pay Now
                              <input type="radio" id="paymethod" name="paymethod" value="0">Pay Later &nbsp;
                              
                              </p> 
                        </div> 
                    </div>
                    <?php }?>
    	                   <button type="submit" id="custom_btn"  class="custom-btn1" >Submit</button> 
    	              </form> 
    	        </div>
    		</div>
     </div>
  </div>   

</div>
</div>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$.fn.datepicker.defaults.startDate = today; 

onclick="window.location.href = '<?php echo base_url();?>Booking-summary';"

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

      var user_id= '<?php echo $_SESSION['olouserid'];?>';
                        
      //alert(user_id);

     $.get(base_url+'getredeempoints',{ user_id: user_id },function(data){
 
        console.log(data);
            if(data.status == 1){ 
                 $('#points').show();  
                 document.getElementById("points").innerHTML = "You have Rs. " + data.msg +  " points in your wallet.";
                 $('#nopoints').hide();
            }
            else if(data.status == 0)
            {
                $('#nopoints').show();  
                document.getElementById("nopoints").innerHTML = "Your Wallet " + data.msg + "";
                 $('#points').hide();
            }
            
          },'json');


  });


$('#visit_date').datepicker({
	 autoclose: true
 }).on('changeDate', function(e){
	  $.get(base_url+'delivery_dates',{date:$(this).val()},function(data){
		   $("#visit_time").html(data);
		      });
 }); 


$.getScript("//maps.googleapis.com/maps/api/js?v=3.exp&key=<?php echo $google_map_key;?>&libraries=places&sensor=false&callback=initMap");

function initMap() {
    var options = {
        componentRestrictions: {country: 'in'}
    };

    var input =  document.getElementById('landmark');

    var autocomplete = new google.maps.places.Autocomplete(input,options);
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
        } 
    }
}).on('success.form.bv', function(event,data) {
	 //Prevent form submission
	event.preventDefault();
	saveOrder();
});

function saveOrder() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'booking/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#general_form').ajaxSubmit(options);
}

function showAddRequest(formData, jqForm, options){
	$("#response").hide();
	ajaxindicatorstart("Please hang on.. while we add order ..");
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	//ajaxindicatorstop();
   if (resp.status == '0') {
    ajaxindicatorstop();
        swal('',resp.msg,'error');
    }
	 else if(resp.status == 1){
    ajaxindicatorstop();
    if(resp.url)
    {
        window.location.href = resp.url;
        return false;
    }
    //swal('',resp.msg,'success');  
    setTimeout(function() {
    window.location.href = base_url+'thank-you'; 
    }, 3000); 
  }else{
    ajaxindicatorstop();
    
    swal('',resp.msg,'error'); 
    setTimeout(function() {
    window.location.href = base_url+'booking-failed'; 
    }, 6000); 
}
}

 

function checkCoupon() { 

  var package_id = '<?php echo $_SESSION['package_id']; ?>';

  if($("#coupon_code").val() == "") {
    swal('',"Please enter a coupon code.",'error');
  }  
  else if($("#visit_date").val() == "")
  {
    swal('',"Please select a visit date.",'error');
    return false;
  }
  else { 
    $.post("<?php echo base_url();?>applycpoupon",{coupon_code: $("#coupon_code").val(),visit_date:$("#visit_date").val() },function(data){ 
              if(data.status == 1){
               $("#offer2").prop('disabled', true);   
              swal('',data.msg,'success')
             }else{
              swal('',data.msg,'error')
              $("#coupon_code").val('');
            } 
     },'json');
  }
} 



$(".offer").change(function () {
        var radioValue = $("input[name='offer']:checked").val();
        if (radioValue == 1) {
            $('.coupon-div').show();
            $('.redeem-div').hide();
        }else if(radioValue == 2) {
            $('.coupon-div').hide();
            $('.redeem-div').show();
        }
    }); 


$(".paymethod").change(function () {
        var radioValue = $("input[name='pay-method']:checked").val();
        if (radioValue == 1) {
            $('#custom_btn1').show();
            $('#custom_btn').hide();
        }else if(radioValue == 2) {
            $('#custom_btn').hide();
            $('#custom_btn1').show();
        }
    }); 



function applyRedeem() {
       var redeem_code = $('#redeem_code').val();
       var visit_date = $('#visit_date').val(); 
       if (redeem_code != "") {
           $.post(base_url + "applyredeem", {redeem_code: redeem_code, visit_date: visit_date}, function (data) {
               if (data.status == 1) {
                console.log(data); 
                    $("#redeem_response").hide(); 
                    $("#offer1").prop('disabled', true); 
                    swal('',data.msg,'success'); 
                   
               } else{
                     swal('',data.msg,'error');
                   $("#redeem_response").show();
               }
           }, 'json');
       } else {
           //alert("Please Enter Coupon Code"); 
           swal('','Please Enter Redeem Code','error');
           $("#redeem_response").show();
       }
   } 

</script>
