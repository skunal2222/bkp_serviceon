    <style>
    .nav-menu a {
    font-size: 15px;
    }
     @media only screen and (max-width:1600px) and (min-width:1400px){
    .head-text{
      margin-bottom: 6%;
      }
    }
    @media only screen and (max-width:767px) {
    .login-font {
    font-size: 12px !important;;;
}
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
.social{
    display: inline-block;
    margin-bottom: 2%;
    margin-top:1%;
    }
    .container {
    width: 90%;
}
.head-text{
    font-size: 24px;
    color: #292b2c;
    font-weight: 500;
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
.scrolltop{
background:#000;
}
.uppercase{

    text-transform: uppercase;
    }
.frmcntrl {
	border-top: aliceblue;
	border-left: antiquewhite;
	border-right: azure;
	display: block;
	width: 100%;
	border: none;
	border-bottom: 1px solid #757575 !important;
	background-color: transparent !important;
	border-radius: unset !important;
}

.btn12 {
    background-color: #f7bb33 !important;
    font-family: "Roboto", Helvetica, Arial, sans-serif !important;
    font-weight: 400 !important;
    color: #151414 !important;
    padding: 7px 45px !important;
    border-radius: 0px !important; 
    cursor: pointer;
}

.input-disabled
{
background-color:#EBEBE4;
border:1px solid #ABADB3;
padding:2px 1px;
}
    </style>
  
    <section class="about" id="about" style='background-image: url("<?php echo asset_url();?>images/img/templatemo_main_bg_bottom_wrapper.jpg");background-position: 0px -65.24px;'>
     <div class="container">
      <div class="row">
      <div class="col-md-12 text-center">
              <h1 class="head-text">
                       LOGIN TO YOUR ACCOUNT
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
	 <form name="lg_login_frm" id="lg_login_frm" method="post" action="" >
<div class="col-md-12 form-group" style="margin-top:10px;">
         <div>      
    <input name="lg_mobile" id="lg_mobile" class="form-control frmcntrl" placeholder="Phone Number" type="text">   
		</div>
		<div class="messageContainer" style="color:red"></div>
</div>
<div class="col-md-12 form-group" style="margin-top:10px;">
               <div>
    <input name="lg_password" id="lg_password" class="form-control frmcntrl" placeholder="Password" type="password">
         
		</div>
		<div class="messageContainer" style="color:red"></div>
</div>
<div class="col-md-12 form-group" style="margin-top:10px;">
    <span>
    <a data-toggle="modal" data-target="#fogetModal" data-dismiss="modal" style="cursor:pointer;" class="login-font"><i>Forgot Password</i></a>
    </span>
    <span style="float:right;">
    <a onclick="otpLogin();" style="cursor:pointer;" class="login-font"><i>Login through OTP</i></a>  
	</span>
</div>
<div class="col-md-12 text-center">	<div id="lg_response" style="color:red"></div></div>
<div class="col-md-12 text-center" style="margin:6px" >
               <button type="submit" class="searchbtn uppercase">Login</button>
              </div>
			  </form>
			  <!--<div class="col-md-12 text-center" style="margin:6px" >
               <h5>or login with</h5>
              </div>-->
			  
			  <div class="col-md-12 text-center" style="margin:6px" >
              <div class="row text-center social">
			
              <!--<div class="text-center">
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
               
    <p>Don't have an account?<span style="color:green"><a href="<?php echo base_url();?>signup"> Register Now</a></span></p>
		
</div>
</div>

<div class="col-md-3"></div>
</div>


</div>
  </section>
  
<div id="fogetModal" class="modal fade" role="dialog" style="color:#555;">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form action="" name="forget_frm" id="forget_frm">
      		<div class="modal-header">
        		<h4 class="modal-title">Forgot Password</h4>
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
      		</div>
	      	<div class="modal-body">
              	<div class="row" style="padding:0px">
              		<div class="col-md-12">
                  		<div class="form-group">
                       		<input type="text" name="forget_email" id="forget_email" class="form-control frmcntrl" value="" placeholder="Enter Email or Mobile" />
                  		</div>
                  		<div class="messageContainer" style="color:red"></div>
              		</div>
              	</div>
	      	</div>
	      	<div class="modal-footer">
	      		<button type="submit" class="btn btn12" >SUBMIT</button>
	        	<button type="button" class="btn btn12 uppercase" data-dismiss="modal">Close</button>
	      	</div>
	      	</form>
    	</div>
  	</div>
</div>

<div id="fogetModal1" class="modal fade" role="dialog" style="color:#555;">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form action="" name="forget_frm1" id="forget_frm1">
      		<div class="modal-header">
        		<h4 class="modal-title">Forgot Password</h4>
        		<button type="button" class="close" id="close123" data-dismiss="modal">&times;</button>
      		</div>
	      	<div class="modal-body">
              	<div class="row" style="padding:0px">
              		<div class="col-md-12">
              		<input type="hidden" name="uid" id="uid" value=""/>
                  		<div class="form-group">
                       		<input type="password" name="new_password" id="new_password" class="form-control frmcntrl" value="" placeholder="new password" />
                  		</div>
                  		<div class="messageContainer" style="color:red"></div>
              		</div>
              			<div class="col-md-12">
                  		<div class="form-group">
                       		<input type="password" name="new_password1" id="new_password1" class="form-control frmcntrl" value="" placeholder="confirm password" />
                  		</div>
                  		<div class="messageContainer" style="color:red"></div>
              		</div>
              	</div>
	      	</div>
	      	<div class="modal-footer">
	      		<button type="submit" class="btn btn12" style="margin-right: 140px;">RESET NOW</button>
	       	</div>
	      	</form>
    	</div>
  	</div>
</div>

<div id="otpModal1" class="modal fade" role="dialog">
  	<div class="modal-dialog custom-dialog">
    	<div class="modal-content">
    	<form action="" name="otp_frm1" id="otp_frm1">
      		<div class="modal-header">
      		<h4 class="modal-title">Verification Code Sent!</h4>
      		<button type="button" class="close" id="close123" data-dismiss="modal">&times;</button>
      		</div>
      		<div class="modal-body">
        		<div class="form-body pal">
					<div class="row">
						<div class="col-md-12" style="margin-bottom:5px;">
							<input type="hidden" name="lg_uid" id="lg_uid" value=""/>
							<input type="hidden" name="su_email12" id="su_email12" value=""/>
							<div class="form-group" id="error-load_title">
								<div>
									<input type="text" name="lg_otp1" id="lg_otp1" class="form-control frmcntrl" placeholder="Enter OTP" style="padding: 6px 20px !important;"/>
								</div>
								<span style="float: right;margin-left: -20px;"><a onclick="resendOtp();" style="cursor:pointer;">Resend OTP</a></span>
								<div class="messageContainer" style="color:red"></div>
							</div>
						</div>
						<div class="col-md-12" style="margin-top: 20px;">
							<div class="alert alert-danger" id="otp_response1" style="display:none;"></div>
						</div>
					</div>
				</div>
      		</div>
      		<div class="modal-footer text-center" style="display: inherit;">
      		<!-- <a href="" class="green-icon pull-left" style="text-decoration:underline;" onclick="resendOtp();">Resend Otp</a>-->
      			<button type="submit" class="btn btn12" id="otp_verify_btn">CONTINUE</button>
      		</div>
      		</form>
    	</div>
  	</div>
</div>   

<script src="<?php echo asset_url();?>js/lib/jquery/jquery.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
  <script type="text/javascript">
$('#lg_login_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
   excluded: ':disabled',
    fields: {
        lg_mobile: {
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
        lg_password: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {	event.preventDefault();	userLogin();});

$("#lg_response").hide();

function userLogin() {
	
	$.post(base_url+"userlogin", { mobile: $("#lg_mobile").val(), password: $("#lg_password").val() }, function(data){
		if(data.is_verify==1)
		{
			$("#lg_response").show();
			$("#lg_response").html(data.msg);
		}
		else{ 
			if(data.status == 1 && data.otp_verify==1) {
				     $("#lg_response").html(data.msg);
					 window.location.href = base_url;
			} 
			else if(data.status == 1 && data.otp_verify==0)
			{
				$("#lg_uid").val(data.id);
				$("#su_email12").val(data.email);
				$("#myModal").modal("hide");
				$("#otpModal1").modal("show");
				$("#otp_response1").show();
				$("#otp_response1").html("Please enter the verification code sent to your mobile number to proceed.");
				
			}
			else
			{
				$("#lg_response").show();
				$("#lg_response").html(data.msg);
				
			}
		}
	},'json');
}


$("#otp1_response").hide();
$("#otp_verify_btn").click(function(){
	//ajaxindicatorstart("Please wait.. while we submit your query...");
	//$.get(base_url+"verifyotp/"+$("#lg_uid").val()+"/"+$("#lg_otp").val(), { }, function(data){
		$.post(base_url+"otpreg", { id: $("#lg_uid").val(),otp: $("#lg_otp").val()}, function(data){
			//alert(data.mobile);
		if(data.status == 1) {
			alert("Thank you for registering with us. You've been logged in successfully.");
			window.location.href = base_url;
		} else {
			//ajaxindicatorstop();
			$("#otp1_response").show();
			//$("#otp1_response").html(data.msg);
			//alert(data.msg);
		}
	},'json');
});

$("#lg_pwd").keypress(function(event) {
	 if (event.which == 13) {
       event.preventDefault();
       userLogin();
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

function showotp()
{
	$.post(base_url+"otpreg", { id: $("#lg_uid").val(),otp: $("#lg_otp").val()}, function(data){
		//alert(data.mobile);
	if(data.status == 1) {
		alert("Thank you for registering with us. You've been logged in successfully.");
		window.location.href = base_url;
	} else {
		//ajaxindicatorstop();
		$("#otp1_response").show();
		//$("#otp1_response").html(data.msg);
		//alert(data.msg);
	}
},'json');
}



$('#otp_frm1').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	lg_otp1: {
            validators: {
                notEmpty: {
                    message: 'OTP is required and cannot be empty'
                }
            }
        }, 
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	userOTP2();
});

function userOTP2() {
	$.post(base_url+"otpreg",{id: $("#lg_uid").val(),otp: $("#lg_otp1").val()},function(data) {
		if(data.status == 1) {
			//$("#otp_response1").show();
			//$("#otp_response1").html("Thank you for registering with us. You've been logged in successfully.");
			alert("Thank you for registering with us. You've been logged in successfully.");
			//$("#otpModel").modal('hide');
			//$("#signInModal1").modal('show');
			window.location.href = base_url;
		} else {
			$("#otp_response1").show();
			$("#otp_response1").html("Incorrect Code. Please enter the correct Code.");
			//alert("Please Enter Correct Otp");
			/*$("#close123").mouseover(function(){
				alert("Incorrect OTP. Please enter the correct OTP.");
			});*/
		}
	},'json');
}

function resendOtp() {
	//alert("hi");
	$.post(base_url+"resendotp",{email: $("#su_email12").val()},function(data) {
		//alert(data.status);
		if(data.status == 1) {
			$("#signInModal1").modal("hide");
			$("#otp_response1").show();
			$("#otp_response1").html("Verification code has been resent to your mobile number.");
			//alert("Verification code sent to the you mobile number to proceed.");
		} else
		{
			$("#otp_response1").show();
			$("#otp_response1").html("Code not send");
			//alert("otp not send");
		}
	},'json');
}

function otpLogin() {
	var a=$("#lg_mobile").val();

	if(a=='')
	{
       alert("Enter Mobile No");
	}
	else
	{
	$.post(base_url+"sendotp",{mobile: $("#lg_mobile").val()},function(data) {
			if(data.is_verify==0)
			{
				
				$("#otpModal1").modal("show");
				$("#lg_uid").val(data.id);
				$("#su_email12").val(data.email);
				$("#otp_response1").show();
				$("#otp_response1").html("Please enter the verification code sent to your mobile number to proceed.");
			}
			else
			{ 
				$("#lg_response").show();
				$("#lg_response").html(data.msg);
			}
			 
			
	},'json');
	}
}

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
                      message: 'Email or Mobile is required and cannot be empty'
                  }
              }
          },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	resendPassword1();
});
function resendPassword1() {
	$.post(base_url+"resetpassword",{email: $("#forget_email").val()},function(data) {
		if(data.status == 1) {
			$("#uid").val(data.data['id']);
			$("#fogetModal").modal('hide');
			$("#fogetModal1").modal("show");
			//alert(data.msg);
			//window.location.href = base_url;
		} else {
			alert(data.msg);
		}
	},'json');
}


$('#forget_frm1').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
       new_password: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                },
                identical: {
                    field: 'new_password1',
                    message: 'Passwords do not match.'
                }
            }
        },
        new_password1: {
            validators: {
            	notEmpty: {
                    message: 'Password is required and cannot be empty'
                },
                identical: {
                    field: 'new_password',
                    message: 'Passwords do not match.'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	resetPassword1();
});
function resetPassword1() {
	$.post(base_url+"resetpassword1",{id: $("#uid").val(),password: $("#new_password").val()},function(data) {
		if(data.status == 1) {
			window.location.href = base_url;
		} else {
			alert(data.msg);
		}
	},'json');
}
</script>
