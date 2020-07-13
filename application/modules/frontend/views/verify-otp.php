<section class="section-padding" id="verifyotp">
    <div class="">
		<div class="col-lg-5 col-md-8 col-sm-12 m-auto">
            <h2 style="font-weight: 900;" class="text-center">Verify Mobile</h2>              
                <div class="pt-4">
                    <span id="resent-msg" style="color: green;"></span><br>
                    <label style="font-size: 0.9em;"><strong>Enter OTP</strong></label>
                    <input type="hidden" name="sent-otp" id="sent-otp">
                    <input type="hidden" name="userid" id="userid" value="<?= !empty($_SESSION['olouserid'])?$_SESSION['olouserid']:0 ?>">
                    <input type="text" class="login-input form-control" placeholder="Enter OTP" name="otp" id="otp" maxlength="6">
                    <span id="otp-error" style="color: red;"></span>
                </div>
                
                <div class="resendotp">
                    <div class="pt-3">
                        <a href="#" id="resendotp">Didn’t receive the OTP? Resend again</a>
                    </div>
                    <div class="pt-3">
                        <a href="#" id="show_number">Change mobile no.</a>      
                    </div>
                </div>
		</div>
	</div>
</section>
<script type="text/javascript">
$(document).ready(function () {
	
	$("#show_number").on('click', function() {
        $("#md-verifymobile").modal('hide');
        $("#mobile").focus();
    });

    $(document).on('keyup', '#otp', function () {
        var otp = $("#otp").val();
        var pattern = '^[0-9]{6}$';
        if (otp.length == 6 && otp.match(pattern)) {
        	ajaxindicatorstart("Please wait..");
            var sent_otp = $("#sent-otp").val();
            if (otp === sent_otp) {
                ajaxindicatorstop();
                $("#isOtpVerify").val(1);
                $("#md-verifymobile").modal('hide');
                /*var mobile = $("#mobile").val();
                var id = $("#userid").val();
                $.post(base_url+"update_mobile",{username: mobile, id:id, otp:otp},function(data) {
                },'json');*/
            }else {
                $("#otp-error").html('OTP is incorrect');
            }
        } else {
            $("#otp-error").html('Please enter valid OTP');
        }
    });

    $("#resendotp").on('click', function() {    
        ajaxindicatorstart("Please wait..");
        
        $.post(base_url+"send_otp_verify_mobile",{username: $("#mobile").val()},function(data) {
            ajaxindicatorstop();
            if(data.exist_flag === 0){
                $("#sent-otp").val(data.otp);
                $("#resent-msg").html('OTP resend successfully!');
            } else {
                alert('something went wrong!');
                return false;
            }                
        },'json');
        return false;
    });
});
</script>