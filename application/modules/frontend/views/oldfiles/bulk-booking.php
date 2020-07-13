<div class="terms">
  <!-- This agreement can also be known under these names: starts-->
  
   <div class="spl-div">
   <div class="bann">
     <h2 class="text-center">We are Here to Help!</h2>
     <p class="spl-p">Surprise your Car with Pune's Expert mechanic!<br/> Fill the form below to get a quote!</p>
     </div>
    <div class="container custom-container">
     <?php if($error=$this->session->flashdata('Success')):  ?>
     <div <?php echo  $this->session->flashdata('feedback');?> style="text-align: center;" >
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong><?php echo $error; ?>!</strong> 
          </div><?php endif; ?>
     
   <div class="contactus">
       <div class="contact-form con text-center">
              <h3>We deliver perfect!</h3>
                <form class="custom-form" action="<?php echo base_url();?>frontend/b2bgetquote" method="post" action="" id="partnerwithus" novalidate="novalidate">
                  <input type="hidden" name="fromtype" value="enquiry">
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
                    <input type="text" class="form-control" name="p_city" id="p_city" placeholder="Enter your city" data-bv-field="p_city">
                  </div>
                    <div class="messageContainer-small" ></div> 
                </div>
                <div>
                  <div class="input-group">
                    <input type="text" class="form-control" name="p_company_name" id="p_company_name" placeholder="Enter your company name" data-bv-field="p_company_name">
                  </div>
                    <div class="messageContainer-small" ></div> 
                </div>
                <div>
                  <div class="input-group">
                    <input type="text" class="form-control" name="p_total_vehicle" id="p_total_vehicle" placeholder="Enter total vehicle" data-bv-field="p_total_vehicle">
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

<script>

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
        p_city: {
            validators: {
                notEmpty: {
                    message: 'City is required'
                }
            }
        }, 
        p_company_name: {
            validators: {
                notEmpty: {
                    message: 'Company is required'
                }
            }
        }, 
        p_total_vehicle: {
            validators: {
                notEmpty: {
                    message: 'Total vehicle is required'
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
        }
    
    }
}).on('success.form.bv', function(event,data) {
   // event.preventDefault();
 
});



</script>

