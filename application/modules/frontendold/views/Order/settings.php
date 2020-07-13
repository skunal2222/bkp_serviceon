   <style>
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

.searchbtn1 {
    margin-left: 5px;
    background-color: transparent;
    font-family: "Roboto", Helvetica, Arial, sans-serif;
    font-weight: 400;
    color: #0c0c0c;
    padding: 14px;
    display: inline-block;
    white-space: nowrap;
    cursor: pointer;
    border: 2px solid;
    border-color:rgb(250, 186, 3);
    }
    
@media only screen and (max-width:767px) and (min-width:200px){
   .spl1{
      padding-top: 0px !important;
   }
   .show1{
        position: absolute;
        right: 15px;
        font-size: 12px;
   }
   .form-control {
        font-size: 14px !important;;
    }
}
@media only screen and (min-width:768px) {
    .show1{
     font-size: 13px;
    }
 }   
</style>

<link href="<?php echo asset_url();?>css/order.css" rel="stylesheet">
    <section class="about" id="about" style='background-image: url("<?php echo asset_url();?>images/img/templatemo_main_bg_bottom_wrapper.jpg");background-position: 0px -65.24px;'>
     <div class="container">
      <div class="row">

           <div class="col-lg-3 col-xs-12">
				<div class="nk-footer-text" style="margin: 23px;">
					<!-- <ul> -->
					<!-- <li><a href="#section-london">London</a></li> -->
					<!-- <li><a href="#section-paris">Paris</a></li> -->
					<!-- </ul> -->
			    <a href="<?php echo base_url();?>order/trackorder"><p class="foterp">Ongoing Orders</p></a>
				<a href="<?php echo base_url();?>order/history">	<p class="foterp">Order	History</p></a>
				<!--<a href="<?php echo base_url();?>order/notification"><p class="foterp">Notifications <span>2</span></p></a>-->
				<a href="<?php echo base_url();?>order/setting"><p class="foterp act">Settings</p></a>
				<a href="<?php echo base_url();?>order/wallet"><p class="foterp">Wallet</p></a> 
				<a href="<?php echo base_url();?>order/offer"><p class="foterp">Offers</p></a>
				</div>
			</div>
            
            <div class="col-lg-9 col-xs-12 text-center" style="padding-top: 23px;">
			 <form name="user_update" id="user_update" method="post" action="" >
			 <?php foreach($user as $row){ ?>
                    <div class="nk-footer-text">
					<!-- <img src="img/Thankucheck.png" class="img-responsive" /> -->
                        <p class="foterp spl">BASIC INFO</p>
						<div class="row text-center spl1">
						<?php $abc=explode(" ",$row['name']);?>
						<div class="col-lg-6 form-group">
								<div class="input-group">
								<input name="id" id="id" class="form-control frmcntrl" type="hidden" value="<?php echo $row['id']; ?>" >
									<input name="fname" id="fname" class="form-control frmcntrl"
										placeholder="First Name" type="text" value="<?php echo $abc[0]; ?>" >
										<span style="float: right;margin-left: -20px;"><i class="fa fa-pencil fa-fw"></i></span>
								</div>
								<div class="messageContainer"></div>
					   </div>
					   
					   <div class="col-lg-6 form-group">
								<div class="input-group">
								<input name="id" id="id" class="form-control frmcntrl" type="hidden" value="<?php echo $olouserid; ?>" >
									<input name="lname" id="lname" class="form-control frmcntrl"
										placeholder="Last Name" type="text" value="<?php echo $abc[1]; ?>" >
										<span style="float: right;margin-left: -20px;"><i class="fa fa-pencil fa-fw"></i></span>
								</div>
								<div class="messageContainer"></div>
					   </div>
					   
					  
					   </div>
					   
					  <div class="row text-center spl1">
					     <div class="col-md-6 form-group">
								<div class="input-group">
									<input name="mobile" id="mobile" class="form-control frmcntrl"
										placeholder="Mobile" type="text" readonly value="<?php echo $row['mobile']; ?>" >
										
								</div>
								
								<div class="messageContainer"></div>
					   </div>
					   <div class="col-lg-6 form-group">
								<div class="input-group">
									<input name="email" id="email" class="form-control frmcntrl"
										placeholder="Email" type="text" value="<?php echo $row['email']; ?>" >
										<span style="float: right;margin-left: -20px;"><i class="fa fa-pencil fa-fw"></i></span>
								</div>
								<div class="messageContainer"></div>
					   </div>
					 
					   </div>
					   
					
					   
					     <div class="row text-center spl1">
					   
					  <div class="col-md-6 form-group" id="hidep">
								<div class="input-group">
								
									<input name="password" id="password" class="form-control frmcntrl"
										placeholder="Password" type="password" value="<?php echo $row['original']; ?>" >
										<span style="float: right;margin-left: -20px;"><i class="fa fa-pencil fa-fw"></i></span>
										
								</div>
								<span style="float: right;margin-left: -20px;" class="show1"><a onclick="showpass();">Show</a></span>
								<div class="messageContainer"></div>
					   </div>
					   
					     <div class="col-md-6 form-group" id="showp" style="display:none;">
								<div class="input-group">
								
									<input name="password1" id="password1" class="form-control frmcntrl"
										placeholder="Password" type="text" value="<?php echo $row['original']; ?>" >
										<span style="float: right;margin-left: -20px;"><i class="fa fa-pencil fa-fw"></i></span>
										
								</div>
								<span style="float: right;margin-left: -20px;"><a onclick="hidepass();">Hide</a></span>
								<div class="messageContainer"></div>
					   </div>
					   
					   <div class="col-lg-6 form-group">
								<div class="input-group">
									<input name="cpassword" id="cpassword" class="form-control frmcntrl"
										placeholder="Confirm Password" type="password" value="<?php echo $row['original']; ?>" >
										<span style="float: right;margin-left: -20px;"><i class="fa fa-pencil fa-fw"></i></span>
								</div>
								<div class="messageContainer"></div>
					   </div>
					   </div>
					   
			 		        <div class="row text-center spl1" id="vehicleid">
					     <div class="col-md-6 form-group">
								<div class="input-group">
									<input name="model" id="model" class="form-control frmcntrl"
										placeholder="Vehicle Model" type="text" value="<?php echo $row['model']; ?>" >
										<span style="float: right;margin-left: -20px;"><i class="fa fa-pencil fa-fw"></i></span>
								</div>
								
								<div class="messageContainer"></div>
					   </div>
					   <div class="col-lg-6 form-group">
								<div class="input-group">
									<input name="vehicleno" id="vehicleno" class="form-control frmcntrl"
										placeholder="Vehicle No" type="text" value="<?php echo $row['vehicle_no']; ?>" >
										<span style="float: right;margin-left: -20px;"><i class="fa fa-pencil fa-fw"></i></span>
								</div>
								<div class="messageContainer"></div>
					   </div>
					 
					   </div>
					   <?php //if(!empty($user1[0]['model'])){ ?>
					          <div class="row text-center spl1" id="vehicleid1" style="display:none;">
					     <div class="col-md-6 form-group">
								<div class="input-group">
									<input name="model1" id="model1" class="form-control frmcntrl"
										placeholder="Vehicle Model" type="text" value="<?php echo $user1[0]['model']; ?>" >
										<span style="float: right;margin-left: -20px;"><i class="fa fa-pencil fa-fw"></i></span>
								</div>
								
								<div class="messageContainer"></div>
					   </div>
					   <div class="col-lg-6 form-group">
								<div class="input-group">
									<input name="vehicleno1" id="vehicleno1" class="form-control frmcntrl"
										placeholder="Vehicle No" type="text" value="<?php echo $user1[0]['vehicle_no']; ?>" >
										<span style="float: right;margin-left: -20px;"><i class="fa fa-pencil fa-fw"></i></span>
								</div>
								<div class="messageContainer"></div>
								<a href="javascript:removeItem();" style="margin-left: 400px;"><i class="fa fa-times" style="color:grey;"></i></a>
					   </div>
					 
					   </div>
					   <?php //} ?>
					   <br>
					   	<div class="col-md-12 text-center">
					   	<button class="searchbtn1" type="button" onclick="addMoreVehicle();">ADD VEHICLE</button> 
						<button class="searchbtn1" type="button" onclick="userUpdate();">UPDATE INFO</button>
				    	</div>
					   
			       </div>
			       <?php } ?>
					</form>
            </div>	
          
            
        
	   </div>


		</div>


<div class="container">
<div class="row">
<div class="col-md-3 bike1">

</div>
 <div class="col-md-6"><!--<img src="img/GooglePlay.png" class="img-responsive" width="100%"/> --></div>
 
<div class="col-md-3"></div>

</div>



</div></section>

    <a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a>
    <script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var asset_url = '<?php echo asset_url();?>'; 
</script>
<script>
function ajaxindicatorstart(text)
{
	if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
	jQuery('body').append('<div id="resultLoading" style="display:none"><div><i class="fa fa-spinner fa-5x"></i><div>'+text+'</div></div><div class="bg"></div></div>');
	}

	jQuery('#resultLoading').css({
		'width':'100%',
		'height':'100%',
		'position':'fixed',
		'z-index':'10000000',
		'top':'0',
		'left':'0',
		'right':'0',
		'bottom':'0',
		'margin':'auto'
	});

	jQuery('#resultLoading .bg').css({
		'background':'#000000',
		'opacity':'0.7',
		'width':'100%',
		'height':'100%',
		'position':'absolute',
		'top':'0'
	});

	jQuery('#resultLoading>div:first').css({
		'width': '250px',
		'height':'75px',
		'text-align': 'center',
		'position': 'fixed',
		'top':'0',
		'left':'0',
		'right':'0',
		'bottom':'0',
		'margin':'auto',
		'font-size':'16px',
		'z-index':'10',
		'color':'#ffffff'

	});

    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}
function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
} 
</script>
<script type="text/javascript">
$('#update_user').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
  //  excluded: ':disabled',
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: 'The Mobile is required.'
                }
            }
        },
        mobile: {
            validators: {
                notEmpty: {
                    message: 'Mobile is required and cannot be empty'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                }
            }
        },
        cpassword: {
            validators: {
            	notEmpty: {
                    message: 'Password is required and cannot be empty'
                },
                identical: {
                    field: 'password',
                    message: 'Passwords do not match.'
                }
            }
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'Email is required and cannot be empty'
                }
            }
        },
        
    }
});

$("#lg_response").hide();

function userUpdate() {
	
	$.post(base_url+"order/userupdate", {id: $("#id").val(), fname: $("#fname").val(),lname: $("#lname").val(), email: $("#email").val(), password: $("#password").val(), mobile: $("#mobile").val(),model: $("#model").val(), vehicleno: $("#vehicleno").val(),model1: $("#model1").val(), vehicleno1: $("#vehicleno1").val() }, function(data){
		if(data.status == 1) {
			//window.location.reload();
			window.location.href = base_url+'order/setting';
		} else {
			$("#lg_response").show();
			$("#lg_response").html(data.msg);
		}
	},'json');
}
</script>
<script>
$("#showp").hide();
function showpass()
{
	$("#hidep").hide();
	$("#showp").show();
}

function hidepass()
{
	$("#hidep").show();
	$("#showp").hide();
}

$("#vehicleid1").hide();
function addMoreVehicle() {
	/*var rows = parseInt($("#rcount").val());
	rows = rows + 1;
	var html = '<div class="row text-center spl1" id="rowitem-'+rows+'">'+
  		'<div class="col-md-6 form-group">'+
  		'<div class="input-group">'+
		'<input type="hidden" name="itemid[]" id="itemid-'+rows+'" value=""/>'+
		'<input name="model" id="model" class="form-control frmcntrl" placeholder="Vehicle Model" type="text">'+
		'</div>'+
		'</div>'+
		'<div class="col-md-6 form-group">'+
  		'<div class="input-group">'+
		'<input name="model" id="model" class="form-control frmcntrl" placeholder="Vehicle Model" type="text"'+
		'</div>'+
		'</div>'+
		'<div class="col-sm-1"><a href="javascript:removeItem('+rows+');" class="btn btn-xs"><i class="fa fa-times"></i></a></div>'+
		'</div>';
	$("#vehicleid").append(html);
	$("#rcount").val(rows);*/
	$("#vehicleid1").show();
	
}

function removeItem() {
	$("#vehicleid1").hide();
	 $('#model1').val('');
	 $('#vehicleno1').val('');
}
</script>