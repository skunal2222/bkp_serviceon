<link href="https://g2g.dirtzgarage.com/assets/css/offer.css" rel="stylesheet">
     
    <style>
    @media only screen and (max-width:1600px) and (min-width:1400px){
    .head-text{
      margin-bottom: 5%;
      }
    }
     @media only screen and (max-width:767px) {
     .searchbtn {
    width: 200px;
    margin-bottom: 7% !important;;
 }
 .searchbtn {
    width: 200px !important;;;
    margin-top: 5%;
    }
 .head-text {
    font-size: 18px  !important;;;
 }
 }
    @media only screen and (max-width:1400px) and (min-width:1200px){
    .head-text{
      margin-bottom: 1%;
      }
    }
    .container {
    width: 90%;
    }
    .head-text{
    
    font-size: 24px;
    color: #292b2c;
  
    font-weight: 500;
    }
    .social-nav11{
    display: inline-block;
    width: 100%;
    }
.uppercase{

    text-transform: uppercase;
    }
.form-control {
    display: block;
    width: 100%;
    padding: .5rem 0rem;
    }
.searchbtn{
    width: 200px;
    margin-bottom: 4%;
    padding: 10px !important;
    background-color: rgb(247, 187, 51);
    font-family: "Roboto", Helvetica, Arial, sans-serif;
    font-weight: 500;
    color: #000;
    border: none;
    border-radius: 0px;
    text-align: center;
}
    .frmcntrl {
	border-top: aliceblue;
	border-left: antiquewhite;
	border-right: azure;
	display: block;
	width: 100%;
	border: none;
	
    border-bottom: 1px solid #000 !important;
	background-color: transparent !important;
	border-radius: unset !important;
	}
	.social {
    display: inline-block;
    margin-bottom: 2%;
    margin-top: 1%;
}
	.btn12 {
    background-color: rgb(250, 186, 3) !important;
    font-family: "Roboto", Helvetica, Arial, sans-serif !important;
    font-weight: 400 !important;
    color: #151414 !important;
    padding: 7px 45px !important;
    border-radius: 0px !important; 
    cursor: pointer;
}
.frmcntrl {
    color: #000;
    font-weight: 400;
    }
    </style>
  
    <section class="about" id="about" style='background-image: url("<?php echo asset_url();?>images/img/templatemo_main_bg_bottom_wrapper.jpg");background-position: 0px -65.24px;'>
     <div class="container">
      <div class="row">

            
            <div class="col-md-12 text-center">
			
                    <h1 class="head-text">
                        REGISTER
                    </h1>
					
            </div>
           
			
			

	   </div>


		</div>


<div class="container">
<div class="row">
<div class="col-md-3 bike1">

</div>
<div class="col-md-6"></div>
 
<div class="col-md-3"></div>

</div>



</div>



 <div class="container">
<div class="row">

<div class="col-md-3"></div>
<div class="col-md-6">

<form name="su_sign_frm" id="su_sign_frm" method="post" action="" >
<div class="row">
<div class="col-md-6 form-group" style="margin-top:10px;">
     <div>         
    <input name="su_fname" id="su_fname" class="form-control frmcntrl" placeholder="first name" type="text">   
		</div>
<div class="messageContainer" style="color:red"></div>
</div>
<div class="col-md-6 form-group" style="margin-top:10px;">
   <div>
    <input name="su_lname" id="su_lname" class="form-control frmcntrl" placeholder="last name" type="text">   
	</div>
	  <div class="messageContainer" style="color:red"></div>
</div>
<div class="col-md-6 form-group" style="margin-top:10px;">
          <div>     
    <input name="su_mobile" id="su_mobile" class="form-control frmcntrl" placeholder="phone no." type="text">   
		</div>
		  <div class="messageContainer" style="color:red"></div>
</div>
<div class="col-md-6 form-group" style="margin-top:10px;">
     <div>          
    <input name="su_email" id="su_email" class="form-control frmcntrl" placeholder="Email id" type="text">   
	</div>
	  <div class="messageContainer" style="color:red"></div>	
</div>
<div class="col-md-6 form-group" style="margin-top:10px;">
           <div>    
    <input name="su_password" id="su_password" class="form-control frmcntrl" placeholder="password" type="password">   
	</div>
	  <div class="messageContainer" style="color:red"></div>	
</div>
<div class="col-md-6 form-group" style="margin-top:10px;">
      <div>         
    <input name="su_password_confirm" id="su_password_confirm" class="form-control frmcntrl" placeholder="confirm password" type="password">   
	</div>
	  <div class="messageContainer" style="color:red"></div>	
	  <div class="message" style="color:red"></div>
</div>
<div class="col-md-6 form-group" style="margin-top:10px;">
    <div>    
    	<input name="referal_code" id="referal_code" class="form-control frmcntrl" placeholder="Enter referal code(if any)" type="text">   
	</div>
	  <div class="messageContainer" style="color:red"></div>	
</div>
</div>
<div class="col-md-12 text-center">	
<div id="su_response" style="color:red"></div>
<div id="ref_code" style="display:none;color:red"><button type="button" onclick="removeRefcode();">Ok</button></div>
</div>
<div class="col-md-12 text-center" style="margin:6px" >
                <button type="submit" id="su_signup_btn" class="searchbtn uppercase">Register</button>
              </div>
			  </form>
			  
			  <!--<div class="col-md-12 text-center" style="margin:6px" >
              <h5>or register with</h5>
              </div>-->
			  
			  <div class="col-md-12 text-center" style="margin:6px" >
              <div class="row social">
			
             <!-- <div class="text-center">
                       <nav class="nav social-nav text-center">
        <a href="#" style="padding: 8px;">
          <img src="<?php echo asset_url();?>images/img/face.png"class="img-responsive"/>
        </a> 
		<a href="#" style="padding: 8px;">
		 <img src="<?php echo asset_url();?>images/img/goog.png"class="img-responsive"/>
		</a> 
		<a href="#" style="padding: 8px;">
		 <img src="<?php echo asset_url();?>images/img/tweet.png"class="img-responsive" />
		</a>
      </nav>
                    </div>-->
				
</div>
              </div>
			  
			  <div class="col-md-12 text-center" style="margin-top:10px;">
               
    <p>Already have an account?<span style="color:green"><a href="<?php echo base_url();?>login"> Login Now</a></span></p>
		
</div>
</div>

<div class="col-md-3"></div>
</div>


</div> 
   </section>
    
<div id="otpModal" class="modal fade" role="dialog">
  	<div class="modal-dialog custom-dialog">
    	<div class="modal-content">
    	<form action="" name="otp_frm" id="otp_frm">
      		<div class="modal-header">
        		Verification Code Sent!
        		<button type="button" class="close" id="close123" data-dismiss="modal">&times;</button>
      		</div>
      		<div class="modal-body">
        		<div class="form-body pal">
					<div class="row">
						<div class="col-md-12" style="margin-bottom:5px;">
							<input type="hidden" name="lg_uid" id="lg_uid" value=""/>
							<input type="hidden" name="su_emailreg" id="su_emailreg" value=""/>
							<div class="form-group" id="error-load_title">
								<div>
									<input type="text" name="lg_otp" id="lg_otp" class="form-control frmcntrl" placeholder="Enter Your OTP" style="padding: 6px 20px !important;"/>
								</div>
								<span style="float: right;margin-left: -20px;"><a onclick="resendOtp();" style="cursor:pointer;">Resend OTP</a></span>
								<div class="messageContainer" style="color:red"></div>
							</div>
						</div>
						<div class="col-md-12" style="margin-top: 20px;">
							<div class="alert alert-danger" id="otp_response" style="display:none;"></div>
						</div>
					</div>
				</div>
      		</div>
      		<div class="modal-footer text-center" style="display: inherit;">
      		 	<button type="submit" class="btn btn12" id="otp_verify_btn">CONTINUE</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>

<script src="<?php echo asset_url();?>js/lib/jquery/jquery.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
      
<script>

$("#su_password_confirm").keypress(function(event) {
	 if (event.which == 13) {
      event.preventDefault();
      userSignUp();
      return false;
  }
});

$("#lg_otp").keypress(function(event) {
	 if (event.which == 13) {
      event.preventDefault();
      showotp();
      return false;
  }
});

$('#su_signup_btn').on('click', function () {
	  if ($('#su_password').val() == $('#su_password_confirm').val()) {
	    //$('.message').html('').css('color', 'green');
	  } else {
	    $('.message').html('Passwords do not match').css('color', 'red');
	    return false;
	  }
	});

$('#su_sign_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
   excluded: ':disabled',
    fields: {
    	su_fname: {
            validators: {
                notEmpty: {
                    message: 'First Name is required and cannot be empty'
                }
            }
        },
        su_lname: {
            validators: {
                notEmpty: {
                    message: 'Last Name is required and cannot be empty'
                }
            }
        }, 
        su_email: {
            validators: {
                notEmpty: {
                    message: 'Email is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'The value is not a valid email address'
                }
        		
            }
        },
        su_mobile: {
            validators: {
                notEmpty: {
                    message: 'The Mobile is required.'
                },
                regexp: {
                    regexp: '^[7-9][0-9]{9}$',
                    message: 'Invalid Mobile Number'
                }
            }
        },
        su_password: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                },
                stringLength: {
                    max: 25,
                    min: 6,
                    message: 'Password must be 6 characters or longer.'
                }
               /* identical: {
                    field: 'su_password_confirm',
                    message: 'Passwords do not match.'
                }*/
            }
        },
        su_password_confirm: {
            validators: {
            	notEmpty: {
                    message: 'Password is required and cannot be empty'
                },
                stringLength: {
                    max: 25,
                    min: 6,
                    message: 'Password must be 6 characters or longer.'
                },
                identical: {
                    field: 'su_password',
                    message: 'Passwords do not match.'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	userSignUp();
});
$("#lg_response").hide();
$("#su_response").hide();
$("#en_response").hide();
function userSignUp() {
	
	$.post(base_url+"register", { fname: $("#su_fname").val(), lname: $("#su_lname").val(), email: $("#su_email").val(), mobile: $("#su_mobile").val(), password: $("#su_password").val(), referal_code : $("#referal_code").val()}, function(data){
		if(data.status == 0) {
				if(data.refstatus == 1) {
			    	$("#otp_response").show();
					$("#otp_response").html("Please enter the verification code sent to your mobile number to proceed.");
					//alert("Please enter the verification code sent to the you mobile number to proceed.");
					//$("#signInModal").modal("hide");
					$("#otpModal").modal("show");
					$("#lg_uid").val(data.id);
					$("#su_emailreg").val(data.email);
				}else{
					$("#ref_code").show();
					$("#ref_code").html(data.msg);
					$("#su_signup_btn").attr('disabled',false);
				}
			} else {
				$("#su_response").show();
				$("#su_response").html("The email ID or mobile number is already registered.");
				$("#su_recover").show();
				
			}
	},'json');
}

$("#otp_verify_btn").click(function(){
	//ajaxindicatorstart("Please wait.. while we submit your query...");
	$.post(base_url+"otpreg", { id: $("#lg_uid").val(),otp: $("#lg_otp").val()}, function(data){
			if(data.status == 1) {
			//ajaxindicatorstop();
			//alert("Please Login To Continue");
			window.location.href = base_url;
		} else {
			//ajaxindicatorstop();
			$("#otp_response").show();
			$("#otp_response").html(data.msg);
		}
	},'json');
});

function showotp()
{
	$.post(base_url+"otpreg", { id: $("#lg_uid").val(),otp: $("#lg_otp").val()}, function(data){
		if(data.status == 1) {
		//ajaxindicatorstop();
		//alert("Please Login To Continue");
		window.location.href = base_url;
	} else {
		//ajaxindicatorstop();
		$("#otp_response").show();
		$("#otp_response").html(data.msg);
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
    	lg_otp: {
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
	var useremail = $("#su_emailreg").val();
	//alert("hi");
	//alert(useremail);
	$.post(base_url+"otpreg",{id: $("#lg_uid").val(),otp: $("#lg_otp").val()},function(data) {
		if(data.status == 1) {
			//$("#otp_response").show();
			//$("#otp_response").html("Thank you for registering with us. You've been logged in successfully.");
			alert("Thank you for registering with us. You've been logged in successfully.");
			//$("#otpModel").modal('hide');
			//$("#signInModal1").modal('show');
			window.location.href = base_url;
		} else {
			$("#otp_response").show();
			$("#otp_response").html("Incorrect Code. Please enter the correct Code.");
			//alert("Incorrect OTP. Please enter the correct OTP.");
			/*$("#close123").mouseover(function(){
				alert("Please enter the correct OTP");
			});*/
		}
	},'json');
}

function resendOtp() {
	//alert("hi");
$.post(base_url+"resendotp",{email: $("#su_emailreg").val()},function(data) {
		//alert(data.status);
		if(data.status == 1) {
			$("#signInModal1").modal("hide");
			$("#otp_response").show();
			$("#otp_response").html("Verification code has been resent to your mobile number.");
			//alert("Verification code sent to the you mobile number to proceed.");
		} else
		{
			$("#otp_response").show();
			$("#otp_response").html("Code not send");
			//alert("otp not send");
		}
	},'json');
}

function removeRefcode(){
	//$("#referal_code").empty();
	$("#referal_code").val('');
}
</script>
