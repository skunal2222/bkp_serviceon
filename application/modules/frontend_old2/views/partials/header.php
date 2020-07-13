 <?php if(!empty($userid)){  ?>
    
  
                 <script type="text/javascript">
                    $(document).ready(function(){
                    $('#resetPasswordModal').modal({
                    backdrop: 'static',
                    keyboard: false
                    })
                     $("#resetPasswordModal").modal();      
                    });
                  
                 </script>
                 <?php } ?>
<header> 
  <nav class="navbar navbar-inverse navbar-fixed-top custom-navbar justify-content-center">
    <div class="container-fluid">
      <div class="navbar-header custom-brand">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="<?php echo base_url();?>">
           <img src="<?php echo asset_url();?>frontend/images/common/Logo.png" alt="BikeDoctor" class="">
        </a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right navbar-custom">
          <li>
            <a href="<?php echo base_url();?>">Home</a>
          </li>
          <li>
            <a href="<?php echo base_url();?>about-us">About Us</a>
          </li>
          <li>
            <a href="<?php echo base_url();?>our-services">Services</a>
          </li>
<!--          <li>
            <a href="<?php echo base_url();?>why-us">Why Us</a>
          </li>-->
          <li>
            <a href="<?php echo base_url();?>partner-with-us">Franchise</a>
          </li>
          <li>
            <a href="<?php echo base_url();?>package">Packages</a>
          </li>
           <li>
            <a href="<?php echo base_url();?>bulk-booking">Bulk Booking</a>
          </li> 
          <li>
            <?php if(!isset($_SESSION['olouserid'])){ ?>
 
            <a href="javascript:void(0)"> 
              <button type="button" data-toggle="modal" data-target="#myLoginModal" class="smp-btn">Login </button> 
              <button type="button" data-toggle="modal" data-target="#myRegisterModal" class="smp-btn"> / Register</button>
            </a>
              
             <?php } ?>
          </li>

          <li class="dropdown">
            <?php if(isset($_SESSION['olouserid'])){
            //echo "<pre>"; print_r($_SESSION); exit; ?>
            <a href="javascript:void(0)" class="dropbtn"> 
             <?php echo 'Hi'.' '.$this->session->userdata('olousername').'!';?>
            </a>
            <div class="dropdown-content my-profile-dropdown">
                <a href="<?php echo base_url();?>ongoing-orders">
                  My Profile 
                </a>
                <a href="<?php echo base_url();?>logout">
                  Logout 
                </a>
            </div>
            <?php } ?>
          </li>
          <li class="fright">
            <!-- <a href="<?php echo base_url();?>select-subcategory" class="spl-btn"> 
              Book Now
            </a> -->

            <button type="button" class="custom-btn1" onclick="booknow()">Book Now</button>

          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
 
<!-- Login Modal starts -->
<div id="myLoginModal" class="modal fade custom-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content custom-modal-content">
            <div class="modal-header custom-modal-header">
                <button type="button" class="close custom-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body custom-modal-body">
                <div class="row">
                    <div class="col-sm-6">
                    	<img src="<?php echo asset_url();?>frontend/images/new/login.png" alt="BikeDoctor" class="img">
                    </div>
                    <div class="col-sm-6">
                        <div class="login-sinup-form">
                            <div class="on-login-btn">
                                <div class="row">
                                   <div class="col-sm-6 col-xs-6 text-center">
                                      <button type="button" class="login-head-btn underline">Login </button>
                                   </div>
                                   <div class="col-sm-6 col-xs-6 text-center">
                                     <button type="button" class="login-head-btn" data-dismiss="modal" data-toggle="modal" data-target="#myRegisterModal">Register </button>
                                   </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="login-with-social">
                                    <div class="inline-flex">
                                      <h3>Login with</h3>
                                      <a href="<?= base_url()?>facebook"><img src="<?php echo asset_url();?>frontend/images/social-media/fb.png" alt="login-with-fb"></a>
                                         <a href="<?= base_url()?>google"><img src="<?php echo asset_url();?>frontend/images/social-media/gp2.png" alt="login-with-fb"></a>
                                    </div>
                                </div>
                            <center><h4>OR</h4></center>
                            <form class="form-inline text-center spl-" action="" id="login_frm" name="login_frm" method="post">
                                <div class="form-group">
                                    <div>
                                        <input type="text" class="form-control" id="username" name="username" autocomplete="" placeholder="Email Id">
                                    </div>
                                    <div class="messageContainer"></div>
                                </div>
                                <!-- login with password or PIN -->
                                <div class="Password-login">
                                    <div class="form-group">
                                        <div>
                                            <input type="password" class="form-control" id="lg_password" name="lg_password" autocomplete="" placeholder="Password">
                                        </div>
                                        <div class="messageContainer pass-err"></div>
                                    </div>
                                    <div class="inline-section">
                                        <button type="button" class="OTP-btn otp-login-btn" onclick="loginWithOTP();">Login with OTP</button>
                                        <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#forgotPasswordModal" class="forgot-password-btn">Forgot Password?</button>
                                    </div>
                                </div>

                                <div id="lg_response" style="color: red;"></div>
                                 <br/> <br/> <br/>
                                  <button type="submit" class="custom-btn1">Login</button> <br/>
                                 <br/>
                                <!-- login with social media-->
                                
                                <div class="inline-flex">
                                  <h3>Don’t have an account?
                                    <button type="button" class="register-login-here-btn" data-dismiss="modal" data-toggle="modal" data-target="#myRegisterModal">Register Now </button>
                                  </h3>
                                </div>
                            </form>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Modal ends -->

<!-- Signup Modal starts -->
<div id="myRegisterModal" class="modal fade custom-modal" role="dialog" tabindex="-1">
    <div class="modal-dialog" tabindex="-1">
        <!-- Modal content-->
        <div class="modal-content custom-modal-content">
            <div class="modal-header custom-modal-header">
                <button type="button" class="close custom-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body custom-modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                        	<img src="<?php echo asset_url();?>frontend/images/new/login.png" alt="BikeDoctor" class="img">
                    	</div>
                        <div class="col-sm-6">
                            <div class="login-sinup-form">
                                <div class="row">
                                   <div class="col-sm-6 col-xs-6 text-center">
                                      <button type="button" class="login-head-btn" data-dismiss="modal" data-toggle="modal" data-target="#myLoginModal">Login </button>
                                   </div>
                                   <div class="col-sm-6 col-xs-6 text-center">
                                     <button type="button" class="login-head-btn underline">Register </button>
                                   </div>
                                </div>
                                <br>
                                <br>
                                <div class="login-with-social">
                                    <div class="inline-flex">
                                      <h3>Register with</h3>
                                         <a href="<?= base_url()?>facebook"><img src="<?php echo asset_url();?>frontend/images/social-media/fb.png" alt="login-with-fb"></a>
                                         <a href="<?= base_url()?>google"><img src="<?php echo asset_url();?>frontend/images/social-media/gp.png" alt="login-with-fb"></a>
                                    </div>
                                </div>
                            <center><h4>OR</h4></center>
                                <div class="login-sinup-form">
                                    <form class="form-inline text-center" action="" name="sign_frm" id="sign_frm" method="post">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" class="form-control" id="fname" name="fname" autocomplete="" placeholder="First Name">
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" class="form-control" id="lname" name="lname" autocomplete="" placeholder="Last Name">
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group email-err">
                                                    <div>
                                                        <input type="email" class="form-control" id="email" name="email" autocomplete="" placeholder="Email Id">
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="text" class="form-control" autocomplete="" id="mobile" name="mobile" placeholder="Phone No.">
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="password" class="form-control" autocomplete="" id="password" name="password" placeholder="Password">
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group confirm-ps">
                                                    <div>
                                                        <input type="password" class="form-control" autocomplete="" id="password_confirm" name="password_confirm" placeholder="Confirm Password">
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group confirm-ps">
                                                    <div>
                                                        <input type="text" class="form-control" autocomplete="" id="referal_code" name="referal_code" placeholder="Enter referal code(if any)">
                                                    </div>
                                                    <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="otpp_response"></div>
                                        <br/>
                                           <button type="submit" class="custom-btn1" id="userreg">Regiter</button> 
                                        <br/>
                                       
                                        <div class="inline-flex">   
                                           <h3>Already have an account?<button type="button" class="register-login-here-btn" data-dismiss="modal" data-toggle="modal" data-target="#myLoginModal">Login Now</button></h3>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Signup Modal ends -->

<!-- forgot Password Modal starts -->
<div id="forgotPasswordModal" class="modal fade custom-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content custom-modal-content">
            <div class="modal-header custom-modal-header">
                <button type="button" class="close custom-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Forgot Password</h4>
            </div>
            <div class="modal-body custom-modal-body text-center">
                <div class="row">
                    <div class="col-sm-6">
                      <img src="<?php echo asset_url();?>frontend/images/new/login.png" alt="BikeDoctor" class="img">
                    </div>
                    <div class="col-sm-6">
                        <div class="login-sinup-form cust-space">
                            <h4>Forgot Password</h4>
                            <p>Enter your email id and we will send you a link to reset it</p>
                            <form class="form-inline" id="forget_frm" name="forget_frm" action="" method="post">
                                <div class="form-group">
                                    <div>
                                        <input type="text" class="form-control" id="forget_email" name="forget_email" autocomplete="" placeholder="Email Id">
                                    </div>
                                    <div class="messageContainer"></div>
                                </div>
                               <!--  <button type="button" class="custom-btn1" data-dismiss="modal" data-toggle="modal" data-target="#resetPasswordModal">Submit</button> -->

                                <button type="submit" class="custom-btn1">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- forgot Password Modal ends -->

<!-- Reset Password Modal starts -->
<div id="resetPasswordModal" class="modal fade custom-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content custom-modal-content">
            <div class="modal-header custom-modal-header">
                <button type="button" class="close custom-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body custom-modal-body text-center">
                <div class="row">
                    <div class="col-sm-6">
                      <img src="<?php echo asset_url();?>frontend/images/new/login.png" alt="BikeDoctor" class="img">
                    </div>
                    <div class="col-sm-6">
                        <div class="login-sinup-form cust-space">
                            <h4>Reset Password</h4>
                            <form class="form-inline" id="reset_frm" action="" method="post">
                                 <?php if(!empty($userid)){ ?>
                                 <input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>">
                                 <input type="hidden" name="resetcode" id="resetcode" value="<?php echo $resetcode; ?>">
                                 <?php } ?> 

                                <div class="form-group">
                                    <div>
                                    <input type="password" name="new_pass" id="new_pass" class="form-control" autocomplete="" placeholder="Password">
                                    </div>
                                    <div class="messageContainer"></div>
                                </div>
                                <div class="form-group">
                                    <div>
                                    <input type="password" name="new_confirm_pass" id="new_confirm_pass" class="form-control" autocomplete="" placeholder="Confirm Password">
                                     </div>
                                   <div class="messageContainer"></div>
                                </div>
                                <div class="center">
                                   <div id="reset_response" style="display:none;color:red"></div>
                                </div>
                                <button type="submit" class="custom-btn1">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Reset Password Modal ends -->

<!-- OTP Verification Modal starts -->
<div id="OTPVerificationModal" class="modal fade custom-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content custom-modal-content">
            <div class="modal-header custom-modal-header">
                <button type="button" class="close custom-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body custom-modal-body text-center">
                <div class="row">
                    <div class="col-sm-6">
                       <img src="<?php echo asset_url();?>frontend/images/new/login.png" alt="BikeDoctor" class="img">
                    </div>
                    <div class="col-sm-6">
                        <div class="login-sinup-form cust-space">
                            <h4>OTP Verification</h4>
                            <p>Enter the OTP Verification code sent on your phone no.</p>
                            <form class="form-inline" action="" name="otp_frm" id="otp_frm" method="post">
                                <input type="hidden" name="otp_code" id="otp_code">
                                <div class="form-group">
                                    <div>
                                        <input type="text" class="form-control" name="user_otp" id="user_otp" autocomplete="" placeholder="OTP Verification Code">
                                    </div>
                                    <div class="messageContainer"></div>
                                </div>
                                <div id="otp_response"></div>
                                <button type="submit" class="custom-btn1">Submit</button><br/>
                                <button type="button" class="Resent-OTP-btn" onClick="resendOtp();">RESEND OTP</button>
                                <div class="center">
                                  <div id="su_response" style="display:none;color:red"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- OTP Verification Modal ends -->

<!-- login OTP Verification Modal starts -->
<div id="login-with-otp" class="modal fade custom-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content custom-modal-content">
            <div class="modal-header custom-modal-header">
                <button type="button" class="close custom-close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body custom-modal-body text-center">
                <div class="row">
                    <div class="col-sm-6">
                       <img src="<?php echo asset_url();?>frontend/images/new/login.png" alt="BikeDoctor" class="img">
                    </div>
                    <div class="col-sm-6">
                        <div class="login-sinup-form cust-space">
                            <h4>OTP Verification</h4>
                            <p>Enter the OTP Verification code sent on your email id or phone no.</p>
                            <form class="form-inline" action="" name="login_otp_frm" id="login_otp_frm" method="post">
                                <input type="hidden" name="loginotp_code" id="loginotp_code">
                                 <input type="hidden" name="lg_username" id="lg_username">
                                <input type="hidden" name="lg_uid" id="lg_uid">
                                <div class="form-group">
                                    <div>
                                        <input type="text" class="form-control" name="loginuser_otp" id="loginuser_otp" autocomplete="" placeholder="OTP Verification Code">
                                    </div>
                                    <div class="messageContainer"></div>
                                </div>
                                <div id="otp_response"></div>
                                <button type="submit" class="custom-btn1">Submit</button><br/>
                                <button type="button" class="Resent-OTP-btn" onClick="resendOtpLogin();">RESEND OTP</button>
                                <div class="center">
                                  <div id="lg_otp_response" style="display:none;color:red"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- OTP Verification Modal ends --> 

<!-- Confirm registration pop up -->
  <!-- Modal -->
    <div id="confirm-registration" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header cancel-header custom-modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="cancel-sub text-center">
              <img src="<?php echo asset_url();?>frontend/images/social-media/success.png" alt="successful"/>
              <h3>Thank You for registering. Your registration is confirmed.</h3>
              <div class="inline-flex">
             <button type="button" class="custom-btn1" data-dismiss="modal" data-toggle="modal" data-target="#not-confirm-registration">Continue</button>
              </div>
            </div>
          </div>
        </div>
    
      </div>
    </div>
  <!-- Modal -->  
<!-- Confirm registration pop up -->


<!-- registration rejected pop up -->
  <!-- Modal -->
    <div id="not-confirm-registration" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header cancel-header custom-modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="cancel-sub text-center">
              <img src="<?php echo asset_url();?>frontend/images/social-media/error.png" alt="successful"/>
              <h3>Registration failed! Please try again.</h3>
              <div class="inline-flex">
             <button type="button" class="custom-btn1" data-dismiss="modal" data-toggle="modal" data-target="#myRegisterModal">Try Again</button>
              </div>
            </div>
          </div>
        </div>
    
      </div>
    </div>
 <?php if($this->session->socialuserid) { ?>
 
<div id="social-mobile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
          
            <div class="modal-header">
               <a href="<?php echo base_url();?>logout" class="close" aria-hidden="true" >X</a>
            </div>
            <div class="modal-body text-center">
                <form id="social_mobile_frm" name="social_mobile_frm" method="post" action="">
                   <div class="custom-margin">
                        <div class="input-group">
                            <span class="input-group-addon"><img src="<?php echo asset_url();?>images/phone-receiver.png" alt="" class="width23" /></span>
                            <input type="text" pattern="[0-9]{6,14}" class="form-control custom-pl" name="mobile" id="" required="" placeholder="ENTER MOBILE NUMBER">
                            <input type="hidden" name="id" value="<?=$this->session->socialuserid?>">
                        </div>
                        <div class="messageContainer"></div>
                        
                    </div>
                    
                    <div class="center">
                      <button type="submit" class="button-submit">CONFIRM</button>
                    </div>
                </form>
                <form id="social_otp_frm" method="post" action="" style="display: none">
                    <input type="hidden" name="mobile" id="hidden_mobile">
                	
                    <div class="custom-margin">
                        <div class="input-group">
                            <span class="input-group-addon"><img src="<?php echo asset_url();?>images/phone-receiver.png" alt="" class="width23" /></span>
                            <input type="text" class="form-control custom-pl" name="otp" id="otp" placeholder="ENTER OTP">
                        </div>
                        <input type="hidden" name="id" value="<?=$this->session->socialuserid?>">
                        <div class="messageContainer"></div>
                        <!--<span><button type="button" class="resend-btn" onclick="resendOtpLogin();">Resend OTP</button></span><br>-->
                    </div>
                    <div class="center">
                    	
                    </div>
                    <div class="center">
                      <button type="submit" class="button-submit">VERIFY</button>
                    </div>
                </form>
                <div class="col-lg-6" id="socialotp_response" style="display: none"> </div>
            </div>
        </div>
    </div>
</div>
 <script>

 $("#social-mobile").modal({
  // backdrop: 'static',
   //keyboard: false
 });
 $('#social-mobile').on('hidden.bs.modal', function () {
  window.location.href = base_url + 'logout';
})
  $('#social-mobile').modal('show');
 </script>
<?php }?> 
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
$('#login_frm').bootstrapValidator({
    container: function($field, validator) {
        return $field.parent().next('.messageContainer');
    },
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        username: {
            validators: {
                notEmpty: {
                    message: 'Email or Phone no. is required'
                } 
            }
        },
        lg_password: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
    event.preventDefault();
    var username=$("#username").val()
    if(isNaN(username))
    {
     var flag=validatemail(username);
     // alert(' ismobile'); 
    }else{
      var flag= mobilevalidate(username);  
    }
    // call userlogin
    if(flag)
    userLogin();

});

function validatemail(val) {
    
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
      if (!expr.test(val)) {
           $("#lg_response").empty();
          $("#lg_response").show();
          $("#lg_response").html('Please enter valid email');
             return false;
      }else return true;
}
        // mobile validation
function mobilevalidate(val){
          
    var expr = /^[7-9]{1}[0-9]{9}$/;
    if (!expr.test(val)) { 
        $("#lg_response").empty();
        $("#lg_response").show();
        $("#lg_response").html('Please enter valid mobile'); 
        return false;
       
    }else return true;
}

function userLogin() {
   ajaxindicatorstart("Please wait..");
  $.post(base_url+"userlogin", { username: $("#username").val(), password: $("#lg_password").val() }, function(data){
        if(data.status == 1 ) {
            ajaxindicatorstop();
                 $("#lg_response").show();
                 $("#lg_response").html(data.msg);
                 //window.location.reload();
                 window.location.href = base_url;
        } else {
            ajaxindicatorstop();
            $("#lg_response").show();
            $("#lg_response").html(data.msg);
        }
  },'json');
}



$('#sign_frm').bootstrapValidator({
    container: function($field, validator) {
        return $field.parent().next('.messageContainer');
    },
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
     excluded: ':disabled',
    fields: {
        fname: {
            validators: {
                notEmpty: {
                    message: 'First Name is required'
                }
            }
        }, 
        lname: {
            validators: {
                notEmpty: {
                    message: 'Last Name is required'
                }
            }
        }, 
        email: {
            validators: {
                notEmpty: {
                    message: 'Email is required'
                },
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'Not a valid email address'
                }
                
            }
        },
        mobile: {
            validators: {
                notEmpty: {
                    message: 'The Mobile is required.'
                },
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Password is required'
                },
                // regexp: { 
                //     //regexp: ((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})',
                //     regexp:'^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,12}',
                //     message: 'Please enter  atleast one small and capital alphabet ,one number and one symbol and minimun six character length'
                // },
            }
        },
        password_confirm: {
            validators: {
                notEmpty: {
                    message: 'Confirm Password is required'
                },
                identical: {
                    field: 'password',
                    message: 'Passwords do not match.'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
    event.preventDefault();
    sendOTP();
});

function sendOTP(){
  ajaxindicatorstart("Please wait..");
    $.post(base_url+"sendotp",{ fname: $("#fname").val(), lname: $("#lname").val(), email: $("#email").val(), mobile: $("#mobile").val()},function(data) {
        if(data.status == 0) {
            ajaxindicatorstop();
            //myRegisterModal
            $("#myRegisterModal").modal("hide");
            $("#OTPVerificationModal").modal("show");
            $("#otp_code").val(data.otp);
            $("#otpp_response").show();
            //$("#otp_response1").html(msg);
            //alert("Verification code sent to the you mobile number to proceed.");
        } else {
            ajaxindicatorstop();
            $("#otpp_response").show();
            $("#otpp_response").html("User already exist");
            //alert("otp not send");
        }
    },'json');
}

$('#otp_frm').bootstrapValidator({
    container: function($field, validator) {
        return $field.parent().next('.messageContainer');
    },
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        user_otp: {
            validators: {
                notEmpty: {
                    message: 'OTP is required and cannot be empty'
                }
            }
        }, 
    }
}).on('success.form.bv', function(event,data) {
    event.preventDefault();
    userOTPtest();
});

function userOTPtest() {
    //alert($("#otp_code").val());
    var otpcode = $("#otp_code").val();
    var userotp = $("#user_otp").val();
    //ajaxindicatorstart("Please wait..");
    if(otpcode == userotp){
        $("#su_response").show();
        $("#OTPVerificationModal").modal("hide");
        userSignUp();
    }else{
        $("#su_response").show();
        swal('','Incorrect OTP. Please enter the correct OTP.','warning');
        return false;
    }
}

function userSignUp() {
   ajaxindicatorstart("Please wait..");
    $.post(base_url+"signup", { fname: $("#fname").val(), lname: $("#lname").val(), email: $("#email").val(), mobile: $("#mobile").val(), password: $("#password").val(),referal_code: $("#referal_code").val() }, function(data){
         ajaxindicatorstop();
        if(data.status == 1) {
         //    
             swal("Thanks for registering with us,","You've been logged in successfully.", "success",{button: "continue",timer: 5000})
                .then((value) => {
                    location.reload();
                    $("#lg_uid").val(data.id);
                    $("#su_emailreg").val(data.email);
                });
            
            
        } else {
           $("#userreg").attr('disabled',false);
            if(data['refstatus'] == 0){
         
            $("#otp_response").show();
            $("#otp_response").html(data.msg);
            $("#referal_code").val('');
            }
        }
    },'json');
}
function resendOtpLogin()
{

  ajaxindicatorstart("Please wait..");
        $.post(base_url+"resendOtp",{username: $("#username").val()},function(data) {
            console.log(data);
            ajaxindicatorstop();
                if(data.status==1)
                {
                    $("#lg_otp_response").show();
                    $("#lg_otp_response").html("Otp send successfully.");
                    $("#loginotp_code").val(data.otp);
                    $("#lg_uid").val(data.id);
                    $("#lg_username").val(data.username);
                }
                else
                { 
                    $("#lg_otp_response").show();
                    $("#lg_otp_response").html(data.msg);
                }     
        },'json'); 
}
function loginWithOTP() {
    var a=$("#username").val();

    if(a=='')
    {
      // alert("Enter Mobile No or email id");
       $(".help-block").hide();
       $("#lg_response").show();
       $("#lg_response").html("Enter Mobile No or email id");
    }
    else
    {
        ajaxindicatorstart("Please wait..");
        $.post(base_url+"sendLoginotp",{username: $("#username").val()},function(data) {
            console.log(data);
            ajaxindicatorstop();
                if(data.status==1)
                {
                    //
                    $("#myLoginModal").modal("hide");
                    $("#login-with-otp").modal("show");
                    $("#loginotp_code").val(data.otp);
                    $("#lg_uid").val(data.id);
                    $("#lg_username").val(data.username);
                    //$("#lg_response").show();
                    //$("#lg_response").html("Please enter the verification code sent to your mobile number to proceed.");
                }
                else
                { 
                   // ajaxindicatorstop();
                    $("#lg_response").show();
                    $("#lg_response").html(data.msg);
                }
                
        },'json');
    }
}

$('#login_otp_frm').bootstrapValidator({
    container: function($field, validator) {
        return $field.parent().next('.messageContainer');
    },
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        loginuser_otp: {
            validators: {
                notEmpty: {
                    message: 'OTP is required and cannot be empty'
                }
            }
        }, 
    }
}).on('success.form.bv', function(event,data) {
    event.preventDefault();
    userLoginOTP();
});

function userLoginOTP() {
    //alert($("#otp_code").val());
    var otpcode = $("#loginotp_code").val();
    var userotp = $("#loginuser_otp").val();
    ajaxindicatorstart("Please wait..");
    if(otpcode == userotp){
        //alert("Otp Verified succsfully");
        $("#lg_otp_response").show();
        $("#lg_otp_response").html("Otp Verified succsfully");
        $.post(base_url+"loginwithOTP",{id : $("#lg_uid").val(),otp: $("#loginuser_otp").val()},function(data) {
          console.log();
          ajaxindicatorstop();
            if(data.status == 1) {
                //alert("Thank you for registering with us. You've been logged in successfully.");
                 location.reload();
            } else {
                $("#otp_response1").show();
                $("#otp_response1").html("Username wrong");
            }
        },'json');
    }else{
        ajaxindicatorstop();
        //alert("Enter correct otp");
        $("#lg_otp_response").show();
        $("#lg_otp_response").html("Enter correct otp");
        return false;
    }
} 
$(document).on('submit','#social_mobile_frm', function(){
    $.ajax({
        url : base_url+"social-mobile-otp",
        data : $(this).serialize(),
        dataType :'JSON',
        type : 'POST',
        success : function(data) {
            
            if(data.status == 0) { 
		swal('',data.msg,'warning');
            } else {
                $("#social_mobile_frm").hide();
                swal('',data.msg,'success');
                $("#socialotp_response").html(data.msg);
                $("#hidden_mobile").val(data.mobile);
                $('#social_otp_frm').show(); 
			
	   }
        }
    });
   return false; 
 });
 $(document).on('submit','#social_otp_frm', function(){
    $.ajax({
        url : base_url+"social_mobile_otp_verify",
        data : $(this).serialize(),
        dataType :'JSON',
        type : 'POST',
        success : function(data) {
            if(data.status == 0) { 
			swal('',data.msg,'warning');
			
		} else {
			location.reload();
			
		}
        }
    });
   return false; 
 });

$('#forget_frm').bootstrapValidator({
    container: function($field, validator) {
        return $field.parent().next('.messageContainer');
    },
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
          forget_email: {
              validators: {
                  notEmpty: {
                      message: 'Email is required and cannot be empty'
                  }
              }
          },
    }
}).on('success.form.bv', function(event,data) {
    event.preventDefault();
    forgetPassword();
});


function forgetPassword() {
    ajaxindicatorstart("Please wait..");
    $.post(base_url+"forgetPassword",{email: $("#forget_email").val()},function(data) {
        if(data.status == 1) {
            ajaxindicatorstop();
            $("#uid").val(data.data['id']);
            $("#forget_response").show();
            $("#forget_response").css("color", "green");
            $("#forget_response").html(data.msg);
            swal('','Instructions to reset your password has been sent to your registered email address.','success') .then((value) => {
                    location.reload();
                   
                });
         
        } else {
            ajaxindicatorstop();
            swal('','The email id has not been registered. Kindly submit a registered email address.','warning');
            $("#forget_response").show();
            $("#forget_response").html(data.msg);
        }
    },'json');
}

//reset password
$('#reset_frm').bootstrapValidator({
    container: function($field, validator) {
        return $field.parent().next('.messageContainer');
    },
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        new_pass: {
             validators: {
                 notEmpty: {
                     message: 'Password is required'
                 },
                 stringLength: {
                     max: 25,
                     min: 6,
                     message: 'Password must be 6 characters or longer.'
                 },
                 // identical: {
                 //     field: 'new_confirm_pass',
                 //     message: 'Passwords do not match.'
                 // }
             }
         },
         new_confirm_pass: {
             validators: {
                notEmpty: {
                     message: 'Confirm Password is required'
                 },
                 stringLength: {
                     max: 25,
                     min: 6,
                     message: 'Password must be 6 characters or longer.'
                 },
                 identical: {
                     field: 'new_pass',
                     message: 'Passwords do not match.'
                 }
             }
         },
    }
}).on('success.form.bv', function(event,data) {
    event.preventDefault();
    resetPassword();
});

function resetPassword() {
    ajaxindicatorstart("Please wait..");
    $.post(base_url+"updatePassword",{userid: $("#userid").val(),resetcode: $("#resetcode").val(),password: $("#new_pass").val()},function(data) {
        if(data.status == 1) {
            ajaxindicatorstop();
            //$("#uid").val(data.data['id']);
            $("#reset_response").show();
             $("#reset_response").css("color", "green");
            $("#reset_response").html(data.msg);
            //$("#fogetModal").modal('hide');
            //$("#fogetModal1").modal("show");
            //alert(data.msg);
            //window.location.href = base_url;
        } else {
            ajaxindicatorstop();
            //alert(data.msg);
            $("#reset_response").show();
            $("#reset_response").html(data.msg);
        }
    },'json');
}

var userid = '<?php echo $this->session->userdata('olouserid') ; ?>';

function booknow(){ 
    //debugger;
 
        if(userid!=""){ 
                //window.location.href=base_url+'select-subcategory'; 
                window.location.href=base_url ; 
        }else{
                 $('#myLoginModal').modal('show');
        }
             
  }
 

</script>
