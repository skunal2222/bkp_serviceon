<!--subscript section -->
  <div class="subscription" >
     <div class="container">
        <h3>INTERESTED IN UPDATES ON OFFERS?</h3>
         <form id="subscription_form" class="custom-form" method="post" action="" enctype="multipart/formdata">
        <div class="input-group">
          <input type="text" name="subscription_email" class="form-control custom-form" placeholder="Your Email">
      
          <div class="input-group-btn">
            <button class="sub-btn" type="submit">
              SUBSCRIPTION
            </button>
          </div>
        </div>
             <div class="messageContainer"></div>
      </form>
     </div>
  </div>
<!--subscript section -->
<footer>
<div class="top-footer">
<div class="custom-container">
    <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
           <a href="<?php echo base_url();?>">
               <img src="<?php echo asset_url();?>images/common/Logo.png" alt="BikeDoctor" class="">
            </a>
          <div class="width100">
             <ul>
               <li><a href="<?php echo base_url();?>enquiry-form">Enquiry Form</a></li>
               <li><a href="<?php echo base_url();?>Privacy-Policy">Privacy Policy</a></li>
               <li><a href="<?php echo base_url();?>refund-policy">Refund Policy</a></li>
               <li><a href="<?php echo base_url();?>cancellation-policy">Cancellation Policy</a></li>
               <li><a href="<?php echo base_url();?>FAQ">FAQ </a></li>
               <li><a href="<?php echo base_url();?>contact-us">Contact Us </a></li>
             </ul>
          </div>
        </div>  
    </div>
    <div class="contact-details-spl">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-center">
             <img src="<?php echo asset_url();?>frontend/images/new/emailid.png" alt="BikeDoctor" class="">
             <p>Email Id</p>
             <p>support@bikedoctor.in</p>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-center">
            <img src="<?php echo asset_url();?>frontend/images/new/phoneno.png" alt="BikeDoctor" class="">
            <p>Phone no.</p>
            <p>+91 8390 888 409</p>
          </div>
           <div class="col-lg-4 col-md-4 col-sm-4 text-center">
            <img src="<?php echo asset_url();?>frontend/images/new/website.png" alt="BikeDoctor" class="">
            <p>Website</p>
              <p>www.bikedoctor.in</p> 
          </div>
        </div>
    </div> 
    </div>
  </div>
</div>

<div class="bottom-footer">
   <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4">      
        <p>Copyright&copy;BikeDoctor 2019, </p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 text-center">   
      <div class="footer-social-media">
               <a href="https://www.facebook.com/bikedoctorindia/" target="_blank"><img src="<?php echo asset_url();?>images/social-media/facebook.png" /></a>
               <a href="https://plus.google.com/111284580882021895889" target="_blank"><img src="<?php echo asset_url();?>images/social-media/google-plus.png" /></a>
               <a href="https://twitter.com/bikedoctorin" target="_blank"><img src="<?php echo asset_url();?>images/social-media/twitt.png" /></a>
               <a href="https://www.instagram.com/bikedoctorindia" target="_blank"><img src="<?php echo asset_url();?>images/social-media/instagram.png" /></a>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 text-right">
      <a href="http://brandzgarage.com/" target="_blank">Designed &#38; Developed by BrandzGarage</a>
    </div>
   </div>   
</div>
</footer>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script>

$('#subscription_form').bootstrapValidator({
        container: function ($field, validator) {
            return $field.parent().next('div.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {  
            
          'subscription_email': {
              validators: {
                  notEmpty: {
                      message: 'Email is required and cannot be empty'
                  },
                  regexp: {
                      regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                      message: 'The value is not a valid email address'
                  }
              }
            }
        }
    }).on('success.form.bv', function (event, data) {
        // Prevent form submission
        event.preventDefault();
        addSubscription();
    }); 

    function addSubscription() { 
        var options = {
            target: '#response',
            beforeSubmit: showAddRequest1,
            success: showAddResponse1,
            url: base_url + 'add-subscription',
            semantic: true,
            dataType: 'json'
        };
        $('#subscription_form').ajaxSubmit(options);
    }

    function showAddRequest1(formData, jqForm, options) {
        $("#response").hide();
       // ajaxindicatorstart("Please hang on.. while we add subscription ..");
        var queryString = $.param(formData);
        return true;
    }

    function showAddResponse1(resp, statusText, xhr, $form) {
       // ajaxindicatorstop();
        //alert(resp.msg);
        
        if (resp.status == '0') {
            swal('',resp.msg,'warning'); 
            $("#response").show();
        } else {
            swal('',resp.msg,'success'); 
            $("#response").show();
            setTimeout(function() {
            window.location.href = base_url; 
           }, 6000);
        }
    } 

   </script> 