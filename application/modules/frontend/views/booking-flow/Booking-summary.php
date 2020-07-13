 
<link href="<?php echo asset_url();?>frontend/css/booking-flow/date-time-picker.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo asset_url();?>frontend/js/datepicker.js"></script>
<div class="terms">
  <!-- This agreement can also be known under these names: starts-->
  
   <div class="spl-div">
     <h2 class="text-center">Booking Summary</h2>
    <div class="container custom-container">
     
   <div class="contactus">
       <div class="contact-form con text-center">
              <h3>You are just one step away!</h3>
               <form class="custom-form">
                 <div class="input-group slt-date">
                     <div id="sandbox-container">
                        <input type="text" type="text" class="form-control date-place" placeholder="date and time" readonly  value="<?php echo $_SESSION['visit_date'].' '.$_SESSION['visit_time']?>" />
                    </div>
                  </div>
                  <div class="input-group">
                    <input type="email" class="form-control" name="email" id="semail" placeholder="Address" value="<?php echo $_SESSION['email']?>" readonly>
                  </div>
                  <div class="input-group">
                    <input type="text" class="form-control" name="service_type" placeholder="Type of service" value="<?php echo $service_type ; ?>" readonly>
                  </div>
                  <div class="input-group">
                    <input type="text" class="form-control" name="vehicle_number" placeholder="Vehicle Number" value="<?php echo $vehicle_number ; ?>" readonly>
                  </div>
                  <div class="input-group">
                   <input type="text" class="form-control" name="mobile" id="smobile" placeholder="Phone no." value="<?php echo $_SESSION['mobile']?>" readonly>
                  </div>
                  <div class="input-group">
                    <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Enter Coupon Code">
                    <div class="input-group-btn">
                      <button type="button" onclick="checkCoupon()" class="apply-btn">APPLY</button>
                    </div>
                  </div>
                   <button type="button" onclick="saveOrder()" class="custom-btn1" data-toggle="modal" data-target="#confirm-booking">Continue</button>
              </form>
         
        </div>
   </div>  
  <!-- This agreement can also be known under these names: ends -->
 </div> 
</div>
</div>

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


function checkCoupon() { 
  if($("#coupon_code").val() == "") {
    swal('',"Please enter a coupon code.",'error');
  } else { 
    $.post("<?php echo base_url();?>applycpoupon",{coupon_code: $("#coupon_code").val() },function(data){ 
              if(data.status == 1){
              swal('',data.msg,'success')
             }else{
              swal('',data.msg,'error')
              $("#coupon_code").val('');
            } 
     },'json');
  }
}

function saveOrder(){
  ajaxindicatorstart('Please hang on.. while we add order ..');
   $.post("<?php echo base_url();?>booking/add",{coupon_code: $("#coupon_code").val() },function(data){ 
               if(data.status == 1){
                ajaxindicatorstop();
                swal('',data.msg,'success');  
                setTimeout(function() {
                window.location.href = base_url+'thank-you'; 
                }, 6000); 
              }else{
                ajaxindicatorstop();
                
                swal('',data.msg,'error'); 
                setTimeout(function() {
                window.location.href = base_url+'booking-failed'; 
                }, 6000); 
            }  
     },'json');
}

</script>