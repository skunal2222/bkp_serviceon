   <!-- Modal -->
                        <div id="package_modal" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-md">
                        
                            <!-- Modal content-->
                            <div class="modal-content know-more-div">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                <div class="text-center">
                                  <!-- summeury order -->
                                  <link href="<?php echo asset_url();?>frontend/css/booking-flow/date-time-picker.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo asset_url();?>frontend/js/datepicker.js"></script>
 <style type="text/css">

     .pac-container {

    z-index: 100000;

}

   </style>
<div class="terms">
  <!-- This agreement can also be known under these names: starts-->
  <?php   
   // pretag($perorder);      ?>
   <div class="spl-div">
     <h2 class="text-center">Booking Summary</h2>
    <div class="container custom-container">
     
   <div class="contactus">
       <div class="contact-form con text-center">
              <h3>You are just one step away!</h3>
               <form class="custom-form" id="general_form"  method="post">
                <input type="hidden" name="userid"  value="<?= ($userdata['olouserid']  ? $userdata['olouserid'] :0)?>">
                    
                      <input type="hidden" name="packageid" value="<?=$package['id'] ?>">
                      <input type="hidden" name="best_price" value="<?=$package['best_price'] ?>">
                      <input type="hidden" name="special_price" value="<?=$package['special_price'] ?>">  
                      <input type="hidden" name="model_id" value="<?= $perorder['vehicle_model'] ?>"> 
                      <input type="hidden" name="brand_id" value="<?= $perorder['brand_id'] ?>"> 
                      <input type="hidden" name="notfirstorder" value="1">  
                      <input type="hidden" name="latitude" id="latitude" value=""/>
                      <input type="hidden" name="longitude" id="longitude" value=""/>
                      <!-- <input type="hidden" name="packagename" value="<?=$package['package_name'] ?>"> -->
                <div class="spl-space">
                 <div class="row">
                  <div class="col-sm-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" value="<?= $userdata['name'] ?>" placeholder="Name" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="input-group">
                       <input type="email" class="form-control" name="email" value="<?= $userdata['email'] ?>" placeholder="Email Id" autocomplete="off">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="mobile" value="<?= $userdata['mobile'] ?>" placeholder="Phone No." autocomplete="off">
                    </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="input-group slt-date">
                          <div id="sandbox-container">
                          
                                <input type="text" id="visit_date" name="visit_date" class="form-control"   placeholder="Select Visit Date" value="<?php echo date('d-m-Y'); ?>" autocomplete="off" >
                       
                          </div> 
                          <div class="messageContainer"></div>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="input-group">
                     <div id="visit_slot">
                    <select name="visit_time" id="visit_time" class="form-control frmcntrl" placeholder="Select Visit time" value="" autocomplete="off">
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
            </div>
                <div class="row">  

                   <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" class="form-control" name="flat" id="flat"
                             placeholder="Flat No./Building" value="" autocomplete="off">
                        </div>
                        <div class="messageContainer"></div> 
                  </div> 
                 
                
                   <div class="col-sm-6">
                    <div class="input-group">
                       <!-- <input type="text" class="form-control" name="landmark" id="landmark"  value="<?= $perorder['landmark'] ?>" placeholder="Society Name & Landmark"> -->
                       <input type="text" class="form-control" name="landmark" id="landmark" onkeyup="checkLatlng(this.value)" autocomplete="off" />
                    </div>
                    <div class="messageContainer"></div> 
                  </div> 
                  <div class="col-sm-6">
                    <div class="input-group">
                       <input type="text" class="form-control" name="packagename" value="<?=$package['package_name'] ?>" placeholder="Package Selected" readonly >
                    </div>
                    <div class="messageContainer"></div> 
                  </div>
                </div>
                <!-- checkbok for service -->

               <?php  if((!empty($packageservices)) AND (!empty($catsubcat))) {?>

              <div class="row">
                <h4>Package Services List</h4>
                <table class="table table-hover">
                    <tbody>
                <?php $i=1; 


                 foreach ($packageservices as $value) { ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $value['servicename'] ?></td>

                            <?php
                            $checkStyle = "checked onclick=\"return false;\" "; 
                            foreach ($servicecnt as $key2 => $row) {
                            	if($value['service_id']==$row['service_id']){
                            		$finalCount = $mypackages[0]['remaining_service_count']  +  $row['service_count'] ; 
                             		if($finalCount!=$value['service_used_validity']){
                            			 $checkStyle = "" ; 
                            		}
                            	}

                            }
                            	
                              ?>
                             <td><input type='checkbox' name="service_use[]"  value=
            "<?php echo $value['service_id']; ?>" <?php echo $checkStyle ; ?> ></td>
                       </tr>
                <?php $i++; } ?>  
                  </tbody>
                </table> 

              </div> 

                <h4>You have Selected Extra Services </h4>  

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
            <?php } else if(!empty($packageservices)) { ?> 


                <div class="row">
                <h4>Package Service List</h4>
                <table class="table table-hover">
                      <tbody>

                <?php $i=1; //pretag($packageservices);





                 foreach ($packageservices as $value) { ?>

                        <tr>

                            <td><?php echo $i ?></td>

                            <td><?php echo $value['servicename'] ?></td>



                            <?php

                            $flag=0;

                            $checkStyle = "checked onclick=\"return false;\" "; 

                            foreach ($servicecnt as $key2 => $row) {

                              if($value['service_id']==$row['service_id']){

                                $finalCount = $mypackages[0]['remaining_service_count']  +  $row['service_count'] ; 

                                if($finalCount!=$value['service_used_validity']){

                                   $checkStyle = "" ; 

                                }

                                if($row['service_count']==$value['service_used_validity'])

                                  $flag=1;

                              }



                            }

                            if($flag)

                            {  ?>

                             <td>expired</td>

                       </tr>

                     <?php       }  else{  

                              ?>

                               

                             <td><input type='checkbox' name="service_use[]"  value=

            "<?php echo $value['service_id']; ?>" <?php echo $checkStyle ; ?> ></td>

                       </tr>

                <?php  } $i++; } ?>  

                  </tbody>

                </table> 

              </div>   
 
            <?php } ?>
                <!-- end -->
              </div>
               <!--  <div class="summary-booking">
                  <div class="row">
                     <div class="col-sm-6 col-xs-7 text-left">
                       <h4><?= $package['package_name'] ?></h4>
                     </div>
                     <div class="col-sm-6 col-xs-5 text-right">
                      <h4>Rs <?= $package['best_price'] ?></h4>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6 col-xs-6 text-left">
                       <h4>Tax</h4>
                     </div>
                     <div class="col-sm-6 col-xs-6 text-right">
                      <h4>Rs 0</h4>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6 col-xs-6 text-left">
                       <h4>Discount</h4>
                     </div>
                     <div class="col-sm-6 col-xs-6 text-right">
                      <h4>Rs <?= $package['best_price']-$package['special_price'] ?></h4>
                     </div>
                  </div>
                </div>
                  <div class="total-amount">
                    <div class="row">
                       <div class="col-sm-6 col-xs-6 text-left">
                         <h4>Total</h4>
                       </div>
                       <div class="col-sm-6 col-xs-6 text-right">
                        <h4>Rs <?= $package['special_price'] ?></h4>
                       </div>
                    </div>
                  </div> -->

               <!--  <button type="button" class="custom-btn1" data-toggle="modal" data-target="#confirm-booking" onclick="saveOrder()">Pay</button> -->
                <button type="submit" class="custom-btn1"  >Book Now</button>
              </form>
         
        </div>
   </div>  
  <!-- This agreement can also be known under these names: ends -->
 </div> 
</div>
</div>
                                  <!-- end summery order -->
                       
                                </div>
                              </div>
                            </div>
                        
                          </div>
                        </div>
                      <!-- Modal -->  


                      <script type="text/javascript">
                        var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$.fn.datepicker.defaults.startDate = today; 
 
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
 
 function checkLatlng(land){

   // alert('nitin');

    $('#latitude').val('');

    $('#longitude').val('');

  }
 

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
                    message: 'Flat is required '
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
        'service_type': {
            validators: {
              notEmpty: {
                    message: 'Service Type is required '
                } 
            } 

        } 
    }
}).on('success.form.bv', function(event,data) {
   //Prevent form submission
  event.preventDefault();
  // var flag=$('[name="flag"]').val();
  //   if(parseInt(flag)==0)
  //   $("#coupon_code").val('');
 
      addorder();
    
  
  
});

function addorder()
{
   $.ajax({
            url : base_url+"setdata",
            type: "POST",
            data: $('#general_form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status == 1){
                 saveOrder();
                }
             
              
             // location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            } 
        }); 
}

  function saveOrder(){
  ajaxindicatorstart("Please hang on.. while we add order ..");
   $.post("<?php echo base_url();?>booking/profileorder/",{latitude:$('#latitude').val(),longitude:$('#longitude').val()},function(data){ 
              
              if (data.status == '0') {
              ajaxindicatorstop();
                  swal('',data.msg,'error');
              } else if(data.status == 1){
              ajaxindicatorstop();
                //swal('',data.msg,'success');  
                setTimeout(function() {
                 window.location.href = base_url+'thank-you'; 
                 }, 2000); 
              }else{
                ajaxindicatorstop();  
               // swal('',data.msg,'error'); 
                setTimeout(function() {
                window.location.href = base_url+'booking-failed'; 
                }, 2000); 
            }  
     },'json');
}
                      </script>