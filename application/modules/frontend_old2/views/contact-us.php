<div class="terms">
  <!-- This agreement can also be known under these names: starts-->
  
   <div class="spl-div">
     <h2 class="text-center">Contact Us</h2>
    <div class="container custom-container">
     
   <div class="contactus">
       <div class="contact-form con text-center">
         <?php if($error=$this->session->flashdata('Success')):  ?>
              <div <?php echo  $this->session->flashdata('feedback');?> style="text-align: center;" >
                   <button type="button" class="close" data-dismiss="alert">&times;</button>
                       <strong><?php echo $error; ?>!</strong> 
               </div><?php endif; ?>
              <h3>We’d  <img src="http://motormechtest.brandzgarage.com/assets/frontend/images/favorite-heart-button-1.png" alt="scaleup"> to help </h3>
               <form class="custom-form con" action="<?php echo base_url();?>frontend/getquote" method="post" action="" id="partnerwithus" novalidate="novalidate">
                   <input type="hidden" name="fromtype" value="contactus">
                <div>
                   <div class="input-group">
                    <input type="text" class="form-control" name="p_name" id="p_name" placeholder="Enter your name">
                  </div>
                   <div class="messageContainer-small" ></div> 
                </div>
                <div>
                  <div class="input-group">
                    <input type="email" class="form-control" id="p_email" name="p_email"  placeholder="Enter your email - id">
                  </div>
                    <div class="messageContainer-small" ></div> 
                </div>
                <div>
                  <div class="input-group">
                    <input type="text" class="form-control" name="p_mobile" id="p_mobile" placeholder="Enter your phone no." data-bv-field="p_mobile">
                  </div>
                    <div class="messageContainer-small" ></div> 
                </div>
                <div>
                  <div class="input-group">
                   <textarea class="form-control" name="p_msg" id="p_msg" placeholder="Enter your query"></textarea>
                  </div>
                   <div class="messageContainer-small" ></div> 
                </div>
                   <button type="submit" class="custom-btn1">Submit</button>
              </form>
         
        </div>
      <div class="Contact-us-div">
          <div class="Contact-info row text-center">
               <div class="col-lg-4 col-md-4 col-sm-4 mtop">
                 <div class="">
                   <img src="<?php echo asset_url();?>frontend/images/new/website.png" alt="MotorMechs">
                   <p>Pune | Pimpri | Chinchwad | Mumbai | Navi Mumbai | Thane</p>
                 </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-4 spl-margin">
                  <div class="">
                    <img src="<?php echo asset_url();?>frontend/images/new/emailid.png" alt="MotorMechs">
                    <p>support@bikedoctor.in</p>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-4 ">
                 <div class="">
                   <img src="<?php echo asset_url();?>frontend/images/new/phoneno.png" alt="MotorMechs">
                   <p>+91 8390 888 409</p>
                 </div> 
               </div>
            </div> 
     </div>
   </div>  
  <!-- This agreement can also be known under these names: ends -->
 </div> 
</div>
<script type="text/javascript">

$('#partnerwithus').bootstrapValidator({
    container: function($field, validator) {
        return $field.parent().next('.messageContainer-small');
    },
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
     excluded: ':disabled',
    fields: {
        
        p_name: {
            validators: {
                notEmpty: {
                    message: 'Name is required'
                },
                  regexp: {
                  regexp: '^[a-zA-Z ]*$',
                  //  regexp: '^[a-z\s]+$',
                    message: 'alphabet and space only'
                } 
            }
        }, 
        p_city: {
            validators: {
                notEmpty: {
                    message: 'City is required'
                }
            }
        }, 
       
        p_email: {
            validators: {
                notEmpty: {
                    message: 'Email is required'
                },
             /*   regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    //message: 'Not a valid email address'
                }  */
                
            }
        },
        p_mobile: {
            validators: {
                notEmpty: {
                    message: 'The Mobile is required.'
                },
                regexp: {
                    regexp: '^[7-9][0-9]{9}$',
                   // regexp: '[0][1-9]\d{9}$|^[1-9]\d{9}$/i',
                    message: 'Invalid Mobile Number'
                } 
            }
        },
        p_msg: {
            validators: {
                notEmpty: {
                    message: 'Message is required'
                },
                stringLength: {
                  
                    min: 20,
                    message: 'Message must be 20 characters or longer.'
                },
                
            }
        },
    
    }
}).on('success.form.bv', function(event,data) {
   // event.preventDefault();
 
});



</script>

