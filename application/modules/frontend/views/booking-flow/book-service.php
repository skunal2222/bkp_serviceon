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
                <div class="select-box">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/subcategoryname1.png" alt="thankyou">
                    <h2>Select Subcategory</h2>
                </div>
            </div>
            <div class="flex-1">
                <div class="select-box">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/modelselectbrand.png" alt="thankyou">
                    <h2>Select Vehicle</h2>
                </div>
            </div>
            <div class="flex-1">
                <div class="select-box">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/servicesandpackagesselectbrand.png" alt="thankyou">
                    <h2>Select Service or Packages</h2>
                </div>
            </div>
            <div class="flex-1">
                <div class="select-box  active">
                    <img src="<?php echo asset_url();?>frontend/images/new-img/address-selectbrand.png" alt="thankyou">
                    <h2>Select Address</h2>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-sm-4">
                        <div class="package text-center">
                                <img src="<?php echo asset_url().'/'. $package['image'];?>"  height="80px" width="80px" alt="thankyou">
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
                              
                            <button type="button" class="custom-btn1" style="width: 188px;" onclick="window.location.href = '<?php echo $url ;?>';">Change Package</button>
                        </div>
            </div>
            <div class="col-sm-6">
                   <div class="contactus">
                       <div class="text-center">
                              <h3>Enter Address Details</h3>
                               <form id="general_form" class="custom-form" method="post" action="" enctype="multipart/formdata">
                                    <div class="row"> 
                                        <input type="hidden" name="package_id" id="package_id" value="<?=$package['id'] ?>">
                                         <input type="hidden" name="best_price" value="<?=$package['best_price'] ?>">
                                        <input type="hidden" name="special_price" value="<?=$package['special_price'] ?>">  
                                        <input type="hidden" name="packagename" value="<?=$package['package_name'] ?>">
                                        <input type="hidden" name="latitude" id="latitude" value=""/> 
                                        <input type="hidden" name="longitude" id="longitude" value=""/>
                                        <input type="hidden" name="vehicle_no" id="vehicle_no" value="<?=$vehicle_id ?>"/>
                                        
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
                                                <div id="service_type">
                                                    <select name="service_type" id="service_type" class="form-control frmcntrl" placeholder="Select Service Type" value="">
                                                        <option value="">Select Service Type</option>
                                                        <option value="11">Breakdown</option>
                                                        <option value="12">Pick n' Drop</option>
                                                        <option value="13">Doorstep</option>
                                                    </select>
                                                </div>
                                                <div class="messageContainer"></div>

                                            </div>
                                        </div>  
                                        <!-- <div class="col-sm-6">
                                             <div class="input-group">
                                                <input type="text" class="form-control" name="service_type" placeholder="Type of service" value="<?php echo $service_type ; ?>" readonly>
                                              </div> 
                                        </div>  --> 
                                         
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-sm-6">
                                             <div class="input-group">
                                                <input type="text" class="form-control" name="vehicle_number" placeholder="Vehicle Number" value="<?php echo $vehicle_number ; ?>" readonly>
                                              </div>
                                        </div>  -->
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
                                                <input type="text" class="form-control" name="landmark" id="landmark" placeholder="Society Name & Landmark" value="">
                                            </div>
                                            <div class="messageContainer"></div>  
                                        </div>   
                                    </div>
                                     <div class="row">
                      <p><input type="radio" class="offer" name="offer" value="1" id="offer1">Apply Coupon &nbsp;
                       <input type="radio" class="offer" name="offer" value="2" id="offer2">Redeem From Wallet</p> 
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

  $(document).ready(function(){

      var defaultDate=$("#visit_date").val();

      //alert(defaultDate);

     $.get(base_url+'delivery_dates',{ date: defaultDate },function(data){

       $("#visit_time").html(data);

          }); 
  });

$('#visit_date').datepicker({
     autoclose: true
 }).on('changeDate', function(e){
      $.get(base_url+'delivery_dates',{date:$(this).val()},function(data){
           $("#visit_time").html(data);
              });
 }); 


 $.getScript("//maps.googleapis.com/maps/api/js?v=3.exp&key=<?php echo $google_map_key; ?>&libraries=places&sensor=false&callback=initMap");

    function initMap() {
        var options = {
            componentRestrictions: {country: 'in'}
        };
        var input = document.getElementById('landmark');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function () {
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
         'service_type': {
            validators: {
                notEmpty: {
                    message: 'Service type is required '
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
        'service_type': {
            validators: {
                notEmpty: {
                    message: 'Service type is required '
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
    //swal('',resp.msg,'success');  
    setTimeout(function() {
    window.location.href = base_url+'thank-you'; 
    }, 2000); 
  }else{
    ajaxindicatorstop();
    
    swal('',resp.msg,'error'); 
    setTimeout(function() {
    window.location.href = base_url+'booking-failed'; 
    }, 2000); 
  }
}


 
function checkCoupon() { 

  var package_id = $('#package_id').val();;

  if($("#coupon_code").val() == "") {
    swal('',"Please enter a coupon code.",'error');
  } else if(package_id != ''){
    swal('',"You can not apply coupon code for package.",'error');
  }

  else { 
    $.post("<?php echo base_url();?>applycpoupon",{coupon_code: $("#coupon_code").val() },function(data){ 
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
