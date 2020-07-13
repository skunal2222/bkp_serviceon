<div class="terms">
  <!-- This agreement can also be known under these names: starts-->
  
   <div class="spl-div">
     <h2 class="text-center">Partner With Us</h2>
    <div class="container custom-container space">


      <div class="row">
            <div class="col-sm-5 col-md-6 paddin-top-div">
                    <p class="paddin-top">Why you should partner with us ?</p>
                    <div class="inline-sec">
                        <img src="<?php echo asset_url();?>frontend/images/p.png" alt="the-mesh" class="pro-img">
                        <p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
                    </div>
                    <div class="inline-sec">
                        <img src="<?php echo asset_url();?>frontend/images/p.png" alt="the-mesh" class="pro-img">
                        <p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
                    </div>
                    <div class="inline-sec">
                        <img src="<?php echo asset_url();?>frontend/images/p.png" alt="the-mesh" class="pro-img">
                        <p>Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
                    </div>
                </div>
          
          <div class="col-sm-7 col-md-6">
     <?php if($error=$this->session->flashdata('Success')):  ?>
      <div <?php echo  $this->session->flashdata('feedback');?> style="text-align: center;" >
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php echo $error; ?>!</strong> 
      </div>
    <?php endif; ?>
            <div class="contact-form con text-center">
              <h3>We are just a form away </h3>
               <form class="custom-form con" method="post"  action="<?php echo base_url();?>frontend/getquote" id="partnerwithus" novalidate="novalidate">
                                 <div class="input-group">
                                        <input type="hidden" name="fromtype" value="partner">   
                                        <input type="text" class="form-control" name="p_cname" id="p_cname" placeholder="Enter company's name*" data-bv-field="p_cname">
                                         
                                    </div>
                                        <div class="messageContainer-small"></div> 
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" class="form-control" name="p_city" id="p_city" placeholder="Enter city*" data-bv-field="p_city">
                      </div>
                       <div class="messageContainer-small" ></div> 
                    </div>
                    <div class="col-sm-6">
                      <div class="input-group">
                         <input type="text" class="form-control" name="p_country" id="p_country" placeholder="Enter country*" data-bv-field="p_country">
                      </div>
                       <div class="messageContainer-small"></div> 
                    </div>
                  </div>
                       
                                <div class="input-group">
                                   
                                    <input type="text" class="form-control" name="p_name" id="p_name" placeholder="Enter your name*" data-bv-field="p_name">
                                </div>
                                  <div class="messageContainer-small"></div> 
                                <div class="input-group">
                                   
                                    <input type="email" class="form-control" id="p_email" name="p_email" placeholder="Enter email id* " data-bv-field="p_email">
                                </div>
                                  <div class="messageContainer-small"></div> 
                                <div class="input-group">
                                  
                                    <input type="text" class="form-control" name="p_mobile" id="p_mobile" placeholder="Enter mobile no.*" data-bv-field="p_mobile">
                                </div>
                                  <div class="messageContainer-small"></div> 
                                <div class="input-group">
                                    
                                    <input type="text" class="form-control" name="p_msg" id="p_msg" placeholder="Message*" data-bv-field="p_msg">
                                </div>
                                  <div class="messageContainer-small"></div> 
                               
                                 <button type="submit" class="custom-btn1" id="userreg123">Submit</button>
                            </form>
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
        p_cname: {
            validators: {
                notEmpty: {
                    message: 'Company name is required'
                },
                regexp: {
                            regexp: /^[a-zs ]+$/i,
                            message: 'Company can consist of alphabetical characters and spaces only'
                        }
            }
        }, 
        p_name: {
            validators: {
                notEmpty: {
                    message: 'Name is required'
                },
                 regexp: {
                            regexp: /^[a-zs ]+$/i,
                            message: 'name can consist of alphabetical characters and spaces only'
                        }
            }
        }, 
        p_city: {
            validators: {
                notEmpty: {
                    message: 'City is required'
                },
                regexp: {
                            regexp: /^[a-zs]+$/i,
                            message: 'City can consist of alphabetical characters and spaces only'
                        }
            }
        }, 
        p_country: {
            validators: {
                notEmpty: {
                    message: 'Country is required'
                },
                regexp: {
                            regexp: /^[a-zs ]+$/i,
                            message: 'Country can consist of alphabetical characters and spaces only'
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
                    //regexp: '^[7-9][0-9]{9}$',
                    regexp: '^[0-9]{6,10}$',
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
  
});

</script>

