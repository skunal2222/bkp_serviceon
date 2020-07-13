<!-- User Login Section -->
<section id="profile-login">
    <div class="d-flex align-items-center profile-title-img">
        <img src="<?php echo asset_url();?>frontend/images/profile-img.png" class="profile-img pr-2">
        <span class="profile-title">Profile</span>
    </div>
    <div class="all-user-history">
        <div class="row profile-section-row">
            <?php echo $sidebar_url; ?>
            <div class="col-xl-10 col-lg-9 col-md-9 col-sm-12 tabcontent login-form pb-5" id="Login">
                <div class="card user-login-form ">
                    <form class="profile-login-form" id="frm_profile">
                        <input type="hidden" name="isOtpVerify" id="isOtpVerify" value="0">
                        <div class="form-row">
                            <?php // print_r($userdata); ?>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" name="fname" placeholder="Enter First Name" value="<?= isset($userdata['name'])?$userdata['name']:''; ?>">
                                <div class="messageContainer"></div>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">                                     
                                <label for="phone">Last Name</label>
                                <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" value="<?= isset($userdata['lname'])?$userdata['lname']:''; ?>">
                                <div class="messageContainer"></div>
                            </div>
                        </div>

                        <div class="form-row form-group-padding">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="phone">Phone Number</label>
                                <input type="hidden" id="oldMobile" name="oldMobile" value="<?= isset($userdata['mobile'])?$userdata['mobile']:''; ?>">
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Phone" value="<?= isset($userdata['mobile'])?$userdata['mobile']:''; ?>" maxlength="10">
                                <div class="messageContainer"></div>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email" value="<?= isset($userdata['email'])?$userdata['email']:''; ?>">
                                <div class="messageContainer"></div>
                            </div>
                        </div>

                        <div class="form-row form-group-padding">
                            <div class="form-group col-md-6 col-sm-12" >
                                <label for="birth-date">DOB</label>
                                <input type="date" class="form-control" name="dob" value="<?= isset($userdata['dob'])?$userdata['dob']:''; ?>" >
                                <div class="messageContainer"></div>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">select</option>
                                    <option value="1" <?= (isset($userdata['gender']) && $userdata['gender'] == 1)? 'selected':'' ?>>Male</option>
                                    <option value="2" <?= (isset($userdata['gender']) && $userdata['gender'] == 2)? 'selected':'' ?>>Female</option>
                                </select>
                                <div class="messageContainer"></div>
                            </div>
                        </div>
                        <span id="response-msg"></span>
                        <div class="pt-3 update-button">
                            <button type="submit" class="btn">Update</button>          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
    var optionsMobile = {
        'show' : true,
        'backdrop' : 'static',
        'keyboard' : false
    }

    $(document).on('blur', '#mobile', function () {
        var mobile = $(this).val();
        var oldMobile = $("#oldMobile").val();
        if (mobile != oldMobile) {
            loginWithOTP();
        }
    });

    function loginWithOTP() {
        ajaxindicatorstart("Please wait..");
        $.post(base_url+"send_otp_verify_mobile",{username: $("#mobile").val(), seprateView:1},function(data) {
            ajaxindicatorstop();
            if(data.exist_flag === 0){

            $("#mobileModel").empty();
            $("#mobileModel").html(data.view);
            $("#md-verifymobile").modal(optionsMobile);
            $("#sent-otp").val(data.otp);
            $("#resent-msg").html('Please enter OTP which send your mobile number');
            } else {
                alert('Mobile number alrady exist, Please enter another number.');
                return false;
            }                
        },'json');
        return false;
    }

    $('#frm_profile').bootstrapValidator({
        container: function($field, validator) {
            return $field.parent().find('.messageContainer');
        },
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: ':disabled',
        fields: {
            'fname': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter First Name'
                    },
                    regexp:{
                        regexp:'^[a-zA-Z]+$',
                        message: 'Allowed letters only'
                    }
                }
            },
            'lname': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Last Name'
                    },
                    regexp:{
                        regexp:'^[a-zA-Z]+$',
                        message: 'Allowed letters only'
                    }
                }
            },
            'mobile': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Mobile'
                    },
                    regexp:{
                        regexp:'^[6-9][0-9]{9}$',
                        message: 'Please enter a 10 digit valid mobile number'
                    }
                }
            },
            'email': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Email'
                    },
                    regexp:{
                        regexp:'^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Not a valid email address '
                    }
                }
            },
            'dob': {
                validators: {
                    notEmpty: {
                        message: 'Please Select Date of Birth'
                    }
                }
            },
            'gender': {
                validators: {
                    notEmpty: {
                        message: 'Please Select Gender'
                    }
                }
            },
            'pincode': {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Pincode'
                    }
                }
            }
        }
        }).on('success.form.bv', function(event,data) {
            event.preventDefault();
            $("#response-msg").hide();
            var formData = new FormData($('#frm_profile')[0]);
            ajaxindicatorstart('please wait');
            $.ajax({ url: base_url + 'profile_update', data: formData, type: 'POST', dataType: 'JSON', processData: false, contentType: false, success: function (response) { 
                ajaxindicatorstop();
                    $("#response-msg").show();
                    if (response.status == 1) {
                        $("#isOtpVerify").val(0);
                        $("#response-msg").css('color','green');
                        $("#response-msg").html('Profile updated successfully');
                        setInterval(function(){ location.reload(); }, 3000);
                    } else {
                        $("#response-msg").css('color','red');
                        $("#response-msg").html("Error, Something went wrong!");
                    }
                }
            });
        return false;
    }); 
});
</script>