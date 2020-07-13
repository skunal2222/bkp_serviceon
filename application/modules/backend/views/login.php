<?php 
    
    if(isset($_SESSION['adminsession']))
    {     
         redirect('admin/dashboard');
    }

?>
<section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">
                <form class="form-horizontal form-material" id="loginform" action="" method="post">
                    <center><h3 class="box-title m-b-20">Sign In</h3></center>
                    <div class="form-group ">
                        <div class="col-xs-12">
                           <!--<input class="form-control" type="text" required="" placeholder="Username">-->
							<input class="form-control" placeholder="E-mail" name="email" id="email" type="email" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <!--<input class="form-control" type="password" required="" placeholder="Password">-->
							<input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> Remember me </label>
                            </div>
                            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>
                    </div>-->
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" id="login_btn">Log In</button>
                        </div>
                    </div>
                   <!-- <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                            <div class="social">
                                <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Don't have an account? <a href="register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                        </div>
                    </div>-->
                </form>
                <form class="form-horizontal form-material" id="reset_password" style="display: none">
                    <center><h3 class="box-title m-b-20">Reset Password</h3></center>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" maxlength="12" placeholder="Password" name="password" id="r_password" type="password" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                          <input class="form-control" placeholder="Conform Password" name="c_password" id="c_password" type="password" >
                        </div>
                    </div>
                    
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            
                            <button class="btn btn-danger btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" id="login_btn">Submit</button>
                        </div>
                    </div> 
                </form>
                <form class="form-horizontal" id="recoverform" action="">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</section>
	
<script type="text/javascript">
$(document).on('submit', '#loginform', function(){
		$.post("<?php echo base_url();?>admin/login",{email: $('#email').val(), password: $('#password').val()},function(data) {
            console.log(data);
			if(data.status == 1) 
            { 
                if(data.result.first_login == 1 ){
                     $('#loginform').hide();
                     $('#reset_password').show(400); 
                }  
                else if(data.status == 0)
                {
					window.location.href = "<?php echo base_url();?>admin/activate";
				}
                else
                {
					 window.location.href = "<?php echo base_url();?>admin/dashboard";  
				}
			} else {
				alert(data.msg);
			}
		},'json');
        return false;
	});

$(document).on('submit', '#reset_password', function(){
   if($('#r_password').val().length < 6 || $('#r_password').val().length > 12) {
       alert('Password should be 6-12 in length');
       return false;
   }
   if($('#r_password').val() != $('#c_password').val()) {
       alert('Password and confirm password should be same');
       return false;
   }
   $.ajax({
       url : '<?=base_url()?>admin/login/client_reset_password',
       data : $(this).serialize(),
       dataType : 'JSON',
       type : 'POST',
       success : function(response){
           alert(response.msg);
           if (response.status == 1) {
                window.location.href = "<?php echo base_url(); ?>admin/dashboard";
           } 
       }
   });
   return false;
});



</script>

<script type="text/javascript">
    $(document).ready(function(){
       
        $('#myModal').modal({backdrop: 'static', keyboard: false}) ;
    });
</script>
<script>
//document.getElementById('password').onkeydown = function(e){
//	   if(e.keyCode == 13){
//		   alert("inside");
//		   $('#loginform').submit();
//	   }
//	};

    





</script>
		